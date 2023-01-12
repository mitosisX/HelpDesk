@extends('admin.layout.app')

@section('title')
    <title>Accounts - Admin</title>
@endsection

@section('breadcrumb')
    <li>Manage</li>
    <li>Tickets</li>
@endsection

@section('content')
    <!-- START ISSUES LIST-->
    <div class="column">
        <div class="column">
        </div>

        <section class="section" style="padding: 1.5rem;margin-top:-25px;">
            <div class="columns is-multiline is-12">
                <div class="column is-2"></div>
                <div class="column box is-8">
                    <div class="tabs is-centered">
                        <ul>
                            <li @class(['is-active' => session('account-type') === 'admins'])><a
                                    href="{{ route('admin.accounts.view', ['type' => 'admin']) }}">Administrators</a></li>
                            <li @class(['is-active' => session('account-type') === 'staff'])><a
                                    href="{{ route('admin.accounts.view', ['type' => 'staff']) }}">IT Staff</a></li>
                            <li @class(['is-active' => session('account-type') === 'users'])><a
                                    href="{{ route('admin.accounts.view', ['type' => 'user']) }}">User</a></li>
                        </ul>
                        <button class="button is-small is-rounded is-info" id="create_account_modal">
                            <span class="icon">
                                <i class="mdi mdi-plus"></i>
                            </span>
                            <span class="menu-item-label">Create</span>
                        </button>
                    </div>

                    <table class="table is-fullheight is-striped is-hoverable is-fullwidth" id='accounts_table'>
                        <thead>
                            <tr>
                                <th>#</th>
                                <th>Name</th>
                                <th>Email</th>
                                <th>Role</th>
                                <th>Actions</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($users as $user)
                                <tr>
                                    <td>{{ $loop->index + 1 }}</td>
                                    <td>{{ $user->name }}</td>
                                    <td>{{ $user->email }}</td>
                                    <td>{{ $user->role['name'] }}</td>
                                    <td>
                                        <div>
                                            <button class="button is-rounded is-small is-primary" type="button">
                                                <span class="icon">
                                                    <i class="mdi mdi-account-wrench-outline"></i>
                                                </span>
                                            </button>
                                            <button class="button is-rounded is-small is-danger jb-modal"
                                                data-target="sample-modal" type="button">
                                                <span class="icon">
                                                    <i class="mdi mdi-trash-can-outline"></i>
                                                </span>
                                            </button>
                                        </div>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
                <div class="column is-2"></div>
            </div>
        </section>
        <!-- END ISSUES LIST -->
    </div>

    @if (session('account-type') === 'admins')
        <div id="create_modal" class="modal">
            <div class="modal-background"></div>
            <div class="modal-card">
                <header class="modal-card-head">
                    <p class="modal-card-title">
                        <span class="icon"><i class="mdi mdi-account-multiple"></i></span>
                        <span>Admin Account</span>
                    </p>
                    <button class="delete" aria-label="close"></button>
                </header>
            </div>
        @elseif (session('account-type') === 'staff')
            <div id="create_modal" class="modal">
                <div class="modal-background"></div>
                <div class="modal-card">
                    <header class="modal-card-head">
                        <p class="modal-card-title">
                            <span class="icon"><i class="mdi mdi-account-multiple"></i></span>
                            <span>Staff Account</span>
                        </p>
                        <button class="delete" aria-label="close"></button>
                    </header>
                    <section class="modal-card-body">
                        <div class="column">
                            <form action="{{ route('account.user.store') }}" method='POST'>
                                @csrf
                                <div class="columns is-mobile is-multiline">
                                    <div class="column is-half pt-0">
                                        <label>Name</label>
                                        <div class="control">
                                            <input name="name" class="input" placeholder="Provide name" required>
                                            <input name="role" class="input" value="staff" style="display: none;">
                                        </div>
                                    </div>
                                    <div class="column is-half pt-0">
                                        <label>Email</label>
                                        <div>
                                            <input type="email" name="email" class="input" placeholder="Provide Email"
                                                required>
                                        </div>
                                    </div>

                                    <div class="column is-half pt-0">
                                        <label>Password</label>
                                        <div>
                                            <input class="input" value="12345" readonly>
                                        </div>
                                    </div>
                                </div>
                        </div>
                    </section>
                    <footer class="modal-card-foot">
                        <input type="submit" class="button is-info" value="Create" />
                    </footer>
                    </form>
                </div>
            </div>
        </div>
    @elseif(session('account-type') === 'users')
        <div id="create_modal" class="modal">
            <div class="modal-background"></div>
            <div class="modal-card">
                <header class="modal-card-head">
                    <p class="modal-card-title">
                        <span class="icon"><i class="mdi mdi-account-multiple"></i></span>
                        <span>User Account</span>
                    </p>
                    <button class="delete" aria-label="close"></button>
                </header>
                <section class="modal-card-body">
                    <div class="column">
                        <form action="{{ route('account.user.store') }}" method='POST'>
                            @csrf
                            <div class="columns is-mobile is-multiline">
                                <div class="column is-half pt-0">
                                    <label>Name</label>
                                    <div class="control">
                                        <input name="name" class="input" placeholder="Provide name" required>
                                        <input name="role" class="input" value="user" style="display: none;">
                                    </div>
                                </div>
                                <div class="column is-half pt-0">
                                    <label>Departments</label>
                                    <div>
                                        <div class="select">
                                            <select name="departments_id">
                                                @foreach ($departments as $department)
                                                    <option value="{{ $department->id }}">{{ $department->name }}
                                                    </option>
                                                @endforeach
                                            </select>
                                        </div>
                                    </div>
                                </div>

                                <div class="column is-half pt-0">
                                    <label>Location</label>
                                    <div>
                                        <input name="location" class="input" placeholder="Provide location" required>
                                    </div>
                                </div>
                                <div class="column is-half pt-0">
                                    <label>Email</label>
                                    <div>
                                        <input type="email" name="email" class="input" placeholder="Provide Email"
                                            required>
                                    </div>
                                </div>
                                <div class="column is-half pt-0">
                                    <label>Password</label>
                                    <div>
                                        <input type="text" class="input" value="12345" readonly>
                                    </div>
                                </div>
                            </div>
                    </div>
                </section>
                <footer class="modal-card-foot">
                    <input type="submit" class="button is-info" value="Create" />
                </footer>
                </form>
            </div>
        </div>
    @endif
@endsection

@section('scripts')
    <script>
        $(document).ready(function() {
            $('#create_account_modal').on('click', function() {
                Bulma('#create_modal').modal().open();
            });

            $("#accounts_table").DataTable();
        });
    </script>
@endsection
