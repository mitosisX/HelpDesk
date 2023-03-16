@extends('manager.layout.app')

@section('title')
<title>Tickets - Manager</title>
@endsection

@section('breadcrumb')
<li>Manage</li>
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
                                    <input name="description" class="input" placeholder="Enter description" value="{{ $ticket->description }}" readonly>
                                </div>
                                @error('description')
                                <p class="help is-success">{{ $message }}</p>
                                @enderror
                            </div>

                            <div class="column is-half pt-0 input-resize">
                                <label>Category</label>
                                <div class="control">
                                    <input class="input" value="{{ $category->name }}" readonly>
                                </div>
                            </div>

                            <div class="column is-half pt-0">
                                <label>Assigned By</label>
                                <div class="control">
                                    <input class="input" value="{{ $ticket->assigner->name }}" readonly>
                                </div>
                            </div>

                            <div class="column is-half pt-0 input-resize">
                                <label>Reported By</label>
                                <div class="control">
                                    <input class="input" value="{{ $ticket->reporter->name }}" readonly>
                                </div>
                            </div>

                            <div class="column is-half pt-0">
                                <div class="columns">
                                    <div class="column is-6">
                                        <label>Department</label>
                                        <div>
                                            <span class="tag is-info is-medium is-size-7">{{ $ticket->reporter->department['name'] }}</span>
                                        </div>
                                    </div>
                                    <div class="column is-6">
                                        <label>Location</label>
                                        <div>
                                            <span class="tag is-info is-size-7">{{ $ticket->reporter->location }}</span>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div class="column is-half pt-0 input-resize2">
                                <label>Priority</label>
                                <div class="control">
                                    <input class="input" value="{{ $ticket->priority }}" readonly>
                                </div>
                            </div>

                            <div class="column is-half pt-0">
                                <label>Due Date</label>
                                <div>
                                    <input class="input bulmaCalendar" id="duedate" name="due_date" type="date" data-color="info" readonly>
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
            url: "{{ route('staff.ticket.manage.markdone') }}"
            , type: "POST"
            , data: {
                id
            , }
            , dataType: 'json'
            , success: function(data) {
                // alert(JSON.stringify(data));
                $(tag).toggleClass('is-loading');
                $(tag).toggleClass('is-success');

                new swal("Done!"
                    , "The ticket has been closed. Now awaiting confirmation from the user."
                    , "success");

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
