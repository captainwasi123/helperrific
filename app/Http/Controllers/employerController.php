<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Auth;
use App\Models\User;
use App\Models\userDetail;
use App\Models\skills;
use App\Models\qual;
use App\Models\employer\empSkills;
use App\Models\employer\empQual;
use App\Models\orders\order;
use App\Models\country;

class employerController extends Controller
{

	//Orders

	function Orders(){
		if(Auth::check() && Auth::user()->type == '1'){
			$orders = array();
			$orders['pending'] = order::where('buyer_id', Auth::id())->where('status', '1')->get();
			$orders['confirmed'] = order::where('buyer_id', Auth::id())->where('status', '2')->get();
			$orders['completed'] = order::where('buyer_id', Auth::id())->where('status', '3')->get();
			$orders['rejected'] = order::where('buyer_id', Auth::id())->where('status', '4')->get();

			return view('web.employer.orders', ['orders' => $orders]);
		}else{
			return redirect('/');
		}
	}

    //Profile

	function profile(){
		if(Auth::check() && Auth::user()->type == '1'){
			$orders = order::where('buyer_id', Auth::id())->orderBy('status')->get();

			return view('web.employer.profile', ['orders' => $orders]);
		}else{
			return redirect('/');
		}
	}

	// Registration 

	function rule_1(){
		if(Auth::check() && Auth::user()->type == '1'){

			return view('web.employer.rule1');
		}else{
			return redirect('/');
		}
	}    

	function rule_2(){
		if(Auth::check() && Auth::user()->type == '1'){

			return view('web.employer.rule2');
		}else{
			return redirect('/');
		}
	} 

	function form_1(){
		if(Auth::check() && Auth::user()->type == '1'){
			
			$country = country::orderBy('country')->get();
			return view('web.employer.form1', ['country' => $country]);
		}else{
			return redirect('/');
		}
	} 
	function form_1Submit(Request $request){
		if(Auth::check() && Auth::user()->type == '1'){
			$data = $request->all();
			$u = User::find(Auth::id());
			$u->fname = $data['fname'];
			$u->lname = $data['lname'];
			$u->username = $data['username'];
			if ($request->hasFile('profileImage')) {
				$file = $request->file('profileImage');
	            $filename = Auth::id().'-'.date('dmyHis').'.'.$file->getClientOriginalExtension();
	            $file->move(base_path('/public/profile_img/'), $filename);

	            $u->profile_img = $filename;
	        }
			$u->save();

			userDetail::addDetail($data);

			return redirect('/employer/form_2');

		}else{
			return redirect('/');
		}
	}   

	function form_2(){
		if(Auth::check() && Auth::user()->type == '1'){
			$skills = skills::all();
			$qual = qual::all();
			return view('web.employer.form2', ['skills' => $skills, 'qual' => $qual]);
		}else{
			return redirect('/');
		}
	} 

	function form_2Submit(Request $request){
		if(Auth::check() && Auth::user()->type == '1'){
			$data = $request->all();
			
			empSkills::addSkill($data);
			empQual::addQualification($data);

			return redirect('/');

		}else{
			return redirect('/');
		}
	} 
}
