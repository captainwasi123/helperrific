<?php

namespace App\Models\orders;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Auth;
use App\Models\User;
use App\Models\reviewReport;

class reviews extends Model
{
    use HasFactory;

    protected $table = 'tbl_order_reviews_info';

    public static function addReview(array $data){
    	$r = new reviews;
    	$r->order_id 	= empty($data['order']) ? null : base64_decode($data['order']);
    	$r->seller_id 	= base64_decode($data['seller']);
    	$r->buyer_id	= Auth::id();
    	$r->rating 		= $data['rating'];
    	$r->description = $data['description'];
    	$r->save();
    }

    public function buyer(){
    	return $this->belongsTo(User::class, 'buyer_id');
    }
    public function seller(){
    	return $this->belongsTo(User::class, 'seller_id');
    }


    public function report(){
        return $this->belongsTo(reviewReport::class, 'id', 'review_id');
    }
}
