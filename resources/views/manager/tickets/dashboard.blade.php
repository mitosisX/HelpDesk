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

    <div class="column">
        <div class="column">
        </div>

        <section class="section" style="padding: 1.5rem;margin-top:-25px;">
            <div class="columns is-multiline is-12">
                <div class="column is-1"></div>
                <div class="column box is-10">

                    <div class="tabs is-boxed is-centered">
                        <ul>
                            <li class="is-active"><a id="1"><span>General</span></a></li>
                            <li><a id="2"><span>Location & Departments</span></a></li>
                            <li><a id="3"><span>Months Report</span></a></li>
                        </ul>
                    </div>

                    <div class="tab-content">
                        <div class="tab-pane is-active" id="1">
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
                            </div>
                        </div>
                        <div class="tab-pane" id="2">
                            <div class="columns is-multiline">
                                <div class="column is-12">
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

                                <div class="column">
                                    <div class="card tile is-child">
                                        <div class="card-header">
                                            <p class="card-header-title">
                                                <span class="icon"><i class="mdi mdi-finance"></i></span>
                                                Ticket Stats #2
                                            </p>
                                            <a class="card-header-icon">
                                                <label for="start_date">From</label>
                                                <input class="input bulmaCalendar" id="start_date" name="due_date" type="date" data-color="info">

                                                <label for="end_date">To</label>
                                                <input class="input bulmaCalendar" id="end_date" name="due_date" type="date" data-color="info">
                                            </a>
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
                            </div>
                        </div>

                        <div class="tab-pane" id="3">
                            <div class="columns is-multiline">
                                <div class="column">
                                    <div class="card tile is-child">
                                        <div class="card-header">
                                            <p class="card-header-title">
                                                <span class="icon"><i class="mdi mdi-finance"></i></span>
                                                Ticket Stats #3
                                            </p>
                                            <a class="card-header-icon">
                                                <label for="start_date">From</label>
                                                <input class="input" id="monthly_start_date" name="monthly_start_date" type="date" data-color="info">

                                                <label for="end_date">To</label>
                                                <input class="input" id="monthly_end_date" name="monthly_end_date" type="date" data-color="info">

                                            </a>
                                        </div>
                                        <div class="card-content">
                                            <div class="level">
                                                <div class="level-item">
                                                    <div class="is-widget-label">
                                                        <canvas id="monthTicketsCount" width="700" height="300"></canvas>
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
                <div class="column is-1"></div>
            </div>
        </section>
        <!-- END ISSUES LIST -->
    </div>


    {{-- <div class="tile is-ancestor">
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
    </div> --}}
</section>
@endsection

@section('scripts')
<script>
    var statusChart = document.getElementById("statusChart");
    var priorityChart = document.getElementById("priorityChart");
    var ticketsLocations = document.getElementById("ticketsLocations");
    var ticketsDepartments = document.getElementById("ticketsDepartments");
    var monthTicketsCount = document.getElementById("monthTicketsCount");

    $(document).ready(function() {
        // $('#dept_loc_div').hide();
        $('#tab_general').css('is-active');

        $('#monthly_end_date').change(function() {
            let start_date = $('#monthly_start_date').val()
            let end_date = $('#monthly_end_date').val()

            $.ajax({
                url: `{{ route('manager.ticket.stats.daily.json') }}`
                , type: "GET"
                , dataType: 'json'
                , data: {
                    start_date
                    , end_date
                }
                , success: function(data) {
                    const dates = data.map(item => item.date);
                    const counts = data.map(item => item.count);

                    // // To avoid the top count getting dominance,
                    // // The sum is appende to be the dominant
                    counts.push(counts.reduce((a, b) => a + b, 0) + 1);

                    new Chart(monthTicketsCount, {
                        type: 'line'
                        , data: {
                            labels: dates
                            , datasets: [{
                                label: 'Tickets Created'
                                , data: counts
                                , backgroundColor: 'rgba(0, 119, 204, 0.3)'
                                , borderColor: 'rgba(0, 119, 204, 1)'
                                , borderWidth: 1
                            }]
                        }
                        , options: {
                            responsive: true
                            , scales: {
                                yAxes: [{
                                    ticks: {
                                        suggestedMin: 0
                                        , stepSize: 1
                                    }
                                }]
                            }
                            // , scales: {
                            //     xAxes: [{
                            //         type: 'time'
                            //         , time: {
                            //             unit: 'day'
                            //         }
                            //         , ticks: {
                            //             autoSkip: true
                            //             , maxTicksLimit: 20
                            //         }
                            //     }]
                            //     , yAxes: [{
                            //         ticks: {
                            //             beginAtZero: true
                            //         }
                            //     }]
                            // }
                        }
                    });
                }
            });
        });

        // $('#tab_general').click(function() {
        //     openTab(this, 'prior_status_div');
        // });

        // $('#tab_departmental').click(function() {
        //     openTab(this, 'dept_loc_div');
        // });

        // $('#tab_locational').click(function() {
        //     openTab(this, 'tab_locational');
        // });

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

    let prevTab = null;
    let currTab = null;

    function tabSwitcher() {}

    function addon(obj) {
        prevTab = currTab;
        currTab = obj;

        // console.log($(currTab).near.val())

        $(prevTab).toggleClass('is-active');
        $(currTab).toggleClass('is-active');
    }

</script>
@endsection
