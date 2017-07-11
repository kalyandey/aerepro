<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Private_company,App\Private_planroom_assigns,App\Private_project,App\Private_company_assign;
use \Session,\Redirect,\Validator,\Image;

class PrivatePlanroomCompanyController extends Controller
{
    public function lists(Request $request,$company_slug){
        $data = [];
        $company = $this->companyExistCheck($company_slug);
        if(count($company) > 0){
            $data['company']      = $company;
            $data['company_slug'] = $company_slug;
            $data['project']      = Private_project::where('company_id',$company->id)->where('status','<>','Close')->paginate(10);
            return view('front.private.company_planroom_list',$data);
        }else{
            return view('front.private.companyNotExist',$data);
        }
    }
    
    public function private_lists(Request $request,$company_slug){
        $data = [];
        $company = $this->companyExistCheck($company_slug);
        if(count($company) > 0){
            $data['company']      = $company;
            $data['project']      = Private_project::where('company_id',$company->id)->where('view_status','Private')->where('status','<>','Close')->paginate(10);
            return view('front.private.company_planroom_list',$data);
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
            $logo                 = $company->logo;
            $id                   = Session::get('PRIVATE_COMPANY_DETAILS')->id;
            $user                 = Private_company::find($id);
            if($request->isMethod('post')){
                $validator = Validator::make($request->all(),
                                    [
                                        
                                        'first_name'           => 'required',
                                        'last_name'            => 'required',
                                        'phone_no'             => 'required',
                                        'domain'               => 'url',
                                        'logo'                 => 'image|mimes:jpeg,png,jpg,gif,svg'
                                     ]);
                if ($validator->fails())
                {
                    $messages = $validator->messages();
                    return Redirect::back()->withErrors($validator)->withInput();
                }
                else
                {
                    if ($request->hasFile('logo')) {
                        if($logo != '' && file_exists(public_path('uploads/private_planroom/company_logo/thumb/'.$logo))){
                            unlink(public_path('uploads/private_planroom/company_logo/thumb/'.$logo));
                        }
                        
                        if($logo != '' && file_exists(public_path('uploads/private_planroom/company_logo/'.$logo))){
                            unlink(public_path('uploads/private_planroom/company_logo/'.$logo));
                        }
                        $logo = $request->file('logo');
                        $imagename = time().'.'.$logo->getClientOriginalExtension(); 
                   
                        $destinationPath = public_path('/uploads/private_planroom/company_logo/thumb');
                        $thumb_img = Image::make($logo->getRealPath())->resize(130, 60);
                        $thumb_img->save($destinationPath.'/'.$imagename,80);
                                    
                        $destinationPath = public_path('/uploads/private_planroom/company_logo');
                        $logo->move($destinationPath, $imagename);
                        $user->logo = $imagename;
                   }
                   $user->first_name                  = $request->first_name;
                   $user->last_name                   = $request->last_name;
                   //if($request->password != ''){
                   // $user->password                    = $request->password;
                   //}
                   $user->phone_no                    = $request->phone_no;
                   $user->domain                      = $request->domain;
                   $user->address                     = $request->address;
                   $user->save();
                   return Redirect::back()->with('success','Your account updated successfully.');
                }
            }
            $data['user']               = $user;
            return view('front.private.edit_company_profile',$data);
        }else{
            return view('front.private.companyNotExist',$data);
        }
    }

}
