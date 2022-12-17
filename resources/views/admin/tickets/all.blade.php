@extends('admin.layout.app')

@section('title')
    <title>Dashboard - Admin</title>
@endsection

@section('content')
    <!-- START ISSUES LIST-->
    <div class="column">
        <!-- START ISSUES CARD LIST-->
        <div class="columns is-desktop">
            <div class="column" style="margin-left: 200px;">
                <div class="columns  is-desktop has-text-centered">
                    <div class="column is-2">
                        <a href="{{ route('admin.tickets.view', ['status' => 'new']) }}">
                            <div class="card">
                                <div class="card-content">
                                    <div class="content">
                                        <div>
                                            <p class="subtitle">New</p>
                                            <p class="title">{{ $newCount }}</p>
                                        </div>
                                    </div>
                                </div>
                                <div class="card-active"></div>
                            </div>
                        </a>
                    </div>

                    <div class="column is-2">
                        <a href="{{ route('admin.tickets.view', ['status' => 'open']) }}">
                            <div class="card">
                                <div class="card-content">
                                    <div class="content">
                                        <div>
                                            <p class="subtitle">Open</p>
                                            <p class="title">{{ $openCount }}</p>
                                        </div>
                                    </div>
                                </div>
                                <div class="card-open"></div>
                            </div>
                        </a>
                    </div>

                    <div class="column is-2">
                        <a href="{{ route('admin.tickets.view', ['status' => 'closed']) }}">
                            <div class="card">
                                <div class="card-content">
                                    <div class="content">
                                        <div>
                                            <p class="subtitle">Closed</p>
                                            <p class="title">{{ $closedCount }}</p>
                                        </div>
                                    </div>
                                </div>
                                <div class="card-closed"></div>
                            </div>
                        </a>
                    </div>

                    <div class="column is-2">
                        <a href="{{ route('admin.tickets.view', ['status' => 'overdue']) }}">
                            <div class="card">
                                <div class="card-content">
                                    <div class="content">
                                        <div>
                                            <p class="subtitle has-text-danger">Overdue</p>
                                            <p class="title has-text-danger">32</p>
                                        </div>
                                    </div>
                                </div>
                                <div class="card-overdue"></div>
                            </div>
                        </a>
                    </div>



                </div>
            </div>
        </div>
        <!-- END ISSUES CARD LIST-->


        <div class="tags has-addons">
            <span class="tag is-size-8 is-rounded">Tickets</span>
            <span @class([
                'tag',
                'is-danger' => session('status') === 'Overdue',
                'is-info' => session('status') !== 'Overdue',
                'is-size-8',
                'is-rounded',
            ])>{{ session('status') }}</span>
        </div>
        <div class="column box is-multiline">
            <table class="table is-fullheight is-striped is-hoverable is-bordered is-fullwidth" id='table'>
                <thead>
                    <tr>
                        <th>Ticket #</th>
                        <th>Ticket name</th>
                        <th>Department</th>
                        <th>Assigned by</th>
                        <th>Priority</th>
                        <th>Due</th>
                        <th>Action</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($tickets as $ticket)
                        <tr>
                            <td>{{ $loop->index + 1 }}</td>
                            <td>{{ $ticket->name }}</td>
                            <td>{{ $ticket->department->name }}</td>
                            <td>{{ $ticket->assigner->name }}</td>
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
                            <td>{{ $m->format('d F,Y') }}</td>
                            <td>
                                <div>
                                    <button class="button is-rounded is-small is-primary" type="button">
                                        <span class="icon">
                                            <i class="mdi mdi-eye"></i>
                                        </span>
                                    </button>
                                    <a href={{ route('admin.tickets.edit', ['ticket' => $ticket->id]) }}>
                                        <button class="button is-rounded is-small is-info jb-modal"
                                            data-target="sample-modal" type="button">
                                            <span class="icon">
                                                <i class="mdi mdi-desktop-mac"></i>
                                            </span>
                                        </button>
                                    </a>
                                    <button class="button is-rounded is-small is-danger jb-modal" data-target="sample-modal"
                                        type="button">
                                        <span class="icon">
                                            <i class="mdi mdi-trash-can-outline"></i>
                                        </span>
                                    </button>
                                </div>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
    <!-- END ISSUES LIST -->
@endsection

@section('script')
    <script>
        $(document).ready(function() {
            $('#table').DataTable();
        });
    </script>
@endsection
