@extends('admin.layouts.master')


@section('styles')
        <!-- BEGIN PAGE LEVEL STYLES -->
<link href="{{ URL::to('assets/global/plugins/bootstrap-wysihtml5/bootstrap-wysihtml5.css') }}" rel="stylesheet" type="text/css"/>
<link href="{{ URL::to('assets/global/plugins/fancybox/source/jquery.fancybox.css') }}" rel="stylesheet"/>
<!-- BEGIN:File Upload Plugin CSS files-->
<link href="{{ URL::to('assets/global/plugins/jquery-file-upload/blueimp-gallery/blueimp-gallery.min.css') }}" rel="stylesheet"/>
<link href="{{ URL::to('assets/global/plugins/jquery-file-upload/css/jquery.fileupload.css') }}" rel="stylesheet"/>
<link href="{{ URL::to('assets/global/plugins/jquery-file-upload/css/jquery.fileupload-ui.css') }}" rel="stylesheet"/>
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
@endsection

@section('content')
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
            <a href="{{ route('admin.emails') }}">Inbox</a>
        </li>
    </ul>
</div>
<!-- END PAGE HEADER-->
<div class="row inbox">
    <div class="col-md-2">
        @include('admin.emails.list')
    </div>
    <div class="col-md-10">
        <div class="inbox-header inbox-view-header">
            <h1 class="pull-left">{{ $message->subject }}
                <a href="{{ route('admin.emails') }}">Inbox </a>
            </h1>
            <div class="pull-right">
                <i class="fa fa-print"></i>
            </div>
        </div>
        <div class="inbox-view-info">
            <div class="row">
                <div class="col-md-7">
                    <img src="{{ URL::to('assets/admin/layout/img/avatar1_small.jpg') }}">
                    <span class="bold">{{ $message->from[0]->mailbox }} </span>
                    <span>&#60;{{ $message->from[0]->mail }}&#62; </span>
                    to <span class="bold">{{ $message->to[0]->mailbox }} </span>on {{ $message->date->diffForHumans() }}
                </div>
                <div class="col-md-5 inbox-info-btn">
                    <div class="btn-group">
                        <a href="{{ route('admin.emails.reply', $message->message_no) }}" data-messageid="{{ $message->message_no }}" class="btn blue reply-btn">
                            <i class="fa fa-reply"></i> Reply </a>
                        <a class="btn blue dropdown-toggle" data-toggle="dropdown">
                            <i class="fa fa-angle-down"></i>
                        </a>
                        <ul class="dropdown-menu pull-right">
                            <li>
                                <a href="{{ route('admin.emails.reply', $message->message_no) }}" data-messageid="{{ $message->message_no }}" class="reply-btn">
                                    <i class="fa fa-reply"></i> Reply </a>
                            </li>
                            <li>
                                <a href="{{ route('admin.emails.forward', $message->message_no) }}">
                                    <i class="fa fa-arrow-right reply-btn"></i> Forward </a>
                            </li>
                            <li>
                                <a href="javascript:;">
                                    <i class="fa fa-print"></i> Print </a>
                            </li>
                            <li class="divider">
                            </li>
                            <li>
                                <a href="javascript:;">
                                    <i class="fa fa-ban"></i> Spam </a>
                            </li>
                            <li>
                                <a href="{{ route('admin.emails.delete', $message->message_no) }}">
                                    <i class="fa fa-trash-o"></i> Delete </a>
                            </li>
                            <li>
                    </div>
                </div>
            </div>
        </div>
        <div class="inbox-view">
            @if ($message->hasTextBody())
                {{ $message->getTextBody() }}
            @else
                {!! $message->getHTMLBody() !!}
            @endif
        </div>
        <hr>
        <div class="inbox-attached">
            <div class="margin-bottom-15">
            <span>
            3 attachments — </span>
                <a href="javascript:;">
                    Download all attachments </a>
                <a href="javascript:;">
                    View all images </a>
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
<!-- The main application script -->
<!-- The XDomainRequest Transport is included for cross-domain file deletion for IE 8 and IE 9 -->
<!--[if (gte IE 8)&(lt IE 10)]>
<script src="{{ URL::to('assets/global/plugins/jquery-file-upload/js/cors/jquery.xdr-transport.js') }}"></script>
<![endif]-->
<!-- END:File Upload Plugin JS files-->
<!-- END: Page level plugins -->
<script>
    $(document).ready(function() {

    });
</script>
@endsection