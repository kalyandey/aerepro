<!DOCTYPE html>
<html lang="en">
<head><title>A&E Reprographics</title>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="cache-control" content="no-cache">
    <meta http-equiv="expires" content="Thu, 19 Nov 1900 08:52:00 GMT">
    <meta name="_token" content="{!! csrf_token() !!}"/>
    <link rel="shortcut icon" href="images/icons/favicon.ico">
    <link rel="apple-touch-icon" href="images/icons/favicon.png">
    <link rel="apple-touch-icon" sizes="72x72" href="images/icons/favicon-72x72.png">
    <link rel="apple-touch-icon" sizes="114x114" href="images/icons/favicon-114x114.png">
    <!--Loading bootstrap css-->
    <link type="text/css" rel="stylesheet" href="http://fonts.googleapis.com/css?family=Open+Sans:400italic,400,300,700">
    <link type="text/css" rel="stylesheet" href="http://fonts.googleapis.com/css?family=Oswald:400,700,300">
    <link type="text/css" rel="stylesheet" href="{{ asset('admin_assets/vendors/jquery-ui-1.10.4.custom/css/ui-lightness/jquery-ui-1.10.4.custom.min.css')}}">
    <link type="text/css" rel="stylesheet" href="{{ asset('admin_assets/vendors/font-awesome/css/font-awesome.min.css ')}}">
    <link type="text/css" rel="stylesheet" href="{{ asset('admin_assets/vendors/bootstrap/css/bootstrap.min.css')}}">
    <!--LOADING STYLESHEET FOR PAGE-->
    <link type="text/css" rel="stylesheet" href="{{ asset('admin_assets/vendors/intro.js/introjs.css')}}">
    <link type="text/css" rel="stylesheet" href="{{ asset('admin_assets/vendors/calendar/zabuto_calendar.min.css')}}">
    <link type="text/css" rel="stylesheet" href="{{ asset('admin_assets/vendors/sco.message/sco.message.css')}}">
    <link type="text/css" rel="stylesheet" href="{{ asset('admin_assets/vendors/intro.js/introjs.css')}}">
    <!--Loading style vendors-->
    <link type="text/css" rel="stylesheet" href="{{ asset('admin_assets/vendors/animate.css/animate.css')}}">
    <link type="text/css" rel="stylesheet" href="{{ asset('admin_assets/vendors/jquery-pace/pace.css')}}">
    <link type="text/css" rel="stylesheet" href="{{ asset('admin_assets/vendors/iCheck/skins/all.css')}}">
    <link type="text/css" rel="stylesheet" href="{{ asset('admin_assets/vendors/jquery-notific8/jquery.notific8.min.css')}}">
    <!--Loading style-->
    <link type="text/css" rel="stylesheet" href="{{ asset('admin_assets/css/themes/style1/orange-blue.css')}}" class="default-style">
    <link type="text/css" rel="stylesheet" href="{{ asset('admin_assets/css/themes/style1/orange-blue.css')}}" id="theme-change" class="style-change color-change">
    <link type="text/css" rel="stylesheet" href="{{ asset('admin_assets/css/style-responsive.css')}}">
    
    <link type="text/css" rel="stylesheet" href="{{ asset('admin_assets/vendors/bootstrap-datepicker/css/datepicker.css') }}">
    <link type="text/css" rel="stylesheet" href="{{ asset('admin_assets/vendors/bootstrap-daterangepicker/daterangepicker-bs3.css') }}">
    <link type="text/css" rel="stylesheet" href="{{ asset('admin_assets/vendors/bootstrap-datetimepicker/build/css/bootstrap-datetimepicker.min.css') }}">
    <link type="text/css" rel="stylesheet" href="{{ asset('admin_assets/vendors/bootstrap-timepicker/css/bootstrap-timepicker.min.css') }}">
    <link type="text/css" rel="stylesheet" href="{{ asset('admin_assets/css/custom.css') }}">
    
    <script src="{{ asset('admin_assets/js/jquery-1.10.2.min.js')}}"></script>
    <script src="{{ asset('admin_assets/js/jquery-migrate-1.2.1.min.js')}}"></script>
    <script src="{{ asset('admin_assets/js/jquery-ui.js')}}"></script>
    <!--loading bootstrap js-->
    <script src="{{ asset('admin_assets/vendors/bootstrap/js/bootstrap.min.js')}}"></script>
    <script src="{{ asset('admin_assets/vendors/bootstrap-hover-dropdown/bootstrap-hover-dropdown.js')}}"></script>
    <script src="{{ asset('admin_assets/js/html5shiv.js')}}"></script>
    <script src="{{ asset('admin_assets/js/respond.min.js')}}"></script>
    <script src="{{ asset('admin_assets/vendors/metisMenu/jquery.metisMenu.js')}}"></script>
    <script src="{{ asset('admin_assets/vendors/slimScroll/jquery.slimscroll.js')}}"></script>
    <script src="{{ asset('admin_assets/vendors/jquery-cookie/jquery.cookie.js')}}"></script>
    <script src="{{ asset('admin_assets/vendors/iCheck/icheck.min.js')}}"></script>
    <script src="{{ asset('admin_assets/vendors/iCheck/custom.min.js')}}"></script>
    <script src="{{ asset('admin_assets/vendors/jquery-notific8/jquery.notific8.min.js')}}"></script>
    <script src="{{ asset('admin_assets/vendors/jquery-highcharts/highcharts.js')}}"></script>
    <script src="{{ asset('admin_assets/js/jquery.menu.js')}}"></script>
    <script src="{{ asset('admin_assets/vendors/jquery-pace/pace.min.js')}}"></script>
    <script src="{{ asset('admin_assets/vendors/holder/holder.js')}}"></script>
    <script src="{{ asset('admin_assets/vendors/responsive-tabs/responsive-tabs.js')}}"></script>
    <script src="{{ asset('admin_assets/vendors/jquery-news-ticker/jquery.newsTicker.min.js')}}"></script>
    <script src="{{ asset('admin_assets/vendors/jquery-validate/jquery.validate.min.js')}}"></script>  
    <script>
    var BASE_URL = "{{ URL::to('/') }}";
    var ADMIN_URL = "{{ URL::to('/').'/admin' }}";
    var CSRF_TOKEN = "{{ csrf_token() }}";
    //var base_url_suffix	= '';
    //var base_url = location.protocol + '//' + location.host + '/' + base_url_suffix;
