@extends('admin/layout')

@section('title', 'Admin Users')

@section('content')
    <div class="page-title-breadcrumb" id="title-breadcrumb-option-demo">
                <div class="page-header pull-left">
                    <div class="page-title">Private Planroom Users</div>
                </div>
                <ol class="breadcrumb page-breadcrumb pull-right">
                    <li><i class="fa fa-home"></i>&nbsp;<a href="javascript:void(0);">Home</a>&nbsp;&nbsp;<i class="fa fa-angle-right"></i>&nbsp;&nbsp;</li>
                    <li><i class="fa fa-user"></i>&nbsp;<a href="javascript:void(0);">Users</a>&nbsp;&nbsp;<i class="fa fa-angle-right"></i>&nbsp;&nbsp;</li>
                    <li class="active"><i class="fa fa-user"></i>&nbsp; Private Planroom Users</li>
                </ol>
                <div class="clearfix"></div>
            </div>
    <div class="page-content">
                <div class="row">
                    <div class="col-lg-12">
	            

                     <div class="portlet box portlet-yellow">
                            <div class="portlet-header">
                                <div class="caption">Private Planroom Users List</div>
                                <div class="actions"><a class="btn btn-sm btn-white" href="{{ URL::route('private_users_add') }}"><i class="fa fa-plus"></i>&nbsp;
                                    Add New Private Planroom User</a></div>
                            </div>
                            <div class="portlet-body">
				    <div class="row">
						{!! Form::open(array('route'=>'private_users','method'=>'post','class'=>'form-validate','novalidate')) !!}
			   
						   <div class="col-lg-3">
							   <div class="form-group">
								<div class="input-icon right"><i class="fa fa-search"></i>
								     {!! Form::text('key',$key,['class'=>'form-control','placeholder'=>'Search Keyword'])!!}
								</div>
							   </div>
						   </div>
						   <div class="col-lg-3">
							   <div class="form-group">
								<div class="input-icon right">
								     {!! Form::select('company',$companies,$company,['class'=>'form-control'])!!}
								</div>
							   </div>
						   </div>
						   <div class="col-lg-3">
							   <input type="submit" name="submit" value="Search" class="btn btn-danger" />
							   <a href="{{ URL::route('private_users') }}" class="btn btn-success" >View All</a>
						   </div>
					        {!! Form::close() !!}
				    </div>
                                    <div id="flip-scroll">
                                    <table class="table table-bordered table-striped table-condensed cf">
                                        <thead class="cf">
                                        <tr>
						<th width="20%">Company</th>
                                                <th width="20%">Name</th>
                                                <th width="10%">Email</th>
                                                <th width="10%">Status</th>
                                                <th width="12%">Actions</th>
                                           
                                        </tr>
                                        </thead>
                                        <tbody>
                                          @if($lists->count() >0)
                                                @foreach($lists as $l)
                                                    <tr>
                                                        <td>{!! $l->all_assign_company($l->id)->companyname !!}</td>
                                                        <td>{{ $l->first_name.' '.$l->last_name }}</td>
                                                        <td>{{ $l->email }}</td>
                                                        <td>
                                                          @if($l->status =='Active')
                                                              <span class="label label-sm label-success">{{ $l->status }}</span>
                                                          @else
                                                              <span class="label label-sm label-danger">{{ $l->status }}</span>
                                                          @endif
                                                            
                                                        </td>
                                                        <td>
                                                            <div class="btn-group">
                                                            <button type="button" class="btn btn-info"><i class="fa fa-gears"></i> Actions</button>
                                                            <button type="button" data-toggle="dropdown" class="btn btn-info dropdown-toggle">
                                                                <span class="caret"></span><span class="sr-only">Toggle Dropdown</span>
                                                            </button>
                                                            <ul role="menu" class="dropdown-menu">
                                                                <li><a href="{{ URL::route('private_users_edit',$l->id) }}">Edit</a></li>
                                                                <!--<li><a href="{{ URL::route('private_users_delete',$l->id) }}" onclick="return confirm('Are you sure want to delete this record?')">Delete</a></li>-->								    
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