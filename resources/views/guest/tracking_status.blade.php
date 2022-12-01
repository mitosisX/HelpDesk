@extends('guest.layout.app')

@section('title')
    <title>Reference Number - Help Desk</title>
@endsection

@section('content')
    <div class="columns my-2">
        <div class="column is-3"></div>
        <div class="column box">
            <div class="tags has-addons">
                <span class="tag is-size-6 is-rounded is-rounded">Reference</span>
                <span class="tag is-info is-size-6 is-rounded">{{ $ticket->tracker['reference_code'] }}</span>
            </div>

            <div class="block">
                <p class="title">Status</p>
                @if ($ticket->status == 'new')
                    <p class="subtitle">Awaiting to be attented to</p>
                @elseif ($ticket->status == 'open')
                    <p class="subtitle">Ticker has been assigned to the IT team</p>
                @elseif ($ticket->status == 'closed')
                    <p class="subtitle">Issue was resolved and ticket has been closed</p>
                @endif
            </div>
        </div>
        <div class="column is-3"></div>
    </div>
@endsection
