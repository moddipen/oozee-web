<!DOCTYPE html>
<html>

<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    <title>404 page | Josh Admin Template</title>
    <meta content='width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no' name='viewport'>
    <!-- global level js-->
    <link href="{{ asset('public/adminTheme/css/bootstrap.min.css') }}" rel="stylesheet" type="text/css" />
    <!-- end of globallevel js-->
    <!-- page level styles-->
    <link rel="stylesheet" type="text/css" href="{{ asset('public/adminTheme/css/pages/404.css') }}" />
    <!-- end of page level styles-->
</head>

<body>
    <div id="animate" class="row">
        <div class="number">4</div>
        <div class="icon"> <i class="livicon" data-name="pacman" data-size="105" data-c="#f6c500" data-hc="#f1b21d" data-eventtype="click" data-iteration="15"></i>
        </div>
        <div class="number">4</div>
    </div>
    <div class="hgroup">
        <h1>Page Not Found</h1>
        <h2>It seems that page you are looking for no longer exists.</h2>
        <a href="{{ url('/') }}" class="btn btn-responsive btn-default button-alignment">Home
        </a>
    </div>
    <!-- global js -->
    <script src="{{ asset('public/adminTheme/js/app.js') }}" type="text/javascript"></script>
    <!-- end of global js -->
    <!-- begining of page level js-->
    <script src="{{ asset('public/adminTheme/js/404.js') }}"></script>
    <!-- end of page level js-->
</body>
</html>