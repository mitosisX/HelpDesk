@extends('authentication.layout.app')

@section('title')
    <title>Register Account</title>
@endsection

@section('content')
    <div class="grid">
        <form action="{{ route('admin.auth.register_account') }}" method="POST" class="form login">
            @csrf
            <header class="login__header">
                <h3 class="login__title">Register</h3>
            </header>

            <div class="login__body">
                <div class="form__field">
                    <input name="email" type="email" placeholder="Email" value="{{ old('email') }}">
                </div>

                <div class="form__field">
                    <input name="password" type="password" placeholder="Password">
                </div>

                <div class="form__field">
                    <input name="confirm_pass" type="password" placeholder="Confirm Password">
                </div>
            </div>

            <footer class="login__footer">
                <input type="submit" value="Register">

                <p><a href="{{ route('admin.auth.login') }}">Login instead</a>
            </footer>
        </form>
    </div>
@endsection
