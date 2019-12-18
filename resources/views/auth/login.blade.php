<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Login | Welcome to Admin panel</title>
    <!--global css starts-->
    <link rel="stylesheet" type="text/css" href="{{ asset('public/assets/css/bootstrap.css') }}">
    <link rel="shortcut icon" href="{{ asset('public/assets/images/favicon.ico') }}" type="image/x-icon">
    <link rel="icon" href="{{ asset('public/assets/images/favicon.ico') }}" type="image/x-icon">
    <!--end of global css-->
    <!--page level css starts-->
    <link type="text/css" rel="stylesheet" href="{{asset('public/assets/vendors/iCheck/css/all.css')}}" />
    <link href="{{ asset('public/assets/vendors/bootstrapvalidator/css/bootstrapValidator.min.css') }}" rel="stylesheet"/>
    <link rel="stylesheet" type="text/css" href="{{ asset('public/adminTheme/css/login.css') }}">
    <!--end of page level css-->
</head>
<body>
<div class="container">
    <!--Content Section Start -->
    <div class="row">
        <div class="box animation flipInX font_size ">
            <div class="box1" align = 'center'>
              
            <h3 class="text-primary"><br/>Login</h3><br/>
                <!-- Notifications -->
                <div id="notific">
                @include('admin.layout.notification')
                </div>
                <form action="{{ route('login') }}" class="omb_loginForm"  autocomplete="off" method="POST">
                    <input type="hidden" name="_token" value="{{ csrf_token() }}">
                    <div class="form-group {{ $errors->first('email', 'has-error') }}">
                        <label class="sr-only">Email</label>
                        <input type="email" id="email"  class="form-control" name="email" placeholder="Email"
                               value="{!! old('email') !!}">
                    </div>
                    <span class="help-block">{{ $errors->first('email', ':message') }}</span>
                    <div class="form-group {{ $errors->first('password', 'has-error') }}">
                        <label class="sr-only">Password</label>
                        <input type="password" id="password" class="form-control" name="password" placeholder="Password">
                    </div>
                    <span class="help-block">{{ $errors->first('password', ':message') }}</span>
                    
                    <input type="submit" class="btn btn-block btn-primary" value="Log In">
                    
                </form>
                <br/>
                    <a class="btn btn-link" href="{{ route('password.request') }}">
                    {{ __('Forgot Your Password?') }}
                </a>
            </div>
                
            
        </div>
    </div>
    <!-- //Content Section End -->
</div>
<!--global js starts-->
<script type="text/javascript" src="{{ asset('public/assets/src/js/jquery.min.js') }}"></script>
<script type="text/javascript" src="{{ asset('public/assets/js/bootstrap.min.js') }}"></script>
<script src="{{ asset('public/assets/vendors/assets/js/bootstrapValidator.min.js') }}" type="text/javascript"></script>
<script type="text/javascript" src="{{ asset('public/assets/vendors/iCheck/js/icheck.js') }}"></script>
<script type="text/javascript" src="{{ asset('public/assets/js/login_custom.js') }}"></script>
<!--global js end-->
</body>
</html>
