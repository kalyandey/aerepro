Hello,
<br><br>
<table align="center" style="border-spacing: 0;  border-right:1px solid #ccc; text-align:center; font-family:arial, helvetica,sans-serif; font-size:14px; line-height:2; text-transform:capitalize;">
    <tr>
        <th style="border-left:1px solid #ccc; padding:8px 10px; background:#001f5b; color:#fff; font-weight:500; margin:0; text-transform:uppercase;">Job#</th>
        <th style="border-left:1px solid #ccc; padding:8px 10px; background:#001f5b; color:#fff; font-weight:500; margin:0; text-transform:uppercase;">Document</th>
        <th style="border-left:1px solid #ccc; padding:8px 10px; background:#001f5b; color:#fff; font-weight:500; margin:0; text-transform:uppercase;">Size/Download</th>
        <th style="border-left:1px solid #ccc; padding:8px 10px; background:#001f5b; color:#fff; font-weight:500; margin:0; text-transform:uppercase;">Shipping</th>
        <th style="border-left:1px solid #ccc; padding:8px 10px; background:#001f5b; color:#fff; font-weight:500; margin:0; text-transform:uppercase;">QTY</th>
        <th style="border-left:1px solid #ccc; padding:8px 10px; background:#001f5b; color:#fff; font-weight:500; margin:0; text-transform:uppercase;">Price</th>
        <th style="border-left:1px solid #ccc; padding:8px 10px; background:#001f5b; color:#fff; font-weight:500; margin:0; text-transform:uppercase;">File</th>
    </tr>
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
                <td style="border-left:1px solid #ccc; padding:8px 10px; color:#333; margin:0; border-bottom:1px solid #ccc;">{{ $k }}</td>
                <td style="border-left:1px solid #ccc; padding:8px 10px; color:#333; margin:0; border-bottom:1px solid #ccc;">{{ ($i<10)?'0'.$i:$i }} {{$c->name}}</td>
                <td style="border-left:1px solid #ccc; padding:8px 10px; color:#333; margin:0; border-bottom:1px solid #ccc;">
                @if($c->options->papersize == 'full_size')
                    {{'Full Size'}}
                @elseif($c->options->papersize == 'half_size')
                    {{'Half size'}}
                @endif
                </td>
                <td style="border-left:1px solid #ccc; padding:8px 10px; color:#333; margin:0; border-bottom:1px solid #ccc;">
                    @if($delivery_type == 'store_location')
                        <div>Store Location Pickup</div>
                        <div>Pickup Location : {{$pickup_location}}</div>
                    @elseif($delivery_type == 'local_delivery')
                        <div>Local Delivery</div>
                        <div>Address : {{$address}}</div>
                        <div>City : {{$city}}</div>
                        <div>States : {{$states}}</div>
                        <div>Zip : {{$zip}}</div>
                    @endif
                </td>
                <td style="border-left:1px solid #ccc; padding:8px 10px; color:#333; margin:0; border-bottom:1px solid #ccc;">{!! $c->qty !!}</td>
                <td  style="border-left:1px solid #ccc; padding:8px 10px; color:#333; margin:0; border-bottom:1px solid #ccc;">${!! number_format($c->qty * $c->price,2) !!}</td>
                <td style="border-left:1px solid #ccc; padding:8px 10px; color:#333; margin:0; border-bottom:1px solid #ccc;">
                    @php $filename = App\Private_plans::find($c->id)->file_name; @endphp
                    @if(Helpers::isFileExist('uploads/private_planroom/plan/'.$filename) && $filename != '')
                        <a target="_blank" href="{{Helpers::isFileExist('uploads/private_planroom/plan/'.$filename)}}"><b>view</b></a>
                    @endif
                </td>
            </tr>
            @endforeach
        @endforeach
        <tr><td align="right" colspan="7" style="background:#eee; font-weight:600; color:#000; padding:1px 10px;border-left:1px solid #ccc; border-bottom:1px solid #ccc;">Total : {!! \Cart::subtotal() !!}</td></tr>
    @endif
@else
    <tr><td style="border-left:1px solid #ccc; padding:8px 10px; color:#333; margin:0; border-bottom:1px solid #ccc;" colspan="7">No record found</td></tr>
@endif
</table>
<br><br>
Thanks & Regards
<br>
aerepro
<br>