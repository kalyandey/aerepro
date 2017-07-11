@extends('admin/layout')

@section('title', 'Specs Update')

@section('content')
    <div class="page-title-breadcrumb" id="title-breadcrumb-option-demo">
                <div class="page-header pull-left">
                    <div class="page-title">Specs</div>
                </div>
                <ol class="breadcrumb page-breadcrumb pull-right">
                    <li>
                    <i class="fa fa-list-ul"></i>&nbsp;
                    <a href="{{ URL::route('admin_private_specs_category') }}">Specs</a>&nbsp;&nbsp;<i class="fa fa-angle-right"></i>&nbsp;&nbsp;
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
                            <div class="panel-heading">Specs Update</div>
                            <div class="panel-body pan">                                    
                                    {!! Form::open(array('route'=>array('admin_private_specs_category_update',$lists->id),'class'=>'form-horizontal form-validate')) !!}
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
                                        <div class="form-group"><label class="col-md-3 control-label" for="inputName">Name</label>

                                            <div class="col-md-9">
                                                <div class="input-icon right">
                                                            {!! Form::text('name',$lists->name,array('class'=>'form-control required','placeholder'=>'Name','id'=>'name' ))!!}
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
                                            {!! Html::linkRoute('admin_private_specs_category', 'Cancel', array(), array('class' => 'btn btn-green')) !!}
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