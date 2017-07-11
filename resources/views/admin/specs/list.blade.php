@extends('admin/layout')

@section('title', 'Specs List')

@section('content')
    <div class="page-title-breadcrumb" id="title-breadcrumb-option-demo">
                <div class="page-header pull-left">
                    <div class="page-title">Specs</div>
                </div>
                <ol class="breadcrumb page-breadcrumb pull-right">
                    <li>
                    <i class="fa fa-list-ul"></i>&nbsp;
                    <a href="javascript:void(0);">Specs</a>&nbsp;&nbsp;<i class="fa fa-angle-right"></i>&nbsp;&nbsp;
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
                                <div class="caption">Specs List</div>
                                <div class="actions"><a class="btn btn-sm btn-info" href="{{ URL::route('specs_add') }}"><i class="fa fa-plus"></i>&nbsp;
                                    Add Speces</a></div>
                            </div>
                            <div class="portlet-body">
                                 <div id="flip-scroll">
                                    <table class="table table-striped table-bordered table-hover">
                                        <thead >
                                        <tr>
                                            <th width="50%">Name</th>
					    <th width="20%">Status</th>	
                                            <th class="numeric">Action</th>
                                           
                                        </tr>
                                        </thead>
                                        <tbody>
                                          @if($lists->count() > 0)
								@foreach($lists AS $r)
								<tr>
									<td>{{$r->name}}</td>
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
											<li><a href="{{ URL::route('admin_specs_edit',$r->id) }}">Edit</a></li>
																    
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