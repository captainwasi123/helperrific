<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Auth;
use App\Models\skills;

class userSkills extends Model
{
    use HasFactory;

    protected $table = 'tbl_users_skills_info';

    public static function addSkill(array $data){
        if(!empty($data['skills'])){
            userSkills::where('user_id', Auth::id())->delete();
        	$c = count($data['skills']);
        	for ($i=0; $i < $c; $i++) { 
        		$s = new userSkills;
        		$s->user_id = Auth::id();
        		$s->skill_id = $data['skills'][$i];
        		$s->experience = $data['skills_exp'][$i];
        		$s->details = $data['skills_detail'][$i];
        		$s->save();
        	}
        }
    }

    function skills(){
    	return $this->belongsTo(skills::class, 'skill_id', 'id');
    }
}
