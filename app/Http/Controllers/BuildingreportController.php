<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;

use App\Project;
use \Session;
use App\Jurisdictions,App\Building_report,App\Permit_type, App\County, App\Contractor, App\Planroom_trade, App\Plan, App\Users, App\User_subscription;

class BuildingreportController extends Controller
{
        public function index(Request $request){
        $data                   = array();
        
        $u                      = User_subscription::where('user_id',Session::get('USER_DETAILS')->id)
        ->where(function($query) use ($data) {
                $query->whereRaw('FIND_IN_SET(2,subscription_id) or FIND_IN_SET(3,subscription_id)');
                })
        ->where('status','active')->count();
        
        //$u                      = Users::where('id',Session::get('USER_DETAILS')->id)->where(function($query) use ($data) {$query->whereRaw('FIND_IN_SET(2,subscription_id) or FIND_IN_SET(3,subscription_id)')})->count();
        if($u > 0){
            
        $county                 = User_subscription::select(\DB::raw('GROUP_CONCAT(DISTINCT subscription_id) as subscription_id'))->where('user_id',Session::get('USER_DETAILS')->id)->where('status','active')->first(); 
        $county_id              = '';
        if($county->subscription_id != '' && in_array('2',explode(',',$county->subscription_id))){
            $county_id              .= '18,';
        }
        if($county->subscription_id != '' && in_array('3',explode(',',$county->subscription_id))){
            $county_id              .= '7';
        }
        $county_id                   = rtrim($county_id,',');   
        //Query
        $query                       = Building_report::select('building_reports.created_at as postedDate','building_reports.*')
										->where('building_reports.status','Active')
										->whereIn('building_reports.county_id',explode(',',$county_id));
        
        //Search
        $data['jurisdiction']       = '';
        $data['contractor']         = '';
        $data['autocompleteContractor']         = '';
        $data['permittype']         = '';
        $data['text_search']        = '';
        $data['county']             = '';
        $data['issue_start_date']   = '';
        $data['issue_end_date']     = '';
        $data['posting_start_date'] = '';
        $data['posting_end_date']   = '';
        $data['s']		    = '';
	$data['stype']		    = '';
        if($request->project_name != ''){
            $query->where('name', 'LIKE', '%'.$request->project_name.'%');
            $data['project_name']   = $request->project_name;
        }
        if($request->jurisdiction != ''){
            $query->where('jurisdiction_id', $request->jurisdiction);
            $data['jurisdiction']   = $request->jurisdiction;
        }
        if($request->permittype != ''){
            $query->where('permit_type_id', '=', $request->permittype);
            $data['permittype']  = $request->permittype;
        }
        if($request->contractor != ''){
            $query->where('contractor_id', '=', $request->contractor);
            $data['contractor']  = $request->contractor;
            $data['autocompleteContractor']= $request->autocompleteContractor;
        }
        
        if($request->county != ''){
            if($request->county == 18){
                $user = User_subscription::where('subscription_id',2)
								->where('user_id',Session::get('USER_DETAILS')->id)
								->where('status','active')
								->whereDate('start_date', '<=', \Carbon\Carbon::today()->toDateString())
								->whereDate('end_date', '>', \Carbon\Carbon::today()->toDateString())
								->count();
                if($user == 0){
                    return view('front.permission_denied',$data);
                }
            }
            
            if($request->county == 7){
                $user = User_subscription::where('subscription_id',3)
								->where('user_id',Session::get('USER_DETAILS')->id)
								->where('status','active')
								->whereDate('start_date', '<=', \Carbon\Carbon::today()->toDateString())
								->whereDate('end_date', '>', \Carbon\Carbon::today()->toDateString())
								->count();
                if($user == 0){
                    return view('front.permission_denied',$data);
                }
            }
            $query->where('county_id', '=', $request->county);
            $data['county']  = $request->county;
        }
        
        if($request->posting_start_date != '' && $request->posting_end_date != ''){
            $query->whereBetween(\DB::raw("DATE_FORMAT(created_at, '%m/%d/%y')"), array($request->posting_start_date, $request->posting_end_date));
            $data['posting_start_date']  = $request->posting_start_date;
            $data['posting_end_date']    = $request->posting_end_date;
        }
        
        if($request->issue_start_date != '' && $request->issue_end_date != ''){
            $query->whereBetween(\DB::raw("DATE_FORMAT(issued_date, '%m/%d/%y')"), array($request->issue_start_date, $request->issue_end_date));
            $data['issue_start_date']  = $request->issue_start_date;
            $data['issue_end_date']    = $request->issue_end_date;
        }
        
        if($request->s != '' && $request->stype != ''){
	    $data['s']		= $request->s;
	    $data['stype']	= $request->stype;
	    if($data['s'] == 'id'){
		$query->orderBy('building_reports.number',$request->stype);
	    }elseif($data['s'] == 'permit_issue'){
		$query->orderBy('building_reports.issued_date',$request->stype);
	    }elseif($data['s'] == 'posted_date'){
		$query->orderBy('building_reports.created_at',$request->stype);
	    }elseif($data['s'] == 'county_sort'){
		$query->join('counties', 'counties.id', '=', 'building_reports.county_id');
		$query->orderBy('counties.name',$request->stype);
	    }elseif($data['s'] == 'juris'){
		$query->join('jurisdictions', 'jurisdictions.id', '=', 'building_reports.jurisdiction_id');
		$query->orderBy('jurisdictions.name',$request->stype);
	    }elseif($data['s'] == 'permit_type'){
		$query->orderBy('building_reports.permit_type_id',$request->stype);
	    }elseif($data['s'] == 'owner'){
		$query->join('permit_owners', 'permit_owners.id', '=', 'building_reports.permit_owner_id');
		$query->orderBy('permit_owners.owner_name',$request->stype);
	    }elseif($data['s'] == 'contractor'){
                $query->join('contractors', 'contractors.id', '=', 'building_reports.contractor_id');
		$query->orderBy('contractors.business_name',$request->stype);
	    }
	    
	}else{
	    $data['s']		= 'id';
	    $data['stype']	= 'DESC';
	    $query->orderBy('building_reports.number','DESC');
	}
        
        $data['list']                = $query->paginate(10);
        //$data['list']                = $query->toSql();
        
        $data['jurisdictions']       = [''=>'Select'] + Jurisdictions::where('status','Active')->orderBy('name','ASC')->pluck('name','id')->all();
        $data['permit_type']         = [''=>'Select'] + Permit_type::where('status','Active')->pluck('name','id')->all();
        $data['contractors']         = [''=>'Select'] + Contractor::where('status','Active')->orderBy('name','ASC')->pluck('name','id')->all();
        $data['counties']            = [''=>'Select'] + County::whereIn('id',explode(',',$county_id))->where('status','Active')->orderBy('name','ASC')->pluck('name','id')->all();
        return view('front.buildingreport.index',$data);
        }else{
            return view('front.permission_denied',$data);
        }
    }
    
    public function details(Request $request){
        $data               = array();
        $data['details']    = Building_report::find($request->bid_id);
        return view('front.buildingreport.details',$data);   
    }
    
    public function building_report_print(Request $request){
        $data               = array();
        $data['list'] = Building_report::where('status','Active')->whereIn('id',$request->report)->get();
        //dd($data['list']);
        return view('front.buildingreport.print',$data);   
    }
    
    public function building_report_print_last(){
        $data               = array();
        $county             = User_subscription::select(\DB::raw('GROUP_CONCAT(DISTINCT subscription_id) as subscription_id'))->where('user_id',Session::get('USER_DETAILS')->id)->where('status','active')->first(); 
        $county_id          = '';
        if($county->subscription_id != '' && in_array('2',explode(',',$county->subscription_id))){
            $county_id              .= '18,';
        }
        if($county->subscription_id != '' && in_array('3',explode(',',$county->subscription_id))){
            $county_id              .= '7';
        }
        $data['list']       = Building_report::where('status','Active')->whereIn('county_id',explode(',',$county_id))->orderBy('created_at','DESC')->limit(50)->get();
        return view('front.buildingreport.print',$data);   
    }
}
