@extends('admin/layout')

@section('title', 'Bidder Update')

@section('content')
    <div class="page-title-breadcrumb" id="title-breadcrumb-option-demo">
                <div class="page-header pull-left">
                    <div class="page-title">Bidder</div>
                </div>
                <ol class="breadcrumb page-breadcrumb pull-right">
                    <li>
                    <i class="fa fa-file-text-o"></i>&nbsp;
                    <a href="{{ URL::route('admin_bidder_list',array($project_id)) }}">Bidder</a>&nbsp;&nbsp;<i class="fa fa-angle-right"></i>&nbsp;&nbsp;
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
                            <div class="panel-heading">Category Update</div>
                            <div class="panel-body pan">                                    
                                    {!! Form::open(array('route'=>array('admin_bidder_update',$project_id,$lists->id),'class'=>'form-horizontal form-validate')) !!}
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
						<div class="form-group"><label class="col-md-3 control-label" for="inputName">Company</label>
						    <div class="col-md-9">
							<div class="input-icon right">
							    {!! Form::text('company',$lists->company,array('class'=>'form-control required','placeholder'=>'Company','id'=>'company' ))!!}
							</div>
						    </div>
						</div>
						<div class="form-group"><label class="col-md-3 control-label" for="contact">Contact</label>
						    <div class="col-md-9">
							<div class="input-icon right">
							    {!! Form::text('contact',$lists->contact,array('class'=>'form-control required','placeholder'=>'Contact','id'=>'contact' ))!!}
							</div>
						    </div>
						</div>
						<div class="form-group"><label class="col-md-3 control-label" for="phone">Phone</label>
						    <div class="col-md-9">
							<div class="input-icon right">
							    {!! Form::text('phone',$lists->phone,array('class'=>'form-control required','placeholder'=>'Phone','id'=>'phone' ))!!}
							</div>
						    </div>
						</div>
						<div class="form-group"><label class="col-md-3 control-label" for="fax">Fax</label>
						    <div class="col-md-9">
							<div class="input-icon right">
							    {!! Form::text('fax',$lists->fax,array('class'=>'form-control','placeholder'=>'Fax','id'=>'fax' ))!!}
							</div>
						    </div>
						</div>
						<div class="form-group"><label class="col-md-3 control-label" for="email">Email</label>
						    <div class="col-md-9">
							<div class="input-icon right">
							    {!! Form::email('email',$lists->email,array('class'=>'form-control required','placeholder'=>'Email','id'=>'email' ))!!}
							</div>
						    </div>
						</div>
						<div class="form-group"><label class="col-md-3 control-label" for="address">Address</label>
						    <div class="col-md-9">
							<div class="input-icon right">
							    {!! Form::textarea('address',$lists->address,array('class'=>'form-control required','placeholder'=>'Address','id'=>'address' ))!!}
							</div>
						    </div>
						</div>
					<div class="form-group"><label class="col-md-3 control-label" for="inputName">Status</label>

                                            <div class="col-md-9">
                                                <div class="input-icon right">
                                                            {!! Form::select('status',['Active'=>'Active','Inactive'=>'Inactive'],$lists->status,array('class'=>'form-control required','id'=>'status' ))!!}
                                                </div>
                                            </div>
                                        </div>	
				     </div>
                                    <div class="form-actions pal">
                                        <div class="form-group mbn">
                                            <div class="col-md-offset-3 col-md-6">
                                            {!! Form::submit('Submit',array('class'=>'btn btn-primary' )) !!}&nbsp;&nbsp;
                                            {!! Html::linkRoute('admin_planroom_trade', 'Cancel', array(), array('class' => 'btn btn-green')) !!}
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