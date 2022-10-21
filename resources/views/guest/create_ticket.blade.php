@extends('guest.layout.app')

@section('title')
    <title>Create a Ticket - Help Desk</title>
@endsection

@section('content')
    <div class="columns my-2">
        <div class="column is-3"></div>
        <div class="column box">
            <form action="{{ route('guest.store') }}" method="POST">
                @csrf
                <div class="field">
                    <label class="label">Your issue</label>
                    <div class="control">
                        <div class="column is-6 no-padding">
                            <input class="input is-rounded" name="" type="text" placeholder="What's wrong">
                        </div>
                    </div>
                </div>

                <div class="field">
                    <label class="label">Category</label>
                    <div class="control">
                        <div class="select is-rounded">
                            <select name="department">
                                <option>Computer</option>
                                <option>Hardware</option>
                                <option>Network</option>
                            </select>
                        </div>
                    </div>
                    <!-- <p class="help is-success">This username is available</p> -->
                </div>

                <div class="field">
                    <label class="label">Department</label>
                    <div class="control">
                        <div class="select is-rounded">
                            <select>
                                <option>Water</option>
                                <option>Options</option>
                                <option>Board</option>
                            </select>
                        </div>
                    </div>
                    <!-- <p class="help is-success">This username is available</p> -->
                </div>

                <div class="field">
                    <label class="label">Reported by</label>
                    <div class="control">
                        <div class="column is-4 is-gapless no-padding">
                            <input class="input is-rounded" type="text" placeholder="Provide your name">
                        </div>
                    </div>
                    <!-- <p class="help is-danger">This email is invalid</p> -->
                </div>

                <div class="field">
                    <label class="label">Email address</label>
                    <div class="control">
                        <div class="column is-4 is-gapless no-padding">
                            <input class="input is-rounded" type="email" placeholder="Provide your email">
                        </div>
                    </div>
                    <!-- <p class="help is-danger">This email is invalid</p> -->
                </div>

                <div class="field">
                    <label class="label">Location</label>
                    <div class="control">
                        <div class="column is-4 is-gapless no-padding">
                            <input class="input is-rounded" type="text" name="location" value="{{ old('location') }}"
                                placeholder="Provide location">
                        </div>
                    </div>
                    @error('location')
                        <p class="help is-success">{{ $message }}</p>
                    @enderror
                </div>

                <div class="field">
                    <label class="label">Priority</label>
                    <div class="control">
                        <div class="select is-rounded">
                            <select>
                                <option>Urgent</option>
                                <option>Not Urgent</option>
                            </select>
                        </div>
                    </div>
                </div>

                <div class="field is-size-3">
                    <label class="label" for="user_skills">Tags</label>
                    <div class="input" data-name="tags-input">
                        <!--<span class="tag">CSS<span class="close"></span></span>
                                                <span class="tag">JavaScript<span class="close"></span></span>
                                                <span class="tag">HTML<span class="close"></span></span>-->
                    </div>
                    <p class="help has-text-info">
                        Comma-separated
                    </p>
                </div>

                <div class="field">
                    <label class="label">Description</label>
                    <div class="control">
                        <div class="column is-6 no-padding">
                            <textarea class="textarea" placeholder="Provide some brief description of the ticket"></textarea>
                        </div>
                    </div>
                </div>

                <div class="field is-grouped">
                    <div class="control">
                        <button class="button is-info is-rounded" id="submit">Submit</button>
                    </div>
                    <div class="control">
                        <button class="button is-danger is-light is-rounded">Clear</button>
                    </div>
                </div>
            </form>
        </div>
        <div class="column is-3"></div>
    </div>
@endsection

@section('scripts')
    <script src="{{ asset('js/bulma-calendar.min.js') }}"></script>
    <script src="{{ asset('js/tags.js') }}"></script>
    <script>
        var calendars = bulmaCalendar.attach('[type="date"]');
    </script>
@endsection
