@extends('admin/layout')

@section('title', 'Order Details')

@section('content')
    <div class="page-title-breadcrumb" id="title-breadcrumb-option-demo">
                <div class="page-header pull-left">
                    <div class="page-title">Order</div>
                </div>
                <ol class="breadcrumb page-breadcrumb pull-right">
                    <li>
                    <i class="fa fa-file-text"></i>&nbsp;
                    <a href="{{ URL::route('admin_city') }}">Order</a>&nbsp;&nbsp;<i class="fa fa-angle-right"></i>&nbsp;&nbsp;
                    </li>
                    <li>
                    <i class="fa fa-eye"></i>&nbsp;
                    <a href="javascript:void(0);">View </a>&nbsp;&nbsp;
                    </li>
                 
                </ol>
                <div class="clearfix"></div>
            </div>
<div class="page-content">
                <div class="row">
                    <div class="col-lg-12">
		    <div class="panel panel-yellow">
                            <div class="panel-heading">Order Details</div>
                            <div class="panel-body pan">                                    
                                   
                                    <div class="form-body pal order-details">
                                         <div class="form-group"><label class="col-md-3 control-label" for="inputName">ID</label>
                                             <div class="col-md-9">
                                                <div class="input-icon right">
                                                            {!! $details->order_master->order_id !!}
                                                </div>
                                            </div>
                                        </div>       
                                         <div class="form-group"><label class="col-md-3 control-label" for="inputName">Project Name</label>
                                             <div class="col-md-9">
                                                <div class="input-icon right">
                                                            {!! $details->project->name !!}
                                                </div>
                                            </div>
                                        </div>     
                                        <div class="form-group"><label class="col-md-3 control-label" for="inputName">Plan Name</label>
                                            <div class="col-md-9">
                                                <div class="input-icon right">
                                                            {!! $details->plan->plan_name !!}
                                                </div>
                                            </div>
                                        </div>

                                        <div class="form-group"><label class="col-md-3 control-label" for="inputName">User Name</label>
                                            <div class="col-md-9">
                                                <div class="input-icon right">
                                                            {!! $details->user->business_name !!}
                                                </div>
                                            </div>
                                        </div>
                                            
                                        <div class="form-group"><label class="col-md-3 control-label" for="inputName">Order Type</label>
                                            <div class="col-md-9">
                                                <div class="input-icon right">
                                                            {!! $details->order_type !!}
                                                </div>
                                            </div>
                                        </div>
                                        
                                        
                                        <div class="form-group"><label class="col-md-3 control-label" for="inputName">Price</label>
                                            <div class="col-md-9">
                                                <div class="input-icon right">
                                                            {!! $details->price !!}
                                                </div>
                                            </div>
                                        </div>
                                            
                                        <div class="form-group"><label class="col-md-3 control-label" for="inputName">Quantity</label>
                                            <div class="col-md-9">
                                                <div class="input-icon right">
                                                            {!! $details->quantity !!}
                                                </div>
                                            </div>
                                        </div>
                                            
                                        <div class="form-group"><label class="col-md-3 control-label" for="inputName">Transaction Id</label>
                                            <div class="col-md-9">
                                                <div class="input-icon right">
                                                            {!! $details->order_master->transaction_id !!}
                                                </div>
                                            </div>
                                        </div>
                                            
				     </div>
                                    <div class="form-actions pal">
                                        <div class="form-group mbn">
                                            <div class="col-md-offset-3 col-md-6">
                                           
                                            {!! Html::linkRoute('admin_order_list', 'Back', array(), array('class' => 'btn btn-green')) !!}
                                            </div>
                                        </div>
                                    </div>
                                    
                            </div>
                        </div>
                     
                         </div>
                </div>
            </div>
		
@endsection