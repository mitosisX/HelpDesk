@extends('admin.layout.app')
@section('title')
    <title>Dashboard - Admin</title>
@endsection

@section('breadcrumb')
    <li>Manage</li>
    <li>Tickets</li>
@endsection

@section('content')
    <section class="section is-main-section">
        <div class="tile is-ancestor">
            <!-- First Card - For New -->
            <div class="tile is-parent">
                <div class="card tile is-child">
                    <a href="{{ route('admin.tickets.view', ['status' => 'new']) }}">
                        <div class="card-content">
                            <div class="level is-mobile">
                                <div class="level-item">
                                    <div class="is-widget-label">
                                        <h3 class="subtitle is-spaced">NEW</h3>
                                        <h1 class="title">{{ $newCount }}</h1>
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
                    <a href="{{ route('admin.tickets.view', ['status' => 'open']) }}">
                        <div class="card-content">
                            <div class="level is-mobile">
                                <div class="level-item">
                                    <div class="is-widget-label">
                                        <h3 class="subtitle is-spaced">OPEN</h3>
                                        <h1 class="title">{{ $openCount }}</h1>
                                    </div>
                                </div>
                                <div class="level-item has-widget-icon">
                                    <div class="is-widget-icon">
                                        <span class="icon has-text-primary is-large">
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
                    <a href="{{ route('admin.tickets.view', ['status' => 'closed']) }}">
                        <div class="card-content">
                            <div class="level is-mobile">
                                <div class="level-item">
                                    <div class="is-widget-label">
                                        <h3 class="subtitle is-spaced">CLOSED</h3>
                                        <h1 class="title">{{ $closedCount }}</h1>
                                    </div>
                                </div>
                                <div class="level-item has-widget-icon">
                                    <div class="is-widget-icon">
                                        <span class="icon has-text-warning is-large"><i
                                                class="mdi mdi-moon-full mdi-48px"></i></span>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </a>
                </div>
            </div>

            <!-- Fourth Card - For Due -->
            <div class="tile is-parent">
                <div class="card tile is-child">
                    <a href="{{ route('admin.tickets.view', ['status' => 'overdue']) }}">
                        <div class="card-content">
                            <div class="level is-mobile">
                                <div class="level-item">
                                    <div class="is-widget-label">
                                        <h3 class="subtitle is-spaced">DUE</h3>
                                        <h1 class="title">2</h1>
                                    </div>
                                </div>
                                <div class="level-item has-widget-icon">
                                    <div class="is-widget-icon">
                                        <span class="icon has-text-danger is-large">
                                            <i class="mdi mdi-moon-full mdi-48px"></i>
                                        </span>
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
        <div class="card has-table has-mobile-sort-spaced">
            <header class="card-header">
                <p class="card-header-title">
                    {{-- <span class="icon"><i class="mdi mdi-account-multiple"></i></span> --}}

                    <span class="tags has-addons">
                        <span class="tag is-size-8 is-rounded">Tickets</span>
                        <span @class([
                            'tag',
                            'is-danger' => session('status') === 'Overdue',
                            'is-info' => session('status') !== 'Overdue',
                            'is-size-8',
                            'is-rounded',
                        ])>{{ session('status') }}</span>
                    </span>
                </p>

                <div class="card-header-icon">
                    <button class="button is-small is-rounded is-info" id='create_ticket_modal'>
                        <span class="icon">
                            <i class="mdi mdi-plus"></i>
                        </span>
                        <span class="menu-item-label">Create</span>
                    </button>
                </div>
            </header>
            <div class="card-content px-2 my-2">
                <div class="b-table has-pagination">
                    <div class="column is-full">
                        <table class="table is-fullwidth is-striped is-hoverable is-fullwidth" id="tickets_table">
                            <thead>
                                <tr>
                                    <th>Ticket #</th>
                                    <th>Ticket name</th>
                                    <th>Department</th>
                                    <th>Assigned to</th>
                                    <th>Priority</th>
                                    <th>Status</th>
                                    <th>Due</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($tickets as $ticket)
                                    <tr>
                                        <td>{{ $loop->index + 1 }}</td>
                                        <td>{{ $ticket->description }}</td>
                                        <td>{{ $ticket->reporter->department->name }}</td>
                                        <td>{{ isset($ticket->assignee->name) ? $ticket->assignee->name : '----' }}</td>
                                        {{-- {{ dd($ticket) }} --}}
                                        <td>
                                            @php
                                                $tagColor = $ticket->priority;
                                                
                                                $m = new \Moment\Moment($ticket->due_date);
                                            @endphp

                                            <span @class([
                                                'tag',
                                                'is-rounded',
                                                'is-success' => $tagColor == 'Low',
                                                'is-warning' => $tagColor == 'Medium',
                                                'is-danger' => $tagColor == 'High',
                                            ])>{{ $ticket->priority }}</span>
                                        </td>
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
                                        <td>{{ $m->format('d F,Y') }}</td>
                                        <td>
                                            <div>
                                                <div class="field has-addons">

                                                    {{-- <button class="button is-rounded is-small is-primary" type="button">
                                                        <span class="icon">
                                                            <i class="mdi mdi-eye"></i>
                                                        </span>
                                                        <span>View</span>
                                                    </button> --}}
                                                    <a class="control"
                                                        href={{ route('admin.tickets.assign', ['ticket' => $ticket->id]) }}>
                                                        <button class="button is-small is-info is-rounded"
                                                            data-target="sample-modal" type="button">
                                                            <span class="icon">
                                                                <i class="mdi mdi-pencil"></i>
                                                            </span>
                                                            <span>Edit</span>
                                                        </button>
                                                    </a>
                                                    <a class="control">
                                                        <button class="button is-rounded is-small is-danger jb-modal"
                                                            data-target="sample-modal" type="button">
                                                            <span class="icon">
                                                                <i class="mdi mdi-trash-can-outline"></i>
                                                            </span>
                                                            <span>Delete</span>
                                                        </button>
                                                    </a>
                                                </div>

                                                {{-- <button class="button is-rounded is-small is-primary" type="button">
                                                    <span class="icon">
                                                        <i class="mdi mdi-eye"></i>
                                                    </span>
                                                </button>
                                                <a href={{ route('admin.tickets.edit', ['ticket' => $ticket->id]) }}>
                                                    <button class="button is-rounded is-small is-info jb-modal"
                                                        data-target="sample-modal" type="button">
                                                        <span class="icon">
                                                            <i class="mdi mdi-pencil"></i>
                                                        </span>
                                                    </button>
                                                </a>
                                                <button class="button is-rounded is-small is-danger jb-modal"
                                                    data-target="sample-modal" type="button">
                                                    <span class="icon">
                                                        <i class="mdi mdi-trash-can-outline"></i>
                                                    </span>
                                                </button> --}}
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
    </section>


    {{-- <div id="create_modal" class="modal">
        <div class="modal-background"></div>
        <div class="modal-card">
            <header class="modal-card-head">
                <p class="modal-card-title">
                    <span class="icon"><i class="mdi mdi-account-multiple"></i></span>
                    <span>Create Ticket</span>
                </p>
                <button class="delete" aria-label="close"></button>
            </header>
            <section class="modal-card-body" style="overflow-y: auto;">
                <div class="column">
                    <form action="{{ route('admin.tickets.store') }}" method='POST'>
                        @csrf
                        <div class="columns is-mobile is-multiline">
                            <div class="column is-half pt-0">
                                <label>Ticket Description</label>
                                <div class="control">
                                    <input name="description" class="input" placeholder="Enter description" required>
                                </div>
                                @error('description')
                                    <p class="help is-success">{{ $message }}</p>
                                @enderror
                            </div>
                            <div class="column is-half pt-0">
                                <label>Category</label>
                                <div>
                                    <div class="select">
                                        <select name="categories_id">
                                            @foreach ($categories as $category)
                                                <option value="{{ $category->id }}">{{ $category->name }}
                                                </option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>
                            </div>

                            <div class="column is-half pt-0">
                                <label>Reported By</label>
                                <div>
                                    <div class="select">
                                        <select name="reported_by">
                                            @foreach ($users as $user)
                                                <option value="{{ $user->id }}">{{ $user->name }}
                                                </option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>
                            </div>
                            <div class="column is-half pt-0">
                                <label>Priority</label>
                                <div>
                                    <div class="select">
                                        <select name="priority">
                                            <option>Low</option>
                                            <option>Medium</option>
                                            <option>High</option>
                                        </select>
                                    </div>
                                </div>
                            </div>
                            <div class="column is-half pt-0">
                                <label>Due Date</label>
                                <div>
                                    <input type="date" id="duedate" value="{{ old('due_date') }}" name="due_date"
                                        data-close-on-select="false">
                                </div>
                                <p class="help is-link" id="datediff">-- days</p>
                            </div>
                            <div class="column is-half pt-0">
                                <label>Assign To</label>
                                <div>
                                    <div class="select">
                                        <select name="assigned_to">
                                            @foreach ($staffs as $staff)
                                                <option value="{{ $staff->id }}">
                                                    {{ $staff->name }}
                                                </option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>
                            </div>
                        </div>
                </div>
            </section>
            <footer class="modal-card-foot">
                <input type="submit" class="button is-info" id="submit" disabled>
            </footer>
            </form>
        </div>
    </div> --}}
@endsection

@section('scripts')
    <script>
        $(document).ready(function() {
            $("#tickets_table").DataTable();

            $('#create_ticket_modal').on('click', function() {
                Bulma('#create_modal').modal().open();
            });
        });
    </script>
@endsection
