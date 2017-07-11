@extends('admin/layout')

@section('title', 'Admin Role Edit')

@section('content')
<div class="page-title-breadcrumb" id="title-breadcrumb-option-demo">
                <div class="page-header pull-left">
                    <div class="page-title">Edit Role</div>
                </div>
                <ol class="breadcrumb page-breadcrumb pull-right">
                    <li>
                    <i class="fa fa-file-text-o"></i>&nbsp;
                    <a href="{{ URL::route('admin_role') }}">Role</a>&nbsp;&nbsp;<i class="fa fa-angle-right"></i>&nbsp;&nbsp;
                    </li>
                    <li>
                    <i class="fa fa-home"></i>&nbsp;
                    <a href="javascript:void(0);">Edit Role </a>&nbsp;&nbsp;
                    </li>
                 
                </ol>
                <div class="clearfix"></div>
            </div>
<div class="page-content">
                <div class="row">
                    <div class="col-lg-12">
		    <div class="panel panel-yellow">
                            <div class="panel-heading">Edit Role</div>
                            <div class="panel-body pan">                                    
                                    {!! Form::open(array('route'=>'admin_role_update','class'=>'form-horizontal form-validate','novalidate')) !!}
                                    {!! Form::hidden('id',$details->id) !!}
                                    <div class="form-body pal">
                                                @if (count($errors) > 0)
                                                            <div class="alert alert-danger">
                                                                <ul>
                                                                    @foreach ($errors->all() as $error)
                                                                        <li>{{ $error }}</li>
                                                                    @endforeach
                                                                </ul>
                                                            </div>
                                                @endif
                                        <div class="form-group"><label class="col-md-3 control-label" for="inputName">Role</label>

                                            <div class="col-md-9">
                                                <div class="input-icon right">
                                                        {!! Form::text('name',$details->name,array('class'=>"form-control required", 'placeholder'=>"Admin Role Name", 'id'=>"name")) !!}
                                                </div>
                                            </div>
                                        </div>
                                        <div class="form-group"><label class="col-md-3 control-label" for="inputName">Display Name</label>        
                                            <div class="col-md-9">
                                                <div class="input-icon right">
                                                       {!! Form::text('display_name',$details->display_name,array('class'=>"form-control required", 'placeholder'=>"Display Role Name", 'id'=>"display_name")) !!}
                                                </div>
                                            </div>
                                        </div>  
                                        <div class="form-group"><label class="col-md-3 control-label" for="inputName">Description</label>                
                                            <div class="col-md-9">
                                                <div class="input-icon right">
                                                        {!! Form::textarea('desc',$details->description,array('class'=>"form-control required", 'placeholder'=>"Role Description", 'id'=>"desc")) !!}
                                                </div>
                                            </div>
                                         </div>   
                                       </div>
                                       <div class="form-actions pal">
                                        <div class="form-group mbn">
                                            <div class="col-md-offset-3 col-md-6">
                                            {!! Form::submit('Update',array('class'=>'btn btn-primary' )) !!}&nbsp;&nbsp;
                                            {!! Html::linkRoute('admin_role', 'Cancel', array(), array('class' => 'btn btn-green')) !!}
                                            </div>
                                        </div>
                                    </div>
                                    {!! Form::close() !!}
                            </div>
                        </div>
                     
                         </div>
                </div>
            </div>
		
@endsection
