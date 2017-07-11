@extends('admin/layout')

@section('title', 'Sitesettings Update')

@section('content')
    <div class="page-title-breadcrumb" id="title-breadcrumb-option-demo">
                <div class="page-header pull-left">
                    <div class="page-title">Email Templete</div>
                </div>
                <ol class="breadcrumb page-breadcrumb pull-right">
                    <li>
                    <i class="fa fa-cogs"></i>&nbsp;
                    <a href="{{ URL::route('admin_sitesettings') }}">Email Templete</a>&nbsp;&nbsp;<i class="fa fa-angle-right"></i>&nbsp;&nbsp;
                    </li>
                    <li>
                    <i class="fa fa-home"></i>&nbsp;
                    <a href="javascript:void(0);">Edit </a>&nbsp;&nbsp;
                    </li>
                 
                </ol>
                <div class="clearfix"></div>
            </div>
<div class="page-content">
                <div class="row">
                    <div class="col-lg-12">
		    <div class="panel panel-yellow">
                            <div class="panel-heading">Email Templete Update</div>
                            <div class="panel-body pan">                                    
                                    {!! Form::open(array('route'=>array('admin_emailtemplate_update_action',$lists->id),'class'=>'form-horizontal form-validate')) !!}
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
						<div class="form-group"><label class="col-md-3 control-label" for="sitesettings_lebel">Email Subject</label>
	
						    <div class="col-md-9">
							<div class="input-icon right">
							{!! Form::text('email_subject',$lists->email_subject,array('class'=>'form-control required'))!!}
							</div>
						    </div>
						</div>
						<div class="form-group">
							    <label for="email_content" class="col-md-3 control-label">Email Content</label>
							    <div class="col-md-9">
							    <span style="color:red; font-size: 11px;">Template Variables: [ {!! $lists->template_variables !!} ] <span style="font-style: italic">(do not change any variable's name this will causes error)</span></span>
									{!! Form::textarea('email_content',$lists->email_content,['class'=>'form-control ckeditor','id' => 'email_content'])!!}</div>
						</div>
                                        
                                    </div>
                                    <div class="form-actions pal">
                                        <div class="form-group mbn">
                                            <div class="col-md-offset-3 col-md-6">
                                            {!! Form::submit('Submit',array('class'=>'btn btn-primary' )) !!}&nbsp;&nbsp;
                                            {!! Html::linkRoute('admin_emailtemplate', 'Cancel', array(), array('class' => 'btn btn-green')) !!}
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