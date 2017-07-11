@extends('emails.layout')

@section('content')
    
    <tr>
        <td border="0" style="font-family:arial, sans-serif; font-size:18px; line-height:18px; height:18px;"><b>Hello {{ $to_name }},</b></td>
    </tr>
    <tr><td border="0" style="line-height:20px; height:20px;">&nbsp;</td></tr>
    <tr>                
        <td border="0" style="font-family:arial, sans-serif; font-size:14px; line-height:18px; height:18px;">Thanks for signing up!</td>                   
    </tr>
    
    <tr><td border="0" style="line-height:20px; height:20px;">&nbsp;</td></tr>
    
    <tr>                
        <td border="0" style="font-family:arial, sans-serif; font-size:14px; line-height:18px; height:18px;">Your account has been created, you can login with the following credentials after you have activated your account by pressing the url below.</td>                   
    </tr>
    
    <tr><td border="0" style="line-height:20px; height:20px;">&nbsp;</td></tr>
        
    <tr>                
        <td border="0" style="font-family:arial, sans-serif; font-size:14px; line-height:18px; height:18px;">--------------------------------------------------------</td>                   
    </tr>
    
    <tr><td border="0" style="line-height:20px; height:20px;">&nbsp;</td></tr>
    
     <tr>                
        <td border="0" style="font-family:arial, sans-serif; font-size:14px; line-height:18px; height:18px;">Email : {{$to_email}}</td>                   
    </tr>
    
    <tr><td border="0" style="line-height:20px; height:20px;">&nbsp;</td></tr>
        
    <tr>                
        <td border="0" style="font-family:arial, sans-serif; font-size:14px; line-height:18px; height:18px;">Password : {{$password}}</td>                   
    </tr>
    
    <tr><td border="0" style="line-height:20px; height:20px;">&nbsp;</td></tr>
    
    <tr>                
        <td border="0" style="font-family:arial, sans-serif; font-size:14px; line-height:18px; height:18px;">--------------------------------------------------------</td>                   
    </tr>
    
    <tr><td border="0" style="line-height:20px; height:20px;">&nbsp;</td></tr>
        
    <tr>                
        <td border="0" style="font-family:arial, sans-serif; font-size:14px; line-height:18px; height:18px;"><a href="{{URL::route('payment_process',[$token])}}" style="color: #10367f; font-size: 14px; text-decoration: none;">Click here</a> to activate your account</td>                   
    </tr>
@endsection