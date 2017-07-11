@extends('admin.layout')
@section('content')
@section('title', 'Profile')   
<div id="title-breadcrumb-option-demo" class="page-title-breadcrumb">
                <div class="page-header pull-left">
                    <div class="page-title">Profile</div>
                </div>
                <ol class="breadcrumb page-breadcrumb pull-right">
                    <li><i class="fa fa-home"></i>&nbsp;<a href="javascript:void(0);">Home</a>&nbsp;&nbsp;<i class="fa fa-angle-right"></i>&nbsp;&nbsp;</li>
                    <li class="hidden"><a href="javascript:void(0);">Dashboard</a>&nbsp;&nbsp;<i class="fa fa-angle-right"></i>&nbsp;&nbsp;</li>
                    <li class="active">Profile</li>
                </ol>
                <div class="clearfix"></div>
    </div>
    <div class="page-content">
        <div id="form-layouts" class="row">
            <div class="col-lg-12">
                <div class="row">
                
                <div class="col-lg-12">
                @if(count($errors)>0)
                <div class="note note-danger">
                @foreach($errors->all() as $error)
                            <p class="text-red">{{$error}}</p>
                @endforeach
                </div>
                @endif
                </div>
                
                
                    <div class="col-lg-12">
                    
                    <!-------------panel start-------------->
                        <div class="panel panel-yellow">
                                            <div class="panel-heading">Pofile Update</div>
                                            <div class="panel-body pan">
                                            {!! Form::open(array('route'=>'admin_profile_update','class'=>'form-horizontal form-validate','id'=>'admin_profile_update'))!!}
                                             {!!  Form::hidden('profile_id',$profile->id) !!}
                                                    <div class="form-body pal">
                                                 
                                                        <div class="form-group">
                                                        <label class="col-md-3 control-label" for="inputUsername">Email <span class="require"></span></label>

                                                            <div class="col-md-9">
                                                                <div class="input-icon"><i class="fa fa-envelope"></i>
                                                                {!! Form::text('email',$profile->email,array('class'=>'form-control required','readonly'))!!}
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <div class="form-group">
                                                        <label class="col-md-3 control-label" for="inputUsername">First Name <span class="require">*</span></label>

                                                            <div class="col-md-9">
                                                                <div class="input-icon"><i class="fa fa-user"></i>
                                                                {!! Form::text('first_name',$profile->first_name,array('class'=>'form-control required','placeholder'=>'Enter your first name'))!!}
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <div class="form-group">
                                                        <label class="col-md-3 control-label" for="inputUsername">Last Name <span class="require">*</span></label>

                                                            <div class="col-md-9">
                                                                <div class="input-icon"><i class="fa fa-user"></i>
                                                                {!! Form::text('last_name',$profile->last_name,array('class'=>'form-control required','placeholder'=>'Enter your last name'))!!}
                                                                </div>
                                                            </div>
                                                        </div>
                                                            
                                                            
                                                            
                                                            
                                                            
                                                            
                                                    </div>
                                                    <div class="form-actions none-bg">
                                                        <div class="col-md-offset-3 col-md-9">
                                                            {!! Form::button('Update',array('type'=>'submit','class'=>'btn btn-primary')) !!}
                                                            &nbsp;
                                                            {!! Html::linkRoute('admin_dashboard','Cancel',array(),array('class'=>'btn btn-green')) !!}
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