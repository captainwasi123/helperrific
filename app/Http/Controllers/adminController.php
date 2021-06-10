<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Auth;
use App\Models\admin;
use App\Models\admin\role;

class adminController extends Controller
{
    function index(){
    	if(Auth::guard('admin')->check()){
    		return view('admin.index');
    	}else{
    		return redirect('admin\login');
    	}
    }

    function login(){

    	return view('admin.login');
    }

    function loginAttempt(Request $request){
    	$data = $request->all();
    	if(Auth::guard('admin')->attempt(['username' => $data['username'], 'password' => $data['password'], 'status' => '1'])){

    		return redirect('admin');
    	}else{
    		return redirect()->back()->with('error', 'Authentication Failed.');
    	}
    }

    function logout(){
    	if(Auth::guard('admin')->check()){
    		Auth::guard('admin')->logout();
    		
    		return redirect('admin');
    	}else{
    		return redirect('admin\login');
    	}
    }


    function users(){
        if(Auth::guard('admin')->check()){
            
            $databelt = admin::where('status', '!=', '3')->get();

            return view('admin.users.list', ['databelt' => $databelt]);
        }else{
            return redirect('admin\login');
        }
    }

    function addUsers(){
        if(Auth::guard('admin')->check()){
            
            $roles = role::all();

            return view('admin.users.add', ['roles' => $roles]);
        }else{
            return redirect('admin\login');
        }
    }

    function insertUsers(Request $request){
        if(Auth::guard('admin')->check()){
            $validated = $request->validate([
                'username' => 'required|unique:tbl_admin_users_info|max:16',
                'password' => 'required|confirmed|min:6',
            ]);
            $data = $request->all();

            admin::addUser($data);

            return redirect()->back()->with('success', 'User Registered.');

        }else{
            return redirect('admin\login');
        }
    }
    function updateUsers(Request $request){
        if(Auth::guard('admin')->check()){

            $data = $request->all();

            admin::updateUser($data);

            return redirect()->back()->with('success', 'User Updated.');

        }else{
            return redirect('admin\login');
        }
    }

    function editUsers($id){
        if(Auth::guard('admin')->check()){
            $id = base64_decode($id);
            $data = admin::find($id);

            $roles = role::all();

            return view('admin.users.edit', ['roles' => $roles, 'data' => $data]);
        }else{
            return redirect('admin\login');
        }
    }
    function inActiveUsers($id){
        if(Auth::guard('admin')->check()){
            $id = base64_decode($id);

            $a = admin::find($id);
            $a->status = '2';
            $a->save();

            return redirect()->back()->with('success', 'User In-Aactivated.');

        }else{
            return redirect('admin\login');
        }
    }
    function activeUsers($id){
        if(Auth::guard('admin')->check()){
            $id = base64_decode($id);

            $a = admin::find($id);
            $a->status = '1';
            $a->save();

            return redirect()->back()->with('success', 'User Aactivated.');

        }else{
            return redirect('admin\login');
        }
    }

    function deleteUsers($id){
        if(Auth::guard('admin')->check()){
            $id = base64_decode($id);

            $a = admin::find($id);
            $a->status = '3';
            $a->save();

            return redirect()->back()->with('success', 'User Deleted.');

        }else{
            return redirect('admin\login');
        }
    }

}
