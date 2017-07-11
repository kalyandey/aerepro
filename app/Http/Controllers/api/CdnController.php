<?php

namespace App\Http\Controllers\api;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use MaxCDN;
use FTP;
class CdnController extends Controller
{
    public function index(){
        $api = new MaxCDN("wj6sbbg5kqo","810404acb4861823a0c4c817424f6067057eb7a0b","9826ddd49ec3d9b648fce26d2b68e4f9");
        //echo  $api->get('/zones/pull.json/count');
        //$params = array("name"=>"specs","password"=>"aerepro_specs");
        //$api->post('/zones/push.json', $params);
        //echo $api->get('/zones/push.json');
        $ftp_server         = "ftp.specs.wj6sbbg5kqo.netdna-cdn.com";
        $ftp_user_name      = "specs.wj6sbbg5kqo";
        $ftp_user_pass      = "aerepro_specs";
        $file               = public_path("images/brand4.jpg");//tobe uploaded
        $remote_file        = "public_html/brand4.jpg";
        
        // set up basic connection
        $conn_id = ftp_connect($ftp_server);
        
        // login with username and password
        $login_result = ftp_login($conn_id, $ftp_user_name, $ftp_user_pass);
        
        // upload a file
        if (ftp_put($conn_id, $remote_file, $file, FTP_ASCII)) {
           echo "successfully uploaded $file\n";
           exit;
        } else {
           echo "There was a problem while uploading $file\n";
           exit;
        }
        // close the connection
        ftp_close($conn_id);
        //FTP::connection('connection1')->getDirListing();
        //FTP::connection('connection1')->uploadFile(public_path('images/add.jpg'), 'public_html/', '777');
    }
    
    public function fileupload(){
                $server = 'ftp.specs.wj6sbbg5kqo.netdna-cdn.com';
                $port = '22';
                $username = 'specs.wj6sbbg5kqo';
                $passwd = 'aerepro_specs';
                $connection = ssh2_connect($server, $port);
                if (ssh2_auth_password($connection, $username, $passwd)) {
                $sftp = ssh2_sftp($connection);
                echo "Connection status: OK. Uploading file!"."n";
                $file = public_path("images/img5.jpg");
                $contents = file_get_contents($file);
                file_put_contents("ssh2.sftp://{$sftp}/public_html/img5.jpg", $contents);
                } else {
                echo "Nope! Can not connect to server!"."n";
                }
    }
}
