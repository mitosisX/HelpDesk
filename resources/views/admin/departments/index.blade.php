@extends('admin.layout.app')

@section('title')
    <title>Departments - Admin</title>
@endsection

@section('breadcrumb')
    <li>Manage</li>
    <li>Departments</li>
@endsection

@section('content')
    <section class="section is-main-section">
        <div class="columns">
            <div class="column is-2"></div>
            <div class="column is-6">
                <div class="tile is-ancestor">
                    <div class="tile is-parent">
                        <div class="card tile is-child">
                            <header class="card-header">
                                <p class="card-header-title">
                                    <span class="icon"><i class="mdi mdi-account-circle default"></i></span>
                                    Departments
                                </p>
                                <a class="card-header-icon" id='create_ticket_modal'>
                                    <button class="button is-small is-info is-rounded">
                                        <span class="icon"><i class="mdi mdi-plus"></i></span>
                                        <span>Create</span>
                                    </button>

                                </a>
                            </header>
                            <div class="card-content">
                                <table class="table is-fullwidth is-striped is-hoverable is-fullwidth">
                                    <thead>
                                        <tr>
                                            <th>#</th>
                                            <th>Name</th>
                                            <th>Action</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($departments as $department)
                                            <td>{{ $loop->index + 1 }}</td>
                                            <td>{{ $department->name }}</td>
                                            <td>
                                                <div class="field has-addons">
                                                    <p class="control">
                                                        <a href="{{ route('admin.departments.edit', $department->id) }}">
                                                            <button class="button is-rounded is-small is-info">
                                                                <span class="icon is-small">
                                                                    <i class="mdi mdi-pencil-outline"></i>
                                                                </span>
                                                                <span>Edit</span>
                                                            </button>
                                                        </a>
                                                    </p>
                                                    <p class="control">
                                                        <button class="button is-rounded is-small is-danger" id="remove"
                                                            data-id="{{ $department->id }}"
                                                            data-action="{{ route('admin.departments.destroy', $department->id) }}">
                                                            <span class="icon is-small">
                                                                <i class="mdi mdi-trash-can-outline"></i>
                                                            </span>
                                                        </button>
                                                    </p>
                                                </div>
                                            </td>
                                            </tr>
                                        @endforeach
                                        <tr>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="column is-2"></div>
        </div>
    </section>

    <div id="create_modal" class="modal">
        <div class="modal-background"></div>
        <div class="modal-card">
            <header class="modal-card-head">
                <p class="modal-card-title">Create Department</p>
                <button class="delete" aria-label="close"></button>
            </header>
            <section class="modal-card-body">
                <form action="{{ route('admin.departments.store') }}" method="POST">
                    @csrf
                    <div class="field">
                        <label class="label">Provide name</label>
                        <div class="control has-icons-left has-icons-right">
                            <input class="input" id='department_name' name="name" type="text"
                                placeholder="Department's name" value="{{ old('name') }}" required>
                            <span class="icon is-left">
                                <i class="mdi mdi-rename-box"></i>
                            </span>
                        </div>
                        @error('name')
                            <p class="help has-text-info">{{ $message }}</p>
                        @enderror
                    </div>
            </section>
            <footer class="modal-card-foot">
                <input type="submit" class="button is-info" value="Create" />
            </footer>
            </form>
        </div>
    </div>
@endsection

@section('scripts')
    <script>
        $(document).ready(function() {
            $('#create_ticket_modal').on('click', function() {
                Bulma('#create_modal').modal().open();
            })
        });

        $(document).on("click", "#remove", function() {
            var current_object = $(this);
            // swal({
            //     title: "",
            //     text: "",
            //     type: "error",
            //     showCancelButton: true,
            //     dangerMode: true,
            //     cancelButtonClass: '#DD6B55',
            //     confirmButtonColor: '#dc3545',
            //     confirmButtonText: 'Delete!',
            // });
            Swal.fire({
                title: "Are you sure?",
                text: "You will not be able to recover this imaginary file!",
                type: "error",
                showCancelButton: true,
                dangerMode: true,
                cancelButtonClass: '#DD6B55',
                confirmButtonColor: '#dc3545',
                confirmButtonText: 'Delete!',
                allowOutsideClick: () => !Swal.isLoading()
            }).then((result) => {
                if (result.isConfirmed) {
                    var action = current_object.attr('data-action');
                    var token = jQuery('meta[name="csrf-token"]').attr('content');
                    var id = current_object.attr('data-id');

                    $('body').html(
                        `<form class='form-inline remove-form' method='POST' action='${action}'>
                        @csrf
                        
                        <input name="id" type="hidden" value="${id}"/>
                        </form>`);
                    // $('body').find('.remove-form').append(
                    //     '<input name="_method" type="hidden" value="delete">');
                    // $('body').find('.remove-form').append('<input name="_token" type="hidden" value="' +
                    //     token + '">');
                    // $('body').find('.remove-form').append('<input name="id" type="hidden" value="' + id +
                    //     '">');
                    $('body').find('.remove-form').submit();
                }
            })
        });

        //     result = Swal.fire({
        //         title: 'Are you sure?',
        //         text: 'You will not be able to recover this imaginary file!',
        //         icon: 'question',
        //         iconHtml: '?',
        //         showCancelButton: true,
        //         confirmButtonColor: '#dc3545',
        //         confirmButtonText: 'Delete!',
        //     });

        //     if (result) {
        //         var action = current_object.attr('data-action');
        //         var token = jQuery('meta[name="csrf-token"]').attr('content');
        //         var id = current_object.attr('data-id');

        //         $('body').html("<form class='form-inline remove-form' method='post' action='" + action +
        //             "'></form>");
        //         $('body').find('.remove-form').append(
        //             '<input name="_method" type="hidden" value="delete">');
        //         $('body').find('.remove-form').append('<input name="_token" type="hidden" value="' +
        //             token + '">');
        //         $('body').find('.remove-form').append('<input name="id" type="hidden" value="' + id +
        //             '">');
        //         $('body').find('.remove-form').submit();
        //     }
        // });
    </script>
@endsection
