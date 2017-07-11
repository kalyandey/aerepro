<?php

namespace App\Http\Controllers\admin;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use App\State;
use App\County;
use \Validator,\Redirect;

class CountyController extends Controller
{
    /*
     * County listing
     */
    public function index(Request $request){
        
        $data['keyword']       = '';
        $data['state_code']    = '';
        if($request->keyword !='' || $request->state_code != ''){
            $data['keyword']     = $request->keyword;
            $data['state_code']  = $request->state_code;
        }
        $data['lists'] = County::select('counties.*','states.state','states.state_code')->leftjoin('states', 'states.state_code', '=', 'counties.state_code')
                         ->where(function($query) use ($data) {
                                if($data['state_code'] != ''){
                                $query->where('states.state_code',$data['state_code']);
                                }
                                if($data['keyword'] != ''){
                                    $query->where('counties.name','like','%'.$data['keyword'].'%');
                                }
                            })   
                         ->orderBy('counties.name', 'ASC')->paginate(10);
         $data['state']    = [''=>'Select State'] + State::pluck('state','state_code')->all();                   
         return view('admin.county.list',$data);
    }
    
    /*
     * County add
     */
    public function create(){
        $data['state']  = [''=>'Select State'] + State::pluck('state','state_code')->all();
        return view('admin.county.create',$data);
    }
    
    /*
     * County store
     */
    public function store(Request $request){
        $validator = Validator::make(
                             $request->all(),
                              [    'state_code'  => 'required', 
                                   'county_name'   => 'required|unique:counties,name',
                              ]
               );

         if ($validator->fails())
         {
             $messages = $validator->messages();
             return Redirect::back()->withErrors($validator)->withInput();
         } else {
             $model                 = new County;
             $model->name           = $request->county_name;
             $model->state_code     = $request->state_code;
             $model->created_at     = date('Y-m-d h:i:s');
             $model->save();
             return Redirect::route('admin_county')->with('success','County is created successfully'); 

         }
    }
    
    /*
     * County edit
     */
    public function edit($id){
        $data['state']  = [''=>'Select State'] + State::pluck('state','state_code')->all();
        $data['lists'] = County::find($id);
        return view('admin.county.edit',$data);
    }
    
    /*
     * County update
     */
    public function update(Request $request)
    {   
        $model  = County::find($request->id);
        $validator = Validator::make(
                             $request->all(),
                              [    'state_code'  => 'required',
                                   'county_name'   => 'required|unique:counties,name,'.$model->id,
                              ]
               );

         if ($validator->fails())
         {
             $messages = $validator->messages();
             return Redirect::back()->withErrors($validator)->withInput();
         } else {
             $model->name           = $request->county_name;
             $model->state_code     = $request->state_code;
             $model->save();
             return Redirect::route('admin_county')->with('success','County is updated successfully'); 

         }
    }
}
