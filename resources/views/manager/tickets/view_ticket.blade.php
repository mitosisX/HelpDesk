@extends('manager.layout.app')

@section('title')
    <title>Tickets - Manager</title>
@endsection

@section('breadcrumb')
    <li>Manage</li>
    <li>Tickets</li>
@endsection

@section('content')
    {{-- <div class="toast active">

        <div class="toast-content">
            <i class="mdi mdi-check is-info"></i>

            <div class="message">
                <span class="text text-1">Success</span>
                <span class="text text-2">Your changes has been saved</span>
            </div>
        </div>
        <i class="fa-solid fa-xmark close"></i>

        <!-- Remove 'active' class, this is just to show in Codepen thumbnail -->
        <div class="progress active"></div>
    </div> --}}

    <section class="section is-main-section">
        <div class="columns">
            <div class="column is-2"></div>
            <div class="column is-8">
                <div class="card has-table has-mobile-sort-spaced">
                    <header class="card-header">
                        <p class="card-header-title">
                            <span class="icon"><i class="mdi mdi-account-multiple"></i></span>
                            <span>View Ticket</span>
                        </p>

                        <a class="card-header-icon" href={{ route('staff.tickets.view') }}>
                            <button class="button is-small is-rounded is-info" id='create_ticket_modal'>
                                <span class="icon">
                                    <i class="mdi mdi-home"></i>
                                </span>
                                <span class="menu-item-label">Back</span>
                            </button>
                        </a>

                    </header>
                    <div class="card-content px-2 my-2 mx-10">
                        <div class="column is-full mx-5">
                            <div class="columns is-mobile is-multiline">
                                <div class="column is-half pt-0">
                                    <label>Ticket Description</label>
                                    <div class="control">
                                        <input name="description" class="input" placeholder="Enter description"
                                            value="{{ $ticket->description }}" readonly>
                                    </div>
                                    @error('description')
                                        <p class="help is-success">{{ $message }}</p>
                                    @enderror
                                </div>
                                <div class="column is-half pt-0">
                                    <label>Category</label>
                                    <div>
                                        <div class="select">
                                            <select name="categories_id" readonly>
                                                <option value="{{ $category->id }}">
                                                    {{ $category->name }}
                                                </option>
                                            </select>
                                        </div>
                                    </div>
                                </div>

                                <div class="column is-half pt-0">
                                    <label>Assigned By</label>
                                    <div>
                                        <div class="select">
                                            <select name="reported_by" readonly>
                                                <option value="{{ $ticket->reporter->id }}">
                                                    {{ $ticket->assigner->name ?? 'NOT ASSIGNED' }}
                                                </option>
                                            </select>
                                        </div>
                                    </div>
                                </div>

                                <div class="column is-half pt-0">
                                    <label>Reported By</label>
                                    <div>
                                        <div class="select">
                                            <select name="reported_by" readonly>
                                                <option value="{{ $ticket->reporter->id }}">
                                                    {{ $ticket->reporter->name }}
                                                </option>
                                            </select>
                                        </div>
                                    </div>
                                </div>

                                <div class="column is-half pt-0">
                                    <label>Department</label>
                                    <div>
                                        <span
                                            class="tag is-info is-medium is-rounded">{{ $ticket->reporter->department['name'] }}</span>
                                    </div>
                                </div>
                                <div class="column is-half pt-0">
                                    <label>Priority</label>
                                    <div>
                                        <div class="select">
                                            <select name="priority" readonly>
                                                <option>{{ $ticket->priority }}</option>
                                            </select>
                                        </div>
                                    </div>
                                </div>
                                <div class="column is-half pt-0">
                                    <label>Due Date</label>
                                    <div>
                                        <input class="input bulmaCalendar" id="duedate" name="due_date" type="date"
                                            data-color="info" readonly>
                                    </div>
                                </div>

                                <div class="column is-half pt-0"></div>

                                <div class="column is-half pt-0">
                                    <label>Comment</label>
                                    <div>
                                        <div>
                                            <textarea name="comment" class="textarea" readonly>{{ $ticket->comment }}</textarea>
                                        </div>
                                    </div>
                                </div>

                                <div class="column is-half pt-0">
                                </div>

                                {{-- <div class="column is-half is-grouped">
                                    <div class="control">
                                        @if ($ticket->status === 'closed')
                                            <button class="button is-success">
                                                <span class="icon">
                                                    <i class="mdi mdi-check"></i>
                                                </span>
                                                <span>Closed</span>
                                            </button>
                                        @else
                                            <button class="button is-info" id='markDone'>
                                                <span class="icon">
                                                    <i class="mdi mdi-lead-pencil"></i>
                                                </span>
                                                <span>Mark as Done</span>
                                            </button>
                                        @endif
                                    </div>
                                </div> --}}
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
    <script>
        $(document).ready(function() {
            const calendar = bulmaCalendar.attach("#duedate");

            // To access to bulmaCalendar instance of an element
            const element = document.querySelector('#duedate');
            const duedate = '{{ $ticket->due_date }}';
            calendar[0].value(duedate);
        });

        var id = "{{ $ticket->id }}";

        var button;
        var tag = '#markDone';

        $(tag).click(() => {
            button = this;
            $('#markDone').toggleClass('is-loading');

            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });

            $.ajax({
                url: "{{ route('staff.ticket.manage.markdone') }}",
                type: "POST",
                data: {
                    id,
                },
                dataType: 'json',
                success: function(data) {
                    // alert(JSON.stringify(data));
                    $(tag).toggleClass('is-loading');
                    $(tag).toggleClass('is-success');

                    new swal("Done!",
                        "The ticket has been closed. Now awaiting confirmation from the user.",
                        "success");

                    $(tag).html(`<button class="button is-success">
                                                <span class="icon">
                                                    <i class="mdi mdi-check"></i>
                                                </span>
                                                <span>Closed</span>
                                            </button>`);
                    $(tag).unbind();
                }
            });
        });
    </script>
@endsection
