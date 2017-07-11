<?php

namespace App\Http\Controllers\admin;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use App\Permit_owner;
use \Validator,\Redirect;
use App\City, App\State;

class PermitownerController extends Controller
{
    public function index(Request $request){
        $data['keyword']        = '';
        $data['cities']         = '';
        $data['states']         = '';
        if($request->keyword !='' || $request->states != '' || $request->cities != ''){
            $data['keyword']            = $request->keyword;
            $data['cities']             = $request->cities;
            $data['states']             = $request->states;
            
            $data['lists'] = Permit_owner::orderBy('id','desc')->where(function($query) use ($data) {
                                if($data['cities'] != ''){
                                    $query->where('owner_city_id',$data['cities']);
                                }
                                if($data['states'] != ''){
                                    $query->where('owner_state_id',$data['states']);
                                }
                                
                                if($data['keyword'] != ''){
                                $query->where('owner_name','like','%'.$data['keyword'].'%');
                                $query->orWhere('status','like','%'.$data['keyword'].'%');
                                }
            })->paginate(10);
            
        }else{
            $data['lists'] = Permit_owner::orderBy('id','desc')->paginate(10);
        }
        $data['city'] = [''=>'Select City']+City::pluck('city','id')->all();
        $data['state'] = [''=>'Select State'] + State::pluck('state','id')->all();
        return view('admin.permitowner.list',$data);
    }
    
    /*
     * Category edit
     */
    public function edit($id){
        $data['lists'] = Permit_owner::find($id);
        $data['city'] = [''=>'Select City']+City::pluck('city','id')->all();
        $data['state'] = [''=>'Select State'] + State::pluck('state','id')->all();
        return view('admin.permitowner.edit',$data);
    }
    
    /*
     * Category update
     */
    public function update(Request $request,$id)
    {   
        $model      = Permit_owner::find($id);
        $validator  = Validator::make($request->all(),
                                      ['owner_name'      => 'required',
                                      'owner_city_id'   => 'required',
                                      'owner_state_id'  => 'required']);

         if ($validator->fails())
         {
             $messages = $validator->messages();
             return Redirect::back()->withErrors($validator)->withInput();
         } else {
             $model->owner_name             = $request->owner_name;
             $model->owner_city_id          = $request->owner_city_id;
             $model->owner_state_id         = $request->owner_state_id;
             $model->owner_zip              = $request->owner_zip;
             $model->owner_phone            = $request->owner_phone;
             $model->owner_address          = $request->owner_address;
             $model->status                 = $request->status;
             $model->save();
             return Redirect::route('admin_permitowner')->with('success','Permit owner is updated successfully'); 

         }
    }
    
    public function create(){
        $data = array();
        $data['city'] = [''=>'Select City']+City::pluck('city','id')->all();
        $data['state'] = [''=>'Select State'] + State::pluck('state','id')->all();
        return view('admin.permitowner.create',$data);
    }
    
    public function store(Request $request){
        $validator = Validator::make($request->all(),
                                     ['owner_name'      => 'required',
                                      'owner_city_id'   => 'required',
                                      'owner_state_id'  => 'required']
                                    );

         if ($validator->fails())
         {
             $messages = $validator->messages();
             return Redirect::back()->withErrors($validator)->withInput();
         } else {
             $model                         = new Permit_owner();
             $model->owner_name             = $request->owner_name;
             $model->owner_city_id          = $request->owner_city_id;
             $model->owner_state_id         = $request->owner_state_id;
             $model->owner_zip              = $request->owner_zip;
             $model->owner_phone            = $request->owner_phone;
             $model->owner_address          = $request->owner_address;
             $model->save();
             return Redirect::route('admin_permitowner')->with('success','Permit owner is added successfully'); 
         }
    }
    
    public function delete($id){
        $model = Permit_owner::find($id);
        $model->delete();
        return Redirect::route('admin_permitowner')->with('success','Permit owner deleted successfully');
    }
}
