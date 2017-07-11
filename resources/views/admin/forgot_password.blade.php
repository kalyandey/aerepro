<!DOCTYPE html>
<html lang="en">
<head><title>A&E Reprographics</title>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="cache-control" content="no-cache">
    <meta http-equiv="expires" content="Thu, 19 Nov 1900 08:52:00 GMT">
    <!--Loading bootstrap css-->
    <link type="text/css" href="http://fonts.googleapis.com/css?family=Open+Sans:400italic,700italic,800italic,400,700,800">
    <link type="text/css" rel="stylesheet" href="http://fonts.googleapis.com/css?family=Oswald:400,700,300">
    <link type="text/css" rel="stylesheet" href="{{ asset('admin_assets/vendors/jquery-ui-1.10.3.custom/css/ui-lightness/jquery-ui-1.10.3.custom.css') }}">
    <link type="text/css" rel="stylesheet" href="{{ asset('admin_assets/vendors/font-awesome/css/font-awesome.min.css') }}">
    <link type="text/css" rel="stylesheet" href="{{ asset('admin_assets/vendors/bootstrap/css/bootstrap.min.css') }}">
    <!--Loading style vendors-->
    <link type="text/css" rel="stylesheet" href="{{ asset('admin_assets/vendors/animate.css/animate.css') }}">
    <link type="text/css" rel="stylesheet" href="{{ asset('admin_assets/vendors/iCheck/skins/all.css') }}">
    <!--Loading style-->
    <link type="text/css" rel="stylesheet" href="{{ asset('admin_assets/css/themes/style1/pink-blue.css') }}" class="default-style">
    <link type="text/css" rel="stylesheet" href="{{ asset('admin_assets/css/themes/style1/pink-blue.css') }}" id="theme-change" class="style-change color-change">
    <link type="text/css" rel="stylesheet" href="{{ asset('admin_assets/css/style-responsive.css') }}">
    <link rel="shortcut icon" href="{{ asset('admin_assets/images/favicon.ico') }}">
</head>
<body id="signin-page">
<div class="page-form">
    {!! Form::open(array('route'=>'admin_forgot_password_action','class'=>'form','novalidate'))!!}
        <div class="header-content"><h1>Admin Log In</h1></div>
        <div class="body-content"><!--<p>Log in with a social network:</p>-->
        @if(count($errors)>0)
            @foreach($errors->all() as $error)
                <p class='text-red'>{{$error}}</p>
            @endforeach
        @endif
        @if( Session::has('errorMessage') )
            <p class='text-red'>{{Session::get('errorMessage')}}</p>
        @endif
        @if( Session::has('sucMsg') )
            <p class='text-green'>{{Session::get('sucMsg')}}</p>
        @endif
           
            <div class="form-group">
                <div class="input-icon right">
                    <i class="fa fa-user"></i>{!! Form::email('email','',array('class'=>'form-control','placeholder'=>'Username'))!!}
                </div>
            </div>
           
            <div class="form-group pull-right">
            <a class="btn btn-danger" href="{{ URL::route('admin_login') }}"><i class="fa fa-chevron-circle-left"></i> Back To Login</a>
                <button type="submit" class="btn btn-success">Send Password
                    &nbsp;<i class="fa fa-chevron-circle-right"></i></button>
            </div>
            <div class="clearfix"></div><hr>
           {!! Form::close() !!}
</div>
<script src="{{ asset('admin_assets/js/jquery-1.10.2.min.js') }}"></script>
<script src="{{ asset('admin_assets/vendors/iCheck/icheck.min.js') }}"></script>
<script src="{{ asset('admin_assets/vendors/iCheck/custom.min.js') }}"></script>
<script>//BEGIN CHECKBOX & RADIO
$('input[type="checkbox"]').iCheck({
    checkboxClass: 'icheckbox_minimal-grey',
    increaseArea: '20%' // optional
});
$('input[type="radio"]').iCheck({
    radioClass: 'iradio_minimal-grey',
    increaseArea: '20%' // optional
});
//END CHECKBOX & RADIO</script>

</body>
</html>