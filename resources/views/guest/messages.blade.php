@extends('guest.layout.app')

@section('title')
<title>Messages - NRWB system</title>
@endsection

@section('breadcrumb')
<li>Ticket</li>
<li>Messages</li>
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
                        <span>Conversation</span>
                    </p>
                </header>
                <div class="card-content px-2 my-2 mx-10">
                    <div class="field is-horizontal">
                        <div class="field-body">
                            <div class="field ">
                                <div class="control">
                                    <div class="card box">
                                        <section class="discussion">
                                            @forelse ($messages as $message)
                                            @if ($message->users_id === Auth::user()->id)
                                            <div class="bubble recipient first">{{ $message->message }}</div>
                                            @else
                                            <div class="bubble sender first">{{ $message->message }}</div>
                                            @endif
                                            @empty
                                            <div class="field is-horizontal">
                                                <div class="field-body">
                                                    <div class="field ">
                                                        <div class="control">
                                                            <div class="card box">
                                                                <div class="card-content">
                                                                    <h1 class="title is-4 is-centered">No messages available</h1>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            @endforelse
                                        </section>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="column">
                        <div class="field has-addons">
                            <input class="input is-rounded" type="text" placeholder="Message" id='messageContent'>
                            <button class="button is-rounded is-info" id='sendMessage'>Send</button>
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
        $('#sendMessage').click(function() {
            // $('#messageContent').prop('disabled', true);
            $('#sendMessage').toggleClass('is-loading');

            let users_id = "{{ Auth::user()->id }}";
            let tickets_id = "{{ $ticket->id }}";
            let message = $('#messageContent').val();

            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });

            $.ajax({
                url: "{{ route('user.ticket.message.send') }}"
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

                    $('#sendMessage').toggleClass('is-loading');

                    // alert(JSON.stringify(data))
                    $('.discussion div:last')
                        .after(`<div class="bubble recipient first">${message}</div>`);
                }
            });
        });
    });

</script>
@endsection
