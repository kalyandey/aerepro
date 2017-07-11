      <div class="popup_sec">
    <div class="popup_inner">
      <span class="close_button"><img src="{{asset('images/close.png')}}" alt="no img"></span>
      <div class="popup_box clear">
	<div class="popup_top clear">
	  {!! Form::open(array('route'=>array('building_report_print'),'class'=>'table_chkbox2')) !!} 
                <input type="hidden" name="report[]" value="{{$details->id}}">
                <span class="print"><a class="" href="javascript:void(0);" id="report_jobs" onclick="$(this).closest('form').submit();"><img src="{{asset('images/icon2.png')}}" alt="no img"></a></span>
            {!! Form::close() !!} 
	  <div class="pop_top building_top">
	    <ul>
	      <li>{!! $details->permit !!}</li>
	      <li>{!! (count($details->permit_type))?$details->permit_type->name:'' !!}</li>
	    </ul>
	  </div>
	</div>
	<div id="horizontalTab">
            <ul class="resp-tabs-list">
              <li>Details</li>
              <li>General Contractors</li>
              <li>Property Owner</li>
              <li>Permits</li>
            </ul>
            <div class="resp-tabs-container">
                <div class="tab_box_in clear">
		  <div class="clear">
                    <div class="tab_left">
			@php
                        $issued_date = explode('-',$details->issued_date);
                        $issued_date = $issued_date[1].'/'.$issued_date[2].'/'.$issued_date[0];
                        @endphp
		      <p>
		      <strong>Date Issued :</strong>{!! $issued_date !!}<br>
		      <strong>Date Posted :</strong> {!! date('m/d/Y',strtotime($details->created_at)) !!}<br>
		      <strong>Jurisdiction :</strong> {!! $details->jurisdictions->name !!} <br>
		      <strong>Permit Type :</strong> {!! $details->permit_type_id !!}<br>
		      <strong>Address :</strong> {!! $details->address !!}<br>
		      <strong>City :</strong> {!! $details->city_id !!}<br>
		      <strong>State :</strong> {!! $details->state->state !!}<br>
                      <strong>Zip :</strong> {!! $details->zip !!}<br>
		      <strong>Sq Ft:  :</strong> {!! $details->sqft !!}<br>
		      <strong>Valuation :</strong> ${!! $details->valuation !!}<br>
		      <strong>Permit # :</strong> {!! $details->permit !!}<br>
		      <strong>Parcel # :</strong> {!! $details->parcel !!}<br>
		      <strong>Subdivision :</strong> {!! $details->subdivision !!}<br>
		      <strong>Lot # :</strong> {!! $details->lot !!}<br>
		      </p>
		    </div>
		  </div>
                </div>
                <div class="tab_box_in clear">
                    <p>
		    <strong>Business Name :</strong>{!! (count($details->contractor)>0)?$details->contractor->business_name:'N/A' !!}<br>
		    <strong>Contact Name :</strong>{!! (count($details->contractor)>0)?$details->contractor->name:'N/A' !!}<br>
		    <strong>Street :</strong>{!! (count($details->contractor)>0)?$details->contractor->street:'N/A' !!}<br>
		    <strong>City :</strong>{!! (count($details->contractor)>0)?$details->contractor->city:'N/A' !!}<br>
		    <strong>State :</strong>{!! (count($details->contractor)>0 && count($details->contractor->state_name) > 0)?$details->contractor->state_name->state:'N/A' !!}<br>
		    <strong>Zip :</strong>{!! (count($details->contractor)>0)?$details->contractor->zip:'N/A' !!}<br>
		    <strong>Phone :</strong>{!! (count($details->contractor)>0)?$details->contractor->phone:'N/A' !!}<br>
		    <strong>Fax :</strong>{!! (count($details->contractor)>0)?$details->contractor->fax:'N/A' !!}<br>
		    <strong>Email :</strong>{!! (count($details->contractor)>0)?$details->contractor->email:'N/A' !!}<br>
		    </p>
                </div>
                <div class="tab_box_in clear">
                    <p>
		      <strong>Owner Name :</strong>{!! (count($details->permit_owner)>0)?$details->permit_owner->owner_name:'N/A' !!}<br>
		      <strong>Owner Address :</strong>{!! (count($details->permit_owner)>0)?$details->permit_owner->owner_address:'N/A' !!}<br>
		      <strong>Owner City :</strong>{!! (count($details->permit_owner)>0)?$details->permit_owner->owner_city_id:'N/A' !!}<br>
		      <strong>Owner State :</strong>{!! (count($details->permit_owner)>0)?$details->permit_owner->state->state:'N/A' !!}<br>
		      <strong>Owner Zip :</strong>{!! (count($details->permit_owner)>0)?$details->permit_owner->owner_zip:'N/A' !!}<br>
		      <strong>Owner Phone :</strong>{!! (count($details->permit_owner)>0)?$details->permit_owner->owner_phone:'N/A' !!}<br>
		    </p>
                </div>
                <div class="tab_box_in clear">
		    <div>
		    <div><strong>Building Report : </strong></div>
		    @if(count($details->permit_file) > 0)
		      <strong>{{$details->permit_file[0]->permit_name}}</strong>
		      <span>Building Report</span>
		      <span>
			@if(Helpers::isFileExist('uploads/permit_pdf/'.$details->permit_file[0]->permit_pdf) && $details->permit_file[0]->permit_pdf != '')
			    <a target="_blank" href="{{Helpers::isFileExist('uploads/permit_pdf/'.$details->permit_file[0]->permit_pdf)}}">
			    <span class="download">Download</span></a>
			@endif
		      </span>
			
		    @else
		      <span>No record found</span>
		    @endif
		    </div>
		</div>
            </div>
        </div>
      </div>
    </div>
  </div>
