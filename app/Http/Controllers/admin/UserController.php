<?php

namespace App\Http\Controllers\admin;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use App\Admin, App\Role, App\Role_user, App\Users, App\State, App\City , App\Profession, App\Csi_division, App\Trade,App\User_payment, App\Subscription, App\User_subscription, App\Temp_payment,App\Sitesetting;
use \Session, \Validator,\Redirect, \Cookie;
use AuthorizeNetSIM;
use Excel;

use net\authorize\api\contract\v1 as AnetAPI;
use net\authorize\api\controller as AnetController;

class UserController extends Controller
{
    public $setName 		= '7B6Ejq2Lh';
    public $setTransactionKey 	= '523Us8tX9G2qsH2C';
    
    public function admin_users_list(Request $request){
        $data['key'] = $key  = $request->key;
        if($key !=''){
            $data['lists']  = Admin::where('first_name','LIKE','%'.$key.'%')
                                ->orWhere('last_name','LIKE','%'.$key.'%')
                                ->orWhere('email','LIKE','%'.$key.'%')
				->orderBy(\DB::raw('CONCAT(first_name, " ", last_name)'),'asc')
                                ->paginate(10);
        }else{
            $data['lists']  = Admin::orderBy(\DB::raw('CONCAT(first_name, " ", last_name)'),'asc')->paginate(10);    
        }
        return view('admin.users.admin.index',$data);
    }
    public function admin_users_add(){
        $data['roles'] =  Role::pluck('name','id')->all();
        return view('admin.users.admin.add',$data);
    }
    public function admin_user_create(Request $request){
      $validator = Validator::make(
				  $request->all(),
				   [
				     
				     'first_name'        => 'required',
				     'last_name'         => 'required',
				     'email'		 => 'required|unique:admins'				    
				   ]
		    );
	    
	    if ($validator->fails()){
		    $messages = $validator->messages();
		    return Redirect::back()->withErrors($validator->errors())->withInput();
	    }else{
            $newUser                    = new Admin();
            $newUser->first_name        = $request->first_name;
            $newUser->last_name         = $request->last_name;
            $newUser->email             = $request->email;
            $newUser->password          = $request->password;
            $newUser->status            = 'active';
            $newUser->created_at        = date('Y-m-d H:i:s');
            $newUser->remember_token    = '';
            $newUser->save();
            
            $newId = $newUser->id;
            
            $newRoles = \DB::table('role_user')->insert(array('user_id'=>$newId,'role_id'=>$request->role));
            
            return Redirect::route('admin_users')->with('success','Admin user created successfully');
        }
    }
    public function admin_users_edit($id){
        $data['profile'] = Admin::find($id);
	//dd($data['profile']->roleuser[0]->role_id);
        $data['roles'] =  Role::pluck('name','id')->all();
        return view('admin.users.admin.edit',$data);
    }
    public function admin_user_update(Request $request){
	   
	    $validator = Validator::make(
				  $request->all(),
				   [
				     
				     'first_name'        => 'required',
				     'last_name'         => 'required',
				     //'email'		 => 'required|unique:admins,email,'.$request->user_id,		    
				   ]
	    );
	    
	    if ($validator->fails()){
		    $messages = $validator->messages();
		    return Redirect::back()->withErrors($validator->errors())->withInput();
	    }else{
	    
	    
	    
		$profile = Admin::find($request->user_id);
		$profile->first_name = $request->first_name;
		$profile->last_name = $request->last_name;
		$profile->status                   = $request->status;
		if($request->password !=''){
			$profile->password = $request->password;
		}
		$profile->save();
		$role = Role_user::where('user_id',$request->user_id)->first();
		
		$role->role_id = $request->role;
		//$role->user_id = $request->user_id;
		$role->save();
	    }	return Redirect::route('admin_users')->with('success','Admin user updated successfully');
	}
	
    public function admin_users_delete($id){
        
	$affectedRows   = Admin::where('id',$id)->delete();
        
        if($affectedRows){
            return Redirect::route('admin_users')->with('success','Admin user deleted Successfully!');
        }
        else{
            return Redirect::route('admin_users')->with('error','Admin user is not deleted!');
        }
    }
    
