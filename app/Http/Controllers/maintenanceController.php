<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;




class maintenanceController extends Controller
{
    
    function index(){
    	
		return view('web.maintenance.index');
    }

}
