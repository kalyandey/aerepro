<?php

namespace App\Http\Controllers\admin;
use Illuminate\Http\Request;
use App\Http\Requests;
use App\Http\Controllers\Controller;
use App\Profession;
use \Validator,\Redirect;

class ProfessionController extends Controller
{
    /*
     * Profession listing
     */
    public function index(Request $request){
        
        $data['keyword']       = '';
        if($request->keyword !=''){
            $data['keyword']     = $request->keyword;
        }
        $data['lists'] = Profession::where(function($query) use ($data) {
                                if($data['keyword'] != ''){
                                    $query->where('professions.profession_title','like','%'.$data['keyword'].'%');
                                }
                            })   
                            ->orderBy('profession_title','asc')->paginate(10);
         return view('admin.profession.list',$data);
    }
    
    /*
     * Profession add
     */
    public function create(){
        $data = array();
        return view('admin.profession.create',$data);
    }
    
    /*
     * Profession store
     */
    public function store(Request $request){
        $validator = Validator::make(
                             $request->all(),
                              [   'profession_title'   => 'required|unique:professions,profession_title',
                              ]
               );

         if ($validator->fails())
         {
             $messages = $validator->messages();
             return Redirect::back()->withErrors($validator)->withInput();
         } else {
             $model                     = new Profession;
             $model->profession_title   = $request->profession_title;
             $model->created_at         = date('Y-m-d h:i:s');
             $model->save();
             return Redirect::route('admin_profession')->with('success','Profession is created successfully'); 

         }
    }
    
    /*
     * Profession edit
     */
    public function edit($id){
       
        $data['lists'] = Profession::find($id);
        return view('admin.profession.edit',$data);
    }
    
    /*
     * Profession update
     */
    public function update(Request $request)
    {   
        $model  = Profession::find($request->id);
        $validator = Validator::make(
                             $request->all(),
                              [    
                                  'profession_title'   => 'required|unique:professions,profession_title,'.$model->id,
                              ]
               );

         if ($validator->fails())
         {
             $messages = $validator->messages();
             return Redirect::back()->withErrors($validator)->withInput();
         } else {
             $model->profession_title   = $request->profession_title;
             $model->profession_status  = $request->profession_status;
             $model->save();
             return Redirect::route('admin_profession')->with('success','Profession is updated successfully'); 

         }
    }
}
