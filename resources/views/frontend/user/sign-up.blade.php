@extends('frontend.layout.main')
@section('title', 'Office Tech - Sign Up')
@section('main.container')
    <main>
        <div class="breadcrumbs">
            <div class="container">
                <div class="breadcrumbs__inner">
                    <a href="/" data-translate="home">
                        Home
                    </a>
                    <div class="el">
                        /
                    </div>
                    <span data-translate="sign_up">
                        Sign Up
                    </span>
                </div>
            </div>
        </div>
        @if (session('error_messages'))
            <div class="alert alert-danger" style="text-align: center;">
                {{ session('error_messages') }}
            </div>
        @endif

        <section class="authPage pS">
            <div class="container">
                @if (Session::has('login_error'))
                    <p class="alert alert-danger mb-2">{{ Session::get('login_error') }}</p>
                @endif
                <div class="authPage__body">
                    <div class="authPage__tabs">
                        <a class="authPage__tab active" data-bs-toggle="tab" href="{{ route('user.signin') }}"
                            id="sign-in" data-translate="sign_in">
                            Sign In
                        </a>
                        <a class="authPage__tab " data-bs-toggle="tab" href="{{ route('user.signup') }}" id="sign-up" data-translate="sign_up">
                            Sign Up
                        </a>
                    </div>
                    <div class="authPage__body-inner">
                        <div class="tab-pane @if (Session::get('error_message') == '1') active show @endif" id="pro">
                            <form method="post" action="{{ url('/sign-up/form') }}"
                                class="authPage__form inputSWrap inputWhite">
                                @csrf
                                <div class="input__wrapper">
                                    <label data-translate="full_name">Full Name</label>
                                    <input type="text" class="@error('name') is-invalid @enderror px-3" name="name"
                                        value="{{ old('name') }}" required>
                                    @error('name')
                                        <p style="color: red; ">{{ $message }}</p>
                                    @enderror
                                </div>
                                <div class="input__wrapper">
                                    <label data-translate="email">Email</label>
                                    <input type="email" class="@error('email') is-invalid @enderror px-3" name="email"
                                        value="{{ old('email') }}" required>
                                    @error('email')
                                        <p style="color: red; font-size: 14px">{{ $message }}</p>
                                    @enderror
                                </div>
                                <div class="input__wrapper">
                                    <label data-translate="password">Password</label>
                                    <input type="password" placeholder="min 4 character"
                                        class="password @error('password') is-invalid @enderror px-3" name="password"
                                        value="{{ old('password') }}" required>
                                        @error('password')
                                        <p style="color: red; font-size: 14px">{{ $message }}</p>
                                    @enderror
                                </div>
                                <div class="input__wrapper">
                                    <label data-translate="c_password">Confirm Password</label>
                                    <input type="password" placeholder="min 4 character"
                                        class="@error('password_confirmation') is-invalid @enderror px-3"
                                        name="password_confirmation" value="{{ old('password_confirmation') }}" required>
                                </div>
                                <button type="submit" class="btnHover" data-translate="sign_up">
                                    Sign Up
                                </button>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </section>
        @php
            if (Session::get('error_message') == 0) {
                $error = 0;
            } else {
                $error = Session::get('error_message');
            }
        @endphp
    </main>

    <script>
        $(document).ready(function() {
            var error_validation = {{ $error }};
            if (error_validation == 1) {
                $('#error_message_pt').css('margin-top', '450px');
            }
            $('#sign-in').click(function() {
                // Set the margin-bottom to your desired value (e.g., 100px)
                $('.custom-content').css('margin-bottom', '0px');
            });
            $('#sign-up').click(function() {
                // Set the margin-bottom to your desired value (e.g., 100px)
                $('.custom-content').css('margin-bottom', '310px');
            });
        });
    </script>
@endsection
