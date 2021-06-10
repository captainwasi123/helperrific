<?php

namespace App\Models\employer;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Auth;
use App\Models\qual;

class empQual extends Model
{
    use HasFactory;

    protected $table = 'tbl_employer_qualification_info';

    public static function addQualification(array $data){
    	$c = count($data['qual']);
    	for ($i=0; $i < $c; $i++) { 
    		$q = new empQual;
    		$q->user_id = Auth::id();
    		$q->qual_id = $data['qual'][$i];
    		$q->status = $data['qualstatus'][$i];
    		$q->save();
    	}
    }

    function qual(){
    	return $this->belongsTo(qual::class, 'qual_id', 'id');
    }
}
