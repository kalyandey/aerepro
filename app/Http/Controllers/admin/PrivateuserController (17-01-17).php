<?php

namespace App\Http\Controllers\admin;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;

use App\Private_company, App\Private_project,App\Sitesetting, App\Private_planroom_assigns,App\Private_company_assign;
use \Redirect, \Validator;

class PrivateuserController extends Controller
{
                            
    public function lists(Request $request){
        $data['key']        = $request->key;
        $data['company']    = $request->company;
        if($data['key'] !='' || $data['company']  != ''){
            $data['lists']  = Private_company::where('user_type','user')->where(function($query) use ($data) {
                
                                if($data['company'] != ''){
                                    
                                    $products = $query->whereHas('assign_user', function ($q) use ($data)
                                    {
                                        $q->where('private_company_assigns.company_id', $data['company']);
                                    });
                                }
                                if($data['key'] != ''){
                                    $query->where('first_name','LIKE','%'.$data['key'].'%');
                                    $query->orWhere('last_name','LIKE','%'.$data['key'].'%');
                                    $query->orWhere('email','LIKE','%'.$data['key'].'%');
                                }
                                })->paginate(10);
        }else{
            $data['lists']  = Private_company::where('user_type','user')->paginate(10);
        }
        $data['companies'] = ['' => 'select Company'] +Private_company::where('user_type','company')->pluck('company_name','id')->all();
        return view('admin.private.user.index',$data);
    }
    public function add($id=''){
        $data = array();
        $data['project']   = [];
        $data['companies'] = Private_company::where('user_type','company')->pluck('company_name','id')->all();
        if($id != ''){
            $data['project'] = Private_project::find($id);
        }
        return view('admin.private.user.add',$data);
    }
    public function create(Request $request){
      $validator = Validator::make(
				  $request->all(),
				   [
                                     'company'           => 'required',
				     'first_name'        => 'required',
				     'last_name'         => 'required',
				     'email'		 => 'required|unique:private_companies',
                                     'phone'             => 'required',
                                     'address'           => 'required'
				   ]
		    );
	    
	    if ($validator->fails()){
		    $messages = $validator->messages();
		    return Redirect::back()->withErrors($validator->errors())->withInput();
	    }else{
                
                $newUser                    = new Private_company();
                $newUser->user_type         = 'user';
                $newUser->first_name        = $request->first_name;
                $newUser->last_name         = $request->last_name;
                $newUser->email             = $request->email;
                $newUser->password          = $request->password;
                $newUser->phone_no          = $request->phone;
                $newUser->address           = $request->address;
                $newUser->save();
                
                $assign                    = new Private_company_assign();
                $assign->user_id           = $newUser->id;
                $assign->company_id        = $request->company;
                $assign->save();
                
                
                $setting_email_value    = Sitesetting::find(1);
                $data['from_email']     = $setting_email_value->sitesettings_value;
                $data['from_name']      = '';
                $data['to_email']       = $request->email;
                $data['first_name']     = $request->first_name;
                $data['password']       = $request->password;
                $data['company']        = $assign->assign_company->company_name;
                $data['company_slug']   = $assign->assign_company->company_slug;
                $data['domain']         = $assign->assign_company->domain;
                \Mail::send('emails.private_user_create', $data, function ($message) use ($data) {
                    $message->from($data['from_email'], $data['from_name']);
                    $message->subject('Your profile is added to '.$data['company']);
                    $message->to($data['to_email'] );
                });
                
                
                if($request->project_id != ''){
                    
                    $project                    = new Private_planroom_assigns();   
                    $project->project_id        = $request->project_id;
                    $project->company_id        = $request->company;
                    $project->user_id           = $newUser->id;
                    $project->save();
                    
                    $p                       = Private_project::find($request->project_id);
                    $data1['from_email']     = $setting_email_value->sitesettings_value;
                    $data1['from_name']      = '';
                    $data1['to_email']       = $request->email;
                    $data1['project_name']   = $p->project_name;
                    $data1['company_slug']   = \URL::route('public_planroom_list_for_user',$assign->assign_company->company_slug);
                    \Mail::send('emails.private_planroom_create', $data1, function ($message) use ($data1) {
                        $message->from($data1['from_email'], $data1['from_name']);
                        $message->subject('New Project Added to Your Planroom');
                        $message->to($data1['to_email'] );
                    });
                    
                    return Redirect::route('admin_private_project')->with('success','Private Planroom user created successfully');
                }else{
                    return Redirect::route('private_users')->with('success','Private Planroom user created successfully');
                }
            }
    }
    public function edit($id){
        $data['details']        = Private_company::find($id);
        $data['assign_user']    = Private_company_assign::select( \DB::raw('GROUP_CONCAT(company_id) AS companyid') )->where('user_id',$id)->first();
        $data['companies']      = Private_company::where('user_type','company')->pluck('company_name','id')->all();
        return view('admin.private.user.edit',$data);
    }
    public function update(Request $request,$id){
	   
	    $validator = Validator::make(
				  $request->all(),
				   [
				     
				     'company'           => 'required',
				     'first_name'        => 'required',
				     'last_name'         => 'required',
				     'email'		 => 'required|unique:private_companies,email,'.$id,
                                     'phone'             => 'required',
                                     'address'           => 'required'	    
				   ]
	    );
	    
	    if ($validator->fails()){
		    $messages = $validator->messages();
		    return Redirect::back()->withErrors($validator->errors())->withInput();
	    }else{
	    
		$profile                    = Private_company::find($id);
                $profile->first_name        = $request->first_name;
                $profile->last_name         = $request->last_name;
                $profile->email             = $request->email;
                $profile->phone_no          = $request->phone;
                $profile->address           = $request->address;
		if($request->password !=''){
			$profile->password = $request->password;
		}
                
		$profile->save();
                
                Private_company_assign::where('user_id',$id)->delete();
                
                if(count($request->company) > 0){
                    foreach($request->company as $c){
                        $project = new Private_company_assign();
                        $project->company_id        = $c;
                        $project->user_id           = $id;
                        $project->save();
                    }
                }
	    }	return Redirect::route('private_users')->with('success','Private Planroom user updated successfully');
	}
	
    public function delete($id){
        
	$affectedRows   = Private_company::where('id',$id)->delete();
        if($affectedRows){
            return Redirect::route('private_users')->with('success','Private Planroom user deleted Successfully!');
        }
        else{
            return Redirect::route('private_users')->with('error','Private Planroom user is not deleted!');
        }
    }
}
