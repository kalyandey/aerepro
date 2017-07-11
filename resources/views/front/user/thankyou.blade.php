@extends('front.app')
@section('content')
      <div class="container">
      <div class="deshboard breport clear">
	<div class="form-report clear">
	         
	@if(Session::has('success'))
        <p class='text-green success-msg'>{!! Session::get('success') !!}</p>
	@endif
	
	@if(Session::has('error'))
	  <p class='text-red error-msg'>{!! Session::get('error') !!}</p>
	@endif
	
	</div>
      </div>
    </div>

@endsection