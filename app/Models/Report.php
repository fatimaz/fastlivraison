<?php

namespace App\Models;

use Astrotomic\Translatable\Translatable;
use Illuminate\Database\Eloquent\Model;
use DB;

class Report extends Model
{
    protected $table = 'reports';
    protected $fillable =['user_id','order_id','sujet','message','is_active'];

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


    public function offer(){
        return $this->belongsTo(Offer::class,'order_id');
    }
    public function user(){
        return $this->belongsTo(User::class,'user_id');
    }
  

}

