<?php

namespace App\Models\orders;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Auth;
use App\Models\User;

class conversation extends Model
{
    use HasFactory;

    protected $table = 'tbl_order_conversation';

    public static function addChat(array $data, $filename, $file_fullname){
    	$c = new conversation;
    	$c->order_id = base64_decode($data['msg_id']);
    	$c->user_id = Auth::id();
    	$c->message = $data['message'];
    	$c->file_attach = $filename;
        $c->file_name = $file_fullname;
    	$c->save();
    }

    public function users(){
    	return $this->belongsTo(User::class, 'user_id');
    }
}
