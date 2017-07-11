@extends('emails.layout')

@section('content')
    
    <tr>
        <td border="0" style="font-family:arial, sans-serif; font-size:18px; line-height:18px; height:18px;"><b>Dear {{$to_name }},</b></td>
    </tr>
    <tr><td border="0" style="line-height:20px; height:20px;">&nbsp;</td></tr>
    <tr>                
        <td border="0" style="font-family:arial, sans-serif; font-size:14px; line-height:18px; height:18px;">Your account has been created, you can login with the following credentials.</td>                   
    </tr>
    <tr><td border="0" style="line-height:20px; height:20px;">&nbsp;</td></tr>
    <tr>                
        <td border="0" style="font-family:arial, sans-serif; font-size:14px; line-height:18px; height:18px;"><b>Email :</b> {{$email}}</td>                   
    </tr>
    <tr><td border="0" style="line-height:20px; height:20px;">&nbsp;</td></tr>
    <tr>                
        <td border="0" style="font-family:arial, sans-serif; font-size:14px; line-height:18px; height:18px;"><b>Password : </b>{{$password}}</td>                   
    </tr>
    
@endsection