<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;

use App\Private_company,App\Private_planroom_assigns,App\Private_project,App\Private_company_assign,App\Private_plans,App\Price,App\Private_order, App\Private_order_master,App\Sitesetting;
use \Session,\Redirect,\Validator;
use \Cart;

class PrivatePlanroomController extends Controller
{
    public function login(Request $request,$company_slug){
        
        $company    = $this->companyExistCheck($company_slug);
        $data       = array();
        if(count($company) > 0){
            if(Session::has('PRIVATE_COMPANY_DETAILS') && Session::get('PRIVATE_COMPANY_DETAILS')->id != ''){
                return Redirect::route('public_planroom_list_for_company',[Session::get('COMPANY_SLUG')]);
            }elseif(Session::has('PRIVATE_USER_DETAILS') && Session::get('PRIVATE_USER_DETAILS')->id != ''){
                return Redirect::route('public_planroom_list_for_user',[Session::get('COMPANY_SLUG')]);
            }else if(Session::has('USER_DETAILS') && Session::get('USER_DETAILS')->id != ''){
                return Redirect::route('dashboard');
            }
            $data['company'] = $company;
            if(count($request->request) > 0){
                $email      = $request->email;
                $password   = $request->password;
                $user       = Private_company::where('email',$email)->where('status','Active')->first();
                if($user){
                    if(\Hash::check($password,$user->password) ){
                        if($user->user_type == 'company'){
                            if($user->company_slug == $company_slug){
                                Session::set('COMPANY_SLUG',$company_slug);
                                Session::set('PRIVATE_COMPANY_DETAILS',$user);
                                return Redirect::route('public_planroom_list_for_company',[$company_slug]);
                            }else{
                                $data['error'] = 'You can not login for this company';
                            }
                        }else{
                            $userExist = Private_company_assign::where('user_id',$user->id)->where('company_id',$company->id)->count();
                            if($userExist > 0){
                                Session::set('COMPANY_SLUG',$company_slug);
                                Session::set('PRIVATE_USER_DETAILS',$user);
                                return Redirect::route('public_planroom_list_for_user',[$company_slug]);
                            }else{
                                $data['error'] = 'Please enter valid login details';
                            }
                        }
                    }else{
                        $data['error'] = 'Please enter valid login details';
                    }
                }else{
                    $data['error'] = 'Please enter valid email and password';
                }
            }
            return view('front.private.login',$data);
        }else{ 
            return view('front.private.companyNotExist',$data);
        }
    }
    
    public function details(Request $request){
        $data = array();
        $data['details']    = Private_project::find($request->project);
        return view('front.private.details',$data);
    }
    
    public function addToCart(Request $request){
        $plan_id        = rtrim($request->plan_id,',');
        $papersize      = $request->papersize;
        $plan_details   = Private_plans::whereIn('id',explode(',',$plan_id))->get();
        if(count($plan_details) > 0){
            foreach($plan_details as $plan){
                
                $planarea = $plan->file_height * $plan->file_width;
                $price    = Price::whereRaw("$planarea BETWEEN from_range AND to_range")->first();
                if(count($price) > 0){
                    if($papersize == 'full_size'){
                        $price  = $price->full_size_price;
                    }elseif($papersize == 'half_size'){
                        $price  = $price->half_size_price;
                    }else{
                        $price  = $price->download_price;
                    }
                }else{
                    if($papersize == 'full_size'){
                        $price  = 1;
                    }elseif($papersize == 'half_size'){
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
                    Cart::add($plan->id, $plan->plan_name, 1, $price,['project_id' => $plan->project->project_id,'papersize' => $papersize,'project_name' => $plan->project->project_name]);
                }
                else{
                    Cart::add($plan->id, $plan->plan_name, 1, $price,['project_id' => $plan->project->project_id,'papersize' => $papersize,'project_name' => $plan->project->project_name]);
                }
            
            }
        }
        
    }
    
    public function cartView(){
        $data['cart_item']      = count(Cart::content());
        $data['company_slug']   = Session::get('COMPANY_SLUG');
        echo json_encode($data);  
    }
    
    public function logout($company_slug){
        Cart::destroy();
        Session::forget('PRIVATE_COMPANY_DETAILS');
        Session::forget('PRIVATE_USER_DETAILS');
        Session::forget('COMPANY_SLUG');
        return Redirect::route('private_planroom_login',[$company_slug]);
    }
    
    public function order(Request $request,$company_slug){
        $data = [];
        $company = $this->companyExistCheck($company_slug);
        if(count($company) > 0){
            if(Session::has('PRIVATE_COMPANY_DETAILS') && Session::get('PRIVATE_COMPANY_DETAILS') != ''){
                $user_id      = Session::get('PRIVATE_COMPANY_DETAILS')->id;
            }elseif(Session::has('PRIVATE_USER_DETAILS') && Session::get('PRIVATE_USER_DETAILS') != ''){
                $user_id      = Session::get('PRIVATE_USER_DETAILS')->id;
            }
            $data['list'] = Private_order_master::where('user_id',$user_id)->orderBy('created_at','desc')->paginate(10);
            return view('front.private.order.index',$data);
        }else{
            return view('front.private.companyNotExist',$data);
        }
    }
    
    public function order_details($company_slug,$id)
    {
        $data = [];
        $company = $this->companyExistCheck($company_slug);
        if(count($company) > 0){
            $data['details'] = Private_order_master::find($id);
            return view('front.private.order.details',$data);
        }else{
            return view('front.private.companyNotExist',$data);
        }
    }
    
    public function change_password(Request $request) 
    {
        $data           = array();
        if(Session::has('PRIVATE_COMPANY_DETAILS') && Session::get('PRIVATE_COMPANY_DETAILS') != ''){
            $id      = Session::get('PRIVATE_COMPANY_DETAILS')->id;
        }elseif(Session::has('PRIVATE_USER_DETAILS') && Session::get('PRIVATE_USER_DETAILS') != ''){
            $id      = Session::get('PRIVATE_USER_DETAILS')->id;
        }
        
	$user           = Private_company::find($id);
	$data['user']   = $user;
        
        if($request->isMethod('post')){
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
                if(\Hash::check($old_password,$user->password)){
                    $user->password = $new_password;
                    $user->save();
                    return Redirect::route('private_change_password',Session::get('COMPANY_SLUG'))->with('success','Password is updated successfully');
                }else{
                   return Redirect::route('private_change_password',Session::get('COMPANY_SLUG'))->with('error','Old Password does not matched');
                }
            }
        }
	return view('front.private.change_password',$data);
       
    }
    
