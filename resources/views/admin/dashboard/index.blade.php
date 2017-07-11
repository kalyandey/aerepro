@extends('admin/layout')

@section('title', 'Dashboard')

@section('content')
    <div id="title-breadcrumb-option-demo" class="page-title-breadcrumb">
                <div class="page-header pull-left">
                    <div class="page-title">Dashboard</div>
                </div>
                <ol class="breadcrumb page-breadcrumb pull-right">
                    <li><i class="fa fa-home"></i>&nbsp;<a href="javascript:void(0);">Home</a>&nbsp;&nbsp;<i class="fa fa-angle-right"></i>&nbsp;&nbsp;</li>
                    <li class="hidden"><a href="javascript:void(0);">Dashboard</a>&nbsp;&nbsp;<i class="fa fa-angle-right"></i>&nbsp;&nbsp;</li>
                    <li class="active">Dashboard</li>
                </ol>
                <div class="clearfix"></div>
    </div>
        <div class="page-content">
                <!--<h2 align="center">Welcome to admin panel</h2>-->
                        <div id="sum_box" class="row mbl">
                        <div class="col-sm-6 col-md-4">
                        <a href="<?= \URL::Route('admin_project_create') ?>">
                            <div class="panel visit db mbm">
                                <div class="panel-body"><p class="icon" style="font-size: 42px"><i class="fa fa-list-alt" style="color : #A4BB24"></i></p>
                                    <h4 class="value"><span><b>New project</b></span></h4>
                                </div>
                            </div>
                        </a>
                        </div>
                        
                        <div class="col-sm-6 col-md-4">
                        <a href="<?= URL::Route('admin_buildingreport_create')?>">
                            <div class="panel visit db mbm">
                                <div class="panel-body"><p class="icon" style="font-size: 42px"><i class="fa fa-bar-chart-o" style="color : #E0ED6A"></i></p>
                                    <h4 class="value"><span><b>New Report</b></span></h4>
                                </div>
                            </div>
                        </a>
                        </div>
                        
                        <div class="col-sm-6 col-md-4">
                        <a href="<?= URL::Route('front_users_add') ?>">
                            <div class="panel visit db mbm">
                                <div class="panel-body"><p class="icon" style="font-size: 42px"><i class="fa fa-user" style="color : #947EE5"></i></p><h4 class="value"><span><b>New Customer</b></span></h4>

                                </div>
                            </div>
                        </a>
                        </div>
                        
                    </div>

    </div>

@endsection