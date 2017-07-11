<?php

namespace App\Http\Controllers\admin;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use App\Project;
use App\Plan_category;
use \Validator,\Redirect;

class PlancategoryController extends Controller
{
    /*
     * Category listing
     */
    public function index(){
        $data['lists'] = Plan_category::orderBy('name','asc')->paginate(10);
       return view('admin.plan_category.list',$data);
    }
    
    /*
     * Category edit
     */
    public function edit($id){
        $data['lists'] = Plan_category::find($id);
        return view('admin.plan_category.edit',$data);
    }
    
    /*
     * Category update
     */
    public function update(Request $request,$id)
    {   
        $model  = Plan_category::find($id);
        $validator = Validator::make(
                             $request->all(),
                              [
                                   'category_name'   => 'required|unique:plan_categories,name,'.$model->id,
                              ]
               );

         if ($validator->fails())
         {
             $messages = $validator->messages();
             return Redirect::back()->withErrors($validator)->withInput();
         } else {
             $model->name           = $request->category_name;
             $model->status         = $request->status;
             $model->save();
             return Redirect::route('admin_plan_category')->with('success','Plan category is updated successfully'); 

         }
    }
    
    public function create(){
        $data = array();
        return view('admin.plan_category.create',$data);
    }
    
    public function store(Request $request){
        $validator = Validator::make(
                             $request->all(),
                              [
                                   'category_name'   => 'required|unique:plan_categories,name',
                              ]
               );

         if ($validator->fails())
         {
             $messages = $validator->messages();
             return Redirect::back()->withErrors($validator)->withInput();
         } else {
             $model                 = new Plan_category();
             $model->name           = $request->category_name;
             $model->save();
             return Redirect::route('admin_plan_category')->with('success','Plan category is added successfully'); 

         }
    }
    
    public function delete($id){
        
        $is_assigned = Project::whereHas('plan', function ($query) use ($id){
        $query->where('cat_id',$id);
        })->count();
        
        if($is_assigned == 0)
        {
            $model  = Plan_category::find($id);
            $model->delete();
            return Redirect::route('admin_plan_category')->with('success','Plan Category has been deleted successfully');
        } else {
            return Redirect::route('admin_plan_category')->with('error','This plan category already has planroom assigned.  Please remove him from projects before deleting.'); 
        }
        
    }
}
