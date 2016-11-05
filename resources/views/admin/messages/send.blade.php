@extends('admin.layouts.master')

@section('content')
        <!-- BEGIN PAGE HEADER-->
<h3 class="page-title">
    Send SMS
</h3>
<div class="page-bar">
    <ul class="page-breadcrumb">
        <li>
            <i class="fa fa-home"></i>
            <a href="{{ route('admin.dashboard') }}">Home</a>
            <i class="fa fa-angle-right"></i>
        </li>
        <li>
            <a href="{{ route('admin.messages') }}">Messages</a>
            <i class="fa fa-angle-right"></i>
        </li>
        <li>
            <span>Send SMS</span>
        </li>
    </ul>
    <!--div class="page-toolbar">
        <div id="dashboard-report-range" class="pull-right tooltips btn btn-fit-height grey-salt" data-placement="top" data-original-title="Change dashboard date range">
            <i class="icon-calendar"></i>&nbsp; <span class="uppercase visible-lg-inline-block"></span>&nbsp; <i class="fa fa-angle-down"></i>
        </div>
    </div-->
</div>
@endsection