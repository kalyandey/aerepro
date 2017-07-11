<div class="container">
      <ul class="ftrcol">
	<li>
	  @if( Session::has('success') )
                        <p class='text-green forgot-success-msg'>{{Session::get('success')}}</p>
         @endif
	  <h3><strong>Get Free</strong> Consultation </h3>
	  <p>Praesent sagittis risus nisi, a fermentum tellus aliquam vel. Ut faucibus, mauris quis fermentum placerat </p>
	  {!! Form::open(array('route'=>array('free_consultant_action'),'id'=>'free_consultant')) !!}
	    {!! Form::text('name','',array('class'=>'input input-half required','placeholder'=>'Your Name'))!!}
	    {!! Form::text('email','',array('class'=>'input input-half required','placeholder'=>'Your Email'))!!}
	    {!! Form::text('phone','',array('class'=>'input input','placeholder'=>'Phone Number'))!!}
	    {!! Form::textarea('message','',array('class'=>'input required','placeholder'=>'Your Message'))!!}
	    {!! Form::submit('Submit',array('class'=>'btn-submit' )) !!}
	  {!! Form::close()!!}	  
	</li>
	
	<li>
	  <h3><strong>3 Great</strong>Locations</h3>
	  <ul class="location" id="accordion">
	    <li>
		<h4 class="acc-head">Northern Prescott</h4>
		<div class="holder">
		  <span>030 Sandretto Dr Ste F <br />Prescott, AZ 86305</span>
		  <span>(928) 776-1550</span>
		  <span><a href="tel:9284429116">(928) 442-9116 </a></span>
		</div>
	    </li>
	    <li>
	      <h4 class="acc-head">Downtown Prescott</h4>
	      <div class="holder">
		<p>Praesent sagittis risus nisi, a fermentum tellus aliquam vel. Ut faucibus, mauris quis fermentum placerat </p>
	      </div>
	    </li>
	    <li>
	      <h4 class="acc-head">Prescott Valley</h4>
	       <div class="holder">
		<p>Praesent sagittis risus nisi, a fermentum tellus aliquam vel. Ut faucibus, mauris quis fermentum placerat </p>
	      </div>
	    </li>	 
	  </ul>	  
	</li>
	
	<li>
	  <div class="hours">
	    <h3><strong>Operating</strong>Hours</h3>
	    <p>M-F 8:00 AM-5:00PM</p> 
	    <p>Closed Saturday and Sunday</p>
	  </div>
	  <div class="social2">
	    <h3><strong>Social</strong>Networking</h3>
	    <ul>
	      <li><a href="#">facebook</a></li>
	      <li><a href="#">googleplus</a></li>
	    </ul>
	  </div>
	</li>
      </ul>      
    </div>
    <div class="copyright">
      <div class="container">
	<p> &copy; {{date('Y')}} A&E Reprographics.com.  All Rights Reserved.</p>
      </div>
    </div>