<div >
    <p>Hello, {{ $first_name }}</p>
    <p>Your profile is added to {!! $company !!}</p>
    <b>Login Details</b>
    <p>Email :  <strong>{{ $to_email }}</strong></p>
    <p>Password :  <strong>{{ $password }}</strong></p>
    @if($domain != '')
        <p>Link :  <a href="{!! $domain !!}">{!! $domain; !!}</a></p>
    @else
    <p>Link :  <a href="{!! URL::route('planroom').'/'.$company_slug; !!}">{!! URL::route('planroom').'/'.$company_slug; !!}</a></p>
    @endif
    <p>Thanks</p>
</div>