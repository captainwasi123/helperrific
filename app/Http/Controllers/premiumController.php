<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\premium;
use App\Models\premiumDetail;
use App\Models\userPremium;
use Auth;

class premiumController extends Controller
{
    //
    function getPrice(){
        if(Auth::check() && (Auth::user()->type == '1' || Auth::user()->type == '3')){

            $data = premium::where('account_type', Auth::user()->type)->first();

            return view('web.response.premium', ['data' => $data]);
        }else{
            return 'Error';
        }

    }

    function subscribe(Request $request){
        if(Auth::check() && (Auth::user()->type == '1' || Auth::user()->type == '3')){
            $da = $request->all();
            $data = premiumDetail::find($da['account_type']);
            userPremium::subscribe($data);

            return 'success';
        }else{
            return 'Error';
        }
    }
}
