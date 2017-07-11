@extends('emails/layout')
@section('content')
    
    <tr>
        <td border="0" style="font-family:arial, sans-serif; font-size:18px; line-height:18px; height:18px;"><b>Hello  {{$first_name}},</b></td>
    </tr>
    <tr><td border="0" style="line-height:20px; height:20px;">&nbsp;</td></tr>
    <tr>                
        <td border="0" style="font-family:arial, sans-serif; font-size:14px; line-height:18px; height:18px;">You have been invited to participate in the webdevelopment Private Planroom hosted by A&E Reprographics.  To log in, use the details below:</td>                   
    </tr>
    <tr><td border="0" style="line-height:20px; height:20px;">&nbsp;</td></tr>
    <tr>                
        <td border="0" style="font-family:arial, sans-serif; font-size:14px; line-height:18px; height:18px;">Email :  <strong>{{ $to_email }}</td>                   
    </tr>
    <tr><td border="0" style="line-height:20px; height:20px;">&nbsp;</td></tr>
    <tr>                
        <td border="0" style="font-family:arial, sans-serif; font-size:14px; line-height:18px; height:18px;">Password :  <strong>{{ $password }}</strong></td>                   
    </tr>
    <tr><td border="0" style="line-height:20px; height:20px;">&nbsp;</td></tr>
    @if($domain != '')  
    <tr>                
        <td border="0" style="font-family:arial, sans-serif; font-size:14px; line-height:18px; height:18px;">Link : <a href="{!! $domain !!}" style="color: #10367f; font-size: 14px; text-decoration: none;">{!! $domain !!}</a></td>                   
    </tr>
    @else
       <tr>                
        <td border="0" style="font-family:arial, sans-serif; font-size:14px; line-height:18px; height:18px;">Link : <a href="{!! URL::route('planroom').'/'.$company_slug; !!}" style="color: #10367f; font-size: 14px; text-decoration: none;">{!! URL::route('planroom').'/'.$company_slug; !!}</a></td>                   
    </tr>
    @endif
    
    <tr><td border="0" style="line-height:20px; height:20px;">&nbsp;</td></tr>
    <tr>                
        <td border="0" style="font-family:arial, sans-serif; font-size:14px; line-height:18px; height:18px;">If you have any questions, please contact us.</td>                   
    </tr>    
@endsection