<?php

namespace App\Http\Controllers\admin;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;

use \Session, \Validator,\Redirect, \Cookie;
use Illuminate\Cookie\CookieJar;
use Illuminate\Cookie\CookieServiceProvider;
use App\Admin;
use \Auth;
class LoginController extends Controller
{
    public function index(Request $request , CookieJar $cookieJar){
       $data = array();
        if(Session::has('ADMIN_ACCESS_ID')){
            return redirect::route('admin_dashboard');
        }
        if( $request->isMethod('post') ){
            $data['email'] = '';
            $data['password'] = '';
            
            $validator = Validator::make($request->all(), ['email'=>'required|email','password' => 'required']);
            
            if($validator->fails()){
                 $messages = $validator->messages();
                 return Redirect::back()->withErrors($validator)->withInput();
            }
            else{
                $email = $request->get('email');
                $password = $request->get('password');
                if($request->get('remember_me')){
                    $cookieJar->queue(Cookie::make('email',$email,45000));
                    $cookieJar->queue(Cookie::make('password',$password,45000));
                }
                else{
                    $cookieJar->queue(Cookie::forget('email'));
                    $cookieJar->queue(Cookie::forget('password'));
                }
                $checkAdminExists = Admin::where('email', $email)->get();
                if( count($checkAdminExists) > 0 ){
                    $checkUserstatus = Admin::where('email', $email)
                                                ->where('status','Active')
                                                ->get();
                    if( count($checkUserstatus) > 0 ){
                        $auth = auth()->guard('admin');
                        $userdata = array('email' => $email, 'password' => $password);
                        if($auth->attempt($userdata)){
                            //dd($auth->authenticate()->roles);
                            //echo $auth->authenticate()->id;
                            //exit;
                            Session::put('ADMIN_ACCESS_ID', $checkAdminExists[0]->id);
                            $name = $checkAdminExists[0]->first_name." ".$checkAdminExists[0]->last_name;
                            Session::put('ADMIN_ACCESS_NAME', $name);
                            Session::put('ADMIN_ACCESS_EMAIL', $checkAdminExists[0]->email);
                            return redirect::route('admin_dashboard');
                        }
                        else{
                            return redirect::back()->with('errorMessage', 'Invalid email address or/and password provided.');
                        }
                    }
                    else{
                        return redirect::back()->with('errorMessage', 'You have not permission to access this.');
                    }
                }
                else{
                    return redirect::back()->with('errorMessage', 'Invalid email address or/and password provided.');
                }
            }
        }
        $email = Cookie::get('email');
        $password = Cookie::get('password');
        
        if( $email && $password ){
            $data['email'] 		= $email;
            $data['password'] 		= $password;
        }
        return view('admin.adminLogin',$data);
    }
    
    public function admin_forgot_password(){
        $data = array();
        return view('admin.forgot_password',$data);
    }
    public function admin_forgot_password_action(Request $request){
        $email  = $request->email;
        $profile = Admin::where('email',$email)->first();
        if(count($profile)>0){
            $new_pass = str_random(10);
           
            
            $data['from_email'] = 'noreply@admin.com';
            $data['form_name'] =  "Aerepro" ;
            $data['to_email'] = $email;
            $data['to_name'] = 'Admin';
            $data['password'] = $new_pass;
            
            \Mail::send('emails.admin_password_recovary', $data, function ($message) use ($data) {
                $message->from($data['from_email'], $data['form_name']);
                $message->subject('Password Recovary');
                $message->to($data['to_email'] );
            });
            $profile->password = $new_pass ;
            $profile->save();
            return Redirect::route('admin_forgot_password')->with('sucMsg','Password is send to the email address. Please check in your inbox');
        }else{
            return Redirect::route('admin_forgot_password')->with('errorMessage','Email is not exists');
        }
    }
    
    
}

