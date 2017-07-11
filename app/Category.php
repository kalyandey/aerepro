<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    function Project(){
        return $this->hasMany('App\Project','category_id','category_id');
    }
}
