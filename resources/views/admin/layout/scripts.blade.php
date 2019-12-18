@if(Request::is('admin/home'))
    <script src="{{ asset('public/assets_/js/app.js') }}" type="text/javascript"></script>
@else
    <script src="{{ asset('public/assets/js/app.js') }}" type="text/javascript"></script>
    <script type="text/javascript" src="{{ asset('public/assets/vendors/iCheck/js/icheck.js') }}"></script>
    <script type="text/javascript"
            src="{{ asset('public/assets/vendors/bootstrap-switch/js/bootstrap-switch.js') }}"></script>
    {{--<script type="text/javascript" src="{{ asset('public/assets/vendors/switchery/js/switchery.js') }}"></script>--}}
    <script type="text/javascript"
            src="{{ asset('public/assets/vendors/bootstrap-maxlength/js/bootstrap-maxlength.js') }}"></script>
    {{--<script type="text/javascript" src="{{ asset('public/assets/vendors/card/lib/js/jquery.card.js') }}"></script>--}}
    {{--<script type="text/javascript" src="{{asset('public/assets/js/jquery-2.1.4.js')}}"></script>--}}
    {{--<script type="text/javascript" src="{{ asset('public/prettyPhoto/js/jquery.prettyPhoto.js')}}"></script>--}}
    <script type="text/javascript" src="{{ asset('public/assets/vendors/toastr/js/toastr.js') }}"></script>
@endif