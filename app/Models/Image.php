<?php

namespace App\Models;

use Astrotomic\Translatable\Translatable;
use Illuminate\Database\Eloquent\Model;

class Image extends Model
{

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = ['name','prescription_id'];
    
    public function getActive(){
        return  $this -> is_active  == 0 ?  'non active'   : 'active' ;
    }

    public function prescription()
    {
        return $this->belongsTo(Prescription::class,'prescription_id');
    }


}