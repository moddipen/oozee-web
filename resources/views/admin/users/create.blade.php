@extends('admin.layout.auth')

{{-- Page title --}}
@section('title')
    Add User
    @parent
@stop
{{-- Page header --}}
@section('content-header')
    <h1>Application User</h1>
    <ol class="breadcrumb">
        <li>
            <a href="{{ route('admin.admin-users.index') }}">
                <i class="livicon" data-name="users" data-size="14" data-color="#333" data-hovercolor="#333"></i>
                Users
            </a>
        </li>
        <li class="active">
            <a href="javascript:">
                Create
            </a>
        </li>
    </ol>
@endsection
{{-- page level styles --}}
@section('style')
    <!--page level css -->
    <link href="{{ asset('public/adminTheme/vendors/jasny-bootstrap/css/jasny-bootstrap.css') }}" rel="stylesheet">
    <link href="{{ asset('public/adminTheme/vendors/select2/css/select2.min.css') }}" type="text/css" rel="stylesheet">
    <link href="{{ asset('public/adminTheme/vendors/select2/css/select2-bootstrap.css') }}" rel="stylesheet">
    <link href="{{ asset('public/adminTheme/vendors/datetimepicker/css/bootstrap-datetimepicker.min.css') }}"
          rel="stylesheet">
    <link href="{{ asset('public/adminTheme/vendors/iCheck/css/all.css') }}" rel="stylesheet" type="text/css"/>
    <link href="{{ asset('public/adminTheme/css/pages/wizard.css') }}" rel="stylesheet">
    <!--end of page level css-->
@stop


{{-- Page content --}}
@section('content')
    <section class="content">
        <div class="row">
            <div class="col-md-12 col-sm-12 col-lg-12 my-3">
                <div class="card panel-primary">
                    <div class="card-heading">
                        <h3 class="card-title">
                            <i class="livicon" data-name="user-add" data-size="18" data-c="#fff" data-hc="#fff"
                               data-loop="true"></i>
                            Add New User
                        </h3>
                        <span class="float-right clickable">
                                    <i class="fa fa-chevron-up"></i>
                                </span>
                    </div>
                    <div class="card-body">
                        <!--main content-->
                        <form id="commentForm" action="{{ route('admin.users.store') }}"
                              method="POST" enctype="multipart/form-data" class="form-horizontal">
                            <!-- CSRF Token -->
                            <input type="hidden" name="_token" value="{{ csrf_token() }}"/>

                            @include('admin.users.form')
                        </form>
                    </div>
                </div>
            </div>
        </div>

        <!--row end-->
    </section>
@stop

{{-- page level scripts --}}
@section('script')
    <script src="{{ asset('public/adminTheme/vendors/iCheck/js/icheck.js') }}"></script>
    <script src="{{ asset('public/adminTheme/vendors/moment/js/moment.min.js') }}"></script>
    <script src="{{ asset('public/adminTheme/vendors/jasny-bootstrap/js/jasny-bootstrap.js') }}"
            type="text/javascript"></script>
    <script src="{{ asset('public/adminTheme/vendors/select2/js/select2.js') }}" type="text/javascript"></script>
    <script src="{{ asset('public/adminTheme/vendors/bootstrapwizard/jquery.bootstrap.wizard.js') }}"
            type="text/javascript"></script>
    <script src="{{ asset('public/adminTheme/vendors/bootstrapvalidator/js/bootstrapValidator.min.js') }}"
            type="text/javascript"></script>
    <script src="{{ asset('public/adminTheme/vendors/datetimepicker/js/bootstrap-datetimepicker.min.js') }}"
            type="text/javascript"></script>
    <script src="{{ asset('public/adminTheme/js/pages/adduser.js') }}"></script>
    <script>
        function formatState(state) {
            if (!state.id) {
                return state.text;
            }
            var $state = $(
                '<span><img src="{{ asset('public/adminTheme/img/countries_flags') }}/' + state.element.value.toLowerCase() + '.png" class="img-flag" width="20px" height="20px" /> ' + state.text + '</span>'
            );
            return $state;

        }

        $('#name').on('keyup', function () {
            $('#name_error').hide();
        });

        $('#email').on('keyup', function () {
            $('#email_error').hide();
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

    </script>
@stop
