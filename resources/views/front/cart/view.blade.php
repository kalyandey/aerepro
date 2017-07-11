@extends('front.app')
@section('content')
    
    <div class="container">

        <div class="deshboard cartdetails breport clear list-page">

	<h3><strong>Cart </strong></h3>
            {!! Form::open(array('route'=>'update_cart','method'=>'post')) !!}
            
            <table>
			<thead>
                <tr>
                    <td>Document</td>
                    <td>Paper Size</td>
                    <td>Qty</td>
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
            
            
                @if(count($data) > 0)
                    
                    @foreach($data as $k=>$d)
			
			@php
			$project = \App\Project::where('project_id',$k)->first();
			@endphp
			<tbody data-id="{{ $k }}" class="orderProjectsTitle">
                        <tr><td colspan="4" class="docTxt">Documents for project {{$k}} - {!! $project->name !!}</td></tr>
			</tbody>  
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
			    {{Form::hidden('full_set[]','true')}}
			    {{Form::hidden('project_id[]',$k)}}
			    {{Form::hidden('total_plan['.$k.']',$d[0]->options->total_plan)}}
			    <tr>
				<td>
				<a href="{{URL::route('remove_full_cart',[$k])}}" onclick="return confirm('Are you sure???')">X</a>
				    <b>Full Set:</b>{{count($d).' Pages'}}
				</td>
				<td>
				{!! Form::select('fullsetpapersize['.$k.']',['download' => 'Download','full_size' => 'Full Size','half_size' => 'Half Size'],$d[0]->options->papersize) !!}
				</td>
				<td>{!! Form::number('fullsetqty['.$k.']',$d[0]->qty,['min'=> '1','style' => 'width: 4em']) !!}</td>
				<td class="cart-price">
				${!! number_format($total_price,2) !!}
				</td>
			    </tr>
			@else
			    @php $i = 0 @endphp
				
				<tbody data-id="{{ $k }}" class="orderProjects" >
				
			    @foreach($d as $c)
				@php $i++ @endphp
				
				<tr class="projectPlans" data-plan-name="{{$c->name}}">
				{!! Form::hidden('planId[]',$c->id) !!}
				{!! Form::hidden('rowId[]',$c->rowId) !!}
				    <td>
				    <a href="{{URL::route('remove_cart',[$c->rowId])}}" onclick="return confirm('Are you sure???')">X</a>
				    {{$c->name}}
				    </td>
				    <td>
				    {!! Form::select('papersize[]',['download' => 'Download','full_size' => 'Full Size','half_size' => 'Half Size'],$c->options->papersize) !!}
				    <td>{!! Form::number('qty[]',$c->qty,['min'=> '1','style' => 'width: 4em']) !!}</td>
				    <td class="cart-price">${!! number_format($c->qty * $c->price,2) !!}</td>
				</tr>
			    @endforeach
				</tbody>
			@endif
                    @endforeach
                @endif
                
                <tr>
                    <td>
                    {!! Form::submit('Update Cart') !!}
                    <a href="{{URL::route('clear_cart')}}" onclick="return confirm('Are you sure???')" class="clear-cart">Clear Cart</a>
                    </td>
		    <td></td>
                    <td colspan="2" class="cart-total-price">Sub-Total : ${!! \Cart::subtotal() !!}</td>
                </tr>
                
            @else
                <tr><td  colspan="4">Your cart is empty</td></tr>
            @endif
            </table>
            {!! Form::close() !!}
            {!! Form::open(array('route'=>'checkout','method'=>'post','id'=>'checkout')) !!}
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