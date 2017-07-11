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
	  <div class="table_top clear">
	    <span class="number">{{$list->total() }} reports</span>
	    <div class="pagination">
	      @include('front.pagination.custom', ['paginator' => $list])
	    </div>
	  </div>
	  <div class="table_bot clear">
	    <table id="no-more-tables" class="res-table2">
		<thead>
		  <tr>		
		    <th class="numeric">ID</th>
		    <th class="numeric">Transaction Id</th>
		    <th class="numeric">Delivery Type</th>
		    <th class="numeric">Delivery Details</th>
		    <th class="numeric">Price</th>
		    <th class="numeric">Payment Date</th>
		    <th class="numeric">Action</th>
		  </tr>
		</thead>
		<tbody>
		  @if(count($list) > 0)
                    
			@foreach($list as $l)
			<tr>
			  <td data-title="ID">{!! $l->order_id !!} </td>
			  <td data-title="Transaction Id" class="numeric">{!! $l->transaction_id !!}</td>
			  <td data-title="Delivery Type" class="numeric">
			  @if($l->delivery_type == 'store_location')
				      {{ 'Store Location Pickup' }}
			  @elseif($l->delivery_type == 'local_delivery')
				      {{'Local Delivery'}}
			  @endif
			  </td>
			  <td data-title="Delivery Details" >
			  @if($l->delivery_type == 'store_location')
				      <b>Pickup Location:</b>{!! $l->pickup_location !!}
			  @elseif($l->delivery_type == 'local_delivery')
				      <b>Address:</b>{!! ($l->address != '')?$l->address:'N/A'; !!} <br>
				      <b>City:</b>{!! (count($l->city_name))?$l->city_name->city:'N/A'; !!} <br>
				      <b>State:</b>{!! (count($l->state_name))?$l->state_name->state:'N/A' !!} <br>
				      <b>Zip:</b>{!! ($l->zip != '')?$l->zip:'N/A'; !!} <br>
			  @endif
			  </td>
			  <td data-title="Price">{!! $l->total_price !!}</td>
			  <td data-title="Payment Date">{!! date('m-d-Y',strtotime($l->created_at)) !!}</td>
			  <td data-title="Action">
                          <a class="btn btn-info" href="{{ URL::route('order_details',$l->id) }}" title="Details"> Details </a>
                          </td>  
			</tr>
			@endforeach
		  @else
		    <tr>
		      <td colspan="5">--No Record Found--</td>
		    </tr>
		  @endif
		  
	      </table>
          </div>
	  
	</div>
	
	
	
      </div>
    </div>
  </div>
@endsection