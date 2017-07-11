@extends('front.app')
@section('content')
        <div class="details_view"></div>
        <div class="details_loader"></div>
         <div class="container">
            <div class="deshboard breport clear private-box">
               <div class="welcomePan clear">
                  <div class="welcomeTxt alignleft">
                     <h4>Welcome to My PlanRoom Private Projects.</h4>
                     <h5>Please click on any of the projects below to view the details</h5>
                  </div>
                  @include('front.private.user_menu')
               </div>
               <br />
               <div class="report-table">
                  <div class="table_top clear">
                     <span class="number">{{ (count($project) > 0)?count($project).' Project(s)':''}} </span>
                  </div>
                  <div class="table_bot clear">
                     <form class="table_chkbox2">
                        <table id="no-more-tables" class="res-table2 private_planroom_list">
                           <thead>
                              <tr>
                                 <th class="numeric">ID</th>
                                 <th class="numeric">Job Name</th>
                                 <th class="numeric">Bid Date</th>
                                 <th class="numeric">Status</th>
                              </tr>
                           </thead>
                           <tbody>
                                @if(count($project) > 0 )
                                   @foreach($project as $p)
                                   <tr>
                                   <td data-title="ID" class="privateplanroomdetails" data-project="{{$p->id}}">{!! $p->project_id !!}</td>
                                   <td data-title="Project Name" class="numeric privateplanroomdetails" data-project="{{$p->id}}">
                                      {!! $p->project_name !!}
                                   </td>
                                   <td data-title="Bid Date">{!! date('m/d/Y',strtotime($p->created_at)) !!}</td>
                                   <td data-title="Tracking List">
                                   @if($p->view_status == 'Public')
                                       <img src="{{asset('images/lck-grn.png')}}">
                                    @else
                                   <img src="{{asset('images/lck-red.png')}}" alt="no img">
                                    @endif
                                   </td>
                                    </tr>
                                    @endforeach
                                @else
                                    <tr><td colspan="4" data-title="Tracking List">Record not found</td></tr>
                                @endif
                            
                        </table>
                     </form>
                  </div>
               </div>
               <!--<a href="#" class="btn-report btn-psr">edit</a>-->
            </div>
         </div>
@endsection