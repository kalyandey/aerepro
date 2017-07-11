@extends('admin/layout')

@section('title', 'Currency Add')

@section('content')
    <div class="page-title-breadcrumb" id="title-breadcrumb-option-demo">
                <div class="page-header pull-left">
                    <div class="page-title">Currency</div>
                </div>
                <ol class="breadcrumb page-breadcrumb pull-right">
                    <li>
                    <i class="fa fa-file-text-o"></i>&nbsp;
                    <a href="{{ URL::route('admin_currency') }}">Currency</a>&nbsp;&nbsp;<i class="fa fa-angle-right"></i>&nbsp;&nbsp;
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
                            <div class="panel-heading">Currency Add</div>
                            <div class="panel-body pan">                                    
                                    {!! Form::open(array('route'=>'admin_currency_create_action','class'=>'form-horizontal form-validate')) !!}
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
                                        <div class="form-group"><label class="col-md-3 control-label" for="inputName">Currency Symbol</label>
                                            <div class="col-md-9">
                                                <div class="input-icon right">
                                                            {!! Form::text('currency_symbol',null,array('class'=>'form-control required','placeholder'=>'Enter Currency Symbol','id'=>'currency_symbol' ))!!}
                                                </div>
                                            </div>
                                        </div>
					<div class="form-group"><label class="col-md-3 control-label" for="inputName">Currency Rate</label>
                                            <div class="col-md-9">
                                                <div class="input-icon right">
                                                            {!! Form::text('currency_rate',null,array('class'=>'form-control required','placeholder'=>'Enter Currency Rate','id'=>'currency_rate' ))!!}
                                                </div>
                                            </div>
                                        </div>	
                                        
                                    </div>
                                    <div class="form-actions pal">
                                        <div class="form-group mbn">
                                            <div class="col-md-offset-3 col-md-6">
                                            {!! Form::submit('Submit',array('class'=>'btn btn-primary' )) !!}&nbsp;&nbsp;
                                            {!! Html::linkRoute('admin_currency', 'Back', array(), array('class' => 'btn btn-default')) !!}
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