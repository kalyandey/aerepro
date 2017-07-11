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
	<p>If you're already registered, please login.</p>
	<div class="form-report clear">
	  {!! Form::open(array('route'=>array('login'),'id'=>'login','class'=>'login-form')) !!}
	  
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
	   
	     <a href="{{ URL::route('dashboard') }}"><input type="button" class="btn-srrp cancel" value="Cancel" /></a>
	  {!! Form::close() !!}
	  
	  <p>Please register today to subscribe to the Planroom. Learn more here.</p>
	  
	  <a href="{{ URL::route('planroom').'#planroom-signup' }}"><input type="button" class="btn-srrp register" value="Register Here" /></a>
	  
	</div>
      </div>
      </div>
    </div>
  </div>

@endsection