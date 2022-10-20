<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="{{ asset('css/bulma.min.css') }}"/>
    <link rel="stylesheet" href="{{ asset('css/extensions/bulmatable.min.css') }}"/>
    <link rel="stylesheet" href="{{ asset('css/extensions/bulma-steps.css') }}"/>
    <link rel="stylesheet" href="{{ asset('css/mdi/font/css/materialdesignicons.min.css') }}"/>
    <link rel="stylesheet" href="{{ asset('css/extensions/bulma-calendar.min.css') }}"/>
    <link rel="stylesheet" href="{{ asset('css/styles.css') }}"/>
    <link rel="stylesheet" href="{{ asset('css/tags.css') }}"/>

    @yield('title')
</head>
<body>
    <section class="hero is-info">
        <div class="hero-body">
            <p class="title">
            Nothern Region Water Board (NRWB)
            </p>
            <p class="subtitle">
            Help desk system
            </p>
        </div>
    </section>
    
    <section class="section">
        <div class="column">
            <ul class="steps is-narrow is-medium is-centered has-content-centered">
            <li class="steps-segment">
                <a href="{{ route('guest.ticket') }}" class="has-text-dark">
                <span class="steps-marker">
                    <span class="icon">
                    <i class="mdi mdi-account-edit"></i>
                    </span>
                </span>
                <div class="steps-content">
                    <p class="heading">Create Ticket</p>
                </div>
                </a>
            </li>
            <li class="steps-segment is-active ">
                <a href="{{ route('guest.reference.enter') }}" class="has-text-dark">
                <span class="steps-marker">
                    <span class="icon">
                    <i class="mdi mdi-barcode-scan"></i>
                    </span>
                </span>
                <div class="steps-content">
                    <p class="heading">Reference Number</p>
                </div>
                </a>
            </li>
            <li class="steps-segment is-active is-dashed">
                <span class="steps-marker is-hollow">
                <span class="icon">
                    <i class="mdi mdi-compass-outline"></i>
                </span>
                </span>
                <div class="steps-content">
                <p class="heading">Track</p>
                </div>
            </li>
            <li class="steps-segment">
                <span class="steps-marker is-hollow">
                <span class="icon">
                    <i class="mdi mdi-check-bold"></i>
                </span>
                </span>
                <div class="steps-content">
                <p class="heading">Resolved</p>
                </div>
            </li>
            </ul>
        </div>


        @yield('content')
    </section>

    @yield('scripts')
</body>
</html>