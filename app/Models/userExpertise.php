<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Auth;
use App\Models\skills;

class userExpertise extends Model
{
    use HasFactory;
    protected $table = 'tbl_user_expertise_info';

    public static function addSkill(array $data){
        if(!empty($data['expertise'])){
            userExpertise::where('user_id', Auth::id())->delete();
            $c = count($data['expertise']);
            for ($i=0; $i < $c; $i++) { 
                $s = new userExpertise;
                $s->user_id = Auth::id();
                $s->skill_id = $data['expertise'][$i];
                $s->experience = $data['expertise_exp'][$i];
                $s->details = $data['expertise_detail'][$i];
                $s->save();
            }
        }
    }

    function skills(){
        return $this->belongsTo(skills::class, 'skill_id', 'id');
    }
}
