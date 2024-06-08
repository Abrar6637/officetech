@extends('frontend.layout.main')
@section('title', 'Office Tech - Track Order')
@section('main.container')

    <div class="breadcrumbs">
        <div class="container">
            <div class="breadcrumbs__inner">
                <a href="/" data-translate="home">
                    Home
                </a>
                <div class="el">
                    /
                </div>
                <span data-translate="track_order">
                    Track Order
                </span>
            </div>
        </div>
    </div>

    <main>
        <section class="trackOrder pS">
            <div class="container">
                <div class="trackOrder__inner">
                    <h1 class="trackOrder__title titleSection tl" data-translate="track_order">
                        Track Order
                    </h1>
                    <div class="trackOrder__dscr" data-translate="to_track_your_order_please_enter_your_order_id_in_the_input_field_below_and_press_the_track_order_button_this_was_given_to_you_on_your_receipt_and_in_the_confirmation_email_you_should_have_recieved">
                        <p>
                            To track your order please enter your order ID in the input field below and press the “Track
                            Order” button. this was
                            given to you on your receipt and in the confirmation email you should have received.
                        </p>
                    </div>
                    <form action="{{ route('user.track_order_details') }}" method="post"
                        class="trackOrder__form inputSWrap">
                        @csrf
                        <div class="trackOrder__form-grid-2">
                            <div class="input__wrapper">
                                <label data-translate="order_id" >
                                    Order ID
                                </label>
                                <input type="text" name="order_number" required>
                            </div>
                            <div class="input__wrapper" data-translate="billing_emailll">
                                <label >
                                    Billing Email
                                </label>
                               
                                <input type="email" name="billing_email" required>
                            </div>
                        </div>
                        @if (session('error'))
                            <div id="error-message" style="font-size: 14px; color: red; margin-bottom: 10px">
                                {{ session('error') }}
                            </div>
                        @endif
                        <div class="trackOrder__form-dscr" data-translate="order_id_that_we_sended_to_your_in_your_email_address">
                            Order ID that we sended to your in your email address.
                        </div>
                        <button type="submit" class="btnHover" data-translate="track_order">
                            Track Order
                        </button>
                    </form>
                </div>
            </div>
        </section>
    </main>
    <script>
        setTimeout(function() {
            document.getElementById('error-message').style.display = 'none';
        }, 5000);
    </script>
@endsection
