<table border="0"  cellspacing="0" cellpadding="0" width="100%" letter-spacing: 0.5px; ">
<tr><td border="0" colspan="6" style="line-height:10px; height:10px;background-color:#10367f; border-top:2px solid #10367f; border-bottom:2px solid #10367f;">&nbsp;</td></tr>
<tr><td border="0" colspan="6" align="center" style="background-color:#10367f; border-top:2px solid #10367f; border-bottom:2px solid #10367f;"><img src="{{asset('images/logo.png')}}" style="width:230px; border:0;"></td></tr>
 <tr><td border="0" colspan="6" style="line-height:10px; height:10px;background-color:#10367f; border-top:2px solid #10367f; border-bottom:2px solid #10367f;">&nbsp;</td></tr>
    <tr>
        <td border="0" style="background-color:#fff; width:70%;" colspan="4">
            <table border="0" cellspacing="0" cellpadding="0" style="background-color:#fff; letter-spacing: 0.5px;">
            <tr><td border="0"  style="line-height:10px; height:10px;">&nbsp;</td></tr>
                <tr>
                <td border="0" style="width:5px"></td>
                    <td border="0" style="font-family:arial, sans-serif; font-size:14px; line-height:14px; height:14px;"><b>ID:</b></td>
                    <td border="0" style="font-family:arial, sans-serif; font-size:14px; line-height:14px; height:14px;">{{$order_master->order_id}}</td>
                        <td border="0" style="width:5px"></td>
                </tr>
                <tr><td border="0" style="line-height:10px; height:10px;">&nbsp;</td></tr>
                <tr>
                <td border="0" style="width:5px"></td>
                    <td border="0" style="font-family:arial, sans-serif; font-size:14px; line-height:14px; height:14px;"><b>Transaction ID:</b></td>
                    <td border="0" style="font-family:arial, sans-serif; font-size:14px; line-height:14px; height:14px;">{{($order_master->transaction_id != '')?$order_master->transaction_id:'N/A'}}</td>
                        <td border="0" style="width:5px"></td>
                </tr>
                <tr><td border="0" style="line-height:10px; height:10px;">&nbsp;</td></tr>
                <tr>
                <td border="0" style="width:5px"></td>
                    <td border="0" style="font-family:arial, sans-serif; font-size:14px; line-height:14px; height:14px;"><b>Delivery Type:</b></td>
                    <td border="0" style="font-family:arial, sans-serif; font-size:14px; line-height:14px; height:14px;">
                        @if($order_master->delivery_type == 'store_location')
                            Store Location
                        @elseif($order_master->delivery_type == 'local_delivery')
                            Local Delivery
                        @else
                            N/A
                        @endif
                    </td>
                        <td border="0" style="width:5px"></td>
                </tr>
                <tr><td border="0" style="line-height:10px; height:10px;">&nbsp;</td></tr>
                <tr>
                <td border="0" style="width:5px"></td>
                    <td border="0" style="font-family:arial, sans-serif; font-size:14px; line-height:14px; height:14px;"><b>Delivery Details:</b></td>
                    <td border="0" style="font-family:arial, sans-serif; font-size:14px; line-height:14px; height:14px;">
                        @if($order_master->delivery_type == 'store_location')
                            {{$order_master->pickup_location}}
                        @elseif($order_master->delivery_type == 'local_delivery')
                            {{$order_master->address}}
                             <br>
                            @if($order_master->city != '')
                            {{ $order_master->city.',' }}
                            @endif
                            @if(count($order_master->state_name) > 0)
                            {{ $order_master->state_name->state.',' }}
                            @endif
                            @if($order_master->zip != '')
                            {{ $order_master->zip.',' }}
                            @endif
                        @else
                            N/A
                        @endif
                        </td>
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
                    <td border="0" style="font-family:arial, sans-serif; font-size:13px; line-height:13px; height:13px;"><b>A&E Reprographics</b></td>
                <td border="0" style="width:5px"></td>
                </tr>
                    <tr><td border="0" style="line-height:3px; height:3px;">&nbsp;</td></tr>
                <tr>
                <td border="0" style="width:5px"></td>
                    <td border="0" style="font-family:arial, sans-serif; font-size:13px; line-height:13px; height:13px;">{{$user->first_name .' '.$user->last_name }}</td>
                <td style="width:5px"></td>
                </tr>
                  <tr><td style="line-height:5px; height:5px;">&nbsp;</td></tr>
                    <tr>
                <td style="width:5px"></td>
                    <td style="font-family:arial, sans-serif; font-size:13px; line-height:13px; height:13px;">
                    {{$user->addess_line1}}
                        @if($user->addess_line2 != '')
                        {{','.$user->addess_line2}}
                    @endif
                    </td>
                <td style="width:5px"></td>
                </tr>
                <tr><td    style="line-height:3px; height:3px;">&nbsp;</td></tr>
                <tr>
                <td style="width:5px"></td>
                    <td style="font-family:arial, sans-serif; font-size:13px; line-height:13px; height:13px;">
                @if($user->city != '')
                {{ $user->city.',' }}
                @endif
                @if(count($user->state_name) > 0)
                {{ $user->state_name->state.',' }}
                @endif
                @if($user->zip != '')
                {{ $user->zip.',' }}
                @endif
                </td>
                <td style="width:5px"></td>
                </tr>
                    <tr><td style="line-height:12px; height:12px;">&nbsp;</td></tr>
                <tr>
                <td style="width:5px"></td>
                    <td style="font-family:arial, sans-serif; font-size:13px; line-height:13px; height:13px; color:#cf0f31;">{{$user->phone}}</td>
                <td style="width:5px"></td>
                </tr>
                    <tr><td style="line-height:5px; height:5px;">&nbsp;</td></tr>
                        <tr>
                <td style="width:5px"></td>
                    <td style="font-family:arial, sans-serif; font-size:13px; line-height:13px; height:13px;">{{$user->email}} </td>
                <td style="width:5px"></td>
                </tr>
                    <tr><td    style="line-height:10px; height:10px;">&nbsp;</td></tr>
             </table>
        </td>
    </tr>
        <tr>
            <td style="background-color:#f5f5f5; width:100%;" colspan="6">
                <table border="0" cellspacing="0" cellpadding="0"  style="background-color:#f5f5f5; letter-spacing: 0.5px; width:100%; text-align:center;">
                    <thead style="background-color:#10367f;">
                    <tr><th style="line-height:5px;background-color:#10367f; height:5px;" colspan="6">&nbsp;</th></tr>
                    <tr>

                        <th style="font-family:arial, sans-serif; font-size:15px; line-height:15px; height:15px; color:#fff; border:0; outline:0; text-align:center;background-color:#10367f; border-top:2px solid #10367f; border-bottom:2px solid #10367f; border-right:2px solid #10367f; padding-left:5px;">Job#</th>
    <th style="font-family:arial, sans-serif; font-size:15px; line-height:15px; height:15px; color:#fff; border:0; outline:0; text-align:center;background-color:#10367f; border-top:2px solid #10367f; border-bottom:2px solid #10367f; border-right:2px solid #10367f; padding-left:5px;">Document</th>
                        <th style="font-family:arial, sans-serif; font-size:15px; line-height:15px; height:15px; color:#fff; text-align:center;background-color:#10367f; border-top:2px solid #10367f; border-bottom:2px solid #10367f; border-right:2px solid #10367f;">Size/Download</th>
                        <th style="font-family:arial, sans-serif; font-size:15px; line-height:15px; height:15px; color:#fff; text-align:center;background-color:#10367f; border-top:2px solid #10367f; border-bottom:2px solid #10367f; border-right:2px solid #10367f;">Shipping</th>
     <th style="font-family:arial, sans-serif; font-size:15px; line-height:15px; height:15px; color:#fff; text-align:center;background-color:#10367f; border-top:2px solid #10367f; border-bottom:2px solid #10367f; border-right:2px solid #10367f;">QTY</th>
                        <th style="font-family:arial, sans-serif; font-size:15px; line-height:15px; height:15px; color:#fff; text-align:center;background-color:#10367f; border-top:2px solid #10367f; border-bottom:2px solid #10367f;">Price</th>

                    </tr>
