@if(!Session::has('PRIVATE_COMPANY_DETAILS') && !Session::has('PRIVATE_USER_DETAILS') )
<div class="container">
      <ul class="ftrcol">
	<li>
	  @if( Session::has('successMail') )
                        <p class='text-green success-msg'>{!!Session::get('successMail')!!}</p>
         @endif
	  <h3><strong>Get Free</strong> Consultation </h3>
	  <p>Tell us what you would like to know, we would be happy to help you with any questions you may have!</p>
	  {!! Form::open(array('route'=>array('free_consultant_action'),'id'=>'free_consultant')) !!}
	    <div class="main-div clear">
		  <div class="sub-div">{!! Form::text('name','',array('class'=>'input input-half required','placeholder'=>'Your Name'))!!}</div>
		  <div class="sub-div">{!! Form::email('email','',array('class'=>'input input-half required','placeholder'=>'Your Email'))!!}</div>
	    </div>
	    <div class="sub-div">{!! Form::text('phone','',array('class'=>'input input','placeholder'=>'Phone Number'))!!}</div>
	    <div class="sub-div">{!! Form::textarea('message','',array('class'=>'input required','placeholder'=>'Your Message'))!!}</div>
	    <div class="sub-div">{!! Form::submit('Submit',array('class'=>'btn-submit' )) !!}</div>
	  {!! Form::close()!!}	  
	</li>
	
	<li>
	  <h3><strong>3 Great</strong>Locations</h3>
	  <ul class="location" id="accordion">
	    <li>
		<h4 class="acc-head">Northern Prescott</h4>
		<div class="holder">
		  <span>1030 Sandretto Dr Ste F <br />Prescott, AZ 86305</span>
		  <span><a href="tel:9284429116">(928) 442-9116 </a></span>	
		  <span>(928) 776-1550</span>
		</div>
	    </li>
	    <li>
	      <h4 class="acc-head">Downtown Prescott</h4>
		  <div class="holder">
		  <span>222 S Montezuma St <br />Prescott, AZ 86303</span>
		  <span><a href="tel:9284453815 ">(928) 445-3815 </a></span>
		  <span>(928) 776-8892</span>
		</div>
	      <!--<div class="holder">
		<p>Praesent sagittis risus nisi, a fermentum tellus aliquam vel. Ut faucibus, mauris quis fermentum placerat </p>
	      </div>-->
	    </li>
	    <li>
	      <h4 class="acc-head">Prescott Valley</h4>
		  <div class="holder">
		  <span>8098 E Valley Rd, Suite 1  <br />Prescott Valley, AZ 86314</span>
		  <span><a href="tel:9287720054">(928) 772-0054</a></span>
		  <span>(928) 772-0005</span>
		</div>
	       <!--<div class="holder">
		<p>Praesent sagittis risus nisi, a fermentum tellus aliquam vel. Ut faucibus, mauris quis fermentum placerat </p>
	      </div>-->
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
	      <li><a target="_blank" href="https://www.facebook.com/AE.Reprographics/">facebook</a></li>
	      <li><a target="_blank" href="https://plus.google.com/u/0/108301750702305927651">googleplus</a></li>
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
@endif