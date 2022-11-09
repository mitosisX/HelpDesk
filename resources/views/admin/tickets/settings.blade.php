@extends('staff.layout.app')

@section('title')
    <title>Ticket Settings - Admin</title>
@endsection

@section('content')
    <!-- START ISSUES LIST-->
    <div class="column">
        <div class="column box">
            <nav class="navbar" role="navigation" aria-label="main navigation">
                <div class="navbar-start">
                    <h1 class="title is-size-3 has-text-info">Ticket Settings</h1>
                </div>
                <div class="navbar-end">
                    <div class="tags has-addons">
                        <a href="{{ route('staff.dashboard') }}"><button
                                class="button is-rounded is-info is-hovered">Home</button></a>
                    </div>
                </div>
            </nav>
        </div>

        <section class="section" style="padding: 1.5rem;margin-top:-25px;">
            <div class="columns is-multiline is-12">
                <div class="column is-2"></div>

                <div class="column box is-8">
                    <form action="{{ route('admin.categories.store') }}" method="POST">
                        @csrf
                        <div class="field">
                            <label class="label">Due date criterion</label>
                            <div class="control">
                                <div class="select is-rounded">
                                    <select name="categories_id">
                                        <option value="1">Current Date</option>
                                        <option value="2">Following Day</option>
                                        <option value="3">2 Days</option>
                                    </select>
                                </div>
                            </div>
                        </div>

                        <div class="field">
                            <label class="label">Email</label>
                            <div class="control">
                                <div class="column is-6 no-padding">
                                    <input class="input is-rounded" id='category_name' name="name" type="text"
                                        placeholder="Your full name" value="{{ old('name') }}">
                                </div>
                            </div>
                            @error('name')
                                <p class="help has-text-info">{{ $message }}</p>
                            @enderror
                        </div>

                        <div class="field">
                            <label class="label">Password</label>
                            <div class="control">
                                <div class="column is-6 no-padding">
                                    <input class="input is-rounded" id='category_name' name="name" type="text"
                                        placeholder="Category name" value="{{ old('name') }}">
                                </div>
                            </div>
                            @error('name')
                                <p class="help has-text-info">{{ $message }}</p>
                            @enderror
                        </div>

                        <div class="field is-grouped">
                            <div class="control">
                                <button class="button is-info is-rounded" id="submit">Save</button>
                            </div>
                        </div>
                    </form>
                </div>

                <div class="column is-2"></div>
            </div>
        </section>
    </div>
@endsection
