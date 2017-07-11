<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Users,App\Sitesetting,App\User_subscription,App\Email_templete;

class CronController extends Controller
{
    public function reminder(){
        
        $users = User_subscription::where(\DB::raw('DATE_FORMAT(SUBDATE(end_date, INTERVAL 2 week),"%Y-%m-%d")'),date('Y-m-d'))->where('auto_payment','enable')->get();
        if(count($users) > 0){
            foreach($users as $u){
                $sitesettings           = Sitesetting::find(2);
                $data['from_email']     = $sitesettings->sitesettings_value;
		
		$emailtmp		= Email_templete::find(6);
		
                $data['form_name']      = "Aerepro" ;
                $data['to_email']       = $u->user->email;
		//$data['to_email']       = 'nasmin.begam@webskitters.com';
                $data['to_name']        = $u->user->first_name;
                $data['renewal_date']   = date('m/d/Y',strtotime($u->end_date));
                $data['subject']	= $emailtmp->email_subject;
		$data['msg']	    = str_replace(array('{RENEWAL_DATE}'),array($data['renewal_date']),$emailtmp->email_content);
                $mail = \Mail::send('emails.common', $data, function ($message) use ($data) {
                    $message->from($data['from_email'], $data['form_name']);
                    $message->subject($data['subject']);
                    $message->to($data['to_email'] );
                });
            }
        }
        //dd($users);
    }
    
    
    public function auto_payment(){
        
        $users = User_subscription::where(\DB::raw('DATE_FORMAT(end_date,"%Y-%m-%d")'),date('Y-m-d'))->where('auto_payment','enable')->get();
	if(count($users) > 0){
            foreach($users as $user){
		$user->start_date  = date('Y-m-d H:i:s',strtotime('+1 day', strtotime($user->end_date)));
                if($user->subscription_type == 'quarterly'){
                $user->end_date    = date('Y-m-d H:i:s',strtotime('+3 months', strtotime($user->start_date)));   
                }elseif($user->subscription_type == 'yearly'){
                $user->end_date    = date('Y-m-d H:i:s',strtotime('+1 year', strtotime($user->start_date))); 
                }
                $user->save();
	    }
	}
        //dd($users);
    }
    
    public function disablereminder(){
        
	///Expiration Change
	$expireSubscription = User_subscription::whereDate(\DB::raw('DATE_FORMAT(end_date,"%Y-%m-%d")'), '<', date('Y-m-d'))->where('status','active')->get();
	if(count($expireSubscription) > 0 ){
	    foreach($expireSubscription as $es){
		$subscribe                  = User_subscription::find($es->id);
		$subscribe->status          = 'inactive';
		$subscribe->payment_expire  = 'Yes';
		$subscribe->save();
	    }
	}
	
	
	////14days ago mail send
	
	$selectSubscription         = User_subscription::where(\DB::raw('DATE_FORMAT(SUBDATE(end_date, INTERVAL 2 week),"%Y-%m-%d")'),date('Y-m-d'))->where('auto_payment','disable')->get();
	//dd($selectSubscription);
	if(count($selectSubscription) > 0){
	    foreach($selectSubscription as $sSub){
		$emailtmp		= Email_templete::find(7);
		
		$sitesettings           = Sitesetting::find(2);
		$data['from_email']     = $sitesettings->sitesettings_value;
		$data['form_name']      = "Aerepro" ;
		$data['to_email']       = $sSub->user->email;
		//$data['to_email']       = 'nasmin.begam@webskitters.com';
		$data['to_name']        = $sSub->user->first_name;
		$data['renewal_date']   = date('m/d/Y',strtotime($sSub->end_date));
		$data['subject']	= $emailtmp->email_subject;
		$data['service']	= $sSub->subscription->subscription_title;
		$data['msg']	    	= str_replace(array('{SERVICE}','{RENEWAL_DATE}'),array($data['service'] , $data['renewal_date']),$emailtmp->email_content);
		$mail = \Mail::send('emails.common', $data, function ($message) use ($data) {
		    $message->from($data['from_email'], $data['form_name']);
		    $message->subject($data['subject']);
		    $message->to($data['to_email'] );
		});
	    }
	}
    }
}
