<?php

namespace App\Models;

use Astrotomic\Translatable\Translatable;
use Illuminate\Database\Eloquent\Model;

class Reservation extends Model
{

    protected $fillable = ['trip_id','user_id','qty','last_price','code','stars','is_active','status'];


    protected $casts = [
        'is_active' => 'boolean',
    ];

    public function scopeActive($query){
        return $query -> where('is_active',1) ;
    }

    public function getActive(){
        return  $this -> is_active  == 0 ?  'non active'   : 'active' ;
    }


	


    public function user()
    {
        return $this->belongsTo(User::class,'user_id');
    }


    public function trip()
    {
        return $this->belongsTo(Trip::class,'trip_id');
    }




}