    public function private_project_print($id){
        $data['list'] = Private_project::where('id',$id)->first();
        return view('front.private.print',$data);   
    }
    
    public function forgot_password($company_slug,Request $request){
        $company    = $this->companyExistCheck($company_slug);
        $data       = array();
        if(count($company) > 0){
            if($request->isMethod('post')){
                $validator = Validator::make(
                            $request->all(),
                            ['email'         => 'required|email']);
                if ($validator->fails())
                {
                    $messages = $validator->messages();
                    return Redirect::back()->withErrors($validator)->withInput();
                }
                else
                {
                $user = Private_company::where('email',$request->email)->first();
                if(count($user) > 0){
                    $mail_send = 0;
                    if($user->user_type == 'company'){
                        if($user->company_slug == $company->company_slug){
                        $mail_send = 1;
                        }
                    }elseif($user->user_type == 'user'){
                        $assign_user = Private_company_assign::where('company_id',$company->id)->where('user_id',$user->id)->count();
                        if($assign_user > 0){
                            $mail_send = 1;
                        }
                    }
                    if($mail_send == 1){
                        $user->token            = str_random(8);
                        $user->save();
                        $setting_email_value    = Sitesetting::find(1);
                        $data['to_email']       = $request->email;
                        $data['from_email']     = $setting_email_value->sitesettings_value;
                        $data['from_name']      = 'aerepro';
                        $data['user']           = $user;
                        $data['company_slug']   = $company->company_slug;
                        \Mail::send('emails.forgot_password', $data, function ($message) use ($data) {
                                    $message->from($data['from_email'], $data['from_name']);
                                    $message->subject('Forgotten password reset');
                                    $message->to($data['to_email'] );
                        });
                        return Redirect::route('private_forgot_password',$company_slug)->with('success','Please check your email to reset password.');
                    }else{
                        return Redirect::route('private_forgot_password',$company_slug)->with('error','You are not assign for this company');
                    }
                }else{
                    return Redirect::route('private_forgot_password',$company_slug)->with('error','Email address does not exist');
                }
                }
            }
            $data['company'] = $company;
            return view('front.private.forgot_password',$data);
        }else{ 
            return view('front.private.companyNotExist',$data);
        }
        
    }
    
    public function reset_password($company_slug,$token,Request $request){
        $company    = $this->companyExistCheck($company_slug);
        $data       = array();
        if(count($company) > 0){
            $data['company']    = $company;
            $data['token']      = $token;
            $user = Private_company::where('token',$token)->first();
            if(count($user) > 0){
                if($request->isMethod('post')){
                    $validator = Validator::make(
                                        $request->all(),
                                        ['password'         => 'required|min:8',
                                         'retypepassword'   => 'required|same:password',
                                        ]);
                    if ($validator->fails())
                    {
                        $messages = $validator->messages();
                        return Redirect::back()->withErrors($validator)->withInput();
                    }
                    else
                    {
                        $password           = $request->password;
                        $user->password     = $password;
                        $user->token        = '';
                        $user->save();
                        return Redirect::route('thankyou')->with('success','Password is updated successfully');
                    }
                }
                return view('front.private.reset_password',$data);
            }else{
                return view('front.private.companyNotExist',$data);
            }
        }else{
            return view('front.private.companyNotExist',$data);
        }
    }
    
    public function normal_site(){
	Cart::destroy();
        Session::forget('PRIVATE_COMPANY_DETAILS');
        Session::forget('PRIVATE_USER_DETAILS');
        Session::forget('COMPANY_SLUG');
        return Redirect(\Config::get('constant.w_link'));
    }
}
