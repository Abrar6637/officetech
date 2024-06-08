@extends('frontend.layout.main')
@section('title', 'Office Tech - Order Successfull')
@section('main.container')
<main class="main margin" >
    <div class="breadcrumb-container">
        <div class="container">
            <ul class="breadcrumb">
                <li><a href="/">Home</a></li>
                <li class="slash">/</li>
                <li>Order Successfully</li>
            </ul>
        </div>
    </div>
    <div class="container text-center mt-4 section-top">
        <div class="div">
            <div
                class="d-flex flex-column w-100 justify-content-center align-items-center   mx-auto  gap-3 py-5  custom-content">
                <svg xmlns="http://www.w3.org/2000/svg" width="88" height="88" viewBox="0 0 88 88" fill="none">
                    <path opacity="0.2"
                        d="M44 77C62.2254 77 77 62.2254 77 44C77 25.7746 62.2254 11 44 11C25.7746 11 11 25.7746 11 44C11 62.2254 25.7746 77 44 77Z"
                        fill="#da5858" />
                    <path d="M59.125 35.75L38.9469 55L28.875 45.375" stroke="#da5858" stroke-width="4"
                        stroke-linecap="round" stroke-linejoin="round" />
                    <path
                        d="M44 77C62.2254 77 77 62.2254 77 44C77 25.7746 62.2254 11 44 11C25.7746 11 11 25.7746 11 44C11 62.2254 25.7746 77 44 77Z"
                        stroke="#da5858" stroke-width="4" stroke-linecap="round" stroke-linejoin="round" />
                </svg>
                <h3 style="font-size:35px; font-weight:900">Your order is successfully place</h3>
                <p class="pb-0 mb-0">We are already collecting your order</p>
                @if(session()->has('order_number'))
                <p><font class="fw-bold" data-transalate="your_order_number_is">Your order number is : </font> {{ session('order_number') }}</p>
                @endif
                <div class="d-flex justify-content-center">
                    <button class="arrow-white  text-white px-4"
                        style="height: 37px; border-radius: 20px; border: none; margin-top: 10px; background-color:#da5858 ">
                        <a href="{{route('user.index')}}" class="text-light">Go
                            to
                            home</a>
                    </button>
                </div>
            </div>
        </div>
    </div>
</main>
@endsection