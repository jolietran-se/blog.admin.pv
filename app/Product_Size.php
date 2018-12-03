<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Product_Size extends Model
{
     protected $fillable = [
        'size_id', 'product_id','quantity'
    ];
}
