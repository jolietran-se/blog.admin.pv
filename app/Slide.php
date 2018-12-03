<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Slide extends Model
{
     protected $fillable = [
        'link','name','caption1','caption2','caption3' 
    ];
}
