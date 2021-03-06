@extends('front.app')
@section('content')
      <div class="container">
      
      <div class="deshboard breport clear log-in-page changepwd">
          
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
                        <p class='text-green success-msg'><span>{{Session::get('success')}}</span></p>
          @endif
           @if( Session::has('error') )
                        <p class='text-red error-msg'><span>{{Session::get('error')}}</span></p>
          @endif
      <div>
	<h3><strong>Change Password</strong></h3>
	
	<div class="form-report clear">
	  {!! Form::open(array('route'=>array('private_change_password',Session::get('COMPANY_SLUG')),'id'=>'chnge_pwd','files'=>true)) !!}
	   <div class="form-msg">
	      
	      <div class="input-box half">
		<label>Old Password :</label>
		{!! Form::password('old_password',array('class'=>'input full','id'=>'old_password'))!!}	      
	      </div>
	      
	    </div>
	    <div class="form-msg">
		<div class="input-box half">
		  <label>Password :</label>
		  {!! Form::password('password',array('class'=>'input full userPassword','id'=>'password'))!!}
		  <div id="userPasswordErrSpan"></div>
		</div>
		
	    </div>
            
            <div class="form-msg">
            <div class="input-box half">
		  <label>Retype Password :</label>
		  {!! Form::password('retypepassword',array('class'=>'input full' , 'id'=>'retypepassword'))!!}
		  
		</div>
            </div>

	    {!! Form::submit('Change Password',array('class'=>'btn-srrp' )) !!}&nbsp;&nbsp;
	    @if(Session::has('PRIVATE_COMPANY_DETAILS') && Session::get('PRIVATE_COMPANY_DETAILS')->id != '')
		      
		  <a href="{{URL::route('public_planroom_list_for_company',Session::get('COMPANY_SLUG'))}}" class="reset">Back</a>
		    
		@else
		    <a href="{{URL::route('public_planroom_list_for_user',Session::get('COMPANY_SLUG'))}}" class="reset">Back</a>
		    @endif
	  {!! Form::close() !!}	  
	</div>
      </div>
      </div>
    </div>
  </div>

@endsection