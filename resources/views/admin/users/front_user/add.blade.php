@extends('admin/layout')

@section('title', 'Customer')

@section('content')
    <div id="title-breadcrumb-option-demo" class="page-title-breadcrumb">
                <div class="page-header pull-left">
                    <div class="page-title">Customer</div>
                </div>
                <ol class="breadcrumb page-breadcrumb pull-right">
                    <li><i class="fa fa-home"></i>&nbsp;<a href="javascript:void(0);">Home</a>&nbsp;&nbsp;<i class="fa fa-angle-right"></i>&nbsp;&nbsp;</li>
                    <li><i class="fa fa-user"></i>&nbsp;<a href="javascript:void(0);">Users</a>&nbsp;&nbsp;<i class="fa fa-angle-right"></i>&nbsp;&nbsp;</li>
                    <li><i class="fa fa-user"></i>&nbsp;<a href="javascript:void(0);">Customer</a>&nbsp;&nbsp;<i class="fa fa-angle-right"></i>&nbsp;&nbsp;</li>
                    <li class="active"><i class="fa fa-user"></i>&nbsp; Add Customer</li>
                        
                </ol>
                <div class="clearfix"></div>
</div>
    <div class="page-content">
        <div id="form-layouts" class="row">
            <div class="col-lg-12">
                    <div class="portlet box portlet-yellow">
                         @if (count($errors) > 0)
                                        <div class="alert alert-danger">
                                            <ul>
                                                @foreach ($errors->all() as $error)
                                                    <li>{{ $error }}</li>
                                                @endforeach
                                            </ul>
                                        </div>
                                    @endif
                        <div class="portlet-header">
                            <div class="caption">Create Customer</div>
                        </div>
                        
                        <div class="portlet-body">
                            <div class="row">
                                <div >
                                    <div class="col-md-2 btn btn-primary" style="border-right:1px solid #FFF">1.My Details</div>
                                    <div class="col-md-2 btn btn-default" style="border-right:1px solid #FFF">2.My Professions </div>
                                    
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-12">
                                    <!--<h3>Account Information</h3>-->
                                    <br>
                                    {!! Form::open(array('route'=>'front_user_create','class'=>'form-validate')) !!}
                    
                                                            <div class="form-body pal">
                                                                <div class="form-group">
                                                                            <label class="control-label" for="inputFirstName">First Name <span class="require">*</span></label>
                                                                            <input type="text" class="form-control required" name="first_name" placeholder="First Name" id="inputFirstName">
                                                                </div>
                                                                <div class="form-group">
                                                                            <label class="control-label" for="inputLastName">Last Name <span class="require">*</span></label>
                                                                            <input type="text" class="form-control required" name="last_name" placeholder="Last Name" id="inputLastName">
                                                                </div>
                                                                <div class="form-group">
                                                                            <label class="control-label" for="inputEmail">Email <span class="require">*</span></label>
                                                                            <input type="text" class="form-control required" name="email" placeholder="Email Address" id="inputEmail">
                                                                </div>
                                                                <div class="form-group">
                                                                            <label class="control-label" for="inputPassword">Password <span class="require">*</span></label>
                                                                            <input type="password" class="form-control required userPassword" name="password" placeholder="Password" id="inputPassword">
                                                                            <div id="userPasswordErrSpan" style="display:none;"></div>
                                                                </div>
                                                                <div class="form-group">
                                                                            <label class="control-label" for="business_name">Business Name <span class="require">*</span></label>
                                                                            <input type="text" class="form-control required" name="business_name" placeholder="Business Name" id="business_name">
                                                                </div>
                                                                <div class="form-group">
                                                                            <label class="control-label" for="phone">Phone</label>
                                                                            <input type="text" class="form-control" name="phone" placeholder="Phone" id="phone">
                                                                </div>
                                                                <div class="form-group">
                                                                            <label class="control-label" for="fax">Fax</label>
                                                                            <input type="text" class="form-control" name="fax" placeholder="Fax" id="fax">
                                                                </div>
                                                                <div class="form-group">
                                                                            <label class="control-label" for="website_url">Website Url</label>
                                                                            <input type="text" class="form-control" name="website_url" placeholder="Website Url" id="website_url">
                                                                </div>
                                                                <div class="form-group">
                                                                            <label class="control-label" for="addess_line1">Address Line 1 </label>
                                                                            <input type="text" class="form-control" name="addess_line1" placeholder="Address Line 1" id="addess_line1">
                                                                </div>
                                                                <div class="form-group">
                                                                            <label class="control-label" for="addess_line2">Address Line 2 </label>
                                                                            <input type="text" class="form-control" name="addess_line2" placeholder="Address Line 2" id="addess_line2">
                                                                </div>
                                                                <div class="form-group">
                                                                            <label class="control-label" for="city">City </label>
                                                                            {!! Form::text('city','',array('class'=>'form-control','id'=>'city'))!!}
                                                                </div>
                                                                <div class="form-group">
                                                                            <label class="control-label" for="state">State / Province / Region</label>
                                                                            {!! Form::select('state',$state, '' ,array('class'=>'form-control' ,'id'=>'state'))!!}
                                                                           
                                                                </div>
                                                                <div class="form-group">
                                                                            <label class="control-label" for="zip">ZIP</label>
                                                                            <input type="text" class="form-control" name="zip" placeholder="ZIP" id="zip">
                                                                </div>
                                                                <div class="form-group">
                                                                             <label class="control-label required" for="licensed_contractor">Are you a licensed contractor?</label>
                                                                            {{ Form::radio('licensed_contractor', 'Yes') }}Yes
                                                                            {{ Form::radio('licensed_contractor', 'No') }}No
                                                                </div>

                                                                <div class="form-group residential">
                                                                            <label class="control-label" for="Residential">ROC #-Residential</label>
                                                                            <input type="text" class="form-control" name="residential" placeholder="Residential" id="residential">
                                                                </div>
                                                                
                                                                <div class="form-group commercial">
                                                                            <label class="control-label" for="Commercial">ROC #-Commercial</label>
                                                                            <input type="text" class="form-control" name="commercial" placeholder="Commercial" id="commercial">
                                                                </div>
                                                                <span class='error_lebel'></span>
                                                                <!--<div class="form-group">
                                                                            <label class="control-label" for="inputRole">Role <span class="require">*</span></label>
                                                                            {!! Form::select('role',[''=>'Select any role']+$roles,'',array('class'=>'form-control required','id'=>'inputRole')) !!}
                                                                </div>-->
                                                            </div>
                                                            <div class="form-actions pll prl">
                                                                <button class="btn btn-primary customer-create" type="submit" onclick="return checkEmpty()">Create</button>
                                                                &nbsp;
                                                                
                                                                {!! Html::linkRoute('front_users','Cancel',array(),array('class'=>'btn btn-green customer-create')) !!}
                                                            </div>
                                                {!! Form::close() !!}
                                </div>
                            </div>
                            <div style="clear:both"></div>
                        </div>
                    </div>
            </div>
        </div>
    </div>
<script>
            
</script>

@endsection