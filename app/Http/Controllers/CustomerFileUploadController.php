<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Customer_file, App\User;
use Session;
use phpseclib\Net\SFTP;
use \ZipArchive;
use \Response;

class CustomerFileUploadController extends Controller
{
        public function index(Request $request){
            $data                       = array();            
            //$data['plans']              = Customer_file::where('user_id',Session::get('USER_DETAILS')->id)->get();
            $data['userdtls']           = User::find(Session::get('USER_DETAILS')->id);
            return view('front.user.pdf_view',$data);
        }
        
        public function upload_pdf(Request $request){
            $fileInfo                       = pathinfo($request->file_name);
            $filename                       = $fileInfo['filename'].'.pdf';
            $id                             = Session::get('USER_DETAILS')->id;
            $cus                            = new Customer_file;
            $files                          = $request->image;
            $file_arr                       = explode(';',$files);
            
            $ext                            = 'pdf';
            $files                          = str_replace(array('data:application/pdf;base64,'),array(''),$files);
            $files                          = str_replace(array('data:application/force-download;base64,'),array(''),$files);
            $files                          = str_replace(array('data:application/x-unknown;base64,'),array(''),$files);
            $file                           = base64_decode($files);
            $extension                      = $ext;
            //$filename                       = md5(microtime()).'.'.$extension;
            //$files->move(public_path('uploads/project/plan/'), $filename);
            file_put_contents(public_path('uploads/customer/file/'.$filename), $file);
            
            $file = public_path("uploads/customer/file/".$filename);
            $this->fileupload($file , 'uploads/customer/file/' , $filename);
            
            
            $cus->file_name                 = $filename;
            $cus->user_id                   = $id;
            $cus->save();

            echo json_encode(['id'=>$cus->id,'user_id'=>$cus->user_id,'file_name'=>$cus->file_name]);
    }
    public function file_lists(Request $request){
        $user_id                = $request->user_id;
        $file['file']           = Customer_file::where('user_id',Session::get('USER_DETAILS')->id)->orderBy('file_name','ASC')->get();
        $file                   =  response()->json($file);
        return $file;
    }
    
    public function delete_multiple_files(Request $request){
        $plans      = rtrim($request->plans,',');
        $plans      = Customer_file::whereIn('id',explode(',',$plans))->get();
        foreach($plans as $plan){
            if(\Helpers::isFileExist('uploads/customer/file/'.$plan->file_name) && $plan->file_name != ''){
                $this->removeFile('uploads/customer/file/'.$plan->file_name);
            }
            $plan->delete();
        }
    }
    
    public function file_delete(Request $request){
        
        $plan_id    = $request->plan_id;
        $plan       = Customer_file::find($plan_id);
        if(\Helpers::isFileExist('uploads/customer/file/'.$plan->file_name) && $plan->file_name != ''){
            $this->removeFile('uploads/customer/file/'.$plan->file_name);
        }
        
        $plan->delete();
        return response()->json(['code'=>1,'msg'=>'File is removed successfully']);
    }

    public function zip_file_create(Request $request){
        
        $customer       = Customer_file::where('user_id',Session::get('USER_DETAILS')->id)->get();
        
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
           
            if(count($customer) > 0 ){
            foreach($customer as  $c){
                $files = $sftp->get('public_html/uploads/customer/file/'.$c->file_name);
                $zip->addFromString($c->file_name,$files);
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
