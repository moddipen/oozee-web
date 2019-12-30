<!DOCTYPE html>
<html class="wide wow-animation" lang="en">
    <head>
        <title>OOZEE</title>
        <meta charset="utf-8">
        <meta name="format-detection" content="telephone=no">
        <meta name="viewport"
              content="width=device-width, height=device-height, initial-scale=1.0, maximum-scale=1.0, user-scalable=0">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="csrf-token" content="{{ csrf_token() }}">
        @include('frontend.layout.styles')
        <style>
            .avatar {
                vertical-align: middle;
                width: 50px;
                height: 50px;
                border-radius: 50%;
            }
            .btn-round {
                border-radius: 22px !important;
            }
            .spam-data {
                color: red !important;
            }
        </style>
        <script data-ad-client="ca-pub-3126411919241531" async src="https://pagead2.googlesyndication.com/pagead/js/adsbygoogle.js"></script>
        @yield('after-styles')
    </head>
    <body>
        <!--Page-->
        <div class="page">
            <div id="page-loader">
                <div class="cssload-container">
                    <div class="cssload-speeding-wheel"></div>
                </div>
            </div>
            @include('frontend.layout.header')
            @yield('content')
            @include('frontend.layout.footer')
        </div>
        <!--Global Mailform Output-->
        <div class="snackbars" id="form-output-global"></div>
        @include('frontend.layout.scripts')
        @yield('after-scripts')
    </body>
</html>