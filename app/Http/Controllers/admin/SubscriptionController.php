<?php

namespace App\Http\Controllers\admin;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use App\Subscription;
use \Validator,\Redirect;

class SubscriptionController extends Controller
{
    /*
     * Subscription listing
     */
    public function index(){
        $data['lists'] = Subscription::orderBy('id','desc')->get();
        return view('admin.subscription.list',$data);
    }
    
    /*
     * Subscription edit
     */
    public function edit($id){
        $data['lists'] = Subscription::find($id);
        return view('admin.subscription.edit',$data);
    }
    
    /*
     * Subscription update
     */
    public function update(Request $request)
    {   
        $model  = Subscription::find($request->id);
        $validator = Validator::make(
                             $request->all(),
                              [
                                   'subscription_title'   => 'required|unique:subscriptions,subscription_title,'.$model->id,
                                   'quarterly_price'      => 'required',
                                   'yearly_price'         => 'required'
                              ]
               );

         if ($validator->fails())
         {
             $messages = $validator->messages();
             return Redirect::back()->withErrors($validator)->withInput();
         } else {
             $model->subscription_title   = $request->subscription_title;
             $model->quarterly_price      = $request->quarterly_price;
             $model->yearly_price         = $request->yearly_price;
             $model->save();
             return Redirect::route('admin_subscription')->with('success','Subscriptions is updated successfully'); 

         }
    }
}
