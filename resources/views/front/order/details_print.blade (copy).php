    <div class="container">
      <div class="deshboard breport clear">
	<h3><strong>Order</strong> Reports</h3>
	<strong class="welcome">Welcome <span>{{Session::get('USER_DETAILS')->first_name.' '.Session::get('USER_DETAILS')->last_name}}</span></strong>	  
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
				<tbody style="display:none">
				<tr> <td colspan="3"><input type="hidden" name="orderDetailsJSON" value="{{ json_encode($data) }}" /></td><tr/>
				</tbody>
			  @foreach($data as $k=>$d)
				 <tbody data-id="{{ $k }}" class="orderProjects">
			      @php $i = 0; $j=0 @endphp	
			      <tr  class="projectTitle">
			      <td class="docTxt ">Documents for project {{$d[0]->project->project_id .'-' .$d[0]->project->name }}</td>
			      <td>
			      </td>
			      <td colspan="2"></td>
			      </tr>
					
					
			      @foreach($d as $c)
			      @php $i++ @endphp
			      <tr class="projectPlans" data-parent="{{ $c->project->project_id }}" data-plan-name="{{$c->plan->plan_name}}">
				  <td data-title="Project #">{{$c->plan->plan_name}}
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
	      </table>
          </div>
	  
	</div>
      </div>