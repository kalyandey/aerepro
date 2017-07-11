<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use \Validator, \Redirect;
use App\Users, App\Sitesetting, App\Profession, App\Csi_division, App\Trade, App\State, App\City, App\Permit,App\Project,App\Tracking,App\Building_report,App\Private_company,App\User_payment, App\Temp_payment,App\Subscription,App\Order_master,App\User_subscription,App\Email_templete;
use \Session, \Cart;
use Hash;
use \Auth;
use Illuminate\Support\Str;
use AuthorizeNetSIM;

use net\authorize\api\contract\v1 as AnetAPI;
use net\authorize\api\controller as AnetController;

class UserController extends Controller
{
    
    public $setName 		= '7B6Ejq2Lh';
    public $setTransactionKey 	= '523Us8tX9G2qsH2C';
    public function dashboard(){
	
	

        $data 			= array();
	$data['projectList']	= [];
        $today 			= \Carbon\Carbon::now()->subDays(0);
	$one_week_ago 		= \Carbon\Carbon::now()->subWeeks(1);
        $after_thirty_days 	= \Carbon\Carbon::now()->addDays(30)->format('Y-m-d');
        $today_date 		= \Carbon\Carbon::now()->subDays(0)->format('Y-m-d');
        //$today_date             = '2016-09-10';
        
        $dt                     = \Carbon\Carbon::now();
        $data['today_day']      = $dt->day;
        $data['today_dayname']  = $dt->format('l');
        
        $lastweek_from_date     = \Carbon\Carbon::now()->subWeek()->format('Y-m-d');
        $lastweek_to_date       = \Carbon\Carbon::now()->subDays(1)->format('Y-m-d');
        
	
	$county                 = User_subscription::select(\DB::raw('GROUP_CONCAT(DISTINCT subscription_id) as subscription_id'))->where('user_id',Session::get('USER_DETAILS')->id)->where('status','active')->whereDate('end_date', '>', \Carbon\Carbon::today()->toDateString())->first(); 
        $county_id              = '';
        if($county->subscription_id != '' && in_array('2',explode(',',$county->subscription_id))){
            $county_id              .= '18,';
        }
        if($county->subscription_id != '' && in_array('3',explode(',',$county->subscription_id))){
            $county_id              .= '7';
        }
        $county_id                   = rtrim($county_id,',');
	
	
        $data['newPermit'] 	= Permit::where('created_at', '>=', $one_week_ago)
					->where('created_at', '<=', $today)->count();
	$data['newPermit']	= Building_report::where(function($query) use ($lastweek_from_date,$lastweek_to_date) {
                                            $query->where('issued_date','>=',$lastweek_from_date);
                                            $query->where('issued_date','<=',$lastweek_to_date);
                                        })->where('type','issued')->whereIn('county_id',explode(',',$county_id))->count();
	$data['saveTrack']	= Tracking::orderBy('created_at','DESC')->where('user_id',Session::get('USER_DETAILS')->id)->limit(3)->get();
	$data['saveTrackCount']	= Tracking::where('user_id',Session::get('USER_DETAILS')->id)->count();
	if($this->planroomUrlCheck() > 0){
        $data['projectList']	= Project::orderBy('updated_at','DESC')->limit(5)->get();
	}
        $data['projectCalendar']= Tracking::orderBy('updated_at','DESC')->where('user_id',Session::get('USER_DETAILS')->id)
                                   ->whereHas('project', function ($q) use ($today_date,$after_thirty_days)
                                    {   $q->where(function($query) use ($today_date,$after_thirty_days) {
                                            $query->where('projects.bid_close_date','>=',$today_date);
                                            $query->where('projects.bid_close_date','<=',$after_thirty_days);
                                        });
                                        $q->orWhere(function($query) use ($today_date,$after_thirty_days) {
                                            $query->where('projects.pre_bid_meeting_date','>=',$today_date);
                                            $query->where('projects.pre_bid_meeting_date','<=',$after_thirty_days);
                                        });
                                        
                                     })
                                    ->limit(5)->get();
				    
	$data['user']		= Users::find(Session::get('USER_DETAILS')->id);
        $data['subscripe']	= Subscription::get();
	//$data['subscripe']	= User_subscription::where('user_id',$data['user']->id)->get();
        //dd($data['projectCalendar']); 
         return view('front.user.dashboard',$data);
    }
    
    
    public function getcalendar(){
        $data           = array();
	if($this->planroomUrlCheck() > 0){
        $events         = array();   
        $today_date 	= \Carbon\Carbon::now()->subDays(0)->format('Y-m-d');
        //$today_date     = '2016-08-01';
        $get_data       = Tracking::orderBy('updated_at','DESC')->where('user_id',Session::get('USER_DETAILS')->id)
                                   ->whereHas('project', function ($q) use ($today_date)
                                    {   $q->where(function($query) use ($today_date) {
                                            $query->where('projects.bid_close_date','>=',$today_date);
                                            $query->orWhere('projects.pre_bid_meeting_date','>=',$today_date);
                                            
                                         });
                                      })
                                    ->get();
                                      
                                      
       
                                     
        foreach($get_data as $val){
            $bid_close_date = strtotime($val->project->bid_close_date);
            $pre_bid_meeting_date = strtotime($val->project->pre_bid_meeting_date);
            $current_date = strtotime($today_date);
            
            if ($bid_close_date >= $current_date)
            {
                $events[] = \Calendar::event(
                $val->project->name, //event title
                true, //full day event?
                $val->project->bid_close_date, //start time (you can also use Carbon instead of DateTime)
                $val->project->bid_close_date, //end time (you can also use Carbon instead of DateTime)
                $val->project->id, //optionally, you can specify an event ID
                [
                'className' => 'eventhere',
                'color' => '#001F5B', 
                'start'=>$val->project->bid_close_date    
                //any other full-calendar supported parameters
                ]        
                );
                
            }  
            
            if ($pre_bid_meeting_date >= $current_date)
            {
                $events[] = \Calendar::event(
                $val->project->name, //event title
                true, //full day event?
                $val->project->pre_bid_meeting_date, //start time (you can also use Carbon instead of DateTime)
                $val->project->pre_bid_meeting_date, //end time (you can also use Carbon instead of DateTime)
                $val->project->id, //optionally, you can specify an event ID
                [
                'className' => 'eventprebid',
                'color' => 'red',   
                'textColor'=>'white', 
                'start'=>$val->project->pre_bid_meeting_date    
                //any other full-calendar supported parameters
                ]        
                );
            }  

            
            
        }                              
        
        $calendar = \Calendar::addEvents($events,[
        /*'color' => '#001F5B',*/
        'editable'=>true    
    ])->setCallbacks([
        'eventClick' => 'function(calEvent, jsEvent, view) { project_details(calEvent.id)}',
        'eventRender'=> 'function (event, element, monthView) { 
                if (event.className == "eventhere") {
                   date = getEventDate(event); 
                   $(\'.fc-day-number[data-date="\' + date + \'"]\').addClass("reddate");    
                }
            }'
    ]); 
        
        
        
        return view('front.user.eventcalendar',$data,compact('calendar'));
    }else{
        return view('front.permission_denied',$data);
        }
    }
    
    
    public function register(){
	
	
	if(Session::has('USER_DETAILS') && Session::get('USER_DETAILS')->id != ''){
            return Redirect::route('dashboard');
        }elseif(Session::has('PRIVATE_COMPANY_DETAILS') && Session::get('PRIVATE_COMPANY_DETAILS')->id != ''){
	    $company = Private_company::find(Session::get('PRIVATE_COMPANY_DETAILS')->id);
	    return Redirect::route('public_planroom_list_for_company',[$company->company_slug]);
	}elseif(Session::has('PRIVATE_USER_DETAILS') && Session::get('PRIVATE_USER_DETAILS')->id != ''){
	    $company_slug = Session::get('COMPANY_SLUG');
	    return Redirect::route('public_planroom_list_for_user',[$company_slug]);
	}
	
	if(!Session::has('TEMP_SUBSCRIPE') && Session::get('TEMP_SUBSCRIPE') == ''){
	    return Redirect::route('planroom');
	}
	
        $data           = array();
        $data['state']  = State::orderBy('state','ASC')->pluck('state','id')->all();
        $data['city']   = City::pluck('city','id')->all();
        return view('front.user.register',$data);
    }
    
