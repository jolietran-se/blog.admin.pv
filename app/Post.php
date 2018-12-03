<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Post extends Model
{
   protected $table = 'posts';
    protected $fillable = ['title', 'content', 'is_published'];

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
}

