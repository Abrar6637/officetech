@extends('frontend.layout.main')
@section('title', 'Office Tech - Forgot Password')
@section('main.container')
<main class="main margin" >
    <div class="breadcrumb-container">
        <div class="container">
            <ul class="breadcrumb">
                <li><a href="/">Home</a></li>
                <li class="slash">/</li>
                <li>Sign In</li>
            </ul>
        </div>
    </div>
    <div class="container text-center mt-4 section-top">
        <div class="div">
            <div class="d-flex flex-column w-100  mx-auto px-5 gap-3 py-4 bg-white custom-content">
                <h3 class="forget-text">Forget Password</h3>
                <p class="forget-p">Enter the email address or mobile phone number associated with your account.</p>
                <label for="" class="text-start label-text" style="font-size: 18px">Email Address</label>
                <input type="text" class="form-control"
                    style="border:none; height: 35px; background-color: #F3F6F8;padding:9px 17px;"
                    placeholder="Enter Your Email Adress">
                <button class="btn arrow-white btn-bg-color text-white"
                    style="height: 37px; border-radius: 20px; border: none; margin-top: 10px"><a
                        href="{{route('user.reset_password')}}" class="color-a">Sign In</a></button>
                <div class="div">
                    <div class="d-flex justify-content-center">
                        <p>Already have account? &nbsp;</p><span class="font-color">Sign In</span>
                    </div>
                    <div class="d-flex justify-content-center">
                        <p>Don’t have account? &nbsp;</p><span class="font-color">Sign Up</span>
                    </div>
                </div>
            </div>
        </div>
</main>
@endsection