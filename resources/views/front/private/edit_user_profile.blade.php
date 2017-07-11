@extends('front.app')
@section('content')
      <div class="container">
      <div class="deshboard breport clear edit-customer-profile private-box">
	<h3><strong>Edit Profile</strong></h3>
	
	<div class="welcomePan clear">
	      <div class="welcomeTxt alignleft">
		 <h4>Welcome to My PlanRoom Private Projects.</h4>
	      </div>
	      @include('front.private.user_menu')
	   </div>
	   <br />
	   
	<div class="form-report clear">
	  
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
	  @if(Session::has('error'))
	  <p class='text-red error-msg'><span>{!! Session::get('error') !!}</span></p>
	  @endif
	  
	  {!! Form::open(array('route'=>array('profile_edit_for_user',$company->company_slug),'id'=>'edit_profile','files'=>true ,'class'=>'btnAlgn')) !!}
	    <div class="form-msg">
	      
	      <div class="input-box half">
		<label>Email :</label>
		{!! $user->email!!}	      
	      </div>
	      
	    </div>
	    <div class="form-msg">  
		  <div class="input-box half">
		    <label>First Name :</label>
		    <div class='label-input'>{!! Form::text('first_name',$user->first_name,array('class'=>'input full'))!!}</div>
		  </div>
		  <div class="input-box half">
		    <label>Last Name :</label>
		    <div class='label-input'>{!! Form::text('last_name',$user->last_name,array('class'=>'input full'))!!}</div>
		  </div>
	    </div>
	    <!--<div class="form-msg">
		<div class="input-box half">
		  <label>Password :</label>
		  <div class='label-input'>{!! Form::password('password',array('class'=>'input full','id'=>'password'))!!}</div>
		</div>
		<div class="input-box half">
		  <label>Retype Password :</label>
		  <div class='label-input'>{!! Form::password('password_confirmation',array('class'=>'input full'))!!}</div>
		</div>
		<span class="password-text">[Password and Retype Password will be blank if you don't want to change password]</span>
	    </div>-->
	    <div class="form-msg">
		<div class="input-box half">
		  <label>Phone :</label>
		  <div class='label-input'>{!! Form::text('phone',$user->phone,array('class'=>'input full','id'=>'phone'))!!}</div>
		</div>
	    </div>
	    <div class="form-msg"> 
		<div class="input-box half">
		  <label>Address :</label>
		  <div class='label-input'>{!! Form::textarea('address',$user->address,array('class'=>'input full'))!!}</div>
		</div>
	    </div>
	    {!! Form::submit('Update',array('class'=>'btn-srrp' )) !!}&nbsp;&nbsp;
	    <a href="{{ URL::route('public_planroom_list_for_user',[$company->company_slug]) }}">
	    <input type="button" class="btn-srrp cancel" value="Cancel" /></a>
	  {!! Form::close() !!}
	  
	</div>
      </div>
    </div>
  </div>

@endsection