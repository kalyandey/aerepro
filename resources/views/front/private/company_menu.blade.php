<div class="cartRt alignright">
    <!--
    @if(file_exists(public_path('uploads/private_planroom/company_logo/thumb/'.$company->logo)) && $company->logo != '')
       <img src="{{asset('uploads/private_planroom/company_logo/thumb/'.$company->logo)}}" alt="logo">
    @endif
    -->
    <ul>
       <li {{ (Route::currentRouteName() == 'profile_edit_for_company')?'class=active':'' }}><a href="{{URL::route('profile_edit_for_company',[$company->company_slug])}}">My Profile</a> </li>
       <li {{ (Route::currentRouteName() == 'public_planroom_list_for_company')?'class=active':'' }}><a href="{{URL::route('public_planroom_list_for_company',[$company->company_slug])}}">Project List</a></li>
       
       <li {{ (Route::currentRouteName() == 'private_planroom_list_for_company')?'class=active':'' }}><a href="{{URL::route('private_planroom_list_for_company',[$company->company_slug])}}">My Private Projects</a></li>
       <li><a href="javascript:void(0);" class="normalsite">Normal site</a></li>
       <li {{ (Route::currentRouteName() == 'private_change_password')?'class=active':'' }}><a href="{{URL::route('private_change_password',Session::get('COMPANY_SLUG'))}}">Change Password</a></li>  
       <li><a href="{{URL::route('privateplanroomlogout',[$company->company_slug])}}">Logout</a></li>
    </ul>
    <div class="planCrt">
       <h6>Planroom Cart</h6>
       <span id="privateCartView"></span>
    </div>
 </div>