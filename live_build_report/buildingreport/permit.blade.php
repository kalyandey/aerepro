@extends('admin.layout')
@section('content')
    
    <div id="title-breadcrumb-option-demo" class="page-title-breadcrumb">
                <div class="page-header pull-left">
                    <div class="page-title">Edit PlanRoom Building Reports</div>
                </div>
                <ol class="breadcrumb page-breadcrumb pull-right">
                    <li><i class="fa fa-home"></i>&nbsp;<a href="javascript:void(0);">Home</a>&nbsp;&nbsp;<i class="fa fa-angle-right"></i>&nbsp;&nbsp;</li>
                    <li class="active">Edit PlanRoom Building Reports</li>
                </ol>
                <div class="clearfix"></div>
    </div>
    <div class="page-content">
        <div id="form-layouts" class="row">
            <div class="col-lg-12">
                    <div class="portlet box portlet-yellow">
                        <div class="portlet-header">
                            <div class="caption">Edit PlanRoom Building Reports</div>
                        </div>
                        <div class="portlet-body">
                            <div class="row">
                                <div >
                                    @include('admin.buildingreport.menu')
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-12">
                                    <!--<h3>Account Information</h3>-->
                                    <br>
                                        {!! Form::open(array('route'=>array('admin_buildingreport_permit',$lists->id),'class'=>'form-validate form-horizontal','files'=>true,'method'=>'post')) !!}
                                        {!! Form::hidden('action','Process')!!}
                                         <div class="form-group">
                                                <label for="Contractor" class="col-md-3 control-label">Permit Name</label>
                                                <div class="col-md-9">{!! Form::text('permit_name',(count($lists->permit_file)>0)?$lists->permit_file[0]->permit_name:'',['class'=>'form-control required','id' => 'contractor'])!!}</div>
                                        </div>
                                        <div class="form-group">        
                                        <label for="File" class="col-md-3 control-label">File</label>
                                        <div class="col-md-9">{!! Form::file('permit_pdf',['class'=>'form-control'])!!}
                                                <em style="color:red">Note : Pdf only</em>
                                                @if((count($lists->permit_file)>0))
                                                @if(Helpers::isFileExist('uploads/permit_pdf/'.$lists->permit_file[0]->permit_pdf) && $lists->permit_file[0]->permit_pdf != '')
                                                &nbsp;&nbsp;&nbsp;<a target="_blank" href="{{Helpers::isFileExist('uploads/permit_pdf/'.$lists->permit_file[0]->permit_pdf)}}"><b>Pdf view</b></a>
                                                @endif
                                                @endif
                                        </div>
                                        </div>
                                        <div class="form-actions">
                                        <div class="col-md-offset-9 col-md-9">
                                        {!! Form::submit('Submit',['class'=>'btn btn-primary'])!!}
                                        <a class="btn btn-default" href="{{URL::route('admin_buildingreport_owner',$lists->id)}}">back</a>
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