@extends('admin.layouts.master')

@section('content')
        <!-- BEGIN PAGE HEADER-->
<h3 class="page-title">
    Preferences <small>message settings</small>
</h3>
<div class="page-bar">
    <ul class="page-breadcrumb">
        <li>
            <i class="fa fa-home"></i>
            <a href="{{ route('admin.dashboard') }}">Home</a>
            <i class="fa fa-angle-right"></i>
        </li>
        <li>
            <a href="{{ route('admin.preferences.messageIndex') }}">Preferences</a>
            <i class="fa fa-angle-right"></i>
        </li>
        <li>
            <span class="bold">Messages / Status</span>
        </li>
    </ul>
    <!--div class="page-toolbar">
        <div id="dashboard-report-range" class="pull-right tooltips btn btn-fit-height grey-salt" data-placement="top" data-original-title="Change dashboard date range">
            <i class="icon-calendar"></i>&nbsp; <span class="uppercase visible-lg-inline-block"></span>&nbsp; <i class="fa fa-angle-down"></i>
        </div>
    </div-->

</div>

<div class="row">
    <div class="col-md-12">
        @if (session('status'))
            <div class="alert alert-success">
                {{ session('status') }}
            </div>
        @endif
        <div class="portlet box yellow-crusta">
            <div class="portlet-title">
                <div class="caption">
                    <i class="icon-wrench"></i>
                    Message Settings Form
                </div>
            </div>
            <div class="portlet-body form">
                {!! Form::open(['route' => 'admin.preferences.messageSave', 'method' => 'post', 'class' => 'form-horizontal form-bordered']) !!}
                <div class="form-group">
                    {!! Form::label('server_ip', 'Server IP', ['class' => 'col-sm-3 control-label']) !!}
                    <div class="col-sm-4">
                        {!! Form::text('server_ip', array_key_exists('server_ip', $settings) ? $settings['server_ip'] : null, ['class' => 'form-control']) !!}
                    </div>
                </div>
                <div class="form-group">
                    {!! Form::label('server_port', 'Server Port', ['class' => 'col-sm-3 control-label']) !!}
                    <div class="col-sm-4">
                        {!! Form::text('server_port', array_key_exists('server_port' ,$settings) ? $settings['server_port'] : null, ['class' => 'form-control']) !!}
                    </div>
                </div>
                <div class="form-group">
                    {!! Form::label('user_id', 'User ID', ['class' => 'col-sm-3 control-label']) !!}
                    <div class="col-sm-4">
                        {!! Form::text('user_id', array_key_exists('user_id', $settings) ? $settings['user_id'] : null, ['class' => 'form-control']) !!}
                    </div>
                </div>
                <div class="form-group">
                    {!! Form::label('password', 'Password', ['class' => 'col-sm-3 control-label']) !!}
                    <div class="col-sm-4">
                        {!! Form::password('password', ['class' => 'form-control']) !!}
                    </div>
                </div>
                <div class="form-actions">
                    <div class="row">
                        <div class="col-md-offset-3 col-md-9">
                            {!! Form::submit('Submit', ['class' => 'btn purple']) !!}
                            {!! Form::button('Cancel', ['class' => 'btn default']) !!}
                        </div>
                    </div>
                </div>
                {!! Form::close() !!}
            </div>
        </div>
    </div>
</div>

<div class="row">
    <div class="col-md-12">
        <div class="portlet box grey-steel">
            <div class="portlet-title">
                <div class="caption">
                    <i class="icon-speedometer"></i>
                    Status Settings Form
                </div>
            </div>
            <div class="portlet-body form">
                {!! Form::open(['route' => 'admin.preferences.statusSave', 'method' => 'post', 'class' => 'form-horizontal form-bordered']) !!}
                <div class="form-group">
                    {!! Form::label('status_server_ip', 'Server IP', ['class' => 'col-sm-3 control-label']) !!}
                    <div class="col-sm-4">
                        {!! Form::text('status_server_ip', array_key_exists('status_server_ip', $settings) ? $settings['status_server_ip'] : null, ['class' => 'form-control']) !!}
                    </div>
                </div>
                <div class="form-group">
                    {!! Form::label('status_server_port', 'Server Port', ['class' => 'col-sm-3 control-label']) !!}
                    <div class="col-sm-4">
                        {!! Form::text('status_server_port', array_key_exists('status_server_port', $settings) ? $settings['status_server_port'] : null, ['class' => 'form-control']) !!}
                    </div>
                </div>
                <div class="form-group">
                    {!! Form::label('status_user_id', 'User ID', ['class' => 'col-sm-3 control-label']) !!}
                    <div class="col-sm-4">
                        {!! Form::text('status_user_id', array_key_exists('status_user_id', $settings) ? $settings['status_user_id'] : null, ['class' => 'form-control']) !!}
                    </div>
                </div>
                <div class="form-group">
                    {!! Form::label('status_password', 'Password', ['class' => 'col-sm-3 control-label']) !!}
                    <div class="col-sm-4">
                        {!! Form::password('status_password', ['class' => 'form-control']) !!}
                    </div>
                </div>
                <div class="form-actions">
                    <div class="row">
                        <div class="col-md-offset-3 col-md-9">
                            {!! Form::submit('Submit', ['class' => 'btn purple']) !!}
                            {!! Form::button('Cancel', ['class' => 'btn default']) !!}
                        </div>
                    </div>
                </div>
                {!! Form::close() !!}
            </div>
        </div>
    </div>
</div>

@endsection