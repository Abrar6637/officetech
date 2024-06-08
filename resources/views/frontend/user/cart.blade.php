@extends('frontend.layout.main')
@section('title', 'Office Tech - Cart')
@section('main.container')
    <style>
        .swal2-tabs {
            display: flex;
            justify-content: space-between;
            align-items: center;
        }

        .swal2-tabs .swal2-tab {
            text-align: center;
            width: 100%;
            color: #76E5A9;
            border-bottom: 2px solid #76E5A9;
            padding: 10px;
        }

        .swal2-tabs .swal2-tab--active {
            text-align: center;
            width: 100%;
            color: #00B4D8;
            border-bottom: 2px solid #00B4D8;
            padding: 10px;
        }

        .swal2-submit-btn {
            display: flex;
            justify-content: center;
            margin-top: 50px
        }

        ..swal2-close {
            color: #03045E
        }

        .swal2-submit-btn button {
            text-align: center;
            width: 50%;
            color: #000;
            background: #CAF0F8;
            padding: 10px;
        }

        .swal2-title {
            color: #03045E;
        }
         .accordion-active{
            color:#76E5A9;
         }
         @media(max-width:486px){
            .swal2-input{
                width: 100%;
                margin-left: 0px; 
            }
            .input__wrapper{
                overflow: hidden !important;
            }
         }
         @media(min-width:1000px){
            .display-lg-none{
                display: none;
            }
         }
         @media(max-width:1000px){
            .display-sm-none{
                display: none;
            }
         }
         @media(max-width:600px){
            .cart-mobile-set{
                margin-right: 10px;
                margin-top: 12px;
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
                <span data-translate="cart">
                    Cart
                </span>
            </div>
        </div>
    </div>

    <main>
        <section class="cart cartCheckout">
            <div class="container">
                <div class="cart__inner cartCheckout__inner">
                    <div class="cartCheckoutInner__content">
                        <h1 class="cartCheckout__title" data-translate="your_cart">
                            Your Cart
                        </h1>
                        <div class="cart__dscr" data-translate="not_ready_to_checkout">
                            Not ready to checkout? <a href="{{ url()->previous() }}" data-translate="add_to_cart">Continue Shopping</a>
                        </div>
                        <div class="cart__items">
                            @foreach ($cartItems as $cartItem)
                                <div class="cart__item" style="position: relative">
                                    <div class="cart__item-img">
                                        @if (!empty($cartItem->gallery_images) && isset($cartItem->gallery_images[0]))
                                            <img src="{{ asset('images/product_images/' . $cartItem->gallery_images[0]->images) }}"
                                                alt="">
                                        @endif
                                    </div>
                                    <div class="cart__item-content">
                                        <div class="cart__item-title">
                                            {{ $cartItem->product->name ?? $cartItem->name }}
                                        </div>
                                        <div style="position: absolute; top: 0; right: 3%;">
                                            <button onclick="confirmDelete('{{ $cartItem->id }}')"
                                                style="color: #42B9D9; font-weight: 700; font-size: 20px; background: none; border: none; cursor: pointer;">
                                                <i class="fa-solid fa-trash cart-mobile-set"></i>
                                            </button>
                                        </div>
                                        @foreach ($cartItem->product->reviews as $review)
                                            <div class="single__star">
                                                @for ($i = 1; $i <= 5; $i++)
                                                    @if ($i <= (int) $review->rating)
                                                        <span class="active"></span>
                                                    @else
                                                        <span></span>
                                                    @endif
                                                @endfor
                                                <div class="single__star-val">
                                                    {{ $review->rating }}
                                                </div>
                                            </div>
                                        @break
                                    @endforeach
                                    @if (($cartItem->product->availability ?? $cartItem->availability) == 'in-stock')
                                        <div class="single__cat">
                                            {{ str_replace('-', ' ', ucwords($cartItem->product->availability ?? $cartItem->availability)) }}
                                        </div>
                                    @elseif (($cartItem->product->availability ?? $cartItem->availability) == 'out-of-stock')
                                        <div class="single__cat">
                                            {{ str_replace('-', ' ', ucwords($cartItem->product->availability ?? $cartItem->availability)) }}
                                        </div>
                                    @else
                                        <div class="single__cat">
                                            {{ $cartItem->product->availability ?? $cartItem->availability }}</div>
                                    @endif
                                    @if ($cartItem->product->sale_price ?? $cartItem->sale_price)
                                        <div class="cart__item-price">
                                            {{ $cartItem->product->sale_price ?? $cartItem->sale_price }}
                                            <span data-translate="sar">SAR</span>
                                        </div>
                                    @else
                                        <div class="cart__item-price">
                                            {{ $cartItem->product->price ?? $cartItem->price }} <span data-translate="sar">SAR</span>
                                        </div>
                                    @endif
                                </div>
                                <div class="single__count">
                                    <button class="remove btnHover quantity-btn decrement-btn"
                                        data-id="{{ $cartItem->product_id }}"
                                        data-quantity="{{ $cartItem->quantity }}"></button>
                                    <input style="width: 15px" type="text"
                                        class="form-control text-center quantity-input"
                                        id="quantity-input-{{ $cartItem->product_id }}"
                                        value="{{ $cartItem->quantity }}" readonly min="1">
                                    <button class="add btnHover quantity-btn increment-btn"
                                        data-id="{{ $cartItem->product_id }}"
                                        data-quantity="{{ $cartItem->quantity }}"></button>
                                </div>
                            </div>
                        @endforeach
                    </div>
                    <div class="cart__info display-sm-none">
                        <div class="cart__info-title cartCheckout__title" data-translate="order_information">
                            Order Information
                        </div>
                        <div class="cart__info-item accordion-item">
                            <div class="cart__info-item-title accordion-item-title" data-translate="payment_policy">
                                Payment Policy
                            </div>
                            <div class="cart__info-item-body accordion-item-body" data-translate="we_provide_secure_and_multiple_method_of_payment">
                            We provide secure and multiple method of payments: VISA, MasterCard, Mada, cash on delivery, Bank Transfer for completing online orders. <a href="{{ route('payment.policy') }}" style="color:var(--colorBlue)" data-translate="read_more">read more</a>
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
                <div class="cartCheckout__order inputSWrap inputWhite">
                    <h4 class="cartCheckout__title" data-translate="order_summary">
                        Order Summary
                    </h4>
                    <input type="text" class="cartCheckout__order-coupon"
                        value="@if (isset($discount_coupon)) {{ $discount_coupon }} @endif" id="discount_coupon"
                        placeholder="Enter coupon code here" autocomplete="new-coupon">
                    <div class="cartCheckout__order-body">
                        <div class="cartCheckout__order-item">
                            <span data-translate="sub_total">
                            Subtotal (Excl. VAT)
                            </span>
                            <p id="subtotal">
                                {{ $subtotal }} <span data-translate="sar">SAR</span> 
                            </p>
                        </div>
                        <div class="cartCheckout__order-item">
                            <span data-translate="shipping">
                                Shipping
                            </span>
                            <p class="opacity" data-translate="calculated_at_the_next_step">
                                Calculated at the next step
                            </p>
                        </div>
                        <div id="discount-show" class="cartCheckout__order-item" style="display:none;">
                            <span data-translate="discount">Discount</span>
                            <p class="opacity" id="discount"></p>
                        </div>
                        <div class="cartCheckout__order-item">
                            <span data-translate="total_ex">
                            Total (Excl. VAT)
                            </span>
                            <p id="total">
                                {{ $total }} <span data-translate="sar">SAR</span> 
                            </p>
                        </div>
                        @if (empty($cartItems) || (isset($cartItems[0]->user_id) && strpos($cartItems[0]->user_id, 'user-') !== false))
                        <button class="cartCheckout__order-btn btnHover" id="checkoutBtn" data-translate="continue_to_checkout">
                                Continue to checkout
                            </button>
                        @else
                        <div class="catalog__nav-brand-item" style="margin-top:20px;">
                            <input type="checkbox" class="checkbox filter-checkbox" style="height:10px;width:10px;padding:11px 10px;" id="termsCheckbox">
                            <label id="termsLabel" style="font-weight:500;font-size:13px;margin-bottom:4px">
                                <p data-translate="are_you_agree_to_our">Are you agree to our <a href="{{ route('ecom.print.package') }}" style="color: #72e081; text-decoration: underline;" data-translate="print_package">Print Package?</a></p>
                            </label>
                        </div>
                            <button type="button" data-translate="continue_to_checkout" class="cartCheckout__order-btn btnHover" onclick="validateAndRedirect('{{ route('user.checkout', ['slug' => $slug]) }}')">
                                Continue to checkout
                            </button>
                        @endif
                    </div>
                </div>
            </div>
            <div class="cart__info display-lg-none" style="margin-top: 30px;">
                <div class="cart__info-title cartCheckout__title" data-translate="order_information">
                    Order Information
                </div>
                <div class="cart__info-item accordion-item">
                    <div class="cart__info-item-title accordion-item-title" data-translate="payment_policy">
                        Payment Policy
                    </div>
                    <div class="cart__info-item-body accordion-item-body" data-translate="we_provide_secure_and_multiple_method_of_payment">
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
                    In general, service is available five working days based on 8.5 hours. Unless additional service terms have been previously negotiated as part of the service agreement. For all the brands other than Konica Minolta and <a href="{{ route('service.policy') }}" style="color:var(--colorBlue)" data-translate="read_more">read more</a>
                    </div>
                </div>
            </div>
        </div>
    </section>
</main>

@endsection

<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/sweetalert2@11.0.18/dist/sweetalert2.min.css">
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11.0.18/dist/sweetalert2.all.min.js"></script>

<script>
    $(document).ready(function() {
        var timeoutId;
        $('#discount_coupon').change(function() {
            console.log('called');
            clearTimeout(timeoutId);
            var discount_coupon = $(this).val();
            console.log("-------", discount_coupon)
            var productId = $('.quantity-btn').data('id');
            console.log("-------Product ID -----", productId)
            if (productId === undefined || productId === '') {
                return false;
            }
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
                        total = response.total;
                        var newtotal = $('#subtotal').text();
                        discount_amount = response.discount;
                        $('#discount-show').show();
                        if (response.discount) {
                            $('#discount').text('- ' + discount_amount.toFixed(2) + ' SAR');
                            $('#total').text(total.toFixed(2) + ' SAR');
                        } else if (discount_coupon == '') {
                            $('#discount-show').hide();
                            $('#total').text(newtotal.toFixed(2));

                        } else {
                            $('#discount').text(response.message);
                            $('#total').text(newtotal.toFixed(2));
                        }
                    },
                    error: function(response) {
                    },
                });
            }, 1000);
        });

        $('.increment-btn, .decrement-btn').click(function() {
            var $quantityInput = $(this).siblings('.quantity-input');
            var currentQuantity = parseInt($quantityInput.val());
            var $decrementBtn = $(this).siblings('.decrement-btn');
            if ($(this).hasClass('increment-btn')) {
                var quantityproduct = $(this).data('quantity');
                var productId = $(this).data('id');
                var user_id = @json($user_id ?? null);
                var without_user_add_to_Cart = @json($without_user_add_to_Cart ?? null);

                var newQuantity = currentQuantity + 1;
                $('#quantity-input-' + productId).val(newQuantity);
                if (user_id) {
                    updateQuantityAjax(productId, user_id, newQuantity);
                } else {
                    updateQuantityAjax(productId, without_user_add_to_Cart, newQuantity);
                }
            } else if ($(this).hasClass('decrement-btn')) {
                var quantityproduct = $(this).data('quantity');
                var productId = $(this).data('id');
                var user_id = @json($user_id ?? null);
                var newQuantity = Math.max(currentQuantity - 1, 1);
                $decrementBtn.prop('disabled', newQuantity === 1);
                $('#quantity-input-' + productId).val(newQuantity);

                if (user_id) {
                    updateQuantityAjax(productId, user_id, newQuantity);
                } else {
                    updateQuantityAjax(productId, without_user_add_to_Cart, newQuantity);
                }
            }
        });

        function updateQuantityAjax(productId, user_id, newQuantity) {
            $.ajax({
                type: 'POST',
                url: "/cart/update",
                data: {
                    user_id: user_id,
                    productId: productId,
                    quantity: newQuantity,
                    _token: '{{ csrf_token() }}'
                },
                success: function(response) {
                    subtotal = response.subtotal;
                    total = response.total;
                    $('#subtotal').text(subtotal + ' SAR');
                    $('#total').text(total + ' SAR');
                    console.log(response);
                },
                error: function(data) {
                    console.log(data);
                },
            });
        }
    });
