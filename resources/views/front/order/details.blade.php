@extends('front.app')
@section('content')
<div class="details_view"></div>
<div class="details_loader"></div>
    <div class="container">
      <div class="deshboard breport clear">
	<h3><strong>Order</strong> Reports</h3>
	<strong class="welcome">Welcome <span>{{Session::get('USER_DETAILS')->first_name.' '.Session::get('USER_DETAILS')->last_name}}</span></strong>	
	<a href="{{URL::route('dashboard')}}" class="btn-db">Dashboard</a>
	    
        @if(count(\Cart::content()) > 0)
	<a href="{{URL::route('my_cart')}}" class="cart cart-button"> {{ count(\Cart::content())}} Cart item</a>
	@endif
	<div class="report-table">
	  <div class="table_bot clear">
	    <div class="reportDiv"><lable>Order ID : </lable>{!! $details->order_id !!}</div>
	    <div class="reportDiv"><lable>Payment Type : </lable>
	    @if($details->order_type == 'cod')
	      Cash On Delivary
	    @elseif($details->order_type == 'my_account')
	      My Account
	    @else
	      Credit Card
	    @endif
	    </div>
	    @if($details->order_type == 'cc')
	    <div class="reportDiv"><lable>Transaction ID : </lable>{!! $details->transaction_id !!}</div>
	    @endif
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
			<div class="reportDiv"><lable>City:</lable>{!! ($details->city != '')?$details->city:'N/A'; !!} </div>
			<div class="reportDiv"><lable>State:</lable>{!! (count($details->state_name) > 0)?$details->state_name->state:'N/A' !!} </div>
			<div class="reportDiv"><lable>Zip:</lable>{!! ($details->zip != '')?$details->zip:'N/A'; !!} </div>
	    @endif
							    
	    </div>
	    <table id="no-more-tables" class="res-table2">
		<thead>
		  <tr>		
		    <th class="numeric">Project #</th>
		    <th class="numeric">Size/Download</th>		
		    <th class="numeric">QTY</th>
		    <!--<th class="numeric">Price</th>-->
		  </tr>
		</thead>
		  @if(count($details->order) > 0 )
		      @php $data = '' @endphp
		      @foreach($details->order as $ord)
			  @php
			  $data[$ord->project_id][] = $ord;
			  @endphp
		      @endforeach
		      @if(count($data) > 0)
				
			  @foreach($data as $k=>$d)
				 <tbody data-id="{{ $k }}" class="orderProjectsTitle">
			      @php $i = 0; $j=0 @endphp	
			      <tr  class="projectTitle">
			      <td class="docTxt ">Documents for project {{$d[0]->project->project_id .'-' .$d[0]->project->name }}</td>
			      <td>
			      @foreach($d as $c)
				  @if($c->order_type == 'full_set')
				    @php $j = $j+1; @endphp
				  @elseif($c->order_type == 'download')
				      @php $j = $j+1; @endphp
				  @endif
			      @endforeach
			      @if($j > 0)
			      <a href="{{Url::route('download_zip',[$d[0]->order_master_id,$d[0]->project->project_id])}}">Download</a>
			      @endif
			      </td>
			      <td colspan="2"></td>
			      </tr>
					</tbody>
					<tbody data-id="{{ $k }}" class="orderProjects">
			      @foreach($d as $c)
			      @php $i++ @endphp
			      <tr class="projectPlans" data-parent="{{ $c->project->project_id }}" data-plan-name="{{(count($c->plan)>0)?$c->plan->plan_name:'Full Set ('.count($d[0]->project->plan).'Pages)'}}">
				  <td data-title="Project #">
				  {{(count($c->plan)>0)?$c->plan->plan_name:'Full Set ('.count($d[0]->project->plan).'Pages)'}}
				  </td>
				  <td data-title="Size/Download">
				  @if($c->order_type == 'full_size')
				    Full Size
				  @elseif($c->order_type == 'half_size')
				    Half Size
				  @elseif($c->order_type == 'full_set')
				    Full Set
				  @else
				      {{$c->order_type}}
				  @endif
				  </td>
				  <td data-title="QTY">{!! $c->quantity !!}</td>
				  <!--<td data-title="Price">${!! number_format($c->quantity * $c->price,2) !!}</td>-->
			      </tr>
			      @endforeach
				  
				  </tbody>
				  
			  @endforeach
		      @endif
		@else
		<tr>
		    <td colspan="4">----No record Found----</td>
		</tr>
		
		@endif
		<tfoot>
		  <tr>
		    <td><b>Sub Total : </b></td>
		    <td colspan="2">{{ number_format($details->total_price,2) }}</td>
		  </tr>
		   <tr>
		    <td><b>Tax : </b></td>
		    <td colspan="2">{{ number_format($details->tax,2) }}</td>
		  </tr>
		   <tr>
		    <td><b>Total : </b></td>
		    <td colspan="2">{{number_format(($details->total_price + $details->tax),2)}}</td>
		  </tr>
		   <tr>
		    <td><b>Payment Method : </b></td>
		    <td colspan="2">
		      @if($details->order_type == 'my_account')
			My account
		      @elseif($details->order_type == 'cc')
			Credit Credit
		      @elseif($details->order_type == 'cod')
			Cash on Delivery
		      @endif
		    </td>
		  </tr>
		  <tr>
		  <td   style="text-align:left">@if($details->note !='')
					   <strong>* Note : </strong>{{ $details->note }}
					@endif
					</td>
		  <td colspan="2"><a href="{{URL::route('print_order',$details->id)}}" target="_blank" class="btn-report btn-rcrep btn-order-print">Print</a></td></tr>
		</tfoot>
	      </table>
          </div>
	  
	</div>
	
	
	
      </div>
    </div>
  </div>
@endsection