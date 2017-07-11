<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Project extends Model
{
    function category(){
        return $this->belongsTo('App\Category','category_id');
    }
    
    function company(){
        return $this->hasMany('App\Company','project_id');
    }
    
    function county(){
        return $this->belongsTo('App\County','county_id');
    }
    
    function type(){
        return $this->belongsTo('App\Type','type_id');
    }
    
    function specs(){
        return $this->hasMany('App\Specs','project_id');
    }
    
    function plan(){
        return $this->hasMany('App\Plan','project_id');
    }
    
    function awarded_contractor(){
        return $this->belongsTo('App\Contractor','awarded_to_contractor');
    }
    function awarded_bidder(){
        return $this->belongsTo('App\Bidder','awarded_to_bidder');
    }
    function tracking(){
        return $this->hasMany('App\Tracking','project_id');
    }
    function state_name(){
        return $this->belongsTo('App\State','state');
    }
    
    function contractor_assign(){
        return $this->hasMany('App\Contractor_assign','project_id');
    }
    
    function project_bidder(){
        return $this->hasMany('App\Project_bidder','project_id');
    }
    
    function order_project(){
        return $this->hasMany('App\Order','project_id');
    }
}
