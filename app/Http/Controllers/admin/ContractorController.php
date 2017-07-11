<?php

namespace App\Http\Controllers\admin;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use App\Project;
use App\Contractor;
use App\State;
use App\City;
use \Session, \Validator,\Redirect, \Cookie;

class ContractorController extends Controller
{
     public function index(Request $request){
        $data['keyword']       = '';
        if($request->keyword !=''){
            $data['keyword']     = $request->keyword;
         } 
        $data['lists'] = Contractor::where(function($query) use ($data) {
                                if($data['keyword'] != ''){
                                    $query->where('contractors.business_name','like','%'.$data['keyword'].'%');
                                    $query->orWhere('contractors.name','like','%'.$data['keyword'].'%');
                                }
                            })->orderBy('contractors.business_name','ASC')->paginate(10);
        return view('admin.contractor.list',$data);
    }
    
   
    public function edit($id){
        $data['state']  = [''=>'Select State'] + State::pluck('state','id')->all();
        $data['city']  = [''=>'Select City'] + City::pluck('city','id')->all();
        $data['lists'] = Contractor::find($id);
        return view('admin.contractor.edit',$data);
    }
    
   
    public function update(Request $request)
    {   
        $model  = Contractor::find($request->id);
        $validator = Validator::make(
                             $request->all(),
                              [
                                  'business_name'   => 'required|unique:contractors,business_name,'.$model->id, 
                                  'name'   => 'required|unique:contractors,name,'.$model->id,
                                  'phone'   => 'required',
                                  'email'   => 'required',
                                  
                              ]
               );

         if ($validator->fails())
         {
             $messages = $validator->messages();
             return Redirect::back()->withErrors($validator)->withInput();
         } else {
             $model->business_name   = $request->business_name;
             $model->name            = $request->name;
             $model->street          = $request->street;
             $model->city            = $request->city;
             $model->state           = $request->state;
             $model->zip             = $request->zip;
             $model->phone           = $request->phone;
             $model->fax             = $request->fax;
             $model->email           = $request->email;
             $model->status          = $request->status;
             $model->save();
             return Redirect::route('admin_contractor')->with('success','Contractors is updated successfully'); 

         }
    }
    
    
    public function create(){
        $data = array();
        $data['state']  = [''=>'Select State'] + State::pluck('state','id')->all();
        $data['city']  = [''=>'Select City'] + City::pluck('city','id')->all();
        return view('admin.contractor.create',$data);
    }
    
    public function create_action(Request $request)
    {   
       $validator = Validator::make(
                             $request->all(),
                              [
                                  'business_name'   => 'required|unique:contractors,business_name',
                                  'name'   => 'required|unique:contractors,name',
                                  'phone'   => 'required',
                                  'email'   => 'required',
                                  
                              ]
               );

         if ($validator->fails())
         {
             $messages = $validator->messages();
             return Redirect::back()->withErrors($validator)->withInput();
         } else {
             $model  = new Contractor();
             $model->business_name   = $request->business_name;
             $model->name            = $request->name;
             $model->street          = $request->street;
             $model->city            = $request->city;
             $model->state           = $request->state;
             $model->zip             = $request->zip;
             $model->phone           = $request->phone;
             $model->fax             = $request->fax;
             $model->email           = $request->email;
             $model->save();
             return Redirect::route('admin_contractor')->with('success','Contractors is created successfully'); 

         }
    }
    
    public function delete($id)
    {
       
        $is_assigned = Project::where('contractor_id',$id)->Orwhere('awarded_to_contractor',$id)->count();
        if($is_assigned == 0)
        {
            $model  = Contractor::find($id);
            $model->delete();
            return Redirect::route('admin_contractor')->with('success','Contractors has been deleted successfully');
        } else {
            return Redirect::route('admin_contractor')->with('error','This contractor already has contracts assigned.  Please remove him from projects before deleting.'); 
        }
    }
}
