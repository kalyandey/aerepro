<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;

use \Cart, \Redirect, \Session;

use App\Plan, App\Price, App\Users, App\City , App\State, App\Order, App\Order_master, App\Sitesetting, App\Project, App\Email_templete;

use AuthorizeNetSIM;

use net\authorize\api\contract\v1 as AnetAPI;
use net\authorize\api\controller as AnetController;

class CartController extends Controller
{
    public $setName 		= '7B6Ejq2Lh';
    public $setTransactionKey 	= '523Us8tX9G2qsH2C';
    public function index(){
         
        $data['cart_item']  = Cart::content();
        echo view('front.cart.view',$data);
    }
    
    public function cart_remove($rowId){
        
        Cart::remove($rowId);
        
        return Redirect::route('my_cart');
    }
    
    public function remove_full_cart($projectId){
        
	$cart_item  	= Cart::content();
	
	foreach($cart_item as $cart){
	    if($cart->options->project_id == $projectId){
		 Cart::remove($cart->rowId);
	    }
	}
        
        return Redirect::route('my_cart');
    }
    
    public function cart_clear(){
        Cart::destroy();
        return Redirect::route('my_cart');
    }
    
    public function updateCart(Request $request){
	if(count($request->full_set) > 0){
	    
	    $cart_item  	= Cart::content();
	    $project_id 	= $request->project_id;
	    $fullsetpapersize	= $request->fullsetpapersize;
	    $fullsetqty		= $request->fullsetqty;
	    $total_plan		= $request->total_plan;
	    $data 		= [];
	    foreach($cart_item as $cart){
		if(in_array($cart->options->project_id,$project_id)){
		    
		    Session::set('PAPERSIZE',$fullsetpapersize[$cart->options->project_id]);
		    $cart1 = Cart::search(function ($cartItem, $rowId) {
			$paperSize     = Session::get('PAPERSIZE');
			if($cartItem->options->papersize != $paperSize){
			    Session::forget('PAPERSIZE');
			    return true;
			}
		    });
		    
		    if(count($cart1) > 0){
			$plan 		= Plan::find($cart->id);
			$planarea 	= $plan->file_height * $plan->file_width;
			$price    	= Price::whereRaw("$planarea BETWEEN from_range AND to_range")->first();
			if($fullsetpapersize[$cart->options->project_id] == 'full_size'){
			    $price  = $price->full_size_price;
			}elseif($fullsetpapersize[$cart->options->project_id] == 'half_size'){
			    $price  = $price->half_size_price;
			}elseif($fullsetpapersize[$cart->options->project_id] == 'full_set'){
			    $price  = $price->full_set_price;
			}else{
			    $price  = $price->download_price;
			}
			Cart::update($cart->rowId, ['id' => $plan->id, 'name' => $plan->plan_name,'qty' => $fullsetqty[$cart->options->project_id], 'price' => $price ,'options' => ['papersize' => $fullsetpapersize[$cart->options->project_id],'project_id' => $plan->project->project_id,'project_name' =>  $plan->project->name,'all_plans_cat'=>1,'total_plan'=>$total_plan[$cart->options->project_id]]]);
		    }else{
			Cart::update($cart->rowId, $fullsetqty[$cart->options->project_id]);
		    }
		    
		}
	    }
	}
	if(count($request->rowId) > 0){
	    $row_id             = $request->rowId;
	    $qty                = $request->qty;
	    $papersize          = $request->papersize;
	    $planId             = $request->planId;
	    for($i = 0;$i< count($row_id) ;$i++){
		
		Session::set('PAPERSIZE',$papersize[$i]);
		$cart = Cart::search(function ($cartItem, $rowId) {
		    $paperSize     = Session::get('PAPERSIZE');
		    if($cartItem->options->papersize != $paperSize){
			Session::forget('PAPERSIZE');
			return true;
		    }
		});
		
		if(count($cart) > 0){
		    $plan     = Plan::find($planId[$i]);
		    $planarea = $plan->file_height * $plan->file_width;
		    $price    = Price::whereRaw("$planarea BETWEEN from_range AND to_range")->first();
		    if($papersize[$i] == 'full_size'){
			$price  = $price->full_size_price;
		    }elseif($papersize[$i] == 'half_size'){
			$price  = $price->half_size_price;
		    }elseif($papersize[$i] == 'full_set'){
			$price  = $price->full_set_price;
		    }else{
			$price  = $price->download_price;
		    }
		    Cart::update($row_id[$i], ['id' => $plan->id, 'name' => $plan->plan_name,'qty' => $qty[$i], 'price' => $price ,'options' => ['papersize' => $papersize[$i],'project_id' => $plan->project->project_id,'project_name' =>  $plan->project->name]]);
		}else{
		    Cart::update($row_id[$i], $qty[$i]);
		}
	    }
	}
        return Redirect::route('my_cart');
    }
    
