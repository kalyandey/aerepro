      <div class="popup_sec">
         <div class="popup_inner popup_inner1">
            <div class="popIn">
            <div class="popTop clear">
               <div class="popHdng alignleft">
                  {!! $details->project_id !!} | {!! $details->project_name !!}
               </div>
               <div class="popIcon alignright">
                  <a href="{{URL::route('private_project_print',[$details->id])}}" target="_blank"><img src="{{asset('images/prnt1.png') }}" alt="no img"></a>
                  <span class="popupClose"><img src="{{asset('images/cls.png') }}" alt="no img"></span>
               </div>
            </div>
            <div id="horizontalTab">
               <ul class="resp-tabs-list clear">
                  <li>Job Details</li>
                  <li>Job PLANS</li>
                  <li>Specs</li>
               </ul>
               <div class="resp-tabs-container">
                  <div class="tab_box_in clear">
                     <div class="proDtl alignleft">
                        <div class="bidDtTm">
                           <div class="bidDt">
                              <b>Bid Close Date:</b> 
                              @php $close_date = explode('-',$details->close_date) @endphp
                              {!! $close_date[1].'/'.$close_date[2].'/'.$close_date[0] !!}
                           </div>
                           <div class="bidtm">
                              <b>Time Due:</b> 
                              {!! date('h:i A',strtotime($details->close_date)) !!}
                           </div>
                        </div>
                        <div class="preBid">
                           <span>Pre-Bid Meeting Date :
                              @php $prebid_meeting_date = explode('-',$details->prebid_meeting_date) @endphp
                              {!! $prebid_meeting_date[1].'/'.$prebid_meeting_date[2].'/'.$prebid_meeting_date[0] !!}</span>  
                           <span>Pre-Bid Meeting Time :{!! date('h:i A',strtotime($details->prebid_meeting_time)) !!}</span>
                        </div>
                        <div class="proLo">
                           Project Location : {!! $details->location !!}
                        </div>
                        <div class="JbDes">
                           Job Description : {!! $details->description !!}
                        </div>
                     </div>
                     <div class="conDtl alignright">
                        <span> <b>Contact Name :</b>  {!! $details->company->first_name.' '.$details->company->last_name !!}</span>
                        <span><b>Contact Phone :</b> {!! $details->company->phone_no !!}</span>
                     </div>
                  </div>
                  <div class="tab_box_in clear">
                    <em>Click the check boxes to select multiple pages</em>
                    <div class="cart_success" style="color:green;display:none"><b>Cart added successfully!</b></div>
                  <div class="table_bot clear plan_info">
                  <form class="table_chkbox2">
                     <table id="no-more-tables" class="res-table2 tbl1">
                        <thead>
                           <tr>
                              <th class="numeric"><input type="checkbox" id="select_all_plan"></th>
                              <th class="numeric">View</th>
                              <th class="numeric">Project Name</th>
                              <th class="numeric">Divison</th>
                           </tr>
                        </thead>
                        <tbody>
                           @if(count($details->plan)>0)
                              @foreach($details->plan as $k=>$plan)
                              <tr {{(($k%2) == 0)?"class='l-clck'":''}} >
                                 <td data-title=""><input type="checkbox" class="private_plan_check" value="{!! $plan->id !!}"></td>
                                 <td data-title="View">
                                 @if(Helpers::isFileExist('uploads/private_planroom/plan/'.$plan->file_name) && $plan->file_name != '')
                                    <a target="_blank" href="{{Helpers::isFileExist('uploads/private_planroom/plan/'.$plan->file_name)}}"><img src="{{asset('images/srch.png')}}" alt="no img"></a>
                                 @endif
                                 </td>
                                 <td data-title="Project Name" class="numeric">
                                    {!! $plan->plan_name !!}
                                 </td>
                                 <td data-title="County">
                                    
                                    <div class="{!! $plan->plan_category->name !!}">{!! $plan->plan_category->name !!}</div>
                                    @if(Helpers::isFileExist('uploads/private_planroom/plan/'.$plan->file_name) && $plan->file_name != '')
                                    <div class="dwnld"><a target="_blank" href="{{Helpers::isFileExist('uploads/private_planroom/plan/'.$plan->file_name)}}">Download</a></div>
                                    @endif
                                 </td>
                                
                              </tr>
                              @endforeach
                           @endif
                     </table>
                  </form>
                     <div id="privatejob_cart" style="display:none;">
                        <div class="docLeft">
                        <h4><span class="total_document"></span> documents selected</h4>
                        <p>Select the method of delivery for the selected documents: </p>
                        </div>
                        <div class="docRight">
                        <div>Order Type:
                        <select id="addtocart_papersize">
                          <option value="">Select</option>
                          <option value="full_size">Full Size</option>
                          <option value="half_size">Half Size</option>
                        </select>
                        </div>
                        <div id="addCartButton" style="display: none;">
                        {!! Form::button('Add to cart',array('id'=> 'addToCartPrivatePlan')) !!}
                        </div>
                        </div>
                        
                    </div> 
                  </div>

                  </div>
                  <div class="tab_box_in clear">
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
                             <h6>{!! $k !!}</h6>
                              <ul>
                             @foreach($spec as $i=>$s)
                                 <li>
                                    <div class="no">
                                    @if(($i + 1)< 10)
                                       {!! '00'.($i+1) !!}
                                    @elseif((($i + 1) > 10) && (($i + 1)< 100))
                                       {!! '0'.($i+1) !!}
                                    @else
                                       {!! ($i+1) !!}
                                    @endif
                                    </div>
                                    <div class="proName">{!! $s->name !!}</div>
                                    <div class="specCategory">{!! $k !!}</div>
                                    
                                    @if(Helpers::isFileExist('uploads/private_planroom/specs/'.$s->file_name) && $s->file_name != '')
                                    <div class="dwnld">
                                    <a target="_blank" href="{{Helpers::isFileExist('uploads/private_planroom/specs/'.$s->file_name)}}">Download</a>
                                    </div>
                                    @endif
                                 </li>
                             @endforeach
                              </ul>
                         @endforeach
                     @else
                       <p>Record not found</p>
                     @endif
                  </div>
               </div>
            </div>
         </div>
         </div>
         
      </div>
