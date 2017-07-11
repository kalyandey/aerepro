@extends('front.app')
@section('content')
    
    <div class="container">

        <div class="deshboard breport clear list-page paymentThankyou private-box">
        
            @if(Session::has('error'))
                <h2>Payment <span>Error</span></h2>
                <div class="payment_error">{{Session::get('error')}}</div>
            @endif
            
            @if(Session::has('success'))
                <h2>Payment <span>Success</span></h2>
                <div class="payment_success"> <span>Payment is done successfully.</span> <a href="{{URL::route('private_order_details',[Session::get('COMPANY_SLUG'),Session::get('order_id')])}}">Click here</a> to get order details.</div>
            @endif
              
        </div>
    </div>
@endsection