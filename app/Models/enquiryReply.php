<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class enquiryReply extends Model
{
    use HasFactory;

    protected $table = 'tbl_enquiry_reply_info';

    public static function addReply(array $data){
    	$r = new enquiryReply;
    	$r->enquiry_id = base64_decode($data['enq_id']);
    	$r->reply_text = $data['reply_text'];
    	$r->save();
    }
}
