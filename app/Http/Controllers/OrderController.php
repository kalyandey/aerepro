<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;

use Session;

use App\Order, App\Order_master, App\Sitesetting,App\Project;

use phpseclib\Net\SFTP;
use \ZipArchive;
use \Response;

class OrderController extends Controller
{
    public function index(Request $request){
        $data['list'] = Order_master::where('user_id',Session::get('USER_DETAILS')->id)->orderBy('created_at','desc')->paginate(10);
        return view('front.order.index',$data);
    }
    
    public function details($id)
    {
        $data['details'] = Order_master::find($id);
        return view('front.order.details',$data);
    }
    
    public function download_zip($id,$project_id){
        
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
            $pro = Project::where('project_id',$project_id)->first();
            $ordered = $orderDetails->order()->where('project_id',$pro->id)->whereIn('order_type',['full_set','download'])->get();
            if(count($ordered) > 0 ){
            foreach($ordered as $order){
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

        /*$file = 'zip_download.zip';
        $zip = \Zipper::make(public_path('zip_folder/'.$file));
        foreach($orderDetails->order as  $order){
            $files = $sftp->get('public_html/uploads/project/plan/'.$order->plan->file_name);
            $zip->addString($order->plan->file_name,$files);
        }
        return response()->download(public_path('zip_folder/'.$file))->deleteFileAfterSend(true);*/
    }
    
    public function print_order($id){
        $data = array();
        $setting_val            = Sitesetting::find(6);
        $data['settingval']     = $setting_val->sitesettings_value;
        $data['details']        = Order_master::find($id);
        $pdf                    = \App::make('dompdf.wrapper');
        $str                    = view('front.order.details_print',$data);
        $str                    = $str->render();
        $pdf->loadHTML($str)->setPaper('letter','portrait');
        return $pdf->stream();
    }
}
