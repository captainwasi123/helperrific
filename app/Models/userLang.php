<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Auth;

class userLang extends Model
{
    use HasFactory;

    protected $table = 'tbl_users_lang_info';

    public $timestamps = false;

    public static function addLang(array $data){
    	userLang::where('user_id', Auth::id())->delete();
        if(!empty($data['lang'])){
        	$c = count($data['lang']);
        	for ($i=0; $i < $c; $i++) { 
        		$l = new userLang;
        		$l->user_id = Auth::id();
        		$l->language = $data['lang'][$i];
        		$l->level = $data['langlevel'][$i];
        		$l->save();
        	}
        }
    }
}
