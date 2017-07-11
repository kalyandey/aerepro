<?php

namespace App\Http\Controllers\admin;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use App\Building_report, App\City, App\Permit_owner, App\State, App\Permit_type, App\Permit, App\County, App\Contractor, App\Jurisdictions;
use \Validator, \Redirect;

class BuildingreportController extends Controller
{
    public function index(Request $request){
        $data['keyword']            = '';
        $data['contractor_id']      = '';
        $data['permit_owners']      = '';
        $data['jurisdictions']      = '';
        $data['contractor']         = '';
        if($request->keyword !='' || $request->contractor_id != '' || $request->permit_owners != '' || $request->jurisdictions != ''  || $request->contractors != ''){
            $data['keyword']            = $request->keyword;
            $data['contractor_id']      = $request->contractor_id;
            $data['permit_owners']      = $request->permit_owners;
            $data['jurisdictions']      = $request->jurisdictions;
            $data['contractor']         = $request->contractor;
            
            $data['lists'] = Building_report::orderBy('id','desc')->where(function($query) use ($data) {
                                if($data['contractor_id'] != ''){
                                    $query->where('contractor_id',$data['contractor_id']);
                                }
                                //if($data['permit_owners'] != ''){
                                //    $query->where('permit_owner_id',$data['permit_owners']);
                                //}
                                if($data['jurisdictions'] != ''){
                                    $query->where('jurisdiction_id',$data['jurisdictions']);
                                }
                                if($data['keyword'] != ''){
                                    $query->where('number',$data['keyword']);
                                    $query->orWhere('city_id','like','%'.$data['keyword'].'%');
                                    $query->orWhere('address','like','%'.$data['keyword'].'%');
                                    $query->orWhere('zip','like','%'.$data['keyword'].'%');
                                    $query->orWhere('permit_type_id','like','%'.$data['keyword'].'%');
                                    $query->orWhere('permit','like','%'.$data['keyword'].'%');
                                    $query->orWhere('parcel','like','%'.$data['keyword'].'%');
                                    $query->orWhere('subdivision','like','%'.$data['keyword'].'%');
                                    $query->orWhere('status','like','%'.$data['keyword'].'%');
                                }
            })->paginate(10);
            
        }else{
            $data['lists'] = Building_report::orderBy('id','desc')->paginate(10);
        }
        $data['permit_type']        = [''=>'Select Job Type']  + Permit_type::orderBy('name','ASC')->pluck('name','id')->all();
        $data['permit_owner']       = [''=>'Select Owner'] + Permit_owner::pluck('owner_name','id')->all();
        $data['jurisdiction']       = [''=>'Select Jurisdiction'] + Jurisdictions::orderBy('name','ASC')->pluck('name','id')->all();
        //$data['contractor']         = [''=>'Select Contractor'] + Contractor::pluck('name','id')->all();
        //dd($data);
        return view('admin.buildingreport.list',$data);
    }
    
    public function create(){
        $data = array();
        $data['city']               = [''=>'Select City']+City::orderBy('city','ASC')->pluck('city','id')->all();
        $data['state']              = [''=>'Select State'] + State::orderBy('state','ASC')->pluck('state','id')->all();
        $data['county']             = County::orderBy('name','ASC')->pluck('name','id')->all();
        $data['permit_type']        = [''=>'Select Job Type']  + Permit_type::orderBy('name','ASC')->pluck('name','id')->all();
        $data['permit_owner']       = [''=>'Select Owner'] + Permit_owner::orderBy('owner_name','ASC')->pluck('owner_name','id')->all();
        $data['jurisdiction']       = [''=>'Select Jurisdiction'] + Jurisdictions::orderBy('name','ASC')->pluck('name','id')->all();
        return view('admin.buildingreport.create',$data);
    }
    
