<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use \Validator, \Redirect;
use App\Users, App\Sitesetting, App\Profession, App\Csi_division, App\Trade, App\State, App\City, App\Permit,App\Project,App\Tracking,App\Building_report,App\Private_company,App\User_payment, App\Temp_payment,App\Subscription,App\Order_master,App\User_subscription;
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
        
        $data['newPermit'] 	= Permit::where('created_at', '>=', $one_week_ago)
					->where('created_at', '<=', $today)->count();
	$data['newPermit']	= Building_report::where(function($query) use ($lastweek_from_date,$lastweek_to_date) {
                                            $query->where('issued_date','>=',$lastweek_from_date);
                                            $query->where('issued_date','<=',$lastweek_to_date);
                                        })->where('type','issued')->count();
	$data['saveTrack']	= Tracking::orderBy('created_at','DESC')->where('user_id',Session::get('USER_DETAILS')->id)->limit(3)->get();
	$data['saveTrackCount']	= Tracking::where('user_id',Session::get('USER_DETAILS')->id)->count();
        $data['projectList']	= Project::orderBy('updated_at','DESC')->limit(5)->get();
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
        $events         = array();   
        $today_date 	= \Carbon\Carbon::now()->subDays(0)->format('Y-m-d');
        $today_date     = '2016-08-01';
        $get_data       = Tracking::orderBy('updated_at','DESC')->where('user_id',Session::get('USER_DETAILS')->id)
                                   ->whereHas('project', function ($q) use ($today_date)
                                    {   $q->where(function($query) use ($today_date) {
                                            $query->where('projects.bid_close_date','>=',$today_date);
                                         });
                                      })
                                    ->get();
                                     
        foreach($get_data as $val){
            $events[] = \Calendar::event(
            $val->project->name, //event title
            true, //full day event?
            $val->project->bid_close_date, //start time (you can also use Carbon instead of DateTime)
            $val->project->bid_close_date, //end time (you can also use Carbon instead of DateTime)
            $val->project->id, //optionally, you can specify an event ID
            [
            'className' => 'eventhere',
            'start'=>$val->project->bid_close_date    
            //any other full-calendar supported parameters
            ]        
            );
        }                              
        
        $calendar = \Calendar::addEvents($events,[
        'color' => '#001F5B',
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
        $data['state']  = State::pluck('state','id')->all();
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
	    }
	    else
	    {
		$user->licensed_contractor      = 'No';
	    }
            $user->status                   = 'Inactive';
	    
	    $tmp_payment 		    = Temp_payment::find(Session::get('TEMP_SUBSCRIPE'));
	    $user->subscription_id	    = $tmp_payment->subscription_id;
	    $user->subscription_type	    = $tmp_payment->subscription_type;
	    $user->total_amount	    	    = $tmp_payment->total_amount;
	    
	    $tmp_payment->delete();
	    
            $user->save();
            
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
                    $sitesettings           = Sitesetting::find(2);
                    $data['from_email']     = $sitesettings->sitesettings_value;
                    $data['form_name']      = "Aerepro" ;
                    $data['to_email']       = $user->email;
                    $data['to_name']        = $user->first_name;
                    $data['password']       = base64_decode(Session::get('USER_PASSWORD'));
                    $data['token']          = $user->token;
                    
                    \Mail::send('emails.user_activation', $data, function ($message) use ($data) {
                        $message->from($data['from_email'], $data['form_name']);
                        $message->subject('Signup | Verification');
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
            $user       = Users::select('id','password','subscription_id','first_name','last_name')->where('email',$email)->where('status','Active')->first();
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
        $data['state']          = State::pluck('state','id')->all();
        $data['city']           = City::pluck('city','id')->all();
        
        $data['list'] 		= Order_master::where('user_id',Session::get('USER_DETAILS')->id)->orderBy('created_at','desc')->get();
        //return view('front.order.index',$data);
    
        $logged_user_id = Session::get('USER_DETAILS')->id;
        if($logged_user_id)
        {
            $user_details 		= Users::find($logged_user_id);
            $data['user_details']       = $user_details;
	    $explodeSub			= explode(',',$user_details->subscription_id);
	    $subscribes 		= User_subscription::whereRaw("DATE_FORMAT(end_date,'%Y-%m-%d') < '".date('Y-m-d')."'")->where('type','<>','new')->where('user_id',Session::get('USER_DETAILS')->id)->get();
	    if(count($subscribes) > 0){
		$arrDiff = [];
		foreach($subscribes as $s){
		    $arrDiff[] = $s->subscription_id ;
		}
		$getDiff = array_diff($explodeSub,$arrDiff);
		$user_details->subscription_id = implode(',',$getDiff);
		$user_details->save();
	    }
	    
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
    
    public function after_subscription_payment(Request $request){
	if($request->isMethod('post')){
	    $data 				= array();
	    $data['subscription_list']      	= Subscription::whereIn('id',$request->newSubscribe)->get();
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
    }
    
    public function new_subscription_payment(Request $request){
	
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
		    $subscription_id		= rtrim($request->subscription_id,',');
		    $subscription		= explode(',',$subscription_id);
		    
		    $userPayment		= new User_payment();
		    $userPayment->user_id	= Session::get('USER_DETAILS')->id;
		    $userPayment->total_amount	= str_replace(',','',$request->total_amount);
		    $userPayment->type		= 'normal';
		    $userPayment->transactionId	= $tresponse->getTransId();
		    $userPayment->authCode	= $tresponse->getAuthCode();
		    $userPayment->save();
		    
		    $user                   	= Users::find(Session::get('USER_DETAILS')->id);
		    $pay 			= User_payment::where('type','subscription')->where('user_id',Session::get('USER_DETAILS')->id)->first();
		    
		    
		    if($user->payment_status == 'disable' && date('Y-m-d',strtotime($user->payment_end_date)) < date('Y-m-d')){
			
			if($user->subscription_type == 'quarterly'){
			    $dt 	= \Carbon\Carbon::now();
			    $enddate 	= $dt->addMonths(3);
			}elseif($user->subscription_type == 'yearly'){
			    $dt 	= \Carbon\Carbon::now();
			    $enddate	= $dt->addYears(1);
			}
			for($i=0;$i<count($subscription);$i++){
			    $sub 			= new User_subscription;
			    $sub->user_id 		= Session::get('USER_DETAILS')->id;
			    $sub->subscription_id	= $subscription[$i];
			    $sub->type			= 'subscribe';
			    $sub->start_date		= date('Y-m-d H:i:s');
			    $sub->end_date		= $enddate;
			    $sub->save();
			}
			
		    }else{
			for($i=0;$i<count($subscription);$i++){
			    $sub 			= new User_subscription;
			    $sub->user_id 		= Session::get('USER_DETAILS')->id;
			    $sub->subscription_id	= $subscription[$i];
			    $sub->type		= 'subscribe';
			    $sub->start_date	= date('Y-m-d H:i:s');
			    $sub->end_date		= $user->payment_end_date;
			    $sub->save();
			}
		    
		    }
		    ///Set amount for next time payment
		    if($user->payment_status == 'enable'){
			
			
			$refId = 'ref' . time();
			// Creating the API Request with required parameters
			$request1 = new AnetAPI\ARBGetSubscriptionRequest();
			$request1->setMerchantAuthentication($merchantAuthentication);
			$request1->setRefId($refId);
			$request1->setSubscriptionId($pay->subscriptionId);
			// Controller
			$controller = new AnetController\ARBGetSubscriptionController($request1);
			
			// Getting the response
			$response = $controller->executeWithApiResponse( \net\authorize\api\constants\ANetEnvironment::SANDBOX);
			
			if ($response != null) 
			{
			    if($response->getMessages()->getResultCode() == "Ok")
			    {
				$subscriptionAmount 	= str_replace(',','',$request->total_amount) + $response->getSubscription()->getAmount();
				$refId 			= 'ref' . time();
				$subscription 		= new AnetAPI\ARBSubscriptionType();
				$subscription->setAmount($subscriptionAmount);
				
				$request2 = new AnetAPI\ARBUpdateSubscriptionRequest();
				$request2->setMerchantAuthentication($merchantAuthentication);
				$request2->setRefId($refId);
				$request2->setSubscriptionId($pay->subscriptionId);
				$request2->setSubscription($subscription);
				$controller = new AnetController\ARBUpdateSubscriptionController($request2);
				$response = $controller->executeWithApiResponse( \net\authorize\api\constants\ANetEnvironment::SANDBOX);
			    }
			}
		    }
                    $setting_email_value    	= Sitesetting::find(1);
                    $data['from_email']     	= $setting_email_value->sitesettings_value;
                    $data['from_name']      	= '';
                    
		    $user->subscription_id	= $user->subscription_id.','.$subscription_id;
		    $user->save();
		    
                    $data['to_email']       	= $user->email;
                    $data['user']           	= $user;
		    $data['tranId']		= $tresponse->getTransId();
		    $data['total_amount']	= $request->total_amount;
		    
		    $data['item']		= Subscription::select(array(\DB::raw('GROUP_CONCAT(DISTINCT subscription_title) as title ')))->whereIn('id',explode(',',$subscription_id))->first();
		    		    
                    $mail = \Mail::send('emails.newSubscribe', $data, function ($message) use ($data) {
                        $message->from($data['from_email'], $data['from_name']);
                        $message->subject('New item is added to account');
                        $message->to($data['to_email'] );
                    });
                    
                    return Redirect::route('thankyou')->with('success','Thanks for your subscription');
                }
                else
                {
                    
                    $errormsg = $tresponse->getErrors();
                    
                    return Redirect::route('thankyou')->with('error',$errormsg[0]->getErrorText());
                }
            }
            else
            {
                
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
    
    public function update_customer_moreinfo(Request $request)
    {
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
	    $user->total_amount		   = $request->total_amount;
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
		$merchantAuthentication = new AnetAPI\MerchantAuthenticationType();
		$merchantAuthentication->setName($this->setName);
		$merchantAuthentication->setTransactionKey($this->setTransactionKey);
		
		$refId = 'ref' . time();
		// Subscription Type Info
		$subscription = new AnetAPI\ARBSubscriptionType();
		$subscription->setName("Sample Subscription");
		$interval = new AnetAPI\PaymentScheduleType\IntervalAType();
		if($data['user']->subscription_type == 'quarterly'){
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
		$subscription->setPaymentSchedule($paymentSchedule);
		$subscription->setAmount($data['user']->total_amount);
		
		$creditCard = new AnetAPI\CreditCardType();
		$creditCard->setCardNumber($request->card_number);
		$creditCard->setExpirationDate($request->year."-".$request->month);
		$payment = new AnetAPI\PaymentType();
		$payment->setCreditCard($creditCard);
		$subscription->setPayment($payment);
		$billTo = new AnetAPI\NameAndAddressType();
		$billTo->setFirstName($data['user']->first_name);
		$billTo->setLastName($data['user']->last_name);
		$subscription->setBillTo($billTo);
		$request1 = new AnetAPI\ARBCreateSubscriptionRequest();
		$request1->setmerchantAuthentication($merchantAuthentication);
		$request1->setRefId($refId);
		$request1->setSubscription($subscription);
		$controller = new AnetController\ARBCreateSubscriptionController($request1);
		$response = $controller->executeWithApiResponse( \net\authorize\api\constants\ANetEnvironment::SANDBOX);
		if (($response != null) && ($response->getMessages()->getResultCode() == "Ok") )
		{
		    $userpay 					= new User_payment;
		    $userpay->user_id				= $data['user']->id;
		    $userpay->total_amount			= $data['user']->total_amount;
		    $userpay->subscriptionId			= $response->getSubscriptionId();
		    $userpay->customerProfileId			= $response->getProfile()->getCustomerProfileId();
		    $userpay->customerPaymentProfileId		= $response->getProfile()->getCustomerPaymentProfileId();
		    $userpay->refId				= $response->geTrefId();
		    $userpay->status				= $response->getMessages()->getMessage()[0]->getText();
		    $userpay->save();
		    
		    $u 				= Users::find($data['user']->id);
		    $u->status			= 'Active';
		    $u->payment_status		= 'enable';
		    $u->card_no			= $request->card_number;
		    $u->exp_year		= $request->year;
		    $u->exp_month		= $request->month;
		    $u->cvv			= $request->cvv;
		    $u->payment_start_date	= date('Y-m-d H:i:s');
		    if($u->subscription_type == 'quarterly'){
		    $dt = \Carbon\Carbon::now();
		    $u->payment_end_date	= $dt->addMonths(3);
		    }elseif($u->subscription_type == 'yearly'){
		    $dt = \Carbon\Carbon::now();
		    $u->payment_end_date	= $dt->addYears(1);
		    }
		    $u->token 			= '';
		    $u->invoice 		= str_random(8).$data['user']->id;
		    $u->save();
		    
		    $subscription_id		= $u->subscription_id;
		    $subscription		= explode(',',$subscription_id);
		    for($i=0;$i<count($subscription);$i++){
			$sub 			= new User_subscription;
			$sub->user_id 		= $data['user']->id;
			$sub->subscription_id	= $subscription[$i];
			$sub->type		= 'new';
			$sub->start_date	= $u->payment_start_date;
			$sub->end_date		= $u->payment_end_date;
			$sub->save();
		    }
		    
		    
		    $sitesettings           = Sitesetting::find(2);
                    $data['from_email']     = $sitesettings->sitesettings_value;
                    $data['form_name']      = "Aerepro" ;
                    $data['to_email']       = $u->email;
                    $data['to_name']        = $u->first_name;
		    $data['invoice']        = $u->invoice;
                    $data['subject']	    = 'Payment success';
                    $mail = \Mail::send('emails.active_user', $data, function ($message) use ($data) {
                        $message->from($data['from_email'], $data['form_name']);
                        $message->subject($data['subject']);
                        $message->to($data['to_email'] );
                    });
		    
		    
		    return Redirect::route('thankyou')->with('success','Thank you for registering . Your payment has been successfully processed.<br> <a href="'.\URL::route('planroom').'">Click here</a> to login.<br>OR<br><a href="'.\URL::route('print_details',[$u->invoice]).'">Click here</a> to print invoice.');
		}
		else
		{
		    $errorMessages = $response->getMessages()->getMessage();
		    //$data['error'] = $errorMessages[0]->getText();
		    return Redirect::route('thankyou')->with('error',$errorMessages[0]->getText());
		    //echo "Response : " . $errorMessages[0]->getCode() . "  " .$errorMessages[0]->getText() . "\n";
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
	
	$user = Users::find(Session::get('USER_DETAILS')->id);
	$merchantAuthentication = new AnetAPI\MerchantAuthenticationType();
	$merchantAuthentication->setName($this->setName);
        $merchantAuthentication->setTransactionKey($this->setTransactionKey);
	$refId = 'ref' . time();
	$request = new AnetAPI\ARBCancelSubscriptionRequest();
	$request->setMerchantAuthentication($merchantAuthentication);
	$request->setRefId($refId);
	//$request->setSubscriptionId($user->pay[0]->subscriptionId);
	$request->setSubscriptionId('4331313');
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
	$data['subscription_list']      = Subscription::get();
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
		    //Save data to payment table
		    $userPayment 		= new User_payment;
		    $userPayment->total_amount	= $request->total_amount;
		    $userPayment->user_id	= Session::get('USER_DETAILS')->id;
		    $userPayment->type		= 'normal';
		    $userPayment->transactionId = $tresponse->getTransId();
		    $userPayment->authCode 	= $tresponse->getAuthCode();
		    $userPayment->status 	= 'success';
		    $userPayment->save();  
		    
		    //Save data to user tabel
		    $user                   	= Users::find(Session::get('USER_DETAILS')->id);
		    $subscription_id		= explode(',',$user->subscription_id);
		    if(!in_array($data['sub']->subscription_id,$subscription_id))
		    $user->subscription_id	= $user->subscription_id.','.$data['sub']->subscription_id;
		    $user->save();
		    }
		    
		    
		    ///Save data to subscription table
		    $sub 			= User_subscription::find($id);
		    $sub->type			= 'renew';
		    $sub->start_date		= date('Y-m-d H:i:s');
		    
		    $enddate			= strtotime($sub->end_date);
		    $dt 			= \Carbon\Carbon::create(date('Y',$enddate), date('m',$enddate), date('d',$enddate), 0);
		    if($user->subscription_type == 'quarterly'){
			$sub->end_date	= $dt->addMonths(3);
		    }elseif($user->subscription_type == 'yearly'){
			$sub->end_date	= $dt->addYears(1);
		    }
		    $sub->save();
			
		    
		    //Mail array
		    //    $setting_email_value    	= Sitesetting::find(1);
		    //    $data['from_email']     	= $setting_email_value->sitesettings_value;
		    //    $data['from_name']      	= '';
		    //    $data['to_email']       	= $user->email;
		    //    $data['user']           	= $user;
		    //    $data['tranId']		= $tresponse->getTransId();
		    //    $data['total_amount']	= $request->total_amount;
		    //    
		    //    $mail = \Mail::send('emails.renewSubscribe', $data, function ($message) use ($data) {
		    //	$message->from($data['from_email'], $data['from_name']);
		    //	$message->subject('Your product is renew');
		    //	$message->to($data['to_email'] );
		    //    });
		    //    
		    return Redirect::route('thankyou')->with('success','Thanks for renew');
		}
		else
		{
		    
		    $errormsg = $tresponse->getErrors();
		    
		    return Redirect::route('thankyou')->with('error',$errormsg[0]->getErrorText());
		}
	    }
	//    else
	//    {
	//	
	//	return Redirect::route('thankyou')->with('error','Charge Credit card Null response returned');
	//    }
	    return view('front.user.renew_sucsribe',$data);
	}
	
    
    
    
    
    public function disableSubscription(){
	$user 				= Users::find(Session::get('USER_DETAILS')->id);
	$merchantAuthentication 	= new AnetAPI\MerchantAuthenticationType();
	$merchantAuthentication->setName($this->setName);
        $merchantAuthentication->setTransactionKey($this->setTransactionKey);
	$refId 				= 'ref' . time();
	$request 			= new AnetAPI\ARBCancelSubscriptionRequest();
	$request->setMerchantAuthentication($merchantAuthentication);
	$request->setRefId($refId);
	$request->setSubscriptionId($user->pay[0]->subscriptionId);
	$controller 			= new AnetController\ARBCancelSubscriptionController($request);
	$response 			= $controller->executeWithApiResponse( \net\authorize\api\constants\ANetEnvironment::SANDBOX);
	if (($response != null) && ($response->getMessages()->getResultCode() == "Ok"))
	{
	    $user->payment_status	= 'disable';
	    $user->save();
	    return Redirect::route('edit_customer_profile')->with('active_sub',true)->with('success','Payment is disable');
	}
	else
	{
	    $errorMessages = $response->getMessages()->getMessage();
	    return Redirect::route('edit_customer_profile')->with('active_sub',true)->with('error',$errorMessages[0]->getText());
	}
    }
    
    public function enableSubscription(){
	$user 				= Users::find(Session::get('USER_DETAILS')->id);
	$merchantAuthentication 	= new AnetAPI\MerchantAuthenticationType();
	$merchantAuthentication->setName($this->setName);
        $merchantAuthentication->setTransactionKey($this->setTransactionKey);
	$refId 				= 'ref' . time();
	$request 			= new AnetAPI\ARBCancelSubscriptionRequest();
	$request->setMerchantAuthentication($merchantAuthentication);
	$request->setRefId($refId);
	$request->setSubscriptionId($user->pay[0]->subscriptionId);
	$controller 			= new AnetController\ARBCancelSubscriptionController($request);
	$response 			= $controller->executeWithApiResponse( \net\authorize\api\constants\ANetEnvironment::SANDBOX);
	if (($response != null) && ($response->getMessages()->getResultCode() == "Ok"))
	{
	    $user->payment_status	= 'disable';
	    $user->save();
	    return Redirect::route('edit_customer_profile')->with('active_sub',true)->with('success','Payment is disable');
	}
	else
	{
	    $errorMessages = $response->getMessages()->getMessage();
	    return Redirect::route('edit_customer_profile')->with('active_sub',true)->with('error',$errorMessages[0]->getText());
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
