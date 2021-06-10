<?php

namespace App\Models;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

use App\Models\admin\role;

class admin extends Authenticatable
{
    use HasFactory, Notifiable;

    protected $table = 'tbl_admin_users_info';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name',
        'email',
        'password',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    
    public static function addUser(array $data){
        $a = new admin;
        $a->fullname = $data['fullname'];
        $a->phone = $data['phone'];
        $a->email = $data['email'];
        $a->role_id = $data['role_id'];
        $a->username = $data['username'];
        $a->password = bcrypt($data['password']);
        $a->status = '1';
        $a->save();
    }

    public static function updateUser(array $data){
        $a = admin::find(base64_decode($data['u_id']));
        $a->fullname = $data['fullname'];
        $a->phone = $data['phone'];
        $a->email = $data['email'];
        $a->role_id = $data['role_id'];
        $a->save();
    }


    public function role(){
        return $this->belongsTo(role::class, 'role_id', 'id');
    }
}
