<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use \Cart, \Redirect, \Session;

use App\Private_plans, App\Price, App\Users, App\City , App\State, App\Private_order, App\Private_order_master, App\Sitesetting, App\Private_company;

use AuthorizeNetSIM;

use net\authorize\api\contract\v1 as AnetAPI;
use net\authorize\api\controller as AnetController;

class PrivateCartController extends Controller
{
    public $setName 		= '7B6Ejq2Lh';
    public $setTransactionKey 	= '523Us8tX9G2qsH2C';
    public function index($company_slug){
        $data = [];
        $company = $this->companyExistCheck($company_slug);
        if(count($company) > 0){
            $data['cart_item']      = Cart::content();
            $data['company_slug']   = $company_slug;
            echo view('front.private.cart.view',$data);
        }else{
            return view('front.private.companyNotExist',$data);
        }
    }
    
    public function cart_remove($rowId){
        Cart::remove($rowId);
        return Redirect::route('private_planroom_cart',[Session::get('COMPANY_SLUG')]);
    }
    
    public function cart_clear(){
        Cart::destroy();
        return Redirect::route('private_planroom_cart',[Session::get('COMPANY_SLUG')]);
    }
    
    public function updateCart(Request $request){
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
                    $plan = Private_plans::find($planId[$i]);
                    $planarea = $plan->file_height * $plan->file_width;
                    $price    = Price::whereRaw("$planarea BETWEEN from_range AND to_range")->first();
                    if($papersize[$i] == 'full_size'){
                        $price  = $price->full_size_price;
                    }elseif($papersize[$i] == 'half_size'){
                        $price  = $price->half_size_price;
                    }else{
                        $price  = $price->download_price;
                    }
                    Cart::update($row_id[$i], ['id' => $plan->id, 'name' => $plan->plan_name,'qty' => $qty[$i], 'price' => $price ,'options' => ['papersize' => $papersize[$i],'project_id' => $plan->project->project_id,'project_name' =>  $plan->project->project_name]]);
                }else{
                    Cart::update($row_id[$i], $qty[$i]);
                }
            }
        }
        
        return Redirect::route('private_planroom_cart',[Session::get('COMPANY_SLUG')]);
    }
    
    public function checkout(Request $request,$company_slug){
        $data = [];
        $company = $this->companyExistCheck($company_slug);
        if(count($company) > 0){
            if($request->isMethod('post')){
                
                if(\Cart::subtotal() == '0.00'){
            
                    return Redirect::route('private_planroom_cart',[Session::get('COMPANY_SLUG')]);
                
                }else{
                    $data['cities']     = [''=>'Select City'] + City::pluck('city' , 'id')->all();
                    $data['states']     = [''=>'Select State'] + State::pluck('state' , 'id')->all();
                    $data['cart_item']  = Cart::content();
                    $data['note']       = $request->note;
        
                    if(Session::has('PRIVATE_COMPANY_DETAILS') && Session::get('PRIVATE_COMPANY_DETAILS') != ''){
                        $data['users']      = Private_company::find(Session::get('PRIVATE_COMPANY_DETAILS')->id);
                    }elseif(Session::has('PRIVATE_USER_DETAILS') && Session::get('PRIVATE_USER_DETAILS') != ''){
                        $data['users']      = Private_company::find(Session::get('PRIVATE_USER_DETAILS')->id);
                    }
                    $data['company_slug']   = $company_slug;
                    echo view('front.private.cart.checkout',$data);
                }
            }else{
                return Redirect::route('private_planroom_cart',[Session::get('COMPANY_SLUG')]);
            }
        }else{
            return view('front.private.companyNotExist',$data);
        }
    }

    
    public function payment(Request $request){        
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
        $transactionRequestType->setAmount(str_replace(',','',$request->total_price));
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
                
                $order_master = new Private_order_master;
                $order_master->transaction_id      = $tresponse->getTransId();
                $order_master->authCode            = $tresponse->getAuthCode();
                $order_master->total_price         = $request->total_price;
                $order_master->note                = $request->note;
                $order_master->delivery_type       = $request->delivery_type;
                if($request->delivery_type == 'store_location'){
                $order_master->pickup_location     = $request->pickup_location;
                }
                if($request->delivery_type == 'local_delivery'){
                $order_master->address             = $request->address;
                $order_master->city                = ($request->city != '')?$request->city:null;
                $order_master->states              = ($request->states != '')?$request->states:null;
                $order_master->zip                 = $request->zip;
                }
                
                if(Session::has('PRIVATE_COMPANY_DETAILS') && Session::get('PRIVATE_COMPANY_DETAILS') != ''){
                    $order_master->user_id      = Session::get('PRIVATE_COMPANY_DETAILS')->id;
                }elseif(Session::has('PRIVATE_USER_DETAILS') && Session::get('PRIVATE_USER_DETAILS') != ''){
                    $order_master->user_id      = Session::get('PRIVATE_USER_DETAILS')->id;
                }
                
                $order_master->save();
                
                $order_master->order_id            = '#ORD'.('10000' + $order_master->id);
                $order_master->save();
                
                foreach($cart_item as $cart){
                    $order                      = new Private_order;
                    $order->order_master_id     = $order_master->id;
                    $order->project_id          = ($cart->options->project_id - 10000);
                    $order->plan_id             = $cart->id;
                    if(Session::has('PRIVATE_COMPANY_DETAILS') && Session::get('PRIVATE_COMPANY_DETAILS') != ''){
                        $order->user_id      = Session::get('PRIVATE_COMPANY_DETAILS')->id;
                    }elseif(Session::has('PRIVATE_USER_DETAILS') && Session::get('PRIVATE_USER_DETAILS') != ''){
                        $order->user_id      = Session::get('PRIVATE_USER_DETAILS')->id;
                    }
                    $order->order_type          = $cart->options->papersize;
                    $order->price               = $cart->price;
                    $order->quantity            = $cart->qty;
                    
                    //dd($order);
                    $order->save();
                }
                $setting_email_value    = Sitesetting::find(1);
                $data['from_email']     = $setting_email_value->sitesettings_value;
                $data['from_name']      = '';
                
                
                if(Session::has('PRIVATE_COMPANY_DETAILS') && Session::get('PRIVATE_COMPANY_DETAILS') != ''){
                    $user      = Private_company::find(Session::get('PRIVATE_COMPANY_DETAILS')->id);
                }elseif(Session::has('PRIVATE_USER_DETAILS') && Session::get('PRIVATE_USER_DETAILS') != ''){
                    $user      = Private_company::find(Session::get('PRIVATE_USER_DETAILS')->id);
                }
                $data['to_email']       = $user->email;
                $data['user']           = $user;
                $data['cart_item']      = $cart_item;
                
                if($request->delivery_type == 'store_location'){
                $order_master->pickup_location     = $request->pickup_location;
                }
                if($request->delivery_type == 'local_delivery'){
                $order_master->address             = $request->address;
                $order_master->city                = ($request->city != '')?$request->city:null;
                $order_master->states              = ($request->states != '')?$request->states:null;
                $order_master->zip                 = $request->zip;
                }
                
                $data['delivery_type']      = $request->delivery_type;
                $data['pickup_location']    = $request->pickup_location;
                $data['address']            = $request->address;
                $data['city']               = $request->city;
                $data['states']             = $request->states;
                $data['zip']                = $request->zip;
                $data['subject']            = 'Private Plan';
                
                $mail = \Mail::send('emails.private_plan_download', $data, function ($message) use ($data) {
                    $message->from($data['from_email'], $data['from_name']);
                    $message->subject($data['subject']);
                    $message->to($data['to_email'] );
                });
                
                Cart::destroy();
                
                return Redirect::route('private_payment_success',Session::get('COMPANY_SLUG'))->with('order_id',$order_master->id)->with('success',true);
            
                //echo "Charge Credit Card AUTH CODE : " . $tresponse->getAuthCode() . "\n";
                //echo "Charge Credit Card TRANS ID  : " . $tresponse->getTransId() . "\n";
            }
            else
            {
                Cart::destroy();
                
                $errormsg = $tresponse->getErrors();
                
                return Redirect::route('private_payment_success',Session::get('COMPANY_SLUG'))->with('error',$errormsg[0]->getErrorText());
            }
        }
        else
        {
            Cart::destroy();
            
            return Redirect::route('private_payment_success',Session::get('COMPANY_SLUG'))->with('error','Charge Credit card Null response returned');
        }
    }
    
    public function payment_success($company_slug){
        $data = [];
        $company = $this->companyExistCheck($company_slug);
        if(count($company) > 0){
            echo view('front.private.cart.payment_success',$data);
        }else{
            return view('front.private.companyNotExist',$data);
        }
    }
}
