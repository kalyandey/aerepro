<a href="{{URL::route('admin_private_company_edit',[$details->id])}}" class="col-md-3 btn btn-primary" style="border-right:1px solid #FFF">1. Company</a>

<a href="{{URL::route('admin_private_project_details',[$details->id])}}" class="col-md-3 @if(Route::current()->getName() == 'admin_private_project_details' || Route::current()->getName() == 'admin_private_project_speces' ||  Route::current()->getName() == 'admin_private_project_plans') btn btn-primary @else btn btn-default @endif" style="border-right:1px solid #FFF">2. Details </a>
      
<a href="{{URL::route('admin_private_project_plans',[$details->id])}}" class="col-md-3 @if(Route::current()->getName() == 'admin_private_project_speces' || Route::current()->getName() == 'admin_private_project_plans') btn btn-primary @else btn btn-default @endif" style="border-right:1px solid #FFF">3. Plans</a>
    
<a href="{{URL::route('admin_private_project_speces',[$details->id])}}" class="col-md-3 @if(Route::current()->getName() == 'admin_private_project_speces') btn btn-primary @else btn btn-default @endif" style="border-right:1px solid #FFF">4. Specs</a>


@if (count($errors) > 0)
    <div class="alert alert-danger">
        <ul>
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
@endif