    //frontuser
    
    
    public function front_users_list(Request $request){
	
	 $type = $request->export;
         $data['key'] = $key  = $request->key;
	 $data['trade']         = $request->trade;
	 $data['profession']    = $request->profession;
	 $data['csidivision']   = $request->csidivision;
	 
	$data['trades'] = ['' => 'select Trades'] +Trade::pluck('trade_title','id')->all();
	$data['professions'] = ['' => 'select Profession'] +Profession::pluck('profession_title','id')->all();
	$data['csidivisions'] = ['' => 'select CSI Division'] +Csi_division::pluck('division_title','id')->all();
	
	if($type == 'Export to CSV')
	{
	    if($key !='' || $data['trade']  != '' ||  $data['profession']  != '' ||  $data['csidivision']  != ''){
		$data_set1  = Users::where(function($query) use ($data) {
		if($data['trade'] != ''){
				    //$query->orWhereIn('trade', $data['trade_val']);
				    $query->whereRaw("FIND_IN_SET('".$data['trade']."',trade)");
                                }
		if($data['profession'] != ''){
                        $query->whereRaw("FIND_IN_SET('".$data['profession']."',profession)");
                }
				
		if($data['csidivision'] != ''){
                    $query->whereRaw("FIND_IN_SET('".$data['csidivision']."',division)");
                }
				
		if($data['key'] != '')
		{
		    $query->orwhere('first_name','LIKE','%'.$data['key'].'%');
                    $query->orWhere('last_name','LIKE','%'.$data['key'].'%');
                    $query->orWhere('business_name','LIKE','%'.$data['key'].'%');
		    $query->orWhere('email','LIKE','%'.$data['key'].'%');
		    $query->orderBy('business_name','ASC');
		}
		
	     })->get();
		
		$data_set 		= '';
		foreach($data_set1 as $k=>$f){
		    $data_set[$k]['business_name'] 	= $f->business_name;
		    $data_set[$k]['first_name'] 	= $f->first_name;
		    $data_set[$k]['last_name'] 		= $f->last_name;
		    $data_set[$k]['email'] 		= $f->email;
		    $data_set[$k]['phone'] 		= $f->phone;
		    $data_set[$k]['fax'] 		= $f->fax;
		    $data_set[$k]['city'] 		= $f->city;
		    $data_set[$k]['state'] 		= $f->state_name->state;
		    $data_set[$k]['zip'] 		= $f->zip;
		    $projectSub 			= $f->user_subscription()->where('subscription_id',1)->first();
		    $yavSub 				= $f->user_subscription()->where('subscription_id',2)->first();
		    $cocSub 				= $f->user_subscription()->where('subscription_id',3)->first();
		    $data_set[$k]['PR'] 		= (count($projectSub) >0)?date('Y-m-d',strtotime($projectSub->end_date)):'N/A';
		    $data_set[$k]['BY'] 		= (count($yavSub) >0)?date('Y-m-d',strtotime($yavSub->end_date)):'N/A';
		    $data_set[$k]['BC'] 		= (count($cocSub) >0)?date('Y-m-d',strtotime($cocSub->end_date)):'N/A';
		}
		
		return Excel::create('export_to_excel_example', function($excel) use ($data_set) {
			$excel->sheet('mySheet', function($sheet) use ($data_set)
	        {
				$sheet->fromArray($data_set);
	        });
		})->download('csv');
		
	    }
	    else
	    {
		
		//$data_set1 		= Users::get(['business_name','first_name','last_name','email','phone','fax','city','state','zip'])->toArray();
		
		$data_set1 		= Users::get();
		
		$data_set 		= '';
		foreach($data_set1 as $k=>$f){
		    $data_set[$k]['business_name'] 	= $f->business_name;
		    $data_set[$k]['first_name'] 	= $f->first_name;
		    $data_set[$k]['last_name'] 		= $f->last_name;
		    $data_set[$k]['email'] 		= $f->email;
		    $data_set[$k]['phone'] 		= $f->phone;
		    $data_set[$k]['fax'] 		= $f->fax;
		    $data_set[$k]['city'] 		= $f->city;
		    $data_set[$k]['state'] 		= $f->state_name->state;
		    $data_set[$k]['zip'] 		= $f->zip;
		    $projectSub 			= $f->user_subscription()->where('subscription_id',1)->first();
		    $yavSub 				= $f->user_subscription()->where('subscription_id',2)->first();
		    $cocSub 				= $f->user_subscription()->where('subscription_id',3)->first();
		    $data_set[$k]['PR'] 		= (count($projectSub) >0)?date('Y-m-d',strtotime($projectSub->end_date)):'N/A';
		    $data_set[$k]['BY'] 		= (count($yavSub) >0)?date('Y-m-d',strtotime($yavSub->end_date)):'N/A';
		    $data_set[$k]['BC'] 		= (count($cocSub) >0)?date('Y-m-d',strtotime($cocSub->end_date)):'N/A';
		}
		return Excel::create('export_to_excel_example', function($excel) use ($data_set) {
			$excel->sheet('mySheet', function($sheet) use ($data_set)
	        {
				$sheet->fromArray($data_set);
	        });
		})->download('csv');
		
		
	    }
	}
	else
	{
        if($key !='' || $data['trade']  != '' ||  $data['profession']  != '' ||  $data['csidivision']  != ''){
	
	    //$trade = explode(',', $data['trade']);
	    //$data['trade_val'] = $trade;
	    
	    //$profession = explode(',', $data['profession']);
	    //$data['profession_val'] = $profession;
	    
	    //$csidivision = explode(',', $data['csidivision']);
	    //$data['csidivision_val'] = $csidivision;
	   
	     $data['lists']  = Users::where(function($query) use ($data) {
		
		if($data['trade'] != ''){
                                    
				    //$query->orWhereIn('trade', $data['trade_val']);
				    $query->whereRaw("FIND_IN_SET('".$data['trade']."',trade)");
				    
                                }
		if($data['profession'] != ''){
                                    
				   
				    $query->whereRaw("FIND_IN_SET('".$data['profession']."',profession)");
                                }
				
		if($data['csidivision'] != ''){
                                    
				   
				    $query->whereRaw("FIND_IN_SET('".$data['csidivision']."',division)");
                                }
				
		if($data['key'] != '')
		{
		    $query->orwhere('first_name','LIKE','%'.$data['key'].'%');
                    $query->orWhere('last_name','LIKE','%'.$data['key'].'%');
                    $query->orWhere('business_name','LIKE','%'.$data['key'].'%');
		    $query->orWhere('email','LIKE','%'.$data['key'].'%');
		    $query->orderBy('business_name','ASC');
		}
		
	     }) ->paginate(10);
	     
	     
	    // dd($data['lists']);
	     
//            $data['lists']  = Users::where('first_name','LIKE','%'.$key.'%')
//                                ->orWhere('last_name','LIKE','%'.$key.'%')
//				->orWhere('business_name','LIKE','%'.$key.'%')
//                                ->orWhere('email','LIKE','%'.$key.'%')
//				->orderBy('business_name','ASC')
//                                ->paginate(10);
        }else{
            $data['lists']  = Users::orderBy('business_name','ASC')->paginate(10);    
        }
	}
        return view('admin.users.front_user.index',$data);
    }
    

    
    
