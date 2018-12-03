<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    protected $fillable = [
        'name', 'description', 'status','id'
    ];

    public static function getExcerpt($str, $startPos = 0, $maxLength = 50) {
        if(strlen($str) > $maxLength) {
            $excerpt   = substr($str, $startPos, $maxLength - 6);
            $lastSpace = strrpos($excerpt, ' ');
            $excerpt   = substr($excerpt, 0, $lastSpace);
            $excerpt  .= ' [...]';
        } else {
            $excerpt = $str;
        }

        return $excerpt;
    }

    public function product(){
    	return $this->hasMany('App\Product','category_id','id');
    }
    public function productFirst(){
        return $this->product()->take(2)->get();
    }
    public function productSecond(){
        return $this->product()->take(3)->get();
    }

    
}






