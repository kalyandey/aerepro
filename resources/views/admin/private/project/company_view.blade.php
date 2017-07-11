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
                                <div class="topTabText">
                                    @include('admin.private.project.menu_view')
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-12 allViewSection">
                                    <!--<h3>Account Information</h3>-->
                                    @if(count($details->company) > 0)
                                        <div class="col-md-12">
                                            <div class="col-md-3 box-heading">Logo : </div>
                                            <h5 class="col-md-3 list-group-item-heading">
                                            @if($details->company->logo != '' && file_exists(public_path('uploads/private_planroom/company_logo/thumb/'.$details->company->logo)))
                                                        {{ Html::image(asset('uploads/private_planroom/company_logo/thumb/'.$details->company->logo)) }}
                                            @endif
                                            </h5>
                                        </div>        
                                        <div class="col-md-12">
                                            <div class="col-md-3 box-heading">Company Name : </div>
                                            <h5 class="col-md-3 list-group-item-heading">{!! $details->company->company_name !!}</h5>
                                            <div class="col-md-3 box-heading">Name : </div>
                                            <h5 class="col-md-3">{!! $details->company->first_name .' '.$details->company->last_name  !!}</h5>   
                                        </div>
                                        <div class="col-md-12">
                                            <div class="col-md-3 box-heading">Email : </div>
                                            <h5 class="col-md-3">{!! $details->company->email !!}</h5>
                                            <div class="col-md-3 box-heading">Phone No : </div>
                                            <h5 class="col-md-3">{!! $details->company->phone_no !!}</h5>   
                                        </div>
                                        <div class="col-md-12">
                                            <div class="col-md-3 box-heading">Domain : </div>
                                            <h5 class="col-md-3">{!! $details->company->domain !!}</h5>  
                                        </div>
                                        @else
                                                <div class="col-md-12">
                                                            <h3 class="col-md-12 box-heading">Result not found </h3>
                                                </div>
                                        @endif
                                        <div class="form-actions">
                                        <div class="col-md-12">
                                        <a href="{{URL::route('admin_private_project_details',[$details->id])}}" class="btn btn-primary">Next</a>
                                        <a class="btn btn-default" href="{{URL::route('admin_private_project')}}">Back</a>
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