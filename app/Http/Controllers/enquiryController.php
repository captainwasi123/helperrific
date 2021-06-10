<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Auth;
use App\Models\enquiry;
use App\Models\enquiryReply;

class enquiryController extends Controller
{
    
    function index(){
    	if(Auth::guard('admin')->check()){
            $databelt = enquiry::orderBy('created_at', 'desc')
	                        ->simplePaginate(25);

    		return view('admin.enquiry.list', ['databelt' => $databelt]);
    	}else{
    		return redirect('/admin');
    	}
    }


    function pendingEnquiries(){
    	if(Auth::guard('admin')->check()){
            $databelt = enquiry::where('status', '1')
            				->orderBy('created_at', 'desc')
	                        ->simplePaginate(25);

    		return view('admin.enquiry.pending', ['databelt' => $databelt]);
    	}else{
    		return redirect('/admin');
    	}
    }

    function enquiryDetail($id){
    	if(Auth::guard('admin')->check()){
    		$id = base64_decode($id);
            $data = enquiry::find($id);

    		return view('admin.enquiry.detail', ['data' => $data]);
    	}else{
    		return redirect('/admin');
    	}
    }

    function insertReply(Request $request){
    	if(Auth::guard('admin')->check()){
    		$data = $request->all();
    		$e = enquiry::find(base64_decode($data['enq_id']));
    		$e->status = '2';
    		$e->save();
    		
    		enquiryReply::addReply($data);

    		return redirect()->back()->with('success', 'Reply Sent.');
    	}else{
    		return redirect('/admin');
    	}
    }
}
