<?php

namespace App\Http\Controllers\admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Private_order, App\Private_order_master,App\Private_company;
use \Validator, \Redirect, \Session;

class PrivateOrderController extends Controller
{
    public function index(Request $request){
        $data['keyword']        = '';
        $data['delivery_type']  = '';
        $data['user']           = '';
        if($request->keyword !='' ||  $request->delivery_type != '' ||  $request->user != ''){
        
        $data['keyword']            = $request->keyword;
        $data['delivery_type']      = $request->delivery_type;
        $data['user']               = $request->user;
        $lists = Private_order_master::where(function($query) use ($data) {
                                if($data['delivery_type'] != ''){
                                    $query->where('delivery_type',$data['delivery_type']);
                                }
                                if($data['keyword'] != ''){
                                    $query->where('transaction_id','like','%'.$data['keyword'].'%');
                                    $query->orWhere('order_id','like','%'.$data['keyword'].'%');
                                }
                                if($data['user'] != ''){
                                    $query->where('user_id','like','%'.$data['user'].'%');
                                }
                            });
        $data['lists_result'] = $lists->orderBy('updated_at','desc')->paginate(10);
        }
        else
        {
            $data['lists_result'] = Private_order_master::orderBy('created_at','desc')->paginate(10);
        }
        $data['users']      = [''=>'Select User/Company'] + Private_company::select('id', \DB::raw('CONCAT(first_name, " ", last_name) AS full_name'))->pluck('full_name','id')->all();
        return view('admin.private.order.list',$data);
    }
    
    public function view($id)
    {
        $data['details'] = Private_order_master::find($id);
        return view('admin.private.order.view',$data);
    }
}
