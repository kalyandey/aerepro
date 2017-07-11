@extends('admin/layout')

@section('title', 'Customer')

@section('content')
    <div class="page-title-breadcrumb" id="title-breadcrumb-option-demo">
                <div class="page-header pull-left">
                    <div class="page-title">Customer</div>
                </div>
               <ol class="breadcrumb page-breadcrumb pull-right">
                    <li><i class="fa fa-home"></i>&nbsp;<a href="javascript:void(0);">Home</a>&nbsp;&nbsp;<i class="fa fa-angle-right"></i>&nbsp;&nbsp;</li>
                    <li><i class="fa fa-user"></i>&nbsp;<a href="javascript:void(0);">Users</a>&nbsp;&nbsp;<i class="fa fa-angle-right"></i>&nbsp;&nbsp;</li>
                    <li class="active"><i class="fa fa-user"></i>&nbsp; Customer</li>
                </ol>
                <div class="clearfix"></div>
            </div>
    <div class="page-content">
                <div class="row">
                    <div class="col-lg-12">
	            <div class="form-body pal">
		     <form action="" method="get">

			<div class="col-lg-3">
				<div class="form-group">
				     <div class="input-icon right"><i class="fa fa-search"></i>
					  <input  type="text" class="form-control" placeholder="Search Keyword" name="key" value="{{ $key }}">
				     </div>
				</div>
			</div>
			
			<div class="col-lg-3">
							   <div class="form-group">
								<div class="input-icon right">
								     {!! Form::select('trade',$trades,$trade,['class'=>'form-control'])!!}
								</div>
							   </div>
						   </div>
	               
		       
		       <div class="col-lg-3">
							   <div class="form-group">
								<div class="input-icon right">
								     {!! Form::select('profession',$professions,$profession,['class'=>'form-control'])!!}
								</div>
							   </div>
						   </div>
							    
			<div class="col-lg-3">
							   <div class="form-group">
								<div class="input-icon right">
								     {!! Form::select('csidivision',$csidivisions,$csidivision,['class'=>'form-control'])!!}
								</div>
							   </div>
						   </div>
		       
		       
			
			
			<div class="row">
			<div class="col-lg-6">
				<input type="submit" name="submit" value="Search" class="btn btn-danger" />
				<a href="{{ URL::route('front_users') }}" class="btn btn-success" >View All</a>
			        
				<input type="submit" class="btn btn-warning" value="Export to CSV" name="export">
			</div></div>
		    </form>
		    </div>

                     <div class="portlet box portlet-yellow">
                            <div class="portlet-header">
                                <div class="caption">Customer List</div>
                                <div class="actions"><a class="btn btn-sm btn-info" href="{{ URL::route('front_users_add') }}"><i class="fa fa-plus"></i>&nbsp;
                                    Add Customer</a></div>
                            </div>
                            <div class="portlet-body">
                                    <div id="flip-scroll">
                                    <table class="table table-bordered table-striped table-condensed cf">
                                        <thead class="cf">
                                        <tr>
						<th width="20%">Business Name</th>
                                                <th width="20%">Name</th>
                                                <th width="10%">Email</th>
                                                <th width="3%">PR</th>
						<th width="3%">BY</th>
						<th width="3%">BC</th>
                                                <th width="15%">Actions</th>
                                           
                                        </tr>
                                        </thead>
                                        <tbody>
                                         @if($lists->count() >0)
                                                @foreach($lists as $l)
                                                    <tr>
                                                        <td>{{ $l->business_name }}</td>
                                                        <td>{{ $l->first_name.' '.$l->last_name }}</td>
                                                        <td>{{ $l->email }}</td>
                                                        <td>
							    @php
							    $projectSub = $l->user_subscription()->where('subscription_id',1)->first();
							    @endphp
							    
							    @if(count($projectSub)>0)
									@php
									$date = date('Y-m-d',strtotime($projectSub->end_date));
									@endphp
									@if($date >= date('Y-m-d'))
										    <span class="label label-sm label-success">{{date('m/d/y',strtotime($projectSub->end_date))}}</span>
									@else
										    <span class="label label-sm label-danger">{{date('m/d/y',strtotime($projectSub->end_date))}}</span>
									@endif
							    @else
							    <span class="label label-sm label-danger">N/A</span>
							    @endif
							</td>
							<td>
							    @php
							    $yavSub = $l->user_subscription()->where('subscription_id',2)->first();
							    @endphp
							    
							    @if(count($yavSub)>0)
									@php
									$date = date('Y-m-d',strtotime($yavSub->end_date));
									@endphp
									@if($date >= date('Y-m-d'))
										    <span class="label label-sm label-success">{{date('m/d/y',strtotime($yavSub->end_date))}}</span>
									@else
										    <span class="label label-sm label-danger">{{date('m/d/y',strtotime($yavSub->end_date))}}</span>
									@endif
							    @else
							    <span class="label label-sm label-danger">N/A</span>
							    @endif
							</td>
							<td>
							    @php
							    $cocoSub = $l->user_subscription()->where('subscription_id',3)->first();
							    @endphp
							     @if(count($cocoSub)>0)
									@php
									$date = date('Y-m-d',strtotime($cocoSub->end_date));
									@endphp
									@if($date >= date('Y-m-d'))
										    <span class="label label-sm label-success">{{date('m/d/y',strtotime($cocoSub->end_date))}}</span>
									@else
										    <span class="label label-sm label-danger">{{date('m/d/y',strtotime($cocoSub->end_date))}}</span>
									@endif
							    @else
							    <span class="label label-sm label-danger">N/A</span>
							    @endif
							</td>
                                                        <td>
                                                            <div class="btn-group">
                                                            <button type="button" class="btn btn-info"><i class="fa fa-gears"></i> Actions</button>
                                                            <button type="button" data-toggle="dropdown" class="btn btn-info dropdown-toggle">
                                                                <span class="caret"></span><span class="sr-only">Toggle Dropdown</span>
                                                            </button>
                                                            <ul role="menu" class="dropdown-menu">
                                                                <li><a href="{{ URL::route('front_users_edit',$l->id) }}">Edit</a></li>
								<li><a href="{{ URL::route('front_transaction_history',$l->id) }}">Transaction History</a></li>	
                                                                <li><a href="{{ URL::route('front_users_delete',$l->id) }}" onclick="return confirm('Are you sure want to delete this record?')">Delete</a></li>								    
                                                            </ul>
                                                            </div>   
                                                        </td>
                                                    </tr>
                                                     @endforeach
							@else
								<tr><td colspan="7" align="center">.:: Record Not Found ::.</td></tr>
							@endif	
                                        </tbody>
                                    </table>
                                          <div class="pagination-panel">
						
						{!! $lists->render() !!}
						
						
						 
				         </div>
						
						
			
			
                                </div>

                                
                            </div>
                        </div>
                     
                     
                     
                         </div>
                </div>
            </div>
		
@endsection