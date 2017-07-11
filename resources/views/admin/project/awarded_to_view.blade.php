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
                                <div class="col-md-12  allViewSection">
                                        {!! Form::hidden('action','Process') !!}
                                        
                                        <div class="col-md-12">
                                        <br>
                                        @if($projectDetails->awarded_to_contractor != '')
                                            <div class="col-md-12">
                                                <div class="col-md-3 box-heading">Business Name : </div>
                                                <h5 class="col-md-3 list-group-item-heading">{!! ($projectDetails->awarded_contractor->business_name != '')?$projectDetails->awarded_contractor->business_name:'N/A' !!}</h5>
                                                <div class="col-md-3 box-heading">Contact Name : </div>
                                                <h5 class="col-md-3">{!! ($projectDetails->awarded_contractor->name != '')?$projectDetails->awarded_contractor->name:'N/A' !!}</p></h5>   
                                            </div>
                                            <div class="col-md-12">
                                                <div class="col-md-3 box-heading">Street : </div>
                                                <h5 class="col-md-3 list-group-item-heading">{!! ($projectDetails->awarded_contractor->street != '')?$projectDetails->awarded_contractor->street:'N/A' !!}</h5>
                                                <div class="col-md-3 box-heading">City : </div>
                                                <h5 class="col-md-3">{!! (count($projectDetails->awarded_contractor->city_name)>0)?$projectDetails->awarded_contractor->city_name->city:'N/A' !!}</p></h5>   
                                            </div>
                                            <div class="col-md-12">
                                                <div class="col-md-3 box-heading">State : </div>
                                                <h5 class="col-md-3 list-group-item-heading">{!! (count($projectDetails->awarded_contractor->state_name)>0)?$projectDetails->awarded_contractor->state_name->state:'N/A' !!}</h5>
                                                <div class="col-md-3 box-heading">Zip : </div>
                                                <h5 class="col-md-3">{!! ($projectDetails->awarded_contractor->zip != '')?$projectDetails->awarded_contractor->zip:'N/A' !!}</p></h5>   
                                            </div>
                                            <div class="col-md-12">
                                                <div class="col-md-3 box-heading">Phone : </div>
                                                <h5 class="col-md-3 list-group-item-heading">{!! ($projectDetails->awarded_contractor->phone != '')?$projectDetails->awarded_contractor->phone:'N/A' !!}</h5>
                                                <div class="col-md-3 box-heading">Fax : </div>
                                                <h5 class="col-md-3">{!! ($projectDetails->awarded_contractor->fax != '')?$projectDetails->awarded_contractor->fax:'N/A' !!}</p></h5>   
                                            </div>
                                            <div class="col-md-12">
                                                <div class="col-md-3 box-heading">Email : </div>
                                                <h5 class="col-md-3 list-group-item-heading">{!! ($projectDetails->awarded_contractor->email != '')?$projectDetails->awarded_contractor->email:'N/A' !!}</h5>  
                                            </div>    
                                        @elseif($projectDetails->awarded_to_bidder != '')
                                            <div class="col-md-12">
                                                <div class="col-md-3 box-heading">Company Name : </div>
                                                <h5 class="col-md-3 list-group-item-heading">{!! ($projectDetails->awarded_bidder->company != '')?$projectDetails->awarded_bidder->company:'N/A' !!}</h5>
                                                <div class="col-md-3 box-heading">Contact Name : </div>
                                                <h5 class="col-md-3">{!! ($projectDetails->awarded_bidder->contact != '')?$projectDetails->awarded_bidder->contact:'N/A' !!}</p></h5>   
                                            </div>
                                            <div class="col-md-12">
                                                <div class="col-md-3 box-heading">Address : </div>
                                                <h5 class="col-md-3 list-group-item-heading">{!! ($projectDetails->awarded_bidder->address != '')?$projectDetails->awarded_bidder->address:'N/A' !!}</h5>
                                                <div class="col-md-3 box-heading">Phone : </div>
                                                <h5 class="col-md-3">{!! ($projectDetails->awarded_bidder->phone != '')?$projectDetails->awarded_bidder->phone:'N/A' !!}</p></h5>   
                                            </div>
                                            <div class="col-md-12">
                                                
                                                <div class="col-md-3 box-heading">Fax : </div>
                                                <h5 class="col-md-3">{!! ($projectDetails->awarded_bidder->fax != '')?$projectDetails->awarded_bidder->fax:'N/A' !!}</p></h5>
                                                <div class="col-md-3 box-heading">Email : </div>
                                                <h5 class="col-md-3 list-group-item-heading">{!! ($projectDetails->awarded_bidder->email != '')?$projectDetails->awarded_bidder->email:'N/A' !!}</h5>  
                                            </div>  
                                        @endif
                                            @if($projectDetails->awarded_to_contractor == '' && $projectDetails->awarded_to_bidder == '' )        
                                            <div class="col-md-3 box-heading">Awarded To : </div>
                                            <h5 class="col-md-3 list-group-item-heading">Not Yet</h5>
                                            @endif
                                        </div>
                                        <div class="form-actions">
                                        <div class="col-md-12">                                        <a href="{{URL::route('admin_project_address_view',[$projectDetails->id])}}" class="btn btn-primary">Next</a>
                                        <a class="btn btn-default" href="{{URL::route('admin_project_details',[$projectDetails->id])}}">Back</a>
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