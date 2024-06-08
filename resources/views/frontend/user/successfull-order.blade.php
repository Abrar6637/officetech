@extends('frontend.layout.main')
@section('title', 'Office Tech - Order Successfull')
@section('main.container')

    <div class="breadcrumbs">
        <div class="container">
            <div class="breadcrumbs__inner">
                <a href="/"data-translate="home">
                    Home
                </a>
                <div class="el">
                    /
                </div>
                <span data-translate="order_successfull">
                    Order Successfull
                </span>
            </div>
        </div>
    </div>

    <main>
        <section class="successfully">
            <div class="container">
                <div class="successfully__inner">
                    <div class="successfully__icon">
                        <img src="images/icons/successfully.svg" alt="">
                    </div>
                    <h1 class="successfully__title titleSection" data-translate="your_order_is_successfully_placed">
                        Your order is successfully placed
                    </h1>
                    @if (session()->has('order_number'))
                        <p data-translate="your_order_number_is">
                            Your order number is : <b>{{ session('order_number') }}</b>
                        </p>
                    @endif
                    @if (session()->has('tran_ref'))
                        @if (session()->has('payment_status'))
                            @if (session('payment_status') === 'authorized')
                                <p data-translate="your_payment_was_successfully_authorized">Your Payment was successfully Authorized.</p>
                            @else
                                <p data-translate="your_payment">Your Payment: <b>{{ session('payment_status') }}</b></p>
                            @endif
                            <p data-translate="your_payment_transaction_reference_id_is">Your Payment Transaction Reference ID is : <b>{{ session('tran_ref') }}</b></p>
                        @endif
                    @endif

                    <div class="successfully__dscr">
                        <p data-translate="we_are_collecting_your_order">We are collecting your order.</p>
                        <p data-translate="we_will_recieve_an_email_notification_with_the_order_detail">You will receive an email notification with the order detail.</p>
                        <p data-translate="your_order_will_be_processed_once_payment_recieved">Your order will be processed once payment received.</p>
                    </div>
                    <a href="/" class="successfully__btn btnHover" data-translate="go_to_home">
                        Go to home
                    </a>
                </div>
            </div>
        </section>
    </main>
    <script>
        window.addEventListener('beforeunload', function (e) {
            {!! session()->forget(['tran_ref', 'payment_status']) !!}
        });
    </script>

@endsection
