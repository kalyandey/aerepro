@extends('front.app')
@section('content')
   <script src="{{ asset('js/ckeditor/ckeditor.js') }}"></script>
	 <script type="text/javascript">
			$(document).ready(function(){
				 CKEDITOR.replace( 'email_content',
				 {
						//customConfig : 'config.js',
						toolbar : 'simple',
            enterMode : CKEDITOR.ENTER_BR,
            enterMode : Number(2),
				 })
				 CKEDITOR.config.width = 950;
				 CKEDITOR.config.height = 300;
			
				 $('#pgsubmit').on('click',function(){
						if($('.roles:checkbox:checked').length == 0){
							 alert("Please check at least one checkbox");
							 return false;
						}
						else{
							 var emailsubject = $('#email_subject').val();
							 //var emailcontent = $('#cke_1_contents').val(); alert(emailcontent);
							 if (emailsubject != '') {
									$('#add_campaign').submit();
							 }
							 else{
									alert("Please fill up all the fields");
									return false;
							 }
						}
				 });
			});
	 </script> 
   <div class="container">
      <div class="deshboard breport clear edit-customer-profile">
         <h3><strong>Edit Campaign</strong></h3>
         <div class="welcomePan clear">
            <div class="welcomeTxt alignleft">
               <h4>Welcome to Email Campaign.</h4>
            </div>
            
         </div>
         <br/>
         <div class="form-report clear">
            @if (count($errors) > 0)
               <div class="alert alert-danger error-msg">
                  <ul>
                     @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                     @endforeach
		     
                  </ul>
               </div>
		<br>	      
            @endif
            @if( Session::has('success') )
               <p class='text-green success-msg'><span>{{Session::get('success')}}</span></p>
            @endif
            @if(Session::has('error'))
               <p class='text-red error-msg'><span>{!! Session::get('error') !!}</span></p>
            @endif
            
            {!! Form::open(array('route'=>array('update_email_campaign_list_for_company',Session::get('COMPANY_SLUG')), 'id'=>'edit_profile', 'files'=>true ,'class'=>'btnAlgn')) !!}          
               {!! Form::hidden('id',$list[0]->id) !!}
	       {!! Form::hidden('company_id',$list[0]->company_id) !!}
               <div class="form-msg">
                  <div class="input-box half">
                     <label>Company :</label>
	             <div class='label-input'>
                    {!! Form::text('companyid',$list[0]->CompanyName,array('class'=>'input full','placeholder'=>'Company Name','id'=>'companyid','disabled' ))!!}
		     </div>
                  </div>
               </div>
               <div class="form-msg">  
                  <div class="input-box half">
                     <label>User :</label>
                     <div class='label-input'>
                        @foreach($userlist as $ul)
                           {{ Form::checkbox('chkuser[]',$ul->id,in_array($ul->id, explode(',',$list[0]->user_id)),['class' => 'roles']) }}
                           {!! $ul->first_name !!}
                        @endforeach
                     </div>
                  </div>
               </div>
               <div class="form-msg">
                  <div class="input-box half">
                     <label>Email Subject :</label>
                     <div class='label-input'>
                        {!! Form::text('email_subject',$list[0]->email_subject,array('class'=>'input full','placeholder'=>'Email Subject','id'=>'email_subject' ))!!}
                     </div>
                  </div>
               </div>  
                  
               <div class="form-msg">
                  <div class="input-box half">
                     <label>Email Content :</label>
                     <div class='label-input'>
                        {!! Form::textarea('email_content',$list[0]->email_content,array('class'=>'form-control required ckeditor', 'placeholder'=>'Email Content','id'=>'email_content'))!!}
                     </div>
                  </div>
               </div>
               {!! Form::submit('Update',array('class'=>'btn-srrp','id'=>'pgsubmit' )) !!}&nbsp;&nbsp;
               <a href="{{ URL::route('email_campaign_list_for_company',Session::get('COMPANY_SLUG')) }}">
                  <input type="button" class="btn-srrp cancel" value="Cancel" />
               </a>
            {!! Form::close() !!}
         </div>
      </div>
   </div>
@endsection