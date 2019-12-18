<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>OOZEE | Reset Password</title>
    <!--global css starts-->
    <link rel="stylesheet" type="text/css" href="{{ asset('public/assets/css/bootstrap.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('public/assets/vendors/iCheck/css/square/blue.css') }}">
    <link rel="stylesheet" type="text/css"
          href="{{ asset('public/assets/vendors/bootstrapvalidator/css/bootstrapValidator.min.css') }}">
    <link rel="shortcut icon" href="{{ asset('public/assets/images/favicon.ico') }}" type="image/x-icon">
    <link rel="icon" href="{{ asset('public/assets/images/favicon.ico') }}" type="image/x-icon">
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
                        <form action="{{ route('password.email') }}" id="reset_password" autocomplete="on"
                              method="post">
                            <h3 class="logo_bg"><img src="{{ asset('public/images/site_logo.png') }}" width="70%" height="70%" alt="oozee"></h3>
                            @csrf
                            <input type="hidden" value="{{ $token }}" name="token">
                            <div class="form-group {{ $errors->first('email', 'has-error') }}">
                                <label style="margin-bottom:0;" for="email1" class="uname control-label">
                                    <i
                                            class="livicon" data-name="mail" data-size="16" data-loop="true"
                                            data-c="#3c8dbc" data-hc="#3c8dbc"></i>
                                    E-mail
                                </label>
                                <input id="email" placeholder="Email" type="email" class="form-control" name="email"
                                       value="{{ old('email') }}" autofocus>

                                @if ($errors->has('email'))
                                    <span role="alert">
                                        <strong>{{ $errors->first('email') }}</strong>
                                    </span>
                                @endif
                            </div>
                            <div class="form-group{{ $errors->has('password') ? ' has-error' : '' }}">
                                <label style="margin-bottom:0;" for="password" class="youpasswd">
                                    <i class="livicon"
                                       data-name="key"
                                       data-size="16"
                                       data-loop="true"
                                       data-c="#3c8dbc"
                                       data-hc="#3c8dbc"></i>
                                    Password
                                </label>
                                <input type="password" id="password" name="password" placeholder="Password"/>
                                @if ($errors->has('password'))
                                    <span>
                                        <strong>{{ $errors->first('password') }}</strong>
                                    </span>
                                @endif
                                <div class="col-sm-12">
                                </div>
                            </div>
                            <div class="form-group{{ $errors->has('password_confirmation') ? ' has-error' : '' }}">
                                <label style="margin-bottom:0;" for="password" class="youpasswd">
                                    <i class="livicon"
                                       data-name="key"
                                       data-size="16"
                                       data-loop="true"
                                       data-c="#3c8dbc"
                                       data-hc="#3c8dbc"></i>
                                    Password
                                </label>
                                <input id="password-confirm" placeholder="Confirm Password" type="password"
                                       class="form-control"
                                       name="password_confirmation">

                                @if ($errors->has('password_confirmation'))
                                    <span>
                                        <strong>{{ $errors->first('password_confirmation') }}</strong>
                                    </span>
                                @endif
                            </div>
                            <div class="form-group ">
                                <button type="submit" class="btn btn-raised btn-success btn-block col-sm-12">{{ __('Reset Password') }}</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<!--global js starts-->
<script type="text/javascript" src="{{ asset('public/assets/js/app.js') }}"></script>
<script type="text/javascript" src="{{ asset('public/assets/js/app.js') }}"></script>
<script type="text/javascript"
        src="{{ asset('public/assets/vendors/bootstrapvalidator/js/bootstrapValidator.min.js') }}"></script>
<script src="{{ asset('public/assets/vendors/iCheck/js/icheck.js') }}" type="text/javascript"></script>
<script type="text/javascript" src="{{ asset('public/assets/js/pages/login.js') }}"></script>
<script type="text/javascript" src="{{ asset('public/assets/vendors/toastr/js/toastr.js') }}"></script>
@include('admin.layout.notification')
</body>
</html>

