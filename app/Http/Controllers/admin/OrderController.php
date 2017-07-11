<?php

namespace App\Http\Controllers\admin;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use App\Order, App\Order_master, App\Sitesetting;
use App\Plan , App\Users, App\Project;
use \Validator, \Redirect, \Session;
use phpseclib\Net\SFTP;
use \ZipArchive;

class OrderController extends Controller
{
    public function index(Request $request){
        $data['keyword']        = '';
        $data['delivery_type']  = '';
        $data['start_date']     = '';
        $data['end_date']       = '';
        if($request->keyword !='' ||  $request->delivery_type != '' ||  $request->user != '' ||  ($request->start_date != '' &&  $request->end_date != '')){
        
        $data['keyword']            = $request->keyword;
        $data['delivery_type']      = $request->delivery_type;
        $data['start_date']         = $request->start_date;
        $data['end_date']           = $request->end_date;
        $lists = Order_master::where(function($query) use ($data) {
                                if($data['delivery_type'] != ''){
                                    $query->where('delivery_type',$data['delivery_type']);
                                }
                                if($data['keyword'] != ''){
                                $query->where('transaction_id','like','%'.$data['keyword'].'%');
                                $query->orWhere('order_id','like','%'.$data['keyword'].'%');
                                }
                                if($data['start_date'] != '' && $data['end_date'] != ''){
                                    $start_date     = explode('/',$data['start_date']);
                                    $start_date     = $start_date[2].'-'.$start_date[0].'-'.$start_date[1];
                                    $end_date       = explode('/',$data['end_date']);
                                    $end_date       = $end_date[2].'-'.$end_date[0].'-'.$end_date[1];
                                    
                                    //$query->where(\DB::raw('DATE_FORMAT(created_at, "%m/%d/%Y")'),'<=',$data['start_date']);
                                    //$query->where(\DB::raw('DATE_FORMAT(created_at, "%m/%d/%Y")'),'>=',$data['end_date']);
                                    
                                    $query->whereBetween(\DB::raw('DATE_FORMAT(created_at, "%Y-%m-%d")'),[$start_date, $end_date]);
                                } 
                            });
        $data['lists_result'] = $lists->orderBy('updated_at','desc')->paginate(10);
        }
        else
        {
            $data['lists_result'] = Order_master::orderBy('created_at','desc')->paginate(10);
        }
        $data['users']      = [''=>'Select User'] + Users::select('id', \DB::raw('CONCAT(first_name, " ", last_name) AS full_name'))->pluck('full_name','id')->all();
        //dd($data);
        return view('admin.order.list',$data);
    }
    
    public function view($id)
    {
        $data = array();
        $data['details'] = Order_master::find($id);
        $setting_val = Sitesetting::find(6);
        $data['settingval'] = $setting_val->sitesettings_value;
        return view('admin.order.view',$data);
    }
    
    public function invoice_pdf($id)
    {
        $data 			= array();
        $data['details'] 	= Order_master::find($id);
        $setting_val 		= Sitesetting::find(6);
        $data['settingval'] 	= $setting_val->sitesettings_value;
        $pdf = \App::make('dompdf.wrapper');
        $str = view('admin/order/invoice_pdf',$data);
		//echo $str ; die;
        $str = $str->render();
        $pdf->loadHTML($str)->setPaper('letter','portrait');
        return $pdf->stream();
	
    }
    
    public function admin_download_zip($id,$project_id){
        
        $orderDetails   = Order_master::find($id);
        
        $server         = 'ftp.specs.wj6sbbg5kqo.netdna-cdn.com';
        $port           = '22';
        $username       = 'specs.wj6sbbg5kqo';
        $passwd         = 'aerepro_specs';
        $sftp           = new SFTP('ftp.specs.wj6sbbg5kqo.netdna-cdn.com');
        if (!$sftp->login($username, $passwd)) {
        exit('Login Failed');
        }
        
        $zipFileName =  time().'.zip';
        // Create "MyCoolName.zip" file in public directory of project.
        $zip = new \ZipArchive;
        
        if ( $zip->open( public_path() . '/zip_folder/' . $zipFileName, ZipArchive::CREATE ) === true )
        {
            // Copy all the files from the folder and place them in the archive.
            
            $ordered = $orderDetails->order()->where('project_id',$project_id)->whereIn('order_type',['full_set','download'])->get();
            
            if(count($ordered) > 0 ){
            foreach($ordered as  $order){
		if($order->plan_id == null){
                    if(count($order->project->plan) > 0 ){
                        foreach($order->project->plan as $oplan){
                            $files = $sftp->get('public_html/uploads/project/plan/'.$oplan->file_name);
                            $zip->addFromString($oplan->file_name,$files);
                        }
                    }
                }else{
                    $files = $sftp->get('public_html/uploads/project/plan/'.$order->plan->file_name);
                    $zip->addFromString($order->plan->file_name,$files);
                }
            }

            $zip->close();
            
            header('Content-Type: application/zip');
            header('Content-disposition: attachment; filename='.$zipFileName);
            header('Content-Length: ' . filesize(public_path() . '/zip_folder/' . $zipFileName));
            readfile(public_path() . '/zip_folder/' . $zipFileName);
            @unlink(public_path() . '/zip_folder/' . $zipFileName);
            }
        }  
}
}