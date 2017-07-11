<div >
    <p>Hello, {{ $first_name }}</p>
    <p>You have been invited to participate in the webdevelopment Private Planroom hosted by A&E Reprographics.  To log in, use the details below:</p>
    <p>Email :  <strong>{{ $to_email }}</strong></p>
    <p>Password :  <strong>{{ $password }}</strong></p>
    @if($domain != '')
        <p>Link :  <a href="{!! $domain !!}">{!! $domain; !!}</a></p>
    @else
    <p>Link :  <a href="{!! URL::route('planroom').'/'.$company_slug; !!}">{!! URL::route('planroom').'/'.$company_slug; !!}</a></p>
    @endif
    <p>If you have any questions, please contact us.</p>

    <p> Sincerely, </p>

    <p>The A&E Reprographics Team</p>
</div>