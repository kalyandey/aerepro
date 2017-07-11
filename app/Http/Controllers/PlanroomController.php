<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Subscription;
use App\Project;
use \Session, \Cart, \Redirect , \URL;
use App\Category,App\Contractor,App\Type, App\County, App\Tracking, App\Planroom_trade, App\Plan, App\Price, App\Trade, App\Company;

class PlanroomController extends Controller
{
    public function index(){
       
        if(Session::has('USER_DETAILS') && Session::get('USER_DETAILS')->id != ''){
            return Redirect::route('dashboard');
        }elseif(Session::has('PRIVATE_COMPANY_DETAILS') && Session::get('PRIVATE_COMPANY_DETAILS')->id != ''){
	    return Redirect::route('public_planroom_list_for_company',[Session::get('COMPANY_SLUG')]);
	}elseif(Session::has('PRIVATE_USER_DETAILS') && Session::get('PRIVATE_USER_DETAILS')->id != ''){
	    return Redirect::route('public_planroom_list_for_user',[Session::get('COMPANY_SLUG')]);
	}
        
        $data                           = array();
        $data['subscription_list']      = Subscription::get();
        return view('front.planroom.planroom',$data);
    }
    
    public function lists(Request $request){

        $data                   = array();
        if($this->planroomUrlCheck() > 0){
        //Pagination
        Session::set('pegination', 25 );
        if($request->change_view != ''){
            Session::set('pegination', $request->change_view );
            
        }
        $data['pegination'] = Session::get('pegination');
        //Query
	$query                      = Project::select('projects.*','projects.name as projectName')->where('projects.status','<>','');
        
        //Search
        $data['county_id']          = '';
        $data['category_id']        = '';
        $data['contractor_id']      = '';
        $data['type_id']            = '';
        $data['project_no']         = '';
        $data['project_name']       = '';
        $data['contractor']         = '';
	//$data['company']  	    = '';
	$data['text_search']	    = '';
	$data['s']		    = '';
	$data['stype']		    = '';
        if($request->project_name != ''){
            $query->where('projects.name', 'LIKE', '%'.$request->project_name.'%');
            $data['project_name']   = $request->project_name;
        }
        if($request->project_no != ''){
            $query->where('projects.project_id', $request->project_no);
            $data['project_no']   = $request->project_no;
        }
        if($request->county != ''){
            $query->where('projects.county_id', '=', $request->county);
            $data['county_id']  = $request->county;
        }
        if($request->category != ''){
            $query->where('projects.category_id', '=', $request->category);
            $data['category_id']  = $request->category;
        }
         if($request->contractor != ''){
	    $products = $query->whereHas('contractor_assign', function ($q) use ($request)
            {
                $q->where('contractor_assigns.contractor_id',  $request->contractor_id);
            });
	    
            $data['contractor_id']          = $request->contractor_id;
            $contractor                     = Contractor::where('id',$request->contractor_id)->first();
            $data['contractor']             = $contractor->name;
        }
        if($request->type != ''){
            $query->where('projects.type_id', '=', $request->type);
            $data['type_id']  = $request->type;
        }
//	if($request->company != ''){
//	    $products = $query->whereHas('company', function ($q) use ($request)
//            {
//                $q->where('companies.id',  $request->company);
//            });
//            $data['company']  = $request->company;
//        }
	if($request->text_search != ''){
            $data['text_search']  = $request->text_search;
        }
	
	if($request->s != '' && $request->stype != ''){
	    $data['s']		= $request->s;
	    $data['stype']	= $request->stype;
	    if($data['s'] == 'id'){
		$query->orderBy('project_id',$request->stype);
	    }elseif($data['s'] == 'name'){
		$query->orderBy('name',$request->stype);
	    }elseif($data['s'] == 'county'){
		$query->join('counties', 'counties.id', '=', 'projects.county_id');
		$query->orderBy('counties.name',$request->stype);
	    }elseif($data['s'] == 'type'){
		$query->join('types', 'types.id', '=', 'projects.type_id');
		$query->orderBy('types.name',$request->stype);
	    }elseif($data['s'] == 'category'){
		$query->join('categories', 'categories.id', '=', 'projects.category_id');
		$query->orderBy('categories.name',$request->stype);
	    }elseif($data['s'] == 'prebid'){
		$query->orderBy('pre_bid_meeting_date',$request->stype);
	    }elseif($data['s'] == 'bid'){
		$query->orderBy('bid_close_date',$request->stype);
	    }
	    
	}else{
	    $data['s']		= 'id';
	    $data['stype']	= 'DESC';
	    $query->orderBy('project_id',$request->stype);
	}
	
        $data['list']           = $query->paginate(Session::get('pegination'));
        $data['category']       = [''=>'Select Category'] + Category::where('status','Active')->orderBy('name','ASC')->pluck('name','id')->all();
        $data['type']           = [''=>'Select Type'] + Type::where('status','Active')->orderBy('name','ASC')->pluck('name','id')->all();
        $data['county']         = [''=>'Select County'] + County::where('status','Active')->orderBy('name','ASC')->pluck('name','id')->all();
	//$data['companies']      = [''=>'Select Company'] + Company::where('company_name','<>','')->pluck('company_name','id')->all();
	
	//dd($data);
        return view('front.planroom.lists',$data);
        }else{
        return view('front.permission_denied',$data);
        }
    }
    
    public function tracking(Request $request){
        $userDetails = Session::get('USER_DETAILS');
        $trackinExist = Tracking::where('user_id',$userDetails->id)->where('project_id',$request->project)->count();
        if($trackinExist){
            Tracking::where('user_id',$userDetails->id)->where('project_id',$request->project)->delete();
            echo 0;
        }else{
            $tracking               = new Tracking();
            $tracking->user_id      = $userDetails->id;
            $tracking->project_id   = $request->project;
            $tracking->save();
            echo 1;
        }
    }
    
