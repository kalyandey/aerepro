<?php

namespace App\Http\Controllers\admin;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use App\Private_specs_categories;
use \Session, \Validator,\Redirect, \Cookie;

class PrivatespecscategoryController extends Controller
{
    public function index(){
        $data['lists'] = Private_specs_categories::orderBy('id','desc')->paginate(10);
        return view('admin.private.specs_category.list',$data);
    }
    
   
    public function edit($id){
        $data['lists'] = Private_specs_categories::find($id);
        return view('admin.private.specs_category.edit',$data);
    }
    
   
    public function update(Request $request,$id)
    {   
        $model  = Private_specs_categories::find($id);
        $validator = Validator::make(
                             $request->all(),
                              ['name'   => 'required|unique:private_specs_categories,name,'.$model->id]
               );

         if ($validator->fails())
         {
             $messages = $validator->messages();
             return Redirect::back()->withErrors($validator)->withInput();
         } else {
             $model->name   = $request->name;
             $model->status   = $request->status;
             $model->save();
             return Redirect::route('admin_private_specs_category')->with('success','Specs Category is updated successfully'); 

         }
    }
    
    
    public function create(){
        $data = array();
        return view('admin.private.specs_category.create',$data);
    }
    
    public function store(Request $request)
    {   
        $validator = Validator::make($request->all(),['name'   => 'required']);
         if ($validator->fails())
         {
             $messages = $validator->messages();
             return Redirect::back()->withErrors($validator)->withInput();
         } else {
             $model  = new Private_specs_categories();
             $model->name   = $request->name;
             $model->save();
             return Redirect::route('admin_private_specs_category')->with('success','Specs Category is created successfully'); 

         }
    }
    
    public function delete($id){
        $model = Private_specs_categories::find($id);
        $model->delete();
        return Redirect::route('admin_private_specs_category')->with('success','Specs category deleted successfully');
    }
}
