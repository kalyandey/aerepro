<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Private_specs_categories extends Model
{
    function Specs(){
        return $this->hasMany('App\Private_specs','spec_cat_id');
    }
    
}
