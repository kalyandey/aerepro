@php
if($order_master->delivery_type == 'store_location'){
    $delivery_type = 'Store Location Pickup';
}elseif($order_master->delivery_type == 'local_delivery'){
    $delivery_type = 'Local Delivery';
}
$pickup = '';
if($order_master->delivery_type == 'store_location'){
    $pickup = '<b>Pickup Location:</b>'.$order_master->pickup_location;
}elseif($order_master->delivery_type == 'local_delivery'){
    $pickup = '<b>Address:</b>'.($order_master->address != '')?$order_master->address:'N/A'.'<br>';
    $pickup .= '<b>Address:</b>'.($order_master->address != '')?$order_master->address:'N/A'.'<br>';
    $pickup .= '<b>City:</b>'.(count($order_master->city_name))?$order_master->city_name->city:'N/A'.'<br>';
    $pickup .= '<b>State:</b>'.(count($order_master->state_name))?$order_master->state_name->state:'N/A'.'<br>';
    $pickup .= '<b>Zip:</b>'.($order_master->zip != '')?$order_master->zip:'N/A'.'<br>';
}

$addess_line = ($order_master->user->addess_line1 != '')?$order_master->user->addess_line1.',<br>':' ';
$addess_line .= ($order_master->user->addess_line2 != '')?$order_master->user->addess_line2.',':'';

$city = ($order_master->user->city != '')?$order_master->user->city.',':' ';

$state = ($order_master->user->state_name->state != '' && $order_master->user->state > 0)?$order_master->user->state_name->state.',':' ';
if($order_master->order_type == 'cc'){$order_type = 'Credit Card';}
elseif($order_master->order_type == 'cod'){$order_type = 'Cash On Delivery'; }
elseif($order_master->order_type == 'my_account'){$order_type = 'My Account'; }

if($order_master->tax !='' && $order_master->tax!= 0){
$tax = '$'.$order_master->tax;
}elseif($order_master->tax == '0.00'){$tax = '$'.$order_master->tax; }


if(count($order_master->order) > 0 ){
$data1 = '';
foreach($order_master->order as $ord){
$data1[$ord->project_id][] = $ord;
}
if(count($data1) > 0){
    foreach($data1 as $k=>$d){
    $i = 0 ;
    $order = '<tr><th style="line-height:15px;background-color:#fff; height:15px;" colspan="5">&nbsp;</th></tr>';
    $order .= '<tr><td style="font-family:arial, sans-serif; font-size:14px; line-height:14px; height:14px; color:#d41a1a;background:#fff;" colspan="5"><b>Documents for project '.$d[0]->project->project_id.'</b></td></tr>';
    foreach($d as $c){
    $i++;
    $order .= '<tr><th style="line-height:10px;background-color:#fff; height:10px;" colspan="5">&nbsp;</th></tr>';
    $order .= '<tr><th style="line-height:10px; height:10px;" colspan="5">&nbsp;</th></tr>';
    $order .= '<tr><td style="font-family:arial, sans-serif; font-size:14px; line-height:15px; height:15px; text-align:left;">'.(count($c->plan) > 0 )?$c->plan->plan_name : 'Full Set ('.count($d[0]->project->plan).'Pages)</td>';
    $order .= '<td style="font-family:arial, sans-serif; font-size:14px; line-height:15px; height:15px;text-align:center;">';
    if($c->order_type == 'full_size'){ $order .=  'Full Size';}
    elseif($c->order_type == 'half_size'){ $order .= 'Half Size';}
    elseif($c->order_type == 'full_set'){$order .=  'Full Set';}
    else{$order .= $c->order_type; }
    $order .= '</td>';
    $order .= '<td style="font-family:arial, sans-serif; font-size:14px; line-height:15px; height:15px; text-align:center;">$c->quantity</td>';
    $order .= '<td style="font-family:arial, sans-serif; font-size:14px; line-height:15px; height:15px; text-align:center;">$ '.number_format($c->quantity * $c->price,2).'</td>';
    $order .= '</tr>';
    }}}else{
    $order .= '<tr><td colspan="4" style="width:100%;">----No record Found----</td></tr>';
}
}						
$str = str_replace(
array('{ORDER_ID}','{TRANSACTION_ID}','{BUSINESS_NAME}','{USER_NAME}','{USER_PHONE}','{USER_EMAIL}','{NOTE}','{DELIVERY_TYPE}','{PICKUP_DETAILS}','{ADDESS_LINE}','{CITY_NAME}','{STATE_NAME}','{PAYMENT_TYPE}','{SETTING_TAX}','{TAX}','{ORDER_DETAILS}','{TOTAL_PRICE}','{TOTAL_AMOUNT}'),
array($order_master->id,
$order_master->transaction_id,
$order_master->user->business_name,
$order_master->user->first_name.' '.$order_master->user->last_name,
$order_master->user->phone,
$order_master->user->email,
$order_master->note,
$delivery_type,
$pickup,
$addess_line,
$city,$state,
$order_type,
$order_master->tax,
$tax,$order,
$order_master->total_price,
number_format($order_master->total_price + $order_master->tax,2)
),
$msg);
@endphp

{!! $str !!}