<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Auth;

class userPremium extends Model
{
    use HasFactory;

    protected $table = 'tbl_premium_account_info';

    public static function subscribe($data){
        $start_date = date('Y-m-d');
        $end_date = date('Y-m-d', strtotime("+".$data->duration." months", strtotime($start_date)));
        $p = new userPremium;
        $p->user_id = Auth::id();
        $p->type_id = $data->id;
        $p->duration = $data->duration;
        $p->start_date = $start_date;
        $p->end_date = $end_date;
        $p->status = '1';
        $p->save();

    }
}
