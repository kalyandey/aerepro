<?php

namespace App\Http\Controllers\admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Customer_file, App\User;

class CustomerFileUploadController extends Controller
{
        public function index(Request $request, $id){
            $data                       = array();            
            $data['plans']              = Customer_file::where('user_id',$id)->get();
            $data['userdtls']           = User::find($id);
            return view('admin.users.front_user.pdf_view',$data);
        }
        
        public function upload_pdf(Request $request){
            $fileInfo                       = pathinfo($request->file_name);
            $filename                       = $fileInfo['filename'].'.pdf';
            $id                             = $request->user_id;
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
        $file['file']           = Customer_file::where('user_id',$user_id)->orderBy('file_name','ASC')->get();
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
        dd($request->filezip_check);
    }
}