    public function store(Request $request){
        $validator = Validator::make($request->all(),
                                     ['issued_date'         => 'required',
                                      'jurisdiction'        => 'required',
                                      'county'              => 'required',
                                      'permit_type'         => 'required',
                                      'state'               => 'required',
                                      'city'                => 'required',
                                      'zip'                 => 'required'
                                      ]
                                    );

         if ($validator->fails())
         {
             $messages = $validator->messages();
             return Redirect::back()->withErrors($validator)->withInput();
         } else {
             $model                             = new Building_report();
             if($request->issued_date != ''){
                $issued_date               = explode('/',$request->issued_date);
                $model->issued_date      = $issued_date[2].'-'.$issued_date[0].'-'.$issued_date[1];
             }
             $model->jurisdiction_id            = $request->jurisdiction;
             $model->county_id                  = $request->county;
             $model->permit_type_id             = $request->permit_type;
             $model->state_id                   = $request->state;
             $model->city_id                    = $request->city;
             $model->zip                        = $request->zip;
             $model->sqft                       = $request->sqft;
             $model->valuation                  = $request->valuation;
             $model->permit                     = $request->permit;
             $model->parcel                     = $request->parcel;
             $model->subdivision                = $request->subdivision;
             $model->address                    = $request->address;
             $model->save();
             
             $model->number                     = 10000+$model->id;
             $model->save();
             return Redirect::route('admin_buildingreport_contractor',array($model->id))->with('success','Building Report is added successfully'); 
        }
    }
    
    public function contractor(Request $request, $id){
        $model = Building_report::find($id);
        if($request->action == "Process"){
            $validator = Validator::make($request->all(),['select_type'   => 'required']);
            if($validator->fails()){
               $message = $validator->messages();
               return Redirect::back()->withErrors($validator)->withInput();
            }else{
                    
                if($request->select_type == 'others'){
                    $validator = Validator::make($request->all(),
                                                ['business_name'   => 'required',
                                                 'name'            => 'required',
                                                 'street'          => 'required',
                                                 'city'            => 'required',
                                                 'state'           => 'required',
                                                 'zip'             => 'required',
                                                 'phone'           => 'required',
                                                 'email'           => 'email' ]);
                    if($validator->fails()){
                       $message = $validator->messages();
                       return Redirect::back()->withErrors($validator)->withInput();
                    }else{
                       $contractor                            = new Contractor;
                       $contractor->business_name             = $request->business_name;
                       $contractor->name                      = $request->name;
                       $contractor->street                    = $request->street;
                       $contractor->city                      = $request->city;
                       $contractor->state                     = $request->state;
                       $contractor->zip                       = $request->zip;
                       $contractor->phone                     = $request->phone;
                       $contractor->fax                       = $request->fax;
                       $contractor->email                     = $request->email;
                       $contractor->save();
                       $model->contractor_id = $contractor->id;
                    }
                }else{
                    $model->contractor_id  = $request->contractor_id;
                }
                $model->save();
                return Redirect::route('admin_buildingreport_owner',[$id])->with('success','Contractor details updated successfully');
            }
        }

        $data['lists']              = $model;
        $data['contractor']         = [''=>'Select Contractor'] + Contractor::orderBy('name','ASC')->pluck('name','id')->all() + ['other' => 'Other'];
        $data['city']               = [''=>'Select City']+City::orderBy('city','ASC')->pluck('city','id')->all();
        $data['state']              = [''=>'Select State'] + State::orderBy('state','ASC')->pluck('state','id')->all();
        return view('admin.buildingreport.contractor',$data);
    }
    
