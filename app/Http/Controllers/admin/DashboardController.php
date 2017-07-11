<?php

namespace App\Http\Controllers\admin;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;

use \Session, \Validator,\Redirect, \Cookie, \Hash;
use Illuminate\Cookie\CookieJar;
use Illuminate\Cookie\CookieServiceProvider;
use App\Admin, App\Users, App\Project, App\Contractor;
use \Auth;
use App\Role;

class DashboardController extends Controller
{
    public function index(){
        $data = array();
        $data['admin_user']         = Admin::count();
        $data['customer']           = Users::count();
        $data['project']            = Project::count();
        $data['contractor']         = Contractor::count();
        
        return view('admin.dashboard.index',$data);
    }
    public function profile(){
        $data['profile'] = Admin::find(Session::get('ADMIN_ACCESS_ID'));
        return view('admin.dashboard.profile',$data);
    }
    public function profile_update(Request $request){
       
        $profile_id = $request->profile_id;
        $profile = Admin::find($profile_id);
        $profile->first_name = $request->first_name;
        $profile->last_name  = $request->last_name;
        $profile->save();
        Session::set('ADMIN_ACCESS_NAME',$profile->first_name.' '.$profile->last_name);
        return Redirect::route('admin_profile')->with('success','Profile is updated successfully');
        
    }
    public function change_password(){
        $data['profile'] = Admin::find(Session::get('ADMIN_ACCESS_ID'));
        return view('admin.dashboard.change_password',$data);
    }
    public function change_password_action(Request $request){
        $old_password = $request->old_password;
        $new_password = $request->new_password;
        $confirm_password = $request->confirm_password;
        $profile = Admin::find(Session::get('ADMIN_ACCESS_ID'));
        if(Hash::check($old_password,$profile->password)){
            $profile->password = $new_password;
            $profile->save();
            return Redirect::route('admin_change_password')->with('success','Password is updated successfully');
        }else{
           return Redirect::route('admin_change_password')->with('error','Old Password is wrong');
        }
    }
    public function logout(){
        Session::forget('ADMIN_ACCESS_ID');
        Session::forget('ADMIN_ACCESS_NAME');
        Session::forget('ADMIN_ACCESS_EMAIL');
        return Redirect::route('admin_login')->with('success', 'You have logged out successfully.');
    }
}