</script>
</head>
<body class=" ">
<div>
  <!--BEGIN BACK TO TOP--><a id="totop" href="javascript:void(0);"><i class="fa fa-angle-up"></i></a><!--END BACK TO TOP--><!--BEGIN TOPBAR-->
    <div id="header-topbar-option-demo" class="page-header-topbar">
        <nav id="topbar" role="navigation" style="margin-bottom: 0; z-index: 2;" class="navbar navbar-default navbar-static-top">
            <div class="navbar-header">
                <button type="button" data-toggle="collapse" data-target=".sidebar-collapse" class="navbar-toggle"><span class="sr-only">Toggle navigation</span><span class="icon-bar"></span><span class="icon-bar"></span><span class="icon-bar"></span></button>
                <a id="logo" href="{{ URL::route('admin_login') }}" class="navbar-brand"><span class="fa fa-rocket"></span><span class="logo-text"><img src="{{asset('images/logo.png')}}" width="230px"></span><span style="display: none;font-size: 16px" class="logo-text-icon">A&E</span></a></div>
            <div class="topbar-main"><a id="menu-toggle" href="javascript:void(0);" class="hidden-xs"><i class="fa fa-bars"></i></a>
                <ul class="nav navbar-nav">
                    <li class="active"><a href="{{ URL::route('admin_dashboard') }}">Dashboard</a></li>

                </ul>
                <ul class="nav navbar navbar-top-links navbar-right mbn">
                    <li class="dropdown topbar-user"><a data-hover="dropdown" href="javascript:void(0);" class="dropdown-toggle"><!--<img src="https://s3.amazonaws.com/uifaces/faces/twitter/kolage/48.jpg" alt="" class="img-responsive img-circle"/>-->&nbsp;<span class="hidden-xs">{!!Session::get('ADMIN_ACCESS_NAME')!!}</span>&nbsp;<span class="caret"></span></a>
                        <ul class="dropdown-menu dropdown-user pull-right">
                            <li><a href="{{ URL::route('admin_profile') }}"><i class="fa fa-user"></i>My Profile</a></li>
                            <li><a href="{{ URL::route('admin_change_password') }}"><i class="fa fa-user"></i>Change Password</a></li>
                            <li><a href="{{ URL::route('admin_logout') }}"><i class="fa fa-key"></i>Log Out</a></li>
                        </ul>
                    </li>
                </ul>
            </div>
        </nav>
        <!--BEGIN MODAL CONFIG PORTLET-->
        <!--END MODAL CONFIG PORTLET--></div>
    <!--END TOPBAR-->
    <div id="wrapper"><!--BEGIN SIDEBAR MENU-->
        <nav id="sidebar" role="navigation" class="navbar-default navbar-static-side">
            <div class="sidebar-collapse menu-scroll">
                <ul id="side-menu" class="nav">
                    <li class="user-panel">
                        <!--<div class="thumb"><img src="https://s3.amazonaws.com/uifaces/faces/twitter/kolage/128.jpg" alt="" class="img-circle"/></div>-->
                        <div class="info"><p>{!!Session::get('ADMIN_ACCESS_NAME')!!}</p>
                            <ul class="list-inline list-unstyled">
                                <li><a href="{{ URL::route('admin_profile') }}" data-hover="tooltip" title="Profile"><i class="fa fa-user"></i></a></li>
                                <li><a href="{{ URL::route('admin_logout') }}" data-hover="tooltip" title="Logout"><i class="fa fa-sign-out"></i></a></li>
                            </ul>
                        </div>
                        <div class="clearfix"></div>
                    </li>
                    <li @if(Route::current()->getName() == 'admin_dashboard') {{ "class=active" }} @endif>
                        <a href="{{ URL::route('admin_dashboard') }}"><i class="fa fa-tachometer fa-fw">
                            <div class="icon-bg bg-orange"></div>
                        </i><span class="menu-title">Dashboard</span></a>
                        
                    </li>
                    @if(Auth::guard('admin')->authenticate()->ability(array('admin'),''))
                    <li @if(Route::current()->getName() == 'admin_sitesettings' || Route::current()->getName() == 'admin_sitesettings_edit') {{ "class=active" }} @endif >
                        <a href="{{ URL::route('admin_sitesettings') }}"><i class="fa fa-slack fa-fw">
                            <div class="icon-bg bg-green"></div>
                        </i><span class="menu-title">Site Settings</span></a>
                    </li>
                    @endif
                    <li @if(Route::current()->getName() == 'admin_users' || Route::current()->getName() == 'admin_users_add' || Route::current()->getName() == 'admin_users_edit' || Route::current()->getName() == 'front_users' || Route::current()->getName() == 'front_users_add' || Route::current()->getName() == 'front_user_subscriptions' || Route::current()->getName() == 'front_users_edit' || Route::current()->getName() == 'front_user_moreinfo'||Route::current()->getName() == 'private_users' || Route::current()->getName() == 'private_users_add' || Route::current()->getName() == 'private_users_edit' || Route::current()->getName() == 'front_transaction_history' || Route::current()->getName() == 'admin_role'|| Route::current()->getName() == 'admin_role_create' || Route::current()->getName() == 'admin_role_edit'|| Route::current()->getName() == 'front_user_subscribe_single') {{ "class=active" }} @endif>
                        <a href="javascript:void(0)"><i class="fa fa-group fa-fw">
                            <div class="icon-bg bg-orange"></div>
                        </i><span class="menu-title">User Management</span><span class="fa arrow"></span></a>
                        <ul class="nav nav-second-level">
                            @if(Auth::guard('admin')->authenticate()->ability(array('admin'),''))
                            <li @if(Route::current()->getName() == 'admin_role'|| Route::current()->getName() == 'admin_role_create' || Route::current()->getName() == 'admin_role_edit') {{ "class=active" }} @endif>
                                 <a href="{{ URL::route('admin_role') }}">
                                     <i class="fa fa-cog"></i>
                                     <span class="submenu-title">Role Access</span>
                                 </a>
                             </li>
                            @endif
                            @if(Auth::guard('admin')->authenticate()->ability(array('admin'),''))
                            <li @if(Route::current()->getName() == 'admin_users' || Route::current()->getName() == 'admin_users_add' || Route::current()->getName() == 'admin_users_edit') {{ "class=active" }} @endif>
                                <a href="{{ URL::route('admin_users') }}">
                                <i class="fa fa-user fa-fw"></i>
                                <span class="menu-title">Admin Users</span></a>
                            </li>
                            @endif
                            @if(Auth::guard('admin')->authenticate()->ability(array('admin','manager','planroom_manager'),''))
                            <li @if(Route::current()->getName() == 'front_users' || Route::current()->getName() == 'front_users_add' || Route::current()->getName() == 'front_users_edit' || Route::current()->getName() == 'front_user_moreinfo' || Route::current()->getName() == 'front_transaction_history'|| Route::current()->getName() == 'front_user_subscriptions'|| Route::current()->getName() == 'front_user_subscribe_single') {{ "class=active" }} @endif>
                                <a href="{{ URL::route('front_users') }}">
                                <i class="fa fa-user fa-fw"></i>
                                <span class="menu-title">Customers</span></a>
                            </li>
                            @endif
                            @if(Auth::guard('admin')->authenticate()->ability(array('admin','manager','planroom_manager'),''))
                            <li @if(Route::current()->getName() == 'private_users' || Route::current()->getName() == 'private_users_add' || Route::current()->getName() == 'private_users_edit') {{ "class=active" }} @endif>
                                <a href="{{ URL::route('private_users') }}"><i class="fa fa-user fa-fw">
                                    <div class="icon-bg bg-orange"></div>
                                </i><span class="menu-title">Private Planroom User</span></a>
                            </li>
                            @endif
                        </ul>
                    </li>
                    <!--    
                    <li @if(Route::current()->getName() == 'admin_cms_add' || Route::current()->getName() == 'admin_cms_edit' || Route::current()->getName() == 'admin_cms') {{ "class=active" }} @endif >
                        <a href="{{ URL::route('admin_cms') }}"><i class="fa fa-file-text">
                            <div class="icon-bg bg-orange"></div>
                        </i><span class="menu-title">CMS Management</span></a>
                    </li>
                    -->
                    @if(Auth::guard('admin')->authenticate()->ability(array('admin','manager','planroom_manager'),''))
                     <li @if(Route::current()->getName() == 'admin_order_list' || Route::current()->getName() == 'admin_order_view') {{ "class=active" }} @endif >
                        <a href="{{ URL::route('admin_order_list') }}"><i class="fa fa-file-text">
                            <div class="icon-bg bg-orange"></div>
                        </i><span class="menu-title">Order Management</span></a>
                    </li>
                    @endif
                    <li @if(Route::current()->getName() == 'admin_private_plan_category' || Route::current()->getName() == 'admin_private_plan_category_create'|| Route::current()->getName() == 'admin_private_plan_category_edit' || Route::current()->getName() == 'admin_private_specs_category' || Route::current()->getName() == 'admin_private_specs_category_create'|| Route::current()->getName() == 'admin_private_specs_category_edit' || Route::current()->getName() == 'admin_private_project' || Route::current()->getName() == 'admin_private_company' || Route::current()->getName() == 'admin_private_company_edit' || Route::current()->getName() == 'admin_private_project_details' || Route::current()->getName() == 'admin_private_project_plans' || Route::current()->getName() == 'admin_private_project_speces'|| Route::current()->getName() == 'admin_private_project_details_view' || Route::current()->getName() == 'admin_private_project_company_view' || Route::current()->getName() == 'admin_private_project_speces_view' || Route::current()->getName() == 'admin_private_project_plan_view' || Route::current()->getName() == 'admin_assign_private_project'|| Route::current()->getName() == 'private_users_add_from_project' || Route::current()->getName() == 'admin_private_company_list' || Route::current()->getName() == 'admin_privatecompany_edit' || Route::current()->getName() == 'private_admin_order_list' || Route::current()->getName() == 'private_admin_order_view'||Route::current()->getName() == 'admin_emailcampaign' || Route::current()->getName() == 'admin_edit_emailcampaign') {{ "class=active" }} @endif>
                        <a href="javascript:void(0)"><i class="fa fa-lock">
                            <div class="icon-bg bg-orange"></div>
                        </i><span class="menu-title">Private Planroom</span><span class="fa arrow"></span></a>
                        <ul class="nav nav-second-level">
                             @if(Auth::guard('admin')->authenticate()->ability(array('admin','manager','planroom_manager'),''))
                            <li @if(Route::current()->getName() == 'admin_private_project' || Route::current()->getName() == 'admin_private_company' || Route::current()->getName() == 'admin_private_company_edit' || Route::current()->getName() == 'admin_private_project_details' || Route::current()->getName() == 'admin_private_project_plans' || Route::current()->getName() == 'admin_private_project_speces' || Route::current()->getName() == 'admin_private_project_details_view' || Route::current()->getName() == 'admin_private_project_company_view' || Route::current()->getName() == 'admin_private_project_speces_view' || Route::current()->getName() == 'admin_private_project_plan_view'|| Route::current()->getName() == 'admin_assign_private_project'|| Route::current()->getName() == 'private_users_add_from_project')  {{ "class=active" }} @endif>
                                <a href="{{ URL::route('admin_private_project') }}"><i class="fa fa-list-alt">
                                    <div class="icon-bg bg-orange"></div>
                                </i><span class="menu-title">Projects</span></a>
                            </li>
                            @endif
                            @if(Auth::guard('admin')->authenticate()->ability(array('admin','planroom_manager'),''))
                            <li @if(Route::current()->getName() == 'admin_private_plan_category' || Route::current()->getName() == 'admin_private_plan_category_create'|| Route::current()->getName() == 'admin_private_plan_category_edit') {{ "class=active" }} @endif>
                                <a href="{{ URL::route('admin_private_plan_category') }}"><i class="fa fa-list-alt">
                                    <div class="icon-bg bg-orange"></div>
                                </i><span class="menu-title">Plan Category</span></a>
                            </li>
                            @endif
                            @if(Auth::guard('admin')->authenticate()->ability(array('admin','planroom_manager'),''))
                            <li @if(Route::current()->getName() == 'admin_private_specs_category' || Route::current()->getName() == 'admin_private_specs_category_create'|| Route::current()->getName() == 'admin_private_specs_category_edit') {{ "class=active" }} @endif>
                                <a href="{{ URL::route('admin_private_specs_category') }}"><i class="fa fa-list-alt">
                                    <div class="icon-bg bg-orange"></div>
                                </i><span class="menu-title">Specs Category</span></a>
                            </li>
                            @endif
                            @if(Auth::guard('admin')->authenticate()->ability(array('admin','planroom_manager'),''))
                            <li @if(Route::current()->getName() == 'admin_private_company_list' || Route::current()->getName() == 'admin_privatecompany_edit') {{ "class=active" }} @endif>
                                <a href="{{ URL::route('admin_private_company_list') }}"><i class="fa fa-list-alt">
                                    <div class="icon-bg bg-orange"></div>
                                </i><span class="menu-title">Company List</span></a>
                            </li>
                            @endif
                            @if(Auth::guard('admin')->authenticate()->ability(array('admin','manager','planroom_manager'),''))
                            <li @if(Route::current()->getName() == 'private_admin_order_list' || Route::current()->getName() == 'private_admin_order_view') {{ "class=active" }} @endif>
                                <a href="{{ URL::route('private_admin_order_list') }}"><i class="fa fa-list-alt">
                                    <div class="icon-bg bg-orange"></div>
                                </i><span class="menu-title">Order Details</span></a>
                            </li>
                            @endif
                            <!--<li @if(Route::current()->getName() == 'admin_emailcampaign' || Route::current()->getName() == 'admin_edit_emailcampaign' ){{"class=active"}}@endif>
                                <a href="{{ URL::route('admin_emailcampaign') }}">
                                <i class="fa fa-file-text">
                                    <div class="icon-bg bg-orange"></div>
                                </i>
                                <span class="menu-title">Email Campaign Management</span>
                                </a>
                            </li>-->
                        </ul>
                    </li>
                    <li @if(Route::current()->getName() == 'admin_project' || Route::current()->getName() == 'admin_project_create' || Route::current()->getName() == 'admin_project_awarded_to' || Route::current()->getName() == 'admin_project_address' || Route::current()->getName() == 'admin_project_principle' || Route::current()->getName() == 'admin_project_plans'|| Route::current()->getName() == 'admin_project_contractor' || Route::current()->getName() == 'admin_project_speces' || Route::current()->getName() == 'admin_project_edit' || Route::current()->getName() == 'admin_project_details'|| Route::current()->getName() == 'admin_project_awarded_to_view'|| Route::current()->getName() == 'admin_project_address_view'|| Route::current()->getName() == 'admin_project_principle_view'|| Route::current()->getName() == 'admin_project_contrctor_view' || Route::current()->getName() == 'admin_project_plan_view'|| Route::current()->getName() == 'admin_project_speces_view' || Route::current()->getName() == 'admin_category' || Route::current()->getName() == 'admin_category_edit' || Route::current()->getName() == 'admin_type' || Route::current()->getName() == 'admin_type_create' || Route::current()->getName() == 'admin_type_edit' || Route::current()->getName() == 'admin_specs' || Route::current()->getName() == 'specs_add'|| Route::current()->getName() == 'admin_specs_edit'||Route::current()->getName() == 'admin_plan_category' || Route::current()->getName() == 'admin_plan_category_create'|| Route::current()->getName() == 'admin_plan_category_edit'||Route::current()->getName() == 'admin_planroom_trade' || Route::current()->getName() == 'admin_planroom_trade_create' || Route::current()->getName() == 'admin_planroom_trade_edit' || Route::current()->getName() == 'admin_bidder_list'|| Route::current()->getName() == 'admin_bidder_create'|| Route::current()->getName() == 'admin_bidder_edit'||Route::current()->getName() == 'admin_price' || Route::current()->getName() == 'admin_price_create' || Route::current()->getName() == 'admin_price_edit'||Route::current()->getName() == 'admin_bidder_database_list' ||  Route::current()->getName() == 'admin_bidder_database_edit'||Route::current()->getName() == 'contractor_add' || Route::current()->getName() == 'admin_contractor_edit' || Route::current()->getName() == 'admin_contractor') {{ "class=active" }} @endif>
                        <a href="javascript:void(0)"><i class="fa fa-list-ul">
                            <div class="icon-bg bg-orange"></div>
                        </i><span class="menu-title">Planroom Projects</span><span class="fa arrow"></span></a>
                        <ul class="nav nav-second-level">
                            @if(Auth::guard('admin')->authenticate()->ability(array('admin','manager','planroom_manager'),''))
                            <li @if(Route::current()->getName() == 'admin_project' || Route::current()->getName() == 'admin_project_create' || Route::current()->getName() == 'admin_project_awarded_to' || Route::current()->getName() == 'admin_project_address' || Route::current()->getName() == 'admin_project_principle' || Route::current()->getName() == 'admin_project_plans'|| Route::current()->getName() == 'admin_project_contractor'|| Route::current()->getName() == 'admin_project_speces' || Route::current()->getName() == 'admin_project_edit'|| Route::current()->getName() == 'admin_project_details'|| Route::current()->getName() == 'admin_project_awarded_to_view'|| Route::current()->getName() == 'admin_project_address_view'|| Route::current()->getName() == 'admin_project_principle_view' || Route::current()->getName() == 'admin_project_contrctor_view' || Route::current()->getName() == 'admin_project_plan_view'|| Route::current()->getName() == 'admin_project_speces_view'|| Route::current()->getName() == 'admin_bidder_list'|| Route::current()->getName() == 'admin_bidder_create'|| Route::current()->getName() == 'admin_bidder_edit') {{ "class=active" }} @endif>
                                <a href="{{ URL::route('admin_project') }}"><i class="fa fa-list-alt">
                                    <div class="icon-bg bg-orange"></div>
                                </i><span class="menu-title">Projects</span></a>
                            </li>
                            @endif
                            @if(Auth::guard('admin')->authenticate()->ability(array('admin','planroom_manager'),''))
                            <li @if(Route::current()->getName() == 'contractor_add' || Route::current()->getName() == 'admin_contractor_edit' || Route::current()->getName() == 'admin_contractor') {{ "class=active" }} @endif >
                                <a href="{{ URL::route('admin_contractor') }}"><i class="fa fa-male">
                                <div class="icon-bg bg-orange"></div>
                                </i><span class="menu-title">General Contractor Rolodex</span></a>
                            </li>
                            @endif
                            @if(Auth::guard('admin')->authenticate()->ability(array('admin','planroom_manager'),''))
                            <li @if(Route::current()->getName() == 'admin_bidder_database_list' ||  Route::current()->getName() == 'admin_bidder_database_edit') {{ "class=active" }} @endif>
                                <a href="{{ URL::route('admin_bidder_database_list') }}"><i class="fa fa fa-user">
                                    <div class="icon-bg bg-orange"></div>
                                </i><span class="menu-title">Bidders Rolodex</span></a>
                            </li>
                            @endif
                            @if(Auth::guard('admin')->authenticate()->ability(array('admin'),''))
                            <li @if(Route::current()->getName() == 'admin_price' || Route::current()->getName() == 'admin_price_create' || Route::current()->getName() == 'admin_price_edit') {{ "class=active" }} @endif>
                                <a href="{{ URL::route('admin_price') }}"><i class="fa fa-money">
                                    <div class="icon-bg bg-orange"></div>
                                </i><span class="menu-title">Document Pricing</span></a>
                            </li>
                            @endif
                            @if(Auth::guard('admin')->authenticate()->ability(array('admin','planroom_manager'),''))
                            <li @if(Route::current()->getName() == 'admin_category' || Route::current()->getName() == 'admin_category_edit' || Route::current()->getName() == 'admin_type'|| Route::current()->getName() == 'admin_type_create' || Route::current()->getName() == 'admin_type_edit' || Route::current()->getName() == 'admin_plan_category' || Route::current()->getName() == 'admin_plan_category_create'|| Route::current()->getName() == 'admin_plan_category_edit' || Route::current()->getName() == 'admin_specs' || Route::current()->getName() == 'specs_add' || Route::current()->getName() == 'admin_specs_edit') {{ "class=active" }} @endif>
                                <a href="javascript:void(0)"><i class="fa fa-list-ul">
                                <div class="icon-bg bg-orange"></div>
                                </i><span class="menu-title">Field Data</span><span class="fa arrow"></span></a>
                                <ul class="nav nav-third-level">
                                <li @if(Route::current()->getName() == 'admin_category' || Route::current()->getName() == 'admin_category_edit') {{ "class=active" }} @endif>
                                    <a href="{{ URL::route('admin_category') }}"><i class="fa fa-list-alt">
                                        <div class="icon-bg bg-orange"></div>
                                    </i><span class="menu-title">Categories</span></a>
                                </li>
                                <li @if(Route::current()->getName() == 'admin_type'|| Route::current()->getName() == 'admin_type_create' || Route::current()->getName() == 'admin_type_edit') {{ "class=active" }} @endif>
                                    <a href="{{ URL::route('admin_type') }}"><i class="fa fa-list-alt">
                                        <div class="icon-bg bg-orange"></div>
                                    </i><span class="menu-title">Types</span></a>
                                </li>
                                <li @if(Route::current()->getName() == 'admin_plan_category' || Route::current()->getName() == 'admin_plan_category_create'|| Route::current()->getName() == 'admin_plan_category_edit') {{ "class=active" }} @endif>
                                    <a href="{{ URL::route('admin_plan_category') }}"><i class="fa fa-list-alt">
                                        <div class="icon-bg bg-orange"></div>
                                    </i><span class="menu-title">Plan Types</span></a>
                                </li>
                                <li @if(Route::current()->getName() == 'admin_specs' || Route::current()->getName() == 'specs_add'|| Route::current()->getName() == 'admin_specs_edit') {{ "class=active" }} @endif>
                                    <a href="{{ URL::route('admin_specs') }}"><i class="fa fa fa-list-alt">
                                        <div class="icon-bg bg-orange"></div>
                                    </i><span class="menu-title">Spec Types</span></a>
                                </li>
                                
                            </ul>
                        </li> 
                        @endif
                            
                            <!--<li @if(Route::current()->getName() == 'admin_planroom_trade' || Route::current()->getName() == 'admin_planroom_trade_create' || Route::current()->getName() == 'admin_planroom_trade_edit') {{ "class=active" }} @endif>
                                <a href="{{ URL::route('admin_planroom_trade') }}"><i class="fa fa-building-o">
                                    <div class="icon-bg bg-orange"></div>
                                </i><span class="menu-title">Trade</span></a>
                            </li>-->
                            
                        </ul>
                    </li>
                    <li @if(Route::current()->getName() == 'admin_permittype' || Route::current()->getName() == 'admin_permittype_create' || Route::current()->getName() == 'admin_permittype_edit' || Route::current()->getName() == 'admin_permitowner' || Route::current()->getName() == 'admin_permitowner_create' || Route::current()->getName() == 'admin_permitowner_edit'|| Route::current()->getName() == 'admin_buildingreport' || Route::current()->getName() == 'admin_buildingreport_create' || Route::current()->getName() == 'admin_buildingreport_edit' || Route::current()->getName() == 'admin_buildingreport_contractor' || Route::current()->getName() == 'admin_buildingreport_owner' || Route::current()->getName() == 'admin_buildingreport_permit' || Route::current()->getName() == 'admin_jurisdictions' || Route::current()->getName() == 'admin_jurisdictions_create' || Route::current()->getName() == 'admin_jurisdictions_edit') {{ "class=active" }} @endif>
                        <a href="javascript:void(0)"><i class="fa fa-bars">
                            <div class="icon-bg bg-orange"></div>
                        </i><span class="menu-title">Planroom Building Reports</span><span class="fa arrow"></span></a>
                        <ul class="nav nav-second-level">
                            
                            
                            @if(Auth::guard('admin')->authenticate()->ability(array('admin','manager','planroom_manager'),''))
                            <li @if(Route::current()->getName() == 'admin_buildingreport' || Route::current()->getName() == 'admin_buildingreport_create' || Route::current()->getName() == 'admin_buildingreport_edit' || Route::current()->getName() == 'admin_buildingreport_contractor' || Route::current()->getName() == 'admin_buildingreport_owner' || Route::current()->getName() == 'admin_buildingreport_permit') {{ "class=active" }} @endif>
                                <a href="{{ URL::route('admin_buildingreport') }}"><i class="fa fa-bar-chart-o">
                                    <div class="icon-bg bg-orange"></div>
                                </i><span class="menu-title">Building Reports</span></a>
                            </li>
                            @endif
                            
                            <!--<li @if(Route::current()->getName() == 'admin_permittype' || Route::current()->getName() == 'admin_permittype_create' || Route::current()->getName() == 'admin_permittype_edit') {{ "class=active" }} @endif>
                                <a href="{{ URL::route('admin_permittype') }}"><i class="fa fa fa-list-alt">
                                    <div class="icon-bg bg-orange"></div>
                                </i><span class="menu-title">Permit Type</span></a>
                            </li>-->
                            <!--<li @if(Route::current()->getName() == 'admin_permitowner' || Route::current()->getName() == 'admin_permitowner_create' || Route::current()->getName() == 'admin_permitowner_edit') {{ "class=active" }} @endif>
                                <a href="{{ URL::route('admin_permitowner') }}"><i class="fa fa fa-user">
                                    <div class="icon-bg bg-orange"></div>
                                </i><span class="menu-title">Permit Owners</span></a>
                            </li>-->
                            @if(Auth::guard('admin')->authenticate()->ability(array('admin','planroom_manager'),''))
                            <li @if(Route::current()->getName() == 'admin_jurisdictions' || Route::current()->getName() == 'admin_jurisdictions_create' || Route::current()->getName() == 'admin_jurisdictions_edit') {{ "class=active" }} @endif>
                                <a href="{{ URL::route('admin_jurisdictions') }}"><i class="fa fa-circle">
                                    <div class="icon-bg bg-orange"></div>
                                </i><span class="menu-title">Jurisdictions</span></a>
                            </li>
                            @endif
                            
                        </ul>
                    </li>
                   
                    
                    <li @if(Route::current()->getName() == 'admin_subscription' || Route::current()->getName() == 'admin_subscription_edit' || Route::current()->getName() == 'admin_profession' || Route::current()->getName() == 'admin_profession_create' || Route::current()->getName() == 'admin_profession_edit' || Route::current()->getName() == 'admin_csidivision' || Route::current()->getName() == 'admin_csidivision_create' || Route::current()->getName() == 'admin_csidivision_edit'|| Route::current()->getName() == 'admin_trade' || Route::current()->getName() == 'admin_trade_create' || Route::current()->getName() == 'admin_trade_edit' || Route::current()->getName() == 'admin_state' || Route::current()->getName() == 'admin_state_create' || Route::current()->getName() == 'admin_state_edit' || Route::current()->getName() == 'admin_county' || Route::current()->getName() == 'admin_county_create' || Route::current()->getName() == 'admin_county_edit'|| Route::current()->getName() == 'admin_city' || Route::current()->getName() == 'admin_city_create' || Route::current()->getName() == 'admin_city_edit'||Route::current()->getName() == 'admin_emailtemplate' || Route::current()->getName() == 'admin_emailtemplate_edit') {{ "class=active" }} @endif>
                        <a href="javascript:void(0)"><i class="fa fa-bars">
                            <div class="icon-bg bg-orange"></div>
                        </i><span class="menu-title">Global Management</span><span class="fa arrow"></span></a>
                        <ul class="nav nav-second-level">
                            @if(Auth::guard('admin')->authenticate()->ability(array('admin'),''))
                            <li @if(Route::current()->getName() == 'admin_subscription' || Route::current()->getName() == 'admin_subscription_edit') {{ "class=active" }} @endif>
                                <a href="{{ URL::route('admin_subscription') }}"><i class="fa fa-money">
                                <div class="icon-bg bg-orange"></div>
                                </i><span class="menu-title">Subscription</span></a>
                            </li>
                            @endif
                            @if(Auth::guard('admin')->authenticate()->ability(array('admin'),''))
                            <li @if(Route::current()->getName() == 'admin_profession' || Route::current()->getName() == 'admin_profession_create' || Route::current()->getName() == 'admin_profession_edit' || Route::current()->getName() == 'admin_csidivision' || Route::current()->getName() == 'admin_csidivision_create' || Route::current()->getName() == 'admin_csidivision_edit'|| Route::current()->getName() == 'admin_trade' || Route::current()->getName() == 'admin_trade_create' || Route::current()->getName() == 'admin_trade_edit') {{ "class=active" }} @endif>
                                <a href="javascript:void(0)"><i class="fa fa-list-ul">
                                <div class="icon-bg bg-orange"></div>
                                </i><span class="menu-title">Customer Traits</span><span class="fa arrow"></span></a>
                                <ul class="nav nav-third-level">
                                    <li @if(Route::current()->getName() == 'admin_profession' || Route::current()->getName() == 'admin_profession_create' || Route::current()->getName() == 'admin_profession_edit') {{ "class=active" }} @endif >
                                        <a href="{{ URL::route('admin_profession') }}"><i class="fa fa-list-alt">
                                        <div class="icon-bg bg-orange"></div>
                                        </i><span class="menu-title">Profession</span></a>
                                    </li>
                                    <li @if(Route::current()->getName() == 'admin_csidivision' || Route::current()->getName() == 'admin_csidivision_create' || Route::current()->getName() == 'admin_csidivision_edit') {{ "class=active" }} @endif >
                                        <a href="{{ URL::route('admin_csidivision') }}"><i class="fa fa-list-alt">
                                        <div class="icon-bg bg-orange"></div>
                                        </i><span class="menu-title">CSI Divisions</span></a>
                                    </li>
                                    <li @if(Route::current()->getName() == 'admin_trade' || Route::current()->getName() == 'admin_trade_create' || Route::current()->getName() == 'admin_trade_edit') {{ "class=active" }} @endif >
                                        <a href="{{ URL::route('admin_trade') }}"><i class="fa fa-list-alt">
                                        <div class="icon-bg bg-orange"></div>
                                        </i><span class="menu-title">Trade</span></a>
                                    </li>
                                     
                                </ul> 
                            </li>
                            @endif
                            @if(Auth::guard('admin')->authenticate()->ability(array('admin','planroom_manager'),''))
                            <li @if(Route::current()->getName() == 'admin_state' || Route::current()->getName() == 'admin_state_create' || Route::current()->getName() == 'admin_state_edit' || Route::current()->getName() == 'admin_county' || Route::current()->getName() == 'admin_county_create' || Route::current()->getName() == 'admin_county_edit'|| Route::current()->getName() == 'admin_city' || Route::current()->getName() == 'admin_city_create' || Route::current()->getName() == 'admin_city_edit') {{ "class=active" }} @endif>
                                <a href="javascript:void(0)"><i class="fa fa-map-marker">
                                <div class="icon-bg bg-orange"></div>
                                </i><span class="menu-title">Location</span><span class="fa arrow"></span></a>
                                <ul class="nav nav-third-level">
                                <li @if(Route::current()->getName() == 'admin_state' || Route::current()->getName() == 'admin_state_create' || Route::current()->getName() == 'admin_state_edit') {{ "class=active" }} @endif>
                                    <a href="{{ URL::route('admin_state') }}"><i class="fa fa fa-list-alt">
                                        <div class="icon-bg bg-orange"></div>
                                    </i><span class="menu-title">State</span></a>
                                </li>
                                <li @if(Route::current()->getName() == 'admin_county' || Route::current()->getName() == 'admin_county_create' || Route::current()->getName() == 'admin_county_edit') {{ "class=active" }} @endif>
                                    <a href="{{ URL::route('admin_county') }}"><i class="fa fa fa-list-alt">
                                        <div class="icon-bg bg-orange"></div>
                                    </i><span class="menu-title">County</span></a>
                                </li>
                                 <!--   
                                <li @if(Route::current()->getName() == 'admin_city' || Route::current()->getName() == 'admin_city_create' || Route::current()->getName() == 'admin_city_edit') {{ "class=active" }} @endif>
                                    <a href="{{ URL::route('admin_city') }}"><i class="fa fa fa-list-alt">
                                        <div class="icon-bg bg-orange"></div>
                                    </i><span class="menu-title">City</span></a>
                                </li>
                                   --> 
                                </ul>
                            </li>
                            @endif
                        
                           <li @if(Route::current()->getName() == 'admin_emailtemplate' || Route::current()->getName() == 'admin_emailtemplate_edit') {{ "class=active" }} @endif>
                                    <a href="{{ URL::route('admin_emailtemplate') }}"><i class="fa fa-envelope">
                                        <div class="icon-bg bg-orange"></div>
                                    </i><span class="menu-title">Email Template</span></a>
                            </li>
                        
                        </ul>
                    </li>
                </ul>
            </div>
        </nav>
        <!--END SIDEBAR MENU-->
        @if(Session::has('success')) 
                <div id="flashmessage" class="page_mess_animate page_mess_ok"><?= Session::get('success');?></div>
            @endif
            @if(Session::has('error'))
                <div id="flashmessage" class="page_mess_animate page_mess_error"><?= Session::get('error');?></div>
            @endif 
        <!--BEGIN PAGE WRAPPER-->
        <div id="page-wrapper"><!--BEGIN CONTENT-->

                @yield('content')

            <!--END CONTENT-->
        </div>
        <!--BEGIN FOOTER-->
        <div id="footer">
            <div class="copyright">&copy <?php echo date("Y"); ?>-<?php echo date('Y', strtotime('+1 year')); ?> - A&E Reprographics Admin</div>
        </div>
        <!--END FOOTER--><!--END PAGE WRAPPER--></div>
