@extends('guest.layout.app')

@section('title')
<title>Complaint - NRWB system</title>
@endsection

@section('breadcrumb')
<li>Ticket</li>
<li>Complaint</li>
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
                        <span>Send Complaint</span>
                    </p>
                </header>
                <div class="card-content px-2 my-2 mx-10">
                    <div class="field is-horizontal">
                        <div class="field-body">
                            <div class="field ">
                                <div class="control">
                                    <article class="message is-primary">
                                        <div class="message-header">
                                            <p>Information</p>
                                            <button class="delete" aria-label="delete"></button>
                                        </div>
                                        <div class="message-body">
                                            You are about to send a complaint on the ticket that you recently reported. Please provide additional information if possible.
                                        </div>
                                    </article>

                                    <div class="card">
                                        <textarea class="input" style="height: 200px" type="text" placeholder="Please provide (optional) additional information." id='messageContent'></textarea>
                                    </div>
                                    <button class="button is-info" id='sendComplaint'>Send</button>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="column">
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
        $('#sendComplaint').click(function() {
            // $('#messageContent').prop('disabled', true);
            $('#sendComplaint').toggleClass('is-loading');

            let users_id = "{{ Auth::user()->id }}";
            let tickets_id = "{{ $ticket->id }}";
            let message = $('#messageContent').val();

            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });

            $.ajax({
                url: "{{ route('user.ticket.complaint.report') }}"
                , type: "POST"
                , data: {
                    users_id
                    , tickets_id
                    , message
                , }
                , dataType: 'json'
                , success: function(data) {
                    $('#messageContent').prop('disabled', false);
                    $('#messageContent').val('');

                    $('#sendComplaint').toggleClass('is-loading');

                    new swal("Done!"
                        , "Your complaint has been sent."
                        , "success").then(function() {
                        location.href = "{{ route('user.tickets.view', ['status'=> 'new']) }}";
                    });
                }
            });
        });
    });

</script>
@endsection
