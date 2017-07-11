<?php namespace App\Http;
use \Route, \Config;
use App\County, App\Private_company, App\Users,App\User_subscription;


    class Helpers {
	
	
	public static function isFileExist($file_path,$url="http://specs.wj6sbbg5kqo.netdna-cdn.com/")
	{
		$file_path 	= $url.$file_path;
		$ch		= curl_init($file_path);
		curl_setopt($ch, CURLOPT_NOBODY, true);
		curl_exec($ch);
		
		$retcode = curl_getinfo($ch, CURLINFO_HTTP_CODE);
		
		if($retcode == 200)
		{
		    return  $file_path;
		}
		else
		{
		    return  false;
		}
		curl_close($ch);
		
	}
	
	public static function getSelectedCounty(){
	    return County::whereIn('id',['7','18'])->get();
	}
	
	public static function getCompanyLogo($company_slug){
	    $company = Private_company::where('company_slug',$company_slug)->first();
	    if(count($company)>0){
	    return $company->logo;
	    }
	    return false;
	}
	
	public static function getSubscriptionID($id){
	    $user = User_subscription::select(\DB::raw('GROUP_CONCAT(DISTINCT subscription_id) as subscription_id'))->where('user_id',$id)->where('status','active')
        ->whereDate('start_date', '<=', \Carbon\Carbon::today()->toDateString())
        ->whereDate('end_date', '>', \Carbon\Carbon::today()->toDateString())->first();
	    if(count($user)>0){
	    return $user->subscription_id;
	    }
	    return false;
	}
    } //Class
