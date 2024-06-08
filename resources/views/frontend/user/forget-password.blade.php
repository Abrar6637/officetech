@extends('frontend.layout.main')
@section('title', 'Office Tech - Forgot Password')
@section('main.container')

<div class="breadcrumbs">
    <div class="container">
        <div class="breadcrumbs__inner" data-translate="home">
            <a href="/">
                Home
            </a>
            <div class="el">
                /
            </div>
            <span data-translate="forget_password">
                Forget Password
            </span>
        </div>
    </div>
</div>

<main>
    <section class="authPage pS">
        <div class="container">
            <div class="authPage__body">
            @if(Session::has('message'))
            <div style="display:flex; justify-content:center">
                    <div class="alert alert-success" style="text-align: center; color: #1d643b;background-color: #d7f3e3;border-color: #c7eed8;padding:10px 110px 10px 110px; margin-bottom:10px" >
                        {{ Session::get('message') }}
                    </div>
                    </div>
                @endif
                <div class="checkout__nextTitle" data-translate="forget_password">
                    Forget Password
                </div>
         
                <div class="authPage__dscr" data-translate="enter_the_email_associated_with_your_account">
                    Enter the email address associated with your account.
                </div>
                <div class="authPage__body-inner">
                    <form  class="authPage__form inputSWrap inputWhite"  method="post" action="{{route('user.forget_password_link')}}" >
                        @csrf
                        <div class="input__wrapper">
                            <label data-translate="email">Email</label>
                            <input type="email"  placeholder="Enter Email" name="email">
                        </div>
                        <button class="btnHover" data-translate="send_request">
                            Send Request
                        </button>
                    </form>
                    <div class="forgetPassword__bottom">
                        <div class="forgetPassword__bottom-item">
                            <span data-translate="already_have_account">
                                Already have account?
                            </span>
                            <a href="{{route('user.signin')}}" class="btnHover" data-translate="sign_in">
                                Sign In
                            </a>
                        </div>
                        <div class="forgetPassword__bottom-item">
                            <span data-translate="dont_have_account">
                                Don’t have account?
                            </span>
                            <a href="{{route('user.signup')}}" class="btnHover" data-translate="sign_up">
                                Sign Up
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
</main>

@endsection