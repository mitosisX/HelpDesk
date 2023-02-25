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
                            <div class="is-widget-icon"><span class="icon has-text-info is-large"><i class="mdi mdi-circle mdi-48px"></i></span>
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
                            <div class="is-widget-icon"><span class="icon has-text-primary is-large"><i class="mdi mdi-circle mdi-48px"></i></span>
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
                            <div class="is-widget-icon"><span class="icon has-text-warning is-large"><i class="mdi mdi-circle mdi-48px"></i></span>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="columns is-multiline">
        <div class="column">
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
        <div class="column">
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

        <div class="column is-5">
            <div class="card tile is-child">
                <div class="card-header">
                    <span class="icon"><i class="mdi mdi-finance"></i></span>
                    Ticket Stats #1
                </div>
                <div class="card-content">
                    <div class="level">
                        <div class="level-item">
                            <div class="is-widget-label">
                                <canvas id="ticketsLocations" width="300" height="200"></canvas>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="column is-5">
            <div class="card tile is-child">
                <div class="card-header">
                    <span class="icon"><i class="mdi mdi-finance"></i></span>
                    Ticket Stats #2
                </div>
                <div class="card-content">
                    <div class="level">
                        <div class="level-item">
                            <div class="is-widget-label">
                                <canvas id="ticketsDepartments" width="300" height="200"></canvas>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        {{-- <div class="tile is-parent">
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
        </div> --}}
    </div>
</section>
@endsection

@section('scripts')
<script>
    var statusChart = document.getElementById("statusChart");
    var priorityChart = document.getElementById("priorityChart");
    var ticketsLocations = document.getElementById("ticketsLocations");
    var ticketsDepartments = document.getElementById("ticketsDepartments");

    $(document).ready(function() {
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });

        $.ajax({
            url: `{{ route('manager.tickets.stats.json') }}`
            , type: "GET"
            , dataType: 'json'
            , success: function(data) {
                new Chart(statusChart, {
                    type: 'doughnut'
                    , data: {
                        labels: ['New', 'Open', 'Closed']
                        , datasets: [{
                            label: 'Status'
                            , data: [data['new'], data['open']
                                , data['closed']
                            ]
                            , backgroundColor: [
                                '#209CEE'
                                , '#00D1B2'
                                , '#FFE08A'
                            ]
                            , borderWidth: 2
                        }]
                    }
                    , options: {
                        // cutoutPercentage: 40,
                        responsive: !false,

                    }
                });
            }
        });

        $.ajax({
            url: `{{ route('manager.tickets.priority.json') }}`
            , type: "GET"
            , dataType: 'json'
            , success: function(data) {
                new Chart(priorityChart, {
                    type: 'doughnut'
                    , data: {
                        labels: ['Low', 'Medium', 'High']
                        , datasets: [{
                            label: 'Status'
                            , data: [data['low'], data['medium']
                                , data['high']
                            ]
                            , backgroundColor: [
                                '#209CEE'
                                , '#00D1B2'
                                , '#FFE08A'
                            ]
                            , borderWidth: 2
                        }]
                    }
                    , options: {
                        // cutoutPercentage: 40,
                        responsive: !false,

                    }
                });
            }
        });

        $.ajax({
            url: `{{ route('manager.ticket.stats.locations.json') }}`
            , type: "GET"
            , dataType: 'json'
            , success: function(data) {

                // To avoid the top count getting dominance,
                // The sum is appende to be the dominant
                data.count.push(data.total)

                new Chart(ticketsLocations, {
                    type: 'bar'
                    , data: {
                        labels: data.locations
                        , datasets: [{
                            label: 'By location'
                            , data: data.count
                            , backgroundColor: [
                                '#209CEE'
                                , '#00D1B2'
                                , '#FFE08A'
                            ]
                            , borderWidth: 2
                            , lineTension: 0.2
                            , borderWidth: 2
                            , pointRadius: 3
                        }]
                    }
                    , options: {
                        // cutoutPercentage: 40,
                        responsive: !false
                        , scales: {
                            yAxes: [{
                                ticks: {
                                    suggestedMin: 0
                                    , stepSize: 1
                                }
                            }]
                        }
                    }
                });
            }
        });

        $.ajax({
            url: `{{ route('manager.ticket.stats.departments.json') }}`
            , type: "GET"
            , dataType: 'json'
            , success: function(data) {
                const keys = Object.keys(data);
                const values = Object.values(data);

                // // To avoid the top count getting dominance,
                // // The sum is appende to be the dominant
                values.push(values.reduce((a, b) => a + b, 0) + 1);

                new Chart(ticketsDepartments, {
                    type: 'bar'
                    , data: {
                        labels: keys
                        , datasets: [{
                            label: 'By departments'
                            , data: values
                            , backgroundColor: [
                                '#209CEE'
                                , '#00D1B2'
                                , '#FFE08A'
                            ]
                            , borderWidth: 2
                            , lineTension: 0.2
                            , borderWidth: 2
                            , pointRadius: 3
                        }]
                    }
                    , options: {
                        // cutoutPercentage: 40,
                        responsive: !false
                        , scales: {
                            yAxes: [{
                                ticks: {
                                    suggestedMin: 0
                                    , stepSize: 1
                                }
                            }]
                        }
                    }
                });
            }
        });
    });

</script>
@endsection
