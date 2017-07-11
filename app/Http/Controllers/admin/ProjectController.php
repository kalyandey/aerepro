<?php

namespace App\Http\Controllers\admin;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use App\County, App\Category, App\Type;
use App\Project, App\Company, App\Specs_category, App\Specs, App\Users, App\Plan_category, App\Plan, App\City, App\State, App\Contractor,App\Trade , App\Tracking, App\Bidder,App\Contractor_assign;
use \Validator,\Redirect;
class ProjectController extends Controller
{
    public function __construct(){
        ini_set('max_execution_time', 0);
    }
    public function lists(Request $request){
        $data['keyword']        = '';
        $data['counties']       = '';
        $data['types']          = '';
        $data['categories']     = '';
        if($request->keyword !='' || $request->counties != '' || $request->types != '' || $request->categories != ''){
            $data['keyword']            = $request->keyword;
            $data['counties']           = $request->counties;
            $data['types']              = $request->types;
            $data['categories']         = $request->categories;
            $data['lists'] = Project::select('projects.bid_close_date','projects.id','projects.project_id','projects.name as project_name','projects.status','counties.name as county_name','categories.name as category_name','types.name as type_name')
                            ->leftjoin('counties', 'counties.id', '=', 'projects.county_id')
                            ->leftjoin('categories', 'categories.id', '=', 'projects.category_id')
                            ->leftjoin('types', 'types.id', '=', 'projects.type_id')
                            ->where(function($query) use ($data) {
                                if($data['counties'] != ''){
                                $query->where('counties.id',$data['counties']);
                                }
                                if($data['categories'] != ''){
                                $query->where('categories.id',$data['categories']);
                                }
                                if($data['types'] != ''){
                                $query->where('types.id',$data['types']);
                                }
                                
                                if($data['keyword'] != ''){
                                $query->where('projects.name','like','%'.$data['keyword'].'%');
                                $query->orWhere('projects.status','like','%'.$data['keyword'].'%');
                                $query->orWhere('projects.project_id','like','%'.$data['keyword'].'%');
                                }
                            })
                            ->orderBy('projects.project_id','desc')->paginate(10);
        }
        else{
            $data['lists'] = Project::select('projects.bid_close_date','projects.id','projects.project_id','projects.name as project_name','projects.status','counties.name as county_name','categories.name as category_name','types.name as type_name')->leftjoin('counties', 'counties.id', '=', 'projects.county_id')->leftjoin('categories', 'categories.id', '=', 'projects.category_id')->leftjoin('types', 'types.id', '=', 'projects.type_id')->orderBy('projects.project_id','desc')->paginate(10);
        
        }
        
        $data['category']       = [''=>'Select Category'] + Category::orderBy('name','ASC')->pluck('name','id')->all();
        $data['type']           = [''=>'Select Type'] + Type::orderBy('name','ASC')->pluck('name','id')->all();
        $data['county']         = [''=>'Select County'] + County::orderBy('name','ASC')->pluck('name','id')->all();
        
        return view('admin.project.list',$data);
    }
    
    public function create(){
        $data                   = array();
        $data['category']       = [''=>'Select Category'] + Category::orderBy('name','ASC')->pluck('name','id')->all();
        $data['type']           = [''=>'Select Type'] + Type::orderBy('name','ASC')->pluck('name','id')->all();
        $data['plan_trade']     = Trade::get();
        return view('admin.project.create',$data);
    }
    
