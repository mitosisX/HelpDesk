@extends('authentication.layout.app')

@section('title')
    <title>Login</title>
@endsection

@section('content')
    <div class="grid">
        <form action="{{ route('manager.auth.login_account') }}" method="POST" class="form login">
            @csrf
            <header class="login__header">
                <h3 class="login__title">Login</h3>
            </header>

            <div class="login__body">
                <div class="form__field">
                    <input name="email" type="email" placeholder="Email" required>
                </div>

                <div class="form__field">
                    <input name="password" type="password" placeholder="Password" required>
                </div>
            </div>

            <footer class="login__footer">
                <input type="submit" value="Login">

                <p><a href="{{ route('manager.auth.register') }}">Register account</a>
                </p>
            </footer>
        </form>
    </div>
@endsection
