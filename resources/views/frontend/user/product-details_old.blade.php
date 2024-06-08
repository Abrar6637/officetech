@extends('frontend.layout.main')
@php
    $product_name = $product_details[0]->name;
@endphp
@section('title', '' . ucwords($product_name))
@section('main.container')
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <style>
        div:where(.swal2-container) button:where(.swal2-styled).swal2-default-outline:focus {
            box-shadow: 0 0 0 3px rgba(255, 255, 255, 0.5) !important;
        }

        div:where(.swal2-icon).swal2-info {
            border-color: rgb(218, 88, 88) !important;
            color: rgb(218, 88, 88) !important;
        }

        .product-detail-p {
            height: 153px;
        }

        .specification .table table {
            width: 100%;
        }

        .specification .table table tr {
            justify-content: space-around;
            height: 30px;
        }

        .specification .table table tr {
            border-bottom: 0px;
        }

        .odd-tr {
            background: #F3F3F3 !important;
            border-radius: 5px !important;
        }

        td {
            padding: 7px;
        }

        div:where(.swal2-icon).swal2-success .swal2-success-ring {
            border: 0.25rem solid #da5858 !important;
        }

        div:where(.swal2-icon).swal2-success [class^=swal2-success-line] {
            background-color: #da5858;
        }

        div:where(.swal2-container) button:where(.swal2-styled).swal2-default-outline:focus {
            box-shadow: 0 0 0 3px rgba(255, 255, 255, 0.911) !important;
        }
    </style>

    <main class="main margin">
        <div class="breadcrumb-container">
            <div class="container">
                <ul class="breadcrumb">
                    <li><a href="/">Home</a></li>
                    <li class="slash">/</li>
                    <li>Workstations</li>
                </ul>
            </div>
        </div>
        <div class="container mt-4 section-top">
            <div class="row">
                @foreach ($product_details as $product)
                    <div class="col-lg-6">
                        <div class="card">
                            {{-- <span class="position-absolute sale-badge product-details-sale-badge">Sale 25%</span> --}}
                            <div class="card-body text-center">
                                @if (count($product->gallery_images) > 0)
                                    <img src="{{ url('images/product_images/' . $product->gallery_images[0]->images) }}"
                                        id="main-image" style="width: 334px; height: 355px;object-fit:contain;">
                                @else
                                    <img src="{{ url('images/no-image.png') }}"
                                        style="width: 334px; height: 355px;object-fit:contain;">
                                @endif
                                <div class="mt-4">
                                    <div id="productImageSlider" class="carousel slide" data-bs-ride="carousel"
                                        data-bs-interval="false">
                                        <div
                                            class="carousel-inner carousel-inner-lg carousel-inner-sm-320 carousel-inner-sm-375 carousel-inner-sm-470">
                                            @php
                                                $imageCount = count($product->gallery_images);
                                            @endphp
                                            @foreach ($product->gallery_images as $index => $image)
                                                @if ($index % 4 === 0)
                                                    <div
                                                        class="carousel-item @if ($index === 0) active @endif">
                                                        <div class="d-flex gap-3">
                                                @endif
                                                <div class="carousel-item-image border-md"
                                                    style="height: 86px; width: 86px; display: flex; justify-content: center; align-items: center;">
                                                    <img src="{{ url('images/product_images/' . $image->images) }}"
                                                        alt="Product Image" onclick="change_image(this)"
                                                        style="height: 63px; width: 67px;">
                                                </div>
                                                @if ($index % 4 === 3 || $index === $imageCount - 1)
                                        </div>
                                    </div>
                @endif
                @endforeach
            </div>
            <script>
                function change_image(image) {
                    var container = document.getElementById("main-image");
                    container.src = image.src;
                }

                document.addEventListener("DOMContentLoaded", function(event) {});
            </script>
            <a class="carousel-control-prev carousel-inner-sm-indicator-left" href="#productImageSlider" role="button"
                data-bs-slide="prev">
                <span class="carousel-control-prev-icon" aria-hidden="true"
                    style="height: 19px;
                                        width: 8px;"></span>
                <span class="visually-hidden">Previous</span>
            </a>
            <a class="carousel-control-next carousel-inner-sm-indicator-right" href="#productImageSlider" role="button"
                data-bs-slide="next">
                <span class="carousel-control-next-icon" aria-hidden="true"
                    style="height: 19px;
                                        width: 8px;"></span>
                <span class="visually-hidden">Next</span>
            </a>
        </div>
        </div>
        </div>
        </div>
        </div>
        <div class="col-lg-6">
            <div class="card">
                <div class="container">
                    <div class="card-body">
                        @if ($product->availability == 'in-stock')
                            <p class="tick text-success">{{ str_replace('-', ' ', ucwords($product->availability)) }}</p>
                        @elseif ($product->availability == 'out-of-stock')
                            <p class="text-danger">{{ str_replace('-', ' ', ucwords($product->availability)) }}</p>
                        @else
                            <p class="tick text-success">{{ $product->availability }}</p>
                        @endif
                        <h1 class="product-detail-heading">{{ $product->name }}</h1>
                        <div class="product-review-rating product-review-rating-margin mb-2">
                            @php
                                $roundedAverage = round($averageRating);
                                $hasHalfStar = $averageRating - $roundedAverage === 0.5;
                            @endphp
                            @for ($i = 1; $i <= 5; $i++)
                                <svg xmlns="http://www.w3.org/2000/svg" width="9" height="9" viewBox="0 0 9 9"
                                    fill="none">
                                    <g clip-path="url(#clip0_167_13789)">
                                        <path
                                            d="M3.43246 2.028C3.90759 1.176 4.14496 0.75 4.50009 0.75C4.85521 0.75 5.09259 1.176 5.56771 2.028L5.69071 2.2485C5.82571 2.49075 5.89321 2.61187 5.99821 2.69175C6.10321 2.77163 6.23446 2.80125 6.49696 2.8605L6.73546 2.9145C7.65796 3.12337 8.11884 3.22763 8.22871 3.5805C8.33821 3.933 8.02396 4.30088 7.39509 5.03625L7.23234 5.22638C7.05384 5.43525 6.96421 5.53988 6.92409 5.66887C6.88396 5.79825 6.89746 5.93775 6.92446 6.21637L6.94921 6.47025C7.04409 7.45162 7.09171 7.94213 6.80446 8.16C6.51721 8.37825 6.08521 8.17912 5.22196 7.78162L4.99809 7.67887C4.75284 7.56562 4.63021 7.50937 4.50009 7.50937C4.36996 7.50937 4.24734 7.56562 4.00171 7.67887L3.77859 7.78162C2.91496 8.17912 2.48296 8.37787 2.19609 8.16037C1.90846 7.94212 1.95609 7.45162 2.05096 6.47025L2.07571 6.21675C2.10271 5.93775 2.11621 5.79825 2.07571 5.66925C2.03596 5.53988 1.94634 5.43525 1.76784 5.22675L1.60509 5.03625C0.976213 4.30125 0.661963 3.93338 0.771463 3.5805C0.881338 3.22763 1.34259 3.123 2.26509 2.9145L2.50359 2.8605C2.76571 2.80125 2.89659 2.77163 3.00196 2.69175C3.10696 2.61187 3.17446 2.49075 3.30946 2.2485L3.43246 2.028Z"
                                            fill="{{ $i <= $roundedAverage ? '#FFDF00' : 'none' }}" stroke="#6D6D6D"
                                            stroke-width="0.8" />
                                    </g>
                                    <defs>
                                        <clipPath id="clip0_167_13789">
                                            <rect width="9" height="9" fill="white" />
                                        </clipPath>
                                    </defs>
                                </svg>
                            @endfor
                            <sup class="product-review-rating-font">{{ number_format($averageRating, 1) }}</sup>
                        </div>
                        <div class="product-detail-p">
                            {!! $product->product_description !!}
                        </div>
                    </div>
                    <div class="card-footer pb-5 pb-md-0 quantity-cart-footer-div">
                        @if ($product->sale_price)
                            <h5 class="price"><s class="text-muted">{{ $product->price }}</s> {{ $product->sale_price }}
                                SAR</h5>
                        @else
                            <h5 class="price">{{ $product->price }} SAR</h5>
                        @endif
                        <div class="d-flex justify-content-between gap-3 gap-md-0 pb-4">
                            <div class="input-group quantity-input-group ">
                                <button class="btn quantity-btn decrement-btn" type="button" id="decrementBtn"
                                    data-id="{{ $product->id }}" data-quantity="{{ $product->quantity }}">-</button>
                                <input type="text" class="form-control text-center quantity-input" value="1"
                                    id="quantity" readonly>
                                <button class="btn quantity-btn increment-btn" type="button" id="incrementBtn"
                                    data-id="{{ $product->id }}" data-quantity="{{ $product->quantity }}">+</button>
                            </div>
                            <button data-id="{{ $product->id }}"
                                class="filter-sidebar-btn cart-btn btn-bg-color add-to-cart">Add To
                                Cart</button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        </div>
        <div class="row">
            <div class="col-lg-12">
                <div class="container my-5 w-100 w-md-50 mx-md-auto custom-content" style="margin-top: 10px;">
                    <!-- Nav tabs -->
                    <ul class="nav nav-tabs sig mx-md-auto d-flex ">
                        <li class="nav-item flex-grow-1">
                            <a class="nav-link active py-3 fw-bold text-black text-center" style="font-size: 18px"
                                data-bs-toggle="tab" href="#Specification">Specification</a>
                        </li>
                        <li class="nav-item flex-grow-1">
                            <a class="nav-link py-3 fw-bold text-black text-center" style="font-size: 18px"
                                data-bs-toggle="tab" href="#Reviews">Reviews</a>
                        </li>
                        <li class="nav-item flex-grow-1">
                            <a class="nav-link py-3 fw-bold text-black text-center" style="font-size: 18px"
                                data-bs-toggle="tab" href="#similar-tab">Similar products</a>
                        </li>
                    </ul>
                    <!-- Tab panes -->
                    <div class="tab-content text-center mx-md-auto bg-white">
                        <div class="tab-pane container active" id="Specification">
                            <div class="d-flex flex-column w-100 mx-auto gap-3 py-5 text-start" style="padding: 44px;">
                                <h1 class="review-tab-heading">Main Specification</h1>
                                <div class="specification">
                                    {!! $product->specifications !!}
                                </div>
                                <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
                                <script>
                                    $(document).ready(function() {
                                        $(".specification figure table tbody tr td:nth-child(2)").addClass("second-td");
                                        $(".specification figure table tbody tr:nth-child(odd)").addClass("odd-tr");
                                    });
                                </script>
                            </div>
                        </div>
                        <div class="tab-pane container" id="Reviews">
                            <div class="d-flex flex-column w-100 mx-auto gap-3  text-start">
                                <div class="specification">
                                    <div class="card ">
                                        <div class="card-body">
                                            <div class="d-flex flex-column mx-auto gap-3 py-4">
                                                <input type="hidden" name="" id="count_review"
                                                    value="{{ $reviews->count() }}">
                                                @foreach ($reviews->take(3) as $review_tab)
                                                    @if ($review_tab->count() > 0 && $review_tab->status == 1)
                                                        <div class="row mb-4">
                                                            <div class="col-lg-1">
                                                                <img src="{{ url('images/user/user-avatar.png') }}"
                                                                    style="height:40px; ">
                                                            </div>
                                                            <div class="col-lg-10" style="background: #F3F6F8;">
                                                                <div class="d-flex py-2">
                                                                    <p class="customer-review-name">
                                                                        {{ $review_tab->name }}</p>
                                                                    <div class="product-review-rating">
                                                                        @for ($i = 1; $i <= 5; $i++)
                                                                            @if ($i <= (int) $review_tab->rating)
                                                                                <svg xmlns="http://www.w3.org/2000/svg"
                                                                                    width="9" height="9"
                                                                                    viewBox="0 0 9 9" fill="none">
                                                                                    <g clip-path="url(#clip0_167_13789)">
                                                                                        <path
                                                                                            d="M3.43246 2.028C3.90759 1.176 4.14496 0.75 4.50009 0.75C4.85521 0.75 5.09259 1.176 5.56771 2.028L5.69071 2.2485C5.82571 2.49075 5.89321 2.61187 5.99821 2.69175C6.10321 2.77163 6.23446 2.80125 6.49696 2.8605L6.73546 2.9145C7.65796 3.12337 8.11884 3.22763 8.22871 3.5805C8.33821 3.933 8.02396 4.30088 7.39509 5.03625L7.23234 5.22638C7.05384 5.43525 6.96421 5.53988 6.92409 5.66887C6.88396 5.79825 6.89746 5.93775 6.92446 6.21637L6.94921 6.47025C7.04409 7.45162 7.09171 7.94213 6.80446 8.16C6.51721 8.37825 6.08521 8.17912 5.22196 7.78162L4.99809 7.67887C4.75284 7.56562 4.63021 7.50937 4.50009 7.50937C4.36996 7.50937 4.24734 7.56562 4.00171 7.67887L3.77859 7.78162C2.91496 8.17912 2.48296 8.37787 2.19609 8.16037C1.90846 7.94212 1.95609 7.45162 2.05096 6.47025L2.07571 6.21675C2.10271 5.93775 2.11621 5.79825 2.07571 5.66925C2.03596 5.53988 1.94634 5.43525 1.76784 5.22675L1.60509 5.03625C0.976213 4.30125 0.661963 3.93338 0.771463 3.5805C0.881338 3.22763 1.34259 3.123 2.26509 2.9145L2.50359 2.8605C2.76571 2.80125 2.89659 2.77163 3.00196 2.69175C3.10696 2.61187 3.17446 2.49075 3.30946 2.2485L3.43246 2.028Z"
                                                                                            fill="#FFDF00"
                                                                                            stroke="#6D6D6D"
                                                                                            stroke-width="0.8" />
                                                                                    </g>
                                                                                    <defs>
                                                                                        <clipPath id="clip0_167_13789">
                                                                                            <rect width="9"
                                                                                                height="9"
                                                                                                fill="white" />
                                                                                        </clipPath>
                                                                                    </defs>
                                                                                </svg>
                                                                            @else
                                                                                <svg xmlns="http://www.w3.org/2000/svg"
                                                                                    width="9" height="9"
                                                                                    viewBox="0 0 9 9" fill="none">
                                                                                    <g clip-path="url(#clip0_167_13797)">
                                                                                        <path
                                                                                            d="M3.43246 2.028C3.90759 1.176 4.14496 0.75 4.50009 0.75C4.85521 0.75 5.09259 1.176 5.56771 2.028L5.69071 2.2485C5.82571 2.49075 5.89321 2.61187 5.99821 2.69175C6.10321 2.77162 6.23446 2.80125 6.49696 2.8605L6.73546 2.9145C7.65796 3.12337 8.11884 3.22763 8.22871 3.5805C8.33821 3.933 8.02396 4.30088 7.39509 5.03625L7.23234 5.22638C7.05384 5.43525 6.96421 5.53987 6.92409 5.66887C6.88396 5.79825 6.89746 5.93775 6.92446 6.21637L6.94921 6.47025C7.04409 7.45162 7.09171 7.94213 6.80446 8.16C6.51721 8.37825 6.08521 8.17912 5.22196 7.78162L4.99809 7.67887C4.75284 7.56562 4.63021 7.50937 4.50009 7.50937C4.36996 7.50937 4.24734 7.56562 4.00171 7.67887L3.77859 7.78162C2.91496 8.17912 2.48296 8.37787 2.19609 8.16037C1.90846 7.94212 1.95609 7.45162 2.05096 6.47025L2.07571 6.21675C2.10271 5.93775 2.11621 5.79825 2.07571 5.66925C2.03596 5.53988 1.94634 5.43525 1.76784 5.22675L1.60509 5.03625C0.976213 4.30125 0.661963 3.93338 0.771463 3.5805C0.881338 3.22763 1.34259 3.123 2.26509 2.9145L2.50359 2.8605C2.76571 2.80125 2.89659 2.77162 3.00196 2.69175C3.10696 2.61187 3.17446 2.49075 3.30946 2.2485L3.43246 2.028Z"
                                                                                            stroke="#6D6D6D"
                                                                                            stroke-width="0.8" />
                                                                                    </g>
                                                                                    <defs>
                                                                                        <clipPath id="clip0_167_13797">
                                                                                            <rect width="9"
                                                                                                height="9"
                                                                                                fill="white" />
                                                                                        </clipPath>
                                                                                    </defs>
                                                                                </svg>
                                                                            @endif
                                                                        @endfor
                                                                        <sup
                                                                            class="product-review-rating-font">{{ $review_tab->rating }}</sup>
                                                                    </div>
                                                                </div>
                                                                <p class="customer-review-p">
                                                                    {{ $review_tab->review }}
                                                                </p>
                                                                <div class="d-flex align-items-start gap-3  mt-4">
                                                                    <svg width="13" height="13"
                                                                        viewBox="0 0 16 16" fill="none"
                                                                        xmlns="http://www.w3.org/2000/svg">
                                                                        <circle cx="8" cy="8" r="8"
                                                                            fill="#469F00"></circle>
                                                                        <rect x="7.33331" y="4" width="1.06667"
                                                                            height="8" fill="white"></rect>
                                                                        <rect x="4" y="8.40009" width="1.06667"
                                                                            height="8"
                                                                            transform="rotate(-90 4 8.40009)"
                                                                            fill="white"></rect>
                                                                    </svg>
                                                                    <div class="text-start">
                                                                        <h5 class="advantages-text">Advantages</h5>
                                                                        <p class="customer-review-p"
                                                                            style="margin-top: 0px;">
                                                                            {{ $review_tab->advantages }}
                                                                        </p>
                                                                    </div>
                                                                </div>
                                                                <div class="d-flex gap-3">
                                                                    <svg width="13" height="13"
                                                                        viewBox="0 0 16 16" fill="none"
                                                                        xmlns="http://www.w3.org/2000/svg">
                                                                        <circle cx="8" cy="8" r="8"
                                                                            fill="#9F0000"></circle>
                                                                        <rect x="4" y="8.40033" width="1.06667"
                                                                            height="8"
                                                                            transform="rotate(-90 4 8.40033)"
                                                                            fill="white"></rect>

                                                                    </svg>
                                                                    <div class="text-start">
                                                                        <h5 class="advantages-text">Flaws</h5>
                                                                        <p class="customer-review-p"
                                                                            style="margin-top: 0px;">
                                                                            {{ $review_tab->flaws }}
                                                                        </p>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    @endif
                                                @endforeach
                                                @if ($reviews->count() <= 1)
                                                    <div class="d-flex justify-content-center">
                                                        <h4 class="no-reviews-heading">No Reviews</h4>
                                                    </div>
                                                @endif

                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
                            </div>
                        </div>
                        <div class="tab-pane container" id="similar-tab">
                            <div class="d-flex flex-column w-100 mx-auto gap-3 py-5" style="padding: 44px;">
                                <div class="specification">
                                    <div class="row">
                                        @foreach ($related_products->take(6) as $related_product)
                                            <div class="col-md-6 col-lg-4 col-12 product-card">
                                                <a href="{{ route('user.product_details', $related_product->slug) }}"
                                                    class="text-decoration-none font-color-black" style="color: inherit">
                                                    <div class="card mt-4"
                                                        style="border: 1px solid rgba(0, 0, 0, 0.175);border-radius:9px;">
                                                        <div class="card-body">
                                                            @if (count($related_product->gallery_images) > 0)
                                                                <img src="{{ url('images/product_images/' . $related_product->gallery_images[0]->images) }}"
                                                                    class="py-3" alt="{{ $related_product->name }}"
                                                                    style="height: 222px !important; width:209px !important; object-fit:contain !important;">
                                                            @else
                                                                <img src="{{ url('images/no-image.png') }}"
                                                                    style="height: 222px !important; width:209px !important; object-fit:contain !important;">
                                                            @endif
                                                            <div class="text-start">
                                                                <p class="text-muted">{{ $related_product->sku }}</p>
                                                                <h5 class="fw-bolder text-dark">
                                                                    {{ $related_product->name }}</h5>
                                                                @if ($related_product->availability == 'in-stock')
                                                                    <p class="tick text-success">
                                                                        {{ str_replace('-', ' ', ucwords($related_product->availability)) }}
                                                                    </p>
                                                                @elseif ($related_product->availability == 'out-of-stock')
                                                                    <p class="text-danger">
                                                                        {{ str_replace('-', ' ', ucwords($related_product->availability)) }}
                                                                    </p>
                                                                @endif
                                                            </div>
                                                        </div>
                                                        <div class="card-footer bg-transparent border-top-0">
                                                            <div class="d-flex justify-content-between">
                                                                <h5 class="fw-bold text-dark">
                                                                    {{ $related_product->price }} SAR</h5>
                                                                <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
                                                                <a id="add-tocart" data-id="{{ $related_product->id }}"
                                                                    class="arrow fw-bold clr add-to-cart">Add
                                                                    to cart</a>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </a>
                                            </div>
                                        @endforeach
                                    </div>
                                </div>
                                <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            @endforeach
            <!-- Compatible Products Section  -->
            {{-- <section class="compatible-products">
                <h1 class="review-tab-heading">Compatible Products</h1>
                <div class="row">
                    <div class="col-md-12">
                        <div class="lc-block">
                            <div id="carouselLogos" class="carousel slide pt-5 pb-4 pointer-event" data-bs-ride="carousel">
                                <div class="carousel-inner ">
                                    <div class="carousel-item active active-color">
                                        <div class="row">
                                            <div class="col-md-6 col-lg-4 col-12">
                                                <div class="card mt-2">
                                                    <div class="card-body">
                                                        <img src="{{url('images/lp24.png')}}" class="py-3" width="150px" height="110px" alt="">
                                                        <div class="text-start ">
                                                            <p>RM32141566737</p>
                                                            <h5 class="fw-bolder">Printer Epson L805 Black</h5>
                                                            <p class="tick text-success">In stock</p>
                                                        </div>
                                                    </div>
                                                    <div class="card-footer bg-transparent border-top-0">
                                                        <div class="d-flex justify-content-between ">
                                                            <h5 class="fw-bold">1 500 SAR</h5>
                                                            <p class="arrow fw-bold text-info font-color">Add to cart
                                                            </p>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-md-6 col-lg-4 col-12">
                                                <div class="card mt-2">
                                                    <div class="card-body">
                                                        <img src="{{url('images/lp24.png')}}" class="py-3" width="150px" height="110px" alt="">
                                                        <div class="text-start ">
                                                            <p>RM32141566737</p>
                                                            <h5 class="fw-bolder">Printer Epson L805 Black</h5>
                                                            <p class="tick text-success">In stock</p>
                                                        </div>
                                                    </div>
                                                    <div class="card-footer bg-transparent border-top-0">
                                                        <div class="d-flex justify-content-between ">
                                                            <h5 class="fw-bold">1 500 SAR</h5>
                                                            <p class="arrow fw-bold text-info font-color ">Add to cart
                                                            </p>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-md-6 col-lg-4 col-12">
                                                <div class="card mt-2">
                                                    <div class="card-body">
                                                        <img src="{{url('images/lp24.png')}}" class="py-3" width="150px" height="110px" alt="">
                                                        <div class="text-start ">
                                                            <p>RM32141566737</p>
                                                            <h5 class="fw-bolder">Printer Epson L805 Black</h5>
                                                            <p class="tick text-success">In stock</p>
                                                        </div>
                                                    </div>
                                                    <div class="card-footer bg-transparent border-top-0">
                                                        <div class="d-flex justify-content-between ">
                                                            <h5 class="fw-bold">1 500 SAR</h5>
                                                            <p class="arrow fw-bold text-info font-color">Add to cart
                                                            </p>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="carousel-item active-color">
                                        <div class="row">
                                            <div class="col-md-6 col-lg-4 col-12">
                                                <div class="card mt-2">
                                                    <div class="card-body">
                                                        <img src="{{url('images/lp24.png')}}" class="py-3" width="150px" height="110px" alt="">
                                                        <div class="text-start ">
                                                            <p>RM32141566737</p>
                                                            <h5 class="fw-bolder">Printer Epson L805 Black</h5>
                                                            <p class="tick text-success">In stock</p>
                                                        </div>
                                                    </div>
                                                    <div class="card-footer bg-transparent border-top-0">
                                                        <div class="d-flex justify-content-between ">
                                                            <h5 class="fw-bold">1 500 SAR</h5>
                                                            <p class="arrow fw-bold text-info font-color">Add to cart
                                                            </p>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-md-6 col-lg-4 col-12">
                                                <div class="card mt-2">
                                                    <div class="card-body">
                                                        <img src="{{url('images/lp24.png')}}" class="py-3" width="150px" height="110px" alt="">
                                                        <div class="text-start ">
                                                            <p>RM32141566737</p>
                                                            <h5 class="fw-bolder">Printer Epson L805 Black</h5>
                                                            <p class="tick text-success">In stock</p>
                                                        </div>
                                                    </div>
                                                    <div class="card-footer bg-transparent border-top-0">
                                                        <div class="d-flex justify-content-between ">
                                                            <h5 class="fw-bold">1 500 SAR</h5>
                                                            <p class="arrow fw-bold text-info font-color">Add to cart
                                                            </p>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-md-6 col-lg-4 col-12">
                                                <div class="card mt-2">
                                                    <div class="card-body">
                                                        <img src="{{url('images/lp24.png')}}" class="py-3" width="150px" height="110px" alt="">
                                                        <div class="text-start ">
                                                            <p>RM32141566737</p>
                                                            <h5 class="fw-bolder">Printer Epson L805 Black</h5>
                                                            <p class="tick text-success">In stock</p>
                                                        </div>
                                                    </div>
                                                    <div class="card-footer bg-transparent border-top-0">
                                                        <div class="d-flex justify-content-between ">
                                                            <h5 class="fw-bold">1 500 SAR</h5>
                                                            <p class="arrow fw-bold text-info font-color ">Add to cart
                                                            </p>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <center>
                                    <ol class="carousel-indicators position-relative main-index-secondcaresoul-indicators">
                                        <li data-bs-target="#carouselLogos" data-bs-slide-to="0" class=""></li>
                                        <li data-bs-target="#carouselLogos" data-bs-slide-to="1" class="active" aria-current="true"></li>
                                    </ol>
                                </center>
                            </div>
                        </div>
                        <!-- /lc-block -->
                    </div>
                    <!-- /col -->
                </div>
            </section> --}}
            <section class="review-about-product">
                <div class="card">
                    <div class="card-body">
                        <div class="d-flex flex-column w-75 mx-auto gap-3 py-4">
                            <div class="row">
                                <div class="col-lg-12">
                                    @foreach ($product_details as $product)
                                        <h1 class="review-tab-heading">Reviews about
                                            {{ $product->name }}
                                        </h1>
                                    @endforeach
                                </div>
                            </div>
                            <input type="hidden" name="" id="count_review" value="{{ $reviews->count() }}">
                            @foreach ($reviews as $review)
                                @if ($review->count() > 0 && $review->status == 1)
                                    <div class="row load-more-reviews">
                                        <div class="col-lg-1">
                                            <img src="{{ url('images/user/user-avatar.png') }}" style="height:40px">
                                        </div>
                                        <div class="col-lg-10" style="background: #F3F6F8;">
                                            <div class="d-flex py-2">
                                                <p class="customer-review-name">{{ $review->name }}</p>
                                                <div class="product-review-rating">
                                                    @for ($i = 1; $i <= 5; $i++)
                                                        @if ($i <= (int) $review->rating)
                                                            <svg xmlns="http://www.w3.org/2000/svg" width="9"
                                                                height="9" viewBox="0 0 9 9" fill="none">
                                                                <g clip-path="url(#clip0_167_13789)">
                                                                    <path
                                                                        d="M3.43246 2.028C3.90759 1.176 4.14496 0.75 4.50009 0.75C4.85521 0.75 5.09259 1.176 5.56771 2.028L5.69071 2.2485C5.82571 2.49075 5.89321 2.61187 5.99821 2.69175C6.10321 2.77163 6.23446 2.80125 6.49696 2.8605L6.73546 2.9145C7.65796 3.12337 8.11884 3.22763 8.22871 3.5805C8.33821 3.933 8.02396 4.30088 7.39509 5.03625L7.23234 5.22638C7.05384 5.43525 6.96421 5.53988 6.92409 5.66887C6.88396 5.79825 6.89746 5.93775 6.92446 6.21637L6.94921 6.47025C7.04409 7.45162 7.09171 7.94213 6.80446 8.16C6.51721 8.37825 6.08521 8.17912 5.22196 7.78162L4.99809 7.67887C4.75284 7.56562 4.63021 7.50937 4.50009 7.50937C4.36996 7.50937 4.24734 7.56562 4.00171 7.67887L3.77859 7.78162C2.91496 8.17912 2.48296 8.37787 2.19609 8.16037C1.90846 7.94212 1.95609 7.45162 2.05096 6.47025L2.07571 6.21675C2.10271 5.93775 2.11621 5.79825 2.07571 5.66925C2.03596 5.53988 1.94634 5.43525 1.76784 5.22675L1.60509 5.03625C0.976213 4.30125 0.661963 3.93338 0.771463 3.5805C0.881338 3.22763 1.34259 3.123 2.26509 2.9145L2.50359 2.8605C2.76571 2.80125 2.89659 2.77163 3.00196 2.69175C3.10696 2.61187 3.17446 2.49075 3.30946 2.2485L3.43246 2.028Z"
                                                                        fill="#FFDF00" stroke="#6D6D6D"
                                                                        stroke-width="0.8" />
                                                                </g>
                                                                <defs>
                                                                    <clipPath id="clip0_167_13789">
                                                                        <rect width="9" height="9"
                                                                            fill="white" />
                                                                    </clipPath>
                                                                </defs>
                                                            </svg>
                                                        @else
                                                            <svg xmlns="http://www.w3.org/2000/svg" width="9"
                                                                height="9" viewBox="0 0 9 9" fill="none">
                                                                <g clip-path="url(#clip0_167_13797)">
                                                                    <path
                                                                        d="M3.43246 2.028C3.90759 1.176 4.14496 0.75 4.50009 0.75C4.85521 0.75 5.09259 1.176 5.56771 2.028L5.69071 2.2485C5.82571 2.49075 5.89321 2.61187 5.99821 2.69175C6.10321 2.77162 6.23446 2.80125 6.49696 2.8605L6.73546 2.9145C7.65796 3.12337 8.11884 3.22763 8.22871 3.5805C8.33821 3.933 8.02396 4.30088 7.39509 5.03625L7.23234 5.22638C7.05384 5.43525 6.96421 5.53987 6.92409 5.66887C6.88396 5.79825 6.89746 5.93775 6.92446 6.21637L6.94921 6.47025C7.04409 7.45162 7.09171 7.94213 6.80446 8.16C6.51721 8.37825 6.08521 8.17912 5.22196 7.78162L4.99809 7.67887C4.75284 7.56562 4.63021 7.50937 4.50009 7.50937C4.36996 7.50937 4.24734 7.56562 4.00171 7.67887L3.77859 7.78162C2.91496 8.17912 2.48296 8.37787 2.19609 8.16037C1.90846 7.94212 1.95609 7.45162 2.05096 6.47025L2.07571 6.21675C2.10271 5.93775 2.11621 5.79825 2.07571 5.66925C2.03596 5.53988 1.94634 5.43525 1.76784 5.22675L1.60509 5.03625C0.976213 4.30125 0.661963 3.93338 0.771463 3.5805C0.881338 3.22763 1.34259 3.123 2.26509 2.9145L2.50359 2.8605C2.76571 2.80125 2.89659 2.77162 3.00196 2.69175C3.10696 2.61187 3.17446 2.49075 3.30946 2.2485L3.43246 2.028Z"
                                                                        stroke="#6D6D6D" stroke-width="0.8" />
                                                                </g>
                                                                <defs>
                                                                    <clipPath id="clip0_167_13797">
                                                                        <rect width="9" height="9"
                                                                            fill="white" />
                                                                    </clipPath>
                                                                </defs>
                                                            </svg>
                                                        @endif
                                                    @endfor
                                                    <sup class="product-review-rating-font">{{ $review->rating }}</sup>
                                                </div>
                                            </div>
                                            <p class="customer-review-p">
                                                {{ $review->review }}
                                            </p>
                                            <div class="d-flex align-items-start gap-3  mt-4">
                                                <svg width="13" height="13" viewBox="0 0 16 16" fill="none"
                                                    xmlns="http://www.w3.org/2000/svg">
                                                    <circle cx="8" cy="8" r="8" fill="#469F00"></circle>
                                                    <rect x="7.33331" y="4" width="1.06667" height="8"
                                                        fill="white"></rect>
                                                    <rect x="4" y="8.40009" width="1.06667" height="8"
                                                        transform="rotate(-90 4 8.40009)" fill="white"></rect>
                                                </svg>
                                                <div class="text-start">
                                                    <h5 class="advantages-text">Advantages</h5>
                                                    <p class="customer-review-p" style="margin-top: 0px;">
                                                        {{ $review->advantages }}
                                                    </p>
                                                </div>
                                            </div>
                                            <div class="d-flex gap-3">
                                                <svg width="13" height="13" viewBox="0 0 16 16" fill="none"
                                                    xmlns="http://www.w3.org/2000/svg">
                                                    <circle cx="8" cy="8" r="8" fill="#9F0000"></circle>
                                                    <rect x="4" y="8.40033" width="1.06667" height="8"
                                                        transform="rotate(-90 4 8.40033)" fill="white"></rect>
                                                </svg>
                                                <div class="text-start">
                                                    <h5 class="advantages-text">Flaws</h5>
                                                    <p class="customer-review-p" style="margin-top: 0px;">
                                                        {{ $review->flaws }}
                                                    </p>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                @endif
                            @endforeach
                            @if ($reviews->count() > 2)
                                <div class="d-flex justify-content-center">
                                    <button class="btn btn-primary rounded-1 load-more-btn" id="loadMoreBtn"
                                        data-page="2">Show more</button>
                                </div>
                            @elseif ($reviews->count() < 0)
                                <div class="d-flex justify-content-center">
                                    <h4 class="no-reviews-heading">No Reviews</h4>
                                </div>
                            @endif
                        </div>
                    </div>
                </div>
            </section>
            @if (Session::get('user_name'))
                <section class="review-about-product">
                    <div class="card">
                        <div class="card-body">
                            <div class="d-flex flex-column w-75 mx-auto gap-3 py-5">
                                <div class="row">
                                    <div class="col-lg-12">
                                        <h1 class="review-tab-heading">What a review</h1>
                                        @if (session('success'))
                                            <div class="alert alert-success">
                                                {{ session('success') }}
                                            </div>
                                        @endif
                                        @if (session('error'))
                                            <div class="alert alert-danger">
                                                {{ session('error') }}
                                            </div>
                                        @endif
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-lg-12">
                                        <form action="{{ route('product.reviews') }}">
                                            @csrf
                                            <p class="mymark-text mb-0">My mark</p>
                                            <div class="rating">
                                                <label>
                                                    <input type="radio" value="1" />
                                                    <span class="icon">★</span>
                                                </label>
                                                <label>
                                                    <input type="radio" value="2" />
                                                    <span class="icon">★</span>
                                                    <span class="icon">★</span>
                                                </label>
                                                <label>
                                                    <input type="radio" value="3" />
                                                    <span class="icon">★</span>
                                                    <span class="icon">★</span>
                                                    <span class="icon">★</span>
                                                </label>
                                                <label>
                                                    <input type="radio" value="4" />
                                                    <span class="icon">★</span>
                                                    <span class="icon">★</span>
                                                    <span class="icon">★</span>
                                                    <span class="icon">★</span>
                                                </label>
                                                <label>
                                                    <input type="radio" value="5" />
                                                    <span class="icon">★</span>
                                                    <span class="icon">★</span>
                                                    <span class="icon">★</span>
                                                    <span class="icon">★</span>
                                                    <span class="icon">★</span>
                                                </label>
                                            </div>
                                            <input type="hidden" id="star" name="star" />
                                            <input type="hidden" name="user_id" value="{{ Session::get('user_id') }}">
                                            <input type="hidden" name="product_id" value="{{ $product->id }}">
                                            <script>
                                                $(':radio').change(function() {
                                                    var ratingStarValue = this.value;
                                                    $('#star').val(ratingStarValue);
                                                });
                                            </script>
                                            <div class="row">
                                                <div class="col-lg-6">
                                                    <p class="review-text-p">Review</p>
                                                    <textarea id="" cols="60" rows="8" class="review-textarea w-100" placeholder="Text"
                                                        name="review"></textarea>
                                                    <div class="mb-3">
                                                        <label for="exampleFormControlInput1"
                                                            class="form-label input-field-label">Name</label>
                                                        <input type="text" class="form-control input-field-name"
                                                            id="exampleFormControlInput1" placeholder="Name"
                                                            name="name" value="{{ Session::get('user_name') }}"
                                                            readonly>
                                                    </div>
                                                </div>
                                                <div class="col-lg-6">
                                                    <div class="mb-3">
                                                        <label for="exampleFormControlInput1"
                                                            class="form-label input-field-label">Advantages and
                                                            flaws</label>
                                                        <div class="input-field-wrapper">
                                                            <input type="text"
                                                                class="form-control input-field-name input-field-advantage"
                                                                id="exampleFormControlInput1" placeholder="Advantages"
                                                                name="advantages">
                                                        </div>
                                                    </div>
                                                    <div class="mb-3">
                                                        <div class="input-field-wrapper">
                                                            <input type="text"
                                                                class="form-control input-field-name input-field-disadvantage"
                                                                id="exampleFormControlInput1" placeholder="Flaws"
                                                                name="disadvantage">
                                                        </div>
                                                    </div>
                                                    <div class="mb-3" style="margin-top: 78px;">
                                                        <label for="exampleFormControlInput1"
                                                            class="form-label input-field-label">Email</label>
                                                        <input type="email" class="form-control input-field-name"
                                                            id="exampleFormControlInput1" placeholder="example@gmail.com"
                                                            name="email" value="{{ Session::get('user_email') }}"
                                                            readonly>
                                                    </div>
                                                </div>
                                                <button class="arrow-white btn-bg-color text-white"
                                                    style="height:37px ; border-radius:20px; width:147px; border:none;  margin-top:10px">Submit</button>
                                            </div>
                                        </form>
                                    </div>
                                </div>
                            </div>
                        </div>
                </section>
            @endif
            <br><br>
        </div>
    </main>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/sweetalert2@11.0.18/dist/sweetalert2.min.css">
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11.0.18/dist/sweetalert2.all.min.js"></script>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script>
        $(document).ready(function() {
            $(".load-more-reviews:gt(1)").hide();
            $("#loadMoreBtn").click(function(e) {
                e.preventDefault();
                $(".load-more-reviews:hidden:lt(2)").fadeIn("slow");

                if ($(".load-more-reviews:hidden").length === 0) {
                    $("#loadMoreBtn").fadeOut("slow");
                }
            });
        });
    </script>

    <script>
        setTimeout(function() {
            $('.alert-success').fadeOut('fast');
        }, 5000);
    </script>
    <script>
        $(document).ready(function() {
            $('#userDropdown2').click(function(event) {
                event.stopPropagation();
                $('#user_Dropdown2').addClass('show').css({
                    'position': 'absolute',
                    'inset': '0px auto auto 0px',
                    'margin': '0px',
                    'transform': 'translate(-135px, 23px)',
                });
                $('#user_Dropdown').removeClass('show');
            });

            $('#userDropdown').click(function(event) {
                event.stopPropagation();
                $('#user_Dropdown').addClass('show');
                $('#user_Dropdown2').removeClass('show');
            });

            $(document).click(function(event) {
                if (!$(event.target).closest('#userDropdown2').length && !$(event.target).closest(
                        '#user_Dropdown2').length) {
                    $('#user_Dropdown2').removeClass('show');
                }
                if (!$(event.target).closest('#userDropdown').length && !$(event.target).closest(
                        '#user_Dropdown').length) {
                    $('#user_Dropdown').removeClass('show');
                }
            });

            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });

            $(".add-to-cart").click(function() {
                var user_id = @json($user_id[0] ?? null);
                var productId = $(this).data('id');
                var quantity = 1;
                if (user_id) {
                    hit_ajax(productId, user_id, quantity)
                } else {
                    var without_user_add_to_Cart = @json($without_user_add_to_Cart ?? null);
                    hit_ajax(productId, without_user_add_to_Cart, quantity)
                }

                function hit_ajax(productId, user_id, quantity) {
                    $.ajax({
                        type: 'POST',
                        url: "/cart/add",
                        data: {
                            user_id: user_id,
                            productId: productId,
                            quantity: quantity
                        },

                        success: function(response) {
                            console.log(response);
                            if (response.success) {
                                var cartCount = parseInt($("#cart-badge").text(), 10);
                                cartCount += 1;
                                $("#cart-badge").text(cartCount);
                                Swal.fire({
                                    title: 'Success!',
                                    text: 'Product added to cart!',
                                    icon: 'success',
                                    iconColor: '#da5858',
                                    confirmButtonColor: '#da5858',
                                    confirmButtonText: 'OK'
                                });
                            }
                        },
                        error: function(data) {
                            console.log(data);
                        },
                    });
                }
            });
        });

        $(document).ready(function() {
            $('.increment-btn, .decrement-btn').click(function() {
                var user_id = @json($user_id ?? null);
                var without_user_add_to_Cart = @json($without_user_add_to_Cart ?? null);
                var $quantityInput = $(this).siblings('.quantity-input');
                var currentQuantity = parseInt($quantityInput.val());
                if ($(this).hasClass('increment-btn')) {
                    var quantityproduct = $(this).data('quantity');
                    var productId = $(this).data('id');
                    if (currentQuantity < quantityproduct) {
                        var currentQuantity = currentQuantity + 1;
                        $('.quantity-input').val(currentQuantity);
                        if (user_id) {
                            increment_ajax(productId, user_id, quantity)
                        } else {
                            increment_ajax(productId, without_user_add_to_Cart, quantity)
                        }

                        function increment_ajax(productId, user_id, quantity) {
                            $.ajax({
                                type: 'POST',
                                url: "/cart/update",
                                data: {
                                    user_id: user_id,
                                    productId: productId,
                                    quantity: currentQuantity
                                },
                                success: function(response) {
                                    console.log(response);
                                },
                                error: function(data) {
                                    console.log(data);
                                },
                            });
                        }
                    } else {
                        alert('Cannot exceed the available quantity.');
                        return false;
                    }
                } else if ($(this).hasClass('decrement-btn')) {
                    var quantityproduct = $(this).data('quantity');
                    var productId = $(this).data('id');
                    var currentQuantity = currentQuantity - 1;
                    $('.quantity-input').val(currentQuantity);
                    if (user_id) {
                        decrement_ajax(productId, user_id, quantity)
                    } else {
                        decrement_ajax(productId, without_user_add_to_Cart, quantity)
                    }

                    function decrement_ajax(productId, user_id, quantity) {
                        $.ajax({
                            type: 'POST',
                            url: "/cart/update",
                            data: {
                                user_id: user_id,
                                productId: productId,
                                quantity: currentQuantity
                            },
                            success: function(response) {
                                console.log(response);
                            },
                            error: function(data) {
                                console.log(data);
                            },
                        });
                    }
                }

            });
        });

        function controlFromInput(fromSlider, fromInput, toInput, controlSlider) {
            const [from, to] = getParsed(fromInput, toInput);
            fillSlider(fromInput, toInput, '#C6C6C6', '#25daa5', controlSlider);
            if (from > to) {
                fromSlider.value = to;
                fromInput.value = to;
            } else {
                fromSlider.value = from;
            }
        }

        function controlToInput(toSlider, fromInput, toInput, controlSlider) {
            const [from, to] = getParsed(fromInput, toInput);
            fillSlider(fromInput, toInput, '#C6C6C6', '#00A9E1', controlSlider);
            setToggleAccessible(toInput);
            if (from <= to) {
                toSlider.value = to;
                toInput.value = to;
            } else {
                toInput.value = from;
            }
        }

        function controlFromSlider(fromSlider, toSlider, fromInput) {
            const [from, to] = getParsed(fromSlider, toSlider);
            fillSlider(fromSlider, toSlider, '#C6C6C6', '#00A9E1', toSlider);
            if (from > to) {
                fromSlider.value = to;
                fromInput.value = to;
            } else {
                fromInput.value = from;
            }
        }

        function controlToSlider(fromSlider, toSlider, toInput) {
            const [from, to] = getParsed(fromSlider, toSlider);
            fillSlider(fromSlider, toSlider, '#C6C6C6', '#00A9E1', toSlider);
            setToggleAccessible(toSlider);
            if (from <= to) {
                toSlider.value = to;
                toInput.value = to;
            } else {
                toInput.value = from;
                toSlider.value = from;
            }
        }

        function getParsed(currentFrom, currentTo) {
            const from = parseInt(currentFrom.value, 10);
            const to = parseInt(currentTo.value, 10);
            return [from, to];
        }

        function fillSlider(from, to, sliderColor, rangeColor, controlSlider) {
            const rangeDistance = to.max - to.min;
            const fromPosition = from.value - to.min;
            const toPosition = to.value - to.min;

            // Set the track color for WebKit (Chrome, Safari)
            controlSlider.style.cssText += `
            background: linear-gradient(
                to right,
                ${sliderColor} 0%,
                ${sliderColor} ${(fromPosition / rangeDistance) * 100}%,
                ${rangeColor} ${(fromPosition / rangeDistance) * 100}%,
                ${rangeColor} ${(toPosition / rangeDistance) * 100}%,
                ${sliderColor} ${(toPosition / rangeDistance) * 100}%,
                ${sliderColor} 100%);
            `;

            // Set the track color for Firefox
            controlSlider.style.background = `linear-gradient(
                    to right,
                    ${sliderColor} 0%,
                    ${sliderColor} ${(fromPosition / rangeDistance) * 100}%,
                    ${rangeColor} ${(fromPosition / rangeDistance) * 100}%,
                    ${rangeColor} ${(toPosition / rangeDistance) * 100}%,
                    ${sliderColor} ${(toPosition / rangeDistance) * 100}%,
                    ${sliderColor} 100%)`;

            // Explicitly set the track color to the rangeColor
            controlSlider.style.backgroundSize = '100% 100%';
        }



        function setToggleAccessible(currentTarget) {
            const toSlider = document.querySelector('#toSlider');
            if (Number(currentTarget.value) <= 0) {
                toSlider.style.zIndex = 2;
            } else {
                toSlider.style.zIndex = 0;
            }
        }

        const fromSlider = document.querySelector('#fromSlider');
        const toSlider = document.querySelector('#toSlider');
        const fromInput = document.querySelector('#fromInput');
        const toInput = document.querySelector('#toInput');
        fillSlider(fromSlider, toSlider, '# ', '#00A9E1', toSlider);
        setToggleAccessible(toSlider);

        fromSlider.oninput = () => controlFromSlider(fromSlider, toSlider, fromInput);
        toSlider.oninput = () => controlToSlider(fromSlider, toSlider, toInput);
        fromInput.oninput = () => controlFromInput(fromSlider, fromInput, toInput, toSlider);
        toInput.oninput = () => controlToInput(toSlider, fromInput, toInput, toSlider);
    </script>
    <!-- BootStrap Script -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js"></script>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
@endsection