    public function store(Request $request){
        $validator = Validator::make($request->all(),
                                     ['name'            => 'required',
                                      'category_id'     => 'required',
                                      'type_id'         => 'required',
                                      'status'          => 'required']);
        if($validator->fails()){
            $message = $validator->messages();
            return Redirect::back()->withErrors($validator)->withInput();
        }else{
            $project                            = new Project;
            $project->name                      = $request->name;
            $project->category_id               = ($request->category_id != '')?$request->category_id:null;
            if($request->type_id != ''){
               $project->type_id                   = $request->type_id;
            }
            $project->mandatory_pre_bidding     = $request->mandatory_pre_bidding;
            if($request->bid_close_date != ''){
            $bid_close_date                     = explode('/',$request->bid_close_date);
            $project->bid_close_date            = $bid_close_date[2].'-'.$bid_close_date[0].'-'.$bid_close_date[1];
            $project->time_due                  = date('H:i:s',strtotime($request->time_due));
            }
            if($request->pre_bid_meeting_date != ''){
            $pre_bid_meeting_date               = explode('/',$request->pre_bid_meeting_date);
            $project->pre_bid_meeting_date      = $pre_bid_meeting_date[2].'-'.$pre_bid_meeting_date[0].'-'.$pre_bid_meeting_date[1];
            }
            $project->pre_bid_meeting_time      = ($request->pre_bid_meeting_time !='')?date('H:i:s',strtotime($request->pre_bid_meeting_time)):'';
            $project->valuation                 = $request->valuation;
            $project->description               = $request->description;
            $project->additional_comments       = $request->additional_comments;
            if($request->trade != ''){
                $project->trade                     = implode(',',$request->trade);
            }
            $project->status                    = $request->status;
            //if ($request->hasFile('documents')) {
            //    
            //    $filename = time().$request->documents->getClientOriginalName();
            //    $request->documents->move(public_path('uploads/project/documents/'), $filename);
            //    $file = public_path("uploads/project/documents/".$filename);
            //    $this->fileupload($file , 'uploads/project/documents/' , $filename );
            //    
            //    if(file_exists($file) && $filename != ''){
            //        unlink($file);
            //    }
            //    
            //    $project->documents = $filename;
            //}
            $project->save();
            
            /*$project->project_id                = 1000+$project->id;*/
            $project->project_id                = $project->id;
            $project->save();

            $company                            = new Company;
            $company->project_id                = $project->id;
            $company->save();
            
            $is_save_track = Tracking::where('project_id','=', $project->id)->get();
               
                
            if(count($is_save_track) > 0)
            {
                foreach($is_save_track as $st){
                    $st->seen_change = '1';
                    $st->updated_at = date('Y-m-d H:i:s');
                    $st->save();
                }
            }
            
            return Redirect::route('admin_project_awarded_to',array($project->id))->with('success','Details Added Successfully!');
        }
    }
    
    public function awarded_to(Request $request,$id){
        $data = array();
        $project                            = Project::find($id);
        if($request->action == "Process"){
            if($request->select_awarded_type == 'contractor_bidder'){
                if($request->awarded_to != ''){
                    if($request->awarded_type == 'contractor'){
                        $project->awarded_to_bidder                    = null;
                        $project->awarded_to_contractor                = $request->awarded_to;
                    }else{
                        $project->awarded_to_contractor                = null;
                        $project->awarded_to_bidder                    = $request->awarded_to;
                    }
                    $project->status                    = 'Awarded';
                }else{
                    $project->status                    = ($project->status == 'Awarded')?'Bidding':$project->status;
                }
            }elseif($request->select_awarded_type == 'bidder'){
                $model                     = new Bidder;
                $model->company            = $request->company;
                $model->contact            = $request->contact;
                $model->phone              = $request->phone;
                $model->fax                = $request->fax;
                $model->email              = $request->email;
                $model->address            = $request->address;
                $model->save();
                
                $project->awarded_to_contractor                = null;
                $project->awarded_to_bidder                    = $model->id;
                $project->status                               = 'Awarded';
                        
            }elseif($request->select_awarded_type == 'contractor'){
                $contractor                            = new Contractor;
                $contractor->business_name             = $request->business_name;
                $contractor->name                      = $request->name;
                $contractor->street                    = $request->street;
                $contractor->city                      = $request->city;
                if($request->state == ''){
                $contractor->state                     = null;
                }else{
                $contractor->state                     = $request->state;
                }
                $contractor->zip                       = $request->zip;
                $contractor->phone                     = $request->phone;
                $contractor->fax                       = $request->fax;
                $contractor->email                     = $request->email;
                $contractor->save();
                
                $project->awarded_to_bidder            = null;
                $project->awarded_to_contractor        = $contractor->id;
                $project->status                       = 'Awarded';
            }
            $project->save();
            $is_save_track = Tracking::where('project_id','=', $id)->get();
                
            if(count($is_save_track) > 0)
            {
                foreach($is_save_track as $st){
                     $st->seen_change = '1';
                     $st->updated_at = date('Y-m-d H:i:s');
                     $st->save();
                }
            }
           return Redirect::route('admin_project_address',[$project->id])->with('success','Awarded Updated successfully!');
        }

        $data['projectDetails'] = $project;
        $data['user']           = [''=>'Select User'] + Users::select('id', \DB::raw('CONCAT(first_name, " ", last_name) AS full_name'))->pluck('full_name','id')->all();
        $data['state']          = [''=>'Select State'] + State::orderBy('state','ASC')->pluck('state','id')->all();
        return view('admin.project.awarded_to',$data);
    }
    
