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
            <h1 class="pull-left">
                <a href="{{ route('admin.emails') }}">Inbox </a>
            </h1>
            <div class="pull-right">
                <i class="fa fa-print"></i>
            </div>
        </div>
        <form class="inbox-compose form-horizontal" id="fileupload" action="{{ route('admin.emails.sendReply') }}" method="POST" enctype="multipart/form-data">
            {!! csrf_field() !!}
            <div class="inbox-compose-btn">
                <button class="btn blue"><i class="fa fa-check"></i>Send</button>
                <button class="btn">Discard</button>
                <button class="btn">Draft</button>
            </div>
            <div class="inbox-form-group mail-to">
                <label class="control-label">To:</label>
                <div class="controls controls-to">
                    <input type="text" class="form-control" name="to" value="">
			<span class="inbox-cc-bcc">
			<span class="inbox-cc " style="display:none">
			Cc </span>
			<span class="inbox-bcc">
			Bcc </span>
			</span>
                </div>
            </div>
            <div class="inbox-form-group input-cc">
                <a href="javascript:;" class="close">
                </a>
                <label class="control-label">Cc:</label>
                <div class="controls controls-cc">
                    <input type="text" name="cc" class="form-control" value="">
                </div>
            </div>
            <div class="inbox-form-group input-bcc display-hide">
                <a href="javascript:;" class="close">
                </a>
                <label class="control-label">Bcc:</label>
                <div class="controls controls-bcc">
                    <input type="text" name="bcc" class="form-control">
                </div>
            </div>
            <div class="inbox-form-group">
                <label class="control-label">Subject:</label>
                <div class="controls">
                    <input type="text" class="form-control" name="subject" value="">
                </div>
            </div>
            <div class="inbox-form-group">
                <div class="controls-row">
                    <textarea class="inbox-editor inbox-wysihtml5 form-control" name="message" rows="12"></textarea>
                    <!--blockquote content for reply message, the inner html of reply_email_content_body element will be appended into wysiwyg body. Please refer Inbox.js loadReply() function. -->
                    {{--<div id="reply_email_content_body" class="hide">
                        <input type="text">
                        <br>
                        <br>
                        <blockquote>
                            {!! $message->bodies['html']->content !!}
                        </blockquote>
                    </div>--}}
                </div>
            </div>
            <div class="inbox-compose-attachment">
                <!-- The fileupload-buttonbar contains buttons to add/delete files and start/cancel the upload -->
                <span class="btn green fileinput-button"><i class="fa fa-plus"></i>
                    <span>Add files... </span>
                    <input type="file" name="files[]" multiple>
                </span>
                <!-- The table listing the files available for upload/download -->
                <table role="presentation" class="table table-striped margin-top-10">
                    <tbody class="files">
                    </tbody>
                </table>
            </div>
            <script id="template-upload" type="text/x-tmpl">
            {% for (var i=0, file; file=o.files[i]; i++) { %}
                <tr class="template-upload fade">
                    <td class="name" width="30%"><span>{%=file.name%}</span></td>
                    <td class="size" width="40%"><span>{%=o.formatFileSize(file.size)%}</span></td>
                    {% if (file.error) { %}
                        <td class="error" width="20%" colspan="2"><span class="label label-danger">Error</span> {%=file.error%}</td>
                    {% } else if (o.files.valid && !i) { %}
                        <td>
                            <p class="size">{%=o.formatFileSize(file.size)%}</p>
                            <div class="progress progress-striped active" role="progressbar" aria-valuemin="0" aria-valuemax="100" aria-valuenow="0">
                               <div class="progress-bar progress-bar-success" style="width:0%;"></div>
                               </div>
                        </td>
                    {% } else { %}
                        <td colspan="2"></td>
                    {% } %}
                    <td class="cancel" width="10%" align="right">{% if (!i) { %}
                        <button class="btn btn-sm red cancel">
                                   <i class="fa fa-ban"></i>
                                   <span>Cancel</span>
                               </button>
                    {% } %}</td>
                </tr>
            {% } %}
            </script>
            <!-- The template to display files available for download -->
            <script id="template-download" type="text/x-tmpl">
                {% for (var i=0, file; file=o.files[i]; i++) { %}
                    <tr class="template-download fade">
                        {% if (file.error) { %}
                            <td class="name" width="30%"><span>{%=file.name%}</span></td>
                            <td class="size" width="40%"><span>{%=o.formatFileSize(file.size)%}</span></td>
                            <td class="error" width="30%" colspan="2"><span class="label label-danger">Error</span> {%=file.error%}</td>
                        {% } else { %}
                            <td class="name" width="30%">
                                <a href="{%=file.url%}" title="{%=file.name%}" data-gallery="{%=file.thumbnail_url&&'gallery'%}" download="{%=file.name%}">{%=file.name%}</a>
                            </td>
                            <td class="size" width="40%"><span>{%=o.formatFileSize(file.size)%}</span></td>
                            <td colspan="2"></td>
                        {% } %}
                        <td class="delete" width="10%" align="right">
                            <button class="btn default btn-sm" data-type="{%=file.delete_type%}" data-url="{%=file.delete_url%}"{% if (file.delete_with_credentials) { %} data-xhr-fields='{"withCredentials":true}'{% } %}>
                                <i class="fa fa-times"></i>
                            </button>
                        </td>
                    </tr>
                {% } %}
	        </script>
            <div class="inbox-compose-btn">
                <button id="sendMail" class="btn blue"><i class="fa fa-check"></i>Send</button>
                <button class="btn">Discard</button>
                <button class="btn">Draft</button>
            </div>
        </form>
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
    var initWysihtml5 = function () {
        $('.inbox-wysihtml5').wysihtml5({
            "stylesheets": ["{{ URL::to('assets/global/plugins/bootstrap-wysihtml5/wysiwyg-color.css') }}"]
        });
    };

    var initFileupload = function () {

        $('#fileupload').fileupload({
            // Uncomment the following to send cross-domain cookies:
            //xhrFields: {withCredentials: true},
            url: "/",
            autoUpload: true
        });

        // Upload server status check for browsers with CORS support:
        if ($.support.cors) {
            $.ajax({
                url: "/",
                type: 'HEAD'
            }).fail(function () {
                $('<span class="alert alert-error"/>')
                        .text('Upload server currently unavailable - ' +
                        new Date())
                        .appendTo('#fileupload');
            });
        }
    };

    var handleCCInput = function () {
        var the = $('.inbox-compose .mail-to .inbox-cc');
        var input = $('.inbox-compose .input-cc');
        the.hide();
        input.show();
        $('.close', input).click(function () {
            input.hide();
            the.show();
        });
    };

    $(document).ready(function() {
        $('[name="message"]').val($('#reply_email_content_body').html());
        handleCCInput(); // init "CC" input field

        initFileupload();
        initWysihtml5();
        Layout.fixContentHeight();
        Metronic.initUniform();

        $("#sendMail").on('click', function (e) {

        });
    });
</script>
@endsection