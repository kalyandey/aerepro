@extends('admin.layout')
@section('content')
    
    <div id="title-breadcrumb-option-demo" class="page-title-breadcrumb">
                <div class="page-header pull-left">
                    <div class="page-title">Edit Project</div>
                </div>
                <ol class="breadcrumb page-breadcrumb pull-right">
                    <li><i class="fa fa-home"></i>&nbsp;<a href="javascript:void(0);">Home</a>&nbsp;&nbsp;<i class="fa fa-angle-right"></i>&nbsp;&nbsp;</li>
                    <li class="active">Edit Project </li>
                </ol>
                <div class="clearfix"></div>
    </div>
    <div class="page-content">
        <div id="form-layouts" class="row">
            <div class="col-lg-12">
                    <div class="portlet box portlet-yellow">
                        <div class="portlet-header">
                            <div class="caption">Edit Project : {!! $details->company->company_name !!}</div>
                        </div>
                        <div class="portlet-body">
                           <div class="row">
                                <div class="topTabText">
                                    @include('admin.private.project.menu')
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-12">
                                    <!--<h3>Account Information</h3>-->
                                    <br>
                                        {!! Form::open(array('route'=>array('admin_private_project_details',$details->id),'class'=>'form-validate form-horizontal','files'=>true,'method'=>'post')) !!}
                                        {!! Form::hidden('action','Process') !!}
                                        <div class="form-group">
                                            <label for="Name" class="col-md-3 control-label">Project Name</label>
                                            <div class="col-md-9">{!! Form::text('project_name',$details->project_name,['class'=>'form-control required','id' => 'project_name'])!!}</div>
                                        </div>
                                        <div class="form-group">
                                            <label for="bid_date" class="col-md-3 control-label">Close Date</label>
                                            <div class="col-md-9">    
                                            <div class="input-group datetimepicker-disable-time date">
                                           
                                                @php
                                                if($details->close_date != '0000-00-00'){
                                                          
                                                            $close_dateArr = explode('-',$details->close_date);
                                                            $close_date = $close_dateArr[1].'/'.$close_dateArr[2].'/'.$close_dateArr[0];
                                                            
                                                }else{
                                                            $close_date = '';
                                                }
                                                @endphp
                                            {!! Form::text('close_date',$close_date,['class'=>'form-control required','id' => 'close_date','autocomplete'=>'off'])!!}
                                            <span class="input-group-addon"><i class="fa fa-calendar"></i></span>
                                            </div>
                                            </div>    
                                        </div>
                                        <div class="form-group">
                                            <label for="time_due" class="col-md-3 control-label">Time Due</label>
                                            <div class="col-md-9">    
                                            <div class="input-group datetimepicker-disable-date date">{!! Form::text('time_due',($details->time_due != '00:00:00')?date('h:i A',strtotime($details->time_due)):'',['class'=>'form-control','id' => 'time_due','autocomplete'=>'off'])!!}
                                            <span class="input-group-addon"><i class="fa fa-clock-o"></i></span>
                                            </div>
                                            </div>    
                                        </div>
                                        <div class="form-group">
                                            <label for="pre_bid_meeting_date" class="col-md-3 control-label">Pre-Bid Meeting Date</label>
                                            <div class="col-md-9">
                                            <div class="input-group datetimepicker-disable-time date">
                                            @php
                                                if($details->prebid_meeting_date != '0000-00-00'){
                                                          
                                                            $prebid_meeting_date = explode('-',$details->prebid_meeting_date);
                                                            $prebid_meeting_date = $prebid_meeting_date[1].'/'.$prebid_meeting_date[2].'/'.$prebid_meeting_date[0];
                                                            
                                                }else{
                                                            $prebid_meeting_date = '';
                                                }
                                                @endphp
                                            {!! Form::text('prebid_meeting_date',$prebid_meeting_date,['class'=>'form-control required','id' => 'prebid_meeting_date','autocomplete'=>'off'])!!}
                                            <span class="input-group-addon"><i class="fa fa-calendar"></i></span>
                                            </div>
                                            </div>    
                                        </div>  
                                        <div class="form-group">
                                            <label for="pre_bid_meeting_time" class="col-md-3 control-label">Pre-Bid Meeting Time</label>
                                            <div class="col-md-9">
                                            <div class="input-group datetimepicker-disable-date date">{!! Form::text('prebid_meeting_time',($details->prebid_meeting_time != '00:00:00')?date('h:i A',strtotime($details->prebid_meeting_time)):'',['class'=>'form-control','id' => 'prebid_meeting_time','autocomplete'=>'off'])!!}
                                            <span class="input-group-addon"><i class="fa fa-clock-o"></i></span>
                                            </div>
                                            </div>    
                                        </div>
                                        <div class="form-group">
                                            <label for="description" class="col-md-3 control-label">Location</label>
                                            <div class="col-md-9">{!! Form::textarea('location',$details->location,['class'=>'form-control','id' => 'location'])!!}</div>
                                        </div>        
                                        <div class="form-group">
                                            <label for="description" class="col-md-3 control-label">Description</label>
                                            <div class="col-md-9">{!! Form::textarea('description',$details->description,['class'=>'form-control','id' => 'description'])!!}</div>
                                        </div>
                                        <div class="form-group">
                                            <label for="description" class="col-md-3 control-label">Project Type</label>
                                            <div class="col-md-9">{!! Form::select('view_status',['Public'=>'Public','Private'=>'Private'],$details->view_status,['class'=>'form-control','id' => 'view_status'])!!}</div>
                                        </div>        
                                        <div class="form-group">
                                            <label for="description" class="col-md-3 control-label">Status</label>
                                            <div class="col-md-9">{!! Form::select('status',['Pre-bid'=>'Pre-bid','Bidding'=>'Bidding','Close'=>'Close'],$details->view_status,['class'=>'form-control','id' => 'status'])!!}</div>        
                                        </div>        
                                        <div class="form-actions">
                                        <div class="col-md-12">
                                        {!! Form::submit('Submit',['class'=>'btn btn-primary'])!!}
                                        <a class="btn btn-default" href="{{URL::route('admin_private_company_edit',$details->id)}}">Cancel</a>
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