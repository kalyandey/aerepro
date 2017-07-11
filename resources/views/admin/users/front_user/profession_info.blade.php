@extends('admin.layout')
@section('content')
    
    <div id="title-breadcrumb-option-demo" class="page-title-breadcrumb">
                <div class="page-header pull-left">
                    <div class="page-title">Edit Customer</div>
                </div>
                 <ol class="breadcrumb page-breadcrumb pull-right">
                    <li><i class="fa fa-home"></i>&nbsp;<a href="javascript:void(0);">Home</a>&nbsp;&nbsp;<i class="fa fa-angle-right"></i>&nbsp;&nbsp;</li>
                    <li><i class="fa fa-user"></i>&nbsp;<a href="javascript:void(0);">Users</a>&nbsp;&nbsp;<i class="fa fa-angle-right"></i>&nbsp;&nbsp;</li>
                    <li><i class="fa fa-user"></i>&nbsp;<a href="javascript:void(0);">Customer</a>&nbsp;&nbsp;<i class="fa fa-angle-right"></i>&nbsp;&nbsp;</li>
                    <li class="active"><i class="fa fa-user"></i>&nbsp; Edit Customer</li>
                        
                </ol>
                <div class="clearfix"></div>
    </div>
    <div class="page-content">
        <div id="form-layouts" class="row">
            <div class="col-lg-12">
                    <div class="portlet box portlet-yellow">
                        <div class="portlet-header">
                            <div class="caption">Edit Customer : {!! $user_details->business_name !!}</div>
                        </div>
                        <div class="portlet-body">
                            <div class="row">
                                <div >
                                    @include('admin.users.front_user.menu')
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-12">
                                    <!--<h3>Account Information</h3>-->
                                    <br>
                                        {!! Form::open(array('route'=>array('front_user_moreinfo',$user_details->id),'class'=>'form-validate')) !!}
{!! Form::hidden('action','Process')!!}
                   
                                                            <div class="form-body pal">
                                                                <div class="form-group">
                                                                            <label class="control-label" for="Your Profession"><strong>Your Profession :</strong></label><br>
                                                                             @php $profession_val = explode(',',$user_details->profession); @endphp
                                                                              
                                                                            @if(count($profession) > 0 )
                                                                                    @foreach($profession as $p)
                                                                                        
                                                                                        @if(count($profession_val) > 0 && in_array($p->id,$profession_val))
		     @php $checked = 'checked';@endphp
		   @else
		      @php $checked = '';@endphp
		   @endif
                                                                                        
                                                                                        {!! Form::checkbox('profession[]',$p->id,$checked,array('class'=>'form-control checkbox'))!!} {!! $p->profession_title !!}&nbsp;
                                                                                    @endforeach
                                                                            @endif
                                                                </div>
                                                            </div>
                                                            <div class="form-body pal">
                                                                <div class="form-group">
                                                                            <label class="control-label" for="CSI Division"><strong>CSI Division : </strong></label><br>
                                                                            @php $division_val = explode(',',$user_details->division); @endphp
                                                                            @if(count($division) > 0 )
										    <div class="col-md-12">
                                                                                    @foreach($division as $d)
                                                                                        
                                                                                         @if(count($division_val) > 0 && in_array($d->id,$division_val))
												@php $checked = 'checked';@endphp
											      @else
												 @php $checked = '';@endphp
											 @endif
                                                                                        <div class="col-md-4">{!! Form::checkbox('division[]',$d->id,$checked,array('class'=>'input full required'))!!} {!! $d->division_title !!}</div>
                                                                                    @endforeach
										    </div>
                                                                                @endif
                                                                </div>
                                                            </div>
                                                            <div class="form-body pal">
                                                                <div class="form-group">
                                                                            <label class="control-label" for="Construction Trades"><strong>Construction Trades : </strong></label><br>
                                                                            @php $trade_val = explode(',',$user_details->trade); @endphp
                                                                            
                                                                            @if(count($trade) > 0 )
											<div class="col-md-12">
                                                                                    @foreach($trade as $t)
                                                                                        
                                                                                        @if(count($trade_val) > 0 && in_array($t->id,$trade_val))
			@php $checked = 'checked';@endphp
		      @else
			 @php $checked = '';@endphp
		      @endif
                                                                                        
                                                                                        <div class="col-md-4">{!! Form::checkbox('trade[]',$t->id,$checked,array('class'=>'input full required'))!!} {!! $t->trade_title !!}</div>
                                                                                    @endforeach
											</div>
                                                                            @endif
                                                                </div>
                                                            </div>
							    <div style="clear:both"></div>
							    <br>
                                                            <div class="form-actions pll prl">
                                                                <button class="btn btn-primary" type="submit">Update</button>
                                                                &nbsp;
                                                                
                                                                <a class="btn btn-green" href="{{URL::route('front_users_edit',$user_details->id)}}">back</a>
                                                            </div>
                                                {!! Form::close() !!}
                                </div>
                            </div>
                            <div style="clear:both"></div>
                        </div>
                    </div>
            </div>
        </div>
    </div>
@endsection