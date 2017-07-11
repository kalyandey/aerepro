@extends('front.app')
@section('content')
      <div class="container">
      <div class="deshboard breport clear register-customer-profile">
	<h3><strong>Payment</strong></h3>
	  <table id="no-more-tables" class="res-table1">
	    <thead>
	      <tr>		
		<th class="numeric">Item</th>
		@if($user->temp_payment->subscription_type == 'quarterly')
		  <th class="numeric">QUARTERLY PRICE</th>
		@elseif($user->temp_payment->subscription_type == 'yearly')
		  <th class="numeric">YEARLY PRICE</th>
		@endif		
	      </tr>
	    </thead>
	    <tbody>
	    @if(count($subscription_list) > 0)
	      @php $total_price ='' @endphp
	      @foreach($subscription_list AS $subscription)
		@if(in_array($subscription->id,explode(',',$user->temp_payment->subscription_id)))
		<tr>
		  <td data-title="Item">{{ $subscription->subscription_title }}</td>
		  @if($user->temp_payment->subscription_type == 'quarterly')
		  @php $total_price += $subscription->quarterly_price @endphp
		  <td data-title="QUARTERLY PRICE"> ${{ $subscription->quarterly_price }}</td>
		  @elseif($user->temp_payment->subscription_type == 'yearly')
		    @php $total_price += $subscription->yearly_price @endphp
		  <td data-title="YEARLY PRICE"> ${{ $subscription->yearly_price }}</td>
		  @endif
		</tr>
		@endif
	      @endforeach
	    @endif
	    </tbody>
	    <tfoot>
	       <tr>
		<td data-title="Total">Total</td>
		<td data-title="">{!! '$'.number_format($total_price,2) !!}</td>
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
	  {!! Form::open(array('route'=>array('payment_process',$user->token),'files'=>true,'class'=>'paymentForm')) !!}

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