    public function address_update(Request $request, $id){
        $data                   = array();
        $data['county']         = [''=>'Select County'] + County::orderBy('name','ASC')->pluck('name','id')->all();
        $project                = Project::find($id);
        if($request->action == "Process"){
                
                $validator = Validator::make($request->all(),['county_id'            => 'required']);
                if($validator->fails()){
                    $message = $validator->messages();
                    return Redirect::back()->withErrors($validator)->withInput();
                }else{
            
                    $project->street                    = $request->street;
                    $project->city                      = ($request->city != '')?$request->city:null;
                    $project->state                     = ($request->state != '')?$request->state:null;
                    $project->county_id                 = ($request->county_id != '')?$request->county_id:null;
                    $project->zip                       = $request->zip;
                    $project->save();
                       
                       
                    $is_save_track = Tracking::where('project_id','=', $id)->get();
                   
                    
                    if(count($is_save_track) > 0)
                    {
                        foreach($is_save_track as $st){
                            $st->seen_change = '1';
                            $st->updated_at = date('Y-m-d H:i:s');
                            $st->save();
                        }
                    }
                    return Redirect::route('admin_project_principle',[$project->id])->with('success','Address Updated successfully');
                }
        }
        $data['projectDetails'] = $project;
        $data['city']           = [''=>'Select City'] + City::orderBy('city','ASC')->pluck('city','id')->all();
        $data['state']          = [''=>'Select State'] + State::orderBy('state','ASC')->pluck('state','id')->all();
        return view('admin.project.address',$data);
    }
    
    
    public function principle_update(Request $request, $id){
        $data                   = array();
        if($request->action == "Process"){
            
            $validator = Validator::make($request->all(),
                                            ['company_name'    => 'required',
                                             'email'           => 'email' ]);
               if($validator->fails()){
                   $message = $validator->messages();
                   return Redirect::back()->withErrors($validator)->withInput();
               }else{
                   $company                            = Company::where('project_id',$id)->first();
                   $company->company_name              = $request->company_name;
                   $company->user_name                 = $request->user_name;
                   $company->address                   = $request->address;
                   $company->city                      = ($request->city != '')?$request->city:null;
                   $company->state                     = ($request->state != '')?$request->state:null;
                   $company->zip                       = $request->zip;
                   $company->phone                     = $request->phone;
                   $company->fax                       = $request->fax;
                   $company->email                     = $request->email;
                   $company->save();
                   
                $is_save_track = Tracking::where('project_id','=', $id)->get();
               
                
                if(count($is_save_track) > 0)
                {
                    foreach($is_save_track as $st){
                        $st->seen_change = '1';
                        $st->updated_at = date('Y-m-d H:i:s');
                        $st->save();
                    }
                }
                   
                   
                   return Redirect::route('admin_project_contractor',[$id])->with('success','Principle details updated successfully');
                }
        }
        $data['city']           = [''=>'Select City'] + City::orderBy('city','ASC')->pluck('city','id')->all();
        $data['state']          = [''=>'Select State'] + State::orderBy('state','ASC')->pluck('state','id')->all();
        $data['projectDetails'] = Project::find($id);
        return view('admin.project.principle',$data);
    }
    
