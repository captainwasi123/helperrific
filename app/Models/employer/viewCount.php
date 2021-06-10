<?php

namespace App\Models\employer;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Auth;

class viewCount extends Model
{
    use HasFactory;
    protected $table = 'tbl_profile_view_count';
    public $timestamps = false;

    public static function addCount($id){
        $data = viewCount::where('profile_id', $id)
                    ->where('date', '>=', date('Y-m-1'))
                    ->where('date', '<=', date('Y-m-31'))
                    ->count();
        if($data < 1){           
            $v = new viewCount;
            $v->user_id = Auth::id();
            $v->profile_id = $id;
            $v->date = date('Y-m-d');
            $v->save();
        }
    }
}
