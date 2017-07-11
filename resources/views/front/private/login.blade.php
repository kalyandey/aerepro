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
	<h3><strong>Welcome</strong></h3>
	<br />
	<p>
	 @if(file_exists(public_path('uploads/private_planroom/company_logo/thumb/'.$company->logo)) && $company->logo != '')
	  <img src="{{asset('uploads/private_planroom/company_logo/thumb/'.$company->logo)}}">
	 @endif
	</p>
	<p>If you're already registered, please login.</p>
	<div class="form-report clear">
	  {!! Form::open(array('route'=>array('private_planroom_login',$company->company_slug),'id'=>'login','class'=>'login-form')) !!}
	  
	  <div class="form-msg">
	    <div class="input-box half">
	      <label>Email :</label>
	      {!! Form::email('email','',array('class'=>'input full required'))!!}	      
	    </div>
	    <div class="input-box half">
	      <label>Password :</label>
	      {!! Form::password('password',array('class'=>'input full required'))!!}
	    </div>
	  </div>
	    {!! Form::submit('Login',array('class'=>'btn-srrp' )) !!}&nbsp;&nbsp;
	   
	     <a href="{{ URL::route('private_forgot_password',[$company->company_slug]) }}"><input type="button" class="btn-srrp cancel" value="Forgot password" /></a>
	  {!! Form::close() !!}
	</div>
      </div>
      </div>
    </div>
  </div>

@endsection