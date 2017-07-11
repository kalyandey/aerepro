@extends('admin/layout')
@section('title', 'Profession Update')
@section('content')
		<div class="page-title-breadcrumb" id="title-breadcrumb-option-demo">
				<div class="page-header pull-left">
						<div class="page-title">Email Campaign</div>
				</div>
				<ol class="breadcrumb page-breadcrumb pull-right">
						<li>
								<i class="fa fa-file-text-o"></i>&nbsp;
								<a href="{{ URL::route('admin_emailcampaign') }}">Email Campaign</a>&nbsp;&nbsp;<i class="fa fa-angle-right"></i>&nbsp;&nbsp;
						</li>
						<li>
								<i class="fa fa-home"></i>&nbsp;
								<a href="javascript:void(0);">Update </a>&nbsp;&nbsp;
						</li>
				</ol>
				<div class="clearfix"></div>
		</div>
		<div class="page-content">
				<div class="row">
						<div class="col-lg-12">
								<div class="panel panel-yellow">
										<div class="panel-heading">Campaign Update</div>
										<div class="panel-body pan">                                    
												{!! Form::open(array('route'=>array('admin_update_emailcampaign'),'class'=>'form-horizontal form-validate')) !!}
														{!! Form::hidden('id',$list[0]->id) !!}
														{!! Form::hidden('company_id',$list[0]->company_id) !!}
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
																<div class="form-group">
																		<label class="col-md-3 control-label" for="inputName">Company</label>
																		<div class="col-md-9">
																				<div class="input-icon right">
																						{!! Form::text('companyid',$list[0]->CompanyName,array('class'=>'form-control required','placeholder'=>'Company Name','id'=>'companyid','readonly' ))!!}
																				</div>
																		</div>
																</div>
																																				
																<div class="form-group">
																		<label class="col-md-3 control-label" for="inputName">User</label>
																		<div class="col-md-9">
																				<div class="input-icon right">
																						@foreach($userlist as $ul)
																								{{ Form::checkbox('chkuser[]',$ul->id,in_array($ul->id, explode(',',$list[0]->user_id)),['class' => 'roles']) }}
																								{!! $ul->first_name !!}
																						@endforeach
																				</div>
																		</div>
																</div>
			
																<div class="form-group">
																		<label class="col-md-3 control-label" for="inputName">Email Subject</label>
																		<div class="col-md-9">
																				<div class="input-icon right">
																						{!! Form::text('email_subject',$list[0]->email_subject,array('class'=>'form-control required','placeholder'=>'Email Subject','id'=>'email_subject' ))!!}
																				</div>
																		</div>
																</div>		
																
																<div class="form-group">
																		<label class="col-md-3 control-label" for="inputName">Email Content</label>
																		<div class="col-md-9">
																				<div class="input-icon right">
																						{!! Form::textarea('email_content',$list[0]->email_content,array('class'=>'form-control required ckeditor', 'placeholder'=>'Email Content','id'=>'email_content'))!!}
																				</div>
																		</div>
																</div>	
																
																<div class="form-group">
																		<label class="col-md-3 control-label" for="inputName">Status</label>
																		<div class="col-md-9">
																				<div class="input-icon right">
																						{!! Form::select('status',['Active' => 'Active','Inactive' => 'Inactive'],$list[0]->status,array('class'=>'form-control required','id'=>'status' ))!!}
																				</div>
																		</div>
																</div>        
														</div>
														<div class="form-actions pal">
																<div class="form-group mbn">
																		<div class="col-md-offset-3 col-md-6">
																				{!! Form::submit('Submit',array('class'=>'btn btn-primary' )) !!}&nbsp;&nbsp;
																				{!! Html::linkRoute('admin_emailcampaign', 'Cancel', array(), array('class' => 'btn btn-green')) !!}
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