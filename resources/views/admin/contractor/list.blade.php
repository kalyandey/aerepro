@extends('admin/layout')

@section('title', 'General Contractor List')

@section('content')
    <div class="page-title-breadcrumb" id="title-breadcrumb-option-demo">
                <div class="page-header pull-left">
                    <div class="page-title">General Contractor</div>
                </div>
                <ol class="breadcrumb page-breadcrumb pull-right">
                    <li>
                    <i class="fa fa-list-ul"></i>&nbsp;
                    <a href="javascript:void(0);">General Contractor</a>&nbsp;&nbsp;<i class="fa fa-angle-right"></i>&nbsp;&nbsp;
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
                    <div class="form-body pal">
                        {!! Form::open(array('route'=>'admin_contractor','method'=>'post','class'=>'form-validate','novalidate')) !!}

                        <div class="col-lg-3">
                                <div class="form-group">
                                     <div class="input-icon right"><i class="fa fa-search"></i>
                                         {!! Form::text('keyword',$keyword,array('class'=>"form-control","placeholder"=>"Enter The Keyword")) !!}
                                     </div>
                                </div>
                        </div>
                        <div class="col-lg-3">
                                <input type="submit" name="submit" value="Search" class="btn btn-danger" />
                                <a href="{{ URL::route('admin_contractor') }}" class="btn btn-success" >View All</a>
                        </div>
                        {!! Form::close() !!}
                        </div>
                     <div class="portlet box portlet-yellow">
                            <div class="portlet-header">
                                <div class="caption">General Contractor List</div>
                                <div class="actions"><a class="btn btn-sm btn-info" href="{{ URL::route('contractor_add') }}"><i class="fa fa-plus"></i>&nbsp;
                                    Add General Contractor</a></div>
                            </div>
                            <div class="portlet-body">
                                 <div id="flip-scroll">
                                    <table class="table table-striped table-bordered table-hover">
                                        <thead >
                                        <tr>
                                            <th width="15%">Business Name</th>
                                            <th width="15%">Contact Name</th>
                                            <th width="20%">Address</th>
                                            <th width="15%">Email</th>
                                            <th width="15%">Phone</th>
                                            <th class="numeric">Action</th>
                                           
                                        </tr>
                                        </thead>
                                        <tbody>
                                          @if($lists->count() > 0)
						@foreach($lists AS $r)
								<tr>
									<td>{{$r->business_name}}</td>
                                                                        <td>{{$r->name}}</td>
                                                                        <td>
                                                                            State : {!! (count($r->state_name)>0)?$r->state_name->state:'' !!}<br>
                                                                            City : {{$r->city}}<br>
                                                                            Street : {{$r->street}}
                                                                       </td>
                                                                       <td>{{$r->email}}</td>
                                                                       <td>{{$r->phone}}</td>
                                                                        <td>
										    <div class="btn-group">
										    <button type="button" class="btn btn-info"><i class="fa fa-gears"></i> Actions</button>
										    <button type="button" data-toggle="dropdown" class="btn btn-info dropdown-toggle">
											<span class="caret"></span><span class="sr-only">Toggle Dropdown</span>
										    </button>
										    <ul role="menu" class="dropdown-menu">
											<li><a href="{{ URL::route('admin_contractor_edit',$r->id) }}">Edit</a></li>
											<li><a href="{{ URL::route('admin_contractor_delete',$r->id) }}" onclick="return confirm('Are you sure want to delete this record?')">Delete</a></li>								    					    
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