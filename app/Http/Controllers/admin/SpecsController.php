<?php

namespace App\Http\Controllers\admin;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use App\Project;
use App\Specs_category;
use \Session, \Validator,\Redirect, \Cookie;

class SpecsController extends Controller
{
   
    public function index(){
        $data['lists'] = Specs_category::orderBy('name','asc')->paginate(10);
        return view('admin.specs.list',$data);
    }
    
   
    public function edit($id){
        $data['lists'] = Specs_category::find($id);
        return view('admin.specs.edit',$data);
    }
    
   
    public function update(Request $request)
    {   
        $model  = Specs_category::find($request->id);
        $validator = Validator::make(
                             $request->all(),
                              [
                                   'name'   => 'required|unique:specs_categories,name,'.$model->id,
                                  
                              ]
               );

         if ($validator->fails())
         {
             $messages = $validator->messages();
             return Redirect::back()->withErrors($validator)->withInput();
         } else {
             $model->name   = $request->name;
             $model->status   = $request->status;
             $model->save();
             return Redirect::route('admin_specs')->with('success','Specs is updated successfully'); 

         }
    }
    
    
    public function create(){
        $data = array();
        return view('admin.specs.create',$data);
    }
    
    public function create_action(Request $request)
    {   
       
        $validator = Validator::make(
                             $request->all(),
                              [
                                   'name'   => 'required',
                                  
                              ]
               );

         if ($validator->fails())
         {
             $messages = $validator->messages();
             return Redirect::back()->withErrors($validator)->withInput();
         } else {
             $model  = new Specs_category();
             $model->name   = $request->name;
             $model->save();
             return Redirect::route('admin_specs')->with('success','Specs is created successfully'); 

         }
    }
    
    public function delete($id)
    {
        
        /*$is_assigned = Project::join("specs","specs.project_id","=","projects.id")
                        ->where('spec_cat_id',$id)
                        ->first();*/
                
        $is_assigned = Project::whereHas('specs', function ($query) use ($id){
        $query->where('spec_cat_id',$id);
        })->count();
        
       
        if($is_assigned == 0)
        {
            $model  = Specs_category::find($id);
            $type = Specs_category::find($id)->delete();
            return Redirect::route('admin_specs')->with('success','Specs Category has been deleted successfully');
        } else {
            return Redirect::route('admin_specs')->with('error','This specs category already has planroom assigned.  Please remove him from projects before deleting.'); 
        }
        
    }
}
