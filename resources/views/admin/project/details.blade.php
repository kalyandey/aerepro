@extends('admin.layout')
@section('content')
    
    <div id="title-breadcrumb-option-demo" class="page-title-breadcrumb">
                <div class="page-header pull-left">
                    <div class="page-title">Project View</div>
                </div>
                <ol class="breadcrumb page-breadcrumb pull-right">
                    <li><i class="fa fa-home"></i>&nbsp;<a href="javascript:void(0);">Home</a>&nbsp;&nbsp;<i class="fa fa-angle-right"></i>&nbsp;&nbsp;</li>
                    <li class="active">Project : {!! $projectDetails->name !!}</li>
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
                                    @include('admin.project.menu_view')
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-12 allViewSection">
                                    <!--<h3>Account Information</h3>-->
                                        <div class="col-md-12">
                                            <div class="col-md-3 box-heading">Project Name : </div>
                                            <h5 class="col-md-3 list-group-item-heading">{!! $projectDetails->name !!}</h5>
                                            <div class="col-md-3 box-heading">Category : </div>
                                            <h5 class="col-md-3">{!! $projectDetails->category->name !!}</h5>   
                                        </div>

                                        <div class="col-md-12">
                                            <div class="col-md-3 box-heading">Project Type : </div>
                                            <h5 class="col-md-3">{!! (count($projectDetails->type)>0)?$projectDetails->type->name:'<span style="color:red">Not Available</span>' !!}</h5>
                                            <div class="col-md-3 box-heading">Bid Close Date : </div>
                                            <h5 class="col-md-3">
                                            @php
                                                $bid_close_dateArr = explode('-',$projectDetails->bid_close_date);
                                                $bid_close_date = $bid_close_dateArr[1].'/'.$bid_close_dateArr[2].'/'.$bid_close_dateArr[0];
                                                
                                                @endphp
                                                {!! $bid_close_date !!}
                                            </h5>   
                                        </div>

                                        <div class="col-md-12">
                                            <div class="col-md-3 box-heading">Time Due : </div>
                                            <h5 class="col-md-3">{!! ($projectDetails->time_due != '00:00:00')?date('h:i A',strtotime($projectDetails->time_due)):'' !!}</h5>
                                            <div class="col-md-3 box-heading">Pre-Bid Meeting Date : </div>
                                            <h5 class="col-md-3">
                                                @php
                                                $pre_bid_meeting_date = '';
                                                if($projectDetails->pre_bid_meeting_date != ''){
                                                $pre_bid_meeting_date = explode('-',$projectDetails->pre_bid_meeting_date);
                                                $pre_bid_meeting_date = $pre_bid_meeting_date[1].'/'.$pre_bid_meeting_date[2].'/'.$pre_bid_meeting_date[0];
                                                }
                                                @endphp
                                                {!! $pre_bid_meeting_date!!}
                                            </h5>   
                                        </div>  

                                        <div class="col-md-12">
                                            <div class="col-md-3 box-heading">Pre-Bid Meeting Time : </div>
                                            <h5 class="col-md-3">{!! ($projectDetails->pre_bid_meeting_time != '00:00:00')?date('h:i A',strtotime($projectDetails->pre_bid_meeting_time)):'' !!}</h5>
                                            <div class="col-md-3 box-heading">Mandatory Pre-Bidding : </div>
                                            <h5 class="col-md-3">{!! $projectDetails->mandatory_pre_bidding !!}</h5>   
                                        </div>

                                        <div class="col-md-12">
                                            <div class="col-md-3 box-heading">Valuation : </div>
                                            <h5 class="col-md-3">{!! $projectDetails->valuation !!}</h5>
                                            <!--<div class="col-md-3 box-heading">Documents : </div>
                                            <h5 class="col-md-3">
                                                @if(file_exists(public_path('uploads/project/documents/'.$projectDetails->documents)) && $projectDetails->documents != '')
                                                <br><a target="_blank" href="{{asset('uploads/project/documents/'.$projectDetails->documents)}}"><img src="{{asset('images/pdf-icon.png')}}"></a>
                                                @endif
                                            </h5> -->  
                                        </div> 
                                        
                                        <div class="col-md-12">
                                            <div class="col-md-3 box-heading">Description : </div>
                                            <h5 class="col-md-3">{!! $projectDetails->description !!}</h5>
                                            <div class="col-md-3 box-heading">Additional Comments : </div>
                                            <h5 class="col-md-3">{!! $projectDetails->additional_comments !!}</h5>   
                                        </div>
                                        <div class="form-actions">
                                        <div class="col-md-12">
                                        <a href="{{URL::route('admin_project_awarded_to_view',[$projectDetails->id])}}" class="btn btn-primary">Next</a>
                                        <a class="btn btn-default" href="{{URL::route('admin_project')}}">Cancel</a>
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