    public function register_post(Request $request){
	if(!Session::has('TEMP_SUBSCRIPE') && Session::get('TEMP_SUBSCRIPE') == ''){
	    return Redirect::route('planroom');
	}
	
        $validator = Validator::make(
                            $request->all(),
                            ['email'            => 'required|email|unique:users',
                             'password'         => 'required|min:6',
                             'retypepassword'   => 'required|same:password',
                             'business_name'    => 'required|unique:users',
                             'first_name'       => 'required',
                             'last_name'        => 'required',
                             'terms_of_service' => 'required',
                             'privacy_policy'   => 'required'
                             ]);
        if ($validator->fails())
        {
            $messages = $validator->messages();
            return Redirect::back()->withErrors($validator)->withInput();
        }
        else
        {
            $user                           = new Users();
            $user->token                    = str_random(8);
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
            //$user->licensed_contractor      = $request->licensed_contractor;
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
            $user->status                   = 'Inactive';
            $user->save();
	    
	    $tmp_payment 		    = Temp_payment::find(Session::get('TEMP_SUBSCRIPE'));
	    $tmp_payment->user_id	    = $user->id;
	    $tmp_payment->save();
            
            Session::set('USER_ID',$user->id);
            Session::set('USER_PASSWORD',base64_encode($request->password));
            
            return Redirect::route('register_moreinfo');
        }
    }
    
    public function more_info(Request $request){
	
        $data = array();
        if(Session::has('USER_ID')){
            if($request->action == "Process"){
                
                $profession             = $request->profession;
                $division               = $request->division;
                $trade                  = $request->trade;
                
                $profession             = implode(',',$profession);
                $division               = implode(',',$division);
                $trade                  = implode(',',$trade);
                
                $user                   = Users::find(Session::get('USER_ID'));
                $user->profession       = $profession;
                $user->division         = $division;
                $user->trade            = $trade;
                $user->save();
                if($user->id){
		    $emailtmp		    = Email_templete::find(3);
		    
                    $sitesettings           = Sitesetting::find(2);
                    $data['from_email']     = $sitesettings->sitesettings_value;
                    $data['form_name']      = "Aerepro" ;
                    $data['to_email']       = $user->email;
		    //$data['to_email']       = 'nasmin.begam@webskitters.com';
                    $data['to_name']        = $user->first_name;
                    $data['password']       = base64_decode(Session::get('USER_PASSWORD'));
                    $data['token']          = $user->token;
		    $data['subject']        = $emailtmp->email_subject;
                    
		    $data['msg']	    = str_replace(array('{TO_NAME}','{TO_EMAIL}','{PASSWORD}','{PAYMENT_PROCESS_URL}'),array($user->first_name,$user->email,$data['password'],\URL::route('payment_process',[$data['token']])),$emailtmp->email_content);
                    \Mail::send('emails.common', $data, function ($message) use ($data) {
                        $message->from($data['from_email'], $data['form_name']);
                        $message->subject($data['subject']);
                        $message->to($data['to_email'] );
                    });
                    
                    Session::set('USER_ID','');
                    Session::forget('USER_ID');
                    Session::forget('USER_PASSWORD');
                    return Redirect::route('thankyou')->with('success','Thank you! Your account has been created! <br>Please verify it by clicking the activation link that has been sent to your email.<br>If you\'d like to use a different email address. Please <a href="'.\URL::route("resendMail",[$data['token']]).'">click here</a>');
                }
            }
        $data['profession']     = Profession::where('profession_status','Active')->get();
        $data['division']       = Csi_division::where('division_status','Active')->get();
        $data['trade']          = Trade::where('trade_status','Active')->get();
        return view('front.user.moreinfo',$data);
        }else{
            return Redirect::route('register');
        }
    }
    public function thankyou(){
        $data = array();
        return view('front.user.thankyou',$data);
    }
    
    public function active_user($token){
        $user = Users::where('token',$token)->first();
        if($user){
            $users = Users::find($user->id);
            $users->status = 'Active';
            $users->token  = '';
            $users->save();
            return Redirect::route('thankyou')->with('success','Your account is activated successfully! <br><a href="'.\URL::route('planroom').'">Click here</a> to login');
        }else{
            return Redirect::route('thankyou')->with('error','Account not found');
        }
    }
    
    public function login(Request $request){
        if(Session::has('USER_DETAILS') && Session::get('USER_DETAILS')->id != ''){
            return Redirect::route('dashboard');
        }elseif(Session::has('PRIVATE_COMPANY_DETAILS') && Session::get('PRIVATE_COMPANY_DETAILS')->id != ''){
	    $company = Private_company::find(Session::get('PRIVATE_COMPANY_DETAILS')->id);
	    return Redirect::route('public_planroom_list_for_company',[$company->company_slug]);
	}elseif(Session::has('PRIVATE_USER_DETAILS') && Session::get('PRIVATE_USER_DETAILS')->id != ''){
	    $company_slug = Session::get('COMPANY_SLUG');
	    return Redirect::route('public_planroom_list_for_user',[$company_slug]);
	}
	
        $data = array();
        if(count($request->request) > 0){
            $email      = $request->email;
            $password   = $request->password;
            $user       = Users::select('id','password','first_name','last_name')->where('email',$email)->where('status','Active')->first();
            if($user){
                if(\Hash::check($password,$user->password) ){
                    Session::set('USER_DETAILS',$user);
                    $_SESSION = 'abcdef';
                    if ($redirect = Session::get('url.intended')) {
                        Session::forget('url.intended');
                        return Redirect::to($redirect);
                    } else {
                        return Redirect::route('dashboard');
                    }
                }else{
                    $data['error'] = 'Please enter valid login details';
                }
            }else{
                $data['error'] = 'Please enter valid email and password';
            }
        }
        return view('front.user.login',$data);
    }
    
