@extends('front.app')
@section('content')
      <div class="container">
      <div class="deshboard breport clear register-customer-profile">
	<h3><strong>Payment</strong></h3>
	  <table id="no-more-tables" class="res-table1">
	    <thead>
	      <tr>		
		<th class="numeric">Item</th>
		<th class="numeric">PRICE</th>
	      </tr>
	    </thead>
	    <tbody>
		<tr>
		  <td data-title="Item">{{ $sub->subscription->subscription_title }}</td>
		  <td data-title="PRICE"> $
		  @if($sub->subscription_type == 'quarterly')
		    {{ $sub->subscription->quarterly_price }}
		    @else
		    {{ $sub->subscription->yearly_price }}
		  @endif
		  </td>
		</tr>
		  
	    </tbody>
	    <tfoot>
	       <tr>
		<td data-title="Total">Total</td>
		@if($sub->subscription_type == 'quarterly')
		  <td data-title="">{{ '$'.number_format($sub->subscription->quarterly_price,2) }}</td>
		@else
		  <td data-title="">{{ '$'.number_format($sub->subscription->yearly_price,2) }}</td>
		@endif
	      </tr>
	    </tfoot>
	  </table>
	<strong>Enter card information:</strong>
	  
	<br />
	<div class="form-report clear">
	  
	  @if (count($errors) > 0)
	      <div class="alert alert-danger">
		  <ul>
		      @foreach ($errors->all() as $error)
			  <li class="text-red error-msg">{{ $error }}</li>
		      @endforeach
		  </ul>
	      </div>
	      <br>
	  @endif
	  
	  @if(isset($error) && $error != '')
	    <p class="text-red error-msg">{{ $error }}</p>
	  @endif
	  {!! Form::open(array('route'=>array('renewSubscribe',$sub->id),'files'=>true,'class'=>'paymentForm')) !!}
	  {!! Form::hidden('total_amount',($sub->subscription_type == 'quarterly')?$sub->subscription->quarterly_price:$sub->subscription->yearly_price) !!}
	    <div class="form-msg">
		<div class="input-box half">
		  <label>Card Number :</label>
		  <div class='label-input'>{!! Form::text('card_number','',array('class'=>'input full required number','id'=>'card_number','minlength' => 15,'maxlength' => 16))!!}</div>
		</div>
		<div class="input-box half">
		  <label>Expire Date :</label>
		  @php
		      $currentYear = date('Y');
		      $lastYear    = $currentYear + 50;
		  @endphp
		  {!! Form::selectYear('year',$currentYear,$lastYear,'',array('class' => 'input half required')) !!}
		  
		  {!! Form::selectMonth('month','',array('class' => 'input half required','style'=>"width: 128px;")) !!}
	      </div>
	    </div>
	    <div class="form-msg">
		<div class="input-box half">
		<label>CVV :</label>
                <div class='label-input'>{!! Form::password('cvv',array('class' => 'input full required number','minlength' => 3,'maxlength' => 4)) !!}</div>
	    </div>
	    </div>
	    <div class="input-box">
	    {!! Form::submit('Process',array('class'=>'btn-srrp' )) !!}&nbsp;&nbsp;
	  {!! Form::close() !!}	  
	</div>
      </div>
    </div>
  </div>
@endsection