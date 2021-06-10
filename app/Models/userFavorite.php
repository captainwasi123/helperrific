<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Auth;
use App\Models\User;

class userFavorite extends Model
{
    use HasFactory;

    protected $table = 'tbl_users_favorite_info';

    public static function addFavor($id){
    	$f = new userFavorite;
    	$f->user_id = Auth::id();
    	$f->favor_id = $id;
    	$f->save();

    }

    function user(){
    	return $this->belongsTo(User::class, 'favor_id', 'id');
    }
}
