@extends('admin.layout')
@section('content')
    
    <div id="title-breadcrumb-option-demo" class="page-title-breadcrumb">
                <div class="page-header pull-left">
                    <div class="page-title">Edit Project</div>
                </div>
                <ol class="breadcrumb page-breadcrumb pull-right">
                    <li><i class="fa fa-home"></i>&nbsp;<a href="javascript:void(0);">Home</a>&nbsp;&nbsp;<i class="fa fa-angle-right"></i>&nbsp;&nbsp;</li>
                    <li class="active">Edit Project</li>
                </ol>
                <div class="clearfix"></div>
    </div>
    <div class="page-content">
        <div id="form-layouts" class="row">
            <div class="col-lg-12">
                    <div class="portlet box portlet-yellow">
                        <div class="portlet-header">
                            <div class="caption">Edit Project : {!! $projectDetails->name !!}</div>
                        </div>
                        <div class="portlet-body">
                            <div class="row">
                                <div class="topTabText">
                                    @include('admin.project.menu')
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-12">
                                    <!--<h3>Account Information</h3>-->
                                    <br>   
                                        {!! Form::open(array('route'=>array('admin_project_awarded_to',$projectDetails->id),'class'=>'form-validate form-horizontal','files'=>true,'method'=>'post')) !!}
                                        {!! Form::hidden('action','Process')!!}
                                        <div class="form-group">
                                        <div class="col-md-12">
                                        <label for="Company Name" class="col-md-3 control-label">Awarded To</label>
                                            <div class="col-md-3">
                                            Lookup contractor/bidder
                                                {!! Form::radio('select_awarded_type','contractor_bidder',true)!!}
                                            </div>
                                            <div class="col-md-3">
                                            Create New Bidder 
                                                {!! Form::radio('select_awarded_type','bidder')!!}
                                            </div>
                                            <div class="col-md-3">
                                            Create New GCs
                                                {!! Form::radio('select_awarded_type','contractor')!!}
                                            </div>
                                        </div>
                                        <div class="contractor_bidder" style="display:none;">     
                                                <div class="col-md-12">
                                                    <label for="Company Name" class="col-md-3 control-label">Select Bidder/contractor</label>
                                                    <div class="col-md-9">
                                                    @php
                                                        $awarded_to_name = '';
                                                        $awarded_to_id   = '';
                                                        $awarded_to_type = '';
                                                        if($projectDetails->awarded_to_contractor != ''){
                                                                    $awarded_to_name = $projectDetails->awarded_contractor->business_name;
                                                                    $awarded_to_id   = $projectDetails->awarded_to_contractor;
                                                                    $awarded_to_type = 'contractor';
                                                        }else if($projectDetails->awarded_to_bidder != ''){
                                                                    $awarded_to_name = $projectDetails->awarded_bidder->contact;
                                                                    $awarded_to_id   = $projectDetails->awarded_to_bidder;
                                                                    $awarded_to_type = 'bidder';
                                                        }
                                                    @endphp
                                                    {!! Form::text('awarded',$awarded_to_name,['class'=>'form-control','id' => 'awarded_to'])!!}
                                                    {!! Form::hidden('awarded_to',$awarded_to_id,['id' => 'awarded_to_id']) !!}
                                                    {!! Form::hidden('awarded_type',$awarded_to_type,['id' => 'awarded_type']) !!}
                                                    </div>
                                                </div>
                                        </div>
                                        <div class="add_contractor" style="display:none;">      
                                        <div class="form-group">
                                            <label for="Company Name" class="col-md-3 control-label">Business Name</label>
                                            <div class="col-md-6">{!! Form::text('business_name','',['class'=>'form-control required','id' => 'business_name'])!!}</div>
                                        </div>
                                        <div class="form-group">
                                            <label for="user_name" class="col-md-3 control-label">Contact Name</label>
                                            <div class="col-md-6">{!! Form::text('name','',['class'=>'form-control','id' => 'name'])!!}</div>
                                        </div>
                                        <div class="form-group">
                                            <label for="address" class="col-md-3 control-label">Street</label>
                                            <div class="col-md-6">{!! Form::text('street','',['class'=>'form-control','id' => 'address'])!!}</div>
                                        </div> 
                                        <div class="form-group">
                                            <label for="city" class="col-md-3 control-label">City</label>
                                            <div class="col-md-6">{!! Form::text('city','',['class'=>'form-control','id' => 'city'])!!}</div>
                                        </div>
                                        <div class="form-group">
                                            <label for="State" class="col-md-3 control-label">State</label>
                                            <div class="col-md-6">{!! Form::select('state',$state,'',['class'=>'form-control','id' => 'state'])!!}</div>
                                        </div>
                                        <div class="form-group">
                                            <label for="Zip" class="col-md-3 control-label">Zip</label>
                                            <div class="col-md-6">{!! Form::text('zip','',['class'=>'form-control','id' => 'Zip'])!!}</div>
                                        </div>
                                        <div class="form-group">
                                            <label for="phone" class="col-md-3 control-label">Phone</label>
                                            <div class="col-md-6">{!! Form::text('phone','',['class'=>'form-control phone'])!!}</div>
                                        </div>
                                        <div class="form-group">
                                            <label for="fax" class="col-md-3 control-label">Fax: </label>
                                            <div class="col-md-6">{!! Form::text('fax','',['class'=>'form-control fax','id' => 'fax'])!!}</div>
                                        </div>
                                        <div class="form-group">
                                            <label for="email" class="col-md-3 control-label">Email:</label>
                                            <div class="col-md-6">{!! Form::email('email','',['class'=>'form-control','id' => 'email'])!!}</div>
                                        </div>
                                        </div>
                                        
                                        <div class="add_bidder" style="display:none;">      
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
                                        <div class="form-actions">
                                        <div class="col-md-12">
                                        {!! Form::submit('Submit',['class'=>'btn btn-primary'])!!}
                                        <a class="btn btn-default" href="{{URL::route('admin_project_edit',$projectDetails->id)}}">back</a>
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