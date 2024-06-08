@extends('frontend.layout.main')
@section('title', 'Office Tech - Reset Passsword')
@section('main.container')

<div class="breadcrumbs">
    <div class="container">
        <div class="breadcrumbs__inner" data-translate="reset_password">
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
                <div class="checkout__nextTitle" data-translate="reset_password">
                    Reset Password
                </div>
                <div class="authPage__dscr" data-translate="create-a_complex_password">
                    Create a complex password
                </div>
                <div class="authPage__body-inner">
                    <form action="/" method="post" class="authPage__form inputSWrap inputWhite">
                        <div class="input__wrapper">
                            <label data-translate="password">Password</label>
                            <input type="password" name="password" required>
                        </div>
                        <div class="input__wrapper">
                            <label data-translate="confirm_password">Confirm Password</label>
                            <input type="password" name="password2" required>
                        </div>
                        <button type="submit" class="btnHover" data-translate="update_password">
                            Update Password
                        </button>
                    </form>
                </div>
            </div>
        </div>
    </section>
</main>

@endsection