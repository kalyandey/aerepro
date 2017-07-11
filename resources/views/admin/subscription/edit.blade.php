@extends('admin/layout')

@section('title', 'Subscription Update')

@section('content')
    <div class="page-title-breadcrumb" id="title-breadcrumb-option-demo">
                <div class="page-header pull-left">
                    <div class="page-title">Subscription</div>
                </div>
                <ol class="breadcrumb page-breadcrumb pull-right">
                    <li>
                    <i class="fa fa-file-text-o"></i>&nbsp;
                    <a href="{{ URL::route('admin_subscription') }}">Subscription</a>&nbsp;&nbsp;<i class="fa fa-angle-right"></i>&nbsp;&nbsp;
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
                            <div class="panel-heading">Subscription Update</div>
                            <div class="panel-body pan">                                    
                                    {!! Form::open(array('route'=>array('admin_subscription_update'),'class'=>'form-horizontal form-validate')) !!}
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
                                        <div class="form-group"><label class="col-md-3 control-label" for="inputName">Title</label>

                                            <div class="col-md-9">
                                                <div class="input-icon right">
                                                            {!! Form::text('subscription_title',$lists->subscription_title,array('class'=>'form-control required','placeholder'=>'Title','id'=>'subscription_title' ))!!}
                                                </div>
                                            </div>
                                        </div>
                                        <div class="form-group"><label class="col-md-3 control-label" for="inputName">Quarterly Price</label>        
                                            <div class="col-md-9">
                                                <div class="input-icon right">
                                                            {!! Form::text('quarterly_price',$lists->quarterly_price,array('class'=>'form-control required number','placeholder'=>'Quarterly Price','id'=>'quarterly_price' ))!!}
                                                </div>
                                            </div>
                                        </div>  
                                        <div class="form-group"><label class="col-md-3 control-label" for="inputName">Yearly Price</label>                
                                            <div class="col-md-9">
                                                <div class="input-icon right">
                                                            {!! Form::text('yearly_price',$lists->yearly_price,array('class'=>'form-control required number','placeholder'=>'Yearly Price','id'=>'yearly_price' ))!!}
                                                </div>
                                            </div>
                                         </div>   
                                       </div>
                                       <div class="form-actions pal">
                                        <div class="form-group mbn">
                                            <div class="col-md-offset-3 col-md-6">
                                            {!! Form::submit('Submit',array('class'=>'btn btn-primary' )) !!}&nbsp;&nbsp;
                                            {!! Html::linkRoute('admin_subscription', 'Cancel', array(), array('class' => 'btn btn-green')) !!}
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