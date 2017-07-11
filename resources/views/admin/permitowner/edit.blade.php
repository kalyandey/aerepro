@extends('admin/layout')

@section('title', 'Category Update')

@section('content')
    <div class="page-title-breadcrumb" id="title-breadcrumb-option-demo">
                <div class="page-header pull-left">
                    <div class="page-title">Permit Owner</div>
                </div>
                <ol class="breadcrumb page-breadcrumb pull-right">
                    <li>
                    <i class="fa fa-file-text-o"></i>&nbsp;
                    <a href="{{ URL::route('admin_permittype') }}">Permit Owner</a>&nbsp;&nbsp;<i class="fa fa-angle-right"></i>&nbsp;&nbsp;
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
                            <div class="panel-heading">Permit Owner Update</div>
                            <div class="panel-body pan">                                    
                                    {!! Form::open(array('route'=>array('admin_permitowner_update',$lists->id),'class'=>'form-horizontal form-validate')) !!}
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
                                        <div class="form-group"><label class="col-md-3 control-label" for="owner_name">Owner Name</label>
						<div class="col-md-9">
                                                <div class="input-icon right">
                                                            {!! Form::text('owner_name',$lists->owner_name,array('class'=>'form-control required','placeholder'=>'Owner Name'))!!}
                                                </div>
                                            </div>
                                        </div>
					<div class="form-group"><label class="col-md-3 control-label" for="City">Owner City</label>
                                            <div class="col-md-9">
                                                <div class="input-icon right">
                                                            {!! Form::select('owner_city_id',$city,$lists->owner_city_id,array('class'=>'form-control required'))!!}
                                                </div>
                                            </div>
                                        </div>
					<div class="form-group"><label class="col-md-3 control-label" for="State">Owner State</label>
                                            <div class="col-md-9">
                                                <div class="input-icon right">
                                                            {!! Form::select('owner_state_id',$state,$lists->owner_state_id,array('class'=>'form-control required'))!!}
                                                </div>
                                            </div>
                                        </div>
					<div class="form-group"><label class="col-md-3 control-label" for="inputName">Owner Zip</label>
                                            <div class="col-md-9">
                                                <div class="input-icon right">
                                                            {!! Form::text('owner_zip',$lists->owner_zip,array('class'=>'form-control','placeholder'=>'Owner Zip'))!!}
                                                </div>
                                            </div>
                                        </div>
					<div class="form-group"><label class="col-md-3 control-label" for="inputName">Owner Phone</label>
                                            <div class="col-md-9">
                                                <div class="input-icon right">
                                                            {!! Form::text('owner_phone',$lists->owner_phone,array('class'=>'form-control','id'=>'phone'))!!}
                                                </div>
                                            </div>
                                        </div>
					<div class="form-group"><label class="col-md-3 control-label" for="inputName">Owner Address</label>
                                            <div class="col-md-9">
                                                <div class="input-icon right">
                                                            {!! Form::textarea('owner_address',$lists->owner_address,array('class'=>'form-control','placeholder'=>'Owner Address'))!!}
                                                </div>
                                            </div>
                                        </div>	
					<div class="form-group"><label class="col-md-3 control-label" for="inputName">Status</label>

                                            <div class="col-md-9">
                                                <div class="input-icon right">
                                                            {!! Form::select('status',['Active'=>'Active','Inactive'=>'Inactive'],$lists->status,array('class'=>'form-control required','id'=>'status' ))!!}
                                                </div>
                                            </div>
                                        </div>	
				     </div>
                                    <div class="form-actions pal">
                                        <div class="form-group mbn">
                                            <div class="col-md-offset-3 col-md-6">
                                            {!! Form::submit('Submit',array('class'=>'btn btn-primary' )) !!}&nbsp;&nbsp;
                                            {!! Html::linkRoute('admin_permittype', 'Cancel', array(), array('class' => 'btn btn-green')) !!}
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