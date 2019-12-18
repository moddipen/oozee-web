<link rel="icon" href="{{ asset('public/images/fevicon_web_oozee.png') }}" type="image/x-icon">
<link rel="stylesheet" type="text/css"
      href="//fonts.googleapis.com/css?family=Libre+Franklin:200,300,500,600,300italic">
<link rel="stylesheet" href="{{ asset('public/frontend/css/bootstrap.css') }}">
<link rel="stylesheet" href="{{ asset('public/frontend/css/style.css') }}">
<link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.8.2/css/all.css">
<link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
<style>
    .menu-custom {
        background: #fff !important;
    }
    .menu-custom .rd-navbar-nav > li > a {
        color: #000;
    }
    .menu-custom .rd-navbar-nav > li > a:hover {
        color: #2bcdd8 !important;
    }
    .search_listheader_bf{
        background: /*url({{ asset('public/images/search_graphics.png')}}) no-repeat right 72%*/ #00d1e0 !important;
    }
    .searhv-icon-inner{
        width: 64px; height: 64px;
        position: absolute; top: 2px; right: -5px;
    }
    .search_listheader_bf{ position:relative;  }
    .avatar{
        border-radius:50%;
        margin-right:10px;
    }
    .search_listheader_bf:before {
    content: "";
    position: absolute;
    width: 104%;
    bottom: 0;
    height: 45px;
    background: #fff;
    left: -41px;
    border-top-right-radius: 50%;
    border-top-left-radius: 50%;
}
    .img-content{
        display:inline-flex;
    }
    .user-data
    {
        /*text-align:right !important;*/
    }
    .signout-btn{
        float:right;
    }
    .popover {
        max-width: 306.6px;
        border-radius: 6px;
        border: none;
    }
    .popover-body {
        border: none;
        padding: 20px;
        font-size: 15px;
        z-index: 2;
        line-height: 1.53;
        letter-spacing: 0.1px;
    }
    .sign-out{
        padding-top: 10px;
        padding-bottom: 10px;
    }

    .signout-btn {
        color: grey !important;
    }

    .user-email{
        font-size: 12px !important;
    }
</style>