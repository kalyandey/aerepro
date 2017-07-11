@extends('admin/layout')

@section('title', 'Subscription list')

@section('content')
    <div class="page-title-breadcrumb" id="title-breadcrumb-option-demo">
                <div class="page-header pull-left">
                    <div class="page-title">Subscription</div>
                </div>
                <ol class="breadcrumb page-breadcrumb pull-right">
                    <li>
                    <i class="fa fa-file-text-o"></i>&nbsp;
                    <a href="javascript:void(0);">Subscription</a>&nbsp;&nbsp;<i class="fa fa-angle-right"></i>&nbsp;&nbsp;
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
                                <div class="caption">Subscription List</div>
                                <div class="actions">&nbsp;</div>
                            </div>
                            <div class="portlet-body">
                                 <div id="flip-scroll">
                                    <table class="table table-striped table-bordered table-hover">
                                        <thead >
                                        <tr>
                                            <th width="30%">Title</th>
                                            <th width="30%" class="numeric">Quarterly Price</th>
                                            <th width="10%" class="numeric">Yearly Price</th>
                                            <th class="numeric">Action</th>
                                           
                                        </tr>
                                        </thead>
                                        <tbody>
                                          @if($lists->count() > 0)
								@foreach($lists AS $r)
								<tr>
									<td>{{$r->subscription_title}}</td>
									<td>{{$r->quarterly_price}}</td>
                                                                        <td>{{$r->yearly_price}}</td>
													
									
									<td>
										    <div class="btn-group">
										    <button type="button" class="btn btn-info"><i class="fa fa-gears"></i> Actions</button>
										    <button type="button" data-toggle="dropdown" class="btn btn-info dropdown-toggle">
											<span class="caret"></span><span class="sr-only">Toggle Dropdown</span>
										    </button>
										    <ul role="menu" class="dropdown-menu">
											<li><a href="{{ URL::route('admin_subscription_edit',$r->id) }}">Edit</a></li>
																    
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
                                          
                                </div>

                                
                            </div>
                        </div>
                     
                     
                     
                         </div>
                </div>
            </div>
		
@endsection