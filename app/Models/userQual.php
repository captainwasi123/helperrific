<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Auth;
use App\Models\qual;

class userQual extends Model
{
    use HasFactory;

    protected $table = 'tbl_users_qualification_info';

    public static function addQualification(array $data){
        if(!empty($data['qual'])){
            userQual::where('user_id', Auth::id())->delete();
        	$c = count($data['qual']);
        	for ($i=0; $i < $c; $i++) { 
        		$q = new userQual;
        		$q->user_id = Auth::id();
        		$q->qual_id = $data['qual'][$i];
        		$q->certificate = $data['qual_certificate'][$i];
        		$q->save();
        	}
        }
    }

    function qual(){
    	return $this->belongsTo(qual::class, 'qual_id', 'id');
    }
}
