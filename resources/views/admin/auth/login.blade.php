<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>OOZEE | Admin Login</title>
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
        .form-group-cutom {
            padding: 0 5% 0 5% !important;
        }
        .change_link {
            padding-bottom: 5% !important;
        }
    </style>
</head>
<body>
<div class="container">
    <div class="row vertical-offset-100">
        <div class="col-sm-6 col-sm-offset-3  col-md-6 col-md-offset-4 col-lg-4 col-lg-offset-6">
            <div id="container_demo">
                <div id="wrapper">
                    <div id="login" class="animate form">
                        <form action="{{ url('/admin/login') }}" id="login_form" autocomplete="on" method="post">
                            @csrf
                            <h3 class="logo_bg"><img src="{{ asset('public/images/site_logo.png') }}" width="70%" height="70%" alt="oozee"></h3>
                            <div class="form-group form-group-cutom">
                                <label style="margin-bottom:0;" for="email1" class="uname control-label">
                                    <i
                                            class="livicon" data-name="mail" data-size="16" data-loop="true"
                                            data-c="#3c8dbc" data-hc="#3c8dbc"></i>
                                    E-mail or Username
                                </label>
                                <input id="username" name="username" placeholder="E-mail or Username"/>
                                <div class="col-sm-12">
                                </div>
                            </div>
                            <div class="form-group form-group-cutom">
                                <label style="margin-bottom:0;" for="password" class="youpasswd">
                                    <i class="livicon"
                                       data-name="key"
                                       data-size="16"
                                       data-loop="true"
                                       data-c="#3c8dbc"
                                       data-hc="#3c8dbc"></i>
                                    Password
                                </label>
                                <input type="password" id="password" name="password" placeholder="Enter a password"/>
                                <div class="col-sm-12">
                                </div>
                            </div>
                            <div class="form-group form-group-cutom">
                                <button type="submit" class="btn btn-success col-sm-12">Log In</button>
                            </div>
                            <p class="change_link" style="text-align: center">
                                <a href="{{ url('/admin/password/reset') }}">Forgot
                                    password ?
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
