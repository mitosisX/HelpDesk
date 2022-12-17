@extends('admin.layout.app')

@section('title')
    <title>Categories - Admin</title>
@endsection

@section('breadcrumb')
    <li>Manage</li>
    <li>Categories</li>
@endsection

@section('content')
    <section class="section is-main-section">

        <div class="columns">
            <div class="column is-2"></div>
            <div class="column is-6">
                <div class="tile is-ancestor">
                    <div class="tile is-parent">
                        <div class="card tile is-child">
                            <header class="card-header">
                                <p class="card-header-title">
                                    <span class="icon"><i class="mdi mdi-account-circle default"></i></span>
                                    Departments
                                </p>
                                <a class="card-header-icon" id='create_ticket_modal'>
                                    <button class="button is-small is-info is-rounded">
                                        <span class="icon"><i class="mdi mdi-plus"></i></span>
                                        <span>Create</span>
                                    </button>

                                </a>
                            </header>
                            <div class="card-content">
                                <table class="table is-fullwidth is-striped is-hoverable is-fullwidth">
                                    <thead>
                                        <tr>
                                            <th>#</th>
                                            <th>Name</th>
                                            <th>Action</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($categories as $category)
                                            <td>{{ $loop->index + 1 }}</td>
                                            <td>{{ $category->name }}</td>
                                            <td>
                                                <div class="field has-addons">
                                                    <p class="control">
                                                        <a href="{{ route('admin.categories.edit', $category->id) }}">
                                                            <button class="button is-rounded is-small is-info">
                                                                <span class="icon is-small">
                                                                    <i class="mdi mdi-pencil-outline"></i>
                                                                </span>
                                                                <span>Edit</span>
                                                            </button>
                                                        </a>
                                                    </p>
                                                    <p class="control">
                                                        <button class="button is-rounded is-small is-danger" id="remove">
                                                            <span class="icon is-small">
                                                                <i class="mdi mdi-trash-can-outline"></i>
                                                            </span>
                                                        </button>
                                                    </p>
                                                </div>
                                            </td>
                                            </tr>
                                        @endforeach
                                        <tr>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="column is-2"></div>
        </div>
    </section>
@endsection

@section('script')
    <script>
        $(document).ready(function() {


            const calendar = bulmaCalendar.attach("#duedate");

            // To access to bulmaCalendar instance of an element
            const element = document.querySelector('#duedate');
            const today = new Date();

            if (element) {
                // bulmaCalendar instance is available as element.bulmaCalendar
                element.bulmaCalendar.on('select', datepicker => {
                    console.log(showDiff(today, new Date(datepicker.data.value())));
                });
            }
        });


        function showDiff(date1, date2) {
            var diffObj = dateDiff(date1, date2);
            var s = diffObj.sign;
            if (diffObj.years > 0) s += diffObj.years + " years, "
            if (diffObj.months > 0) s += diffObj.months + " months, "
            s += diffObj.days + " days" //+diffObj.days>11?'s':''

            if (s.charAt(0) == '-' && s.charAt(1) !== '0') {
                $('#datediff').text('before today');
                $('#submit').attr('disabled', true);
            } else if (s.charAt(0) == '-' && s.charAt(1) == '0') {
                $('#datediff').text('today');
                $('#submit').attr('disabled', false);
            } else if (s.charAt(0) == '1' && s.charAt(1) == ' ') {
                $('#datediff').text('tomorrow');
                $('#submit').attr('disabled', false);
            } else {
                $('#datediff').text(s);
                $('#submit').attr('disabled', false);
            }

            console.log(s)
        }

        function dateDiff(dt1, dt2) {
            // setup return object
            var ret = {
                days: 0,
                months: 0,
                years: 0,
                sign: ""
            };

            // if same date, nothing to do
            if (dt1 == dt2) return ret;

            // we will do absolute diff and set the sign
            if (dt1 > dt2) {
                var dtmp = dt2;
                dt2 = dt1;
                dt1 = dtmp;
                ret.sign = "-";
            }

            // populate variables for comparison
            var year1 = dt1.getFullYear();
            var year2 = dt2.getFullYear();

            var month1 = dt1.getMonth();
            var month2 = dt2.getMonth();

            var day1 = dt1.getDate();
            var day2 = dt2.getDate();

            // calculate differences
            ret.years = year2 - year1;
            ret.months = month2 - month1;
            ret.days = day2 - day1;

            // cope with any negative values.
            if (ret.days < 0) {
                // can't span months by arithmetic, use temp date
                var dtmp = new Date(dt1.getFullYear(), dt1.getMonth() + 1, 1, 0, 0, -1);
                var numDays = dtmp.getDate();

                ret.months -= 1;
                ret.days += numDays;
            }

            // months is pure arithmetic
            if (ret.months < 0) {
                ret.months += 12;
                ret.years -= 1;
            }

            return ret;
        }
    </script>
@endsection
