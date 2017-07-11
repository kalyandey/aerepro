@extends('admin.layout')
@section('content')
    
    <div id="title-breadcrumb-option-demo" class="page-title-breadcrumb">
                <div class="page-header pull-left">
                    <div class="page-title">Edit Project</div>
                </div>
                <ol class="breadcrumb page-breadcrumb pull-right">
                    <li><i class="fa fa-home"></i>&nbsp;<a href="javascript:void(0);">Home</a>&nbsp;&nbsp;<i class="fa fa-angle-right"></i>&nbsp;&nbsp;</li>
                    <li class="active">Edit Project</li>
                </ol>
                <div class="clearfix"></div>
    </div>
    <div class="page-content">
        <div id="form-layouts" class="row">
            <div class="col-lg-12">
                    <div class="portlet box portlet-yellow">
                        <div class="portlet-header">
                            <div class="caption">Edit Project : {!! $projectDetails->name !!}</div>
                        </div>
                        <div class="portlet-body">
                            <div class="row">
                                <div class="topTabText">
                                    @include('admin.project.menu')
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-12">
                                    <!--<h3>Account Information</h3>-->
                                    <br>
                                        {!! Form::open(array('route'=>array('admin_project_principle',$projectDetails->id),'class'=>'form-validate form-horizontal','files'=>true,'method'=>'post')) !!}
                                        {!! Form::hidden('action','Process')!!}
                                        <div class="form-group">
                                            <label for="Company Name" class="col-md-3 control-label">Principal Company</label>
                                            <div class="col-md-9">{!! Form::text('company_name',$projectDetails->company[0]->company_name,['class'=>'form-control required','id' => 'company_name'])!!}</div>
                                        </div>
                                        <div class="form-group">
                                            <label for="user_name" class="col-md-3 control-label">Principal Contact</label>
                                            <div class="col-md-9">{!! Form::text('user_name',$projectDetails->company[0]->user_name,['class'=>'form-control','id' => 'user_name'])!!}</div>
                                        </div>
                                        <div class="form-group">
                                            <label for="address" class="col-md-3 control-label">Principal Address</label>
                                            <div class="col-md-9">{!! Form::text('address',$projectDetails->company[0]->address,['class'=>'form-control','id' => 'address'])!!}</div>
                                        </div> 
                                        <div class="form-group">
                                            <label for="city" class="col-md-3 control-label">Principal City</label>
                                            <div class="col-md-9">{!! Form::text('city',$projectDetails->company[0]->city,['class'=>'form-control','id' => 'city'])!!}</div>
                                        </div>
                                        <div class="form-group">
                                            <label for="State" class="col-md-3 control-label">Principal State</label>
                                            <div class="col-md-9">{!! Form::select('state',$state,$projectDetails->company[0]->state,['class'=>'form-control','id' => 'state'])!!}</div>
                                        </div>
                                        <div class="form-group">
                                            <label for="Zip" class="col-md-3 control-label">Principal Zip</label>
                                            <div class="col-md-9">{!! Form::text('zip',$projectDetails->company[0]->zip,['class'=>'form-control','id' => 'Zip'])!!}</div>
                                        </div>
                                        <div class="form-group">
                                            <label for="phone" class="col-md-3 control-label">Principal Phone</label>
                                            <div class="col-md-9">{!! Form::text('phone',$projectDetails->company[0]->phone,['class'=>'form-control','id' => 'phone'])!!}</div>
                                        </div>
                                        <div class="form-group">
                                            <label for="fax" class="col-md-3 control-label">Principal Fax: </label>
                                            <div class="col-md-9">{!! Form::text('fax',$projectDetails->company[0]->fax,['class'=>'form-control','id' => 'fax'])!!}</div>
                                        </div>
                                        <div class="form-group">
                                            <label for="email" class="col-md-3 control-label">Principal Email:</label>
                                            <div class="col-md-9">{!! Form::email('email',$projectDetails->company[0]->email,['class'=>'form-control email','id' => 'email'])!!}</div>
                                        </div>         
                                        <div class="form-actions">
                                        <div class="col-md-12">
                                        {!! Form::submit('Submit',['class'=>'btn btn-primary'])!!}
                                        <a class="btn btn-default" href="{{URL::route('admin_project_address',$projectDetails->id)}}">back</a>
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