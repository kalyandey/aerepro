@extends('front.app')
@section('content')
    <div class="container">
      <div class="deshboard breport clear log-in-page">
          @if (count($errors) > 0)
	      @foreach ($errors->all() as $error)
		  <!--<li>{{ $error }}</li>-->
	      @endforeach
	  @endif
	  
	  @if(isset($error) && $error != '')
	    <p class="error-msg"><span>{!! $error !!}</span></p>
	  @endif
	  
	  @if(Session::has('success'))
	  <p class='text-green success-msg'>{!! Session::get('success') !!}</p>
	  @endif
	  <div>
	  <h3><strong>Reset Password</strong></h3>
	  <br />
	  <p>
	   @if(file_exists(public_path('uploads/private_planroom/company_logo/thumb/'.$company->logo)) && $company->logo != '')
	    <img src="{{asset('uploads/private_planroom/company_logo/thumb/'.$company->logo)}}">
	   @endif
	  </p>
	  <div class="form-report clear">
	    {!! Form::open(array('route'=>array('private_reset_password',$company->company_slug,$token),'id'=>'login','class'=>'login-form resetform')) !!}
	    <!--<p>Please enter your email address</p>-->
	      <div class="form-msg">
	      <div class="input-box half">
		<label>Password :</label>
		    {!! Form::password('password',array('class'=>'input full required userPassword'))!!}
		    <div id="userPasswordErrSpan"></div>
		</div>
	      <div class="input-box half">
		<label>Re-enter password :</label>
		    {!! Form::password('retypepassword',array('class'=>'input full required'))!!}
		</div>
	      </div>
	      {!! Form::submit('Submit',array('class'=>'btn-srrp' )) !!}&nbsp;&nbsp;
	      <a href="{{ URL::route('private_planroom_login',$company->company_slug) }}"><input type="button" class="btn-srrp cancel" value="Cancel" /></a>
	    {!! Form::close() !!}
	  </div>
	</div>

      </div>
    </div>
@endsection