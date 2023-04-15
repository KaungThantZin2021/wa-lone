<aside class="left-sidebar" data-sidebarbg="skin6">
    <!-- Sidebar scroll-->
    <div class="scroll-sidebar dark:tw-bg-slate-700" data-sidebarbg="skin6">
        <!-- Sidebar navigation-->
        <nav class="sidebar-nav">
            <ul id="sidebarnav">
                <li class="sidebar-item @yield('dashboard-selected')">
                    <a class="sidebar-link sidebar-link" href="{{ route('admin.dashboard') }}" aria-expanded="false">
                        <i data-feather="home" class="feather-icon"></i>
                        <span class="hide-menu">Dashboard</span>
                    </a>
                </li>

                <li class="list-divider"></li>

                @can('view_category')
                <li class="nav-small-cap"><span class="hide-menu dark:tw-text-gray-300">Category Management</span></li>
                <li class="sidebar-item @yield('category-selected')">
                    <a class="sidebar-link" href="{{ route('admin.category.index') }}" aria-expanded="false">
                        <i data-feather="users" class="feather-icon"></i><span class="hide-menu">Category</span>
                    </a>
                </li>
                @endcan

                <li class="nav-small-cap"><span class="hide-menu dark:tw-text-gray-300">User Management</span></li>
                <li class="sidebar-item  @yield('user-selected')">
                    <a class="sidebar-link" href="{{ route('admin.user.index') }}" aria-expanded="false">
                        <i data-feather="users" class="feather-icon"></i><span class="hide-menu">User</span>
                    </a>
                </li>

                <li class="nav-small-cap"><span class="hide-menu dark:tw-text-gray-300">Admin User Management</span></li>
                <li class="sidebar-item  @yield('admin-user-selected')">
                    <a class="sidebar-link" href="{{ route('admin.admin-user.index') }}" aria-expanded="false">
                        <i data-feather="users" class="feather-icon"></i><span class="hide-menu">Admin User</span>
                    </a>
                </li>

                @can('view_slider')
                <li class="nav-small-cap"><span class="hide-menu dark:tw-text-gray-300">Slider Management</span></li>
                <li class="sidebar-item  @yield('slider-selected')">
                    <a class="sidebar-link" href="{{ route('admin.slider.index') }}" aria-expanded="false">
                        <i data-feather="file-text" class="feather-icon"></i><span class="hide-menu">Slider</span>
                    </a>
                </li>
                @endcan

                @can('view_blog')
                <li class="nav-small-cap"><span class="hide-menu dark:tw-text-gray-300">Blog Management</span></li>
                <li class="sidebar-item  @yield('blog-selected')">
                    <a class="sidebar-link" href="{{ route('admin.blog.index') }}" aria-expanded="false">
                        <i data-feather="file-text" class="feather-icon"></i><span class="hide-menu">Blog</span>
                    </a>
                </li>
                @endcan

                <li class="nav-small-cap"><span class="hide-menu dark:tw-text-gray-300">Log</span></li>
                <li class="sidebar-item  @yield('activity-log-selected')">
                    <a class="sidebar-link" href="{{ route('admin.activity-log.index') }}" aria-expanded="false">
                        <i data-feather="activity" class="feather-icon"></i><span class="hide-menu">Activity Log</span>
                    </a>
                </li>

                <li class="nav-small-cap"><span class="hide-menu dark:tw-text-gray-300">Role and Permission</span></li>
                <li class="sidebar-item  @yield('role-selected')">
                    <a class="sidebar-link" href="{{ route('admin.role.index') }}" aria-expanded="false">
                        <i class="fas fa-id-card-alt"></i><span class="hide-menu">Role</span>
                    </a>
                </li>
                <li class="sidebar-item  @yield('permission-group-selected')">
                    <a class="sidebar-link" href="{{ route('admin.permission-group.index') }}" aria-expanded="false">
                        <i class="fas fa-id-card"></i><span class="hide-menu">Permission Group</span>
                    </a>
                </li>

                <li class="nav-small-cap"><span class="hide-menu dark:tw-text-gray-300">Applications</span></li>

                <li class="sidebar-item"> <a class="sidebar-link" href="ticket-list.html" aria-expanded="false"><i
                            data-feather="tag" class="feather-icon"></i><span class="hide-menu">Ticket List
                        </span></a>
                </li>
                <li class="sidebar-item"> <a class="sidebar-link sidebar-link" href="app-chat.html"
                        aria-expanded="false"><i data-feather="message-square" class="feather-icon"></i><span
                            class="hide-menu">Chat</span></a></li>
                <li class="sidebar-item"> <a class="sidebar-link sidebar-link" href="app-calendar.html"
                        aria-expanded="false"><i data-feather="calendar" class="feather-icon"></i><span
                            class="hide-menu">Calendar</span></a></li>

                <li class="list-divider"></li>
                <li class="nav-small-cap"><span class="hide-menu dark:tw-text-gray-300">Components</span></li>
                <li class="sidebar-item"> <a class="sidebar-link has-arrow" href="javascript:void(0)"
                        aria-expanded="false"><i data-feather="file-text" class="feather-icon"></i><span
                            class="hide-menu">Forms </span></a>
                    <ul aria-expanded="false" class="collapse  first-level base-level-line">
                        <li class="sidebar-item"><a href="form-inputs.html" class="sidebar-link"><span
                                    class="hide-menu"> Form Inputs
                                </span></a>
                        </li>
                        <li class="sidebar-item"><a href="form-input-grid.html" class="sidebar-link"><span
                                    class="hide-menu"> Form Grids
                                </span></a>
                        </li>
                        <li class="sidebar-item"><a href="form-checkbox-radio.html" class="sidebar-link"><span
                                    class="hide-menu"> Checkboxes &
                                    Radios
                                </span></a>
                        </li>
                    </ul>
                </li>
                <li class="sidebar-item"> <a class="sidebar-link has-arrow" href="javascript:void(0)"
                        aria-expanded="false"><i data-feather="grid" class="feather-icon"></i><span
                            class="hide-menu">Tables </span></a>
                    <ul aria-expanded="false" class="collapse  first-level base-level-line">
                        <li class="sidebar-item"><a href="table-basic.html" class="sidebar-link"><span
                                    class="hide-menu"> Basic Table
                                </span></a>
                        </li>
                        <li class="sidebar-item"><a href="table-dark-basic.html" class="sidebar-link"><span
                                    class="hide-menu"> Dark Basic Table
                                </span></a>
                        </li>
                        <li class="sidebar-item"><a href="table-sizing.html" class="sidebar-link"><span
                                    class="hide-menu">
                                    Sizing Table
                                </span></a>
                        </li>
                        <li class="sidebar-item"><a href="table-layout-coloured.html" class="sidebar-link"><span
                                    class="hide-menu">
                                    Coloured
                                    Table Layout
                                </span></a>
                        </li>
                        <li class="sidebar-item"><a href="table-datatable-basic.html" class="sidebar-link"><span
                                    class="hide-menu">
                                    Basic
                                    Datatables
                                    Layout
                                </span></a>
                        </li>
                    </ul>
                </li>
                <li class="sidebar-item"> <a class="sidebar-link has-arrow" href="javascript:void(0)"
                        aria-expanded="false"><i data-feather="bar-chart" class="feather-icon"></i><span
                            class="hide-menu">Charts </span></a>
                    <ul aria-expanded="false" class="collapse  first-level base-level-line">
                        <li class="sidebar-item"><a href="chart-morris.html" class="sidebar-link"><span
                                    class="hide-menu"> Morris Chart
                                </span></a>
                        </li>
                        <li class="sidebar-item"><a href="chart-chart-js.html" class="sidebar-link"><span
                                    class="hide-menu"> ChartJs
                                </span></a>
                        </li>
                        <li class="sidebar-item"><a href="chart-knob.html" class="sidebar-link"><span
                                    class="hide-menu">
                                    Knob Chart
                                </span></a>
                        </li>
                    </ul>
                </li>
                <li class="sidebar-item"> <a class="sidebar-link has-arrow" href="javascript:void(0)"
                        aria-expanded="false"><i data-feather="box" class="feather-icon"></i><span
                            class="hide-menu">UI Elements </span></a>
                    <ul aria-expanded="false" class="collapse  first-level base-level-line">
                        <li class="sidebar-item"><a href="ui-buttons.html" class="sidebar-link"><span
                                    class="hide-menu"> Buttons
                                </span></a>
                        </li>
                        <li class="sidebar-item"><a href="ui-modals.html" class="sidebar-link"><span
                                    class="hide-menu"> Modals </span></a>
                        </li>
                        <li class="sidebar-item"><a href="ui-tab.html" class="sidebar-link"><span class="hide-menu">
                                    Tabs </span></a></li>
                        <li class="sidebar-item"><a href="ui-tooltip-popover.html" class="sidebar-link"><span
                                    class="hide-menu"> Tooltip &
                                    Popover</span></a></li>
                        <li class="sidebar-item"><a href="ui-notification.html" class="sidebar-link"><span
                                    class="hide-menu">Notification</span></a></li>
                        <li class="sidebar-item"><a href="ui-progressbar.html" class="sidebar-link"><span
                                    class="hide-menu">Progressbar</span></a></li>
                        <li class="sidebar-item"><a href="ui-typography.html" class="sidebar-link"><span
                                    class="hide-menu">Typography</span></a></li>
                        <li class="sidebar-item"><a href="ui-bootstrap.html" class="sidebar-link"><span
                                    class="hide-menu">Bootstrap
                                    UI</span></a></li>
                        <li class="sidebar-item"><a href="ui-breadcrumb.html" class="sidebar-link"><span
                                    class="hide-menu">Breadcrumb</span></a></li>
                        <li class="sidebar-item"><a href="ui-list-media.html" class="sidebar-link"><span
                                    class="hide-menu">List
                                    Media</span></a></li>
                        <li class="sidebar-item"><a href="ui-grid.html" class="sidebar-link"><span
                                    class="hide-menu"> Grid </span></a></li>
                        <li class="sidebar-item"><a href="ui-carousel.html" class="sidebar-link"><span
                                    class="hide-menu">
                                    Carousel</span></a></li>
                        <li class="sidebar-item"><a href="ui-scrollspy.html" class="sidebar-link"><span
                                    class="hide-menu">
                                    Scrollspy</span></a></li>
                        <li class="sidebar-item"><a href="ui-toasts.html" class="sidebar-link"><span
                                    class="hide-menu"> Toasts</span></a>
                        </li>
                        <li class="sidebar-item"><a href="ui-spinner.html" class="sidebar-link"><span
                                    class="hide-menu"> Spinner </span></a>
                        </li>
                    </ul>
                </li>
                <li class="sidebar-item"> <a class="sidebar-link sidebar-link" href="ui-cards.html"
                        aria-expanded="false"><i data-feather="sidebar" class="feather-icon"></i><span
                            class="hide-menu">Cards
                        </span></a>
                </li>
                <li class="list-divider"></li>
                <li class="nav-small-cap"><span class="hide-menu">Authentication</span></li>

                <li class="sidebar-item"> <a class="sidebar-link sidebar-link" href="authentication-login1.html"
                        aria-expanded="false"><i data-feather="lock" class="feather-icon"></i><span
                            class="hide-menu">Login
                        </span></a>
                </li>
                <li class="sidebar-item"> <a class="sidebar-link sidebar-link" href="authentication-register1.html"
                        aria-expanded="false"><i data-feather="lock" class="feather-icon"></i><span
                            class="hide-menu">Register
                        </span></a>
                </li>

                <li class="sidebar-item"> <a class="sidebar-link has-arrow" href="javascript:void(0)"
                        aria-expanded="false"><i data-feather="feather" class="feather-icon"></i><span
                            class="hide-menu">Icons
                        </span></a>
                    <ul aria-expanded="false" class="collapse first-level base-level-line">
                        <li class="sidebar-item"><a href="icon-fontawesome.html" class="sidebar-link"><span
                                    class="hide-menu"> Fontawesome Icons </span></a></li>

                        <li class="sidebar-item"><a href="icon-simple-lineicon.html" class="sidebar-link"><span
                                    class="hide-menu"> Simple Line Icons </span></a>
                        </li>
                    </ul>
                </li>

                <li class="sidebar-item"> <a class="sidebar-link has-arrow" href="javascript:void(0)"
                        aria-expanded="false"><i data-feather="crosshair" class="feather-icon"></i><span
                            class="hide-menu">Multi
                            level
                            dd</span></a>
                    <ul aria-expanded="false" class="collapse first-level base-level-line">
                        <li class="sidebar-item"><a href="javascript:void(0)" class="sidebar-link"><span
                                    class="hide-menu"> item 1.1</span></a>
                        </li>
                        <li class="sidebar-item"><a href="javascript:void(0)" class="sidebar-link"><span
                                    class="hide-menu"> item 1.2</span></a>
                        </li>
                        <li class="sidebar-item"> <a class="has-arrow sidebar-link" href="javascript:void(0)"
                                aria-expanded="false"><span class="hide-menu">Menu 1.3</span></a>
                            <ul aria-expanded="false" class="collapse second-level base-level-line">
                                <li class="sidebar-item"><a href="javascript:void(0)" class="sidebar-link"><span
                                            class="hide-menu"> item
                                            1.3.1</span></a></li>
                                <li class="sidebar-item"><a href="javascript:void(0)" class="sidebar-link"><span
                                            class="hide-menu"> item
                                            1.3.2</span></a></li>
                                <li class="sidebar-item"><a href="javascript:void(0)" class="sidebar-link"><span
                                            class="hide-menu"> item
                                            1.3.3</span></a></li>
                                <li class="sidebar-item"><a href="javascript:void(0)" class="sidebar-link"><span
                                            class="hide-menu"> item
                                            1.3.4</span></a></li>
                            </ul>
                        </li>
                        <li class="sidebar-item"><a href="javascript:void(0)" class="sidebar-link"><span
                                    class="hide-menu"> item
                                    1.4</span></a></li>
                    </ul>
                </li>
                <li class="list-divider"></li>
                <li class="nav-small-cap"><span class="hide-menu">Extra</span></li>
                <li class="sidebar-item"> <a class="sidebar-link sidebar-link" href="../../docs/docs.html"
                        aria-expanded="false"><i data-feather="edit-3" class="feather-icon"></i><span
                            class="hide-menu">Documentation</span></a></li>
                <li class="sidebar-item"> <a class="sidebar-link sidebar-link" href="authentication-login1.html"
                        aria-expanded="false"><i data-feather="log-out" class="feather-icon"></i><span
                            class="hide-menu">Logout</span></a></li>
            </ul>
        </nav>
        <!-- End Sidebar navigation -->
    </div>
    <!-- End Sidebar scroll-->
</aside>