    //public function permit_owner(Request $request, $id){
    //    $model = Building_report::find($id);
    //    
    //    if($request->action == "Process"){
    //        $validator = Validator::make($request->all(),['owner'   => 'required']);
    //        if($validator->fails()){
    //           $message = $validator->messages();
    //           return Redirect::back()->withErrors($validator)->withInput();
    //        }else{
    //                
    //            if($request->owner == 'other'){
    //                $validator = Validator::make($request->all(),
    //                                            ['owner_name'       => 'required',
    //                                             'city'             => 'required',
    //                                             'state'            => 'required']);
    //                if($validator->fails()){
    //                   $message = $validator->messages();
    //                   return Redirect::back()->withErrors($validator)->withInput();
    //                }else{
    //                   $owner                            = new Permit_owner;
    //                   $owner->owner_name                = $request->owner_name;
    //                   $owner->owner_address             = $request->owner_address;
    //                   $owner->owner_city_id             = $request->city;
    //                   $owner->owner_state_id            = $request->state;
    //                   $owner->owner_zip                 = $request->zip;
    //                   $owner->owner_phone               = $request->phone;
    //                   $owner->save();
    //                   $model->permit_owner_id           = $owner->id;
    //                }
    //            }else{
    //                $model->permit_owner_id  = $request->owner;
    //            }
    //            $model->save();
    //            return Redirect::route('admin_buildingreport_permit',[$id])->with('success','Owner added successfully');
    //        }
    //    }
    //    $data['lists']              = $model;
    //    $data['city']               = [''=>'Select City']+City::pluck('city','id')->all();
    //    $data['state']              = [''=>'Select State'] + State::pluck('state','id')->all();
    //    $data['permit_owner']       = [''=>'Select Permit Owner'] + Permit_owner::pluck('owner_name','id')->all() + ['other' => 'Create New Private owner'];
    //    return view('admin.buildingreport.owner',$data);
    //}
    
    
    public function permit_owner(Request $request, $id){
        $model = Building_report::find($id);
        
        if($request->action == "Process"){ 
            $validator = Validator::make($request->all(),
                                        ['owner_name'       => 'required',
                                         'city'             => 'required',
                                         'state'            => 'required']);
            if($validator->fails()){
               $message = $validator->messages();
               return Redirect::back()->withErrors($validator)->withInput();
            }else{
               if($model->permit_owner_id != null){
               $owner                            = Permit_owner::find($model->permit_owner_id);
               $owner->owner_name                = $request->owner_name;
               $owner->owner_address             = $request->owner_address;
               $owner->owner_city_id             = $request->city;
               $owner->owner_state_id            = $request->state;
               $owner->owner_zip                 = $request->zip;
               $owner->owner_phone               = $request->phone;
               $owner->save();
               }else{
               $owner                            = new Permit_owner;
               $owner->owner_name                = $request->owner_name;
               $owner->owner_address             = $request->owner_address;
               $owner->owner_city_id             = $request->city;
               $owner->owner_state_id            = $request->state;
               $owner->owner_zip                 = $request->zip;
               $owner->owner_phone               = $request->phone;
               $owner->save();
               $model->permit_owner_id           = $owner->id;
               }
            }
            $model->save();
            return Redirect::route('admin_buildingreport_permit',[$id])->with('success','Owner added successfully');
        }
        $data['lists']              = $model;
        $data['city']               = [''=>'Select City']+City::orderBy('city','ASC')->pluck('city','id')->all();
        $data['state']              = [''=>'Select State'] + State::orderBy('state','ASC')->pluck('state','id')->all();
        $data['permit_owner']       = [''=>'Select Permit Owner'] + Permit_owner::pluck('owner_name','id')->all() + ['other' => 'Create New Private owner'];
        return view('admin.buildingreport.owner',$data);
    }

    
    public function permit(Request $request, $id){
        $model      = Building_report::find($id);
        if($request->action == "Process"){
            $validator = Validator::make($request->all(),
                                        ['permit_pdf'        => 'mimes:pdf']);
            if($validator->fails()){
               $message = $validator->messages();
               return Redirect::back()->withErrors($validator)->withInput();
            }else{
                
                if(Permit::where('building_report_id',$id)->count() > 0){
                    $permit = Permit::where('building_report_id',$id)->first();
                }else{
                    $permit = new Permit();
                }
                if ($request->hasFile('permit_pdf')) {
                    $removeFilePath  = '';
                    if(\Helpers::isFileExist('uploads/permit_pdf/'.$model->permit_pdf) && $model->permit_pdf != ''){
                        $removeFilePath = 'uploads/permit_pdf/'.$model->permit_pdf;
                    }
                    
                    $filename = time().$request->permit_pdf->getClientOriginalName();
                    $request->permit_pdf->move(public_path('uploads/permit_pdf/'), $filename);
                    $file = public_path("uploads/permit_pdf/".$filename);
                    $this->fileupload($file , 'uploads/permit_pdf/' , $filename ,$removeFilePath);
                    
                    if(file_exists($file) && $filename != ''){
                        unlink($file);
                    }
                    
                    $permit->permit_pdf = $filename;
                }
                $permit_name = ($request->permit_name <> '')?$request->permit_name:$filename;
                $permit->building_report_id  = $id;
                $permit->permit_name         = $permit_name;
                $permit->save();
                
                return Redirect::route('admin_buildingreport')->with('success','Building report added successfully');
            }
        }
        $data['lists'] = $model;
        return view('admin.buildingreport.permit',$data);
    }
    public function edit($id){
        $data['lists']              = Building_report::find($id);
        $data['city']               = [''=>'Select City']+City::orderBy('city','ASC')->pluck('city','id')->all();
        $data['state']              = [''=>'Select State'] + State::orderBy('state','ASC')->pluck('state','id')->all();
        $data['county']             = County::orderBy('name','ASC')->pluck('name','id')->all();
        $data['permit_type']        = [''=>'Select Job Type']  + Permit_type::orderBy('name','ASC')->pluck('name','id')->all();
        $data['permit_owner']       = [''=>'Select Owner'] + Permit_owner::orderBy('owner_name','ASC')->pluck('owner_name','id')->all();
        $data['jurisdiction']       = [''=>'Select Jurisdiction'] + Jurisdictions::orderBy('name','ASC')->pluck('name','id')->all();
        return view('admin.buildingreport.edit',$data);
    }
    
