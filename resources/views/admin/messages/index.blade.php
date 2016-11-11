@extends('admin.layouts.master')

@section('styles')
    <link rel="stylesheet" href="{{ URL::to('assets/global/plugins/bootstrap-toastr/toastr.min.css') }}">
@endsection

@section('content')
        <!-- BEGIN PAGE HEADER-->
<h3 class="page-title">
    Messages <small>reports & statistics</small>
</h3>
<div class="page-bar">
    <ul class="page-breadcrumb">
        <li>
            <i class="fa fa-home"></i>
            <a href="{{ route('admin.dashboard') }}">Home</a>
            <i class="fa fa-angle-right"></i>
        </li>
        <li>
            <a href="{{ $typeOf == "Sent" ? route('admin.messages.send') : route('admin.messages.recieved') }}">{{ $typeOf  }} Messages</a>
        </li>
    </ul>
    <!--div class="page-toolbar">
        <div id="dashboard-report-range" class="pull-right tooltips btn btn-fit-height grey-salt" data-placement="top" data-original-title="Change dashboard date range">
            <i class="icon-calendar"></i>&nbsp; <span class="uppercase visible-lg-inline-block"></span>&nbsp; <i class="fa fa-angle-down"></i>
        </div>
    </div-->
</div>

<div class="row">
    <div class="col-md-6">
        <div class="portlet box red-thunderbird">
            <div class="portlet-title">
                <div class="caption">
                    <i class="icon-message"></i> {{ $typeOf }} Messages
                </div>
            </div>
            <div class="portlet-body">
                @if (!$smessages->isEmpty())
                    <div class="table-scrollable">
                        <table id="smessages" class="table table-hover">
                            <thead>
                            <tr>
                                <th>#</th>
                                <th>Date</th>
                                <th>Sender</th>
                                <th>Reciever</th>
                                <th>Message</th>
                                <th>Status</th>
                            </tr>
                            </thead>
                            <tbody>
                                @foreach($smessages as $index => $message)
                                    <tr>
                                        <td>{{ $message->id }}</td>
                                        <td>{{ $message->created_at->diffForHumans() }}</td>
                                        <td>{{ $message->sender }}</td>
                                        <td>{{ $message->reciever }}</td>
                                        <td>{{ $message->message }}</td>
                                        <td>
                                            @if($message->status == "Message accepted for delivery")
                                                <span class="label label-info label-sm">Pending</span>
                                            @elseif($message->status == "deliveredtohandset" || $message->status == "deliveredtonetwork")
                                                <span class="label label-success label-sm">Delivered</span>
                                            @else
                                                <span class="label label-danger label-sm">Failed</span>
                                            @endif
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                @else
                    No messages {{ $typeOf }}
                @endif
                <div class="row">
                    <div style="text-align: center;" class="col-md-12 col-sm-12">
                        @if (!empty($smessages))
                            {{ $smessages->links() }}
                        @endif
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="col-md-6">
        <div class="portlet box blue-chambray">
            <div class="portlet-title">
                <div class="caption">
                    <i class="icon-message"></i> Send Message
                </div>
            </div>
            <div class="portlet-body">
                <form id="sendMessage" class="form-horizontal" action="{{ route('admin.messages.send') }}">
                    {!! csrf_field() !!}
                    <div class="form-group">
                        <label for="reciever" class="col-sm-2 control-label">Reciever</label>
                        <div class="col-sm-10">
                            <input placeholder="923351234567" name="reciever" id="reciever" type="text" class="form-control" required>
                            <span class="help-block">
                                Please include "92" before number excluding "0"
                            </span>
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="message" class="col-sm-2 control-label">Message</label>
                        <div class="col-sm-10">
                            <textarea class="form-control" name="message" id="message" cols="30" rows="10" required></textarea>
                            <span class="help-block">
                                (1) SMS equals 160 characters including spaces current count is <span id="character-count">0</span>
                            </span>
                        </div>
                    </div>
                    <div class="form-actions">
                        <div class="row">
                            <div class="col-md-offset-2 col-md-9">
                                {!! Form::submit('Submit', ['class' => 'btn purple']) !!}
                                {!! Form::button('Cancel', ['class' => 'btn default']) !!}
                            </div>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

