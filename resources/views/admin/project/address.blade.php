@extends('admin.layout')
@section('content')
    
    <div id="title-breadcrumb-option-demo" class="page-title-breadcrumb">
                <div class="page-header pull-left">
                    <div class="page-title">Edit Project</div>
                </div>
                <ol class="breadcrumb page-breadcrumb pull-right">
                    <li><i class="fa fa-home"></i>&nbsp;<a href="javascript:void(0);">Home</a>&nbsp;&nbsp;<i class="fa fa-angle-right"></i>&nbsp;&nbsp;</li>
                    <li class="active">Edit Project</li>
                </ol>
                <div class="clearfix"></div>
    </div>
    <div class="page-content">
        <div id="form-layouts" class="row">
            <div class="col-lg-12">
                    <div class="portlet box portlet-yellow">
                        <div class="portlet-header">
                            <div class="caption">Edit Project : {!! $projectDetails->name !!}</div>
                        </div>
                        <div class="portlet-body">
                            <div class="row">
                                <div class="topTabText">
                                    @include('admin.project.menu')
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-12">
                                    <!--<h3>Account Information</h3>-->
                                    <br>
                                        {!! Form::open(array('route'=>['admin_project_address',$projectDetails->id],'class'=>'form-validate form-horizontal','files'=>true,'method'=>'post')) !!}
                                        {!! Form::hidden('action','Process')!!}
                                        <div class="form-group">
                                            <label for="Street" class="col-md-3 control-label">Street</label>
                                            <div class="col-md-9">{!! Form::text('street',$projectDetails->street,['class'=>'form-control','id' => 'Street'])!!}</div>
                                        </div>
                                        <div class="form-group">
                                            <label for="Street" class="col-md-3 control-label">City</label>
                                            <div class="col-md-9">{!! Form::text('city',$projectDetails->city,['class'=>'form-control','id' => 'City'])!!}</div>
                                        </div>
                                        <div class="form-group">
                                            <label for="Street" class="col-md-3 control-label">State</label>
                                            <div class="col-md-9">{!! Form::select('state',$state,$projectDetails->state,['class'=>'form-control','id' => 'State'])!!}</div>
                                        </div>           
                                        <div class="form-group">
                                            <label for="County" class="col-md-3 control-label">County</label>
                                            <div class="col-md-9">{!! Form::select('county_id',$county,$projectDetails->county_id,['class'=>'form-control required','id' => 'County'])!!}</div>
                                        </div>
                                        <div class="form-group">
                                            <label for="Zip" class="col-md-3 control-label">Zip</label>
                                            <div class="col-md-9"> {!! Form::text('zip',$projectDetails->zip,['class'=>'form-control','id' => 'Zip'])!!}</div>
                                        </div>        
                                        <div class="form-actions">
                                        <div class="col-md-12">
                                        {!! Form::submit('Submit',['class'=>'btn btn-primary'])!!}
                                        <a class="btn btn-default" href="{{URL::route('admin_project_awarded_to',[$projectDetails->id])}}">Back</a>
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