@extends('front.app')
@section('content')
   <div class="container">
      <div class="deshboard clear">
	<h3><strong>Planroom</strong> Dashboard</h3>
        <strong class="welcome">Welcome <a href="{{URL::route('edit_customer_profile')}}"><span>{{Session::get('USER_DETAILS')->first_name.' '.Session::get('USER_DETAILS')->last_name}}</span></a></strong>
	@if(count(\Cart::content()) > 0)
	<a href="{{URL::route('my_cart')}}" class="cart"> {{ count(\Cart::content())}} Cart item</a>
	@endif
	<br />
	<div class="inner-wraper clear">
	  <div class="db-left subscription-panel">
	  <h2>Subscribed Service</h2>
	    
		
	 @if(count($subscripe)>0)
	   <ul>
	   @foreach($subscripe as $s)
	    <li>
	   <h4>{!! $s->subscription_title !!}</h4>
	   <div class="subscription-section">
	   @php $sub = $s->subscriptionUser(Session::get('USER_DETAILS')->id,$s->id); @endphp
	   @if(count($sub) > 0)
	   <span class="subscrileStatus {!! $sub->status !!}">{!! $sub->status !!}</span>
	   <span class="subscrileSpan">Expires : {!! date('m/d/y',strtotime($sub->end_date)) !!}</span>
	   @if($sub->auto_payment == 'disable')
	      <a href="{{URL::route('renewSubscribe',$sub->id)}}" class="subscribeLink">(Renew)</a>
	   @endif
	   
	   @else
	   <span class="subscrileStatus inactive">Inactive</span>
	   <span class="subscrileSpan">No subscription</span>
	   <a href="{{URL::route('edit_customer_profile').'#subscription'}}" class="subscribeLink">Subscribe</a>
	   
	   @endif
	   </div>
	     </li>
	   @endforeach
	  
	   </ul>
	 @endif
	      
	    
	    
	  </div>
	  <div class="db-right">
	    <ul class="clear">
	      <li>
		<div class="bx-wraper">
		  <div class="rp-left">
		    <strong>Building Reports</strong>  
		  </div>		
		  <a class="dash-ip" href="{{URL::route('building_report')}}"><img src="{{asset('images/rimg1.png')}}" alt="img" /></a>
		  <div class="rp-area">
		    @if($newPermit > 0)
		    <p>{{$newPermit}} New permits issued in the last week.</p>
                    @else
                    <p>No permits issued in the last week.</p>
		    @endif
		  </div>
		</div>
	      </li>
	      
	      <li>
		<div class="bx-wraper red">
		  <div class="rp-left">
		    <strong>Project Calendar</strong>		    
		    <strong class="rp-date">{{$today_day}}<span>{{$today_dayname}}</span></strong>
		  </div>		
		  <a class="dash-ip" href="{{URL::route('calendar')}}"><img src="{{asset('images/rimg2.png')}}" alt="img" /></a>
		  <div class="rp-area">
		    <p>
		      <strong>In the next 30 days:</strong>      
		    </p>
		      <div class="no-tl clear">
                        @php
                        $i = 1
                        @endphp	
                        @if(count($projectCalendar) > 0)
                        @foreach($projectCalendar as $val)
                        @php
                        $bid_close_date = explode('-',$val->project->bid_close_date);
                        $bid_close_date  = $bid_close_date[1].'/'.$bid_close_date[2].'/'.$bid_close_date[0];
                        @endphp
                        <span class="no-tl-hold" data-val="{{$i}}">{!! $val->project->project_id  !!}
                        <div class="tooltip">
                        <span class="tltp"> {!! $val->project->name  !!}
                        <span class="bid">bid date-{{$bid_close_date}}</span>
                        </div>	
                        </span>    
                        @php			    	
                        $i++
                        @endphp	
                        @endforeach
                        @else
                        <span>No Tracked Projects Due Soon</span>
                        @endif
                          
                          
                       
		      </div>
		  </div>
		</div>
	      </li>
	      
	      <li>
		<div class="bx-wraper red">
		  <div class="rp-left">
		    <strong>Saved Tracking List</strong>		    
		    <strong class="rp-date">{{$saveTrackCount}}<span>Saved tracking</span></strong>
		  </div>		
		  <a class="dash-ip" href="{{URL::route('saved_tracking_list')}}"><img src="{{asset('images/rimg3.png')}}" alt="img" /></a>
		  <div class="rp-area">
		    <p>
		      @if(count($saveTrack) > 0)
			@foreach($saveTrack as $st)
		      <span>{!! str_limit($st->project->name, $limit = 35, $end = '...')  !!}</span>
		      <!--<span>Bio-Medical & Surgical Plaza - Yuma</span>
		      <span>Big Chino Sub-Basin Groundwater Flow...</span>-->
			@endforeach
		      @endif
		      <a class="link-vl" href="{{URL::route('saved_tracking_list')}}" style="color:#fff">view all</a>
		    </p>
		  </div>
		</div>
	      </li>
	      
	      <li>
		<div class="bx-wraper">
		  <div class="rp-left">
		    <strong>Projects </strong>		    
		    
		  </div>		
		  <a class="dash-ip" href="{{URL::route('planroom_list')}}"><img src="{{asset('images/rimg4.png')}}" alt="img" /></a>
		  <div class="rp-area">
		    <p>
		      @if(count($projectList) > 0)
			@foreach($projectList as $pr)
                        <span>{!! str_limit($pr->name, $limit = 35, $end = '...')  !!}</span>
		      @endforeach
		      <a class="link-vl" href="{{URL::route('planroom_list')}}" style="color:#fff">view all</a>
		      @endif
		      
		    </p>
                  </div>
		</div>
	      </li>
              
	    </ul>
	   </div>
	</div>
	
	
      
    </div>
  </div>
@endsection