    public function logout(){
	Cart::destroy();
        Session::forget('USER_DETAILS');
	if(Session::get('url.intended')){
        Session::forget('url.intended');
        }
        return Redirect::route('planroom');
    }
    
    public function free_consultant_action(Request $request)
    {
        $setting_email_value = Sitesetting::find(1);
        
        $message 		= $request->message;
        $name   		= $request->name;
        $email   		= $request->email;
        $phone   		= $request->phone;
        $data['from_email'] 	= $email;
        $data['to_email']   	= $setting_email_value->sitesettings_value;
        $data['from_name']  	= $name;
        $data['phone']      	= $phone;
        $data['msg']        	= $message;
        \Mail::send('emails.free_consult', $data, function ($message) use ($data) {
                    $message->from($data['from_email'], $data['from_name']);
                    $message->subject('Free Consultation Query');
                    $message->to($data['to_email'] );
        });
        
        return Redirect::route('thankyou')->with('success','Post successfully.');
        
    }
    
    public function edit_customer_profile()
    {
	
        $data = array();
        $data['profession']     = Profession::where('profession_status','Active')->get();
        $data['division']       = Csi_division::where('division_status','Active')->get();
        $data['trade']          = Trade::where('trade_status','Active')->get();
        $data['state']          = State::orderBy('state','ASC')->pluck('state','id')->all();
        $data['city']           = City::pluck('city','id')->all();
        
        $data['list'] 		= Order_master::where('user_id',Session::get('USER_DETAILS')->id)->orderBy('created_at','desc')->get();
        //return view('front.order.index',$data);
    
        $logged_user_id 	= Session::get('USER_DETAILS')->id;
        if($logged_user_id)
        {
	    $data['user_payment_details'] 		= User_payment::where('user_id',$logged_user_id)->get();
	    //dd($data['user_payment_details']);
            $user_details 		= Users::find($logged_user_id);
            $data['user_details']       = $user_details;
	    $data['subscribeUser']	= Subscription::join('user_subscriptions', 'user_subscriptions.subscription_id', '=', 'subscriptions.id')->where('user_subscriptions.user_id',Session::get('USER_DETAILS')->id)->get();
	    
	    $notSubscribe       	= Subscription::whereNotIn('subscriptions.id',explode(',',$user_details->subscription_id))->get();
	    $data['notSubscribe']	= [];
	    if(count($notSubscribe) > 0){
		foreach($notSubscribe as $k=>$nSub){
		    if(count($nSub->user_subscription()->where('user_id',Session::get('USER_DETAILS')->id)->get())== 0){
			$data['notSubscribe'][$k]	= $nSub;
		    }
		}
	    }
	    return view('front.user.edit_customer_profile',$data);
        }
        else
        {
            return Redirect::route('planroom');
        }
    }
    
    
    public function subscription_details_pdf($id)
    {
	$data = array();
	
	$logged_user_id 	= Session::get('USER_DETAILS')->id;
        if($id)
        {
	    $data['user_payment_details'] 		= User_payment::find($id);
	
	}
	//dd($data['user_payment_details']);
        $pdf = \App::make('dompdf.wrapper');
        $str = view('front.user.subscription_details_pdf',$data);
        $str = $str->render();
        $pdf->loadHTML($str)->setPaper('letter','portrait');
        return $pdf->stream();
	
    }
    
    
    public function after_subscription_payment(Request $request){
	if($request->isMethod('post')){
	    $data 	= array();
	    $subId 	= $request->subId;
	    for($i=0;$i<count($subId);$i++){
		$subscribe = 'newSubscribe_'.$subId[$i];
		if($request->$subscribe != ''){
		    $data['subscription_id'][$subId[$i]] 	= $subId[$i];
		    $data['subscription_type'][$subId[$i]] 	= $request->$subscribe;
		}
	    }
	    if(count($data) > 0){
		$data['subscription_list']      	= Subscription::whereIn('id',$data['subscription_id'])->get();
		$logged_user_id 			= Session::get('USER_DETAILS')->id;
		if($logged_user_id)
		{
		    $user_details 			= Users::find($logged_user_id);
		    $data['user_details']       	= $user_details;
		}
		$data['newsubscriptionFees']    = $request->newsubscriptionFees;
		return view('front.user.new_sucsribe_info',$data);
	    }else{
		return Redirect::route('edit_customer_profile');
	    }
	}else{
	    return Redirect::route('edit_customer_profile');
	}
    }
    
