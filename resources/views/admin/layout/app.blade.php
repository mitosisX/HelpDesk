<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">

    <link rel="stylesheet" href="{{ asset('css/bulma.min.css') }}">
    <link rel="stylesheet" href="{{ asset('css/sidebar-style.css') }}">
    <link rel="stylesheet" href="{{ asset('css/extensions/modal-fx.min.css') }}">
    <link rel="stylesheet" href="{{ asset('css/extensions/bulma-radio-checkbox.min.css') }}">
    <link rel="stylesheet" href="{{ asset('css/extensions/bulma-badge.min.css') }}">
    <link rel="stylesheet" href="{{ asset('css/extensions/bulmatable.min.css') }}">
    <link rel="stylesheet" href="{{ asset('css/extensions/bulma-calendar.min.css') }}">
    <link rel="stylesheet" href="{{ asset('css/mdi/font/css/materialdesignicons.min.css') }}">
    <link rel="stylesheet" href="{{ asset('css/styles.css') }}">
    <link rel="stylesheet" href="{{ asset('css/tags.css') }}">
    @yield('title')
</head>

<body>
    <section class="hero is-info" style="position: sticky;top:0px;z-index:100;">
        <div class="hero-body">
            <p class="title">
                Nothern Region Water Board (NRWB)
            </p>
            <p class="subtitle">
                Help desk & Ticketing system
            </p>
        </div>
    </section>

    <div class="columns my-1 mx-2">

        {{-- Side menu --}}
        <div class="column box is-2">

            <!-- START SIDE MENU -->
            <aside class="menu">
                <p class="menu-label">
                    General
                </p>
                <ul class="menu-list">
                    <li><a href="{{ route('admin.dashboard') }}">Dashboard</a></li>
                    <li><a href="{{ route('admin.profile.show') }}">Profile</a></li>
                </ul>
                <p class="menu-label">
                    Tickets
                </p>
                <ul class="menu-list">
                    <!-- <li><a>Team Settings</a></li> -->
                    <li>
                        <a class="is-active has-background-info">Statistics</a>
                        <ul>
                            <li><a>New (10)</a></li>
                            <li><a>Open (1)</a></li>
                            <li><a>Closed (19)</a></li>
                            <li><a>Overdue (200)</a></li>
                        </ul>
                    </li>
                    <li><a href="{{ route('admin.tickets.view', ['status' => 'new']) }}">All tickets</a></li>
                    <li><a href="{{ route('admin.create_ticket') }}">Create Ticket</a></li>
                    <li><a href="{{ route('admin.ticket.settings') }}">Ticket Settings</a></li>
                </ul>
                <p class="menu-label">Manage</p>
                <ul class="menu-list">
                    <li><a href="{{ route('admin.categories.index') }}">Categories</a></li>
                    <li><a href="{{ route('admin.departments.index') }}">Departments</a></li>
                    <li><a href="{{ route('admin.accounts.view') }}">Accounts</a></li>
                </ul>
            </aside>
        </div>
        <!-- END SIDE MENU -->


        {{-- <div class="column box is-2">
            <div class="sidebar">
                <div class="logo-details">
                    <i class='bx bxl-c-plus-plus'></i>
                    <span class="logo_name">CodingLab</span>
                </div>
                <ul class="nav-links">
                    <li>
                        <a href="#">
                            <i class='bx bx-grid-alt'></i>
                            <span class="link_name">Dashboard</span>
                        </a>
                        <ul class="sub-menu blank">
                            <li><a class="link_name" href="#">Category</a></li>
                        </ul>
                    </li>
                    <li class="showMenu">
                        <div class="iocn-link">
                            <a href="#">
                                <i class='bx bx-collection'></i>
                                <span class="link_name">Category</span>
                            </a>
                            <i class='bx bxs-chevron-down arrow'></i>
                        </div>
                        <ul class="sub-menu">
                            <li><a class="link_name" href="#">Category</a></li>
                            <li><a href="#">HTML & CSS</a></li>
                            <li><a href="#">JavaScript</a></li>
                            <li><a href="#">PHP & MySQL</a></li>
                        </ul>
                    </li>
                    <li>
                        <div class="iocn-link">
                            <a href="#">
                                <i class='bx bx-book-alt'></i>
                                <span class="link_name">Posts</span>
                            </a>
                            <i class='bx bxs-chevron-down arrow'></i>
                        </div>
                        <ul class="sub-menu">
                            <li><a class="link_name" href="#">Posts</a></li>
                            <li><a href="#">Web Design</a></li>
                            <li><a href="#">Login Form</a></li>
                            <li><a href="#">Card Design</a></li>
                        </ul>
                    </li>
                    <li>
                        <a href="#">
                            <i class='bx bx-pie-chart-alt-2'></i>
                            <span class="link_name">Analytics</span>
                        </a>
                        <ul class="sub-menu blank">
                            <li><a class="link_name" href="#">Analytics</a></li>
                        </ul>
                    </li>
                    <li>
                        <a href="#">
                            <i class='bx bx-line-chart'></i>
                            <span class="link_name">Chart</span>
                        </a>
                        <ul class="sub-menu blank">
                            <li><a class="link_name" href="#">Chart</a></li>
                        </ul>
                    </li>
                    <li>
                        <div class="iocn-link">
                            <a href="#">
                                <i class='bx bx-plug'></i>
                                <span class="link_name">Plugins</span>
                            </a>
                            <i class='bx bxs-chevron-down arrow'></i>
                        </div>
                        <ul class="sub-menu">
                            <li><a class="link_name" href="#">Plugins</a></li>
                            <li><a href="#">UI Face</a></li>
                            <li><a href="#">Pigments</a></li>
                            <li><a href="#">Box Icons</a></li>
                        </ul>
                    </li>
                    <li>
                        <a href="#">
                            <i class='bx bx-compass'></i>
                            <span class="link_name">Explore</span>
                        </a>
                        <ul class="sub-menu blank">
                            <li><a class="link_name" href="#">Explore</a></li>
                        </ul>
                    </li>
                    <li>
                        <a href="#">
                            <i class='bx bx-history'></i>
                            <span class="link_name">History</span>
                        </a>
                        <ul class="sub-menu blank">
                            <li><a class="link_name" href="#">History</a></li>
                        </ul>
                    </li>
                    <li>
                        <a href="#">
                            <i class='bx bx-cog'></i>
                            <span class="link_name">Setting</span>
                        </a>
                        <ul class="sub-menu blank">
                            <li><a class="link_name" href="#">Setting</a></li>
                        </ul>
                    </li>
                    <li>
                        <div class="profile-details">
                            <div class="profile-content">
                                <!--<img src="image/profile.jpg" alt="profileImg">-->
                            </div>
                            <div class="name-job">
                                <div class="profile_name">Prem Shahi</div>
                                <div class="job">Web Desginer</div>
                            </div>
                            <i class='bx bx-log-out'></i>
                        </div>
                    </li>
                </ul>
            </div>
        </div> --}}
        @yield('content')
    </div>

    <script src="{{ asset('js/alpinejs.min.js') }}"></script>
    <script src="{{ asset('js/jquery.min.js') }}"></script>
    <script src="{{ asset('js/bulma-tagsinput.min.js') }}"></script>
    <script src="{{ asset('js/bulma-calendar.min.js') }}"></script>
    <script src="{{ asset('js/modal-fx.min.js') }}"></script>
    <script src="{{ asset('js/tags.js') }}"></script>
    @yield('script')
</body>

</html>
