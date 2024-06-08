@extends('frontend.layout.main')
@section('title', 'Office Tech - Home')
@section('main.container')
    @if ($sliders->count() > 0)
        <style>
            .main-index-slider-printer-img {
                width: 404px;
                height: 444px;
                margin-bottom: 0 !important;
                position: absolute;
                margin-top: 32px;
                margin-left: 32px;
                object-fit: fill;
            }

            .brands__slider.slick-initialized .slick-slide {
                height: 120px !important;
                display: flex;
                justify-content: center;
                align-items: center;
                padding: 0 20px;
            }

            .brands__slider.slick-slide img {
                height: 100% !important;
                object-fit: cover;
                width: 100%;
            }

            .categories__items-top .categories__item {
                background-size: contain;
                background-color: #F2F3F7;
                height: 300px;
            }

            /*
                                                                            .promo__item-img {
                                                                                max-width: 446.5px;
                                                                                width: 22vw;
                                                                            }

                                                                            .promo__item-img img {
                                                                                height: 600px;
                                                                                margin-top: 75px
                                                                            }

                                                                            .promo__item-img-2 {
                                                                                max-width: 679px;
                                                                                height: 672px;
                                                                                margin-left: 70px
                                                                            } */

            /* @media (max-width: 1300px) {
                                                                                .promo__item-img-2 {
                                                                                    display: none;
                                                                                }

                                                                                .promo__item-img img {
                                                                                    transform: rotate(-5deg);
                                                                                }

                                                                                .promo__item-img {
                                                                                    width: auto;
                                                                                    max-width: 100%;
                                                                                }
                                                                            }

                                                                            @media (max-width: 1025px) {
                                                                                .promo__item-img img {
                                                                                    height: 529px !important;
                                                                                    margin-top: 75px;
                                                                                }
                                                                            } */

            .cate {
                display: flex;
                flex-direction: row;
                gap: 59px;
                padding: 0px 74px;
            }

            .background-container {
                width: 700px !important;
                height: 426px;
                background-image: url('{{ asset('updated-assets/images/cat.png') }}');
                background-size: cover;
                background-position: center;
                background-repeat: no-repeat;
                border-radius: 8px
            }

            .background-container1 {
                width: 700px !important;
                height: 426px;
                background-image: url('{{ asset('updated-assets/images/cat1.png') }}');
                background-size: cover;
                background-position: center;
                background-repeat: no-repeat;
                border-radius: 8px;
                position: relative;
                overflow: hidden
            }

            .background-container1:hover .cat_overlay {
                opacity: .3;
            }

            .cat_overlay {
                position: absolute;
                top: 0;
                left: 0;
                height: 100%;
                width: 100%;
                background: #f1f3f7;
                opacity: 0;
                transition: 0.3s ease;
            }


            .cate-head {
                color: #00B4D8;
                font-family: Figtree;
                font-size: 17px;
                font-style: normal;
                font-weight: 900;
                line-height: 100.901px;
                text-align: center;

            }

            @media (max-width: 600px) {
                .background-container {
                    width: 290px !important;
                    height: 226px;
                    background-image: url('{{ asset('updated-assets/images/cat.png') }}');
                    background-size: cover;
                    background-position: center;
                    background-repeat: no-repeat;
                    border-radius: 8px
                }

                .background-container1 {
                    width: 290px !important;
                    height: 226px;
                    background-image: url('{{ asset('updated-assets/images/cat1.png') }}');
                    background-size: cover;
                    background-position: center;
                    background-repeat: no-repeat;
                    border-radius: 8px
                }

                .cate {
                    display: flex;
                    flex-direction: column;
                    gap: 20px;
                    align-items: center;
                }

                .cate-head {
                    color: #00B4D8;

                    font-family: Figtree;
                    font-size: 14.021px;
                    font-style: normal;
                    font-weight: 900;
                    line-height: 100.901px;
                    text-align: center;

                }


            }

            @media (min-width:1024px) {
                .cate-head {
                    color: #00B4D8;

                    font-family: Figtree;
                    font-size: 34px;
                    font-style: normal;
                    font-weight: 900;
                    line-height: 100.901px;
                    text-align: end;
                    padding-right: 74px
                }

            }

            /* .promo__item-img-2 {
                                                                                top: 82px
                                                                            } */

            /* .slide-img-1 {
                                                                                margin-top: 80px;
                                                                            } */

            /* @media (min-width:1440px) {
                                                                                .slide-img-1 {
                                                                                    margin-top: 110px !important;
                                                                                }

                                                                            } */
            /*
                                                                            @media (min-width:1500px)and (max-width:1920px) {
                                                                                .slide-img-1 {
                                                                                    margin-top: 0px;
                                                                                }

                                                                            } */

            .brand_items {
                display: flex;
                align-items: center;
                justify-content: center;
                gap: 10px;
                padding: 0px 80px;
                flex-direction: row;
            }

            @media (max-width:500px) {
                .brand_items {

                    padding: 0px 20px;
                    gap: 20px;
                }
            }

            .brand_item {
                height: 72px;
                width: 378px;
                display: flex;
                justify-content: center;
                align-items: center
            }

            .brand_item img {
                height: 100%;
                width: 100%;
                object-fit: contain;
            }

            /* .promo__slider .slick-track {
                                                                                height: 612px !important;
                                                                            } */

            .promo__item-img {
                max-width: 446.5px;
                width: 22vw;
            }

            .promo__item-img img {
                height: 425px !important;
            }

            .promo__item-img-2 {
                max-width: 446.6px;
                position: absolute;
                bottom: 0;
                right: 0;
            }

            @media (max-width: 1000px) {
                .promo__item-img {
                    display: none;
                }

                .promo__item-img-2 {
                    display: none;
                }
            }

            .img-1 img {
                transform: rotate(7.7deg);
            }

            .slider-main {
                height: auto;
                background-color: linear-gradient(to right, #D74319, #FF6C47);
            }

            .slider-item {
                display: flex;
            }

            @media (min-width:1600px) and (max-width:2000px) {
                .slider-item-img-1 {
                    height: 600px;
                    width: 35%;
                    padding-top: 90px;
                    object-fit: contain;
                }

                .slider-item {
                    height: 612px;
                }
            }

            @media (min-width:1200px) and (max-width:1500px) {
                .slider-item-img-1 {
                    height: 510px;
                }

                .slider-item {
                    height: 580px;
                }
            }


            @media (max-width: 1100px) {
                .slider-item-img-2 {
                    display: none;
                }

                .slider-item-img-1 {
                    width: 100%;
                    height: 400px;
                }

            }

            @media(max-width:900px) {
                .slider-item {
                    display: block
                }

                .slider-img-content {
                    display: none;
                }

                .slider-item-img-1 {
                    display: none;
                }
            }

            .slider-img-content {
                display: flex;

            }

            @media (min-width: 901px) and (max-width: 1200px) {
                .slider-item {
                    justify-content: space-between;
                    align-items: center;
                }
                .img-1 img {
                transform: rotate(0deg);
            }
            }

            @media (min-width: 1201px) and (max-width: 1300px) {
                .slider-item-img-2 {
                    width: 100%
                }

            }

            @media (min-width:1301px) and (max-width:1600px) {
                .slider-item-img-2 {
                    width: 90%
                }

            }

            @media (min-width:1100px) and (max-width:1200px) {
                .slider-item-img-2 {
                    width: 96%
                }

            }

            @media (min-width:1601px) {
                .slider-item-img-2 {
                    width: 65%
                }

            }

            @media (min-width:1200px) {
                .img-1 {
                    width: 40%;
                    display: flex;
                    align-items: center;
                    height: 100%;
                }

                .img-2 {
                    width: 60%;
                    display: flex;
                    align-items: end;
                }

            }

            @media (min-width:600px) and (max-width:1200px) {
                .img-1 {
                    width: 100%
                }

                .img-2 {
                    display: none;
                }

            }

            @media (max-width:900px) {
                .img-1 {
                    display: none;
                }

                .img-2 {
                    display: none;
                }

            }
            .client-img-1{
                width: 104%
            }
            .client-img-2{
                width: 108%
            }
            .client-img-3{
                width: 108%
            }
            @media (min-width:1920px){
                .client-img-1{
                width: 100%
            }
            .client-img-2{
                width: 100%
            }
            .client-img-3{
                width: 100%
            }
            }
            .reviews__title{
                margin-top: 96px;
            }
        </style>
    @endif
    <main >
        {{-- @if ($sliders->count() > 0)
            <section class="">
                <div class="promo__slider" style="background-color:blue ;">
                    @foreach ($sliders as $key => $slider)
                        <div class="container" >
                            <div class="promo__item promo{{ $key + 1 }}">
                                <div class="container_item">
                                    <div class="promo__item-content">
                                        <div class="promo__item-title">
                                            <span>{{ $slider->prints }}</span> Prints <br>
                                            <span>{{ $slider->contract_years }} Years</span> Contract!
                                        </div>
                                        <div class="promo__item-dscr">
                                            <p> {!! $slider->description !!}</p>

                                        </div>
                                        <a href="{{ route('user.product_details', $slider->product_slug) }}"
                                            class="products__item-btn" data-translate="buy_now_btn">
                                            Buy now
                                        </a>
                                    </div>
                                    <div class="promo__item-img">
                                        <img src="{{ asset('images/' . $slider->image) }}" alt="">
                                    </div>
                                </div>
                            </div>
                        </div>
                    @endforeach
                </div>
            </section>
        @else
            <section class="" >
                <div class="container" style="background-color:blue">
                    <div class="promo__slider" style="background-color:blue ;">
                        <div class="promo__item">
                            <div class="promo__item-content">
                                <div class="promo__item-title">
                                    <span>24000</span> Prints <br>
                                    <span>2 Years</span> Contract!
                                </div>
                                <div class="promo__item-dscr">
                                    <p>A flexible and networkable</p>
                                    <p>
                                        26 ppm Speed & A4-black& white
                                    </p>
                                    <p>
                                        Paper formats: A5-A3 and customized paper sizes
                                    </p>
                                    <p>
                                        Full service contract Including spare parts & consumable during
                                    </p>
                                    <p>
                                        contract period
                                    </p>
                                </div>
                                <a href="#" class="promo__item-btn" data-translate="buy_now_btn">
                                    Buy Now!
                                </a>
                            </div>
                            <div class="promo__item-img">
                                <img src="images/promo__item_1.webp" alt="">
                            </div>
                        </div>
                        <div class="promo__item">
                            <div class="promo__item-content">
                                <div class="promo__item-title">
                                    Lorem <span>ipsum</span> dolor sit amet.
                                </div>
                                <div class="promo__item-dscr">
                                    <p>
                                        Lorem ipsum dolor sit amet consectetur adipisicing elit. Culpa quod ab officia
                                        reprehenderit fugit dicta sint dignissimos. Quas porro maxime enim repellendus ut,
                                        quod rem ipsum quibusdam saepe deserunt odio.
                                    </p>
                                </div>
                                <a href="#" class="promo__item-btn" data-translate="buy_now_btn">
                                    Buy Now!
                                </a>
                            </div>
                            <div class="promo__item-img">
                                <img src="images/promo__item_1.webp" alt="">
                            </div>
                        </div>
                        <div class="promo__item">
                            <div class="promo__item-content">
                                <div class="promo__item-title">
                                    <span>24000</span> Prints <br>
                                    <span>2 Years</span> Contract!
                                </div>
                                <div class="promo__item-dscr">
                                    <p>A flexible and networkable</p>
                                    <p>
                                        26 ppm Speed & A4-black& white
                                    </p>
                                    <p>
                                        Paper formats: A5-A3 and customized paper sizes
                                    </p>
                                    <p>
                                        Full service contract Including spare parts & consumable during
                                    </p>
                                    <p>
                                        contract period
                                    </p>
                                </div>
                                <a href="#" class="promo__item-btn" data-translate="buy_now_btn">
                                    Buy Now!
                                </a>
                            </div>
                            <div class="promo__item-img">
                                <img src="images/promo__item_1.webp" alt="">
                            </div>
                        </div>
                    </div>
                </div>
            </section>
        @endif --}}
        {{-- <section class="" style="background-image:linear-gradient(to right,#D74319  ,#FF6C47 ) ;">
            <div class="container" style="">
                <div class="promo__slider" style="">
                    @if ($sliders->count() > 0)
                        @foreach ($sliders as $key => $slider)
                            <div class="promo__item" style="position: relative; ">
                                <div class="promo__item promo__padding">
                                    <div class="promo__item-content">
                                        <div class="promo__item-title" style="color: #ffffff">
                                            {{ $slider->prints }} Prints <br>
                                            {{ $slider->contract_years }} Contract!
                                        </div>
                                        <div class="promo__item-dscr" style="color: #ffffff">
                                            {!! $slider->description !!}
                                        </div>
                                        <a href="{{ route('user.product_details', $slider->product_slug) }}"
                                            class="promo__item-btn" data-translate="buy_now_btn">
                                            Buy Now!
                                        </a>
                                    </div>
                                    <div class="promo__item-img">
                                        <img src="{{ asset('images/SliderImages/' . $slider->image) }}" alt="">
                                    </div>
                                    <div class="promo__item-img-2">
                                        @if ($key == 0)
                                            <img class=""
                                                src="{{ asset('updated-assets/images/client-img.png') }}" alt="" style="height: 400px">
                                        @elseif($key == 1)
                                            <img src="{{ asset('updated-assets/images/img2.png') }}" style="height:400px"
                                                alt="">
                                        @else
                                            <img src="{{ asset('updated-assets/images/img3.png') }}" alt=""
                                                style="height:350px">
                                        @endif
                                    </div>
                                </div>
                            </div>
                        @endforeach
                    @endif
                </div>
            </div>
        </section> --}}
        <section class="">
            <div class="promo__slider slider-main">
                @if ($sliders->count() > 0)
                    @foreach ($sliders as $key => $slider)
                        <div class="slider-main"
                            style="@if ($key == 0) background: linear-gradient(to right, #D74319, #FF6C47); 
                                @elseif($key == 1) background: linear-gradient(271deg, #E8F08B 20.35%, #E8F927 85.83%), #F1F3F7; 
                                @elseif($key == 2) background: #BFABD2; 
                                @else background: #BFABD2; @endif">
                            <div class="container-left">
                                <div class="slider-item"  >
                                    <div class="promo__item-content">
                                        <div class="promo__item-title" style="color: white">
                                            <span
                                                style="@if ($key == 1) color: #021A6F; @else color:white; @endif">{{ $slider->prints }}</span>
                                            <span
                                                style="@if ($key == 0) color: white; @else color:#021A6F; @endif">Prints</span>
                                            <br>
                                            <span
                                                style="@if ($key == 1) color: #021A6F; @else color:white; @endif">{{ $slider->contract_years }}
                                                Year</span> <span
                                                style="@if ($key == 0) color: white; @else color:#021A6F; @endif">Contract!
                                            </span>
                                        </div>
                                        <div class="promo__item-dscr"
                                            style="@if ($key == 0) color: white; @else color:#021A6F; @endif">
                                            <p> {!! $slider->description !!}</p>
                                        </div>
                                        <a href="{{ route('user.product_details', $slider->product_slug) }}"
                                            class="promo__item-btn" data-translate="buy_now_btn">
                                            Buy Now!
                                        </a>
                                    </div>
                                    <div class="slider-img-content" style=" ">
                                        <div class="img-1">
                                            <img src="{{ asset('images/SliderImages/' . $slider->image) }}" alt=""
                                                style="width: 100%; height: 90%;   object-fit: contain;">
                                        </div>
                                        <div class="img-2">
                                            @if ($key == 0)
                                                <img src="{{ asset('updated-assets/images/client-img.png') }}"
                                                    alt="" class="client-img-1" style="  object-fit: fill; width: 87% ">
                                            @elseif($key == 1)
                                                <img src="{{ asset('updated-assets/images/happy-man-v2.png') }}" alt=""
                                                    style=" object-fit: fill; " class="client-img-2">
                                            @else
                                                <img src="{{ asset('updated-assets/images/happy-man-v3.png') }}" alt=""
                                                    style=" object-fit: fill;   ;
                                                    " class="client-img-3">
                                            @endif
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    @endforeach
                @endif
            </div>
        </section>
        <div class="promo__dots"></div>
        <section class="categories">
            <div class="container">
                <div class="categories__inner">
                    <h2 class="categories__title titleSection" style="colors:red;" data-translate="categories">
                        Categories
                    </h2>
                    <div class="cate">
                        @foreach ($main_categories->take(2) as $key => $main_category)
                            @if (
                                $main_category->subCategories->count() > 0 &&
                                    $main_category->id == $main_category->subCategories->first()->parent_category_id)
                                @foreach ($main_category->subCategories->take(1) as $subcategory)
                                    <div class="background-container1"
                                        style="background-image: url({{ asset('images/category_images/' . $main_category->image) }})">
                                        <a href="{{ route('sub.category.products', $subcategory->slug) }}">
                                            <h1 class="cate-head">{{ $main_category->category_name }} </h1>
                                        </a>
                                        <a href="{{ route('sub.category.products', $subcategory->slug) }}"
                                            class="cat_overlay">
                                        </a>
                                    </div>
                                @endforeach
                            @endif
                        @endforeach
                        {{-- <div class="background-container">
                            <h1 class="cate-head">Black & White Printing </h1>
                        </div> --}}
                    </div>
                    {{-- <div class="categories__items-top">
                        @foreach ($main_categories->take(6) as $key => $main_category)
                            @if ($main_category->subCategories->count() > 0 && $main_category->id == $main_category->subCategories->first()->parent_category_id)
                                @foreach ($main_category->subCategories->take(1) as $subcategory)
                                    <a href="{{ route('sub.category.products', $subcategory->slug) }}"
                                        class="categories__item"
                                        style="background-image: url({{ $main_category->image ? asset('images/category_images/' . $main_category->image) : asset('images/category_images/categories__item_3.webp') }})">
                                        <h3 class="categories__item-title">{{ $main_category->category_name }}</h3>
                                    </a>
                                @endforeach
                            @endif
                        @endforeach
                    </div>
                    <div class="categories__items-bottom">
                        @foreach ($main_categories as $key => $main_category)
                            @if ($key > 3)
                                <a href="{{ url('/Category/toner-for-konica-minolta') }}" class="categories__item"
                                    style="background-image: url({{ $main_category->image ? asset('images/category_images/' . $main_category->image) : asset('images/category_images/categories__item_3.webp') }})">
                                    <h3 class="categories__item-title">{{ $main_category->category_name }}</h3>
                                </a>
                            @endif
                        @endforeach
                    </div> --}}
                </div>
            </div>
        </section>
        <section class="products">  
            <div class="container">
                <div class="products__inner">
                    <h2 class="products__title titleSection" data-translate="featured_products">
                        Featured Products
                    </h2>
                    <div class="tabsWrapper">
                        <!-- <div class="products__tabs">
                            <div class="products__tab tabItem active" onclick="loadData('recommended-products')"
                                data-tab_id="products__items_1">
                                Recommended
                            </div>
                            <div class="products__tab tabItem" onclick="loadData('latest-products')"
                                data-tab_id="products__items_2">
                                New
                            </div>
                        </div> -->
                        <div class="tabContent" id="products__items_1">
                            <div class="products__items">
                                @foreach ($products as $recommend)
                                    <div class="products__item">
                                        <div class="products__item-cat">
                                            @if (isset($recommend['availability']) && $recommend['availability'] == 'in-stock')
                                                {{ str_replace('-', ' ', ucwords($recommend['availability'])) }}
                                            @elseif (isset($recommend['availability']) && $recommend['availability'] == 'out-of-stock')
                                                {{ str_replace('-', ' ', ucwords($recommend['availability'])) }}
                                            @elseif(isset($recommend['availability']))
                                                {{ $recommend['availability'] }}
                                            @endif
                                        </div>
                                        <div class="products__item-img">
                                            @if (
                                                isset($recommend['gallery_images']) &&
                                                count($recommend['gallery_images']) > 0 &&
                                                isset($recommend['gallery_images'][0]['images'])
                                            )
                                                @php
                                                $imagePath = public_path('images/product_images/' . $recommend['gallery_images'][0]['images']);
                                                @endphp
                                                @if (file_exists($imagePath))
                                                    <img src="{{ url('images/product_images/' . $recommend['gallery_images'][0]['images']) }}"
                                                        alt="{{ $recommend['name'] }}">
                                                @else
                                                    <img src="{{ url('images/no-image.png') }}" alt="{{ $recommend['name'] }}" id="main-image">
                                                @endif
                                            @else
                                                <img src="{{ asset('images/no-image.png') }}">
                                            @endif
                                        </div>
                                        <a href="{{ route('user.product_details', $recommend['slug']) }}" class="products__item-title">
                                            @if (isset($recommend['name']))
                                                {{ $recommend['name'] }}
                                            @endif
                                        </a>
                                        <div class="products__item-info">
                                            <div class="products__item-price">
                                                @if (isset($recommend['price']))
                                                    {{ $recommend['price'] }}
                                                @else
                                                    0
                                                @endif
                                                <span data-translate="sar">SAR</span>
                                            </div>
                                        </div>
                                        <div class="products__item-btns">
                                            <a href="{{ route('user.product_details', $recommend['slug']) }}" class="products__item-btn" data-translate="buy_now_btn">
                                                Buy now
                                            </a>
                                            @if (isset($recommend['availability']) && $recommend['availability'] == 'out-of-stock')
                                            <a class="products__item-btn add-to-cart index-add-to-cart" disabled title="This product is out of stock." data-translate="add_to_cart_btn">
                                                    Add to cart
                                                </a>
                                            @else
                                                <a id="add-tocart" data-id="{{ $recommend['id'] }}" class="products__item-btn add-to-cart index-add-to-cart" data-translate="add_to_cart_btn">
                                                    Add to cart
                                                </a>
                                            @endif
                                        </div>
                                    </div>
                                @endforeach
                            </div>

                        </div>
                        {{-- <div class="tabContent" id="products__items_2">
                            <div class="products__items">
                                @foreach ($latestProducts as $new)
                                    <div class="products__item">
                                        <div class="products__item-cat">
                                            @if (isset($new->availability) && $new->availability == 'in-stock')
                                                {{ str_replace('-', ' ', ucwords($new->availability)) }}
                                            @elseif (isset($new->availability) && $new->availability == 'out-of-stock')
                                                {{ str_replace('-', ' ', ucwords($new->availability)) }}
                                            @elseif(isset($new->availability))
                                                {{ $new->availability }}
                                            @endif
                                        </div>
                                        <div class="products__item-img">
                                            @if ($new->gallery_images && count($new->gallery_images) >= 0 && isset($new->gallery_images[0]->images))
                                                @php
                                                    $imagePath = public_path('images/product_images/' . $new->gallery_images[0]->images);
                                                @endphp
                                                @if (file_exists($imagePath))
                                                    <img src="{{ url('images/product_images/' . $new->gallery_images[0]->images) }}"
                                                        alt="{{ $new->name }}">
                                                @else
                                                    <img src="{{ url('images/no-image.png') }}" alt="{{ $new->name }}"
                                                        id="main-image">
                                                @endif
                                            @else
                                                <img src="{{ asset('images/no-image.png/') }}">
                                            @endif
                                        </div>
                                        <a href="{{ route('user.product_details', $new->slug) }}"
                                            class="products__item-title">
                                            @if (isset($new->name))
                                                {{($new->name) }}
                                            @endif
                                        </a>
                                        <div class="products__item-info">
                                            <div class="products__item-price">
                                                @if (isset($new->price))
                                                    {{ $new->price }}
                                                @else
                                                    1.500
                                                @endif
                                                <span data-translate="sar">SAR</span>
                                            </div>
                                        </div>
                                        <div class="products__item-btns">
                                            <a href="{{ route('user.product_details', $new->slug) }}"
                                                class="products__item-btn" data-translate="buy_now_btn">
                                                Buy now
                                            </a>
                                            <a id="add-tocart" data-id="{{ $new->id }}"
                                                class="products__item-btn add-to-cart index-add-to-cart" data-translate="add_to_cart_btn">
                                                Add to cart
                                            </a>
                                        </div>
                                    </div>
                                @endforeach

                            </div>
                        </div> --}}
                    </div>
                </div>
            </div>
        </section>
        <section class="brands" style="overflow: hidden">
            <div class="container">
                <div class="brands__inner">
                    <h2 class="brands__title titleSection"  data-translate="brands">
                        Brands
                    </h2>
                    {{-- @php $brandsChunked = $brands->chunk(6); @endphp --}}
                    <div class="brand_items">
                        @foreach ($brands as $brand)
                            <div class="brand_item">
                                <a href="{{ route('brands.products', ['slug' => $brand->slug]) }}">
                                    <img src="{{ asset('images/' . $brand->image) }}">
                                </a>
                            </div>
                        @endforeach
                    </div>
                    {{-- <img src="{{ asset('updated-assets/images/brand.png') }}" width="1200px"
                        style="display:flex; justify-content:center" alt=""> --}}

                    {{-- @php $brandsChunked = $brands->chunk(6); @endphp
                    <div class="brands__slider">
                        @foreach ($brandsChunked as $key => $brandGroup)
                            @foreach ($brandGroup as $brand)
                                <div class="brands__slider-item">
                                    <img src="{{ asset('images/' . $brand->image) }}" alt="">
                                </div>
                            @endforeach
                        @endforeach
                    </div>  --}}
                </div>
            </div>
        </section>

        {{-- <section class="services">
            <div class="container">
                <div class="services__inner">
                    <h2 class="services__title titleSection">
                        Services
                    </h2>
                    <div class="services__items">
                        <div class="services__item">
                            <div class="services__item-img">
                                <img src="images/services__item_1.webp" alt="">
                            </div>
                            <a href="#" class="services__item-title">
                                1 Year Support Free
                            </a>
                            <div class="services__item-dscr">
                                <p>
                                    Our experts ensure fast and high-quality servicing of your equipment. We are always
                                    ready to address any issues, so you
                                    can have confidence in the reliability of your technology
                                </p>
                            </div>
                            <div class="services__item-bottom">
                                <div class="services__item-price">
                                    500 <span data-translate="sar">SAR</span>
                                </div>
                                <a href="#" class="services__item-btn">
                                    More about Service Ticket
                                </a>
                            </div>
                        </div>
                        <div class="services__item">
                            <div class="services__item-img">
                                <img src="images/services__item_2.webp" alt="">
                            </div>
                            <a href="#" class="services__item-title">
                                1 Year Support Free
                            </a>
                            <div class="services__item-dscr">
                                <p>
                                    Our experts ensure fast and high-quality servicing of your equipment. We are always
                                    ready to address any issues,
                                    so you
                                    can have confidence in the reliability of your technology
                                </p>
                            </div>
                            <div class="services__item-bottom">
                                <div class="services__item-price">
                                    500 <span data-translate="sar">SAR</span>
                                </div>
                                <a href="#" class="services__item-btn">
                                    More about Service Ticket
                                </a>
                            </div>
                        </div>
                        <div class="services__item">
                            <div class="services__item-img">
                                <img src="images/services__item_1.webp" alt="">
                            </div>
                            <a href="#" class="services__item-title">
                                1 Year Support Free
                            </a>
                            <div class="services__item-dscr">
                                <p>
                                    Our experts ensure fast and high-quality servicing of your equipment. We are always
                                    ready to address any issues,
                                    so you
                                    can have confidence in the reliability of your technology
                                </p>
                            </div>
                            <div class="services__item-bottom">
                                <div class="services__item-price">
                                    500 <span data-translate="sar">SAR</span>
                                </div>
                                <a href="#" class="services__item-btn">
                                    More about Service Ticket
                                </a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section> --}}

        @if ($reviews->count() > 0)
            <section class="reviews">
                <div class="container">
                    <div class="reviews__inner">
                        <h2 class="reviews__title titleSection"  data-translate="reviews">
                            Reviews
                        </h2>
                        <div class="reviews__slider">
                            @foreach ($reviews as $review)
                                @if ($review->product)
                                    <div class="reviews__item">
                                        <div class="reviews__item-main">
                                            <div class="reviews__item-user">
                                                <img src="images/reviews__item_1.webp" alt="">
                                            </div>
                                            <div class="reviews__item-content">
                                                <div class="reviews__item-top">
                                                    <div class="reviews__item-name">
                                                        {{ $review->name }}
                                                    </div>
                                                    <div class="reviews__item-stars">
                                                        @for ($i = 1; $i <= 5; $i++)
                                                            @if ($i <= (int) $review->rating)
                                                                <span class="active"></span>
                                                            @else
                                                                <span></span>
                                                            @endif
                                                        @endfor
                                                        <div class="count">
                                                            {{ $review->rating }}
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="reviews__item-dscr">
                                                    <p>
                                                        {{ $review->review }}
                                                    </p>
                                                </div>
                                                <div class="reviews__item-advantages">
                                                    <div class="reviews__item-advantages-title">
                                                        Advantages
                                                    </div>
                                                    <ul>
                                                        <li>
                                                            {{ $review->advantages }}
                                                        </li>
                                                    </ul>
                                                </div>
                                                <div class="reviews__item-flaws">
                                                    <div class="reviews__item-flaws-title">
                                                        Flaws
                                                    </div>
                                                    <ul>
                                                        <li>
                                                            {{ $review->flaws }}
                                                        </li>
                                                    </ul>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="reviews__item-product">
                                            <div class="products__item">
                                                <div class="products__item-cat">
                                                    @if (isset($review->product->availability) && $review->product->availability == 'in-stock')
                                                        {{ str_replace('-', ' ', ucwords($review->product->availability)) }}
                                                    @elseif (isset($review->product->availability) && $review->product->availability == 'out-of-stock')
                                                        {{ str_replace('-', ' ', ucwords($review->product->availability)) }}
                                                    @elseif(isset($review->product->availability))
                                                        {{ $review->product->availability }}
                                                    @endif
                                                </div>
                                                <div class="products__item-img">
                                                    @if ($review->product && count($review->product->gallery_images) >= 0)
                                                        @php
                                                            $imagePath = public_path('images/product_images/' . $review->product->gallery_images[0]->images);
                                                        @endphp
                                                        @if (file_exists($imagePath))
                                                            <img src="{{ url('images/product_images/' . $review->product->gallery_images[0]->images) }}"
                                                                alt="" style="height:295px">
                                                        @else
                                                            <img src="{{ url('images/no-image.png') }}" alt=""
                                                                id="main-image">
                                                        @endif
                                                    @else
                                                        <img src="images/products__item_1.webp" alt="">
                                                    @endif
                                                </div>
                                                <a href="{{ route('user.product_details', $review->product->slug) }}"
                                                    class="products__item-title">
                                                    @if (isset($review->product->name))
                                                        {{($review->product->name) }}
                                                    @endif
                                                </a>
                                                <div class="products__item-info">
                                                    <div class="products__item-price">
                                                        @if (isset($review->product->price))
                                                            {{ $review->product->price }}
                                                        @else
                                                            1.500
                                                        @endif
                                                        <span data-translate="sar">SAR</span>
                                                    </div>
                                                </div>
                                                <div class="products__item-btns">
                                                    <a href="{{ route('user.product_details', $review->product->slug) }}"
                                                        class="products__item-btn" data-translate="buy_now_btn">
                                                        Buy now
                                                    </a>
                                                    <a id="add-tocart" data-id="{{ $review->product->id }}"
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
                    </div>
                </div>
            </section>
        @endif

        <meta name="csrf-token" content="{{ csrf_token() }}">
        <section class="trigger">
            <div class="container">
                <div class="trigger__inner"
                    style="@if (Session::get('user_name')) grid-template-columns: repeat(1, minmax(auto, 1fr)); @endif">
                    <div class="trigger__content">
                        <div>
                            <h2 class="trigger__content-title" data-translate="get_in_touch">
                                Get in touch
                            </h2>
                            <div class="trigger__content-dscr">
                                <p data-translate="get_in_touch_message">
                                    You can contact us on the contact page
                                </p>
                            </div>
                            <a href="{{ route('user.contact_us') }}" class="trigger__content-btn" data-translate="contact_us_btn">
                                Contact Us
                            </a>
                        </div>
                    </div>
                    @if (!Session::get('user_name'))
                        <div class="trigger__form">
                            <div class="trigger__form-inner">
                                <h3 class="trigger__form-title" data-translate="newsletter">
                                    Subscribe to our newsletter
                                </h3>
                                <div class="trigger__form-dscr" >
                                    <p data-translate="newsletter_message">
                                        Stay up to date with new events
                                    </p>
                                </div>
                                <form action="{{ route('user.newsletter') }}" id="newsletterForm" method="POST">
                                    @csrf
                                    <div class="input__wrapper">
                                        <input type="email" name="email" id="email"
                                            placeholder="yxz@gmail.com" required>
                                    </div>
                                    <button type="submit" id="newsletterBtn" data-translate="submit_btn">Submit</button>
                                </form>
                            </div>
                        </div>
                    @endif
                </div>
            </div>
        </section>

    </main>
    <script src="https://code.jquery.com/jquery-3.6.4.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script>
        $(".index-add-to-cart").on('click', function(e) {
            e.stopPropagation();
            e.preventDefault();
            var user_id = @json($user_id ?? null);
            var without_user_add_to_Cart = @json($without_user_add_to_Cart ?? null);
            var productId = $(this).data('id');
            var quantity = 1;
            if (user_id) {
                increment_ajax(productId, user_id, quantity)
            } else {
                increment_ajax(productId, without_user_add_to_Cart, quantity)
            }

            function increment_ajax(productId, user_id, quantity) {
                $.ajax({
                    type: 'POST',
                    url: "/cart/add",
                    data: {
                        user_id: user_id,
                        productId: productId,
                        quantity: quantity,
                        _token: '{{ csrf_token() }}'
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

        // function loadData(tab) {
        //     var route;

        //     switch (tab) {
        //         case 'featured-products':
        //             route = '{{ route('featured.products') }}';
        //             break;
        //         case 'recommended-products':
        //             route = '{{ route('recommended.products') }}';
        //             break;
        //         case 'latest-products':
        //             route = '{{ route('latest.products') }}';
        //             break;
        //     }
        //     $.ajax({
        //         url: route,
        //         method: 'GET',
        //         data: { tab: tab, _token: '{{ csrf_token() }}' },
        //         dataType: 'json',
        //         success: function(response) {
        //             displayProducts(response.data);
        //         },
        //         error: function(xhr, status, error) {
        //             console.error('Error loading data:');
        //             console.log('XHR:', xhr);
        //             console.log('Status:', status);
        //             console.log('Error:', error);
        //         }
        //     });
        // }

        // function displayProducts(products) {
        //    // console.log('Products received:', products);
        //     const rowContainer = $('#product-row');
        //     rowContainer.empty();

        //     if (Array.isArray(products)) {
        //         products.forEach(product => {
        //             const cardColumn = $('<div class="col-md-6 col-lg-3 col-12"></div>');
        //             const productDetailsLink = $(`<a href="/product-details/${product.slug}" class="text-decoration-none font-color-black" style="color: inherit"></a>`);
        //             const card = $('<div class="card mt-2 border-0"></div>');
        //             const cardBody = $('<div class="card-body"></div>');
        //             const productImage = $(`
    //                 <img src="${product.gallery_images.length > 0 ? '{{ url('images/product_images/') }}' + '/' + product.gallery_images[0].images : '{{ url('images/no-image.png') }}'}"
    //                     class="py-3"
    //                     alt="${product.name}"
    //                     style="height: 222px !important; width:209px !important; object-fit:contain !important;"
    //                 >
    //             `);
        //             const productInfo = $(`
    //                 <div class="text-start">
    //                     <p>${product.sku}</p>
    //                     <h5 class="fw-bolder">${product.name}</h5>
    //                     <p class="${product.availability == 'in-stock' ? 'tick text-success' : 'text-danger'}">
    //                         ${product.availability == 'in-stock' ? 'In Stock' : 'Out of Stock'}
    //                     </p>
    //                 </div>
    //             `);
        //             const cardFooter = $('<div class="card-footer bg-transparent border-top-0"></div>');
        //             const flexContainer = $('<div class="d-flex justify-content-between "></div>');
        //             const price = $(`<h5 class="fw-bold">${product.price} SAR</h5>`);
        //             const addToCart = $(`
    //                 <a
    //                     id="add-to-cart"
    //                     data-id="${product.id}"
    //                     class="index-add-to-cart arrow fw-bold clr ${product.quantity <= 0 ? 'disabled-link text-muted arrow-disable' : 'add-to-cart'}"
    //                 >
    //                     Add to cart
    //                 </a>
    //             `);
        //             $(".index-add-to-cart").on('click', function(e) {
        //                 e.stopPropagation();
        //                 e.preventDefault();
        //                 var user_id = @json($user_id ?? null);
        //                 var without_user_add_to_Cart = @json($without_user_add_to_Cart ?? null);
        //                 var productId = $(this).data('id');
        //                 var quantity = 1;

        //                  if (user_id) {
        //                     increment_ajax(productId, user_id, quantity)
        //                 } else {
        //                     increment_ajax(productId, without_user_add_to_Cart, quantity)
        //                 }
        //                 function  increment_ajax(productId, user_id, quantity){
        //                     $.ajax({
        //                         type: 'POST',
        //                         url: "/cart/add",
        //                         data: {
        //                             user_id: user_id,
        //                             productId: productId,
        //                             quantity: quantity
        //                         },
        //                         success: function(response) {
        //                             console.log(response);
        //                             if (response.success) {
        //                                 var cartCount = parseInt($("#cart-badge").text(), 10);
        //                                 cartCount += 1;
        //                                 $("#cart-badge").text(cartCount);
        //                                 Swal.fire({
        //                                     title: 'Success!',
        //                                     text: 'Product Added to Cart!',
        //                                     icon: 'success',
        //                                     iconColor: '#da5858',
        //                                     confirmButtonColor: '#da5858',
        //                                     confirmButtonText: 'OK'
        //                                 });
        //                             }
        //                         },
        //                         error: function(data) {
        //                             console.log(data);
        //                         },
        //                     });
        //                 }
        //             });

        //             cardBody.append(productImage);
        //             cardBody.append(productInfo);

        //             flexContainer.append(price);
        //             flexContainer.append(addToCart);

        //             cardFooter.append(flexContainer);

        //             card.append(cardBody);
        //             card.append(cardFooter);

        //             productDetailsLink.append(card);

        //             cardColumn.append(productDetailsLink);

        //             rowContainer.append(cardColumn);
        //         });

        //     } else {
        //         console.error('Products is not an array:', products);
        //     }
        // }

        // $(document).ready(function() {
        //     loadData('featured-products');
        //     $('#featured-tab').addClass('fw-bold text-dark');
        //     $('#featured-tab').click(function name() {
        //         $('#featured-tab').addClass('fw-bold text-dark');
        //         $('#recommended-tab').removeClass('fw-bold text-dark');
        //         $('#new-tab').removeClass('fw-bold text-dark');
        //     });
        //     $('#recommended-tab').click(function name() {
        //         $('#recommended-tab').addClass('fw-bold text-dark');
        //         $('#featured-tab').removeClass('fw-bold text-dark');
        //         $('#new-tab').removeClass('fw-bold text-dark');
        //     });
        //     $('#new-tab').click(function name() {
        //         $('#new-tab').addClass('fw-bold text-dark');
        //         $('#featured-tab').removeClass('fw-bold text-dark');
        //         $('#recommended-tab').removeClass('fw-bold text-dark');
        //     });
        // });
    </script>
    {{-- @if ($sliders->count() > 0)
        <script>
            $(document).ready(function() {
                var prints = $('.slider-text div:eq(1)').text();
                var years = $('.slider-text div:eq(2)').text();
                $('#prints').text(prints);
                $('#years').text(years);
                $('.slider-text div:eq(1)').addClass('text-shadow');

                var productName = {!! json_encode($slider->product_slug) !!};
                productName = productName.replace(/-/g, ' ');
                productName = productName.replace(/\b\w/g, function(match) {
                    return match.toUpperCase();
                });
                var words = productName.split(' ');
                var formattedProductName = '';
                for (var i = 0; i < Math.min(words.length, 4); i++) {
                    var wordColor = i < 2 ? '#fe8c3d' : '#171717';
                    formattedProductName += '<font style="color: ' + wordColor + '">' + words[i] + '</font> ';
                    if ((i + 1) % 2 === 0 && i !== words.length - 1) {
                        formattedProductName += '<br>';
                    }
                }

                $('#product-name').html(formattedProductName.trim());
            });
        </script>
    @endif --}}
    <script>
        $(document).ready(function() {
            var slickSlider = $('.reviews__slider');
            if (slickSlider.find('.slick-slide').length <= 1) {
                slickSlider.find('.slick-dots').hide();
            }
            slickSlider.slick({
                dots: true,
            });
            // $('.promo__slider').slick({
            //     dots: true,
            //     arrows: false,
            //     slidesToShow: 1,
            //     centerMode: true,
            //     slidesToScroll: 1,
            //     centerPadding: '0px',
            //     variableWidth: true,
            //     appendDots: $('.promo__dots'),
            //     autoplay: true, // Enable autoplay
            //     autoplaySpeed: 2000, // Set autoplay speed in milliseconds (e.g., 2000ms = 2 seconds)
            // });

        });
    </script>
@endsection
