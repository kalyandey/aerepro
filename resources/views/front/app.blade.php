<!doctype html>
<html>
<head>
<meta charset="utf-8">
<title>A&E Reprographics</title>
<link rel="icon" type="image/png" href="{{asset('images/favicon.png')}}">
<meta name="viewport" content="width=device-width, initial-scale=1">
<meta name="format-detection" content="telephone=no">
<meta name="SKYPE_TOOLBAR" content="SKYPE_TOOLBAR_PARSER_COMPATIBLE" />
<link type="text/css" rel="stylesheet" href="{{asset('css/style.css')}}">
<link type="text/css" rel="stylesheet" href="{{asset('css/genericons.css')}}">
<link rel="stylesheet" href="{{asset('css/jquery.bxslider.css')}}" />
<link rel="stylesheet" href="{{asset('css/jquery-ui.css')}}" />
<link href="https://fonts.googleapis.com/css?family=Open+Sans:300,300i,400,400i,600,600i,700,700i,800,800i" rel="stylesheet">
<link href="https://fonts.googleapis.com/css?family=Oswald:300,400,700" rel="stylesheet">
<link type="text/css" rel="stylesheet" href="{{asset('css/jquery.dataTables.min.css')}}">

<link rel="stylesheet" type="text/css" href="{{asset('css/jquery.fancybox.css?v=2.1.5') }}" media="screen" />
<link rel="stylesheet" type="text/css" href="{{asset('css/jquery.fancybox-thumbs.css?v=1.0.7') }}" />

<script type="text/javascript" src="{{asset('js/jquery.min.js')}}"></script>
<script type="text/javascript" src="{{asset('js/bootstrap.min.js')}}"></script>
<script type="text/javascript" src="{{asset('js/bootstrap-datepicker.min.js')}}"></script>
<script>
    var BASE_URL = "{{ URL::to('/') }}";
    var CSRF_TOKEN = "{{ csrf_token() }}";
</script>
</head>

<body>
<header id="header">
@include('front.layout.header')
</header>

@if(Route::currentRouteName() == 'private_planroom_list_for_user' || Route::currentRouteName() == 'private_planroom_list_for_company' )
<div class="main private-planroom-branding">
@else
<div class="main">
@endif
  <div class="banner fixed">
    <img src="{{asset('images/banner1.jpg')}}" alt="img" />
  </div>
  @yield('content')
</div>

<footer>
@include('front.layout.footer')
</footer>

<script type="text/javascript" src="{{asset('js/jquery.fancybox.js?v=2.1.5') }}"></script>
<script type="text/javascript" src="{{asset('js/jquery.fancybox-thumbs.js?v=1.0.7') }}"></script>
<script src="{{asset('js/jquery.panzoom.js')}}"></script>
<script src="{{asset('js/jquery.mousewheel.js')}}"></script>
        
<script type="text/javascript" src="{{asset('js/jquery.dataTables.min.js')}}"></script>
<script type="text/javascript" src="{{asset('js/functions.js')}}"></script>
<script src="{{asset('js/jquery-ui.js') }}"></script>
<script src="{{asset('js/jquery.bxslider.js')}}"></script>
<script src="{{asset('js/main.js')}}"></script>
<script src="{{asset('js/jquery.validate.min.js')}}"></script>
<script src="{{asset('js/jquery.maskedinput.min.js')}}"></script>
<script src="{{asset('js/easyResponsiveTabs.js')}}" type="text/javascript"></script>
</body>
</html>