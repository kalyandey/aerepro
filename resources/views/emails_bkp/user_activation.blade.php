<div >
    <p>Hello {{ $to_name }},</p>
    <p>Thanks for signing up!</p>
    <p>Your account has been created, you can login with the following credentials after you have activated your account by pressing the url below.</p>
    <p>--------------------------------------------------------</p>
    <p>Email : {{$to_email}}</p>
    <p>Password : {{$password}}</p>
    <p>--------------------------------------------------------</p>
    <p>Please <a href="{{URL::route('payment_process',[$token])}}">click here</a> to activate your account</p>
    <p>Thanks</p>
    <p>{{$form_name}}</p>
</div>