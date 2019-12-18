<header class="header">
        <a href="{{ route('admin.home') }}" class="logo">
            <h3 class="logo_header_text" style="color: white;">OOZEE</h3>
        </a>
        <nav class="navbar navbar-static-top" role="navigation">
            <!-- Sidebar toggle button-->
            <div>
                <a href="#" class="navbar-btn sidebar-toggle" data-toggle="offcanvas" role="button">
                    <div class="responsive_nav"></div>
                </a>
            </div>
            <div class="navbar-right">
                <ul class="nav navbar-nav">
                   
                    <li class="dropdown user user-menu">
                        <a href="#" class="dropdown-toggle" data-toggle="dropdown">
                            <img src="{{ asset('public/assets/images/authors/no_avatar.jpg') }}" width="35" class="img-circle img-responsive pull-left" height="35" alt="riot">
                            <div class="riot">
                                <div>
                                    {{ Auth::user()->name }}
                                    <span>
                                        <i class="caret"></i>
                                    </span>
                                </div>
                            </div>
                        </a>
                        <ul class="dropdown-menu">
                            <!-- User image -->
                            <li class="user-header bg-light-blue">
                                <img src="{{ asset('public/assets/images/authors/no_avatar.jpg') }}" width="90" class="img-circle img-responsive" height="90" alt="User Image" />
                                <p class="topprofiletext">{{ Auth::user()->name }}</p>
                            </li>
                            <!-- Menu Body -->
                            <li>
                                <a href="{{ route('admin.profile') }}">
                                    <i class="livicon" data-name="user" data-s="18"></i> My Profile
                                </a>
                            </li>
                            <li role="presentation"></li>
                            <li>
                                <a href="{{ route('logout') }}">
                                    <i class="livicon" data-name="sign-out" data-s="18"></i> Logout
                                </a>
                            </li>
                         
                        </ul>
                    </li>
                </ul>
            </div>
        </nav>
    </header>