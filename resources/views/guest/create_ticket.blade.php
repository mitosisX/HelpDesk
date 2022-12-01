@extends('guest.layout.app')

@section('title')
    <title>Create a Ticket - Help Desk</title>
@endsection

@section('content')
    <div class="columns my-2">
        <div class="column is-3"></div>
        <div class="column box">
            <form action="{{ route('guest.tickets.store') }}" method='POST'>
                @csrf
                <div class="field">
                    <label class="label">Ticket name</label>
                    <div class="control">
                        <div class="column is-6 no-padding">
                            <input class="input is-rounded" type="text" name="name" value="{{ old('name') }}"
                                placeholder="Give the ticket a title" value="{{ old('name') }}">
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
                            <input class="input is-rounded" type="text" name="location" value="{{ old('location') }}"
                                placeholder="Provide location">
                        </div>
                    </div>
                    @error('location')
                        <p class="help is-success">{{ $message }}</p>
                    @enderror
                </div>

                <div class="field">
                    <label class="label">Your email</label>
                    <div class="control">
                        <div class="column is-4 no-padding">
                            <input class="input is-rounded" type="text" name="reporter_email"
                                value="{{ old('reporter_email') }}" placeholder="Provide their email address">
                        </div>
                    </div>
                </div>

                <div class="field">
                    <label class="label">Urgency</label>
                    <div class="control">
                        <div class="select is-rounded">
                            <select name="priority">
                                <option value="1">Immediate</option>
                                <option value="2">Not Urgent</option>
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
                        <input type="submit" class="button is-info is-rounded" id="submit">
                    </div>
                    <div class="control">
                        <input type="button" class="button is-danger is-light is-rounded" value="Clear" />
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
