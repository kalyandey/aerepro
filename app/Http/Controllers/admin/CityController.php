<?php

namespace App\Http\Controllers\admin;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use App\State;
use App\City;
use \Validator,\Redirect;

class CityController extends Controller
{
     /*
     * City listing
     */
    public function index(Request $request){
        
        $data['keyword']       = '';
        $data['state_code']    = '';
        if($request->keyword !='' || $request->state_code != ''){
            $data['keyword']     = $request->keyword;
            $data['state_code']  = $request->state_code;
        }
        $data['lists'] = City::select('cities.*','states.state','states.state_code')->leftjoin('states', 'states.state_code', '=', 'cities.state_code')
                         ->where(function($query) use ($data) {
                                if($data['state_code'] != ''){
                                $query->where('states.state_code',$data['state_code']);
                                }
                                if($data['keyword'] != ''){
                                    $query->where('cities.city','like','%'.$data['keyword'].'%');
                                }
                            })   
                         ->orderBy('cities.id','desc')->paginate(10);
         $data['state']    = [''=>'Select State'] + State::pluck('state','state_code')->all();                   
         return view('admin.city.list',$data);
    }
    
    /*
     * City add
     */
    public function create(){
        $data['state']  = [''=>'Select State'] + State::pluck('state','state_code')->all();
        return view('admin.city.create',$data);
    }
    
    /*
     * City store
     */
    public function store(Request $request){
        $validator = Validator::make(
                             $request->all(),
                              [    'state_code'  => 'required', 
                                   'city_name'   => 'required|unique:cities,city',
                              ]
               );

         if ($validator->fails())
         {
             $messages = $validator->messages();
             return Redirect::back()->withErrors($validator)->withInput();
         } else {
             $model                 = new City;
             $model->city           = $request->city_name;
             $model->state_code     = $request->state_code;
             $model->created_at     = date('Y-m-d h:i:s');
             $model->save();
             return Redirect::route('admin_city')->with('success','City is created successfully'); 

         }
    }
    
    /*
     * City edit
     */
    public function edit($id){
        $data['state']  = [''=>'Select State'] + State::pluck('state','state_code')->all();
        $data['lists'] = City::find($id);
        return view('admin.city.edit',$data);
    }
    
    /*
     * City update
     */
    public function update(Request $request)
    {   
        $model  = City::find($request->id);
        $validator = Validator::make(
                             $request->all(),
                              [    'state_code'  => 'required',
                                   'city_name'   => 'required|unique:cities,city,'.$model->id,
                              ]
               );

         if ($validator->fails())
         {
             $messages = $validator->messages();
             return Redirect::back()->withErrors($validator)->withInput();
         } else {
             $model->city           = $request->city_name;
             $model->state_code     = $request->state_code;
             $model->save();
             return Redirect::route('admin_city')->with('success','City is updated successfully'); 

         }
    }
}
