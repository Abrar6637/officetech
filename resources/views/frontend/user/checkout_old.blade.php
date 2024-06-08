@extends('frontend.layout.main')
@section('title', 'Office Tech - Checkout')
@section('main.container')
<style>
         .hidden {
            display: none;
        }

        .border {
            border: 1px solid #ccc;
            padding: 10px;
            margin: 10px;
        }

        .input-container {
            margin: 10px 0;
        }

        .bg-input {
            background-color: #f2f2f2;
            border: 1px solid #ccc;
            padding: 5px;
            width: 100%;
        }


        input[type="number"] {
            color: #000;
            font-family: "Figtree";
            font-size: 1rem;
            font-style: normal;
            font-weight: 400;
            line-height: normal;
            letter-spacing: 0.183px;
            width: 100%;
            height: 40px;
            border: none;
            background: transparent;
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
</style>
<div id="loader-container" style="display: none;">
    <div id="loader">
        <img src="{{ asset('images/loader/loader.gif') }}" alt="Loading...">
    </div>
</div>
<main class="main margin" >
    <div class="breadcrumb-container">
        <div class="container">
            <ul class="breadcrumb">
                <li><a href="/">Home</a></li>
                <li class="slash">/</li>
                <li>Checkout</li>
            </ul>
        </div>
    </div>
    {{-- @if ($errors->any())
    <div class="alert alert-danger">
        <ul>
            @foreach ($errors->all() as $error)
            <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
    @endif --}}
    <div class="container text-center mt-4 section-top">
        <form action="{{url('/checkout/add')}}" method="post" id="paymentForm">
            @csrf
            <div class="row gap-5">
                <div class="col-lg-7 col-12 d-flex flex-column gap-3  bg-white text-start px-lg-5 px-3 px-md-2 py-5 mb-5 ">
                    <h1 class="fw-bold">Checkout</h1>
                    <p style="font-size:18px">Billing Information</p>
                    <div class="row g-3 ">
                        <div class="d-flex flex-column col-12 col-sm-6 col-xxl-4">
                            <label for="" class="d-flex gap-2">First Name <span class="text-danger">*</span></label>
                            <input type="text" value="{{ $user_details ? $user_details->first_name : '' }}" name="first_name" class="in p-2 border-0 bg-input" id="first_name">
                            @error('first_name')
                            <div class="invalid-feedback" style="display:block;">{{ $message }}</div>
                            @enderror
                        </div>
                        <div class="d-flex flex-column col-12 col-sm-6 col-xxl-4">
                            <label for="" class="d-flex gap-2">Last Name<span class="text-danger ml-5">*</span></label>
                            <input type="text" name="last_name" value="{{ $user_details ? $user_details->last_name : '' }}" class="in p-2 border-0 bg-input" id="last_name">
                            @error('last_name')
                            <div class="invalid-feedback" style="display:block;">{{ $message }}</div>
                            @enderror
                        </div>
                        <div class="d-flex flex-column col-12 col-sm-6 col-xxl-4">
                            <label for="">Company Name</label>
                            <input type="text" name="company_name" value="{{ $user_details ? $user_details->company_name : '' }}" class="in p-2 border-0 bg-input" id="">
                            @error('company_name')
                            <div class="invalid-feedback" style="display:block;">{{ $message }}</div>
                            @enderror
                        </div>
                        <div class="col-12 col-sm-6 col-xxl-12 d-flex flex-column">
                            <label for="" class="d-flex gap-2">Address<span class="text-danger">*</span></label>
                            <input type="text" name="address" value="{{ $user_details ? $user_details->address : '' }}" class="in p-2 border-0 bg-input p-2"  id="address">
                            @error('address')
                            <div class="invalid-feedback" style="display:block;">{{ $message }}</div>
                            @enderror
                        </div>
                        <div class=" d-flex flex-column col-12 col-sm-6 col-xxl-3">
                            <label for="" class="d-flex gap-2">Country<span class="text-danger">*</span></label>
                            <select class="form-select border-0 bg-input rounded-0" name="country" aria-label="Default select example" style="height: 40px;">
                                @foreach ($countries as $country)
                                    <option value="{{$country->name}}" {{ ($user_details && $user_details->country === $country->name) ? 'selected' : '' }}>{{$country->name}}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="d-flex flex-column col-12 col-sm-6 col-xxl-3">
                            <label for="" class="d-flex gap-2">Region<span class="text-danger">*</span></label>
                            <select class="form-select border-0 bg-input rounded-0" name="region_state" id="region_states" aria-label="Default select example" style="height: 40px;">
                                <option value="" disabled>Select Region</option>
                                @foreach ($regions as $region)
                                    <option value="{{$region->name}}" {{ ($region->name == 'Riyadh' ? 'selected' : '' )}}>{{$region->name}}</option>
                                @endforeach
                            </select>
                        </div>

                        <div class=" d-flex flex-column col-12 col-sm-6 col-xxl-3">
                            <label for="" class="d-flex gap-2">VAT reg no.</label>
                            <input type="text" name="vat_reg_no" value="{{ $user_details ? $user_details->vat_reg_no : '' }}" class="in p-2 border-0 bg-input w-100">
                            @error('vat_reg_no')
                            <div class="invalid-feedback" style="display:block;">{{ $message }}</div>
                            @enderror
                        </div>
                        <div class=" d-flex flex-column col-12 col-sm-6 col-xxl-3">
                            <label for="" class="d-flex gap-2">Company Reg no.</label>
                            <input type="text" name="company_reg_no" value="{{ $user_details ? ($user_details->company_reg_no ?? $user_details->cr_no) : '' }}" class="in p-2 border-0 bg-input w-100">
                            @error('company_reg_no')
                            <div class="invalid-feedback" style="display:block;">{{ $message }}</div>
                            @enderror
                        </div>
                        <div class="d-flex flex-column col-12 col-sm-6 col-xxl-4">
                            <label for="" class="d-flex gap-2">Account Manger</label>
                            @if(isset($defaultManager))
                                <input type="text" name="account_manager" value="{{ $defaultManager->name }}" class="in p-2 border-0 bg-input" readonly id="account_manager">
                            @else
                                <input type="text" name="account_manager" value="" class="in p-2 border-0 bg-input" id="account_manager">
                            @endif
                            
                            @error('account_manager')
                            <div class="invalid-feedback" style="display:block;">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="d-flex flex-column col-12 col-sm-6 col-xxl-4">
                            <label for="" class="d-flex gap-2">Email<span class="text-danger">*</span></label>
                            <input type="email" name="email" value="{{ $user_details ? $user_details->email : '' }}" class="in p-2 border-0 bg-input" id="email">
                            @error('email')
                            <div class="invalid-feedback" style="display:block;">{{ $message }}</div>
                            @enderror
                        </div>
                        <div class="d-flex flex-column col-12 col-sm-6 col-xxl-4">
                            <label for="" class="d-flex gap-2">Phone number<span class="text-danger">*</span></label>
                            <input type="number" name="phone_number" value="{{ $user_details ? $user_details->phone_number : '' }}" class="in p-2 border-0 bg-input no-spinners">
                            @error('phone_number')
                            <div class="invalid-feedback" style="display:block;">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>
                    <h2 class="fw-bold text-black ">Payment Option</h2>
                    <div class="col-md-10 col-12 d-flex flex-column flex-md-row border mx-auto mx-sm-0   p-3">
                        <div class="payment-border   pb-2 pb-md-0 w-100 d-flex flex-column align-items-center">
                            <svg xmlns="http://www.w3.org/2000/svg" width="32" height="32" viewBox="0 0 32 32" fill="none">
                                <path d="M16 3V29" stroke="#FA8232" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"></path>
                                <path d="M23 11C23 10.3434 22.8707 9.69321 22.6194 9.08658C22.3681 8.47996 21.9998 7.92876 21.5355 7.46447C21.0712 7.00017 20.52 6.63188 19.9134 6.3806C19.3068 6.12933 18.6566 6 18 6H13.5C12.1739 6 10.9021 6.52678 9.96447 7.46447C9.02678 8.40215 8.5 9.67392 8.5 11C8.5 12.3261 9.02678 13.5979 9.96447 14.5355C10.9021 15.4732 12.1739 16 13.5 16H19C20.3261 16 21.5979 16.5268 22.5355 17.4645C23.4732 18.4021 24 19.6739 24 21C24 22.3261 23.4732 23.5979 22.5355 24.5355C21.5979 25.4732 20.3261 26 19 26H13C11.6739 26 10.4021 25.4732 9.46447 24.5355C8.52678 23.5979 8 22.3261 8 21" stroke="#FA8232" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                                </path>
                            </svg>
                            <label class="form-check-label" for="content1">Cash On showroom</label>
                            <input type="radio" name="payment_status" value="COD" id="cashOption" checked>
                                                </div>
                        <div class="payment-border pb-2 pb-md-0 w-100 d-flex flex-column align-items-center">
                            <svg xmlns="http://www.w3.org/2000/svg" width="32" height="32" viewBox="0 0 32 32" fill="none">
                                <path opacity="0.2" d="M4 13.1123H28V23.9998L4 23.9998L4 13.1123Z" fill="#FA8232" stroke="#FA8232" stroke-width="2"></path>
                                <path d="M28 7H4C3.44772 7 3 7.44772 3 8V24C3 24.5523 3.44772 25 4 25H28C28.5523 25 29 24.5523 29 24V8C29 7.44772 28.5523 7 28 7Z" stroke="#FA8232" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                                </path>
                                <path d="M21 21H25" stroke="#FA8232" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"></path>
                                <path d="M15 21H17" stroke="#FA8232" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"></path>
                                <path d="M3 12.1123H29" stroke="#FA8232" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"></path>
                            </svg>
                            <label class="form-check-label" for="content2">Debit/Credit Card</label>
                            <input type="radio" name="payment_status" value="Debit-Credit" id="cardOption">

                        </div>
                        <div class=" w-100 d-flex flex-column align-items-center">
                            <svg xmlns="http://www.w3.org/2000/svg" width="32" height="32" viewBox="0 0 28 22" fill="none">
                                <path d="M22.6666 13.3931L22.679 13.3795M9.04757 13.3931L9.05995 13.3795M4.71423 18.3331V8.42834C4.71423 7.77161 4.97512 7.14178 5.43949 6.67741C5.90387 6.21303 6.5337 5.95215 7.19042 5.95215H24.5238C25.1805 5.95215 25.8103 6.21303 26.2747 6.67741C26.7391 7.14178 26.9999 7.77161 26.9999 8.42834V18.3331C26.9999 18.9898 26.7391 19.6197 26.2747 20.084C25.8103 20.5484 25.1805 20.8093 24.5238 20.8093H7.19042C6.5337 20.8093 5.90387 20.5484 5.43949 20.084C4.97512 19.6197 4.71423 18.9898 4.71423 18.3331Z" stroke="#FA8232" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round">
                                </path>
                                <path d="M4.71429 15.8571H3.47619C2.81946 15.8571 2.18964 15.5963 1.72526 15.1319C1.26088 14.6675 1 14.0377 1 13.381V3.47619C1 2.81946 1.26088 2.18964 1.72526 1.72526C2.18964 1.26088 2.81946 1 3.47619 1H20.8095C21.4663 1 22.0961 1.26088 22.5605 1.72526C23.0248 2.18964 23.2857 2.81946 23.2857 3.47619V5.95238M15.8571 15.8571C15.2004 15.8571 14.5706 15.5963 14.1062 15.1319C13.6418 14.6675 13.381 14.0377 13.381 13.381C13.381 12.7242 13.6418 12.0944 14.1062 11.63C14.5706 11.1656 15.2004 10.9048 15.8571 10.9048C16.5139 10.9048 17.1437 11.1656 17.6081 11.63C18.0724 12.0944 18.3333 12.7242 18.3333 13.381C18.3333 14.0377 18.0724 14.6675 17.6081 15.1319C17.1437 15.5963 16.5139 15.8571 15.8571 15.8571Z" stroke="#FA8232" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round">
                                </path>
                            </svg>
                            <label class="form-check-label" for="content3">Bank Transfer</label>
                            <input type="radio" name="payment_status" value="Bank-Transfer" id="bankOption">
                                                </div>
                    </div>
                    <div class="content" id="cashContainer">Content for Cash On Showroom</div>
                    <div class="content hidden" id="cardContainer">
                        <div class="input-container">
                            <label for="cardName">Name on Card</label>
                            <input type="text" class="in p-2 border-0 bg-input" id="cardName">
                        </div>
                        <div class="input-container">
                            <label for="cardNumber">Card Number</label>
                            <input type="text" class="in p-2 border-0 bg-input" id="cardNumber">
                        </div>
                        <div class="d-flex gap-5">
                            <div class="input-container">
                                <label for="expiryDate">Expiry date</label>
                                <input type="text" class="in p-2 border-0 bg-input" id="expiryDate">
                            </div>
                            <div class="input-container">
                                <label for="cvc">CVC</label>
                                <input type="text" class="in p-2 border-0 bg-input" id="cvc">
                            </div>
                        </div>
                    </div>
                    <div class="content hidden" id="bankContainer">Content for Bank Transfer</div>
                    <div class="w-100 d-flex flex-column">
                        <label for="" class="fw-bold text-black fs-3">Additional Infomration</label>
                        <label for="">Order Notes</label>
                        <textarea type="text" class="in p-2 border-0 bg-input" name="additional_notes"></textarea>
                    </div>
                </div>
                <div class="col-md-8 col-lg-4 col-12 mx-auto">
                    <div class="w-md-75 w-100 mb-5 mb-md-0">
                        <h1 class="text-start fw-bolder">Order Summary</h1>
                        <input type="text" class="w-100 in p-2  border-0 mt-3 mb-3 px-2" value="{{ $discount_coupon }}" name="discount_code_coppen" id="discount_coupon" style="height:30px" placeholder="Enter coupon code here">
                        <div class="d-flex justify-content-between">
                            <p>Subtotal</p>
                            <p id="subtotal">{{$subtotal}} SAR</p>
                            <input type="hidden" name="total_amount" value="{{$subtotal}}" id="total_amount">
                        </div>
                        <div class="d-flex justify-content-between">
                            <p>Shipping</p>
                            <p id="shipping">Calculated at the next step</p>
                            <input type="hidden" id="vat_amount" name="vat_amount" value="0">
                            <input type="hidden" name="shipping_amount" id="shipping_amount" value="0">
                        </div>
                        <div id="discount-show" @if($discount_amount=="") style="display:none;" @endif>
                            <div class="d-flex justify-content-between">
                                <p>Discount</p>
                                <p id="discount">- {{$discount_amount}} SAR</p>
                                <input type="hidden" name="discount_amount" id="discount_amount" value="{{$discount_amount}}">
                            </div>
                        </div>
                        <hr>
                        <div class="d-flex justify-content-between">
                            <p>Total</p>
                            <p id="total">{{$totalPrice}} SAR</p>
                            <input type="hidden" name="grand_total" id="new_total_amount" value="{{$totalPrice}}">
                        </div>
                        @php
                            $userId = $cartItems[0]->user_id;
                        @endphp
                        <button id="request-quotation" type="button" class="text-white w-100 btn-bg-color"
                            style="height: 37px; border-radius: 20px; border: none; margin-top: 10px;">
                            Print Quotation
                        </button>
                        <input type="hidden" name="stripeToken" id="stripeToken" />
                        @if($product_quantity)
                        <p style="margin-top:10px;">The product '{{ $product_name }}' is currently out of stock. You can simply request a quotation using the above request quotation button. </p>
                        @else
                        <button id="payment" data-translation="place_order" type="submit" class="arrow-white text-white w-100" style="height: 37px; border-radius: 20px; border: none; margin-top: 10px; background-color: #da5858">
                            Place Order
                        </button>
                        @endif
                    </div>
                </div>
            </div>
        </form>
        <div id="formContainer" style="display: none"></div>
    </div>
</main>
<script src="https://js.stripe.com/v3/"></script>
<script src="https://checkout.stripe.com/checkout.js"></script>
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<!-- <script>
    $(function() {
        const amountInSAR = Math.round(parseFloat("{{$totalPrice}}") * 100);
        const stripePublicKey = @json(config('services.stripe.public_key'));
        let stripe = StripeCheckout.configure({
            key: stripePublicKey,
            image: "",
            locale: "auto",
            token: (token) => {
                $.ajax({
                    url: '/process-payment',
                    method: 'POST',
                    data: {
                        stripeToken: token.id,
                        amount: amountInSAR,
                        currency: 'sar',
                    },
                    success: function(response) {
                        console.log(response);
                        document.getElementById('paymentForm').submit();
                    },
                    error: function(error) {
                        console.error(error);
                    }
                });
            }
        });
        $('#payment').on('click', function(e) {
            e.preventDefault();
            const isDebitCreditSelected = $('input[name="payment_status"]:checked').val() === 'Debit-Credit';

            if (isDebitCreditSelected) {
                stripe.open({
                    name: 'Office Supplies',
                    description: '',
                    amount: amountInSAR,
                    currency: 'sar'
                });
            } else {
                document.getElementById('paymentForm').submit();
            }
        });
        window.addEventListener('popstate', function() {
            stripe.close();
        });
    });
</script> -->
<script>
    $(document).ready(function() {
        var timeoutId;
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
                        discount_coupon: discount_coupon
                    },
                    success: function(response) {
                        console.log(response);
                        total = response.total;
                        var newtotal = $('#subtotal').text();
                        var newtotal = parseFloat(newtotal.replace(/\D/g, ''));
                        discount_amount = response.discount;
                        var selectedRegionState = $('#region_states').val();

                        if (!(selectedRegionState == 'Makkah' || selectedRegionState == 'Dammam' || selectedRegionState == 'Kohbar' ||
                                selectedRegionState == 'Jeddah' || selectedRegionState == 'Riyadh')) {
                            var shipping = newtotal * 0.05;
                            total = total + shipping;
                            var newshipping = newtotal * 0.05;
                            newtotal = newtotal + newshipping;
                        }

                        $('#discount-show').show();
                        if (response.discount) {
                            $('#discount').text('- ' + discount_amount + ' SAR');
                            $('#total').text(total + ' SAR');
                            $('#new_total_amount').val(total);
                            $('#discount_amount').val(discount_amount);
                        } else if (discount_coupon == '') {
                            $('#discount-show').hide();
                            $('#total').text(newtotal);
                            $('#new_total_amount').val(newtotal);
                            $('#discount_amount').val(0);
                        } else {
                            $('#discount').text(response.message);
                            $('#total').text(newtotal + ' SAR');
                            $('#new_total_amount').val(newtotal);
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
                url: '{{ route("update.shipping") }}',
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
                        $('#shipping').text(shippingAmount + ' SAR');
                        $('#shipping_amount').val(shippingAmount);
                    } else {
                        $('#shipping_amount').val(0);
                        $('#shipping').text("Enjoy Free Shipping on Your Order!");
                    }
                    $('#vat_amount').val(vatAmount.toFixed(2));
                    $('#total').text(totalWithVat + ' SAR');
                    $('#new_total_amount').val(totalWithVat);
                },
                error: function(error) {
                    console.log("Ajax request failed:", error);
                }
            });
        }
        $('#discount_coupon').on('keyup', function() {
            handleDiscountCoupon();
        });
        updateShipping();
        $('#region_states').on('change', function() {
            updateShipping();
        });
    });
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
                discount_coupon_name: $('#discount_coupon').val(),
                selectedRegion :$('#region_states').val(),
                selectedManager :$('#account_manager').val(),
                added_by: 'user',
                _token: '{{ csrf_token() }}'
            };
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
                        window.location.href = response.redirect_url;
                    } else {
                        $('#loader-container').hide();
                        console.log(response.message);
                    }
                },
                error: function(error) {
                    console.error(error);
                }
            });

        });
    });
</script>
<script>
        document.addEventListener('DOMContentLoaded', function () {
            const radioButtons = document.querySelectorAll('input[type="radio"]');
            radioButtons.forEach(function (radioButton)
 {
                radioButton.addEventListener('change', function () {
                    const optionValue = radioButton.value;
                    const contentContainers = document.querySelectorAll('.content');

                    contentContainers.forEach(function (container) {
                        if (container.id === optionValue + 'Container') {
                            container.classList.remove('hidden');
                        } else {
                            container.classList.add('hidden');
                        }
                    });
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
@endsection
