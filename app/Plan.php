<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Plan extends Model
{
    function plan_category(){
        return $this->belongsTo('App\Plan_category','cat_id');
    }
    
    function project(){
        return $this->belongsTo('App\Project','project_id');
    }
    
    function all_plan($cat_id, $project_id){
        return Plan::where('cat_id',$cat_id)->where('project_id',$project_id)->get();
    }
    
    function order_plan(){
        return $this->hasMany('App\Order','plan_id');
    }
}