</div>

<!--CORE JAVASCRIPT-->
<script src="{{ asset('admin_assets/js/main.js')}}"></script>
<!--LOADING SCRIPTS FOR PAGE-->
<script src="{{ asset('admin_assets/vendors/intro.js/intro.js')}}"></script>

<script src="{{ asset('admin_assets/vendors/calendar/zabuto_calendar.min.js')}}"></script>
<script src="{{ asset('admin_assets/vendors/sco.message/sco.message.js')}}"></script>
<script src="{{ asset('admin_assets/vendors/intro.js/intro.js')}}"></script>
<script src="{{ asset('admin_assets/vendors/ckeditor/ckeditor.js') }}"></script>

<!--LOADING SCRIPTS FOR PAGE-->
<script src="{{ asset('admin_assets/vendors/bootstrap-datepicker/js/bootstrap-datepicker.js') }}"></script>
<script src="{{ asset('admin_assets/vendors/bootstrap-daterangepicker/daterangepicker.js') }}"></script>
<script src="{{ asset('admin_assets/vendors/moment/moment.js') }}"></script>
<script src="{{ asset('admin_assets/vendors/bootstrap-datetimepicker/build/js/bootstrap-datetimepicker.min.js') }}"></script>
<script src="{{ asset('admin_assets/vendors/bootstrap-timepicker/js/bootstrap-timepicker.js') }}"></script>
<script src="{{ asset('admin_assets/vendors/bootstrap-clockface/js/clockface.js') }}"></script>
<script src="{{ asset('admin_assets/vendors/jquery-maskedinput/jquery-maskedinput.js') }}"></script>
<script src="{{ asset('admin_assets/js/form-components.js') }}"></script>

<script src="{{ asset('admin_assets/js/custom_script.js')}}"></script>
<script src="{{ asset('admin_assets/js/table-advanced.js')}}"></script>
</body>
</html>