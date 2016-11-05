@extends('admin.layouts.master')

@section('styles')
    <link rel="stylesheet" href="{{ URL::to('assets/global/plugins/bootstrap-toastr/toastr.min.css') }}">
@endsection

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

<div class="row">
    <div class="col-md-12">
        <div class="portlet light bordered">
            <div class="portlet-title">
                <div class="caption">
                    <i class="icon-user"></i>
                    <span class="caption-subject bold uppercase">
                         Users
                    </span>
                </div>
                <div class="actions">
                    <a href="" data-toggle="modal" data-target="#myModal" class="btn btn-circle btn-default">
                        <i class="fa fa-pencil"></i> Create New
                    </a>
                </div>
            </div>
            <div class="portlet-body">
                <div class="table-scrollable">
                    <table class="table table-hover">
                        <tr>
                            <th>#</th>
                            <th>Name</th>
                            <th>Username</th>
                            <th>Active</th>
                            <th>Actions</th>
                        </tr>
                        @if(!$users->isEmpty())
                            @foreach($users as $index => $user)
                                <tr>
                                    <td>{{ $user->id }}</td>
                                    <td>{{ $user->name }}</td>
                                    <td>{{ $user->email }}</td>
                                    <td><i class="fa fa-check" style="color: green;"></i></td>
                                    <td>
                                        <a href="#" id="{{ $user->id }}" class="btn btn-sm btn-danger delete-btn"><i class="fa fa-ban"></i> Delete</a>
                                        <a href="#" id="{{ $user->id }}" class="btn btn-sm btn-info edit-btn"><i class="fa fa-pencil"></i> Edit</a>
                                    </td>
                                </tr>
                            @endforeach
                        @endif
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>

<div id="myModal" class="modal fade" tabindex="-1" role="dialog">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                <h4 class="modal-title">Create user</h4>
            </div>
            <div class="modal-body form">
                <form id="myForm" role="form" action="{{ route('admin.preferences.user') }}">
                    <div class="form-body">
                        {{ csrf_field() }}
                        <div class="form-group form-md-line-input">
                            {!! Form::text('name', null, ['id' => 'name' ,'class' => 'form-control']) !!}
                            {!! Form::label('name', 'Name') !!}
                        </div>
                        <div class="form-group form-md-line-input">
                            {!! Form::email('email', null, ['class' => 'form-control', 'id' => 'email']) !!}
                            {!! Form::label('email', 'Email') !!}
                        </div>
                        <div class="form-group form-md-line-input">
                            {!! Form::password('password', ['class' => 'form-control', 'id' => 'password']) !!}
                            {!! Form::label('password', 'Password') !!}
                        </div>
                    </div>
                    <div class="form-actions noborder">
                        {!! Form::submit('Submit', ['class' => 'btn blue']) !!}
                    </div>
                </form>
            </div>
        </div><!-- /.modal-content -->
    </div><!-- /.modal-dialog -->
</div><!-- /.modal -->

<div id="myModalEdit" class="modal fade" tabindex="-1" role="dialog">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                <h4 class="modal-title">Edit user</h4>
            </div>
            <div class="modal-body form">
                <form id="myFormEdit" role="form" action="{{ route('admin.preferences.editUser') }}">
                    <div class="form-body">
                        {{ csrf_field() }}
                        <input type="hidden" id="Id">
                        <div class="form-group form-md-line-input">
                            {!! Form::text('name', null, ['id' => 'name' ,'class' => 'form-control']) !!}
                            {!! Form::label('name', 'Name') !!}
                        </div>
                        <div class="form-group form-md-line-input">
                            {!! Form::email('email', null, ['class' => 'form-control', 'id' => 'email']) !!}
                            {!! Form::label('email', 'Email') !!}
                        </div>
                        <div class="form-group form-md-line-input">
                            {!! Form::password('password', ['class' => 'form-control', 'id' => 'password']) !!}
                            {!! Form::label('password', 'Password') !!}
                        </div>
                    </div>
                    <div class="form-actions noborder">
                        {!! Form::submit('Submit', ['class' => 'btn green']) !!}
                    </div>
                </form>
            </div>
        </div><!-- /.modal-content -->
    </div><!-- /.modal-dialog -->
</div><!-- /.modal -->

@endsection