@endsection

@section('scripts')
    <script src="{{ URL::to('assets/global/scripts/Countable.js') }}"></script>
    <script src="{{ URL::to('assets/global/plugins/jquery-validation/js/jquery.validate.min.js') }}"></script>
    <script type="text/javascript" src="{{ URL::to('assets/global/plugins/bootstrap-toastr/toastr.min.js') }}"></script>
    <script>
        $.validator.setDefaults({
            highlight: function(element) {
                $(element).closest('.form-group').addClass('has-error');
            },
            unhighlight: function(element) {
                $(element).closest('.form-group').removeClass('has-error');
            },
            errorElement: 'span',
            errorClass: 'help-block',
            errorPlacement: function(error, element) {
                if(element.parent('.input-group').length) {
                    error.insertAfter(element.parent());
                } else {
                    error.insertAfter(element);
                }
            }
        });
        var area = document.getElementById('message');
        Countable.live(area, function (counter) {
            $('#character-count').html(counter.all).css('font-weight', 'bold');
        });
        $("#sendMessage").on("submit", function (e) {
            $(this).validate({
                rules: {
                    reciever: {
                        required: true,
                        minlength: 12,
                        maxlength: 12,
                        digits: true
                    }
                },
                messages: {
                    reciever: {
                        required: "Recipient number is required.",
                        minlength: "Number should be 12 digits with format 92xxxxxxxxxx"
                    }
                }
            });
            if (!$(this).valid()) return false;
            e.preventDefault();
            var url = $(this).attr("action");
            var data = {
                reciever: $("#reciever").val(),
                message: $("#message").val(),
                _token: $("input[name=_token]").val()
            };
            $.ajax({
                type: "POST",
                url: url,
                data: data,
                dataType: "JSON",
                success: function (data) {
                    console.log(data);
                    toastr.success("Message has been sent successfully.", "SMS Sent");

                    toastr.options = {
                        "closeButton": true,
                        "debug": false,
                        "positionClass": "toast-top-right",
                        "onclick": null,
                        "showDuration": "1000",
                        "hideDuration": "1000",
                        "timeOut": "5000",
                        "extendedTimeOut": "1000",
                        "showEasing": "swing",
                        "hideEasing": "linear",
                        "showMethod": "fadeIn",
                        "hideMethod": "fadeOut"
                    };
                    $("#reciever").val("");
                    $("#message").val("");
                    $("#smessages > tbody").prepend(
                            "<tr>" +
                            "<td>" + data.message.id + "</td>" +
                            "<td>" + data.message.sender + "</td>" +
                            "<td>" + data.message.reciever + "</td>" +
                            "<td>" + data.message.message + "</td>" +
                            "<td>" + data.message.status + "</td>" +
                            "<td>" + (data.message.status == "Message accepted for delivery" ? "<span class='label label-info label-sm'>Pending</span>" : "<span class='label label-info label-sm'>Pending</span>") + "</td>" +
                            "</tr>"
                    );
                    $("#myModal").modal('hide');
                },
                error: function (data) {
                    toastr.error("Some error occured. Please try again later.", "SMS Failed");

                    toastr.options = {
                        "closeButton": true,
                        "debug": false,
                        "positionClass": "toast-top-right",
                        "onclick": null,
                        "showDuration": "1000",
                        "hideDuration": "1000",
                        "timeOut": "5000",
                        "extendedTimeOut": "1000",
                        "showEasing": "swing",
                        "hideEasing": "linear",
                        "showMethod": "fadeIn",
                        "hideMethod": "fadeOut"
                    };
                    console.log(data);
                }
            });
        })
    </script>
@endsection