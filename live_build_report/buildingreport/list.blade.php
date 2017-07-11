@extends('admin/layout')

@section('title', 'Permit Owner list')

@section('content')
    <div class="page-title-breadcrumb" id="title-breadcrumb-option-demo">
                <div class="page-header pull-left">
                    <div class="page-title">PlanRoom Building Reports</div>
                </div>
                <ol class="breadcrumb page-breadcrumb pull-right">
                    <li>
                    <i class="fa fa-file-text-o"></i>&nbsp;
                    <a href="javascript:void(0);">PlanRoom Building Reports</a>&nbsp;&nbsp;<i class="fa fa-angle-right"></i>&nbsp;&nbsp;
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
                    <div class="col-lg-12">
                     <div class="portlet box portlet-yellow">
                            <div class="portlet-header">
                                <div class="caption">PlanRoom Building Reports List</div>
                                <div class="actions">
                                <a class="btn btn-sm btn-white" href="{{ URL::route('admin_buildingreport_create') }}"><i class="fa fa-plus"></i>&nbsp;
                                    New Building Reports</a>&nbsp;</div>
                            </div>
                            <div class="portlet-body">
				    <div class="row col-lg-12">
                                    {!! Form::open(array('route'=>'admin_buildingreport','method'=>'post','class'=>'form-validate','novalidate')) !!}
                
                                        <div class="col-lg-2">
                                                <div class="form-group">
                                                     <div class="input-icon right"><i class="fa fa-search"></i>
                                                         {!! Form::text('keyword',$keyword,array('class'=>"form-control","placeholder"=>"Enter The Keyword")) !!}
                                                     </div>
                                                </div>
                                        </div>
				        <div class="col-lg-2">
						{!! Form::select('jurisdictions',$jurisdiction,$jurisdictions,array('class'=>"form-control")) !!}
					</div>
					<div class="col-lg-2">
						{!! Form::text('contractor',$contractor,['class'=>'form-control contractor_business_name','placeholder'=>'Type Contractor'])!!}
                                                {!! Form::hidden('contractor_id',$contractor_id,['class' => 'contractor_id']) !!}
						
					</div>
                                        <!--<div class="col-lg-2">
                                                {!! Form::select('permit_owners',$permit_owner,$permit_owners,array('class'=>"form-control"))!!}
                                        </div>-->
                                        <div class="col-lg-1">
						{!! Form::submit('Search',array('class'=> 'btn btn-danger')) !!}
                                        </div>
					<div class="col-lg-1">
					<a href="{{ URL::route('admin_buildingreport') }}" class="btn btn-success" >View All</a>
                                        </div>	
                                    {!! Form::close() !!}
				    </div>
                                 <div id="flip-scroll">
                                    <table class="table table-striped table-bordered table-hover">
                                        <thead >
                                        <tr>
					    <th>ID</th>
                                            <th>Permit Issued</th>
				            <th>Jurisdiction</th>
				            <th>Job Type</th>
                                            <th>Owner</th>
					    <th>General Contractor</th>
				            <th>Status</th>
                                            <th class="numeric" width="15%">Action</th>
                                           
                                        </tr>
                                        </thead>
                                        <tbody>
                                          @if($lists->count() > 0)
						@foreach($lists AS $r)
						<tr>
						        <td>{{$r->number}}</td>
							<td>
							@php
							$issued_date = explode('-',$r->issued_date);
							@endphp
							{{$issued_date[1].'/'.$issued_date[2].'/'.$issued_date[0]}}
							</td>
							<td>@if(isset($r->jurisdictions->name)){{$r->jurisdictions->name}}@else N/A @endif</td>
							<td>@if(isset($r->permit_type_id)){{$r->permit_type_id}}@else N/A @endif</td>
							<td>@if(isset($r->permit_owner->owner_name)){{$r->permit_owner->owner_name}}@else N/A @endif</td>
							<td>@if(isset($r->contractor->name)){{$r->contractor->business_name}}@else N/A @endif</td>    
							<td>
							@if($r->status == 'Active')
								    <span class="label label-sm label-success"> {{ $r->status }}</span>
							@else
								    <span class="label label-sm label-danger"> {{ $r->status }}</span>
							@endif
							 </td>
							<td>
								    <div class="btn-group">
								    <button type="button" class="btn btn-info"><i class="fa fa-gears"></i> Actions</button>
								    <button type="button" data-toggle="dropdown" class="btn btn-info dropdown-toggle">
									<span class="caret"></span><span class="sr-only">Toggle Dropdown</span>
								    </button>
								    <ul role="menu" class="dropdown-menu">
									<li><a href="{{ URL::route('admin_buildingreport_edit',$r->id) }}">Edit</a></li>
									<li><a href="{{ URL::route('admin_buildingreport_delete',$r->id) }}" onclick="return confirm('Are you sure want to delete this record?')">Delete</a></li>					    
								    </ul>
								    </div>  	 
							</td>
						</tr>
						@endforeach
					@else
						<tr><td colspan="8" align="center">.:: Record Not Found ::.</td></tr>
					@endif	
                                        </tbody>
                                    </table>
                                          <div class="pagination-panel">
						@if($keyword !='' || $contractor_id != '' || $permit_owners != '' || $jurisdictions != '')
					  {!! $lists->appends(['keyword'=>$keyword,'contractor_id'=>$contractor_id,'permit_owners'=>$permit_owners,'jurisdictions'=>$jurisdictions,'contractor'=>$contractor])->render() !!}
						@else
						 {!! $lists->render() !!}
						@endif
						  </div>
                                </div>

                                
                            </div>
                        </div>
                     
                     
                     
                         </div>
                </div>
            </div>
		
@endsection