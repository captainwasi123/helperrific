<?php

namespace App\Models\inbox;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Auth;
use App\Models\User;

class chat extends Model
{
    use HasFactory;

    protected $table = 'tbl_chat_messages_info';

    public static function addChat(array $data, $filename, $file_fullname){
    	$c = new chat;
    	$c->sender_id = Auth::id();
    	$c->receiver_id = base64_decode($data['msg_id']);
    	$c->message = $data['message'];
    	$c->file_attach = $filename;
        $c->file_name = $file_fullname;
    	$c->status = '1';
    	$c->save();

    	return $c->created_at;
    }

    function sender(){
        return $this->belongsTo(User::class, 'sender_id', 'id');
    }
    function receiver(){
        return $this->belongsTo(User::class, 'receiver_id', 'id');
    }
}
