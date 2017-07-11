<!DOCTYPE html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Order Invoice</title>
</head>
<body><table border="0"  cellspacing="0" cellpadding="0" width="100%" letter-spacing: 0.5px; ">
<tr><td border="0" colspan="4"><img src="{{ asset('images/new-logo.png') }}" style="width:230px; border:0;"></td></tr>
 <tr><td border="0" colspan="4" style="line-height:10px; height:10px;">&nbsp;</td></tr>
    <tr>
        <td border="0" style="background-color:#fff; width:70%;" colspan="3">
            <table border="0" cellspacing="0" cellpadding="0" style="background-color:#fff; letter-spacing: 0.5px;">
            <tr><td border="0"  style="line-height:10px; height:10px;">&nbsp;</td></tr>
                <tr>
                <td border="0" style="width:5px"></td>
                    <td border="0" style="font-family:arial, sans-serif; font-size:14px; line-height:14px; height:14px;"><b>ID:</b></td>
                    <td border="0" style="font-family:arial, sans-serif; font-size:14px; line-height:14px; height:14px;">{!! $order_master->order_id !!}</td>
                        <td border="0" style="width:5px"></td>
                </tr>
                <tr><td border="0" style="line-height:16px; height:16px;">&nbsp;</td></tr>
                <tr>
                <td border="0" style="width:5px"></td>
                    <td border="0" style="font-family:arial, sans-serif; font-size:14px; line-height:14px; height:14px;"><b>Transaction ID:</b></td>
                    <td border="0" style="font-family:arial, sans-serif; font-size:14px; line-height:14px; height:14px;">{!! $order_master->transaction_id !!}</td>
                        <td border="0" style="width:5px"></td>
                </tr>
                <tr><td border="0" style="line-height:16px; height:16px;">&nbsp;</td></tr>
                <tr>
                <td border="0" style="width:5px"></td>
                    <td border="0" style="font-family:arial, sans-serif; font-size:14px; line-height:14px; height:14px;"><b>Delivery Type:</b></td>
                    <td border="0" style="font-family:arial, sans-serif; font-size:14px; line-height:14px; height:14px;"> @if($order_master->delivery_type == 'store_location')
									{{ 'Store Location Pickup' }}
							    @elseif($order_master->delivery_type == 'local_delivery')
									{{'Local Delivery'}}
							    @endif
                                                            </td>
                        <td border="0" style="width:5px"></td>
                </tr>
                <tr><td border="0" style="line-height:16px; height:16px;">&nbsp;</td></tr>
                <tr>
                <td border="0" style="width:5px"></td>
                    <td border="0" style="font-family:arial, sans-serif; font-size:14px; line-height:14px; height:14px;"><b>Delivery Details:</b></td>
                    <td border="0" style="font-family:arial, sans-serif; font-size:14px; line-height:14px; height:14px;">@if($order_master->delivery_type == 'store_location')
									<b>Pickup Location:</b>{!! $order_master->pickup_location !!}
							    @elseif($order_master->delivery_type == 'local_delivery')
									<b>Address:</b>{!! ($order_master->address != '')?$order_master->address:'N/A'; !!} <br>
									<b>City:</b>{!! (count($order_master->city_name))?$order_master->city_name->city:'N/A'; !!} <br>
									<b>State:</b>{!! (count($order_master->state_name))?$order_master->state_name->state:'N/A' !!} <br>
									<b>Zip:</b>{!! ($order_master->zip != '')?$order_master->zip:'N/A'; !!} <br>
							    @endif</td>
                        <td border="0" style="width:5px"></td>
                </tr>
                <tr><td border="0" style="line-height:10px; height:10px;">&nbsp;</td></tr>
            </table>
        </td>
        <td border="0" style="background-color:#fff; width:10%;" >
             <table border="0" cellspacing="0" cellpadding="0"  style="background-color:#fff; letter-spacing: 0.5px;">
                <tr><td border="0" style="line-height:10px; height:10px;">&nbsp;</td></tr>
                <tr>
                <td border="0" style="width:5px"></td>
                    <td border="0" style="font-family:arial, sans-serif; font-size:15px; line-height:15px; height:15px;"><b>Contact Information</b></td>
                <td border="0" style="width:5px"></td>
                </tr>
                <tr><td border="0" style="line-height:10px; height:10px;">&nbsp;</td></tr>
                <tr>
                <td border="0" style="width:5px"></td>
                    <td border="0" style="font-family:arial, sans-serif; font-size:13px; line-height:13px; height:13px;"><b>{!! $order_master->user->business_name !!}</b></td>
                <td border="0" style="width:5px"></td>
                </tr>
                    <tr><td border="0" style="line-height:3px; height:3px;">&nbsp;</td></tr>
                <tr>
                <td border="0" style="width:5px"></td>
                    <td border="0" style="font-family:arial, sans-serif; font-size:13px; line-height:13px; height:13px;">{!! $order_master->user->first_name.' '.$order_master->user->last_name !!}</td>
                <td style="width:5px"></td>
                </tr>
                  <tr><td    style="line-height:5px; height:5px;">&nbsp;</td></tr>
                    <tr>
                <td style="width:5px"></td>
                    <td style="font-family:arial, sans-serif; font-size:13px; line-height:13px; height:13px;">
                  
                    {!! ($order_master->user->addess_line1 != '')?$order_master->user->addess_line1.',<br>':' ' !!}
                    
                    {!! ($order_master->user->addess_line2 != '')?$order_master->user->addess_line2.',':'' !!}
                    
                    </td>
                <td style="width:5px"></td>
                </tr>
					<tr><td    style="line-height:3px; height:3px;">&nbsp;</td></tr>
					<tr>
                <td style="width:5px"></td>
                    <td style="font-family:arial, sans-serif; font-size:13px; line-height:13px; height:13px;">
                    
                    {!! ($order_master->user->city != '')?$order_master->user->city.',':' ' !!}
                    {!! ($order_master->user->state_name->state != '' && $order_master->user->state > 0)?$order_master->user->state_name->state.',':' ' !!}
                    {!! ($order_master->user->city != '')?$order_master->user->city:' ' !!}
                    
                   </td>
                <td style="width:5px"></td>
                </tr>
                    <tr><td style="line-height:12px; height:12px;">&nbsp;</td></tr>
                <tr>
                <td style="width:5px"></td>
                    <td style="font-family:arial, sans-serif; font-size:13px; line-height:13px; height:13px; color:#cf0f31;">{!! $order_master->user->phone !!}</td>
                <td style="width:5px"></td>
                </tr>
                    <tr><td    style="line-height:5px; height:5px;">&nbsp;</td></tr>
                        <tr>
                <td style="width:5px"></td>
                    <td style="font-family:arial, sans-serif; font-size:13px; line-height:13px; height:13px;">{!! $order_master->user->email !!}</td>
                <td style="width:5px"></td>
                </tr>
                    <tr><td    style="line-height:10px; height:10px;">&nbsp;</td></tr>
             </table>
        </td>
    </tr>
        <tr>
            <td style="background-color:#f5f5f5; width:100%;" colspan="4">
                		<table border="0" cellspacing="0" cellpadding="0"  style="background-color:#f5f5f5; letter-spacing: 0.5px; width:100%; text-align:center;">
						<thead style="background-color:#D3CDCD;">
                        <tr><th style="line-height:5px;background-color:#D3CDCD; height:5px;" colspan="5">&nbsp;</th></tr>
						<tr>
						
                           
						    <th style="font-family:arial, sans-serif; font-size:15px; line-height:15px; height:15px; color:#000; border:0; outline:0; text-align:left;background-color:#D3CDCD; border-top:2px solid #D3CDCD; border-bottom:2px solid #D3CDCD; border-right:2px solid #D3CDCD; padding-left:5px;">Project #</th>
						    <th style="font-family:arial, sans-serif; font-size:15px; line-height:15px; height:15px; color:#000; text-align:center;background-color:#D3CDCD; border-top:2px solid #D3CDCD; border-bottom:2px solid #D3CDCD; border-right:2px solid #D3CDCD;">Size/Download</th>
						    <th style="font-family:arial, sans-serif; font-size:15px; line-height:15px; height:15px; color:#000; text-align:center;background-color:#D3CDCD; border-top:2px solid #D3CDCD; border-bottom:2px solid #D3CDCD; border-right:2px solid #D3CDCD;">QTY</th>
						    <th style="font-family:arial, sans-serif; font-size:15px; line-height:15px; height:15px; color:#000; text-align:center;background-color:#D3CDCD; border-top:2px solid #D3CDCD; border-bottom:2px solid #D3CDCD;">Price</th>
                          
						</tr>
                            <tr><th style="line-height:5px;background-color:#D3CDCD; height:5px;" colspan="5">&nbsp;</th></tr>
						</thead>
                        <tbody style="background:#fff;">
                        
                        
                        @if(count($order_master->order) > 0 )
                                @php $data = '' @endphp
                                @foreach($order_master->order as $ord)
                                    @php
                                    $data[$ord->project_id][] = $ord;
                                    @endphp
                                @endforeach
		        @if(count($data) > 0)
                            @foreach($data as $k=>$d)
                                    @php $i = 0 ;
                                    @endphp
                        
                        
                        
                        
                        <tr><th style="line-height:15px;background-color:#fff; height:15px;" colspan="5">&nbsp;</th></tr>
                             <tr>    
                                <td style="font-family:arial, sans-serif; font-size:14px; line-height:14px; height:14px; color:#d41a1a;background:#fff;" colspan="5"><b>Documents for project {{$d[0]->project->project_id }}</b></td>
                            </tr>
                                 @foreach($d as $c)
				@php $i++ @endphp
                                <tr><th style="line-height:10px;background-color:#fff; height:10px;" colspan="5">&nbsp;</th></tr>
                                <tr><th style="line-height:10px; height:10px;" colspan="5">&nbsp;</th></tr>
                                <tr>
                           
						    <td style="font-family:arial, sans-serif; font-size:14px; line-height:15px; height:15px; text-align:left;">{{ (count($c->plan) > 0 )?$c->plan->plan_name : 'Full Set ('.count($d[0]->project->plan).'Pages)' }}</td>
						    <td style="font-family:arial, sans-serif; font-size:14px; line-height:15px; height:15px;text-align:center;"> @if($c->order_type == 'full_size')
									    Full Size
									  @elseif($c->order_type == 'half_size')
									    Half Size
									  @elseif($c->order_type == 'full_set')
									    Full Set
									  @else
									      {{$c->order_type}}
									  @endif</td>
						    <td style="font-family:arial, sans-serif; font-size:14px; line-height:15px; height:15px; text-align:center;">{!! $c->quantity !!}</td>
						    <td style="font-family:arial, sans-serif; font-size:14px; line-height:15px; height:15px; text-align:center;">${!! number_format($c->quantity * $c->price,2) !!}</td>
                           
						</tr>
                           
							    @endforeach
							    @endforeach
						@endif
				    		
						
                                                @else
                                                <tr>
						    <td colspan="4" style="width:100%;">----No record Found----</td>
						</tr>
						@endif                                      
                           
                        </tbody>
		</table>
            </td>
        </tr>
            <tr>
                <td style="line-height:30px;background-color:#fff; height:30px;" colspan="5"></td>
            </tr>
                
                 <tr>
                 <td colspan="2" valign="bottom">
					@if($order_master->note !='')
					   <strong>* Note : </strong>{{ $order_master->note }}
					@endif
				 </td>
                 <td colspan="3">
                    <table  border="0" cellspacing="0" cellpadding="0" style="letter-spacing: 0.5px; background:#9f9f9f; width:100%;">
                    
              
                <tr>
                <td style="width:5px; background:#000;"></td>
                    <td style="font-family:arial, sans-serif; font-size:14px;  background:#8F8F8F; padding: 8px; line-height:14px; height:14px; text-align:left; color:#fff; border-bottom:1px solid #fff;"><b>Sub Total:</b></td>
                    <td style="font-family:arial, sans-serif; font-size:14px;background:#C6C6C6; padding: 8px; line-height:14px; height:14px; text-align:left; border-bottom:1px solid #fff;">${!! $order_master->total_price !!}</td>
                        <td style="width:5px"></td>
                </tr>
                
                <tr>
                <td style="width:5px;background:#000;"></td>
                    <td style="font-family:arial, sans-serif; font-size:14px;  background:#8F8F8F; padding: 8px; line-height:14px; height:14px; text-align:left; color:#fff; border-bottom:1px solid #fff;"><b>Tax</b>({{$setting_tax}}%):</td>
                    <td style="font-family:arial, sans-serif; font-size:14px;background:#C6C6C6; padding: 8px; line-height:14px; height:14px; text-align:left; border-bottom:1px solid #fff;">@if($order_master->tax!='' && $order_master->tax!= 0)
					     ${!! $order_master->tax !!}
					     @else
						@php $order_master->tax= '0.00' @endphp
						${{ $order_master->tax }}
					    @endif
                                            </td>
                        <td style="width:5px"></td>
                </tr>
                
                <tr>
                <td style="width:5px;background:#000;"></td>
                    <td style="font-family:arial, sans-serif; font-size:14px;  background:#8F8F8F; padding: 8px; line-height:14px; height:14px; text-align:left; color:#fff; border-bottom:1px solid #fff;"><b>Total amount</b></td>
                    <td style="font-family:arial, sans-serif; font-size:14px;background:#C6C6C6; padding: 8px; line-height:14px; height:14px; text-align:left; border-bottom:1px solid #fff;">${{number_format($order_master->total_price + $order_master->tax,2)}}</td>
                        <td style="width:5px"></td>
                </tr>
                
                <tr>
                <td style="width:5px;background:#000;"></td>
                    <td style="font-family:arial, sans-serif; font-size:14px;  background:#8F8F8F; padding: 8px; line-height:14px; height:14px; text-align:left; color:#fff; border-bottom:1px solid #fff;"><b>Payment Type:</b></td>
                    <td style="font-family:arial, sans-serif; font-size:14px;background:#C6C6C6; padding: 8px; line-height:14px; height:14px; text-align:left; border-bottom:1px solid #fff;">@if($order_master->order_type == 'cc')
                    {{'Credit Card'}}@elseif($order_master->order_type == 'cod')
                    {{'Cash On Delivery'}}@elseif($order_master->order_type == 'my_account'){{'My Account'}}@endif</td>
                        <td style="width:5px"></td>
                </tr>
                
                    </tr>
                    </table>
                 </td>
            </table>
        </td>
            </tr>
                
                
</table></body>