    public function project_print(Request $request){
        $userDetails = Session::get('USER_DETAILS');
        $data['list'] = Project::whereIn('id',$request->project)->get();
        return view('front.planroom.print',$data);   
     }
    
    public function details(Request $request){
        $data               = array();
        $data['trades']      = '';
        $data['page']       = $request->page;
        $data['details']    = Project::find($request->project);
        if($data['details']->trade != ''){
        $data['trades']      = Trade::select(\DB::raw('GROUP_CONCAT(DISTINCT trade_title) as trade_name'))->whereIn('id',explode(',',$data['details']->trade))->first();
        }
        //dd($data['trades']);
        return view('front.planroom.details',$data);   
    }
    
    public function addToCart(Request $request){
	$all_plans_cat  = $request->all_plans_cat;
        $plan_id        = rtrim($request->plan_id,',');
        $papersize      = $request->papersize;
	$plan_id	= explode(',',$plan_id);
        $plan_details   = Plan::whereIn('id',$plan_id)->get();
        
        if(count($plan_details) > 0){
            foreach($plan_details as $plan){
                
                $planarea = $plan->file_height * $plan->file_width;
                $price    = Price::whereRaw("$planarea BETWEEN from_range AND to_range")->first();
                if(count($price) > 0){
                    if($papersize == 'full_size'){
                        $price  = $price->full_size_price;
                    }elseif($papersize == 'half_size'){
                        $price  = $price->half_size_price;
                    }elseif($papersize == 'full_set'){
			$price  = $price->full_set_price;
		    }else{
                        $price  = $price->download_price;
                    }
                }else{
                    if($papersize == 'full_size'){
                        $price  = 1;
                    }elseif($papersize == 'half_size'){
                        $price  = 1;
                    }elseif($papersize == 'full_set'){
			$price  = 1;
		    }else{
                        $price  = 1;
                    }
                }
                Session::set('PLAN_ID',$plan->id);
                $cart = [];
                if(count(Cart::content()) > 0){
                    $cart = Cart::search(function ($cartItem, $rowId) {
                        $planid     = Session::get('PLAN_ID');
                        if($cartItem->id == $planid){
                            Session::forget('PLAN_ID');
                            return true;
                        }
                    });
                }
                
                if(count($cart) > 0){
                    foreach($cart as $c){
                      Cart::remove($c->rowId);
                    }
                    Cart::add($plan->id, $plan->plan_name, 1, $price,['project_id' => $plan->project->project_id,'papersize' => $papersize,'project_name' => $plan->project->name,'all_plans_cat'=>$all_plans_cat,'total_plan'=>count($plan_id)]);
                }
                else{
                    Cart::add($plan->id, $plan->plan_name, 1, $price,['project_id' => $plan->project->project_id,'papersize' => $papersize,'project_name' => $plan->project->name,'all_plans_cat'=>$all_plans_cat,'total_plan'=>count($plan_id)]);
                }
            
            }
        }
        
    }
    
    public function cartView(){
        $data['cart_item'] = Cart::content();
        echo view('front.planroom.cart_view',$data);  
    }
    
    public function getContractor(Request $request){
        $contractor     = Contractor::where('status','Active')->where('business_name','LIKE','%'.$request->term.'%')->orderBy('id','desc')->limit(5)->get();
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
    
    public function view_plan_details(Request $request){
	$file_id 		= $request->file_id;
	$project_id 		= $request->project_id;
	$images = [];
	if($request->type == 'plan'){
		$plan_details 		= Plan::find($file_id);
		$image 			= explode(',',$plan_details->file_images);
		$list_count = 0;
		foreach($image as $key=>$i){
			if(file_exists(public_path('uploads/project/plan/images/'.$i))){
			   $images[$key]['id'] = $list_count;
			   $images[$key]['href'] = asset('uploads/project/plan/images/'.$i);
			   $images[$key]['title'] = $plan_details->plan_name;
			   $list_count ++;
			}
			
		}
	}elseif($request->type == 'category'){
		$plan_details 		= Plan::where('cat_id',$file_id)->where('project_id',$project_id)->get();
		$list_count = 0;
		foreach($plan_details as $p){
			$plan 		= $p;
			$image 			= explode(',',$plan->file_images);
			foreach($image as $key=>$i){
				if(file_exists(public_path('uploads/project/plan/images/'.$i))){
				   $images[$list_count]['id'] = $list_count;
				   $images[$list_count]['href'] = asset('uploads/project/plan/images/'.$i);
				   $images[$list_count]['title'] = $p->plan_name;
				   $list_count ++;
				}
				
			}
		}
	}
	echo json_encode($images);exit;
	
	//$str			= '<div class="popup_inner"><span class="pdf_close_button"><img src="'.asset("images/close.png").'" alt="no img"></span>';
	//if(count($image) > 1){
	//$str			.= '<div class="nev-div">';
	//$str			.= '<ul>';
	//$str			.= '<li class="prev-link">Prev</li>';
	//$str			.= '<li class="next-link">Next</li>';
	//$str			.= '</ul>';
	//$str			.= '</div>';
	//}
	//$str			.= '<ul class="slide-image">';
	//foreach($image as $key=>$i){
	//    if(file_exists(public_path('uploads/project/plan/images/'.$i))){
	//    $str			.= '<li class="'.(($key == 0)?'active':'').'"><img src="'.asset('uploads/project/plan/images/'.$i).'"> </li>';
	//    }
	//}
	//$str			.= '</ul></div>';
	//echo $str;
    }
}
