<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Auth;

class userEducation extends Model
{
    use HasFactory;

    protected $table = 'tbl_users_education_info';

    public static function addEducation(array $data){
        if(!empty($data['edu_certificate'])){
            userEducation::where('user_id', Auth::id())->delete();
        	$c = count($data['edu_certificate']);
        	for ($i=0; $i < $c; $i++) { 
        		$e = new userEducation;
        		$e->user_id = Auth::id();
        		$e->certificate = $data['edu_certificate'][$i];
        		$e->country = $data['edu_country'][$i];
        		$e->save();
        	}
        }
    }
}
