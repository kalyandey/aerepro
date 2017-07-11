@extends('front.app')
@section('content')
      <div class="container">
      <div class="deshboard breport clear register-customer-profile">
	<h3><strong>Register</strong></h3>
	<strong>Please register below:</strong>	
	<br />
	<div class="form-report clear">
	  
	  @if (count($errors) > 0)
	      <div class="alert alert-danger">
		  <ul>
		      @foreach ($errors->all() as $error)
			  <li class="text-red error-msg">{{ $error }}</li>
		      @endforeach
		  </ul>
	      </div>
	      <br>
	  @endif
	  
	  {!! Form::open(array('route'=>array('register_post'),'id'=>'register_post','files'=>true,'class'=>'signupForm')) !!}
	    <div class="form-msg">
	      
	      <div class="input-box half">
		<label>Email :</label>
		<div class='label-input'>{!! Form::text('email','',array('class'=>'input full required'))!!}</div>	      
	      </div>
	      
	    </div>
	    <div class="form-msg">
		<div class="input-box half">
		  <label>Password :</label>
		  <div class='label-input'>
		  {!! Form::password('password',array('class'=>'input full userPassword','id'=>'password'))!!}
		  <div id="userPasswordErrSpan"></div>
		  </div>
		  
		</div>
		<div class="input-box half">
		  <label>Retype Password :</label>
		  <div class='label-input'>{!! Form::password('retypepassword',array('class'=>'input full'))!!}</div>
		</div>
	    </div>
	    <div class="form-msg">
		<div class="input-box half">
		  <label>Business Name :</label>
		  <div class='label-input'>{!! Form::text('business_name','',array('class'=>'input full'))!!}</div>
		</div>
	    </div>
	    <div class="form-msg">
		<div class="input-box half">
		  <label>Phone :</label>
		  <div class='label-input'>{!! Form::text('phone','',array('class'=>'input full','id'=>'phone'))!!}</div>
		</div>
		<div class="input-box half">
		  <label>Fax :</label>
		  <div class='label-input'>{!! Form::text('fax','',array('class'=>'input full','id'=>'fax'))!!}</div>
		</div>
	    </div>
	    <div class="form-msg">
		<div class="input-box half">
		  <label>Website URL :</label>
		  <div class='label-input'>{!! Form::text('website_url','',array('class'=>'input full'))!!}</div>
		</div>
	    </div>
	    <div class="form-msg">  
		  <div class="input-box half">
		    <label>First Name :</label>
		    <div class='label-input'>{!! Form::text('first_name','',array('class'=>'input full'))!!}</div>
		  </div>
		  <div class="input-box half">
		    <label>Last Name :</label>
		    <div class='label-input'>{!! Form::text('last_name','',array('class'=>'input full'))!!}</div>
		  </div>
	    </div>
	    <div class="form-msg"> 
		<div class="input-box half">
		  <label>Address Line 1 :</label>
		  <div class='label-input'>{!! Form::text('addess_line1','',array('class'=>'input full'))!!}</div>
		</div>
		<div class="input-box half">
		  <label>Address Line 2 :</label>
		  <div class='label-input'>{!! Form::text('addess_line2','',array('class'=>'input full'))!!}</div>
		</div>
	    </div>
	    <div class="form-msg">
		<div class="input-box half">
		  <label>City :</label>
		  <div class='label-input'>{!! Form::text('city','',array('class'=>'input full'))!!}</div>
		</div>
		<div class="input-box half">
		  <label>State / Province / Region :</label>
		  <div class='label-input'>{!! Form::select('state',$state, '' ,array('class'=>'input full'))!!}</div>
		</div>
	    </div>
	    <div class="form-msg">
		<div class="input-box half">
		  <label>ZIP :</label>
		  <div class='label-input'>{!! Form::text('zip','',array('class'=>'input full'))!!}</div>
		</div>
	    </div>
	    <div class="form-msg">
		<div class="input-box half">
		  <label>Are you a licensed contractor?</label>
		  {{ Form::radio('licensed_contractor', 'Yes') }}Yes
		  {{ Form::radio('licensed_contractor', 'No') }}No
		</div>
	    </div>
	    
	    <div class="form-msg">
	    <div class="input-box half residential">
                                    <label>ROC #-Residential</label>
                                    <div class='label-input'><input type="text" class="input full" name="residential" id="residential" value=""></div>
                        </div>
	    
                                                                
                       
			<div class="input-box half commercial">
                                    <label>ROC #-Commercial</label>
                                    <div class='label-input'><input type="text" class="input full" name="commercial"  id="commercial" value=""></div>
                        </div></div>
                        <span class='error_lebel'></span>  
	    
	    
	    <div class="input-box">
	    <br>
	    <div class="form-msg">
		<div class="input-box half">
		  <div class="checkbox">
		    {{ Form::checkbox('terms_of_service') }}
		    <label>I agree with the A&E Reprographics <a href="{{Config::get('constant.w_link').'terms-of-service'}}" target="_blank">terms of service</a>.</label>
		  </div>	      
		</div>
	    </div>
	    <div class="form-msg">
	      <div class="input-box half">
		<div class="checkbox">
		  {{ Form::checkbox('privacy_policy') }}
		  <label>I agree with the A&E Reprographics <a href="{{Config::get('constant.w_link').'privacy-policy'}}" target="_blank">privacy policy</a>.</label>
		</div>	      
	      </div>
	    </div>
	    {!! Form::submit('Register',array('class'=>'btn-srrp customer-create' , 'onclick'=>'return checkEmpty()' )) !!}&nbsp;&nbsp;
	  {!! Form::close() !!}	  
	</div>
      </div>
    </div>
  </div>

@endsection