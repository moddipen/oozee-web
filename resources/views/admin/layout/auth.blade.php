<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <title>
        @section('title')
            | OOZEE
        @show
    </title>
    <meta content='width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no' name='viewport'>
    {{--CSRF Token--}}
    <meta name="csrf-token" content="{{ csrf_token() }}">
    @include('admin.layout.styles')
    @yield('styles')
    <style type="text/css">
        .logo_header_text {
            color: #fff !important;
            margin-top: 10px !important;
        }
        .note-check > li > a {
            color: black !important;
        }

        .dropdown-style > li > a {
            color: black !important;
        }
    </style>
<body class="skin-josh">
@include('admin.layout.header')
<div class="wrapper">
    <!-- Left side column. contains the logo and sidebar -->
    <aside class="left-side ">
        <section class="sidebar ">
            <div class="page-sidebar  sidebar-nav">
                {{--<div class="nav_icons">--}}
                    {{--<ul class="sidebar_threeicons">--}}
                        {{--<li>--}}
                            {{--<a href="#">--}}
                                {{--<i class="livicon" data-name="table" title="Advanced tables" data-loop="true"--}}
                                   {{--data-color="#418BCA" data-hc="#418BCA" data-s="25"></i>--}}
                            {{--</a>--}}
                        {{--</li>--}}
                        {{--<li>--}}
                            {{--<a href="#">--}}
                                {{--<i class="livicon" data-name="list-ul" title="Tasks" data-loop="true"--}}
                                   {{--data-color="#e9573f" data-hc="#e9573f" data-s="25"></i>--}}
                            {{--</a>--}}
                        {{--</li>--}}
                        {{--<li>--}}
                            {{--<a href="#">--}}
                                {{--<i class="livicon" data-name="image" title="Gallery" data-loop="true"--}}
                                   {{--data-color="#F89A14" data-hc="#F89A14" data-s="25"></i>--}}
                            {{--</a>--}}
                        {{--</li>--}}
                        {{--<li>--}}
                            {{--<a href="#">--}}
                                {{--<i class="livicon" data-name="user" title="Users" data-loop="true"--}}
                                   {{--data-color="#6CC66C" data-hc="#6CC66C" data-s="25"></i>--}}
                            {{--</a>--}}
                        {{--</li>--}}
                    {{--</ul>--}}
                {{--</div>--}}
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
@include('admin.layout.scripts')
@include('admin.layout.notification')
@yield('scripts')
</body>
</html>
