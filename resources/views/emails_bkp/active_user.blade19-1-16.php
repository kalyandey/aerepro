@extends('email.layout')

@section('content')
<div>
    <p>Hello {{ $to_name }},</p>
    <p>Your payment has been completed successfully.</p>
    <p><a href="{{\URL::route('planroom')}}">Click here</a> to login</p>
    <p>OR</p>
    <p><a href="{{\URL::route('print_details',[$invoice])}}">Click here</a> print invoice</p>
    <p>Thanks</p>
    <p>{{$form_name}}</p>
</div>
@endsection