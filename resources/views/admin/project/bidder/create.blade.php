@extends('admin/layout')

@section('title', 'Bidder Create')

@section('content')
    <div class="page-title-breadcrumb" id="title-breadcrumb-option-demo">
                <div class="page-header pull-left">
                    <div class="page-title">Bidder</div>
                </div>
                <ol class="breadcrumb page-breadcrumb pull-right">
                    <li>
                    <i class="fa fa-file-text-o"></i>&nbsp;
                    <a href="{{ URL::route('admin_planroom_trade') }}">Bidder</a>&nbsp;&nbsp;<i class="fa fa-angle-right"></i>&nbsp;&nbsp;
                    </li>
                    <li>
                    <i class="fa fa-home"></i>&nbsp;
                    <a href="javascript:void(0);">Create </a>&nbsp;&nbsp;
                    </li>
                 
                </ol>
                <div class="clearfix"></div>
            </div>
<div class="page-content">
                <div class="row">
                    <div class="col-lg-12">
		    <div class="panel panel-yellow">
                            <div class="panel-heading">Bidder Create</div>
                            <div class="panel-body pan">                                    
                                    {!! Form::open(array('route'=>array('admin_bidder_add',$project_id),'class'=>'form-horizontal form-validate')) !!}
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
                                                <div class="form-group col-md-6"><label class="col-md-4 control-label" for="inputName"><input type="radio" name="bidder_add" value="choose" class="add_bidder" checked>&nbsp;Select Bidder</label>
						    <div class="col-md-8">
							<div class="input-icon right">
							    {!! Form::text('get_bidder','',['class'=>'form-control','id' => 'choose_bidder'])!!}
                                                            {!! Form::hidden('bidder','',['id' => 'bidder_to_id']) !!}
                                                            {!! Form::hidden('hidden_project_id',$project_id,['id' => 'hidden_project_id']) !!}
                                                        </div>
						    </div>
                                                    
						</div>
                                                <div class="form-group col-md-6"><label class="col-md-5 control-label" for="inputName"><input type="radio" value="other" name="bidder_add" class="add_bidder">&nbsp;Create New Bidder</label>
						    <div class="col-md-7">
							<div class="input-icon right">
							    &nbsp;
							</div>
						    </div>
						</div>
						<div class="add_new_bidder" style="display:none;">
						<div class="form-group"><label class="col-md-3 control-label" for="inputName">Company</label>
						    <div class="col-md-9">
							<div class="input-icon right">
							    {!! Form::text('company','',array('class'=>'form-control required','placeholder'=>'Company','id'=>'company' ))!!}
							</div>
						    </div>
						</div>
						<div class="form-group"><label class="col-md-3 control-label" for="contact">Contact</label>
						    <div class="col-md-9">
							<div class="input-icon right">
							    {!! Form::text('contact','',array('class'=>'form-control required','placeholder'=>'Contact','id'=>'contact' ))!!}
							</div>
						    </div>
						</div>
						<div class="form-group"><label class="col-md-3 control-label" for="phone">Phone</label>
						    <div class="col-md-9">
							<div class="input-icon right">
							    {!! Form::text('phone','',array('class'=>'form-control','placeholder'=>'Phone','id'=>'phone' ))!!}
							</div>
						    </div>
						</div>
						<div class="form-group"><label class="col-md-3 control-label" for="fax">Fax</label>
						    <div class="col-md-9">
							<div class="input-icon right">
							    {!! Form::text('fax','',array('class'=>'form-control','placeholder'=>'Fax','id'=>'fax' ))!!}
							</div>
						    </div>
						</div>
						<div class="form-group"><label class="col-md-3 control-label" for="email">Email</label>
						    <div class="col-md-9">
							<div class="input-icon right">
							    {!! Form::email('email','',array('class'=>'form-control required','placeholder'=>'Email','id'=>'email' ))!!}
							</div>
						    </div>
						</div>
						<div class="form-group"><label class="col-md-3 control-label" for="address">Address</label>
						    <div class="col-md-9">
							<div class="input-icon right">
							    {!! Form::textarea('address','',array('class'=>'form-control required','placeholder'=>'Address','id'=>'address' ))!!}
							</div>
						    </div>
						</div>
						
				    
						</div>
						</div>
                                    <div class="form-actions pal">
                                        <div class="form-group mbn">
                                            <div class="col-md-offset-3 col-md-6">
                                            {!! Form::submit('Submit',array('class'=>'btn btn-primary' )) !!}&nbsp;&nbsp;
                                            {!! Html::linkRoute('admin_bidder_list', 'Cancel', array($project_id), array('class' => 'btn btn-green')) !!}
                                            </div>
                                        </div>
                                    </div>
                                    {!! Form::close() !!}
                            </div>
                        </div>
                     
                         </div>
                </div>
            </div>
	    <script>
			$(function(){
				    $('.add_bidder').click(function(){ 
						if($(this).val() == 'other'){
							$('#choose_bidder').val(''); 
                                                        $('#bidder_to_id').val(''); 
                                                        $('.add_new_bidder').show();   
						}else{
							 $('.add_new_bidder').hide();    
						}
				    });
				    
			});
	    </script>
@endsection