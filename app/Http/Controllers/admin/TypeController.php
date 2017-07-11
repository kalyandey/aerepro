<?php

namespace App\Http\Controllers\admin;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use App\Type;
use App\Project;
use \Validator,\Redirect;

class TypeController extends Controller
{
    /*
     * Type listing
     */
    public function index(){
       $data['lists'] = Type::whereNotIn('id', [1])->orderBy('name','asc')->paginate(10);
       return view('admin.type.list',$data);
    }
    
    public function create(){
        $data = array();
        return view('admin.type.create',$data);
    }
    
    /*
     * Type store
     */
    public function store(Request $request){
        $validator = Validator::make(
                             $request->all(),
                              [   
                                  'type_name'  => 'required|unique:types,name'
                              ]);
         if ($validator->fails())
         {
             $messages = $validator->messages();
             return Redirect::back()->withErrors($validator)->withInput();
         } else {
             $model                 = new Type;
             $model->name           = $request->type_name;
             $model->created_at     = date('Y-m-d h:i:s');
             $model->save();
             return Redirect::route('admin_type')->with('success','Type is created successfully'); 
         }
    }
    
    /*
     * Type edit
     */
    public function edit($id){
        $data['lists'] = Type::find($id);
        return view('admin.type.edit',$data);
    }
    
    /*
     * Type update
     */
    public function update(Request $request)
    {   
        $model  = Type::find($request->id);
        $validator = Validator::make(
                             $request->all(),
                              [
                                   'type_name'   => 'required|unique:types,name,'.$model->id,
                              ]
               );

         if ($validator->fails())
         {
             $messages = $validator->messages();
             return Redirect::back()->withErrors($validator)->withInput();
         } else {
             $model->name           = $request->type_name;
             $model->save();
             return Redirect::route('admin_type')->with('success','Type is updated successfully'); 

         }
    }
    
    public function delete($id)
    {
        $is_assigned = Project::where('type_id',$id)->count();
        if($is_assigned == 0)
        {
            $model  = Type::find($id);
            $type = Type::find($id)->delete();
            return Redirect::route('admin_type')->with('success','Type has been deleted successfully');
        } else {
            return Redirect::route('admin_type')->with('error','This type already has planroom assigned.  Please remove him from projects before deleting.'); 
        }
        
    }
}
