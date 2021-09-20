<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\reviewReport;
use App\Models\orders\reviews;
use Auth;
use App\Models\web_setting;

class websiteSettingControlle extends Controller
{
    //
    function index(){
        if(Auth::guard('admin')->check()){

            $data = web_setting::first();

            return view('admin.websiteSetting.index', ['web_setting' => $data]);
        }else{
            return redirect('admin\login');
        }
    }

    public function udapte($id)
    {
    	$web = web_setting::find(1);
    	$web->is_live = $id;
    	$web->save();

    	return 'Website setting is Update';
    }
}
