<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\userDetail;

class country extends Model
{
    use HasFactory;

    protected $table = 'tbl_country_info';
    public $timestamps = false;


    public function users(){
        return $this->hasMany(userDetail::class, 'country', 'id');
    }

    public function helperUsers(){
        return $this->hasMany(userDetail::class, 'country', 'id')
                    ->whereHas('user', function($q){
                        $q->where('type', '2');
                    });
    }

    public function agencyUsers(){
        return $this->hasMany(userDetail::class, 'country', 'id')
                    ->whereHas('user', function($q){
                        $q->where('type', '3');
                    });
    }
    
}
