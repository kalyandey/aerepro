@extends('admin.layout')
@section('content')
@section('title', 'Change Password')   
<div id="title-breadcrumb-option-demo" class="page-title-breadcrumb">
                <div class="page-header pull-left">
                    <div class="page-title">Change Password</div>
                </div>
                <ol class="breadcrumb page-breadcrumb pull-right">
                    <li><i class="fa fa-home"></i>&nbsp;<a href="javascript:void(0);">Home</a>&nbsp;&nbsp;<i class="fa fa-angle-right"></i>&nbsp;&nbsp;</li>
                    <li class="hidden"><a href="javascript:void(0);">Dashboard</a>&nbsp;&nbsp;<i class="fa fa-angle-right"></i>&nbsp;&nbsp;</li>
                    <li class="active">Change Password</li>
                </ol>
                <div class="clearfix"></div>
    </div>
    <div class="page-content">
        <div id="form-layouts" class="row">
            <div class="col-lg-12">
                <div class="row">
                    <div class="col-lg-12">
                                
                    <!-------------panel start-------------->
                        <div class="panel panel-yellow">
                                            <div class="panel-heading">Change Password</div>
                                            <div class="panel-body pan">
                                            {!! Form::open(array('route'=>'admin_change_password_action','class'=>'form-horizontal form-validate','id'=>'admin_change_password'))!!}
                                                    <div class="form-body pal">
                                                     @if(count($errors)>0)
                                                @foreach($errors->all() as $error)
                                                    <p class='text-red'>{{$error}}</p>
                                                @endforeach
                                                @endif
                                                
                                                
                                                
                                                        <div class="form-group">
                                                        <label class="col-md-3 control-label" for="inputUsername">Old Password <span class="require">*</span></label>

                                                            <div class="col-md-9">
                                                                <div class="input-icon"><i class="fa fa-key"></i>
                                                                {!! Form::password('old_password',array('class'=>'form-control required','placeholder'=>'Enter your old password'))!!}
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <div class="form-group">
                                                        <label class="col-md-3 control-label" for="inputUsername">New Password <span class="require">*</span></label>

                                                            <div class="col-md-9">
                                                                <div class="input-icon"><i class="fa fa-key"></i>
                                                                {!! Form::password('new_password',array('class'=>'form-control required','placeholder'=>'Enter your password','id'=>'new_password'))!!}
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <div class="form-group">
                                                        <label class="col-md-3 control-label" for="inputUsername">Confirm Password <span class="require">*</span></label>

                                                            <div class="col-md-9">
                                                                <div class="input-icon"><i class="fa fa-key"></i>
                                                                {!! Form::password('confirm_password',array('class'=>'form-control required','placeholder'=>'Confirm your password'))!!}
                                                                </div>
                                                            </div>
                                                        </div>
                                                            
                                                           
                                                            
                                                    </div>
                                                    <div class="form-actions none-bg">
                                                        <div class="col-md-offset-3 col-md-9">
                                                            {!! Form::submit('Change Password',array('class'=>'btn btn-primary')) !!}
                                                            &nbsp;
                                                            {!! Html::linkRoute('dashboard','Cancel',array(),array('class'=>'btn btn-green')) !!}
                                                        </div>
                                                    </div>
                                                {!! Form::close() !!}
                                            </div>
                                        </div>
                
                <!-------------End panel start-------------->
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection