@extends('admin.layout.auth')

{{-- Page title --}}
@section('title')
    Profile
    @parent
@stop
{{-- Page header --}}
@section('content-header')
    <h1>Admin profile</h1>
    <ol class="breadcrumb">
        <li>
            <a href="{{ route('admin.home') }}">
                <i class="livicon" data-name="home" data-size="14" data-color="#333" data-hovercolor="#333"></i>
                Dashboard
            </a>
        </li>
        <li>
            <a href="#">
                <i class="livicon" data-name="users" data-size="14" data-color="#333" data-hovercolor="#333"></i>
                Update profile
            </a>
        </li>
    </ol>
@endsection
{{-- page level styles --}}
@section('styles')
    <style>
        .checkbox {
            color: black !important;
        }
    </style>
    <!--page level css -->
    <link href="{{ asset('public/assets/vendors/jasny-bootstrap/css/jasny-bootstrap.css') }}" rel="stylesheet">
    <link href="{{ asset('public/assets/vendors/select2/css/select2.min.css') }}" type="text/css" rel="stylesheet">
    <link href="{{ asset('public/assets/vendors/select2/css/select2-bootstrap.css') }}" rel="stylesheet">
    <link href="{{ asset('public/assets/vendors/datetimepicker/css/bootstrap-datetimepicker.min.css') }}"
          rel="stylesheet">
    <link href="{{ asset('public/assets/vendors/iCheck/css/all.css') }}" rel="stylesheet" type="text/css"/>
    <link href="{{ asset('public/assets/css/pages/wizard.css') }}" rel="stylesheet">

    <!--end of page level css-->
@stop


{{-- Page content --}}
@section('content')
    <section class="content paddingleft_right15">
        <div class="row">
            <div class="col-12">
                <div class="card panel-primary">
                    <div class="card-heading">
                        <h4 class="card-title pull-left add_remove_title" style="margin-top: 5px;">
                            <i class="livicon" data-name="user-add" data-size="16" data-c="#fff" data-hc="#fff"
                               data-loop="true"></i>
                            Update profile
                        </h4>
                        <div class="pull-right">
                            <a type="button" href="javascript:" onclick="changePassword()"
                               class="btn btn-default btn-sm"
                               data-toggle="tooltip" data-placement="left" data-original-title="Change password"
                               id="delButton">Change Password
                            </a>
                        </div>
                    </div>
                    <div class="card-body">
                        <!--main content-->
                        <form id="commentForm" action="{{ route('admin.update-profile') }}"
                              method="POST" enctype="multipart/form-data" class="form-horizontal">
                        <!-- CSRF Token -->
                            <input type="hidden" name="_token" value="{{ csrf_token() }}"/>
                            <div id="rootwizard">
                                <ul>
                                    <li class="nav-item"><a href="#tab1" data-toggle="tab"></a></li>
                                </ul>
                                <div class="tab-content">
                                    <div class="tab-pane " id="tab1">
                                        <div class="form-group {{ $errors->first('name', 'has-error') }}">
                                            <div class="row">
                                                <label for="first_name" class="col-sm-2 control-label">Name *</label>
                                                <div class="col-sm-10">
                                                    <input id="name" name="name" type="text" @if(!empty(old('name'))) value="{!! old('name') !!}" @elseif(!empty($adminUser)) value="{{ $adminUser->name }}" @else value="{!! old('name') !!}" @endif
                                                    placeholder="Name" class="form-control required"/>

                                                    {!! $errors->first('name', '<span id="name_error" class="help-block">:message</span>') !!}
                                                </div>
                                            </div>
                                        </div>
                                        <div class="form-group {{ $errors->first('username', 'has-error') }}">
                                            <div class="row">
                                                <label for="username" class="col-sm-2 control-label">Username *</label>
                                                <div class="col-sm-10">
                                                    <input id="username" name="username" type="text"
                                                           placeholder="Username" class="form-control required"
                                                           @if(!empty(old('username'))) value="{!! old('username') !!}"
                                                           @elseif(!empty($adminUser)) value="{{ $adminUser->username }}" @else value="{!! old('username') !!}" @endif/>

                                                    {!! $errors->first('username', '<span id="username_error" class="help-block">:message</span>') !!}
                                                </div>
                                            </div>
                                        </div>
                                        <div class="form-group {{ $errors->first('email', 'has-error') }}">
                                            <div class="row">
                                                <label for="email" class="col-sm-2 control-label">Email *</label>
                                                <div class="col-sm-10">
                                                    <input id="email" name="email" placeholder="E-mail" type="text"
                                                           class="form-control required email" value="{{ $adminUser->email }}" readonly/>
                                                </div>
                                            </div>
                                        </div>
                                            <button align='center' type="submit" class="btn btn-success btn-sm"
                                                    data-toggle="" data-placement="left"
                                                    data-original-title="Update Admin User" id="delButton">Update
                                            </button>
                                    </div>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
        <!--row end-->
    </section>
    <!-- /.modal-dialog -->
    <div class="modal fade" id="change_password" tabindex="-1" role="dialog" aria-labelledby="deleteLabel"
         aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title" id="deleteLabel">Change Password</h4>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span
                                aria-hidden="true">&times;</span></button>
                </div>
                <form id="changePasswordForm" action="{{ route('admin.admin-users.password-change', $adminUser->id) }}"
                      method="post" class="form-horizontal">
                    @method('PUT')
                    <input type="hidden" name="_token" value="{{ csrf_token() }}"/>
                    <div class="modal-body">
                        <div id="pid" class="form-group {{ $errors->first('password', 'has-error') }}">
                            <div class="row">
                                <div class="col-sm-12">
                                    <input id="password" name="password" minlength="6"  type="password"
                                           placeholder="Password"
                                           class="form-control"/>
                                    {!! $errors->first('password', '<span id="password_error" class="help-block">:message</span>') !!}
                                </div>
                            </div>
                        </div>
                        <div id="cpid" class="form-group {{ $errors->first('password_confirm', 'has-error') }}">
                            <div class="row">
                                <div class="col-sm-12">
                                    <input id="password_confirm" name="password_confirm" type="password"
                                           placeholder="Confirm Password "
                                           class="form-control"/>
                                    {!! $errors->first('password_confirm', '<span id="password_confirm_error" class="help-block">:message</span>') !!}
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancel</button>
                        <button type="submit" class="btn btn-danger Remove_square">
                            Change Password
                        </button>
                    </div>
                </form>
            </div>
            <!-- /.modal-content -->
        </div>
    </div>
