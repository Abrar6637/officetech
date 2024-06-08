@extends('frontend.layout.main')
@section('title', 'Office Tech - Cart')
@section('main.container')
    <style>
        /* Custom style to center the modal */
        .modal-dialog {

            min-height: 100vh;
            margin-top: 160px;
        }
        .modal-dialog::before {
            content: "";
            position: fixed;
            top: 0;
            right: 0;
            bottom: 0;
            left: 0;
            background: inherit;
            backdrop-filter: blur(8px);
            /* Adjust the blur amount as needed */
            z-index: -1;
        }

        .sig .nav-link.active {
            border-bottom: 2px solid #da5858;
            border-right: 1px solid #e9e9e9;
            border-radius: 0px;
            background-color: white;
           
        }

        .sig .nav-link {
            background-color: white;
            color: black;
            border-top:none !important;
           
        }
     .mar{
        margin-top:3px !important;
     }
     .active{
        color:black !important;
     }
    </style>
    <main class="main margin">
        <div class="breadcrumb-container">
            <div class="container">
                <ul class="breadcrumb">
                    <li><a href="/">Home</a></li>
                    <li class="slash">/</li>
                    <li>Cart</li>
                </ul>
            </div>
        </div>
        <div class="container text-center mt-4 section-top">
            <div class="row gap-md-5">
                <div class="col-md-7 col-12 justify-content-center border bg-white text-start px-5 py-5 mb-5">
                    <h1 class="fw-bold">Your Cart</h1>
                    <p style="font-size:18px">Not ready to checkout? <a href="{{url()->previous()}}" style="color:#da5858;">Continue Shopping</a></p>
                    @foreach ($cartItems as $cartItem)
                        {{-- @dd($cartItem) --}}
                        <div class="row border-bottom pb-3 mb-3">
                            <div class="col-md-3 col-12 md-border rounded d-flex justify-content-center"
                                style="align-items: center">
                                @if (!empty($cartItem->gallery_images) && isset($cartItem->gallery_images[0]))
                                    <img src="{{ asset('images/product_images/' . $cartItem->gallery_images[0]->images) }}"
                                        class="object-fit-none" alt="" style="height: 100px; width: 100px">
                                @endif
                            </div>
                            <div class="col-md-9 col-12 pt-3">
                                <h1 class="heading"> {{ $cartItem->product->name }}</h1>
                                @foreach ($cartItem->product->reviews as $review)     
                                    <div class="product-review-rating">
                                        @for ($i = 1; $i <= 5; $i++)
                                            @if ($i <= (int) $review->rating)
                                                <svg xmlns="http://www.w3.org/2000/svg" width="9" height="9" viewBox="0 0 9 9" fill="none">
                                                    <g clip-path="url(#clip0_167_13789)">
                                                    <path d="M3.43246 2.028C3.90759 1.176 4.14496 0.75 4.50009 0.75C4.85521 0.75 5.09259 1.176 5.56771 2.028L5.69071 2.2485C5.82571 2.49075 5.89321 2.61187 5.99821 2.69175C6.10321 2.77163 6.23446 2.80125 6.49696 2.8605L6.73546 2.9145C7.65796 3.12337 8.11884 3.22763 8.22871 3.5805C8.33821 3.933 8.02396 4.30088 7.39509 5.03625L7.23234 5.22638C7.05384 5.43525 6.96421 5.53988 6.92409 5.66887C6.88396 5.79825 6.89746 5.93775 6.92446 6.21637L6.94921 6.47025C7.04409 7.45162 7.09171 7.94213 6.80446 8.16C6.51721 8.37825 6.08521 8.17912 5.22196 7.78162L4.99809 7.67887C4.75284 7.56562 4.63021 7.50937 4.50009 7.50937C4.36996 7.50937 4.24734 7.56562 4.00171 7.67887L3.77859 7.78162C2.91496 8.17912 2.48296 8.37787 2.19609 8.16037C1.90846 7.94212 1.95609 7.45162 2.05096 6.47025L2.07571 6.21675C2.10271 5.93775 2.11621 5.79825 2.07571 5.66925C2.03596 5.53988 1.94634 5.43525 1.76784 5.22675L1.60509 5.03625C0.976213 4.30125 0.661963 3.93338 0.771463 3.5805C0.881338 3.22763 1.34259 3.123 2.26509 2.9145L2.50359 2.8605C2.76571 2.80125 2.89659 2.77163 3.00196 2.69175C3.10696 2.61187 3.17446 2.49075 3.30946 2.2485L3.43246 2.028Z" fill="#FFDF00" stroke="#6D6D6D" stroke-width="0.8"/>
                                                    </g>
                                                    <defs>
                                                    <clipPath id="clip0_167_13789">
                                                    <rect width="9" height="9" fill="white"/>
                                                    </clipPath>
                                                    </defs>
                                                </svg>
                                                @else
                                                <svg xmlns="http://www.w3.org/2000/svg" width="9" height="9" viewBox="0 0 9 9" fill="none">
                                                    <g clip-path="url(#clip0_167_13797)">
                                                    <path d="M3.43246 2.028C3.90759 1.176 4.14496 0.75 4.50009 0.75C4.85521 0.75 5.09259 1.176 5.56771 2.028L5.69071 2.2485C5.82571 2.49075 5.89321 2.61187 5.99821 2.69175C6.10321 2.77162 6.23446 2.80125 6.49696 2.8605L6.73546 2.9145C7.65796 3.12337 8.11884 3.22763 8.22871 3.5805C8.33821 3.933 8.02396 4.30088 7.39509 5.03625L7.23234 5.22638C7.05384 5.43525 6.96421 5.53987 6.92409 5.66887C6.88396 5.79825 6.89746 5.93775 6.92446 6.21637L6.94921 6.47025C7.04409 7.45162 7.09171 7.94213 6.80446 8.16C6.51721 8.37825 6.08521 8.17912 5.22196 7.78162L4.99809 7.67887C4.75284 7.56562 4.63021 7.50937 4.50009 7.50937C4.36996 7.50937 4.24734 7.56562 4.00171 7.67887L3.77859 7.78162C2.91496 8.17912 2.48296 8.37787 2.19609 8.16037C1.90846 7.94212 1.95609 7.45162 2.05096 6.47025L2.07571 6.21675C2.10271 5.93775 2.11621 5.79825 2.07571 5.66925C2.03596 5.53988 1.94634 5.43525 1.76784 5.22675L1.60509 5.03625C0.976213 4.30125 0.661963 3.93338 0.771463 3.5805C0.881338 3.22763 1.34259 3.123 2.26509 2.9145L2.50359 2.8605C2.76571 2.80125 2.89659 2.77162 3.00196 2.69175C3.10696 2.61187 3.17446 2.49075 3.30946 2.2485L3.43246 2.028Z" stroke="#6D6D6D" stroke-width="0.8"/>
                                                    </g>
                                                    <defs>
                                                    <clipPath id="clip0_167_13797">
                                                    <rect width="9" height="9" fill="white"/>
                                                    </clipPath>
                                                    </defs>
                                                </svg>  
                                            @endif
                                        @endfor
                                        <sup class="product-review-rating-font">{{$review->rating}}</sup>
                                    </div>
                                    @break
                                @endforeach
                                @if ($cartItem->product->availability== 'in-stock')
                                <p class="tick text-success">{{ str_replace('-', ' ', ucwords($cartItem->product->availability)) }}</p>
                                @elseif ($cartItem->product->availability== 'out-of-stock')
                                <p class="text-danger">{{ str_replace('-', ' ', ucwords($cartItem->product->availability)) }}</p>
                                @else
                                <p class="tick text-success">{{$cartItem->product->availability}}</p>
                                @endif
                                <div class="d-flex justify-content-between mt-5">
                                    @if ($cartItem->product->sale_price)
                                        <h5 class="fw-bolder"><s class="text-muted">{{ $cartItem->product->price }}</s>  {{$cartItem->product->sale_price}} SAR</h5>
                                    @else
                                        <p class="fw-bolder" style="font-size: 22px">{{ $cartItem->product->price }} SAR</p>
                                    @endif
                                    <div class="input-group quantity-input-group delete_basket_postion">
                                        <a href="/cart/remove/{{ $cartItem->id }}"> <button
                                                onclick="return confirm('Are you sure you want to delete this cart items.');"
                                                class="remove_styling"><i
                                                    class="fa-solid fa-trash trash-button"></i></button>
                                    </div></a>
                                    <div class="input-group quantity-input-group">
                                        <button class="btn quantity-btn decrement-btn"
                                            data-id="{{ $cartItem->product->id }}"
                                            data-quantity="{{ $cartItem->product->quantity }}">-</button>
                                        <input type="text" class="form-control text-center quantity-input"
                                            id="quantity-input-{{ $cartItem->product->id }}"
                                            value="{{ $cartItem->quantity }}" readonly>
                                        <button class="btn quantity-btn increment-btn"
                                            data-id="{{ $cartItem->product->id }}"
                                            data-quantity="{{ $cartItem->product->quantity }}">+</button>
                                    </div>
                                </div>
                            </div>
                        </div>
                    @endforeach
                </div>
                <div class="col-md-4 col-12 ">
                    <div class="w-100 w-sm-75 px-3 px-sm-0">
                        <h1 class="text-start fw-bolder text-center text-sm-start">Order Summary</h1>
                        <input type="text" class="w-100 border-0 mt-3 mb-3 px-2 in"
                            value="@if (isset($discount_coupon)) {{ $discount_coupon }} @endif" id="discount_coupon"
                            style="height:30px" placeholder="Enter coupon code here" autocomplete="new-coupon">
                        <div class="d-flex justify-content-between">
                            <p>Subtotal</p>
                            <p id="subtotal">{{ $subtotal }} SAR</p>
                        </div>
                        <div class="d-flex justify-content-between">
                            <p>Shipping</p>
                            <p id="shipping">Calculated at the next step</p>
                        </div>
                        <div id="discount-show" style="display:none;">
                            <div class="d-flex justify-content-between">
                                <p>Discount</p>
                                <p id="discount"></p>
                            </div>
                        </div>
                        <hr>
                        <div class="d-flex justify-content-between">
                            <p>Total</p>
                            <p id="total">{{ $total }} SAR</p>
                        </div>
                        @if ($cartItems->isEmpty() || (isset($cartItems[0]->user_id) && strpos($cartItems[0]->user_id, 'user-') !== false))
                            <button class="arrow-white text-white w-100 btn-bg-color continue-text" data-bs-toggle="modal"
                                data-bs-target="#checkModal"
                                style="height: 37px; border-radius: 20px; border: none; margin-top: 10px;">Continue to
                                checkout
                            </button>
                        @else
                            <button class="arrow-white text-white w-100 btn-bg-color"
                                style="height: 37px; border-radius: 20px; border: none; margin-top: 10px;">
                                <a href="{{ $total ? route('user.checkout') : '#' }}" class="text-light">Continue to
                                    checkout</a>
                            </button>
                        @endif

                        {{-- <button class="arrow-white text-white w-100 btn-bg-color continue-text" data-bs-toggle="modal"
                            data-bs-target="#exampleModal"
                            style="height: 37px; border-radius: 20px; border: none; margin-top: 10px;">
                            <a class="text-light">Continue to checkout</a>
                        </button> --}}
                    </div>
                </div>
            </div>
            <div class="modal fade" id="checkModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                <div class="modal-dialog">
                    <div class="modal-content">
                        <div class="modal-header border-0">
                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                        </div>
                        <div class="  w-100 w-sm-50 mx-md-auto ">
                            <!-- Nav tabs -->
                            <ul class="nav nav-tabs sig mx-md-auto d-flex ">
                                <li class="nav-item flex-grow-1">
                                    <a class="nav-link @if (Session::get('error_message') == '') active @endif py-3 fw-bold text-black"
                                        style="font-size: 18px" data-bs-toggle="tab" href="#msg" id="sign-in">Sign
                                        In</a>
                                </li>
                                <li class="nav-item flex-grow-1">
                                    <a class="nav-link @if (Session::get('error_message') == '1') active @endif py-3 fw-bold text-black"
                                        style="font-size: 18px" data-bs-toggle="tab" href="#pro" id="sign-up">Sign
                                        Up</a>
                                </li>
                            </ul>
                            <!-- Tab panes -->
                            <div class="tab-content text-center mx-md-auto bg-white position-relative z-10">
                                <div class="tab-pane container @if (Session::get('error_message') == '') active @endif"
                                    id="msg">
                                    {{-- <form method="post" action="{{ url('/sign-in/form') }}"> --}}
                                    {{-- @csrf --}}
                                    <div class="d-flex flex-column w-75 mx-auto gap-3 py-4">
                                        <label for="" class="text-start" style="font-size: 18px" style="color:blue">Email
                                            Address</label>
                                        <input type="email" value="{{ old('email') }}" name='email'
                                            id="sign_in_email" class="in px-3"
                                            style="border:none; height: 30px; border-radius: 10px; background-color: #F3F6F8"
                                            required>
                                        <div class="d-flex justify-content-between pt-3">
                                            <label for="" style="font-size: 18px">Password</label>
                                            <a href="{{ route('user.forget_password') }}" style="font-size: 18px"
                                                class="in font-color">Forget Password ?</a>
                                        </div>
                                        <input type="password" class="px-3" name='password' id="sign_in_password"
                                            style="border:none; height: 30px; border-radius: 10px; background-color: #F3F6F8"
                                            required>
                                            <div class="text-danger" id="sign_in_error" role="alert"></div>
                                        <button class="arrow-white btn-bg-color text-white" id="sign_in_button"
                                            style="height: 37px; border-radius: 20px; border: none; margin-top: 10px">Sign
                                            In</button>
                                    </div>
                                    {{-- </form> --}}
                                </div>
                                <div class="tab-pane container fade  @if (Session::get('error_message') == '1') active show @endif"
                                    id="pro">
                                    {{-- <form method="post" action="{{ url('/sign-up/form') }}"> --}}
                                    {{-- @csrf --}}
                                    <div class="row px-2 my-3 pb-3 gy-3">
                                        <div class="col-6 d-flex flex-column">
                                        <label for="" class=" text-start" style="font-size: 18px">Name</label>
                                        <input type="text" id="name"
                                            class="@error('name') is-invalid @enderror px-3 in" name="name"
                                            value="{{ old('name') }}"
                                            style="border:none; height: 30px; border-radius: 10px; background-color: #F3F6F8">
                                        <div class="text-danger" id="error-name" role="alert"></div>
                                        </div>
                                        <div class="col-6 d-flex flex-column">
                                        <label for="" class="text-start" style="font-size: 18px">Email
                                            Address</label>
                                        <input type="email" class="@error('email') is-invalid @enderror px-3 in"
                                            name="email" id="email" value="{{ old('email') }}"
                                            style="border:none; height: 30px; border-radius: 10px; background-color: #F3F6F8">
                                        <div class="text-danger" id="error-email" role="alert"></div>
                                        </div>
                                        <div class="col-6 d-flex flex-column">

                                       
                                        <label for="" class="text-start" style="font-size: 18px">Password</label>
                                        <input type="password" id="password" placeholder="8+ character"
                                            class="password @error('password') is-invalid @enderror px-3 in" name="password"
                                            value="{{ old('password') }}"
                                            style="border:none; height: 30px; border-radius: 10px; background-color: #F3F6F8">
                                        <div class="text-danger" id="error-password" role="alert"></div>
                                        </div>
                                        <div class="col-6 d-flex flex-column">

                                        
                                        <label for="" class="text-start" style="font-size: 18px">Confirm
                                            Password</label>
                                        <input type="password" id="password_confirmation" placeholder="8+ character"
                                            class="@error('password_confirmation') is-invalid @enderror px-3 in"
                                            name="password_confirmation" value="{{ old('password_confirmation') }}"
                                            style="border:none; height: 30px; border-radius: 10px; background-color: #F3F6F8">
                                        <div class="text-danger" id="error-confirmation" role="alert"></div>
                                        </div>
                                        <div class="d-flex pt-3 gap-3 ">
                                            <input type="checkbox" name="my_checkbox" id="my_checkbox" class="checkbox mar"
                                                @if (old('my_checkbox')) checked @endif>
                                            <p class="text-start " style="font-size:16px">Are you agree to Clicon
                                                Terms of Condition and Privacy Policy.</p>
                                        </div>
                                        <button class="arrow-white btn-bg-color text-white" id="sign_up_button"
                                            style="height: 37px; border-radius: 20px; border: none; margin-top: 10px">Sign
                                            Up</button>
                                        {{-- </form> --}}
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>     
            </div>
    </main>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script>
        $(document).ready(function() {
            var timeoutId;
            $('#discount_coupon').on('keyup', function() {
                clearTimeout(timeoutId);
                var discount_coupon = $(this).val();
                var productId = $('.quantity-btn').data('id');
                // console.log(productId);
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
                            discount_coupon: discount_coupon
                        },
                        success: function(response) {
                            console.log(response);
                            total = response.total;
                            var newtotal = $('#subtotal').text();
                            discount_amount = response.discount;
                            $('#discount-show').show();
                            if (response.discount) {
                                $('#discount').text('- ' + discount_amount + ' SAR');
                                $('#total').text(total + ' SAR');
                            } else if (discount_coupon == '') {
                                $('#discount-show').hide();
                                $('#total').text(newtotal);

                            } else {
                                $('#discount').text(response.message);
                                $('#total').text(newtotal);
                            }
                        },
                        error: function(response) {
                            console.log(response);
                        },
                    });
                }, 1000);
            });

            $('.increment-btn, .decrement-btn').click(function() {
                var $quantityInput = $(this).siblings('.quantity-input');
                var currentQuantity = parseInt($quantityInput.val());

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
                    var newQuantity = currentQuantity - 1;
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
                        quantity: newQuantity
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
        $(document).ready(function() {
            $('#sign_up_button').click(function(e) {
                e.preventDefault();

                var name = $('#name').val();
                var email = $('#email').val();
                var password = $('#password').val();
                var password_confirmation = $('#password_confirmation').val();
                var my_checkbox = $('#my_checkbox').is(':checked');

                var data = {
                    _token: '{{ csrf_token() }}',
                    name: name,
                    email: email,
                    password: password,
                    password_confirmation: password_confirmation,
                    my_checkbox: my_checkbox,
                };

                $.ajax({
                    url: '{{ route('signup.ajax') }}',
                    method: 'POST',
                    data: data,
                    dataType: 'json',
                    success: function(data) {
                        console.log(data.status);
                        if (data.status == 'success') {
                            $('#checkModal').modal('hide');
                            window.location.href = ('/checkout');
                        }
                    },
                    error: function(xhr, status, error) {
                        console.error("AJAX Request Error:", status, error);
                        var JsonResponse = JSON.parse(xhr.responseText);

                        if (JsonResponse.errors) {
                            var nameError = JsonResponse.errors.name ? JsonResponse.errors.name[
                                0] : null;
                            var emailError = JsonResponse.errors.email ? JsonResponse.errors
                                .email[0] : null;
                            var passwordError = JsonResponse.errors.password ? JsonResponse
                                .errors.password[0] : null;
                            var passwordConfirmError = JsonResponse.errors
                                .password_confirmation ? JsonResponse.errors
                                .password_confirmation[0] : null

                            $('#error-name').text(nameError);

                            $('#error-email').text(emailError);

                            $('#error-password').text(passwordError);

                            $('#error-confirmation').text(passwordConfirmError);
                        }
                        console.log("Error Response Text:", xhr.responseText);
                    }
                });
            });
        });
    </script>
    <script>
        $(document).ready(function() {
            $('#sign_in_button').click(function(e) {
                e.preventDefault();
                var signInEmail = $('#sign_in_email').val();
                var signInPassword = $('#sign_in_password').val();

                var data = {
                    _token: '{{ csrf_token() }}',
                    email: signInEmail,
                    password: signInPassword,
                }
                $.ajax({
                    url: '/sign-in/ajax',
                    method: 'POST',
                    data: data,
                    dataType: 'json',
                    success: function(data) {
                        console.log(data);
                        window.location.href = ('/checkout');
                    },
                    error: function(xhr, status, error) {
                        console.log(xhr.responseText);
                        var jsonResponse = JSON.parse(xhr.responseText);
                        var errorMessage = jsonResponse.error;

                        console.log("Error Message:", errorMessage);
                        $('#sign_in_error').text(errorMessage);

                    }
                });
            })
        });
    </script>
@endsection