@extends('guest.layout.app')

@section('title')
    <title>Dashboard - NRWB system</title>
@endsection

@section('breadcrumb')
    <li>Manage</li>
    <li>Tickets</li>
@endsection

@section('content')
    <section class="section is-main-section">
        <div class="tile is-ancestor">
            <!-- First Card - For New -->
            <div class="tile is-parent" style="visibility: hidden">
                <div class="card tile is-child">
                    <a href="{{ route('user.tickets.view', ['status' => 'new']) }}">
                        <div class="card-content">
                            <div class="level is-mobile">
                                <div class="level-item">
                                    <div class="is-widget-label">
                                        <h3 class="subtitle is-spaced">NEW</h3>
                                        <h1 class="title"></h1>
                                    </div>
                                </div>
                                <div class="level-item has-widget-icon">
                                    <div class="is-widget-icon">
                                        <span class="icon has-text-info is-large"><i
                                                class="mdi mdi-moon-full mdi-48px"></i></span>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </a>
                </div>
            </div>

            <!-- Second Card - For Open -->
            <div class="tile is-parent">
                <div class="card tile is-child">
                    <a href="{{ route('user.tickets.view', ['status' => 'new']) }}">
                        <div class="card-content">
                            <div class="level is-mobile">
                                <div class="level-item">
                                    <div class="is-widget-label">
                                        <h3 class="subtitle is-spaced">NEW</h3>
                                        <h1 class="title">{{ $openCount }}</h1>
                                    </div>
                                </div>
                                <div class="level-item has-widget-icon">
                                    <div class="is-widget-icon">
                                        <span class="icon has-text-info is-large">
                                            <i class="mdi mdi-moon-full mdi-48px"></i></span>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </a>
                </div>
            </div>

            <!-- Third Card - For Closed -->
            <div class="tile is-parent">
                <div class="card tile is-child">
                    <a href="{{ route('user.tickets.view', ['status' => 'resolved']) }}">
                        <div class="card-content">
                            <div class="level is-mobile">
                                <div class="level-item">
                                    <div class="is-widget-label">
                                        <h3 class="subtitle is-spaced">RESOLVED</h3>
                                        <h1 class="title">{{ $closedCount }}</h1>
                                    </div>
                                </div>
                                <div class="level-item has-widget-icon">
                                    <div class="is-widget-icon">
                                        <span class="icon has-text-primary is-large"><i
                                                class="mdi mdi-moon-full mdi-48px"></i></span>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </a>
                </div>
            </div>

            <!-- Fourth Card - For Due -->
            <div class="tile is-parent" style="visibility: hidden">
                <div class="card tile is-child">
                    <a href="{{ route('admin.tickets.view', ['status' => 'overdue']) }}">
                        <div class="card-content">
                            <div class="level is-mobile">
                                <div class="level-item">
                                    <div class="is-widget-label">
                                        <h3 class="subtitle is-spaced">DUE</h3>
                                        <h1 class="title"></h1>
                                    </div>
                                </div>
                                <div class="level-item has-widget-icon">
                                    <div class="is-widget-icon">
                                        <span class="icon has-text-danger is-large"><i
                                                class="mdi mdi-moon-full mdi-48px"></i></span>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </a>
                </div>
            </div>
        </div>
    </section>


    <section class="section is-main-section">
        <div class="columns">
            <div class="column is-1"></div>
            <div class="column">
                <div class="card has-table has-mobile-sort-spaced">
                    <header class="card-header">
                        <p class="card-header-title">
                            <span class="icon"><i class="mdi mdi-account-circle default"></i></span>
                            Tickets
                        </p>

                        <a class="card-header-icon" href="{{ route('user.tickets.create') }}">
                            <button class="button is-small is-rounded is-info" id='create_ticket_modal'>
                                <span class="icon">
                                    <i class="mdi mdi-plus"></i>
                                </span>
                                <span class="menu-item-label">Create</span>
                            </button>
                        </a>
                    </header>
                    <div class="card-content px-2 my-2">
                        <div class="b-table has-pagination">
                            <table class="table is-fullwidth is-striped is-hoverable is-fullwidth" id="tickets_table">
                                <thead>
                                    <tr>
                                        <th>Ticket #</th>
                                        <th>Description</th>
                                        {{-- <th>Department</th> --}}
                                        {{-- <th>Assigned to</th> --}}
                                        <th>Status</th>
                                        {{-- <th>Due</th> --}}
                                        <th>Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($tickets as $ticket)
                                        <tr>
                                            <td>{{ $loop->index + 1 }}</td>
                                            <td>{{ $ticket->description }}</td>
                                            {{-- <td>{{ $ticket->reporter->department->name }}</td> --}}
                                            {{-- <td>{{ isset($ticket->assignee->name) ? $ticket->assignee->name : '----' }}</td> --}}
                                            {{-- {{ dd($ticket) }} --}}

                                            <td>
                                                <span @class([
                                                    'tag',
                                                    'is-rounded',
                                                    'is-info' => $ticket->status == 'new',
                                                    'is-success' => $ticket->status == 'open',
                                                    'is-warning' => $ticket->status == 'closed' && $ticket->resolved,
                                                    'is-warning is-light' => $ticket->status == 'closed' && !$ticket->resolved,
                                                ])>{{ $ticket->status }}

                                                    @if ($ticket->resolved === true)
                                                        <span class="mdi mdi-check">
                                                        </span>
                                                    @endif
                                                </span>
                                            </td>
                                            {{-- <td>{{ $m->format('d F,Y') }}</td> --}}
                                            <td>
                                                <div>
                                                    <div class="buttons has-addons">
                                                        <a
                                                            href="{{ route('user.tickets.reference.track', ['ticket' => $ticket->id]) }}">
                                                            <button class="button is-rounded is-small is-primary"
                                                                type="button">
                                                                <span class="icon">
                                                                    <i class="mdi mdi-eye"></i>
                                                                </span>
                                                                <span>Track</span>
                                                            </button>
                                                        </a>
                                                    </div>
                                                </div>
                                            </td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
            <div class="column is-1"></div>
        </div>
    </section>
@endsection

@section('scripts')
    <script>
        new JSTable("#tickets_table");
    </script>
@endsection
