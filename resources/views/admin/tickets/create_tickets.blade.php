@extends('admin.layout.app')

@section('title')
    <title>Create Ticket - Admin</title>
@endsection

@section('breadcrumb')
    <li>Manage</li>
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
                            <span>Create Ticket</span>
                        </p>
                    </header>
                    <div class="card-content px-2 my-2 mx-10">
                        <div class="column is-full mx-5">
                            <form action="{{ route('admin.tickets.store') }}" method='POST'>
                                @csrf
                                <div class="columns is-mobile is-multiline">
                                    <div class="column is-half pt-0">
                                        <label>Ticket Description</label>
                                        <div class="control">
                                            <input name="description" class="input" placeholder="Enter description"
                                                required>
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
                                            <input type="date" id="duedate" value="{{ old('due_date') }}"
                                                name="due_date" data-close-on-select="false">
                                        </div>
                                        <p class="help is-link"><span class="tag is-rounded is-info" id="datediff">--
                                                days</span></p>
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
                                    <div class="column is-half pt-0">
                                        <label>Comment</label>
                                        <div>
                                            <div>
                                                <textarea name="comment" class="textarea"></textarea>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="column is-half pt-0"></div>

                                    <div class="column is-half is-grouped">
                                        <div class="control">
                                            <input type="submit" class="button is-info" id="submit" disabled>
                                        </div>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
            <div class="column is-2"></div>
        </div>
    </section>
@endsection

@section('scripts')
    <script>
        $(document).ready(function() {
            const calendar = bulmaCalendar.attach("#duedate", {
                color: 'info'
            });

            // To access to bulmaCalendar instance of an element
            const element = document.querySelector('#duedate');
            const today = new Date();

            if (element) {
                // element.bulmaCalendar.value(today)
                // bulmaCalendar instance is available as element.bulmaCalendar
                element.bulmaCalendar.on('select', datepicker => {
                    showDiff(today, new Date(datepicker.data.value()));
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
