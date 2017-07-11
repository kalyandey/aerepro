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
                                            <div class="col-md-3 box-heading">Principal Company : </div>
                                            <h5 class="col-md-3 list-group-item-heading">{!! $projectDetails->company[0]->company_name !!}</h5>
                                            <div class="col-md-3 box-heading">Principal Name : </div>
                                            <h5 class="col-md-3">{!! $projectDetails->company[0]->user_name !!}</h5>   
                                        </div>
                                        <div class="col-md-12">
                                            <div class="col-md-3 box-heading">Principal Address : </div>
                                            <h5 class="col-md-3">{!! $projectDetails->company[0]->address !!}</h5>
                                            <div class="col-md-3 box-heading">Principal City : </div>
                                            <h5 class="col-md-3">{!! $projectDetails->company[0]->city !!}</h5>   
                                        </div>
                                        <div class="col-md-12">
                                            <div class="col-md-3 box-heading">Principal State : </div>
                                            <h5 class="col-md-3">{!! $projectDetails->company[0]->state_name->state !!}</h5>
                                            <div class="col-md-3 box-heading">Principal Zip : </div>
                                            <h5 class="col-md-3">{!! $projectDetails->company[0]->zip !!}</h5>   
                                        </div>
                                        <div class="col-md-12">
                                            <div class="col-md-3 box-heading">Principal Phone : </div>
                                            <h5 class="col-md-3">{!! $projectDetails->company[0]->phone !!}</h5>
                                            <div class="col-md-3 box-heading">Principal Fax : </div>
                                            <h5 class="col-md-3">{!! $projectDetails->company[0]->fax !!}</h5>   
                                        </div>
                                        <div class="col-md-12">
                                            <div class="col-md-3 box-heading">Principal Email : </div>
                                            <h5 class="col-md-3">{!! $projectDetails->company[0]->email !!}</h5> 
                                        </div>         
                                        <div class="form-actions">
                                        <div class="col-md-12">
                                        <a href="{{URL::route('admin_project_contrctor_view',[$projectDetails->id])}}" class="btn btn-primary">Next</a>
                                        <a class="btn btn-default" href="{{URL::route('admin_project_address_view',[$projectDetails->id])}}">Back</a>
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