<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Auth;
use App\Models\User;
use App\Models\userDetail;
use App\Models\agency\joinHelper;
use App\Models\orders\order;
use App\Models\country;

class agencyController extends Controller
{

	//Orders

	function Orders(){
		if(Auth::check() && Auth::user()->type == '3'){
			$orders = array();
			$orders['pending'] = order::where('seller_id', Auth::id())->where('status', '1')->get();
			$orders['confirmed'] = order::where('seller_id', Auth::id())->where('status', '2')->get();
			$orders['completed'] = order::where('seller_id', Auth::id())->where('status', '3')->get();
			$orders['rejected'] = order::where('seller_id', Auth::id())->where('status', '4')->get();

			return view('web.agency.orders', ['orders' => $orders]);
		}else{
			return redirect('/');
		}
	}

	//Profile

	function profile(){
		if(Auth::check() && Auth::user()->type == '3'){
			$request = joinHelper::where('agency_id', Auth::id())->where('status', '1')->orderBy('created_at', 'desc')->get();
			$curr_helper = joinHelper::where('agency_id', Auth::id())
									->where('status', '2')
									->where('star', null)
									->orderBy('created_at', 'desc')
									->get();
			$star_helper = joinHelper::where('agency_id', Auth::id())
									->where('status', '2')
									->where('star', '1')
									->orderBy('created_at', 'desc')
									->get();

			return view('web.agency.profile', ['request' => $request, 'curr_helper' => $curr_helper, 'star_helper' => $star_helper]);
		}else{
			return redirect('/');
		}
	}
	function acceptRequest($id){
		if(Auth::check() && Auth::user()->type == '3'){
			$id = base64_decode($id);
			$c = joinHelper::where('helper_id', $id)->where('agency_id', Auth::id())->first();
			$c->status = '2';
			$c->save();
			joinHelper::where('helper_id', $id)->where('status', '1')->delete();

			return redirect()->back()->with('success', 'Request Approved.');
		}else{
			return redirect('/');
		}
	}
	function rejectRequest($id){
		if(Auth::check() && Auth::user()->type == '3'){
			$id = base64_decode($id);
			$c = joinHelper::where('helper_id', $id)->where('agency_id', Auth::id())->first();
			$c->status = '3';
			$c->save();

			return redirect()->back()->with('success', 'Request Rejected.');
		}else{
			return redirect('/');
		}
	}
	function makeStar($id){
		if(Auth::check() && Auth::user()->type == '3'){
			$id = base64_decode($id);
			$c = joinHelper::where('helper_id', $id)->where('agency_id', Auth::id())->first();
			$c->star = '1';
			$c->save();

			return redirect()->back()->with('success', 'Added to Star Helper.');
		}else{
			return redirect('/');
		}
	}
	function removeStar($id){
		if(Auth::check() && Auth::user()->type == '3'){
			$id = base64_decode($id);
			$c = joinHelper::where('helper_id', $id)->where('agency_id', Auth::id())->first();
			$c->star = null;
			$c->save();

			return redirect()->back()->with('success', 'Removed from Star Helper.');
		}else{
			return redirect('/');
		}
	}
	function terminateHelper($id){
		if(Auth::check() && Auth::user()->type == '3'){
			$id = base64_decode($id);
			$c = joinHelper::where('helper_id', $id)->where('agency_id', Auth::id())->first();
			$c->status = '4';
			$c->save();

			return redirect()->back()->with('success', 'Helper Terminated.');
		}else{
			return redirect('/');
		}
	}




	//Helper Join

	function join($id){
		if(Auth::check() && Auth::user()->type == '2'){
			$id = base64_decode($id);
			$c = joinHelper::where('helper_id', Auth::id())->where('agency_id', $id)->count();
			$x = joinHelper::where('helper_id', Auth::id())->where('status', '2')->count();
			if($c != '0'){
				return redirect()->back()->with('error', 'You are aleardy Submited request to this agency.');
			}elseif($x != '0'){
				return redirect()->back()->with('error', 'You are aleardy employed with a agency.');
			}else{
				joinHelper::addJoin($id);
				return redirect()->back()->with('success', 'You have Submited request for joining.');
			}
		}else{
			return redirect('/');
		}
	}

    
    // Registration 

	function rule_1(){
		if(Auth::check() && Auth::user()->type == '3'){

			return view('web.agency.rule1');
		}else{
			return redirect('/');
		}
	}    

	function rule_2(){
		if(Auth::check() && Auth::user()->type == '3'){

			return view('web.agency.rule2');
		}else{
			return redirect('/');
		}
	} 

	function form(){
		if(Auth::check() && Auth::user()->type == '3'){
			$country = country::all();
			return view('web.agency.form', ['country' => $country]);
		}else{
			return redirect('/');
		}
	} 
	function formSubmit(Request $request){
		if(Auth::check() && Auth::user()->type == '3'){
			$data = $request->all();

			$u = User::find(Auth::id());
			$u->company = $data['company'];

				if ($request->hasFile('profileImage')) {
					$file = $request->file('profileImage');
		            $filename = Auth::id().'-'.date('dmyHis').'.'.$file->getClientOriginalExtension();
		            $file->move(base_path('/public/profile_img/'), $filename);

		            $u->profile_img = $filename;
		        }
		        if ($request->hasFile('coverImage')) {
					$cfile = $request->file('coverImage');
		            $cfilename = Auth::id().'-'.date('dmyHis').'.'.$cfile->getClientOriginalExtension();
		            $cfile->move(base_path('/public/cover_img/'), $cfilename);

		            $u->cover_img = $cfilename;
		        }

			$u->save();

			userDetail::addDetail($data);

			return redirect('/agency/profile');

		}else{
			return redirect('/');
		}
	}   
}
