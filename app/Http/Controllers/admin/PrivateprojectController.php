<?php

namespace App\Http\Controllers\admin;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use App\Private_company, App\Private_project, App\Private_plan_categories, App\Private_plans, App\Private_specs_categories, App\Private_specs, App\Private_users, App\Private_planroom_assigns,App\Sitesetting, App\Private_company_assign;
use \Validator,\Redirect;
use Image;

class PrivateprojectController extends Controller
{
    public function index(Request $request){
        $data['keyword']        = '';
        $data['company']        = '';
        $data['status']         = '';
        $data['project_type']   = '';
        if($request->keyword !='' || $request->company != '' || $request->status != '' || $request->project_type != ''){
            $data['keyword']            = $request->keyword;
            $data['company']            = $request->company;
            $data['status']             = $request->status;
            $data['project_type']       = $request->project_type;
            $data['lists'] = Private_project::where(function($query) use ($data) {
                
                                if($data['company'] != ''){
                                $query->where('company_id',$data['company']);
                                }
                                if($data['status'] != ''){
                                $query->where('status',$data['status']);
                                }
                                if($data['project_type'] != ''){
                                $query->where('view_status',$data['project_type']);
                                }
                                if($data['keyword'] != ''){
                                $query->where('project_name','like','%'.$data['keyword'].'%');
                                $query->orWhere('status','like','%'.$data['keyword'].'%');
                                $query->orWhere('project_id','like','%'.$data['keyword'].'%');
                                }
                            })
                            ->orderBy('project_id','desc')->paginate(10);
        }
        else{
            $data['lists'] = Private_project::orderBy('project_id','desc')->paginate(10);
        }
        $data['companies']       = [''=>'Select Private Company'] + Private_company::where('user_type','company')->pluck('company_name','id')->all();
        
        return view('admin.private.project.list',$data);
    }
    
    
    public function company(Request $request){
        $data                           = array();
        if($request->action == "Process"){
            $validator = Validator::make($request->all(),['company'         => 'required']);
            if($validator->fails()){
               $message = $validator->messages();
               return Redirect::back()->withErrors($validator)->withInput();
            }else{
                if($request->company != 'other'){
                    $project = new Private_project();
                    $project->company_id                  = $request->company;
                    $project->save();
                    $project->project_id  = 10000 + $project->id;
                    $project->save();
                    return Redirect::route('admin_private_project_details',[$project->id])->with('success','Company details updated successfully');
                }else{
                    $validator = Validator::make($request->all(),
                                                ['company_name'         => 'required|unique:private_companies,company_name',
                                                 'first_name'           => 'required',
                                                 'last_name'            => 'required',
                                                 'email'                => 'email|required|unique:private_companies,email',
                                                 'password'             => 'required',
                                                 'phone_no'             => 'required',
                                                 'domain'               => 'url',
                                                 'logo'                 => 'required|image|mimes:jpeg,png,jpg,gif,svg',]);
                    if($validator->fails()){
                       $message = $validator->messages();
                       return Redirect::back()->withErrors($validator)->withInput();
                    }else{
                       $company                              = new Private_company;
                       $project = new Private_project(); 
                       
                       if ($request->hasFile('logo')) {
                        
                        $logo = $request->file('logo');
                        $imagename = time().'.'.$logo->getClientOriginalExtension(); 
                   
                        $destinationPath = public_path('/uploads/private_planroom/company_logo/thumb');
                        $thumb_img = Image::make($logo->getRealPath())->resize(130, 60);
                        $thumb_img->save($destinationPath.'/'.$imagename,80);
                                    
                        $destinationPath = public_path('/uploads/private_planroom/company_logo');
                        $logo->move($destinationPath, $imagename);
                        $company->logo = $imagename;
                       }
                       $company->user_type                   = 'company';
                       $company->company_name                = $request->company_name;
                       $company->first_name                  = $request->first_name;
                       $company->last_name                   = $request->last_name;
                       $company->email                       = $request->email;
                       $company->password                    = $request->password;
                       $company->phone_no                    = $request->phone_no;
                       $company->domain                      = $request->domain;
                       $company->save();
                       $project->company_id                  = $company->id;
                       
                       $project->save();
                
                       $project->project_id  = 10000 + $project->id;
                       $project->save();
                
                        $setting_email_value    = Sitesetting::find(1);
                        $data['from_email']     = $setting_email_value->sitesettings_value;
                        $data['from_name']      = '';
                        $data['to_email']       = $request->email;
                        $data['first_name']     = $request->first_name;
                        $data['password']       = $request->password;
                        $data['company_slug']   = $company->company_slug;
                        $data['domain']         = $company->domain;
                        
                        \Mail::send('emails.company_create', $data, function ($message) use ($data) {
                            $message->from($data['from_email'], $data['from_name']);
                            $message->subject('Company Added successfully!!');
                            $message->to($data['to_email'] );
                        });
                        
                        return Redirect::route('admin_private_project_details',[$project->id])->with('success','Company details updated successfully');
                    }
                }
            }
        }
        $data['companies'] = [''=>'Select Company']+Private_company::where('user_type','company')->pluck('company_name','id')->all()+['other'=>'Create New Company'];
        return view('admin.private.project.company',$data);
    }
    

