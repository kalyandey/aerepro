@extends('emails.layout')

@section('content')
    
    <tr>
        <td border="0" style="font-family:arial, sans-serif; font-size:18px; line-height:18px; height:18px;"><b>Dear {{$user->first_name }},</b></td>
    </tr>
    <tr><td border="0" style="line-height:20px; height:20px;">&nbsp;</td></tr>
    <tr>                
        <td border="0" style="font-family:arial, sans-serif; font-size:14px; line-height:18px; height:18px;">Thanks for your subscription.</td>                   
    </tr>
    <tr><td border="0" style="line-height:20px; height:20px;">&nbsp;</td></tr>
    <tr>                
        <td border="0" style="font-family:arial, sans-serif; font-size:14px; line-height:18px; height:18px;">Your total payable amount is : {{$total_amount}}</td>                   
    </tr>
    <tr><td border="0" style="line-height:20px; height:20px;">&nbsp;</td></tr>
    <tr>                
        <td border="0" style="font-family:arial, sans-serif; font-size:14px; line-height:18px; height:18px;">Subscription Item : {{$item->title}}</td>                   
    </tr>
    
@endsection