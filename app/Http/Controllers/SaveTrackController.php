<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Subscription;
use App\Project;
use Session;
use App\Category,App\Contractor,App\Type, App\County, App\Tracking;

class SaveTrackController extends Controller
{
   public function lists(Request $request){
      
      $data                   = array();
        //Query
        $query               = Tracking::select('trackings.id as track_id','trackings.*','projects.*','projects.project_id as projectid','projects.id as p_id','counties.name as counname','types.name as typename','categories.name as catename')->where('user_id','=', Session::get('USER_DETAILS')->id);
        //dd($query->get());
         
        $data['project_name']       = '';
        $data['s']		    = '';
	$data['stype']		    = '';
        
         $query->join('projects', 'trackings.project_id', '=', 'projects.id');
         $query->leftJoin('counties', 'counties.id', '=', 'projects.county_id');
         $query->leftJoin('types', 'types.id', '=', 'projects.type_id');
         $query->leftJoin('categories', 'categories.id', '=', 'projects.category_id');
            
        if($request->project_name != ''){
            $q->where('projects.name', 'like', '%'.$request->project_name.'%');
            $data['project_name']       = $request->project_name;
        }
        
        if($request->s != '' && $request->stype != ''){
	    $data['s']		= $request->s;
	    $data['stype']	= $request->stype;
            
	    if($data['s'] == 'id'){
		$query->orderBy('projects.project_id',$request->stype);
	    }elseif($data['s'] == 'name'){
		$query->orderBy('projects.name',$request->stype);
	    }elseif($data['s'] == 'county'){
		$query->orderBy('counties.name',$request->stype);
	    }elseif($data['s'] == 'type'){
		$query->orderBy('types.name',$request->stype);
	    }elseif($data['s'] == 'category'){
		$query->orderBy('categories.name',$request->stype);
	    }elseif($data['s'] == 'bid'){
		$query->orderBy('projects.bid_close_date',$request->stype);
	    }
	}else{
	    $data['s']		= 'id';
	    $data['stype']	= 'DESC';
	    $query->orderBy('projects.project_id',$request->stype);
	}
        
        $data['list'] = $query->paginate(25);
        //dd($data);
        return view('front.saved_tracking.list',$data);
   }
   
   public function removeFromSaveTrack(Request $request){
      $data_track          = $request->data_track;
      $track               = Tracking::find($data_track);
      $track->seen_change  = '0';
      $track->save();
      return $track->project_id;
   }
   
   public function markAsUnread(Request $request){
      $data_track          = $request->data_track;
      $track               = Tracking::find($data_track);
      $track->seen_change  = '1';
      $track->save();
      return $track->project_id;
   }
}
