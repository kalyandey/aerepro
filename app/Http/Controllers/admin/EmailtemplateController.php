<?php

namespace App\Http\Controllers\admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Email_templete;
use Redirect, Validator;

class EmailtemplateController extends Controller
{
    public function index(){
        $data['lists'] = Email_templete::where('status','Active')->paginate(10);
        return view('admin.emailtemplate.list',$data);
    }
    
    public function edit($id){
        $data['lists'] = Email_templete::find($id);
        return view('admin.emailtemplate.edit',$data);
    }
    
    public function update(Request $request,$id){
        $validator = Validator::make(
                            $request->all(),
                            ['email_subject'     => 'required',
                             'email_content'     => 'required']);
        if ($validator->fails())
        {
            $messages = $validator->messages();
            return Redirect::back()->withErrors($validator)->withInput();
        }
        else
        {
            $saveEmail                            = Email_templete::find($id);
            $saveEmail->email_subject             = $request->email_subject;
            $saveEmail->email_content             = $request->email_content;
            $saveEmail->save();
            return Redirect::route('admin_emailtemplate')->with('success','Email templete Updated Successfully!');
        }
    }
}
