<?php

namespace App\Models;

use Astrotomic\Translatable\Translatable;
use Illuminate\Database\Eloquent\Model;
use DB;

class Product extends Model
{

    protected $fillable = ['name','weight','photo','price','qty','details','category_id'];

     protected $casts = [
        'is_active' => 'boolean',
    ];

    public function scopeActive($query){
        return $query -> where('is_active',1) ;
    }

    public function getActive(){
        return  $this -> is_active  == 0 ?  'non active'   : 'active' ;
    }

    public function getPhotoAttribute($val)
    {
        return ($val !== null) ? asset('assets/images/products/' . $val) : "";

    }

    public function cartproduct(){
        return $this->hasMany(CartProduct::class,'product_id');
    }

}
