<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Auth;
use App\Models\User;

class siteUserController extends Controller
{

    function employers(){
    	if(Auth::guard('admin')->check()){

    		$databelt = User::with(['skills'])->where('type', '1')->where('status', '!=', '3')->orderBy('created_at', 'desc')->get();

    		return view('admin.siteUsers.employers.list', ['databelt' => $databelt]);
    	}else{
    		return redirect('admin\login');
    	}
    }

    function helpers(){
    	if(Auth::guard('admin')->check()){

    		$databelt = User::where('type', '2')->where('status', '!=', '3')->orderBy('created_at', 'desc')->get();

    		return view('admin.siteUsers.helpers.list', ['databelt' => $databelt]);
    	}else{
    		return redirect('admin\login');
    	}
    }

    function agencies(){
    	if(Auth::guard('admin')->check()){

    		$databelt = User::where('type', '3')->where('status', '!=', '3')->orderBy('created_at', 'desc')->get();

    		return view('admin.siteUsers.agencies.list', ['databelt' => $databelt]);
    	}else{
    		return redirect('admin\login');
    	}
    }


    function suspendUser($id){
        if(Auth::guard('admin')->check()){
            $id = base64_decode($id);

            $a = User::find($id);
            $a->status = '2';
            $a->save();

            return redirect()->back()->with('success', 'User Suspended.');

        }else{
            return redirect('admin\login');
        }
    }
    function activeUser($id){
        if(Auth::guard('admin')->check()){
            $id = base64_decode($id);

            $a = User::find($id);
            $a->status = '1';
            $a->save();

            return redirect()->back()->with('success', 'User Activated.');

        }else{
            return redirect('admin\login');
        }
    }function terminateUser($id){
        if(Auth::guard('admin')->check()){
            $id = base64_decode($id);

            $a = User::find($id);
            $a->status = '3';
            $a->save();

            return redirect()->back()->with('success', 'User Terminated.');

        }else{
            return redirect('admin\login');
        }
    }
}
