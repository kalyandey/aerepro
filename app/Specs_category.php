<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Specs_category extends Model
{
    function Specs(){
        return $this->hasMany('App\Specs','spec_cat_id');
    }
    
}
