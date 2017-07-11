@extends('front.app')
@section('content')
    
    <div class="container">

        <div class="deshboard cartdetails breport clear list-page">
	{!! Form::open(array('route' => 'payment','id'=>'checkout')) !!}
	{!! Form::hidden('total_price',number_format(\Cart::subtotal(),2))!!}
	{!! Form::hidden('tax',number_format(((str_replace(',','',\Cart::subtotal())*$tax->sitesettings_value)/100),2) )!!}
	{!! Form::hidden('note',nl2br($note)) !!}
	<h3><strong>Cart </strong></h3>            
            <table>
		<thead>
                <tr>
		    <td>Job#</td>
                    <td>Document</td>
                    <td>Size/Download</td>
		    <!--<td>Shipping</td>-->
                    <td>QTY</td>
                    <td>Price</td>
                </tr>
		</thead>
                @if(count($cart_item) > 0)
                @php $data = '' @endphp
                @foreach($cart_item as $cart)
                    @php
                    $data[$cart->options->project_id][] = $cart;
                    @endphp
                @endforeach
		
		@php $dw = 0 @endphp
		
                @if(count($data) > 0)
                    
                    @foreach($data as $k=>$d)
			
			@php $total = 0;$total_price = 0 @endphp
			@foreach($d as $c)
			    @if($c->options->papersize == $d[0]->options->papersize)
				@php
				$total = $total+1;
				$total_price += $c->qty * $c->price;
				@endphp
			    @endif
			@endforeach
			
			
			@if($total == $d[0]->options->total_plan && $d[0]->options->all_plans_cat == 1)
			    <input type="hidden" name="project_id[]" value="{{$k}}">
			    <input type="hidden" name="papersize[]" value="{{$c->options->papersize}}">
			    <input type="hidden" name="price[]" value="{{number_format($total_price,2)}}">
			    <input type="hidden" name="qty[]" value="{{$c->qty}}">
			    <input type="hidden" name="plan_id[]" value="">
			    
			    <tr>
				<td>{{$k}}</td>
				<td>{{$total.' Pages' }}</td>
				<td>
				@if($d[0]->options->papersize == 'full_size')
				    {{'Full Size'}}
				@elseif($d[0]->options->papersize == 'half_size')
				    {{'Half Size'}}
				@elseif($d[0]->options->papersize == 'full_set')
				    {{'Full Set'}}
				@else
				    @php $dw = $total @endphp
				    {{$c->options->papersize}}
				@endif
				</td>
				<td>{!! $d[0]->qty !!}</td>
				<td class="cart-price">
				${!! number_format($total_price,2) !!}
				</td>
			    </tr>
			@else
			    
                        @php $i = 0 @endphp
                        @foreach($d as $c)
                        @php $i++ @endphp
			<input type="hidden" name="project_id[]" value="{{$k}}">
			<input type="hidden" name="papersize[]" value="{{$c->options->papersize}}">
			<input type="hidden" name="price[]" value="{{$c->price}}">
			<input type="hidden" name="qty[]" value="{{$c->qty}}">
			<input type="hidden" name="plan_id[]" value="{{$c->id}}">
                        <tr>
			    <td>{{ $k }}</td>
			    <td>{{ ($i<10)?'0'.$i:$i }} {{$c->name}}</td>
                            <td>
			    @if($c->options->papersize == 'full_size')
				{{'Full Size'}}
			    @elseif($c->options->papersize == 'half_size')
				{{'Half Size'}}
			    @elseif($c->options->papersize == 'full_set')
				{{'Full Set'}}
			    @else
				@php $dw = $dw + 1 @endphp
				{{$c->options->papersize}}
			    @endif
			    </td>
			    <!--<td>Download link will become available after successful payment.</td>-->
                            <td>{!! $c->qty !!}</td>
                            <td class="cart-price">${!! number_format($c->qty * $c->price,2) !!}</td>
                        </tr>
                        @endforeach
			
			@endif
                    @endforeach
                @endif
            @else
                <tr><td  colspan="4">No record found</td></tr>
            @endif
            </table>
	    @if($note != '')
	    <div class="notesReqMain">
		<div class="notesReq">Notes/Special Requests : </div>
		<div class="noteDesc">{!! nl2br($note) !!}</div>
	    </div>
	    @endif
	    <h3><strong>Checkout</strong></h3>
	    <div class="input-box half">
		<label>Name :</label>
		<b>{{ $users->first_name.' '.$users->last_name }}</b>
	    </div>
	    <div class="input-box half">
		<label>Email :</label>
                <b>{{ $users->email }}</b>
	    </div>
	    
	    <div class="input-box half">
		<label>Payment Type :</label>
		@php
		if($dw > 0){
		    $dw_array = array(''=>'Select Payment Type','cc'=>'Credit card');
		}else{
		    $dw_array = array(''=>'Select Payment Type','cod' => 'COD','my_account'=>'My Account','cc'=>'Credit card');
		}
		@endphp
                {{ Form::select('payment_type',$dw_array,'',array('class' => 'input full required payment_type')) }}
	    </div>
	    @if($dw !=  count($cart_item) )
	    <div class="input-box half">
		<label>Delivery Type :</label>
                {{ Form::select('delivery_type',[''=>'Select Delivery Type','store_location'=>'Store Location Pickup','local_delivery' => 'Local Delivery'],'',array('class' => 'input full required delivery_type')) }}
	    </div>
	    
	    <div class="store_location_show" style="display:none;">
		<div class="input-box half">
		    <label>Pickup Location:</label>
		    {{ Form::select('pickup_location',['Northern Prescott'=>'Northern Prescott','Downtown Prescott' => 'Downtown Prescott','Prescott Valley'=>'Prescott Valley'],'',array('class' => 'input full required')) }}
		</div>
	    </div>
	    <div class="local_delivery_show" style="display:none;">
		<div class="input-box half">
		    <label>Address :</label>
		    {{ Form::text('address',$users->addess_line1,array('class' => 'input full required')) }}
		</div>
		<div class="input-box half">
		    <label>City :</label>
		    {{ Form::text('city',$users->city,array('class' => 'input full required')) }}
		</div>
		<div class="input-box half">
		    <label>State :</label>
		    {{ Form::select('states',$states,3,array('class' => 'input full required states_change')) }}
		</div>
		<div class="input-box half">
		    <label>Zip :</label>
		    {{ Form::text('zip',$users->zip,array('class' => 'input full required')) }}
		</div>
	    </div>
	    @endif
	    <div class="card_details" style="display:none;">
	    <div class="input-box half">
		<label>Card Number :</label>
                {{ Form::text('card_number','',array('class' => 'input full required number','minlength' => 15,'maxlength' => 16)) }}
	    </div>
	    <div class="input-box half">
		<label>Expire Date :</label>
		@php
		    $currentYear = date('Y');
		    $lastYear    = $currentYear + 50;
		@endphp
                {{ Form::selectYear('year',$currentYear,$lastYear,'',array('class' => 'input half required')) }}
		
		{{ Form::selectMonth('month','',array('class' => 'input half required','style'=>"width: 128px;")) }}
		
	    </div>
	    <div class="input-box half">
		<label>CVV :</label>
                {{ Form::password('cvv',array('class' => 'input full required number','minlength' => 3,'maxlength' => 4)) }}
	    </div>
	    </div>
	    
	    <br>
	    <div class="cartBelow">
	    <b>Sub-Total Amount: ${!! \Cart::subtotal() !!}</b><br>
	    @if($dw ==  count($cart_item) )
	    @php
	    $tax = number_format(((str_replace(',','',\Cart::subtotal())*$tax->sitesettings_value)/100),2);
	    @endphp
	    <b>Tax : ${{ $tax }}</b><br>
	    <b>Total : ${{ \Cart::subtotal()+ $tax }}</b><br>
	    @endif
	    <!--<span class="taxspan"></span>--><br>
	    </div>
	    <div class="input-box full">
		{!! Form::submit('Submit Payment') !!}
	    </div>
	    {!! Form::close() !!}
        </div>
    </div>
    <script>
	$(function(){
	   $('.states_change').change(function(){
	    var selected_val 	= $(this).val();
	    var delivery_type 	= $('.delivery_type').val();
	    if ((selected_val == '3' && delivery_type == 'local_delivery') || (delivery_type == 'store_location')) {
		var total_price = $('input[name=total_price]').val();
		var tax 	= $('input[name=tax]').val();
		
		var str = '<b>Sub-Total $: '+total_price+'</b><br>';
		str += '<b>Tax : $'+tax+'</b><br>';
		str += '<b>Total : $'+(Number(total_price) + Number(tax)).toFixed(2)+'</b><br>';
		
		$('.cartBelow').html(str);
		//$('.taxspan').html('<b>Tax : '+$('input[name=tax]').val()+'</b><br>');
	    }else{
		var total_price = $('input[name=total_price]').val();
		$('.cartBelow').html('<b>Total Amount: $'+total_price+'</b><br>');
	    }
	   }); 
	});
    </script>
@endsection