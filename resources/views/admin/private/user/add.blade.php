@extends('admin.layout')
@section('content')
    
    <div id="title-breadcrumb-option-demo" class="page-title-breadcrumb">
                <div class="page-header pull-left">
                    <div class="page-title">Add Private Planroom User</div>
                </div>
                <ol class="breadcrumb page-breadcrumb pull-right">
                    <li><i class="fa fa-user"></i>&nbsp;<a href="javascript:void(0);">Users</a>&nbsp;&nbsp;<i class="fa fa-angle-right"></i>&nbsp;&nbsp;</li>
                    <li><i class="fa fa-user"></i>&nbsp;<a href="{{URL::route('private_users') }}">Private Planroom Users</a>&nbsp;&nbsp;<i class="fa fa-angle-right"></i>&nbsp;&nbsp;</li>
                    <li class="active"><i class="fa fa-user"></i>&nbsp; Add</li>
                </ol>
                <div class="clearfix"></div>
    </div>
    <div class="page-content">
        <div id="form-layouts" class="row">
            <div class="col-lg-12">
                    <div class="portlet box portlet-yellow">
                        <div class="portlet-header">
                            <div class="caption">Add private planroom user </div>
                        </div>
                        <div class="portlet-body">
                            <div class="row">
                                <div class="col-md-12">
                                    @if (count($errors) > 0)
                                                <div class="alert alert-danger">
                                                    <ul>
                                                        @foreach ($errors->all() as $error)
                                                            <li>{{ $error }}</li>
                                                        @endforeach
                                                    </ul>
                                                </div>
                                    @endif
                                    <br>
                                        {!! Form::open(array('route'=>['private_user_create'],'class'=>'form-validate form-horizontal','files'=>true,'method'=>'post')) !!}
                                        {!! Form::hidden('project_id',(count($project) > 0)?$project->id:'') !!}
                                        @if(count($project) > 0)
                                        <div class="form-group">
                                            <label for="Street" class="col-md-2 control-label">Company</label>
                                            <div class="col-md-10">
                                            {!! Form::text('company_name',$project->company->company_name,['class'=>'form-control','disabled'=>'disabled'])!!}
                                            {!! Form::hidden('company',$project->company->id) !!}</div>
                                        </div>
                                        @else
                                        <div class="form-group">
                                            <label for="Street" class="col-md-2 control-label">Company</label>
                                            <div class="col-md-10">{!! Form::select('company',[''=>'Select any company']+$companies,'',array('class'=>'form-control required','id'=>'inputCompany')) !!}</div>
                                        </div>
                                        @endif
                                        <div class="form-group">
                                            <label for="first_name" class="col-md-2 control-label">First Name</label>
                                            <div class="col-md-10"> {!! Form::text('first_name','',['class'=>'form-control required','id' => 'first_name','placeholder'=>'First Name'])!!}</div>
                                        </div>
                                        <div class="form-group">
                                            <label for="first_name" class="col-md-2 control-label">Last Name</label>
                                            <div class="col-md-10"> {!! Form::text('last_name','',['class'=>'form-control required','id' => 'last_name', 'placeholder'=>'Last Name'])!!}</div>
                                        </div>
                                        <div class="form-group">
                                            <label for="email" class="col-md-2 control-label">Email</label>
                                            <div class="col-md-10"> {!! Form::email('email','',['class'=>'form-control required','id' => 'email', 'placeholder'=>'Email'])!!}</div>
                                        </div>
                                        <div class="form-group">
                                            <label for="first_name" class="col-md-2 control-label">Password</label>
                                            <div class="col-md-10"> {!! Form::password('password',['class'=>'form-control required','id' => 'password', 'placeholder'=>'Password'])!!}</div>
                                        </div>
                                        <div class="form-group">
                                            <label for="first_name" class="col-md-2 control-label">Phone</label>
                                            <div class="col-md-10"> {!! Form::text('phone','',['class'=>'form-control required','id' => 'phone', 'placeholder'=>'Phone'])!!}</div>
                                        </div>
                                        <div class="form-group">
                                            <label for="first_name" class="col-md-2 control-label">Address</label>
                                            <div class="col-md-10"> {!! Form::textarea('address','',['class'=>'form-control required','id' => 'address', 'placeholder'=>'Address'])!!}</div>
                                        </div>        
                                        <div class="form-actions">
                                        <div class="col-md-12">
                                        {!! Form::submit('Submit',['class'=>'btn btn-primary'])!!}
                                        <a class="btn btn-default" href="{{URL::route('private_users')}}">Cancel</a>
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