<tr><th style="line-height:5px;background-color:#10367f; height:5px;" colspan="6">&nbsp;</th></tr>
                    </thead>
                    <tbody style="background:#fff;">
                    
                    @if(count($cart_item) > 0)
                    @php $data = '' @endphp
                    @foreach($cart_item as $cart)
                        @php
                        $data[$cart->options->project_id][] = $cart;
                        @endphp
                    @endforeach
                
                
                    @if(count($data) > 0)
                        
                        @foreach($data as $k=>$d)
                            @php $i = 0 @endphp
                            @foreach($d as $c)
                            @php $i++ @endphp
            
                        <tr>
                                <td style="font-family:arial, sans-serif; font-size:14px; line-height:15px; height:15px; text-align:center; background-color:#eee; border-right:1px solid #ccc; border-bottom:1px solid #ccc; border-left:1px solid #ccc; padding:6px 8px;">{{ $k }}</td>
                                <td style="font-family:arial, sans-serif; font-size:14px; line-height:15px; height:15px;text-align:left; background-color:#eee;border-right:1px solid #ccc; border-bottom:1px solid #ccc; padding:6px 8px;"> {{ ($i<10)?'0'.$i:$i }} {{$c->name}} </td>
                                <td style="font-family:arial, sans-serif; font-size:14px; line-height:15px; height:15px; text-align:center; background-color:#eee;border-right:1px solid #ccc; border-bottom:1px solid #ccc; padding:6px 8px;">
                                @if($c->options->papersize == 'full_size')
                                    {{'Full Size'}}
                                @elseif($c->options->papersize == 'half_size')
                                    {{'Half size'}}
                                @elseif($c->options->papersize == 'full_set')
                                    {{'Full Set'}}
                                @else
                                    {{$c->options->papersize}}
                                @endif
                                </td>
                                <td style="font-family:arial, sans-serif; font-size:14px; line-height:15px; height:15px; text-align:left; background-color:#eee;border-right:1px solid #ccc; border-bottom:1px solid #ccc; padding:6px 8px;">
                                
                                @if($delivery_type == 'store_location')
                                    Store Location Pickup
                                    <br><b>Pickup Location : </b>{{$pickup_location}}
                                @elseif($delivery_type == 'local_delivery')
                                    Local Delivery
                                    <br><b>Address : </b>{{$address}}
                                    <b>City : </b>{{$city}}<br>
                                    <b>States : </b>{{$states}}<br>
                                    <b>Zip : </b>{{$zip}}
                                @else
                                    N/A
                                @endif
                                </td>
            <td style="font-family:arial, sans-serif; font-size:14px; line-height:15px; height:15px; text-align:center; background-color:#eee;border-right:1px solid #ccc; border-bottom:1px solid #ccc; padding:6px 8px;">{!! $c->qty !!}</td>
                                <td style="font-family:arial, sans-serif; font-size:14px; line-height:15px; height:15px; text-align:center; background-color:#eee;border-right:1px solid #ccc; border-bottom:1px solid #ccc; padding:6px 8px;">${!! number_format(($c->qty * $c->price),2) !!}</td>
                       
                        </tr>
                        @endforeach
                            @endforeach
                            @endif
                    @else
                        <tr><td style="border-left:1px solid #ccc; padding:8px 10px; color:#333; margin:0; border-bottom:1px solid #ccc;" colspan="7">No record found</td></tr>
                    @endif
                    </tbody>
                </table>
            </td>
        </tr>
            <tr>
                <td style="line-height:30px;background-color:#fff; height:30px;" colspan="5"></td>
            </tr>
                
                 <tr>
                 <td colspan="3">
                <table  border="0" cellspacing="0" cellpadding="0" style="letter-spacing: 0.5px; background:#9f9f9f; width:100%;">
                @if($order_master->tax != '')
                <tr>
                
                    <td style="font-family:arial, sans-serif; font-size:14px;  background:#000; padding: 8px; line-height:14.6px; height:14.6px; text-align:left; color:#fff; border-bottom:1px solid #fff;"><b></b></td>
                    <td style="font-family:arial, sans-serif; font-size:14px;background:#000; padding: 8px; line-height:14px; height:14px; text-align:left; color:#fff; border-bottom:1px solid #fff;"></td>
                       
                </tr>
                
                <tr>
                
                    <td style="font-family:arial, sans-serif; font-size:14px;  background:#000; padding: 8px; line-height:14px; height:14px; text-align:left; color:#fff; border-bottom:1px solid #fff;"><b></b></td>
                    <td style="font-family:arial, sans-serif; font-size:14px;background:#000; padding: 8px; line-height:14px; height:14px; text-align:left; color:#fff; border-bottom:1px solid #fff;"></td>
                      
                </tr>
                @endif
                <tr>
                
                    <td style="font-family:arial, sans-serif; font-size:14px;  background:#000; padding: 8px; line-height:14px; height:14px; text-align:left; color:#fff; border-bottom:1px solid #fff;"><b></b></td>
                    <td style="font-family:arial, sans-serif; font-size:14px;background:#000; padding: 8px; line-height:14px; height:14px; text-align:left; color:#fff; border-bottom:1px solid #fff;"></td>
                      
                </tr>
                
                <tr>
                
                    <td style="font-family:arial, sans-serif; font-size:14px;  background:#000; padding: 8px; line-height:14px; height:14px; text-align:left; color:#fff; border-bottom:1px solid #fff;"><b></b></td>
                    <td style="font-family:arial, sans-serif; font-size:14px;background:#000; padding: 8px; line-height:14.5px; height:14.5px; text-align:left; color:#fff; border-bottom:1px solid #fff;"></td>
                        
                </tr>
                
                  
                    </table>
                 </td>
                 <td colspan="3">
                <table  border="0" cellspacing="0" cellpadding="0" style="letter-spacing: 0.5px; background:#9f9f9f; width:100%;">
                    
                @if($order_master->tax != '')
                <tr>
                
                    <td style="font-family:arial, sans-serif; font-size:14px;  background:#000; padding: 8px; line-height:14px; height:14px; text-align:left; color:#fff; border-bottom:1px solid #fff;"><b>Sub Total:</b></td>
                    <td style="font-family:arial, sans-serif; font-size:14px;background:#333; padding: 8px; line-height:14px; height:14px; text-align:left; color:#fff; border-bottom:1px solid #fff;">{{$order_master->total_price}}</td>
                       
                </tr>
                
                <tr>
                
                    <td style="font-family:arial, sans-serif; font-size:14px;  background:#000; padding: 8px; line-height:14px; height:14px; text-align:left; color:#fff; border-bottom:1px solid #fff;"><b>Tax({{$setting_tax}}) </b></td>
                    <td style="font-family:arial, sans-serif; font-size:14px;background:#333; padding: 8px; line-height:14px; height:14px; text-align:left; color:#fff; border-bottom:1px solid #fff;">{{$order_master->tax}}</td>
                       
                </tr>
                
                <tr>
                
                    <td style="font-family:arial, sans-serif; font-size:14px;  background:#000; padding: 8px; line-height:14px; height:14px; text-align:left; color:#fff; border-bottom:1px solid #fff;"><b>Total amount</b></td>
                    <td style="font-family:arial, sans-serif; font-size:14px;background:#333; padding: 8px; line-height:14px; height:14px; text-align:left; color:#fff; border-bottom:1px solid #fff;">{{$order_master->total_price + $order_master->tax}}</td>
                      
                </tr>
                @else
                    <tr>
                        
                        <td style="font-family:arial, sans-serif; font-size:14px;  background:#000; padding: 8px; line-height:14px; height:14px; text-align:left; color:#fff; border-bottom:1px solid #fff;"><b>Total amount</b></td>
                        <td style="font-family:arial, sans-serif; font-size:14px;background:#333; padding: 8px; line-height:14px; height:14px; text-align:left; color:#fff; border-bottom:1px solid #fff;">{{$order_master->total_price}}</td>
                       
                    </tr>
                @endif
                <tr>
                
                    <td style="font-family:arial, sans-serif; font-size:14px;  background:#000; padding: 8px; line-height:14px; height:14px; text-align:left; color:#fff; border-bottom:1px solid #fff;"><b>Payment Type:</b></td>
                    <td style="font-family:arial, sans-serif; font-size:14px;background:#333; padding: 8px; line-height:14px; height:14px; text-align:left; color:#fff; border-bottom:1px solid #fff;">
                    @if($order_master->order_type == 'cod')
                        Cash on delivery
                    @elseif($order_master->order_type == 'cc')
                        Credit Card
                    @elseif($order_master->order_type == 'my_account')
                        My Account
                    @endif
                    </td>
                       
                </tr>
                
                    </tr>
                    </table>
                 </td>
            </table>
        </td>
            </tr>
</table>