    public function company_edit(Request $request,$id){
        $data               = array();
        $project            = Private_project::find($id); 
        if($request->action == "Process"){
            $validator = Validator::make($request->all(),['company'         => 'required']);
            if($validator->fails()){
               $message = $validator->messages();
               return Redirect::back()->withErrors($validator)->withInput();
            }else{
                if($request->company != 'other'){
                    $project->company_id        = $request->company;
                    $project->save();
                    return Redirect::route('admin_private_project_details',[$id])->with('success','Company details updated successfully');
                }else{
                    $validator = Validator::make($request->all(),
                                                ['company_name'         => 'required|unique:private_companies,company_name',
                                                 'first_name'           => 'required',
                                                 'last_name'            => 'required',
                                                 'email'                => 'email|required|unique:private_companies,email',
                                                 'password'             => 'required',
                                                 'phone_no'             => 'required',
                                                 'domain'               => 'url',
                                                 'logo'                 => 'required|image|mimes:jpeg,png,jpg,gif,svg',]);
                    if($validator->fails()){
                       $message = $validator->messages();
                       return Redirect::back()->withErrors($validator)->withInput();
                    }else{
                       $company                              = new Private_company;
                       
                       if ($request->hasFile('logo')) {
                        
                        $logo = $request->file('logo');
                        $imagename = time().'.'.$logo->getClientOriginalExtension(); 
                   
                        $destinationPath = public_path('/uploads/private_planroom/company_logo/thumb');
                        $thumb_img = Image::make($logo->getRealPath())->resize(130, 60);
                        $thumb_img->save($destinationPath.'/'.$imagename,80);
                                    
                        $destinationPath = public_path('/uploads/private_planroom/company_logo');
                        $logo->move($destinationPath, $imagename);
                        $company->logo = $imagename;
                       }
                       $company->user_type                   = 'company';
                       $company->company_name                = $request->company_name;
                       $company->first_name                  = $request->first_name;
                       $company->last_name                   = $request->last_name;
                       $company->email                       = $request->email;
                       $company->password                    = $request->password;
                       $company->phone_no                    = $request->phone_no;
                       $company->domain                      = $request->domain;
                       $company->save();
                       
                       $project->company_id                  = $company->id;
                       $project->save();
                       
                        $setting_email_value    = Sitesetting::find(1);
                        $data['from_email']     = $setting_email_value->sitesettings_value;
                        $data['from_name']      = '';
                        $data['to_email']       = $request->email;
                        $data['first_name']     = $request->first_name;
                        $data['password']       = $request->password;
                        $data['company_slug']   = $company->company_slug;
                        $data['domain']         = $company->domain;
                        
                        \Mail::send('emails.company_create', $data, function ($message) use ($data) {
                            $message->from($data['from_email'], $data['from_name']);
                            $message->subject('Company Added successfully!!');
                            $message->to($data['to_email'] );
                        });
                        
                        return Redirect::route('admin_private_project_details',[$id])->with('success','Company details updated successfully');
                    }
                }
            }
        }
        $data['details']        = $project;
        $data['companies']      = [''=>'Select Company']+Private_company::where('user_type','company')->pluck('company_name','id')->all()+['other'=>'Others'];
        return view('admin.private.project.company_edit',$data);
    }
    
