@extends('front.app')
@section('content')
  <div class="details_view"></div>
  <div class="details_loader"></div>
        <div class="container">

      <div class="deshboard breport clear save-list-page">

	<h3><strong>Saved </strong>Tracking list</h3>

	<a href="{{URL::route('dashboard')}}" class="btn-db">Dashboard</a>
	  
	@if(count(\Cart::content()) > 0)
	  
	<a href="{{URL::route('my_cart')}}" class="cart cart-button"> {{ count(\Cart::content())}} Cart item</a>
	  
	@endif

	<br />

	<div class="form-report form-report2 clear">

	  {{Form::open()}}

	    <div class="input-box half">

	      <div class="clear inner_field">

		<label>Project Name :</label>

		{{Form::text('project_name',$project_name,['class'=>'input full'])}}

	      </div>

	      

	      <div class="clear inner_field button_set">

		<input type="submit" name="submit" value="Search Reports"/>
		
		<a href="{{URL::route('saved_tracking_list')}}" class="reset">Reset Now</a>

	      </div>

	    </div>

	{{Form::close()}}	  

	</div>

	<div class="report-table">

	  <div class="table_top clear">

	    <span class="number">{{$list->total() }} Jobs</span>

	    <div class="pagination">
            
                @include('front.pagination.custom', ['paginator' => $list->appends(['project_name' => $project_name,'s'=>$s,'stype'=>$stype])])

	    </div>

	  </div>

	  {!! Form::open(array('route'=>array('project-print'),'class'=>'table_chkbox2')) !!} 

	  <div class="table_bot clear">

	   <table id="no-more-tables" class="res-table2 savetrack_list" >

		<thead>

		  <tr>		

		    <th class="numeric"><input type="checkbox" id="select_all"></th>

		    <th class="numeric">ID
		    @if($s == 'id')
			@if($stype == 'DESC')
			      <a href="{{URL::route('saved_tracking_list').'?s=id&stype=ASC'}}" class="top-arrow"><img src="{{asset('images/arrow5.png')}}"></a>
			@endif
			@if($stype == 'ASC')
			      <a href="{{URL::route('saved_tracking_list').'?s=id&stype=DESC'}}" class="down-arrow"><img src="{{asset('images/arrow4.png')}}"></a>
			@endif
		     @else
			<a href="{{URL::route('saved_tracking_list').'?s=id&stype=ASC'}}" class="top-arrow"><img src="{{asset('images/arrow1.png')}}"></a>
			<a href="{{URL::route('saved_tracking_list').'?s=id&stype=DESC'}}" class="down-arrow"><img src="{{asset('images/arrow3.png')}}"></a>
		     @endif
		    </th>

		    <th class="numeric">Project Name
		    @if($s == 'name')
			@if($stype == 'DESC')
			      <a href="{{URL::route('saved_tracking_list').'?s=name&stype=ASC'}}" class="top-arrow"><img src="{{asset('images/arrow5.png')}}"></a>
			@endif
			@if($stype == 'ASC')
			      <a href="{{URL::route('saved_tracking_list').'?s=name&stype=DESC'}}" class="down-arrow"><img src="{{asset('images/arrow4.png')}}"></a>
			@endif
		     @else
			<a href="{{URL::route('saved_tracking_list').'?s=name&stype=ASC'}}" class="top-arrow"><img src="{{asset('images/arrow1.png')}}"></a>
			<a href="{{URL::route('saved_tracking_list').'?s=name&stype=DESC'}}"  class="down-arrow"><img src="{{asset('images/arrow3.png')}}"></a>
		     @endif
		    </th>		

		    <th class="numeric">County
		    @if($s == 'county')
			@if($stype == 'DESC')
			      <a href="{{URL::route('saved_tracking_list').'?s=county&stype=ASC'}}"><img src="{{asset('images/arrow5.png')}}"></a>
			@endif
			@if($stype == 'ASC')
			      <a href="{{URL::route('saved_tracking_list').'?s=county&stype=DESC'}}"><img src="{{asset('images/arrow4.png')}}"></a>
			@endif
		     @else
			<a href="{{URL::route('saved_tracking_list').'?s=county&stype=ASC'}}" class="top-arrow"><img src="{{asset('images/arrow1.png')}}"></a>
			<a href="{{URL::route('saved_tracking_list').'?s=county&stype=DESC'}}" class="down-arrow"><img src="{{asset('images/arrow3.png')}}"></a>
		     @endif
		     </th>

		    <th class="numeric">Type
		    @if($s == 'type')
			@if($stype == 'DESC')
			      <a href="{{URL::route('saved_tracking_list').'?s=type&stype=ASC'}}"><img src="{{asset('images/arrow5.png')}}"></a>
			@endif
			@if($stype == 'ASC')
			      <a href="{{URL::route('saved_tracking_list').'?s=type&stype=DESC'}}"><img src="{{asset('images/arrow4.png')}}"></a>
			@endif
		     @else
			<a href="{{URL::route('saved_tracking_list').'?s=type&stype=ASC'}}" class="top-arrow"><img src="{{asset('images/arrow1.png')}}"></a>
			<a href="{{URL::route('saved_tracking_list').'?s=type&stype=DESC'}}" class="down-arrow"><img src="{{asset('images/arrow3.png')}}"></a>
		     @endif
		     </th>

		    <th class="numeric">Category
		    @if($s == 'category')
			@if($stype == 'DESC')
			      <a href="{{URL::route('saved_tracking_list').'?s=category&stype=ASC'}}"><img src="{{asset('images/arrow5.png')}}"></a>
			@endif
			@if($stype == 'ASC')
			      <a href="{{URL::route('saved_tracking_list').'?s=category&stype=DESC'}}"><img src="{{asset('images/arrow4.png')}}"></a>
			@endif
		     @else
			<a href="{{URL::route('saved_tracking_list').'?s=category&stype=ASC'}}" class="top-arrow"><img src="{{asset('images/arrow1.png')}}"></a>
			<a href="{{URL::route('saved_tracking_list').'?s=category&stype=DESC'}}" class="down-arrow"><img src="{{asset('images/arrow3.png')}}"></a>
		     @endif
		     </th>		

		    <th class="numeric">Bid Date
		    @if($s == 'bid')
			@if($stype == 'DESC')
			      <a href="{{URL::route('saved_tracking_list').'?s=bid&stype=ASC'}}"><img src="{{asset('images/arrow5.png')}}"></a>
			@endif
			@if($stype == 'ASC')
			      <a href="{{URL::route('saved_tracking_list').'?s=bid&stype=DESC'}}"><img src="{{asset('images/arrow4.png')}}"></a>
			@endif
		     @else
			<a href="{{URL::route('saved_tracking_list').'?s=bid&stype=ASC'}}" class="top-arrow"><img src="{{asset('images/arrow1.png')}}"></a>
			<a href="{{URL::route('saved_tracking_list').'?s=bid&stype=DESC'}}" class="down-arrow"><img src="{{asset('images/arrow3.png')}}"></a>
		     @endif
		    </th>
		    <th class="numeric"></th>
		    
		    <th class="numeric">Track</th>
		  
		  </tr>

		</thead>

		<tbody>
              
                @if(count($list) > 0)
                    
                    @foreach($list as $l)
		     
                    <tr data-project-id="{{$l->p_id}}" @if($l->seen_change == '1') class="seen-track" @endif >
  
                      <td data-title=""><input type="checkbox" name="project[]" class="checkbox project_check" value="{{$l->p_id}}"></td>
  
                        <td data-title="ID">{!! $l->projectid !!}</td>
  
                      <td data-title="Project Name" class="numeric details_show changes_seen" data-page="saveTrack" data-track-id = "{{$l->track_id}}" data-project="{{$l->p_id}}">{!! $l->name !!}
                      </td>	
  
                      <td data-title="County">{!! $l->counname !!}</td>
  
                      <td data-title="Type">{!! ($l->typename != '')?$l->typename:'<span style="color:red">Not Available</span>' !!}</td>
  
                      <td data-title="Category" class="numeric">{!! $l->catename !!}</td>
                       
                       @php
                       $bid_close_date = explode('-',$l->bid_close_date);
                       $bid_close_date  = $bid_close_date[1].'/'.$bid_close_date[2].'/'.$bid_close_date[0];
                       @endphp
  
                      <td data-title="Bid Date">{!! $bid_close_date !!}<!--<div class="no_start">*<span>This is a mandatory prebid date and time</span></div>--></td>
                      <td data-title="Mark as Unread">@if($l->seen_change == '1') <a href="javascript:void(0);" class="mark_unread" data-track-id="{{$l->track_id}}" data-project="{{$l->p_id}}" id="mark_unread_{{$l->p_id}}" style="display:none;">Mark as Unread</a> @else <a href="javascript:void(0);" class="mark_unread" data-track-id="{{$l->track_id}}" data-project="{{$l->p_id}}" id="mark_unread_{{$l->p_id}}">Mark as Unread</a> @endif</td>
                    </td>
                       <td data-title="Tracking List">
		      
		      @if($l->where('user_id',Session::get('USER_DETAILS')->id)->count()>0)
                      <span class="tracking" data-project="{{$l->id}}" data-saved="active">
                      <img src="{{asset('images/star2.png')}}" alt="no img">
                      </span>
		      @else
                      <span class="tracking" data-project="{{$l->id}}" data-saved="">
		      <img src="{{asset('images/star1.png')}}" alt="no img">
                      </span>
		      @endif
		     
                     </td>
                    @endforeach
                    
		  @else
		    <tr><td colspan="8" align="center"> ----- No Record Found ----</td></tr>
                @endif

              </table>
              <div class="btn-hold">

                    <a class="btn-report btn-psr" href="javascript:void(0);" id="print_jobs" onclick="$(this).closest('form').submit();" style="display:none;">Print Selected Jobs</a>
             </div>
	  </div>
          {!! Form::close() !!}   

	</div>

	  

	</div>
         

      </div>
@endsection