    public function new_subscription_payment(Request $request){
	$data['user'] 	= Users::find(Session::get('USER_DETAILS')->id);
	if($request->isMethod('post')){
	    $success 		= 0;
	    $merchantAuthentication = new AnetAPI\MerchantAuthenticationType();
	    $merchantAuthentication->setName($this->setName);
	    $merchantAuthentication->setTransactionKey($this->setTransactionKey);
	    // Subscription Type Info
	    
	    $interval = new AnetAPI\PaymentScheduleType\IntervalAType();

	    $paymentSchedule = new AnetAPI\PaymentScheduleType();
	    $paymentSchedule->setStartDate(new \DateTime(date('Y-m-d')));
	    $paymentSchedule->setTotalOccurrences("9999");
	    
	    $creditCard = new AnetAPI\CreditCardType();
	    $creditCard->setCardNumber($request->card_number);
	    $creditCard->setExpirationDate($request->year."-".$request->month);
	    $payment = new AnetAPI\PaymentType();
	    $payment->setCreditCard($creditCard);
	    
	    $billTo = new AnetAPI\NameAndAddressType();
	    $billTo->setFirstName($data['user']->first_name);
	    $billTo->setLastName($data['user']->last_name);
	    
	    $total_subscription 	= $request->subscription_id;
	    $total_subscription		= explode(',',$total_subscription);
	    $subscription_type		= explode(',',$request->subscription_type);
	    $total_amount		= 0;
	    for($i=0;$i<count($total_subscription);$i++){
		
		$sub 		= Subscription::find($total_subscription[$i]);
		if($subscription_type[$i] == 'quarterly'){
		    $payment_amount = $sub->quarterly_price;
		    $total_amount   += $payment_amount;
		    $interval->setLength('3');
		}else{
		    $payment_amount = $sub->yearly_price;
		    $total_amount   += $payment_amount;
		    $interval->setLength('12');   
		}
		$interval->setUnit("months");
		$paymentSchedule->setInterval($interval);
		
		$subscription 	= new AnetAPI\ARBSubscriptionType();
		$subscription->setName($sub->subscription_title);
		$subscription->setPaymentSchedule($paymentSchedule);
		$subscription->setAmount($payment_amount);
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
		    $success = 1;
		    $userpay 					= new User_payment;
		    $userpay->user_id				= $data['user']->id;
		    $userpay->subscription_id			= $total_subscription[$i];
		    $userpay->total_amount			= $payment_amount;
		    $userpay->subscription_type			= $subscription_type[$i];
		    $userpay->subscriptionId			= $response->getSubscriptionId();
		    $userpay->customerProfileId			= $response->getProfile()->getCustomerProfileId();
		    $userpay->customerPaymentProfileId		= $response->getProfile()->getCustomerPaymentProfileId();
		    $userpay->refId				= $response->getrefId();
		    $userpay->status				= $response->getMessages()->getMessage()[0]->getText();
		    $userpay->save();
		    
		    
		    if($subscription_type[$i] == 'quarterly'){
			$dt 			= \Carbon\Carbon::now();
			$payment_end_date	= $dt->addMonths(3);
		    }elseif($subscription_type[$i] == 'yearly'){
			$dt 			= \Carbon\Carbon::now();
			$payment_end_date	= $dt->addYears(1);
		    }
		    
		    $sub 			= new User_subscription;
		    $sub->user_id 		= $data['user']->id;
		    $sub->subscription_id	= $total_subscription[$i];
		    $sub->subscription_type	= $subscription_type[$i];
		    $sub->type			= 'subscribe';
		    $sub->start_date		= date('Y-m-d H:i:s');
		    $sub->end_date		= $payment_end_date;
		    $sub->save();
		}else{
		    $success = 0;
		    $errorMessages = $response->getMessages()->getMessage();
		    return Redirect::route('thankyou')->with('error',$errorMessages[0]->getText());
		}
	    }
	    
	    if($success == 1){
		
		$setting_email_value    	= Sitesetting::find(1);
		$data['from_email']     	= $setting_email_value->sitesettings_value;
		$data['from_name']      	= 'Aerepro';
		
		$emailtmp		    	= Email_templete::find(4);
		$data['msg']	    		= $emailtmp->email_content;
		
		$data['subject']	    	= $emailtmp->email_subject;
		$data['to_email']       	= $data['user']->email;
		$data['total_amount']		= $total_amount;
		
		//$data['item']			= Subscription::select(array(\DB::raw('GROUP_CONCAT(DISTINCT subscription_title) as title ')))->whereIn('id',$total_subscription)->first();
		
		$data['sub'] 			= User_subscription::whereIn('subscription_id',$total_subscription)->where('user_id',$data['user']->id)->get();
		//dd($data['sub']);
		$pdf 				= \PDF::loadView('front.subscription_invoice', $data);
		$data['file_name'] 		= time().'invoice.pdf';
		$pdf->save(public_path().'/pdf/'.$data['file_name']);
		
		$mail = \Mail::send('emails.newSubscribe', $data, function ($message) use ($data) {
                        $message->from($data['from_email'], $data['from_name']);
                        $message->subject($data['subject']);
                        $message->to($data['to_email'] );
			//$message->to('nasmin.begam@webskitters.com');
			$message->attach(asset('pdf/'.$data['file_name']));
                    });
		
		if(file_exists(public_path().'/pdf/'.$data['file_name'])){
		    unlink(public_path().'/pdf/'.$data['file_name']);
		}
		//$mail = \Mail::send('emails.newSubscribe', $data, function ($message) use ($data) {
		//    $message->from($data['from_email'], $data['from_name']);
		//    $message->subject('New item is added to account');
		//    $message->to($data['to_email'] );
		//});
		
		return Redirect::route('thankyou')->with('success','Thanks for your subscription');
	    
	    }else{
		
		return Redirect::route('thankyou')->with('error','Charge Credit card Null response returned');
	    }
	}
    }
    public function update_customer_profile(Request $request)
    {
        $validator = Validator::make(
                            $request->all(),
                            [
                             'business_name'    => 'required|unique:users,business_name,'.$request->user_id,
                             'first_name'       => 'required',
                             'last_name'        => 'required',
                            
                             ]);
        if ($validator->fails())
        {
            $messages = $validator->messages();
            return Redirect::back()->withErrors($validator)->withInput();
        }
        else
        {
            $user                           = Users::find($request->user_id);
	    $user->business_name	    = $request->business_name;	
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
            $user->save();
            if($user->id)
            {
                return Redirect::back()->with('success','Your account updated successfully.');
            }
            else
            {
                return Redirect::back()->with('error','Your account can not update.');
            }
            
        }
    }
    
    public function update_customer_moreinfo(Request $request){
         $data = array();
         $logged_user_id = Session::get('USER_DETAILS')->id;
        if($logged_user_id)
        {
            if($request->action == "Process"){
                
                $profession = $division = $trade = '';
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
                
                
                $user                   = Users::find($logged_user_id);
                $user->profession       = $profession;
                $user->division         = $division;
                $user->trade            = $trade;
                $user->save();
                if($user->id)
                {
                    return Redirect::back()->with('success','Your account updated successfully.');
                }
                else
                {
                    return Redirect::back()->with('error','Your account can not update.');
                }
            }
       
       
        }else{
            return Redirect::route('register');
        }
    }
    
    public function update_card_info(Request $request){
	$data = array();
	$logged_user_id = Session::get('USER_DETAILS')->id;
        if($logged_user_id)
        {
            if($request->action == "Process"){
		
		$user                   = Users::find($logged_user_id);
		
		if(($user->card_no != $request->card_number_value) || ($user->exp_year != $request->exp_year) || ($user->exp_month != $request->exp_month)){
		    
		    $subscribe = User_subscription::join('user_payments','user_payments.subscription_id','=','user_subscriptions.subscription_id')->orderBy('user_payments.id','DESC')->where('user_subscriptions.user_id',$logged_user_id)->where('user_payments.user_id',$logged_user_id)->where('user_subscriptions.auto_payment','enable')->get();
		    //$subscribe = $user->pay()->where('type','subscription')->get();
		    $merchantAuthentication = new AnetAPI\MerchantAuthenticationType();
		    $merchantAuthentication->setName($this->setName);
		    $merchantAuthentication->setTransactionKey($this->setTransactionKey);
		    
		    $refId 			= 'ref' . time();
		    $subscription 		= new AnetAPI\ARBSubscriptionType();
		    $creditCard 		= new AnetAPI\CreditCardType();
		    $creditCard->setCardNumber($request->card_number_value);
		    $creditCard->setExpirationDate($request->exp_year."-".$request->exp_month);
		    $payment 		= new AnetAPI\PaymentType();
		    $payment->setCreditCard($creditCard);
		    
		    $subscription->setPayment($payment);
		    
		    foreach($subscribe as $s){
			
			$request1 = new AnetAPI\ARBUpdateSubscriptionRequest();
			$request1->setMerchantAuthentication($merchantAuthentication);
			$request1->setRefId($refId);
			$request1->setSubscriptionId($s->subscriptionId);
			$request1->setSubscription($subscription);
			$controller = new AnetController\ARBUpdateSubscriptionController($request1);
			$response = $controller->executeWithApiResponse( \net\authorize\api\constants\ANetEnvironment::SANDBOX);
			if (($response != null) && ($response->getMessages()->getResultCode() == "Ok") )
			{ }
			else
			{
			    $errorMessages = $response->getMessages()->getMessage();
			    
			    return Redirect::to('edit_customer_profile'.'#card_details')->with('error',$errorMessages[0]->getCode() . "  " .$errorMessages[0]->getText());
			}
			
		    }
		    
		    
		}
		$user->card_no       		= $request->card_number_value;
		$user->exp_year         	= $request->exp_year;
		$user->exp_month        	= $request->exp_month;
		$user->cvv			= $request->cvv;
		$user->save();
		if($user->id)
		{
		    return Redirect::to('edit_customer_profile'.'#card_details')->with('success','Your account updated successfully.');
		}
		else
		{
		    return Redirect::back()->with('error','Your account can not update.');
		}
		
		
            }
        }else{
            return Redirect::route('register');
        }
    }
    
    public function add_card_info(Request $request){
	$data = array();
	$logged_user_id = Session::get('USER_DETAILS')->id;
        if($logged_user_id)
        {
            if($request->action == "Process"){
		$user                   	= Users::find($logged_user_id);
		$user->card_no       		= $request->card_no;
		$user->exp_year         	= $request->exp_year;
		$user->exp_month        	= $request->exp_month;
		$user->cvv			= $request->cvv;
		$user->delete_card		= 'No';
		$user->save();
		if($user->id)
		{
		    return Redirect::to('edit_customer_profile'.'#card_details')->with('success','Your card information is added successfully.');
		}
		else
		{
		    return Redirect::back()->with('error','Your card information can not add.');
		}
            }
        }else{
            return Redirect::route('register');
        }
    }

    
    public function delete_card_info(){
	$logged_user_id 	= Session::get('USER_DETAILS')->id;
	$subscribe 		= User_subscription::select('user_subscriptions.id as usersId','user_payments.subscriptionId as subscriptionId')->join('user_payments','user_payments.subscription_id','=','user_subscriptions.subscription_id')->orderBy('user_payments.id','DESC')->where('user_subscriptions.user_id',$logged_user_id)->where('user_payments.user_id',$logged_user_id)->where('user_subscriptions.auto_payment','enable')->get();
	$merchantAuthentication = new AnetAPI\MerchantAuthenticationType();
	$merchantAuthentication->setName($this->setName);
        $merchantAuthentication->setTransactionKey($this->setTransactionKey);
	$refId = 'ref' . time();
	if(count($subscribe) > 0){
	    foreach($subscribe as $s){
		$request = new AnetAPI\ARBCancelSubscriptionRequest();
		$request->setMerchantAuthentication($merchantAuthentication);
		$request->setRefId($refId);
		$request->setSubscriptionId($s->subscriptionId);
		$controller = new AnetController\ARBCancelSubscriptionController($request);
		$response = $controller->executeWithApiResponse( \net\authorize\api\constants\ANetEnvironment::SANDBOX);
		if (($response != null) && ($response->getMessages()->getResultCode() == "Ok"))
		{
		    $user_subscribe = User_subscription::find($s->usersId);
		    $user_subscribe->auto_payment = 'disable';
		    $user_subscribe->save();
		
		}else{
		    $errorMessages = $response->getMessages()->getMessage();
		    return Redirect::to('edit_customer_profile'.'#delete_card')->with('error',$errorMessages[0]->getText());
		}
	    }
	}
	$user 			= Users::find($logged_user_id);
	$user->delete_card		= 'Yes';
	$user->card_no		= '';
	$user->exp_year		= '';
	$user->exp_month		= '';
	$user->cvv			= '';
	$user->save();
	
	return Redirect::to('edit_customer_profile')->with('success','Your card is deleted successfully');
    }
    public function change_password() 
    {
        $data = array();
        $logged_user_id = Session::get('USER_DETAILS')->id;
        
	$user_details = Users::find($logged_user_id);
	$data['user_details']       = $user_details;
	return view('front.user.change_customer_password',$data);
       
    }
    
    public function change_password_update(Request $request)
    {
        $validator = Validator::make(
                            $request->all(),
                            [
                             'old_password'     => 'required',
                             'password'         => 'required|min:8',
                             'retypepassword'   => 'required|same:password',
                             
                             ]);
        if ($validator->fails())
        {
            $messages = $validator->messages();
            return Redirect::back()->withErrors($validator)->withInput();
        }
        else
        {
            
            $old_password       = $request->old_password;
            $new_password       = $request->password;
            $confirm_password   = $request->retypepassword;
            $user               = Users::find($request->user_id);
            if(Hash::check($old_password,$user->password)){
                $user->password = $new_password;
                $user->save();
                return Redirect::route('change_password')->with('success','Password is updated successfully');
            }else{
               return Redirect::route('change_password')->with('error','Old Password does not matched');
            }
        }
    }
    
    public function resendMail(Request $request,$token){
	$user = Users::where('token',$token)->first();
	if(count($user) > 0){
	    $data['token'] 	= $token;
	    if($request->isMethod('post')){
		
		$sitesettings           = Sitesetting::find(2);
		$data['from_email']     = $sitesettings->sitesettings_value;
		$data['form_name']      = "Aerepro" ;
		$data['to_email']       = $request->resend_email;
		$data['to_name']        = $user->first_name;
		$data['token']          = $user->token;
		
		\Mail::send('emails.resend_mail', $data, function ($message) use ($data) {
		    $message->from($data['from_email'], $data['form_name']);
		    $message->subject('Signup | Verification');
		    $message->to($data['to_email'] );
		});
		
		return Redirect::route('thankyou')->with('success','Please verify it by clicking the activation link that has been sent to your email.');
	    
	    }else{
		return view('front.user.resend_mail',$data);
	    }
	}else{
	    
	    return Redirect::route('thankyou')->with('error','User does not exist!');
	}
	
    }
    
    public function subscription(Request $request){
	if($request->isMethod('post')){
	    $user                           = new Temp_payment();
            $user->subscription_type        = $request->subscription;
	    if($request->subscription == 'quarterly'){
		$user->subscription_id          = implode(',',$request->subscriptionQuarterly);
	    }else{
		$user->subscription_id          = implode(',',$request->subscriptionYearly);
	    }
	    $user->save();
	    Session::set('TEMP_SUBSCRIPE',$user->id);
	    return Redirect::route('register');
	}
    }
    
    public function payment_process(Request $request,$token){
	//phpinfo();die;
	$data 		= array();
	$data['user'] 	= Users::where('token',$token)->first();
	if(count($data['user']) > 0){
	if($request->isMethod('post')){
		$success = 0;
		$merchantAuthentication = new AnetAPI\MerchantAuthenticationType();
		$merchantAuthentication->setName($this->setName);
		$merchantAuthentication->setTransactionKey($this->setTransactionKey);
		// Subscription Type Info
		
		$interval = new AnetAPI\PaymentScheduleType\IntervalAType();
		if($data['user']->temp_payment->subscription_type == 'quarterly'){
		$interval->setLength('3');
		}else{
		$interval->setLength('12');   
		}
		$interval->setUnit("months");
		
		//$interval->setLength('16');
		//$interval->setUnit("days");
		
		$paymentSchedule = new AnetAPI\PaymentScheduleType();
		$paymentSchedule->setInterval($interval);
		$paymentSchedule->setStartDate(new \DateTime(date('Y-m-d')));
		$paymentSchedule->setTotalOccurrences("9999");
		
		$creditCard = new AnetAPI\CreditCardType();
		$creditCard->setCardNumber($request->card_number);
		$creditCard->setExpirationDate($request->year."-".$request->month);
		$payment = new AnetAPI\PaymentType();
		$payment->setCreditCard($creditCard);
		
		$billTo = new AnetAPI\NameAndAddressType();
		$billTo->setFirstName($data['user']->first_name);
		$billTo->setLastName($data['user']->last_name);
		$billTo->setAddress($data['user']->addess_line1);
		$billTo->setCity($data['user']->city);
		$billTo->setZip($data['user']->zip);
		
		$total_subscription 	= $data['user']->temp_payment->subscription_id;
		$total_subscription	= explode(',',$total_subscription);
		for($i=0;$i<count($total_subscription);$i++){
		    
		    $sub 		= Subscription::find($total_subscription[$i]);
		    $subscription 	= new AnetAPI\ARBSubscriptionType();
		    $subscription->setName($sub->subscription_title);
		    $subscription->setPaymentSchedule($paymentSchedule);
		    if($data['user']->temp_payment->subscription_type == 'quarterly'){
		    $payment_amount = $sub->quarterly_price;
		    $subscription->setAmount($sub->quarterly_price);
		    }else{
		    $payment_amount = $sub->yearly_price;
		    $subscription->setAmount($sub->yearly_price);
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
			
			$success 					= 1;
			$userpay 					= new User_payment;
			$userpay->user_id				= $data['user']->id;
			$userpay->subscription_id			= $total_subscription[$i];
			$userpay->total_amount				= $payment_amount;
			$userpay->subscription_type			= $data['user']->temp_payment->subscription_type;
			$userpay->subscriptionId			= $response->getSubscriptionId();
			$userpay->customerProfileId			= $response->getProfile()->getCustomerProfileId();
			$userpay->customerPaymentProfileId		= $response->getProfile()->getCustomerPaymentProfileId();
			$userpay->refId					= $response->getrefId();
			$userpay->status				= $response->getMessages()->getMessage()[0]->getText();
			$userpay->save();
			
			if($data['user']->temp_payment->subscription_type == 'quarterly'){
			$dt 			= \Carbon\Carbon::now();
			$payment_end_date	= $dt->addMonths(3);
			}elseif($data['user']->temp_payment->subscription_type == 'yearly'){
			$dt 			= \Carbon\Carbon::now();
			$payment_end_date	= $dt->addYears(1);
			}
			
			$sub 			= new User_subscription;
			$sub->user_id 		= $data['user']->id;
			$sub->subscription_id	= $total_subscription[$i];
			$sub->subscription_type	= $data['user']->temp_payment->subscription_type;
			$sub->type		= 'new';
			$sub->start_date	= date('Y-m-d H:i:s');
			$sub->end_date		= $payment_end_date;
			$sub->save();
			
		    }else{
			$success = 0;
			$errorMessages = $response->getMessages()->getMessage();
			return Redirect::route('thankyou')->with('error',$errorMessages[0]->getText());
		    }
		}
		if ($success == 1)
		{
		    
		    $u 				= Users::find($data['user']->id);
		    $u->status			= 'Active';
		    $u->card_no			= $request->card_number;
		    $u->exp_year		= $request->year;
		    $u->exp_month		= $request->month;
		    $u->cvv			= $request->cvv;
		    $u->token 			= '';
		    $u->invoice 		= str_random(8).$data['user']->id;
		    $u->save();
		    
		    Temp_payment::where('user_id',$data['user']->id)->delete();
		    
		    
		    $data['sub'] = User_payment::where('user_id',$data['user']->id)->where('type','subscription')->where(\DB::raw('DATE_FORMAT(created_at,"%Y-%m-%d")'),date('Y-m-d'))->get();
	
		    //$data['sub'] = User_payment::where('user_id',$data['user']->id)->where('type','subscription')->get();
		    //echo view('front.subscription_invoice', $data);
		    
		    $pdf 		= \PDF::loadView('front.subscription_invoice', $data);
		    $data['file_name'] 	= time().'invoice.pdf';
		    $pdf->save(public_path().'/pdf/'.$data['file_name']);
		    
		    $emailtmp		    = Email_templete::find(2);
		    
		    $sitesettings           = Sitesetting::find(2);
                    $data['from_email']     = $sitesettings->sitesettings_value;
                    $data['form_name']      = "Aerepro" ;
                    $data['to_email']       = $u->email;
                    $data['to_name']        = $u->first_name;
		    $data['invoice']        = $u->invoice;
                    $data['subject']	    = $emailtmp->email_subject;
		    
		    $data['msg']	    = str_replace(array('{TO_NAME}','{LOGIN_URL}','{INVOICE_URL}'),array($u->first_name,\URL::route('planroom'),\URL::route('print_details',[$data['invoice']])),$emailtmp->email_content);
                    $mail = \Mail::send('emails.common', $data, function ($message) use ($data) {
                        $message->from($data['from_email'], $data['form_name']);
                        $message->subject($data['subject']);
                        $message->to($data['to_email'] );
			//$message->to('nasmin.begam@webskitters.com');
			$message->attach(asset('pdf/'.$data['file_name']));
                    });
		    
		    $mail = \Mail::send('emails.active_user', $data, function ($message) use ($data) {
                        $message->from($data['from_email'], $data['form_name']);
                        $message->subject('Planroom Subscription Payment Processed');
                        $message->to(['planroom@a-erepro.com','accounts@a-erepro.com']);
			//$message->to(['nasmin.begam@webskitters.com','tonmoy.nandy@webskitters.com']);
			$message->attach(asset('pdf/'.$data['file_name']));
                    });
		    
		    if(file_exists(public_path('pdf/'.$data['file_name']))){
			unlink(public_path('pdf/'.$data['file_name']));
		    }
		    return Redirect::route('thankyou')->with('success','Thank you for registering . Your payment has been successfully processed.<br> <a href="'.\URL::route('planroom').'">Click here</a> to login.<br>OR<br><a href="'.\URL::route('print_details',[$u->invoice]).'">Click here</a> to print invoice.');
		}
	    }
	}else{
	    return Redirect::route('thankyou')->with('error','Account not found');
	}
	$data['subscription_list']      = Subscription::get();
	return view('front.user.payment_form',$data);
    }
    
    public function silent_post_url(){
	
	$myfile = fopen(public_path("newfile.txt"), "w") or die("Unable to open file!");
	$txt = 'test';
	$txt .= json_encode($_REQUEST);
	fwrite($myfile, $txt);
	fclose($myfile);
	mail('nasmin.begam@webskitters.com','silent post url',$txt);
    }
    
    public function cancel_payment(){
	
	//$user = Users::find(Session::get('USER_DETAILS')->id);
	$merchantAuthentication = new AnetAPI\MerchantAuthenticationType();
	$merchantAuthentication->setName($this->setName);
        $merchantAuthentication->setTransactionKey($this->setTransactionKey);
	$refId = 'ref' . time();
	$request = new AnetAPI\ARBCancelSubscriptionRequest();
	$request->setMerchantAuthentication($merchantAuthentication);
	$request->setRefId($refId);
	//$request->setSubscriptionId($user->pay[0]->subscriptionId);
	$request->setSubscriptionId('4372408');
	$controller = new AnetController\ARBCancelSubscriptionController($request);
	$response = $controller->executeWithApiResponse( \net\authorize\api\constants\ANetEnvironment::SANDBOX);
	dd($response);
	if (($response != null) && ($response->getMessages()->getResultCode() == "Ok"))
	{
	    $user->status		= 'Inactive';
	    $user->payment_status	= 'Cancel';
	    $user->save();
	    
	    
	    $sitesettings           = Sitesetting::find(2);
	    $data['from_email']     = $sitesettings->sitesettings_value;
	    $data['form_name']      = "Aerepro" ;
	    $data['to_email']       = $user->email;
	    $data['to_name']        = $user->first_name;
	    
	    \Mail::send('emails.cancel_user', $data, function ($message) use ($data) {
		$message->from($data['from_email'], $data['form_name']);
		$message->subject('Payment Cancel');
		$message->to($data['to_email'] );
	    });
	    
	    Cart::destroy();
	    Session::forget('USER_DETAILS');
	    return Redirect::route('thankyou')->with('success','Your payment is cancel.You can not log in.');
	    
	 }
	else
	{
	    $errorMessages = $response->getMessages()->getMessage();
	    return Redirect::route('thankyou')->with('error',$errorMessages[0]->getText());
	}

    }
    
    public function  print_details($invoice){
        $data['user'] 			= Users::where('invoice',$invoice)->first();
        return view('front.user.print',$data);   
    }
    
    public function renewSubscribe($id, Request $request){
	$data 					= array();
	$data['sub']      			= User_subscription::find($id);
	$logged_user_id 			= Session::get('USER_DETAILS')->id;
	if($logged_user_id)
	{
	    $user_details 			= Users::find($logged_user_id);
	    $data['user_details']       	= $user_details;
	}
	
	if($request->isMethod('post')){
	    // Common setup for API credentials
	    $merchantAuthentication = new AnetAPI\MerchantAuthenticationType();
	    $merchantAuthentication->setName($this->setName);
            $merchantAuthentication->setTransactionKey($this->setTransactionKey);
	    
	    // Create the payment data for a credit card
	    $creditCard = new AnetAPI\CreditCardType();
	    $creditCard->setCardNumber($request->card_number);
	    $creditCard->setExpirationDate($request->year.'-'.$request->month);
	    $creditCard->setCardCode($request->cvv);
	    $paymentOne = new AnetAPI\PaymentType();
	    $paymentOne->setCreditCard($creditCard);
	    
	    // Create a transaction
	    $transactionRequestType = new AnetAPI\TransactionRequestType();
	    $transactionRequestType->setTransactionType( "authCaptureTransaction"); 
	    $transactionRequestType->setAmount(str_replace(',','',$request->total_amount));
	    $transactionRequestType->setPayment($paymentOne);
	    
	    $request1 = new AnetAPI\CreateTransactionRequest();
	    $request1->setMerchantAuthentication($merchantAuthentication);
	    $request1->setTransactionRequest( $transactionRequestType);
	    $controller = new AnetController\CreateTransactionController($request1);
	    $response = $controller->executeWithApiResponse( \net\authorize\api\constants\ANetEnvironment::SANDBOX);
	    
	    if ($response != null)
	    {
		$tresponse = $response->getTransactionResponse();
		
		if (($tresponse != null) && ($tresponse->getResponseCode()=="1") )   
		{
		    $sub 				= User_subscription::find($id);
		    
		    //Save data to payment table
		    $userPayment 			= new User_payment;
		    $userPayment->total_amount		= $request->total_amount;
		    $userPayment->user_id		= Session::get('USER_DETAILS')->id;
		    $userPayment->subscription_id	= $sub->subscription_id;
		    $userPayment->subscription_type	= $sub->subscription_type;
		    $userPayment->type			= 'normal';
		    $userPayment->transactionId 	= $tresponse->getTransId();
		    $userPayment->authCode 		= $tresponse->getAuthCode();
		    $userPayment->status 		= 'success';
		    $userPayment->save();  
		    
		    ///Save data to subscription table
		    
		    $sub->type			= 'renew';
		    $sub->status		= 'active';
		    $enddate			= strtotime($sub->end_date);
		    if($sub->payment_expire == 'Yes'){
			$dt 			= \Carbon\Carbon::create(date('Y'), date('m'), date('d'), 0);
			if($sub->subscription_type == 'quarterly'){
			    $sub->end_date	= $dt->addMonths(3);
			}elseif($sub->subscription_type == 'yearly'){
			    $sub->end_date	= $dt->addYears(1);
			}
		    }else{
			$dt 			= \Carbon\Carbon::create(date('Y',$enddate), date('m',$enddate), date('d',$enddate), 0);
			if($sub->subscription_type == 'quarterly'){
			    $sub->end_date	= $dt->addMonths(3);
			}elseif($sub->subscription_type == 'yearly'){
			    $sub->end_date	= $dt->addYears(1);
			}
		    }
		    $sub->save();
		    
		    $data['sub'] 	= User_subscription::where('id',$id)->get();
		    $pdf 		= \PDF::loadView('front.subscription_invoice', $data);
		    $data['file_name'] 	= time().'invoice.pdf';
		    $pdf->save(public_path().'/pdf/'.$data['file_name']);
		    
		    $sitesettings           = Sitesetting::find(2);
                    $data['from_email']     = $sitesettings->sitesettings_value;
		    
		    $emailtmp		    = Email_templete::find(5);
		    $data['msg']	    = $emailtmp->email_content;

                    $data['form_name']      = "Aerepro" ;
                    $data['to_email']       = $sub->user->email;
                    $data['to_name']        = $sub->user->first_name;
                    $data['subject']	    = $emailtmp->email_subject;
		    
		    $mail = \Mail::send('emails.renew', $data, function ($message) use ($data) {
                        $message->from($data['from_email'], $data['form_name']);
                        $message->subject($data['subject']);
                        $message->to($data['to_email'] );
			//$message->to('nasmin.begam@webskitters.com');
			$message->attach(asset('pdf/'.$data['file_name']));
                    });
		    
		    $mail = \Mail::send('emails.renew', $data, function ($message) use ($data) {
                        $message->from($data['from_email'], $data['form_name']);
                        $message->subject('Planroom renew Payment Processed');
                        $message->to(['planroom@a-erepro.com','accounts@a-erepro.com']);
			//$message->to(['nasmin.begam@webskitters.com','tonmoy.nandy@webskitters.com']);
			$message->attach(asset('pdf/'.$data['file_name']));
                    });
		    
		    return Redirect::route('thankyou')->with('success','Thank you for renewing your '.$data['sub'][0]->subscription->subscription_title.' subscription.<br> Click here to go to your <a href="'.\URL::route('dashboard').'">dashboard</a>');
		}
		else
		{
		    $errormsg = $tresponse->getErrors();
		    return Redirect::route('thankyou')->with('error',$errormsg[0]->getErrorText());
		}
	    }
	    
	}
	    return view('front.user.renew_sucsribe',$data);
    }
	
    
    
    
    
    public function disableSubscription($id){
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
	    return Redirect::route('edit_customer_profile')->with('active_sub',true)->with('success','Payment is disable');
	}
	else
	{
	    $errorMessages = $response->getMessages()->getMessage();
	    return Redirect::route('edit_customer_profile')->with('active_sub',true)->with('error',$errorMessages[0]->getText());
	}
    }
    
    public function enableSubscription($id){
	$user 				= Users::find(Session::get('USER_DETAILS')->id);
	if($user->card_no == ''){
	    return Redirect::route('thankyou')->with('error','Please enter your card details.<a href="'.URL::route('edit_customer_profile').'#card_details'.'">Click here </a> to enter your card details');
	}else{
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
	    $creditCard->setCardNumber($user->card_no);
	    $creditCard->setExpirationDate($user->exp_year."-".$user->exp_month);
	    $payment = new AnetAPI\PaymentType();
	    $payment->setCreditCard($creditCard);
	    $subscription->setPayment($payment);
	    $billTo = new AnetAPI\NameAndAddressType();
	    $billTo->setFirstName($user->first_name);
	    $billTo->setLastName($user->last_name);
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
		$userpay->user_id				= Session::get('USER_DETAILS')->id;
		$userpay->subscription_id			= $subscribe->subscription_id;
		$userpay->subscription_type 			= $subscribe->subscription_type;
		$userpay->total_amount				= number_format($amount,2);
		$userpay->type					= 'subscription';
		$userpay->subscriptionId			= $response->getSubscriptionId();
		$userpay->customerProfileId			= $response->getProfile()->getCustomerProfileId();
		$userpay->customerPaymentProfileId		= $response->getProfile()->getCustomerPaymentProfileId();
		$userpay->refId					= $response->geTrefId();
		$userpay->status				= $response->getMessages()->getMessage()[0]->getText();
		$userpay->save();
		
		return Redirect::route('edit_customer_profile')->with('active_sub',true)->with('success','Thanks for enable auto-renewal');
	    }else{
		    
		$errorMessages = $response->getMessages()->getMessage();
		    //$data['error'] = $errorMessages[0]->getText();
		return Redirect::route('edit_customer_profile')->with('active_sub',true)->with('error',$errorMessages[0]->getText());
	    }
	}
    }
    
    function updateSubscription() {
	// Common Set Up for API Credentials
	$merchantAuthentication = new AnetAPI\MerchantAuthenticationType();
	$merchantAuthentication->setName($this->setName);
        $merchantAuthentication->setTransactionKey($this->setTransactionKey);
	
	$refId 			= 'ref' . time();
	$subscription 		= new AnetAPI\ARBSubscriptionType();
	$creditCard 		= new AnetAPI\CreditCardType();
	$creditCard->setCardNumber("5500000000000004");
	$creditCard->setExpirationDate("2020-12");
	$payment 		= new AnetAPI\PaymentType();
	$payment->setCreditCard($creditCard);
	
	//set profile information
	$profile 		= new AnetAPI\CustomerProfileIdType();
	$profile->setCustomerProfileId("1808396362");
	$profile->setCustomerPaymentProfileId("1803255535");
	$subscription->setPayment($payment);
	$subscription->setAmount(300);
	//set customer profile information
	//$subscription->setProfile($profile);
	
	$request = new AnetAPI\ARBUpdateSubscriptionRequest();
	$request->setMerchantAuthentication($merchantAuthentication);
	$request->setRefId($refId);
	$request->setSubscriptionId('4331329');
	$request->setSubscription($subscription);
	$controller = new AnetController\ARBUpdateSubscriptionController($request);
	$response = $controller->executeWithApiResponse( \net\authorize\api\constants\ANetEnvironment::SANDBOX);
	
	if (($response != null) && ($response->getMessages()->getResultCode() == "Ok") )
	{
	    $errorMessages = $response->getMessages()->getMessage();
	    echo "SUCCESS Response : " . $errorMessages[0]->getCode() . "  " .$errorMessages[0]->getText() . "\n";
	    
	 }
	else
	{
	    echo "ERROR :  Invalid response\n";
	    $errorMessages = $response->getMessages()->getMessage();
	    echo "Response : " . $errorMessages[0]->getCode() . "  " .$errorMessages[0]->getText() . "\n";
	}
	dd($response);
      }

}
