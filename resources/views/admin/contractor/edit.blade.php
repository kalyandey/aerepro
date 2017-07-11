@extends('admin/layout')

@section('title', 'General Contractor Update')

@section('content')
    <div class="page-title-breadcrumb" id="title-breadcrumb-option-demo">
                <div class="page-header pull-left">
                    <div class="page-title">General Contractor</div>
                </div>
                <ol class="breadcrumb page-breadcrumb pull-right">
                    <li>
                    <i class="fa fa-list-ul"></i>&nbsp;
                    <a href="{{ URL::route('admin_specs') }}">Speces</a>&nbsp;&nbsp;<i class="fa fa-angle-right"></i>&nbsp;&nbsp;
                    </li>
                    <li>
                    <i class="fa fa-edit"></i>&nbsp;
                    <a href="javascript:void(0);">Update </a>&nbsp;&nbsp;
                    </li>
                 
                </ol>
                <div class="clearfix"></div>
            </div>
<div class="page-content">
                <div class="row">
                    <div class="col-lg-12">
		    <div class="panel panel-yellow">
                            <div class="panel-heading">General Contractor Update</div>
                            <div class="panel-body pan">                                    
                                    {!! Form::open(array('route'=>array('admin_contractor_update'),'class'=>'form-horizontal form-validate')) !!}
                                    {!! Form::hidden('id',$lists->id) !!}
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
                                        
                                        <div class="form-group"><label class="col-md-3 control-label" for="inputName">Business Name</label>

                                            <div class="col-md-9">
                                                <div class="input-icon right">
                                                            {!! Form::text('business_name',$lists->business_name,array('class'=>'form-control required','placeholder'=>'Business Name','id'=>'business_name' ))!!}
                                                </div>
                                            </div>
                                        </div>        
                                        <div class="form-group"><label class="col-md-3 control-label" for="inputName">Contact Name</label>

                                            <div class="col-md-9">
                                                <div class="input-icon right">
                                                            {!! Form::text('name',$lists->name,array('class'=>'form-control required','placeholder'=>'Name','id'=>'name' ))!!}
                                                </div>
                                            </div>
                                        </div>
                                        <div class="form-group"><label class="col-md-3 control-label" for="inputName">Phone</label>

                                            <div class="col-md-9">
                                                <div class="input-icon right">
                                                            {!! Form::text('phone',$lists->phone,array('class'=>'form-control required','placeholder'=>'Phone','id'=>'phone_number' ))!!}
                                                </div>
                                            </div>
                                        </div>
                                        <div class="form-group"><label class="col-md-3 control-label" for="inputName">Fax</label>

                                            <div class="col-md-9">
                                                <div class="input-icon right">
                                                            {!! Form::text('fax',$lists->fax,array('class'=>'form-control required','placeholder'=>'Fax','id'=>'fax_number' ))!!}
                                                </div>
                                            </div>
                                        </div> 
                                        <div class="form-group"><label class="col-md-3 control-label" for="inputName">Email</label>

                                            <div class="col-md-9">
                                                <div class="input-icon right">
                                                            {!! Form::text('email',$lists->email,array('class'=>'form-control required','placeholder'=>'Email','id'=>'email' ))!!}
                                                </div>
                                            </div>
                                        </div>         
                                        <div class="form-group"><label class="col-md-3 control-label" for="inputName">Street</label>

                                            <div class="col-md-9">
                                                <div class="input-icon right">
                                                            {!! Form::text('street',$lists->street,array('class'=>'form-control required','placeholder'=>'Street','id'=>'street' ))!!}
                                                </div>
                                            </div>
                                        </div>        
                                        <div class="form-group"><label class="col-md-3 control-label" for="inputName">State</label>
                                             <div class="col-md-9">
                                                <div class="input-icon right">
                                                            {!! Form::select('state',$state,$lists->state,['class'=>'form-control required','id' => 'state'])!!}
                                                </div>
                                            </div>
                                        </div>
                                        <div class="form-group"><label class="col-md-3 control-label" for="inputName">City</label>
                                             <div class="col-md-9">
                                                <div class="input-icon right">
                                                            {!! Form::text('city',$lists->city,['class'=>'form-control required','id' => 'city'])!!}
                                                </div>
                                            </div>
                                        </div>
                                        <div class="form-group"><label class="col-md-3 control-label" for="inputName">Zip</label>

                                            <div class="col-md-9">
                                                <div class="input-icon right">
                                                            {!! Form::text('zip',$lists->zip,array('class'=>'form-control required','placeholder'=>'Zip','id'=>'zip' ))!!}
                                                </div>
                                            </div>
                                        </div>           
                                        
					<div class="form-group">
                                                <label class="col-md-3 control-label" for="inputName">Status</label>
						<div class="col-md-9">
                                                <div class="input-icon right">
                                           
						{!! Form::select('status',['Active' => 'Active','Inactive' => 'Inactive'],$lists->status,array('class'=>'form-control required','id'=>'status' ))!!}
						</div>
                                                </div>
                                               
                                        </div>
					
					
                                       <div class="form-actions pal">
                                        <div class="form-group mbn">
                                            <div class="col-md-offset-3 col-md-6">
                                            {!! Form::submit('Update',array('class'=>'btn btn-primary' )) !!}&nbsp;&nbsp;
                                            {!! Html::linkRoute('admin_contractor', 'Cancel', array(), array('class' => 'btn btn-green')) !!}
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