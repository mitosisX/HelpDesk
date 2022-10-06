<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href="{{ asset('css/bulma.min.css') }}">
    <link rel="stylesheet" href="{{ asset('css/extensions/modal-fx.min.css') }}">
    <link rel="stylesheet" href="{{ asset('css/extensions/bulma-radio-checkbox.min.css') }}">
    <link rel="stylesheet" href="{{ asset('css/extensions/bulma-badge.min.css') }}">
    <link rel="stylesheet" href="{{ asset('css/extensions/bulmatable.min.css') }}">
    <link rel="stylesheet" href="{{ asset('css/extensions/bulma-calendar.min.css') }}">
    <link rel="stylesheet" href="{{ asset('css/fontawesome/css/fontawesome.min.css') }}">
    <link rel="stylesheet" href="{{ asset('css/styles.css') }}">
    <link rel="stylesheet" href="{{ asset('css/simple-tags.css') }}">
    @yield('title')
</head>
<body>
    <section class="hero is-info" style="position: sticky;top:0px;z-index:100;">
        <div class="hero-body">
            <p class="title">
            Nothern Region Water Board (NRWB)
            </p>
            <p class="subtitle">
            Help desk system
            </p>
        </div>
    </section>
    
    <div class="columns my-1 mx-2">
        <div class="column box is-2">
            
        <!-- START SIDE MENU -->
            <aside class="menu">
                <p class="menu-label">
                  General
                </p>
                <ul class="menu-list">
                  <li><a href="{{ route('admin.dashboard') }}">Dashboard</a></li>
                  <li><a>Profile</a></li>
                </ul>
                <p class="menu-label">
                  Tickets
                </p>
                <ul class="menu-list">
                  <!-- <li><a>Team Settings</a></li> -->
                  <li>
                    <a class="is-active has-background-info">Statistics</a>
                    <ul>
                      <li><a>Active</a></li>
                      <li><a>Open</a></li>
                      <li><a>Closed</a></li>
                      <li><a>Overdue</a></li>
                    </ul>
                  </li>
                  <li><a>All tickets</a></li>
                  <li><a href="{{ route('admin.create_ticket') }}">Create Ticket</a></li>
                  <li><a>Authentication</a></li>
                </ul>
                <p class="menu-label">
                  Miscenellaneous
                </p>
                <ul class="menu-list">
                  <li><a>Payments</a></li>
                  <li><a>Transfers</a></li>
                  <li><a>Balance</a></li>
                </ul>
              </aside>
        </div>
        <!-- END SIDE MENU -->
        @yield('content')
    </div>


    
    <script src="{{ asset('js/jquery.min.js') }}"></script>
    <script src="{{ asset('js/bulma-tagsinput.min.js') }}"></script>
    <script src="{{ asset('js/bulma-calendar.min.js') }}"></script>
    <script src="{{ asset('js/modal-fx.min.js') }}"></script>
    <script src="{{ asset('js/simple-tags.js') }}"></script>
    @yield('script')
</body>
</html>