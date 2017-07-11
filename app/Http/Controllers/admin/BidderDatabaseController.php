<?php

namespace App\Http\Controllers\admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Bidder, App\Project_bidder, App\Project;
use \Validator, \Redirect;

class BidderDatabaseController extends Controller
{
    public function index(Request $request){
        $data['keyword']        = '';
        $data['project']        = '';
        if($request->keyword !='' || $request->project != ''){
            $data['keyword'] = $request->keyword;
            $data['project'] = $request->project;
            $data['lists'] = Bidder::where(function($query) use ($data) {
                            if($data['project'] != ''){
                                $query->whereHas('project_bidder', function ($q) use ($data){
                                    $q->where('project_bidders.project_id',$data['project']);
                                });
                            }
                            
                            if($data['keyword'] != ''){
                                $query->where('bidders.company','like','%'.$data['keyword'].'%');
                                $query->orWhere('bidders.contact','like','%'.$data['keyword'].'%');
                                $query->orWhere('bidders.address','like','%'.$data['keyword'].'%');
                                $query->orWhere('bidders.email','like','%'.$data['keyword'].'%');
                                $query->orWhere('bidders.status','like','%'.$data['keyword'].'%');
                            }
                        })
                        ->orderBy('bidders.company','ASC')->paginate(10);
        }else{
            $data['lists']      = Bidder::orderBy('company','ASC')->paginate(10);
        }
        return view('admin.bidder.list',$data);
    }
    /*
     * edit
     */
    public function edit($id){
        $data['lists']          = Bidder::find($id);
        return view('admin.bidder.edit',$data);
    }
    
    /*
     * update
     */
    public function update(Request $request,$id)
    {   
        $model  = Bidder::find($id);
        $validator = Validator::make(
                             $request->all(),
                              [
                                   'company'    => 'required',
                                   'contact'    => 'required',
                                   'phone'      => 'required',
                                   'email'      => 'required',
                                   'address'    => 'required',
                              ]
               );

         if ($validator->fails())
         {
             $messages = $validator->messages();
             return Redirect::back()->withErrors($validator)->withInput();
         } else {
             $model->company            = $request->company;
             $model->contact            = $request->contact;
             $model->phone              = $request->phone;
             $model->fax                = $request->fax;
             $model->email              = $request->email;
             $model->address            = $request->address;
             $model->status             = $request->status;
             $model->save();
             
             return Redirect::route('admin_bidder_database_list')->with('success','Bidder is updated successfully'); 

         }
    }
    
    public function delete($id){
        $model = Bidder::find($id);
        $model->delete();
        return Redirect::route('admin_bidder_database_list')->with('success','Bidder deleted successfully');
    }
    
    public function getprojectid(Request $request){
        $project     = Project::where('project_id','LIKE',$request->term.'%')->orderBy('id','desc')->limit(5)->get();
        if(count($project)){
            foreach ($project as $k=>$c) {
                $result[]['value']    = $c->project_id;
            }
        }else{
            $result[0]['label'] = 'Project not found';
            $result[0]['value'] = "error";
        }
        
        echo json_encode($result);
    }
    
}