    public function details(Request $request,$id){
        $data                           = array();
        $project                        = Private_project::find($id);
        
            if($request->action == "Process"){
            $validator = Validator::make($request->all(),
                                        ['project_name'         => 'required',
                                         'close_date'           => 'required',
                                         'time_due'             => 'required',
                                         'location'             => 'required',
                                         'description'          => 'required']);
           if($validator->fails()){
               $message = $validator->messages();
               return Redirect::back()->withErrors($validator)->withInput();
           }else{
               $project                             = Private_project::find($id);
               $project->project_name               = $request->project_name;
               $close_date                          = explode('/',$request->close_date);
               $project->close_date                 = $close_date[2].'-'.$close_date[0].'-'.$close_date[1];
               $project->time_due                   = date('H:i:s',strtotime($request->time_due));
               
               if($request->prebid_meeting_date != ''){
               $prebid_meeting_date                 = explode('/',$request->prebid_meeting_date);
               $project->prebid_meeting_date        = $prebid_meeting_date[2].'-'.$prebid_meeting_date[0].'-'.$prebid_meeting_date[1];
               }
               $project->prebid_meeting_time        = ($request->prebid_meeting_time !='')?date('H:i:s',strtotime($request->prebid_meeting_time)):'';
               $project->location                   = $request->location;
               $project->description                = $request->description;
               $project->view_status                = $request->view_status;
               $project->status                     = $request->status;
               $project->save();
               if($project->view_status == 'Public' && $project->is_email_send == 'No'){
                    $user = Private_company_assign::where('company_id',$project->company->id)->get();
                    if(count($user) > 0){
                        foreach($user as $u){
                            $setting_email_value    = Sitesetting::find(1);
                            $data['from_email']     = $setting_email_value->sitesettings_value;
                            $data['from_name']      = '';
                            $data['to_email']       = $u->assign_user->email;
                            $data['project_name']   = $project->project_name;
                            $data['company_slug']   = \URL::route('public_planroom_list_for_user',$project->company->company_slug);
                            \Mail::send('emails.private_planroom_create', $data, function ($message) use ($data) {
                                $message->from($data['from_email'], $data['from_name']);
                                $message->subject('New Project Added to Your Planroom');
                                $message->to($data['to_email'] );
                            });
                        }
                    }
                    $project->is_email_send  = 'Yes';
                    $project->save();
               }
               
               return Redirect::route('admin_private_project_plans',array($project->id))->with('success','Details Updated Successfully!');
           }
        }
        $data['details']                = $project;
        return view('admin.private.project.details',$data);
    }
    
    public function plan_update(Request $request, $id){
        $data                       = array();        
        $data['plan_category']      = [''=>'Select Plan Category'] + Private_plan_categories::pluck('name','id')->all();
        $data['details']            = Private_project::find($id);
        return view('admin.private.project.plan',$data);
    }
    
    public function speces_update(Request $request, $id){
        $data                   = array();        
        $data['spece_category']     = [''=>'Select Category']+Private_specs_categories::pluck('name','id')->all();
        $data['details']            = Private_project::find($id);
    
        return view('admin.private.project.speces',$data);
        
    }
    
