@extends('admin/layout')
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
                     @if (count($errors) > 0)
                                        <div class="alert alert-danger">
                                            <ul>
                                                @foreach ($errors->all() as $error)
                                                    <li>{{ $error }}</li>
                                                @endforeach
                                            </ul>
                                        </div>
                                    @endif
                        <div class="portlet-header">
                            <div class="caption">Payment for: {!! $subscription_list->subscription->subscription_title !!}</div>
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
                                        {!! Form::open(array('route'=>array('front_user_payment',$subscription_list->id),'class'=>'form-validate')) !!}
					<div class="form-body pal">
					<div class="form-group">
					  <label class="control-label" for="inputFirstName">Subscription Type<span class="require">*</span></label>
					    {{Form::select('sub_type',['quarterly'=>'Quarterly','yearly'=>'Yearly'],$subscription_list->subscription_type,['class'=>'form-control','readonly'=>'readonly'])}}
					</div>
					<div class="form-group">
					  <label class="control-label" for="inputFirstName">Start Date<span class="require">*</span></label>
					    {!! Form::text('start_date',date('m-d-Y',strtotime($subscription_list->tmp_start)),array('class'=>'form-control required','readonly'=>'readonly'))!!}
					</div>
					<div class="form-group">
					  <label class="control-label" for="inputFirstName">End Date<span class="require">*</span></label>
					    {!! Form::text('end_date',date('m-d-Y',strtotime($subscription_list->	tmp_end)),array('class'=>'form-control','readonly'=>'readonly'))!!}
					</div>
					<div class="form-group">
					  <label class="control-label" for="inputFirstName">Payment Amount<span class="require">*</span></label>
					    {!! Form::text('payment_amount',($subscription_list->subscription_type == 'yearly' )?$subscription_list->subscription->yearly_price:$subscription_list->subscription->quarterly_price,array('class'=>'form-control','readonly'=>'readonly'))!!}
					</div>
					<div class="form-group">
					  <label class="control-label" for="inputFirstName">Card No <span class="require">*</span></label>
					    {!! Form::number('card_number',$user_details->card_no,array('class'=>'form-control required','id'=>'card_number','minlength'=>'15','maxlength'=>'16'))!!}
					</div>
					<div class="form-group">
					  <label class="control-label" for="inputLastName">Expire Date<span class="require">*</span></label>
					  @php
					      $currentYear = date('Y');
					      $lastYear    = $currentYear + 50;
					  @endphp
					  <div class="form-group">
					  <div class="col-md-6">
					  {!! Form::selectYear('year',$currentYear,$lastYear,($user_details->exp_year != '0000' || $user_details->exp_year != '')?$user_details->exp_year:'',array('class' => 'form-control required')) !!}
					  </div>
					  <div class="col-md-6">
					  {!! Form::selectMonth('month',($user_details->exp_month != '0' || $user_details->exp_month != '')?$user_details->exp_month:'',array('class' => 'form-control required')) !!}
					  </div>
					  </div>
					</div>
					<div class="form-group">
					  <label class="control-label" for="inputFirstName">CVV <span class="require">*</span></label>
					    {!! Form::password('cvv',array('class' => 'form-control required number','minlength'=>'3','maxlength'=>'4')) !!}
					</div>
				    </div>
				    <div class="form-actions pll prl">
					<button class="btn btn-primary customer-create" type="submit" >Update</button>
					&nbsp;
					{!! Html::linkRoute('front_users','Cancel',array(),array('class'=>'btn btn-green')) !!}
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