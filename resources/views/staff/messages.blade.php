@extends('staff.layout.app')

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
                <div class="page my-3">
                    <div class="marvel-device">
                        <div class="screen">
                            <div class="screen-container">
                                <div class="chat">
                                    <div class="chat-container">
                                        <div class="user-bar">
                                            <div class="avatar">
                                                <span class="mdi mdi-account-supervisor-circle "></span>
                                            </div>
                                            <div class="name">
                                                <span>Reporter: {{ $ticket->reporter['name'] }}</span>
                                            </div>
                                        </div>
                                        <div class="conversation">
                                            <div class="conversation-container">
                                                @forelse ($messages as $message)
                                                @if ($message->users_id === Auth::user()->id)
                                                <div class="msg sent">{{ $message->message }}</div>
                                                @else
                                                <div class="msg received">{{ $message->message }}</div>
                                                @endif
                                                @empty
                                                {{-- <div class="field is-horizontal">
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
                                                </div> --}}
                                                @endforelse

                                                {{-- <div class="message received" style="visibility: hidden">
                                                    <span id="random">You were hugging an old man with a beard screaming "DUMBLEDORE YOU'RE ALIVE!"</span>
                                                    <span class="metadata"><span class="time"></span></span>
                                                </div> --}}
                                            </div>
                                            <div class="conversation-compose">
                                                <div class="emoji">
                                                </div>
                                                <textarea class="input-msg" id="messageContent" placeholder="Type a message" autocomplete="off" autofocus></textarea>
                                                <div class="photo">

                                                </div>
                                                <button class="send">
                                                    <div class="circle is-loading">
                                                        <i class="mdi mdi-send" id='sendMessage'></i>
                                                    </div>
                                                </button>
                                            </div>
                                        </div>
                                    </div>
                                </div>
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
                url: "{{ route('staff.ticket.message.send') }}"
                , type: "POST"
                , data: {
                    users_id
                    , tickets_id
                    , message
                , }
                , dataType: 'json'
                , error: function(data) {
                    alert(JSON.stringify(data))
                }
                , success: function(data) {
                    $('#messageContent').prop('disabled', false);
                    $('#messageContent').val('');

                    $('#sendMessage').toggleClass('is-loading');

                    // alert(JSON.stringify(data))
                    $('.conversation-container div:last')
                        .after(`<div class="msg sent">${message}</div>`);
                }
            });
        });
    });

</script>
@endsection
