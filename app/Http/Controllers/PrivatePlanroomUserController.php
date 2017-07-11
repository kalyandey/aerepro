<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Private_company,App\Private_planroom_assigns,App\Private_project,App\Private_company_assign;
use \Session,\Redirect,\Validator;

class PrivatePlanroomUserController extends Controller
{
    public function lists(Request $request,$company_slug){
        $data = [];
        $company = $this->companyExistCheck($company_slug);
        if(count($company) > 0){
            $data['company']      = $company;
            $data['project']      = Private_project::select('private_projects.*')->join('private_company_assigns', 'private_company_assigns.company_id', '=', 'private_projects.company_id')
                                    ->where('private_projects.company_id',$company->id)
                                    ->where('private_projects.status','<>','Close')
                                    ->where('private_projects.view_status','Public')
                                    ->where('private_company_assigns.user_id',Session::get('PRIVATE_USER_DETAILS')->id)
                                    ->paginate(10);
            return view('front.private.user_planroom_list',$data);
        }else{
            return view('front.private.companyNotExist',$data);
        }
    }
    
    public function private_lists(Request $request,$company_slug){
        $data = [];
        $company = $this->companyExistCheck($company_slug);
        if(count($company) > 0){
            $data['company']      = $company;
            $data['project']      = Private_project::
                                    //join('private_company_assigns', 'private_company_assigns.company_id', '=', 'private_projects.company_id')->
                                    join('private_planroom_assigns','private_planroom_assigns.project_id','=','private_projects.id')
                                    ->select('private_projects.*')
                                    ->where('private_projects.company_id',$company->id)
                                    ->where('private_projects.status','<>','Close')
                                    ->where('private_projects.view_status','Private')
                                    ->where('private_planroom_assigns.user_id',Session::get('PRIVATE_USER_DETAILS')->id)
                                    //->toSql();
                                    ->paginate(10);
                                    //dd($data);
            return view('front.private.user_planroom_list',$data);
        }else{
            return view('front.private.companyNotExist',$data);
        }
    }
    
    public function editProfile(Request $request,$company_slug){
        $data = [];
        $company = $this->companyExistCheck($company_slug);
        if(count($company) > 0){
            $data                 = array();
            $data['company']      = $company;
            $id                   = Session::get('PRIVATE_USER_DETAILS')->id;
            $user                 = Private_company::find($id);
            if($request->isMethod('post')){
                $validator = Validator::make($request->all(),
                                    [
                                        
                                        'first_name'           => 'required',
                                        'last_name'            => 'required'
                                    ]);
                if ($validator->fails())
                {
                    $messages = $validator->messages();
                    return Redirect::back()->withErrors($validator)->withInput();
                }
                else
                {
                   $user->first_name                  = $request->first_name;
                   $user->last_name                   = $request->last_name;
                   //if($request->password != ''){
                   // $user->password                    = $request->password;
                   //}
                   $user->phone_no                    = $request->phone_no;
                   $user->address                     = $request->address;
                   $user->save();
                   return Redirect::back()->with('success','Your account updated successfully.');
                }
            }
            $data['user']               = $user;
            return view('front.private.edit_user_profile',$data);
        }else{
            return view('front.private.companyNotExist',$data);
        }
    }

}