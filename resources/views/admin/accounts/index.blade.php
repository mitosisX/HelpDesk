@extends('admin.layout.app')
@section('title')
    <title>Accounts - Admin</title>
@endsection

@section('breadcrumb')
    <li>Manage</li>
    <li>Accounts</li>
@endsection

@section('content')
    <section class="section is-main-section">

        <div class="columns">
            <div class="column is-1"></div>

            <div class="column is-10">
                <div class="card has-table has-mobile-sort-spaced">
                    <header class="card-header">
                        <p class="card-header-title">
                            <span class="icon"><i class="mdi mdi-account-multiple"></i></span>
                            <span>Accounts</span>
                        </p>

                        <a class="card-header-icon" id='create_account_modal'>
                            <button class="button is-small is-rounded is-info">
                                <span class="icon">
                                    <i class="mdi mdi-plus"></i>
                                </span>
                                <span class="menu-item-label">Create</span>
                            </button>
                        </a>
                    </header>
                    <div class="card-content px-2 my-2">
                        <div class="b-table has-pagination">
                            <div class="column is-full">
                                <div class="tabs is-centered">
                                    <ul>
                                        {{-- <li @class([
                                'is-active',
                                'font-bold' => $request->session()->get('for-all'),
                            ])><a
                                    href="{{ route('admin.accounts.view', ['type' => 'all']) }}">All</a>
                            </li> --}}
                                        <li @class(['is-active' => session('for-admins')])><a
                                                href="{{ route('admin.accounts.view', ['type' => 'admin']) }}">Administrators</a>
                                        </li>
                                        <li @class(['is-active' => session('for-staff')])><a
                                                href="{{ route('admin.accounts.view', ['type' => 'staff']) }}">IT
                                                Staff</a></li>
                                        <li @class(['is-active' => session('for-users')])><a
                                                href="{{ route('admin.accounts.view', ['type' => 'user']) }}">User</a>
                                        </li>
                                    </ul>
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
                                                        <button class="button is-rounded is-small is-primary"
                                                            type="button">
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
                        </div>
                    </div>
                </div>

            </div>

            <div class="column is-1"></div>
        </div>
    </section>
    @if (session('for-admins'))
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
                <section class="modal-card-body">
                    <form action="{{ route('admin.departments.store') }}" method="POST">
                        @csrf
                        <div class="column">
                            <form action="{{ route('admin.tickets.store') }}" method='POST'>
                                @csrf
                                <div class="columns is-mobile is-multiline">
                                    <div class="column is-half pt-0">
                                        <label>Ticket Description</label>
                                        <div class="control">
                                            <input name="fname" class="input" placeholder="Enter description" required>
                                        </div>
                                        @error('name')
                                            <p class="help is-success">{{ $message }}</p>
                                        @enderror
                                    </div>
                                    <div class="column is-half pt-0">
                                        <label>Categories</label>
                                        <div>
                                            <div class="select">
                                                <select name="categories_id">
                                                    <option value="s">sdsd</option>
                                                </select>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="column is-half pt-0">
                                        <label>Reported By</label>
                                        <div>
                                            <div class="select">
                                                <select name="categories_id">
                                                    <option value="s">sdsd</option>
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
                                        @error('priority')
                                            <p class="help is-success">{{ $message }}</p>
                                        @enderror
                                    </div>
                                    <div class="column is-half pt-0">
                                        <label>Due Date</label>
                                        <div>
                                            <input type="date" id="duedate" value="{{ old('due_date') }}"
                                                name="due_date" data-close-on-select="false">
                                        </div>
                                        <p class="help is-link" id="datediff">-- days</p>
                                    </div>
                                    <div class="column is-half pt-0">
                                        <label>Assign To</label>
                                        <div>
                                            <div class="select">
                                                <select name="assigned_to">
                                                    <option value="s">sdsd</option>
                                                </select>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </form>
                        </div>
                </section>
                <footer class="modal-card-foot">
                    <input type="submit" class="button is-info" value="Create" />
                </footer>
                </form>
            </div>
        </div>
    @elseif (session('for-staff'))
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
                    <form action="{{ route('admin.departments.store') }}" method="POST">
                        @csrf
                        <div class="column">
                            <form action="{{ route('admin.tickets.store') }}" method='POST'>
                                @csrf
                                <div class="columns is-mobile is-multiline">
                                    <div class="column is-half pt-0">
                                        <label>Ticket Description</label>
                                        <div class="control">
                                            <input name="fname" class="input" placeholder="Enter description"
                                                required>
                                        </div>
                                        @error('name')
                                            <p class="help is-success">{{ $message }}</p>
                                        @enderror
                                    </div>
                                    <div class="column is-half pt-0">
                                        <label>Categories</label>
                                        <div>
                                            <div class="select">
                                                <select name="categories_id">
                                                    <option value="s">sdsd</option>
                                                </select>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="column is-half pt-0">
                                        <label>Reported By</label>
                                        <div>
                                            <div class="select">
                                                <select name="categories_id">
                                                    <option value="s">sdsd</option>
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
                                        @error('priority')
                                            <p class="help is-success">{{ $message }}</p>
                                        @enderror
                                    </div>
                                    <div class="column is-half pt-0">
                                        <label>Due Date</label>
                                        <div>
                                            <input type="date" id="duedate" value="{{ old('due_date') }}"
                                                name="due_date" data-close-on-select="false">
                                        </div>
                                        <p class="help is-link" id="datediff">-- days</p>
                                    </div>
                                    <div class="column is-half pt-0">
                                        <label>Assign To</label>
                                        <div>
                                            <div class="select">
                                                <select name="assigned_to">
                                                    <option value="s">sdsd</option>
                                                </select>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </form>
                        </div>
                </section>
                <footer class="modal-card-foot">
                    <input type="submit" class="button is-info" value="Create" />
                </footer>
                </form>
            </div>
        </div>
    @elseif(session('for-users'))
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
                        <form action="{{ route('account.user.create') }}" method='POST'>
                            @csrf
                            <div class="columns is-mobile is-multiline">
                                <div class="column is-half pt-0">
                                    <label>Name</label>
                                    <div class="control">
                                        <input name="name" class="input" placeholder="Provide name" required>
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
                                        <input type="email" name="email" class="input" placeholder="Provide name"
                                            required>
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
