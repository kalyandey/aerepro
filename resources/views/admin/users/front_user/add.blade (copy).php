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
                        @if (count($errors) > 0)
                        <div class="alert alert-danger">
                                    <ul>
                                        @foreach ($errors->all() as $error)
                                            <li>{{ $error }}</li>
                                        @endforeach
                                    </ul>
                        </div>
                        @endif
                        @if( Session::has('succmsg') )
                        <div class="note note-success">
                        <p class='text-green'>{{Session::get('succmsg')}}</p>
                        </div>
                        @endif
                        @if( Session::has('errorMessage') )
                            <div class="note note-danger">
                            <p class='text-red'>{{Session::get('errorMessage')}}</p>
                            </div>
                        @endif
                    </div>
                    <div class="col-lg-12">
                     
                        <ul class="nav ul-edit nav-tabs responsive">
                            <li class="active"><a href="#my_details" data-toggle="tab">My Details</a></li>
                            <li><a href="#my_professions" data-toggle="tab">My Professions</a></li>
                           
                        </ul>
                        <div style="background: transparent; border: 0; box-shadow: none !important" class="tab-content pan mtl mbn responsive">
                            <div id="my_details" class="tab-pane fade active in">
                            
                            
                                    <div class="row">
                                    <div class="col-lg-12">
                                        <div class="panel panel-violet">
                                            <div class="panel-heading">Form Actions On Top</div>
                                            <div class="panel-body pan">
                                                {!! Form::open(array('route'=>'front_user_create','class'=>'form-validate')) !!}
                    
                                                            <div class="form-body pal">
                                                                <div class="form-group">
                                                                            <label class="control-label" for="inputFirstName">First Name <span class="require">*</span></label>
                                                                            <input type="text" class="form-control required" name="first_name" placeholder="First Name" id="inputFirstName">
                                                                </div>
                                                                <div class="form-group">
                                                                            <label class="control-label" for="inputLastName">Last Name</label>
                                                                            <input type="text" class="form-control" name="last_name" placeholder="Last Name" id="inputLastName">
                                                                </div>
                                                                <div class="form-group">
                                                                            <label class="control-label" for="inputEmail">Email <span class="require">*</span></label>
                                                                            <input type="text" class="form-control required" name="email" placeholder="Email Address" id="inputEmail">
                                                                </div>
                                                                <div class="form-group">
                                                                            <label class="control-label" for="inputPassword">Password <span class="require">*</span></label>
                                                                            <input type="password" class="form-control required" name="password" placeholder="Password" id="inputPassword">
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
                                                                            {!! Form::select('city',$city,'',array('class'=>'form-control','id'=>'city'))!!}
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
                                                                             <label class="control-label" for="licensed_contractor">Are you a licensed contractor?</label>
                                                                            {{ Form::radio('licensed_contractor', 'Yes') }}Yes
                                                                            {{ Form::radio('licensed_contractor', 'No') }}No
                                                                </div>
                                        
                                                                <!--<div class="form-group">
                                                                            <label class="control-label" for="inputRole">Role <span class="require">*</span></label>
                                                                            {!! Form::select('role',[''=>'Select any role']+$roles,'',array('class'=>'form-control required','id'=>'inputRole')) !!}
                                                                </div>-->
                                                            </div>
                                                            <div class="form-actions pll prl">
                                                                <button class="btn btn-primary" type="submit">Create</button>
                                                                &nbsp;
                                                                
                                                                {!! Html::linkRoute('front_users','Cancel',array(),array('class'=>'btn btn-green')) !!}
                                                            </div>
                                                {!! Form::close() !!}
                                            </div>
                                            </div>
                                       </div>
                                    </div>
                                                
                            
                            
                            </div>
                            <div id="my_professions" class="tab-pane fade">
                                                
                                    <div class="row">
                                    <div class="col-lg-12">
                                        <div class="panel panel-violet">
                                            <div class="panel-heading">Form Actions On Top</div>
                                            <div class="panel-body pan">
                                                {!! Form::open(array('route'=>'front_user_moreinfo','class'=>'form-validate')) !!}
                    
                                                            <div class="form-body pal">
                                                                <div class="form-group">
                                                                            <label class="control-label" for="Your Profession">Your Profession : </label><br>
                                                                            @if(count($profession) > 0 )
                                                                                    @foreach($profession as $p)
                                                                                        {!! Form::checkbox('profession[]',$p->id,'',array('class'=>'form-control checkbox'))!!} {!! $p->profession_title !!}&nbsp;
                                                                                    @endforeach
                                                                            @endif
                                                                </div>
                                                            </div>
                                                            <div class="form-body pal">
                                                                <div class="form-group">
                                                                            <label class="control-label" for="CSI Division">CSI Division : </label><br>
                                                                            @if(count($division) > 0 )
                                                                                    @foreach($division as $d)
                                                                                        {!! Form::checkbox('division[]',$d->id,'',array('class'=>'input full required'))!!} {!! $d->division_title !!}<br><br>
                                                                                    @endforeach
                                                                                @endif
                                                                </div>
                                                            </div>
                                                            <div class="form-body pal">
                                                                <div class="form-group">
                                                                            <label class="control-label" for="Constraction Trades">Constraction Trades : </label><br>
                                                                            @if(count($trade) > 0 )
                                                                                    @foreach($trade as $t)
                                                                                        {!! Form::checkbox('trade[]',$t->id,'',array('class'=>'input full required'))!!} {!! $t->trade_title !!}<br><br>
                                                                                    @endforeach
                                                                            @endif
                                                                </div>
                                                            </div>
                                                            <div class="form-actions pll prl">
                                                                <button class="btn btn-primary" type="submit">Create</button>
                                                                &nbsp;
                                                                
                                                                {!! Html::linkRoute('front_users','Cancel',array(),array('class'=>'btn btn-green')) !!}
                                                            </div>
                                                {!! Form::close() !!}
                                            </div>
                                        </div>
                                    </div>
                                    </div>
                            </div>
                    </div>
                </div>
            </div>

@endsection