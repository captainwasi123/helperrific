<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Socialite;
use Auth;
use Exception;
use App\Models\User;

class googleController extends Controller
{
    public function redirectToGoogle()
    {
        return Socialite::driver('google')->redirect();
    }
      
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function handleGoogleCallback()
    {    
            $user = Socialite::driver('google')->user();
     
            $finduser = User::where('email', $user->email)->first();
     
            if($finduser){
     
                Auth::login($finduser);
    			
    			if(Auth::user()->type == '2' && count(Auth::user()->skills) == '0'){
	                return redirect('/helper/rule_1');
	            }else if(Auth::user()->type == '3' && empty(Auth::user()->details)){
	                return redirect('/agency/rule_1');
	            }else if(Auth::user()->type == '1' && empty(Auth::user()->details)){
	                return redirect('/employer/rule_1');
	            }else{
	                return redirect('/');
	            }
     
            }else{
                $newUser = User::create([
                    'fname' => $user->name,
                    'email' => $user->email,
                    'google_id'=> $user->id,
                    'status'	=> '1',
                    'source'	=> '2',
                    'password' => encrypt('123456dummy')
                ]);
    
                Auth::login($newUser);
     
                return redirect('/');
            }
    }
}
