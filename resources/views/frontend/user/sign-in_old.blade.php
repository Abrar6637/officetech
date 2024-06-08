@extends('frontend.layout.main')
@section('title', 'Office Tech - Sign In')
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

    @if (session('error_messages'))
    <div class="alert alert-danger" style="text-align: center;">
        {{ session('error_messages') }}
    </div>
    @endif
    <div class="container text-center mt-4 w-sm-50 section-top">
        <div class="container  w-100 w-sm-50 mx-md-auto custom-content" style="margin-top: 60px;">
            @if (Session::has('login_error'))
                <p class="alert alert-danger mb-2">{{ Session::get('login_error') }}</p>
            @endif
            <!-- Nav tabs -->
            <ul class="nav nav-tabs sig mx-md-auto d-flex ">
                <li class="nav-item flex-grow-1">
                    <a class="nav-link @if (Session::get('error_message') == '') active @endif py-3 fw-bold text-black"
                        style="font-size: 18px" data-bs-toggle="tab" href="#msg" id="sign-in">Sign In</a>
                </li>
                <li class="nav-item flex-grow-1">
                    <a class="nav-link @if (Session::get('error_message') == '1') active @endif py-3 fw-bold text-black"
                        style="font-size: 18px" data-bs-toggle="tab" href="#pro" id="sign-up">Sign Up</a>
                </li>
            </ul>
            <!-- Tab panes -->
            <div class="tab-content text-center mx-md-auto bg-white position-relative z-10">
                <div class="tab-pane container text-dark @if (Session::get('error_message') == '') active @endif" id="msg">
                    <form method="post" action="{{ url('/sign-in/form') }}">
                        @csrf
                        <div class="d-flex flex-column w-75 mx-auto gap-3 py-4">
                            <label for="" class="text-start" style="font-size: 18px">Email Address</label>
                            <input type="email" value="{{ old('email') }}" name='email' class="px-3"
                                style="border:none; height: 30px; border-radius: 10px; background-color: #F3F6F8"
                                required>
                            <div class="d-flex justify-content-between pt-3">
                                <label for="" style="font-size: 18px">Password</label>
                                <a href="{{ route('user.forget_password') }}" style="font-size: 18px"
                                    class="font-color">Forget Password ?</a>
                            </div>
                            <input type="password" class="px-3" name='password'
                                style="border:none; height: 30px; border-radius: 10px; background-color: #F3F6F8"
                                required>
                            @if (session('error'))
                            <span class="form-alert" role="alert">
                                <strong class="text-danger">{{ session('error') }}</strong>
                            </span>
                            @endif
                            <button class="arrow-white btn-bg-color text-white"
                                style="height: 37px; border-radius: 20px; border: none; margin-top: 10px">Sign
                                In</button>
                        </div>
                    </form>
                </div>
                <div class="tab-pane container fade text-dark  @if (Session::get('error_message') == '1') active show @endif"
                    id="pro">
                    <form method="post" action="{{ url('/sign-up/form') }}">
                        @csrf
                        <div class="d-flex flex-column w-75 mx-auto gap-3 py-5">
                            <label for="" class="text-start" style="font-size: 18px">Name</label>
                            <input type="text" class="@error('name') is-invalid @enderror px-3" name="name"
                                value="{{ old('name') }}"
                                style="border:none; height: 30px; border-radius: 10px; background-color: #F3F6F8">
                            @error('name')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                            @enderror
                            <label for="" class="text-start" style="font-size: 18px">Email
                                Address</label>
                            <input type="email" class="@error('email') is-invalid @enderror px-3" name="email"
                                value="{{ old('email') }}"
                                style="border:none; height: 30px; border-radius: 10px; background-color: #F3F6F8">
                            @error('email')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                            @enderror
                            <label for="" class="text-start" style="font-size: 18px">Password</label>
                            <input type="password" placeholder="8+ character" class="password @error('password') is-invalid @enderror px-3"
                                name="password" value="{{ old('password') }}"
                                style="border:none; height: 30px; border-radius: 10px; background-color: #F3F6F8">
                            @error('password')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                            @enderror
                            <label for="" class="text-start" style="font-size: 18px">Confirm
                                Password</label>
                            <input type="password" placeholder="8+ character" class="@error('password_confirmation') is-invalid @enderror px-3"
                                name="password_confirmation" value="{{ old('password_confirmation') }}"
                                style="border:none; height: 30px; border-radius: 10px; background-color: #F3F6F8">
                            <div class="d-flex pt-3 gap-3 ">
                            <input type="checkbox" name="my_checkbox" class="checkbox" @if(old('my_checkbox')) checked @endif required>
                                <p class="text-start " style="font-size:16px">Are you agree to our
                                    <a href="{{route('terms.conditions')}}" class="font-color text-decoration-underline">Terms of Condition</a> and <a href="{{route('privacy.policy')}}" class="font-color text-decoration-underline">Privacy Policy</a>.</p>
                            </div>
                            <button class="arrow-white btn-bg-color text-white"
                                style="height: 37px; border-radius: 20px; border: none; margin-top: 10px">Sign
                                Up</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
    @php
        if(Session::get('error_message')==0){
            $error = 0;
        }else{
            $error = Session::get('error_message');
        }
    @endphp
</main>
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
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