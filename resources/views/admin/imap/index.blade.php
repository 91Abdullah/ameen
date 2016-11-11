@extends('admin.layouts.master')


@section('styles')
    <!-- BEGIN PAGE LEVEL STYLES -->
    <link href="{{ URL::to('assets/global/plugins/bootstrap-wysihtml5/bootstrap-wysihtml5.css') }}" rel="stylesheet" type="text/css"/>
    <link href="{{ URL::to('assets/global/plugins/fancybox/source/jquery.fancybox.css') }}" rel="stylesheet"/>
    <!-- BEGIN:File Upload Plugin CSS files-->
    <link href="{{ URL::to('assets/global/plugins/jquery-file-upload/blueimp-gallery/blueimp-gallery.min.css') }}" rel="stylesheet"/>
    <link href="{{ URL::to('assets/global/plugins/jquery-file-upload/css/jquery.fileupload.css') }}" rel="stylesheet"/>
    <link href="{{ URL::to('assets/global/plugins/jquery-file-upload/css/jquery.fileupload-ui.css') }}" rel="stylesheet"/>
    <link href="{{ URL::to('assets/global/plugins/pace/themes/pace-theme-barber-shop.css') }}" rel="stylesheet"/>
    <!-- END:File Upload Plugin CSS files-->
    <!-- END PAGE LEVEL STYLES -->
    <!-- BEGIN PAGE LEVEL STYLES -->
    <link href="{{ URL::to('assets/admin/pages/css/inbox.css') }}" rel="stylesheet" type="text/css"/>
    <!-- END PAGE LEVEL STYLES -->
    <!-- BEGIN THEME STYLES -->
    <link href="{{ URL::to('assets/global/css/components-md.css') }}" id="style_components" rel="stylesheet" type="text/css"/>
    <link href="{{ URL::to('assets/global/css/plugins-md.css') }}" rel="stylesheet" type="text/css"/>
    <link href="{{ URL::to('assets/admin/layout/css/layout.css') }}" rel="stylesheet" type="text/css"/>
    <link id="style_color" href="{{ URL::to('assets/admin/layout/css/themes/darkblue.css') }}" rel="stylesheet" type="text/css"/>
    <link href="{{ URL::to('assets/admin/layout/css/custom.css') }}" rel="stylesheet" type="text/css"/>
    <link rel="stylesheet" href="{{ URL::to('assets/global/plugins/bootstrap-toastr/toastr.min.css') }}">
@endsection

