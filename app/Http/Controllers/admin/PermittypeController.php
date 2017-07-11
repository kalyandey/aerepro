<?php

namespace App\Http\Controllers\admin;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use App\Permit_type;
use \Validator,\Redirect;

class PermittypeController extends Controller
{
    /*
     * Category listing
     */
    public function index(){
        $data['lists'] = Permit_type::orderBy('id','desc')->paginate(10);
        return view('admin.permittype.list',$data);
    }
    
    /*
     * Category edit
     */
    public function edit($id){
        $data['lists'] = Permit_type::find($id);
        return view('admin.permittype.edit',$data);
    }
    
    /*
     * Category update
     */
    public function update(Request $request,$id)
    {   
        $model      = Permit_type::find($id);
        $validator  = Validator::make($request->all(),['name'   => 'required|unique:permit_types,name,'.$model->id]);

         if ($validator->fails())
         {
             $messages = $validator->messages();
             return Redirect::back()->withErrors($validator)->withInput();
         } else {
             $model->name           = $request->name;
             $model->status         = $request->status;
             $model->save();
             return Redirect::route('admin_permittype')->with('success','Permit type is updated successfully'); 

         }
    }
    
    public function create(){
        $data = array();
        return view('admin.permittype.create',$data);
    }
    
    public function store(Request $request){
        $validator = Validator::make($request->all(),['name'   => 'required|unique:permit_types,name']);

         if ($validator->fails())
         {
             $messages = $validator->messages();
             return Redirect::back()->withErrors($validator)->withInput();
         } else {
             $model                 = new Permit_type();
             $model->name           = $request->name;
             $model->save();
             return Redirect::route('admin_permittype')->with('success','Permit type is added successfully'); 

         }
    }
    
    public function delete($id){
        $model = Permit_type::find($id);
        $model->delete();
        return Redirect::route('admin_permittype')->with('success','Permit type deleted successfully');
    }
}
