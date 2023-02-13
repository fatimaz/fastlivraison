<?php

namespace App\Models;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Tymon\JWTAuth\Contracts\JWTSubject;
use Illuminate\Notifications\Notifiable;

class User extends Authenticatable implements JWTSubject
{
    use Notifiable;
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable=['name','email','password','mobile','photo','rewards','passport','verified','activation_code','is_active','offers_sent','offers_received', 'avgstars','numRating','api_token'];
    public $timestamps = true;

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'is_active' => 'boolean',
        'email_verified_at' => 'datetime',
        'document_verified_at'=> 'datetime',
        'phone_verified_at' => 'datetime',
    ];

     public function scopeActive($query){
        return $query -> where('is_active',1) ;
    }

    public function getActive(){
        return  $this -> is_active  == 0 ?  'non active'   : 'active' ;
    }


    public function getPhotoAttribute($val)
    {
        return ($val !== null) ? asset('assets/images/users/' . $val) : "";

    }

    public function codes(){
        return $this -> hasMany('Users_Verification','user_id');
    }

    public function addresses(){
        return $this->hasMany(Address::class,'user_id');
    }


    public function getJWTIdentifier()
    {
        return $this->getKey();
    }

    public function getJWTCustomClaims()
    {
        return [];
    }

    public function tokens()
    {
        return $this->hasMany('App\Models\UserToken');
    }

    public function shipments()
    {
        return $this->hasMany(Shipment::class,'user_id');
    }

    public function trips()
    {
        return $this->hasMany(Trip::class,'user_id');
    }
  
    public function offers()
    {
        return $this->hasMany(Offer::class,'user_id');
    }

    public function messages()
    {
        return $this->hasMany(Message::class,'receiver_id');
    }
    public function messagesfrom()
    {
        return $this->hasMany(Message::class,'sender_id');
    }
}



