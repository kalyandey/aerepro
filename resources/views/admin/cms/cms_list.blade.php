@extends('admin/layout')

@section('title', 'CMS list')

@section('content')
    <div class="page-title-breadcrumb" id="title-breadcrumb-option-demo">
                <div class="page-header pull-left">
                    <div class="page-title">CMS</div>
                </div>
                <ol class="breadcrumb page-breadcrumb pull-right">
                    <li>
                    <i class="fa fa-bar-chart-o fa-fw"></i>&nbsp;
                    <a href="javascript:void(0);">CMS</a>&nbsp;&nbsp;<i class="fa fa-angle-right"></i>&nbsp;&nbsp;
                    </li>
                    <li>
                    <i class="fa fa-list-ul"></i>&nbsp;
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
                                <div class="caption">CMS List</div>
                                <div class="actions">    <a class="btn btn-info btn-xs" href="{{ URL::route('admin_cms_add') }}"><i class="fa fa-plus"></i>&nbsp;
                                    New CMS</a>&nbsp;</div>
                            </div>
                            <div class="portlet-body">
                                    <div id="flip-scroll">
                                    <table class="table table-striped table-bordered table-hover">
                                        <thead >
                                        <tr>
                                            <th width="50%">Title</th>
                                            <th width="30%" class="numeric">Status</th>
                                            <th class="numeric">Action</th>
                                           
                                        </tr>
                                        </thead>
                                        <tbody>
                                          @if($lists->count() > 0)
								@foreach($lists AS $r)
								<tr>
									<td>{{$r->cms_title}}</td>
									<td>
									@if($r->cms_status == 'Active')
										    <span class="label label-sm label-success"> {{ $r->cms_status }}</span>
									@else
										    <span class="label label-sm label-danger"> {{ $r->cms_status }}</span>
									@endif
									 </td>
													
									<td>
									
									<a class="btn btn-info" href="{{ URL::route('admin_cms_edit',$r->id) }}" title="Edit" ><i class="fa fa-edit"></i>
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
						 {!! $lists->render() !!}
						  </div>
                                </div>

                                
                            </div>
                        </div>
                     
                     
                     
                         </div>
                </div>
            </div>
		
@endsection