    public function contractor_update(Request $request , $id){
        $data                           = array();
        $project                        = Project::find($id);
        $data['contractor_assign']      = Contractor_assign::where('project_id',$id)->get();
        if($request->action == "Process"){
            //dd($request->all());
                for($i=0;$i<count($request->contractor_business_name);$i++){
                    if(isset($request->select_type[$i]) && $request->select_type[$i] != ''){
                       if($request->select_type[$i] == 'autocomplete'){
                        
                            $con_count = Contractor_assign::where('project_id',$id)->where('contractor_id',$request->contractor_id[$i])->count();
                            if($con_count == 0){
                                $ass_contractor                         = new Contractor_assign;
                                $ass_contractor->contractor_id          = $request->contractor_id[$i];
                                $ass_contractor->project_id             = $id;
                                $ass_contractor->save();
                            }
                       }else if($request->select_type[$i] == 'others'){
                            
                            $contractor                            = new Contractor;
                            $contractor->business_name             = $request->business_name[$i];
                            $contractor->name                      = $request->name[$i];
                            $contractor->street                    = $request->street[$i];
                            $contractor->city                      = $request->city[$i];
                            if($request->state[$i] == ''){
                            $contractor->state                     = null;
                            }else{
                            $contractor->state                     = $request->state[$i];
                            }
                            $contractor->zip                       = $request->zip[$i];
                            $contractor->phone                     = $request->phone[$i];
                            $contractor->fax                       = $request->fax[$i];
                            $contractor->email                     = $request->email[$i];
                            $contractor->save();
                            
                            $ass_contractor                         = new Contractor_assign;
                            $ass_contractor->contractor_id          = $contractor->id;
                            $ass_contractor->project_id             = $id;
                            $ass_contractor->save();
                        }
                    }
                }
                $is_save_track = Tracking::where('project_id','=', $id)->get();
               
                
                if(count($is_save_track) > 0)
                {
                    foreach($is_save_track as $st){
                        $st->seen_change = '1';
                        $st->updated_at = date('Y-m-d H:i:s');
                        $st->save();
                    }
                }
                
                return Redirect::route('admin_project_plans',[$id])->with('success','Contractor details updated successfully');
        }
        $data['projectDetails']         = $project;
        $data['city']                   = [''=>'Select City'] + City::orderBy('city','ASC')->pluck('city','id')->all();
        $data['state']                  = [''=>'Select State'] + State::orderBy('state','ASC')->pluck('state','id')->all();
        $data['contractor']             = [''=>'Select Contractor'] + Contractor::orderBy('name','ASC')->pluck('name','id')->all() + ['other'=>'Other'];
    
        return view('admin.project.contractor',$data);
    }
    public function plan_update(Request $request, $id){
        
        $data                   = array();
        if($request->action == "Process"){
            
                foreach($request->option as $opt){
                    $category_id = $opt['plan_category'];
                    for($i=0;$i<count($opt['plan_name']);$i++){
                        if(array_key_exists('plan_id',$opt) && array_key_exists($i,$opt['plan_id'])){
                            $plan                            = Plan::find($opt['plan_id'][$i]);
                            if (array_key_exists('file_name',$opt) && array_key_exists($i,$opt['file_name'])) {
                                
                                $removeFilePath  = '';
                                if(\Helpers::isFileExist('uploads/project/plan/'.$plan->file_name) && $plan->file_name != ''){
                                    $removeFilePath = 'uploads/project/plan/'.$plan->file_name;
                                }
                                $filename           = md5(microtime()).'.'.$opt['file_name'][$i]->getClientOriginalExtension();
                                
                                $opt['file_name'][$i]->move(public_path('uploads/project/plan/'), $filename);
                                
                                $file = public_path("uploads/project/plan/".$filename);
                                $this->fileupload($file , 'uploads/project/plan/' , $filename , $removeFilePath);
                                
                                
                                $output     = shell_exec('pdfinfo '.$file);
                                $data       = explode("\n", $output);
                                //dd($data);
                                for($c=0; $c < count($data); $c++) {
                                    if(stristr($data[$c],"Page size") == true) {
                                    $string             = preg_replace('/\s+/', '', $data[$c]);
                                    $string             = str_replace('Pagesize:','',$string);
                                    $string             = strstr($string,'pts',true);
                                    $strArr             = explode('x',$string);
                                    $plan->file_width   = round($strArr[0]/72);
                                    $plan->file_height  = round($strArr[1]/72);
                                    }
                                }
                                
                                if(file_exists($file) && $filename != ''){
                                    unlink($file);
                                }
                                
                                $plan->file_name    = $filename;
                            }
                            $plan->plan_name                 = $opt['plan_name'][$i];
                            $plan->project_id                = $id;
                            $plan->cat_id                    = $category_id;
                            $plan->save();
                            
                            
                        }else{
                            $plan                            = new Plan;
                            if (array_key_exists('file_name',$opt)) {
                                
                                $filename = md5(microtime()).'.'.$opt['file_name'][$i]->getClientOriginalExtension();
                                $opt['file_name'][$i]->move(public_path('uploads/project/plan/'), $filename);
                                $file = public_path("uploads/project/plan/".$filename);
                                $this->fileupload($file , 'uploads/project/plan/' , $filename);
                                
                                $output     = shell_exec('pdfinfo '.$file);
                                $data       = explode("\n", $output);
                                //dd($data);
                                for($c=0; $c < count($data); $c++) {
                                    if(stristr($data[$c],"Page size") == true) {
                                        
                                    $string             = preg_replace('/\s+/', '', $data[$c]);
                                    $string             = str_replace('Pagesize:','',$string);
                                    $string             = strstr($string,'pts',true);
                                    $strArr             = explode('x',$string);
                                    $plan->file_width   = round($strArr[0]/72);
                                    $plan->file_height  = round($strArr[1]/72);
                                    }
                                }
                                
                                if(file_exists($file) && $filename != ''){
                                    unlink($file);
                                }
                                $plan->file_name = $filename;
                            }
                            $plan->plan_name                 = $opt['plan_name'][$i];
                            $plan->project_id                = $id;
                            $plan->cat_id                    = $category_id;
                            $plan->save();
                            
                        }
                    }
                }
                
                
                $is_save_track = Tracking::where('project_id','=', $id)->get();
                if(count($is_save_track) > 0)
                {
                    foreach($is_save_track as $st){
                        $st->seen_change = '1';
                        $st->updated_at = date('Y-m-d H:i:s');
                        $st->save();
                    }
                }
                
                
                return Redirect::route('admin_project_speces',$id)->with('success','Plan Successfully updated');
        }
        
        $data['plans']              = Plan::where('project_id',$id)->groupBy('cat_id')->get();
        $data['plan_category']      = [''=>'Select Plan Category'] + Plan_category::orderBy('name','ASC')->pluck('name','id')->all();
        $data['projectDetails']     = Project::find($id);
        return view('admin.project.plan',$data);
    }
    
