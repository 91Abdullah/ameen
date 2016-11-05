@extends('admin.layouts.master')

@section('content')
<!-- BEGIN PAGE HEADER-->
<h3 class="page-title">
    Preferences <small>email settings</small>
</h3>
<div class="page-bar">
    <ul class="page-breadcrumb">
        <li>
            <i class="fa fa-home"></i>
            <a href="{{ route('admin.dashboard') }}">Home</a>
            <i class="fa fa-angle-right"></i>
        </li>
        <li>
            <a href="{{ route('admin.messages') }}">Preferences</a>
        </li>
    </ul>
    <!--div class="page-toolbar">
        <div id="dashboard-report-range" class="pull-right tooltips btn btn-fit-height grey-salt" data-placement="top" data-original-title="Change dashboard date range">
            <i class="icon-calendar"></i>&nbsp; <span class="uppercase visible-lg-inline-block"></span>&nbsp; <i class="fa fa-angle-down"></i>
        </div>
    </div-->

</div>
{!! Form::model($preferences, ['type' => 'patch', 'route' => 'admin.preferences.mail']) !!}
<div class="form-group">
    <label for="host">Host</label>
    {!! Form::input('text', 'host', null, ['class' => 'form-control']) !!}
</div>
<div class="form-group">
    <label for="port">Port</label>
    {!! Form::input('text', 'port', null, ['class' => 'form-control']) !!}
</div>
<div class="form-group">
    <label for="encryption">Encryption</label>
    {!! Form::select('encryption', ['ssl', 'tls'], null, ['class' => 'form-control']) !!}
</div>
<div class="form-group">
    <label for="password">Password</label>
    {!! Form::input('password', 'password', $preferences->password, ['class' => 'form-control']) !!}
</div>
<div class="form-group">
    <label for="username">Username</label>
    {!! Form::input('text', 'username', null, ['class' => 'form-control']) !!}
</div>
<div class="form-group">
    <label for="validate_cert">Validate Certificate</label>
    {!! Form::select('validate_cert', [0 => 'false', 1 => 'true'], 0, ['class' => 'form-control']) !!}
</div>
{!! Form::submit('submit', ['class' => 'btn btn-primary']) !!}
{!! Form::close() !!}
@endsection