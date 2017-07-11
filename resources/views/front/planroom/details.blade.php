  <div class="popup_sec">
    <div class="popup_inner planroom_popup">
      <span class="close_button"><img src="{{asset('images/close.png')}}" alt="no img"></span>
      <div class="popup_box clear">
	<div class="popup_top clear">
            {!! Form::open(array('route'=>array('project-print'),'class'=>'table_chkbox2')) !!} 
                <input type="hidden" name="project[]" value="{{$details->id}}">
                <span class="print"><a class="" href="javascript:void(0);" id="print_jobs" onclick="$(this).closest('form').submit();"><img src="{{asset('images/icon2.png')}}" alt="no img"></a></span>
            {!! Form::close() !!}  
	  
	  <div class="pop_top">
	    <ul>
	      <li>
                  @if($details->mandatory_pre_bidding == 'Yes')
                      <img src="{{asset('images/star2.png')}}" alt="no img">
		  @endif
                  Project ID : <span>{!! $details->project_id !!}</span></li>
	      <li>{!! (count($details->type))?$details->type->name:'<span style="color:red">Crack Sealing</span>'; !!} - <span>{!! (count($details->county) >0)?$details->county->name:'N/A'; !!}</span></li>
	    </ul>
	  </div>
	</div>
	<div id="horizontalTab">
            <ul class="resp-tabs-list">
              <li>Details</li>
	      @if($details->awarded_to_contractor != '' || $details->awarded_to_bidder != '' )
              <li>Awarded To</li>
	      @endif
              <li>Principal/Address</li>
	      <li>GC's</li>
              <li>Plans</li>
              <li>Specs</li>
              <li>Bidder List</li>
            </ul>
            <div class="resp-tabs-container">
                <div class="tab_box_in clear">
		  <div class="clear">
                    <div class="tab_left">
		      <p><strong>Status :</strong> <span class="green">{!! $details->status !!}</span></p>
		      <p><strong>Category :</strong> {!! (count($details->category)>0)?$details->category->name:'N/A' !!}<br> <strong>Bid Close Date :</strong>
                        @php
                        $bid_close_date = explode('-',$details->bid_close_date);
                        $bid_close_date = $bid_close_date[1].'/'.$bid_close_date[2].'/'.$bid_close_date[0];
                        @endphp
                        {!! $bid_close_date !!} {!! date('h:i A',strtotime($details->time_due)) !!}
                        <!--<br> <strong>Time Due :</strong> {!! date('h:i A',strtotime($details->time_due)) !!}-->
		      <br> <strong>PreBid Close Date :</strong>
			@if($details->pre_bid_meeting_date != '')
                        @php
                        $pre_bid_meeting_date = explode('-',$details->pre_bid_meeting_date);
                        $pre_bid_meeting_date = $pre_bid_meeting_date[1].'/'.$pre_bid_meeting_date[2].'/'.$pre_bid_meeting_date[0];
                        @endphp
                        {!! $pre_bid_meeting_date !!}
			{!! date('h:i A',strtotime($details->pre_bid_meeting_time)) !!}
		      @else
		       N/A
			@endif
		      </p>
		      <p><strong>Type :</strong> {!! (count($details->type))?$details->type->name:'<span style="color:red">Not Available</span>'; !!} <br> <strong>Valuation :</strong> {!! ($details->valuation != '')? $details->valuation : 'N/A' !!}</p>
		      <p><strong>Description :</strong> {!! ($details->description != '')?$details->description : 'N/A' !!}</p>
		      <p><strong>Additional Comments :</strong> {!! ($details->additional_comments != '')?$details->additional_comments:'N/A' !!}</p>
		    </div>
                    <div class="tab_right">
		      <p><strong>Trades Needed</strong></p>
		      @if($trades != '')
		      <p>{!! $trades->trade_name !!}</p>
		      @endif
		    </div>
		  </div>
		  <div class="track_project clear">
		    <span class="post_date">Date Posted : {{date('m/d/Y',strtotime($details->created_at))}}</span>
		    @if($page != 'saveTrack')
		    <a href="javascript:void(0);" class="track_button">{!! ($details->tracking()->where('user_id',Session::get('USER_DETAILS')->id)->count()>0)?'This Project is Tracked!':'Track This Project!'; !!}</a>
		    @endif
		  </div>
                </div>
		@if($details->awarded_to_contractor != '' || $details->awarded_to_bidder != '' )
                <div class="tab_box_in clear">
		    <div class="tab-box-hold">
		      @if($details->awarded_to_contractor != '')
			<p><strong>Business Name :</strong>
			  {!! ($details->awarded_contractor->business_name != '')?$details->awarded_contractor->business_name:'N/A' !!}</p>
			<p><strong>Contact Name :</strong>
			  {!! ($details->awarded_contractor->name != '')?$details->awarded_contractor->name:'N/A' !!}</p>
			
			<p><strong>Address :</strong> <br>{!! ($details->awarded_contractor->street != '')?$details->awarded_contractor->street.'<br>':'' !!}
			{!! ($details->awarded_contractor->city != 0)?$details->awarded_contractor->city.',':'' !!}
			{!! (count($details->awarded_contractor->state_name)>0)?$details->awarded_contractor->state_name->state:'' !!}
			{!! ($details->awarded_contractor->zip != '')?$details->awarded_contractor->zip:'' !!}
			</p>
			<p><strong>Phone :</strong>
			  {!! ($details->awarded_contractor->phone != '')?$details->awarded_contractor->phone:'N/A' !!}</p>
			<p><strong>Fax :</strong>
			  {!! ($details->awarded_contractor->fax != '')?$details->awarded_contractor->fax:'N/A' !!}</p>
			<p><strong>Email :</strong>
			  {!! ($details->awarded_contractor->email != '')?$details->awarded_contractor->email:'N/A' !!}</p>
			 
		      @elseif($details->awarded_to_bidder != '')
			<p><strong>Company Name :</strong>
			{!! ($details->awarded_bidder->company != '')?$details->awarded_bidder->company:'N/A' !!}</p>
			<p><strong>Contact Name :</strong>
			{!! ($details->awarded_bidder->contact != '')?$details->awarded_bidder->contact:'N/A' !!}</p>
			<p><strong>Address :</strong>
			  {!! ($details->awarded_bidder->address != '')?$details->awarded_bidder->address:'N/A' !!}</p>
			<p><strong>Phone :</strong>
			  {!! ($details->awarded_bidder->phone != '')?$details->awarded_bidder->phone:'N/A' !!}</p>
			<p><strong>Fax :</strong>
			  {!! ($details->awarded_bidder->fax != '')?$details->awarded_bidder->fax:'N/A' !!}</p>
			<p><strong>Email :</strong>
			  {!! ($details->awarded_bidder->email != '')?$details->awarded_bidder->email:'N/A' !!}</p>
		      @endif
		    </div>
                </div>
		@endif
                <div class="tab_box_in clear">
		    <div class="planroomAddress">
		      <h2>Project Principal:</h2>
		      <div class="tab-box-hold">
			<p><strong>Contact :</strong>
			  {!! ($details->company[0]->company_name != '')?$details->company[0]->company_name:'N/A' !!}</p>
			<p><strong>Name :</strong> {!! ($details->company[0]->user_name != '')?$details->company[0]->user_name:'N/A' !!}</p>
			<p><strong>Phone :</strong> {!! ($details->company[0]->phone != '')?$details->company[0]->phone:'N/A' !!}</p>
			<p><strong>Fax :</strong> {!! ($details->company[0]->fax != '')?$details->company[0]->fax:'N/A' !!}</p>
			<p><strong>Email :</strong> {!! ($details->company[0]->email != '')?$details->company[0]->email:'N/A' !!}</p>
			<p><strong>Address :</strong> <br>{!! ($details->company[0]->address != '')?$details->company[0]->address.'<br>':'' !!}
			{!! ($details->company[0]->city != '' )?$details->company[0]->city.',':'' !!}
			{!! (count($details->company[0]->state_name))?$details->company[0]->state_name->state:'' !!}
			{!! ($details->company[0]->zip != '')?$details->company[0]->zip:'' !!}
			</p>
			<!--<p><strong>City :</strong> {!! (count($details->company[0]->city_name))?$details->company[0]->city_name->city:'N/A' !!}</p>
			<p><strong>State :</strong> {!! (count($details->company[0]->state_name))?$details->company[0]->state_name->state:'N/A' !!}</p>
			<p><strong>Zip :</strong> {!! ($details->company[0]->zip != '')?$details->company[0]->zip:'N/A' !!}</p>-->
			
		      </div>
		    </div>
		    <div class="planroomAddress">
		      <h2>Project Address : </h2>
		      <div class="tab-box-hold">
			<p><strong>Location :</strong><br>
			{!! ($details->street != '')?$details->street.'<br>':'' !!}
			{!! (count($details->city)>0)?$details->city.',' :''!!}
			{!! (count($details->state_name)>0)?$details->state_name->state:'' !!}
			{!! ($details->zip != '')?$details->zip:'N/A' !!}
			</p>
			<!--<p><strong>Street :</strong> {!! ($details->street != '')?$details->street:'N/A' !!}</p>
			<p><strong>City :</strong> {!! (count($details->city_name)>0)?$details->city_name->city :'N/A'!!}</p>
			<p><strong>State :</strong> {!! (count($details->state_name)>0)?$details->state_name->state:'N/A' !!}</p>-->
			<p><strong>County :</strong> {!! (count($details->county)>0)?$details->county->name:'N/A' !!}</p>
			<!--<p><strong>Zip :</strong> {!! ($details->zip != '')?$details->zip:'N/A' !!}</p>-->
		      </div>
		    </div>
                </div>
                <div class="tab_box_in clear">
		  <div class="tab-box-table-hold">
		      <table class="tab-box-table" cellspacing="0">
			  <thead>
			      <tr>
				  <th>Business Name</th>
				  <th>Contact Name</th>
				  <th>Address</th>
				  <th>Phone</th>
				  <th>Fax</th>
				  <th>Email</th>
			      </tr>
			  </thead>        
			  <tbody id="the-list">
				@if(count($details->contractor_assign) > 0)
				  @foreach($details->contractor_assign as $cs)
                                  <tr>			
				      <td>{!! ($cs->contractor->business_name != '')?$cs->contractor->business_name:'N/A' !!}</td>	
				      <td>{!! ($cs->contractor->name != '')?$cs->contractor->name:'N/A' !!}</td>
				      <td>
				      {!! ($cs->contractor->street != '')?$cs->contractor->street.'<br>':'' !!}
				      {!! ($cs->contractor->city != '')?$cs->contractor->city.',':'' !!}
				      {!! (count($cs->contractor->state_name)>0)?$cs->contractor->state_name->state:'' !!}
				      {!! ($cs->contractor->zip != '')?$cs->contractor->zip:'' !!}
				      </td>
					
				      <td>{!! ($cs->contractor->phone != '')?$cs->contractor->phone:'N/A' !!}</td>
				      <td>{!! ($cs->contractor->fax != '')?$cs->contractor->fax:'N/A' !!}</td>
				      <td>{!! ($cs->contractor->email != '')?$cs->contractor->email:'N/A' !!}</td>
				  </tr>
				  @endforeach
				@else
				  <tr><td colspan="8">No record found</td></tr>
				@endif
				
			  </tbody>
		      </table>
		  </div>
		</div>
		<div class="tab_box_in clear">
		<div class="tab-box-hold plan">
		    <p>* Click the checkboxes to select multiple pages.</p>
			<p class="order-full-set-plans">{{Form::checkbox('all_plans_cat','','',array('class'=>'all_plans_cat'))}}
			<span>Order Full Set Of Plans</span></p>
		    <div class="cart_success" style="color:green;display:none"><b>Cart added successfully!</b></div>
                    @php
                        $planDtls = array();
                    @endphp
                    @if(count($details->plan)>0)
                        @foreach($details->plan as $plan)
                            @php
                            $planDtls[$plan->plan_category->name][] = $plan
                            @endphp
                        @endforeach
                    @endif
                    
                    @if(count($planDtls) > 0)
                        @foreach($planDtls as $k=>$plan)
			    <div class="checkPlanContainer">
                            <div class="check-plan-heading">
				<h3 class="category-Plan">{{Form::checkbox('plan_check_cat','','',array('class'=>'plan_check_cat'))}}<span>{!! $k !!}</span></h3>
				<span class="view-all-pdf-images" data-cat="{{ $plan[0]->cat_id }}" data-project="{{ $plan[0]->project_id }}">View All {!! $k !!}<img src="/images/search1.png" width="18" /></span>
			    </div>
                            @foreach($plan as $p)
                                <div class="plan_view {{ (($loop->index%2 == 0 )?'even':'odd') }}">
				<div class="col-1">
				{{Form::checkbox('plan_check',$p->id,'',array('class'=>'plan_check'))}}
                                <span>{!! $p->plan_name !!}</span>
				</div>
                                <span class="col-2">{!! $k !!}</span>
				@if(Helpers::isFileExist('uploads/project/plan/'.$p->file_name) && $p->file_name != '')
                                <span class="view view_plan_images col-3" data-plan-file-id="{{$p->id}}" >View</span>
				@endif
				</div>
                            @endforeach
			    </div>
                        @endforeach
		    @endif
		    
		        <div id="job_multiorder_cart" style="display: none;">
			  <div class="docLeft">
			  <h4><span class="total_document"></span> documents selected</h4>
			  <p>Select the method of delivery for the selected documents: </p>
			  </div>
			  <div class="docRight">
			  <div id="multiorder_document_sizes">Order Type:
			  <select class="addtocart_papersize_select" id="addtocart_papersize_multiselect">
			    <option value="">Select</option>
			    <!--<option value="full_set">Full Set</option>-->
			    <option value="download">Download</option>
			    <option value="full_size">Full Size</option>
			    <option value="half_size">Half Size</option>
			  </select>
			  </div>
			  <!--<p> * Downloads are only payable by Credit Card</p>-->
			  </div>
			  <div id="addCartButton" style="display: none;">
			  {!! Form::button('Add to cart',array('id'=> 'addToCart')) !!}
			  </div>
		      </div>      

                </div>
		</div>
                <div class="tab_box_in clear">
		<div class="tab-box-hold spec">
                    @php
                        $specsDtls = array();
                    @endphp
                    @if(count($details->specs)>0)
                        @foreach($details->specs as $specs)
                            @php
                            $specsDtls[$specs->specs_category->name][] = $specs
                            @endphp
                        @endforeach
                    @endif
                    
                    @if(count($specsDtls) > 0)
                        @foreach($specsDtls as $k=>$spec)
                            <h3>{!! $k !!}</h3>
                            @foreach($spec as $s)
                                <div>
                                <p>{!! $s->name !!}</p>
                                <p>{!! $k !!}</p>
                                @if(Helpers::isFileExist('uploads/project/specs/'.$s->file_name) && $s->file_name != '')
                                <a target="_blank" href="{{Helpers::isFileExist('uploads/project/specs/'.$s->file_name)}}"><img src="{{asset('images/pdf-icon.png')}}"></a>
                                @endif
                                </div>
                            @endforeach
                        @endforeach
		    @else
		      <p>Record not found</p>
                    @endif
		</div>
                </div>
                
                <div class="tab_box_in clear">
		<div class="tab-box-table-hold">
                    <table class="tab-box-table" cellspacing="0">
			<thead>
			    <tr>
				<th>Company</th>
						<th>Contact</th>
						<th>Address</th>
						<th>Phone</th>
						<th>Fax</th>
						<th>Email</th>
			    </tr>
			</thead>        
			<tbody id="the-list">
			      @php $k = 0 @endphp
			      @if(count($details->project_bidder) > 0)
				@foreach($details->project_bidder as $b)
				@if($b->bidder->status == 'Active')
				  @php $k = $k+1 @endphp
				<tr>			
				    <td>{!! $b->bidder->company !!}</td>	
				    <td>{!! $b->bidder->contact !!}</td>	
				    <td>{!! $b->bidder->address !!}</td>	
				    <td>{!! $b->bidder->phone !!}</td>	
				    <td>{!! $b->bidder->fax !!}</td>	
				    <td>{!! $b->bidder->email !!}</td>
				</tr>
				@endif
				@endforeach
			      @else
				@php $k = $k+1 @endphp
				<tr><td colspan="6">No record found</td></tr>
			      @endif
			      
			      @if($k == 0)
				<tr><td colspan="6">No record found</td></tr>
			      @endif
			</tbody>
		    </table>
                </div>
	    </div>
            </div>
        </div>
          
      </div>
      
    </div>
  </div>
    
    <section id="big-image-container" class="view-pdf-big-image-container">
	<div class="buttons">
        <button class="zoom-in"><img src="{{asset('images/zoom_in.png') }}"/></button>
        <button class="zoom-out"><img src="{{asset('images/zoom_out.png')}} "/></button>
        <input type="range" class="zoom-range" value="1" style="display:none">
        <!--<button class="reset">Reset</button>-->
      </div>
		
      <div class="parent clearfix">
        <div class="panzoom">
          <img src="">
        </div>
      </div>
      
    </section>
      
    <div class="view-pdf-container"></div>
