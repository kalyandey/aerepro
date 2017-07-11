<?php

namespace App\Http\Controllers\admin;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use App\State;
use \Validator,\Redirect;

class StateController extends Controller
{
    /*
     * State listing
     */
    public function index(Request $request){
        
        $data['keyword']       = '';
        if($request->keyword !=''){
            $data['keyword']     = $request->keyword;
         }
        $data['lists'] = State::where(function($query) use ($data) {
                                if($data['keyword'] != ''){
                                    $query->where('states.state','like','%'.$data['keyword'].'%');
                                    $query->orWhere('states.state_code','like','%'.$data['keyword'].'%');
                                }
                            })   
                         ->orderBy('state','asc')->paginate(10);
         return view('admin.state.list',$data);
    }
    
    /*
     * State add
     */
    public function create(){
        $data = array();
        return view('admin.state.create',$data);
    }
    
    /*
     * State store
     */
    public function store(Request $request){
        $validator = Validator::make(
                             $request->all(),
                              [   
                                  'state_name'  => 'required|unique:states,state',
                                  'state_code'  => 'required'
                              ]
               );

         if ($validator->fails())
         {
             $messages = $validator->messages();
             return Redirect::back()->withErrors($validator)->withInput();
         } else {
             $model                 = new State;
             $model->state          = $request->state_name;
             $model->state_code     = $request->state_code;
             $model->created_at     = date('Y-m-d h:i:s');
             $model->save();
             return Redirect::route('admin_state')->with('success','State is created successfully'); 

         }
    }
    
    /*
     * State edit
     */
    public function edit($id){
        $data['lists'] = State::find($id);
        return view('admin.state.edit',$data);
    }
    
    /*
     * State update
     */
    public function update(Request $request)
    {   
        $model  = State::find($request->id);
        $validator = Validator::make(
                             $request->all(),
                              [    'state_name'   => 'required|unique:states,state,'.$model->id,
                              ]
               );

         if ($validator->fails())
         {
             $messages = $validator->messages();
             return Redirect::back()->withErrors($validator)->withInput();
         } else {
             $model->state          = $request->state_name;
             $model->state_code     = $request->state_code;
             $model->save();
             return Redirect::route('admin_state')->with('success','State is updated successfully'); 

         }
    }
}
