@extends('admin/layout')

@section('title', 'Trade Update')

@section('content')
    <div class="page-title-breadcrumb" id="title-breadcrumb-option-demo">
                <div class="page-header pull-left">
                    <div class="page-title">Trade</div>
                </div>
                <ol class="breadcrumb page-breadcrumb pull-right">
                    <li>
                    <i class="fa fa-file-text-o"></i>&nbsp;
                    <a href="{{ URL::route('admin_trade') }}">Trade</a>&nbsp;&nbsp;<i class="fa fa-angle-right"></i>&nbsp;&nbsp;
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
                            <div class="panel-heading">Trade Update</div>
                            <div class="panel-body pan">                                    
                                    {!! Form::open(array('route'=>array('admin_trade_update'),'class'=>'form-horizontal form-validate')) !!}
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
                                         
                                        <div class="form-group"><label class="col-md-3 control-label" for="inputName">Trade</label>

                                            <div class="col-md-9">
                                                <div class="input-icon right">
                                                            {!! Form::text('trade_title',$lists->trade_title,array('class'=>'form-control required','placeholder'=>'Trade','id'=>'trade_title' ))!!}
                                                </div>
                                            </div>
                                        </div>
                                        <div class="form-group">
                                                <label class="col-md-3 control-label" for="inputName">Status</label>
						<div class="col-md-9">
                                                <div class="input-icon right">
                                           
						{!! Form::select('trade_status',['Active' => 'Active','Inactive' => 'Inactive'],$lists->trade_status,array('class'=>'form-control required','id'=>'trade_status' ))!!}
						</div>
                                                </div>
                                               
                                        </div>        
						
				     </div>
                                    <div class="form-actions pal">
                                        <div class="form-group mbn">
                                            <div class="col-md-offset-3 col-md-6">
                                            {!! Form::submit('Submit',array('class'=>'btn btn-primary' )) !!}&nbsp;&nbsp;
                                            {!! Html::linkRoute('admin_trade', 'Cancel', array(), array('class' => 'btn btn-green')) !!}
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