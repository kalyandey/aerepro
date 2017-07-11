@extends('emails/layout')


@section('content')
Dear {{$first_name}},
<br><br>
<p>You have requested to reset your password </p>
<p>Please use the following link to <a href="{{URL::route('user_reset_newpassword',[$token])}}">reset your password</a></p>
<p>If you did not request this password change feel free to ignore it.</p>
<br>
Thanks & Regards
<br>
<p>The A&E Reprographics Team</p>
    
@endsection