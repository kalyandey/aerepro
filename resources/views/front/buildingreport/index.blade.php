@extends('front.app')
@section('content')
<div class="details_view"></div>
<div class="details_loader"></div>
    <div class="container">
      <div class="deshboard breport clear">
	<h3><strong>Planroom</strong> Building Reports</h3>
	<strong class="welcome">Welcome <span>{{Session::get('USER_DETAILS')->first_name.' '.Session::get('USER_DETAILS')->last_name}}</span></strong>	
	<!--<a href="#" class="cart">Cart item</a>-->
	<a href="{{URL::route('dashboard')}}" class="btn-db">Dashboard</a>
	    
        @if(count(\Cart::content()) > 0)
	<a href="{{URL::route('my_cart')}}" class="cart cart-button"> {{ count(\Cart::content())}} Cart item</a>
	@endif
	<br />
	<div class="form-report clear">
	    {!! Form::open() !!}
	    <div class="input-box half">
	      <label>County :</label>
              {!! Form::select('county',$counties,$county) !!}
	    </div>
	    <div class="input-box half">
	      <label>Jurisdiction :</label>
              {!! Form::select('jurisdiction',$jurisdictions,$jurisdiction) !!}
	    </div>
	    <!--<div class="input-box half">
	      <label>Permit Type :</label>
	      {!! Form::select('permittype',$permit_type,$permittype) !!}
	    </div>-->
	    <div class="input-box half">
                <label>General Contractor :</label>
                {!! Form::text('autocompleteContractor',$autocompleteContractor,['class'=>'input full','id' => 'autocompleteContractor'])!!}
                {!! Form::hidden('contractor',$contractor,['id' => 'contractor_id']) !!}
                
	    </div>
	    <div class="input-box half">
	      <label>Issue Date :</label>
              {!! Form::text('issue_start_date',$issue_start_date,array('class' => 'input half calender datepicker')) !!}
	      <span class="to">to</span>
	      {!! Form::text('issue_end_date',$issue_end_date,array('class' => 'input half calender datepicker')) !!}
	    </div>
	    <div class="input-box half">
	      <label>Posting Date :</label>
	      {!! Form::text('posting_start_date',$posting_start_date,array('class' => 'input half calender datepicker')) !!}	
	      <span class="to">to</span>
	      {!! Form::text('posting_end_date',$posting_end_date,array('class' => 'input half calender datepicker')) !!}
	    </div>

	    <div class="input-box half">
	      <label>Full Text Search :</label>
              {!! Form::text('text_search',$text_search,array('class' => 'input full')) !!}		  
	      <!--<input type="text" class="input full" />-->
	    </div>
	    <div class="input-box half">
	    {!! Form::submit('Search Reports',array('class' => 'btn-srrp')) !!}
	    </div>
	  {!! Form::close() !!}  
	</div>
	<div class="report-table">
	  <!--<img src="images/report.png" alt="" />-->
	  
	  <div class="table_top clear">
	    <span class="number">{{$list->total() }} reports</span>
	    <div class="pagination">
	      @include('front.pagination.custom', ['paginator' => $list->appends(['jurisdiction' => $jurisdiction,'contractor'=>$contractor,'county'=>$county,'issue_start_date'=>$issue_start_date,'issue_end_date'=>$issue_end_date,'posting_start_date'=>$posting_start_date,'posting_end_date'=>$posting_end_date,'text_search'=>$text_search,'s'=>$s,'stype'=>$stype])])
	    </div>
	  </div>
	   {!! Form::open(array('route'=>array('building_report_print'),'class'=>'table_chkbox2','target'=>"_blank")) !!} 
	  <div class="table_bot clear">
	    <table id="no-more-tables" class="res-table2 building_list">
		<thead>
		  <tr>		
		    <th class="numeric"></th>
		    <th class="numeric">ID
		    @if($s == 'id')
			@if($stype == 'DESC')
			      <a href="{{URL::route('building_report').'?s=id&stype=ASC'}}" class="top-arrow"><img src="{{asset('images/arrow5.png')}}"></a>
			@endif
			@if($stype == 'ASC')
			      <a href="{{URL::route('building_report').'?s=id&stype=DESC'}}" class="down-arrow"><img src="{{asset('images/arrow4.png')}}"></a>
			@endif
		     @else
			<a href="{{URL::route('building_report').'?s=id&stype=ASC'}}" class="top-arrow"><img src="{{asset('images/arrow1.png')}}"></a>
			<a href="{{URL::route('building_report').'?s=id&stype=DESC'}}" class="down-arrow"><img src="{{asset('images/arrow3.png')}}"></a>
		     @endif
		    </th>
		    <th class="numeric">Permit Issued
		    @if($s == 'permit_issue')
			@if($stype == 'DESC')
			      <a href="{{URL::route('building_report').'?s=permit_issue&stype=ASC'}}" class="top-arrow"><img src="{{asset('images/arrow5.png')}}"></a>
			@endif
			@if($stype == 'ASC')
			      <a href="{{URL::route('building_report').'?s=permit_issue&stype=DESC'}}" class="down-arrow"><img src="{{asset('images/arrow4.png')}}"></a>
			@endif
		     @else
			<a href="{{URL::route('building_report').'?s=permit_issue&stype=ASC'}}" class="top-arrow"><img src="{{asset('images/arrow1.png')}}"></a>
			<a href="{{URL::route('building_report').'?s=permit_issue&stype=DESC'}}" class="down-arrow"><img src="{{asset('images/arrow3.png')}}"></a>
		     @endif
		     </th>		
		    <th class="numeric">Posted Date
		    @if($s == 'posted_date')
			@if($stype == 'DESC')
			      <a href="{{URL::route('building_report').'?s=posted_date&stype=ASC'}}" class="top-arrow"><img src="{{asset('images/arrow5.png')}}"></a>
			@endif
			@if($stype == 'ASC')
			      <a href="{{URL::route('building_report').'?s=posted_date&stype=DESC'}}" class="down-arrow"><img src="{{asset('images/arrow4.png')}}"></a>
			@endif
		     @else
			<a href="{{URL::route('building_report').'?s=posted_date&stype=ASC'}}" class="top-arrow"><img src="{{asset('images/arrow1.png')}}"></a>
			<a href="{{URL::route('building_report').'?s=posted_date&stype=DESC'}}" class="down-arrow"><img src="{{asset('images/arrow3.png')}}"></a>
		     @endif
		     </th>
		    <th class="numeric">County
		    @if($s == 'county_sort')
			@if($stype == 'DESC')
			      <a href="{{URL::route('building_report').'?s=county_sort&stype=ASC'}}" class="top-arrow"><img src="{{asset('images/arrow5.png')}}"></a>
			@endif
			@if($stype == 'ASC')
			      <a href="{{URL::route('building_report').'?s=county_sort&stype=DESC'}}" class="down-arrow"><img src="{{asset('images/arrow4.png')}}"></a>
			@endif
		     @else
			<a href="{{URL::route('building_report').'?s=county_sort&stype=ASC'}}" class="top-arrow"><img src="{{asset('images/arrow1.png')}}"></a>
			<a href="{{URL::route('building_report').'?s=county_sort&stype=DESC'}}" class="down-arrow"><img src="{{asset('images/arrow3.png')}}"></a>
		     @endif
		     </th>
		    <th class="numeric">Jurisdiction
		    @if($s == 'juris')
			@if($stype == 'DESC')
			      <a href="{{URL::route('building_report').'?s=juris&stype=ASC'}}" class="top-arrow"><img src="{{asset('images/arrow5.png')}}"></a>
			@endif
			@if($stype == 'ASC')
			      <a href="{{URL::route('building_report').'?s=juris&stype=DESC'}}" class="down-arrow"><img src="{{asset('images/arrow4.png')}}"></a>
			@endif
		     @else
			<a href="{{URL::route('building_report').'?s=juris&stype=ASC'}}" class="top-arrow"><img src="{{asset('images/arrow1.png')}}"></a>
			<a href="{{URL::route('building_report').'?s=juris&stype=DESC'}}" class="down-arrow"><img src="{{asset('images/arrow3.png')}}"></a>
		     @endif
		     </th>	
		    <th class="numeric">Permit Type
		    @if($s == 'permit_type')
			@if($stype == 'DESC')
			      <a href="{{URL::route('building_report').'?s=permit_type&stype=ASC'}}" class="top-arrow"><img src="{{asset('images/arrow5.png')}}"></a>
			@endif
			@if($stype == 'ASC')
			      <a href="{{URL::route('building_report').'?s=permit_type&stype=DESC'}}" class="down-arrow"><img src="{{asset('images/arrow4.png')}}"></a>
			@endif
		     @else
			<a href="{{URL::route('building_report').'?s=permit_type&stype=ASC'}}" class="top-arrow"><img src="{{asset('images/arrow1.png')}}"></a>
			<a href="{{URL::route('building_report').'?s=permit_type&stype=DESC'}}" class="down-arrow"><img src="{{asset('images/arrow3.png')}}"></a>
		     @endif
		     </th>		
		    <th class="numeric">Owner
		    @if($s == 'owner')
			@if($stype == 'DESC')
			      <a href="{{URL::route('building_report').'?s=owner&stype=ASC'}}" class="top-arrow"><img src="{{asset('images/arrow5.png')}}"></a>
			@endif
			@if($stype == 'ASC')
			      <a href="{{URL::route('building_report').'?s=owner&stype=DESC'}}" class="down-arrow"><img src="{{asset('images/arrow4.png')}}"></a>
			@endif
		     @else
			<a href="{{URL::route('building_report').'?s=owner&stype=ASC'}}" class="top-arrow"><img src="{{asset('images/arrow1.png')}}"></a>
			<a href="{{URL::route('building_report').'?s=owner&stype=DESC'}}" class="down-arrow"><img src="{{asset('images/arrow3.png')}}"></a>
		     @endif
		     </th>
		    <th class="numeric">General Contractor
		    @if($s == 'contractor')
			@if($stype == 'DESC')
			      <a href="{{URL::route('building_report').'?s=contractor&stype=ASC'}}" class="top-arrow"><img src="{{asset('images/arrow5.png')}}"></a>
			@endif
			@if($stype == 'ASC')
			      <a href="{{URL::route('building_report').'?s=contractor&stype=DESC'}}" class="down-arrow"><img src="{{asset('images/arrow4.png')}}"></a>
			@endif
		     @else
			<a href="{{URL::route('building_report').'?s=contractor&stype=ASC'}}" class="top-arrow"><img src="{{asset('images/arrow1.png')}}"></a>
			<a href="{{URL::route('building_report').'?s=contractor&stype=DESC'}}" class="down-arrow"><img src="{{asset('images/arrow3.png')}}"></a>
		     @endif
		     </th>	
		  </tr>
		</thead>
		<tbody>
		  @if(count($list) > 0)
			@foreach($list as $l)
			      
			<tr>
			  <td data-title=""><input type="checkbox" name="report[]" class="checkbox report_check" value="{{$l->id}}"></td>
			  <td data-title="ID"  data-bid="{{$l->number}}" data-item="{{$l->id}}" class="building_details_show">{!! $l->number !!} </td>
			  @php
			      $issued_date 	= explode('-',$l->issued_date);
			      $issued_date  	= $issued_date[1].'/'.$issued_date[2].'/'.$issued_date[0];
			  @endphp
			  <td data-title="Permit Issued">{!! $issued_date !!}</td>	
			  <td data-title="Posted Date">{!! date('m/d/Y',strtotime($l->postedDate)) !!}</td>
			  <td data-title="County">{!! (count($l->county)>0)?$l->county->name:'N/A'; !!}</td>
			  <td data-title="Jurisdictions">{!! (count($l->jurisdictions)>0)?$l->jurisdictions->name:'N/A'; !!}</td>    
			  <td data-title="Permit Type">{!! $l->permit_type_id !!}</td>	
			  <td data-title="Owner">{!! (count($l->permit_owner)>0)?$l->permit_owner->owner_name:'N/A'; !!} </td>
			  <td data-title="General Contractor">{!! (count($l->contractor)>0)?$l->contractor->business_name:'N/A' !!} </td>	
			</tr>
			@endforeach
		  @endif
	      </table>
	    <a class="btn-report btn-psr" href="javascript:void(0);" id="report_jobs" onclick="$(this).closest('form').submit();" style="display:none;">Print Selected Jobs</a>
	    <a class="btn-report btn-rcrep" target="_blank" href="{{URL::route('building_report_print_last') }}">Print table of 50 most recent reports</a>
          </div>
           {!! Form::close() !!}
	  
	</div>
	
	
	
      </div>
    </div>
  </div>
<script>
      $(function(){
	    $('.datepicker').datepicker({
		  dateFormat : 'mm/dd/y'
	    });
      })
      
</script>
@endsection