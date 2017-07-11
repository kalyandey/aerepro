<?php

namespace App\Http\Controllers\admin;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Sitesetting;
use \Validator, \Redirect, \Session;
use App\Http\Controllers\Controller;

class SitesettingController extends Controller
{
     public function index(){
        $data['lists'] = Sitesetting::where('status','Active')->paginate(10);
        return view('admin.sitesettings.list',$data);
    }
    
    public function edit($id){
        $data['lists'] = Sitesetting::find($id);
        return view('admin.sitesettings.edit',$data);
    }
    
    public function update(Request $request,$id){
        $validator = Validator::make(
                            $request->all(),
                            ['sitesettings_value'     => 'required']);
        if ($validator->fails())
        {
            $messages = $validator->messages();
            return Redirect::back()->withErrors($validator)->withInput();
        }
        else
        {
            $saveSite                            = Sitesetting::find($id);
            $saveSite->sitesettings_value        = $request->sitesettings_value;
            $saveSite->save();
            return Redirect::route('admin_sitesettings')->with('success','Site Settings Updated Successfully!');
        }
    }
}
