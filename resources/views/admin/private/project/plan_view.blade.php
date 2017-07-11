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
                                <div class="col-md-12 ">
                                    @php
                                                $planDtls = array();
                                    @endphp
                                    @if(count($details->plan) > 0)
                                    @foreach($details->plan as $plan)
                                                @php
                                                $planDtls[$plan->plan_category->name][] = $plan
                                                @endphp
                                    @endforeach
                                    @endif
                                    @if(count($planDtls) > 0)
                                    @foreach($planDtls as $k=>$plan)
                                                <div class="col-md-12 allViewSection">
                                                <div class="col-md-3 box-heading">
                                                {!! $k !!}
                                                </div>
                                                @foreach($plan as $s)         
                                                <div class="col-md-12">
                                                <div class="col-md-4">{!! $s->plan_name !!}</div>
                                                <div class="col-md-4">{!! $k !!}</div>
                                                <div class="col-md-4">
                                                @if(Helpers::isFileExist('uploads/private_planroom/plan/'.$s->file_name) && $s->file_name != '')
                                                <a target="_blank" href="{{Helpers::isFileExist('uploads/private_planroom/plan/'.$s->file_name)}}"><b>View PDF</b></a>
                                                @endif
                                                </div>
                                                </div>
                                                @endforeach 
                                                </div>
                                    @endforeach
                                    @else
                                    
                                                <div class="col-md-12">
                                                <h3 class="col-md-12 box-heading">Result not found </h3>
                                                </div>
                                    @endif
                                    
                                    
                                        <div class="form-actions">
                                        <div class="col-md-12">
                                        <a href="{{URL::route('admin_private_project_speces_view',[$details->id])}}" class="btn btn-primary">Next</a>
                                        <a class="btn btn-default" href="{{URL::route('admin_private_project_details',[$details->id])}}">Back</a>
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