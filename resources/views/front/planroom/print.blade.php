<style>
*{box-sizing:border-box; -moz-box-sizing:border-box; -ms-box-sizing:border-box; -webkit-box-sizing:border-box;}
	body{margin:0; position:relative;}
	img{max-width:100%; height:auto; vertical-align:middle;}
	h1, h2, h3, h4, h5, h6{margin-top:0; margin-bottom:12px; padding: 0 8px}
	table.tablesty td a img{vertical-align:bottom;}
	table.tablesty td{padding:4px;}
	table td span{padding:8px; border-bottom:1px solid #f5f5f5; width:100%; display:block;}
	table td span:last-child{border:0; margin-bottom:10px;}
	table td span strong{display: inline-block; width: 260px; font-size: 15px; text-transform: uppercase; font-weight: 600; color:#333;}
	strong{display: inline-block;  font-size: 18px; text-transform: uppercase; font-weight: 600; color:#333;  color:#001f5b;}
	#the-list td{padding:10px; border-bottom:1px solid #f5f5f5 !important;  border-left:1px solid #f5f5f5;  border-right:1px solid #f5f5f5; font-size:14px; text-align:center;}
</style>
<div style="background-image:url(../images/back.png); width:100%; padding:10px;">


<table width="900" cellspacing="5" cellpadding="5"  align="center" style="border:0px; font-family:helvetica,sans serif; background:#001f5b; padding:10px; position:relative;" class="tablesty">
    <tbody>
        <tr>
            <td colspan="2">
            <img src="{{asset('images/logo.png')}}" style="display:block; margin: 0 auto;">
            <a style="font-size: 20px;
            color: #F00;
            font-weight: bold;
            text-decoration: none; position:absolute; bottom:-45px; right:10px; padding:0 5px 5px 5px; background:#f5f5f5;border:1px solid #eee; border-radius:4px" href="javascript:if(window.print)window.print()">PRINT <img src="{{asset('images/print_large.png')}}"></a>
            </td>
          </tr>
    </tbody>
</table>
@if(count($list) > 0)
@foreach($list as $details)
<table width="900" cellspacing="5" cellpadding="5" style="font-family:helvetica,sans serif;  background:#fff;padding:50px 10px 15px; border-bottom:3px solid #e1e1e1;" align="center">
                <tbody>
                    <tr>
			<td valign="top" colspan="2"><h1 style="color:#001f5b; font-weight:600; font-size:26px;text-align:center;">{!! $details->name !!}<br>Job #{!! $details->project_id !!}</h1></td>
                    </tr>
		<tr>
                    <td valign="top" colspan="2">
		    <h3 style="text-transform:uppercase; color:#cf0a2c;">Job Details</h3>
                    <span><strong>Job Status: </strong>{!! $details->status !!}</span>
                    <span><strong>Job Category: </strong>{!! (count($details->category)>0)?$details->category->name:'N/A' !!}</span>
                    <span><strong>Job Name: </strong>{!! $details->name !!}</span>
                    <span><strong>Time Due:</strong>{!! date('h:i A',strtotime($details->time_due)) !!}</span>            
                    <span><strong>Bid Close Date:</strong>@php
                        $bid_close_date = explode('-',$details->bid_close_date);
                        $bid_close_date = $bid_close_date[1].'/'.$bid_close_date[2].'/'.$bid_close_date[0];
                        @endphp
                        {!! $bid_close_date !!} {!! date('h:i A',strtotime($details->time_due)) !!}</span>  
                    <span><strong>Pre-Bid Meeting Time: </strong>
		    @if($details->pre_bid_meeting_date != '')
		    @php
		    $pre_bid_meeting_date = explode('-',$details->pre_bid_meeting_date);
		    $pre_bid_meeting_date = $pre_bid_meeting_date[1].'/'.$pre_bid_meeting_date[2].'/'.$pre_bid_meeting_date[0];
		    @endphp
		    {!! $pre_bid_meeting_date !!} {!! date('h:i A',strtotime($details->pre_bid_meeting_time)) !!}
		    @else
			N/A
		    @endif
		    </span>  
                    <span><strong>Mandatory Pre-Bidding:</strong>{!! $details->mandatory_pre_bidding !!}</span>  
                    <span><strong>Job Type: </strong>{!! count($details->type) > 0 ? $details->type->name : 'Not Available' !!}</span>  
                    <span><strong>Valuation: </strong>{!! ($details->valuation != '')?$details->valuation:'N/A'; !!}</span>  
                    <span><strong>Date Job Posted: </strong>{{date('m/d/Y',strtotime($details->created_at))}}</span>  
                    <span><strong>Job Description: </strong>{!! ($details->description != '')?$details->description : 'N/A' !!}</span>  
                    <span><strong>Additional Comments: </strong>{!! ($details->additional_comments != '')?$details->additional_comments:'N/A' !!}</span>  
                    
                    </td>
		</tr>
		<tr>
                    <td valign="top" colspan="2" style="background:#f5f5f5; border:1px solid #eee;">
                    <h3 style="display:inline-block; text-transform:uppercase;color:#cf0a2c; margin: 10px 0;">Awarded to:</h3>
                    @if(count($details->awarded_contractor) != 0 || count($details->awarded_bidder) != 0 )    
                    @if(count($details->awarded_contractor) > 0)
			<span><strong>Business Name :</strong>
			  {!! ($details->awarded_contractor->business_name != '')?$details->awarded_contractor->business_name:'N/A' !!}</span>
			<span><strong>Contact Name :</strong>
			  {!! ($details->awarded_contractor->name != '')?$details->awarded_contractor->name:'N/A' !!}</span>
			
			<span><strong>Street :</strong>
			  {!! ($details->awarded_contractor->street != '')?$details->awarded_contractor->street:'N/A' !!}</span>
			
			<span><strong>City :</strong>
			  {!! (count($details->awarded_contractor->city_name)>0)?$details->awarded_contractor->city_name->city:'N/A' !!}</span>
			<span><strong>State :</strong>
			  {!! (count($details->awarded_contractor->state_name)>0)?$details->awarded_contractor->state_name->state:'N/A' !!}</span>
			<span><strong>Zip :</strong>
			  {!! ($details->awarded_contractor->zip != '')?$details->awarded_contractor->zip:'N/A' !!}</span>
			<span><strong>Phone :</strong>
			  {!! ($details->awarded_contractor->phone != '')?$details->awarded_contractor->phone:'N/A' !!}</span>
			<span><strong>Fax :</strong>
			  {!! ($details->awarded_contractor->fax != '')?$details->awarded_contractor->fax:'N/A' !!}</span>
			<span><strong>Email :</strong>
			  {!! ($details->awarded_contractor->email != '')?$details->awarded_contractor->email:'N/A' !!}</span>
			 
		      @elseif(count($details->awarded_bidder)>0)
			<span><strong>Company Name :</strong>
			{!! ($details->awarded_bidder->company != '')?$details->awarded_bidder->company:'N/A' !!}</span>
			<span><strong>Contact Name :</strong>
			{!! ($details->awarded_bidder->contact != '')?$details->awarded_bidder->contact:'N/A' !!}</span>
			<span><strong>Address :</strong>
			  {!! ($details->awarded_bidder->address != '')?$details->awarded_bidder->address:'N/A' !!}</span>
			<span><strong>Phone :</strong>
			  {!! ($details->awarded_bidder->phone != '')?$details->awarded_bidder->phone:'N/A' !!}</span>
			<span><strong>Fax :</strong>
			  {!! ($details->awarded_bidder->fax != '')?$details->awarded_bidder->fax:'N/A' !!}</span>
			<span><strong>Email :</strong>
			  {!! ($details->awarded_bidder->email != '')?$details->awarded_bidder->email:'N/A' !!}</span>
		      @endif
                      @else
                        Not Awarded
		      @endif
                    
                    </td>
		</tr>
        
            <tr>
                <td valign="top" colspan="2">
                <h3 style="text-transform:uppercase; color:#cf0a2c; margin-top:20px;">Job Address/Principal:</h3>
                <span><strong>Street: </strong>{!! ($details->street != '')?$details->street:'N/A' !!}</span>
                <span><strong>City: </strong>{!! (count($details->city_name)>0)?$details->city_name->city :'N/A'!!}</span>
                <span><strong>State: </strong>{!! (count($details->state_name)>0)?$details->state_name->state:'N/A' !!}</span>
                <span><strong>County: </strong>{!! (count($details->county)>0)?$details->county->name:'N/A' !!}</span>
                <span><strong>Zip: </strong>{!! ($details->zip != '')?$details->zip:'N/A' !!}</span>
                <h3 style="text-transform:uppercase; color:#cf0a2c; margin:30px 0 10px;">Job Principal:</h3>
                <span><strong>Principal Company: </strong>{!! ($details->company[0]->company_name != '')?$details->company[0]->company_name:'N/A' !!}</span>
                <span><strong>Principal Name: </strong>{!! ($details->company[0]->user_name != '')?$details->company[0]->user_name:'N/A' !!}</span>
                <span><strong>Principal Address: </strong>{!! ($details->company[0]->address != '')?$details->company[0]->address:'N/A' !!}</span>
                <span><strong>Principal City: </strong>{!! (count($details->company[0]->city_name))?$details->company[0]->city_name->city:'N/A' !!}</span>
                <span><strong>Principal State: </strong>{!! (count($details->company[0]->state_name))?$details->company[0]->state_name->state:'N/A' !!}</span>
                <span><strong>Principal Zip: </strong>{!! ($details->company[0]->zip != '')?$details->company[0]->zip:'N/A' !!}</span>
                <span><strong>Principal Phone: </strong>{!! ($details->company[0]->phone != '')?$details->company[0]->phone:'N/A' !!}</span>
                <span><strong>Principal Fax: </strong>{!! ($details->company[0]->fax != '')?$details->company[0]->fax:'N/A' !!}</span>
                <span><strong>Principal Email: </strong>{!! ($details->company[0]->email != '')?$details->company[0]->email:'N/A' !!}</span>        
                </td>
            </tr>
            <tr>
	    <td valign="top" colspan="2">
            <h3 style="text-transform:uppercase; color:#cf0a2c; margin-top:20px; margin-bottom:20px;">General contractor::</h3>
           <table cellspacing="0">
                <thead>
                    <tr>
                        <th style="width:150px; border:1px solid #f5f5f5; padding:10px; color:#333;">Business Name</th>
                        <th style="width:150px; border:1px solid #f5f5f5; padding:10px; color:#333;">Contact Name</th>
                        <th style="width:150px; border:1px solid #f5f5f5; padding:10px; color:#333;">Street</th>
                        <th style="width:150px; border:1px solid #f5f5f5; padding:10px; color:#333;">City</th>
                        <th style="width:150px; border:1px solid #f5f5f5; padding:10px; color:#333;">State</th>
                        <th style="width:150px; border:1px solid #f5f5f5; padding:10px; color:#333;">Zip</th>
			<th style="width:150px; border:1px solid #f5f5f5; padding:10px; color:#333;">Fax</th>
			<th style="width:150px; border:1px solid #f5f5f5; padding:10px; color:#333;">Email</th>
                    </tr>
                </thead>        
                <tbody id="the-list">
                    @if(count($details->contractor_assign) > 0)
                    @foreach($details->contractor_assign as $cs)
                    <tr valign="top">			
                        <td style="border-bottom:1px solid #999;">{!! ($cs->contractor->business_name != '')?$cs->contractor->business_name:'N/A' !!}</td>	
                        <td style="border-bottom:1px solid #999;">{!! ($cs->contractor->name != '')?$cs->contractor->name:'N/A' !!}</td>	
                        <td style="border-bottom:1px solid #999;">{!! (count($cs->contractor))?$cs->contractor->city:'N/A' !!}</td>	
                        <td style="border-bottom:1px solid #999;">{!! (count($cs->contractor->state_name))?$cs->contractor->state_name->state:'N/A' !!}</td>	
                        <td style="border-bottom:1px solid #999;">{!! ($cs->contractor->zip != '')?$cs->contractor->zip:'N/A' !!}</td>	
                        <td style="border-bottom:1px solid #999;">{!! ($cs->contractor->phone != '')?$cs->contractor->phone:'N/A' !!}</td>
			<td style="border-bottom:1px solid #999;">{!! ($cs->contractor->fax != '')?$cs->contractor->fax:'N/A' !!}</td>
			<td style="border-bottom:1px solid #999;">{!! ($cs->contractor->email != '')?$cs->contractor->email:'N/A' !!}</td>
                    </tr>
                     @endforeach
                     @else
                    <tr valign="top">			
                        <td colspan="6" align="center">No contractor found</td>	
                    </tr>
                   @endif
                </tbody>
                </table>
             </td>
            </tr>
        <tr>
            <td valign="top" colspan="2">
            <h3 style="text-transform:uppercase; color:#cf0a2c; margin-top:20px; margin-bottom:20px;">Bidder List:</h3>
           <table cellspacing="0">
                <thead>
                    <tr>
                        <th style="width:150px; border:1px solid #f5f5f5; padding:10px; color:#333;">Company</th>
                        <th style="width:150px; border:1px solid #f5f5f5; padding:10px; color:#333;">Contact</th>
                        <th style="width:150px; border:1px solid #f5f5f5; padding:10px; color:#333;">Address</th>
                        <th style="width:150px; border:1px solid #f5f5f5; padding:10px; color:#333;">Phone</th>
                        <th style="width:150px; border:1px solid #f5f5f5; padding:10px; color:#333;">Fax</th>
                        <th style="width:150px; border:1px solid #f5f5f5; padding:10px; color:#333;">Email</th>
                    </tr>
                </thead>        
                <tbody id="the-list">
                    @if(count($details->project_bidder) > 0)
                    @foreach($details->project_bidder as $bidder)
                    <tr valign="top">			
                        <td style="border-bottom:1px solid #999;">{{$bidder->bidder->company}}</td>	
                        <td style="border-bottom:1px solid #999;">{{$bidder->bidder->contact}}</td>	
                        <td style="border-bottom:1px solid #999;">{{$bidder->bidder->address}}</td>	
                        <td style="border-bottom:1px solid #999;">{{$bidder->bidder->phone}}</td>	
                        <td style="border-bottom:1px solid #999;">{{$bidder->bidder->fax}}</td>	
                        <td style="border-bottom:1px solid #999;">{{$bidder->bidder->email}}</td>
                    </tr>
                     @endforeach
                     @else
                    <tr valign="top">			
                        <td colspan="6" align="center">No bidder found</td>	
                    </tr>
                   @endif
                </tbody>
                </table>
             </td>
           </tr>
        </tbody>
    </table>      
 @endforeach
 @endif


</div>