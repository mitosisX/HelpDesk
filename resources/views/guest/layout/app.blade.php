<html lang="en" class="has-aside-left has-aside-mobile-transition has-navbar-fixed-top has-aside-expanded">

<head>
    <meta charset="utf-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <meta name='csrf-token' content="{{ csrf_token() }}" />

    @yield('title')

    <!-- Bulma is included -->
    <link rel="stylesheet" href="{{ asset('css/extensions/bulma-calendar.min.css') }}" />
    <link rel="stylesheet" href="{{ asset('css/extensions/bulma-steps.min.css') }}" />
    <link rel="stylesheet" href="{{ asset('css/main.css') }}" />
    <link rel="stylesheet" href="{{ asset('css/pulse.css') }}" />
    <link rel="stylesheet" href="{{ asset('css/jstable.css') }}" />
    {{-- <link rel="stylesheet" href="{{ asset('css/dataTables.bulma.min.css') }}" /> --}}
    <link rel="stylesheet" href="{{ asset('css/mdi/font/css/materialdesignicons.min.css') }}" />
    <link rel="stylesheet" href="{{ asset('css/sweetalert2.min.css') }}" />

    <!-- Fonts -->
    <link rel="dns-prefetch" href="https://fonts.gstatic.com" />
    <link href="{{ asset('css/nunito.css') }}" rel="stylesheet" />

    @php
        use App\Queries\SpecialQueries;
        $counter = SpecialQueries::ticketCounter();
    @endphp
</head>

