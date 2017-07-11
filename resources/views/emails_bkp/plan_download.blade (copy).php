Hello,
<br><br>
<table>
    <tr>
        <td>Job#</td>
        <td>Document</td>
        <td>Size/Download</td>
        <td>Shipping</td>
        <td>QTY</td>
        <td>Price</td>
        <td>File</td>
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
                <td>{{ $k }}</td>
                <td>{{ ($i<10)?'0'.$i:$i }} {{$c->name}}</td>
                <td>
                @if($c->options->papersize == 'full_size')
                    {{'Full Size'}}
                @elseif($c->options->papersize == 'half_size')
                    {{'Half size'}}
                @else
                    {{$c->options->papersize}}
                @endif
                </td>
                <td>Download link will become available after successful payment.</td>
                <td>{!! $c->qty !!}</td>
                <td class="cart-price">${!! number_format($c->qty * $c->price,2) !!}</td>
                <td>
                @if($c->options->papersize == 'download')
                    @php $filename = App\Plan::find($c->id)->file_name; @endphp
                    @if(Helpers::isFileExist('uploads/project/plan/'.$filename) && $filename != '')
                        <a target="_blank" href="{{Helpers::isFileExist('uploads/project/plan/'.$filename)}}"><b>view</b></a>
                    @endif
                                                        
                @endif
                </td>
            </tr>
            @endforeach
        @endforeach
        <tr><td colspan="6" align="right">Total : {!! \Cart::subtotal() !!}</td></tr>
    @endif
@else
    <tr><td  colspan="4">No record found</td></tr>
@endif
</table>
<br><br>
Thanks & Regards
aerepro
<br>