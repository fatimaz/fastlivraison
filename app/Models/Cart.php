<?php

namespace App\Models;

use Astrotomic\Translatable\Translatable;
use Illuminate\Database\Eloquent\Model;
use DB;

class Cart extends Model
{

    protected $fillable = ['user_id', 'price'];

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

    public function products()
    {
        return $this->belongsToMany(Product::class, 'cart_product');
    }
    public function cartproduct(){
        return $this->hasMany(CartProduct::class,'cart_id');
    }

}
