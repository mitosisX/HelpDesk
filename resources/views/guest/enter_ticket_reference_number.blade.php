@extends('guest.layout.app')

@section('title')
    <title>Reference Number - Help Desk</title>
@endsection

@section('content')
    <div class="columns my-2">
        <div class="column is-3"></div>
        <div class="column box">
            <form action="">
                <div class="field">
                    <label class="label">Enter Tracking Number</label>
                    <div class="control">
                        <div class="column is-6 no-padding">
                            <input class="input is-rounded" type="text" placeholder="What's wrong">
                        </div>
                    </div>
                </div>

                <div class="field is-grouped">
                    <div class="control">
                        <button class="button is-info is-rounded" id="submit">Track</button>
                    </div>
                </div>
            </form>
        </div>
        <div class="column is-3"></div>
    </div>
@endsection