    public function checkout(Request $request){
        
        if($request->isMethod('post')){
            
            if(\Cart::subtotal() == '0.00'){
            
                return Redirect::route('my_cart');
            
            }else{

            $data['cities']     = [''=>'Select City'] + City::pluck('city' , 'id')->all();
            $data['states']     = [''=>'Select State'] + State::pluck('state' , 'id')->all();
            $data['cart_item']  = Cart::content();
            $data['note']       = $request->note;
            $data['users']      = Users::find(Session::get('USER_DETAILS')->id);
	    $data['tax']	= Sitesetting::find(6);
            echo view('front.cart.checkout',$data);
            }
        }else{
            return Redirect::route('my_cart');
        }
    }

    
    public function payment(Request $request){
	    
        if($request->payment_type == 'cc'){
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
	    
	    if(($request->states != '' && $request->states == '3' && $request->delivery_type == 'local_delivery') || ($request->delivery_type == 'store_location') || ($request->delivery_type == '') ){
		$total_price = str_replace(',','',$request->total_price) + $request->tax;
	    }else{
		$total_price = str_replace(',','',$request->total_price);
	    }
            $transactionRequestType->setAmount(str_replace(',','',$total_price));
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
                    $cart_item  = Cart::content();
                    
                    $order_master = new Order_master;
                    $order_master->order_type          = $request->payment_type;
                    $order_master->transaction_id      = $tresponse->getTransId();
                    $order_master->authCode            = $tresponse->getAuthCode();
                    $order_master->total_price         = $request->total_price;
                    $order_master->note                = $request->note;
                    $order_master->delivery_type       = $request->delivery_type;
                    if($request->delivery_type == 'store_location'){
                    $order_master->pickup_location     = $request->pickup_location;
		    $order_master->tax                 = $request->tax;
                    }
                    if($request->delivery_type == 'local_delivery'){
                    $order_master->address             = $request->address;
                    $order_master->city                = ($request->city != '')?$request->city:null;
                    $order_master->states              = ($request->states != '')?$request->states:null;
                    $order_master->zip                 = $request->zip;
		    $order_master->tax                 = (($request->states != '' && $request->states == '3' && $request->delivery_type == 'local_delivery'))?$request->tax:'';
                    }
		    if($request->delivery_type == ''){
			 $order_master->tax                 = $request->tax;
		    }
                    $order_master->user_id             = Session::get('USER_DETAILS')->id;
                    $order_master->save();
                    
                    $order_master->order_id            = '#ORD'.('10000' + $order_master->id);
                    $order_master->save();
                    
		    $project_id				= $request->project_id;
		    $papersize				= $request->papersize;
		    $price				= $request->price;
		    $qty				= $request->qty;
		    $plan_id				= $request->plan_id; 
		    
                    for($i=0; $i<count($project_id);$i++){
			
			$oProject 		    = Project::where('project_id',$project_id[$i])->first();
                        $order                      = new Order;
                        $order->order_master_id     = $order_master->id;
                        $order->project_id          = $oProject->id;
                        if($plan_id[$i] == ''){
			$order->plan_id             = null;
			}else{
                        $order->plan_id             = $plan_id[$i];
			}
                        $order->user_id             = Session::get('USER_DETAILS')->id;
                        $order->order_type          = $papersize[$i];
                        $order->price               = $price[$i];
                        $order->quantity            = $qty[$i];
                        $order->save();
                    }
                    $setting_email_value    = Sitesetting::find(1);
                    $data['from_email']     = $setting_email_value->sitesettings_value;
                    $data['from_name']      = '';
		    
		    $setting_tax    	    = Sitesetting::find(6);
                    $data['setting_tax']    = $setting_tax->sitesettings_value;
                    
		    $emailtmp		    = Email_templete::find(1);
                    $user                   = Users::find(Session::get('USER_DETAILS')->id);
                    $data['to_email']       = $user->email;
                    $data['user']           = $user;
                    $data['cart_item']      = $cart_item;
                    $data['order_master']   = $order_master;
		    
                    $data['delivery_type']      = $request->delivery_type;
                    $data['pickup_location']    = $request->pickup_location;
                    $data['address']            = $request->address;
                    $data['city']               = $request->city;
                    $data['states']             = $request->states;
                    $data['zip']                = $request->zip;
                    $data['subject']            = 'Your A&E Reprographics Order '.$order_master->order_id.' Has Been Placed';
		    $data['tax'] 		= $order_master->tax;
                    
		    $pdf 			= \PDF::loadView('emails.plan_download', $data);
		    $data['file_name'] 		= time().'invoice.pdf';
		    $pdf->save(public_path().'/pdf/'.$data['file_name']);
		    //echo view('emails.plan_download',$data);
		    //exit;
                    $mail = \Mail::send('emails.plan_download', $data, function ($message) use ($data) {
                        $message->from($data['from_email'], $data['from_name']);
                        $message->subject($data['subject']);
                        $message->to($data['to_email'] );
			$message->attach(asset('pdf/'.$data['file_name']));
                    });
                    
		    
		    if($data['delivery_type'] != ''){
			if($data['delivery_type'] == 'local_delivery' || $data['pickup_location'] == 'Northern Prescott'){
			    $data['to_email']       	= 'prescott@a-erepro.com';
			}elseif($data['pickup_location'] == 'Downtown Prescott'){
			    $data['to_email']       	= 'downtown@a-erepro.com';
			}elseif($data['pickup_location'] == 'Prescott Valley'){
			    $data['to_email']       	= 'pv@a-erepro.com';
			}
			$data['subject']            	= 'New Planroom Order Submitted '.$order_master->order_id;
			//$data['to_email']		= 'nasmin.begam@webskitters.com';
		    
			$mail = \Mail::send('emails.plan_download', $data, function ($message) use ($data) {
			    $message->from($data['from_email'], $data['from_name']);
			    $message->subject($data['subject']);
			    $message->to($data['to_email'] );
			    $message->attach(asset('pdf/'.$data['file_name']));
			});
		    }
		    
		    $data['subject']            = 'New Planroom Order Submitted '.$order_master->order_id;
		    $data['to_email']		= 'accounts@a-erepro.com';
		    //$data['to_email']		= 'nasmin.begam@webskitters.com';
		    
		    $mail = \Mail::send('emails.plan_download', $data, function ($message) use ($data) {
			$message->from($data['from_email'], $data['from_name']);
			$message->subject($data['subject']);
			$message->to($data['to_email'] );
			$message->attach(asset('pdf/'.$data['file_name']));
		    });
			
                    Cart::destroy();
                    
                    return Redirect::route('payment_success')->with('order_id',$order_master->id)->with('success',true);
                
                    //echo "Charge Credit Card AUTH CODE : " . $tresponse->getAuthCode() . "\n";
                    //echo "Charge Credit Card TRANS ID  : " . $tresponse->getTransId() . "\n";
                }
                else
                {
                    Cart::destroy();
                    
                    $errormsg = $tresponse->getErrors();
                    
                    return Redirect::route('payment_success')->with('error',$errormsg[0]->getErrorText());
                }
            }
            else
            {
                Cart::destroy();
                
                return Redirect::route('payment_success')->with('error','Charge Credit card Null response returned');
            }
        }else if($request->payment_type == 'cod' || $request->payment_type == 'my_account'){
                    $cart_item  = Cart::content();
                    $order_master = new Order_master;
                    $order_master->order_type          = $request->payment_type; 
                    $order_master->total_price         = $request->total_price;
                    $order_master->note                = $request->note;
                    $order_master->delivery_type       = $request->delivery_type;
                    if($request->delivery_type == 'store_location'){
                    $order_master->pickup_location     = $request->pickup_location;
		    $order_master->tax                 = $request->tax;
                    }
                    if($request->delivery_type == 'local_delivery'){
                    $order_master->address             = $request->address;
                    $order_master->city                = ($request->city != '')?$request->city:null;
                    $order_master->states              = ($request->states != '')?$request->states:null;
                    $order_master->zip                 = $request->zip;
		    $order_master->tax                 = ($request->states != '' && $request->states == 3)?$request->tax:'';
                    }
                    $order_master->user_id             = Session::get('USER_DETAILS')->id;
                    $order_master->save();
                    
                    $order_master->order_id            = '#ORD'.('10000' + $order_master->id);
                    $order_master->save();


		    $project_id				= $request->project_id;
		    $papersize				= $request->papersize;
		    $price				= $request->price;
		    $qty				= $request->qty;
		    $plan_id				= $request->plan_id;
		    
		    
                    for($i=0; $i<count($project_id);$i++){
			
			$oProject 		    = Project::where('project_id',$project_id[$i])->first();
                        $order                      = new Order;
                        $order->order_master_id     = $order_master->id;
                        $order->project_id          = $oProject->id;
			if($plan_id[$i] == ''){
			$order->plan_id             = null;
			}else{
                        $order->plan_id             = $plan_id[$i];
			}
                        $order->user_id             = Session::get('USER_DETAILS')->id;
                        $order->order_type          = $papersize[$i];
                        $order->price               = $price[$i];
                        $order->quantity            = $qty[$i];
                        $order->save();
                    }
                    $setting_email_value    = Sitesetting::find(1);
                    $data['from_email']     = $setting_email_value->sitesettings_value;
                    $data['from_name']      = '';
                    
		    $setting_tax    	    = Sitesetting::find(6);
                    $data['setting_tax']    = $setting_tax->sitesettings_value;
		    
                    $user                   = Users::find(Session::get('USER_DETAILS')->id);
                    $data['to_email']       = $user->email;
                    $data['user']           = $user;
                    $data['cart_item']      = $cart_item;
		    $data['order_master']   = $order_master;
                    
                    $data['delivery_type']      = $request->delivery_type;
                    $data['pickup_location']    = $request->pickup_location;
                    $data['address']            = $request->address;
                    $data['city']               = $request->city;
                    $data['states']             = $request->states;
                    $data['zip']                = $request->zip;
                    $data['subject']            = 'Your A&E Reprographics Order '.$order_master->order_id.' Has Been Placed';
		    $data['tax'] 		= $order_master->tax;
                    
		    $pdf 		= \PDF::loadView('emails.plan_download', $data);
		    $data['file_name'] 	= time().'invoice.pdf';
		    $pdf->save(public_path().'/pdf/'.$data['file_name']);
		    
                    $mail = \Mail::send('emails.plan_download', $data, function ($message) use ($data) {
                        $message->from($data['from_email'], $data['from_name']);
                        $message->subject($data['subject']);
                        $message->to($data['to_email'] );
			$message->attach(asset('pdf/'.$data['file_name']));
                    });
                    
                    if($data['delivery_type'] != ''){
			if($data['delivery_type'] == 'local_delivery' || $data['pickup_location'] == 'Northern Prescott'){
			    $data['to_email']       	= 'prescott@a-erepro.com';
			}elseif($data['pickup_location'] == 'Downtown Prescott'){
			    $data['to_email']       	= 'downtown@a-erepro.com';
			}elseif($data['pickup_location'] == 'Prescott Valley'){
			    $data['to_email']       	= 'pv@a-erepro.com';
			}
			$data['subject']            	= 'New Planroom Order Submitted '.$order_master->order_id;
			//$data['to_email']		= 'nasmin.begam@webskitters.com';
		    
			$mail = \Mail::send('emails.plan_download', $data, function ($message) use ($data) {
			    $message->from($data['from_email'], $data['from_name']);
			    $message->subject($data['subject']);
			    $message->to($data['to_email'] );
			    $message->attach(asset('pdf/'.$data['file_name']));
			});
		    }
		    
		    if($request->payment_type == 'my_account'){
			$data['subject']                = 'New Planroom Order Submitted '.$order_master->order_id;
			$data['to_email']		= 'accounts@a-erepro.com';
			//$data['to_email']		= 'nasmin.begam@webskitters.com';
			
			$mail = \Mail::send('emails.plan_download', $data, function ($message) use ($data) {
			    $message->from($data['from_email'], $data['from_name']);
			    $message->subject($data['subject']);
			    $message->to($data['to_email'] );
			    $message->attach(asset('pdf/'.$data['file_name']));
			});
		    }
                    Cart::destroy();
                    
                    return Redirect::route('payment_success')->with('order_id',$order_master->id)->with('success',true);
            }
    }
    
    public function payment_success(){
        $data = array();
        echo view('front.cart.payment_success',$data);
    }
    
    
}