    public function front_users_add(){
	$data           = array();
        $data['state']  = State::orderBy('state','ASC')->pluck('state','id')->all();
        $data['city']   = City::pluck('city','id')->all();
        $data['roles'] =  Role::pluck('name','id')->all();
	
        return view('admin.users.front_user.add',$data);
    }
    public function front_user_create(Request $request){
	
	//dd($request->licensed_contractor);
	$validator = Validator::make(
                            $request->all(),
                            ['email'            => 'required|email|unique:users',
                             'password'         => 'required|min:8',
                             //'retypepassword'   => 'required|same:password',
                             'business_name'    => 'required|unique:users',
                             'first_name'       => 'required',
                             'last_name'        => 'required',
			     //'licensed_contractor' => 'required',
                            
                             ]);
        if ($validator->fails())
        {
            $messages = $validator->messages();
            return Redirect::back()->withErrors($validator)->withInput();
        }
        else
        {
            $user                           = new Users();
            //$user->token                    = str_random(8);
            $user->email                    = $request->email;
            $user->password                 = $request->password;
            $user->business_name            = $request->business_name;
            $user->phone                    = $request->phone;
            $user->fax                      = $request->fax;
            $user->website_url              = $request->website_url;
            $user->first_name               = $request->first_name;
            $user->last_name                = $request->last_name;
            $user->addess_line1             = $request->addess_line1;
            $user->addess_line2             = $request->addess_line2;
            $user->city                     = $request->city;
            $user->state                    = $request->state;
            $user->zip                      = $request->zip;
	    if($request->licensed_contractor!= null)
	    {
		$user->licensed_contractor      = $request->licensed_contractor;
		if($request->residential){
		    $user->residential      	= $request->residential;
		}
		if($request->commercial){
		    $user->commercial           = $request->commercial;
		}
	    }
	    else
	    {
		
		$user->licensed_contractor      = 'No';
	    }
            
            $user->status                   = 'Active';
            $user->save();
	   
	        if($user->id)
                {
                   return Redirect::route('front_user_moreinfo',array($user->id))->with('success','Customer details added successfully');
                }
                else
                {
                    return Redirect::route('front_user_moreinfo',array($user->id))->with('error','Customer details can not add');
                }
            
        }
      
    }
    
