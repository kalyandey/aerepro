@extends('front.app')
@section('content')
    
    <div class="container">

        <div class="deshboard breport clear list-page paymentThankyou">
        
            @if(Session::has('error'))
                <h2>Payment <span>Unsuccessful</span></h2>
                <div class="payment_error">{{Session::get('error')}}</div>
            @endif
            
            @if(Session::has('success'))
                <h2>Payment <span>Success</span></h2>
                <div class="payment_success"> <span>Payment is done successfully.</span> <a href="{{URL::route('order_details',Session::get('order_id'))}}">Click here</a> to get order details.</div>
            @endif
              
        </div>
    </div>
@endsection