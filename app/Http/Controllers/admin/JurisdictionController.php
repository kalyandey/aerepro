<?php

namespace App\Http\Controllers\admin;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use App\Jurisdictions;
use \Validator,\Redirect;

class JurisdictionController extends Controller
{
    /*
     * Category listing
     */
    public function index(){
        $data['lists'] = Jurisdictions::orderBy('name','ASC')->paginate(10);
        return view('admin.jurisdictions.list',$data);
    }
    
    /*
     * Category edit
     */
    public function edit($id){
        $data['lists'] = Jurisdictions::find($id);
        return view('admin.jurisdictions.edit',$data);
    }
    
    /*
     * Category update
     */
    public function update(Request $request,$id)
    {   
        $model      = Jurisdictions::find($id);
        $validator  = Validator::make($request->all(),['name'   => 'required|unique:jurisdictions,name,'.$model->id]);

         if ($validator->fails())
         {
             $messages = $validator->messages();
             return Redirect::back()->withErrors($validator)->withInput();
         } else {
             $model->name           = $request->name;
             $model->status         = $request->status;
             $model->save();
             return Redirect::route('admin_jurisdictions')->with('success','Jurisdictions is updated successfully'); 

         }
    }
    
    public function create(){
        $data = array();
        return view('admin.jurisdictions.create',$data);
    }
    
    public function store(Request $request){
        $validator = Validator::make($request->all(),['name'   => 'required|unique:jurisdictions,name']);

         if ($validator->fails())
         {
             $messages = $validator->messages();
             return Redirect::back()->withErrors($validator)->withInput();
         } else {
             $model                 = new Jurisdictions();
             $model->name           = $request->name;
             $model->save();
             return Redirect::route('admin_jurisdictions')->with('success','Jurisdictions is added successfully'); 

         }
    }
    
    public function delete($id){
        $model = Jurisdictions::find($id);
        $model->delete();
        return Redirect::route('admin_jurisdictions')->with('success','Jurisdictions deleted successfully');
    }
}
