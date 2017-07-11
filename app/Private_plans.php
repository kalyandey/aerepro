<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Private_plans extends Model
{
    function plan_category(){
        return $this->belongsTo('App\Private_plan_categories','cat_id');
    }
    
    function project(){
        return $this->belongsTo('App\Private_project','project_id');
    }
    
    function all_plan($cat_id, $project_id){
        return Private_plans::where('cat_id',$cat_id)->where('project_id',$project_id)->get();
    }
    
}
