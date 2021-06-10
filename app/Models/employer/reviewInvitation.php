<?php

namespace App\Models\employer;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Auth;
use App\Models\User;

class reviewInvitation extends Model
{
    use HasFactory;
    protected $table = 'tbl_review_invitation_info';

    public static function addRequest($id){
        $r = new reviewInvitation;
        $r->request_by = Auth::id();
        $r->request_to = base64_decode($id);
        $r->save();
    }


    public function requestTo(){
        return $this->belongsTo(User::class, 'request_to');
    }

    public function requestBy(){
        return $this->belongsTo(User::class, 'request_by');
    }
}
