<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Private_specs extends Model
{
    function Specs_category(){
        return $this->belongsTo('App\Private_specs_categories','spec_cat_id');
    }
    
    function Project(){
        return $this->belongsTo('App\Private_project','project_id');
    }
    
    function all_spece($cat_id, $project_id){
        return Private_specs::where('spec_cat_id',$cat_id)->where('project_id',$project_id)->get();
    }
}
