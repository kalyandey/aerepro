@extends('admin/layout')

@section('title', 'Order Details')

@section('content')
	    <div class="page-title-breadcrumb" id="title-breadcrumb-option-demo">
                <div class="page-header pull-left">
                    <div class="page-title">Order</div>
                </div>
                <ol class="breadcrumb page-breadcrumb pull-right">
                    <li>
                    <i class="fa fa-file-text"></i>&nbsp;
                    <a href="{{ URL::route('admin_city') }}">Order</a>&nbsp;&nbsp;<i class="fa fa-angle-right"></i>&nbsp;&nbsp;
                    </li>
                    <li>
                    <i class="fa fa-eye"></i>&nbsp;
                    <a href="javascript:void(0);">View </a>&nbsp;&nbsp;
                    </li>
                 
                </ol>
                <div class="clearfix"></div>
            </div>
	    <div class="page-content">
                <div class="row">
                    <div class="col-lg-12">
		    <div class="panel panel-yellow">
                            <div class="panel-heading">Order Details</div>
                            <div class="panel-body pan">                                    
                                   
                                    <div class="form-body pal order-details">
                                         <div class="form-group"><label class="col-md-3 control-label" for="inputName">ID</label>
                                             <div class="col-md-9">
                                                <div class="input-icon right">
                                                            {!! $details->order_id !!}
                                                </div>
                                            </div>
                                        </div>       
                                         <div class="form-group"><label class="col-md-3 control-label" for="inputName">Transaction Id</label>
                                             <div class="col-md-9">
                                                <div class="input-icon right">
                                                            {!! $details->transaction_id !!}
                                                </div>
                                            </div>
                                        </div>
					<div class="form-group"><label class="col-md-3 control-label" for="inputName">User/Company</label>
                                             <div class="col-md-9">
                                                <div class="input-icon right">
                                                            {!! $details->user->first_name.' '.$details->user->last_name !!}
                                                </div>
                                            </div>
                                        </div>
					<div class="form-group"><label class="col-md-3 control-label" for="inputName">Delivery Type</label>
                                             <div class="col-md-9">
                                                <div class="input-icon right">
                                                            @if($details->delivery_type == 'store_location')
									{{ 'Store Location Pickup' }}
							    @elseif($details->delivery_type == 'local_delivery')
									{{'Local Delivery'}}
							    @endif
                                                </div>
                                            </div>
                                        </div>
					<div class="form-group"><label class="col-md-3 control-label" for="inputName">Delivery Details</label>
                                             <div class="col-md-9">
                                                <div class="input-icon right">
                                                            @if($details->delivery_type == 'store_location')
									<b>Pickup Location:</b>{!! $details->pickup_location !!}
							    @elseif($details->delivery_type == 'local_delivery')
									<b>Address:</b>{!! ($details->address != '')?$details->address:'N/A'; !!} <br>
									<b>City:</b>{!! (count($details->city_name))?$details->city_name->city:'N/A'; !!} <br>
									<b>State:</b>{!! (count($details->state_name))?$details->state_name->state:'N/A' !!} <br>
									<b>Zip:</b>{!! ($details->zip != '')?$details->zip:'N/A'; !!} <br>
							    @endif
                                                </div>
                                            </div>
                                        </div>
					    
					<div class="form-group">	
					<table class="table table-striped table-bordered table-hover">
						<thead>
						<tr>
						    <th>Job#</th>
						    <th>Size/Download</th>
						    <th>QTY</th>
						    <th>Price</th>
						</tr>
						</thead>
						<tbody>
						@if(count($details->order) > 0 )
							@php $data = '' @endphp
							@foreach($details->order as $ord)
							    @php
							    $data[$ord->project_id][] = $ord;
							    @endphp
							@endforeach
						@if(count($data) > 0)
							    @foreach($data as $k=>$d)
								    @php $i = 0 @endphp	
								    <tr><td colspan="4">Documents for project {{$d[0]->project->project_id }}</td></tr>
								    @foreach($d as $c)
								    @php $i++ @endphp
								    <tr>
									<td>
										    <b>Job:</b>{{ $c->project->project_id .'-' .$c->project->project_name }}
										    <div><b>Document:</b> {{ ($i<10)?'0'.$i:$i }}  {{$c->plan->plan_name}}</div>
									</td>
									<td>
									@if($c->order_type == 'full_size')
									    Full Size
									@elseif($c->order_type == 'half_size')
									    Half Size
									@endif
									</td>
									<td>{!! $c->quantity !!}</td>
									<td class="cart-price">${!! number_format($c->quantity * $c->price,2) !!}</td>
								    </tr>
							    @endforeach
							    @endforeach
						@endif
				    		
						
						@else
						<tr>
							    <td colspan="4">----No record Found----</td>
						</tr>
						
						@endif
						
						</tbody>
				    
					</table>
					</div>
                                    <div class="form-actions pal">
                                        <div class="form-group mbn">
                                            <div class="col-md-12">
                                            {!! Html::linkRoute('private_admin_order_list', 'Back', array(), array('class' => 'btn btn-green')) !!}
                                            </div>
                                        </div>
                                    </div>
                                    
                            </div>
                        </div>
                     
                         </div>
                </div>
            </div>
		
@endsection