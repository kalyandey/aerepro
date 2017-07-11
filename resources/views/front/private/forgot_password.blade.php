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
	  
	  @if(Session::has('error'))
	  <p class='error-msg'>{!! Session::get('error') !!}</p>
	  @endif
	  
	  @if(Session::has('success'))
	  <p class='text-green success-msg'>{!! Session::get('success') !!}</p>
	  @endif
	  
	  
	<div>
	<h3><strong>Forgot Password</strong></h3>
	<br />
	<p>
	 @if(file_exists(public_path('uploads/private_planroom/company_logo/thumb/'.$company->logo)) && $company->logo != '')
	  <img src="{{asset('uploads/private_planroom/company_logo/thumb/'.$company->logo)}}">
	 @endif
	</p>
	<div class="form-report clear">
	  {!! Form::open(array('route'=>array('private_forgot_password',$company->company_slug),'id'=>'login','class'=>'login-form resend-form')) !!}
	  
	  <div>
	  <div class="form-msg">
	  <p>Please enter your email address</p>
	    <div class="input-box full resend-mail">
	    <div class="l1">
	      <label>Email :</label>
		</div>
		  <div class="l2">
		  {!! Form::email('email','',array('class'=>'input full required'))!!}
	      </div>
	    </div>
	  </div>
	    {!! Form::submit('Submit',array('class'=>'btn-srrp' )) !!}&nbsp;&nbsp;
	    <a href="{{ URL::route('private_planroom_login',$company->company_slug) }}"><input type="button" class="btn-srrp cancel" value="Cancel" /></a>
	  </div>
	  {!! Form::close() !!}
	</div>
      </div>

      </div>
    </div>
@endsection