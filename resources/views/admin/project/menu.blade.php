<a href="{{URL::route('admin_project_edit',[$projectDetails->id])}}" class="col-md-2 btn btn-primary" style="border-right:1px solid #FFF">1. Details</a>

<a href="{{URL::route('admin_project_awarded_to',[$projectDetails->id])}}" class="col-md-2 @if(Route::current()->getName() == 'admin_project_awarded_to' || Route::current()->getName() == 'admin_project_address' || Route::current()->getName() == 'admin_project_principle' || Route::current()->getName() == 'admin_project_contractor' || Route::current()->getName() == 'admin_project_speces' ||  Route::current()->getName() == 'admin_project_plans') btn btn-primary @else btn btn-default @endif" style="border-right:1px solid #FFF">2. Awarded To </a>
    
<a href="{{URL::route('admin_project_address',[$projectDetails->id])}}" class="col-md-1 @if(Route::current()->getName() == 'admin_project_address' || Route::current()->getName() == 'admin_project_principle' || Route::current()->getName() == 'admin_project_contractor' ||  Route::current()->getName() == 'admin_project_plans' ||  Route::current()->getName() == 'admin_project_speces') btn btn-primary @else btn btn-default @endif" style="border-right:1px solid #FFF">3. Address </a>
    
<a href="{{URL::route('admin_project_principle',[$projectDetails->id])}}" class="col-md-2 @if(Route::current()->getName() == 'admin_project_principle'|| Route::current()->getName() == 'admin_project_contractor' ||  Route::current()->getName() == 'admin_project_plans' ||  Route::current()->getName() == 'admin_project_speces') btn btn-primary @else btn btn-default @endif" style="border-right:1px solid #FFF">4. Project Principal </a>

<a href="{{URL::route('admin_project_contractor',[$projectDetails->id])}}" class="col-md-2 @if( Route::current()->getName() == 'admin_project_contractor' || Route::current()->getName() == 'admin_project_plans' || Route::current()->getName() == 'admin_project_speces') btn btn-primary @else btn btn-default @endif" style="border-right:1px solid #FFF">5. GCs</a>
    
<a href="{{URL::route('admin_project_plans',[$projectDetails->id])}}" class="col-md-1 @if(Route::current()->getName() == 'admin_project_speces' || Route::current()->getName() == 'admin_project_plans') btn btn-primary @else btn btn-default @endif" style="border-right:1px solid #FFF">6. Plans</a>
    
<a href="{{URL::route('admin_project_speces',[$projectDetails->id])}}" class="col-md-2 @if(Route::current()->getName() == 'admin_project_speces') btn btn-primary @else btn btn-default @endif" style="border-right:1px solid #FFF">7. Specs</a>


    
@if (count($errors) > 0)
    <div class="alert alert-danger">
        <ul>
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
@endif