@extends('front.app')
@section('content')
    
    <div class="container">

        <div class="deshboard cartdetails breport clear list-page private-box">
	{!! Form::open(array('route' => 'private_payment','id'=>'checkout')) !!}
	{!! Form::hidden('total_price',\Cart::subtotal())!!}
	{!! Form::hidden('note',nl2br($note)) !!}
	<h3><strong>Cart </strong></h3>            
            <table>
                <tr>
		    <td>Job#</td>
                    <td>Document</td>
                    <td>Size/Download</td>
		    <!--<td>Shipping</td>-->
                    <td>QTY</td>
                    <td>Price</td>
                </tr>
                @if(count($cart_item) > 0)
                @php $data = '' @endphp
                @foreach($cart_item as $cart)
                    @php
                    $data[$cart->options->project_id][] = $cart;
                    @endphp
                @endforeach
            
                @if(count($data) > 0)
                    
                    @foreach($data as $k=>$d)
                        @php $i = 0 @endphp
                        @foreach($d as $c)
                        @php $i++ @endphp
                        <tr>
			    <td>{{ $k }}</td>
			    <td>{{ ($i<10)?'0'.$i:$i }} {{$c->name}}</td>
                            <td>
			    @if($c->options->papersize == 'full_size')
				{{'Full Size'}}
			    @elseif($c->options->papersize == 'half_size')
				{{'Half size'}}
			    @else
				{{$c->options->papersize}}
			    @endif
			    </td>
			    <!--<td>Download link will become available after successful payment.</td>-->
                            <td>{!! $c->qty !!}</td>
                            <td class="cart-price">${!! number_format($c->qty * $c->price,2) !!}</td>
                        </tr>
                        @endforeach
                    @endforeach
                @endif
            @else
                <tr><td  colspan="4">Your cart is empty</td></tr>
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
		<label>Delivery Type :</label>
                {{ Form::select('delivery_type',[''=>'Select Delivery Type','store_location'=>'Store Location Pickup','local_delivery' => 'Local Delivery'],'',array('class' => 'input full required delivery_type')) }}
	    </div>
	    
	    <div class="store_location_show" style="display:none;">
		<div class="input-box half">
		    <label>Pickup Location:</label>
		    {{ Form::select('pickup_location',[''=>'Pickup Location','Northern Prescott'=>'Northern Prescott','Downtown Prescott' => 'Downtown Prescott','Prescott Valley'=>'Prescott Valley'],'',array('class' => 'input full')) }}
		</div>
	    </div>
	    <div class="local_delivery_show" style="display:none;">
		<div class="input-box half">
		    <label>Address :</label>
		    {{ Form::text('address','',array('class' => 'input full')) }}
		</div>
		<div class="input-box half">
		    <label>City :</label>
		    {{ Form::select('city',$cities,'',array('class' => 'input full')) }}
		</div>
		<div class="input-box half">
		    <label>State :</label>
		    {{ Form::select('states',$states,'',array('class' => 'input full')) }}
		</div>
		<div class="input-box half">
		    <label>Zip :</label>
		    {{ Form::text('zip','',array('class' => 'input full')) }}
		</div>
	    </div>
	    <div class="input-box half">
		<label>Card Number :</label>
                {{ Form::text('card_number','',array('class' => 'input full required number','minlength' => 16,'maxlength' => 16)) }}
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
	    <br>
	    <div class="cartBelow">
	    <b>Total Amount: ${!! \Cart::subtotal() !!}</b><br>
	    <b>Description: A & E Reprographics Job Plans order</b><br><br>
	    </div>
	    <div class="input-box full">
		{!! Form::submit('Submit Payment') !!}
	    </div>
	    {!! Form::close() !!}
        </div>
    </div>

@endsection