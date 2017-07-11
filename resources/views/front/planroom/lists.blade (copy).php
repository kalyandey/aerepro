@extends('front.app')
@section('content')
<div class="details_view"></div>
<div class="details_loader"></div>
<div class="container">

      <div class="deshboard breport clear list-page">

	<h3><strong>Project </strong>list</h3>

	<a href="{{URL::route('dashboard')}}" class="btn-db">Dashboard</a>	
	
	<div id="cartView"></div>
	  
	<br />

	<div class="form-report form-report2 clear">

	  {{Form::open()}}

	    <div class="input-box half">

	      <div class="clear inner_field">

		<label>Project Name :</label>

		{{Form::text('project_name',$project_name,['class'=>'input full'])}}

	      </div>

	      <div class="clear inner_field">

		<label>Project No. :</label>

		{{Form::text('project_no',$project_no,['class'=>'input full'])}}

	      </div>

	      <div class="clear inner_field">

		<label>County :</label>

		{{Form::select('county',$county,$county_id,['class'=>'input full'])}}

	      </div>

	      <div class="clear inner_field">

		<label>Category :</label>
		  
		{{Form::select('category',$category,$category_id,['class'=>'input full'])}}
		
	      </div>

	      <div class="clear inner_field">

		<label>Type :</label>

		{{Form::select('type',$type,$type_id,['class'=>'input full'])}}

	      </div>

	      <div class="clear inner_field">

		<label>General Contractor :</label>
		
		{{Form::text('contractor',$contractor,['class'=>'input full','id' => 'autocompleteContractor'])}}
		{{Form::hidden('contractor_id',$contractor_id,['id' => 'contractor_id'])}}
	      </div>
		
		<div class="clear inner_field">

		<label>Project Principal Company :</label>

		{{Form::select('company',$companies,$company,['class'=>'input full'])}}

	      </div>

	      <div class="clear inner_field button_set">

		<input type="submit" name="submit" value="Search Jobs"/>
		
		<a href="{{URL::route('planroom_list')}}" class="reset">Reset Now</a>

	      </div>

	    </div>

	    <div class="input-box half img11"><img src="{{asset('images/img11.jpg')}}" alt="no img"></div>

	  {{Form::close()}}	  

	</div>

	

	<div class="report-table">

	  

	  <div class="table_top clear">

	    <span class="number">{{$list->total() }} Jobs</span>

	    <div class="pagination">
            
                @include('front.pagination.custom', ['paginator' => $list->appends(['project_name' => $project_name,'project_no'=>$project_no,'county'=>$county_id,'category'=>$category_id,'contractor_id'=>$contractor_id,'type'=>$type_id,'company'=>$company,'s'=>$s,'stype'=>$stype,'change_view'=>$pegination])])

	    </div>

	  </div>

	 {!! Form::open(array('route'=>array('project-print'),'class'=>'table_chkbox2')) !!} 
	  
	  
	  <div class="table_bot clear">

	    <table id="no-more-tables" class="res-table2 planroom_list" >
	    

		<thead>

		  <tr>		

		    <th class="numeric"><input type="checkbox" id="select_all"></th>

		    <th class="numeric">
		    ID
		    @if($s == 'id')
			@if($stype == 'DESC')
			      <a href="{{URL::route('planroom_list').'?s=id&stype=ASC'}}" class="top-arrow"><img src="{{asset('images/arrow5.png')}}"></a>
			@endif
			@if($stype == 'ASC')
			      <a href="{{URL::route('planroom_list').'?s=id&stype=DESC'}}" class="down-arrow"><img src="{{asset('images/arrow4.png')}}"></a>
			@endif
		     @else
			<a href="{{URL::route('planroom_list').'?s=id&stype=ASC'}}" class="top-arrow"><img src="{{asset('images/arrow1.png')}}"></a>
			<a href="{{URL::route('planroom_list').'?s=id&stype=DESC'}}" class="down-arrow"><img src="{{asset('images/arrow3.png')}}"></a>
		     @endif
		    </th>

		    <th class="numeric">
		    Project Name
		     @if($s == 'name')
			@if($stype == 'DESC')
			      <a href="{{URL::route('planroom_list').'?s=name&stype=ASC'}}" class="top-arrow"><img src="{{asset('images/arrow5.png')}}"></a>
			@endif
			@if($stype == 'ASC')
			      <a href="{{URL::route('planroom_list').'?s=name&stype=DESC'}}" class="down-arrow"><img src="{{asset('images/arrow4.png')}}"></a>
			@endif
		     @else
			<a href="{{URL::route('planroom_list').'?s=name&stype=ASC'}}" class="top-arrow"><img src="{{asset('images/arrow1.png')}}"></a>
			<a href="{{URL::route('planroom_list').'?s=name&stype=DESC'}}"  class="down-arrow"><img src="{{asset('images/arrow3.png')}}"></a>
		     @endif
		    </th>		

		    <th class="numeric">
		    County
		    @if($s == 'county')
			@if($stype == 'DESC')
			      <a href="{{URL::route('planroom_list').'?s=county&stype=ASC'}}"><img src="{{asset('images/arrow5.png')}}"></a>
			@endif
			@if($stype == 'ASC')
			      <a href="{{URL::route('planroom_list').'?s=county&stype=DESC'}}"><img src="{{asset('images/arrow4.png')}}"></a>
			@endif
		     @else
			<a href="{{URL::route('planroom_list').'?s=county&stype=ASC'}}" class="top-arrow"><img src="{{asset('images/arrow1.png')}}"></a>
			<a href="{{URL::route('planroom_list').'?s=county&stype=DESC'}}" class="down-arrow"><img src="{{asset('images/arrow3.png')}}"></a>
		     @endif
		    </th>

		    <th class="numeric">
		    Type
		    @if($s == 'type')
			@if($stype == 'DESC')
			      <a href="{{URL::route('planroom_list').'?s=type&stype=ASC'}}"><img src="{{asset('images/arrow5.png')}}"></a>
			@endif
			@if($stype == 'ASC')
			      <a href="{{URL::route('planroom_list').'?s=type&stype=DESC'}}"><img src="{{asset('images/arrow4.png')}}"></a>
			@endif
		     @else
			<a href="{{URL::route('planroom_list').'?s=type&stype=ASC'}}" class="top-arrow"><img src="{{asset('images/arrow1.png')}}"></a>
			<a href="{{URL::route('planroom_list').'?s=type&stype=DESC'}}" class="down-arrow"><img src="{{asset('images/arrow3.png')}}"></a>
		     @endif
		     </th>

		    <th class="numeric">
		    Category
		    @if($s == 'category')
			@if($stype == 'DESC')
			      <a href="{{URL::route('planroom_list').'?s=category&stype=ASC'}}"><img src="{{asset('images/arrow5.png')}}"></a>
			@endif
			@if($stype == 'ASC')
			      <a href="{{URL::route('planroom_list').'?s=category&stype=DESC'}}"><img src="{{asset('images/arrow4.png')}}"></a>
			@endif
		     @else
			<a href="{{URL::route('planroom_list').'?s=category&stype=ASC'}}" class="top-arrow"><img src="{{asset('images/arrow1.png')}}"></a>
			<a href="{{URL::route('planroom_list').'?s=category&stype=DESC'}}" class="down-arrow"><img src="{{asset('images/arrow3.png')}}"></a>
		     @endif
		    </th>		

		    <th class="numeric">
		    Bid Date
		    @if($s == 'bid')
			@if($stype == 'DESC')
			      <a href="{{URL::route('planroom_list').'?s=bid&stype=ASC'}}"><img src="{{asset('images/arrow5.png')}}"></a>
			@endif
			@if($stype == 'ASC')
			      <a href="{{URL::route('planroom_list').'?s=bid&stype=DESC'}}"><img src="{{asset('images/arrow4.png')}}"></a>
			@endif
		     @else
			<a href="{{URL::route('planroom_list').'?s=bid&stype=ASC'}}" class="top-arrow"><img src="{{asset('images/arrow1.png')}}"></a>
			<a href="{{URL::route('planroom_list').'?s=bid&stype=DESC'}}" class="down-arrow"><img src="{{asset('images/arrow3.png')}}"></a>
		     @endif
		    </th>

		    <th class="numeric">Tracking List</th>	

		  </tr>

		</thead>

		<tbody>
                @if(count($list) > 0)
                    
                    @foreach($list as $l)
                        
                    <tr>
  
                      <td data-title=""><input type="checkbox" name="project[]" class="checkbox project_check" value="{{$l->id}}"></td>
  
                      <td data-title="ID">{!! $l->project_id !!} </td>
  
                      <td data-title="Project Name" class="numeric details_show" data-page='' data-proid="{{$l->project_id}}" data-project="{{$l->id}}">{!! $l->projectName !!}
			@if($l->additional_comments != '')
                        <div><span class="tltp"> {!! $l->additional_comments !!} </span></div>
			@endif
  
                      </td>	
  
                      <td data-title="County">{!! (count($l->county)>0)?$l->county->name:'N/A' !!}</td>
  
                      <td data-title="Type">{!! (count($l->type)>0)?$l->type->name:'<span style="color:red">-Not Available-</span>' !!}</td>
  
                      <td data-title="Category" class="numeric">{!! (count($l->category)>0)?$l->category->name:'N/A' !!}</td>
			
                       @if($l->pre_bid_meeting_date != '' && $l->pre_bid_meeting_date != '0000-00-00')
		       @php
                       $bid_close_date = explode('-',$l->pre_bid_meeting_date);
                       $bid_close_date  = $bid_close_date[1].'/'.$bid_close_date[2].'/'.$bid_close_date[0];
                       @endphp
		       @else  	
                       @php
                       $bid_close_date = explode('-',$l->bid_close_date);
                       $bid_close_date  = $bid_close_date[1].'/'.$bid_close_date[2].'/'.$bid_close_date[0];
                       @endphp
		       @endif

                      <td data-title="Bid Date" class="bidCloseDate">
		      <em>{!! $bid_close_date !!}</em>
		      @if($l->mandatory_pre_bidding == 'Yes')
		      <div class="no_start">*<span>Mandatory</span></div>
		      @endif
		      </td>
                      <td data-title="Tracking List">
		      
		      @if($l->tracking()->where('user_id',Session::get('USER_DETAILS')->id)->count()>0)
                      <span class="tracking" data-project="{{$l->id}}" data-saved="active">
                      <img src="{{asset('images/star2.png')}}" alt="no img">
                      </span>
		      @else
                      <span class="tracking" data-project="{{$l->id}}" data-saved="">
		      <img src="{{asset('images/star1.png')}}" alt="no img">
                      </span>
		      @endif
		     
                     </td>	
  
                    </tr>
                        
                    @endforeach
                    
		  @else
		    <tr><td colspan="8" align="center"> ----- No Record Found ----</td></tr>
                @endif

              </table>

	    
                <div class="btn-hold">
                    <a class="btn-report btn-psr" href="javascript:void(0);" id="print_jobs" onclick="$(this).closest('form').submit();" style="display:none;">Print Selected Jobs</a>
                     <!--<a href="#" class="btn-report btn-pbp">Print Bidding Projects</a>-->
                </div>
	  </div>
         {!! Form::close() !!}

	</div>

	  <div class="btn-hold">

	    <div class="bt-slct-hld">

                <label>Change View</label>
                {{Form::open(['id' => 'view_pegi'])}}
                {{Form::select('change_view',array('25'=>'25','50' => '50','75' => '75','100' => '100'),$pegination,['class' => 'btn-report bt-slct' , 'id'=>'change_view'])}}
                {{Form::close()}}

	    </div>

	    </div>

	</div>

</div>
  <!--<div id="cartView"></div> -->
      
@endsection