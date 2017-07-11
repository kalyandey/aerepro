<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Bidder extends Model
{
    function project_bidder(){
        return $this->hasMany('App\Project_bidder','bidder_id');
    }
    
    function all_project($id){
        $data = \App\Project_bidder::select( \DB::raw('GROUP_CONCAT(project_id) AS projectid') )->where('bidder_id',$id)->first();
        return \App\Project::select( \DB::raw('GROUP_CONCAT(name SEPARATOR ",<br>") AS project_name') )->whereIn('id',explode(',',$data->projectid))->first();
    }
}
