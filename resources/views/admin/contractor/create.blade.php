@extends('admin/layout')

@section('title', 'Contractor Create')

@section('content')
    <div class="page-title-breadcrumb" id="title-breadcrumb-option-demo">
                <div class="page-header pull-left">
                    <div class="page-title">Contractor</div>
                </div>
                <ol class="breadcrumb page-breadcrumb pull-right">
                    <li>
                    <i class="fa fa-list-ul"></i>&nbsp;
                    <a href="{{ URL::route('admin_contractor') }}">Contractor</a>&nbsp;&nbsp;<i class="fa fa-angle-right"></i>&nbsp;&nbsp;
                    </li>
                    <li>
                    <i class="fa fa-plus"></i>&nbsp;
                    <a href="javascript:void(0);">Add </a>&nbsp;&nbsp;
                    </li>
                 
                </ol>
                <div class="clearfix"></div>
            </div>
<div class="page-content">
                <div class="row">
                    <div class="col-lg-12">
		    <div class="panel panel-yellow">
                            <div class="panel-heading">Contractor Create</div>
                            <div class="panel-body pan">                                    
                                    {!! Form::open(array('route'=>array('contractor_create'),'class'=>'form-horizontal form-validate')) !!}
                                    
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
                                                            {!! Form::text('business_name','',array('class'=>'form-control required','placeholder'=>'Business Name','id'=>'business_name' ))!!}
                                                </div>
                                            </div>
                                        </div>
                                        <div class="form-group"><label class="col-md-3 control-label" for="inputName">Contact Name</label>

                                            <div class="col-md-9">
                                                <div class="input-icon right">
                                                            {!! Form::text('name','',array('class'=>'form-control required','placeholder'=>'Name','id'=>'name' ))!!}
                                                </div>
                                            </div>
                                        </div>
                                        <div class="form-group"><label class="col-md-3 control-label" for="inputName">Phone</label>

                                            <div class="col-md-9">
                                                <div class="input-icon right">
                                                            {!! Form::text('phone','',array('class'=>'form-control required','placeholder'=>'Phone','id'=>'phone_number' ))!!}
                                                </div>
                                            </div>
                                        </div>
                                        <div class="form-group"><label class="col-md-3 control-label" for="inputName">Fax</label>

                                            <div class="col-md-9">
                                                <div class="input-icon right">
                                                            {!! Form::text('fax','',array('class'=>'form-control required','placeholder'=>'Fax','id'=>'fax_number' ))!!}
                                                </div>
                                            </div>
                                        </div> 
                                        <div class="form-group"><label class="col-md-3 control-label" for="inputName">Email</label>

                                            <div class="col-md-9">
                                                <div class="input-icon right">
                                                            {!! Form::text('email','',array('class'=>'form-control required','placeholder'=>'Email','id'=>'email' ))!!}
                                                </div>
                                            </div>
                                        </div>         
                                        <div class="form-group"><label class="col-md-3 control-label" for="inputName">Street</label>

                                            <div class="col-md-9">
                                                <div class="input-icon right">
                                                            {!! Form::text('street','',array('class'=>'form-control required','placeholder'=>'Street','id'=>'street' ))!!}
                                                </div>
                                            </div>
                                        </div>        
                                        <div class="form-group"><label class="col-md-3 control-label" for="inputName">State</label>
                                             <div class="col-md-9">
                                                <div class="input-icon right">
                                                            {!! Form::select('state',$state,'',['class'=>'form-control required','id' => 'state'])!!}
                                                </div>
                                            </div>
                                        </div>
                                        <div class="form-group"><label class="col-md-3 control-label" for="inputName">City</label>
                                             <div class="col-md-9">
                                                <div class="input-icon right">
                                                            {!! Form::text('city','',['class'=>'form-control required','id' => 'city'])!!}
                                                </div>
                                            </div>
                                        </div>
                                        <div class="form-group"><label class="col-md-3 control-label" for="inputName">Zip</label>

                                            <div class="col-md-9">
                                                <div class="input-icon right">
                                                            {!! Form::text('zip','',array('class'=>'form-control required','placeholder'=>'Zip','id'=>'zip' ))!!}
                                                </div>
                                            </div>
                                        </div>         
                                        
					
					
					
                                       <div class="form-actions pal">
                                        <div class="form-group mbn">
                                            <div class="col-md-offset-3 col-md-6">
                                            {!! Form::submit('Submit',array('class'=>'btn btn-primary' )) !!}&nbsp;&nbsp;
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