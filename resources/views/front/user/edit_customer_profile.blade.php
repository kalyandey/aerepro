@extends('front.app')
@section('content')
      <div class="container">
      <div class="deshboard breport clear edit-customer-profile">
	<h3><strong>Edit Profile</strong></h3>
	<a href="{{URL::route('dashboard')}}" class="btn-db">Dashboard</a>
	    
        @if(count(\Cart::content()) > 0)
	<a href="{{URL::route('my_cart')}}" class="cart cart-button"> {{ count(\Cart::content())}} Cart item</a>
	@endif
	<br>
	<div class="form-report clear edit_tab">
	  
	  @if (count($errors) > 0)
	      <div class="alert alert-danger">
		  <ul>
		      @foreach ($errors->all() as $error)
			  <li>{{ $error }}</li>
		      @endforeach
		  </ul>
	      </div>
	  @endif
          
          @if( Session::has('success') )
                        <p class='text-green success-msg'><span>{!! Session::get('success') !!}</span></p>
          @endif
	  @if(Session::has('error'))
	  <p class='text-red error-msg'><span>{!! Session::get('error') !!}</span></p>
	@endif

<link type="text/css" rel="stylesheet" href="{{asset('css/bootstrap.min.css')}}">
      <ul class="nav nav-tabs">
	<li class="{{(!Session::has('active_sub'))?'active':''}}"><a data-toggle="tab" href="#my_details">My Details</a></li>
	<li><a data-toggle="tab" href="#my_professions">My Professions</a></li>
	@if($user_details->delete_card == 'No')
	<li><a data-toggle="tab" href="#card_details">Card Details</a></li>
	<li><a data-toggle="tab" href="#delete_card">Delete Card</a></li>
	@else
	<li><a data-toggle="tab" href="#add_card_details">Add Card Details</a></li> 
	@endif
	<li class="{{(\Session::has('active_sub'))?'active':''}}"><a data-toggle="tab" href="#subscription">Subscription Management</a></li>
	<li><a data-toggle="tab" href="#order">Order History</a></li>
      </ul>
	<div class="tab-content">  
	  
	<div id="my_details" class="tab-pane fade in {{(!Session::has('active_sub'))?'active':''}}">
	  
	  {!! Form::open(array('route'=>array('update_customer_profile'),'id'=>'edit_profile','files'=>true)) !!}
          {!! Form::hidden('user_id',$user_details->id) !!}
	    <div class="form-msg">
	      
	      <div class="input-box half">
		<label>Email :</label>
		{!! $user_details->email!!}	      
	      </div>
	      
	    </div>
	    <div class="form-msg">
		<div class="input-box half">
		  <label>Business Name :</label>
                <div class='label-input'>{!! Form::text('business_name',$user_details->business_name,array('class'=>'input full'))!!}</div>
		  
		</div>
	    </div>
	    <div class="form-msg">
		<div class="input-box half">
		  <label>Phone :</label>
		  <div class='label-input'>{!! Form::text('phone',$user_details->phone,array('class'=>'input full','id'=>'phone'))!!}</div>
		</div>
		<div class="input-box half">
		  <label>Fax :</label>
		  <div class='label-input'>{!! Form::text('fax',$user_details->fax,array('class'=>'input full','id'=>'fax'))!!}</div>
		</div>
	    </div>
	    <div class="form-msg">
		<div class="input-box half">
		  <label>Website URL :</label>
		  <div class='label-input'>{!! Form::text('website_url',$user_details->website_url,array('class'=>'input full'))!!}</div>
		</div>
	    </div>
	    <div class="form-msg">  
		  <div class="input-box half">
		    <label>First Name :</label>
		    <div class='label-input'>{!! Form::text('first_name',$user_details->first_name,array('class'=>'input full'))!!}</div>
		  </div>
		  <div class="input-box half">
		    <label>Last Name :</label>
		    <div class='label-input'>{!! Form::text('last_name',$user_details->last_name,array('class'=>'input full'))!!}</div>
		  </div>
	    </div>
	    <div class="form-msg"> 
		<div class="input-box half">
		  <label>Address Line 1 :</label>
		  <div class='label-input'>{!! Form::text('addess_line1',$user_details->addess_line1,array('class'=>'input full'))!!}</div>
		</div>
		<div class="input-box half">
		  <label>Address Line 2 :</label>
		  <div class='label-input'>{!! Form::text('addess_line2',$user_details->addess_line2,array('class'=>'input full'))!!}</div>
		</div>
	    </div>
	    <div class="form-msg">
		<div class="input-box half">
		  <label>City :</label>
		 
		  <div class='label-input'>{!! Form::text('city',$user_details->city,array('class'=>'input full'))!!}</div>
		</div>
		<div class="input-box half">
		  <label>State / Province / Region :</label>
		  
		  <div class='label-input'>{!! Form::select('state',$state, $user_details->state ,array('class'=>'input full'))!!}</div>
		</div>
	    </div>
	    <div class="form-msg">
		<div class="input-box half">
		  <label>ZIP :</label>
		  <div class='label-input'>{!! Form::text('zip',$user_details->zip,array('class'=>'input full'))!!}</div>
		</div>
	    </div>
	    <div class="form-msg">
		<div class="input-box half">
		  <label>Are you a licensed contractor?</label>
		  {{ Form::radio('licensed_contractor', 'Yes' , ($user_details->licensed_contractor == 'Yes' )?'checked':'') }}Yes
		  {{ Form::radio('licensed_contractor', 'No' , ($user_details->licensed_contractor == 'No' )?'checked':'') }}No
		</div>
	    </div>
	      
	    <div class="form-msg">
	    <div class="input-box half residential">
                                    <label>ROC #-Residential</label>
                                    <div class='label-input'><input type="text" class="input full" name="residential" id="residential" value="{{$user_details->residential}}"></div>
                        </div>
	    
                                                                
                       
			<div class="input-box half commercial">
                                    <label>ROC #-Commercial</label>
                                    <div class='label-input'><input type="text" class="input full" name="commercial"  id="commercial" value="{{$user_details->commercial}}"></div>
                        </div></div>
                        <span class='error_lebel'></span><br><br>
	    
	    <!--<div class="input-box">
	    <br>
	    <div class="form-msg">
		<div class="input-box half">
		  <div class="checkbox">
		    {{ Form::checkbox('terms_of_service') }}
		    <label>I agree with the A&E Reprographics <a href="#">terms of service</a>.</label>
		  </div>	      
		</div>
	    </div>
	    <div class="form-msg">
	      <div class="input-box half">
		<div class="checkbox">
		  {{ Form::checkbox('privacy_policy') }}
		  <label>I agree with the A&E Reprographics <a href="#">privacy policy</a>.</label>
		</div>	      
	      </div>
	    </div>-->
	    {!! Form::submit('Update',array('class'=>'btn-srrp customer-create' , 'onclick'=>'return checkEmpty()')) !!}&nbsp;&nbsp;
	    <a href="{{ URL::route('dashboard') }}"><input type="button" class="btn-srrp cancel" value="Cancel" /></a>
	  {!! Form::close() !!}
	  
	  </div>
	<div id="my_professions" class="tab-pane fade">
	    
	    
	  {!! Form::open(array('route'=>array('update_customer_moreinfo'),'id'=>'moreinfo_edit','files'=>true)) !!}
	  {!! Form::hidden('action','Process')!!}
	    <div class="registerCheckContainer">
	      <strong>Your Profession :</strong>
	      (<span class="check_all">check all </span> || <span class="uncheck_all"> uncheck all </span>)
	      <div class="form-msg registerCheck">
	      
	      @php $profession_val = explode(',',$user_details->profession); @endphp
	      
	      @if(count($profession) > 0 )
		  @foreach($profession as $p)
		   
		   @if(count($profession_val) > 0 && in_array($p->id,$profession_val))
		     @php $checked = 'checked';@endphp
		   @else
		      @php $checked = '';@endphp
		   @endif
		      <div>{!! Form::checkbox('profession[]',$p->id,$checked,array('class'=>'input full checkbox'))!!} {!! $p->profession_title !!}</div>
		  @endforeach
	      @endif
	      </div>
	    </div>
	    <div class="registerCheckContainer">
	      <strong>CSI Division :</strong>
	      (<span class="check_all">check all </span> || <span class="uncheck_all"> uncheck all </span>)
	      <div class="form-msg registerCheck">
	      
	       @php $division_val = explode(',',$user_details->division); @endphp
	      
	      @if(count($division) > 0 )
		  @foreach($division as $d)
		    
		   @if(count($division_val) > 0 && in_array($d->id,$division_val))
		     @php $checked = 'checked';@endphp
		   @else
		      @php $checked = '';@endphp
		   @endif
		   
		      <div>{!! Form::checkbox('division[]',$d->id,$checked,array('class'=>'input full required'))!!} {!! $d->division_title !!}</div>
		  @endforeach
	      @endif
	      </div>
	    </div>
	    <div class="registerCheckContainer">
	      <strong>Construction Trades:</strong>
	      (<span class="check_all">check all </span> || <span class="uncheck_all"> uncheck all </span>)
	      <div class="form-msg registerCheck">
	      @php $trade_val = explode(',',$user_details->trade); @endphp
	      @if(count($trade) > 0 )
		  @foreach($trade as $t)
		      @if(count($trade_val) > 0 && in_array($t->id,$trade_val))
			@php $checked = 'checked';@endphp
		      @else
			 @php $checked = ''; @endphp
		      @endif
		      <div>{!! Form::checkbox('trade[]',$t->id,$checked,array('class'=>'input full required'))!!} {!! $t->trade_title !!}</div>
		  @endforeach
	      @endif
	      </div>
	    </div>
	    {!! Form::submit('Update',array('class'=>'btn-srrp' )) !!}&nbsp;&nbsp;
	    
	     <a href="{{ URL::route('dashboard') }}"><input type="button" class="btn-srrp cancel" value="Cancel" /></a>
	  {!! Form::close() !!}
	  </div>
	    
	
	@if($user_details->delete_card == 'No')
	<div id="card_details" class="tab-pane fade">
	  {!! Form::open(array('route'=>array('update_card_info'),'id'=>'credit_card_info')) !!}
          {!! Form::hidden('user_id',$user_details->id) !!}
	  {!! Form::hidden('action','Process')!!}
	    <div class="form-msg">
		<div class="input-box half">
		  <label>Card No :</label>
		  <div class='label-input'>
		   @php $card_no = strlen($user_details->card_no);
			$replacedStr="";
		   @endphp
		   
		   @if(count($card_no) > 0 )
		     @for ($i = 1; $i <= $card_no-4; $i++)
			 @php $replacedStr.="*";@endphp
		    @endfor
		   @endif
		  
		  
		  
		  {!! Form::hidden('card_number_value',$user_details->card_no,array('class'=>'input full ','id'=>'card_number_value'))!!}
		  
		  {!! Form::text('card_number',$replacedStr.substr($user_details->card_no,-4),array('class'=>'input full card-edit','id'=>'card_number','minlength' => 15,'maxlength' => 16 , 'onfocus'=>"this.select();"))!!}
		  <span class="error_lebel"></span>
		  </div>
		</div>
		<div class="input-box half">
		  <label>Expire year :</label>
		  <div class='label-input'>
		  
		  @php
		      $currentYear = date('Y');
		      $lastYear    = $currentYear + 50;
		  @endphp
		  {!! Form::selectYear('exp_year',$currentYear,$lastYear,$user_details->exp_year,array('class' => 'input half required')) !!}
		  
		  {!! Form::selectMonth('exp_month',$user_details->exp_month,array('class' => 'input half required','style'=>"width: 128px;")) !!}
		  
		  </div>
		</div>
	    </div>
	    <div class="form-msg">
		<div class="input-box half">
		  <label>CVV :</label>
		  <div class='label-input'>{!! Form::password('cvv',array('class' => 'input full required number','minlength' => 3,'maxlength' => 4)) !!}</div>
		</div>
	    </div>
	    {!! Form::submit('Update',array('class'=>'btn-srrp card-update' )) !!}&nbsp;&nbsp;
	  {!! Form::close() !!}
	</div>
	<div id="delete_card" class="tab-pane fade">
	  <p>Deleting a stored card will be disable all automatic renewal.</p>
	  <p>If you want to delete please click delete button.</p>
	  <a href="javascript:void(0);" class="btn btn-danger buttonCardDelete btn-md">Delete</a>
	  <a href="{{URL::route('planroom')}}" class="btn btn-info btn-md">Cancel</a>
	</div>
	@else
	  <div id="add_card_details" class="tab-pane fade">
	  {!! Form::open(array('route'=>array('add_card_info'),'id'=>'credit_card_info')) !!}
          {!! Form::hidden('user_id',$user_details->id) !!}
	  {!! Form::hidden('action','Process')!!}
	    <div class="form-msg">
		<div class="input-box half">
		  <label>Card No :</label>
		  <div class='label-input'>
		  {!! Form::text('card_no','',array('class'=>'input full required number','minlength' => 15,'maxlength' => 16 ))!!}
		  </div>
		</div>
		<div class="input-box half">
		  <label>Expire year :</label>
		  <div class='label-input'>
		  @php
		      $currentYear = date('Y');
		      $lastYear    = $currentYear + 50;
		  @endphp
		  {!! Form::selectYear('exp_year',$currentYear,$lastYear,'',array('class' => 'input half required')) !!}
		  
		  {!! Form::selectMonth('exp_month','',array('class' => 'input half required','style'=>"width: 128px;")) !!}
		  
		  </div>
		</div>
	    </div>
	    <div class="form-msg">
		<div class="input-box half">
		  <label>CVV :</label>
		  <div class='label-input'>{!! Form::password('cvv',array('class' => 'input full required number','minlength' => 3,'maxlength' => 4)) !!}</div>
		</div>
	    </div>
	    {!! Form::submit('Add card',array('class'=>'btn-srrp card-update' )) !!}&nbsp;&nbsp;
	  {!! Form::close() !!}
	</div>

	@endif
	<div id="subscription" class="tab-pane fade {{(\Session::has('active_sub'))?'in active':''}} {{(count($notSubscribe) == 0)?'subscriptionNotFound':''}}">
	  {!! Form::open(array('route'=>array('after_subscription_payment'),'id'=>'new_subscription_payment')) !!}
	  {!! Form::hidden('action','Process')!!}
	  <div class="db-left subscription-panel">
	  <h2>Subscribed Service</h2>
	  <ul>
	  @if(count($subscribeUser) > 0)
	    @foreach($subscribeUser as $subUser)
	      <li>
		<h4>{!! $subUser->subscription_title !!}</h4>
		<div class="subscription-section">
		<span class="subscrileSpan exp-span">Expires : {{date('m-d-Y',strtotime($subUser->end_date))}}</span>
		
		</div>
		 <p class="dis-enb-des"> 
		@if($subUser->auto_payment == 'enable')
		  Auto Renewal-Enabled: Your Card ending in {{substr($user_details->card_no, -4)}} will be charged 
		  @if($subUser->subscription_type == 'quarterly')
		  {{'$'.$subUser->quarterly_price}}
		  @else
		  {{ '$'.$subUser->yearly_price}}
		  @endif
		  on {{date('m-d-Y',strtotime('+1 day', strtotime($subUser->end_date)))}}
		@elseif($subUser->auto_payment == 'disable')
		  Auto Renewal-Disabled: You will not be automattically charged for your subscriptions
		@endif
		</p>
	<div>
	</br>
		@if($subUser->auto_payment == 'disable')
		  
		    
		  <a href="{{URL::route('renewSubscribe',$subUser->id)}}" class="subscribeLink">(renew)</a>
		@endif
		  <div class="en-dis">
		@if($subUser->auto_payment == 'enable')
		  <a data-href="{{URL::route('disableSubscription',$subUser->id)}}" class="btn_cls enable enabledisable" title="Enable">Enable</a>
		@elseif($subUser->auto_payment == 'disable')
		
		  @if($user_details->delete_card == 'No')
		  <a data-href="{{URL::route('enableSubscription',$subUser->id)}}" class="btn_cls disable enabledisable" title="Disable">Disable</a>
		  @else
		  <a href="javascript:void(0);" class="btn_cls disable" title="Disable">Disable</a>
		  @endif
		  
		@endif
		</div>
		  </div>
	      </li>
	    @endforeach
	  @endif
	  </ul>
	  </div>
	  <div class="db-right">
	  @if(count($notSubscribe) > 0)
	  <h2>Subscribe to new subscriptions</h2>
          <div id="errorTxt"></div>
	  <table id="no-more-tables" class="res-table1">
	    <thead>
	      <tr>
		<th class="numeric">Item</th>
		<th class="numeric">Quarterly price</th>
		<th class="numeric">Yearly price</th>
	      </tr>
	    </thead>
	    <tbody>
	    @foreach($notSubscribe as $ntSub)
	      {!! Form::hidden('subId[]',$ntSub->id) !!}
	      <tr>
		<td data-title="Item">{!! $ntSub->subscription_title !!}</td>
		<td data-title="PRICE" class="numeric">
		<input type="radio" name="newSubscribe_{{ $ntSub->id }}" class="newSubscribe" value="quarterly">$
		<span class="newClass">{{ $ntSub->quarterly_price }}</span>
		</td>
		<td>
		<input type="radio" name="newSubscribe_{{ $ntSub->id }}" class="newSubscribe" value="yearly">$
		<span class="newClass">{{$ntSub->yearly_price}}</span>
		</td>
	      </tr>
	    @endforeach
	    </tbody>
	    <tfoot>
	       <tr>
		<td data-title="Total">Total</td>
		<td data-title="">$<span id="newsubscriptionFee">0.00</span></td>
		<td>&nbsp;</td>
		{{Form::hidden('newsubscriptionFees')}}
	      </tr>
	    </tfoot>
	  </table>
	  {!! Form::submit('Subscribe',array('class'=>'btn-srrp')) !!}&nbsp;&nbsp;
	  {!! Form::close() !!}
	@endif
	</div>
	
	</div>
	<div id="order" class="tab-pane fade">
		<div class="report-table">
	  <div class="table_top clear">
	    <span class="number">{{count($list) }} reports</span>
	  </div>
	  <div class="table_bot clear">
	    <table id="no-more-tables" class="res-table2">
		<thead>
		  <tr>		
		    <th class="numeric">ID</th>
		    <th class="numeric">Payment Type</th>
		    <th class="numeric">Transaction Id</th>
		    <th class="numeric">Delivery Type</th>
		    <th class="numeric">Delivery Details</th>
		    <th class="numeric">Price</th>
		    <th class="numeric">Tax</th>
		    <th class="numeric">Payment Date</th>
		    <th class="numeric">Action</th>
		  </tr>
		</thead>
		<tbody>
		  @if(count($list) > 0)
                    
			@foreach($list as $l)
			<tr>
			  <td data-title="ID">{!! $l->order_id !!} </td>
			  <td data-title="Payment Type">{!! ($l->order_type == 'cod')?'Cash On Delivery':'Credit Card'; !!} </td>
			  <td data-title="Transaction Id" class="numeric">{!! ($l->transaction_id != '')?$l->transaction_id:'N/A' !!}</td>
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
				      <b>City:</b>{!! ($l->city != '')?$l->city:'N/A'; !!} <br>
				      <b>State:</b>{!! (count($l->state_name) > 0)?$l->state_name->state:'N/A' !!} <br>
				      <b>Zip:</b>{!! ($l->zip != '')?$l->zip:'N/A'; !!} <br>
			  @endif
			  </td>
			  <td data-title="Price">{!! $l->total_price !!}</td>
			  <td data-title="Tax">{!! ($l->tax != '')?number_format($l->tax,2):'N/A' !!}</td>
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
		
		<h3><strong>User Subscription Details</strong></h3>
	       <table id="no-more-tables" class="res-table2">
		<thead>
		  <tr>		
		    <th class="numeric">Payment Date</th>
		    <th class="numeric">Subscription Title</th>
		    <th class="numeric">Subscription Type</th>
		    <th class="numeric">Total Amount</th>
		    <th class="numeric">Type</th>
		     <th class="numeric">Details</th>
		    <!--<th class="numeric">Subscription Id</th>
		    <th class="numeric">Customer Profile Id</th>
		    <th class="numeric">Customer Payment Profile Id</th>-->
		    
		  </tr>
		</thead>
		<tbody>
		@if(count($user_payment_details) > 0)
                  @foreach($user_payment_details as $ul)
		    <tr>
		      <td>{{ Date('m-d-Y',strtotime($ul->created_at)) }}</td>
		      <td>{{ $ul->subscription->subscription_title }}</td>
		      <td>{{ $ul->subscription_type }}</td>
		      <td>${{ number_format($ul->total_amount,2) }}</td>
		      <td>{{ $ul->type }}</td>
		      <td><a class="btn btn-info" href="{{URL::route('subscription-details-pdf',$ul->id)}}">Details Invoice Page</a></td>
		      <!--<td>{{ $ul->subscriptionId }}</td>
		      <td>{{ $ul->customerProfileId }}</td>
		      <td>{{ $ul->customerPaymentProfileId }}</td>-->
		     
		    </tr>
		  @endforeach
		  @else
		    <tr>
		      <td colspan="9">--No Record Found--</td>
		    </tr>
		  @endif
		</tbody>
	      </table>
	      
	      
          </div>
	  
	</div>

	</div>
	</div> 
	</div>
      </div>
    </div>
  </div>

@endsection