    public function rules($request){
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
    
    public function delete($id){
        
        $project = Private_project::find($id);
        
        if(count($project->specs)>0){
            foreach($project->specs as $specs){
                if(\Helpers::isFileExist('uploads/private_planroom/specs/'.$specs->file_name) && $specs->file_name != ''){
                    $this->removeFile('uploads/private_planroom/specs/'.$specs->file_name);
                }
            }
        }
        if(count($project->plan)>0){
            foreach($project->plan as $plan){
                if(\Helpers::isFileExist('uploads/private_planroom/plan/'.$plan->file_name) && $plan->file_name != ''){
                    $this->removeFile('uploads/private_planroom/plan/'.$plan->file_name);
                }
            }
        }
        if(count($project->company)>0){
            if(file_exists(public_path('uploads/private_planroom/company_logo/'.$project->company))){
                unlink(public_path('uploads/private_planroom/company_logo/'.$project->company));
            }
            if(file_exists(public_path('uploads/private_planroom/company_logo/thumb/'.$project->company))){
                unlink(public_path('uploads/private_planroom/company_logo/thumb/'.$project->company));
            }
        }
        
        Private_project::where('id',$id)->delete();
        Private_company::where('id',$project->company_id)->delete();
        return Redirect::route('admin_private_project')->with('success','Private project deleted Successfully');  
    }
    

    public function assign_project(Request $request,$id){
        $data                           = array();
        if($request->action == "Process"){
                $p                          = Private_project::find($id);
                $company_id                 = $p->company_id;
                if(count($request->users) > 0){
                    $notExistUser = Private_planroom_assigns::where('project_id',$id)->where('company_id',$p->company_id)->whereNotIn('user_id',$request->users)->delete();
                    foreach($request->users as $usr){
                        $p_exist                    = Private_planroom_assigns::where('project_id',$id)->where('user_id',$usr)->where('company_id',$p->company_id)->count();
                        if($p_exist == 0 ){
                            $project                    = new Private_planroom_assigns();   
                            $project->project_id        = $id;
                            $project->company_id        = $p->company_id;
                            $project->user_id           = $usr;
                            $project->save();
                            
                            $user                   = Private_company::find($usr);
                            $setting_email_value    = Sitesetting::find(1);
                            $data['from_email']     = $setting_email_value->sitesettings_value;
                            $data['from_name']      = '';
                            $data['to_email']       = $user->email;
                            $data['project_name']   = $p->project_name;
                            $data['company_slug']   = \URL::route('public_planroom_list_for_user',$p->company->company_slug);
                            \Mail::send('emails.private_planroom_create', $data, function ($message) use ($data) {
                                $message->from($data['from_email'], $data['from_name']);
                                $message->subject('New Project Added to Your Planroom');
                                $message->to($data['to_email'] );
                            });
                        
                        }
                    }
                }else{
                    Private_planroom_assigns::where('project_id',$id)->where('company_id',$p->company_id)->delete();
                }
                return Redirect::route('admin_private_project')->with('success','User assigned successfully');
        }
        $project                    = Private_project::find($id);
        $data['details']            = $project;
        
        $data['users']              = Private_company_assign::where('company_id',$project->company_id)->get();
        //$data['users']              = Private_company::where('user_type','user')->select('id',\DB::raw('CONCAT(first_name , " ", last_name ) AS full_name'))->get();
        $data['assign_user']        = Private_planroom_assigns::select(\DB::raw("GROUP_CONCAT(user_id) as lists"))->where('project_id',$id)->first();
        return view('admin.private.project.assign_user',$data);
    }
    public function details_view($id){
        $data['details'] = Private_project::find($id);
        return view('admin.private.project.details_view',$data);
    }
    public function company_view($id){
        $data['details'] = Private_project::find($id);
        return view('admin.private.project.company_view',$data);
    }
    public function plan_view($id){
        
        $data['details'] = Private_project::find($id);
        return view('admin.private.project.plan_view',$data);
    }
    public function speces_view($id){
        $data['details'] = Private_project::find($id);
        return view('admin.private.project.speces_view',$data);
    }    

    public function plan_lists(Request $request){
        $project_id             = $request->project_id;
        $projects               = Private_plans::where('project_id',$project_id)->groupBy('cat_id')->get();
        
        foreach($projects as $p){
            $p->plans = Private_plans::where('project_id',$project_id)->where('cat_id',$p->cat_id)->get();
        }
        $projects =  response()->json($projects);
        return $projects;
    }
    
    public function plan_remove(Request $request){
        $project_id     =  $request->project_id;
        $cat_id         = $request->cate_id;
        $plans          = Private_plans::where('project_id',$project_id)->where('cat_id',$cat_id)->get();
        foreach($plans as $plan){
            if(\Helpers::isFileExist('uploads/private_planroom/plan/'.$plan->file_name) && $plan->file_name != ''){
                $this->removeFile('uploads/private_planroom/plan/'.$plan->file_name);
            }
            $plan->delete();
        }
        return response()->json(['code'=>1,'msg'=>'plan is removed successfully']);
       
    }
    
    public function plan_delete_individual(Request $request){
        
        $plan_id    = $request->plan_id;
        $plan       = Private_plans::find($plan_id);
        if(\Helpers::isFileExist('uploads/private_planroom/plan/'.$plan->file_name) && $plan->file_name != ''){
            $this->removeFile('uploads/private_planroom/plan/'.$plan->file_name);
        }
        $plan->delete();
        return response()->json(['code'=>1,'msg'=>'plan is removed successfully']);
    }
    
    
    public function project_upload_pdf(Request $request){
        $fileInfo = pathinfo($request->file_name);
        $plan_name = $fileInfo['filename'];
        $id = $request->project_id;
        $category_id = $request->category_id;
        $plan                            = new Private_plans;
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
            file_put_contents(public_path('uploads/private_planroom/plan/'.$filename), $file);
            
            $file = public_path("uploads/private_planroom/plan/".$filename);
            $this->fileupload($file , 'uploads/private_planroom/plan/' , $filename);
            
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
                //$im = new \imagick($PdfFile); 
                //$pages = $im->getNumberImages();
                //$imageName = array();
                //for ($p=0;$p<$pages;$p++){
                //    $im->setResolution(200,200);
                //    $im->setCompressionQuality(90); 
                //    $im->readImage($PdfFile."[".$p."]");    //yourfile.pdf[0], yourfile.pdf[1], ...
                //    $im->setImageFormat( "jpg" );
                //    $image_out = $plan->id."_".$p.".jpg";
                //    //$im = $im->flattenImages();
                //    $file = public_path("uploads/private_planroom/plan/images/".$image_out);
                //    $im->writeImage($file);
                //    $imageName[]=$image_out;
                //}
                //
                ////$im->clear();
                ////$im->destroy();
                //$image_list = implode(",",$imageName);
                //$plan->file_images = $image_list;
                //$plan->save();

                unlink($PdfFile);
            }

        echo json_encode(['id'=>$plan->id,'project_id'=>$plan->project_id,'cate_id'=>$plan->cat_id,'plan_name'=>$plan->plan_name]);
        
        
    }
    
