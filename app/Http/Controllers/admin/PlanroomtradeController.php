<?php

namespace App\Http\Controllers\admin;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use App\Planroom_trade;
use \Validator,\Redirect;

class PlanroomtradeController extends Controller
{
    /*
     * Category listing
     */
    public function index(){
        $data['lists'] = Planroom_trade::orderBy('id','desc')->paginate(10);
       return view('admin.planroom_trade.list',$data);
    }
    
    /*
     * Category edit
     */
    public function edit($id){
        $data['lists'] = Planroom_trade::find($id);
        return view('admin.planroom_trade.edit',$data);
    }
    
    /*
     * Category update
     */
    public function update(Request $request,$id)
    {   
        $model  = Planroom_trade::find($id);
        $validator = Validator::make(
                             $request->all(),
                              [
                                   'name'   => 'required|unique:planroom_trades,name,'.$model->id,
                              ]
               );

         if ($validator->fails())
         {
             $messages = $validator->messages();
             return Redirect::back()->withErrors($validator)->withInput();
         } else {
             $model->name           = $request->name;
             $model->status         = $request->status;
             $model->save();
             return Redirect::route('admin_planroom_trade')->with('success','Trade is updated successfully'); 

         }
    }
    
    public function create(){
        $data = array();
        return view('admin.planroom_trade.create',$data);
    }
    
    public function store(Request $request){
        $validator = Validator::make(
                             $request->all(),
                              [
                                   'name'   => 'required|unique:planroom_trades,name',
                              ]
               );

         if ($validator->fails())
         {
             $messages = $validator->messages();
             return Redirect::back()->withErrors($validator)->withInput();
         } else {
             $model                 = new Planroom_trade();
             $model->name           = $request->name;
             $model->save();
             return Redirect::route('admin_planroom_trade')->with('success','Trade is added successfully'); 

         }
    }
    
    public function delete($id){
        $model = Planroom_trade::find($id);
        $model->delete();
        return Redirect::route('admin_planroom_trade')->with('success','Trade deleted successfully');
    }
}
