<?php

namespace App\Models\helper;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Auth;
use App\Models\currency;

class startSalary extends Model
{
    use HasFactory;

    protected $table = 'tbl_user_starting_price';
    public $timestamps = false;

    public static function updateSalary(array $data){
    	$ch = empty(Auth::user()->startingSalary) ? 'no' : Auth::user()->startingSalary->id;
    	if($ch == 'no'){
    		$ss = new startSalary;
    		$ss->user_id = Auth::id();
    		$ss->price = $data['price'];
    		$ss->currency = $data['currency'];
    		$ss->renewal = $data['renewal'];
    		$ss->save();
    	}else{
    		$ss = startSalary::find($ch);
    		$ss->user_id = Auth::id();
    		$ss->price = $data['price'];
    		$ss->currency = $data['currency'];
    		$ss->renewal = $data['renewal'];
    		$ss->save();
    	}
    }


    public function curr(){
        return $this->belongsTo(currency::class, 'currency');
    }
}
