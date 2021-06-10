<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Auth;
use URL;
use App\Models\User;
use App\Models\inbox\chat;
use App\Events\sendChat;
use Pusher\Pusher;

class chatController extends Controller
{
    
    function index(){
    	if(Auth::check()){
    		$sender = Auth::id();
            $data_list = chat::where("sender_id",$sender)
            				->orWhere("receiver_id",$sender)
							->distinct("sender_id", "receiver_id")
	                        ->orderBy('created_at', 'desc')
	                        ->get();
    		return view('web.chat.messenger', ['chat_list' => $data_list]);
    	}else{
    		return redirect('/');
    	}
    }

    function inboxChat($id, $name){
    	if(Auth::check()){
    		$id = base64_decode($id);
    		$sender = Auth::id();
    		$receiver = $id;
    		$user = User::find($id);
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
            $data_list = chat::where("sender_id",$sender)
            				->orWhere("receiver_id",$sender)
							->distinct("sender_id", "receiver_id")
	                        ->orderBy('created_at', 'desc')
	                        ->get();

    		return view('web.chat.chat', ['user' => $user, 'chat' =>$data, 'chat_list' => $data_list]);
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
                $file->move(base_path('/public/file_attached/'), $filename);

                $attach_block = '<div class="chatAttach">
                                       <span>'.$file_fullname.'</span>
                                       <a href="'.URL::to('/public/file_attached/'.$filename).'" download="'.$file_fullname.'"><i class="fa fa-download"></i></a>
                                    </div>';
            }
    		$timestamp = chat::addChat($data, $filename, $file_fullname);
    		$name = Auth::user()->type == '3' ? Auth::user()->company : Auth::user()->fname.' '.Auth::user()->lname;



            $pusher = new Pusher(
                        env('PUSHER_APP_KEY'), 
                        env('PUSHER_APP_SECRET'), 
                        env('PUSHER_APP_ID'), 
                        array(
                            'cluster' => env('PUSHER_APP_CLUSTER')
                        )
                    );
            $img = empty(Auth::user()->profile_img) ? 'none' : Auth::user()->profile_img;
            $pusher->trigger('send-chatChannel.'.base64_decode($data['msg_id']).'.'.Auth::id(), 'sendChat', 
                        array(
                            'message'   => $data['message'], 
                            'image'     => $img,
                            'name'      => $name,
                            'timestamp' => $timestamp->diffForHumans()
                        )
                    );
            $pusher->trigger('noti-chatChannel.'.base64_decode($data['msg_id']), 'notiChat', 'received');

    		return '<div class="sender-message2">
                        <img alt="user-profile-avatar" src="'.URL::to('/').'/public/profile_img/'.Auth::user()->profile_img.'" onerror="this.onerror=null;this.src='.URL::to('/').'/public/user-placeholder.jpg;"/>
                        <h5> '.$name.' <span class="col-grey"> '.$timestamp->diffForHumans().' </span> </h5>
                        '.$attach_block.'
                        <p> '.$data['message'].' </p>
                    </div>';

    	}else{
    		return 'error';
    	}
    }
}
