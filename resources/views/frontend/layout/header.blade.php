<!--Page Header-->
<header class="page-header">
    <!--RD Navbar-->
    <div class="rd-navbar-wrap">
        @if(!Request::is('/'))
            <nav class="rd-navbar menu-custom" data-layout="rd-navbar-fixed" data-sm-layout="rd-navbar-fixed"
                 data-sm-device-layout="rd-navbar-fixed" data-md-layout="rd-navbar-fixed"
                 data-md-device-layout="rd-navbar-fixed" data-lg-device-layout="rd-navbar-fixed"
                 data-xl-device-layout="rd-navbar-static" data-xxl-device-layout="rd-navbar-static"
                 data-lg-layout="rd-navbar-fixed" data-xl-layout="rd-navbar-static" data-xxl-layout="rd-navbar-static"
                 data-stick-up-clone="false" data-sm-stick-up="true" data-md-stick-up="true" data-lg-stick-up="true"
                 data-xl-stick-up="true" data-xxl-stick-up="true" data-lg-stick-up-offset="69px"
                 data-xl-stick-up-offset="1px" data-xxl-stick-up-offset="1px">
                <div class="rd-navbar-inner">
                    <!--RD Navbar Panel-->
                    <div class="rd-navbar-panel">
                        <button class="rd-navbar-toggle" data-rd-navbar-toggle=".rd-navbar-nav-wrap"><span></span>
                        </button>
                        <!--RD Navbar Brand-->
                        <div class="rd-navbar-brand">
                            <a class="brand-name" href="{{ url('/') }}">
                                <img style="height: 35px !important;"
                                     src="{{ asset('public/frontend/images/main/oozee_heading_logo_blue.png') }}"
                                     alt="">
                            </a>
                        </div>
                    </div>
                    <!--RD Navbar Nav-->
                    <div class="rd-navbar-nav-wrap">
                        <ul class="rd-navbar-nav">
                            <li class="custom-menu-li">
                                <a href="{{ url('/') }}">Home</a>
                            </li>
                            @foreach($commonPages as $page)
                                <li class="custom-menu-li">
                                    <a href="{{ url('/'.$page->slug) }}">{{ $page->title }}</a>
                                </li>
                            @endforeach
                            <li class="custom-menu-li">
                                <a href="{{ route('support') }}">Support</a>
                            </li>
                            {{--                            <li class="mobile-menu">--}}
                            {{--                                <a href="{{ route('blog') }}">Blog</a>--}}
                            {{--                            </li>--}}
                            {{--                            <li class="mobile-menu">--}}
                            {{--                                <a href="{{ route('news') }}">News</a>--}}
                            {{--                            </li>--}}

                            <li>
                                <a href="{{ route('download') }}"><img src="{{ asset('public/images/download_now_badge.png') }}" alt=""> </a>
                            </li>
                            <li>
                                @auth
                                    <a tabindex="2" data-popover-content="#unique-id" data-toggle="popover"
                                       data-placement="left" href="javascript:">
                                        <img src="{{ Auth::user()->avatar ? asset('public/'.Auth::user()->avatar) : asset('public/assets/images/authors/no_avatar.jpg') }}"
                                             alt="Avatar" class="avatar">
                                    </a>
                                    <div id="unique-id" style="display:none;">
                                        <div class="popover-body">
                                            <div class="img-content">
                                                <img src="{{ Auth::user()->avatar ? asset('public/'.Auth::user()->avatar) : asset('public/assets/images/authors/no_avatar.jpg') }}"
                                                     alt="Avatar" class="avatar">
                                                <div class="user-data">
                                                    <b>{{ Auth::user()->name }}</b>
                                                    <span class="user-email">{{ Auth::user()->email }}</span>
                                                </div>
                                            </div>
                                            <hr>
                                            <div class="sign-out">
                                                <a href="javascript:" onclick="$('#logout').submit()"
                                                   class="signout-btn">SIGN
                                                    OUT</a>
                                            </div>
                                        </div>
                                        <form method="post" action="{{ route('user.logout') }}" id="logout">
                                            @csrf
                                        </form>
                                        @else
                                            <a class="custom-menu-a" href="{{ route('login') }}">Sign In</a>
                                @endauth
                            </li>
                        </ul>
                    </div>
                </div>
            </nav>
        @endif
    </div>
</header>