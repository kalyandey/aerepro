@extends('admin/layout')

@section('title', 'Bidder List')

@section('content')
    <div class="page-title-breadcrumb" id="title-breadcrumb-option-demo">
                <div class="page-header pull-left">
                    <div class="page-title">Bidder Database</div>
                </div>
                <ol class="breadcrumb page-breadcrumb pull-right">
                    <li>
                    <i class="fa fa-file-text-o"></i>&nbsp;
                    <a href="javascript:void(0);">Bidder Database</a>&nbsp;&nbsp;<i class="fa fa-angle-right"></i>&nbsp;&nbsp;
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
                                <div class="caption">Bidder Database List</div> 
                             </div>
                             <div class="portlet-body">
				    <div class="row">
                                    {!! Form::open(array('route'=>array('admin_bidder_database_list'),'method'=>'post','class'=>'form-validate','novalidate')) !!}
                
                                        <div class="col-lg-3">
                                                <div class="form-group">
                                                     <div class="input-icon right"><i class="fa fa-search"></i>
                                                         {!! Form::text('keyword',$keyword,array('class'=>"form-control","placeholder"=>"Enter The Keyword")) !!}
                                                     </div>
                                                </div>
                                        </div>
					<div class="col-lg-3">
                                                <div class="form-group">
                                                     <div class="input-icon right"><i class="fa fa-search"></i>
                                                         {!! Form::text('project',$project,array('class'=>"form-control projectIdFromBidder",'placeholder'=>'Type project ID')) !!}
                                                     </div>
                                                </div>
                                        </div>	
                                        <div class="col-lg-3">
                                                <input type="submit" name="submit" value="Search" class="btn btn-danger" />
                                                <a href="{{ URL::route('admin_bidder_database_list') }}" class="btn btn-success" >View All</a>
                                        </div>
                                    {!! Form::close() !!}
				    </div>
                                 <div id="flip-scroll">
                                    <table class="table table-striped table-bordered table-hover">
                                        <thead >
                                        <tr>
					    <!--<th>Project Name</th>-->
                                            <th>Company</th>
                                            <th>Contact</th>
					    <th>Address</th>
					    <th>Phone</th>
					    <th>Email</th>
					    <th>Status</th>	
                                            <th class="numeric" width="15%">Action</th>
                                           
                                        </tr>
                                        </thead>
                                        <tbody>
                                          @if($lists->count() > 0)
						@foreach($lists AS $r)
						<tr>
							<!--<td>{!! $r->all_project($r->id)->project_name !!}</td>-->    
							<td>{{$r->company}}</td>
							<td>{{$r->contact}}</td>
							<td>{{$r->address}}</td>
							<td>{{$r->phone}}</td>
							<td>{{$r->email}}</td>
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
								<li><a href="{{ URL::route('admin_bidder_database_edit',[$r->id]) }}">Edit</a></li>
								<li><a href="{{ URL::route('admin_bidder_database_delete',[$r->id]) }}" onclick="return confirm('Are you sure want to delete this record?')">Delete</a></li>					    
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