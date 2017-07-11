<?php

namespace App\Http\Controllers\admin;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use App\Order, App\Order_master;
use App\Plan , App\Users, App\Project;
use \Validator, \Redirect, \Session;

class OrderController extends Controller
{
    public function index(Request $request){
        $data['keyword']        = '';
        $data['types']          = '';
        $data['plan_list_val']  = '';
        $data['project_list_val']  = '';
        $data['user_list_val']  = '';
        
        
        if($request->keyword !='' || $request->types != '' || $request->plan_list!= ''){
        
        $data['keyword']            = $request->keyword;
        $data['plan_list_val']      = $request->plan_list;
        $data['types']              = $request->types;
        $data['project_list_val']   = $request->project_list;
        $data['user_list_val']      = $request->user_list;
        
       
        
        
        
        $lists = Order::where(function($query) use ($data) {
                                if($data['types'] != ''){
                                $query->where('order_type',$data['types']);
                                }
                                
                                if($data['keyword'] != ''){
                                $query->where('transaction_id','like','%'.$data['keyword'].'%');
                                $query->orWhere('quantity','like','%'.$data['keyword'].'%');
                                $query->orWhere('price','like','%'.$data['keyword'].'%');
                                }
                                
                                if($data['plan_list_val'] != ''){
                                $query->where('plan_id', $data['plan_list_val']);
                                
                                }
                                
                                if($data['user_list_val'] != ''){
                                $query->where('user_id', $data['user_list_val']);
                                
                                }
                                
                                if($data['project_list_val'] != ''){
                                $query->where('project_id', $data['project_list_val']);
                                
                                }
                            });
                            
                        
       
        $data['lists_result'] = $lists->orderBy('updated_at','desc')->paginate(10);
        }
        else
        {
            $data['lists_result'] = Order::orderBy('updated_at','desc')->paginate(10);
        }
        
         $data['plan_list']      = [''=>'Select Plan'] + Plan::pluck('plan_name','id')->all();
         $data['project_list']   = [''=>'Select Project'] + Project::pluck('name','id')->all();
         $data['user_list']      = [''=>'Select User'] + Users::pluck('business_name','id')->all();
         $data['type']           = [''=>'Select Type','Download'=>'Download','Half Size'=>'Half Size','Full Size'=>'Full Size'];
        return view('admin.order.list',$data);
    }
    
    public function view($id)
    {
        $data['details'] = Order::find($id);
        return view('admin.order.view',$data);
    }
}
