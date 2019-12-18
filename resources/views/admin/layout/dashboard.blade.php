<!DOCTYPE html>
<html>
<head>
<meta charset="UTF-8">
<title>
    @section('title')| OOZEE
    @show
</title>
<meta content='width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no' name='viewport'>
{{--CSRF Token--}}
<meta name="csrf-token" content="{{ csrf_token() }}">
<link href="{{ asset('public/assets_/css/app.css') }}" rel="stylesheet" type="text/css"/>
<link rel="stylesheet" type="text/css" href="{{ asset('public/assets_/css/jquery-jvectormap-1.2.2.css') }}">
<link rel="stylesheet" type="text/css" href="{{ asset('public/assets_/css/animate.min.css') }}">
<link rel="stylesheet" type="text/css" href="{{ asset('public/assets_/css/only_dashboard.css') }}">
@yield('styles')
<body class="skin-josh">
@include('admin.layout.dash_header')
<div class="wrapper row-offcanvas row-offcanvas-left">
    <aside class="left-side sidebar-offcanvas">
        <section class="sidebar ">
            <div class="page-sidebar  sidebar-nav">                
                <div class="clearfix"></div>
                <!-- BEGIN SIDEBAR MENU -->
                @include('admin.layout.sidebar')
                <!-- END SIDEBAR MENU -->
            </div>
        </section>
    </aside>
    <aside class="right-side">
        <!-- Main content -->
        <section class="content-header">
            @yield('content-header')
        </section>
        <section class="content">
            @yield('content')
        </section>
    </aside>
</div>
<a id="back-to-top" href="#" class="btn btn-primary btn-lg back-to-top" role="button" title="Return to top"
   data-toggle="tooltip" data-placement="left">
    <i class="livicon" data-name="plane-up" data-size="18" data-loop="true" data-c="#fff" data-hc="white"></i>
</a>

<script src="{{ asset('public/assets_/js/app.js') }}" type="text/javascript"></script>
<script src="{{ asset('public/assets_/js/moment.min.js') }}" type="text/javascript"></script>
<script src="{{ asset('public/assets_/js/countUp.js') }}" type="text/javascript"></script>
<script type="text/javascript" src="{{ asset('public/assets/vendors/toastr/js/toastr.js') }}"></script>
<script src="{{ asset('public/assets_/js/jquery.sparkline.js') }}" type="text/javascript"></script>
<script src="{{ asset('public/assets_/js/fullcalendar.min.js') }}" type="text/javascript"></script>

<script src="{{ asset('public/assets_/js/dashboard.js') }}" type="text/javascript"></script>

@include('admin.layout.notification')
@yield('scripts')
</body>
</html>
