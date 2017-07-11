@extends('admin/layout')

@section('title', 'Printing Price Add')

@section('content')
    <div class="page-title-breadcrumb" id="title-breadcrumb-option-demo">
                <div class="page-header pull-left">
                    <div class="page-title">Printing Price</div>
                </div>
                <ol class="breadcrumb page-breadcrumb pull-right">
                    <li>
                    <i class="fa fa-file-text-o"></i>&nbsp;
                    <a href="{{ URL::route('admin_price') }}">Printing Price</a>&nbsp;&nbsp;<i class="fa fa-angle-right"></i>&nbsp;&nbsp;
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
                            <div class="panel-heading">Printing Price Add</div>
                            <div class="panel-body pan">                                    
                                    {!! Form::open(array('route'=>'admin_price_add','class'=>'form-horizontal form-validate')) !!}
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
                                               
                                        <div class="form-group"><label class="col-md-3 control-label" for="inputName">From (Size)</label>
                                            <div class="col-md-9">
                                                <div class="input-icon right">
                                                            {!! Form::text('from_range',null,array('class'=>'form-control required','placeholder'=>'Enter From Range','id'=>'from_range' ))!!}
                                                </div>
                                            </div>
                                        </div>
                                        <div class="form-group"><label class="col-md-3 control-label" for="inputName">To (Size)</label>
                                            <div class="col-md-9">
                                                <div class="input-icon right">
                                                            {!! Form::text('to_range',null,array('class'=>'form-control required','placeholder'=>'Enter To Range','id'=>'to_range' ))!!}
                                                </div>
                                            </div>
                                        </div>
					                    <div class="form-group"><label class="col-md-3 control-label" for="inputName">Full Size Price</label>
                                            <div class="col-md-9">
                                                <div class="input-icon right">
                                                            {!! Form::text('full_size_price',null,array('class'=>'form-control required','placeholder'=>'Full Size Price','id'=>'full_size_price' ))!!}
                                                </div>
                                            </div>
                                        </div>
                                        <div class="form-group"><label class="col-md-3 control-label" for="inputName">Half Size Price</label>
                                            <div class="col-md-9">
                                                <div class="input-icon right">
                                                            {!! Form::text('half_size_price',null,array('class'=>'form-control required','placeholder'=>'Half Size Price','id'=>'half_size_price' ))!!}
                                                </div>
                                            </div>
                                        </div>
                                        <div class="form-group"><label class="col-md-3 control-label" for="inputName">Download Price</label>
                                            <div class="col-md-9">
                                                <div class="input-icon right">
                                                            {!! Form::text('download_price',null,array('class'=>'form-control required','placeholder'=>'Download Price','id'=>'download_price' ))!!}
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="form-actions pal">
                                        <div class="form-group mbn">
                                            <div class="col-md-offset-3 col-md-6">
                                            {!! Form::submit('Submit',array('class'=>'btn btn-primary' )) !!}&nbsp;&nbsp;
                                            {!! Html::linkRoute('admin_price', 'Back', array(), array('class' => 'btn btn-green')) !!}
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