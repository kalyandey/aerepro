@extends('admin/layout')

@section('title', 'Admin Users')

@section('content')
    <div id="title-breadcrumb-option-demo" class="page-title-breadcrumb">
                <div class="page-header pull-left">
                    <div class="page-title">Admin Users</div>
                </div>
                <ol class="breadcrumb page-breadcrumb pull-right">
                    <li><i class="fa fa-home"></i>&nbsp;<a href="javascript:void(0);">Home</a>&nbsp;&nbsp;<i class="fa fa-angle-right"></i>&nbsp;&nbsp;</li>
                    <li><i class="fa fa-user"></i>&nbsp;<a href="javascript:void(0);">Users</a>&nbsp;&nbsp;<i class="fa fa-angle-right"></i>&nbsp;&nbsp;</li>
                    <li><i class="fa fa-user"></i>&nbsp;<a href="javascript:void(0);">Admin Users</a>&nbsp;&nbsp;<i class="fa fa-angle-right"></i>&nbsp;&nbsp;</li>
                    <li class="active"><i class="fa fa-user"></i>&nbsp; Edit Admin Users</li>
                        
                </ol>
                <div class="clearfix"></div>
    </div>
    <div class="page-content">
        <div class="panel panel-yellow">
            <div class="panel-heading">Edit Admin User</div>
            <div class="panel-body pan">
           @if (count($errors) > 0)
            <div class="alert alert-danger">
                        <ul>
                            @foreach ($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
            </div>
            @endif
            @if( Session::has('succmsg') )
            <div class="note note-success">
            <p class='text-green'>{{Session::get('succmsg')}}</p>
            </div>
            @endif
            @if( Session::has('errorMessage') )
                <div class="note note-danger">
                <p class='text-red'>{{Session::get('errorMessage')}}</p>
                </div>
            @endif
                {!! Form::open(array('route'=>'admin_user_update','class'=>'form-validate')) !!}
                    {!! Form::hidden('user_id',$profile->id) !!}
                    <div class="form-body pal">
                        <div class="form-group">
                                    <label class="control-label" for="inputFirstName">First Name <span class="require">*</span></label>
                                    <input type="text" class="form-control required" name="first_name" placeholder="First Name" id="inputFirstName" value="{{ $profile->first_name }}">
                        </div>
                        <div class="form-group">
                                    <label class="control-label" for="inputLastName">Last Name</label>
                                    <input type="text" class="form-control" name="last_name" placeholder="Last Name" id="inputLastName" value="{{ $profile->last_name }}">
                        </div>
                        <div class="form-group">
                                    <label class="control-label" for="inputEmail">Email <span class="require">*</span></label>
                                    <input type="text" class="form-control required" name="email" placeholder="Email Address" id="inputEmail" value="{{ $profile->email }}" readonly>
                        </div>
                        <div class="form-group">
                                    <label class="control-label" for="inputPassword">Password <span class="require">*</span></label>
                                    <input type="password" class="form-control" name="password" placeholder="Password" id="inputPassword" autocomplete="false">
                        </div>
                        <div class="form-group">
                                    <label class="control-label" for="inputRole">Role <span class="require">*</span></label>
                                    {!! Form::select('role',[''=>'Select any role']+$roles,$profile->roleuser[0]->role_id,array('class'=>'form-control required','id'=>'inputRole')) !!}
                        </div>
                        <div class="form-group">
                                    <label class="col-md-3 control-label" for="inputName">Status</label>

                                           
                                    {!! Form::select('status',['Active' => 'Active','Inactive' => 'Inactive'],$profile->status,array('class'=>'form-control required','id'=>'status' ))!!}
                                               
                        </div>
                    </div>
                    <div class="form-actions pll prl">
                        <button class="btn btn-primary" type="submit">Update</button>
                        &nbsp;
                        {!! Html::linkRoute('admin_users','Cancel',array(),array('class'=>'btn btn-green')) !!}
                    </div>
                {!! Form::close() !!}
            </div>
        </div>
    </div>
@endsection