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
                                <div >
                                    @include('admin.project.menu')
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-12">
                                    <!--<h3>Account Information</h3>-->
                                    <br>
                                        {!! Form::open(array('route'=>array('admin_project_speces',$projectDetails->id),'class'=>'form-validate form-horizontal','files'=>true,'method'=>'post')) !!}
                                        {!! Form::hidden('action','Process')!!}
                                        @if(count($speces) > 0 )
                                        @foreach($speces as $k=>$sps)
                                         {!! Form::hidden('speces_id[]',$sps->id) !!}           
                                        <div  class="row" style="border-bottom:1px dotted #CCC;padding : 10px 2px;">            
                                        <div class="form-group">
                                            <label for="speces_category" class="col-md-3 control-label">Select Speces Category</label>
                                            <div class="col-md-9">{!! Form::select('speces_category[]',$spece_category,$sps->spec_cat_id,['class'=>'form-control','id' => 'speces_category'])!!}</div>
                                        </div>
                                        <div class="form-group">
                                            <label for="name" class="col-md-3 control-label">Name</label>
                                            <div class="col-md-9">{!! Form::text('name[]',$sps->name,['class'=>'form-control','id' => 'name'])!!}</div>
                                        </div>
                                        <div class="form-group">
                                            <label for="name" class="col-md-3 control-label">File</label>
                                            <div class="col-md-9">{!! Form::file('file_name[]',['class'=>'form-control','id' => 'file_name'])!!}
                                            <em style="color:red">Note : Pdf only</em>
                                                <br>
                                                @if(file_exists(public_path('uploads/project/specs/'.$sps->file_name)) && $sps->file_name != '')
                                                <a target="_blank" href="{{asset('uploads/project/specs/'.$sps->file_name)}}"><img src="{{asset('images/pdf-icon.png')}}"></a>
                                                @endif
                                            </div>
                                        </div>
                                        @if($k>0)
                                                <a href="{{URL::route('admin_project_speces_delete',[$sps->id,$sps->project_id])}}" class="btn btn-danger" style="float:right" onclick="confirm('Are you sure??')">Remove</a>
                                        @endif
                                        </div>
                                        @endforeach
                                       @else
                                        {!! Form::hidden('speces_id[]','') !!}                  
                                        <div  class="row" style="border-bottom:1px dotted #CCC;padding : 10px 2px;">
                                        <div class="form-group">
                                            <label for="speces_category" class="col-md-3 control-label">Select Speces Category</label>
                                            <div class="col-md-9">{!! Form::select('speces_category[]',$spece_category,'',['class'=>'form-control','id' => 'speces_category'])!!}</div>
                                        </div>
                                        <div class="form-group">
                                            <label for="name" class="col-md-3 control-label">Name</label>
                                            <div class="col-md-9">{!! Form::text('name[]','',['class'=>'form-control','id' => 'name'])!!}</div>
                                        </div>
                                        <div class="form-group">
                                            <label for="name" class="col-md-3 control-label">File</label>
                                            <div class="col-md-9">{!! Form::file('file_name[]',['class'=>'form-control','id' => 'file_name'])!!}
                                            <em style="color:red">Note : Pdf only</em>
                                            </div>      
                                        </div>
                                        </div>
                                        @endif
                                        <div class="appendSpeces"></div>
                                        <div class="btn btn-info add_more_speces">Add more</div>
                                        <div class="form-actions">
                                        <div class="col-md-offset-9 col-md-9">
                                        {!! Form::submit('Submit',['class'=>'btn btn-primary'])!!}
                                        <a href="{{URL::route('admin_project_plans',[$projectDetails->id])}}" class="btn btn-default" type="button">Back</a>
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
            <div class="speceBody" style="display:none;">
            <div class="appendData">
            {!! Form::hidden('speces_id[]','') !!}  
            <div  class="row" style="border-bottom:1px dotted #CCC;padding : 10px 2px;">
            <div class="form-group">
                <label for="speces_category" class="col-md-3 control-label">Select Speces Category</label>
                <div class="col-md-9">{!! Form::select('speces_category[]',$spece_category,'',['class'=>'form-control','id' => 'speces_category'])!!}</div>
            </div>
            <div class="form-group">
                <label for="name" class="col-md-3 control-label">Name</label>
                <div class="col-md-9">{!! Form::text('name[]','',['class'=>'form-control','id' => 'name'])!!}</div>
            </div>
            <div class="form-group">
                <label for="name" class="col-md-3 control-label">File</label>
                <div class="col-md-9">{!! Form::file('file_name[]',['class'=>'form-control','id' => 'file_name'])!!}
                <em style="color:red">Note : Pdf only</em>
                </div>      
            </div>
            <a class="btn btn-danger remove_speces" style="float:right" onclick="removeBox(this)">Remove</a>
            </div>
            </div>
            </div>
            <script>
                        $(function(){
                                    $('.add_more_speces').click(function(){
                                                $('.appendSpeces').append($('.speceBody').html());
                                                
                                    });
                                    
                        });
                        function removeBox(element) {
                                   if (confirm('Are you sure??')) {
                                    $(element).parents('.appendData').remove();
                                    }
                        }
            </script>
@endsection