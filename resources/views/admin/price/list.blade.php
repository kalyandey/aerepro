@extends('admin/layout')

@section('title', 'Printing Price list')

@section('content')
    <div class="page-title-breadcrumb" id="title-breadcrumb-option-demo">
                <div class="page-header pull-left">
                    <div class="page-title">Printing Price</div>
                </div>
                <ol class="breadcrumb page-breadcrumb pull-right">
                    <li>
                    <i class="fa fa-file-text-o"></i>&nbsp;
                    <a href="javascript:void(0);">Printing Price</a>&nbsp;&nbsp;<i class="fa fa-angle-right"></i>&nbsp;&nbsp;
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
                        {!! Form::open(array('route'=>'admin_price','method'=>'post','class'=>'form-validate','novalidate')) !!}
                        <div class="col-lg-3">
                                <div class="form-group">
                                     <select name="price_range" class="form-control">
                                         <option selected="selected" value="">Select Price Range</option>
                                                @foreach($price_list as $option)
                                                <option value="{{$option->id}}" {{ Request::get('price_range') ? 'selected' : '' }}>{{$option->from_range}} In<sup>2</sup> - {{$option->to_range}} In<sup>2</sup></option>
                                                @endforeach
                                     </select>
                                </div>
                        </div>
                        
                        <div class="col-lg-3">
                                <input type="submit" name="submit" value="Search" class="btn btn-danger" />
                                <a href="{{ URL::route('admin_price') }}" class="btn btn-success" >View All</a>
                        </div>
                        {!! Form::close() !!}
                        </div>
                     <div class="portlet box portlet-yellow">
                            <div class="portlet-header">
                                <div class="caption">Printing Price</div>
                                <div class="actions"><a class="btn btn-sm btn-info" href="{{ URL::route('admin_price_create') }}"><i class="fa fa-edit"></i>&nbsp;
                                    Add New Price</a></div>
                            </div>
                            <div class="portlet-body">
                                 <div id="flip-scroll">
                                    <table class="table table-striped table-bordered table-hover">
                                        <thead >
                                        <tr>
                                            <th width="15%">From Range</th>
                                            <th width="15%">To Range</th>
                                            <th width="15%">Full</th>
                                            <th width="15%">Half</th>
                                            <th width="15%">Download</th>
					    <!--<th width="10%">Full Set</th>	-->
                                            <th class="numeric">Action</th>
                                           
                                        </tr>
                                        </thead>
                                        <tbody>
                                          @if($lists->count() > 0)
								@foreach($lists AS $r)
								<tr>
									<td>{!! $r->from_range !!} In<sup>2</sup></td>
                                                                        <td>{!! $r->to_range !!} In<sup>2</sup></td>
                                                                        <td>{!! $r->full_size_price !!}</td>
                                                                        <td>{!! $r->half_size_price !!}</td>
                                                                        <td>{!! $r->download_price !!}</td>
									<!--<td>{!! $r->full_set_price !!}</td>-->
                                                                        <td>
                                                                            <div class="btn-group">
                                                                            <button type="button" class="btn btn-info"><i class="fa fa-gears"></i> Actions</button>
                                                                            <button type="button" data-toggle="dropdown" class="btn btn-info dropdown-toggle">
                                                                                <span class="caret"></span><span class="sr-only">Toggle Dropdown</span>
                                                                            </button>
                                                                            <ul role="menu" class="dropdown-menu">
                                                                                <li><a href="{{ URL::route('admin_price_edit',$r->id) }}">Edit</a></li>

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