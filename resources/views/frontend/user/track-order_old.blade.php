@extends('frontend.layout.main')
@section('title', 'Office Tech - Track Order')
@section('main.container')
<main class="main margin" >
    <div class="breadcrumb-container">
        <div class="container">
            <ul class="breadcrumb">
                <li><a href="/">Home</a></li>
                <li class="slash">/</li>
                <li>My Orders</li>
            </ul>
        </div>
    </div>
    <div class="container text-center mt-4 section-top">

        <div class="col-12 col-lg-7 text-start d-flex flex-column  gap-3 py-5">
            <h1 class="fw-bold">Track Order</h1>
            <p style="font-size:18px">To track your order please enter your order ID in the input field below and press
                the “Track Order”
                button. this was given to you on your receipt and in the confirmation email you should have received.
            </p>
            <form action="{{route('user.track_order_details')}}" method="post">
                @csrf
                <div class="d-flex gap-4">
                    <div class="d-flex flex-column w-50 gap-3">
                        <label for="" style="font-size:14px ">Order Number</label>
                        <input type="text" class="border-0 in" style="height:30px" name="order_number" required>

                    </div>
                    <div class="d-flex flex-column w-50 gap-3">
                        <label for="" style="font-size:14px">Billing Email</label>
                        <input type="email" class="border-0 in" style="height:30px" name="billing_email" required>

                    </div>

                </div>
                <div class="d-flex gap-2 align-items-center">
                    <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 16 16" fill="none">
                        <path d="M8 14C11.3137 14 14 11.3137 14 8C14 4.68629 11.3137 2 8 2C4.68629 2 2 4.68629 2 8C2 11.3137 4.68629 14 8 14Z" stroke="#5F6C72" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round" />
                        <path d="M7.5 7.5H8V11H8.5" stroke="#5F6C72" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round" />
                        <path d="M7.875 6C8.28921 6 8.625 5.66421 8.625 5.25C8.625 4.83579 8.28921 4.5 7.875 4.5C7.46079 4.5 7.125 4.83579 7.125 5.25C7.125 5.66421 7.46079 6 7.875 6Z" fill="#5F6C72" />
                    </svg>
                    <p class="mt-3">Order ID that we sended to your in your email address.</p><br>
                </div>  
                @if(session('error'))
                <div class="alert alert-danger">
                    {{ session('error') }}
                </div>
                @endif
                <button class="arrow-white text-white" type="submit" style="height:37px ; border-radius:20px; width:207px; border:none;  margin-top:10px; background-color:#da5858"><a class="text-white ">Track Order</a></button>
            </form>

        </div>

</main>
@endsection