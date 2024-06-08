@extends('frontend.layout.main')
@section('title', 'Office Tech - Checkout')
@section('main.container')
    <style>
        .checkout__form-paymentOption input:checked {
            width: 20px !important;
            border-radius: 50%;
            border-color: #76E5A9 !important
            
        }

        .checkout__form-paymentOption input {
            width: 20px;
            border-radius: 50%;
            border-color: #00B4D8 !important;
        }
        .text-danger{
            color:red;
        }
        #loader-container {
            position: fixed;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            background-color: rgba(255, 255, 255, 0.7); /* Semi-transparent white background */
            display: flex;
            justify-content: center;
            align-items: center;
            z-index: 999; /* Ensure the loader is above other content */
        }
        #loader {
            text-align: center;
        }
    </style>
    <div id="loader-container" style="display: none;">
    <div id="loader">
        <img src="{{ asset('images/loader/officetech_new.gif') }}" alt="Loading...">
    </div>
</div>
    <div class="breadcrumbs">
        <div class="container">
            <div class="breadcrumbs__inner">
                <a href="/" data-translate="home">
                    Home
                </a>
                <div class="el">
                    /
                </div>
                <span data-translate="checkout">
                    Checkout
                </span>
            </div>
        </div>
    </div>

    <main>
        <section class="checkout cartCheckout">
            <div class="container">
            @if(Session::has('error_message'))
                <div class="alert alert-danger" style="color: black; background-color: #f9d6d5; border-color: #f7c6c5;width:30%;padding:20px;font-weight:600">
                    {{ Session::get('error_message') }}
                </div>
            @endif
                <form class="checkout__form inputSWrap" action="{{ url('/checkout/add') }}" method="post" id="paymentForm" onsubmit="return validateForm()">
                    <div class="checkout__inner cartCheckout__inner">
                        <div class="cartCheckoutInner__content">
                            <h1 class="cartCheckout__title" data-translate="checkout">
                                Checkout
                            </h1>
                            <div class="checkout__nextTitle" data-translate="billing_information">
                                Billing Information
                            </div>
                            <div class="checkout__form inputSWrap">
                                @csrf
                                <div class="checkout__form-box">
                                    <div class="checkout__form-grid-3">
                                        <div class="input__wrapper">
                                            <label data-translate="first_name">First Name <span class="text-danger">*</span></label>
                                            <input type="text"
                                                value="{{ $user_details ? $user_details->first_name : '' }}"
                                                name="first_name" id="first_name">
                                            @error('first_name')
                                                <small class="invalid-feedback text-danger" style="display:block; margin-top:5px">{{ $message }}</small>
                                            @enderror
                                            <small id="first_name_error" class="invalid-feedback text-danger" style="display: none;"></small>

                                        </div>
                                        <div class="input__wrapper">
                                            <label data-translate="last_name">Last Name <span class="text-danger">*</span></label>
                                            <input type="text" name="last_name"
                                                value="{{ $user_details ? $user_details->last_name : '' }}" id="last_name">
                                        @error('last_name')
                                            <small class="invalid-feedback text-danger" style="display:block; margin-top:5px">{{ $message }}</small>
                                        @enderror
                                        <small id="last_name_error" class="invalid-feedback text-danger" style="display: none;"></small>
                                        </div>
                                       
                                        <div class="input__wrapper">
                                            <label data-translate="company_name">Company Name (Optional)</label>
                                            <input type="text" name="company" name="company_name"
                                                value="{{ $user_details ? $user_details->company_name : '' }}"
                                                id="">
                                            @error('company_name')
                                                <small class="invalid-feedback text-danger" style="display:block;">{{ $message }}</small>
                                            @enderror
                                        </div>
                                      
                                    </div>
                                    <div class="input__wrapper">
                                        <label data-translate="address">Address <span class="text-danger">*</span></label>
                                        <input type="text" name="address"
                                            value="{{ $user_details ? $user_details->address : '' }}" id="address">
                                        @error('address')
                                            <small class="invalid-feedback text-danger" style="display:block; margin-top:5px">{{ $message }}</small>
                                        @enderror
                                        <small id="address_error" class="invalid-feedback text-danger" style="display: none;"></small>
                                    </div>
                                   
                                    <div class="checkout__form-grid-4">
                                        <div class="input__wrapper">
                                            <label data-translate="country">Country</label>
                                            <div class="select">
                                                <select name="country" placeholder="Kevin">
                                                    @foreach ($countries as $country)
                                                        <option value="{{ $country->name }}"
                                                            {{ $user_details && $user_details->country === $country->name ? 'selected' : '' }}>
                                                            {{ $country->name }}</option>
                                                    @endforeach
                                                </select>
                                            </div>
                                            @error('country')
                                                <small class="invalid-feedback text-danger" style="display:block;">{{ $message }}</small>
                                            @enderror
                                        </div>
                                        <div class="input__wrapper">
                                            <label data-translate="region_state">Region/State</label>
                                            <div class="select">
                                                <select placeholder="Kevin" name="region_state" id="region_states">
                                                    <option value="" data-translate="service_policy" disabled>Select Region</option>
                                                    @foreach ($regions as $region)
                                                        <option value="{{ $region->name }}"
                                                            {{ $region->name == 'Riyadh' ? 'selected' : '' }}>
                                                            {{ $region->name }}</option>
                                                    @endforeach
                                                </select>
                                            </div>
                                            @error('region_state')
                                                <small class="invalid-feedback text-danger" style="display:block;">{{ $message }}</small>
                                            @enderror
                                        </div>
                                        <div class="input__wrapper">
                                            <label data-translate="vat_reg_no">VAT Reg. No.</label>
                                            <input type="text" name="vat_reg_no"
                                                value="{{ $user_details ? $user_details->vat_reg_no : '' }}">
                                                @error('vat_reg_no')
                                                    <small class="invalid-feedback text-danger" style="display:block;">{{ $message }}</small>
                                                @enderror
                                        </div>
                                        <div class="input__wrapper">
                                            <label data-translate="cr_company_reg_no">CR -Company Reg. No.</label>
                                            <input type="text" name="company_reg_no"
                                                value="{{ $user_details ? $user_details->company_reg_no ?? $user_details->cr_no : '' }}">
                                                @error('company_reg_no')
                                                    <small class="invalid-feedback text-danger" style="display:block;">{{ $message }}</small>
                                                @enderror
                                        </div>
                                    </div>
                                    <div class="checkout__form-grid-3">
                                        <div class="input__wrapper">
                                            <label data-translate="account_manager">Account Manager</label>
                                            @if (isset($defaultManager))
                                                <input type="text" name="account_manager"
                                                    value="{{ $defaultManager->name }}" readonly id="account_manager">
                                            @else
                                                <input type="text" name="account_manager" value=""
                                                    id="account_manager">
                                            @endif
                                            @error('account_manager')
                                                <small class="invalid-feedback text-danger" style="display:block;">{{ $message }}</small>
                                            @enderror
                                        </div>
                                        <div class="input__wrapper">
                                            <label data-translate="email">Email <span class="text-danger">*</span></label>
                                            <input type="email" name="email" name="email"
                                                value="{{ $user_details ? $user_details->email : '' }}" id="email">
                                                @error('email')
                                                    <small class="invalid-feedback text-danger" style="display:block; margin-top:5px">{{ $message }}</small>
                                                @enderror
                                                <small id="email_error" class="invalid-feedback text-danger" style="display: none;"></small>
                                        </div>
                                        <div class="input__wrapper">
                                            <label data-translate="phone_number">Phone Number <span class="text-danger">*</span>
                                        </label>
                                        <input type="text" name="phone_number" value="{{ $user_details ? $user_details->phone_number : '' }}">

                                                @error('phone_number')
                                                    <small class="invalid-feedback text-danger" style="display:block; margin-top:5px">{{ $message }}</small>
                                                @enderror
                                                <small id="phone_error" class="invalid-feedback text-danger" style="display: none;"></small>
                                        </div>
                                    </div>
                                </div>
                                <div class="checkout__form-box">
                                    <div class="checkout__nextTitle" data-translate="payment_option">
                                        Payment Option
                                    </div>
                                    <div class="checkout__form-paymentOption checkout__form-grid-3">
                                        <div class="input__wrapper">
                                            <img src="{{ asset('updated-assets/images/icons/paymentOption_1.svg') }}"
                                                alt="">
                                            <label data-translate="cash_on_delivery">
                                                Cash on Delivery
                                            </label>
                                            <input type="radio" name="payment_status" value="COD" id="cashOption"
                                                checked>
                                        </div>
                                        <div class="input__wrapper">
                                            <img src="{{ asset('updated-assets/images/icons/paymentOption_2.svg') }}"
                                                alt="">
                                            <label data-translate="debit_credit_card">
                                                Debit/Credit Card
                                            </label>
                                            <input type="radio" name="payment_status" value="Debit-Credit"
                                                id="bankOption">
                                        </div>
                                        <div class="input__wrapper">
                                            <img src="{{ asset('updated-assets/images/icons/paymentOption_3.svg') }}"
                                                alt="">
                                            <label data-translate="bank_transfer">
                                            Bank Transfer
                                            </label>
                                            <input type="radio" name="payment_status" value="Bank-Transfer"
                                                id="cardOption">
                                        </div>
                                    </div>
                                </div>
                                <div class="checkout__form-box">
                                    <div class="checkout__nextTitle" data-translate="additional_information">
                                        Additional Information
                                    </div>
                                    <div class="input__wrapper">
                                        <label data-translate="order_notes">Order Notes (Optional)</label>
                                        <input type="text" name="additional_notes" placeholder="Message">
                                    </div>
                                </div>

                            </div>
                        </div>
                        <div>
                            <div class="cartCheckout__order inputSWrap inputWhite">
                                <h4 class="cartCheckout__title" data-translate="order_summary">
                                    Order Summary
                                </h4>
                                <input class="cartCheckout__order-coupon" value="{{ $discount_coupon }}"
                                    name="discount_code_coppen" placeholder="Enter coupon code here"
                                    id="discount_coupon">
                                <div class="cartCheckout__order-body">
                                    <div class="cartCheckout__order-item">
                                        <span data-translate="sub_total">
                                        Subtotal (Excl. VAT)
                                        </span>
                                        <p id="subtotal">
                                            {{ $subtotal }} <span data-translate="sar">SAR</span> 
                                        </p>
                                        <input type="hidden" name="total_amount" value="{{ $subtotal }}"
                                            id="total_amount">
                                        <input type="hidden" name="slug" value="{{ $slug ?? NULL}}"
                                            id="slug">
                                            <input type="hidden" name="quantity" value="{{ $quantity }}"
                                            id="buy_now_qty">
                                    </div>
                                    <div class="cartCheckout__order-item">
                                        <span data-translate="shipping">
                                            Shipping
                                        </span>
                                        <p style="font-size:14px; margin-top:2px;" id="shipping" data-translate="calculated_at_the_next_step">
                                            Calculated at the next step
                                        </p>
                                        <input type="hidden" id="vat_amount" name="vat_amount" value="0">
                                        <input type="hidden" name="shipping_amount" id="shipping_amount"
                                            value="0">
                                    </div>
                                    <div class="cartCheckout__order-item" id="discount-show"
                                        @if ($discount_amount == '') style="display:none;" @endif>
                                        <span data-translate="discount">Discount</span>
                                        <p id="discount">- {{ $discount_amount }} SAR</p>
                                        <input type="hidden" name="discount_amount" id="discount_amount"
                                            value="{{ $discount_amount }}">
                                    </div>
                                </div>
                                <div class="cartCheckout__order-item">
                                    <span data-translate="total">
                                    Total (Incl. VAT)
                                    </span>
                                    <p id="total">
                                        {{ $totalPrice }} SAR
                                    </p>
                                    <input type="hidden" name="grand_total" id="new_total_amount"
                                        value="{{ $totalPrice }}">
                                </div>
                    
                                @if ($slug !=null)
                                    <div class="catalog__nav-brand-item" style="margin-top:20px;">
                                        <input type="checkbox" class="checkbox filter-checkbox" style="height:10px;width:10px;padding:11px 10px;" id="termsCheckbox">
                                        <label style="font-weight:500;font-size:13px;margin-bottom:4px">
                                       
                                            <p data-translate="are_you_agree_to_our">Are you agree to our <a href="{{ route('ecom.print.package') }}" style="color: #72e081; text-decoration: underline;" data-translate="print_package">Print Package?</a></p>
                                        </label>
                                    </div>
                                @endif
                                @php
                                    $userAddToCart = session('user_add_to_Cart');
                                    if (session()->has('user_id')) {
                                            $user_id = session('user_id');
                                            session(['without_user_add_to_Cart' => $user_id]);
                                        } else {
                                            $without_user_add_to_Cart = session('without_user_add_to_Cart');
                                            session(['without_user_add_to_Cart' => $without_user_add_to_Cart]);
                                        }
                                    $without_user_add_to_Cart = Session('without_user_add_to_Cart');
                                    $userId = isset($cartItems[0]->user_id) ? $cartItems[0]->user_id : $without_user_add_to_Cart;
                                @endphp

                                @if ($userId)
                                    <button id="request-quotation" type="button" class="cartCheckout__order-btn btnHover" data-translate="print_quotation">
                                        Print Quotation
                                    </button>
                                @endif

                                <button style="margin-top: 10px" class="cartCheckout__order-btn btnHover" id="payment" type="submit" data-translate="place_order">
                                    Place Order
                                </button>
                            </div>
                        </div>
                    </div>
                </form>
            </div>
        </section>
        <script src="https://code.jquery.com/jquery-3.6.4.min.js"></script>
    </main>
