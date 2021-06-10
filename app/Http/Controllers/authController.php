<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use App\Models\userFavorite;
use Auth;

class authController extends Controller
{
    
    function register(Request $request){
    	$data = $request->all();
    	if(empty($data['password'])){
	    	$user = User::where('email', $data['email'])->count();
	    	if($user != '0'){
	    		return 'exist';
	    	}else{
	    		return $data;
	    	}
	    }else{
	    	if($data['password'] != $data['confirmation_password']){
	    		return 'nomatch';
	    	}else{
	    		User::addUser($data);
	    		return 'success';
	    	}
	    }
    }

    function login(Request $request){
    	$data = $request->all();
    	if(Auth::attempt(['email' => $data['email'], 'password' => $data['password'], 'status' => '1'])){
            if(Auth::user()->type == '2' && count(Auth::user()->skills) == '0'){
                return '/helper/rule_1';
            }else if(Auth::user()->type == '3' && empty(Auth::user()->details)){
                return '/agency/rule_1';
            }else if(Auth::user()->type == '1' && empty(Auth::user()->details)){
                return '/employer/rule_1';
            }else{
                return '';
            }
    	}else{
    		return 'incorrect';
    	}
    }

    function profilePic(Request $request){
        if(Auth::check()){
            $file = $request->file('profileImage');
            $filename = Auth::id().'-'.date('dmyHis').'.'.$file->getClientOriginalExtension();
            $u = User::find(Auth::id());
            $u->profile_img = $filename;
            $u->save();
            $file->move(base_path('/public/profile_img/'), $filename);

            return redirect()->back();
        }else{
            return redirect('/');
        }
    }

    function coverPic(Request $request){
        if(Auth::check()){
            $file = $request->file('coverImage');
            $filename = Auth::id().'-'.date('dmyHis').'.'.$file->getClientOriginalExtension();
            $u = User::find(Auth::id());
            $u->cover_img = $filename;
            $u->save();
            $file->move(base_path('/public/cover_img/'), $filename);

            return redirect()->back();
        }else{
            return redirect('/');
        }
    }

    function logout(){
    	Auth::logout();

    	return redirect()->back();
    }


    function addFavorite($id){
        if(Auth::check()){
            $id = base64_decode($id);
            userFavorite::addFavor($id);

            return redirect()->back();
        }else{
            return redirect('/');
        }
    }
    function removeFavorite($id){
        if(Auth::check()){
            $id = base64_decode($id);
            userFavorite::where('favor_id', $id)->where('user_id', Auth::id())->delete();
            
            return redirect()->back();
        }else{
            return redirect('/');
        }
    }

    function savedProfile(){
        if(Auth::check()){
            $data = userFavorite::where('user_id', Auth::id())->get();
            
            return view('web.saved', ['databelt' => $data]);
        }else{
            return redirect('/');
        }
    }

    function userTypeSetup(Request $request){
        $data = $request->all();
        $u = User::find(Auth::id());
        $u->type = $data['usertype'];
        $u->save();

        if($u->type == '2' && count($u->skills) == '0'){
            return redirect('/helper/rule_1');
        }else if($u->type == '3' && empty($u->details)){
            return redirect('/agency/rule_1');
        }else if($u->type == '1' && empty($u->details)){
            return redirect('/employer/rule_1');
        }else{
            return '';
        }
    }

}
