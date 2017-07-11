<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use \Auth, \Mail;
use App\Http\Helpers;
use App\Users;
use \Session, \Validator,\Redirect, \Cookie;
class ResetpwdController extends Controller
{
    public function index()
    {
        $data = array();
        return view('front.resetpwd.reset_pwd',$data);
    }
    
    public function user_forgotpwd_action(Request $request)
    {
        $validator = Validator::make(
                                $request->all(),
                                 [
                                      'email'	  => 'required|email'
                                      
                                 ]
        );
	if ($validator->fails())
	{
	    return Redirect::back()->withErrors($validator)->withInput();
	    
	}
	else
	{
	    $user_details = Users::where('email',$request->email)->where('status','Active')->first();
            
	 
        if($user_details && $user_details->count()){
            $token =  md5($user_details->email).time();
            $user_details->token = $token;
	    $user_details->save();
            $user_details1['from_email'] = 'admin@admin.com';
            $user_details1['form_name'] = "A&E Reprographics";
            //$user_details1['to_email'] = 'indira.giri@webskitters.com';
            //$user_details1['to_name'] = $request->first_name.' '.$request->last_name;
	    $user_details1['to_email'] = $request->email;
	    Mail::send('emails.reset_password', array( 'first_name' => $user_details->first_name, 'last_name'=>$user_details->last_name ,'token'=> $token ), function($message) use ($user_details1)
	    {
		    $message->from($user_details1['from_email'], $user_details1['form_name']);
		    $message->subject('User Reset Password');
		    $message->to($user_details1['to_email']);
	    });
            
            return Redirect::back()->with('successMessage', 'A password reset link has been sent to your email. Please check your email.');
        }else{
            return Redirect::back()->with('errorMessage', 'Sorry! we did not find your email in our system');
            
        }
    
	}
    }
    
    public function password_reset($token){
        
        $data = array();
        $data['token'] = $token;
        return view('front.resetpwd.passwordreset',$data);
    }
    
        public function password_update(Request $request,$token){
        
        
        $validator = Validator::make(
                            $request->all(),
                            [                                  
                                'password'              => 'required|confirmed',
                                'password_confirmation' => 'required'                                                                                    
                            ]
                            );
        if ($validator->fails())
        {
             return Redirect::back()->withErrors($validator)->withInput();
        }
        else
        {
       
            
                $user_details = Users::where('token',$token)->first();
                //dd($user_details->count());
                 if(isset($user_details->token)){
                    $user_details->password = $request->password;
                    $user_details->token = '';
                    $user_details->save();
                    return redirect::back()->with('successMessage', 'Congratulations! you have reset your password successfully.Please login' );
                    
                 }else{
                    
                    return redirect::back()->with('errorMessage', 'Sorry! token miss match.');
                 }
               
        }
         
        
    }
}
