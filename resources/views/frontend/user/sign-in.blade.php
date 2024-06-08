@extends('frontend.layout.main')
@section('title', 'Office Tech - Sign In')
@section('main.container')
<main>
    <div class="breadcrumbs">
        <div class="container">
            <div class="breadcrumbs__inner">
                <a href="/"  data-translate="home">
                    Home
                </a>
                <div class="el">
                    /
                </div>
                <span  data-translate="sign_in">
                    Sign In
                </span>
            </div>
        </div>
    </div>
        @if (session('error_messages'))
            <div class="alert alert-danger" style="text-align: center;">
                {{ session('error_messages') }}
            </div>
        @endif
        @if (session('message'))
        <div style="display:flex; justify-content:center">
        
            <div class="alert alert-danger" style="text-align: center; color: #1d643b;background-color: #d7f3e3;border-color: #c7eed8;padding-left:110px; padding-right:110px;padding-top: 10px;padding-bottom: 10px;">
                <span data-translate="need_to_login">{{ session('message') }}</span>
            </div>
          
            </div>
        @endif

        <section class="authPage pS">
            <div class="container">
                @if (Session::has('login_error'))
                    <p class="alert alert-danger mb-2">{{ Session::get('login_error') }}</p>
                @endif
                <div class="authPage__body">
                    <div class="authPage__tabs">
                        <a class="authPage__tab"
                        data-bs-toggle="tab" href="{{route('user.signin')}}" id="sign-in" data-translate="sign_in">
                            Sign In
                        </a>
                        <a class="authPage__tab active"
                        data-bs-toggle="tab" href="{{route('user.signup')}}" id="sign-up" data-translate="sign_up">
                            Sign Up
                        </a>
                    </div>
                    <div class="authPage__body-inner">
                        <div class="tab-pane @if (Session::get('error_message') == '') active @endif" id="msg">
                            <form method="post" action="{{ url('/sign-in/form') }}" class="authPage__form inputSWrap inputWhite">
                            @csrf    
                            <div class="input__wrapper">
                                    <label data-translate="email">Email</label>
                                    <input type="email" value="{{ old('email') }}" name='email' required>
                                </div>
                                <div class="input__wrapper">
                                    <label data-translate="password">Password</label>
                                    <input type="password" name='password' required>
                                </div>
                                <a  href="{{ route('user.forget_password') }}" class="help btnHover" data-translate="forget">
                                    Forget Password
                                </a>
                                @if (session('error'))
                                    <p style="color: red; font-size: 14px">{{ session('error') }}</p>
                                @endif
                                <button type="submit" class="btnHover" data-translate="sign_in">
                                    Sign In
                                </button>
                            </form>
                        </div>              
                    </div>
                </div>
            </div>
        </section>
        @php
            if(Session::get('error_message')==0){
                $error = 0;
            }else{
                $error = Session::get('error_message');
            }
        @endphp
</main>
    
    <script>
    $(document).ready(function() {
        var error_validation= {{$error}};
        if(error_validation==1){
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