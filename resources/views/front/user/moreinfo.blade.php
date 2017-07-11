@extends('front.app')
@section('content')
      <div class="container">
      <div class="deshboard breport clear register-customer-profile">
	<h3><strong>Register</strong></h3>
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
	  
	  {!! Form::open(array('route'=>array('register_moreinfo'),'id'=>'more_info_post','files'=>true)) !!}
	  {!! Form::hidden('action','Process')!!}
	  <div id="errorTxt"></div>
	    <div class="registerCheckContainer">
	      <strong>Your Profession :</strong>
	      (<span class="check_all">check all </span> || <span class="uncheck_all"> uncheck all </span>)
	      <div class="form-msg registerCheck">
	      @if(count($profession) > 0 )
		  @foreach($profession as $p)
		      <div>{!! Form::checkbox('profession[]',$p->id,'',array('class'=>'input full checkbox'))!!} {!! $p->profession_title !!}</div>
		  @endforeach
	      @endif
	      </div>
	    </div>
	    <div class="registerCheckContainer">
	      <strong>CSI Division :</strong>
	      (<span class="check_all">check all </span> || <span class="uncheck_all"> uncheck all </span>)
	      <div class="form-msg registerCheck">
	      @if(count($division) > 0 )
		  @foreach($division as $d)
		      <div>{!! Form::checkbox('division[]',$d->id,'',array('class'=>'input full'))!!} {!! $d->division_title !!}</div>
		  @endforeach
	      @endif
	      </div>
	    </div>
	    <div class="registerCheckContainer">
	      <strong>Constraction Trades :</strong>
	      (<span class="check_all">check all </span> || <span class="uncheck_all"> uncheck all </span>)
	      <div class="form-msg registerCheck">
	      @if(count($trade) > 0 )
		  @foreach($trade as $t)
		      <div>{!! Form::checkbox('trade[]',$t->id,'',array('class'=>'input full'))!!} {!! $t->trade_title !!}</div>
		  @endforeach
	      @endif
	      
	      </div>
	    </div>
	    {!! Form::submit('Next',array('class'=>'btn-srrp' )) !!}&nbsp;&nbsp;
	  {!! Form::close() !!}	  
	</div>
      </div>
    </div>
  </div>

@endsection