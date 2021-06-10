<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Auth;

class userGallery extends Model
{
    use HasFactory;

    protected $table = 'tbl_users_gallery_info';

    public $timestamps = false;

    public static function addGallery($filename){
    	$g = new userGallery;
    	$g->user_id = Auth::id();
    	$g->image = $filename;
    	$g->save();

    	return $g->id;
    }
}
