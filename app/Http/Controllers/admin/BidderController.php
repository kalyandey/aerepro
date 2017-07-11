<?php

namespace App\Http\Controllers\admin;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use App\Bidder, App\Project_bidder, App\Tracking;
use \Validator, \Redirect; 

class BidderController extends Controller
{
    /*
     * listing
     */
    public function index(Request $request,$project_id){
        $data['keyword']        = '';
        
        if($request->keyword !=''){
            $data['keyword'] = $request->keyword;
            $data['lists'] = Project_bidder::where('project_id',$project_id)->where(function($query) use ($data) {
                                if($data['keyword'] != ''){
                                    
                                    $query->whereHas('bidder', function ($q) use ($data)
                                    {
                                        $q->where('bidders.company','like','%'.$data['keyword'].'%');
                                        $q->orWhere('bidders.contact','like','%'.$data['keyword'].'%');
                                        $q->orWhere('bidders.address','like','%'.$data['keyword'].'%');
                                        $q->orWhere('bidders.email','like','%'.$data['keyword'].'%');
                                        $q->orWhere('bidders.status','like','%'.$data['keyword'].'%');
                                    });
                                }
                            })->orderBy('id','desc')->paginate(10);
        }else{
            $data['lists']      = Project_bidder::where('project_id',$project_id)->orderBy('id','desc')->paginate(10);
        }
        $data['project_id'] = $project_id;
        return view('admin.project.bidder.list',$data);
    }
    
    public function create($project_id){
        $data = array();
        $data['project_id'] = $project_id;
        $bidder             = Project_bidder::select(\DB::raw("GROUP_CONCAT(bidder_id) as bidderId"))->where('project_id',$project_id)->first();
        $data['bidder']     = [''=>'Select Bidder']+Bidder::whereNotIn('id',explode(',',$bidder->bidderId))->pluck('company','id')->all()+['other' => 'Other'];
        //$data['bidder']     = [''=>'Select Bidder']+Bidder::whereNotIn('id',explode(',',$bidder->bidderId))->pluck('company','id')->all();
        return view('admin.project.bidder.create',$data);
    }
    
    public function store($project_id,Request $request){
        
        if($request->bidder_add != 'other'){
            $model                     = new Project_bidder();
            $model->project_id         = $project_id;
            $model->bidder_id          = $request->bidder;
            $model->save();
            
            return Redirect::route('admin_bidder_list',$project_id)->with('success','Bidder is added successfully');
        
        }else{
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
            
             $model                     = new Bidder();
             $model->company            = $request->company;
             $model->contact            = $request->contact;
             $model->phone              = $request->phone;
             $model->fax                = $request->fax;
             $model->email              = $request->email;
             $model->address            = $request->address;
             $model->save();
             
             $pmodel                     = new Project_bidder();
             $pmodel->project_id         = $project_id;
             $pmodel->bidder_id          = $model->id;
             $pmodel->save();
             
             
             $is_save_track = Tracking::where('project_id','=', $project_id)->get();
               
                
                if(count($is_save_track) > 0)
                {
                    foreach($is_save_track as $st){
                        $st->seen_change = '1';
                        $st->updated_at = date('Y-m-d H:i:s');
                        $st->save();
                    }
                }
             
             
             return Redirect::route('admin_bidder_list',$project_id)->with('success','Bidder is added successfully'); 

         }
        }
    }
    
    
    /*
     * edit
     */
    public function edit($project_id,$id){
        $data['lists']          = Bidder::find($id);
        $data['project_id']     = $project_id;
        return view('admin.project.bidder.edit',$data);
    }
    
    /*
     * update
     */
    public function update(Request $request,$project_id,$id)
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
             
             
             $is_save_track = Tracking::where('project_id','=', $project_id)->get();
               
                
                if(count($is_save_track) > 0)
                {
                    foreach($is_save_track as $st){
                        $st->seen_change = '1';
                        $st->updated_at = date('Y-m-d H:i:s');
                        $st->save();
                    }
                }
             
             
             
             return Redirect::route('admin_bidder_list',$project_id)->with('success','Bidder is updated successfully'); 

         }
    }
    
    public function delete($project_id,$id){
        $model = Project_bidder::find($id);
        $model->delete();
        return Redirect::route('admin_bidder_list',$project_id)->with('success','Bidder deleted successfully');
    }
    
    public function getBidder(Request $request){
        
        $project_id                 = $request->input('pid');
        $data                       = array();
        $project_bidder             = Project_bidder::select(\DB::raw("GROUP_CONCAT(bidder_id) as bidderId"))->where('project_id',$project_id)->first();
        $record                     = 0;
        $result                     = array();
        $bidder                     = Bidder::where('company','LIKE','%'.$request->term.'%');
        if(isset($project_bidder->bidderId)){
           $bidder   = $bidder->whereNotIn('id',explode(',',$project_bidder->bidderId)); 
        }
        $bidder      = $bidder->orderBy('id','desc')->limit(5)->get();
        
        if(count($bidder)){
            foreach ($bidder as $k=>$c) {
                $record                 = $record + 1;
                $result[$record]['value']    = $c->company;
                $result[$record]['id']       = $c->id;
                $result[$record]['label']    = $c->company;
             }
        }
        
        if($record == 0){
            $result[0]['label'] = 'Bidder not found';
            $result[0]['value'] = "error";
        }
        
        echo json_encode($result);
    }
}
