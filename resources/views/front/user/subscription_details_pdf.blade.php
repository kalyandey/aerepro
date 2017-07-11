<!DOCTYPE html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Subscription Invoice</title>
</head>
<body><table border="0"  cellspacing="0" cellpadding="0" width="100%" letter-spacing: 0.5px; ">
<tr><td border="0" colspan="2" style="line-height:10px; height:10px;background-color:#D3CDCD; border-top:2px solid #D3CDCD; border-bottom:2px solid #D3CDCD;">&nbsp;</td></tr>
<tr><td border="0" colspan="2" align="left" style="background-color:#D3CDCD; border-top:2px solid #D3CDCD; border-bottom:2px solid #D3CDCD; padding-left:20px;"><img src="{{asset('images/logo.png')}}" style="width:230px; border:0;"></td></tr>
 <tr><td border="0" colspan="2" style="line-height:10px; height:10px;background-color:#D3CDCD; border-top:2px solid #D3CDCD; border-bottom:2px solid #D3CDCD;">&nbsp;</td></tr>
    <tr>
        <td border="0" style="background-color:#fff; width:100%;">
            <table border="0" cellspacing="0" cellpadding="0" style="background-color:#fff; letter-spacing: 0.5px;">
            <tr><td border="0"  style="line-height:30px; height:30px;">&nbsp;</td></tr>
                
                <tr><td border="0"  style="font-family:arial, sans-serif; font-size:25px; line-height:25px; height:25px; color:#cd092b;" colspan="3">DETAILS</td></tr>
             <tr><td border="0"  style="line-height:30px; height:30px;">&nbsp;</td></tr>   
                <tr>
                
                    <td border="0" style="font-family:arial, sans-serif; font-size:14px; line-height:14px; height:14px;"><b>Name:</b></td>
                    <td border="0" style="font-family:arial, sans-serif; font-size:14px; line-height:14px; height:14px;">{{$user_payment_details->user->first_name.' '.$user_payment_details->user->last_name}}</td>
                       
                </tr>
                <tr><td border="0" style="line-height:10px; height:10px;">&nbsp;</td></tr>
                <tr>
                
                    <td border="0" style="font-family:arial, sans-serif; font-size:14px; line-height:14px; height:14px;"><b>Email:</b></td>
                    <td border="0" style="font-family:arial, sans-serif; font-size:14px; line-height:14px; height:14px;">{{$user_payment_details->user->email}}</td>
                     
                </tr>
		 <tr><td border="0" style="line-height:10px; height:10px;">&nbsp;</td></tr> 
		<tr>
                
                    <td border="0" style="font-family:arial, sans-serif; font-size:14px; line-height:14px; height:14px;"><b>Business Name:</b></td>
                    <td border="0" style="font-family:arial, sans-serif; font-size:14px; line-height:14px; height:14px;">{{$user_payment_details->user->business_name}}</td>
                     
                </tr>
		
                <tr><td border="0" style="line-height:10px; height:10px;">&nbsp;</td></tr>
                <tr>
               
                    <td border="0" style="font-family:arial, sans-serif; font-size:14px; line-height:14px; height:14px;"><b>Address:</b></td>
			
                    <td border="0" style="font-family:arial, sans-serif; font-size:14px; line-height:14px; height:14px;">
		    
		    
		        {!! ($user_payment_details->user->addess_line1 != '')?$user_payment_details->user->addess_line1.',':'' !!}
                        {!! ($user_payment_details->user->addess_line2 != '')?$user_payment_details->user->addess_line2.',':'' !!}
                        {!! ($user_payment_details->user->city != '')?$user_payment_details->user->city.',':'' !!}
                        
                        {!! ((count($user_payment_details->user->state) > 0) && $user_payment_details->user->state_name != '')?$user_payment_details->user->state_name->state.',':'' !!}
			
			
                        {!! ($user_payment_details->user->zip != '')?$user_payment_details->user->zip:'' !!}
		    
		</td>
                    
                </tr>
                <tr><td border="0" style="line-height:10px; height:10px;">&nbsp;</td></tr>
                <tr>
               
                    <td border="0" style="font-family:arial, sans-serif; font-size:14px; line-height:14px; height:14px;"><b>Payment Date: </b></td>
                    <td border="0" style="font-family:arial, sans-serif; font-size:14px; line-height:14px; height:14px;">{{date('m-d-Y',strtotime($user_payment_details->created_at))}}</td>
                 
                </tr>
                <tr><td border="0" style="line-height:10px; height:10px;">&nbsp;</td></tr>
            </table>
        </td>
    </tr>
        
        <tr><td border="0"  style="line-height:30px; height:30px;">&nbsp;</td></tr>
                
                <tr><td border="0"  style="font-family:arial, sans-serif; font-size:20px; line-height:20px; height:20px; color:#cd092b;" colspan="3">SUBSCRIPTION DETAILS</td></tr>
             <tr><td border="0"  style="line-height:10px; height:10px;">&nbsp;</td></tr>   
        
        <tr>
            <td style="background-color:#f5f5f5; width:100%;" colspan="2">
                		<table border="0" cellspacing="0" cellpadding="0"  style="background-color:#f5f5f5; letter-spacing: 0.5px; width:100%; text-align:center;">
						<thead style="background-color:#D3CDCD;">
                        <tr><th style="line-height:5px;background-color:#D3CDCD; height:5px;" colspan="5">&nbsp;</th></tr>
						<tr>
						
                           
						    <th style="font-family:arial, sans-serif; font-size:15px; line-height:15px; height:15px; color:161515; border:0; outline:0; text-align:left;background-color:#D3CDCD; border-top:2px solid #D3CDCD; border-bottom:2px solid #D3CDCD; border-right:2px solid #D3CDCD; padding-left:5px; padding:6px 8px;">Subscription Title</th>
							
                                <th style="font-family:arial, sans-serif; font-size:15px; line-height:15px; height:15px; color:#161515; border:0; outline:0; text-align:left;background-color:#D3CDCD; border-top:2px solid #D3CDCD; border-bottom:2px solid #D3CDCD; border-right:2px solid #D3CDCD; padding-left:5px; padding:6px 8px;">Subscription Type</th>
				    
				    
				    <th style="font-family:arial, sans-serif; font-size:15px; line-height:15px; height:15px; color:#161515; border:0; outline:0; text-align:left;background-color:#D3CDCD; border-top:2px solid #D3CDCD; border-bottom:2px solid #D3CDCD; border-right:2px solid #D3CDCD; padding-left:5px; padding:6px 8px;">Total Amount</th>
					
				    
				    <th style="font-family:arial, sans-serif; font-size:15px; line-height:15px; height:15px; color:#161515; border:0; outline:0; text-align:left;background-color:#D3CDCD; border-top:2px solid #D3CDCD; border-bottom:2px solid #D3CDCD; border-right:2px solid #D3CDCD; padding-left:5px; padding:6px 8px;">Type</th>
				    
				    
				   <th style="font-family:arial, sans-serif; font-size:15px; line-height:15px; height:15px; color:#161515; border:0; outline:0; text-align:left;background-color:#D3CDCD; border-top:2px solid #D3CDCD; border-bottom:2px solid #D3CDCD; border-right:2px solid #D3CDCD; padding-left:5px; padding:6px 8px;">Expiry Date</th>
						</tr>
                            <tr><th style="line-height:5px;background-color:#D3CDCD; height:5px;" colspan="5">&nbsp;</th></tr>
						</thead>
                        <tbody style="background:#fff;">
                       
                                                             

                        <tr>                           
						    <td style="font-family:arial, sans-serif; font-size:14px; line-height:15px; height:15px; text-align:left; background-color:#eee; border-right:1px solid #ccc; border-bottom:1px solid #ccc; border-left:1px solid #ccc; padding:6px 8px;">{{$user_payment_details->subscription->subscription_title}}</td>
						    <td style="font-family:arial, sans-serif; font-size:14px; line-height:15px; height:15px;text-align:left; background-color:#eee;border-right:1px solid #ccc; border-bottom:1px solid #ccc; padding:6px 8px;">{{$user_payment_details->subscription_type}}</td>
						
			
			<td style="font-family:arial, sans-serif; font-size:14px; line-height:15px; height:15px;text-align:left; background-color:#eee;border-right:1px solid #ccc; border-bottom:1px solid #ccc; padding:6px 8px;">${{ number_format($user_payment_details->total_amount,2) }}</td>
			    
			
			<td style="font-family:arial, sans-serif; font-size:14px; line-height:15px; height:15px;text-align:left; background-color:#eee;border-right:1px solid #ccc; border-bottom:1px solid #ccc; padding:6px 8px;"> {{$user_payment_details->type}}</td>
			    
			    
			<td style="font-family:arial, sans-serif; font-size:14px; line-height:15px; height:15px;text-align:left; background-color:#eee;border-right:1px solid #ccc; border-bottom:1px solid #ccc; padding:6px 8px;">
			
			                @php
                                        $exp = \App\User_subscription::where('subscription_id',$user_payment_details->subscription_id)->where('user_id',$user_payment_details->user_id)->first();
                                        @endphp
                                        {{date('m-d-Y',strtotime($exp->end_date))}}
			
			
			</td>
			</tr>
                            
                            
                            
                            

                                                  
                           
                        </tbody>
		</table>
            </td>
        </tr>
            <tr>
                <td style="line-height:30px;background-color:#fff; height:30px;" colspan="5"></td>
            </tr>
                
                
            </table>
       
            </tr>
                
                
</table></body>