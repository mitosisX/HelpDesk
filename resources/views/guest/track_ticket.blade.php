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

                        <div class="steps" id="stepsDemo">
                            <div class="step-item is-active is-info">
                                <div class="step-marker">1</div>
                                <div class="step-details">
                                    <p class="step-title">Quede</p>
                                </div>
                            </div>
                            <div class="step-item is-active is-info">
                                <div class="step-marker">2</div>
                                <div class="step-details">
                                    <p class="step-title">Profile</p>
                                </div>
                            </div>
                            <div class="step-item is-info is-active">
                                <div class="step-marker pulse">3</div>
                                <div class="step-details">
                                    <p class="step-title">Social</p>
                                </div>
                            </div>
                            <div class="step-item">
                                <div class="step-marker">4</div>
                                <div class="step-details">
                                    <p class="step-title">Finish</p>
                                </div>
                            </div>
                            <div class="steps-content">
                                <div class="step-content has-text-centered is-active">
                                    <div class="field is-horizontal">
                                        <div class="field-label is-normal">
                                            <label class="label">Username</label>
                                        </div>
                                        <div class="field-body">
                                            <div class="field">
                                                <div class="control">
                                                    <input class="input" name="username" id="username" type="text"
                                                        placeholder="Username" autofocus data-validate="require">
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="field is-horizontal">
                                        <div class="field-label is-normal">
                                            <label class="label">Password</label>
                                        </div>
                                        <div class="field-body">
                                            <div class="field">
                                                <div class="control has-icon has-icon-right">
                                                    <input class="input" type="password" name="password" id="password"
                                                        placeholder="Password" data-validate="require">
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="field is-horizontal">
                                        <div class="field-label is-normal">
                                            <label class="label">Confirm password</label>
                                        </div>
                                        <div class="field-body">
                                            <div class="field">
                                                <div class="control has-icon has-icon-right">
                                                    <input class="input" type="password" name="password_confirm"
                                                        id="password_confirm" placeholder="Confirm password"
                                                        data-validate="require">
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="step-content has-text-centered">
                                    <div class="field is-horizontal">
                                        <div class="field-label is-normal">
                                            <label class="label">Firstname</label>
                                        </div>
                                        <div class="field-body">
                                            <div class="field">
                                                <div class="control">
                                                    <input class="input" name="firstname" id="firstname" type="text"
                                                        placeholder="Firstname" autofocus data-validate="require">
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="field is-horizontal">
                                        <div class="field-label is-normal">
                                            <label class="label">Last name</label>
                                        </div>
                                        <div class="field-body">
                                            <div class="field">
                                                <div class="control has-icon has-icon-right">
                                                    <input class="input" type="text" name="lastname" id="lastname"
                                                        placeholder="Last name" data-validate="require">
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="field is-horizontal">
                                        <div class="field-label is-normal">
                                            <label class="label">Email</label>
                                        </div>
                                        <div class="field-body">
                                            <div class="field">
                                                <div class="control has-icon has-icon-right">
                                                    <input class="input" type="email" name="email" id="email"
                                                        placeholder="Email" data-validate="require">
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="step-content has-text-centered">
                                    <div class="field is-horizontal">
                                        <div class="field-label is-normal">
                                            <label class="label">Facebook account</label>
                                        </div>
                                        <div class="field-body">
                                            <div class="field">
                                                <div class="control">
                                                    <input class="input" name="facebook" id="facebook" type="text"
                                                        placeholder="Facebook account url" autofocus
                                                        data-validate="require">
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="field is-horizontal">
                                        <div class="field-label is-normal">
                                            <label class="label">Twitter account</label>
                                        </div>
                                        <div class="field-body">
                                            <div class="field">
                                                <div class="control">
                                                    <input class="input" name="twitter" id="twitter" type="text"
                                                        placeholder="Twitter account url" autofocus
                                                        data-validate="require">
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="step-content has-text-centered">
                                    <h1 class="title is-4">Your account is now created!</h1>
                                </div>
                            </div>
                            <div class="steps-actions">
                                <div class="steps-action">
                                    <a href="#" data-nav="previous" class="button is-light">Previous</a>
                                </div>
                                <div class="steps-action">
                                    <a href="#" data-nav="next" class="button is-light">Next</a>
                                </div>
                            </div>
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
