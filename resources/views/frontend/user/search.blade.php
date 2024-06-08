@php
    use App\Models\Product;
@endphp
@extends('frontend.layout.main')
@section('title', 'Office Tech - Search')
@section('main.container')
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <style>
        /* Active page button */ .pagination button.active {
            color: black;
    }

    /* Active arrows */ .pagination button.active.arrow {
        background-color: #76E5A9;
        border-color: #76E5A9;
        color: #000;
        padding: 5px 10px 5px 10px;
        border-radius: 5px
    }

    .prev-button {
        background-color: rgba(229, 229, 229, 1);
        border-color: rgba(229, 229, 229, 1);
        padding: 5px 10px 5px 10px;
        border-radius: 5px
    }
    .prev-button.active{
            background-color: #76E5A9;
            border-color: #76E5A9;
        }

    .next-button {
        background-color: #76E5A9;
        border-color: #76E5A9;
        padding: 5px 10px 5px 10px;
        border-radius: 5px
    }


    .pagination {
        display: flex;
        justify-content: start;
        margin-top: 20px;
        gap: 20px;
        color: #999999;

    }

    .paginate-no{
            font-weight: bold;
            color:#999999
        }
        .paginate-no.active{
            color:black
        }

    .pagination .page-item {
        list-style: none;
        margin-right: 5px;
    }

    .pagination .page-link {
        color: #999999;
        background-color: #fff;
        border: 0px solid #dee2e6;
        padding: 0.375rem 0.75rem;
        font-weight: 700;
        font-size: 14px
    }

    .pagination .page-link:hover {
        z-index: 3;
        color: #0056b3;
        background-color: #e9ecef;
        border-color: #dee2e6;
    }

    .pagination .page-item.active .page-link {
        z-index: 3;
        color: #03045e;
        background-color: transparent !important;
        border-color: transparent !important;
        font-weight: 700;
        font-size: 14px
    }

    .pagination .page-item.disabled .page-link {
        color: #000;
        pointer-events: none;
        cursor: not-allowed;
        background-color: #EBEBEB !important;
    }

    .pagination .page-item:first-child .page-link,
    .pagination .page-item:last-child .page-link {
        border-radius: 0.25rem;
        background-color: #76E5A9;
        color: #fff;
    }

    .pagination .page-item:not(:first-child):not(:last-child) .page-link {
        border-radius: 0;
    }

    .pagination .page-item.prev,
    .pagination .page-item.next {
        margin-right: 5px;
    }

    .pagination .page-item.prev .page-link,
    .pagination .page-item.next .page-link {
        background-color: #007bff;
        border-color: #007bff;
        color: #000;
    }

    .slider {
        display: block;
        position: relative;
        height: 36px;
        width: 100%;
        -webkit-user-select: none;
        -moz-user-select: none;
        -ms-user-select: none;
        -o-user-select: none;
        user-select: none;
    }
    .slider .slider-touch-left,
    .slider .slider-touch-right {
        -webkit-box-sizing: border-box;
        -moz-box-sizing: border-box;
        box-sizing: border-box;
        display: block;
        position: absolute;
        height: 36px;
        width: 36px;
        padding: 6px;
        z-index: 2;
    }
    .slider .slider-touch-left span,
    .slider .slider-touch-right span {
        display: block;
        width: 100%;
        height: 100%;
        background: #00b4d8 ;
        border: 6px solid white;
        border-radius: 50%;
        outline:2px solid #caf0f8;
    }
    .slider .slider-line {
        -webkit-box-sizing: border-box;
        -moz-box-sizing: border-box;
        box-sizing: border-box;
        position: absolute;
        width: calc(100% - 36px);
        left: 18px;
        top: 16px;
        height: 4px;
        border-radius: 4px;
        background: #caf0f8;
        z-index: 0;
        overflow: hidden;
    }
    .slider .slider-line span {
        display: block;
        height: 100%;
        width: 0%;

        border:4px solid #76e5a9;
    }
    .price-range-input
    {
        width: 80px !important;
        height: 34px !important;
        border: 1px solid  #caf0f8 !important;
        border-radius: 5px !important;
        color: #7E7E7E;
        font-family: "Poppins";
        font-size: 12px;
        font-style: normal;
        font-weight: 400;
        line-height: normal;
        letter-spacing: 0.183px;
        text-align: center;
    }
    </style>