@section('content')
    @if(!empty($status))
        <div class="alert alert-success">
            <strong>Success!</strong>
            Messages has been successfully synced.
        </div>
        @endif
                <!-- BEGIN PAGE HEADER-->
        <h3 class="page-title">
            Inbox <small>user inbox</small>
        </h3>
        <div class="page-bar">
            <ul class="page-breadcrumb">
                <li>
                    <i class="fa fa-home"></i>
                    <a href="{{ route('admin.dashboard') }}">Home</a>
                    <i class="fa fa-angle-right"></i>
                </li>
                <li>
                    <a href="{{ route('admin.imap') }}">Inbox</a>
                </li>
            </ul>
        </div>
        <!-- END PAGE HEADER-->
        <div class="row inbox">
            {{--<div class="col-md-6">
                <div class="inbox-header">
                    <h1 class="pull-left">Inbox</h1>
                </div>
                <div class="inbox-content">
                    <div class="inbox-table">
                        <table class="table table-striped table-advance table-hover">
                            <thead>
                            <tr>
                                <th colspan="3">
                                    <input type="checkbox" class="mail-checkbox mail-group-checkbox">
                                    <div class="btn-group">
                                        <a class="btn btn-sm blue dropdown-toggle" href="javascript:;" data-toggle="dropdown">
                                            More <i class="fa fa-angle-down"></i>
                                        </a>
                                        <ul class="dropdown-menu">
                                            <li>
                                                <a href="javascript:;">
                                                    <i class="fa fa-pencil"></i> Mark as Read </a>
                                            </li>
                                            <li>
                                                <a href="javascript:;">
                                                    <i class="fa fa-ban"></i> Spam </a>
                                            </li>
                                            <li class="divider">
                                            </li>
                                            <li>
                                                <a href="javascript:;">
                                                    <i class="fa fa-trash-o"></i> Delete </a>
                                            </li>
                                        </ul>
                                    </div>
                                </th>
                                <th class="pagination-control" colspan="3">
                        <span class="pagination-info">
                        1-30 of 789 </span>
                                    <a class="btn btn-sm blue">
                                        <i class="fa fa-angle-left"></i>
                                    </a>
                                    <a class="btn btn-sm blue">
                                        <i class="fa fa-angle-right"></i>
                                    </a>
                                </th>
                            </tr>
                            </thead>
                            <tbody>
                            @if (!empty($mail))
                                @foreach($mail as $message)
                                    <tr class="unread" data-messageid="{{ $message->id }}">
                                        <td class="inbox-small-cells">
                                            <input type="checkbox" class="mail-checkbox">
                                        </td>
                                        <td class="inbox-small-cells">
                                            <i class="fa fa-star"></i>
                                        </td>
                                        <td class="view-message hidden-xs">
                                            <a href="{{ route('admin.imap.view', $message->id) }}">{{ $message->fromName }}</a>
                                        </td>
                                        <td class="view-message">
                                            <a href="{{ route('admin.imap.view', $message->id) }}">{{ $message->subject }}</a>
                                        </td>
                                        <td class="view-message inbox-small-cells">
                                            @if(!empty($message->getAttachments()))
                                                <i class="fa fa-paperclip"></i>
                                            @endif
                                        </td>
                                        <td class="view-message text-right">
                                            {{\Carbon\Carbon::parse($message->date)->diffForHumans() }}
                                        </td>
                                    </tr>
                                @endforeach
                            @endif
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>--}}
            <div class="col-md-12">
                <div class="inbox-header">
                    <h1 class="pull-left">Inbox</h1>
                </div>
                <div class="inbox-content">
                    <div class="inbox-table">
                        <table id="ajaxMessages" class="table table-striped table-advance table-hover">
                            <tr>
                                <th colspan="3">
                                    <input type="checkbox" class="mail-checkbox mail-group-checkbox">
                                    <div class="btn-group">
                                        <a class="btn btn-sm blue dropdown-toggle" href="javascript:;" data-toggle="dropdown">
                                            More <i class="fa fa-angle-down"></i>
                                        </a>
                                        <ul class="dropdown-menu">
                                            <li>
                                                <a href="javascript:;">
                                                    <i class="fa fa-pencil"></i> Mark as Read </a>
                                            </li>
                                            <li>
                                                <a href="javascript:;">
                                                    <i class="fa fa-ban"></i> Spam </a>
                                            </li>
                                            <li class="divider">
                                            </li>
                                            <li>
                                                <a href="javascript:;">
                                                    <i class="fa fa-trash-o"></i> Delete </a>
                                            </li>
                                        </ul>
                                    </div>
                                </th>
                                <th class="pagination-control" colspan="3">
                                    {{--<span class="pagination-info">1-30 of 789 </span>
                                    <a class="btn btn-sm blue">
                                        <i class="fa fa-angle-left"></i>
                                    </a>
                                    <a class="btn btn-sm blue">
                                        <i class="fa fa-angle-right"></i>
                                    </a>--}}
                                </th>
                            </tr>
                            {{--<tr class="unread" data-messageid="">
                                <td class="inbox-small-cells">
                                    <input type="checkbox" class="mail-checkbox">
                                </td>
                                <td class="inbox-small-cells">
                                    <i class="fa fa-star"></i>
                                </td>
                                <td class="view-message hidden-xs">
                                    <a href=""></a>
                                </td>
                                <td class="view-message">
                                    <a href=""></a>
                                </td>
                                <td class="view-message inbox-small-cells">
                                    <i class="fa fa-paperclip"></i>
                                </td>
                                <td class="view-message text-right">

                                </td>
                            </tr>--}}
                        </table>
                    </div>
                </div>
            </div>
        </div>


        @endsection

        @section('scripts')
            <!-- BEGIN: Page level plugins -->
            <script src="{{ URL::to('assets/global/plugins/fancybox/source/jquery.fancybox.pack.js') }}" type="text/javascript"></script>
            <script src="{{ URL::to('assets/global/plugins/bootstrap-wysihtml5/wysihtml5-0.3.0.js') }}" type="text/javascript"></script>
            <script src="{{ URL::to('assets/global/plugins/bootstrap-wysihtml5/bootstrap-wysihtml5.js') }}" type="text/javascript"></script>
            <!-- BEGIN:File Upload Plugin JS files-->
            <!-- The jQuery UI widget factory, can be omitted if jQuery UI is already included -->
            <script src="{{ URL::to('assets/global/plugins/jquery-file-upload/js/vendor/jquery.ui.widget.js') }}"></script>
            <!-- The Templates plugin is included to render the upload/download listings -->
            <script src="{{ URL::to('assets/global/plugins/jquery-file-upload/js/vendor/tmpl.min.js') }}"></script>
            <!-- The Load Image plugin is included for the preview images and image resizing functionality -->
            <script src="{{ URL::to('assets/global/plugins/jquery-file-upload/js/vendor/load-image.min.js') }}"></script>
            <!-- The Canvas to Blob plugin is included for image resizing functionality -->
            <script src="{{ URL::to('assets/global/plugins/jquery-file-upload/js/vendor/canvas-to-blob.min.js') }}"></script>
            <!-- blueimp Gallery script -->
            <script src="{{ URL::to('assets/global/plugins/jquery-file-upload/blueimp-gallery/jquery.blueimp-gallery.min.js') }}"></script>
            <!-- The Iframe Transport is required for browsers without support for XHR file uploads -->
            <script src="{{ URL::to('assets/global/plugins/jquery-file-upload/js/jquery.iframe-transport.js') }}"></script>
            <!-- The basic File Upload plugin -->
            <script src="{{ URL::to('assets/global/plugins/jquery-file-upload/js/jquery.fileupload.js') }}"></script>
            <!-- The File Upload processing plugin -->
            <script src="{{ URL::to('assets/global/plugins/jquery-file-upload/js/jquery.fileupload-process.js') }}"></script>
            <!-- The File Upload image preview & resize plugin -->
            <script src="{{ URL::to('assets/global/plugins/jquery-file-upload/js/jquery.fileupload-image.js') }}"></script>
            <!-- The File Upload audio preview plugin -->
            <script src="{{ URL::to('assets/global/plugins/jquery-file-upload/js/jquery.fileupload-audio.js') }}"></script>
            <!-- The File Upload video preview plugin -->
            <script src="{{ URL::to('assets/global/plugins/jquery-file-upload/js/jquery.fileupload-video.js') }}"></script>
            <!-- The File Upload validation plugin -->
            <script src="{{ URL::to('assets/global/plugins/jquery-file-upload/js/jquery.fileupload-validate.js') }}"></script>
            <!-- The File Upload user interface plugin -->
            <script src="{{ URL::to('assets/global/plugins/jquery-file-upload/js/jquery.fileupload-ui.js') }}"></script>
            <!-- Pace Plugin -->
            <script src="{{ URL::to('assets/global/plugins/pace/pace.min.js') }}"></script>
            <script type="text/javascript" src="{{ URL::to('assets/global/plugins/bootstrap-toastr/toastr.min.js') }}"></script>
            <!-- The main application script -->
            <!-- The XDomainRequest Transport is included for cross-domain file deletion for IE 8 and IE 9 -->
            <!--[if (gte IE 8)&(lt IE 10)]>
            <script src="{{ URL::to('assets/global/plugins/jquery-file-upload/js/cors/jquery.xdr-transport.js') }}"></script>
            <![endif]-->
            <!-- END:File Upload Plugin JS files-->
            <!-- END: Page level plugins -->
            <script>
                $(document).ready(function() {
                    var url = "{{ route('admin.imap.getMails') }}";
                    var token = "{{ csrf_token() }}";
                    var baseUrl = "http://server/ameen/public/imap/";
                    var data = {
                        _token: token
                    };
                    $.ajax({
                        type: "GET",
                        url: url,
                        dataType: "JSON",
                        data: data,
                        success: function (data) {
                            console.log(data);
                            $.each(data, function (key, value) {
                                $("#ajaxMessages tbody").append(
                                    '<tr class="unread" data-messageid="' + value.id + '">' +
                                        '<td class="inbox-small-cells"><input type="checkbox" class="mail-checkbox"></td>' +
                                        '<td class="inbox-small-cells"><i class="fa fa-star"></i></td>' +
                                        '<td class="view-message hidden-xs"><a href="' + baseUrl + '/' + value.id + '">' + value.fromName + '</a></td>' +
                                        '<td class="view-message"><a href="'+ baseUrl + value.id +'">'+ value.subject +'</a></td>' +
                                        '<td class="view-message inbox-small-cells"></td>' +
                                        '<td class="view-message text-right">'+ value.date +'</td>' +
                                    '</tr>'
                                )
                            });
                            $(".mail-checkbox").uniform();
                            toastr.success("Email fetch successful. Total emails fetched: " + data.length, "Emails");

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
                        },
                        error: function (data) {
                            console.log(data);
                            toastr.error(data.responseText, "Email Fetch Failed");

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
                        }
                    });
                });
            </script>
@endsection