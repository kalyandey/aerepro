@extends('admin/layout')

@section('title', 'Sitesettings Update')

@section('content')
    <div class="page-title-breadcrumb" id="title-breadcrumb-option-demo">
                <div class="page-header pull-left">
                    <div class="page-title">Sitesettings</div>
                </div>
                <ol class="breadcrumb page-breadcrumb pull-right">
                    <li>
                    <i class="fa fa-cogs"></i>&nbsp;
                    <a href="{{ URL::route('admin_sitesettings') }}">Sitesettings</a>&nbsp;&nbsp;<i class="fa fa-angle-right"></i>&nbsp;&nbsp;
                    </li>
                    <li>
                    <i class="fa fa-home"></i>&nbsp;
                    <a href="javascript:void(0);">Edit </a>&nbsp;&nbsp;
                    </li>
                 
                </ol>
                <div class="clearfix"></div>
            </div>
<div class="page-content">
                <div class="row">
                    <div class="col-lg-12">
		    <div class="panel panel-yellow">
                            <div class="panel-heading">Sitesettings Update</div>
                            <div class="panel-body pan">                                    
                                    {!! Form::open(array('route'=>array('admin_sitesettings_update_action',$lists->id),'class'=>'form-horizontal form-validate')) !!}
				    {!! Form::hidden('value_type',$lists->sitesettings_type) !!}
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
				        <div class="form-group"><label class="col-md-3 control-label" for="sitesettings_lebel">Setting Label</label>

                                            <div class="col-md-9">
                                                <div class="input-icon right">
						{!! Form::text('sitesettings_lebel',$lists->sitesettings_lebel,array('class'=>'form-control required','id'=>'sitesettings_lebel','disabled'=>'disabled' ))!!}
                                                </div>
                                            </div>
                                        </div>
                                        <div class="form-group"><label class="col-md-3 control-label" for="sitesettings_value">Setting Value</label>

                                            <div class="col-md-9">
                                                <div class="input-icon right">
						@php $sitesettings_type = $lists->sitesettings_type @endphp
						@if($sitesettings_type =='TEXTAREA')
							    {!! Form::textarea( 'sitesettings_value',$lists->sitesettings_value,array('class'=>'form-control required','id'=>'sitesettings_value' ))!!}
						@else
							    {!! Form::text('sitesettings_value',$lists->sitesettings_value,array('class'=>'form-control required','id'=>'sitesettings_value' ))!!}
						@endif
                                                </div>
                                            </div>
                                        </div>
                                        
                                    </div>
                                    <div class="form-actions pal">
                                        <div class="form-group mbn">
                                            <div class="col-md-offset-3 col-md-6">
                                            {!! Form::submit('Submit',array('class'=>'btn btn-primary' )) !!}&nbsp;&nbsp;
                                            {!! Html::linkRoute('admin_sitesettings', 'Cancel', array(), array('class' => 'btn btn-green')) !!}
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