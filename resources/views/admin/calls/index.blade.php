@extends('admin.layouts.master')

@section('content')
    <!-- BEGIN PAGE HEADER-->
    <h3 class="page-title">
        Calls <small>reports & statistics</small>
    </h3>
    <div class="page-bar">
        <ul class="page-breadcrumb">
            <li>
                <i class="fa fa-home"></i>
                <a href="javascript:;">Home</a>
                <i class="fa fa-angle-right"></i>
            </li>
            <li>
                <a href="{{ route('admin.calls') }}">Calls</a>
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
            <div class="portlet box red">
                <div class="portlet-title">
                    <div class="caption">
                        <i class="fa fa-phone"></i> Call Recordings
                    </div>
                </div>
                <div class="portlet-body">
                    <div class="table-scrollable">
                        <table class="table table-hover">
                            <thead>
                                <tr>
                                    <th>#</th>
                                    <th>Call Date</th>
                                    <th>Source</th>
                                    <th>Destination</th>
                                    <th>Disposition</th>
                                    <th>Duration (secs)</th>
                                    <th>Play</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($cdrs as $index => $cdr)
                                    <tr>
                                        <td>{{ $cdr->id }}</td>
                                        <td>{{ \Carbon\Carbon::parse($cdr->calldate)->diffForHumans() }}</td>
                                        <td>{{ $cdr->src }}</td>
                                        <td>{{ $cdr->dst }}</td>
                                        <td>
                                            @if ($cdr->disposition == "ANSWERED")
                                                <span class="label label-success label-sm">{{ $cdr->disposition }}</span>
                                            @else
                                                <span class="label label-warning label-sm">{{ $cdr->disposition }}</span>
                                            @endif
                                        </td>
                                        <td>{{ $cdr->duration }}</td>
                                        <td>
                                            @if ($cdr->recordingfile)
                                                <a href="{{ $cdr->recordingfile }}"><i class="fa fa-play-circle-o fa-2x"></i></a>
                                            @endif
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
            {{ $cdrs->links() }}
        </div>
    </div>
@endsection