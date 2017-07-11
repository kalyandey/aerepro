@if(count($cart_item) > 0)
    <h3>Planroom Cart</h3>
    @php $data = '' @endphp
    @foreach($cart_item as $cart)
        @php
        $data[$cart->options->project_id][] = $cart;
        @endphp
    @endforeach
    
    @if(count($data) > 0)
    @foreach($data as $k=>$d)
        <div>Documents for project {{$k}}</div>
        @foreach($d as $c)
        <div>{{$k .' '.$c->name}}</div>
        <div>Shipping:
        
        @if($c->options->papersize== 'full_size')
            @php $papersize = 'Full Size'; @endphp
        @elseif($c->options->papersize== 'half_size')
            @php $papersize = 'Half Size'; @endphp
        @else
            @php $papersize = 'Download'; @endphp
        @endif
        {{$papersize}}</div>
        <div>Total : {{$c->qty}} pages x ${{$c->price}} x 1 prints = ${{$c->qty * $c->price}}</div>
        <br>
        @endforeach
    @endforeach
@endif
-----------------------------------------------
<br>
Sub total : ${{\Cart::subtotal()}}
    <a href="{{URL::route('my_cart') }}">View Cart</a>

@endif