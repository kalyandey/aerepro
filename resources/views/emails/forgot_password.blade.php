@extends('emails/layout')
@section('content')
    <tr>
        <td border="0" style="font-family:arial, sans-serif; font-size:18px; line-height:18px; height:18px;"><b>Hello  {{$user->first_name}},</b></td>
    </tr>
    <tr><td border="0" style="line-height:20px; height:20px;">&nbsp;</td></tr>
    <tr>                
        <td border="0" style="font-family:arial, sans-serif; font-size:14px; line-height:18px; height:18px;">You have requested to reset your password</td>                   
    </tr>
    
    <tr><td border="0" style="line-height:20px; height:20px;">&nbsp;</td></tr>
    
    <tr>                
        <td border="0" style="font-family:arial, sans-serif; font-size:14px; line-height:18px; height:18px;">Please use the following link to <a href="{{URL::route('private_reset_password',[$company_slug,$user->token])}}" style="color: #10367f; font-size: 14px; text-decoration: none;">reset your password</a></td>                   
    </tr>
    <tr><td border="0" style="line-height:20px; height:20px;">&nbsp;</td></tr>
    <tr>                
        <td border="0" style="font-family:arial, sans-serif; font-size:14px; line-height:18px; height:18px;">If you did not request this password change feel free to ignore it.</td>                   
    </tr>  
@endsection