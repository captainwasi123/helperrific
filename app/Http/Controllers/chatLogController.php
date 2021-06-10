<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Auth;
use App\Models\User;
use App\Models\inbox\chat;

class chatLogController extends Controller
{

    function index(){
    	if(Auth::guard('admin')->check()){
            $databelt = chat::groupBy("sender_id", "receiver_id")
	                        ->orderBy('created_at', 'desc')
	                        ->simplePaginate(25);

    		return view('admin.chatLog.log', ['databelt' => $databelt]);
    	}else{
    		return redirect('/admin');
    	}
    }

    function logDetails($sender, $receiver){
    	if(Auth::guard('admin')->check()){
    		$sender = base64_decode($sender);
    		$receiver = base64_decode($receiver);
            $data = chat::Where(function($query) use ($sender, $receiver)
                          {
                              $query->where("sender_id",$sender)
                                    ->where("receiver_id",$receiver);
                          })
                          ->orWhere(function($query) use ($sender, $receiver)
                          {
                              $query->Where("sender_id",$receiver)
                                    ->Where("receiver_id",$sender);
                          })
                          ->get();
            $senderData = User::find($sender);
            $receiverData = User::find($receiver);
    		return view('admin.chatLog.logDetail', ['databelt' => $data, 'sender' => $senderData, 'receiver' => $receiverData]);
    	}else{
    		return redirect('/admin');
    	}
    }

    function filterLog(){
    	if(Auth::guard('admin')->check()){


    		return view('admin.chatLog.filter');
    	}else{
    		return redirect('/admin');
    	}
    }

    function filterLogSubmit(Request $request){
    	if(Auth::guard('admin')->check()){
    		$data = $request->all();

    		$databelt = chat::when(!empty($data['date_from']), function ($q) use ($data) {
                            return $q->where('created_at', '>=', date('Y-m-d H:i:s', strtotime($data['date_from'].' 00:00:01')));
                        })
    					->when(!empty($data['date_to']), function ($q) use ($data) {
                            return $q->where('created_at', '<=', date('Y-m-d H:i:s', strtotime($data['date_to'].' 23:59:59')));
                        })->when(!empty($data['keyword']), function ($q) use ($data) {
                            return $q->where('message', 'like', '%' . $data['keyword'] . '%');
                        })
                        ->get();

    		return view('admin.chatLog.filter', ['databelt' => $databelt, 'searchData' => $data]);
    	}else{
    		return redirect('/admin');
    	}
    }
}
