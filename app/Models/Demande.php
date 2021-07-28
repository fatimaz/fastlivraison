<?php

namespace App\Models;

use Astrotomic\Translatable\Translatable;
use Illuminate\Database\Eloquent\Model;
use DB;
class Demande extends Model
{

    protected $fillable = ['name','email','phone','message'];


   
}
