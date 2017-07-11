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
                                    @if(count($projectDetails->contractor_assign) > 0)
                                    @foreach( $projectDetails->contractor_assign as $ps)
                                        <div class="col-md-12">
                                            <div class="col-md-3 box-heading">Business Name : </div>
                                            <h5 class="col-md-3 list-group-item-heading">{!! $ps->contractor->business_name !!}</h5>
                                            <div class="col-md-3 box-heading">Contact Name : </div>
                                            <h5 class="col-md-3">{!! $ps->contractor->name !!}</h5>   
                                        </div>
                                        <div class="col-md-12">
                                            <div class="col-md-3 box-heading">Street : </div>
                                            <h5 class="col-md-3">{!! $ps->contractor->street !!}</h5>
                                            <div class="col-md-3 box-heading">City : </div>
                                            <h5 class="col-md-3">{!! ($ps->contractor->city != '')?$ps->contractor->city:'N/A' !!}</h5>   
                                        </div>
                                        <div class="col-md-12">
                                            <div class="col-md-3 box-heading">State : </div>
                                            <h5 class="col-md-3">{!! (count($ps->contractor->state_name) > 0)?$ps->contractor->state_name->state:'N/A' !!}</h5>
                                            <div class="col-md-3 box-heading">Zip : </div>
                                            <h5 class="col-md-3">{!! $ps->contractor->zip !!}</h5>   
                                        </div>
                                        <div class="col-md-12">
                                            <div class="col-md-3 box-heading">Phone : </div>
                                            <h5 class="col-md-3">{!! $ps->contractor->phone !!}</h5>
                                            <div class="col-md-3 box-heading">Fax : </div>
                                            <h5 class="col-md-3">{!! $ps->contractor->fax !!}</h5>   
                                        </div>
                                        <div class="col-md-12">
                                            <div class="col-md-3 box-heading">Email : </div>
                                            <h5 class="col-md-3">{!! $ps->contractor->email !!}</h5> 
                                        </div>
                                        <div class="col-md-12"></div>        
                                        @endforeach        
                                        @else
                                                <div class="col-md-12">
                                                            <h3 class="col-md-12 box-heading">Result not found </h3>
                                                </div>
                                        @endif
                                        <div class="form-actions">
                                        <div class="col-md-12">
                                        <a href="{{URL::route('admin_project_plan_view',[$projectDetails->id])}}" class="btn btn-primary">Next</a>
                                        <a class="btn btn-default" href="{{URL::route('admin_project_principle_view',[$projectDetails->id])}}">Back</a>
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