<?php

namespace App\Models;

use Astrotomic\Translatable\Translatable;
use Illuminate\Database\Eloquent\Model;
use DB;

class Shipment extends Model
{

    public $table = 'shipments';
    protected $fillable = ['from','to','expected_date','link','name', 'photo', 'price' ,'weight' , 'qty' ,'description' , 'category_id' , 'user_id' ,'is_active'];

             
  public $timestamps = true;
   protected $casts = [
        'is_active' => 'boolean',
    ];
    public function scopeActive($query){
        return $query -> where('is_active',1) ;
    }

    public function getActive(){
        return  $this -> is_active  == 0 ?  'non active'   : 'active' ;
    }

      public function countries()
    {
        return $this->belongsToMany(Country::class, 'country_shipments')->withPivot('state');
    }
    public function user()
    {
        return $this->belongsTo(User::class,'user_id');
    }

       public function category()
    {
        return $this->belongsTo(Category::class,'category_id');
    }

    public function  getPhotoAttribute($val){
        return ($val !== null) ? asset('assets/images/drivers/' . $val) : "";
    }

    public function orders()
    {
        return $this->hasMany(Order::class,'user_id');
    }

}
