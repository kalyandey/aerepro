<?php

namespace App\Http\Controllers\admin;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;

use App\Role;
use App\Adminusers;
use App\Permission;
use App\Permission_role;
use \Validator, \Redirect, \Session , \Mail;
use App\Http\Helpers;
use DB;

class RolemanagentController extends Controller
{
    public function index(Request $request)
    {
        $data['search'] = '';
        $data['keyword'] = '';
        if($request->keyword !=''){
            $data['search']['keyword'] = $request->keyword;
            $data['keyword'] = $request->keyword;
            
            $data['lists'] = Role::Where('name','like','%'.$request->keyword.'%')
			    ->orWhere('display_name','like','%'.$request->keyword.'%')
			    ->orderBy('id','desc')->paginate(10);
        }
        else{
             $data['lists'] = Role::orderBy('id','desc')->paginate(10);
        }
        
       
        return view('admin.role.role_list',$data);
    }
    
    public function edit($id)
    {
           $data = array();
           $data['details'] = Role::where('id',$id)->first();
          
           return view('admin.role.role_edit', $data);
    }
    
    public function update(Request $request)
    {
            $role                  = Role::find($request->id);
           
            $validator = Validator::make(
                                $request->all(),
                                 [
                                   
                                      'name'   => 'required|unique:roles,name,'.$role->id,
				      'display_name'   => 'required',
                                      'desc'           => 'required',
				      //'status'         => 'required',
                                      
				  ]
                  );
            
            if ($validator->fails())
            {
                $messages = $validator->messages();
                return Redirect::back()->withErrors($validator)->withInput();
            } else {
            
                
            $role->name                 = $request->name;
            $role->display_name         = $request->display_name;
            $role->description          = $request->desc;
            $role->save();
                
                return Redirect::route('admin_role')->with('success','Admin Role is updated successfully'); 

            }
    }
    
    public function create()
    {
        $data = array();
        return view('admin.role.role_create', $data);
    }
    
    public function store(Request $request)
    {
        $validator = Validator::make(
                                $request->all(),
                                 [
                                      'name'   => 'required|unique:roles,name',
				      'display_name'   => 'required',
                                      'desc'   => 'required',
				      //'status'    => 'required',
                                      
				  ]
                  );
       
       if ($validator->fails())
        {
            $messages = $validator->messages();
	    return Redirect::back()->withErrors($validator)->withInput();
        }
        else
        {
            $role = new Role();
            $role->name      = $request->name;
            $role->display_name          = $request->display_name;
            $role->description          = $request->desc;
          
            $role->save();
           
            
            return Redirect::route('admin_role')->with('succmsg','Admin Role is added successfully');
        }
       
    }
    
    public function delete($id)
    {

        DB::table('roles')->where('id', $id)->delete();
        return Redirect::route('admin_role')->with('succmsg','Admin Role is deleted successfully');
    }
    
    public function permission_role_assign()
    {
        $data = array();
	$data['role_lists'] = Role::where('id','<>',1)->orderBy('id','desc')->get();
        $data['permission_lists'] = Permission::orderBy('id','desc')->get();
	return view('admin.role.user_role_assign', $data);
    }
    
    public function permission_user_assign_store(Request $request)
    {
	$data = array();
	//dd($request->permission_type);
	
	$permission_role = new Permission_role();
	$permission_role->truncate();
	if(count($request->permission_type) > 0)
	{
	    foreach($request->permission_type AS $key=>$p_type)
	    {
		//echo $key;
		$permission = $p_type['permission'];
		for($i=0;$i<count($p_type['permission']);$i++)
		{
		    //print_r($permission[$k]);
		    
		    $permissionrole = new Permission_role();
		    $permissionrole->permission_id = $permission[$i];
		    $permissionrole->role_id = $key;
		    $permissionrole->save();
		}
		//echo '<pre>';
		//print_r($p_type);
		//dd($permission);
		
	    }
	}
	return Redirect::back()->with('succmsg','Permission Role is assigned successfully');
	
    }
}
