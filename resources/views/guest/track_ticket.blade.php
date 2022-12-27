@extends('guest.layout.app')

@section('title')
    <title>Track Tickets - NRWB system</title>
@endsection

@section('breadcrumb')
    <li>Track</li>
    <li>Tickets</li>
@endsection

@section('content')
    <section class="section is-main-section">
        <div class="columns">
            <div class="column is-2"></div>
            <div class="column is-8">
                <div class="card has-table has-mobile-sort-spaced">
                    <header class="card-header">
                        <p class="card-header-title">
                            <span class="icon"><i class="mdi mdi-account-multiple"></i></span>
                            <span>Ticket Progress</span>
                        </p>
                    </header>
                    <div class="card-content px-2 my-2 mx-10">

                        <div class="steps my-5" id="stepsDemo">
                            <div @class([
                                'step-item',
                                'is-info',
                                'is-active' =>
                                    $ticket->status === 'new' ||
                                    $ticket->status === 'open' ||
                                    $ticket->status === 'closed',
                            ])>
                                <div @class(['step-marker', 'pulse' => $ticket->status === 'new'])>1</div>
                                <div class="step-details">
                                    <p class="step-title">Issue Sent</p>
                                </div>
                            </div>
                            <div @class([
                                'step-item',
                                'is-info',
                                'is-active' => $ticket->status === 'open' || $ticket->status === 'closed',
                            ])>
                                <div @class(['step-marker', 'pulse' => $ticket->status === 'open'])>2</div>
                                <div class="step-details">
                                    <p class="step-title">Attended To</p>
                                </div>
                            </div>
                            <div @class([
                                'step-item',
                                'is-info',
                                'is-active' => $ticket->status === 'closed',
                            ])>
                                <div @class([
                                    'step-marker',
                                    'pulse' => $ticket->status === 'closed' && $ticket->status === 0,
                                ])>3</div>
                                <div class="step-details">
                                    <p class="step-title">Resolved</p>
                                </div>
                            </div>
                            <div @class([
                                'step-item',
                                'is-info',
                                'is-active' => $ticket->status === 'closed' && $ticket->resolved == 1,
                            ])>
                                <div @class([
                                    'step-marker',
                                    'is-hollow',
                                    'pulse' => $ticket->resolved === 1,
                                ])>
                                    <div class="icon">
                                        <span class="mdi mdi-check"></span>
                                    </div>
                                </div>
                                <div class="step-details">
                                    <p class="step-title">Agreed Resolvment</p>
                                </div>
                            </div>
                            <div class="steps-content">
                                <div class="step-content has-text-centered is-active">

                                    <div class="field is-horizontal">

                                        <div class="field-body">
                                            <div class="field ">
                                                <div class="control">
                                                    <div class="notification is-info">
                                                        <button class="delete"></button>
                                                        Primar lorem ipsum dolor sit amet, consectetur
                                                        adipiscing elit lorem ipsum dolor. <strong>Pellentesque risus
                                                            mi</strong>, tempus quis placerat ut, porta nec nulla.
                                                        Vestibulum rhoncus ac ex sit amet fringilla. Nullam gravida purus
                                                        diam, et dictum <a>felis venenatis</a> efficitur.
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="column is-2"></div>
        </div>
    </section>
@endsection

@section('scripts')
    <script src="{{ asset('js/bulma-calendar.min.js') }}"></script>
@endsection
