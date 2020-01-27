<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    public function getArticleCount(){
      return $this->hasMany('App\Models\Article', 'category_id', 'id')->whereStatus(1)->count();
    }
}
