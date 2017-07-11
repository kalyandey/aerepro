@extends('admin/layout')

@section('title', 'Career list')

@section('content')
    <div class="page-title-breadcrumb" id="title-breadcrumb-option-demo">
                <div class="page-header pull-left">
                    <div class="page-title">Private Company List</div>
                </div>
                <ol class="breadcrumb page-breadcrumb pull-right">
                    <li>
                    <i class="fa fa-file-text-o"></i>&nbsp;
                    <a href="javascript:void(0);">Company</a>&nbsp;&nbsp;<i class="fa fa-angle-right"></i>&nbsp;&nbsp;
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
                                <div class="caption">Private Company</div>
                            </div>       
                            <div class="portlet-body">
                            <div class="row">
                                    {!! Form::open(array('route'=>'admin_private_company_list','method'=>'post','class'=>'form-validate','novalidate')) !!}
                
                                        <div class="col-lg-3">
                                                <div class="form-group">
                                                     <div class="input-icon right"><i class="fa fa-search"></i>
                                                         {!! Form::text('keyword',$keyword,array('class'=>"form-control","placeholder"=>"Enter The Keyword")) !!}
                                                     </div>
                                                </div>
                                        </div>
                                        <div class="col-lg-3">
                                                <input type="submit" name="submit" value="Search" class="btn btn-danger" />
                                                <a href="{{ URL::route('admin_private_company_list') }}" class="btn btn-success" >View All</a>
                                        </div>
                                    {!! Form::close() !!}
                             </div> 
                                    <div id="flip-scroll">
                                    <table class="table table-hover table-striped table-bordered table-advanced tablesorter tb-sticky-header">
                                        <thead >
                                        <tr>
                                            <th>Logo</th>
                                            <th>Company Name</th>
                                            <th>User Name</th>   
					    <th>Email</th>
					    <th>Domain</th>	
                                            <th>Status</th>
                                            <th width="15%">Action</th>
                                           
                                        </tr>
                                        </thead>
                                        <tbody>
                                          @if($lists->count() > 0)
                                                @foreach($lists AS $r)
                                                <tr>
                                                        <td>
							@if($r->logo != '' && file_exists(public_path('uploads/private_planroom/company_logo/thumb/'.$r->logo)))
                                                        {{ Html::image(asset('uploads/private_planroom/company_logo/thumb/'.$r->logo)) }}
							@endif
						        </td>
                                                        <td>{!! $r->company_name !!}</td>
							<td>{!! $r->first_name .' '. $r->last_name !!}</td>    
                                                        <td>{!! $r->email !!}</td>
							<td><a href="{{$r->domain}}" target="_blank">{!! $r->domain !!}</a></td>    
                                                        <td>{{ $r->status }}</td>				
                                                        <td style="text-align:left" >
                                                            <div class="btn-group">
                                                            <button type="button" class="btn btn-info"><i class="fa fa-gears"></i> Actions</button>
                                                            <button type="button" data-toggle="dropdown" class="btn btn-info dropdown-toggle">
                                                            <span class="caret"></span><span class="sr-only">Toggle Dropdown</span>
                                                            </button>
                                                            <ul role="menu" class="dropdown-menu">
                                                                <li><a href="{{ URL::route('admin_privatecompany_edit',$r->id) }}">Edit</a></li>
                                                                <li><a href="{{ URL::route('admin_private_company_delete',$r->id) }}" onclick="return confirm('Are you sure want to delete this record?')">Delete</a></li>
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