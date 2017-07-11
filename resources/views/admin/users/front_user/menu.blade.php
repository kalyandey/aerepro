<a href="{{URL::route('front_users_edit',[$user_details->id])}}" class="col-md-2 btn btn-primary" style="border-right:1px solid #FFF">1. My Details</a>

<a href="{{URL::route('front_user_moreinfo',[$user_details->id])}}" class="col-md-2 @if(Route::current()->getName() == 'front_user_moreinfo' || Route::current()->getName() == 'front_user_subscriptions'|| Route::current()->getName() == 'front_user_subscribe_single') btn btn-primary @else btn btn-default @endif" style="border-right:1px solid #FFF">2. My Professions </a>
    
<a href="{{URL::route('front_user_subscriptions',[$user_details->id])}}" class="col-md-2 @if(Route::current()->getName() == 'front_user_subscriptions' || Route::current()->getName() == 'front_user_subscribe_single') btn btn-primary @else btn btn-default @endif" style="border-right:1px solid #FFF">3. Subscription </a>
  
@if (count($errors) > 0)
    <div class="alert alert-danger">
        <ul>
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
@endif