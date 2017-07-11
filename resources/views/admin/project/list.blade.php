@extends('admin/layout')

@section('title', 'Career list')

@section('content')
    <div class="page-title-breadcrumb" id="title-breadcrumb-option-demo">
                <div class="page-header pull-left">
                    <div class="page-title">Project List</div>
                </div>
                <ol class="breadcrumb page-breadcrumb pull-right">
                    <li>
                    <i class="fa fa-file-text-o"></i>&nbsp;
                    <a href="javascript:void(0);">Project</a>&nbsp;&nbsp;<i class="fa fa-angle-right"></i>&nbsp;&nbsp;
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
                                <div class="caption">Project List</div>
                                <div class="actions">
                                <a class="btn btn-sm btn-white" href="{{ URL::route('admin_project_create') }}"><i class="fa fa-plus"></i>&nbsp;
                                    New Project</a>&nbsp;</div>
                            </div>       
                            <div class="portlet-body">
                            <div class="row">
                                    {!! Form::open(array('route'=>'admin_project','method'=>'post','class'=>'form-validate','novalidate')) !!}
                
                                        <div class="col-lg-3">
                                                <div class="form-group">
                                                     <div class="input-icon right"><i class="fa fa-search"></i>
                                                         {!! Form::text('keyword',$keyword,array('class'=>"form-control","placeholder"=>"Enter The Keyword")) !!}
                                                     </div>
                                                </div>
                                        </div>
                                        <div class="col-lg-2">
                                                {!! Form::select('counties',$county,$counties,array('class'=>"form-control"))!!}
                                        </div>
                                        <div class="col-lg-2">
                                                {!! Form::select('categories',$category,$categories,array('class'=>"form-control"))!!}
                                        </div>         
                                        <div class="col-lg-2">
                                                {!! Form::select('types',$type,$types,array('class'=>"form-control"))!!}
                                        </div>       
                                        <div class="col-lg-3">
                                                <input type="submit" name="submit" value="Search" class="btn btn-danger" />
                                                <a href="{{ URL::route('admin_project') }}" class="btn btn-success" >View All</a>
                                        </div>
                                    {!! Form::close() !!}
                             </div> 
                                    <div id="flip-scroll">
                                    <table class="table table-hover table-striped table-bordered table-advanced tablesorter tb-sticky-header">
                                        <thead >
                                        <tr>
                                            <th width="5%">ID</th>
                                            <th width="20%">Project Name</th>
                                            <th width="10%">County</th>
                                            <th width="10%">Category</th>
                                            <th width="20%">Type</th>    
					    <th>Close Date</th>
                                            <th>Status</th>
                                            <th>Action</th>
                                           
                                        </tr>
                                        </thead>
                                        <tbody>
                                          @if($lists->count() > 0)
                                                @foreach($lists AS $r)
                                                <tr>
                                                        <td>{!! $r->project_id !!}</td> 
                                                        <td>{!! $r->project_name !!}</td>
                                                        <td>{!! $r->county_name !!}</td>
                                                        <td>{!! $r->category_name !!}</td>
                                                        <td>{!! $r->type_name !!}</td>
							@php $bid_close_date = explode('-',$r->bid_close_date); @endphp
                                                        <td>{!! $bid_close_date[1].'-'.$bid_close_date[2].'-'.$bid_close_date[0] !!}</td>   
                                                        <td>{{ $r->status }}</td>				
                                                        <td style="text-align:left">
                                                            <div class="btn-group">
                                                            <button type="button" class="btn btn-info"><i class="fa fa-gears"></i> Actions</button>
                                                            <button type="button" data-toggle="dropdown" class="btn btn-info dropdown-toggle">
                                                                <span class="caret"></span><span class="sr-only">Toggle Dropdown</span>
                                                            </button>
                                                            <ul role="menu" class="dropdown-menu">
                                                                <li><a href="{{ URL::route('admin_bidder_list',$r->id) }}">Bidder</a></li>        
                                                                <li><a href="{{ URL::route('admin_project_edit',$r->id) }}">Edit</a></li>
                                                                <li><a href="{{ URL::route('admin_project_details',$r->id) }}">View</a></li>
                                                                <li><a href="{{ URL::route('admin_project_delete',$r->id) }}" onclick="return confirm('Are you sure want to delete this record?')">Delete</a></li>
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