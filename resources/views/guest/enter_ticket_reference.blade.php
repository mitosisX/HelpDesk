@extends('guest.layout.app')

@section('title')
    <title>Reference Number - Help Desk</title>
@endsection

@section('content')
    <div class="columns my-2">
        <div class="column is-3"></div>
        <div class="column box">
            <form action="{{ route('user.reference.track') }}" method="POST">
                @csrf
                <div class="field">
                    <label class="label">Enter Tracking Number</label>
                    <div class="control">
                        <div class="column is-6 no-padding">
                            <input class="input is-rounded" name="reference_code" type="text"
                                placeholder="Reference code...">
                        </div>
                    </div>
                </div>

                <div class="field is-grouped">
                    <div class="control">
                        <input type="submit" class="button is-info is-rounded" id="submit" value="Track" />
                    </div>
                </div>
            </form>
        </div>
        <div class="column is-3"></div>
    </div>
@endsection