    public function front_user_moreinfo(Request $request,$id){
	$data = array();
        $data['profession']     = Profession::where('profession_status','Active')->get();
        $data['division']       = Csi_division::where('division_status','Active')->get();
        $data['trade']          = Trade::where('trade_status','Active')->get();
	$user                   = Users::find($id);
	$data['user_details']   = $user;
            if($request->action == "Process"){
                
                $profession             = $request->profession;
                $division               = $request->division;
                $trade                  = $request->trade;
                
                if($profession)
                {
                    $profession             = implode(',',$profession);
                }
                
                if($division)
                {
                    $division               = implode(',',$division);
                }
                
                if($trade)
                {
                    $trade                  = implode(',',$trade);
                }
                
                
                $user->profession       = $profession;
                $user->division         = $division;
                $user->trade            = $trade;
                $user->save();
		if($user->id){
                $data['from_email']     = 'admin@admin.com';
                $data['form_name']      = "Aerepro" ;
                $data['to_email']       = $user->email;
                $data['to_name']        = $user->first_name.' '.$user->last_name;
                $data['password']       = $user->password;
                $data['email']          = $user->email;
                
                \Mail::send('emails.new_user_created', $data, function ($message) use ($data) {
                    $message->from($data['from_email'], $data['form_name']);
                    $message->subject('New Account Created');
                    $message->to($data['to_email'] );
                });
		return Redirect::route('front_user_moreinfo',[$user->id])->with('success','Customer profession updated successfully!');
            }
	    else
	    {
		return Redirect::route('front_user_moreinfo',[$user->id])->with('error','Customer profession can not update.!');
	    }
		
	         
            }
      
      return view('admin.users.front_user.profession_info',$data);
    }
    
    
     /*
    |-----------------------------------------------------------
    | Method Name: subscription
    | Parameters: $id => Front user id & Object of request class
    | Purpose: this function is used to load the subscription of user and used to process the enable/disable subscription
    |-----------------------------------------------------------
    */
    public function subscriptions(Request $request,$id){
	
        $data = array();
	$user                   	= Users::find($id);
	$data['user_details']   	= $user;
	$data['activeSubscription']   	= Subscription::join('user_subscriptions','user_subscriptions.subscription_id','=','subscriptions.id')->where('user_subscriptions.user_id',$id)->get();
        if($request->action == "Process"){
	    if(count($request->userSubId) > 0){
		for($i=0;$i<count($request->userSubId);$i++){
		    $end_date		= explode('/',$request->end_date[$i]);
		    $userSub 		= User_subscription::find($request->userSubId[$i]);
		    $userSub->end_date	= $end_date[2].'-'.$end_date[0].'-'.$end_date[1].' '.date('H:i:s',strtotime($userSub->end_date));
		    $userSub->status	= $request->status[$i];
		    $userSub->save();
		}
	    }
	    return Redirect::route('front_user_subscriptions',[$user->id])->with('success','Subscription updated successfully!');
	}
	
	
	$subscribe_id = '';
	//dd($data['activeSubscription']);
	if(count($data['activeSubscription']) > 0){
	    foreach($data['activeSubscription'] as $s){
		$subscribe_id .= $s->subscription_id.',';
	    }
	}
	$data['inactiveSubscription']   	= Subscription::whereNotIn('id',explode(',',rtrim($subscribe_id,',')))->get();
	return view('admin.users.front_user.subscription',$data);
    }
    public function subscribe_single(Request $request,$user_id,$subscription_id){
	if($request->isMethod('post')){
	    $start_date		= explode('/',$request->start_date);
	    
	    //if(($start_date[2].'-'.$start_date[0].'-'.$start_date[1])<date('Y-m-d')){
		$sub 			= new User_subscription;
		$sub->user_id 		= $request->user_id;
		$sub->subscription_id	= $subscription_id;
		$sub->subscription_type	= $request->sub_type;
		$sub->type		= 'new';
		$sub->start_date        = $start_date[2].'-'.$start_date[0].'-'.$start_date[1].' 00:00:00';
		$end_date		= explode('/',$request->end_date);
		$sub->end_date        	= $end_date[2].'-'.$end_date[0].'-'.$end_date[1].' 00:00:00';
                $sub->auto_payment      = 'disable';    
		$sub->save();
		return Redirect::route('front_user_subscriptions',$request->user_id)->with('success','Your data is added successfully!');
	//    }else{
	//	Temp_payment::where('user_id',$request->user_id)->delete();
	//	$user                           	= new Temp_payment();
	//	$user->user_id				= $request->user_id;
	//	$user->subscription_id			= $subscription_id;
	//	$user->subscription_type        	= $request->sub_type;
	//	$start_date				= explode('/',$request->start_date);
	//	$user->tmp_start        		= $start_date[2].'-'.$start_date[0].'-'.$start_date[1].' 00:00:00';
	//	$end_date				= explode('/',$request->end_date);
	//	$user->tmp_end        			= $end_date[2].'-'.$end_date[0].'-'.$end_date[1].' 00:00:00';
	//	$user->save();
	//	Session::set('ADMIN_TEMP_SUBSCRIPE',$user->id);
	//    }
	}
	//if(Session::has('ADMIN_TEMP_SUBSCRIPE')){
	//    $data['subscription_list']      	= Temp_payment::find(Session::get('ADMIN_TEMP_SUBSCRIPE'));
	//    $data['user_details'] 		= Users::find($user_id);
	//    return view('admin.users.front_user.payment_form',$data);
	//}else{
	//    return Redirect::route('front_user_subscriptions',array($user_id));
	//}
    }
    public function front_user_payment(Request $request,$tmp_id){
	    $tmp_value = Temp_payment::find($tmp_id);
	    if($request->isMethod('post')){
		$success = 0;
		$merchantAuthentication = new AnetAPI\MerchantAuthenticationType();
		$merchantAuthentication->setName($this->setName);
		$merchantAuthentication->setTransactionKey($this->setTransactionKey);
		// Subscription Type Info
		
		$interval = new AnetAPI\PaymentScheduleType\IntervalAType();
		if($tmp_value->subscription_type == 'quarterly'){
		$interval->setLength('3');
		}else{
		$interval->setLength('12');   
		}
		$interval->setUnit("months");
		
		//$interval->setLength('16');
		//$interval->setUnit("days");
		
		$paymentSchedule = new AnetAPI\PaymentScheduleType();
		$paymentSchedule->setInterval($interval);
		$paymentSchedule->setStartDate(new \DateTime(date('Y-m-d',strtotime($tmp_value->tmp_start))));
		$paymentSchedule->setTotalOccurrences("9999");
		
		$creditCard = new AnetAPI\CreditCardType();
		$creditCard->setCardNumber($request->card_number);
		$creditCard->setExpirationDate($request->year."-".$request->month);
		$payment = new AnetAPI\PaymentType();
		$payment->setCreditCard($creditCard);
		
		$billTo = new AnetAPI\NameAndAddressType();
		$billTo->setFirstName($tmp_value->users->first_name);
		$billTo->setLastName($tmp_value->users->last_name);
		$billTo->setAddress($tmp_value->users->addess_line1);
		$billTo->setCity($tmp_value->users->city);
		$billTo->setZip($tmp_value->users->zip);
		
		$total_subscription 	= $tmp_value->subscription_id;
		
		    $subscription 	= new AnetAPI\ARBSubscriptionType();
		    $subscription->setName($tmp_value->subscription->subscription_title);
		    $subscription->setPaymentSchedule($paymentSchedule);
		    if($tmp_value->subscription_type == 'quarterly'){
		    $payment_amount = $tmp_value->subscription->quarterly_price;
		    $subscription->setAmount($tmp_value->subscription->quarterly_price);
		    }else{
		    $payment_amount = $tmp_value->subscription->yearly_price;
		    $subscription->setAmount($tmp_value->subscription->yearly_price);
		    }
		    $refId 	= 'ref' . time();
		    $subscription->setPayment($payment);
		    $subscription->setBillTo($billTo);
		    $request1 = new AnetAPI\ARBCreateSubscriptionRequest();
		    $request1->setmerchantAuthentication($merchantAuthentication);
		    $request1->setRefId($refId);
		    $request1->setSubscription($subscription);
		    $controller = new AnetController\ARBCreateSubscriptionController($request1);
		    $response 	= $controller->executeWithApiResponse( \net\authorize\api\constants\ANetEnvironment::SANDBOX);
		    //dd($response);
		    if (($response != null) && ($response->getMessages()->getResultCode() == "Ok") )
		    {
			$userpay 					= new User_payment;
			$userpay->user_id				= $tmp_value->user_id;
			$userpay->subscription_id			= $tmp_value->subscription_id;
			$userpay->total_amount				= $payment_amount;
			$userpay->subscription_type			= $tmp_value->subscription_type;
			$userpay->subscriptionId			= $response->getSubscriptionId();
			$userpay->customerProfileId			= $response->getProfile()->getCustomerProfileId();
			$userpay->customerPaymentProfileId		= $response->getProfile()->getCustomerPaymentProfileId();
			$userpay->refId					= $response->getrefId();
			$userpay->status				= $response->getMessages()->getMessage()[0]->getText();
			$userpay->save();
			
			$sub 			= new User_subscription;
			$sub->user_id 		= $tmp_value->user_id;
			$sub->subscription_id	= $tmp_value->subscription_id;
			$sub->subscription_type	= $tmp_value->subscription_type;
			$sub->type		= 'new';
			$sub->start_date	= $tmp_value->tmp_start;
			$sub->end_date		= $tmp_value->tmp_end;
			$sub->save();
			
			$tmp_value->delete();
			
			Session::forget('ADMIN_TEMP_SUBSCRIPE');
			
			$data['sub'] 		= User_payment::where('user_id',$userpay->user_id)->where('subscription_id',$userpay->subscription_id)->first();
			$pdf 			= \PDF::loadView('admin.subscription_invoice', $data);
			$data['file_name'] 	= time().'invoice.pdf';
			$pdf->save(public_path().'/pdf/'.$data['file_name']);
			
			$sitesettings           = Sitesetting::find(2);
			$data['from_email']     = $sitesettings->sitesettings_value;
			$data['form_name']      = "Aerepro" ;
			$data['to_email']       = $data['sub']->user->email;
			$data['to_name']        = $data['sub']->user->first_name;
			$data['subject']	= 'A&E Reprographics-Thank you for your Subscription';
			$mail = \Mail::send('emails.subscribe_user', $data, function ($message) use ($data) {
			    $message->from($data['from_email'], $data['form_name']);
			    $message->subject($data['subject']);
			    $message->to($data['to_email'] );
			    //$message->to('nasmin.begam@webskitters.com');
			    $message->attach(asset('pdf/'.$data['file_name']));
			});
			
			$mail = \Mail::send('emails.subscribe_user', $data, function ($message) use ($data) {
			    $message->from($data['from_email'], $data['form_name']);
			    $message->subject('Planroom Subscription Payment Processed');
			    $message->to(['planroom@a-erepro.com','accounts@a-erepro.com']);
			    //$message->to(['nasmin.begam@webskitters.com','tonmoy.nandy@webskitters.com']);
			    $message->attach(asset('pdf/'.$data['file_name']));
			});
			
			if(file_exists(public_path('pdf/'.$data['file_name']))){
			    unlink(public_path('pdf/'.$data['file_name']));
			}
			return Redirect::route('front_user_subscriptions',$data['sub']->user->id)->with('success','Thank you for Subscription');
		    
			
		    }else{
			$success = 0;
			$errorMessages = $response->getMessages()->getMessage();
			return Redirect::route('front_user_subscriptions',$tmp_value->user_id)->with('error',$errorMessages[0]->getText());
		    }
	}
    }
    public function front_users_edit($id){
	 $data           = array();
        $data['state']  = State::orderBy('state','ASC')->pluck('state','id')->all();
        $data['city']   = City::pluck('city','id')->all();
        $data['user_details'] = Users::find($id);
	//dd($data['profile']->roleuser[0]->role_id);
        $data['roles'] =  Role::pluck('name','id')->all();
        return view('admin.users.front_user.edit',$data);
    }
    public function front_user_update(Request $request)
    {
	    	$validator = Validator::make(
                            $request->all(),
                            [//'email'            => 'required|email|unique:users',
                             //'password'         => 'required|min:6',
                             //'retypepassword'   => 'required|same:password',
			    
                             'business_name'    => 'required|unique:users,business_name,'.$request->user_id,
                             'first_name'       => 'required',
                             'last_name'        => 'required',
			     //'licensed_contractor' => 'required',
                             ]);
        if ($validator->fails())
        {
            $messages = $validator->messages();
            return Redirect::back()->withErrors($validator)->withInput();
        }
        else
        {
            $user                           = Users::find($request->user_id);
	    if($request->password !=''){
			 $user->password                 = $request->password;
	    }
            //$user->token                    = str_random(8);
            //$user->email                    = $request->email;
           
            $user->business_name            = $request->business_name;
            $user->phone                    = $request->phone;
            $user->fax                      = $request->fax;
            $user->website_url              = $request->website_url;
            $user->first_name               = $request->first_name;
            $user->last_name                = $request->last_name;
            $user->addess_line1             = $request->addess_line1;
            $user->addess_line2             = $request->addess_line2;
            $user->city                     = $request->city;
            $user->state                    = $request->state;
            $user->zip                      = $request->zip;
            if($request->licensed_contractor!= null)
	    {
		$user->licensed_contractor      = $request->licensed_contractor;
		if($request->residential){
		    $user->residential      	= $request->residential;
		}
		if($request->commercial){
		    $user->commercial           = $request->commercial;
		}
	    }
	    else
	    {
		$user->licensed_contractor      = 'No';
	    }
            $user->status                   = $request->status;
            $user->save();
           
	   if($user->id)
                {
                   return Redirect::route('front_user_moreinfo',array($user->id))->with('success','Customer details updated successfully');
                }
                else
                {
                    return Redirect::route('front_user_moreinfo',array($user->id))->with('error','Customer details can not update');
                }
        }  
    }
    
