@extends('emails.layout')

@section('content')
    
    <tr>
        <td border="0" style="font-family:arial, sans-serif; font-size:18px; line-height:18px; height:18px;"><b>Hello {{ $to_name }},</b></td>
    </tr>
    <tr><td border="0" style="line-height:20px; height:20px;">&nbsp;</td></tr>
    <tr>                
        <td border="0" style="font-family:arial, sans-serif; font-size:14px; line-height:18px; height:18px;">Your payment has been completed successfully.</td>                   
    </tr>
    
    <tr><td border="0" style="line-height:20px; height:20px;">&nbsp;</td></tr>
    
    <tr>                
        <td border="0" style="font-family:arial, sans-serif; font-size:14px; line-height:18px; height:18px;"><b><a href="{{\URL::route('planroom')}}" style="color: #10367f; font-size: 14px; text-decoration: none;">Click here</a> to login <b style="color: #cd092b;font-size: 14px; padding: 0 10px;">OR</b> <a href="{{\URL::route('print_details',[$invoice])}}" style="color: #10367f;font-size: 14px; text-decoration: none;">Click here</a> print invoice</b></td>                   
    </tr>
@endsection