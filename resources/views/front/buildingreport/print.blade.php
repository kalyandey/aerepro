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
			<td valign="top" colspan="2"><h1 style="color:#001f5b; font-weight:600; font-size:26px;text-align:center;">Report #{!! $details->number !!}</h1></td>
                    </tr>
		<tr>
                    <td valign="top" colspan="2">
                    <h3 style="text-transform:uppercase; color:#cf0a2c;">Job Details</h3>
                    <span><strong>Date Issued: </strong>{{date('m/d/Y',strtotime($details->issued_date))}}</span>
                    <span><strong>Jurisdiction: </strong>{!! $details->jurisdictions->name !!}</span>
                    <span><strong>Permit Type: </strong>{!! $details->permit_type_id !!}</span>
                    <span><strong>Permit County:</strong>{!! count($details->permit_county) > 0 ? $details->permit_county->name : 'N/A' !!}</span>            
                    <span><strong>Address: </strong>{!! $details->address !!}</span>  
                    <span><strong>City:</strong>{!! $details->city_id !!}</span>  
                    <span><strong>State: </strong>{!! $details->state->state !!}</span>  
                    <span><strong>ZIP: </strong>{!! $details->zip !!}</span>  
                    <span><strong>Sq Ft: </strong>{!! ($details->sqft != '')?$details->sqft:'N/A' !!}</span>  
                    <span><strong>Valuation: </strong> ${!! $details->valuation !!}</span>  
                    <span><strong>Permit #: </strong>{!! ($details->permit != '')?$details->permit:'N/A' !!}</span>  
                    <span><strong>Parcel #: </strong>{!! ($details->parcel != '')?$details->parcel:'N/A'!!}</span>
                    <span><strong>Subdivision: </strong>{!! ($details->subdivision != '')?$details->subdivision:'N/A'  !!}</span> 
                    <span><strong>Lot #: </strong>{!! ($details->lot != '')?$details->lot:'N/A' !!}</span> 
                    
                    </td>
		</tr>
            <tr>
	    
                <td valign="top" colspan="2">
                <h3 style="text-transform:uppercase; color:#cf0a2c; margin-top:20px;">General Contractors:</h3>
                <span><strong>Business Name: </strong>{!! (count($details->contractor)>0)?$details->contractor->business_name:'N/A' !!}</span>
                <span><strong>Contact Name: </strong>{!! (count($details->contractor)>0)?$details->contractor->name:'N/A' !!}</span>
                <span><strong>Street: </strong>{!! (count($details->contractor)>0)?$details->contractor->street:'N/A' !!}</span>
                <span><strong>City: </strong>{!! (count($details->contractor)>0)?$details->contractor->city:'N/A' !!}</span>
                <span><strong>State: </strong>{!! (count($details->contractor)>0)?$details->contractor->state_name->state:'N/A' !!}</span>
                <span><strong>Zip: </strong>{!! (count($details->contractor)>0 && $details->contractor->zip != '')?$details->contractor->zip:'N/A' !!}</span>
                <span><strong>Phone: </strong>{!! (count($details->contractor)>0 && $details->contractor->phone != '')?$details->contractor->phone:'N/A' !!}</span>
                <span><strong>Fax: </strong>{!! (count($details->contractor)>0 && $details->contractor->fax != '')?$details->contractor->fax:'N/A' !!}</span>
                <span><strong>Email: </strong>{!! (count($details->contractor)>0 && $details->contractor->email != '')?$details->contractor->email:'N/A' !!}</span>
                </td>
            </tr>
            <tr>
                <td valign="top" colspan="2">
                <h3 style="text-transform:uppercase; color:#cf0a2c; margin-top:20px;">Permit Owner:</h3>
                <span><strong>Owner Name: </strong>{!! (count($details->permit_owner) > 0)?$details->permit_owner->owner_name:'N/A' !!}</span>
                <span><strong>Owner Address: </strong>{!! (count($details->permit_owner)>0)?$details->permit_owner->owner_address:'N/A' !!}</span>
                <span><strong>Owner City: </strong>{!! (count($details->permit_owner)>0)?$details->permit_owner->owner_city_id:'N/A' !!}</span>
                <span><strong>Owner State: </strong>{!! (count($details->permit_owner)>0)?$details->permit_owner->state->state:'N/A' !!}</span>
                <span><strong>Owner Zip: </strong>{!! (count($details->permit_owner)>0)?$details->permit_owner->owner_zip:'N/A' !!}</span>
                <span><strong>Owner Phone: </strong>{!! (count($details->permit_owner)>0)?$details->permit_owner->owner_phone:'N/A' !!}</span>
                </td>
            </tr>
         </tbody>
    </table>      
 @endforeach
 @endif


</div>