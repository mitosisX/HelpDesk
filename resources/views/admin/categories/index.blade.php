@extends('admin.layout.app')

@section('title')
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>Categories - Admin</title>
@endsection

@section('breadcrumb')
    <li>Manage</li>
    <li>Categories</li>
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
                                    Categories
                                </p>
                                <a class="card-header-icon" id='create_ticket_modal'>
                                    <button class="button is-small is-info is-rounded">
                                        <span class="icon"><i class="mdi mdi-plus"></i></span>
                                        <span>Create</span>
                                    </button>

                                </a>
                            </header>
                            <div class="card-content">
                                <table class="table is-fullwidth is-striped is-hoverable is-fullwidth"
                                    id='departments_table'>
                                    <thead>
                                        <tr>
                                            {{-- <th>#</th> --}}
                                            <th>Name</th>
                                            <th>Action</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($categories as $category)
                                            <tr>
                                                {{-- <td>{{ $loop->index + 1 }}</td> --}}
                                                <td id='td_dept_name'>{{ $category->name }}</td>
                                                <td>
                                                    <div class="field has-addons">
                                                        <p class="control">
                                                            {{-- <a href="{{ route('admin.departments.edit', $category->id) }}"> --}}
                                                            <button class="button is-rounded is-small is-info"
                                                                id='edit' data-id="{{ $category->id }}"
                                                                data-full_name="{{ $category->name }}">
                                                                <span class="icon is-small">
                                                                    <i class="mdi mdi-pencil-outline"></i>
                                                                </span>
                                                                <span>Edit</span>
                                                            </button>
                                                            {{-- </a> --}}
                                                        </p>
                                                        <p class="control">
                                                            <button class="button is-rounded is-small is-danger"
                                                                id="remove" data-id="{{ $category->id }}"
                                                                data-action="{{ route('admin.departments.destroy', $category->id) }}">
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
                <p class="modal-card-title">Create Category</p>
                <button class="delete" aria-label="close"></button>
            </header>
            <section class="modal-card-body">
                <div class="field">
                    <label class="label">Provide name</label>
                    <div class="control has-icons-left has-icons-right">
                        <input class="input" id='category_name' name="name" type="text" placeholder="Category's name"
                            required>
                        <span class="icon is-left">
                            <i class="mdi mdi-rename-box"></i>
                        </span>
                    </div>
                </div>
            </section>
            <footer class="modal-card-foot">
                <button id='create_department_button' class="button is-info">Create</button>
            </footer>
        </div>
    </div>


    <div id="edit_modal" class="modal">
        <div class="modal-background"></div>
        <div class="modal-card">
            <header class="modal-card-head">
                <p class="modal-card-title">Edit Department</p>
                <button class="delete" aria-label="close"></button>
            </header>
            <section class="modal-card-body">
                <div class="field">
                    <label class="label">Provide name</label>
                    <div class="control has-icons-left has-icons-right">
                        <input class="input" id='dept_edit_name' name="name" type="text"
                            placeholder="Department's name" value="{{ old('name') }}" required>
                        <span class="icon is-left">
                            <i class="mdi mdi-rename-box"></i>
                        </span>
                    </div>
                </div>
            </section>
            <footer class="modal-card-foot">
                <button id='update_department_button' class="button is-info">Update</button>
            </footer>
        </div>
    </div>
@endsection

@section('scripts')
    <script>
        //The ID to be used in editing the department
        var id = 0;

        //Previously clicked <td> data, we'll use this to avoid reload
        var tdElement = null;

        $(document).ready(function() {
            $('#create_ticket_modal').on('click', function() {
                Bulma('#create_modal').modal().open();
            });

            $('#create_department_button').click(function() {
                $('#create_department_button').toggleClass('is-loading');

                $.ajaxSetup({
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    }
                });

                var newDeptName = $('#category_name').val();

                $.ajax({
                    url: "{{ route('admin.departments.store.json') }}",
                    type: "POST",
                    data: {
                        name: newDeptName,
                    },
                    dataType: 'json',
                    success: function(data) {
                        $('#create_department_button').toggleClass('is-loading');
                        $('#create_department_button').attr('disabled', false);


                        // window.location.reload(true);
                        Bulma('#create_modal').modal().close();

                        appendToTable(data.id, newDeptName);
                    }
                });
            });
        });




        $('#update_department_button').click(() => {
            //The <td> to edit
            var valueToEdit = tdElement.closest('tr').children('td:nth-child(1)'); //.text();

            //The new edit value
            var editValue = $('#dept_edit_name').val();

            $('#update_department_button').toggleClass('is-loading');
            $('#update_department_button').attr('disabled', true);

            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });

            $.ajax({
                url: `{{ route('admin.department.update.json') }}` + `/${id}`,
                type: "POST",
                data: {
                    name: editValue,
                },
                dataType: 'json',
                success: function(data) {
                    $('#update_department_button').toggleClass('is-loading');
                    $('#update_department_button').attr('disabled', false);

                    valueToEdit.text(editValue)
                    Bulma('#edit_modal').modal().close();
                    // window.location.reload(true);
                }
            });
        });

        $(document).on("click", "#edit", function() {
            tdElement = $(this);

            // event.preventDefault();
            id = tdElement.data('id');
            var modal = $('#edit_modal');

            var dept = tdElement.data('full_name');

            $('#dept_edit_name').val(tdElement.closest('tr').children('td:nth-child(1)').text());

            Bulma('#edit_modal').modal().open();
        });



        $(document).on("click", "#remove", function() {
            tdElement = $(this);
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
                text: "You will not be able to recover this particular item!",
                type: "error",
                showCancelButton: true,
                dangerMode: true,
                cancelButtonClass: '#DD6B55',
                confirmButtonColor: '#dc3545',
                confirmButtonText: 'Delete!',
                allowOutsideClick: () => !Swal.isLoading()
            }).then((result) => {
                if (result.isConfirmed) {

                    $.ajaxSetup({
                        headers: {
                            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                        }
                    });

                    var action = tdElement.attr('data-action');
                    var token = jQuery('meta[name="csrf-token"]').attr('content');
                    var del_id = tdElement.attr('data-id');

                    $.ajax({
                        url: `{{ route('admin.department.destroy.json') }}` + `/${del_id}`,
                        type: "DELETE",
                        // data: {
                        //     name: editValue,
                        // },
                        dataType: 'json',
                        success: function(data) {
                            tdElement.parent().parent().parent().parent().remove();
                        }
                    });
                }
            })
        });

        //This re-numbers the # section of the table upon each creation 
        function reNumber() {
            var reCounter = 1;
            $('#departments_table > tbody  > tr').each(function(index, tr) {
                $(tr).children('td:nth-child(1)').text(reCounter);
                console.log(reCounter)
                reCounter += 1;
            });
        }

        function appendToTable(id, text) {
            $('#departments_table tr:last')
                .after(`<tr>
                            <td id='td_dept_name'>${text}</td>
                            <td>
                                <div class="field has-addons">
                                    <p class="control">
                                        <button class="button is-rounded is-small is-info"
                                            id='edit' data-id="${id}"
                                            data-full_name="${text}">
                                            <span class="icon is-small">
                                                <i class="mdi mdi-pencil-outline"></i>
                                            </span>
                                            <span>Edit</span>
                                        </button>
                                    </p>
                                    <p class="control">
                                        <button class="button is-rounded is-small is-danger"
                                            id="remove" data-id="${id}"
                                            data-action="{{ route('admin.department.destroy.json') }} + '/${id}'">
                                            <span class="icon is-small">
                                                <i class="mdi mdi-trash-can-outline"></i>
                                            </span>
                                        </button>
                                    </p>
                                </div>
                            </td>
                        </tr>`);
        }
    </script>
@endsection
