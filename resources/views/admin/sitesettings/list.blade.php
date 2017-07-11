@extends('admin/layout')

@section('title', 'Sitesetting list')

@section('content')
    <div class="page-title-breadcrumb" id="title-breadcrumb-option-demo">
                <div class="page-header pull-left">
                    <div class="page-title">Sitesetting</div>
                </div>
                <ol class="breadcrumb page-breadcrumb pull-right">
                    <li>
                    <i class="fa fa-cogs"></i>&nbsp;
                    <a href="javascript:void(0);">Sitesetting</a>&nbsp;&nbsp;<i class="fa fa-angle-right"></i>&nbsp;&nbsp;
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
                                <div class="caption">Sitesetting List</div>
                            </div>
                            <div class="portlet-body">
                                    <div id="flip-scroll">
                                    <table class="table table-striped table-bordered table-hover">
                                        <thead >
                                        <tr>
						<th>SL No.</th>
						<th>Settings Name</th>
						<th>Settings Value</th>
						<th>Actions</th> 
                                        </tr>
                                        </thead>
                                        <tbody>
                                          @if($lists->count() > 0)
								@foreach($lists AS $k=>$r)
								<tr>
									<td>{!! $k+1 !!}</td>
									<td>{!! $r->sitesettings_lebel !!}</td>
									<td>{!! $r->sitesettings_value !!}</td>
									<td>
									<a class="btn btn-info" href="{{ URL::route('admin_sitesettings_edit',$r->id) }}" title="Edit" ><i class="fa fa-edit"></i>
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