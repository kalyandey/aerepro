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
                                <div class="topTabText">
                                    @include('admin.project.menu_view')
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-12">
                                    @php
                                                $specsDtls = array();
                                    @endphp
                                    @if(count($projectDetails->specs) > 0)
                                    @foreach($projectDetails->specs as $specs)
                                                @php
                                                $specsDtls[$specs->specs_category->name][] = $specs
                                                @endphp
                                    @endforeach
                                    @endif
                                    @if(count($specsDtls) > 0)
                                    @foreach($specsDtls as $k=>$spec)
                                                <div class="col-md-12 allViewSection">
                                                <div class="col-md-3 box-heading">
                                                {!! $k !!}
                                                </div>
                                                @foreach($spec as $s)         
                                                <div class="col-md-12">
                                                <div class="col-md-4">{!! $s->name !!}</div>
                                                <div class="col-md-4">{!! $k !!}</div>
                                                <div class="col-md-4">
                                                @if(Helpers::isFileExist('uploads/project/specs/'.$s->file_name) && $s->file_name != '')
                                                <a target="_blank" href="{{Helpers::isFileExist('uploads/project/specs/'.$s->file_name)}}"><b>View PDF</b></a>
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
                                        <a href="{{URL::route('admin_project')}}" class="btn btn-primary">Next</a>
                                        <a class="btn btn-default" href="{{URL::route('admin_project_plan_view',[$projectDetails->id])}}">Back</a>
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