@extends('admin/layout')

@section('title', 'Customer')

@section('content')
    <div class="page-title-breadcrumb" id="title-breadcrumb-option-demo">
                <div class="page-header pull-left">
                    <div class="page-title">Transaction History</div>
                </div>
               <ol class="breadcrumb page-breadcrumb pull-right">
                    <li><i class="fa fa-home"></i>&nbsp;<a href="javascript:void(0);">Home</a>&nbsp;&nbsp;<i class="fa fa-angle-right"></i>&nbsp;&nbsp;</li>
                    <li><i class="fa fa-user"></i>&nbsp;<a href="javascript:void(0);">Users</a>&nbsp;&nbsp;<i class="fa fa-angle-right"></i>&nbsp;&nbsp;</li>
                    <li class="active"><i class="fa fa-user"></i>&nbsp; Transaction History</li>
                </ol>
                <div class="clearfix"></div>
            </div>
    <div class="page-content">
                <div class="row">
                    <div class="col-lg-12">
                     <div class="portlet box portlet-yellow">
                            <div class="portlet-header">
                                <div class="caption">Customer Transaction History</div>
				<div class="actions">
                                <a href="{{URL::route('front_users')}}" class="btn btn-sm btn-white"><i class="fa fa-arrow-left"></i>&nbsp;Back</a>&nbsp;</div>
                            </div>
                            <div class="portlet-body">
                                    <div id="flip-scroll">
                                    <table class="table table-bordered table-striped table-condensed cf">
                                        <thead class="cf">
                                        <tr>
                                                <th width="20%">Subscription Id</th>
                                                <th width="20%">Customer Profile Id</th>
                                                <th width="20%">Customer Payment Profile Id</th>
                                                <th width="10%">refId</th>
						<th width="8%">Amount</th>
                                                <th width="12%">Status</th>
						<th width="10%">Payment Date</th>
                                           
                                        </tr>
                                        </thead>
                                        <tbody>
                                         @if($lists->count() >0)
                                                @foreach($lists as $l)
                                                    <tr>
                                                       
                                                        <td>{{ $l->subscriptionId}}</td>
                                                        <td>{{ $l->customerProfileId }}</td>
                                                        <td>{{ $l->customerPaymentProfileId }}</td>
							<td>{{ $l->refId }}</td>
							<td>{{ $l->user->total_amount }}</td>    
                                                        <td>{{ $l->status }}</td>
                                                        <td>{!! date('m-d-Y',strtotime($l->created_at)) !!}</td>
                                                    </tr>
                                                     @endforeach
							@else
								<tr><td colspan="7" align="center">.:: Record Not Found ::.</td></tr>
							@endif	
                                        </tbody>
                                    </table>
                                          <div class="pagination-panel">
						
						{!! $lists->render() !!}
						
						
						 
				         </div>
                                </div>

                                
                            </div>
                        </div>
                     
                     
                     
                         </div>
                </div>
            </div>
		
@endsection