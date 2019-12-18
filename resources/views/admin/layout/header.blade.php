<header class="header">
    <a href="{{ route('admin.home') }}" class="logo">
        <h3 class="logo_header_text">OOZEE</h3>
    </a>
    <nav class="navbar navbar-static-top" role="navigation">
        <div>
            <a href="#" class="navbar-btn sidebar-toggle" data-toggle="offcanvas" role="button">
                <div class="responsive_nav"></div>
            </a>
        </div>
        <div class="navbar-right toggle">
            <ul class="nav navbar-nav  list-inline">
                <li class=" nav-item dropdown user user-menu">
                    <a href="#" class="dropdown-toggle nav-link" data-toggle="dropdown">
                        <img src="{{ asset('public/assets/images/authors/no_avatar.jpg') }}" alt="img" height="35px"
                             width="35px" class="rounded-circle img-fluid float-left"/>
                        <div class="riot">
                            <div class="riotcls">
                                <p class="user_name_max">{{ Auth::user()->name }}</p>
                                <span>
                                        <i class="caret"></i>
                                    </span>
                            </div>
                        </div>
                    </a>
                    <ul class="dropdown-menu">
                        <!-- User image -->
                        <li class="user-header bg-light-blue">
                            <img src="{{ asset('public/assets/images/authors/no_avatar.jpg') }}" alt="img"
                                 height="35px" width="35px" class="rounded-circle img-fluid float-left"/>
                            <p class="topprofiletext">{{ Auth::user()->name }}</p>
                        </li>
                        <!-- Menu Body -->
                        <li>
                            <a href="{{ route('admin.profile') }}">
                                <i class="livicon" data-name="user" data-s="18"></i>
                                My Profile
                            </a>
                        </li>
                        <li role="presentation"></li>
                        {{--<li>--}}
                            {{--<a href="#">--}}
                                {{--<i class="livicon" data-name="gears" data-s="18"></i>--}}
                                {{--Account Settings--}}
                            {{--</a>--}}
                        {{--</li>--}}
                        <li role="presentation"></li>
                        <li>
                            <a href="{{ route('logout') }}">
                                <i class="livicon" data-name="sign-out" data-s="18"></i>
                                Logout
                            </a>
                        </li>
                    </ul>
                </li>
            </ul>
        </div>

    </nav>
</header>