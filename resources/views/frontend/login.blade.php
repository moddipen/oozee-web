<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>OOZEE | Login</title>
    <link rel="icon" href="{{ asset('public/images/fevicon_web_oozee.png') }}" type="image/x-icon">
    <link rel="stylesheet" type="text/css" href="{{ asset('public/assets/css/bootstrap.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('public/assets/vendors/iCheck/css/square/blue.css') }}">
    <link rel="stylesheet" type="text/css"
          href="{{ asset('public/assets/vendors/bootstrapvalidator/css/bootstrapValidator.min.css') }}">
    <link type="text/css" rel="stylesheet" href="{{asset('public/assets/vendors/iCheck/css/all.css')}}"/>
    <link href="{{ asset('public/assets/vendors/bootstrapvalidator/css/bootstrapValidator.min.css') }}"
          rel="stylesheet"/>
    <link rel="stylesheet" type="text/css" href="{{ asset('public/assets/css/pages/login.css') }}">
    <link href="{{ asset('public/assets/vendors/toastr/css/toastr.css') }}" rel="stylesheet" type="text/css"/>
    <style>

    </style>
</head>
<body>

<!--global js starts-->
<script type="text/javascript" src="{{ asset('public/assets/js/app.js') }}"></script>
<script type="text/javascript" src="{{ asset('public/assets/js/app.js') }}"></script>
<script type="text/javascript"
        src="{{ asset('public/assets/vendors/bootstrapvalidator/js/bootstrapValidator.min.js') }}"></script>
<script src="{{ asset('public/assets/vendors/iCheck/js/icheck.js') }}" type="text/javascript"></script>
<script type="text/javascript" src="{{ asset('public/assets/js/pages/login.js') }}"></script>
<script type="text/javascript" src="{{ asset('public/assets/vendors/toastr/js/toastr.js') }}"></script>
@include('admin.layout.notification')
<!--global js end-->
</body>
</html>

@extends('frontend.layout.app')
@section('after-styles')
    <link rel="stylesheet" type="text/css" href="{{ asset('public/assets/css/pages/login.css') }}">
    <style>
        .vertical-offset-100 > .col-sm-6 {
            margin-right: auto;
            margin-left: auto;
        }
        .help-block{
            color: red;
        }
        .sbtn{
            color: white !important;
            text-decoration: none !important;
        }
        .download-button {
            text-align: center !important;
        }
        .download-button-img {
            padding: 0 5% 0 5% !important;
        }
        .signin-btn {
            padding-bottom: 5% !important;
        }
    </style>
@endsection
@section('content')
    <div class="mainbg-login">
    <div class="container">
        <div class="row vertical-offset-100">
            <div class="col-sm-6 col-sm-offset-3  col-md-6 col-md-offset-4 col-lg-4 col-lg-offset-6">
                <div id="container_demo">
                    <div id="wrapper">
                        <div id="login" class="animate form">
                            <form>
                                <h3 class="black_bg">Sign in</h3>
                                <br>
                                <div class="form-group download-button">
                                    <a href="{{ route('oauth.login', 'google') }}">
                                        <img class="download-button-img" height="50" src="{{ asset('public/images/login_g.png') }}" alt="">
                                    </a>
                                </div>
                                <div class="form-group download-button">
                                    <a href="{{ route('oauth.login', 'facebook') }}">
                                        <img class="download-button-img signin-btn" height="50" src="{{ asset('public/images/login_f.png') }}" alt="">
                                    </a>
                                </div>
{{--                                <p class="change_link" style="text-align: center">--}}
{{--                                    <a href="{{ url('/') }}">--}}
{{--                                        Later--}}
{{--                                    </a>--}}
{{--                                </p>--}}
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
@section('after-scripts')
    <script type="text/javascript" src="{{ asset('public/assets/js/pages/login.js') }}"></script>
@endsection