    public function plan_lists(Request $request){
        $project_id = $request->project_id;
        $projects              = Plan::where('project_id',$project_id)->orderBy('plan_name','ASC')->groupBy('cat_id')->get();
        
        foreach($projects as $p){
            $p->plans = Plan::where('project_id',$project_id)->orderBy('plan_name','ASC')->where('cat_id',$p->cat_id)->get();
        }
        $projects =  response()->json($projects);
        return $projects;
    }
    
    public function plan_remove(Request $request){
        $project_id =  $request->project_id;
        $cat_id = $request->cate_id;
        $plans = Plan::where('project_id',$project_id)->where('cat_id',$cat_id)->get();
        foreach($plans as $plan){
            if(\Helpers::isFileExist('uploads/project/plan/'.$plan->file_name) && $plan->file_name != ''){
                $this->removeFile('uploads/project/plan/'.$plan->file_name);
                $images = $plan->file_images;
                if($images != ''){
                    $images = explode(',',$images);
                    foreach($images as $i){
                        $file = public_path("uploads/project/plan/images/".$i);
                        @unlink($file);
                    }
                }
            }
            $plan->delete();
        }
        return response()->json(['code'=>1,'msg'=>'plan is removed successfully']);
       
    }
    
    public function plan_delete_individual(Request $request){
        
        $plan_id = $request->plan_id;
        $plan = Plan::find($plan_id);
        if(\Helpers::isFileExist('uploads/project/plan/'.$plan->file_name) && $plan->file_name != ''){
            $this->removeFile('uploads/project/plan/'.$plan->file_name);
            $images = $plan->file_images;
            if($images != ''){
                $images = explode(',',$images);
                foreach($images as $i){
                    $file = public_path("uploads/project/plan/images/".$i);
                    @unlink($file);
                }
            }
        }
        
        $plan->delete();
        return response()->json(['code'=>1,'msg'=>'plan is removed successfully']);
    }
    
    public function delete_multiple_plans(Request $request){
        $plans      = rtrim($request->plans,',');
        $plans      = Plan::whereIn('id',explode(',',$plans))->get();
        foreach($plans as $plan){
            if(\Helpers::isFileExist('uploads/project/plan/'.$plan->file_name) && $plan->file_name != ''){
                $this->removeFile('uploads/project/plan/'.$plan->file_name);
                $images = $plan->file_images;
                if($images != ''){
                    $images = explode(',',$images);
                    foreach($images as $i){
                        $file = public_path("uploads/project/plan/images/".$i);
                        @unlink($file);
                    }
                }
            }
            $plan->delete();
        }
    }
    
