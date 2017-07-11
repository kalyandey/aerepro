<?php

namespace App\Http\Controllers\admin;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use App\Csi_division;
use \Validator,\Redirect;

class CsidivisionController extends Controller
{
    /*
     * Csidivision listing
     */
    public function index(Request $request){
        
        $data['keyword']       = '';
        if($request->keyword !=''){
            $data['keyword']     = $request->keyword;
        }
        $data['lists'] = Csi_division::where(function($query) use ($data) {
                                if($data['keyword'] != ''){
                                    $query->where('csi_divisions.division_title','like','%'.$data['keyword'].'%');
                                }
                            })   
                            ->orderBy('division_title','asc')->paginate(10);
         return view('admin.csi_division.list',$data);
    }
    
    /*
     * Csidivision add
     */
    public function create(){
        $data = array();
        return view('admin.csi_division.create',$data);
    }
    
    /*
     * Csidivision store
     */
    public function store(Request $request){
        $validator = Validator::make(
                             $request->all(),
                              [   'division_title'   => 'required|unique:csi_divisions,division_title',
                              ]
               );

         if ($validator->fails())
         {
             $messages = $validator->messages();
             return Redirect::back()->withErrors($validator)->withInput();
         } else {
             $model                     = new Csi_division;
             $model->division_title     = $request->division_title;
             $model->created_at         = date('Y-m-d h:i:s');
             $model->save();
             return Redirect::route('admin_csidivision')->with('success','CSI Division is created successfully'); 

         }
    }
    
    /*
     * Csidivision edit
     */
    public function edit($id){
       
        $data['lists'] = Csi_division::find($id);
        return view('admin.csi_division.edit',$data);
    }
    
    /*
     * Csidivision update
     */
    public function update(Request $request)
    {   
        $model  = Csi_division::find($request->id);
        $validator = Validator::make(
                             $request->all(),
                              [    
                                  'division_title'   => 'required|unique:csi_divisions,division_title,'.$model->id,
                              ]
               );

         if ($validator->fails())
         {
             $messages = $validator->messages();
             return Redirect::back()->withErrors($validator)->withInput();
         } else {
             $model->division_title   = $request->division_title;
             $model->division_status  = $request->division_status;
             $model->save();
             return Redirect::route('admin_csidivision')->with('success','CSI Division is updated successfully'); 

         }
    }
}
