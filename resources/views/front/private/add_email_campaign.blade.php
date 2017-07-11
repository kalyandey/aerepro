@extends('front.app')
@section('content')
	 <script src="{{ asset('js/ckeditor/ckeditor.js') }}"></script>
	 <script type="text/javascript">
			$(document).ready(function(){
				 CKEDITOR.replace( 'email_content',
				 {
						//customConfig : 'config.js',
						toolbar : 'simple',
				 })
				 CKEDITOR.config.width = 950;
				 CKEDITOR.config.height = 300;
				 //editorInstance.SwitchEditMode();	
			
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
			<div class="deshboard breport clear edit-customer-profile private-box">
				 <h3><strong>Add Campaign</strong></h3>
				 <div class="welcomePan clear">
						<div class="welcomeTxt alignleft">
							 <h4>Welcome to Email Campaign Add Section.</h4>
						</div>
				 </div>
				 <br />
				 <div class="form-report clear">
						@if (count($errors) > 0)
							 <div class="alert alert-danger error-msg">
									<ul>
										 @foreach ($errors->all() as $error)
												<li>{{ $error }}</li>
										 @endforeach
									</ul>
							 </div>
						@endif
						@if( Session::has('success') )
							 <p class='text-green success-msg'><span>{{Session::get('success')}}</span></p>
						@endif
						@if(Session::has('error'))
							 <p class='text-red error-msg'><span>{!! Session::get('error') !!}</span></p>
						@endif
						{!! Form::open(array('route'=>array('post_email_campaign_list_for_company',Session::get('COMPANY_SLUG')), 'id'=>'add_campaign', 'files'=>true, 'class'=>'btnAlgn')) !!}
							 <input type="hidden" name="action" value="Process">
							 <div class="form-msg">
									<div class="input-box half">
										 <label>User :</label>
										 @foreach($userlist as $ul)
												<input type="checkbox" class="roles" name="chkuser[]" value="{{ $ul->assign_user->id }}">{!! $ul->assign_user->first_name !!}
										 @endforeach
									</div>
							 </div>
							 <div class="form-msg">
									<div class="input-box half">
										 <label>Email Subject :</label>
										 <div class='label-input'>{!! Form::text('email_subject','',array('class'=>'input full','id'=>'email_subject'))!!}</div>     
									</div>
							 </div>
							 <div class="form-msg">  
									<div class="input-box half">
										 <label>Email Content :</label>
										 <div class='label-input'>{!! Form::textarea('email_content','',array('class'=>'input full ckeditor', 'id'=>'email_content'))!!}</div>
									</div>
							 </div>
							 <div class="form-msg"> 
									<div class="input-box half">
										 {!! Form::submit('Add',array('class'=>'btn-srrp','id'=>'pgsubmit')) !!}&nbsp;&nbsp;
										 <a href="{{URL::route('email_campaign_list_for_company',[Session::get('COMPANY_SLUG')])}}">
											 <input type="button" class="btn-srrp cancel" value="Cancel" />
										 </a>
									</div>
							 </div>
						{!! Form::close() !!}
				 </div>
			</div>
	 </div>
			
	 			

@endsection