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
    <!--<link type="text/css" rel="stylesheet" href="{{ asset('admin_assets/vendors/jquery-ui-1.10.3.custom/css/ui-lightness/jquery-ui-1.10.3.custom.css') }}">-->
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
    {!! Form::open(array('class'=>'form form-validate ','novalidate'))!!}
    <div class="header-content" style="background-color:#cccccc"><img src="{{asset('admin_assets/images/logo.png')}}" title="" style="max-width:100%"/></div>
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
                    <i class="fa fa-user"></i>{!! Form::email('email','',array('class'=>'form-control required','placeholder'=>'Username'))!!}
                </div>
            </div>
            <div class="form-group">
                <div class="input-icon right">
                    <i class="fa fa-key"></i>{!! Form::password('password',array('class'=>'form-control required','placeholder'=>'Password'))!!}
                </div>
            </div>
            <div class="form-group pull-left">
                <div class="checkbox-list"><label>{!! Form::checkbox('remember_me','remember') !!}&nbsp;
                    Keep me signed in</label></div>
            </div>
            <div class="form-group pull-right">
                <button type="submit" class="btn btn-success">Log In
                    &nbsp;<i class="fa fa-chevron-circle-right"></i></button>
            </div>
            <div class="clearfix"></div><hr>
            <!--<div class="forget-password"><h4>Forgotten your Password?</h4>
            <p>no worries, click <a href='{{ URL::route('admin_forgot_password') }}' class='btn-forgot-pwd'>here</a> to reset your password.</p></div>-->
            
             {!! Form::close() !!}
</div>
    
<script src="{{ asset('admin_assets/js/jquery-1.10.2.min.js') }}"></script>
<script src="{{ asset('admin_assets/vendors/iCheck/icheck.min.js') }}"></script>
<script src="{{ asset('admin_assets/vendors/iCheck/custom.min.js') }}"></script>
<script src="{{ asset('admin_assets/vendors/jquery-validate/jquery.validate.min.js')}}"></script>
<script>
    $(function(){
         $(".form-validate").validate({
            errorPlacement: function(error, element)
            {
                error.insertAfter(element);
            }
        });
    });
</script>
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