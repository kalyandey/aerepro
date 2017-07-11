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
	  
	  @if(isset($error) && $error != '')
	    <p class="error-msg"><span>{!! $error !!}</span></p>
	  @endif
	<div>
	<h3><strong>Resend mail</strong></h3>
	<br />
	
	<div class="form-report clear">
	  {!! Form::open(array('route'=>array('resendMail',$token),'id'=>'login','class'=>'login-form resend-form')) !!}
	  <div>
	  <div class="form-msg">
	  <p>Please enter your email address</p>
	    <div class="input-box full resend-mail">
	    <div class="l1">
	      <label>Email :</label>
		</div>
		  <div class="l2">
	      {!! Form::email('resend_email','',array('class'=>'input full required'))!!}
	      </div>
	    </div>
	  </div>
	    {!! Form::submit('Send',array('class'=>'btn-srrp' )) !!}&nbsp;&nbsp;
	    <a href="{{ URL::route('planroom') }}"><input type="button" class="btn-srrp cancel" value="Cancel" /></a>
	  </div>
	  {!! Form::close() !!}
	</div>
      </div>

      </div>
    </div>
@endsection