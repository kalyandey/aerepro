@extends('front.app')
@section('content')
<div class="details_view"></div>
<div class="details_loader"></div>
<script src="//cdnjs.cloudflare.com/ajax/libs/jquery/2.1.3/jquery.min.js"></script>
    <script src="//cdnjs.cloudflare.com/ajax/libs/moment.js/2.9.0/moment.min.js"></script>
    <script src="//cdnjs.cloudflare.com/ajax/libs/fullcalendar/2.2.7/fullcalendar.min.js"></script>
    <link rel="stylesheet" href="//cdnjs.cloudflare.com/ajax/libs/fullcalendar/2.2.7/fullcalendar.min.css"/>
    <div class="container">
      <div class="deshboard clear">
        <h3><strong>Project</strong>Calendar</h3>
        <a href="{{URL::route('dashboard')}}" class="btn-db">Dashboard</a>	
	<div id="cartView"></div>
	<br><br><br> 
	{!! $calendar->calendar() !!}
        {!! $calendar->script() !!}
    </div>
  </div>
@endsection