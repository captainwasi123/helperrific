<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\premiumDetail;

class premium extends Model
{
    use HasFactory;

    protected $table = 'tbl_premium_account_type';

    public function detail(){
        return $this->hasMany(premiumDetail::class, 'premium_id', 'id');
    }
}
