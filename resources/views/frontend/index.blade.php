@extends('frontend.layout.app')
@section('content')
    <!--Swiper-->
    <section>
        <div class="mainbg">
            <div class="container">
                <nav class="nav">
                    <ul>
                        <li class="signin">
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
                                            <a href="javascript:" onclick="$('#logout').submit()" class="signout-btn">SIGN
                                                OUT</a>
                                        </div>
                                    </div>
                                    <form method="post" action="{{ route('user.logout') }}" id="logout">
                                        @csrf
                                    </form>
                                    @else
                                        <a href="{{ route('login') }}">Sign in <i class="icon"><img
                                                        src="public/frontend/images/main/sign_in_icon.png" alt=""></i>
                                        </a>
                            @endauth
                        </li>
                        @foreach($commonPages as $page)
                            <li class="">
                                <a href="{{ url('/'.$page->slug) }}">{{ $page->title }}</a>
                            </li>
                        @endforeach
                        <li class="">
                            <a href="{{ route('support') }}">Support</a>
                        </li>
                        {{--                        <li class="mobile-menu">--}}
                        {{--                            <a href="{{ route('blog') }}">Blog</a>--}}
                        {{--                        </li>--}}
                        {{--                        <li class="mobile-menu">--}}
                        {{--                            <a href="{{ route('news') }}">News</a>--}}
                        {{--                        </li>--}}
                    </ul>
                </nav>
                <div class="margin-block">
                    <div class="logo"><img src="public/frontend/images/main/oozee_heading_logo.png" alt=""></div>
                    <div class="tagline">
                        <img src="public/frontend/images/main/tagline.png" alt="">
                    </div>
                    <form id="search-form" class="rd-mailform_sizing-1 rd-mailform-inline-flex text-center"
                          method="post"
                          action="{{ route('frontend.search') }}">
                        @csrf
                        <div class="searchblock">
                            <div class="country-code">
                                <select name="iso" id="country_id">
                                    @foreach($countries as $country)
                                        <option {{ $ccode == $country->iso ? 'selected' : '' }} value="{{ $country->iso }}">{{ $country->iso }}
                                            (+{{ $country->code }})
                                        </option>
                                    @endforeach
                                </select>
                            </div>
                            <input type="number" class="history-input input-search numbers" id="number"
                                   autocomplete="off"
                                   name="number"/>
                            <a href="javascript:" onclick="$('#search-form').submit()" class="searhv-icon">
                                <img src="public/frontend/images/main/search.png" alt="">
                            </a>
                            <div class="clearfix"></div>
                        </div>
                    </form>
                    <div class="app-block">
                        <h3> Get The App :</h3>
                        <div class="row nomarg justify-content-lg-center">
                            <div class="col-lg-6 col-xl-6 col-md-6 col-sm-6 col-6 appimg">
                                <a href="https://play.google.com/store/apps/details?id=com.app.oozee" target="_blank" >
                                    <img src="public/frontend/images/main/gp.png" alt="">
                                </a>
                            </div>
                            <div class="col-lg-6 col-xl-6 appimg col-md-6 col-sm-6 col-6">
                                <a href="https://apps.apple.com/in/app/oozee-smart-phonebook-chat/id1478753850" target="_blank" >
                                    <img class="app-store" src="public/frontend/images/main/pp store.png" alt="">
                                </a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!--Presentation-->
    {{--    <section class="section-xl bg-default text-center" id="section-see-features">--}}
    {{--        <div class="container">--}}
    {{--            <div class="row justify-content-lg-center">--}}
    {{--                <div class="col-lg-10 col-xl-8">--}}
    {{--                    <h3>Consistency is the key</h3>--}}
    {{--                    <p>Monstroid² boasts clean and crispy design, bulletproof layout consistency and intuitive--}}
    {{--                        navigation.--}}
    {{--                        The template was created by top industry leaders in web design and user experience. Improve your--}}
    {{--                        audience engagement and loyalty with simple and user friendly tools offered by our template.</p>--}}
    {{--                </div>--}}
    {{--            </div>--}}
    {{--        </div>--}}
    {{--    </section>--}}

    <!--Blurbs-->
    {{--    <section class="section-xl bg-gray-lighter">--}}
    {{--        <div class="container">--}}
    {{--            <div class="row row-50">--}}
    {{--                <div class="col-md-6 col-lg-4">--}}
    {{--                    <!--Blurb minimal-->--}}
    {{--                    <article class="blurb blurb-minimal">--}}
    {{--                        <div class="unit flex-row unit-spacing-md">--}}
    {{--                            <div class="unit-left">--}}
    {{--                                <div class="blurb-minimal__icon"><span class="icon linear-icon-magic-wand"></span></div>--}}
    {{--                            </div>--}}
    {{--                            <div class="unit-body">--}}
    {{--                                <p class="blurb__title">Pixel Perfect Typography</p>--}}
    {{--                                <p>It’s impossible to ignore the fact that perfect typography is a key asset of design--}}
    {{--                                    success. We concentrated on classic proportions, great readability and better user--}}
    {{--                                    experience to produce modern and user friendly template that adds value to any--}}
    {{--                                    project.</p>--}}
    {{--                            </div>--}}
    {{--                        </div>--}}
    {{--                    </article>--}}
    {{--                </div>--}}
    {{--                <div class="col-md-6 col-lg-4">--}}
    {{--                    <!--Blurb minimal-->--}}
    {{--                    <article class="blurb blurb-minimal">--}}
    {{--                        <div class="unit flex-row unit-spacing-md">--}}
    {{--                            <div class="unit-left">--}}
    {{--                                <div class="blurb-minimal__icon"><span class="icon linear-icon-menu3"></span></div>--}}
    {{--                            </div>--}}
    {{--                            <div class="unit-body">--}}
    {{--                                <p class="blurb__title">Great for Any Device</p>--}}
    {{--                                <p>This template is fully responsive and Retina-ready, which means its ability to be--}}
    {{--                                    displayed on any modern gadgets, from computers and laptops to smartphones and--}}
    {{--                                    tablets.--}}
    {{--                                    It is also perfectly optimized for high-resolution displays and other devices.</p>--}}
    {{--                            </div>--}}
    {{--                        </div>--}}
    {{--                    </article>--}}
    {{--                </div>--}}
    {{--                <div class="col-md-6 col-lg-4">--}}
    {{--                    <!--Blurb minimal-->--}}
    {{--                    <article class="blurb blurb-minimal">--}}
    {{--                        <div class="unit flex-row unit-spacing-md">--}}
    {{--                            <div class="unit-left">--}}
    {{--                                <div class="blurb-minimal__icon"><span class="icon linear-icon-users2"></span></div>--}}
    {{--                            </div>--}}
    {{--                            <div class="unit-body">--}}
    {{--                                <p class="blurb__title">Made for People</p>--}}
    {{--                                <p>Monstroid² is built for real users that enjoy easy website development and at the--}}
    {{--                                    same--}}
    {{--                                    are looking for a clear and stunning design. Our template can provide you with lots--}}
    {{--                                    of--}}
    {{--                                    child themes that are available in the full version of this template.</p>--}}
    {{--                            </div>--}}
    {{--                        </div>--}}
    {{--                    </article>--}}
    {{--                </div>--}}
    {{--            </div>--}}
    {{--        </div>--}}
    {{--    </section>--}}
    {{--    <br>--}}

    <!--The Power of Bootstrap Toolkit-->
    {{--    <section class="bg-gray-lighter object-wrap bg-default">--}}
    {{--        <div class="section-xxl section-xxl_bigger">--}}
    {{--            <div class="container">--}}
    {{--                <div class="row">--}}
    {{--                    <div class="col-lg-5">--}}
    {{--                        <h3>The Power of Bootstrap Toolkit</h3>--}}
    {{--                        <p>We’ve made a huge effort to provide you with the extreme power of site building via Bootstrap--}}
    {{--                            Toolkit. It is one of the most modern and flexible solutions for everyone who wants their--}}
    {{--                            website working properly and according to the latest standards.</p>--}}
    {{--                    </div>--}}
    {{--                </div>--}}
    {{--            </div>--}}
    {{--        </div>--}}
    {{--        <div class="object-wrap__body object-wrap__body-sizing-1 object-wrap__body-md-right bg-image"--}}
    {{--             style="background-image: url({{ asset('public/frontend/images/home-default-1-960x640.jpg') }})"></div>--}}
    {{--    </section>--}}
    {{--    <br>--}}
@endsection
@section('after-scripts')
    <script src="https://code.jquery.com/jquery-1.11.3.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-cookie/1.4.1/jquery.cookie.min.js"></script>
    <script src="{{ asset('public/js/jquery.searchHistory.js') }}"></script>
    <script>
        $('#search-form').searchHistory();
    </script>
@endsection
@section('after-styles')
    <link type="text/css" rel="stylesheet" href="{{ asset('public/css/jquery.searchHistory.css') }}">
@endsection