@endsection
<script src="https://js.stripe.com/v3/"></script>
<script src="https://checkout.stripe.com/checkout.js"></script>
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script>
    $(document).ready(function() {
        var timeoutId;

        // Function to remove decimal part if less than or equal to 0.10
        function removeDecimalIfSmall(value) {
            if (value - Math.floor(value) <= 0.11) {
                return Math.floor(value);
            } else {
                return value.toFixed(2);
            }
        }

        function handleDiscountCoupon() {
            clearTimeout(timeoutId);
            var discount_coupon = $('#discount_coupon').val();
            var total = $('#subtotal').text();
            var totalAmount = parseFloat(total.replace(/\D/g, ''));
            timeoutId = setTimeout(function() {
                $.ajax({
                    type: 'POST',
                    url: "/cart/discount",
                    data: {
                        totalAmount: totalAmount,
                        discount_coupon: discount_coupon,
                        _token: '{{ csrf_token() }}'
                    },
                    success: function(response) {
                        console.log(response);
                        total = response.total;
                        var newtotal = $('#subtotal').text();
                        var newtotal = parseFloat(newtotal.replace(/\D/g, ''));
                        
                        discount_amount = response.discount;
                        
                        var selectedRegionState = $('#region_states').val();
                        if (!(selectedRegionState == 'Makkah' || selectedRegionState ==
                                'Dammam' || selectedRegionState == 'Kohbar' ||
                                selectedRegionState == 'Jeddah' || selectedRegionState ==
                                'Riyadh')) {
                            var shipping = newtotal * 0.05;
                            total = total + shipping;
                            var newshipping = newtotal * 0.05;
                            newtotal = newtotal + newshipping;
                        }

                        $('#discount-show').show();
                        if (response.discount) {
                            var discount_amount = parseFloat(response.discount); // Parse the discount amount to a number
                            if (!isNaN(discount_amount)) { // Check if parsing was successful
                                $('#discount').text('- ' + removeDecimalIfSmall(discount_amount) + ' SAR');
                                $('#total').text(removeDecimalIfSmall(total) + ' SAR');
                                $('#new_total_amount').val(removeDecimalIfSmall(total));
                                $('#discount_amount').val(removeDecimalIfSmall(discount_amount));
                            } else {
                                console.error('Error parsing discount amount:', response.discount);
                            }
                        } else if (discount_coupon == '') {
                            $('#discount-show').hide();
                            $('#total').text(removeDecimalIfSmall(newtotal));
                            $('#new_total_amount').val(removeDecimalIfSmall(newtotal));
                            $('#discount_amount').val(0);
                        } else {
                            $('#discount').text(response.message);
                            $('#total').text(removeDecimalIfSmall(newtotal) + ' SAR');
                            $('#new_total_amount').val(removeDecimalIfSmall(newtotal));
                            $('#discount_amount').val(0);
                        }
                        updateShipping();
                    },
                    error: function(response) {
                        console.log(response);
                    },
                });
            }, 1000);
        }

        function updateShipping() {
            var subamount = parseFloat($('#subtotal').text().replace(/[^\d.]/g, ''));
            var discountAmount = parseFloat($('#discount_amount').val());
            var selectedRegionState = $('#region_states').val();
            $.ajax({
                type: 'POST',
                url: '{{ route('update.shipping') }}',
                data: {
                    selectedRegionState: selectedRegionState,
                    subtotal: subamount,
                    discountAmount: discountAmount,
                    _token: '{{ csrf_token() }}',
                },
                success: function(response) {
                    console.log("----------", response);
                    var shippingAmount = response.shippingAmount;
                    var grandTotal = response.grandTotal;
                    var vatRate = 0.15;
                    var vatAmount = grandTotal * vatRate;
                    var totalWithVat = grandTotal + vatAmount;
                    console.log(grandTotal);
  
                    if (shippingAmount > 0) {
                        $('#shipping').text(removeDecimalIfSmall(shippingAmount) + ' SAR');
                        $('#shipping_amount').val(removeDecimalIfSmall(shippingAmount));
                    } else {
                        $('#shipping_amount').val(0);
                        $('#shipping').text("Enjoy Free Shipping on Your Order!");
                    }

                    $('#vat_amount').val(removeDecimalIfSmall(vatAmount));
                    $('#total').text(removeDecimalIfSmall(totalWithVat) + ' SAR');
                    $('#new_total_amount').val(removeDecimalIfSmall(totalWithVat));
                },
                error: function(error) {
                    console.log("Ajax request failed:", error);
                }
            });
        }
        $('#discount_coupon').change(function() {
            handleDiscountCoupon();
        });
        updateShipping();
        $('#region_states').on('change', function() {
            updateShipping();
        });
    });
    function validateForm() {
        var slug = {!! json_encode($slug) !!};
        var checkbox = document.getElementById('termsCheckbox');
        if (slug && checkbox) {
            if (checkbox.checked) {
                return true;
            } else {
                alert('Please agree to the terms & conditions.');
                return false;
            }
        } else {
            return true;
        }
    }