    public function spece_lists(Request $request){
        $project_id             = $request->project_id;
        $projects               = Private_specs::where('project_id',$project_id)->groupBy('spec_cat_id')->get();
        
        foreach($projects as $p){
            $p->plans = Private_specs::where('project_id',$project_id)->where('spec_cat_id',$p->spec_cat_id)->get();
        }
        $projects =  response()->json($projects);
        return $projects;
    }
    
    public function spece_remove(Request $request){
        $project_id     =  $request->project_id;
        $cat_id         = $request->cate_id;
        $specs          = Private_specs::where('project_id',$project_id)->where('spec_cat_id',$cat_id)->get();
        foreach($specs as $spec){
            if(\Helpers::isFileExist('uploads/private_planroom/specs/'.$spec->file_name) && $spec->file_name != ''){
                $this->removeFile('uploads/private_planroom/specs/'.$spec->file_name);
            }
            $spec->delete();
        }
        return response()->json(['code'=>1,'msg'=>'Specs is removed successfully']);
       
    }
    
    public function spece_delete_individual(Request $request){
        
        $plan_id    = $request->plan_id;
        $plan       = Private_specs::find($plan_id);
        if(\Helpers::isFileExist('uploads/private_planroom/specs/'.$plan->file_name) && $plan->file_name != ''){
            $this->removeFile('uploads/private_planroom/specs/'.$plan->file_name);
        }
        $plan->delete();
        return response()->json(['code'=>1,'msg'=>'plan is removed successfully']);
    }
    
    
    public function spece_upload_pdf(Request $request){
        $fileInfo           = pathinfo($request->file_name);
        $plan_name          = $fileInfo['filename'];
        $id                 = $request->project_id;
        $category_id        = $request->category_id;
        $spec               = new Private_specs;
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
        file_put_contents(public_path('uploads/private_planroom/specs/'.$filename), $file);
        
        $file = public_path("uploads/private_planroom/specs/".$filename);
        $this->fileupload($file , 'uploads/private_planroom/specs/' , $filename);
        
        
        $spec->file_name                    = $filename;
        $spec->name                         = $plan_name;
        $spec->project_id                   = $id;
        $spec->spec_cat_id                  = $category_id;
        $spec->save();
        
        @unlink($file);

        echo json_encode(['id'=>$spec->id,'project_id'=>$spec->project_id,'cate_id'=>$spec->spec_cat_id,'plan_name'=>$spec->name]);
        
    }
}