{{--    <div class="breadcrumbs">
        <div class="container">
            <div class="breadcrumbs__inner">
                <a href="/">
                    Home
                </a>
                <div class="el">
                    /
                </div>
                <span >
                    Search
                </span>
            </div>
        </div>
    </div> --}}
    <main>
    <section class="catalog">
            <div class="container">
                <div class="catalog__inner">
                    <div class="catalog__l">
                        <ul class="catalog__nav-menu">
                            @foreach ($main_categories as $main_category)
                                @php
                                    $hasSubcategoriesWithProducts = false;
                                @endphp
                                @foreach ($sub_categories as $subcategory)
                                    @php
                                        $productsCount = Product::where('sub_categories_id', $subcategory->id)->count();
                                        if ($subcategory->parent_category_id == $main_category->id && $productsCount > 0) {
                                            $hasSubcategoriesWithProducts = true;
                                            break;
                                        }
                                    @endphp
                                @endforeach
                                @if ($hasSubcategoriesWithProducts)
                                    @foreach ($sub_categories as $subcategory)
                                        @php
                                            $productsCount = Product::where('sub_categories_id', $subcategory->id)->count();
                                        @endphp
                                        @if ($subcategory->parent_category_id == $main_category->id && $productsCount > 0)
                                            <a href="{{ route('sub.category.products', $subcategory->slug) }}"
                                                class="filter-sidebar-option @if ($subcategory->slug == request()->segment(2)) active @endif">
                                                <li class=" @if ($subcategory->slug == request()->segment(2)) active @endif">
                                                    {{ ucwords($subcategory->sub_category_name) }}</li>
                                            </a><br>
                                        @endif
                                    @endforeach
                                @endif
                            @endforeach
                        </ul>
                        <!-- <form style="display: flex; flex-direction: column; gap: 50px" method="GET"
                            action="{{ route('search.products', ['slug' => $slug]) }}">
                            @csrf -->
                            <div class="wrapper mt-5">
                        <header>
                            <h2 class="pb-4 text-[24px] text-[#323232] border-b-2">Price Range</h2>
                        </header>
                        <div class="mt-[36px]">
                            <div id="my-slider" se-min="0" se-step="2" se-min-value="0" se-max-value="1500" se-max="30000" class="slider bg-transparent">
                                <div class="slider-touch-left">
                                    <span></span>
                                </div>
                                <div class="slider-touch-right">
                                    <span></span>
                                </div>
                                <div class="slider-line">
                                    <span></span>
                                </div>
                            </div>
                            <div id="result"></div>
                            <div style="display:flex; justify-content:space-around; margin:10px 0px 10px 0px">
                                <p id="min_price_text"></p>
                                <p id="max_price_text"></p>
                            </div>
                            <div style="display:flex ; justify-content:space-around; align-items:center">
                                <input type="text" class="price-range-input" id="min_price" name="minPrice" readonly>
                                <p class="text-[#7E7E7E]">upto</p>
                                <input type="text" class="price-range-input" id="max_price" name="maxPrice" readonly>
                            </div>
                            <div>
                            </div>
                        </div>
                    </div>
                    <div class="catalog__nav-brand">
                        <div class="catalog__nav-brand-title">
                            Brand
                        </div>
                        @foreach ($brandCounts as $brandName => $count)
                        <div class="catalog__nav-brand-item">
                            <input type="checkbox" class="checkbox filter-checkbox" id="brand_{{ $brandName }}" name="brand[]" value="{{ $brandName }}">
                            <label for="brand_{{ $brandName }}" class="checkbox-label">
                                {{ $brandName }} / <font class="filter-sidebar-checkbox-label">{{ $count }}</font>
                            </label><br>
                        </div>
                        @endforeach
                    </div>

                    <div class="catalog__nav-brand">
                        <div class="catalog__nav-brand-title">
                            Screen size
                        </div>
                        @foreach ($paperSizeCounts as $paperSize => $count)
                        <div class="catalog__nav-brand-item">
                            <input type="checkbox" class="checkbox filter-checkbox" id="paper_size_{{ $paperSize }}" name="paper_size[]" value="{{ $paperSize }}">
                            <label for="paper_size_{{ $paperSize }}" class="checkbox-label">
                                {{ $paperSize }} / <font class="filter-sidebar-checkbox-label">{{ $count }}</font>
                            </label><br>
                        </div>
                        @endforeach
                    </div>
                    <div class="catalog__nav-brand">
                        <div class="catalog__nav-brand-title">
                            Speed
                        </div>
                        @foreach ($speedCounts as $speed => $count)
                        <div class="catalog__nav-brand-item">
                            <input type="checkbox" class="checkbox filter-checkbox" id="speed_{{ $speed }}" name="speed[]" value="{{ $speed }}">
                            <label for="speed_{{ $speed }}" class="checkbox-label">
                                {{ $speed }} / <font class="filter-sidebar-checkbox-label">{{ $count }}</font>
                            </label><br>
                        </div>
                        @endforeach
                    </div>


                    <div class="catalog__nav-bottom">
                        <button id="apply-filters" class="catalog__nav-apply btnHover">
                            Apply
                        </button>
                    </div>
                    <button class="catalog__nav-reset btnHover" id="resetFilters" style="margin-top:-50px">
                        Reset all
                    </button>
                </div>
                    <div class="catalog__main">
                    <h2 class="catalog__title titleSection tl">
                            Search Result
                        </h2>
                        <div class="catalog__top">
                            <p>
                                There are
                                @if ($showProducts !== '')
                                    {{ count($showProducts) }}
                                @else
                                    {{ count($showProducts) }}
                                @endif
                                products in the catalog
                            </p>
                            <div class="selectWrapper">
                                <span>
                                    Sort by
                                </span>
                                <div class="select">
                                    <select id="sortDropdown" name="catalogCat">
                                    <option value="asc">Price (ascending)</option>
                                    <option value="desc">Price (descending)</option>
                                    </select>
                                </div>
                            </div>
                        </div>
                    <div class="catalog__main">
                        <div class="catalog__items">
                            @foreach ($showProducts as $product)
                            <!-- @if ($product->status == 1) -->
                            @foreach ($product->product_attribute as $attribute)
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
                                    <img style="height: 100%" src="{{ url('images/product_images/' . $product->gallery_images[0]->images) }}" alt="{{ $product->name }}">
                                    @else
                                    <img src="{{ url('images/no-image.png') }}" alt="{{ $product->name }}" id="main-image">
                                    @endif
                                    @else
                                    <img src="{{ url('images/no-image.png/') }}" alt="{{ $product->name }}">
                                    @endif
                                </div>
                                <a href="{{ route('user.product_details', $product->slug) }}" class="products__item-title">
                                    {{ $product->name }}
                                </a>
                                <div class="products__item-info">
                                    <!-- <div class="products__item-code">
                                                            {{ $product->sku }}
                                                        </div> -->
                                    <div class="products__item-price">
                                        @if ($product->sale_price)
                                        {{ $product->sale_price }}<span>SAR</span>
                                        @else
                                        {{ $product->price }}<span>SAR</span>
                                        @endif
                                    </div>
                                </div>
                                <div class="products__item-btns">
                                    <a href="{{ route('user.product_details', $product->slug) }}" class="products__item-btn">
                                        Buy now
                                    </a>
                                    @if (isset($product->availability) && $product->availability == 'out-of-stock')
                                    <a class="products__item-btn add-to-cart index-add-to-cart" disabled title="This product is out of stock.">
                                        Add to cart
                                    </a>
                                    @else
                                    <a id="add-tocart" data-id="{{ $product->id }}" class="products__item-btn add-to-cart index-add-to-cart">
                                        Add to cart
                                    </a>
                                    @endif
                                </div>
                            </div>
                            @endforeach
                            <!-- @endif -->
                            @endforeach
                        </div>
                        <div class="pagination">
                            {{ $showProducts->links() }}
                        </div>
                    </div>
                </div>
            </div>
        </section>
    </main>
    <script src="https://code.jquery.com/jquery-3.6.4.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script>
     $(document).ready(function() {
        $(document).on('click', '.index-add-to-cart', function(e) {
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
        });
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

        function updateProgressBar() {
            var minVal = $('.input-min').val();
            var maxVal = $('.input-max').val();
            var progressText = minVal + ' - ' + maxVal;
            $('.input-min').val(minVal + " SAR");
            $('.input-max').val(maxVal + " SAR");
        }
        function updateRangeValues() {
            var minVal = $('.range-min').val();
            var maxVal = $('.range-max').val();
            $('.min-range-value').text(minVal);
            $('.max-range-value').text(maxVal);
        }
        $('.range-input input').on('input', function() {
            updateProgressBar();
            updateRangeValues();
        });
        function filterProductsByPrice(minPrice, maxPrice) {
            $('.products__item').each(function() {
                var productPrice = parseFloat($(this).find('.products__item-price').text());
                if (productPrice >= minPrice && productPrice <= maxPrice) {
                    $(this).show();
                } else {
                    $(this).hide();
                }
            });
        }
        $('.catalog__nav-apply').on('click', function(e) {
            e.preventDefault();
            var minPrice = parseFloat($('.input-min').val());
            var maxPrice = parseFloat($('.input-max').val());
            if (minPrice !== 0 || maxPrice !== 0) {
                filterProductsByPrice(minPrice, maxPrice);
            } else {
                $('.products__item').show();
            }
        });
        // Event listener for reset button
        $("#resetFilters").on("click", function () {
            $(".filter-checkbox-brand-item").prop("checked", true);
            $(".range-min").val(0+ " SAR");
            $(".range-max").val(0+ " SAR");
            $(".input-min").val(0+ " SAR");
            $(".input-max").val(0+ " SAR");
            $('.min-range-value').text(0);
            $('.max-range-value').text(0);
            $('.products__item').show();
        });

        function sortProductsByPrice(order) {
            var productsContainer = $('.catalog__items');
            var products = productsContainer.children('.products__item').get();

            products.sort(function(a, b) {
                var priceA = parseFloat($(a).find('.products__item-price').text());
                var priceB = parseFloat($(b).find('.products__item-price').text());

                if (order === 'asc') {
                    return priceA - priceB;
                } else {
                    return priceB - priceA;
                }
            });

            // Clear the current products and append the sorted ones
            productsContainer.empty();
            $.each(products, function(index, product) {
                productsContainer.append(product);
            });
        }
        // Event listener for sorting dropdown change
        $('#sortDropdown').on('change', function() {
            var selectedOption = $(this).val();
            sortProductsByPrice(selectedOption);
        });
    });
