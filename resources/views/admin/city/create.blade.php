@extends('admin/layout')

@section('title', 'City Add')

@section('content')
    <div class="page-title-breadcrumb" id="title-breadcrumb-option-demo">
                <div class="page-header pull-left">
                    <div class="page-title">City</div>
                </div>
                <ol class="breadcrumb page-breadcrumb pull-right">
                    <li>
                    <i class="fa fa-file-text-o"></i>&nbsp;
                    <a href="{{ URL::route('admin_city') }}">City</a>&nbsp;&nbsp;<i class="fa fa-angle-right"></i>&nbsp;&nbsp;
                    </li>
                    <li>
                    <i class="fa fa-plus"></i>&nbsp;
                    <a href="javascript:void(0);">Add</a>&nbsp;&nbsp;
                    </li>
                 
                </ol>
                <div class="clearfix"></div>
            </div>
<div class="page-content">
                <div class="row">
                    <div class="col-lg-12">
		    <div class="panel panel-yellow">
                            <div class="panel-heading">City Add</div>
                            <div class="panel-body pan">                                    
                                    {!! Form::open(array('route'=>'admin_city_add','class'=>'form-horizontal form-validate')) !!}
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
                                        <div class="form-group"><label class="col-md-3 control-label" for="inputName">State</label>
                                             <div class="col-md-9">
                                                <div class="input-icon right">
                                                            {!! Form::select('state_code',$state,null,['class'=>'form-control required','id' => 'State'])!!}
                                                </div>
                                            </div>
                                        </div>        
                                        <div class="form-group"><label class="col-md-3 control-label" for="inputName">City</label>
                                            <div class="col-md-9">
                                                <div class="input-icon right">
                                                            {!! Form::text('city_name',null,array('class'=>'form-control required','placeholder'=>'Enter City Name','id'=>'city' ))!!}
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="form-actions pal">
                                        <div class="form-group mbn">
                                            <div class="col-md-offset-3 col-md-6">
                                            {!! Form::submit('Submit',array('class'=>'btn btn-primary' )) !!}&nbsp;&nbsp;
                                            {!! Html::linkRoute('admin_city', 'Back', array(), array('class' => 'btn btn-default')) !!}
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