    /*
     * Category update
     */
    public function update(Request $request,$id)
    {   
        $model      = Building_report::find($id);
        $validator  = Validator::make($request->all(),
                                      ['issued_date'         => 'required',
                                      'jurisdiction'        => 'required',
                                      'county'              => 'required',
                                      'permit_type'         => 'required',
                                      'state'               => 'required',
                                      'city'                => 'required',
                                      'zip'                 => 'required']);

         if ($validator->fails())
         {
             $messages = $validator->messages();
             return Redirect::back()->withErrors($validator)->withInput();
         } else {
            
             
            //dd($request->all());
             $model->jurisdiction_id            = $request->jurisdiction;
             $model->county_id                  = $request->county;
             $model->permit_type_id             = $request->permit_type;
             $model->state_id                   = $request->state;
             $model->city_id                    = $request->city;
             $model->zip                        = $request->zip;
             $model->sqft                       = $request->sqft;
             $model->valuation                  = $request->valuation;
             $model->permit                     = $request->permit;
             $model->parcel                     = $request->parcel;
             $model->subdivision                = $request->subdivision;
             $model->address                    = $request->address;
             $model->type                       = $request->type;
             $model->status                     = $request->status;
             if($request->issued_date != ''){
                $issued_date               = explode('/',$request->issued_date);
                $model->issued_date      = $issued_date[2].'-'.$issued_date[0].'-'.$issued_date[1];
             }
             $model->save();
             return Redirect::route('admin_buildingreport_contractor',[$model->id])->with('success','Building Report is updated successfully'); 

         }
    }
    
    public function delete($id){
        $model = Building_report::find($id);
        if(count($model->permit_file) > 0){
        if(\Helpers::isFileExist('uploads/permit_pdf/'.$model->permit_file[0]->permit_pdf) && $model->permit_file[0]->permit_pdf != ''){
            $this->removeFile('uploads/permit_pdf/'.$model->permit_file[0]->permit_pdf);
        }
        }
        $model->delete();
        return Redirect::route('admin_buildingreport')->with('success','Building Report deleted successfully');
    }
    
    public function permit_exist(Request $request){
        $data = [];
        if($request->building_id != ''){
            $data = Building_report::where('permit',$request->permit_value)->where('id','<>',$request->building_id)->get();
        }else{
            $data =  Building_report::where('permit',$request->permit_value)->get();
        }
        if(count($data) > 0){
            foreach($data as $k=>$d){
                $data[$k] = \URL::route('admin_buildingreport_edit',$d->id);
            }
            echo json_encode($data);
        }else{
            echo '';
        }
    }
    public function details($id){
        $data['lists'] = Building_report::find($id);
        return view('admin.buildingreport.details',$data);
    }
    public function contractors_view($id){
        $data['lists'] = Building_report::find($id);
        return view('admin.buildingreport.contractors_view',$data);
    }
    public function owner_view($id){
        $data['lists'] = Building_report::find($id);
        return view('admin.buildingreport.owner_view',$data);
    }
    public function permit_view($id){
        $data['lists'] = Building_report::find($id);
        return view('admin.buildingreport.permit_view',$data);
    }
}
