<?php

namespace App\Http\Controllers\admin;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use App\Private_company;
use \Validator,\Redirect, \Image;

class PrivatecompanyController extends Controller
{
    public function index(Request $request){
        $data['keyword']        = '';
        if($request->keyword !=''){
            $data['keyword']            = $request->keyword;
            $data['lists'] = Private_company::where('user_type','company')->where(function($query) use ($data) {
                                if($data['keyword'] != ''){
                                $query->where('company_name','like','%'.$data['keyword'].'%');
                                $query->orWhere('first_name','like','%'.$data['keyword'].'%');
                                $query->orWhere('last_name','like','%'.$data['keyword'].'%');
                                $query->orWhere(\DB::raw('CONCAT(first_name, " ", last_name)'),'like','%'.$data['keyword'].'%');
                                $query->orWhere('email','like','%'.$data['keyword'].'%');
                                $query->orWhere('status','like','%'.$data['keyword'].'%');
                                }
                            })->orderBy('company_name','asc')->paginate(10);
        }
        else{
            $data['lists'] = Private_company::where('user_type','company')->orderBy('company_name','asc')->paginate(10);
        }
        return view('admin.private.project.company.list',$data);
    }

    public function edit(Request $request,$id){
        $data                           = array();
        $company                        = Private_company::find($id);
        $logo                           = $company->logo;
        if($request->action == "Process"){   
                $validator = Validator::make($request->all(),
                                            ['company_name'         => 'required|unique:private_companies,company_name,'.$id,
                                             'first_name'           => 'required',
                                             'last_name'            => 'required',
                                             'email'                => 'email|required|unique:private_companies,email,'.$id,
                                             'phone_no'             => 'required',
                                             'domain'               => 'url',
                                             'logo'                 => 'image|mimes:jpeg,png,jpg,gif,svg',]);
                if($validator->fails()){
                   $message = $validator->messages();
                   return Redirect::back()->withErrors($validator)->withInput();
                }else{
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
                    $company->logo = $imagename;
                   }
                   $company->company_name                = $request->company_name;
                   $company->first_name                  = $request->first_name;
                   $company->last_name                   = $request->last_name;
                   $company->email                       = $request->email;
                   if($request->password != ''){
                    $company->password                    = $request->password;
                   }
                   $company->phone_no                    = $request->phone_no;
                   $company->domain                      = $request->domain;
                   $company->address                     = $request->address;
                   $company->save();
                   
                   return Redirect::route('admin_private_company_list')->with('success','Company details updated successfully');
                }
        }
        $data['details'] = $company;
        return view('admin.private.project.company.edit',$data);
    }

}
