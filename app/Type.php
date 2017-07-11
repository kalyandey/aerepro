<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Type extends Model
{
    function Project(){
        return $this->hasMany('App\Project','type_id','type_id');
    }
    
    
}
