<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Plan_category extends Model
{
    function plan(){
        return $this->hasMany('App\Plan','cat_id');
    }
}
