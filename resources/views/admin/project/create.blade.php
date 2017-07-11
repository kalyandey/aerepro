@extends('admin.layout')
@section('content')
    
    <div id="title-breadcrumb-option-demo" class="page-title-breadcrumb">
                <div class="page-header pull-left">
                    <div class="page-title">Create Project</div>
                </div>
                <ol class="breadcrumb page-breadcrumb pull-right">
                    <li><i class="fa fa-home"></i>&nbsp;<a href="javascript:void(0);">Home</a>&nbsp;&nbsp;<i class="fa fa-angle-right"></i>&nbsp;&nbsp;</li>
                    <li class="active">Create Project</li>
                </ol>
                <div class="clearfix"></div>
    </div>
    <div class="page-content">
        <div id="form-layouts" class="row">
            <div class="col-lg-12">
                    <div class="portlet box portlet-yellow">
                        <div class="portlet-header">
                            <div class="caption">Create Project</div>
                        </div>
                        <div class="portlet-body">
                            <div class="row">
                                <div class="topTabText">
                                    <div class="col-md-2 btn btn-primary" style="border-right:1px solid #FFF">1. Details</div>
                                    <div class="col-md-2 btn btn-default" style="border-right:1px solid #FFF">2. Awarded To </div>
                                    <div class="col-md-1 btn btn-default" style="border-right:1px solid #FFF">3. Address </div>
                                    <div class="col-md-2 btn btn-default" style="border-right:1px solid #FFF">4. Project Principal </div>
                                    <div class="col-md-2 btn btn-default" style="border-right:1px solid #FFF">5. GCs</div>
                                    <div class="col-md-1 btn btn-default" style="border-right:1px solid #FFF">6. Plans</div>
                                    <div class="col-md-2 btn btn-default" style="border-right:1px solid #FFF">7. Specs</div>
                                    
                                        
                                    @if (count($errors) > 0)
                                        <div class="alert alert-danger">
                                            <ul>
                                                @foreach ($errors->all() as $error)
                                                    <li>{{ $error }}</li>
                                                @endforeach
                                            </ul>
                                        </div>
                                    @endif
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-12">
                                    <!--<h3>Account Information</h3>-->
                                    <br>
                                        {!! Form::open(array('route'=>'admin_project_post','class'=>'form-validate form-horizontal','files'=>true,'method'=>'post')) !!}
                                        <div class="form-group">
                                            <label for="Name" class="col-md-3 control-label">Project Name</label>
                                            <div class="col-md-9">{!! Form::text('name','',['class'=>'form-control required','id' => 'Name'])!!}</div>
                                        </div>
                                        <div class="form-group">
                                            <label for="Category" class="col-md-3 control-label">Category</label>
                                            <div class="col-md-9">{!! Form::select('category_id',$category,'',['class'=>'form-control required','id' => 'Category'])!!}</div>
                                        </div>
                                        <div class="form-group">
                                            <label for="Type" class="col-md-3 control-label">Type</label>
                                            <div class="col-md-9">{!! Form::select('type_id',$type,'',['class'=>'form-control required','id' => 'Type'])!!}</div>
                                        </div>
                                        <div class="form-group">
                                            <label for="bid_date" class="col-md-3 control-label">Bid Close Date</label>
                                            <div class="col-md-9">    
                                            <div class="input-group datetimepicker-subscription date">{!! Form::text('bid_close_date','',['class'=>'form-control','id' => 'bid_date','autocomplete'=>'off'])!!}
                                            <span class="input-group-addon"><i class="fa fa-calendar"></i></span>
                                            </div>
                                            </div>    
                                        </div>
                                        <div class="form-group">
                                            <label for="time_due" class="col-md-3 control-label">Time Due</label>
                                            <div class="col-md-9">    
                                            <div class="input-group datetimepicker-disable-date date">{!! Form::text('time_due','',['class'=>'form-control','id' => 'time_due','autocomplete'=>'off'])!!}
                                            <span class="input-group-addon"><i class="fa fa-clock-o"></i></span>
                                            </div>
                                            </div>    
                                        </div>
                                        <div class="form-group">
                                            <label for="pre_bid_meeting_date" class="col-md-3 control-label">Pre-Bid Meeting Date</label>
                                            <div class="col-md-9">
                                            <div class="input-group datetimepicker-subscription date">{!! Form::text('pre_bid_meeting_date','',['class'=>'form-control','id' => 'pre_bid_meeting_date','autocomplete'=>'off'])!!}
                                            <span class="input-group-addon"><i class="fa fa-calendar"></i></span>
                                            </div>
                                            </div>    
                                        </div>  
                                        <div class="form-group">
                                            <label for="pre_bid_meeting_time" class="col-md-3 control-label">Pre-Bid Meeting Time</label>
                                            <div class="col-md-9">
                                            <div class="input-group datetimepicker-disable-date date">{!! Form::text('pre_bid_meeting_time','',['class'=>'form-control','id' => 'pre_bid_meeting_time','autocomplete'=>'off'])!!}
                                            <span class="input-group-addon"><i class="fa fa-clock-o"></i></span>
                                            </div>
                                            </div>    
                                        </div>
                                        <div class="form-group">
                                            <label for="mandatory_pre_bidding" class="col-md-3 control-label">Mandatory Pre-Bidding</label>
                                            <div class="col-md-9">{!! Form::select('mandatory_pre_bidding',['No'=>'No','Yes' => 'Yes'],'',['class'=>' form-control','id' => 'mandatory_pre_bidding'])!!}</div>
                                        </div>
                                        <div class="form-group">
                                            <label for="valuation" class="col-md-3 control-label">Valuation</label>
                                            <div class="col-md-9">{!! Form::text('valuation','',['class'=>'form-control','id' => 'valuation'])!!}</div>
                                        </div>
                                       <!-- <div class="form-group">
                                            <label for="documents" class="col-md-3 control-label">Documents</label>
                                            <div class="col-md-9">{!! Form::file('documents','',['class'=>'form-control','id' => 'documents'])!!}
                                            <em style="color:red">[Note:Pdf only]</em></div>
                                        </div>-->
                                        <div class="form-group">
                                            <label for="trade" class="col-md-3 control-label">Trade</label>
                                            <div class="col-md-9">
                                                @if(count($plan_trade) > 0)
                                                            @foreach($plan_trade as $k=>$t)
                                                                   <div class="col-md-4">
                                                                   {!! Form::checkbox('trade[]',$t->id).' '. $t->trade_title !!}
                                                                   </div>  
                                                            @endforeach
                                                @endif
                                            </div>
                                        </div>               
                                        <div class="form-group">
                                            <label for="description" class="col-md-3 control-label">Description</label>
                                            <div class="col-md-9">{!! Form::textarea('description','',['class'=>'form-control ckeditor','id' => 'summernote-default'])!!}</div>
                                        </div>
                                        <div class="form-group">
                                            <label for="additional_comments" class="col-md-3 control-label">Additional Comments</label>
                                            <div class="col-md-9">{!! Form::textarea('additional_comments','',['class'=>'form-control ckeditor','id' => 'additional_comments'])!!}</div>
                                        </div>
                                        <div class="form-group">
                                            <label for="status" class="col-md-3 control-label">Status</label>
                                            <div class="col-md-9">{!! Form::select('status',[''=>'Select Status','Bidding'=>'Bidding','Awarded'=>'Awarded','Closed'=>'Closed','apparent_low'=>'Apparent Low'],'',['class'=>'form-control required','id' => 'status'])!!}</div>
                                        </div>         
                                        <div class="form-actions">
                                        <div class="col-md-12">
                                        {!! Form::submit('Submit',['class'=>'btn btn-primary'])!!}
                                        <a class="btn btn-default" href="{{URL::route('admin_project')}}">Cancel</a>
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
@endsection