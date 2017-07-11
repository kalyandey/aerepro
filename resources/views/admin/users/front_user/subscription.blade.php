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
                    <li class="active"><i class="fa fa-user"></i>&nbsp; Edit Subscription</li>
                        
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
                                    {!! Form::open(array('route'=>array('front_user_subscriptions',$user_details->id),'class'=>'form-validate')) !!}
				    {!! Form::hidden('action','Process')!!}
					
						@if(count($activeSubscription) > 0)
									
						@foreach($activeSubscription as $aSub)
						
						<div class="form-body pal">
						    <div class="form-group col-md-3">
							    <label class="control-label" for="{!! $aSub->subscription_title !!}"><strong>{!! $aSub->subscription_title !!} :</strong></label>    
						    </div>
						    <div class="form-group col-md-3">
							    <div class="input-group datetimepicker-disable-time date">
							    {{Form::text('end_date[]',date('m/d/Y',strtotime($aSub->end_date)),['class'=>'form-control'])}}
							    <span class="input-group-addon"><i class="fa fa-calendar"></i></span>
							    </div>
						    </div>
						    <div class="form-group col-md-3">
							    {{Form::select('status[]',['active'=>'Activate','inactive'=>'Deactivate'],$aSub->status,['class'=>'form-control'])}}
						    </div>
						    <!--<div class="form-group col-md-3">
							    @if($aSub->auto_payment == 'enable')
							    <a class="btn btn-info" href="{{URL::route('front_user_disable_subscriptions',$aSub->id)}}" onclick="return confirm('Are you sure??')">Enable</a>
						    @else
							    <a class="btn btn-danger" href="{{URL::route('front_user_enable_subscriptions',$aSub->id)}}" onclick="return confirm('Are you sure??')">Disable</a>
						    @endif
						    </div>-->
                                                    {{ Form::hidden('userSubId[]', $aSub->id) }}
						</div>
						<div style="clear:both"></div>
						@endforeach
						<div style="clear:both"></div>
						<br>
						<div class="form-actions pll prl ">
						<div class="col-md-9"></div>
						<div class="col-md-3">
						  <button type="submit" class="btn btn-primary">Update</button>
					   </div>
											  </div>
						@else
						<div class="form-body pal">
						<div class="form-group col-md-4">
						<label class="control-label" for="Your Profession"><strong>No Active Subscription found</strong></label>    
						</div>
						@endif
						<div style="clear:both"></div>
                                    {!! Form::close() !!}
						
						<div class="form-body pal">
						@if(count($inactiveSubscription) > 0 )
						@foreach($inactiveSubscription as $iSub)
							    {!! Form::open(array('route'=>array('front_user_subscribe_single',$user_details->id,$iSub->id),'class'=>'form-validate1')) !!}
							    <div class="form-group col-md-2">
							    <label class="control-label" for="{!! $iSub->subscription_title !!}"><strong>{!! $iSub->subscription_title !!} :</strong></label>
							    </div>
							    <div class="form-group col-md-2">
							    {{Form::select('sub_type',[''=>'--Select--','quarterly'=>'Quarterly','yearly'=>'Yearly'],'',['required','class'=>'form-control subscriptionadmintype','data-date-start'=>''])}}
							    </div>
							    <div class="form-group col-md-3">
							    <div class="input-group datetimepicker-subscription date subscriptionadminstartdate">
							    {{Form::text('start_date','',['class'=>'form-control','required','autocomplete'=>'Off'])}}
							    <span class="input-group-addon"><i class="fa fa-calendar"></i></span>
							    </div>
							    </div>
							    <div class="form-group col-md-2">
							    {{Form::text('end_date','',['class'=>'form-control subscriptionadminenddate','readonly'=>'readonly','required',])}}
							    </div>
							    <div class="form-group col-md-3">
							    <button class="btn btn-primary subscriptFormSubmit" type="submit" >Submit</button>
							    </div>
							    <div style="clear:both"></div>
							    {!! Form::close() !!}
						@endforeach
						@endif
						</div>
									
						<div class="form-actions pll prl ">
						<div class="col-md-9"></div>
						<div class="col-md-3">
						    <a class="btn btn-green" href="{{URL::route('front_user_moreinfo',$user_details->id)}}">Back</a>
						</div>
						</div>

						
                                </div>
                            </div>
                            <div style="clear:both"></div>
                        </div>
                    </div>
            </div>
        </div>
    </div>
@endsection