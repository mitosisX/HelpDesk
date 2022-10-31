@extends('admin.layout.app')

@section('title')
    <title>Create Ticket - Admin</title>
@endsection

@section('content')
    <!-- START ISSUES LIST-->
    <div class="column">
        <div class="column box">
            <nav class="navbar" role="navigation" aria-label="main navigation">
                <div class="navbar-start">
                    <h1 class="title is-size-3 has-text-info">Create ticket</h1>
                </div>
                <div class="navbar-end">
                    <div class="tags has-addons">
                        <span class="tag is-size-6 is-rounded">Ticket number</span>
                        <span class="tag is-info is-size-6 is-rounded">{{ $ticketNumber }}</span>
                    </div>
                </div>
            </nav>
        </div>

        <section class="section" style="padding: 1.5rem;margin-top:-25px;">
            <div class="columns is-multiline is-12">
                <div class="column is-2"></div>
                <div class="column box is-8">
                    <form action="{{ route('admin.tickets.store') }}" method='POST'>
                        @csrf
                        <div class="field">
                            <label class="label">Ticket name</label>
                            <div class="control">
                                <div class="column is-6 no-padding">
                                    <input class="input is-rounded" type="text" name="name"
                                        value="{{ old('name') }}" placeholder="Give the ticket a title">

                                    {{-- To be used fro getting the assignee ID --}}
                                    {{-- <input type="text" name="number" value="2" hidden> --}}
                                </div>
                            </div>
                            @error('name')
                                <p class="help is-success">{{ $message }}</p>
                            @enderror
                        </div>

                        <div class="field">
                            <label class="label">Category</label>
                            <div class="control">
                                <div class="select is-rounded">
                                    <select name="categories_id">
                                        @foreach ($categories as $category)
                                            <option value="{{ $category->id }}">{{ $category->name }}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                            @error('category')
                                <p class="help is-success">{{ $message }}</p>
                            @enderror
                        </div>

                        <div class="field">
                            <label class="label">Department</label>
                            <div class="control">
                                <div class="select is-rounded">
                                    <select name="departments_id">
                                        @foreach ($departments as $department)
                                            <option value="{{ $department->id }}">{{ $department->name }}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                            @error('department')
                                <p class="help is-success">{{ $message }}</p>
                            @enderror
                        </div>

                        <div class="field">
                            <label class="label">Reported by</label>
                            <div class="control">
                                <div class="column is-4 is-gapless no-padding">
                                    <input class="input is-rounded" type="text" name="reported_by"
                                        value="{{ old('reported_by') }}" placeholder="Provide name">
                                </div>
                            </div>
                            @error('reported_by')
                                <p class="help is-success">{{ $message }}</p>
                            @enderror
                        </div>

                        <div class="field">
                            <label class="label">Location</label>
                            <div class="control">
                                <div class="column is-4 is-gapless no-padding">
                                    <input class="input is-rounded" type="text" name="location"
                                        value="{{ old('location') }}" placeholder="Provide location">
                                </div>
                            </div>
                            @error('location')
                                <p class="help is-success">{{ $message }}</p>
                            @enderror
                        </div>

                        <div class="field">
                            <label class="label">Their email</label>
                            <div class="control">
                                <div class="column is-4 no-padding">
                                    <input class="input is-rounded" type="text" name="reporter_email"
                                        value="{{ old('reporter_email') }}" placeholder="Provide their email address">
                                </div>
                            </div>
                            {{-- @error('reporter_email')
                        <p class="help is-success">{{ $message }}</p>
                      @enderror --}}
                        </div>

                        <div class="field">
                            <label class="label">Priority</label>
                            <div class="control">
                                <div class="select is-rounded">
                                    <select name="priority">
                                        <option>Low</option>
                                        <option>Medium</option>
                                        <option>High</option>
                                    </select>
                                </div>
                            </div>
                            @error('priority')
                                <p class="help is-success">{{ $message }}</p>
                            @enderror
                        </div>

                        <div class="field">
                            <label class="label">Tags</label>

                            <div class="input" data-name="tags-input">
                            </div>
                            @error('tags')
                                <p class="help is-success">{{ $message }}</p>
                            @enderror
                        </div>

                        {{-- <div class="field">
                      <label class="label" for="user_skills">Tags</label>
                      <div class="simple-tags"
                          id="container"
                          name="tags"
                          data-simple-tags="CodeHim, HTML">
                      </div>
                      <p class="help has-text-info">
                        Comma-separated
                      </p>
                    </div> --}}

                        <div class="field">
                            <label class="label">Due date</label>
                            <div class="control">
                                <div class="column is-3 no-padding">
                                    <input type="date" id="duedate" value="{{ old('due_date') }}" name="due_date"
                                        data-close-on-select="false">
                                </div>
                            </div>
                            <p class="help is-link" id="datediff">-- days</p>
                        </div>

                        <div class="field">
                            <label class="label">Assign task to</label>
                            <div class="control">
                                <div class="select is-rounded">
                                    <select name="assignee">
                                        @foreach ($staff as $user)
                                            <option value="{{ $user->id }}">{{ $user->name }}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                            @error('priority')
                                <p class="help is-success">{{ $message }}</p>
                            @enderror
                        </div>

                        <div class="field">
                            <label class="label">Description</label>
                            <div class="control">
                                <div class="column is-6 no-padding">
                                    <textarea class="textarea" name="description" placeholder="Provide some brief description of the ticket">{{ old('description') }}</textarea>
                                </div>
                            </div>
                            @error('description')
                                <p class="help is-success">{{ $message }}</p>
                            @enderror
                        </div>

                        <div class="field is-grouped">
                            <div class="control">
                                <input type="submit" class="button is-info is-rounded" id="submit" disabled>
                            </div>
                            <div class="control">
                                <input type="button" class="button is-danger is-light is-rounded" value="Clear" />
                            </div>
                        </div>
                    </form>
                </div>
                <div class="column is-2"></div>
            </div>
        </section>
    </div>
    <!-- END ISSUES LIST -->
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
