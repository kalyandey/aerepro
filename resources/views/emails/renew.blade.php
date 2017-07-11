@php

$address = ($sub[0]->user->addess_line1 != '')?$sub[0]->user->addess_line1.',<br>':'';
$address .= ($sub[0]->user->addess_line2 != '')?$sub[0]->user->addess_line2.',<br>':'';
$address .= ($sub[0]->user->city != '')?$sub[0]->user->city:'';
$address .= (($sub[0]->user->city != '') && (count($sub[0]->user->state_name)>0))?',':'';
$address .= (($sub[0]->user->state != '') && (count($sub[0]->user->state_name)>0))?$sub[0]->user->state_name->state:'';
$address .= (($sub[0]->user->zip != '') && (count($sub[0]->user->state_name)>0))?',':'';
$address .= ($sub[0]->user->zip != '')?','.$sub[0]->user->zip:'';

$subscribe = '<table border="0" cellspacing="0" cellpadding="0"  style="background-color:#f5f5f5; letter-spacing: 0.5px; width:100%; text-align:center;">';
$subscribe .= '<thead style="background-color:#10367f;">';
$subscribe .= '<tr><th style="line-height:5px;background-color:#10367f; height:5px;" colspan="3">&nbsp;</th></tr>';
$subscribe .= '<tr>';
$subscribe .= '<th style="font-family:arial, sans-serif; font-size:15px; line-height:15px; height:15px; color:#fff; border:0; outline:0; text-align:left;background-color:#10367f; border-top:2px solid #10367f; border-bottom:2px solid #10367f; border-right:2px solid #10367f; padding-left:5px; padding:6px 8px;">ITEM</th>';
$subscribe .= '<th style="font-family:arial, sans-serif; font-size:15px; line-height:15px; height:15px; color:#fff; border:0; outline:0; text-align:left;background-color:#10367f; border-top:2px solid #10367f; border-bottom:2px solid #10367f; border-right:2px solid #10367f; padding-left:5px; padding:6px 8px;">PRICE</th>';
$subscribe .= '<th style="font-family:arial, sans-serif; font-size:15px; line-height:15px; height:15px; color:#fff; border:0; outline:0; text-align:left;background-color:#10367f; border-top:2px solid #10367f; border-bottom:2px solid #10367f; border-right:2px solid #10367f; padding-left:5px; padding:6px 8px;">Expire Date</th>';
$subscribe .= '</tr>';
$subscribe .= '<tr><th style="line-height:5px;background-color:#10367f; height:5px;" colspan="3">&nbsp;</th></tr>';
$subscribe .= '</thead>';
$subscribe .= '<tbody style="background:#fff;">';
                            
if(count($sub) > 0){
$totalAmount = 0;
foreach($sub AS $pay){
$subscribe .= '<tr>';
$sublist = \App\Subscription::find($pay->subscription_id);
$subscribe .= '<td style="font-family:arial, sans-serif; font-size:14px; line-height:15px; height:15px; text-align:left; background-color:#eee; border-right:1px solid #ccc; border-bottom:1px solid #ccc; border-left:1px solid #ccc; padding:6px 8px;">'. $sublist->subscription_title.'</td>';
    if($pay->subscription_type == 'quarterly'){
        $totalAmount += $sublist->quarterly_price;
        $subscribe .= '<td style="font-family:arial, sans-serif; font-size:14px; line-height:15px; height:15px;text-align:left; background-color:#eee;border-right:1px solid #ccc; border-bottom:1px solid #ccc; padding:6px 8px;"> $'.$sublist->quarterly_price.'</td>';   
    }else{
        $totalAmount += $sublist->yearly_price;
        $subscribe .= '<td style="font-family:arial, sans-serif; font-size:14px; line-height:15px; height:15px;text-align:left; background-color:#eee;border-right:1px solid #ccc; border-bottom:1px solid #ccc; padding:6px 8px;"> $'.$sublist->yearly_price.'</td>';
    }
    $subscribe .= '<td style="font-family:arial, sans-serif; font-size:14px; line-height:15px; height:15px;text-align:left; background-color:#eee;border-right:1px solid #ccc; border-bottom:1px solid #ccc; padding:6px 8px;">';
    $exp = \App\User_subscription::where('subscription_id',$pay->subscription_id)->where('user_id',$pay->user_id)->first();
    $subscribe .= date('m-d-Y',strtotime($exp->end_date));
    $subscribe .= '</td></tr>';
    }
}
$subscribe .= '<tr>';                          
$subscribe .= '<td style="font-family:arial, sans-serif; font-size:14px; line-height:15px; height:15px; text-align:left; background-color:#eee; border-right:1px solid #ccc; border-bottom:1px solid #ccc; border-left:1px solid #ccc; padding:6px 8px;"><b>Total Amount</b></td>';
$subscribe .= '<td style="font-family:arial, sans-serif; font-size:14px; line-height:15px; height:15px;text-align:left; background-color:#eee;border-right:1px solid #ccc; border-bottom:1px solid #ccc; padding:6px 8px;" colspan="2">$'.$totalAmount.'</td>';
$subscribe .= '</tr>';
$subscribe .= '</tbody>';
$subscribe .= '</table>';                    
                            
$str = str_replace(
array('{USER_NAME}','{BUSINESS_NAME}','{USEREMAIL}','{USER_ADDRESS}','{LAST_PAYMENT_DATE}','{RENEW_DETAILS}','{TOTALAMOUNT}'),
array($sub[0]->user->first_name.' '.$sub[0]->user->last_name,
$sub[0]->user->business_name,
$sub[0]->user->email,
$address,
date('m-d-Y',strtotime($sub[0]->created_at)) ,
$subscribe,
$totalAmount),
$msg);
@endphp

{!! $str !!}