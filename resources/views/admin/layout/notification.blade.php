<script>

    toastr.options = {
        "closeButton": true,
        "debug": false,
        "positionClass": "toast-top-right",
        "onclick": null,
        "showDuration": "1000",
        "hideDuration": "1000",
        "timeOut": "5000",
        "extendedTimeOut": "1000",
        "showEasing": "swing",
        "hideEasing": "swing",
        "showMethod": "show",
        "hideMethod": "hide"
    }

    @if(session()->has('success'))
    toastr.success("{{ session('success') }}", "Hurray");
    {{ session()->forget('success')  }}
    @endif

    @if(session()->has('info'))
    toastr.info("{{ session('info') }}", "Hurray");
    {{ session()->forget('info')  }}
    @endif

    @if(session()->has('status'))
    toastr.success("{{ session('status') }}", "Hurray");
    {{ session()->forget('status')  }}
    @endif

    @if(session()->has('warning'))
    toastr.warning("{{ session('warning') }}");
    {{ session()->forget('warning')  }}
    @endif

    @if(session()->has('error'))
    toastr.error("{{ session('error') }}");
    {{ session()->forget('error')  }}
    @endif

</script>