@extends('admin.layout.app')

@section('title')
    <title>Accounts - Admin</title>
@endsection

@section('content')
    <!-- START ISSUES LIST-->
    <div class="column">

        <div class="column box">
            <nav class="navbar" role="navigation" aria-label="main navigation">
                <div class="navbar-start">
                    <h1 class="title is-size-3 has-text-info">Accounts</h1>
                </div>
                <div class="navbar-end">
                    <div class="tags has-addons">
                        <a href="{{ route('admin.accounts.create') }}"><button
                                class="button is-rounded is-info is-hovered">Create</button></a>
                    </div>
                </div>
            </nav>
        </div>

        <section class="section" style="padding: 1.5rem;margin-top:-25px;">
            <div class="columns is-multiline is-12">
                <div class="column is-2"></div>
                <div class="column box is-8">

                    <div class="tabs is-centered">
                        <ul>
                            <li class="is-active"><a>All</a></li>
                            <li><a>Administrators</a></li>
                            <li><a>IT Staff</a></li>
                        </ul>
                    </div>

                    <table class="table is-fullheight is-striped is-hoverable is-fullwidth">
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
    @endsection
