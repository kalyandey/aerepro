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
<table width="900" cellspacing="5" cellpadding="5" style="font-family:helvetica,sans serif;  background:#fff;padding:50px 10px 15px; border-bottom:3px solid #e1e1e1;" align="center">
                <tbody>
		    <tr>
			<td valign="top" colspan="2">
			<h3 style="text-transform:uppercase; color:#cf0a2c;">Details</h3>
			<span><strong>Name: </strong>{!! $user->first_name.' '.$user->last_name !!}</span>
			<span><strong>Email: </strong>{!! $user->email !!}</span>
			<span><strong>Address: </strong>
			    {!! ($user->addess_line1 != '')?$user->addess_line1.',<br>':'' !!}
			    {!! ($user->addess_line2 != '')?$user->addess_line2.',<br>':'' !!}
			    {!! ($user->city != '')?$user->city:'' !!}
			    {!! (($user->city != '') && (count($user->state_name)>0))?',':'' !!}
			    {!! (($user->state != '') && (count($user->state_name)>0))?$user->state_name->state:'' !!}
			    {!! (($user->zip != '') && (count($user->state_name)>0))?',':'' !!}
			    {!! ($user->zip != '')?','.$user->zip:'' !!}
			</span>
			<span><strong>subscription Id</strong>{!! $user->pay[0]->subscriptionId !!}</span>
			<span><strong>Last Payment Date</strong>{!! date('Y-m-d',strtotime($user->pay[0]->created_at)) !!}</span>
			</td>
		    </tr>
		    <tr>
		    <td valign="top" colspan="2">
		    <h3 style="text-transform:uppercase; color:#cf0a2c;">Subscription Details</h3>
		    <table cellspacing="0" width="100%" style="text-align: left">
			<thead>
			    <tr>
				<th style="width:40%; border:1px solid #f5f5f5; padding:10px; color:#333;">Item</th>
				<th style="width:30%; border:1px solid #f5f5f5; padding:10px; color:#333;">PRICE</th>
				<th style="width:30%; border:1px solid #f5f5f5; padding:10px; color:#333;">subscription Id</th>
			    </tr>
			</thead>        
			<tbody id="the-list">
			    @if(count($user->pay) > 0)
			    @php $totalAmount = 0; @endphp
			    @foreach($user->pay()->where('type','subscription')->get() AS $pay)
				<tr valign="top">
				    @php
				    $sublist = \App\Subscription::find($pay->subscription_id);
				    @endphp
				    <td style="border-bottom:1px solid #999;text-align: left">{{ $sublist->subscription_title }}</td>
				    @if($pay->subscription_type == 'quarterly')
				    @php $totalAmount = $sublist->quarterly_price; @endphp
				    <td style="border-bottom:1px solid #999;text-align: left">${{ $sublist->quarterly_price }}</td>
				    @else
				    @php $totalAmount = $sublist->yearly_price; @endphp
				    <td style="border-bottom:1px solid #999;text-align: left">${{ $sublist->yearly_price }}</td>
				    @endif
				    <td style="border-bottom:1px solid #999;text-align: left">{{$pay->subscriptionId}}</td>
				</tr>
			    @endforeach
			    @endif
			    <tr>
				<td style="border-bottom:1px solid #999;text-align: left"><b>Total Amount</b></td><td style="border-bottom:1px solid #999;text-align: left" colspan="2">${!! $totalAmount !!}</td>
			    </tr>
			</tbody>
			</table>
		     </td>
		    </tr>
                </td>
            </tr>
        </tbody>
    </table>      
</div>