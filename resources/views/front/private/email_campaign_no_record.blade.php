@extends('front.app')
@section('content')
<div class="details_view"></div>
<div class="details_loader"></div>
<div class="container">
   <div class="deshboard breport clear private-box">
      <h3><strong>Email</strong> Campaign</h3>
      @if (count($errors) > 0)
         <div class="alert alert-danger">
            <ul>
               @foreach ($errors->all() as $error)
                  <li>{{ $error }}</li>
               @endforeach
            </ul>
         </div>
      @endif
      @if( Session::has('success') )
         <p class='text-green success-msg'><span>{{Session::get('success')}}</span></p>
      @endif
      @if(Session::has('error'))
         <p class='text-red error-msg'><span>{!! Session::get('error') !!}</span></p>
      @endif
      <strong class="welcome">Welcome
         <span>
            @if(Session::has('PRIVATE_COMPANY_DETAILS') && Session::get('PRIVATE_COMPANY_DETAILS') != '')
               {!! Session::get('PRIVATE_COMPANY_DETAILS')->first_name.' '.Session::get('PRIVATE_COMPANY_DETAILS')->last_name !!}
            @elseif(Session::has('PRIVATE_USER_DETAILS') && Session::get('PRIVATE_USER_DETAILS') != '')
               {!! Session::get('PRIVATE_USER_DETAILS')->first_name.' '.Session::get('PRIVATE_USER_DETAILS')->last_name !!}
            @endif
         </span>
      </strong>	
      <div class="report-table">
         <div class="table_top clear">
            <span class="number">Total no of record: {{$list->total() }}</span>
            <span style="float:right;"><a class="btn btn-info" href="{{ URL::route('add_email_campaign_list_for_company',[Session::get('COMPANY_SLUG'),Session::get('PRIVATE_COMPANY_DETAILS')->id]) }}">Add campaign</i></a></span>            
            <div class="pagination">
               @include('front.pagination.custom', ['paginator' => $list])
            </div>
         </div>
         <div class="table_bot clear">
            <table id="no-more-tables" class="res-table2">
               <thead>
                  <tr>		
                     <th class="numeric">Company</th>
                     <th class="numeric">User</th>
                     <th class="numeric">Email Subject</th>
                     <th class="numeric">Status</th>
                     <th class="numeric">Date</th>
                     <th class="numeric">Action</th>
                  </tr>
               </thead>
               <tbody>
                     <tr>
                        <td colspan="5">--No Record Found--</td>
                     </tr>
                  
               </tbody>              
            </table>
         </div>
      </div>
   </div>
</div>
</div>
@endsection