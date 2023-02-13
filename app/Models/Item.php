<?php

namespace App\Models;

use Astrotomic\Translatable\Translatable;
use Illuminate\Database\Eloquent\Model;
use DB;

class Item extends Model
{
    protected $table = 'items';
    protected $fillable = ['name','category_id','restaurant_id','description','price','vat','photo','is_active'];

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

    public function category()
    {
        return $this->belongsTo(Category::class,'category_id');
    }
    
    public function restaurant(){
        return $this->hasOne(Item::class,'restaurant_id');
    }

    public function orders()
    {
      return $this->belongsToMany(Order::class, 'order_menu')->withPivot('qty');
    }

    public  function attributes(){
     return $this->hasMany(Attribute::class,'item_id');
    }

    public function cartitem(){
        return $this->hasMany(CartItem::class,'item_id');
    }

}