<body>
    <div id="app">
        <nav id="navbar-main" class="navbar is-fixed-top">
            <div class="navbar-brand">
                <a class="navbar-item is-hidden-desktop jb-aside-mobile-toggle">
                    <span class="icon"><i class="mdi mdi-forwardburger mdi-24px"></i></span>
                </a>
            </div>
            <div class="navbar-brand is-right">
                <a class="navbar-item is-hidden-desktop jb-navbar-menu-toggle" data-target="navbar-menu">
                    <span class="icon"><i class="mdi mdi-dots-vertical"></i></span>
                </a>
            </div>
            <div class="navbar-menu fadeIn animated faster" id="navbar-menu">
                <div class="navbar-end">
                    <div
                        class="navbar-item has-dropdown has-dropdown-with-icons has-divider has-user-avatar is-hoverable">
                        <a class="navbar-link is-arrowless">
                            <div class="is-user-name"><span>{{ Auth::user()->name }}</span></div>
                            <span class="icon"><i class="mdi mdi-chevron-down"></i></span>
                        </a>
                        <div class="navbar-dropdown">
                            <a href="profile.html" class="navbar-item">
                                <span class="icon">
                                    <i class="mdi mdi-account-badge-outline"></i>
                                </span>
                                <span>My Profile</span>
                            </a>
                        </div>
                    </div>

                    <a href="{{ route('logout') }}" title="Log out" class="navbar-item is-desktop-icon-only">
                        <span class="icon"><i class="mdi mdi-logout"></i></span>
                        <span>Log out</span>
                    </a>
                </div>
            </div>
        </nav>
        <aside class="aside is-placed-left is-expanded">
            <div class="aside-tools">
                <div class="aside-tools-label">
                    <span><b>User</b> account</span>
                </div>
            </div>
            <div class="menu is-menu-main">
                <p class="menu-label">General</p>
                <ul class="menu-list">
                    <li>
                        <a href="{{ route('user.create') }}" class="router-link-active has-icon">
                            <span class="icon"><i class="mdi mdi-home"></i></span>
                            <span class="menu-item-label">Dashboard</span>
                        </a>
                    </li>
                </ul>
                <p class="menu-label">Tickets</p>
                <ul class="menu-list">
                    <li>
                        <a href="{{ route('user.tickets.create') }}" class="has-icon">
                            <span class="icon"><i class="mdi mdi-square-edit-outline"></i></span>
                            <span class="menu-item-label">Create Ticket</span>
                        </a>
                    </li>
                    <li>
                        <a href="{{ route('user.tickets.view') }}" class="has-icon">
                            <span class="icon has-update-mark"><i class="mdi mdi-table"></i></span>
                            <span class="menu-item-label">All Tickets</span>
                        </a>
                    </li>
                </ul>
                <p class="menu-label">Manage</p>
                <ul class="menu-list">
                    <li>
                        <a href="{{ route('admin.accounts.view') }}" class="has-icon">
                            <span class="icon"><i class="mdi mdi-account"></i></span>
                            <span class="menu-item-label">Profile</span>
                        </a>
                    </li>
                </ul>
            </div>
        </aside>
        <section class="section is-title-bar">
            <div class="level">
                <div class="level-left">
                    <div class="level-item">
                        <ul>
                            <li>User</li>
                            @yield('breadcrumb')
                        </ul>
                    </div>
                </div>
            </div>
        </section>

        {{-- <section class="hero is-hero-bar">
            <div class="hero-body">
                <div class="level">
                    <div class="level-left">
                        <div class="level-item">
                            <h1 class="title">Dashboard</h1>
                        </div>
                    </div>
                    <div class="level-right" style="display: none">
                        <div class="level-item"></div>
                    </div>
                </div>
            </div>
        </section> --}}

        @yield('content')

        {{-- <footer class="footer" style="width:100%;position:sticky;bottom:0px;">
            <div class="container-fluid">
                <div class="level">
                    <div class="level-left">
                        <div class="level-item">Help desk & ticketing system</div>
                    </div>
                    <div class="level-right">
                        <div class="level-item">
                            <span>NRWB</span>
                        </div>
                    </div>
                </div>
            </div>
        </footer> --}}
    </div>

    <div id="sample-modal" class="modal">
        <div class="modal-background jb-modal-close"></div>
        <div class="modal-card">
            <header class="modal-card-head">
                <p class="modal-card-title">Confirm action</p>
                <button class="delete jb-modal-close" aria-label="close"></button>
            </header>
            <section class="modal-card-body">
                <p>This will permanently delete <b>Some Object</b></p>
                <p>This is sample modal</p>
            </section>
            <footer class="modal-card-foot">
                <button class="button jb-modal-close">Cancel</button>
                <button class="button is-danger jb-modal-close">Delete</button>
            </footer>
        </div>
        <button class="modal-close is-large jb-modal-close" aria-label="close"></button>
    </div>

    <!-- Scripts below are for demo only -->
    <!-- Scripts below are for demo only -->
    {{-- <script type="text/javascript" src="{{ asset('js/jquery.dataTables.min.js') }}"></script> --}}
    {{-- <script type="text/javascript" src="{{ asset('js/dataTables.bulma.min.js') }}"></script> --}}
    <script type="text/javascript" src="{{ asset('js/jquery.min.js') }}"></script>
    <script type="text/javascript" src="{{ asset('js/chartjs/Chart.min.js') }}"></script>
    <script type="text/javascript" src="{{ asset('js/main.js') }}"></script>
    <script type="text/javascript" src="{{ asset('js/chart.sample.min.js') }}"></script>
    <script type="text/javascript" src="{{ asset('js/bulma-calendar.min.js') }}"></script>
    <script type="text/javascript" src="{{ asset('js/sweetalerts.js') }}"></script>
    <script type="text/javascript" src="{{ asset('js/bulma.js') }}"></script>
    <script type="text/javascript" src="{{ asset('js/bulma-steps.min.js') }}"></script>
    <script type="text/javascript" src="{{ asset('js/jstable.js') }}"></script>

    <!-- Icons below are for demo only. Feel free to use any icon pack. Docs: https://bulma.io/documentation/elements/icon/ -->

    <!-- Code injected by live-server -->
    @yield('scripts')
</body>

</html>
