@extends('admin.layout')
@section('content')
    
    <div id="title-breadcrumb-option-demo" class="page-title-breadcrumb">
                <div class="page-header pull-left">
                    <div class="page-title">Edit Company</div>
                </div>
                <ol class="breadcrumb page-breadcrumb pull-right">
                    <li><i class="fa fa-home"></i>&nbsp;<a href="javascript:void(0);">Home</a>&nbsp;&nbsp;<i class="fa fa-angle-right"></i>&nbsp;&nbsp;</li>
                    <li class="active">Edit Company</li>
                </ol>
                <div class="clearfix"></div>
    </div>
    <div class="page-content">
        <div id="form-layouts" class="row">
            <div class="col-lg-12">
                    <div class="portlet box portlet-yellow">
                        <div class="portlet-header">
                            <div class="caption">Edit Company </div>
                        </div>
                        <div class="portlet-body">
                           <div class="row">
                                <div class="topTabText">
                                    @include('admin.private.project.menu')
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-12">
                                    <!--<h3>Account Information</h3>-->
                                    <br>
                                        {!! Form::open(array('route'=>array('admin_private_company_edit',$details->id),'class'=>'form-validate form-horizontal','files'=>true,'method'=>'post')) !!}
                                        {!! Form::hidden('action','Process')!!}
                                        
                                        <div class="form-group">
                                            <label for="Company Name" class="col-md-3 control-label">Select Company</label>
                                            <div class="col-md-9">{!! Form::select('company',$companies,$details->company_id,['class'=>'form-control required','id' => 'company'])!!}</div>
                                        </div>
                                        <div class="add_company">
                                        
                                        <div class="form-group">
                                            <label for="Company Name" class="col-md-3 control-label">Company Name</label>
                                            <div class="col-md-9">{!! Form::text('company_name','',['class'=>'form-control required','id' => 'company_name'])!!}</div>
                                        </div>
                                        <div class="form-group">
                                            <label for="first_name" class="col-md-3 control-label">First Name</label>
                                            <div class="col-md-9">{!! Form::text('first_name','',['class'=>'form-control required','id' => 'first_name'])!!}</div>
                                        </div>
                                        <div class="form-group">
                                            <label for="last_name" class="col-md-3 control-label">Last Name</label>
                                            <div class="col-md-9">{!! Form::text('last_name','',['class'=>'form-control required','id' => 'last_name'])!!}</div>
                                        </div> 
                                        <div class="form-group">
                                            <label for="city" class="col-md-3 control-label">Email</label>
                                            <div class="col-md-9">{!! Form::email('email','',['class'=>'form-control required','id' => 'email'])!!}</div>
                                        </div>
                                        <div class="form-group">
                                            <label for="State" class="col-md-3 control-label">Password</label>
                                            <div class="col-md-9">{!! Form::password('password',['class'=>'form-control','id' => 'password'])!!}</div>
                                        </div>
                                        <div class="form-group">
                                            <label for="Zip" class="col-md-3 control-label">Phone No</label>
                                            <div class="col-md-9">{!! Form::text('phone_no','',['class'=>'form-control required','id' => 'phone'])!!}</div>
                                        </div>
                                        <div class="form-group">
                                            <label for="phone" class="col-md-3 control-label">Domain</label>
                                            <div class="col-md-9">{!! Form::url('domain','',['class'=>'form-control','id' => 'domain'])!!}</div>
                                        </div>
                                        <div class="form-group">
                                            <label for="phone" class="col-md-3 control-label">Logo</label>
                                            <div class="col-md-9">
                                            {!! Form::file('logo',['class'=>'form-control','id' => 'logo'])!!}
                                            </div>
                                        </div>
                                        </div>        
                                        <div class="form-actions">
                                        <div class="col-md-12">
                                        {!! Form::submit('Submit',['class'=>'btn btn-primary'])!!}
                                        <a class="btn btn-default" href="{{URL::route('admin_private_project')}}">back</a>
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
            <script>
                        $(function(){
                                    $('#company').change(function(){
                                                if($(this).val() == 'other'){
                                                            $('.add_company').show();
                                                }else{
                                                            $('.add_company').hide();
                                                }
                                    });
                                    $('#company').trigger('change');
                        });
            </script>
@endsection