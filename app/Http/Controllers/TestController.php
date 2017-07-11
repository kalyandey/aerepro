<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use \Session , \Validator, \Redirect;
use App\Users;
use App\Sitesetting, App\Email_templete, App\Order_master;
class TestController extends Controller
{
    public function index(){
        return view('front.test');
    }
    
    public function testing(Request $request){
	$cars=array("Volvo12","Volvo10","BMW1","BMW2","Toyota");
        rsort($cars);
        
        $clength=count($cars);
        //for($x=$clength;$x>=0;$x--)
        //{
        //echo $cars[$x];
        //echo "<br>";
        //}
        //for($x=0;$x<$clength;$x++)
        //{
        //echo $cars[$x];
        //echo "<br>";
        //}
        //
        $cars=array('a'=>"Volvo",'d'=>"BMW",'c'=>"Toyota");
        $cars=array("Volvo12","Volvo10","BMW1","BMW2","Toyota");
        natsort($cars);
        print_r($cars);exit;
        $clength=count($cars)-1;
        for($x=0;$x<=$clength;$x++)
        {
        echo $cars[$x];
        echo "<br>";
        }
    }
    
    public function pdf_test(){
                    
        $data = array();
        $pdf = \App::make('dompdf.wrapper');
        $str = view('front.invoice_html.plan_download',$data);
        $str = $str->render();
        $pdf->loadHTML($str)->setPaper('letter','portrait');
        return $pdf->stream();
    }
    
    public function pdf_test_subscribe(){
                    
        $data = array();
        $pdf = \App::make('dompdf.wrapper');
        $str = view('front.invoice_html.pdf_test_subscribe',$data);
        $str = $str->render();
        $pdf->loadHTML($str)->setPaper('letter','portrait');
        return $pdf->stream();
    }
    
    public function view_pdf(){
        //
        //return Response::make(base64_decode( $pdf->pdf), 200, [
        //    'Content-Type' => 'application/pdf',
        //    'Content-Disposition' => 'inline; filename="'.$filename.'"',
        //]);
        //    
            
        return \Response::make(file_get_contents(public_path().'/pdf/1484822798invoice.pdf'), 200, [
            'Content-Type' => 'application/pdf',
            'Content-Disposition' => 'inline;'
        ]);

        return \PDF::loadFile(public_path().'/pdf/1484733133invoice.pdf')->stream('download.pdf');

        echo asset('pdf/1484733133invoice.pdf');
        exit;
    }
    public function order_invoice(){
                    
        $data = array();
        $pdf = \App::make('dompdf.wrapper');
        $str = view('front.invoice_html.order_invoice',$data);
        $str = $str->render();
        $pdf->loadHTML($str)->setPaper('letter','portrait');
        return $pdf->stream();
    }
    
    public function emailtemplate(){
	$setting_email_value    	= Sitesetting::find(1);
	$data['from_email']     	= $setting_email_value->sitesettings_value;
	$data['from_name']      	= '';
	
	$setting_tax    	    	= Sitesetting::find(6);
	$data['setting_tax']    	= $setting_tax->sitesettings_value;
		    
	$emailtmp		    	= Email_templete::find(1);
	$data['msg']   			= $emailtmp->email_content;
	
	$user                   	= Users::find(21984);
	$data['to_email']       	= $user->email;
	$data['user']           	= $user;
	$data['order_master']   	= Order_master::find(6);
	$data['subject']            	= str_replace('{ORDER_ID}',6,$emailtmp->email_subject);

	//
	$mail = \Mail::send('emails.test_download', $data, function ($message) use ($data) {
	    $message->from($data['from_email'], $data['from_name']);
	    $message->subject($data['subject']);
	    $message->to($data['to_email'] );
	});
	
    }
    
}
