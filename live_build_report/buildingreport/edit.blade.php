@extends('admin.layout')
@section('content')
    
    <div id="title-breadcrumb-option-demo" class="page-title-breadcrumb">
                <div class="page-header pull-left">
                    <div class="page-title">Edit PlanRoom Building Reports</div>
                </div>
                <ol class="breadcrumb page-breadcrumb pull-right">
                    <li><i class="fa fa-home"></i>&nbsp;<a href="javascript:void(0);">Home</a>&nbsp;&nbsp;<i class="fa fa-angle-right"></i>&nbsp;&nbsp;</li>
                    <li class="active">Edit PlanRoom Building Reports</li>
                </ol>
                <div class="clearfix"></div>
    </div>
    <div class="page-content">
        <div id="form-layouts" class="row">
            <div class="col-lg-12">
                    <div class="portlet box portlet-yellow">
                        <div class="portlet-header">
                            <div class="caption">Edit PlanRoom Building Reports</div>
                        </div>
                        <div class="portlet-body">
                            <div class="row">
                                <div >
                                    @include('admin.buildingreport.menu')
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-12">
                                    <!--<h3>Account Information</h3>-->
                                    <br>
                                        {!! Form::open(array('route'=>array('admin_buildingreport_update',$lists->id),'class'=>'form-validate form-horizontal','files'=>true,'method'=>'post')) !!}
                                        {!! Form::hidden('action','Process')!!}
                                        <div class="form-group">
                                            <label for="Date Issued" class="col-md-3 control-label">Date Issued</label>
                                            <div class="col-md-9">
					    @php
					    $issued_date = '';
					    if($lists->issued_date != '0000-00-00'){
						$issued_date = explode('-',$lists->issued_date);
						$issued_date = $issued_date[1].'/'.$issued_date[2].'/'.$issued_date[0];
					    }
					    @endphp
                                            <div class="input-group" id="track_datetimepicker">{!! Form::text('issued_date',$issued_date,['class'=>'form-control required','id' => 'bid_date','autocomplete'=>'off'])!!}
                                            <span class="input-group-addon"><i class="fa fa-calendar"></i></span>
                                            </div>
                                            </div>    
                                        </div>
                                        <div class="form-group">
                                            <label for="Jurisdiction" class="col-md-3 control-label">Jurisdiction</label>
                                            <div class="col-md-9">{!! Form::select('jurisdiction',[''=>'Select Jurisdiction'] + $jurisdiction,$lists->jurisdiction_id,['class'=>'form-control required','id' => 'Jurisdiction'])!!}</div>
                                        </div>
					<div class="form-group">
                                            <label for="Permit County" class="col-md-3 control-label">County</label>
                                            <div class="col-md-9">{!! Form::select('county',[''=>'Select County'] + $county,$lists->county_id,['class'=>'form-control required','id' => 'county'])!!}</div>
                                        </div>	
                                        <div class="form-group">
                                            <label for="Permit Type" class="col-md-3 control-label">Permit Type</label>
                                            <div class="col-md-9">{!! Form::text('permit_type',$lists->permit_type_id,['class'=>'form-control required','id' => 'Permit Type'])!!}</div>
                                        </div>
					<div class="form-group">
                                            <label for="address" class="col-md-3 control-label">Street</label>
                                            <div class="col-md-9">{!! Form::text('address',$lists->address,['class'=>'form-control','id' => 'address']) !!}</div>
                                        </div>	
					<div class="form-group">
                                            <label for="City" class="col-md-3 control-label">City</label>
                                            <div class="col-md-9">{!! Form::text('city',$lists->city_id,['class'=>'form-control required','id' => 'City'])!!}</div>
                                        </div>
				        <div class="form-group">
                                            <label for="State" class="col-md-3 control-label">State</label>
                                            <div class="col-md-9">{!! Form::select('state', $state,$lists->state_id,['class'=>'form-control required','id' => 'State'])!!}</div>
                                        </div>
					<div class="form-group">
                                            <label for="ZIP" class="col-md-3 control-label">ZIP</label>
                                            <div class="col-md-9">{!! Form::text('zip',$lists->zip,['class'=>'form-control','id' => 'zip'])!!}</div>
                                        </div>
					<div class="form-group">
                                            <label for="sqft" class="col-md-3 control-label">Sq Ft</label>
                                            <div class="col-md-9">{!! Form::text('sqft',$lists->sqft,['class'=>'form-control','id' => 'sqft'])!!}</div>
                                        </div>
					<div class="form-group">
                                            <label for="valuation" class="col-md-3 control-label">Valuation</label>
                                            <div class="col-md-9">{!! Form::text('valuation',$lists->valuation,['class'=>'form-control','id' => 'valuation'])!!}</div>
                                        </div>
				        <div class="form-group">
                                            <label for="Permit" class="col-md-3 control-label">Permit #</label>
                                            <div class="col-md-9">{!! Form::text('permit',$lists->permit,['class'=>'form-control','id' => 'permit'])!!}</div>
                                        </div>
					<div class="form-group">
                                            <label for="Parcel" class="col-md-3 control-label">Parcel #</label>
                                            <div class="col-md-9">{!! Form::text('parcel',$lists->parcel,['class'=>'form-control','id' => 'parcel'])!!}</div>
                                        </div>
					<div class="form-group">
                                            <label for="subdivision" class="col-md-3 control-label">Subdivision</label>
                                            <div class="col-md-9">{!! Form::text('subdivision',$lists->subdivision,['class'=>'form-control','id' => 'subdivision']) !!}</div>
                                        </div>
                                        <div class="form-group">
                                            <label for="subdivision" class="col-md-3 control-label">Lot #</label>
                                            <div class="col-md-9">{!! Form::text('lot',$lists->lot,['class'=>'form-control','id' => 'lot']) !!}</div>
                                        </div>
					<!--<div class="form-group">
                                            <label for="Status" class="col-md-3 control-label">Type</label>
                                            <div class="col-md-9">{!! Form::select('type',['added'=>'Added', 'issued'=>'Issued'] ,$lists->type,['class'=>'form-control required','id' => 'type'])!!}</div>
                                        </div>-->		
					<div class="form-group">
                                            <label for="Status" class="col-md-3 control-label">Status</label>
                                            <div class="col-md-9">{!! Form::select('status',[''=>'Select Status','Active'=>'Active', 'Inactive'=>'Inactive'] ,$lists->status,['class'=>'form-control required','id' => 'Status'])!!}</div>
                                        </div>	
                                        <div class="form-actions">
                                        <div class="col-md-offset-9 col-md-9">
                                        {!! Form::submit('Submit',['class'=>'btn btn-primary'])!!}
                                        <a class="btn btn-default" href="{{URL::route('admin_buildingreport')}}">back</a>
                                        </div>
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