@stop

{{-- page level scripts --}}
@section('scripts')
    <script src="{{ asset('public/assets/vendors/iCheck/js/icheck.js') }}"></script>
    <script src="{{ asset('public/assets/vendors/moment/js/moment.min.js') }}"></script>
    <script src="{{ asset('public/assets/vendors/jasny-bootstrap/js/jasny-bootstrap.js') }}"
            type="text/javascript"></script>
    <script src="{{ asset('public/assets/vendors/select2/js/select2.js') }}" type="text/javascript"></script>
    <script src="{{ asset('public/assets/vendors/bootstrapwizard/jquery.bootstrap.wizard.js') }}"
            type="text/javascript"></script>
    <script src="{{ asset('public/assets/vendors/bootstrapvalidator/js/bootstrapValidator.min.js') }}"
            type="text/javascript"></script>
    <script src="{{ asset('public/assets/vendors/datetimepicker/js/bootstrap-datetimepicker.min.js') }}"
            type="text/javascript"></script>
    <script src="{{ asset('public/assets/js/pages/adduser.js') }}"></script>
    <script>
        $("#select22").select2({
            theme: "bootstrap",
            placeholder: "Select roles",
            closeOnSelect: false
        });

        function changePassword() {
            $('#pid').removeClass('has-error');
            $('#cpid').removeClass('has-error');
            $('#changePasswordForm')[0].reset();
            $('.help-block').text('');
            $("#change_password").modal("show");
        }

        $('#name').on('keyup', function () {
            $('#name_error').hide();
        });

        $('#email').on('keyup', function () {
            $('#email_error').hide();
        });

        $('#password').on('keyup', function () {
            $('#password_error').hide();
        });

        $('#password_confirm').on('keyup', function () {
            $('#password_confirm_error').hide();
        });

        $('#select21').on('change', function () {
            $('#select_id').hide();
        });

        $('#username').on('change', function () {
            $('#username_error').hide();
        });

        $('#name').on('change', function () {
            $('#name_error').hide();
        });

        $('.roles').on('change', function () {
            $('#roles_error').hide();
        });
        @if($errors->first('password') || $errors->first('password_confirm'))
        $("#change_password").modal("show");
        @endif
    </script>
@stop
