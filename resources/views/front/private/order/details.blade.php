@extends('front.app')
@section('content')
<div class="details_view"></div>
<div class="details_loader"></div>
    <div class="container">
      <div class="deshboard breport clear private-box">
	<h3><strong>Order</strong> Reports</h3>
	<strong class="welcome">Welcome <span>
	@if(Session::has('PRIVATE_COMPANY_DETAILS') && Session::get('PRIVATE_COMPANY_DETAILS') != '')
	  {!! Session::get('PRIVATE_COMPANY_DETAILS')->first_name.' '.Session::get('PRIVATE_COMPANY_DETAILS')->last_name !!}
	@elseif(!Session::has('PRIVATE_USER_DETAILS') && Session::get('PRIVATE_USER_DETAILS') != ''){
	  {!! Session::get('PRIVATE_USER_DETAILS')->first_name.' '.Session::get('PRIVATE_USER_DETAILS')->last_name !!}
	@endif
	</span></strong>
	<div class="report-table">
	  <div class="table_bot clear">
	    <div class="reportDiv"><lable>Order ID : </lable>{!! $details->order_id !!}</div>
	    <div class="reportDiv"><lable>Transaction ID : </lable>{!! $details->transaction_id !!}</div>
	    <div class="reportDiv"><lable>Delivery Type : </lable>
	    @if($details->delivery_type == 'store_location')
			{{ 'Store Location Pickup' }}
	    @elseif($details->delivery_type == 'local_delivery')
			{{'Local Delivery'}}
	    @endif
	    </div>
	    <div class="reportDiv"><lable>Delivery Details  </lable></div>
	    
	    @if($details->delivery_type == 'store_location')
			<div class="reportDiv"><lable>Pickup Location:</lable>{!! $details->pickup_location !!}</div>
	    @elseif($details->delivery_type == 'local_delivery')
			<div class="reportDiv"><lable>Address:</lable>{!! ($details->address != '')?$details->address:'N/A'; !!} </div>
			<div class="reportDiv"><lable>City:</lable>{!! (count($details->city_name))?$details->city_name->city:'N/A'; !!} </div>
			<div class="reportDiv"><lable>State:</lable>{!! (count($details->state_name))?$details->state_name->state:'N/A' !!} </div>
			<div class="reportDiv"><lable>Zip:</lable>{!! ($details->zip != '')?$details->zip:'N/A'; !!} </div>
	    @endif
							    
	    </div>
	    <table id="no-more-tables" class="res-table2">
		<thead>
		  <tr>		
		    <th class="numeric">Job#</th>
		    <th class="numeric">Size/Download</th>		
		    <th class="numeric">QTY</th>
		    <th class="numeric">Price</th>
		    <!--<th class="numeric">File</th>-->
		  </tr>
		</thead>
		<tbody>
		  @if(count($details->order) > 0 )
		      @php $data = '' @endphp
		      @foreach($details->order as $ord)
			  @php
			  $data[$ord->project_id][] = $ord;
			  @endphp
		      @endforeach
		      @if(count($data) > 0)
			  @foreach($data as $k=>$d)
			      @php $i = 0 @endphp	
			      <tr><td colspan="5" class="docTxt">Documents for project {{$d[0]->project->project_id }}</td></tr>
			      @foreach($d as $c)
			      @php $i++ @endphp
			      <tr>
				  <td data-title="Job#">
				    <b>Job:</b>{{ $c->project->project_id .'-' .$c->project->project_name }}
				    <div><b>Document:</b> {{ ($i<10)?'0'.$i:$i }}  {{$c->plan->plan_name}}</div>
				  </td>
				  <td data-title="Size/Download">
				    @if($c->order_type == 'full_size')
				      Full Size
				    @elseif($c->order_type == 'half_size')
				      Half Size
				    @endif
				  </td>
				  <td data-title="QTY">{!! $c->quantity !!}</td>
				  <td data-title="Price">${!! number_format($c->quantity * $c->price,2) !!}</td>
				 <!-- <td data-title="File">
				      @if(Helpers::isFileExist('uploads/private_planroom/plan/'.$c->plan->file_name) && $c->plan->file_name != '')
					  <a target="_blank" href="{{Helpers::isFileExist('uploads/private_planroom/plan/'.$c->plan->file_name)}}"><b>Download</b></a>
				      @endif
				  </td>-->
			      </tr>
			      @endforeach
			  @endforeach
		      @endif
		@else
		<tr>
		    <td colspan="4">----No record Found----</td>
		</tr>
		
		@endif
	      </table>
          </div>
	  
	</div>
	
	
	
      </div>
    </div>
  </div>
@endsection