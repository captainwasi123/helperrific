<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

use App\Models\enquiryReply;

class enquiry extends Model
{
    use HasFactory;

    protected $table = 'tbl_enquiry_info';

    public static function addEnquiry(array $data){
    	$e = new enquiry;
    	$e->is_user 	= $data['is_user'];
    	$e->fullname 	= $data['fullname'];
    	$e->email 		= $data['email'];
    	$e->category	= $data['category'];
    	$e->description = $data['description'];
    	$e->status 		= '1';
    	$e->save();

    	return $e->id;
    }


    function replys(){
        return $this->hasMany(enquiryReply::class, 'enquiry_id', 'id');
    }
}
