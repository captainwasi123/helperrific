<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Auth;
use App\Models\userLang;
use App\Models\country;

class userDetail extends Model
{
    use HasFactory;

    protected $table = 'tbl_users_detail_info';

    public static function addDetail(array $data){
    	if($data['input_type'] == '0'){
	    	$d = new userDetail;
	    }else{
	    	$d = userDetail::find($data['input_type']);
	    }
    	$d->user_id = Auth::id();
    	$d->description = empty($data['description']) ? null : $data['description'];
    	$d->country = empty($data['country']) ? null : $data['country'];
        $d->c_address = empty($data['c_address']) ? null : $data['c_address'];
        $d->c_email = empty($data['c_email']) ? null : $data['c_email'];
        $d->c_phone = empty($data['c_phone']) ? null : $data['c_phone'];
        $d->e_looking_status = empty($data['looking_status']) ? null : $data['looking_status'];
    	$d->save();

    }


    public function user(){
        return $this->belongsTo(User::class, 'user_id');
    }

    public function count(){
        return $this->belongsTo(country::class, 'country');
    }

}
