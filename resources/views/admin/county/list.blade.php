@extends('admin/layout')

@section('title', 'County list')

@section('content')
    <div class="page-title-breadcrumb" id="title-breadcrumb-option-demo">
                <div class="page-header pull-left">
                    <div class="page-title">County</div>
                </div>
                <ol class="breadcrumb page-breadcrumb pull-right">
                    <li>
                    <i class="fa fa-file-text-o"></i>&nbsp;
                    <a href="javascript:void(0);">County</a>&nbsp;&nbsp;<i class="fa fa-angle-right"></i>&nbsp;&nbsp;
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
                        {!! Form::open(array('route'=>'admin_county','method'=>'post','class'=>'form-validate','novalidate')) !!}

                        <div class="col-lg-3">
                                <div class="form-group">
                                     <div class="input-icon right"><i class="fa fa-search"></i>
                                         {!! Form::text('keyword',$keyword,array('class'=>"form-control","placeholder"=>"Enter The Keyword")) !!}
                                     </div>
                                </div>
                        </div>
                        <div class="col-lg-2">
                            {!! Form::select('state_code',$state,$state_code,array('class'=>"form-control"))!!}
                        </div>

                        <div class="col-lg-3">
                                <input type="submit" name="submit" value="Search" class="btn btn-danger" />
                                <a href="{{ URL::route('admin_county') }}" class="btn btn-success" >View All</a>
                        </div>
                        {!! Form::close() !!}
                        </div>
                     <div class="portlet box portlet-yellow">
                            <div class="portlet-header">
                                <div class="caption">County List</div>
                                <div class="actions"><a class="btn btn-sm btn-info" href="{{ URL::route('admin_county_create') }}"><i class="fa fa-edit"></i>&nbsp;
                                    Add New County</a></div>
                            </div>
                            <div class="portlet-body">
                                 <div id="flip-scroll">
                                    <table class="table table-striped table-bordered table-hover">
                                        <thead >
                                        <tr>
                                            
                                            <th width="40%">County</th>
				            <th width="40%">State</th>
                                            <th class="numeric">Action</th>
                                           
                                        </tr>
                                        </thead>
                                        <tbody>
                                          @if($lists->count() > 0)
								@foreach($lists AS $r)
								<tr>
								        <td>{{$r->name}}</td>
									<td>{{$r->state}}</td>
									
									<td>
										    <div class="btn-group">
										    <button type="button" class="btn btn-info"><i class="fa fa-gears"></i> Actions</button>
										    <button type="button" data-toggle="dropdown" class="btn btn-info dropdown-toggle">
											<span class="caret"></span><span class="sr-only">Toggle Dropdown</span>
										    </button>
										    <ul role="menu" class="dropdown-menu">
											<li><a href="{{ URL::route('admin_county_edit',$r->id) }}">Edit</a></li>
																    
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