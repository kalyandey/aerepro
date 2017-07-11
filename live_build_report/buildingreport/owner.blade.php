@extends('admin.layout')
@section('content')
    
    <div id="title-breadcrumb-option-demo" class="page-title-breadcrumb">
                <div class="page-header pull-left">
                    <div class="page-title">Edit PlanRoom Building Reports</div>
                </div>
                <ol class="breadcrumb page-breadcrumb pull-right">
                    <li><i class="fa fa-home"></i>&nbsp;<a href="javascript:void(0);">Home</a>&nbsp;&nbsp;<i class="fa fa-angle-right"></i>&nbsp;&nbsp;</li>
                    <li class="active">Edit PlanRoom Building Reports</li>
                </ol>
                <div class="clearfix"></div>
    </div>
    <div class="page-content">
        <div id="form-layouts" class="row">
            <div class="col-lg-12">
                    <div class="portlet box portlet-yellow">
                        <div class="portlet-header">
                            <div class="caption">Edit PlanRoom Building Reports</div>
                        </div>
                        <div class="portlet-body">
                            <div class="row">
                                <div >
                                    @include('admin.buildingreport.menu')
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-12">
                                    <!--<h3>Account Information</h3>-->
                                    <br>
                                        {!! Form::open(array('route'=>array('admin_buildingreport_owner',$lists->id),'class'=>'form-validate form-horizontal','files'=>true,'method'=>'post')) !!}
                                        {!! Form::hidden('action','Process')!!}  
                                        <div class="form-group">
                                            <label for="owner_name" class="col-md-3 control-label">Owner Name</label>
                                            <div class="col-md-9">{!! Form::text('owner_name',(count($lists->permit_owner)>0)?$lists->permit_owner->owner_name:'',['class'=>'form-control required','id' => 'owner_name'])!!}</div>
                                        </div>
                                        <div class="form-group">
                                            <label for="address" class="col-md-3 control-label">Owner Street</label>
                                            <div class="col-md-9">{!! Form::text('owner_address',(count($lists->permit_owner)>0)?$lists->permit_owner->owner_address:'',['class'=>'form-control','id' => 'address'])!!}</div>
                                        </div>          
                                        <div class="form-group">
                                            <label for="city" class="col-md-3 control-label">Owner City</label>
                                            <div class="col-md-9">{!! Form::text('city',(count($lists->permit_owner)>0)?$lists->permit_owner->owner_city_id:'',['class'=>'form-control required','id' => 'city'])!!}</div>
                                        </div>
                                        <div class="form-group">
                                            <label for="State" class="col-md-3 control-label">Owner State</label>
                                            <div class="col-md-9">{!! Form::select('state',$state,(count($lists->permit_owner)>0 && count($lists->permit_owner->state) > 0 )?$lists->permit_owner->state->id:'',['class'=>'form-control required','id' => 'state'])!!}</div>
                                        </div>
                                        <div class="form-group">
                                            <label for="Zip" class="col-md-3 control-label">Owner Zip</label>
                                            <div class="col-md-9">{!! Form::text('zip',(count($lists->permit_owner)>0)?$lists->permit_owner->owner_zip:'',['class'=>'form-control','id' => 'Zip'])!!}</div>
                                        </div>
                                        <div class="form-group">
                                            <label for="phone" class="col-md-3 control-label">Owner Phone</label>
                                            <div class="col-md-9">{!! Form::text('phone',(count($lists->permit_owner)>0)?$lists->permit_owner->owner_phone:'',['class'=>'form-control','id' => 'phone'])!!}</div>
                                        </div>    
                                        <div class="form-actions">
                                        <div class="col-md-offset-9 col-md-9">
                                        {!! Form::submit('Submit',['class'=>'btn btn-primary'])!!}
                                        <a class="btn btn-default" href="{{URL::route('admin_buildingreport_contractor',$lists->id)}}">back</a>
                                        </div>
                                        </div>
                                        {!! Form::close() !!} 
                                </div>
                            </div>
                            <div style="clear:both"></div>
                        </div>
                    </div>
            </div>
        </div>
    </div>
            <script>
                        $(function(){
                                    $('#owner').change(function(){
                                                if($(this).val() == 'other'){
                                                            $('.add_owner').show();
                                                }else{
                                                            $('.add_owner').hide();
                                                }
                                    });
                                    $('#owner').trigger('change');
                        });
            </script>
@endsection