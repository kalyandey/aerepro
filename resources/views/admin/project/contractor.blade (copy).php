@extends('admin.layout')
@section('content')
    
    <div id="title-breadcrumb-option-demo" class="page-title-breadcrumb">
                <div class="page-header pull-left">
                    <div class="page-title">Edit Project</div>
                </div>
                <ol class="breadcrumb page-breadcrumb pull-right">
                    <li><i class="fa fa-home"></i>&nbsp;<a href="javascript:void(0);">Home</a>&nbsp;&nbsp;<i class="fa fa-angle-right"></i>&nbsp;&nbsp;</li>
                    <li class="active">Edit Project</li>
                </ol>
                <div class="clearfix"></div>
    </div>
    <div class="page-content">
        <div id="form-layouts" class="row">
            <div class="col-lg-12">
                    <div class="portlet box portlet-yellow">
                        <div class="portlet-header">
                            <div class="caption">Edit Project : {!! $projectDetails->name !!}</div>
                        </div>
                        <div class="portlet-body">
                            <div class="row">
                                <div class="topTabText">
                                    @include('admin.project.menu')
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-12">
                                    <!--<h3>Account Information</h3>-->
                                    <br>
                                        {!! Form::open(array('route'=>array('admin_project_contractor',$projectDetails->id),'class'=>'form-validate form-horizontal','files'=>true,'method'=>'post')) !!}
                                        {!! Form::hidden('action','Process')!!}
                                        
                                        @if(count($contractor_assign) > 0)
                                        @foreach($contractor_assign as $k=>$as)
                                        <div class="form-group">
                                            <label for="Contractor" class="col-md-3 control-label"></label>
                                            <div class="col-md-6">{!! $as->contractor->business_name !!}</div>
                                            <div class="col-md-3"><a href="{{URL::route('admin_assign_contractor_delete',$as->id)}}" class="btn btn-primary">Remove</a></div>  
                                        </div>
                                        @endforeach        
                                        @endif        
                                         
                                         <div class="contractor_select">
                                         <div class="form-group">
                                            <label for="Contractor" class="col-md-3 control-label">Select Type</label>
                                            <div class="col-md-3">
                                            {!! Form::checkbox('select_type','autocomplete','',['class'=>'select_type'])!!}Select from Conductor
                                            {!! Form::checkbox('select_type','others','',['class'=>'select_type'])!!} Others</div>  
                                            <div class="col-md-3 removeBtn" style="display:none;"><a class="btn btn-primary">Remove</a></div>    
                                        </div>
                                        </div>       
                                        <!--<div class="contractor_select" {{(count($contractor_assign) < 0)?'style=display:none;':''}}>
                                        <div class="form-group">
                                            <label for="Contractor" class="col-md-3 control-label">Select Contractor</label>
                                            <div class="col-md-6">{!! Form::select('contractor[]',$contractor,'',['class'=>'form-control required contractor'])!!}</div>
                                            <div class="col-md-3 removeBtn"  style="display:none;"><a class="btn btn-primary">Remove</a></div>    
                                        </div>
                                        </div>-->
                                        <div class="contractor_hidden_form">        
                                        <div class="add_contractor" style="display:none;">      
                                        <div class="form-group">
                                            <label for="Company Name" class="col-md-3 control-label">Business Name</label>
                                            <div class="col-md-6">{!! Form::text('business_name[]','',['class'=>'form-control required','id' => 'business_name'])!!}</div>
                                        </div>
                                        <div class="form-group">
                                            <label for="user_name" class="col-md-3 control-label">Contact Name</label>
                                            <div class="col-md-6">{!! Form::text('name[]','',['class'=>'form-control required','id' => 'name'])!!}</div>
                                        </div>
                                        <div class="form-group">
                                            <label for="address" class="col-md-3 control-label">Street</label>
                                            <div class="col-md-6">{!! Form::text('street[]','',['class'=>'form-control required','id' => 'address'])!!}</div>
                                        </div> 
                                        <div class="form-group">
                                            <label for="city" class="col-md-3 control-label">City</label>
                                            <div class="col-md-6">{!! Form::text('city[]','',['class'=>'form-control required','id' => 'city'])!!}</div>
                                        </div>
                                        <div class="form-group">
                                            <label for="State" class="col-md-3 control-label">State</label>
                                            <div class="col-md-6">{!! Form::select('state[]',$state,'',['class'=>'form-control required','id' => 'state'])!!}</div>
                                        </div>
                                        <div class="form-group">
                                            <label for="Zip" class="col-md-3 control-label">Zip</label>
                                            <div class="col-md-6">{!! Form::text('zip[]','',['class'=>'form-control required','id' => 'Zip'])!!}</div>
                                        </div>
                                        <div class="form-group">
                                            <label for="phone" class="col-md-3 control-label">Phone</label>
                                            <div class="col-md-6">{!! Form::text('phone[]','',['class'=>'form-control phone required'])!!}</div>
                                        </div>
                                        <div class="form-group">
                                            <label for="fax" class="col-md-3 control-label">Fax: </label>
                                            <div class="col-md-6">{!! Form::text('fax[]','',['class'=>'form-control fax','id' => 'fax'])!!}</div>
                                        </div>
                                        <div class="form-group">
                                            <label for="email" class="col-md-3 control-label">Email:</label>
                                            <div class="col-md-6">{!! Form::email('email[]','',['class'=>'form-control','id' => 'email'])!!}</div>
                                        </div>
                                        </div>
                                        </div>
                                        <div class="add_cont"></div>        
                                        <div class="form-actions">
                                        <div class="col-md-12">
                                        {!! Form::submit('Submit',['class'=>'btn btn-primary'])!!}
                                        <a class="btn btn-info add_more">Add more</a>
                                        <a class="btn btn-default" href="{{URL::route('admin_project_principle',$projectDetails->id)}}">back</a>
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
                                                if($(this).val() == 'others'){
                                                            //$(this).parents('.add_contractor').next().show();
                                                            console.log($(this).parents('.form-group').next());
                                                            $(this).closest( ".add_contractor" ).show()
                                                }else{
                                                            $(this).parents('.form-group').next().hide();
                                                }    
                                    });
                                    $('.add_more').click(function(){
                                              var addmoretext = '<div class="append_contractor_box">';
                                              addmoretext += $('.contractor_select').html();
                                              addmoretext += $('.contractor_hidden_form').html();
                                              addmoretext += '</div>';
                                              console.log(addmoretext);
                                                $('.add_cont').append(addmoretext);
                                                $('.append_contractor_box').last().find('.removeBtn').show();
                                                $('.contractor').change(function(){
                                                            if($(this).val() == 'other'){
                                                                        $(this).parents('.form-group').next().show();
                                                                        $(".phone").mask("(999) 999-9999");
                                                                        $(".fax").mask("(999) 999-9999");
                                                            }else{
                                                                        $(this).parents('.form-group').next().hide();
                                                            }
                                                });
                                                
                                                $('.removeBtn a').click(function(){
                                                            $(this).parents('.append_contractor_box').remove();        
                                                });
                                    });
                                    $('.contractor').change(function(){
                                                if($(this).val() == 'other'){
                                                            $(this).parents('.form-group').next().show();
                                                }else{
                                                            $(this).parents('.form-group').next().hide();
                                                }
                                    });
                                    //$('#contractor').trigger('change');
                        });
            </script>
@endsection