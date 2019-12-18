<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>OOZEE | Forgot Password</title>
    <!--global css starts-->
    <link rel="stylesheet" type="text/css" href="{{ asset('public/assets/css/bootstrap.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('public/assets/vendors/iCheck/css/square/blue.css') }}">
    <link rel="stylesheet" type="text/css"
          href="{{ asset('public/assets/vendors/bootstrapvalidator/css/bootstrapValidator.min.css') }}">
    <link type="text/css" rel="stylesheet" href="{{asset('public/assets/vendors/iCheck/css/all.css')}}"/>
    <link href="{{ asset('public/assets/vendors/bootstrapvalidator/css/bootstrapValidator.min.css') }}"
          rel="stylesheet"/>
    <link rel="stylesheet" type="text/css" href="{{ asset('public/assets/css/pages/login.css') }}">
    <link href="{{ asset('public/assets/vendors/toastr/css/toastr.css') }}" rel="stylesheet" type="text/css"/>
    <!--end of page level css-->
    <style>
        .vertical-offset-100 > .col-sm-6 {
            margin-right: auto;
            margin-left: auto;
        }
        .help-block{
            color: red;
        }
        .logo_bg {
            padding: 10px 0 10px 0 !important;
        }
    </style>
</head>
<body>
<div class="container">
    <div class="row vertical-offset-100">
        <div class="col-sm-6 col-sm-offset-3  col-md-5 col-md-offset-4 col-lg-4 col-lg-offset-4">
            <div id="container_demo">
                <div id="wrapper">
                    <div id="login" class="animate form">
                        <form action="{{ route('password.request') }}" id="reset_pw" autocomplete="on" method="post">
                            <h3 class="logo_bg"><img src="{{ asset('public/images/site_logo.png') }}" width="70%" height="70%" alt="oozee"></h3>
                            <p>
                                Enter your email address below and we'll send a special reset password link to your inbox.
                            </p>
                            @csrf
                            <div class="form-group">
                                <label style="margin-bottom:0;" for="username2" class="youmai">
                                    <i class="livicon" data-name="mail" data-size="16" data-loop="true" data-c="#3c8dbc" data-hc="#3c8dbc"></i> Your email
                                </label>
                                <input id="email" name="email" placeholder="your@mail.com" />
                                @if ($errors->has('email'))
                                    <span role="alert">
                                        <strong>{{ $errors->first('email') }}</strong>
                                    </span>
                                @endif
                            </div>
                            <div class="form-group ">
                                <button type="submit" class="btn btn-raised btn-success btn-block col-sm-12">{{ __('Send Password Reset Link') }}</button>
                            </div>
                            <p class="change_link" style="text-align: center;">
                                <a href="{{ url('/admin/login') }}">{{ __('Already have login and password ?') }}
                                </a>
                            </p>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<!--global js starts-->
<script type="text/javascript" src="{{ asset('public/assets/js/app.js') }}"></script>
<script type="text/javascript"
        src="{{ asset('public/assets/vendors/bootstrapvalidator/js/bootstrapValidator.min.js') }}"></script>
<script src="{{ asset('public/assets/vendors/iCheck/js/icheck.js') }}" type="text/javascript"></script>
<script type="text/javascript" src="{{ asset('public/assets/js/pages/login.js') }}"></script>
<script type="text/javascript" src="{{ asset('public/assets/vendors/toastr/js/toastr.js') }}"></script>
@include('admin.layout.notification')
</body>
</html>
