@extends('admin.layout.auth')

{{-- Page title --}}
@section('title')
    Edit News
    @parent
@stop
{{-- Page header --}}
@section('content-header')
    <h1>Blog</h1>
    <ol class="breadcrumb">
        <li>
            <a href="{{ route('admin.news.index') }}">
                <i class="livicon" data-name="users" data-size="14" data-color="#333" data-hovercolor="#333"></i>
                News
            </a>
        </li>
        <li class="active">
            <a href="javascript:">
                Edit
            </a>
        </li>
    </ol>
@endsection
{{-- page level styles --}}
@section('styles')
    <link href="{{ asset('public/assets/vendors/jasny-bootstrap/css/jasny-bootstrap.css') }}" rel="stylesheet">
    <link href="{{ asset('public/assets/vendors/iCheck/css/all.css') }}" rel="stylesheet" type="text/css"/>
    <link href="{{ asset('public/assets/vendors/bootstrap-switch/css/bootstrap-switch.css') }}" rel="stylesheet"
          type="text/css"/>
    <link href="{{ asset('public/assets/css/pages/wizard.css') }}" rel="stylesheet">
    <link href="{{ asset('public/assets/vendors/trumbowyg/css/trumbowyg.min.css') }}" rel="stylesheet" type="text/css">
    <link rel="stylesheet"
          href="{{ asset('public/assets/vendors/bootstrap3-wysihtml5-bower/css/bootstrap3-wysihtml5.min.css') }}"/>
    <link rel="stylesheet" href="{{ asset('public/assets/css/pages/editor.css') }}"/>
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
                            Edit news
                        </h3>
                        <span class="float-right clickable">
                                    <i class="fa fa-chevron-up"></i>
                                </span>
                    </div>
                    <div class="card-body">
                        <!--main content-->
                        <form id="commentForm" action="{{ route('admin.news.update', $news->id) }}"
                              method="POST" enctype="multipart/form-data" class="form-horizontal">
                            @method('PUT')
                            <!-- CSRF Token -->
                            <input type="hidden" name="_token" value="{{ csrf_token() }}"/>
                            @include('admin.news.form')
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
    <script src="{{ asset('public/assets/vendors/bootstrap-switch/js/bootstrap-switch.js') }}"
            type="text/javascript"></script>
    <script src="{{ asset('public/assets/js/pages/adduser.js') }}"></script>
    <script src="{{ asset('public/assets/vendors/ckeditor/js/ckeditor.js') }}"></script>
    <script src="{{ asset('public/assets/vendors/ckeditor/js/jquery.js') }}"></script>
    <script src="{{ asset('public/assets/vendors/ckeditor/js/config.js') }}"></script>
    <script type="text/javascript" src="{{ asset('public/assets/js/pages/radio_checkbox.js') }}"></script>
    <script>
        $('#title').on('keyup', function () {
            $('#title_error').hide();
        });
        $('#ckeditor_full').on('keyup', function () {
            $('#content_error').hide();
        });
        $('#ckeditor_full').ckeditor({
            height: '250px'
        });
        $('#ckeditor_full').config.allowedContent = true;
        CKEDITOR.config.allowedContent = true
    </script>
@stop
