<!-- BEGIN SIDEBAR MENU -->
<ul id="menu" class="page-sidebar-menu">
    <li class="{{ Request::is('admin/home') ? 'active' : '' }}">
        <a href="{{ route('admin.home') }}">
            <i class="livicon" data-name="home" data-size="18" data-c="#418BCA" data-hc="#418BCA" data-loop="true"></i>
            <span class="title">Dashboard</span>
        </a>
    </li>

    @if(Auth::guard('admin')->user()->hasAnyPermission(['admin-user-views']))
    <li class="{{ ( Request::is('admin/admin-users') || Request::is('admin/admin-users/*') ) ? 'active' : '' }}">
        <a href="{{ route('admin.admin-users.index') }}">
            <i class="livicon" data-name="users" data-size="18" data-c="#418BCA" data-hc="#418BCA" data-loop="true"></i>
            <span class="title">Admin Management</span>
        </a>
    </li>
    @endif

    @if(Auth::guard('admin')->user()->hasAnyPermission(['role-views']))
    <li class="{{ ( Request::is('admin/roles') || Request::is('admin/roles/*') ) ? 'active' : '' }}">
        <a href="{{ route('admin.roles.index') }}">
            <i class="livicon" data-name="users" data-size="18" data-c="#418BCA" data-hc="#418BCA" data-loop="true"></i>
            <span class="title">Role Management</span>
        </a>
    </li>
    @endif

    {{--@if(Auth::guard('admin')->user()->hasAnyPermission(['permission-views']))--}}
    {{--<li class="{{ ( Request::is('admin/permissions') || Request::is('admin/permissions/*') ) ? 'active' : '' }}">--}}
        {{--<a href="{{ route('admin.permissions.index') }}">--}}
            {{--<i class="livicon" data-name="folder-lock" data-size="18" data-c="#418BCA" data-hc="#418BCA" data-loop="true"></i>--}}
            {{--<span class="title">Permission</span>--}}
        {{--</a>--}}
    {{--</li>--}}
    {{--@endif--}}

    @if(Auth::guard('admin')->user()->hasAnyPermission(['user-views']))
        <li class="{{ ( Request::is('admin/users') || Request::is('admin/users/*') ) ? 'active' : '' }}">
            <a href="{{ route('admin.users.index') }}">
                <i class="livicon" data-name="users" data-size="18" data-c="#418BCA" data-hc="#418BCA" data-loop="true"></i>
                <span class="title">App User Management</span>
            </a>
        </li>
    @endif

    @if(Auth::guard('admin')->user()->hasAnyPermission(['blog-views']))
        <li class="{{ ( Request::is('admin/blogs') || Request::is('admin/blogs/*') ) ? 'active' : '' }}">
            <a href="{{ route('admin.blogs.index') }}">
                <i class="livicon" data-name="comment" data-size="18" data-c="#418BCA" data-hc="#418BCA" data-loop="true"></i>
                <span class="title">Manage Blogs</span>
            </a>
        </li>
    @endif

    @if(Auth::guard('admin')->user()->hasAnyPermission(['news-views']))
        <li class="{{ ( Request::is('admin/news') || Request::is('admin/news/*') ) ? 'active' : '' }}">
            <a href="{{ route('admin.news.index') }}">
                <i class="livicon" data-name="move" data-size="18" data-c="#418BCA" data-hc="#418BCA" data-loop="true"></i>
                <span class="title">Manage News</span>
            </a>
        </li>
    @endif

    @if(Auth::guard('admin')->user()->hasAnyPermission(['cms-views']))
        <li class="{{ ( Request::is('admin/cms') || Request::is('admin/cms/*') ) ? 'active' : '' }}">
            <a href="{{ route('admin.cms.index') }}">
                <i class="livicon" data-name="flag" data-size="18" data-c="#418BCA" data-hc="#418BCA" data-loop="true"></i>
                <span class="title">Manage CMS Pages</span>
            </a>
        </li>
    @endif

    @if(Auth::guard('admin')->user()->hasAnyPermission(['plan-views']))
        <li class="{{ ( Request::is('admin/plans') || Request::is('admin/plans/*') ) ? 'active' : '' }}">
            <a href="{{ route('admin.plans.index') }}">
                <i class="livicon" data-name="flag" data-size="18" data-c="#418BCA" data-hc="#418BCA" data-loop="true"></i>
                <span class="title">Subscription Plans</span>
            </a>
        </li>
    @endif

    @if(Auth::guard('admin')->user()->hasAnyPermission(['contact-views']))
        <li class="{{ Request::is('admin/contacts') ? 'active' : '' }}">
            <a href="{{ route('admin.contacts.index') }}">
                <i class="livicon" data-name="users" data-size="18" data-c="#418BCA" data-hc="#418BCA" data-loop="true"></i>
                <span class="title">Contacts</span>
            </a>
        </li>
    @endif

    @if(Auth::guard('admin')->user()->hasAnyPermission(['notification-send']))
        <li class="{{ Request::is('admin/notification-create') ? 'active' : '' }}">
            <a href="{{ route('admin.notification.create') }}">
                <i class="livicon" data-name="flag" data-size="18" data-c="#418BCA" data-hc="#418BCA" data-loop="true"></i>
                <span class="title">Notification send</span>
            </a>
        </li>
    @endif

    @if(Auth::guard('admin')->user()->hasAnyPermission(['feedback']))
    <li class="{{ ( Request::is('admin/feedback') || Request::is('admin/feedback/*') ) ? 'active' : '' }}">
            <a href="{{ route('admin.feedback.index') }}">
                <i class="livicon" data-name="comment" data-size="18" data-c="#418BCA" data-hc="#418BCA" data-loop="true"></i>
                <span class="title">Feedback</span>
            </a>
        </li>
        @endif
</ul>
<!-- END SIDEBAR MENU -->