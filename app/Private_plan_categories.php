<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Private_plan_categories extends Model
{
    function plan(){
        return $this->hasMany('App\Private_plans','cat_id');
    }
}
