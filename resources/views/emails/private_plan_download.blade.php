<table border="0"  cellspacing="0" cellpadding="0" width="100%" letter-spacing: 0.5px; ">
<tr><td border="0" colspan="6" style="line-height:10px; height:10px;background-color:#10367f; border-top:2px solid #10367f; border-bottom:2px solid #10367f;">&nbsp;</td></tr>
<tr><td border="0" colspan="6" align="center" style="background-color:#10367f; border-top:2px solid #10367f; border-bottom:2px solid #10367f;"><img src="{{asset('images/logo.png')}}" style="width:230px; border:0;"></td></tr>
 <tr><td border="0" colspan="6" style="line-height:10px; height:10px;background-color:#10367f; border-top:2px solid #10367f; border-bottom:2px solid #10367f;">&nbsp;</td></tr>
        <tr>
            <td style="background-color:#f5f5f5; width:100%;" colspan="6">
                <table border="0" cellspacing="0" cellpadding="0"  style="background-color:#f5f5f5; letter-spacing: 0.5px; width:100%; text-align:center;">
                    <thead style="background-color:#10367f;">
                    <tr><th style="line-height:5px;background-color:#10367f; height:5px;" colspan="7">&nbsp;</th></tr>
                    <tr>

                        <th style="font-family:arial, sans-serif; font-size:15px; line-height:15px; height:15px; color:#fff; border:0; outline:0; text-align:center;background-color:#10367f; border-top:2px solid #10367f; border-bottom:2px solid #10367f; border-right:2px solid #10367f; padding-left:5px;">Job#</th>
    <th style="font-family:arial, sans-serif; font-size:15px; line-height:15px; height:15px; color:#fff; border:0; outline:0; text-align:center;background-color:#10367f; border-top:2px solid #10367f; border-bottom:2px solid #10367f; border-right:2px solid #10367f; padding-left:5px;">Document</th>
                        <th style="font-family:arial, sans-serif; font-size:15px; line-height:15px; height:15px; color:#fff; text-align:center;background-color:#10367f; border-top:2px solid #10367f; border-bottom:2px solid #10367f; border-right:2px solid #10367f;">Size/Download</th>
                        <th style="font-family:arial, sans-serif; font-size:15px; line-height:15px; height:15px; color:#fff; text-align:center;background-color:#10367f; border-top:2px solid #10367f; border-bottom:2px solid #10367f; border-right:2px solid #10367f;">Shipping</th>
     <th style="font-family:arial, sans-serif; font-size:15px; line-height:15px; height:15px; color:#fff; text-align:center;background-color:#10367f; border-top:2px solid #10367f; border-bottom:2px solid #10367f; border-right:2px solid #10367f;">QTY</th>
                        <th style="font-family:arial, sans-serif; font-size:15px; line-height:15px; height:15px; color:#fff; text-align:center;background-color:#10367f; border-top:2px solid #10367f; border-bottom:2px solid #10367f;">Price</th>
                        <th style="font-family:arial, sans-serif; font-size:15px; line-height:15px; height:15px; color:#fff; text-align:center;background-color:#10367f; border-top:2px solid #10367f; border-bottom:2px solid #10367f;">File</th>
                    </tr>
<tr><th style="line-height:5px;background-color:#10367f; height:5px;" colspan="7">&nbsp;</th></tr>
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
                                <td style="font-family:arial, sans-serif; font-size:14px; line-height:15px; height:15px; text-align:center; background-color:#eee;border-right:1px solid #ccc; border-bottom:1px solid #ccc; padding:6px 8px;">
                                    @php $filename = App\Private_plans::find($c->id)->file_name; @endphp
                                    @if(Helpers::isFileExist('uploads/private_planroom/plan/'.$filename) && $filename != '')
                                        <a target="_blank" href="{{Helpers::isFileExist('uploads/private_planroom/plan/'.$filename)}}"><b>view</b></a>
                                    @endif
                                </td>
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
                <tr>
                
                    <td style="font-family:arial, sans-serif; font-size:14px;  background:#000; padding: 8px; line-height:14px; height:14px; text-align:left; color:#fff; border-bottom:1px solid #fff;"><b></b></td>
                    <td style="font-family:arial, sans-serif; font-size:14px;background:#000; padding: 8px; line-height:14px; height:14px; text-align:left; color:#fff; border-bottom:1px solid #fff;"></td>
                      
                </tr>               
                  
                    </table>
                 </td>
                 <td colspan="3">
                <table  border="0" cellspacing="0" cellpadding="0" style="letter-spacing: 0.5px; background:#9f9f9f; width:100%;">
                    
                <tr>
                    
                    <td style="font-family:arial, sans-serif; font-size:14px;  background:#000; padding: 8px; line-height:14px; height:14px; text-align:left; color:#fff; border-bottom:1px solid #fff;"><b>Total amount</b></td>
                    <td style="font-family:arial, sans-serif; font-size:14px;background:#333; padding: 8px; line-height:14px; height:14px; text-align:left; color:#fff; border-bottom:1px solid #fff;"> ${!! \Cart::subtotal() !!}</td>
                   
                </tr>
                    </tr>
                    </table>
                 </td>
            </table>
        </td>
            </tr>
</table>