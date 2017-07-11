<?php

namespace App\Http\Controllers;

use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Routing\Controller as BaseController;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use App\Private_company,App\Private_planroom_assigns;
use \Session;
use phpseclib\Net\SFTP;
class Controller extends BaseController
{
    use AuthorizesRequests, DispatchesJobs, ValidatesRequests;
    
    public function fileupload($file , $path , $new_name , $removeFilePath = ''){
        $server         = 'ftp.specs.wj6sbbg5kqo.netdna-cdn.com';
        $port           = '22';
        $username       = 'specs.wj6sbbg5kqo';
        $passwd         = 'aerepro_specs';
        $sftp = new SFTP('ftp.specs.wj6sbbg5kqo.netdna-cdn.com');
        if (!$sftp->login($username, $passwd)) {
        exit('Login Failed');
        }

        $contents = file_get_contents($file);
        // puts a three-byte file named filename.remote on the SFTP server
        //$sftp->put('filename.remote', 'xxx');
        // puts an x-byte file named filename.remote on the SFTP server,
        // where x is the size of filename.local
        $sftp->put("public_html/".$path.'/'.$new_name, $file, NET_SFTP_LOCAL_FILE);
        return true;
        
        /*$connection     = ssh2_connect($server, $port);
        if (ssh2_auth_password($connection, $username, $passwd)) {
            $sftp = ssh2_sftp($connection);
            
            if($removeFilePath != ''){
                ssh2_sftp_unlink($sftp, '/public_html/'.$removeFilePath);
            }
            $contents = file_get_contents($file);
            file_put_contents("ssh2.sftp://{$sftp}/public_html/".$path.'/'.$new_name, $contents);
            return true;
        } else {
            echo "Nope! Can not connect to server!"."n";
        }*/
    }
    
    public function removeFile( $path ){
        $server         = 'ftp.specs.wj6sbbg5kqo.netdna-cdn.com';
        $port           = '22';
        $username       = 'specs.wj6sbbg5kqo';
        $passwd         = 'aerepro_specs';
        $connection     = ssh2_connect($server, $port);
        if (ssh2_auth_password($connection, $username, $passwd)) {
            
            $sftp = ssh2_sftp($connection);
            ssh2_sftp_unlink($sftp, '/public_html/'.$path);
            return true;
        } else {
            echo "Nope! Can not connect to server!"."n";
        }
    }
    
    public function companyExistCheck($company_slug){
        $company = Private_company::where('company_slug',$company_slug)->first();
        return $company;
    }
}
