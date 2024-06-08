@extends('frontend.layout.main')
@section('title', 'Office Tech - Forgot Password')
@section('main.container')
<main>
<div class="breadcrumbs">
    <div class="container">
        <div class="breadcrumbs__inner">
            <a href="/">
                Home
            </a>
            <div class="el">
                /
            </div>
            <span>
                Reset Password
            </span>
        </div>
    </div>
</div>
    @if(Session::has('error'))
    <div style="display:flex; justify-content:center">

    
        <div class="alert alert-success" style="text-align: center;  color: #761b18;background-color: #f9d6d5;border-color: #f7c6c5;padding:10px 110px 10px 110px">
            {{ Session::get('error') }}
        </div>
        </div>
    @endif
    <section class="authPage pS">
        <div class="container">
            <div class="authPage__body">
                <div class="checkout__nextTitle">
                Reset Password
                </div>
                <div class="authPage__dscr">
                    Enter the email address associated with your account.
                </div>
                <div class="authPage__body-inner">
                    <form  class="authPage__form inputSWrap inputWhite"  method="post" action="{{route('reset.password.post')}}" >
                        @csrf
                        <input type="hidden" name="token" value="{{ $token }}">
                        <div class="input__wrapper">
                            <label>Email</label>
                            <input type="email"  placeholder="Enter Email" name="email">
                        </div>
                        <div class="input__wrapper">
                            <label>Password</label>
                            <input type="text"  placeholder="New Password" name="password">
                        </div>
                        <div class="input__wrapper">
                            <label>Confirm Password</label>
                            <input type="text"  placeholder="Confirm Password" name="password_confirmation">
                        </div>
                        <button class="btnHover">
                            Reset
                        </button>
                    </form>
                </div>
            </div>
        </div>
    </section>
</main>

@endsection