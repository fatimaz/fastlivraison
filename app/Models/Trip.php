<?php

namespace App\Models;

use Astrotomic\Translatable\Translatable;
use Illuminate\Database\Eloquent\Model;
use DB;
class Trip extends Model
{

    protected $fillable = ['name','reservation_number','transportation_type','from','to','category_id','user_id','travel_date','weight_total','weight_free','note','is_active'];

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

    public function user()
    {
        return $this->belongsTo(User::class,'user_id');
    }

       public function category()
    {
        return $this->belongsTo(Category::class,'category_id');
    }



    public function countries()
    {
        return $this->belongsToMany(Country::class, 'country_trips')->withPivot('state');
    }
    public function orders()
    {
        return $this->hasMany(Order::class,'user_id');
    }
  


}
