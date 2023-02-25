@extends('staff.layout.app')

@section('title')
<title>Profile - Staff</title>
@endsection

@section('breadcrumb')
<li>Manage</li>
<li>Profile</li>
@endsection

@section('content')
<section class="section is-main-section">
    <div class="columns">
        <div class="column is-2"></div>
        <div class="column is-6">
            <div class="card has-table has-mobile-sort-spaced">
                <header class="card-header">
                    <p class="card-header-title">
                        <span class="icon"><i class="mdi mdi-account-multiple"></i></span>
                        <span>Profile</span>
                    </p>
                </header>
                <div class="card-content px-2 my-2 mx-10">
                    <div class="card-content">
                        <form action="{{ route('staff.profile.update') }}" method="POST">
                            {{-- @csrf --}}
                            <div class="field is-horizontal">
                                <div class="field-label is-normal">
                                    <label class="label">Name</label>
                                </div>
                                <div class="field-body">
                                    <div class="field">
                                        <div class="control">
                                            <input type="text" autocomplete="on" name="name" value="John Doe" class="input" required="">
                                        </div>
                                        {{-- <p class="help">Required. Your name</p> --}}
                                    </div>
                                </div>
                            </div>
                            <div class="field is-horizontal">
                                <div class="field-label is-normal">
                                    <label class="label">E-mail</label>
                                </div>
                                <div class="field-body">
                                    <div class="field">
                                        <div class="control">
                                            <input type="email" autocomplete="on" name="email" value="user@example.com" class="input" required="">
                                        </div>
                                        {{-- <p class="help">Required. Your e-mail</p> --}}
                                    </div>
                                </div>
                            </div>

                            <div class="field is-horizontal">
                                <div class="field-label is-normal">
                                    <label class="label">Password</label>
                                </div>
                                <div class="field-body">
                                    <div class="field">
                                        <div class="control">
                                            <input type="text" name="password" value="user@example.com" class="input" required="">
                                        </div>
                                        {{-- <p class="help">Required. Your e-mail</p> --}}
                                    </div>
                                </div>
                            </div>

                            <div class="field is-horizontal">
                                <div class="field-label is-normal"></div>
                                <div class="field-body">
                                    <div class="field">
                                        <div class="control">
                                            <button type="submit" class="button is-small is-info is-rounded">
                                                Submit
                                            </button>
                                        </div>
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
