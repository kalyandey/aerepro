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
                            <div class="panel-heading">Order Details
							<a href="{{URL::route('admin_order_invoice',$details->id)}}"><button class="prntBtn">Print</button></a>
							</div>
                            <div class="panel-body pan">                                    
                                   
                                    <div class="form-body pal order-details">
									
									<div class="row">
									<div class="col-md-8">
                                         <div class="form-group">
					 <div class="row">
					     <label class="col-md-3 control-label" for="inputName">ID</label>
                                             <div class="col-md-6">
                                                <div class="input-icon right">
                                                            {!! $details->order_id !!}
                                                </div>
                                             </div>
						
					    
					    
                                           </div>  
						
                                        </div>       
                                         <div class="form-group">
					 <div class="row">
					 <label class="col-md-3 control-label" for="inputName">Transaction Id</label>
                                             <div class="col-md-6">
                                                <div class="input-icon right">
                                                            {!! $details->transaction_id !!}
                                                </div>
                                            </div>
						
					    <div class="col-md-3">
                                            </div>
                                        </div>
					</div>
				        <!--<div class="form-group"><label class="col-md-3 control-label" for="inputName">User</label>
                                             <div class="col-md-9">
                                                <div class="input-icon right">
                                                            {!! $details->user->first_name.' '.$details->user->last_name !!}
                                                </div>
                                            </div>
                                        </div>-->
					<div class="form-group">
					    <div class="row">
					     <label class="col-md-3 control-label" for="inputName">Delivery Type</label>
                                             <div class="col-md-6">
                                                <div class="input-icon right">
                                                            @if($details->delivery_type == 'store_location')
									{{ 'Store Location Pickup' }}
							    @elseif($details->delivery_type == 'local_delivery')
									{{'Local Delivery'}}
							    @endif
                                                </div>
                                            </div>
					   <!-- <div class="col-md-3">
                                                <div class="input-icon right">
                                                          {!! $details->user->first_name.' '.$details->user->last_name !!}
                                                </div>
                                            </div>-->
					    </div>
                                        </div>
					<div class="form-group"><div class="row"><label class="col-md-3 control-label" for="inputName">Delivery Details</label>
                                             <div class="col-md-6">
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
					</div>
									</div>
										<div class="col-md-4">
												
												<label class="cnctinf control-label" for="inputName">Customer Information</label>



                                                <div class="input-icon right">
                                                          <span> <b>{!! $details->user->business_name !!}</b><br></span>
							    <span> {!! $details->user->first_name.' '.$details->user->last_name !!}<br></span>
							    <span class="addicnrgt"> {!! $details->user->addess_line1.'<br>'.$details->user->addess_line2.' <br>'.$details->user->city.' ,'.$details->user->state_name->state.' ,'.$details->user->zip !!}<br></span>
							    <a href="tel:{{$details->user->phone}}"> {!! $details->user->phone !!}<br></a>
							    <span class="rgteml"> {!! $details->user->email !!}</span>
                                                </div>

												
										</div>
									</div>
					<div class="form-group">	
					<table class="table table-striped table-bordered table-hover tableCustom" id="sort-table">
						<thead>
						<tr>
						    <th>Job#</th>
						    <th>Size/Download</th>
						    <th>QTY</th>
						    <th>Price</th>
						</tr>
						</thead>
						
						@if(count($details->order) > 0 )
							@php $data = '' @endphp
							@foreach($details->order as $ord)
							    @php
							    $data[$ord->project_id][] = $ord;
							    @endphp
							@endforeach
						@if(count($data) > 0)
							    @foreach($data as $k=>$d)
								    @php $i = 0 ;
								    $j = 0;
								    @endphp
									<tbody data-id="{{ $k }}" class="orderProjectsTitle">
                                    <tr>
									<td colspan="">Documents for project : <b>{{$d[0]->project->name }}</b></td>
								    
								    <td colspan="3">
									@foreach($d as $c)
									    @if($c->order_type == 'full_set')
									      @php $j = $j+1; @endphp
									    @elseif($c->order_type == 'download')
										@php $j = $j+1; @endphp
									    @endif
									@endforeach
									@if($j > 0)
									<a href="{{Url::route('admin_download_zip',[$d[0]->order_master_id,$k])}}">Download</a>
									@endif
			      </td>
								    </tr>
										
									</tbody>
								    <tbody data-id="{{ $k }}" class="orderProjects">
								    @foreach($d as $c)
								    @php $i++ @endphp
								    <tr class="projectPlans" data-plan-name="{{(count($c->plan)>0)?$c->plan->plan_name:''}}">
									<td>
										    <!--<b>Job:</b>{{ $c->project->project_id .'-' .$c->project->name }}-->
										    <div><b>Document:</b>
											{{(count($c->plan)>0)?$c->plan->plan_name:'Full Set ('.count($d[0]->project->plan).'Pages)'}}
										    </div>
									</td>
									<td>
									 @if($c->order_type == 'full_size')
									    Full Size
									  @elseif($c->order_type == 'half_size')
									    Half Size
									  @elseif($c->order_type == 'full_set')
									    Full Set
									  @else
									      {{$c->order_type}}
									  @endif
									</td>
										    
									<td>{!! $c->quantity !!}</td>
									<td class="cart-price">${!! number_format($c->quantity * $c->price,2) !!}</td>
								    </tr>
									
								    
							    @endforeach
								</tbody>
							    @endforeach
						@endif
				    		
						
						@else
						<tr>
							    <td colspan="4">----No record Found----</td>
						</tr>
						
						@endif
						
						
				    
					</table>
                                            <br>
					    <span class="mbspc"><b class="hdlbl">Sub-Total:</b>  <b>${!! number_format($details->total_price,2) !!}</b></span>
					    <span class="mbspc"><b class="hdlbl">Tax({{$settingval}}%):</b> <b>@if($details->tax!='' && $details->tax!= 0)
					     ${!! number_format($details->tax,2) !!}
					    @else
						@php $details->tax= '0.00' @endphp
						${{ number_format($details->tax,2) }}
					    @endif
					    </b></span>
						<hr class="bdb">
					    <span class="mbspc"><b class="hdlbl">Total Amount:</b> ${{number_format($details->total_price + $details->tax,2)}}   <b></b></span>
					    <span class="mbspc"><b class="hdlbl">Payment Type:</b> @if($details->order_type == 'cc'){{'Credit Card'}}@elseif($details->order_type == 'cod'){{'Cash On Delivery'}}@elseif($details->order_type == 'my_account'){{'My Account'}}@endif</span>
						<div style="clear:both"></div><br/>
						@if($details->note !='')
							<strong>* Note : </strong>{{ $details->note }}
						@endif
					</div>
                                    <div class="form-actions pal rmvspc">
                                        <div class="form-group mbn ">
                                            <div class="col-md-12">
                                            {!! Html::linkRoute('admin_order_list', 'Back', array(), array('class' => 'btn btn-green')) !!}
                                            </div>
                                        </div>
                                    </div>
                                    
                            </div>
                        </div>
                     
                         </div>
                </div>
            </div>

<script>
$(function(){
 
 if($(".orderProjects").length > 0){
     $(".orderProjects").each(function(){
        var newPlansTxt = '';var plans = [];
        $(this).find('.projectPlans').each(function(i,element){
            plans.push( $(element).attr('data-plan-name') );
        });
        plans = plans.sort();
        $.each(plans,function(ind,ele){
           newPlansTxt += "<tr>";
           newPlansTxt += $(".projectPlans[data-plan-name="+ele+"]").html();
           newPlansTxt += "</tr>";
        });
        $(this).html(newPlansTxt);
        
    })
 }    
    
})
</script>
@endsection