@section('scripts')
    <script src="{{ URL::to('assets/global/plugins/jquery-validation/js/jquery.validate.min.js') }}"></script>
    <script type="text/javascript" src="{{ URL::to('assets/global/plugins/bootstrap-toastr/toastr.min.js') }}"></script>
    <script>

        var editUrl = "{{ route('admin.preferences.editUser') }}";
        var caller = "";

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

        $(".delete-btn").on("click", function (event) {
            event.preventDefault();
            var url = "{{ route('admin.preferences.deleteUser')  }}";
            var data = {
                id: event.target.id,
                _token: $("input[name=_token]").val()
            };
            $.ajax({
                type: "DELETE",
                url: url,
                data: data,
                dataType: "JSON",
                success: function (data) {
                    console.log(data);
                    toastr.success("User has been deleted successfully", "Success!");

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
                    $(event.target).parent().parent().remove();
                    console.log($(event.target).parent().parent().remove());
                },
                error: function (data) {
                    toastr.error("Some error occured. Please try again later.", "Failed!");

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
        });

        $(".edit-btn").on("click", function (event) {
            event.preventDefault();
            caller = $(event.target);
            var url = "{{ route('admin.preferences.updateUser') }}";
            var data = {
                id: event.target.id,
                _token: $("input[name=_token]").val()
            };
            $("#myFormEdit #Id").val(event.target.id);
            $.ajax({
                url: url,
                data: data,
                dataType: "JSON",
                type: "GET",
                success: function (data) {
                    //console.log(data);
                    $("#myModalEdit").modal("show");
                    $("#myFormEdit #name").val(data.name);
                    $("#myFormEdit #email").val(data.email);
                    $("#myFormEdit #password").change(function () {
                        $("#myFormEdit #password").val(data.password);
                    });
                }
            });
        });

        $("#myFormEdit").on("submit", function (event) {
            event.preventDefault();
            $(this).validate({
                rules: {
                    name: {
                        required: true
                    },
                    email: {
                        required: true,
                        email: true
                    },
                    password: {
                        minlength: 6
                    }
                }
            });
            if (!$(this).valid()) return false;
            var url = $(this).attr("action");
            var data = {
                id: $("#myFormEdit #Id").val(),
                name: $("#myFormEdit #name").val(),
                email: $("#myFormEdit #email").val(),
                password: $("#myFormEdit #password").val(),
                _token: $("input[name=_token]").val()
            };
            console.log(data);
            console.log(caller);
            //return false;
            $.ajax({
                type: "PUT",
                url: url,
                data: data,
                dataType: "JSON",
                success: function (data) {
                    console.log(data);
                    toastr.success("User has been edited successfully", "Success!");

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

                    caller.parent().parent().children()[1].innerHTML = data.user.name;
                    caller.parent().parent().children()[2].innerHTML = data.user.email;
                    $("#myModalEdit").modal("hide");
                },
                error: function (data) {
                    toastr.error("Some error occured. Please try again later.", "Failed!");

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
        });

        $("#myForm").on("submit", function (event) {
            event.preventDefault();
            $(this).validate({
                rules: {
                    name: {
                        required: true
                    },
                    email: {
                        required: true,
                        email: true
                    },
                    password: {
                        required: true,
                        minlength: 6
                    }
                }
            });
            if (!$(this).valid()) return false;
            var url = $(this).attr("action");
            var data = {
                name: $("#name").val(),
                email: $("#email").val(),
                password: $("#password").val(),
                _token: $("input[name=_token]").val()
            };
            //console.log(data);
            $.ajax({
                type: "POST",
                url: url,
                data: data,
                dataType: "JSON",
                success: function (data) {
                    console.log(data);
                    toastr.success("User has been created successfully", "Success!");

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

                    $("#name").val("");
                    $("#email").val("");
                    $("#password").val("");

                    $(".table").append(
                            "<tr>" +
                            "<td>" + data.user.id + "</td>" +
                            "<td>" + data.user.name + "</td>" +
                            "<td>" + data.user.email + "</td>" +
                            "<td><i class='fa fa-check' style='color: green'></i></td>" +
                            "<td>" +
                            "<a href='' id='"+ data.user.id +"' class='btn btn-sm btn-danger delete-btn'><i class='fa fa-ban'></i> Delete</a>" +
                            "<a href='' id='"+ data.user.id +"' class='btn btn-sm btn-info edit-btn'><i class='fa fa-pencil'></i> Edit</a>" +
                            "</td>" +
                            "</tr>"
                    )

                    $("#myModal").modal("hide");
                },
                error: function (data) {
                    toastr.error("Some error occured. Please try again later.", "Failed!");

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