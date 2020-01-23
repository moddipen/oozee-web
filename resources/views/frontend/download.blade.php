@extends('frontend.layout.app')
@section('after-styles')
    <link rel="stylesheet" type="text/css" href="{{ asset('public/assets/css/pages/login.css') }}">
    <style>
        .vertical-offset-100 > .mr-auto {
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
            padding: 0 10% 10% 10% !important;
        }
    </style>
@endsection
@section('content')
<div class="mainbg-login">
    <div class="container">
        <div class="row vertical-offset-100">
            <div class="col-sm-9 col-sm-offset-3  col-md-6 col-md-offset-4 col-lg-4 col-lg-offset-6 mr-auto">
                <div id="container_demo" class="download-box">
                    <div id="wrapper">
                        <div id="login" class="animate form download_bg">
                            <form> 
                               <!-- <a href="#" class="close_icon">
                                     <img src="{{ asset('public/frontend/images/close.png') }}" alt="Close">
                                </a> -->
                                <h3 class="black_bg">Dowload oozee <br> on your device.</h3>
                                <br>
                                <div class="form-group download-button">
                                    <a href="https://play.google.com/store/apps/details?id=com.app.oozee">
                                        <img class="download-button-img" height="50" src="{{ asset('public/frontend/images/google.png') }}" alt="">
                                    </a>
                                </div>
                                <div class="form-group download-button">
                                    <a href="https://apps.apple.com/in/app/oozee-smart-phonebook-chat/id1478753850">
                                        <img class="download-button-img" height="50" src="{{ asset('public/frontend/images/ios.png') }}" alt="">
                                    </a>
                                </div>
{{--                                <div class="form-group download-button">--}}
{{--                                    <a href="#">--}}
{{--                                        <img class="download-button-img" height="50" src="{{ asset('public/frontend/images/apk_download.png') }}" alt="">--}}
{{--                                    </a>--}}
{{--                                </div>--}}
                                {{--                            <p class="change_link" style="text-align: center">--}}
                                {{--                                <a href="{{ url('/') }}">--}}
                                {{--                                    Later--}}
                                {{--                                </a>--}}
                                {{--                            </p>--}}
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