</script>
<script>
    function confirmDelete(cartItemId) {
        Swal.fire({
            title: 'Are you sure?',
            text: 'You won\'t be able to revert this!',
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#03045E',
            cancelButtonColor: '#FE0000',
            confirmButtonText: 'Yes, delete it!'
        }).then((result) => {
            if (result.isConfirmed) {
                window.location.href = '/cart/remove/' + cartItemId;
            }
        });
    }
</script>
<script>
    $(document).ready(function() {
        $('#checkoutBtn').click(function() {
            Swal.fire({
                title: 'Login or Sign Up',
                html: '<div class="swal2-tabs text-center">' +
                    '   <button id="loginTab" class="swal2-tab swal2-tab--active btn btn-primary">Login</button>' +
                    '   <button id="signupTab" class="swal2-tab btn btn-secondary">Sign Up</button>' +
                    '</div>' +
                    '<div id="loginContent" class="swal2-content input__wrapper">' +
                    '   <input type="email" id="loginUsername" class="swal2-input" placeholder="Username">' +
                    '   <input type="password" id="loginPassword" class="swal2-input" placeholder="Password">' +
                    '<div class="swal2-submit-btn"><button id="loginBtn" class="btn btn-primary ">Login</button></div>' +
                    '</div>' +
                    '<div id="signupContent" class="swal2-content input__wrapper" style="display: none;">' +
                    '   <input type="text" name="name" id="name" class="swal2-input" placeholder="Username">' +
                    '   <input type="email" name="email" id="email" class="swal2-input" placeholder="User Email">' +
                    '   <input type="password" name="password" id="password" class="swal2-input" placeholder="Password">' +
                    '   <input type="password" name="password_confirmation" id="c_password" class="swal2-input" placeholder="Confirm Password">' +
                    '   <div class="swal2-submit-btn"><button id="signupBtn" class="btn btn-secondary ">Sign Up</button></div>' +
                    '</div>',
                showCloseButton: true,
                showCancelButton: false,
                showConfirmButton: false,
            });
            $('#loginTab').click(function() {
                $('.swal2-tab').removeClass('swal2-tab--active');
                $(this).addClass('swal2-tab--active');
                $('#loginContent').show();
                $('#signupContent').hide();
            });
            $('#signupTab').click(function() {
                $('.swal2-tab').removeClass('swal2-tab--active');
                $(this).addClass('swal2-tab--active');
                $('#loginContent').hide();
                $('#signupContent').show();
            });
            $('#loginTab').trigger('click');
            $(document).on('click', '#loginBtn', function() {
                var email = $('#loginUsername').val();
                var password = $('#loginPassword').val();
                $.ajax({
                    type: 'POST',
                    url: '{{ route('checkout.signin') }}',
                    data: {
                        email: email,
                        password: password,
                        _token: '{{ csrf_token() }}'
                    },
                    success: function(response) {
                        console.log(response);
                        window.location.href = '{{ route('user.cart') }}';
                    },
                    error: function(response) {
                        console.log(response.responseText);
                    }
                });
            });

            $(document).on('click', '#signupBtn', function() {
                var name = $('#name').val();
                var email = $('#email').val();
                var password = $('#password').val();
                var password_confirmation = $('#c_password').val();
                $.ajax({
                    type: 'POST',
                    url: '{{ route('checkout.signup') }}',
                    data: {
                        name: name,
                        email: email,
                        password: password,
                        password_confirmation: password_confirmation,
                        _token: '{{ csrf_token() }}'
                    },
                    success: function(response) {
                        console.log(response);
                        window.location.href =
                            '{{ route('user.checkout', ['slug' => $slug]) }}';
                    },
                    error: function(response) {
                        console.log(response.responseText);
                    }
                });
            });
        });
    });
    function validateAndRedirect(redirectUrl) {
        var validationsCart = "{{count($cartItems)}}";
        console.log(validationsCart);
        if (validationsCart==0) {
            Swal.fire({
                title: 'Please add a product in the cart',
                icon: 'warning',
                showCancelButton: true,
                cancelButtonColor: '#FE0000',
                confirmButtonColor: '#03045E',
            });
            return false;
        }
        var checkbox = document.getElementById('termsCheckbox');
        var label = document.getElementById('termsLabel');
        if (checkbox && checkbox.checked) {
            window.location.href = redirectUrl;
        } else {
            label.style.color = 'red';
            checkbox.style.border = '0.1px solid red';
            checkbox.style.outline = '0.1px solid red';
            // alert('Please agree to the terms & conditions before proceeding to checkout.');
        }
    }

</script>