</script>
<script>

    var ZBRangeSlider = function (id)
 {
        var self = this;
        var startX = 0,
            x = 0;

        // retrieve touch button
        var slider = document.getElementById(id);
        var touchLeft = slider.querySelector(".slider-touch-left");
        var touchRight = slider.querySelector(".slider-touch-right");
        var lineSpan = slider.querySelector(".slider-line span");

        // get some properties
        var min = parseFloat(slider.getAttribute("se-min"));
        var max = parseFloat(slider.getAttribute("se-max"));

        // retrieve default values
        var defaultMinValue = min;
        if (slider.hasAttribute("se-min-value")) {
            defaultMinValue = parseFloat(
                slider.getAttribute("se-min-value")
            );
        }
        var defaultMaxValue = max;

        if (slider.hasAttribute("se-max-value")) {
            defaultMaxValue = parseFloat(
                slider.getAttribute("se-max-value")
            );
        }

        // check values are correct
        if (defaultMinValue < min) {
            defaultMinValue = min;
        }

        if (defaultMaxValue > max) {
            defaultMaxValue = max;
        }

        if (defaultMinValue > defaultMaxValue) {
            defaultMinValue = defaultMaxValue;
        }

        var step = 0.0;

        if (slider.getAttribute("se-step")) {
            step = Math.abs(parseFloat(slider.getAttribute("se-step")));
        }

        // normalize flag
        var normalizeFact = 26;

        self.slider = slider;
        self.reset = function () {
            touchLeft.style.left = "0px";
            touchRight.style.left =
                slider.offsetWidth - touchLeft.offsetWidth + "px";
            lineSpan.style.marginLeft = "0px";
            lineSpan.style.width =
                slider.offsetWidth - touchLeft.offsetWidth + "px";
            startX = 0;
            x = 0;
        };

        self.setMinValue = function (minValue) {
            var ratio = (minValue - min) / (max - min);
            touchLeft.style.left =
                Math.ceil(
                    ratio *
                        (slider.offsetWidth -
                            (touchLeft.offsetWidth + normalizeFact))
                ) + "px";
            lineSpan.style.marginLeft = touchLeft.offsetLeft + "px";
            lineSpan.style.width =
                touchRight.offsetLeft - touchLeft.offsetLeft + "px";
            slider.setAttribute("se-min-value", minValue);
        };

        self.setMaxValue = function (maxValue) {
            var ratio = (maxValue - min) / (max - min);
            touchRight.style.left =
                Math.ceil(
                    ratio *
                        (slider.offsetWidth -
                            (touchLeft.offsetWidth + normalizeFact)) +
                        normalizeFact
                ) + "px";
            lineSpan.style.marginLeft = touchLeft.offsetLeft + "px";
            lineSpan.style.width =
                touchRight.offsetLeft - touchLeft.offsetLeft + "px";
            slider.setAttribute("se-max-value", maxValue);
        };

        // initial reset
        self.reset();

        // usefull values, min, max, normalize fact is the width of both touch buttons
        var maxX = slider.offsetWidth - touchRight.offsetWidth;
        var selectedTouch = null;
        var initialValue = lineSpan.offsetWidth - normalizeFact;

        // set defualt values
        self.setMinValue(defaultMinValue);
        self.setMaxValue(defaultMaxValue);

        // setup touch/click events
        function onStart(event) {
            // Prevent default dragging of selected content
            event.preventDefault();
            var eventTouch = event;

            if (event.touches) {
                eventTouch = event.touches[0];
            }

            if (this === touchLeft) {
                x = touchLeft.offsetLeft;
            } else {
                x = touchRight.offsetLeft;
            }

            startX = eventTouch.pageX - x;
            selectedTouch = this;
            document.addEventListener("mousemove", onMove);
            document.addEventListener("mouseup", onStop);
            document.addEventListener("touchmove", onMove);
            document.addEventListener("touchend", onStop);
        }

        function onMove(event) {
            var eventTouch = event;

            if (event.touches) {
                eventTouch = event.touches[0];
            }

            x = eventTouch.pageX - startX;

            if (selectedTouch === touchLeft) {
                if (
                    x >
                    touchRight.offsetLeft -
                        selectedTouch.offsetWidth +
                        10
                ) {
                    x =
                        touchRight.offsetLeft -
                        selectedTouch.offsetWidth +
                        10;
                } else if (x < 0) {
                    x = 0;
                }

                selectedTouch.style.left = x + "px";
            } else if (selectedTouch === touchRight) {
                if (
                    x <
                    touchLeft.offsetLeft + touchLeft.offsetWidth - 10
                ) {
                    x =
                        touchLeft.offsetLeft +
                        touchLeft.offsetWidth -
                        10;
                } else if (x > maxX) {
                    x = maxX;
                }
                selectedTouch.style.left = x + "px";
            }

            // update line span
            lineSpan.style.marginLeft = touchLeft.offsetLeft + "px";
            lineSpan.style.width =
                touchRight.offsetLeft - touchLeft.offsetLeft + "px";

            // write new value
            calculateValue();

            // call on change
            if (slider.getAttribute("on-change")) {
                var fn = new Function(
                    "min, max",
                    slider.getAttribute("on-change")
                );
                fn(
                    slider.getAttribute("se-min-value"),
                    slider.getAttribute("se-max-value")
                );
            }

            if (self.onChange) {
                self.onChange(
                    slider.getAttribute("se-min-value"),
                    slider.getAttribute("se-max-value")
                );
            }
        }

        function onStop(event) {
            document.removeEventListener("mousemove", onMove);
            document.removeEventListener("mouseup", onStop);
            document.removeEventListener("touchmove", onMove);
            document.removeEventListener("touchend", onStop);

            selectedTouch = null;

            // write new value
            calculateValue();

            // call did changed
            if (slider.getAttribute("did-changed")) {
                var fn = new Function(
                    "min, max",
                    slider.getAttribute("did-changed")
                );
                fn(
                    slider.getAttribute("se-min-value"),
                    slider.getAttribute("se-max-value")
                );
            }

            if (self.didChanged) {
                self.didChanged(
                    slider.getAttribute("se-min-value"),
                    slider.getAttribute("se-max-value")
                );
            }
        }

        function calculateValue() {
            var newValue =
                (lineSpan.offsetWidth - normalizeFact) / initialValue;
            var minValue = lineSpan.offsetLeft / initialValue;
            var maxValue = minValue + newValue;

            var minValue = minValue * (max - min) + min;
            var maxValue = maxValue * (max - min) + min;

            // console.log(step);
            if (step !== 0.0) {
                var multi = Math.floor(minValue / step);
                minValue = step * multi;

                multi = Math.floor(maxValue / step);
                maxValue = step * multi;
            }

            slider.setAttribute("se-min-value", minValue);
            slider.setAttribute("se-max-value", maxValue);
        }

        // link events
        touchLeft.addEventListener("mousedown", onStart);
        touchRight.addEventListener("mousedown", onStart);
        touchLeft.addEventListener("touchstart", onStart);
        touchRight.addEventListener("touchstart", onStart);
    };

    // -------------------
    // How to use?
    var newRangeSlider = new ZBRangeSlider("my-slider");

    newRangeSlider.onChange = function (min, max) {
        // document.getElementById("result").innerHTML =
        //     "Min: " + min + " Max: " + max;
            document.getElementById('min_price_text').innerHTML = min + " SAR";
            document.getElementById('max_price_text').innerHTML = max + " SAR";
            document.getElementById("min_price").value=min + " SAR";
            document.getElementById("max_price").value=max + " SAR";
    };

    newRangeSlider.didChanged = function (min, max) {
        // document.getElementById("result").innerHTML =
        //     "Min: " + min + " Max: " + max;
            document.getElementById('min_price_text').innerHTML = min + " SAR";
            document.getElementById('max_price_text').innerHTML = max + " SAR";
            document.getElementById("min_price").value=min + " SAR";
            document.getElementById("max_price").value=max + " SAR";
    };

    // call reset if needed
    // newRangeSlider.reset();

    // on load
    var rangeprintonload = function (id, id2) {
        var slider = document.getElementById(id)
;
        var resultid = document.getElementById(id2);
        var minv = parseFloat(slider.getAttribute("se-min-value"));
        var maxv = parseFloat(slider.getAttribute("se-max-value"));

        // resultid.innerHTML = "Min: " + minv + " Max: " + maxv;
        document.getElementById('min_price_text').innerHTML = minv + " SAR";
        document.getElementById('max_price_text').innerHTML = maxv + " SAR";
        document.getElementById("min_price").value=minv + " SAR";
        document.getElementById("max_price").value=maxv + " SAR";
    };
    var newrangeprintonload = new rangeprintonload(
        "my-slider",
        "result"
    );
