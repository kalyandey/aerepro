@extends('admin/layout')

@section('title', 'Role Permision Assign')

@section('content')
    <div class="page-title-breadcrumb" id="title-breadcrumb-option-demo">
                <div class="page-header pull-left">
                    <div class="page-title">Role Permission Assign</div>
                </div>
                <ol class="breadcrumb page-breadcrumb pull-right">
                    <li>
                    <i class="fa fa-cog"></i>&nbsp;
                    <a href="javascript:void(0)">Role Permission Assign</a>&nbsp;&nbsp;
                    </li>
                   
                 
                </ol>
                <div class="clearfix"></div>
            </div>
<div class="page-content">
                <div class="row">
                    <div class="col-lg-12">
                     <div class="portlet box portlet-orange">
                            <div class="portlet-header">
                                <div class="caption">Role Permission Assign</div>
                                <div class="actions"></div>
                            </div>
                            <div class="portlet-body">
                              @if (count($errors) > 0)
                                    <div class="alert alert-danger">
                                        <ul>
                                            @foreach ($errors->all() as $error)
                                                <li>{{ $error }}</li>
                                            @endforeach
                                        </ul>
                                    </div>
                        @endif
                            @if(Session::has('errmsg'))
                                          <div class="alert alert-success"><strong>Well done!</strong> {{ Session::get('errmsg') }}</div>
                            @endif
			    @if(Session::has('succmsg'))
			    <div class="note note-success"><p><strong>Well done!</strong> {{ Session::get('succmsg') }}</p></div>
		
	        @endif
{!! Form::open(array('route'=>'permission_user_assign_store','class'=>'form-validate','novalidate')) !!}
                                                               <div class="portlet-body">
                                                                <div id="flip-scroll">
                                    <table class="table table-bordered table-striped table-condensed cf">
                                        <thead class="cf">
                                        <tr>
                                        <th>Permission List</th>
                                         @if($role_lists->count() > 0)
					 @foreach($role_lists AS $rl)
                                             
                                            <th>{{$rl->display_name}}</th>
                                        @endforeach
                                        @endif
                                           
                                        </tr>
                                        </thead>
                                        <tbody>
                                        
                                        @if($permission_lists->count() > 0)
                                       
                                        
					 @for($i=0; $i<count($permission_lists); $i++)
                                         <tr>
                                            <td>
					    {{Form::hidden('permission_id[]',$permission_lists[$i]->id)}}
                                                {{$permission_lists[$i]->display_name}}
                                            </td>
						{{--*/ $k = 1 /*--}}
				               @if($role_lists->count() > 0)
					       @foreach($role_lists AS $rl)
							   
							{{--*/ $k++ /*--}}   
						
                                                @if($permission_lists[$i]->hasRole($rl->name))
                                               <td>{{ Form::checkbox('permission_type['.$rl->id.'][permission][]', $permission_lists[$i]->id, null, ['class' => 'form-control','checked'=>'checked']) }}</td>
                                                @else
                                                <td>{{ Form::checkbox('permission_type['.$rl->id.'][permission][]', $permission_lists[$i]->id, null, ['class' => 'form-control']) }}</td>
                                                @endif
                                                        
                                              <!--<td>{{ Form::checkbox('permission_type_'.$permission_lists[$i]->id.'['.$rl->id.']', $rl->id, null, ['class' => 'form-control']) }}</td>-->
					     @endforeach
				             @endif
					 </tr>
                                         @endfor
                                        @endif
                                        </tr>
                                        </tbody>
                                    </table>
                                         
                                </div>

                                
                            </div>

                                    <div class="form-actions text-right pal">
                                        <button class="btn btn-primary" type="submit">Submit</button>
                                       <!--{!! Html::linkRoute('admin_role', 'Back', array(), array('class' => 'btn btn-default')) !!}-->
                                    </div>
                          {!! Form::close() !!}
                                
                            </div>
                        </div>
                     
                     
                     
                         </div>
                </div>
            </div>

            
@endsection