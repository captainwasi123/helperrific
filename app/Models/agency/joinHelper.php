<?php

namespace App\Models\agency;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Auth;
use App\Models\User;

class joinHelper extends Model
{
    use HasFactory;

    protected $table = 'tbl_agency_helper_info';

    public static function addJoin($agency){
    	$j = new joinHelper;
    	$j->helper_id = Auth::id();
    	$j->agency_id = $agency;
    	$j->status = '1';
    	$j->save();
    }


    function agency(){
        return $this->belongsTo(User::class, 'agency_id', 'id');
    }

    function helper(){
        return $this->belongsTo(User::class, 'helper_id', 'id');
    }

}
