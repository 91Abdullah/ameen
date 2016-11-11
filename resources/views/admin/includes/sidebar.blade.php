<!-- BEGIN SIDEBAR -->
<div class="page-sidebar-wrapper">
    <!-- DOC: Set data-auto-scroll="false" to disable the sidebar from auto scrolling/focusing -->
    <!-- DOC: Change data-auto-speed="200" to adjust the sub menu slide up/down speed -->
    <div class="page-sidebar navbar-collapse collapse">
        <!-- BEGIN SIDEBAR MENU -->
        <!-- DOC: Apply "page-sidebar-menu-light" class right after "page-sidebar-menu" to enable light sidebar menu style(without borders) -->
        <!-- DOC: Apply "page-sidebar-menu-hover-submenu" class right after "page-sidebar-menu" to enable hoverable(hover vs accordion) sub menu mode -->
        <!-- DOC: Apply "page-sidebar-menu-closed" class right after "page-sidebar-menu" to collapse("page-sidebar-closed" class must be applied to the body element) the sidebar sub menu mode -->
        <!-- DOC: Set data-auto-scroll="false" to disable the sidebar from auto scrolling/focusing -->
        <!-- DOC: Set data-keep-expand="true" to keep the submenues expanded -->
        <!-- DOC: Set data-auto-speed="200" to adjust the sub menu slide up/down speed -->
        <ul class="page-sidebar-menu page-sidebar-menu-light" data-keep-expanded="false" data-auto-scroll="true" data-slide-speed="200">
            <!-- DOC: To remove the sidebar toggler from the sidebar you just need to completely remove the below "sidebar-toggler-wrapper" LI element -->
            <li class="sidebar-toggler-wrapper">
                <!-- BEGIN SIDEBAR TOGGLER BUTTON -->
                <div class="sidebar-toggler">
                </div>
                <!-- END SIDEBAR TOGGLER BUTTON -->
            </li>
            <!-- DOC: To remove the search box from the sidebar you just need to completely remove the below "sidebar-search-wrapper" LI element -->
            <li class="sidebar-search-wrapper">
                <!-- BEGIN RESPONSIVE QUICK SEARCH FORM -->
                <!-- DOC: Apply "sidebar-search-bordered" class the below search form to have bordered search box -->
                <!-- DOC: Apply "sidebar-search-bordered sidebar-search-solid" class the below search form to have bordered & solid search box -->
                <form class="sidebar-search " action="extra_search.html" method="POST">
                    <a href="javascript:;" class="remove">
                        <i class="icon-close"></i>
                    </a>
                    <div class="input-group">
                        <input type="text" class="form-control" placeholder="Search...">
							<span class="input-group-btn">
							<a href="javascript:;" class="btn submit"><i class="icon-magnifier"></i></a>
							</span>
                    </div>
                </form>
                <!-- END RESPONSIVE QUICK SEARCH FORM -->
            </li>
            <li class="start {{ Request::is('dashboard') ? 'active' : '' }}">
                <a href="{{ route('admin.dashboard') }}">
                    <i class="icon-speedometer"></i>
                    <span class="title">Dashboard</span>
                </a>
            </li>
            <li class="{{ Request::is('calls') ? 'active' : '' }}">
                <a href="{{ route('admin.calls') }}">
                    <i class="icon-call-end"></i>
                    <span class="title">Calls</span>
                </a>
            </li>
            <li class="{{ Request::is('messages/*') ? 'active' : '' }}">
                <a href="#">
                    <i class="icon-envelope"></i>
                    <span class="title">Messages</span>
                </a>
                <ul class="sub-menu">
                    <li class="{{ Request::is('messages/sent') ? 'active' : '' }}">
                        <a href="{{ route('admin.messages.sent') }}">
                            <i class="icon-envelope"></i>
                            <span class="title">Sent</span>
                        </a>
                    </li>
                    <li class="{{ Request::is('messages/recieved') ? 'active' : '' }}">
                        <a href="{{ route('admin.messages.recieved') }}">
                            <i class="icon-folder"></i>
                            <span class="title">Recieved</span>
                        </a>
                    </li>
                </ul>
            </li>
            <li class="{{ Request::is('imap') || Request::is('imap/*') ? 'active' : '' }}">
                <a href="{{ route('admin.imap') }}">
                    <i class="icon-folder"></i>
                    <span class="title">Emails</span>
                </a>
            </li>
            <li class="{{ Request::is('preferences/*') ? 'active' : '' }}">
                <a href="{{ route('admin.preferences.mail') }}">
                    <i class="icon-wrench"></i>
                    <span class="title">Preferences</span>
                </a>
                <ul class="sub-menu">
                    <li class="{{ Request::is('preferences/mail') ? 'active' : '' }}">
                        <a href="{{ route('admin.preferences.mail') }}">
                            <i class="icon-folder"></i>
                            <span class="title">Mail</span>
                        </a>
                    </li>
                    <li class="{{ Request::is('preferences/message') ? 'active' : '' }}">
                        <a href="{{ route('admin.preferences.messageIndex') }}">
                            <i class="icon-envelope"></i>
                            <span class="title">Message</span>
                        </a>
                    </li>
                    <li class="{{ Request::is('preferences/user') ? 'active' : '' }}">
                        <a href="{{ route('admin.preferences.user') }}">
                            <i class="icon-user"></i>
                            <span class="title">Users</span>
                        </a>
                    </li>
                </ul>
            </li>
        </ul>
        <!-- END SIDEBAR MENU -->
    </div>
</div>
<!-- END SIDEBAR -->