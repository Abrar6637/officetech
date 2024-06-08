@extends('frontend.layout.main')
@php
    $product_name = $product_details[0]->name;
@endphp
@section('title', '' . ucwords($product_name))
@section('main.container')
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <style>
        .single__specification-item {
            display: block;
            padding: 0px;
            border: 0px;
        }

        .single__specification-item table {
            width: 100%;
            border-collapse: collapse
        }
            
        .single__specification-item table tr:nth-child(even) {
            background-color: #ffffff;
        }

        .single__specification-item table td {
            padding: 5px 17px;
        }
        .slick-slide {
            height: auto !important;
        }
        .single__btns form button {
            padding: 18px 20px;
            text-align: center;
            color: var(--colorBlueDark);
            font-size: 15px;
            font-weight: 600;
            line-height: 1.2;
            border-radius: 4px;
        }

        .single__btns form button:last-child {
            background: #CAF0F8 !important;
            width: 100%;
        }

        .tab-list {
            display: flex;
            justify-content: space-between;
        }
@media (max-width:768px){
    .tab-list-btn{
        font-size: 14px !important;
        padding:14px 0px !important; 
    }
}
        .tab-list-btn {
            padding: 24px 0px;
            text-decoration: none;
            color: #00B4D8;
            border-bottom: 1px solid #00B4D8;
            width: 100%;
            text-align: center;
            font-size: 18px;
            font-weight: 700
        }

        .tab-list-btn.active {
            color: #76E5A9;
            border-bottom: 1px solid #76E5A9;
        }

        .tab-content {
            display: none;
        }

        .active-tab {
            display: block;
        }
        .product-detail-Slider .single__slider-wrapper {
            height: 792px;
        }

        .product-detail-Slider .single__slider-main {
            height: 100%;
        }

        .product-detail-Slider .slick-slider .slick-list {
            height: 100%;
        }

        .product-detail-Slider .slick-track {
            height: 100%;
        }

        .product-detail-Slider .slick-track img {
            height: 589px !important;
            object-fit: contain;
        }

        .product-detail-Slider .single__slider-items {
            margin-top: -80px;
            height: 106px;
            padding: 0px
        }

        .product-detail-Slider .single__slider-items .slick-slider .slick-list {
            height: 100%;
        }
        .product-detail-Slider .single__slider-items .slick-track {
            height: 100%;
        }
        .product-detail-Slider .single__slider-items .slick-slide{
            height: 100% !important;
        }
        .product-detail-Slider .single__slider-items .slick-slide img{
            height: 100% !important;
            object-fit: contain
        }
        @media (max-width:768px){
            .product-detail-Slider .single__slider-wrapper {
            padding: 40px 20px;
            height: 500px;
        }
        .product-detail-Slider .slick-track img {
            height: 300px !important;
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
                <span>
                    {{ ucwords($product_name) }}
                </span>
            </div>
        </div>
    </div>

    <main>
        <section class="single product-detail-Slider">
            <div class="container">
                <div class="single__body">
                <div class="single__slider-wrapper">
        @foreach ($product_details as $product)
            <div class="single__slider-main">
                @foreach ($product->gallery_images as $index => $image)
                    <div class="slide">
                        <img src="{{ asset('images/product_images/'.$image->images) }}" alt="{{ $product->name }}">
                    </div>
                @endforeach
            </div>
            <div class="single__slider-items">
                @foreach ($product->gallery_images as $index => $image)
                    <div class="thumbnail" onclick="changeMainImage({{ $index }})">
                        <img src="{{ asset('images/product_images/'.$image->images) }}" alt="{{ $product->name }}">
                    </div>
                @endforeach
            </div>
        @endforeach
    </div>
                    <div class="single__content">
                        <div>
                            <div class="single__cat">
                                @if ($product->availability == 'in-stock')
                                    <span>
                                        {{ str_replace('-', ' ', ucwords($product->availability)) }}</span>
                                @elseif ($product->availability == 'out-of-stock')
                                    <span>{{ str_replace('-', ' ', ucwords($product->availability)) }}</span>
                                @else
                                    <span>{{ $product->availability }}</span>
                                @endif
                            </div>
                            <h1 class="single__title">
                                {{ $product->name }}
                            </h1>
                            <div class="single__star">
                                @php
                                    $roundedAverage = round($averageRating);
                                    $hasHalfStar = $averageRating - $roundedAverage === 0.5;
                                @endphp
                                @for ($i = 1; $i <= 5; $i++)
                                    <span class="active"></span>
                                @endfor
                                <div class="single__star-val">
                                    {{ number_format($averageRating, 1) }}
                                </div>
                            </div>
                            <div class="single__dscr">
                                <p>
                                    {!! $product->product_description !!}
                                </p>
                            </div>
                        </div>
                        <div class="single__bottom">
                            <div class="single__price" id="product-price">
                                @if ($product->sale_price)
                                    <s>{{ $product->price }}</s>
                                    {{ $product->sale_price }}
                                    <span data-translate="sar">SAR</span>
                                @else
                                    {{ $product->price }}<span data-translate="sar">SAR</span>
                                @endif
                                <input type="hidden" class="original-price" id="original-price" value="{{ $product->sale_price ? $product->sale_price : $product->price }}">
                            </div>
                            <div class="single__bottom-inner">
                                <div class="single__count">
                                    <?php
                                    $price  =$product->sale_price ? $product->sale_price : $product->price ;
                                    ?>
                                    <button class="remove btnHover" onclick="updateQuantity(-1,<?php echo $price; ?>)"></button>
                                    <span id="quantity">
                                        1
                                    </span>
                                    <span style="display: none;" id="new_qty">
                                    </span>
                                    <button class="add btnHover" onclick="updateQuantity(1,<?php echo $price; ?>)"></button>
                                 
                                </div>
                                <div class="single__btns">
                                <form id="buy-now-form" class="single__btn btnHover"
                                        action="{{ route('user.checkout') }}" method="get">
                                        <button {{ $product->availability == 'out-of-stock' ? 'disabled' : '' }} 
                                                title="{{ $product->availability == 'out-of-stock' ? 'This product is out of stock.' : 'Click to buy this product.' }}" data-translate="buy_now_btn">
                                            <input type="hidden" name="slug" value="{{ encrypt($product->slug) }}">
                                            <input type="hidden" id="updated-qty" name="updated_qty" value="1" >
                                            Buy now
                                        </button>
                                    </form>

                                    <button id="add-tocart" data-id="{{ $product->id }}"
                                            class="single__btn btnHover add-to-cart index-add-to-cart"
                                            {{ $product->availability == 'out-of-stock' ? 'disabled' : '' }} 
                                            title="{{ $product->availability == 'out-of-stock' ? 'This product is out of stock.' : 'Click to add this product to cart.' }}" data-translate="add_to_cart_btn">
                                        Add to cart
                                    </button>

                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                {{-- Tab Section  --}}
                <div>
                    <ul class="tab-list">
                        <a class="tab-list-btn active" href="javascript:void(0)" onclick="openTab('tab1')" data-translate="specification">Specification</a>
                        <a class="tab-list-btn" href="javascript:void(0)" onclick="openTab('tab2')" data-translate="review">Reviews</a>
                        <a class="tab-list-btn" href="javascript:void(0)" onclick="openTab('tab3')" data-translate="similar_products">Similar products</a>
                    </ul>

                    <div id="tab1" class="tab-content active-tab">
                        <div class="single__specification">
                            <h4 class="single__specification-title" data-translate="main_specifications">
                                Main Specification
                            </h4>
                            <div class="single__specification-item">
                                {!! $product->specifications !!}
                                </p>
                            </div>
                        </div>
                    </div>

                    <div id="tab2" class="tab-content">
                        <section class="single__specification-item" style="padding-top: 80px">
                            @if ($reviews->count() > 0)
                                <section class="reviews single">
                                    <div class="container" style="padding: 0px">
                                        <div class="reviews__inner">
                                            @foreach ($product_details as $product)
                                                <h2 class="reviews__title titleSection tl">
                                                   <span data-translate="reviews_about">Reviews about</span>  {{ $product->name }}
                                                </h2>
                                            @endforeach
                                            <div class="reviews__items">
                                                @foreach ($reviews->take(2) as $review_tab)
                                                    @if ($review_tab->count() > 0 && $review_tab->status == 1)
                                                        <div class="reviews__item">
                                                            <div class="reviews__item-main">
                                                                <div class="reviews__item-user">
                                                                    <img src="{{ url('images/user/user-avatar.png') }}"
                                                                        alt="">
                                                                </div>
                                                                <div class="reviews__item-content">
                                                                    <div class="reviews__item-top">
                                                                        <div class="reviews__item-name">
                                                                            {{ $review_tab->name }}
                                                                        </div>
                                                                        <div class="reviews__item-stars">
                                                                            @for ($i = 1; $i <= 5; $i++)
                                                                                @if ($i <= (int) $review_tab->rating)
                                                                                    <span class="active"></span>
                                                                                @else
                                                                                    <span></span>
                                                                                @endif
                                                                            @endfor
                                                                            <div class="count">
                                                                                {{ $review_tab->rating }}
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                    <div class="reviews__item-dscr">
                                                                        <p>
                                                                            {{ $review_tab->review }}
                                                                        </p>
                                                                    </div>
                                                                    <div class="reviews__item-advantages">
                                                                        <div class="reviews__item-advantages-title" data-translate="advantages">
                                                                            Advantages
                                                                        </div>
                                                                        <ul>
                                                                            <li>
                                                                                {{ $review_tab->advantages }}
                                                                            </li>
                                                                        </ul>
                                                                    </div>
                                                                    <div class="reviews__item-flaws">
                                                                        <div class="reviews__item-flaws-title" data-translate="flaws">
                                                                            Flaws
                                                                        </div>
                                                                        <ul>
                                                                            <li>
                                                                                {{ $review_tab->flaws }}
                                                                            </li>
                                                                        </ul>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                            <div class="reviews__item-product">
                                                                <div class="products__item">
                                                                    <div class="products__item-cat">
                                                                        @if ($product->availability == 'in-stock')
                                                                            <span>
                                                                                {{ str_replace('-', ' ', ucwords($product->availability)) }}</span>
                                                                        @elseif ($product->availability == 'out-of-stock')
                                                                            <span>{{ str_replace('-', ' ', ucwords($product->availability)) }}</span>
                                                                        @else
                                                                            <span>{{ $product->availability }}</span>
                                                                        @endif
                                                                    </div>
                                                                    <div class="products__item-img">
                                                                        @php
                                                                            $imagePath = public_path('images/product_images/' . $product->gallery_images[0]->images);
                                                                        @endphp
                                                                        @if (file_exists($imagePath))
                                                                            <img src="{{ url('images/product_images/' . $product->gallery_images[0]->images) }}"
                                                                                alt="">
                                                                        @else
                                                                            <img src="{{ url('images/no-image.png') }}"
                                                                                alt="" id="main-image">
                                                                        @endif
                                                                    </div>
                                                                    <a href="#" class="products__item-title">
                                                                        {{ $product->name }}
                                                                    </a>
                                                                    <div class="products__item-info">
                                                                        <div class="products__item-price">
                                                                            @if ($product->sale_price)
                                                                                <s>{{ $product->price }}</s>
                                                                                {{ $product->sale_price }}
                                                                                <span data-translate="sar">SAR</span>
                                                                            @else
                                                                                {{ $product->price }}<span data-translate="sar">SAR</span>
                                                                            @endif
                                                                        </div>
                                                                    </div>
                                                                    <div class="products__item-btns">
                                                                        <a href="{{ route('user.product_details', $product->slug) }}"
                                                                            class="products__item-btn" data-translate="buy_now_btn">
                                                                            Buy now
                                                                        </a>
                                                                        @if (isset($product->availability) && $product->availability == 'out-of-stock')
                                                                            <a class="products__item-btn add-to-cart index-add-to-cart" disabled title="This product is out of stock." data-translate="add_to_cart_btn">
                                                                                    Add to cart
                                                                                </a>
                                                                            @else
                                                                                <a id="add-tocart" data-id="{{ $product->id }}" class="products__item-btn add-to-cart index-add-to-cart" data-translate="add_to_cart_btn">
                                                                                    Add to cart
                                                                                </a>
                                                                            @endif

                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    @endif
                                                @endforeach
                                            </div>
                                        </div>
                                    </div>
                                </section>
                            @else
                                <div>
                                    <h4 class="single__specification-title" data-translate="no_similar_products">
                                        No Similar Products
                                    </h4>
                                </div>
                            @endif
                        </section>
                    </div>

                    <div id="tab3" class="tab-content">
                        <section class="single__specification-item" style="padding-top: 80px">
                            <div class="catalog__items">
                                @foreach ($related_products->take(4) as $product)
                                    <div class="products__item">
                                        <div class="products__item-cat">
                                            @if ($product->availability == 'in-stock')
                                                <p class="tick text-success">
                                                    {{ str_replace('-', ' ', ucwords($product->availability)) }}
                                                </p>
                                            @elseif ($product->availability == 'out-of-stock')
                                                <p class="text-danger">
                                                    {{ str_replace('-', ' ', ucwords($product->availability)) }}
                                                </p>
                                            @endif
                                        </div>
                                        <div class="products__item-img">
                                            @if (count($product->gallery_images) > 0)
                                                @php
                                                    $imagePath = public_path('images/product_images/' . $product->gallery_images[0]->images);
                                                @endphp
                                                @if (file_exists($imagePath))
                                                    <img style="height: 100%"
                                                        src="{{ url('images/product_images/' . $product->gallery_images[0]->images) }}"
                                                        alt="{{ $product->name }}">
                                                @else
                                                    <img src="{{ url('images/no-image.png') }}"
                                                        alt="{{ $product->name }}" id="main-image">
                                                @endif
                                            @else
                                                <img src="{{ url('images/no-image.png/') }}" alt="{{ $product->name }}">
                                            @endif
                                        </div>
                                        <a href="{{ route('user.product_details', $product->slug) }}"
                                            class="products__item-title">
                                            @if (isset($product->name))
                                                {{ ($product->name) }}
                                            @endif
                                        </a>
                                        <div class="products__item-info">
                                            <div class="products__item-price">
                                                @if ($product->sale_price)
                                                    {{ $product->sale_price }}<span data-translate="sar">SAR</span>
                                                @else
                                                    {{ $product->price }}<span data-translate="sar">SAR</span>
                                                @endif
                                            </div>
                                        </div>
                                        <div class="products__item-btns">
                                            <a href="{{ route('user.product_details', $product->slug) }}"
                                                class="products__item-btn" data-translate="buy_now_btn" >
                                                Buy now
                                            </a>
                                            @if (isset($product->availability) && $product->availability == 'out-of-stock')
                                            <a class="products__item-btn add-to-cart index-add-to-cart" disabled title="This product is out of stock." data-translate="add_to_cart_btn">
                                                    Add to cart
                                                </a>
                                            @else
                                                <a id="add-tocart" data-id="{{ $product->id }}" class="products__item-btn add-to-cart index-add-to-cart" data-translate="add_to_cart_btn">
                                                    Add to cart
                                                </a>
                                            @endif


                                        </div>
                                    </div>
                                @endforeach
                            </div>
                        </section>
                    </div>
                </div>
            </div>
        </section>
        <section class="relatedProducts">
            <div class="container">
                <div class="relatedProducts__inner">
                    <h2 class="relatedProducts__title titleSection tl" data-translate="related_products">
                        Related Products
                    </h2>
                    @if ($related_products->count() > 0)
                        <div class="relatedProducts__items">
                            @foreach ($related_products->take(5) as $related_product)
                                <div class="products__item">
                                    <div class="products__item-cat">
                                        @if ($related_product->availability == 'in-stock')
                                            <span>
                                                {{ str_replace('-', ' ', ucwords($related_product->availability)) }}
                                            </span>
                                        @elseif ($related_product->availability == 'out-of-stock')
                                            <span>
                                                {{ str_replace('-', ' ', ucwords($related_product->availability)) }}
                                            </span>
                                        @endif
                                    </div>
                                    <div class="products__item-img">
                                        @if (count($related_product->gallery_images) > 0)
                                            @php
                                                $imagePath = public_path('images/product_images/' . $related_product->gallery_images[0]->images);
                                            @endphp
                                            @if (file_exists($imagePath))
                                                <img src="{{ url('images/product_images/' . $related_product->gallery_images[0]->images) }}"
                                                    alt="{{ $related_product->name }}">
                                            @else
                                                <img src="{{ url('images/no-image.png') }}"
                                                    alt="{{ $related_product->name }}" id="main-image">
                                            @endif
                                        @else
                                            <img src="{{ url('images/no-image.png') }}">
                                        @endif
                                    </div>
                                    <a href="{{ route('user.product_details', $related_product->slug) }}"
                                        class="products__item-title">
                                        {{ $related_product->name }}
                                    </a>
                                    <div class="products__item-info">
                                        <div class="products__item-price">
                                            {{ $related_product->price }}<span data-translate="sar">SAR</span>
                                        </div>
                                    </div>
                                    <div class="products__item-btns">
                                        <a href="{{ route('user.product_details', $related_product->slug) }}"
                                            class="products__item-btn" data-translate="buy_now_btn">
                                            Buy now
                                        </a>
                                        @if (isset($related_product->availability) && $related_product->availability == 'out-of-stock')
                                            <a class="products__item-btn add-to-cart index-add-to-cart" disabled title="This product is out of stock." data-translate="add_to_cart_btn">
                                                    Add to cart
                                                </a>
                                            @else
                                                <a id="add-tocart" data-id="{{ $related_product->id }}" class="products__item-btn add-to-cart index-add-to-cart" data-translate="add_to_cart_btn">
                                                    Add to cart
                                                </a>
                                            @endif
                                    </div>
                                </div>
                            @endforeach
                        </div>
                    @else
                        <div style="text-align: center; font-size: 20px; font-weight: 600; padding-bottom: 10px">
                            <p data-translate="related_products_details">Related Products Not Found!</p>
                        </div>
                    @endif
                </div>
            </div>
        </section>
        @if ($reviews->count() > 0)
            <section class="reviews single">
                <div class="container">
                    <div class="reviews__inner">
                        <h2 class="reviews__title titleSection tl">
                            Reviews about Printer Epson L1300 Black
                        </h2>
                        <div class="reviews__items">
                            @foreach ($reviews->take(2) as $review_tab)
                                @if ($review_tab->count() > 0 && $review_tab->status == 1)
                                    <div class="reviews__item">
                                        <div class="reviews__item-main">
                                            <div class="reviews__item-user">
                                                <img src="{{ url('images/user/user-avatar.png') }}" alt="">
                                            </div>
                                            <div class="reviews__item-content">
                                                <div class="reviews__item-top">
                                                    <div class="reviews__item-name">
                                                        {{ $review_tab->name }}
                                                    </div>
                                                    <div class="reviews__item-stars">
                                                        @for ($i = 1; $i <= 5; $i++)
                                                            @if ($i <= (int) $review_tab->rating)
                                                                <span class="active"></span>
                                                            @else
                                                                <span></span>
                                                            @endif
                                                        @endfor
                                                        <div class="count">
                                                            {{ $review_tab->rating }}
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="reviews__item-dscr">
                                                    <p>
                                                        {{ $review_tab->review }}
                                                    </p>
                                                </div>
                                                <div class="reviews__item-advantages">
                                                    <div class="reviews__item-advantages-title" data-translate="advantages">
                                                        Advantages
                                                    </div>
                                                    <ul>
                                                        <li>
                                                            {{ $review_tab->advantages }}
                                                        </li>
                                                    </ul>
                                                </div>
                                                <div class="reviews__item-flaws">
                                                    <div class="reviews__item-flaws-title" data-translate="flaws">
                                                        Flaws
                                                    </div>
                                                    <ul>
                                                        <li>
                                                            {{ $review_tab->flaws }}
                                                        </li>
                                                    </ul>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="reviews__item-product">
                                            <div class="products__item">
                                                <div class="products__item-cat">
                                                    @if ($product->availability == 'in-stock')
                                                        <span>
                                                            {{ str_replace('-', ' ', ucwords($product->availability)) }}</span>
                                                    @elseif ($product->availability == 'out-of-stock')
                                                        <span>{{ str_replace('-', ' ', ucwords($product->availability)) }}</span>
                                                    @else
                                                        <span>{{ $product->availability }}</span>
                                                    @endif
                                                </div>
                                                <div class="products__item-img">
                                                    @php
                                                        $imagePath = public_path('images/product_images/' . $product->gallery_images[0]->images);
                                                    @endphp
                                                    @if (file_exists($imagePath))
                                                        <img src="{{ url('images/product_images/' . $product->gallery_images[0]->images) }}"
                                                            alt="">
                                                    @else
                                                        <img src="{{ url('images/no-image.png') }}" alt=""
                                                            id="main-image">
                                                    @endif
                                                </div>
                                                <a href="#" class="products__item-title">
                                                    {{ $product->name }}
                                                </a>
                                                <div class="products__item-info">
                                                    <div class="products__item-price">
                                                        @if ($product->sale_price)
                                                            <s>{{ $product->price }}</s>
                                                            {{ $product->sale_price }}
                                                            <span data-translate="sar">SAR</span>
                                                        @else
                                                            {{ $product->price }}<span data-translate="sar">SAR</span>
                                                        @endif
                                                    </div>
                                                </div>
                                                <div class="products__item-btns">
                                                    <a href="{{ route('user.product_details', $product->slug) }}"
                                                        class="products__item-btn" data-translate="buy_now_btn">
                                                        Buy now
                                                    </a>
                                                    <a id="add-tocart" data-id="{{ $product->id }}"
                                                        class="products__item-btn add-to-cart index-add-to-cart" data-translate="add_to_cart_btn">
                                                        Add to cart
                                                    </a>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                @endif
                            @endforeach
                        </div>
                        {{-- @if ($reviews->count() > 2)
                        <a href="#" class="reviews__btn btnHover  load-more-btn" id="loadMoreBtn" data-page="2" data-translate="show_more">
                            Show More
                        </a>
                    @elseif ($reviews->count() < 0)
                        <div style="text-align: center; font-size: 20px; font-weight: 600; padding-bottom: 10px">
                            <p data-translate="reviews_not_found">Reviews Not Found!</p>
                        </div>
                    @endif --}}
                    </div>
                </div>
            </section>
        @else
            <div>
            </div>
        @endif
        @if (Session::get('user_name'))
            <section class="reviewsAdd">
                <div class="container">
                    <div class="reviewsAdd__inner">
                        <h2 class="reviewsAdd__title titleSection tl" data-translate="write_a_review">
                            Write a Review
                        </h2>
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
                        <form action="{{ route('product.reviews') }}" class="reviewsAdd__form inputSWrap inputWhite">
                            @csrf
                            <div class="reviewsAdd__form-l">
                                <div class="reviewsAdd__form-grid">
                                    <div class="input__wrapper">
                                        <label data-translate="name">
                                            Name
                                        </label>
                                        <input type="text" placeholder="Brian Clark" required name="name"
                                            value="{{ Session::get('user_name') }}" readonly>
                                    </div>
                                    <div class="input__wrapper">
                                        <label data-translate="email">
                                            Email
                                        </label>
                                        <input type="email" name="email" name="email"
                                            value="{{ Session::get('user_email') }}" readonly
                                            placeholder="asdasd@gmail.com" required>
                                    </div>
                                </div>
                                <div class="input__wrapper">
                                    <label data-translate="review">
                                        Review
                                    </label>
                                    <textarea name="review" placeholder="Write a review"></textarea>
                                </div>
                            </div>
                            <div class="reviewsAdd__form-r">
                                <div class="input__wrapper">
                                    <label class="advantages" data-translate="advantages">
                                        Advantages
                                    </label>
                                    <input type="text" name="advantages" placeholder="Write advantages" required>
                                </div>
                                <div class="input__wrapper">
                                    <label class="flaws" data-translate="flaws">
                                        Flaws
                                    </label>
                                    <input type="text" name="disadvantage" placeholder="Write flaws" required>
                                </div>
                                <div class="reviewsAdd__form-star">
                                    <p data-translate="my_mark">
                                        My mark
                                    </p>
                                    <div class="rating-area">
                                        <input type="radio" id="star-1" name="star" value="1">
                                        <label for="star-1" title="Оценка «1»"></label>
                                        <input type="radio" id="star-2" name="star" value="2">
                                        <label for="star-2" title="Оценка «2»"></label>
                                        <input type="radio" id="star-3" name="star" value="3">
                                        <label for="star-3" title="Оценка «3»"></label>
                                        <input type="radio" id="star-4" name="star" value="4">
                                        <label for="star-4" title="Оценка «4»"></label>
                                        <input type="radio" id="star-5" name="star" value="5">
                                        <label for="star-5" title="Оценка «5»"></label>
                                    </div>
                                </div>
                            </div>
                            <input type="hidden" name="user_id" value="{{ Session::get('user_id') }}">
                            <input type="hidden" name="product_id" value="{{ $product->id }}" >
                            <button type="submit" class="btnHover" data-translate="send">
                                Send
                            </button>
                        </form>
                    </div>
                </div>
            </section>
        @endif
    </main>
@endsection
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/sweetalert2@11.0.18/dist/sweetalert2.min.css">
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11.0.18/dist/sweetalert2.all.min.js"></script>
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script src="path/to/encryption-script.js"></script>
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

        $(".index-add-to-cart").click(function() {
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
                        if (response.new_Cart == '1') {
                            if (response.success) {
                                var cartCount = parseInt($("#cart-badge").text(), 10);
                                cartCount += 1;
                                $("#cart-badge").text(cartCount);
                                Swal.fire({
                                    title: 'Success!',
                                    text: 'Product Added to Cart!',
                                    icon: 'success',
                                    iconColor: '#03045E',
                                    confirmButtonColor: '#03045E',
                                    confirmButtonText: 'OK'
                                });
                                updateCartBadgeCount();
                            }
                        } else if (response.new_Cart == '0') {
                            if (response.success) {
                                Swal.fire({
                                    title: 'Success!',
                                    text: 'Product quantity updated in Cart!',
                                    icon: 'success',
                                    iconColor: '#03045E',
                                    confirmButtonColor: '#03045E',
                                    confirmButtonText: 'OK'
                                });
                                updateCartBadgeCount();
                            }
                        } else {
                            Swal.fire({
                                title: 'Error!',
                                text: 'Failed to add product to Cart.',
                                icon: 'error',
                                iconColor: '#03045E',
                                confirmButtonColor: '#03045E',
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

        function updateCartBadgeCount() {
            var count = $("#cart-badge").text();
            if (count == 0) {
                console.log('count is 0');
                $('#cartCountDropdown').addClass('invisible');
            } else {
                $('#cartCountDropdown').removeClass('invisible');
            }
        }
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
<script>
var originalPrice; // Declare originalPrice variable outside the function

// Assign value to originalPrice inside the function
function updateQuantity(change,price) {
    originalPrice =price;

    // Log the original price for debugging
    console.log("Original Price:", originalPrice);
    
    // Rest of your function remains unchanged...
    var quantityElement = document.getElementById('quantity');
    var newQuantityElement = document.getElementById('new_qty');
    var currentQuantity = parseInt(quantityElement.innerText);
    var newQuantity = currentQuantity + change;
    newQuantity = Math.max(1, newQuantity);
    quantityElement.style.display = 'none';
    newQuantityElement.style.display = 'inline';
    newQuantityElement.innerText = newQuantity;
    var productPriceElement = document.getElementById('product-price');
    var unitPrice = parseFloat(productPriceElement.innerText);
    var totalPrice = originalPrice * newQuantity;
    totalPrice = totalPrice.toFixed(2);
    productPriceElement.innerHTML = totalPrice + '<span data-translate="sar">SAR</span>';
    var updatedQtyField = document.getElementById('updated-qty');
    updatedQtyField.value = newQuantity;
}

</script>
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
    function openTab(tabId) {
        // Hide all tabs
        var tabs = document.querySelectorAll('.tab-content');
        tabs.forEach(function(tab) {
            tab.classList.remove('active-tab');
        });

        // Remove active class from all tab buttons
        var tabButtons = document.querySelectorAll('.tab-list-btn');
        tabButtons.forEach(function(button) {
            button.classList.remove('active');
        });

        // Show the selected tab
        var selectedTab = document.getElementById(tabId);
        selectedTab.classList.add('active-tab');

        // Add active class to the clicked tab button
        var clickedButton = document.querySelector('[onclick="openTab(\'' + tabId + '\')"]');
        clickedButton.classList.add('active');
    }
</script>

<!-- BootStrap Script -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js"></script>
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
