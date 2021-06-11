<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\orders\reviews;

class reviewReport extends Model
{
    use HasFactory;
    protected $table = 'tbl_reivew_report_info';

    public static function addReport($id){
        $r = new reviewReport;
        $r->review_id = $id;
        $r->save();
    }

    public function review(){
        return $this->belongsTo(reviews::class, 'review_id');
    }
}
