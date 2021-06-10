<?php

namespace App\Models\orders;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Auth;
use App\Models\orders\oStatus;
use App\Models\orders\conversation;
use App\Models\User;

class order extends Model
{
    use HasFactory;

    protected $table = 'tbl_orders_info';

    public static function addOrder(array $data){
    	$o = new order;
    	$o->buyer_id = Auth::id();
    	$o->seller_id = base64_decode($data['seller']);
    	$o->description = $data['description'];
    	$o->status = '1';
    	$o->save();

    	return $o->id;
    }


    public function conversation(){
    	return $this->hasMany(conversation::class, 'order_id', 'id');
    }
    public function orderStatus(){
    	return $this->belongsTo(oStatus::class, 'status');
    }
    public function seller(){
    	return $this->belongsTo(User::class, 'seller_id');
    }
    public function buyer(){
    	return $this->belongsTo(User::class, 'buyer_id');
    }
}
