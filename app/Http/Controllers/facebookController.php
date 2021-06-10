<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use Socialite;
use Exception;
use Auth;

class facebookController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function redirectToFacebook()
    {
        return Socialite::driver('facebook')->redirect();
    }


    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function handleFacebookCallback()
    {

        $user = Socialite::driver('facebook')->user();
        $email = $user->getEmail();
		
		$finduser = User::where('email', $email)->first();
 
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
                'facebook_id'=> $user->id,
                'status'	=> '1',
                'source'	=> '3',
                'password' => encrypt('123456dummy')
            ]);

            Auth::login($newUser);
 
            return redirect('/');
        }

    }
}