</script>
<script>
    $(document).ready(function() {
        var currentPage = 1;
        var pagination = $('.pagination'); 

        $('#apply-filters').click(function() {
            var minPrice = $('#min_price').val().match(/\d+/)[0];
            var maxPrice = $('#max_price').val().match(/\d+/)[0];
            var brands = $('.filter-checkbox[name="brand[]"]:checked').map(function() {
                return this.value;
            }).get();
            var paper_sizes = $('.filter-checkbox[name="paper_size[]"]:checked').map(function() {
                return this.value;
            }).get();
            var speeds = $('.filter-checkbox[name="speed[]"]:checked').map(function() {
                return this.value;
            }).get();
            // console.log('Selected brands:', brands);
            // console.log('Selected screen sizes:', paper_sizes);

            $.ajax({
                url: '{{ route("apply.filters") }}',
                type: 'GET',
                data: {
                    minPrice: minPrice,
                    maxPrice: maxPrice,
                    brand: brands,
                    paper_size: paper_sizes,
                    speed: speeds,
                    page: currentPage 
                },
                success: function(response) {
                    updateProductList(response.data); 
                        if (response.current_page === 1) {
                            if (response.data.length > 7) {
                                createPaginationButtons(response.last_page);
                                $('.pagination').show();
                            } else {
                                $('.pagination').hide();
                            }
                        } else {
                            $('.pagination').show();
                        }
                    $('.catalog__top p').text('There are ' + response.data.length + ' products in the catalog');
                    highlightActiveButton(pagination);
                },
                error: function(xhr, status, error) {
                    console.error(xhr.responseText);
                }
            });
        });

        function updateProductList(products) {
        // console.log("---------", products);
        $('.catalog__items').empty();
        products.forEach(function(product) {
            var productId = product.id;
            var productSlug = product.slug;
            var availabilityText = product.availability.replace(/-/g, ' ').replace(/\b\w/g, function(char) {
                return char.toUpperCase();
            });

            if (product.availability == 'in-stock') {
                availabilityText = '<p class="tick text-success">' + availabilityText + '</p>';
            } else if (product.availability == 'out-of-stock') {
                availabilityText = '<p class="text-danger">' + availabilityText + '</p>';
            }

            var defaultImageSrc = "{{ url('images/no-image.png') }}";
            var imageSrc = defaultImageSrc;

            if (product.imageExists) {
                imageSrc = "{{ url('images/product_images/') }}/" + product.galleryImages[0].images;
            }

            var addToCartBtn;
            if (product.availability == 'out-of-stock') {
                addToCartBtn = '<a class="products__item-btn add-to-cart index-add-to-cart" disabled title="This product is out of stock.">Add to cart</a>';
            } else {
                addToCartBtn = '<a class="products__item-btn add-to-cart index-add-to-cart" data-id="' + productId + '">Add to cart</a>';
            }

            var productHTML = '<div class="products__item">' +
                '<div class="products__item-cat">' +
                availabilityText +
                '</div>' +
                '<div class="products__item-img">' +
                '<img src="' + imageSrc + '" alt="' + product.name + '">' +
                '</div>' +
                '<a href="/product-details/' + productSlug + '" class="products__item-title">' + product.name + '</a>' +
                '<div class="products__item-info">' +
                '<div class="products__item-price">' + product.price + '</div>' +
                '</div>' +
                '<div class="products__item-btns">' +
                '<a href="/product-details/' + productSlug + '" class="products__item-btn">Buy Now</a>' +
                addToCartBtn +
                '</div>' +
                '</div>';
            $('.catalog__items').append(productHTML);
        });
    }

        function createPaginationButtons(totalPages) {
            pagination.empty();
            var svgContent = '<svg width="8" height="14" viewBox="0 0 8 14" fill="none" xmlns="http://www.w3.org/2000/svg">' +
                '<path d="M0.667317 7.00032L7.33398 0.333657L7.33398 13.667L0.667317 7.00032Z" fill="#1F2431" fill-opacity="0.4"/>' +
                '</svg>';

            var prevButton = $('<button>').addClass('prev-button').html(svgContent);
            prevButton.click(function() {
                if (currentPage > 1) {
                    currentPage--;
                    $('#apply-filters').click();
                }
                highlightActiveButton(pagination);
            });
            pagination.append(prevButton);
            for (var i = 1; i <= totalPages; i++) {
                var button = $('<button>').addClass('paginate-no').text(i);
                button.click(function() {
                    currentPage = parseInt($(this).text());
                    $('#apply-filters').click();
                    highlightActiveButton(pagination); 
                });
                pagination.append(button);
            }
            var svgContentt = '<svg width="8" height="14" viewBox="0 0 8 14" fill="none" xmlns="http://www.w3.org/2000/svg">' +
                '<path d="M7.33268 7.00032L0.666015 0.333657L0.666016 13.667L7.33268 7.00032Z" fill="white"/>' +
                '</svg>';

            var nextButton = $('<button>').addClass('next-button').html(svgContentt);

            nextButton.click(function() {
                if (currentPage < totalPages) {
                    currentPage++;
                    $('#apply-filters').click();
                }
                highlightActiveButton(pagination);
            });
            pagination.append(nextButton);
        }

        function highlightActiveButton(pagination) {
            pagination.find('button').removeClass('active arrow'); 
            pagination.find('button').eq(currentPage - 1).addClass('active'); 
            pagination.find('.prev-button').addClass('arrow'); 
            pagination.find('.next-button').addClass('arrow'); 
        }

        $('#resetFilters').on('click', function() {
            var searchText = '{{ session('search_query') }}';

            var routeUrl = "{{ route('search.products') }}";
            if (searchText) {
                routeUrl += "?search-text=" + encodeURIComponent(searchText);
            }
            window.location.href = routeUrl;
        });
    });
</script>
@endsection
