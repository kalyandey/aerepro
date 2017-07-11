<?php

namespace App\Http\Controllers\admin;
use Illuminate\Http\Request;
use App\Http\Requests;
use App\Http\Controllers\Controller;
use App\Trade;
use \Validator,\Redirect;

class TradeController extends Controller
{
    /*
     * Trade listing
     */
    public function index(Request $request){
        
        $data['keyword']       = '';
        if($request->keyword !=''){
            $data['keyword']     = $request->keyword;
        }
        $data['lists'] = Trade::where(function($query) use ($data) {
                                if($data['keyword'] != ''){
                                    $query->where('trades.trade_title','like','%'.$data['keyword'].'%');
                                }
                            })   
                            ->orderBy('trade_title','asc')->paginate(10);
         return view('admin.trade.list',$data);
    }
    /*
     * Trade add
     */
    public function create(){
        $data = array();
        return view('admin.trade.create',$data);
    }
    
    /*
     * Trade store
     */
    public function store(Request $request){
        $validator = Validator::make(
                             $request->all(),
                              [   'trade_title'   => 'required|unique:trades,trade_title',
                              ]
               );

         if ($validator->fails())
         {
             $messages = $validator->messages();
             return Redirect::back()->withErrors($validator)->withInput();
         } else {
             $model                     = new Trade;
             $model->trade_title        = $request->trade_title;
             $model->created_at         = date('Y-m-d h:i:s');
             $model->save();
             return Redirect::route('admin_trade')->with('success','Trade is created successfully'); 

         }
    }
    
    /*
     * Trade edit
     */
    public function edit($id){
       
        $data['lists'] = Trade::find($id);
        return view('admin.trade.edit',$data);
    }
    
    /*
     * Trade update
     */
    public function update(Request $request)
    {   
        $model  = Trade::find($request->id);
        $validator = Validator::make(
                             $request->all(),
                              [    
                                  'trade_title'   => 'required|unique:trades,trade_title,'.$model->id,
                              ]
               );

         if ($validator->fails())
         {
             $messages = $validator->messages();
             return Redirect::back()->withErrors($validator)->withInput();
         } else {
             $model->trade_title        = $request->trade_title;
             $model->trade_status       = $request->trade_status;
             $model->save();
             return Redirect::route('admin_trade')->with('success','Trade is updated successfully'); 

         }
    }
}
