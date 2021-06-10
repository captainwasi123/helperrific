<?php

namespace App\Models\employer;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Auth;
use App\Models\skills;

class empSkills extends Model
{
    use HasFactory;

    protected $table = 'tbl_employer_skills_info';

    public static function addSkill(array $data){
    	foreach ($data['skills'] as $val) { 
    		$s = new empSkills;
    		$s->user_id = Auth::id();
    		$s->skill_id = $val;
    		$s->save();
    	}
    }

    function skills(){
    	return $this->belongsTo(skills::class, 'skill_id', 'id');
    }
}
