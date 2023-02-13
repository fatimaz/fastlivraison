<?php

namespace App\Models;

use Astrotomic\Translatable\Translatable;
use Illuminate\Database\Eloquent\Model;
use DB;

class Prescription extends Model
{
    protected $table = 'prescriptions';
    protected $fillable = ['about','user_id','is_active'];

     protected $casts = [
        'is_active' => 'boolean',
    ];

    public function scopeActive($query){
        return $query -> where('is_active',1) ;
    }

    public function getActive(){
        return  $this -> is_active  == 0 ?  'non active'   : 'active' ;
    }
    public function  getPhotoAttribute($val){
        return ($val !== null) ? asset('assets/images/products/' . $val) : "";
    }



    // public function orders()
    // {
    //   return $this->belongsToMany(Order::class, 'order_menu')->withPivot('qty');
    // }

    public  function images(){
     return $this->hasMany(Image::class,'prescription_id');
    }

    public function user(){
        return $this->belongsTo(User::class,'user_id');
    }



}
