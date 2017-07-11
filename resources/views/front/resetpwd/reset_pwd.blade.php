@extends('front.app')
@section('content')
      <div class="container">
      <div class="deshboard breport clear log-in-page">
       @if (count($errors) > 0)
	      <div class="alert alert-danger">
		  <ul>
		      @foreach ($errors->all() as $error)
			  <li>{{ $error }}</li>
		      @endforeach
		  </ul>
	      </div>
	  @endif
	  
	            @if( Session::has('errorMessage') )
                        <p class='text-red error-msg'><span>{{Session::get('errorMessage')}}</span></p>
                    @endif
                    
                    @if( Session::has('successMessage') )
                        <p class='text-green success-msg'><span>{{Session::get('successMessage')}}</span></p>
                    @endif
		    
		    	<div>
	<h3><strong>Reset Password</strong></h3>
	<br />
	
	<div class="form-report clear form-col12">
	  {!! Form::open(array('route'=>array('user_forgotpwd_action'),'id'=>'login','class'=>'login-form resend-form')) !!}
	  <div>
	  <div class="form-msg">
	    <p>Please enter your email address. You will receive a link to create a new password via email.</p>
	    <div class="input-box full resend-mail">
	    <div class="l1"><label>Email :</label></div>
	    <div class="l2">{!! Form::text('email','',array('id'=>'email','placeholder'=>'Email','class'=>'input full required email'))!!}</div>
	    </div>
	    
	    </div>
	    {!! Form::submit('Get New Password',array('class'=>'btn-srrp get' )) !!}&nbsp;&nbsp;
	    <a href="{{ URL::route('dashboard') }}"><input type="button" class="btn-srrp cancel" value="Cancel" /></a>
	   <p>
	     <a class="signup" href="{{ URL::route('login') }}">Login</a><br><br>
	     <a title="Are you lost?" class="fg-pass" href="{{ URL::route('planroom') }}"> Back to A&E Reprographics, Inc.</a>
	   </p>
	  </div>
	  {!! Form::close() !!}
	</div>
      </div>

    </div>
  </div>

@endsection