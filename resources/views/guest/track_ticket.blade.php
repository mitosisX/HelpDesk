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
                                    'pulse' => $ticket->status === 'closed' && $ticket->resolved === 0,
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
                                    <p class="step-title">Agree Resolvment</p>
                                </div>
                            </div>
                            <div class="steps-content">
                                <div class="step-content has-text-centered is-active">
                                    <div class="field is-horizontal">
                                        <div class="field-body">
                                            <div class="field ">
                                                <div class="control">
                                                    <div class="card box">
                                                        <div class="card-content">
                                                            @if ($ticket->status == 'new')
                                                                <div class="content">
                                                                    <h1 class="title">Your ticket was sent. Please await
                                                                        response</h1>
                                                                </div>
                                                            @elseif ($ticket->status == 'open')
                                                                <div class="content">
                                                                    <h1 class="title">Your ticket has been assigned to an
                                                                        IT staff.</h1>
                                                                </div>
                                                            @elseif ($ticket->status == 'closed' && $ticket->resolved == false)
                                                                <div class="content">
                                                                    <h1 class="title is-4">Your ticket was
                                                                        resolved. You can
                                                                        confirm by clicking the button below.</h1>

                                                                    <button class="button is-primary" id='markDone'>
                                                                        <span class="icon">
                                                                            <i
                                                                                class="mdi mdi-briefcase-account-outline"></i>
                                                                        </span>
                                                                        <span>Confirm</span>
                                                                    </button>
                                                                </div>
                                                            @elseif ($ticket->status == 'closed' && $ticket->resolved)
                                                                <div class="content">
                                                                    <h1 class="title is-4">Your ticket was successfully
                                                                        marked as closed</h1>
                                                                </div>
                                                            @endif
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
            </div>
            <div class="column is-2"></div>
        </div>
    </section>
@endsection

@section('scripts')
    <script src="{{ asset('js/bulma-calendar.min.js') }}"></script>

    <script>
        var id = "{{ $ticket->id }}";

        var button;
        var tag = '#markDone';

        $(tag).click(() => {
            button = this;
            $('#markDone').toggleClass('is-loading');

            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });

            $.ajax({
                url: "{{ route('user.ticket.manage.markdone') }}",
                type: "POST",
                data: {
                    id,
                },
                dataType: 'json',
                success: function(data) {
                    // alert(JSON.stringify(data));
                    $(tag).toggleClass('is-loading');
                    $(tag).toggleClass('is-success');

                    $(tag).html(`<button class="button is-success">
                                    <span class="icon">
                                        <i class="mdi mdi-check"></i>
                                    </span>
                                    <span>Closed</span>
                                </button>`);
                    $(tag).unbind();

                    new swal("Done!",
                        "Agreement was successful. Ticket closed.",
                        "success").then(function() {
                        window.location.reload();
                    });
                }
            });
        });
    </script>
@endsection
