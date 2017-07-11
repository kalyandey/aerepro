<a href="{{URL::route('admin_private_project_company_view',[$details->id])}}" class="col-md-3 btn btn-primary" style="border-right:1px solid #FFF">1. Company Details</a>

<a href="{{URL::route('admin_private_project_details_view',[$details->id])}}" class="col-md-3 @if(Route::current()->getName() == 'admin_private_project_details_view' || Route::current()->getName() =='admin_private_project_plan_view' ||  Route::current()->getName() == 'admin_private_project_speces_view') btn btn-primary @else btn btn-default @endif" style="border-right:1px solid #FFF">2. Project Details</a>
    
<a href="{{URL::route('admin_private_project_plan_view',[$details->id])}}" class="col-md-3 @if(Route::current()->getName() == 'admin_private_project_speces_view' || Route::current()->getName() == 'admin_private_project_plan_view') btn btn-primary @else btn btn-default @endif" style="border-right:1px solid #FFF">3. Plan Details</a>
    
<a href="{{URL::route('admin_private_project_speces_view',[$details->id])}}" class="col-md-3 @if(Route::current()->getName() == 'admin_private_project_speces_view') btn btn-primary @else btn btn-default @endif" style="border-right:1px solid #FFF">4. Specs Details</a>


    
@if (count($errors) > 0)
    <div class="alert alert-danger">
        <ul>
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
@endif