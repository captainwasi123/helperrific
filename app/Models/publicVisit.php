<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class publicVisit extends Model
{
    use HasFactory;
    protected $table = 'tbl_public_profile_view_count';
    public $timestamps = false;

    public static function addCount($id, $ip){
        $data = publicVisit::where('profile_id', $id)
                    ->where('ip_address', $ip)
                    ->where('date', '>=', date('Y-m-1'))
                    ->where('date', '<=', date('Y-m-31'))
                    ->count();
        if($data < 1){           
            $v = new publicVisit;
            $v->ip_address = $ip;
            $v->profile_id = $id;
            $v->date = date('Y-m-d');
            $v->save();
        }
    }
}
