<?php

namespace App\Http\Controllers\admin;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use App\Private_plan_categories;
use \Validator,\Redirect;

class PrivateplancategoryController extends Controller
{
    public function index(){
        $data['lists'] = Private_plan_categories::orderBy('name','asc')->paginate(10);
       return view('admin.private.plan_category.list',$data);
    }
    
    /*
     * Category edit
     */
    public function edit($id){
        $data['lists'] = Private_plan_categories::find($id);
        return view('admin.private.plan_category.edit',$data);
    }
    
    /*
     * Category update
     */
    public function update(Request $request,$id)
    {   
        $model  = Private_plan_categories::find($id);
        $validator = Validator::make(
                             $request->all(),
                              [
                                   'category_name'   => 'required|unique:private_plan_categories,name,'.$model->id,
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
             return Redirect::route('admin_private_plan_category')->with('success','Private plan category is updated successfully'); 

         }
    }
    
    public function create(){
        $data = array();
        return view('admin.private.plan_category.create',$data);
    }
    
    public function store(Request $request){
        $validator = Validator::make(
                             $request->all(),
                              [
                                   'category_name'   => 'required|unique:private_plan_categories,name',
                              ]
               );

         if ($validator->fails())
         {
             $messages = $validator->messages();
             return Redirect::back()->withErrors($validator)->withInput();
         } else {
             $model                 = new Private_plan_categories();
             $model->name           = $request->category_name;
             $model->save();
             return Redirect::route('admin_private_plan_category')->with('success','Private plan category is added successfully'); 

         }
    }
    
    public function delete($id){
        $model = Private_plan_categories::find($id);
        $model->delete();
        return Redirect::route('admin_private_plan_category')->with('success','Plan category deleted successfully');
    }
    
}
