@extends('admin/layout')

@section('title', 'Order list')

@section('content')
    <div class="page-title-breadcrumb" id="title-breadcrumb-option-demo">
                <div class="page-header pull-left">
                    <div class="page-title">Order</div>
                </div>
                <ol class="breadcrumb page-breadcrumb pull-right">
                    <li>
                    <i class="fa fa-file-text"></i>&nbsp;
                    <a href="javascript:void(0);">Order</a>&nbsp;&nbsp;<i class="fa fa-angle-right"></i>&nbsp;&nbsp;
                    </li>
                    <li>
                    <i class="fa fa-list"></i>&nbsp;
                    <a href="javascript:void(0);">List</a>&nbsp;&nbsp;
                    </li>
                 
                </ol>
                <div class="clearfix"></div>
            </div>
<div class="page-content">
                <div class="row">
		@if(Session::has('succmsg'))
			    <div class="note note-success"><p>{{ Session::get('succmsg') }}</p></div>
		
	        @endif
                    <div class="col-lg-12">
                     <div class="portlet box portlet-yellow">
                            <div class="portlet-header">
                                <div class="caption">Order List</div>
                            </div>
                            <div class="portlet-body">
                            
                            
                            <div class="row">
                                    {!! Form::open(array('route'=>'admin_order_list','method'=>'post','class'=>'form-validate','novalidate')) !!}
                
                                        <div class="col-lg-3">
                                                <div class="form-group">
                                                     <div class="input-icon right"><i class="fa fa-search"></i>
                                                         {!! Form::text('keyword',$keyword,array('class'=>"form-control","placeholder"=>"Enter The Keyword")) !!}
                                                     </div>
                                                </div>
                                        </div>
                                        <div class="col-lg-2">
                                                {!! Form::select('project_list',$project_list,$project_list_val,array('class'=>"form-control"))!!}
                                        </div>
                                        <div class="col-lg-2">
                                                {!! Form::select('user_list',$user_list,$user_list_val,array('class'=>"form-control"))!!}
                                        </div> 
                                        <div class="col-lg-2">
                                                {!! Form::select('plan_list',$plan_list,$plan_list_val,array('class'=>"form-control"))!!}
                                        </div> 
                                        <div class="col-lg-2">
                                                {!! Form::select('types',$type,$types,array('class'=>"form-control"))!!}
                                        </div> 
                                          
                                        <div class="col-lg-3">
                                                <input type="submit" name="submit" value="Search" class="btn btn-danger" />
                                                <a href="{{ URL::route('admin_order_list') }}" class="btn btn-success" >View All</a>
                                        </div>
                                    {!! Form::close() !!}
                             </div> 

                            
                            
                                    <div id="flip-scroll">
                                    <table class="table table-striped table-bordered table-hover">
                                        <thead >
                                        <tr>
						<th>ID</th>
						<th>Project Name</th>
						<th>Plan Name</th>
                                                <th>User Name</th>
                                                <th>Order Type</th>
                                                <th>Price</th>
                                                <th>Quantity</th>
                                                <th>Transaction Id</th>
                                                <th>Action</th>
						
                                        </tr>
                                        </thead>
                                        <tbody>
                                          @if($lists_result->count() > 0)
								@foreach($lists_result AS $r)
								<tr>
									<td>{!! $r->order_master->order_id !!}</td>
									<td>{!! $r->project->name !!}</td>
									<td>{!! $r->plan->plan_name !!}</td>
                                                                        <td>{!! $r->user->business_name !!}</td>
                                                                        <td>{!! $r->order_type !!}</td>
                                                                        <td>{!! $r->price !!}</td>
                                                                        <td>{!! $r->quantity !!}</td>
                                                                        <td>{!! $r->order_master->transaction_id !!}</td>
									<td>
                                                                            <a class="btn btn-info" href="{{ URL::route('admin_order_view',$r->id) }}" title="View" ><i class="fa fa-eye"></i>
									</a>
                                                                            
                                                                        </td>
								</tr>
								@endforeach
							@else
								<tr><td colspan="7" align="center">.:: Record Not Found ::.</td></tr>
							@endif	
                                        </tbody>
                                    </table>
                                          <div class="pagination-panel">
						 {!! $lists_result->render() !!}
						  </div>
                                </div>

                                
                            </div>
                        </div>
                     
                     
                     
                         </div>
                </div>
            </div>
		
@endsection