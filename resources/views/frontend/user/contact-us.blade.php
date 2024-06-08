@extends('frontend.layout.main')
@section('title', 'Office Tech - Contact Us')
@section('main.container')
<style>
    @media(max-width:1000px){
  .contact__inner{
      display: flex !important;
      flex-direction: column-reverse !important;
  }
}
</style>
    <div class="breadcrumbs">
        <div class="container">
            <div class="breadcrumbs__inner">
                <a href="/" data-translate="home">
                    Home
                </a>
                <div class="el">
                    /
                </div>
                <span data-translate="contact">
                    Contact
                </span>
            </div>
        </div>
    </div>

    <main>
        <section class="contact">
            <div class="container">
                <div class="contact__inner">
                    <div class="contact__content">
                        <div class="contact__items">
                            <div>
                                <div class="checkout__nextTitle" data-translate="want_to_reach_out_directly">
                                    Want to reach out directly?
                                </div>
                                <p data-translate="you_can_contact_us_using_the_contact_details_below">
                                    You can contact us using the contact details below
                                </p>
                            </div>
                            <div>
                                <div class="checkout__nextTitle" data-translate="follow_us_on_social_media">
                                    Follow us on social media
                                </div>
                                <div class="footer__social">
                                    <a href="#">
                                        <img src="images/icons/footer__social_1.svg" alt="">
                                    </a>
                                    <a href="#">
                                        <img src="images/icons/footer__social_2.svg" alt="">
                                    </a>
                                    <a href="#">
                                        <img src="images/icons/footer__social_3.svg" alt="">
                                    </a>
                                </div>
                            </div>
                            <div>
                                <a href="tel:+9661234567" class="btnHover">
                                    +966 1234 567
                                </a>
                                <a href="mailto:info@officetech.com.sa" class="btnHover">
                                    info@officetech.com.sa
                                </a>
                            </div>
                            <div>
                                <div class="checkout__nextTitle" data-translate="address">
                                    Address
                                </div>
                                <p>
                                    OFFICE SUPPLIES CO. LTD. P.O BOX 509 Riyadh 11421 Kingdom of Saudia Arbia TEL : +966-11-2170000
                                </p>
                            </div>
                        </div>
                        <div class="cart__info">
                            <div class="cart__info-title cartCheckout__title" data-translate="faqs">
                                FAQ'S
                            </div>
                            <div class="cart__info-item accordion-item">
                            <div class="cart__info-item-title accordion-item-title" data-translate="payment_policy">
                                Payment Policy
                            </div>
                            <div class="cart__info-item-body accordion-item-body" data-translate="we_provide_secure_and_multiple_method_of_payments" >
                            We provide secure and multiple method of payments: VISA, MasterCard, Mada, cash on delivery, Bank Transfer for completing online orders. <a href="{{ route('payment.policy') }}" style="color:var(--colorBlue)">read more</a>
                            </div>
                        </div>
                        <div class="cart__info-item accordion-item">
                            <div class="cart__info-item-title accordion-item-title" data-translate="return_policy">
                                Return Policy
                            </div>
                            <div class="cart__info-item-body accordion-item-body" data-translate="to_request_a_return">
                                To request a return/exchange, please read this page carefully then get your order number and   
                                <a href="{{ route('return.policy') }}" style="color:var(--colorBlue)" data-translate="read_more">read more</a>
                            </div>
                        </div>
                        <div class="cart__info-item accordion-item">
                            <div class="cart__info-item-title accordion-item-title" data-translate="service_policy">
                               Service Policy
                            </div>
                            <div class="cart__info-item-body accordion-item-body" data-translate="in_general_service_is_available">
                            In general, service is available five working days based on 8.5 hours. Unless additional service terms have been previously negotiated as part of the service agreement. For all the brands other than Konica Minolta and <a href="{{ route('service.policy') }}" style="color:var(--colorBlue)">read more</a>
                            </div>
                        </div>
                        </div>
                    </div>
                    <div class="contact__form">
                        @if (session('success'))
                            <p class="alert alert-success" style="color: #76E4A8">{{ session('success') }}</p>
                        @endif
                        <form action="{{ route('user.contactus') }}" method="post" method="post"
                            class="inputSWrap inputWhite">
                            @csrf
                            <div class="contact__form-grid-2">
                                <div class="input__wrapper">
                                    <label data-translate="name">Name</label>
                                    <input type="text" name="name" required>
                                </div>
                                @error('name')
                                    <p class="text-danger">{{ $message }}</p>
                                @enderror
                                <div class="input__wrapper">
                                    <label data-translate="email">Email</label>
                                    <input type="email" name="email" required>
                                </div>
                                @error('email')
                                    <p class="text-danger">{{ $message }}</p>
                                @enderror
                                <div class="input__wrapper">
                                    <label data-translate="phone">Phone</label>
                                    <input type="text" name="phone" required>
                                </div>
                                @error('phone')
                                    <p class="text-danger">{{ $message }}</p>
                                @enderror
                                <div class="input__wrapper">
                                    <label data-translate="company">Company</label>
                                    <input type="text" name="company" required>
                                </div>
                                @error('company')
                                    <p class="text-danger">{{ $message }}</p>
                                @enderror
                            </div>
                            <div class="input__wrapper">
                                <label data-translate="message">Message</label>
                                <textarea name="message"></textarea>
                            </div>
                            @error('message')
                                <p class="text-danger">{{ $message }}</p>
                            @enderror
                            <button type="submit" class="btnHover" data-translate="send">Send</button>
                        </form>
                    </div>
                </div>
            </div>
        </section>
    </main>

@endsection
