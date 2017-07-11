<?php

namespace App\Http\Controllers\admin;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use App\Category;
use App\Project;
use \Validator,\Redirect;

class CategoryController extends Controller
{
    /*
     * Category listing
     */
    public function index(){
        
        $data['lists'] = Category::orderBy('name','asc')->paginate(10);
        return view('admin.category.list',$data);
    }
    
    /*
     * Category edit
     */
    public function edit($id){
        $data['lists'] = Category::find($id);
        return view('admin.category.edit',$data);
    }
    
    /*
     * Category update
     */
    public function update(Request $request)
    {   
        $model  = Category::find($request->id);
        $validator = Validator::make(
                             $request->all(),
                              [
                                   'category_name'   => 'required|unique:categories,name,'.$model->id,
                              ]
               );

         if ($validator->fails())
         {
             $messages = $validator->messages();
             return Redirect::back()->withErrors($validator)->withInput();
         } else {
             $model->name           = $request->category_name;
             $model->save();
             return Redirect::route('admin_category')->with('success','Category is updated successfully'); 

         }
    }
    
    public function delete($id)
    {
        $is_assigned = Project::where('category_id',$id)->count();
        if($is_assigned == 0)
        {
            $model  = Category::find($id);
            $Category = Category::find($id)->delete();
            return Redirect::route('admin_category')->with('success','Category has been deleted successfully');
        } else {
            return Redirect::route('admin_category')->with('error','This category already has planroom assigned.  Please remove him from projects before deleting.'); 
        }
        
    }
}
