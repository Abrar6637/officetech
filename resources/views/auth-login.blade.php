@extends('layouts.master-without-nav')
@section('title')
@lang('translation.z')
@endsection
@section('content')
<style>
    @media(max-width:768px){
        .auth-bg .bg-overlay{
        background: white;
    }
    }
</style>
<div class="auth-page">
    <div class="container-fluid p-0">
        <div class="row g-0">
            <div class="col-xxl-3 col-lg-4 col-md-5">
                <div class="auth-full-page-content d-flex p-sm-5 p-4">
                    <div class="w-100">
                        <div class="d-flex flex-column h-100">
                            <div class="mb-4 mb-md-5 text-center">
                                <a href="{{ url('/') }}" class="d-block auth-logo">
                                    <img src="{{url('updated-assets/images/logo.svg')}}" alt="" width="300px">
                                </a>
                            </div>
                            <div class="auth-content my-auto">
                                <div class="text-center">
                                    <h5 class="mb-0">Welcome Back !</h5>
                                    <p class="text-muted mt-2">Sign in to continue to Office Tech Admin.</p>
                                </div>
                                @if(isset($error))
                                    <div class="alert alert-danger" style="color: black;">
                                        {{ $error }}
                                    </div>
                                @endif


                                <form class="mt-4 pt-2" action="{{ route('admin.login') }}" method="POST">
                                    @csrf
                                    <div class="form-floating form-floating-custom mb-4">
                                        <input type="text" class="form-control @error('email') is-invalid @enderror" id="input-username" placeholder="Enter Email" name="email">
                                        @error('email')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror
                                        <label for="input-username">Username</label>
                                        <div class="form-floating-icon">
                                        <i data-feather="users"></i>
                                        </div>
                                    </div>

                                    <div class="form-floating form-floating-custom mb-4 auth-pass-inputgroup">
                                        <input type="password" class="form-control pe-5 @error('password') is-invalid @enderror" name="password" id="password-input" placeholder="Enter Password" value="123456">
                                        @error('password')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror
                                        <button type="button" class="btn btn-link position-absolute h-100 end-0 top-0" id="password-addon">
                                            <i class="mdi mdi-eye-outline font-size-18 text-muted"></i>
                                        </button>
                                        <label for="input-password">Password</label>
                                        <div class="form-floating-icon">
                                            <i data-feather="lock"></i>
                                        </div>
                                    </div>
                                    <div class="mb-3">
                                        <button class="btn w-100 waves-effect waves-light  text-light" type="submit" style="background-color: #03045E; padding: 12px 0px">Log In</button>
                                    </div>
                                </form>
                            </div>
                            <div class="mt-4 mt-md-5 text-center">
                                <p class="mb-0">© <script>document.write(new Date().getFullYear())</script><span style="color: #03045E; font-weight: 600"> Office Tech</span></p>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- end auth full page content -->
            </div>
            <!-- end col -->
            <div class="col-xxl-9 col-lg-8 col-md-7">
                <div class="auth-bg pt-md-5 p-4 d-flex">
                    <div class="bg-overlay"></div>
                    <ul class="bg-bubbles">
                        <li></li>
                        <li></li>
                        <li></li>
                        <li></li>
                        <li></li>
                        <li></li>
                        <li></li>
                        <li></li>
                        <li></li>
                        <li></li>
                    </ul>
                    <!-- end bubble effect -->
                    <div class="row justify-content-center align-items-end">
                        <div class="col-xl-7">
                            <div class="p-0 p-sm-4 px-xl-0">
                        
                                <!-- end review carousel -->
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <!-- end col -->
        </div>
        <!-- end row -->
    </div>
    <!-- end container fluid -->
</div>
@endsection
@section('script')
    <script src="{{ URL::asset('assets/js/pages/pass-addon.init.js') }}"></script>
    <script src="{{ URL::asset('assets/js/pages/feather-icon.init.js') }}"></script>
@endsection
