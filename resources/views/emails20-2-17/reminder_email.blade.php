@extends('emails.layout')

@section('content')
    
    <tr>
        <td border="0" style="font-family:arial, sans-serif; font-size:18px; line-height:18px; height:18px;"><b>Hello,</b></td>
    </tr>
    <tr><td border="0" style="line-height:20px; height:20px;">&nbsp;</td></tr>
    <tr>                
        <td border="0" style="font-family:arial, sans-serif; font-size:14px; line-height:18px; height:18px;">It has come to our attention that your subscription will expire on {{$renewal_date}}.  Your credit card will be automatically charged the renewal fee.  If you'd like to cancel this account please contact us, or please log in if you would like to update your payment method.</td>                   
    </tr>
@endsection