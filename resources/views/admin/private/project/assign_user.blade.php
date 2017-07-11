@extends('admin.layout')
@section('content')
    
    <div id="title-breadcrumb-option-demo" class="page-title-breadcrumb">
                <div class="page-header pull-left">
                    <div class="page-title">Assign User</div>
                </div>
                 <ol class="breadcrumb page-breadcrumb pull-right">
                    <li><i class="fa fa-home"></i>&nbsp;<a href="javascript:void(0);">Home</a>&nbsp;&nbsp;<i class="fa fa-angle-right"></i>&nbsp;&nbsp;</li>
                    <li><i class="fa fa-user"></i>&nbsp;<a href="{{URL::route('admin_private_project')}}">Private Planroom</a>&nbsp;&nbsp;<i class="fa fa-angle-right"></i>&nbsp;&nbsp;</li>
                    <li class="active"><i class="fa fa-user"></i>&nbsp; Assign User</li>
                        
                </ol>
                <div class="clearfix"></div>
    </div>
    <div class="page-content">
        <div id="form-layouts" class="row">
            <div class="col-lg-12">
                    <div class="portlet box portlet-yellow">
                        <div class="portlet-header">
                            <div class="caption">Assign User for {!! $details->company->company_name!!}</div>
                        </div>
                        <div class="portlet-body">
                            <div class="row">
                                <div class="col-md-12">
                                    <!--<h3>Account Information</h3>-->
                                    <br>
                                        {!! Form::open(array('route'=>array('admin_assign_private_project',$details->id),'class'=>'form-validate')) !!}
{!! Form::hidden('action','Process')!!}
                   
                                        <div class="form-body">
                                            <div class="form-group">
                                                @if(count($users) > 0 )
                                                    <div class="col-md-12">
                                                    @php $assign_val = ($assign_user->lists != '')?explode(',',$assign_user->lists):''; @endphp
                                                    @foreach($users as $u)
                                                        @if($assign_val != '' && count($assign_val) > 0 && in_array($u->user_id,$assign_val))
                                                            @php $checked = 'checked';@endphp
                                                        @else
                                                             @php $checked = '';@endphp
                                                        @endif
                   
                                                        <div class="col-md-12">{!! Form::checkbox('users[]',$u->user_id,$checked)!!} {!! $u->assign_user->first_name .' '.$u->assign_user->last_name !!}<br></div>
                                                    @endforeach
                                                    </div>
                                                @endif
                                            </div>
                                        </div>
                                        <div style="clear:both"></div>
                                        <br>
                                        <div class="form-actions pll prl">
                                            <button class="btn btn-primary" type="submit">Update</button>
                                            &nbsp;
                                            <a class="btn btn-info" href="{{ URL::route('private_users_add_from_project',$details->id) }}">Add User</a>
                                            &nbsp;    
                                            <a class="btn btn-green" href="{{URL::route('admin_private_project')}}">back</a>
                                        </div>
                                        {!! Form::close() !!}
                                </div>
                            </div>
                            <div style="clear:both"></div>
                        </div>
                    </div>
            </div>
        </div>
    </div>
@endsection