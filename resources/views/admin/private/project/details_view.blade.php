@extends('admin.layout')
@section('content')
    
    <div id="title-breadcrumb-option-demo" class="page-title-breadcrumb">
                <div class="page-header pull-left">
                    <div class="page-title">Project View</div>
                </div>
                <ol class="breadcrumb page-breadcrumb pull-right">
                    <li><i class="fa fa-home"></i>&nbsp;<a href="javascript:void(0);">Home</a>&nbsp;&nbsp;<i class="fa fa-angle-right"></i>&nbsp;&nbsp;</li>
                    <li class="active">Project : {!! $details->name !!}</li>
                </ol>
                <div class="clearfix"></div>
    </div>
    <div class="page-content">
        <div id="form-layouts" class="row">
            <div class="col-lg-12">
                    <div class="portlet box portlet-yellow">
                        <div class="portlet-header">
                            <div class="caption">View Project</div>
                        </div>
                        <div class="portlet-body">
                           <div class="row">
                                <div  class="topTabText">
                                    @include('admin.private.project.menu_view')
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-12 allViewSection">
                                    <!--<h3>Account Information</h3>-->
                                        <div class="col-md-12">
                                            <div class="col-md-3 box-heading">Project ID : </div>
                                            <h5 class="col-md-3 list-group-item-heading">{!! $details->project_id !!}</h5>
                                            <div class="col-md-3 box-heading">Project Name : </div>
                                            <h5 class="col-md-3">{!! $details->project_name !!}</h5>   
                                        </div>

                                        <div class="col-md-12">
                                            <div class="col-md-3 box-heading">Close Date : </div>
                                            <h5 class="col-md-3">
                                            @php
                                                $close_dateArr = explode('-',$details->close_date);
                                                $close_date = $close_dateArr[1].'/'.$close_dateArr[2].'/'.$close_dateArr[0];
                                                
                                                @endphp
                                                {!! $close_date !!}
                                            </h5>
                                            <div class="col-md-3 box-heading">Time Due : </div>
                                            <h5 class="col-md-3">{!! ($details->time_due != '00:00:00')?date('h:i A',strtotime($details->time_due)):'' !!}</h5>    
                                        </div>

                                        <div class="col-md-12">
                                            <div class="col-md-3 box-heading">Pre-Bid Meeting Date : </div>
                                            <h5 class="col-md-3">
                                                @php
                                                $pre_bid_meeting_date = explode('-',$details->prebid_meeting_date);
                                                $pre_bid_meeting_date = $pre_bid_meeting_date[1].'/'.$pre_bid_meeting_date[2].'/'.$pre_bid_meeting_date[0];
                                                @endphp
                                                {!! $pre_bid_meeting_date!!}
                                            </h5>
                                            <div class="col-md-3 box-heading">Pre-Bid Meeting Time : </div>
                                            <h5 class="col-md-3">{!! ($details->prebid_meeting_time != '00:00:00')?date('h:i A',strtotime($details->prebid_meeting_time)):'' !!}</h5>    
                                        </div> 
                                        
                                        <div class="col-md-12">
                                            <div class="col-md-3 box-heading">Location : </div>
                                            <h5 class="col-md-3">{!! $details->location !!}</h5>    
                                            <div class="col-md-3 box-heading">Description : </div>
                                            <h5 class="col-md-3">{!! $details->description !!}</h5>
                                        </div>
                                        <div class="col-md-12">
                                            <div class="col-md-3 box-heading">Project Type : </div>
                                            <h5 class="col-md-3">{!! $details->view_status !!}</h5>    
                                            <div class="col-md-3 box-heading">Status : </div>
                                            <h5 class="col-md-3">{!! $details->status !!}</h5>
                                        </div>        
                                        <div class="form-actions">
                                        <div class="col-md-12">
                                        <a href="{{URL::route('admin_private_project_plan_view',[$details->id])}}" class="btn btn-primary">Next</a>
                                        <a class="btn btn-default" href="{{URL::route('admin_private_project_company_view',$details->id)}}">Cancel</a>
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