@extends('manager.layout.app')

@section('title')
    <title>Dashboard - Manager</title>
@endsection

@section('breadcrumb')
    <li>Manage</li>
    <li>Dashboard</li>
@endsection

@php
    use App\Queries\SpecialQueries;
    $counter = SpecialQueries::ticketCounter();
@endphp

@section('content')
    <section class="section is-main-section">
        <div class="tile is-ancestor">
            <div class="tile is-parent">
                <div class="card tile is-child">
                    <div class="card-content">
                        <div class="level is-mobile">
                            <div class="level-item">
                                <div class="is-widget-label">
                                    <h3 class="subtitle is-spaced">
                                        New
                                    </h3>
                                    <h1 class="title">
                                        {{ $counter['newCount'] }}
                                    </h1>
                                </div>
                            </div>
                            <div class="level-item has-widget-icon">
                                <div class="is-widget-icon"><span class="icon has-text-info is-large"><i
                                            class="mdi mdi-circle mdi-48px"></i></span>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="tile is-parent">
                <div class="card tile is-child">
                    <div class="card-content">
                        <div class="level is-mobile">
                            <div class="level-item">
                                <div class="is-widget-label">
                                    <h3 class="subtitle is-spaced">
                                        Open
                                    </h3>
                                    <h1 class="title">
                                        {{ $counter['openCount'] }}
                                    </h1>
                                </div>
                            </div>
                            <div class="level-item has-widget-icon">
                                <div class="is-widget-icon"><span class="icon has-text-primary is-large"><i
                                            class="mdi mdi-circle mdi-48px"></i></span>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="tile is-parent">
                <div class="card tile is-child">
                    <div class="card-content">
                        <div class="level is-mobile">
                            <div class="level-item">
                                <div class="is-widget-label">
                                    <h3 class="subtitle is-spaced">
                                        Closed
                                    </h3>
                                    <h1 class="title">
                                        {{ $counter['closedCount'] }}
                                    </h1>
                                </div>
                            </div>
                            <div class="level-item has-widget-icon">
                                <div class="is-widget-icon"><span class="icon has-text-warning is-large"><i
                                            class="mdi mdi-circle mdi-48px"></i></span>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="tile is-ancestor">
            <div class="tile is-parent">
                <div class="card tile is-child">
                    <div class="card-header">
                        <span class="icon"><i class="mdi mdi-finance"></i></span>
                        Status
                    </div>
                    <div class="card-content">
                        <div class="level is-mobile">
                            <div class="level-item">
                                <div class="is-widget-label">
                                    <canvas id="statusChart" width="200" height="200"></canvas>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="tile is-parent">
                <div class="card tile is-child">
                    <div class="card-header">
                        <span class="icon"><i class="mdi mdi-finance"></i></span>
                        Priorities
                    </div>
                    <div class="card-content">
                        <div class="level is-mobile">
                            <div class="level-item">
                                <div class="is-widget-label">
                                    <canvas id="priorityChart" width="200" height="200"></canvas>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="tile is-parent">
                <div class="card tile is-child">
                    <div class="card-content">
                        <div class="level is-mobile">
                            <div class="level-item">
                                <div class="is-widget-label">
                                    <canvas id="" width="200" height="200"></canvas>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="tile is-parent">
                <div class="card tile is-child">
                    <div class="card-content">
                        <div class="level is-mobile">
                            <div class="level-item">
                                <div class="is-widget-label">
                                    <canvas id="" width="200" height="200"></canvas>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection

@section('scripts')
    <script>
        var statusChart = document.getElementById("statusChart");
        var priorityChart = document.getElementById("priorityChart");

        $(document).ready(function() {
            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });

            $.ajax({
                url: `{{ route('manager.tickets.stats.json') }}`,
                type: "GET",
                dataType: 'json',
                success: function(data) {
                    new Chart(statusChart, {
                        type: 'doughnut',
                        data: {
                            labels: ['New', 'Open', 'Closed'],
                            datasets: [{
                                label: 'Status',
                                data: [data['new'], data['open'],
                                    data['closed']
                                ],
                                backgroundColor: [
                                    '#209CEE',
                                    '#00D1B2',
                                    '#FFE08A'
                                ],
                                borderWidth: 2
                            }]
                        },
                        options: {
                            // cutoutPercentage: 40,
                            responsive: !false,

                        }
                    });
                }
            });

            $.ajax({
                url: `{{ route('manager.tickets.priority.json') }}`,
                type: "GET",
                dataType: 'json',
                success: function(data) {
                    new Chart(priorityChart, {
                        type: 'doughnut',
                        data: {
                            labels: ['Low', 'Medium', 'High'],
                            datasets: [{
                                label: 'Status',
                                data: [data['low'], data['medium'],
                                    data['high']
                                ],
                                backgroundColor: [
                                    '#209CEE',
                                    '#00D1B2',
                                    '#FFE08A'
                                ],
                                borderWidth: 2
                            }]
                        },
                        options: {
                            // cutoutPercentage: 40,
                            responsive: !false,

                        }
                    });
                }
            });
        });
    </script>
@endsection