    public function project_upload_pdf(Request $request){
        $fileInfo = pathinfo($request->file_name);
        $plan_name = $fileInfo['filename'];
        $id = $request->project_id;
        $category_id = $request->category_id;
        $plan                            = new Plan;
        $files                          = $request->image;
        $file_arr = explode(';',$files);
        
        $ext = 'pdf';
        $files = str_replace(array('data:application/pdf;base64,'),array(''),$files);
        $files = str_replace(array('data:application/force-download;base64,'),array(''),$files);
        $files = str_replace(array('data:application/x-unknown;base64,'),array(''),$files);
        $file = base64_decode($files);
        $extension      = $ext;
        $filename = md5(microtime()).'.'.$extension;
        //$files->move(public_path('uploads/project/plan/'), $filename);
        file_put_contents(public_path('uploads/project/plan/'.$filename), $file);
        
        $file = public_path("uploads/project/plan/".$filename);
        $this->fileupload($file , 'uploads/project/plan/' , $filename);
        
        $output     = shell_exec('pdfinfo '.$file);
        $data       = explode("\n", $output);
        //dd($data);
        for($c=0; $c < count($data); $c++) {
            if(stristr($data[$c],"Page size") == true) {
                
            $string             = preg_replace('/\s+/', '', $data[$c]);
            $string             = str_replace('Pagesize:','',$string);
            $string             = strstr($string,'pts',true);
            $strArr             = explode('x',$string);
            $plan->file_width   = round($strArr[0]/72);
            $plan->file_height  = round($strArr[1]/72);
            }
        }
        
        
        $plan->file_name = $filename;
       
        $plan->plan_name                 = $plan_name;
        $plan->project_id                = $id;
        $plan->cat_id                    = $category_id;
        $plan->save();
        
        if(file_exists($file) && $filename != ''){
                $PdfFile = $file;
                $im = new \imagick($PdfFile); 
                $pages = $im->getNumberImages();
                $imageName = array();
                for ($p=0;$p<$pages;$p++){
                    $im->setResolution(100,100);
                    $im->setCompressionQuality(50); 
                    $im->readImage($PdfFile."[".$p."]");    //yourfile.pdf[0], yourfile.pdf[1], ...
                    $im->setImageFormat( "jpg" );
                    $image_out = $plan->id."_".$p.".jpg";
                    //$im = $im->flattenImages();
                    
                    if ($im->getImageAlphaChannel()) {
                        // Remove alpha channel
                        $im->setImageAlphaChannel(11);

                        // Set image background color
                        $im->setImageBackgroundColor('white');
                    }
                    $file = public_path("uploads/project/plan/images/".$image_out);
                    $im->writeImage($file);
                    $imageName[]=$image_out;
                }
                
                //$im->clear();
                //$im->destroy();
                $image_list = implode(",",$imageName);
                $plan->file_images = $image_list;
                $plan->save();

                unlink($PdfFile);
            }

        echo json_encode(['id'=>$plan->id,'project_id'=>$plan->project_id,'cate_id'=>$plan->cat_id,'plan_name'=>$plan->plan_name]);
        
    }

   
    public function speces_update(Request $request, $id){
        $data                   = array();
        
        $data['spece_category']     = [''=>'Select Category']+Specs_category::orderBy('name','ASC')->pluck('name','id')->all();
        $data['projectDetails']     = Project::find($id);
    
        return view('admin.project.speces',$data);
    }
    
    public function rules($request)
    {
      $rules = '';
      foreach($request->name as $key => $val)
      {
        $rules['name.'.$key] = 'required';
      }
      foreach($request->speces_category as $key => $val)
      {
        $rules['speces_category.'.$key] = 'required';
      }
      if(count($request->file_name) > 0){
        foreach($request->file_name as $key => $val)
        {
          $rules['file_name.'.$key] = 'mimes:pdf';
        }
      }
      return $rules;
    }
    //public function messages()
    //{
    //  $messages = [];
    //  foreach($this->request->get('items') as $key => $val)
    //  {
    //    $messages['items.'.$key.'.max'] = 'The field labeled "Book Title '.$key.'" must be less than :max characters.';
    //  }
    //  return $messages;
    //}
    public function delete($id){
        
        $project = Project::find($id);
        
        //if(file_exists(public_path('uploads/project/documents/'.$project->documents)) && $project->documents != ''){
        //    unlink(public_path('uploads/project/documents/'.$project->documents));
        //}
        
        if(count($project->specs)>0){
            foreach($project->specs as $specs){
                if(\Helpers::isFileExist('uploads/project/specs/'.$specs->file_name) && $specs->file_name != ''){
                    $this->removeFile('uploads/project/specs/'.$specs->file_name);
                }
            }
        }
        Project::where('id',$id)->delete();
        
        return Redirect::route('admin_project')->with('success','Project deleted Successfully');
    
        
    
    }
    
    public function delete_speces($id,$project_id){
        $specs = Specs::find($id);
        
         if(\Helpers::isFileExist('uploads/project/specs/'.$specs->file_name) && $specs->file_name != ''){
                    $this->removeFile('uploads/project/specs/'.$specs->file_name);
        }
                
        //if(file_exists(public_path('uploads/project/specs/'.$specs->file_name)) && $specs->file_name != ''){
        //    unlink(public_path('uploads/project/specs/'.$specs->file_name));
        //}
        Specs::where('id',$id)->delete();
        
        return Redirect::route('admin_project_speces',array($project_id))->with('success','Speces  deleted Successfully');
    }
    
