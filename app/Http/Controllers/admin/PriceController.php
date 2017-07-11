<?php

namespace App\Http\Controllers\admin;
use Illuminate\Http\Request;
use App\Http\Requests;
use App\Http\Controllers\Controller;
use App\Price;
use \Validator,\Redirect;

class PriceController extends Controller
{
    /*
     * Price listing
     */
    public function index(Request $request){
       
        $data['price_range']       = '';
        if($request->price_range !=''){
            $data['price_range']   = $request->price_range;
        }
        $data['price_list']    = Price::all();
        $data['lists'] = Price::where(function($query) use ($data) {
                                if($data['price_range'] != ''){
                                    $query->where('prices.id','=',$data['price_range']);
                                }
                            })   
                            ->orderBy('id','desc')->paginate(10);
         return view('admin.price.list',$data);
    }
    
    /*
     * Price add
     */
    public function create(){
        $data = array();
        return view('admin.price.create',$data);
    }
    
    /*
     * Price store
     */
    public function store(Request $request){
        $validator = Validator::make(
                             $request->all(),
                              [   'from_range'   => 'required',
                                  'to_range'   => 'required',
                                  'full_size_price'   => 'required',
                                  'half_size_price'   => 'required',
                                  'download_price'   => 'required',
                                  //'full_set_price'   => 'required',
                              ]
               );

         if ($validator->fails())
         {
             $messages = $validator->messages();
             return Redirect::back()->withErrors($validator)->withInput();
         } else {
             $model                     = new Price;
             $model->from_range         = $request->from_range;
             $model->to_range           = $request->to_range;
             $model->full_size_price    = $request->full_size_price;
             $model->half_size_price    = $request->half_size_price;
             $model->download_price     = $request->download_price;
             $model->full_set_price     = $request->full_size_price + $request->half_size_price + $request->download_price;
             $model->created_at         = date('Y-m-d h:i:s');
             $model->save();
             return Redirect::route('admin_price')->with('success','Price is created successfully'); 

         }
    }
    
    /*
     * Price edit
     */
    public function edit($id){
       
        $data['lists'] = Price::find($id);
        return view('admin.price.edit',$data);
    }
    
    /*
     * Price update
     */
    public function update(Request $request)
    {   
        $model  = Price::find($request->id);
        $validator = Validator::make(
                             $request->all(),
                              [    
                                  'from_range'   => 'required',
                                  'to_range'   => 'required',
                                  'full_size_price'   => 'required',
                                  'half_size_price'   => 'required',
                                  'download_price'   => 'required',
                                  //'full_set_price'   => 'required',
                              ]
               );

         if ($validator->fails())
         {
             $messages = $validator->messages();
             return Redirect::back()->withErrors($validator)->withInput();
         } else {
             $model->from_range         = $request->from_range;
             $model->to_range           = $request->to_range;
             $model->full_size_price    = $request->full_size_price;
             $model->half_size_price    = $request->half_size_price;
             $model->download_price     = $request->download_price;
             $model->full_set_price     = $request->full_size_price + $request->half_size_price + $request->download_price;
             $model->save();
             return Redirect::route('admin_price')->with('success','Price is updated successfully'); 

         }
    }
}
