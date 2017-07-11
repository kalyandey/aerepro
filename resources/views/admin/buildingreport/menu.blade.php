<a href="{{URL::route('admin_buildingreport_edit',array($lists->id))}}" class="col-md-3 btn btn-primary" style="border-right:1px solid #FFF">1. Job Details</a>
<a href="{{URL::route('admin_buildingreport_contractor',array($lists->id))}}" class="col-md-3 @if(Route::current()->getName() == 'admin_buildingreport_contractor' || Route::current()->getName() == 'admin_buildingreport_owner' || Route::current()->getName() == 'admin_buildingreport_permit') btn btn-primary @else btn btn-default @endif" style="border-right:1px solid #FFF">2. General Contractors </a>
<a href="{{URL::route('admin_buildingreport_owner',array($lists->id))}}" class="col-md-3 @if(Route::current()->getName() == 'admin_buildingreport_owner' || Route::current()->getName() == 'admin_buildingreport_permit') btn btn-primary @else btn btn-default @endif" style="border-right:1px solid #FFF">3. Property Owner </a>
    
<a href="{{URL::route('admin_buildingreport_permit',array($lists->id))}}" class="col-md-3 @if(Route::current()->getName() == 'admin_buildingreport_permit') btn btn-primary @else btn btn-default @endif" style="border-right:1px solid #FFF">4. Permits </a>



    
@if (count($errors) > 0)
    <div class="alert alert-danger">
        <ul>
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
@endif