    public function disable_subscriptions($id){
	
	$user 				= User_subscription::join('user_payments', 'user_payments.subscription_id', '=', 'user_subscriptions.subscription_id')->where('user_subscriptions.id',$id)->where('user_payments.type','subscription')->orderBy('user_payments.id','DESC')->first();
	$merchantAuthentication 	= new AnetAPI\MerchantAuthenticationType();
	$merchantAuthentication->setName($this->setName);
        $merchantAuthentication->setTransactionKey($this->setTransactionKey);
	$refId 				= 'ref' . time();
	$request 			= new AnetAPI\ARBCancelSubscriptionRequest();
	$request->setMerchantAuthentication($merchantAuthentication);
	$request->setRefId($refId);
	$request->setSubscriptionId($user->subscriptionId);
	$controller 			= new AnetController\ARBCancelSubscriptionController($request);
	$response 			= $controller->executeWithApiResponse( \net\authorize\api\constants\ANetEnvironment::SANDBOX);
	if (($response != null) && ($response->getMessages()->getResultCode() == "Ok"))
	{
	    $user			= User_subscription::find($id);
	    $user->auto_payment		= 'disable';
	    $user->save();
	    return Redirect::route('front_user_subscriptions',$user->user_id)->with('success','Payment is disable');
	}
	else
	{
	    $errorMessages = $response->getMessages()->getMessage();
	    return Redirect::route('front_user_subscriptions',$user->user_id)->with('error',$errorMessages[0]->getText());
	}
	
//	
//	$user 				= Users::find($id);
//	$merchantAuthentication 	= new AnetAPI\MerchantAuthenticationType();
//	$merchantAuthentication->setName($this->setName);
//        $merchantAuthentication->setTransactionKey($this->setTransactionKey);
//	$refId 				= 'ref' . time();
//	$request 			= new AnetAPI\ARBCancelSubscriptionRequest();
//	$request->setMerchantAuthentication($merchantAuthentication);
//	$request->setRefId($refId);
//	$userPay	= $user->pay()->where('subscriptionId','<>','')->orderBy('id','DESC')->first();
//	$request->setSubscriptionId($userPay->subscriptionId);
//	$controller 			= new AnetController\ARBCancelSubscriptionController($request);
//	$response 			= $controller->executeWithApiResponse( \net\authorize\api\constants\ANetEnvironment::SANDBOX);
//	if (($response != null) && ($response->getMessages()->getResultCode() == "Ok"))
//	{
//	    $user->payment_status	= 'disable';
//	    $user->save();
//	    return Redirect::route('front_user_subscriptions',$id)->with('success','Payment is disable');
//	}
//	else
//	{
//	    $errorMessages = $response->getMessages()->getMessage();
//	    return Redirect::route('front_user_subscriptions',$id)->with('error',$errorMessages[0]->getText());
//	}
    }
    public function enable_subscriptions($id){
	$merchantAuthentication 	= new AnetAPI\MerchantAuthenticationType();
	$merchantAuthentication->setName($this->setName);
	$merchantAuthentication->setTransactionKey($this->setTransactionKey);
	
	$refId = 'ref' . time();
	
	//Fetching data from Subscription table
	$subscribe = User_subscription::find($id);
        
        // Subscription Type Info
	$subscription 		= new AnetAPI\ARBSubscriptionType();
	$subscription->setName($subscribe->subscription->subscription_title);
	$interval 			= new AnetAPI\PaymentScheduleType\IntervalAType();
	    
	if($subscribe->subscription_type == 'quarterly'){
	    
	    $amount = $subscribe->subscription->quarterly_price;
	    $interval->setLength('3');
	}else{
	    $amount = $subscribe->subscription->yearly_price;
	    $interval->setLength('12');
	}
	if($subscribe->payment_expire == 'Yes'){
	    $date = date('Y-m-d');
	}else{
	    $date = date('Y-m-d',strtotime($subscribe->end_date));
	}
        
        
	$interval->setUnit("months");
	$paymentSchedule = new AnetAPI\PaymentScheduleType();
	$paymentSchedule->setInterval($interval);
	$paymentSchedule->setStartDate(new \DateTime($date));
	$paymentSchedule->setTotalOccurrences("9999");
	$subscription->setPaymentSchedule($paymentSchedule);
	$subscription->setAmount(number_format($amount,2));
	$creditCard = new AnetAPI\CreditCardType();
	$creditCard->setCardNumber($subscribe->user->card_no);
	$creditCard->setExpirationDate($subscribe->user->exp_year."-".$subscribe->user->exp_month);
	$payment = new AnetAPI\PaymentType();
	$payment->setCreditCard($creditCard);
	$subscription->setPayment($payment);
	$billTo = new AnetAPI\NameAndAddressType();
	$billTo->setFirstName($subscribe->user->first_name);
	$billTo->setLastName($subscribe->user->last_name);
	$subscription->setBillTo($billTo);
	$request1 = new AnetAPI\ARBCreateSubscriptionRequest();
	$request1->setmerchantAuthentication($merchantAuthentication);
	$request1->setRefId($refId);
	$request1->setSubscription($subscription);
	$controller = new AnetController\ARBCreateSubscriptionController($request1);
	$response = $controller->executeWithApiResponse( \net\authorize\api\constants\ANetEnvironment::SANDBOX);
	if (($response != null) && ($response->getMessages()->getResultCode() == "Ok") )
	{
	    $subscribe->auto_payment = 'enable';
	    $subscribe->save();
	    
	    $userpay 					= new User_payment;
	    $userpay->user_id				= $subscribe->user_id;
	    $userpay->subscription_id			= $subscribe->subscription_id;
	    $userpay->subscription_type 		= $subscribe->subscription_type;
	    $userpay->total_amount			= number_format($amount,2);
	    $userpay->type				= 'subscription';
	    $userpay->subscriptionId			= $response->getSubscriptionId();
	    $userpay->customerProfileId			= $response->getProfile()->getCustomerProfileId();
	    $userpay->customerPaymentProfileId		= $response->getProfile()->getCustomerPaymentProfileId();
	    $userpay->refId				= $response->geTrefId();
	    $userpay->status				= $response->getMessages()->getMessage()[0]->getText();
	    $userpay->save();
	    
	    return Redirect::route('front_user_subscriptions',$subscribe->user_id)->with('success','Thanks for enable auto-renewal');
	}else{
		
	    $errorMessages = $response->getMessages()->getMessage();
		//$data['error'] = $errorMessages[0]->getText();
	    return Redirect::route('front_user_subscriptions',$subscribe->user_id)->with('error',$errorMessages[0]->getText());
	}
    }
    public function front_users_delete($id){
        
	$affectedRows   = Users::where('id',$id)->delete();
        
        if($affectedRows){
            return Redirect::route('front_users')->with('success','Customer deleted Successfully!');
        }
        else{
            return Redirect::route('front_users')->with('error','Customer is not deleted!');
        }
    }
    public function front_transaction_history($id){
        $data['lists']  = User_payment::where('user_id',$id)->paginate(10);  
        return view('admin.users.front_user.transaction',$data);
    }

}
