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
	      <li>Project ID : <span>{!! $details->project_id !!}</span></li>
	      <li>Crack Sealing - <span>{!! $details->county->name !!}</span></li>
	    </ul>
	  </div>
	</div>
	<div id="horizontalTab">
            <ul class="resp-tabs-list">
              <li>Details</li>
              <li>Awarded To</li>
              <li>Address/Principal</li>
              <li>Plans</li>
              <li>Specs</li>
              <li>Bidder List</li>
            </ul>
            <div class="resp-tabs-container">
                <div class="tab_box_in clear">
		  <div class="clear">
                    <div class="tab_left">
		      <p><strong>Status :</strong> <span class="green">{!! $details->status !!}</span></p>
		      <p><strong>Category :</strong> {!! $details->category->name !!}<br> <strong>Bid Close Date :</strong>
                        @php
                        $bid_close_date = explode('-',$details->bid_close_date);
                        $bid_close_date = $bid_close_date[1].'/'.$bid_close_date[2].'/'.$bid_close_date[0];
                        @endphp
                        {!! $bid_close_date !!}
                        <br> <strong>Time Due :</strong> {!! date('h:i A',strtotime($details->time_due)) !!}</p>
		      <p><strong>Type :</strong> {!! (count($details->type))?$details->type->name:'<span style="color:red">Not Available</span>'; !!} <br> <strong>Valuation :</strong> {!! $details->valuation !!}</p>
		      <p><strong>Description :</strong> {!! $details->description !!}</p>
		      <p><strong>Additional Comments :</strong> {!! $details->additional_comments !!}</p>
		    </div>
                    <div class="tab_right">
		      <p><strong>Trades Needed:</strong></p>
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
                <div class="tab_box_in clear">
                    <p>
		    @php
			$awarded_to_name = 'Not Awarded';
			if($details->awarded_to_contractor != ''){
				    $awarded_to_name = $details->awarded_contractor->name;
			}else if($details->awarded_to_bidder != ''){
				    $awarded_to_name = $details->awarded_bidder->contact;
			}
		    @endphp
		    {!! $awarded_to_name !!}</p>
                </div>
                <div class="tab_box_in clear">
		    <div class="planroomAddress">
		      <h2>Project Principal:</h2>
		      <div class="tab-box-hold">
			<p><strong>Principal Company :</strong> {!! $details->company[0]->company_name !!}</p>
			<p><strong>Principal Name :</strong> {!! $details->company[0]->user_name !!}</p>
			<p><strong>Principal Address :</strong> {!! $details->company[0]->address !!}</p>
			<p><strong>Principal City :</strong> {!! $details->company[0]->city_name->city !!}</p>
			<p><strong>Principal State :</strong> {!! $details->company[0]->state_name->state !!}</p>
			<p><strong>Principal Zip :</strong> {!! $details->company[0]->zip !!}</p>
			<p><strong>Principal Phone :</strong> {!! $details->company[0]->phone !!}</p>
			<p><strong>Principal Fax :</strong> {!! $details->company[0]->fax !!}</p>
			<p><strong>Principal Email :</strong> {!! $details->company[0]->email !!}</p>
		      </div>
		    </div>
		    <div class="planroomAddress">
		      <h2>Project Details : </h2>
		      <div class="tab-box-hold">
			<p><strong>Street :</strong> {!! $details->street !!}</p>
			<p><strong>City :</strong> {!! $details->city_name->city !!}</p>
			<p><strong>State :</strong> {!! $details->state_name->state !!}</p>
			<p><strong>County :</strong> {!! $details->county->name !!}</p>
			<p><strong>Zip :</strong> {!! $details->zip !!}</p>
		      </div>
		    </div>
                </div>
                <div class="tab_box_in clear">
		<div class="tab-box-hold plan">
		    <p>* Click the checkboxes to select multiple pages.</p>
		    <div class="cart_success" style="color:green;display:none">Cart added successfully!</div>
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
                            <h3>{!! $k !!}</h3>
                            @foreach($plan as $p)
                                <div class="plan_view">
				{{Form::checkbox('plan_check',$p->id,'',array('class'=>'plan_check'))}}
                                <span>{!! $p->plan_name !!}</span>
                                <span>{!! $k !!}</span>
				  
				@if(Helpers::isFileExist('uploads/project/plan/'.$p->file_name) && $p->file_name != '')
                                <span class="view"><a target="_blank" href="{{Helpers::isFileExist('uploads/project/plan/'.$p->file_name)}}">View</a></span>
				@endif
                                
				</div>
                            @endforeach
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
			    <!--<option value="download">Download</option>-->
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
