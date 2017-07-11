<table border="0"  cellspacing="0" cellpadding="0" width="100%" letter-spacing: 0.5px; ">
<tr><td border="0" colspan="2" style="line-height:10px; height:10px;background-color:#10367f; border-top:2px solid #10367f; border-bottom:2px solid #10367f;">&nbsp;</td></tr>
<tr><td border="0" colspan="2" align="left" style="background-color:#10367f; border-top:2px solid #10367f; border-bottom:2px solid #10367f; padding-left:20px;"><img src="{{asset('images/logo.png')}}" style="width:230px; border:0;"></td></tr>
 <tr><td border="0" colspan="2" style="line-height:10px; height:10px;background-color:#10367f; border-top:2px solid #10367f; border-bottom:2px solid #10367f;">&nbsp;</td></tr>
    <tr>
        <td border="0" style="background-color:#fff; width:100%;">
            <table border="0" cellspacing="0" cellpadding="0" style="background-color:#fff; letter-spacing: 0.5px;">
            <tr><td border="0"  style="line-height:30px; height:30px;">&nbsp;</td></tr>
                
                <tr><td border="0"  style="font-family:arial, sans-serif; font-size:25px; line-height:25px; height:25px; color:#cd092b;" colspan="3">DETAILS</td></tr>
             <tr><td border="0"  style="line-height:30px; height:30px;">&nbsp;</td></tr>   
                <tr>
                
                    <td border="0" style="font-family:arial, sans-serif; font-size:14px; line-height:14px; height:14px;"><b>Name:</b></td>
                    <td border="0" style="font-family:arial, sans-serif; font-size:14px; line-height:14px; height:14px;">{!! $sub[0]->user->first_name.' '.$sub[0]->user->last_name !!}</td>
                       
                </tr>
                <tr><td border="0" style="line-height:10px; height:10px;">&nbsp;</td></tr>
                <tr>
                
                    <td border="0" style="font-family:arial, sans-serif; font-size:14px; line-height:14px; height:14px;"><b>Business Name::</b></td>
                    <td border="0" style="font-family:arial, sans-serif; font-size:14px; line-height:14px; height:14px;">{!! $sub[0]->user->business_name !!}</td>
                     
                </tr>
		
		 <tr><td border="0" style="line-height:10px; height:10px;">&nbsp;</td></tr>
		<tr>
                
                    <td border="0" style="font-family:arial, sans-serif; font-size:14px; line-height:14px; height:14px;"><b>Email:</b></td>
                    <td border="0" style="font-family:arial, sans-serif; font-size:14px; line-height:14px; height:14px;">{!! $sub[0]->user->email !!}</td>
                     
                </tr>
		
		
		
		
		
		
                <tr><td border="0" style="line-height:10px; height:10px;">&nbsp;</td></tr>
                <tr>
               
                    <td border="0" style="font-family:arial, sans-serif; font-size:14px; line-height:14px; height:14px;"><b>Address:</b></td>
                    <td border="0" style="font-family:arial, sans-serif; font-size:14px; line-height:14px; height:14px;">
                        {!! ($sub[0]->user->addess_line1 != '')?$sub[0]->user->addess_line1.',<br>':'' !!}
                        {!! ($sub[0]->user->addess_line2 != '')?$sub[0]->user->addess_line2.',<br>':'' !!}
                        {!! ($sub[0]->user->city != '')?$sub[0]->user->city:'' !!}
                        {!! (($sub[0]->user->city != '') && (count($sub[0]->user->state_name)>0))?',':'' !!}
                        {!! (($sub[0]->user->state != '') && (count($sub[0]->user->state_name)>0))?$sub[0]->user->state_name->state:'' !!}
                        {!! (($sub[0]->user->zip != '') && (count($sub[0]->user->state_name)>0))?',':'' !!}
                        {!! ($sub[0]->user->zip != '')?','.$sub[0]->user->zip:'' !!}
                    </td>
                    
                </tr>
                <tr><td border="0" style="line-height:10px; height:10px;">&nbsp;</td></tr>
                <tr>
               
                    <td border="0" style="font-family:arial, sans-serif; font-size:14px; line-height:14px; height:14px;"><b>Last Payment Date:</b></td>
                    <td border="0" style="font-family:arial, sans-serif; font-size:14px; line-height:14px; height:14px;">{!! date('m-d-Y',strtotime($sub[0]->created_at)) !!}</td>
                 
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
			    <thead style="background-color:#10367f;">
                                <tr><th style="line-height:5px;background-color:#10367f; height:5px;" colspan="3">&nbsp;</th></tr>
				<tr>
				<th style="font-family:arial, sans-serif; font-size:15px; line-height:15px; height:15px; color:#fff; border:0; outline:0; text-align:left;background-color:#10367f; border-top:2px solid #10367f; border-bottom:2px solid #10367f; border-right:2px solid #10367f; padding-left:5px; padding:6px 8px;">ITEM</th>
                                <th style="font-family:arial, sans-serif; font-size:15px; line-height:15px; height:15px; color:#fff; border:0; outline:0; text-align:left;background-color:#10367f; border-top:2px solid #10367f; border-bottom:2px solid #10367f; border-right:2px solid #10367f; padding-left:5px; padding:6px 8px;">PRICE</th>
                                <th style="font-family:arial, sans-serif; font-size:15px; line-height:15px; height:15px; color:#fff; border:0; outline:0; text-align:left;background-color:#10367f; border-top:2px solid #10367f; border-bottom:2px solid #10367f; border-right:2px solid #10367f; padding-left:5px; padding:6px 8px;">Expire Date</th>   
				</tr>
                                <tr><th style="line-height:5px;background-color:#10367f; height:5px;" colspan="3">&nbsp;</th></tr>
			    </thead>
                            <tbody style="background:#fff;">
                                @if(count($sub) > 0)
                                @php $totalAmount = 0; @endphp
                                @foreach($sub AS $pay)
                                <tr>
                                    @php
                                    $sublist = \App\Subscription::find($pay->subscription_id);
                                    @endphp
                                    <td style="font-family:arial, sans-serif; font-size:14px; line-height:15px; height:15px; text-align:left; background-color:#eee; border-right:1px solid #ccc; border-bottom:1px solid #ccc; border-left:1px solid #ccc; padding:6px 8px;">{{ $sublist->subscription_title }}</td>
                                    @if($pay->subscription_type == 'quarterly')
                                        @php $totalAmount += $sublist->quarterly_price; @endphp
                                        <td style="font-family:arial, sans-serif; font-size:14px; line-height:15px; height:15px;text-align:left; background-color:#eee;border-right:1px solid #ccc; border-bottom:1px solid #ccc; padding:6px 8px;"> ${{ $sublist->quarterly_price }}</td>   
                                    @else
                                        @php $totalAmount += $sublist->yearly_price; @endphp
                                        <td style="font-family:arial, sans-serif; font-size:14px; line-height:15px; height:15px;text-align:left; background-color:#eee;border-right:1px solid #ccc; border-bottom:1px solid #ccc; padding:6px 8px;"> ${{ $sublist->yearly_price }}</td>
                                    @endif
                                    <td style="font-family:arial, sans-serif; font-size:14px; line-height:15px; height:15px;text-align:left; background-color:#eee;border-right:1px solid #ccc; border-bottom:1px solid #ccc; padding:6px 8px;">
                                        @php
                                        $exp = \App\User_subscription::where('subscription_id',$pay->subscription_id)->where('user_id',$pay->user_id)->first();
                                        @endphp
                                        {{date('m-d-Y',strtotime($exp->end_date))}}
                                    </td>
                                    
				</tr>
                                @endforeach
                                @endif
                                <tr>                           
                                    <td style="font-family:arial, sans-serif; font-size:14px; line-height:15px; height:15px; text-align:left; background-color:#eee; border-right:1px solid #ccc; border-bottom:1px solid #ccc; border-left:1px solid #ccc; padding:6px 8px;"><b>Total Amount</b></td>
                                    <td style="font-family:arial, sans-serif; font-size:14px; line-height:15px; height:15px;text-align:left; background-color:#eee;border-right:1px solid #ccc; border-bottom:1px solid #ccc; padding:6px 8px;" colspan="2">${!! number_format($totalAmount,2) !!}</td>
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
</table>