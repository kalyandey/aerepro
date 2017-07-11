<a href="{{URL::route('admin_project_details',[$projectDetails->id])}}" class="col-md-2 btn btn-primary" style="border-right:1px solid #FFF">1. Details</a>

<a href="{{URL::route('admin_project_awarded_to_view',[$projectDetails->id])}}" class="col-md-2 @if(Route::current()->getName() == 'admin_project_awarded_to_view' || Route::current()->getName() == 'admin_project_address_view' || Route::current()->getName() == 'admin_project_principle_view' || Route::current()->getName() == 'admin_project_contrctor_view' || Route::current()->getName() == 'admin_project_plan_view' ||  Route::current()->getName() == 'admin_project_speces_view') btn btn-primary @else btn btn-default @endif" style="border-right:1px solid #FFF">2. Awarded To </a>
    
<a href="{{URL::route('admin_project_address_view',[$projectDetails->id])}}" class="col-md-1 @if(Route::current()->getName() == 'admin_project_address_view' || Route::current()->getName() == 'admin_project_principle_view' || Route::current()->getName() == 'admin_project_contrctor_view' || Route::current()->getName() == 'admin_project_plan_view' ||  Route::current()->getName() == 'admin_project_speces_view') btn btn-primary @else btn btn-default @endif" style="border-right:1px solid #FFF">3.Address </a>
    
<a href="{{URL::route('admin_project_principle_view',[$projectDetails->id])}}" class="col-md-2 @if(Route::current()->getName() == 'admin_project_principle_view' || Route::current()->getName() == 'admin_project_contrctor_view'|| Route::current()->getName() == 'admin_project_plan_view' ||  Route::current()->getName() == 'admin_project_speces_view') btn btn-primary @else btn btn-default @endif" style="border-right:1px solid #FFF">4. Project Principal </a>

<a href="{{URL::route('admin_project_contrctor_view',[$projectDetails->id])}}" class="col-md-2 @if(Route::current()->getName() == 'admin_project_contrctor_view' || Route::current()->getName() == 'admin_project_speces_view' || Route::current()->getName() == 'admin_project_plan_view') btn btn-primary @else btn btn-default @endif" style="border-right:1px solid #FFF">5. GCs</a>
    
<a href="{{URL::route('admin_project_plan_view',[$projectDetails->id])}}" class="col-md-1 @if(Route::current()->getName() == 'admin_project_speces_view' || Route::current()->getName() == 'admin_project_plan_view') btn btn-primary @else btn btn-default @endif" style="border-right:1px solid #FFF">6. Plans</a>
    
<a href="{{URL::route('admin_project_speces_view',[$projectDetails->id])}}" class="col-md-2 @if(Route::current()->getName() == 'admin_project_speces_view') btn btn-primary @else btn btn-default @endif" style="border-right:1px solid #FFF">7. Speces</a>


    
@if (count($errors) > 0)
    <div class="alert alert-danger">
        <ul>
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
@endif