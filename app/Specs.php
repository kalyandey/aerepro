<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Specs extends Model
{
    function Specs_category(){
        return $this->belongsTo('App\Specs_category','spec_cat_id');
    }
    
    function Project(){
        return $this->belongsTo('App\Project','project_id');
    }
    
    function all_spece($cat_id, $project_id){
        return Specs::where('spec_cat_id',$cat_id)->where('project_id',$project_id)->get();
    }
}
