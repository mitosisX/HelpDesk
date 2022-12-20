@extends('guest.layout.app')

@section('title')
    <title>Track Tickets - Help Desk</title>
@endsection

@section('breadcrumb')
    <li>Track</li>
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
                            <span>Ticket Progress</span>
                        </p>
                    </header>
                    <div class="card-content px-2 my-2 mx-10">
                        <div class="column is-full mx-5">
                            <form action="{{ route('user.tickets.store') }}" method='POST'>
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
                                                    {{-- @foreach ($categories as $category)
                                                        <option value="{{ $category->id }}">{{ $category->name }}
                                                        </option>
                                                    @endforeach --}}
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
                                    </div>

                                    <div class="column is-half is-grouped">
                                        <div class="control">
                                            <input type="submit" class="button is-info" id="submit">
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
    <script src="{{ asset('js/bulma-calendar.min.js') }}"></script>
@endsection
