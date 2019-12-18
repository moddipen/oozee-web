<link rel="icon" href="{{ asset('public/images/fevicon_web_oozee.png') }}" type="image/x-icon">
@if(Request::is('admin/home'))
    <link href="{{ asset('public/assets_/css/app.css') }}" rel="stylesheet" type="text/css"/>
@else
    <link href="{{ asset('public/assets/css/app.css') }}" rel="stylesheet" type="text/css"/>
    <link rel="stylesheet" type="text/css" href="{{ asset('public/assets/vendors/iCheck/css/all.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('public/assets/vendors/iCheck/css/line/line.css') }}">
    <link rel="stylesheet" type="text/css"
          href="{{ asset('public/assets/vendors/bootstrap-switch/css/bootstrap-switch.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('public/assets/vendors/switchery/css/switchery.css') }}">
    {{--<link rel="stylesheet" type="text/css"--}}
    {{--href="{{ asset('public/assets/vendors/awesome-bootstrap-checkbox/css/awesome-bootstrap-checkbox.css') }}">--}}
    <link href="{{ asset('public/assets/css/pages/icon.css') }}" rel="stylesheet" type="text/css"/>
    <link rel="stylesheet" type="text/css" href="{{ asset('public/assets/vendors/toastr/css/toastr.css') }}">
@endif