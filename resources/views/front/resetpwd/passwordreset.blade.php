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
	  
	  
	  
	            
         
	    {!! Form::open(array('id'=>'password_reset', 'class' => 'forgotForm_action' , 'route' => array('user_password_update',$token))) !!}
	    <div class="form-msg">
	    <div class="input-box">
	      <label>Password :</label>
	      {!! Form::password('password',array('class'=>'input full required userPassword' , 'id'=>'password' , 'placeholder'=>'Password')) !!}
	      <div id="userPasswordErrSpan"></div>
	    </div>
	    </div>
            
	    <div class="form-msg">
            <div class="input-box">
	      <label>Confirm Password :</label>
	      {!! Form::password('password_confirmation',array('required', 'class'=>'input full required password' , 'id'=>'password_confirmation' , 'placeholder'=>'Confirm Password')) !!}	      
	    </div>
	    </div>
	    
	    {!! Form::submit('Change Password',array('class'=>'btn-srrp' )) !!}&nbsp;&nbsp;
	    
	    {!! Form::close() !!}
          
          <p>
            <a class="signup" href="{{ URL::route('login') }}">Login</a><br><br>
            <a title="Are you lost?" class="fg-pass" href="{{ URL::route('planroom') }}"> Back to A&E Reprographics, Inc.</a>
          </p>
	</div>
      </div>
      </div>
    </div>
  </div>
          

@endsection