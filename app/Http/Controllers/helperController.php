<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Auth;
use App\Models\User;
use App\Models\userDetail;
use App\Models\skills;
use App\Models\qual;
use App\Models\userSkills;
use App\Models\userLang;
use App\Models\userQual;
use App\Models\userEducation;
use App\Models\userExperience;
use App\Models\userExpertise;
use App\Models\userGallery;
use App\Models\availability;
use App\Models\orders\order;
use App\Models\helper\startSalary;
use App\Models\country;
use App\Models\currency;
use App\Models\agency\joinHelper;

class helperController extends Controller
{

	//Orders

	function Orders(){
		if(Auth::check() && Auth::user()->type == '2'){
			$orders = array();
			$orders['pending'] = order::where('seller_id', Auth::id())->where('status', '1')->get();
			$orders['confirmed'] = order::where('seller_id', Auth::id())->where('status', '2')->get();
			$orders['completed'] = order::where('seller_id', Auth::id())->where('status', '3')->get();
			$orders['rejected'] = order::where('seller_id', Auth::id())->where('status', '4')->get();

			return view('web.helper.orders', ['orders' => $orders]);
		}else{
			return redirect('/');
		}
	}

	//Profile

	function profile(){
		if(Auth::check() && Auth::user()->type == '2'){
        	$availability = availability::all();
			$join = joinHelper::where('helper_id', Auth::id())->where('status', '2')->count();
			return view('web.helper.profile', ['availability' => $availability,'check_a' => $join]);
		}else{
			return redirect('/');
		}
	}

	function galleryUpload(Request $request){
		if(Auth::check() && Auth::user()->type == '2'){
			if ($request->hasFile('galleryImage')) {
				$file = $request->file('galleryImage');
	            $filename = date('dmyHis').'.'.$file->getClientOriginalExtension();
	            $id = userGallery::addGallery($filename);
	            $filename = $id.'-'.$filename;
	            $file->move(base_path('/public/gallery_img/'), $filename);
	        }
	        return '';
		}else{
			return redirect('/');
		}
	}

	function changeAvailability($status){
		if(Auth::check() && Auth::user()->type == '2'){

			$u = User::find(Auth::id());
			$u->availibility_status = $status;
			$u->save();

			return 'done';
		}else{
			return redirect('/');
		}
	}

	function deleteImage($id){
		if(Auth::check() && Auth::user()->type == '2'){
			$id = base64_decode($id);

			userGallery::destroy($id);

			return redirect()->back();
		}else{
			return redirect('/');
		}
	}
	
	// Registration 

	function rule_1(){
		if(Auth::check() && Auth::user()->type == '2'){

			return view('web.helper.rule1');
		}else{
			return redirect('/');
		}
	}    

	function rule_2(){
		if(Auth::check() && Auth::user()->type == '2'){

			return view('web.helper.rule2');
		}else{
			return redirect('/');
		}
	} 

	function form_1(){
		if(Auth::check() && Auth::user()->type == '2'){
			$country = country::orderBy('country')->get();
			return view('web.helper.form1', ['country' => $country]);
		}else{
			return redirect('/');
		}
	} 
	function form_1Submit(Request $request){
		if(Auth::check() && Auth::user()->type == '2'){
			$data = $request->all();
			$u = User::find(Auth::id());
			$u->fname = $data['fname'];
			$u->lname = $data['lname'];
			$u->username = $data['username'];
			$u->save();

			userDetail::addDetail($data);
			userLang::addLang($data);
			return redirect('/helper/form_2');

		}else{
			return redirect('/');
		}
	}   

	function form_2(){
		if(Auth::check() && Auth::user()->type == '2'){
			$uExpertise = userExpertise::where('user_id', Auth::id())->get();
			$skills = skills::all();
			$expertise = skills::whereIn('id', ['1','3','15','13'])->get();
			$qual = qual::all();
			$currency = currency::all();
			$agencies = User::select('company')->where('type', '3')->get()->pluck('company');
			return view('web.helper.form2', ['skills' => $skills, 'expertise' => $expertise,'uExpertise' => $uExpertise, 'qual' => $qual, 'currency' => $currency, 'agencies' => json_encode($agencies, JSON_UNESCAPED_SLASHES )]);
		}else{
			return redirect('/');
		}
	} 

	function form_2Submit(Request $request){
		if(Auth::check() && Auth::user()->type == '2'){
			$data = $request->all();
			$salary_data = array(
				'price'			=>	$data['ss_price'],
				'renewal'		=>	$data['ss_renewal'],
				'currency'	=>	$data['ss_currency'],
			);
			userSkills::addSkill($data);
			userExpertise::addSkill($data);
			userQual::addQualification($data);
			userEducation::addEducation($data);
			userExperience::addExperience($data);
			startSalary::updateSalary($salary_data);

			return redirect('/');

		}else{
			return redirect('/');
		}
	}

}
