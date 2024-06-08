@extends('frontend.layout.main')
@section('title', 'Office Tech - Services')
@section('main.container')

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
                    Service Request
                </span>
            </div>
        </div>
    </div>

    <main>
        <section class="chooseService pS">
            <div class="container">
                @if (session('success'))
                    <p style="font-size: 16px; padding-bottom: 20px; text-align: center; color:green; ">{{ session('success') }}</p>
                @endif
                <div class="chooseService__inner">
                    <form action="{{ route('request.service') }}" method="post"
                        class="chooseService__form inputSWrap inputWhite">
                        @csrf
                        <h2 class="cartCheckout__title">
                            Choose Service
                        </h2>
                        <div class="chooseService__form-grid-2">
                            <div class="input__wrapper">
                                <label>
                                    Service Request
                                </label>
                                <div class="select">
                                    <select name="serviceRequest" id="serviceSelect" name="service_type">
                                        @foreach ($services as $service)
                                            <option value="{{ $service->id }}">
                                                {{ $service->name }}
                                            </option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                            <div class="input__wrapper">
                                <label>
                                    Service Issue
                                </label>
                                <div class="select">
                                    <select name="service_call_type">
                                        <option value="paper_jam" selected>Paper Jam</option>
                                        <option value="setup_device">Setup device</option>
                                        <option value="mehine_error">Machine error</option>
                                        <option value="service_contract">printing quality</option>
                                    </select>
                                </div>
                            </div>
                        </div>
                        <div class="input__wrapper">
                            <label>
                                Enter item cluster no / serial No
                            </label>
                            <div class="select">
                                <select name="serial_num_contract_req">
                                    <option value="" selected disabled>Select Serial Number</option>
                                    @foreach ($orders as $order)
                                        @foreach ($order->productQuantity as $productQuantity)
                                            <option value="{{ $productQuantity->serial_no }}">
                                                {{ $productQuantity->serial_no }}</option>
                                        @endforeach
                                    @endforeach
                                </select>
                            </div>
                        </div>
                        <div class="input__wrapper">
                            <label>
                                Request Details
                            </label>
                            <textarea name="call_service_details"></textarea>
                        </div>
                        <input type="hidden" value="{{ Session::get('user_id') }}" name="user_id">
                        <input type="hidden" value="{{ Session::get('user_email') }}" name="email">
                        <input type="hidden" value="{{ $orderId }}" name="order_id">
                        <button type="submit" class="btnHover">
                            Submit
                        </button>
                    </form>
                </div>
            </div>
        </section>
    </main>

@endsection
