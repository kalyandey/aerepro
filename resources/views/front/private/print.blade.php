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
<table width="900" cellspacing="5" cellpadding="5" style="font-family:helvetica,sans serif;  background:#fff;padding:50px 10px 15px; border-bottom:3px solid #e1e1e1;" align="center">
                <tbody>
                    <tr>
			<td valign="top" colspan="2"><h1 style="color:#001f5b; font-weight:600; font-size:26px;text-align:center;">Job #{!! $list->project_id !!}</h1></td>
                    </tr>
		    <tr>
			<td valign="top" colspan="2">
			<h3 style="text-transform:uppercase; color:#cf0a2c;">Job Details</h3>
			<span><strong>Job Name: </strong>{!! $list->project_name !!}</span>         
			<span><strong>Bid Close Date:</strong>
			    @php
			    $bid_close_date = explode('-',$list->close_date);
			    $bid_close_date = $bid_close_date[1].'/'.$bid_close_date[2].'/'.$bid_close_date[0];
			    @endphp
			    {!! $bid_close_date !!} {!! date('h:i A',strtotime($list->time_due)) !!}</span>  
			<span><strong>Pre-Bid Meeting Time: </strong>
			@php
			    $prebid_meeting_date = explode('-',$list->prebid_meeting_date);
			    $prebid_meeting_date = $prebid_meeting_date[1].'/'.$prebid_meeting_date[2].'/'.$prebid_meeting_date[0];
			    @endphp
			    {!! $prebid_meeting_date !!} {!! date('h:i A',strtotime($list->prebid_meeting_time)) !!}
			</span>  
			<span><strong>Date Job Posted: </strong>{{date('m/d/Y',strtotime($list->created_at))}}</span>  
			<span><strong>Job Description: </strong>{!! ($list->description != '')?$list->description : 'N/A' !!}</span>
			<span><strong>Job Status: </strong>
			    @if($list->view_status == 'Public')
			    <img src="{{asset('images/lck-grn.png')}}">
			     @else
			    <img src="{{asset('images/lck-red.png')}}" alt="no img">
			     @endif
			</span>
			</td>
		    </tr>

		    <tr>
			<td valign="top" colspan="2" style="background:#f5f5f5; border:1px solid #eee;">
			<h3 style="display:inline-block; text-transform:uppercase;color:#cf0a2c; margin: 10px 0;">Company Details:</h3>
			<span><strong>Company Name: </strong>{!! $list->company->company_name !!}</span>
			<span><strong>Contact Name: </strong>{!! $list->company->first_name .' '.$list->company->last_name !!}</span>
			<span><strong>Contact Email:</strong>{!! $list->company->email !!}</span>            
			<span><strong>Contact Phone No:</strong>{!! $list->company->phone_no !!}</span>  
			</td>
		    </tr>
        </tbody>
    </table>
 @endif


</div>