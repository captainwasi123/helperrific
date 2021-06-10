<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Auth;
use App\Models\orders\order;
use App\Models\orders\oStatus;
use App\Models\orders\conversation;
use App\Models\orders\reviews;

class orderController extends Controller
{
    function orderBook(Request $request){
    	if(Auth::check()){
    		$data = $request->all();
    		$id = order::addOrder($data);

    		return $id;
    	}else{
    		return redirect('/');
    	}
    }

    function orderDetail($id){
    	if(Auth::check()){
    		$id = base64_decode($id);
    		$data = order::where('id', $id)->first();
    		$status = oStatus::all();

    		if(empty($data['id'])){
    			return redirect('/');	
    		}else{
    			return view('web.order.detail', ['data' => $data, 'status' => $status]);
    		}
    	}else{
    		return redirect('/');
    	}
    }

    function orderStatus($id, $status){
    	if(Auth::check()){
    		$id = base64_decode($id);
    		$o = order::find($id);
    		$o->status = $status;
    		$o->save();

    	}else{
    		return redirect('/');
    	}
    }

    function sendMessage(Request $request){
    	if(Auth::check()){
    		$data = $request->all();
    		$filename = null;
            $file_fullname = null;
            $attach_block = null;
            if($request->hasFile('attachment')){
                $file = $request->file('attachment');
                $filename = Auth::id().date('dmyHis').'.'.$file->getClientOriginalExtension();
                $file_fullname = $file->getClientOriginalName();
                $file->move(base_path('/public/order_file/'), $filename);

            }
    		$timestamp = conversation::addChat($data, $filename, $file_fullname);
    		
    		return redirect()->back();

    	}else{
    		return redirect('/');
    	}
    }

    function orderReview($id){
    	if(Auth::check()){
    		$id = base64_decode($id);

    		$data = order::where('buyer_id', $id)->where('review', null)->where('status', '3')->first();
    		if(!empty($data->id)){
	    		$da = array(
	    			'name' => $data->seller->type == '3' ? $data->seller->company : $data->seller->fname.' '.$data->seller->lname,
	    			'order_id' => base64_encode($data->id),
	    			'seller_id'	=> base64_encode($data->seller_id)
	    		);

	    		return $da;
	    	}else{
	    		return 'nothing';
	    	}


    	}else{
    		return redirect('/');
    	}
    }

    function reviewSubmit(Request $request){
    	if(Auth::check()){
    		$data = $request->all();
            if(empty($data['order'])){
                reviews::addReview($data);
            }else{
        		$check = reviews::where('order_id', base64_decode($data['order']))->first();
        		if(empty($check->id)){
    	    		reviews::addReview($data);
    	    		$o = order::find(base64_decode($data['order']));
    	    		$o->review = '1';
    	    		$o->save();
    	    	}
            }

    		return redirect()->back();

    	}else{
    		return redirect('/');
    	}
    }

}
