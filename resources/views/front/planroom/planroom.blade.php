@extends('front.app')
@section('content')
        <div class="container">
      <div class="planroom clear">
	<div class="left">
	  @if((!Session::has('USER_DETAILS') && Session::get('USER_DETAILS') == '') && (!Session::has('PRIVATE_COMPANY_DETAILS') && Session::get('PRIVATE_COMPANY_DETAILS') == '') && (!Session::has('PRIVATE_USER_DETAILS') && Session::get('PRIVATE_USER_DETAILS') == ''))
	  <h4>Are you a returning Planroom customer? Use the form below to login:</h4>
	   {!! Form::open(array('route'=>array('login'),'id'=>'login_header','class'=>'pl-login')) !!}
	    <div class="caol-half">
	      <label>Login:</label>
	      {!! Form::email('email','',array('class'=>'input required')) !!}
	    </div>
	    <div class="caol-half">
	      <label>password:</label>
	      {!! Form::password('password',array('class'=>'input required')) !!}
	    </div>
	    {!! Form::submit('Login',array('class'=>'btn-pllogin' )) !!}
	  {!! Form::close() !!}
	  <p><a class="signup" href="#planroom-signup">Sign up below</a> | or <a class="fg-pass" href="{{ URL::route('reset-password') }}">reset your password</a></p>
	  @endif
	  <p>PlanRoom Central helps contractors, sub contractors, tradesmen, realtors, architects, engineers suppliers and homeowners bridge the connections to each other.  Each of these individuals or groups may need the services or products of one another during the pre-construction process.  We are proud to be able to connect these people with each other and provide additional services in a way that no other company can.</p>
	  <p>PlanRoom Central is a one of a kind company, in the sense that no other company provides as many high quality services as we do in an effort to help on the front end of construction projects.  That is, the planning, construction bidding services, providing prints and distributing information.</p>
	  <p>As PlanRoom Central continues to grow and develop we hope that you and your company can be part of our success and we can be part of yours.  Contact us for a personalized free demonstration of this great service.</p>
	  <div id="planroom-signup">
	  <h4>Planroom Sign up</h4>
	  <strong>We welcome you to join our Plan room where we have available the following features :</strong>
	  <ul class="p-list">
	    <li>Project List - where you can track and categorize projects you are interested in.</li>
	    <li>Building Reports, Yavapai County or Coconino County - search for building reports according to certain
      criteria and quickly find the jobs you wish to bid on.</li>
	  </ul>
	  
	 
	  {!! Form::open(array('route'=>array('subscription_action'),'id'=>'subscription-form','class'=>'table_chkbox')) !!}
	  <table id="no-more-tables" class="res-table1">
	    <thead>
	      <tr>		
		<th class="numeric">Item</th>
		<th class="numeric">{!! Form::radio('subscription','quarterly') !!}QUARTERLY PRICE</th>
		<th class="numeric">{!! Form::radio('subscription','yearly') !!}YEARLY PRICE</th>		
	      </tr>
	    </thead>
	    <tbody>
	    @if(count($subscription_list) > 0)
	      @foreach($subscription_list AS $subscription)
	      <tr>
		<td data-title="Item">{{ $subscription->subscription_title }}</td>
		<td data-title="QUARTERLY PRICE"><input type="checkbox" class="subscriptionQuarterly" name="subscriptionQuarterly[]" value="{{ $subscription->id }}" data-attr="{{ $subscription->quarterly_price }}"> ${{ $subscription->quarterly_price }}</td>
		<td data-title="YEARLY PRICE" class="numeric"><input type="checkbox" class="subscriptionYearly"  name="subscriptionYearly[]" value="{{ $subscription->id }}" data-attr="{{ $subscription->yearly_price }}"> ${{ $subscription->yearly_price }}</td>		
	      </tr>
	      @endforeach
	    @endif
	    </tbody>
	    <tfoot>
	       <tr>
		<td data-title="Total">Total</td>
		<td data-title="">$<span id="totalSubscriptionFee">0.00</span></td>
		<td data-title="">&nbsp;</td>
		{{Form::hidden('total_amount')}}
	      </tr>
	    </tfoot>
	  </table>
	    <span class="err-msg" id="subscriptin_err_msg"></span>
	  <a href="javascript:;" class="btn-register">Register Here</a>
	{!! Form::close() !!}
	  </div>
	</div>
	  
	<div class="right">
	  <ul class="aside-list">
	    <li class="pr-access">	      
	      <img src="images/plan-img.png" alt="img" />
	      <h3>Planroom Access</h3>
	      @if(Session::has('USER_DETAILS') && Session::get('USER_DETAILS')->id != '')
		<a href="{{URL::route('logout')}}" class="praccess-login">Logout</a>
	      @else
	      <a href="{{URL::route('login')}}" class="praccess-login">Login</a>
	      @endif
	      <a href="#planroom-signup" class="praccess-scrib" >Subscribe</a>	      
	    </li>
	    <li class="view"><img src="{{asset('images/plan-add.jpg')}}" alt="img" />
		<a class="service" href="{{Config::get('constant.w_link').'printing-services'}}">View Printing Services</a>
		<a class="graphic" href="{{Config::get('constant.w_link').'signs-and-graphics'}}">View Signs and Graphics</a>
	    </li>
	  </ul>
	  
	</div>
	
      </div>
    </div>

@endsection 