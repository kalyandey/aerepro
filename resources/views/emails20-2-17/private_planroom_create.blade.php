@extends('emails.layout')

@section('content')
    
    <tr>
        <td border="0" style="font-family:arial, sans-serif; font-size:18px; line-height:18px; height:18px;"><b>Hello,</b></td>
    </tr>
    <tr><td border="0" style="line-height:20px; height:20px;">&nbsp;</td></tr>
    <tr>                
        <td border="0" style="font-family:arial, sans-serif; font-size:14px; line-height:18px; height:18px;">a new project has been added to your Planroom entitled, "{!! $project_name !!}".  You can log in by clicking on the link below to view the project details.</td>                   
    </tr>
    
    <tr><td border="0" style="line-height:20px; height:20px;">&nbsp;</td></tr>
    
    <tr>                
        <td border="0" style="font-family:arial, sans-serif; font-size:14px; line-height:18px; height:18px;"><b><a href="{!! $company_slug !!}" style="color: #10367f; font-size: 14px; text-decoration: none;">{!! $company_slug !!}</a></b></td>                   
    </tr>
@endsection