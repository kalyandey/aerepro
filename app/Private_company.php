<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Cviebrock\EloquentSluggable\Sluggable;

class Private_company extends Model
{
    use Sluggable;
    
    public function sluggable()
    {
        return [
            'company_slug' => [
                'source' => 'company_name',
                'onUpdate' => true
            ]
        ];
    }
    public function setPasswordAttribute($password){   
        $this->attributes['password'] = bcrypt($password);
    }
    function project(){
        return $this->hasMany('App\Private_project','company_id');
    }
    
    function private_planroom_assign_company(){
        return $this->hasMany('App\Private_planroom_assigns','company_id');
    }
    
    function private_planroom_assign_user(){
        return $this->hasMany('App\Private_planroom_assigns','user_id');
    }
    
    function assign_company(){
        return $this->hasMany('App\Private_company_assign','company_id');
    }
    
    function assign_user(){
        return $this->hasMany('App\Private_company_assign','user_id','id');
    }
    
    function get_company($id)
    {
        return \App\Private_company::select( \DB::raw('company_name') )->where('id',$id)->first();
    }
    
    function all_assign_company($id){
        $data = \App\Private_company_assign::select( \DB::raw('GROUP_CONCAT(company_id) AS companyid') )->where('user_id',$id)->first();
        return \App\Private_company::select( \DB::raw('GROUP_CONCAT(company_name SEPARATOR ",<br>") AS companyname') )->whereIn('id',explode(',',$data->companyid))->first();
    }
    
}