    public function edit(Request $request,$id){
        $data                   = array();
        //echo $id;
        
        if($request->action == "Process"){
            $validator = Validator::make($request->all(),
                                        ['name'            => 'required',
                                         'category_id'     => 'required',
                                         'type_id'         => 'required',
                                         'status'          => 'required']);
           if($validator->fails()){
               $message = $validator->messages();
               return Redirect::back()->withErrors($validator)->withInput();
           }else{
               $project                            = Project::find($id);
               $project->name                      = $request->name;
               $project->category_id               = $request->category_id;
               if($request->type_id != ''){
               $project->type_id                   = $request->type_id;
               }
               $bid_close_date                     = explode('/',$request->bid_close_date);
               $project->bid_close_date            = $bid_close_date[2].'-'.$bid_close_date[0].'-'.$bid_close_date[1];
               $project->time_due                  = date('H:i:s',strtotime($request->time_due));
               $project->mandatory_pre_bidding     = $request->mandatory_pre_bidding; 
               if($request->pre_bid_meeting_date != ''){
               $pre_bid_meeting_date               = explode('/',$request->pre_bid_meeting_date);
               $project->pre_bid_meeting_date      = $pre_bid_meeting_date[2].'-'.$pre_bid_meeting_date[0].'-'.$pre_bid_meeting_date[1];
               }
               $project->pre_bid_meeting_time      = ($request->pre_bid_meeting_time !='')?date('H:i:s',strtotime($request->pre_bid_meeting_time)):'';
               $project->valuation                 = $request->valuation;
               $project->description               = $request->description;
               $project->additional_comments       = $request->additional_comments;
               
               if($request->trade != ''){
                $project->trade                     = implode(',',$request->trade);
               }
               $project->status                    = $request->status;
               //if ($request->hasFile('documents')) {
               //     
               //     $removeFilePath  = '';
               //     if(\Helpers::isFileExist('uploads/project/documents/'.$project->documents) && $project->documents != ''){
               //         $removeFilePath = 'uploads/project/documents/'.$project->documents;
               //     }
               //     
               //     $filename = time().$request->documents->getClientOriginalName();
               //     $request->documents->move(public_path('uploads/project/documents/'), $filename);
               //     $file = public_path("uploads/project/documents/".$filename);
               //     $this->fileupload($file , 'uploads/project/documents/' , $filename ,$removeFilePath);
               //     
               //     if(file_exists($file) && $filename != ''){
               //         unlink($file);
               //     }
               //     
               //     $project->documents = $filename;
               //}
               $project->save();
               
                $is_save_track = Tracking::where('project_id','=', $id)->get();
               
                
                if(count($is_save_track) > 0)
                {
                    foreach($is_save_track as $st){
                        $st->seen_change = '1';
                        $st->updated_at = date('Y-m-d H:i:s');
                        $st->save();
                    }
                }
               
               return Redirect::route('admin_project_awarded_to',array($project->id))->with('success','Details Updated Successfully!');
           }
        }

        $data['category']       = [''=>'Select Category'] + Category::orderBy('name','ASC')->pluck('name','id')->all();
        $data['type']           = [''=>'Select Type'] + Type::orderBy('name','ASC')->pluck('name','id')->all();
        $data['plan_trade']     = Trade::get();
        $data['projectDetails'] = Project::find($id);
        
        return view('admin.project.edit',$data);
    }
    
    public function details($id){
        $data['projectDetails'] = Project::find($id);
        return view('admin.project.details',$data);
    }
    public function awarded_to_view($id){
        $data['projectDetails'] = Project::find($id);
        return view('admin.project.awarded_to_view',$data);
    }
    public function address_view($id){
        $data['projectDetails'] = Project::find($id);
        return view('admin.project.address_view',$data);
    }
    public function principle_view($id){
        $data['projectDetails'] = Project::find($id);
        return view('admin.project.principle_view',$data);
    }
    public function contrctor_view($id){
        $data['projectDetails'] = Project::find($id);
        return view('admin.project.contrctor_view',$data);
    }
    public function plan_view($id){
        
        $data['projectDetails'] = Project::find($id);
        return view('admin.project.plan_view',$data);
    }
    public function speces_view($id){
        $data['projectDetails'] = Project::find($id);
        return view('admin.project.speces_view',$data);
    }    

