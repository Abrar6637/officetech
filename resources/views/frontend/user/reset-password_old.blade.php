@extends('frontend.layout.main')
@section('title', 'Office Tech - Reset Passsword')
@section('main.container')
<main class="main margin" >
    <div class="breadcrumb-container">
        <div class="container">
            <ul class="breadcrumb">
                <li><a href="/">Home</a></li>
                <li class="slash">/</li>
                <li>Reset Password</li>
            </ul>
        </div>
    </div>
    <div class="container text-center mt-4 section-top">
        <div class="div">
            <div class="d-flex flex-column w-100 bg-white mx-auto gap-3 p-5 custom-content">
                <h3 class="forget-text">Reset Password</h3>
                <p class="forget-p">Create a complex password</p>
                <label for="" class="text-start label-text" style="font-size: 18px">Password</label>
                <input type="text" class="form-control"
                    style="border:none; height: 30px; background-color: #F3F6F8;padding:9px 17px;"
                    placeholder="8+ characters">
                <label for="" class="text-start label-text" style="font-size: 18px">Confirm Password</label>
                <input type="text" class="form-control"
                    style="border:none; height: 30px; background-color: #F3F6F8;padding:9px 17px;">
                <button class="btn arrow-white btn-bg-color text-white"
                    style="height: 37px; border-radius: 20px; border: none; margin-top: 10px">Sign In</button>
            </div>
        </div>
</main>
@endsection