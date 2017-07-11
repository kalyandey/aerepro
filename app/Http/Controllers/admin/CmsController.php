<?php
namespace App\Http\Controllers\admin;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;

use App\Cms;
use \Validator, \Redirect, \Session , \Mail;


class CmsController extends Controller
{
   public function index(Request $request)
    {
        $data['search'] = '';
        $data['keyword'] = '';
        if($request->keyword !=''){
            $data['search']['keyword'] = $request->keyword;
            $data['keyword'] = $request->keyword;
            
            $data['lists'] = Cms::Where('cms_title','like','%'.$request->keyword.'%')
            ->orderBy('id','desc')->paginate(10);
        }
        else{
             $data['lists'] = Cms::orderBy('id','desc')->paginate(10);
        }
        
       
        return view('admin.cms.cms_list',$data);
    }
    public function create()
    {
        $data = array();
        return view('admin.cms.cms_create', $data);
    }
    
    public function store(Request $request)
    {
        $validator = Validator::make(
                            $request->all(),
                            ['cms_title'             => 'required|unique:cms',
                             'cms_desc'              => 'required',
                             'cms_status'            => 'required',
                             'cms_meta_title'        => 'required',
                             'cms_meta_key'          => 'required',
                             'cms_meta_desc'         => 'required']);
        if ($validator->fails())
        {
            $messages = $validator->messages();
            return Redirect::back()->withErrors($validator)->withInput();
        }
        else
        {
            $saveCms                            = new Cms();
            $saveCms->cms_title                 = $request->cms_title;
            $saveCms->cms_slug                  = str_slug($request->cms_title);
            $saveCms->cms_desc                  = $request->cms_desc;
            $saveCms->cms_meta_title            = $request->cms_meta_title;
            $saveCms->cms_meta_key              = $request->cms_meta_key;
            $saveCms->cms_meta_desc             = $request->cms_meta_desc;
            $saveCms->cms_status                = $request->cms_status;
            $saveCms->save();
            return Redirect::route('admin_cms')->with('succmsg','CMS Added Successfully!');
        }
       
    }
    
    public function edit($id){
        $data['lists'] = Cms::find($id);
        return view('admin.cms.edit',$data);
    }
    
    public function update(Request $request,$id){
        $validator = Validator::make(
                            $request->all(),
                            [
                             'cms_desc'           => 'required',
                             'cms_status'           => 'required',
                             'cms_meta_title'        => 'required',
                             'cms_meta_key'          => 'required',
                             'cms_meta_desc'         => 'required']);
        if ($validator->fails())
        {
            $messages = $validator->messages();
            return Redirect::back()->withErrors($validator)->withInput();
        }
        else
        {
            $saveCms                            = Cms::find($id);
            //$saveCms->cms_display_title         = $request->cms_display_title;
            //$saveCms->cms_short_desc            = $request->cms_short_desc;
            $saveCms->cms_desc                  = $request->cms_desc;
            $saveCms->cms_meta_title            = $request->cms_meta_title;
            $saveCms->cms_meta_key              = $request->cms_meta_key;
            $saveCms->cms_meta_desc             = $request->cms_meta_desc;
            $saveCms->cms_status                = $request->cms_status;
            $saveCms->save();
        return Redirect::route('admin_cms')->with('succmsg','CMS Updated Successfully!');
        }
    }
}
