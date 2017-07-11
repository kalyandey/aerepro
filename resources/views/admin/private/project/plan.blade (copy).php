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
                            <div class="caption">Edit Project : {!! $details->company->company_name !!}</div>
                        </div>
                        <div class="portlet-body">
                            <div class="row">
                                <div class="topTabText">
                                    @include('admin.private.project.menu')
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-12">
                                    <!--<h3>Account Information</h3>-->
                                    <br>
                                        {!! Form::open(array('route'=>array('admin_private_project_plans',$details->id),'class'=>'form-horizontal','files'=>true,'method'=>'post','id'=>'planFrm')) !!}
                                        {!! Form::hidden('action','Process')!!}
                                        @if(count($plans) > 0 )
                                        @foreach($plans as $k=>$plan)         
                                        <div  class="row appendsubbody" style="border-bottom:1px dotted #CCC;padding : 10px 2px;">            
                                                <div class="form-group">
                                                    <label for="speces_category" class="col-md-2 control-label">Select Plan Category</label>
                                                    <div class="col-md-10">{!! Form::select('option['.$k.'][plan_category]',$plan_category,$plan->cat_id,['class'=>'form-control','id' => 'plan_category'])!!}</div>
                                                </div>
                                                @if(count($plan->all_plan($plan->cat_id,$plan->project_id)) > 0 )
                                                @foreach($plan->all_plan($plan->cat_id,$plan->project_id) as $i=>$p)
                                                {!! Form::hidden('option['.$k.'][plan_id][]',$p->id)!!}
                                                <div class="form-group">
                                                    <label for="plan_name" class="col-md-2 control-label">Name</label>
                                                    <div class="col-md-3">{!! Form::text('option['.$k.'][plan_name][]',$p->plan_name,['class'=>'form-control required'])!!}</div>
                                                    <label for="File" class="col-md-2 control-label">File</label>
                                                    <div class="col-md-3">{!! Form::file('option['.$k.'][file_name][]',['class'=>'form-control'])!!}
                                                    <em style="color:red">Note : Pdf only</em>
                                                        @if(Helpers::isFileExist('uploads/private_planroom/plan/'.$p->file_name) && $p->file_name != '')
                                                        &nbsp;&nbsp;&nbsp;<a target="_blank" href="{{Helpers::isFileExist('uploads/private_planroom/plan/'.$p->file_name)}}"><b>Pdf view</b></a>
                                                        @endif
                                                    </div>
                                                    @if($i>0)        
                                                    <div class="col-md-2">        
                                                    <a href="{{URL::route('admin_private_project_plans_delete',[$p->id,$plan->project_id])}}" class="btn btn-danger" style="float:right" onclick="confirm('Are you sure??')"><i class="fa fa-trash-o"></i></a>
                                                    </div>
                                                    @endif        
                                                </div>
                                                @if(($i + 1) ==count($plan->all_plan($plan->cat_id,$plan->project_id)))
                                                <div class="planfileAdd"></div>
                                                <div class="form-group text-right">
                                                            <div class="col-md-8"><a data-attr="{{$plan->cat_id}}" class="btn btn-info add_files" onclick="addMoreFile(this)">Add file</a></div>
                                                                        
                                                            <div class="col-md-2"><a href="{{URL::route('admin_private_cat_plans_delete',[$plan->cat_id,$plan->project_id])}}" class="btn btn-danger" onclick="confirm('Are you sure??')">Remove Category</a></div>
                                                           
                                                </div>
                                                @endif
                                                @endforeach
                                                @endif 
                                        </div>
                                        @endforeach
                                        @endif
                                        <div class="appendPlans"></div>
                                        
                                                
                                        <div class="form-actions">
                                        <div class="col-md-12">
                                        <div class="btn btn-info add_more_plans">Add more</div>
                                        {!! Form::submit('Submit',['class'=>'btn btn-primary'])!!}
                                        <a href="{{URL::route('admin_private_project_plans',[$details->id])}}" class="btn btn-default" type="button">Back</a>
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
             
            <div class="planfileContent" style="display:none;">
            <div class="form-group ">
            <label for="plan_name" class="col-md-2 control-label">Name</label>
            <div class="col-md-3">{!! Form::text('plan_name[]','',['class'=>'form-control append_plan_name required','id' => 'plan_name'])!!}</div>
            <label for="File" class="col-md-2 control-label">File</label>
            <div class="col-md-3">{!! Form::file('file_name[]',['class'=>'form-control append_plan_file pdf_file_valid required','id' => 'file_name'])!!}
            <em style="color:red">Note : Pdf only</em>
            </div>
            <div class="col-md-2"><a class="btn btn-danger" style="float:right" onclick="removeFile(this)"><i class="fa fa-trash-o"></i></a></div>
            </div>
            </div>
                        
            <div class="planBody" style="display:none;">
            <div  class="row appendData" style="border-bottom:1px dotted #CCC;padding : 10px 2px;">
            <div class="form-group">
                <label for="plan_category" class="col-md-2 control-label">Select Plan Category</label>
                <div class="col-md-9">{!! Form::select('plan_category[]',$plan_category,'',['class'=>'form-control append_plan_category required'])!!}</div>
            </div>
            <div class="form-group ">
            <label for="plan_name" class="col-md-2 control-label">Name</label>
            <div class="col-md-3">{!! Form::text('plan_name[]','',['class'=>'form-control required append_plan_name'])!!}</div>
            <label for="File" class="col-md-2 control-label">File</label>
            <div class="col-md-3">{!! Form::file('file_name[]',['class'=>'form-control required append_plan_file pdf_file_valid'])!!}
            <em style="color:red">Note : Pdf only</em>
            </div>
            </div>
            <div class="planfileAdd"></div>
            <div class="form-group text-right">
                        <div class="col-md-10"><a class="btn btn-info add_files" onclick="addMoreFile(this)">Add file</a></div>
                        <div class="col-md-2"><a onclick="removeBox(this)" class="btn btn-danger removeBox">Remove Category</a></div>
            </div>
            </div>
            </div>
            <script>
                        $(function(){
                       
                                    
                                    $('.add_more_plans').click(function(){
                                                $('.appendPlans').append("<div class='appendsubbody'>"+$('.planBody').html()+'</div>');
                                                $('.appendPlans').find('.appendData').last().find('.append_plan_category').attr('name','option['+($('.appendsubbody').length -1)+'][plan_category]');
                                                $('.appendPlans').find('.appendData').last().find('.append_plan_name').attr('name','option['+($('.appendsubbody').length -1)+'][plan_name][]');
                                                $('.appendPlans').find('.appendData').last().find('.append_plan_file').attr('name','option['+($('.appendsubbody').length -1)+'][file_name][]');
                                                
                                               $(".appendsubbody:eq(0) .removeBox").hide();
                                                
                                    });
                                    
                                   if($('.appendsubbody').length == 0){
                                    
                                                $('.add_more_plans').trigger('click');
                                    }
                                    
                                    $("#planFrm").submit(function(){
                                    var errCount = 0;
                                    $(this).find('.required').each(function(){
                                        $(this).parent().removeClass('state-error');
                                        $(this).removeClass('invalid');
                                        $(this).parent().find('em.invalid').remove();
                                        if ($(this).val() == '') {
                                                $(this).parent().addClass('state-error');
                                                $(this).addClass('invalid');
                                                $(this).parent().append('<em class="invalid" for="'+$(this).attr('name')+'">This Field is required</em>');
                                                errCount = errCount+1;
                                        }
                                    });
                                    $(this).find('.pdf_file_valid').each(function(){
                                        $(this).parent().removeClass('state-error');
                                        $(this).removeClass('invalid');
                                        $(this).parent().find('em.invalid').remove();
                                       var file = $(this).val();
                                       //console.log(file);
                                       var fileArr = file.split('.');
                                       var ext = fileArr[ (fileArr.length - 1) ];
                                       ext = ext.toLowerCase();
                                       
                                        if(ext != 'pdf'){
                                                $(this).parent().addClass('state-error');
                                                $(this).addClass('invalid');
                                                $(this).parent().append('<em class="invalid" for="'+$(this).attr('name')+'">Upload only pdf</em>');
                                                errCount = errCount+1;
                                        }
                                    });
                                    
                                    if (errCount > 0) {
                                                return false;
                                    }
                                    
                                    });
                                    
                                    
                        });
                        function removeBox(element) {
                                   if (confirm('Are you sure??')) {
                                    $(element).parents('.appendsubbody').remove();
                                      $(".appendsubbody").each(function(i,e){
                                                $(e).find('.append_plan_category').attr('name','option['+i+'][plan_category]');
                                                $(e).find('.append_plan_name').attr('name','option['+i+'][plan_name][]');
                                                $(e).find('.append_plan_file').attr('name','option['+i+'][file_name][]');
                                      })
                                    }
                        }
                        
                        function removeFile(element) {
                                    if (confirm('Are you sure??')) {
                                    $(element).parents('.form-group').remove();
                                    }
                        }
                        
                        function addMoreFile(element) {
                                    var parentElementIndex = $('.appendsubbody').index($(element).parents('.appendsubbody'));
                                    var entryElement =$('.appendsubbody:eq('+parentElementIndex+') .planfileAdd'); 
                                    $(entryElement).append($('.planfileContent').html());
                                    
                                    $(entryElement).find('.append_plan_name').attr('name','option['+parentElementIndex+'][plan_name][]');
                                    $(entryElement).find('.append_plan_file').attr('name','option['+parentElementIndex+'][file_name][]');
                                    
                        }
            </script>
@endsection