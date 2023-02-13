<?php

namespace App\Models;

use Astrotomic\Translatable\Translatable;
use Illuminate\Database\Eloquent\Model;
use DB;

class Rating extends Model
{
    protected $table = 'ratings';
    protected $fillable =['sender_id','receiver_id','order_id','type','stars','review','rated','is_active'];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
    */
    protected $casts = [
        'is_active' => 'boolean',
    ];

    public function scopeActive($query){
        return $query -> where('is_active',1) ;
    }
    public function getActive(){
        return  $this -> is_active  == 0 ?  'non active'   : 'active' ;
    }
    public function getRate(){
        return  $this -> rated  == 0 ?  'No'   : 'Yes' ;
    }
    public function sender(){
        return $this->belongsTo(User::class,'sender_id');
    }
    public function receiver(){
        return $this->belongsTo(User::class,'receiver_id');
    }
    public function offer(){
        return $this->belongsTo(Offer::class,'order_id');
    }
}

