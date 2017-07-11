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
                                        {!! Form::open(array('route'=>array('admin_buildingreport_contractor',$lists->id),'class'=>'form-validate form-horizontal','files'=>true,'method'=>'post')) !!}
                                        {!! Form::hidden('action','Process')!!}
                                        <div class="form-group">
                                            <label for="Contractor" class="col-md-3 control-label">Select Type</label>
                                            <div class="col-md-6">
                                            {!! Form::radio('select_type','autocomplete',($lists->contractor_id != '')?true:'',['class'=>'select_type']) !!}Lookup Contractor
                                            {!! Form::radio('select_type','others','',['class'=>'select_type'])!!} Others</div>  
                                            <div class="col-md-3 removeBtn" style="display:none;"><a class="btn btn-primary">Remove</a></div>    
                                        </div>
                                        <div class="add_autocomplete_contractor" style="display:none;">          
                                                <div class="form-group">
                                                    <label for="Contractor" class="col-md-3 control-label">Select Contractor</label>
                                                    <div class="col-md-9">
                                                    {!! Form::text('contractor',($lists->contractor_id != '')?$lists->contractor->business_name:'',['class'=>'form-control required contractor_business_name'])!!}
                                                    {!! Form::hidden('contractor_id',($lists->contractor_id != '')?$lists->contractor_id:'',['class' => 'contractor_id']) !!}
                                                    </div>
                                                </div>
                                        </div>        
                                        <div class="add_contractor" style="display:none;">      
                                        <div class="form-group">
                                            <label for="Company Name" class="col-md-3 control-label">Business Name</label>
                                            <div class="col-md-9">{!! Form::text('business_name','',['class'=>'form-control required','id' => 'business_name'])!!}</div>
                                        </div>
                                        <div class="form-group">
                                            <label for="user_name" class="col-md-3 control-label">Contact Name</label>
                                            <div class="col-md-9">{!! Form::text('name','',['class'=>'form-control required','id' => 'name'])!!}</div>
                                        </div>
                                        <div class="form-group">
                                            <label for="address" class="col-md-3 control-label">Street</label>
                                            <div class="col-md-9">{!! Form::text('street','',['class'=>'form-control required','id' => 'address'])!!}</div>
                                        </div> 
                                        <div class="form-group">
                                            <label for="city" class="col-md-3 control-label">City</label>
                                            <div class="col-md-9">{!! Form::text('city','',['class'=>'form-control required','id' => 'city'])!!}</div>
                                        </div>
                                        <div class="form-group">
                                            <label for="State" class="col-md-3 control-label">State</label>
                                            <div class="col-md-9">{!! Form::select('state',$state,'',['class'=>'form-control required','id' => 'state'])!!}</div>
                                        </div>
                                        <div class="form-group">
                                            <label for="Zip" class="col-md-3 control-label">Zip</label>
                                            <div class="col-md-9">{!! Form::text('zip','',['class'=>'form-control required','id' => 'Zip'])!!}</div>
                                        </div>
                                        <div class="form-group">
                                            <label for="phone" class="col-md-3 control-label">Phone</label>
                                            <div class="col-md-9">{!! Form::text('phone','',['class'=>'form-control required','id' => 'phone'])!!}</div>
                                        </div>
                                        <div class="form-group">
                                            <label for="fax" class="col-md-3 control-label">Fax: </label>
                                            <div class="col-md-9">{!! Form::text('fax','',['class'=>'form-control','id' => 'fax'])!!}</div>
                                        </div>
                                        <div class="form-group">
                                            <label for="email" class="col-md-3 control-label">Email:</label>
                                            <div class="col-md-9">{!! Form::email('email','',['class'=>'form-control','id' => 'email'])!!}</div>
                                        </div>
                                        </div>        
                                        <div class="form-actions">
                                        <div class="col-md-offset-9 col-md-9">
                                        {!! Form::submit('Submit',['class'=>'btn btn-primary'])!!}
                                        <a class="btn btn-default" href="{{URL::route('admin_buildingreport_edit',$lists->id)}}">back</a>
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
                        
                                    $('.select_type').click(function(){
                                                if($('.select_type:checked').val() == 'others'){
                                                            $('.add_autocomplete_contractor').hide();
                                                            $('.add_contractor').show();
                                                }else{
                                                            $('.add_contractor').hide();
                                                            $('.add_autocomplete_contractor').show();
                                                }
                                    });
                                    
                                    $('.select_type:checked').trigger('click');
                        });
            </script>
@endsection