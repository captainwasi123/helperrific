<?php

namespace App\Models;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use App\Models\userDetail;
use App\Models\userLang;
use App\Models\userSkills;
use App\Models\userQual;
use App\Models\userEducation;
use App\Models\userExperience;
use App\Models\userExpertise;
use App\Models\userGallery;
use App\Models\userFavorite;
use App\Models\availability;
use App\Models\userPremium;
use App\Models\agency\joinHelper;
use App\Models\helper\startSalary;
use App\Models\orders\reviews;
use App\Models\employer\viewCount;
use App\Models\employer\reviewInvitation;

class User extends Authenticatable
{
    use HasFactory, Notifiable;

    protected $table = 'tbl_users_info';

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

    public static function adduser(array $data){
        $u = new User;
        $u->email = $data['email'];
        $u->password = bcrypt($data['password']);
        $u->source = '1';
        $u->status = '1';
        $u->availibility_status = '1';
        $u->type   = $data['user_type'];
        $u->save();
    }


    //Employer 
    function reviewInvitation(){
        return $this->hasMany(reviewInvitation::class, 'request_to', 'id')->orderBy('id', 'desc');
    }


    //Helper
    function startingSalary(){
        return $this->belongsTo(startSalary::class, 'id', 'user_id');
    }

    //Agency
    function curr_helpers(){
        return $this->hasMany(joinHelper::class, 'agency_id', 'id')->where('status', '2');
    }


    function premium(){
        return $this->belongsTo(userPremium::class, 'id', 'user_id')->where('status', '1');
    }

    function viewCount(){
        return $this->hasMany(viewCount::class, 'user_id', 'id')
                        ->where('date', '>=', date('Y-m-1'))
                        ->where('date', '<=', date('Y-m-31'));
    }
    function details(){
        return $this->belongsTo(userDetail::class, 'id', 'user_id');
    }
    function availability(){
        return $this->belongsTo(availability::class, 'availability_status', 'id');
    }

    function agency(){
        return $this->belongsTo(joinHelper::class, 'id', 'helper_id');
    }

    function favorite(){
        return $this->hasMany(userFavorite::class, 'user_id', 'id');
    }

    function langs(){
        return $this->hasMany(userLang::class, 'user_id', 'id');
    }

    function skills(){
        return $this->hasMany(userSkills::class, 'user_id', 'id');
    }

    function qualification(){
        return $this->hasMany(userQual::class, 'user_id', 'id');
    }

    function education(){
        return $this->hasMany(userEducation::class, 'user_id', 'id');
    }

    function experience(){
        return $this->hasMany(userExperience::class, 'user_id', 'id');
    }
    function expertise(){
        return $this->hasMany(userExpertise::class, 'user_id', 'id');
    }

    function gallery(){
        return $this->hasMany(userGallery::class, 'user_id', 'id');
    }

    function reviews(){
        return $this->hasMany(reviews::class, 'seller_id', 'id')->where('status', '1');
    }
    public function avgRating()
    {
        return $this->reviews()
          ->selectRaw('avg(rating) as aggregate');
    }


    function ereviews(){
        return $this->hasMany(reviews::class, 'buyer_id', 'id')->where('status', '1');
    }
}