</script>
<script>
    $(document).ready(function() {
        $('#request-quotation').click(function() {
            var formData = {
                first_name: $('#first_name').val(),
                last_name: $('#last_name').val(),
                email: $('#email').val(),
                shipping_amount: $('#shipping_amount').val(),
                discount_amount: $('#discount_amount').val(),
                total_amount: $('#total_amount').val(),
                new_total_amount: $('#new_total_amount').val(),
                vat_amount: $('#vat_amount').val(),
                address: $('#address').val(),
                slug: $('#slug').val(),
                buy_now_qty: $('#buy_now_qty').val(),
                discount_coupon_name: $('#discount_coupon').val(),
                selectedRegion :$('#region_states').val(),
                selectedManager :$('#account_manager').val(),
                added_by: 'user',
                _token: '{{ csrf_token() }}'
            };
            
            $('.invalid-feedback').hide();

            // Check for errors and display them individually
            if (formData.first_name === '') {
                $('#first_name_error').show().html('First name is required.');
                return;
            }

            if (formData.last_name === '') {
                $('#last_name_error').show().html('Last name is required.');
                return;
            }

            if (formData.email === '') {
                $('#email_error').show().html('Email is required.');
                return;
            }

            if (formData.address === '') {
                $('#address_error').show().html('Address is required.');
                return;
            }
            $.ajax({
                type: 'GET',
                url: "{{ route('request.quotation.generate', ['userId' => $userId]) }}",
                data: formData,
                beforeSend: function () {
                    $('#loader-container').show();
                },
                success: function(response) {
                    $('#loader-container').hide();
                    // console.log(response);
                    if (response.redirect_url) {
                        window.open(response.redirect_url, '_blank');
                    } else {
                        $('#loader-container').hide();
                        console.log(response.message);
                    }
                },
                error: function(error) {
                    console.log(error);
                    console.error(error);
                }
            });

        });
    });
</script>
<script>
        window.addEventListener('beforeunload', function (event) {
            $.ajax({
                type: 'POST',
                url: '{{ route("clear.session") }}',
                data: {
                    _token: '{{ csrf_token() }}'
                },
                async: false, 
            });
        });
    </script>

