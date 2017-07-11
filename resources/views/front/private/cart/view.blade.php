@extends('front.app')
@section('content')
    
    <div class="container">

        <div class="deshboard cartdetails breport clear list-page private-box">

	<h3><strong>Cart </strong></h3>
            {!! Form::open(array('route'=>'update_private_cart','method'=>'post')) !!}
            
            <table>
                <tr>
                    <td>Document</td>
                    <td>Paper Size</td>
                    <td>Qty</td>
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
                        
                        <tr><td colspan="4" class="docTxt">Documents for project {{$k}}</td></tr>
                        @php $i = 0 @endphp
                        @foreach($d as $c)
			    
                        @php $i++ @endphp
                        {!! Form::hidden('planId[]',$c->id) !!}
                        {!! Form::hidden('rowId[]',$c->rowId) !!}
                        <tr>
                            <td>
                            <a href="{{URL::route('remove_private_cart',[$c->rowId])}}" onclick="return confirm('Are you sure???')">X</a>
                                <b>Job:</b>{{$k .'-' .$c->options->project_name}}
                                <div class="documentDiv"><b>Document:</b> {{ ($i<10)?'0'.$i:$i }}  {{$c->name}}</div>
                            </td>
                            <td>
                            {!! Form::select('papersize[]',['full_size' => 'Full Size','half_size' => 'Half Size'],$c->options->papersize) !!}
                            <td>{!! Form::number('qty[]',$c->qty,['min'=> '0','style' => 'width: 4em']) !!}</td>
                            <td class="cart-price">${!! number_format($c->qty * $c->price,2) !!}</td>
                        </tr>
                        @endforeach
                    @endforeach
                @endif
                <tr>
                    <td>
                    {!! Form::submit('Update Cart') !!}
                    <a href="{{URL::route('clear_private_cart')}}" onclick="return confirm('Are you sure???')">Clear Cart</a>
                    </td>
		    <td></td>
                    <td colspan="2" class="cart-total-price">Total : ${!! \Cart::subtotal() !!}</td>
                </tr>
                
            @else
                <tr><td  colspan="4">Your cart is empty</td></tr>
            @endif
            </table>
            {!! Form::close() !!}
            {!! Form::open(array('route'=>array('private_checkout',$company_slug),'method'=>'post','id'=>'checkout')) !!}
            <div class="input-box full">
                <label>Notes/Special Requests :</label>
                {{ Form::textarea('note','',array('class' => 'input full')) }}
            </div>
            <div class="input-box half">
                {{ Form::submit('checkout') }}
            </div>        
            {!! Form::close() !!}
        </div>
    </div>

@endsection