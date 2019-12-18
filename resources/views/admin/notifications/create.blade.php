@extends('admin.layout.auth')

{{-- Page title --}}
@section('title')
    Send notifications
    @parent
@stop
{{-- Page header --}}
@section('content-header')
    <h1>Send notifications</h1>
    <ol class="breadcrumb">
        <li class="active">
            <a href="javascript:">
                Send notifications
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
    <section class="content">
        <div class="row">
            <div class="col-md-12 col-sm-12 col-lg-12 my-3">
                <div class="card panel-primary">
                    <div class="card-heading">
                        <h3 class="card-title">
                            <i class="livicon" data-name="user-add" data-size="18" data-c="#fff" data-hc="#fff"
                               data-loop="true"></i>
                            Notifications
                        </h3>
                        <span class="float-right clickable">
                                    <i class="fa fa-chevron-up"></i>
                                </span>
                    </div>
                    <div class="card-body">
                        <!--main content-->
                        <form id="commentForm" action="{{ route('admin.notification.send') }}"
                              method="POST" enctype="multipart/form-data" class="form-horizontal">
                            <!-- CSRF Token -->
                            <input type="hidden" name="_token" value="{{ csrf_token() }}"/>

                            <div id="rootwizard">
                                <ul>
                                    <li class="nav-item"><a href="#tab1" data-toggle="tab"></a></li>
                                </ul>
                                <div class="tab-content">
                                    <div class="tab-pane " id="tab1">
                                        <div class="form-group {{ $errors->first('title', 'has-error') }}">
                                            <div class="row">
                                                <label for="first_name" class="col-sm-2 control-label">Title *</label>
                                                <div class="col-sm-10">
                                                    <input required id="title" name="title" type="text" placeholder="Title" class="form-control required"/>
                                                    {!! $errors->first('title', '<span id="title_error" class="help-block">:message</span>') !!}
                                                </div>
                                            </div>
                                        </div>
                                        <div class="form-group {{ $errors->first('body', 'has-error') }}">
                                            <div class="row">
                                                <label for="body" class="col-sm-2 control-label">Body *</label>
                                                <div class="col-sm-10">
                                                    <textarea required name="body" class="form-control required" id="body"></textarea>
                                                    {!! $errors->first('body', '<span id="body_error" class="help-block">:message</span>') !!}
                                                </div>
                                            </div>
                                        </div>
                                        <div class="form-group {{ $errors->first('email', 'has-error') }}">
                                            <div class="row">
                                                <label for="type" class="col-sm-2 control-label">Notification Type *</label>
                                                <div class="col-sm-10">
                                                    <select class="form-control" name="type" id="type" required>
                                                        <option value="">Select notification type</option>
                                                        @foreach($types as $type)
                                                            <option value="{{ $type }}">{{ $type }}</option>
                                                        @endforeach
                                                    </select>
                                                    {!! $errors->first('type', '<span id="type_error" class="help-block">:message</span>') !!}
                                                </div>
                                            </div>
                                        </div>
                                        <div class="form-group {{ $errors->first('to', 'has-error') }}">
                                            <div class="row">
                                                <label for="to" class="col-sm-2 control-label">Send to *</label>
                                                <div class="col-sm-10">
                                                    <select class="form-control" name="to" id="to" required>
                                                        <option value="1">All Users</option>
                                                        <option value="2">Paid Users</option>
                                                        <option value="3">Free Users</option>
                                                    </select>
                                                    {!! $errors->first('to', '<span id="to_error" class="help-block">:message</span>') !!}
                                                </div>
                                            </div>
                                        </div>
                                        <button align='center' type="submit" class="btn btn-success btn-sm" id="delButton">Send
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
@stop
