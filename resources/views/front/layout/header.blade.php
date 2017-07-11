@php $existdata = '';$imagePath = ''; @endphp
  @if(Session::has('PRIVATE_COMPANY_DETAILS') && Session::get('PRIVATE_COMPANY_DETAILS')->id != '')
  @php
  $existdata = 1;
  $company = Helpers::getCompanyLogo(Session::get('COMPANY_SLUG'));
  @endphp
  
  @if($company != '' && file_exists(public_path('uploads/private_planroom/company_logo/'.$company)))
    @php
    $imagePath = asset('uploads/private_planroom/company_logo/'.$company);
    @endphp
  @endif
@elseif(Session::has('PRIVATE_USER_DETAILS') && Session::get('PRIVATE_USER_DETAILS') != '')
  @php
  $existdata = 1;
  $company = Helpers::getCompanyLogo(Session::get('COMPANY_SLUG'));
  @endphp
  
  @if($company != '' && file_exists(public_path('uploads/private_planroom/company_logo/'.$company)))
    @php
    $imagePath = asset('uploads/private_planroom/company_logo/'.$company);
    @endphp
    @endif
@endif
      
<div class="topheader clear {{($existdata== 1)?'privatetopheader':''}}">      
  <div class="container">
    <div class="logobox">
      @if($imagePath != '')
      <img src="{{$imagePath}}">
    @endif
      <a href="{{Config::get('constant.w_link')}}" class="{{($existdata== 1)?'logolink':''}}">
      @if($existdata == 1)
        <img src="{{asset('images/logo-new.png')}}" alt="logo" />
      @else
      <img src="{{asset('images/logo.png')}}" alt="logo" />
      @endif
      </a>
    </div>
    <div class="topright clear">
      <ul class="social clear">
        <li class="fb"><a target="_blank" href="https://www.facebook.com/AE.Reprographics/">facebook</a></li>
        <li class="gp"><a target="_blank" href="https://plus.google.com/u/0/108301750702305927651">googleplus</a></li>
      </ul>
      <a class="contactno" href="tel:9284429116">(928) 442-9116</a>
      <br />
      <a href="{{Config::get('constant.w_link').'send-us-files'}}" class="btn-sendus">Send us files</a>
        
    </div>
  </div>      
</div>
@if(!Session::has('PRIVATE_COMPANY_DETAILS') && !Session::has('PRIVATE_USER_DETAILS') )
<div id="navbar" class="navbar">
  <nav id="site-navigation" class="navigation main-navigation" role="navigation">
    <button class="menu-toggle">Menu</button>
    <a class="screen-reader-text skip-link" href="#content" title="Skip to content">Skip to content</a>
    <div class="nav-menu">
    
      <ul>
        <li><a href="{{Config::get('constant.w_link')}}">Home</a></li>
        <li><a href="javascript:void(0);">Printing Services</a>
          <ul class="children">
            <li><a href="{{Config::get('constant.w_link').'printing-services'}}">Printing Services</a></li>
            <li><a href="{{Config::get('constant.w_link').'signs-and-graphics'}}">Signs and Graphics</a></li>
          </ul>
        </li>
        <li class="current_page_item"><a href="{{URL::route('planroom')}}">Planroom</a>
            <ul class="children">
            
                @if(Session::has('USER_DETAILS') && Session::get('USER_DETAILS') != '')
                @if(Helpers::getSubscriptionID(Session::get('USER_DETAILS')->id) != '' && in_array('1',explode(',',Helpers::getSubscriptionID(Session::get('USER_DETAILS')->id))))
                <li><a href="{{URL::route('planroom_list')}}">Project List</a></li>
                @endif
                @if(Helpers::getSubscriptionID(Session::get('USER_DETAILS')->id) != '' && (in_array('2',explode(',',Helpers::getSubscriptionID(Session::get('USER_DETAILS')->id))) || in_array('3',explode(',',Helpers::getSubscriptionID(Session::get('USER_DETAILS')->id)))))
                <li>
                <a href="{{URL::route('building_report')}}">Building Reports</a>
                <ul class="planroom-sub-menu">
                  @if(count(Helpers::getSelectedCounty())>0 )
                    @foreach(Helpers::getSelectedCounty() as $c)
                    @if(Helpers::getSubscriptionID(Session::get('USER_DETAILS')->id) != '' && ((in_array('2',explode(',',Helpers::getSubscriptionID(Session::get('USER_DETAILS')->id))) && $c->id == 18) || (in_array('3',explode(',',Helpers::getSubscriptionID(Session::get('USER_DETAILS')->id))) && $c->id == 7)))
                    <li><a href="{{URL::route('building_report').'?county='.$c->id}}">{{$c->name}}</a></li>
                    @endif
                    @endforeach
                  @endif
                </ul>
                </li>
                @endif
                @if(Helpers::getSubscriptionID(Session::get('USER_DETAILS')->id) != '' && in_array('1',explode(',',Helpers::getSubscriptionID(Session::get('USER_DETAILS')->id))))
                <li><a href="{{URL::route('calendar')}}">Calendar</a></li>
                @endif
                <!--<li><a href="{{URL::route('order_report')}}">Order Details</a></li>-->
                
                @elseif(Session::has('PRIVATE_COMPANY_DETAILS') && Session::get('PRIVATE_COMPANY_DETAILS') != '')
                <li><a href="{{URL::route('public_planroom_list_for_company',Session::get('COMPANY_SLUG'))}}">Project List</a></li>
                <li><a href="{{URL::route('private_order_report',Session::get('COMPANY_SLUG'))}}">Order Details</a></li>
                <li><a href="{{URL::route('email_campaign_list_for_company',Session::get('COMPANY_SLUG'))}}">Email Campaign</a></li>
                @elseif(Session::has('PRIVATE_USER_DETAILS') && Session::get('PRIVATE_USER_DETAILS') != '')
                <li><a href="{{URL::route('public_planroom_list_for_user',Session::get('COMPANY_SLUG'))}}">Project List</a></li>
                <li><a href="{{URL::route('private_order_report',Session::get('COMPANY_SLUG'))}}">Order Details</a></li>
                @endif
                
              </ul>
        </li>
        <li><a href="javascript:void(0);">Equipment and Supplies</a>
          <ul class="children">
            <li><a href="{{Config::get('constant.w_link').'large-format-printers'}}">Large Format Printers</a></li>
            <li><a href="{{Config::get('constant.w_link').'inkpaper'}}">Ink/Paper</a></li>
          </ul>
        </li>
        <li><a href="{{Config::get('constant.w_link').'about-us'}}">About Us</a></li>
        <li><a href="{{Config::get('constant.w_link').'contact-us'}}">Contact Us</a></li>
         @if(Session::has('USER_DETAILS') && Session::get('USER_DETAILS')->id != '')
        <li><a href="javascript:void(0);">Settings</a>
            <ul class="children">
                <li><a href="{{URL::route('edit_customer_profile')}}">My Profile</a></li>
                <li><a href="{{URL::route('change_password')}}">Change Password</a></li>
                <!--<li><a href="{{URL::route('cancel_payment')}}">Cancel Payment</a></li>-->
                <li><a href="{{URL::route('logout')}}">Logout</a></li>
            </ul>
        </li>
        @endif
      </ul>
    </div>
  </nav>
</div>
@endif  