    public function getContractor(Request $request){
        $record         = 0;
        $contractor     = Contractor::where('business_name','LIKE','%'.$request->term.'%')->orderBy('id','desc')->limit(5)->get();
        $result         = array();
        if(count($contractor)){
            foreach ($contractor as $k=>$c) {
                $record                 = $k + 1;
                $result[$record]['value']    = $c->business_name;
                $result[$record]['id']       = $c->id;
                $result[$record]['label']    = $c->business_name;
                $result[$record]['type']     = 'contractor';
            }
        }
        
        $bidder     = Bidder::where('contact','LIKE','%'.$request->term.'%')->orderBy('id','desc')->limit(5)->get();
        if(count($bidder)){
            foreach ($bidder as $k=>$c) {
                $record                 = $record + 1;
                $result[$record]['value']    = $c->contact;
                $result[$record]['id']       = $c->id;
                $result[$record]['label']    = $c->contact;
                $result[$record]['type']     = 'bidder';
            }
        }
        
        if($record == 0){
            $result[0]['label'] = 'Contractor not found';
            $result[0]['value'] = "error";
        }
        
        echo json_encode($result);
    }
    
    
    public function getOnlyContractor(Request $request){
        $contractor     = Contractor::where('business_name','LIKE','%'.$request->term.'%')->orderBy('id','desc')->limit(5)->get();
        $result         = array();
        if(count($contractor)){
            foreach ($contractor as $k=>$c) {
                $result[$k]['value']    = $c->business_name;
                $result[$k]['id']       = $c->id;
                $result[$k]['label']    = $c->business_name;
            }
        }else{
            $result[0]['label'] = 'Contractor not found';
            $result[0]['value'] = "error";
        }
        
        echo json_encode($result);
    }
    
    public function deleteAssignContractor($id){
        $project = Contractor_assign::find($id);
        $project->delete();
        return Redirect::route('admin_project_contractor',$project->project_id)->with('success','Removed from assign list');
    }
    
    
    public function spece_lists(Request $request){
        $project_id             = $request->project_id;
        $projects               = Specs::where('project_id',$project_id)->groupBy('spec_cat_id')->get();
        
        foreach($projects as $p){
            $p->plans = Specs::where('project_id',$project_id)->where('spec_cat_id',$p->spec_cat_id)->get();
        }
        $projects =  response()->json($projects);
        return $projects;
    }
    
    public function spece_remove(Request $request){
        $project_id     =  $request->project_id;
        $cat_id         = $request->cate_id;
        $specs          = Specs::where('project_id',$project_id)->where('spec_cat_id',$cat_id)->get();
        foreach($specs as $spec){
            if(\Helpers::isFileExist('uploads/project/specs/'.$spec->file_name) && $spec->file_name != ''){
                $this->removeFile('uploads/project/specs/'.$spec->file_name);
            }
            $spec->delete();
        }
        return response()->json(['code'=>1,'msg'=>'Specs is removed successfully']);
       
    }
    
    public function spece_delete_individual(Request $request){
        
        $plan_id    = $request->plan_id;
        $plan       = Specs::find($plan_id);
        if(\Helpers::isFileExist('uploads/project/specs/'.$plan->file_name) && $plan->file_name != ''){
            $this->removeFile('uploads/project/specs/'.$plan->file_name);
        }
        $plan->delete();
        return response()->json(['code'=>1,'msg'=>'plan is removed successfully']);
    }
    
    public function delete_multiple_specs(Request $request){
        $plans      = rtrim($request->plans,',');
        $plans      = Specs::whereIn('id',explode(',',$plans))->get();
        foreach($plans as $plan){
            if(\Helpers::isFileExist('uploads/project/specs/'.$plan->file_name) && $plan->file_name != ''){
                $this->removeFile('uploads/project/specs/'.$plan->file_name);
            }
            $plan->delete();
        }
    }
    
    
    public function spece_upload_pdf(Request $request){
        $fileInfo           = pathinfo($request->file_name);
        $plan_name          = $fileInfo['filename'];
        $id                 = $request->project_id;
        $category_id        = $request->category_id;
        $spec               = new Specs;
        $files              = $request->image;
        $file_arr           = explode(';',$files);
            
        $ext = 'pdf';
        $files = str_replace(array('data:application/pdf;base64,'),array(''),$files);
        $files = str_replace(array('data:application/force-download;base64,'),array(''),$files);
        $files = str_replace(array('data:application/x-unknown;base64,'),array(''),$files);
        $file = base64_decode($files);
        $extension      = $ext;
        $filename = md5(microtime()).'.'.$extension;
        //$files->move(public_path('uploads/project/plan/'), $filename);
        file_put_contents(public_path('uploads/project/specs/'.$filename), $file);
        
        $file = public_path("uploads/project/specs/".$filename);
        $this->fileupload($file , 'uploads/project/specs/' , $filename);
        
        
        $spec->file_name                    = $filename;
        $spec->name                         = $plan_name;
        $spec->project_id                   = $id;
        $spec->spec_cat_id                  = $category_id;
        $spec->save();
        
        @unlink($file);

        echo json_encode(['id'=>$spec->id,'project_id'=>$spec->project_id,'cate_id'=>$spec->spec_cat_id,'plan_name'=>$spec->name]);
        
    }
}
