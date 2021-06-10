<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Auth;

class userExperience extends Model
{
    use HasFactory;

    protected $table = 'tbl_users_experience_info';

    public static function addExperience(array $data){
        if(!empty($data['exp_employer'])){
            userExperience::where('user_id', Auth::id())->delete();
        	$c = count($data['exp_employer']);
        	for ($i=0; $i < $c; $i++) { 
        		$e = new userExperience;
        		$e->user_id = Auth::id();
        		$e->employer = $data['exp_employer'][$i];
        		$e->start_year = $data['exp_startYear'][$i];
        		$e->end_year = $data['exp_endYear'][$i];
        		$e->agency = $data['exp_agency'][$i];
        		$e->save();
        	}
        }
    }
}
