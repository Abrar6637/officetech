@php
    use App\Models\Product;
@endphp
@extends('frontend.layout.main')
@section('title', 'Office Tech - ' . ucwords($sub_category->sub_category_name))
@section('main.container')
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <style>
        div:where(.swal2-icon).swal2-success .swal2-success-ring {
            border: 0.25rem solid #da5858 !important;
        }

        div:where(.swal2-icon).swal2-success [class^=swal2-success-line] {
            background-color: #da5858;
        }

        div:where(.swal2-container) button:where(.swal2-styled).swal2-default-outline:focus {
            box-shadow: 0 0 0 3px rgba(255, 255, 255, 0.911) !important;
        }

        div:where(.swal2-container) button:where(.swal2-styled).swal2-default-outline:focus {
            box-shadow: 0 0 0 3px rgba(255, 255, 255, 0.5) !important;
        }

        div:where(.swal2-icon).swal2-info {
            border-color: rgb(218, 88, 88) !important;
            color: rgb(218, 88, 88) !important;
        }

        .no-spinners {
            -moz-appearance: textfield;
        }

        .no-spinners::-webkit-outer-spin-button,
        .no-spinners::-webkit-inner-spin-button {
            -webkit-appearance: none;
            margin: 0;
        }

        .inp:focus {
            outline: none !important;
            border: none !important;

        }
    </style>
    {{-- @dd($speeds) --}}
    <main class="main margin">
        <div class="breadcrumb-container">
            <div class="container">
                <ul class="breadcrumb">
                    <li><a href="/">Home</a></li>
                    <li class="slash">/</li>
                    <li>{{ ucwords($sub_category->sub_category_name) }}</li>
                </ul>
            </div>
        </div>
        <div class="container text-center mt-4 section-top" style="padding:0px 37px">
            <div class="row">

                <div class="col-lg-3 text-start d-none d-lg-block">
                    <div class="pages">
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
                                            class="filter-sidebar-option @if ($subcategory->slug == request()->segment(2)) active @endif">{{ ucwords($subcategory->sub_category_name) }}</a><br>
                                    @endif
                                @endforeach
                            @endif
                        @endforeach
                    </div>
                    <form method="GET" action="{{ route('sub.category.products', ['slug' => $sub_category->slug]) }}">
                        @csrf
                        <div class="range filter-sidebar-div">
                            <h4 class="filter-sidebar-heading">Price Range</h4>
                            <div class="range_container">
                                <div class="sliders_control">
                                    <input id="fromSlider" type="range" value="{{ $fromPrice }}" min="0"
                                        max="1500" />
                                    <input id="toSlider" type="range" value="{{ $toPrice }}" min="0"
                                        max="1500" />
                                </div>
                                <div class="row">
                                    <div class="col-6 text-center">
                                        <p id="fromPrice">{{ $fromPrice }}</p>
                                    </div>
                                    <div class="col-6 text-center">
                                        <p id="toPrice">{{ $toPrice }}</p>
                                    </div>
                                </div>
                                <div class="form_control">
                                    <div class="form_control_container filter-sidebar-range-input">
                                        <input class="form_control_container__time__input no-spinners inp" type="number"
                                            name="fromInput" id="fromInput" value="{{ $fromPrice }}" min="2"
                                            max="1500" />

                                    </div>
                                    <div class="upto filter-sidebar-range-input-center-text">Upto</div>
                                    <div class="form_control_container filter-sidebar-range-input">
                                        <input class="form_control_container__time__input no-spinners inp" type="number"
                                            name="toInput" id="toInput" value="{{ $toPrice }}" min="0"
                                            max="1500" />
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="brand filter-sidebar-div">
                            <h4 class="filter-sidebar-heading">Printer Speed</h4>
                            @php
                                $uniqueAttributes = collect();
                            @endphp
                            @foreach ($products as $product)
                                @foreach ($product->product_attribute as $attribute)
                                    @if (!$uniqueAttributes->contains('speed', $attribute->speed))
                                        @php
                                            $uniqueAttributes->push(['speed' => $attribute->speed, 'count' => 1]);
                                        @endphp
                                    @else
                                        @php
                                            $uniqueAttributes = $uniqueAttributes->map(function ($item) use ($attribute) {
                                                if ($item['speed'] === $attribute->speed) {
                                                    $item['count']++;
                                                }
                                                return $item;
                                            });
                                        @endphp
                                    @endif
                                @endforeach
                            @endforeach

                            @foreach ($uniqueAttributes as $uniqueAttribute)
                                <input type="checkbox" class="checkbox filter-checkbox"
                                    id="speed_{{ $uniqueAttribute['speed'] }}" name="speed[]"
                                    value="{{ $uniqueAttribute['speed'] }}"
                                    @if (in_array($uniqueAttribute['speed'], $speeds)) checked @endif>
                                <label for="speed_{{ $uniqueAttribute['speed'] }}" class="checkbox-label">
                                    {{ $uniqueAttribute['speed'] }} / <font class="filter-sidebar-checkbox-label">
                                        {{ $uniqueAttribute['count'] }}</font>
                                </label><br>
                            @endforeach

                        </div>
                        <div class="screen-size filter-sidebar-div">
                            <h4 class="filter-sidebar-heading">Brand</h4>
                            @php
                                $uniqueBrands = collect();
                            @endphp
                            @foreach ($products as $product)
                                @if (!$uniqueBrands->contains('name', $product->brand->brand_name))
                                    @php
                                        $uniqueBrands->push(['name' => $product->brand->brand_name, 'count' => 1]);
                                    @endphp
                                @else
                                    @php
                                        $uniqueBrands = $uniqueBrands->map(function ($item) use ($product) {
                                            if ($item['name'] === $product->brand->brand_name) {
                                                $item['count']++;
                                            }
                                            return $item;
                                        });
                                    @endphp
                                @endif
                            @endforeach

                            @foreach ($uniqueBrands as $uniqueBrand)
                                <input type="checkbox" class="checkbox filter-checkbox"
                                    id="brand_{{ $uniqueBrand['name'] }}" name="brand[]"
                                    value="{{ $uniqueBrand['name'] }}" @if (in_array($uniqueBrand['name'], $brandNames)) checked @endif>
                                <label for="brand_{{ $uniqueBrand['name'] }}" class="checkbox-label">
                                    {{ $uniqueBrand['name'] }} / <font class="filter-sidebar-checkbox-label">
                                        {{ $uniqueBrand['count'] }}</font>
                                </label><br>
                            @endforeach
                        </div>
                        <div class="screen-size filter-sidebar-div">
                            <h4 class="filter-sidebar-heading">Paper Size</h4>
                            @php
                                $uniquePaperSizes = collect();
                            @endphp
                            @foreach ($products as $product)
                                @foreach ($product->product_attribute as $attribute)
                                    @if (!$uniquePaperSizes->contains('paper_size', $attribute->paper_size))
                                        @php
                                            $uniquePaperSizes->push(['paper_size' => $attribute->paper_size, 'count' => 1]);
                                        @endphp
                                    @else
                                        @php
                                            $uniquePaperSizes = $uniquePaperSizes->map(function ($item) use ($attribute) {
                                                if ($item['paper_size'] === $attribute->paper_size) {
                                                    $item['count']++;
                                                }
                                                return $item;
                                            });
                                        @endphp
                                    @endif
                                @endforeach
                            @endforeach

                            @foreach ($uniquePaperSizes as $uniquePaperSize)
                                <input type="checkbox" class="checkbox filter-checkbox"
                                    id="paper_size_{{ $uniquePaperSize['paper_size'] }}" name="paper_size[]"
                                    value="{{ $uniquePaperSize['paper_size'] }}"
                                    @if (in_array($uniquePaperSize['paper_size'], $paperSizes)) checked @endif>
                                <label for="paper_size{{ $uniquePaperSize['paper_size'] }}" class="checkbox-label">
                                    {{ $uniquePaperSize['paper_size'] }} / <font class="filter-sidebar-checkbox-label">
                                        {{ $uniquePaperSize['count'] }}</font>
                                </label><br>
                            @endforeach
                        </div>
                        <div class="btn-div filter-sidebar-div">
                            <button class="filter-sidebar-btn btn-bg-color w-75">Apply</button>
                            <p class="filter-sidebar-reset w-75 text-center">Reset All</p>
                        </div>
                    </form>
                </div>
                <div class="col-lg-9">

                    <!-- Feature Product and Services -->

                    <h2 class="text-start pages-heading">{{ ucwords($sub_category->sub_category_name) }}</h2>

                    <details class=" d-block d-lg-none text-start">
                        <summary class=" fs-3 text-end">Filter<i class="fa fa-filter"></i></summary>
                        <div class="pages text-start col-12">
                            <p class="filter-sidebar-option active">Multi-Functional</p>
                            <p class="filter-sidebar-option">Single-Functional</p>
                            <p class="filter-sidebar-option">Bundles</p>
                            <p class="filter-sidebar-option">Headsets</p>
                            <p class="filter-sidebar-option">Barcode Printers</p>
                        </div>
                        <form method="GET"
                            action="{{ route('sub.category.products', ['slug' => $sub_category->slug]) }}">
                            @csrf
                            <div class="range filter-sidebar-div">
                                <h4 class="filter-sidebar-heading">Price Range</h4>
                                <div class="range_container">
                                    <div class="sliders_control">
                                        <input id="fromSliderMobile" type="range" value="{{ $fromPrice }}"
                                            min="0" max="1500" />
                                        <input id="toSliderMobile" type="range" value="{{ $toPrice }}"
                                            min="0" max="1500" />
                                    </div>
                                    <div class="row">
                                        <div class="col-6 text-center">
                                            <p id="fromPriceMobile">{{ $fromPrice }}</p>
                                        </div>
                                        <div class="col-6 text-center">
                                            <p id="toPriceMobile">{{ $toPrice }}</p>
                                        </div>
                                    </div>
                                    <div class="form_control">
                                        <div class="form_control_container filter-sidebar-range-input">
                                            <input class="form_control_container__time__input no-spinners inp"
                                                type="number" name="fromInput" id="fromInputMobile"
                                                value="{{ $fromPrice }}" min="0" max="1500" />

                                        </div>
                                        <div class="upto filter-sidebar-range-input-center-text">Upto</div>
                                        <div class="form_control_container filter-sidebar-range-input">
                                            <input class="form_control_container__time__input no-spinners inp"
                                                type="number" name="toInput" id="toInputMobile"
                                                value="{{ $toPrice }}" min="0" max="1500" />
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="brand filter-sidebar-div">
                                <h4 class="filter-sidebar-heading">Printer Speed</h4>
                                @php
                                    $uniqueAttributes = collect();
                                @endphp
                                @foreach ($products as $product)
                                    @foreach ($product->product_attribute as $attribute)
                                        @if (!$uniqueAttributes->contains('speed', $attribute->speed))
                                            @php
                                                $uniqueAttributes->push(['speed' => $attribute->speed, 'count' => 1]);
                                            @endphp
                                        @else
                                            @php
                                                $uniqueAttributes = $uniqueAttributes->map(function ($item) use ($attribute) {
                                                    if ($item['speed'] === $attribute->speed) {
                                                        $item['count']++;
                                                    }
                                                    return $item;
                                                });
                                            @endphp
                                        @endif
                                    @endforeach
                                @endforeach

                                @foreach ($uniqueAttributes as $uniqueAttribute)
                                    <input type="checkbox" class="checkbox filter-checkbox"
                                        id="speed_{{ $uniqueAttribute['speed'] }}" name="speed[]"
                                        value="{{ $uniqueAttribute['speed'] }}"
                                        @if (in_array($uniqueAttribute['speed'], $speeds)) checked @endif>
                                    <label for="speed_{{ $uniqueAttribute['speed'] }}" class="checkbox-label">
                                        {{ $uniqueAttribute['speed'] }} / <font class="filter-sidebar-checkbox-label">
                                            {{ $uniqueAttribute['count'] }}</font>
                                    </label><br>
                                @endforeach

                            </div>
                            <div class="screen-size filter-sidebar-div">
                                <h4 class="filter-sidebar-heading">Brand</h4>
                                @php
                                    $uniqueBrands = collect();
                                @endphp
                                @foreach ($products as $product)
                                    @if (!$uniqueBrands->contains('name', $product->brand->brand_name))
                                        @php
                                            $uniqueBrands->push(['name' => $product->brand->brand_name, 'count' => 1]);
                                        @endphp
                                    @else
                                        @php
                                            $uniqueBrands = $uniqueBrands->map(function ($item) use ($product) {
                                                if ($item['name'] === $product->brand->brand_name) {
                                                    $item['count']++;
                                                }
                                                return $item;
                                            });
                                        @endphp
                                    @endif
                                @endforeach

                                @foreach ($uniqueBrands as $uniqueBrand)
                                    <input type="checkbox" class="checkbox filter-checkbox"
                                        id="brand_{{ $uniqueBrand['name'] }}" name="brand[]"
                                        value="{{ $uniqueBrand['name'] }}"
                                        @if (in_array($uniqueBrand['name'], $brandNames)) checked @endif>
                                    <label for="brand_{{ $uniqueBrand['name'] }}" class="checkbox-label">
                                        {{ $uniqueBrand['name'] }} / <font class="filter-sidebar-checkbox-label">
                                            {{ $uniqueBrand['count'] }}</font>
                                    </label><br>
                                @endforeach
                            </div>
                            <div class="screen-size filter-sidebar-div">
                                <h4 class="filter-sidebar-heading">Paper Size</h4>
                                @php
                                    $uniquePaperSizes = collect();
                                @endphp
                                @foreach ($products as $product)
                                    @foreach ($product->product_attribute as $attribute)
                                        @if (!$uniquePaperSizes->contains('paper_size', $attribute->paper_size))
                                            @php
                                                $uniquePaperSizes->push(['paper_size' => $attribute->paper_size, 'count' => 1]);
                                            @endphp
                                        @else
                                            @php
                                                $uniquePaperSizes = $uniquePaperSizes->map(function ($item) use ($attribute) {
                                                    if ($item['paper_size'] === $attribute->paper_size) {
                                                        $item['count']++;
                                                    }
                                                    return $item;
                                                });
                                            @endphp
                                        @endif
                                    @endforeach
                                @endforeach
                                @foreach ($uniquePaperSizes as $uniquePaperSize)
                                    <input type="checkbox" class="checkbox filter-checkbox"
                                        id="paper_size_{{ $uniquePaperSize['paper_size'] }}" name="paper_size[]"
                                        value="{{ $uniquePaperSize['paper_size'] }}"
                                        @if (in_array($uniquePaperSize['paper_size'], $paperSizes)) checked @endif>
                                    <label for="paper_size{{ $uniquePaperSize['paper_size'] }}" class="checkbox-label">
                                        {{ $uniquePaperSize['paper_size'] }} / <font
                                            class="filter-sidebar-checkbox-label">
                                            {{ $uniquePaperSize['count'] }}</font>
                                    </label><br>
                                @endforeach
                            </div>
                            <div class="btn-div filter-sidebar-div">
                                <button class="filter-sidebar-btn btn-bg-color w-75">Apply</button>
                                <p class="filter-sidebar-reset w-75 text-center">Reset All</p>
                            </div>
                        </form>
                    </details>
                    <div class="d-flex flex-column flex-md-row justify-content-between py-2 page-result-div">
                        <div class="d-flex gap-4">
                            <p class="fw-bold page-result-p">There are @if ($showProducts !== '')
                                    {{ count($showProducts) }}
                                @else
                                    {{ count($products) }}
                                @endif Products In The Catalog</p>
                        </div>
                        <div class="d-flex justify-content-end" style="gap:20px;">
                            <p class="fw-bold sort-by">Sort By</p>

                            <div class="dropdown" style="float:right;">
                                <button class="dropbtn">Price (Ascending) &nbsp<i class="fa fa-angle-down"></i></button>
                                <div class="dropdown-content">
                                    <a href="" id="low_to_high">Low To High</a>
                                    <a href="" id="high_to_low">High To Low</a>
                                    {{-- <a href="#">Medium</a> --}}
                                </div>
                            </div>
                        </div>
                    </div>
                    @if (isset($showProducts) && $showProducts != '')
                        <div class="row mb-4 product-container">
                            @foreach ($showProducts as $product)
                                @if ($product->status == 1)
                                    @foreach ($product->product_attribute as $attribute)
                                        <div class="col-md-6 col-lg-4 col-12 product-card"
                                            data-speed="{{ $attribute->speed }}"
                                            data-brand="{{ $product->brand->brand_name }}"
                                            data-price="{{ $product->price }}">
                                            <a href="{{ route('user.product_details', $product->slug) }}"
                                                class="text-decoration-none font-color-black" style="color: inherit">
                                                <div class="card mt-4 border-0">
                                                    <div class="card-body">
                                                        @if ($product->sale_price)
                                                        @php
                                                            $percentageDiscount = round(($product->sale_price / $product->price) * 100);
                                                        @endphp
                                                            <span class="position-absolute sale-badge">Sale {{$percentageDiscount}}%</span>
                                                        @endif
                                                        @if (count($product->gallery_images) > 0)
                                                            <img src="{{ url('images/product_images/' . $product->gallery_images[0]->images) }}"
                                                                class="py-3" alt="{{ $product->name }}"
                                                                style="height: 222px !important; width:209px !important; object-fit:contain !important;">
                                                        @else
                                                            <img src="{{ url('images/no-image.png') }}"
                                                                style="height: 222px !important; width:209px !important; object-fit:contain !important;">
                                                        @endif
                                                        <div class="text-start">
                                                            <p>{{ $product->sku }}</p>
                                                            <h5 class="fw-bolder printer-head">{{ $product->name }}</h5>
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
                                                    </div>
                                                    <div class="card-footer bg-transparent border-top-0">
                                                        <div class="d-flex justify-content-between">
                                                            @if ($product->sale_price)
                                                            <h5 class="fw-bolder"><s class="text-muted">{{ $product->price }}</s>  {{$product->sale_price}} SAR</h5>
                                                            @else
                                                            <h5 class="fw-bolder">{{ $product->price }} SAR</h5>
                                                            @endif
                                                            <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
                                                            <a id="add-tocart" data-id="{{ $product->id }}"
                                                                class="arrow fw-bold clr add-to-cart">Add
                                                                to cart</a>
                                                        </div>
                                                    </div>
                                                </div>
                                            </a>
                                        </div>
                                    @endforeach
                                @endif
                            @endforeach
                        </div>
                    @else
                        <div class="row mb-4 product-container">
                            @foreach ($products as $product)
                                @if ($product->status == 1)
                                    @foreach ($product->product_attribute as $attribute)
                                        <div class="col-md-6 col-lg-4 col-12 product-card"
                                            data-speed="{{ $attribute->speed }}"
                                            data-brand="{{ $product->brand->brand_name }}"
                                            data-price="{{ $product->price }}">
                                            <a href="{{ route('user.product_details', $product->slug) }}"
                                                class="text-decoration-none font-color-black" style="color: inherit">
                                                <div class="card mt-4 border-0">
                                                    <div class="card-body">
                                                        @if ($product->sale_price)
                                                        @php
                                                           $percentageDiscount = round((($product->price - $product->sale_price) / $product->price) * 100);
                                                        @endphp
                                                            <span class="position-absolute sale-badge">Sale {{$percentageDiscount}}%</span>
                                                        @endif
                                                        @if (count($product->gallery_images) > 0)
                                                            <img src="{{ url('images/product_images/' . $product->gallery_images[0]->images) }}"
                                                                class="py-3" alt="{{ $product->name }}"
                                                                style="height: 222px !important; width:209px !important; object-fit:contain !important;">
                                                        @else
                                                            <img src="{{ url('images/no-image.png') }}"
                                                                style="height: 222px !important; width:209px !important; object-fit:contain !important;">
                                                        @endif
                                                        <div class="text-start">
                                                            <p>{{ $product->sku }}</p>
                                                            <h5 class="fw-bolder printer-head">{{ $product->name }}</h5>
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
                                                    </div>
                                                    <div class="card-footer bg-transparent border-top-0">
                                                        <div class="d-flex justify-content-between">
                                                            @if ($product->sale_price)
                                                            <h5 class="fw-bolder"><s class="text-muted">{{ $product->price }}</s>  {{$product->sale_price}} SAR</h5>
                                                            @else
                                                            <h5 class="fw-bolder">{{ $product->price }} SAR</h5>
                                                            @endif
                                                            <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
                                                            <a id="add-tocart" data-id="{{ $product->id }}"
                                                                class="arrow fw-bold clr add-to-cart">Add
                                                                to cart</a>
                                                        </div>
                                                    </div>
                                                </div>
                                            </a>
                                        </div>
                                    @endforeach
                                @endif
                            @endforeach
                        </div>
                    @endif
                    @if ($showProducts !== '')
                        @if (count($showProducts) > 9)
                            <div class="  bg-white mt-4">
                                <div class="pagination-buttons">
                                    {{ $showProducts->links() }}
                                </div>
                                <!-- <div class="">
                                    <button type="button" class="btn btn-outline-none bg-white" style=" height:52px; width:45px;font-size:20px">
                                        <i class="fa fa-angle-left"></i>
                                    </button>
                                    <button type="button" class="btn btn-outline-none " style="background-color:#F3F6F8 ; height:52px; width:45px">1</button>
                                    <button type="button" class="btn btn-outline-none bg-white" style=" height:52px; width:45px">2</button>
                                    <button type="button" class="btn btn-outline-none bg-white" style=" height:52px; width:45px">3</button>
                                </div>
                                <div class="">
                                    <button type="button" class="btn btn-outline-none bg-white" style=" height:52px; width:45px;font-size:20px"><i class="fa fa-angle-right"></i></button></button>
                                </div> -->
                            </div>
                        @endif
                    @else
                        <div class="  bg-white mt-4">
                            <div class="pagination-buttons">
                                {{ $products->links() }}
                            </div>
                        </div>
                    @endif

                </div>
            </div>
        </div>
    </main>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script>
        $(document).ready(function() {
            $('.filter-checkbox').change(function() {
                applyFilters();
            });
            
            
            function applyFilters() {
                var selectedSpeeds = getSelectedCheckboxValues('speed[]');
                var selectedBrands = getSelectedCheckboxValues('brand[]');

                if (selectedSpeeds.length > 0 || selectedBrands.length > 0) {
                    $('.product-card').each(function() {
                        var productSpeed = $(this).data('speed');
                        var productBrand = $(this).data('brand');

                        if ((selectedSpeeds.length === 0 || selectedSpeeds.includes(productSpeed)) &&
                            (selectedBrands.length === 0 || selectedBrands.includes(productBrand))) {
                            $(this).show();
                        }
                    });
                } else {
                    $('.product-card').show();
                }
            }

            function getSelectedCheckboxValues(checkboxName) {
                var selectedValues = [];
                $('input[name="' + checkboxName + '"]:checked').each(function() {
                    selectedValues.push($(this).val());
                });
                return selectedValues;
            }
        });
    </script>
    <script>
        $(document).ready(function() {

            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });

            $(".add-to-cart").click(function() {
                var user_id = @json($user_id ?? null);
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
                            if (response.success) {
                                var cartCount = parseInt($("#cart-badge").text(), 10);
                                var mobilecartCount = parseInt($("#mobile-cart-badge").text(), 10);
                                cartCount += 1;
                                mobilecartCount +=1;
                                $("#cart-badge").text(cartCount);
                                $("#mobile-cart-badge").text(mobilecartCount);
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
            if (response.success) {
                $("#cart-badge").text(cartCount);
                $("#mobile-cart-badge").text(mobilecartCount);
                Swal.fire({
                    title: 'Success!',
                    text: 'Product added to cart!',
                    icon: 'success',
                    iconColor: '#da5858',
                    confirmButtonColor: '#da5858',
                    confirmButtonText: 'OK'
                });
            }
        });
    </script>

    <script>
        const isDesktop = window.matchMedia("(min-width: 769px)").matches;

        function controlFromInput(fromSlider, fromInput, toInput, controlSlider) {
            const [from, to] = getParsed(fromInput, toInput);
            fillSlider(fromInput, toInput, '#C6C6C6', '#da5858', controlSlider);
            if (from > to) {
                fromSlider.value = to;
                fromInput.value = to;
                fromPrice.innerText = to + ' SAR';
            } else {
                fromSlider.value = from;
                fromPrice.innerText = from + ' SAR';
            }
        }

        function controlToInput(toSlider, fromInput, toInput, controlSlider) {
            const [from, to] = getParsed(fromInput, toInput);
            fillSlider(fromInput, toInput, '#C6C6C6', '#da5858', controlSlider);
            setToggleAccessible(toInput);
            if (from <= to) {
                toSlider.value = to;
                toInput.value = to;
                toPrice.innerText = to + ' SAR';
            } else {
                toInput.value = to;
                toPrice.innerText = to + ' SAR';
            }
        }

        function controlFromSlider(fromSlider, toSlider, fromInput) {
            const [from, to] = getParsed(fromSlider, toSlider);
            fillSlider(fromSlider, toSlider, '#C6C6C6', '#da5858', toSlider);
            if (from > to) {
                fromSlider.value = to;
                fromInput.value = to;
                fromPrice.innerText = to + 'SAR';
            } else {
                fromInput.value = from;
                fromPrice.innerText = from + 'SAR';
            }
        }

        function controlToSlider(fromSlider, toSlider, toInput) {
            const [from, to] = getParsed(fromSlider, toSlider);
            fillSlider(fromSlider, toSlider, '#C6C6C6', '#da5858', toSlider);
            setToggleAccessible(toSlider);
            if (from <= to) {
                toSlider.value = to;
                toInput.value = to;
                toPrice.innerText = to + ' SAR';
            } else {
                toInput.value = to;
                toSlider.value = to;
                toPrice.innerText = to + ' SAR';
            }
        }

        function getParsed(currentFrom, currentTo) {
            const fromValue = currentFrom.value.trim();
            const toValue = currentTo.value.trim();

            const parsedFrom = parseInt(fromValue, 10);
            const parsedTo = parseInt(toValue, 10);

            const from = isNaN(parsedFrom) ? '0 SAR' : parsedFrom;
            const to = isNaN(parsedTo) ? '0 SAR' : parsedTo;

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

        const fromSlider = isDesktop ? document.querySelector('#fromSlider') : document.querySelector('#fromSliderMobile');
        const toSlider = isDesktop ? document.querySelector('#toSlider') : document.querySelector('#toSliderMobile');
        const fromInput = isDesktop ? document.querySelector('#fromInput') : document.querySelector('#fromInputMobile');
        const toInput = isDesktop ? document.querySelector('#toInput') : document.querySelector('#toInputMobile');
        const fromPrice = isDesktop ? document.querySelector('#fromPrice') : document.querySelector('#fromPriceMobile');
        const toPrice = isDesktop ? document.querySelector('#toPrice') : document.querySelector('#toPriceMobile');
        fillSlider(fromSlider, toSlider, '#C6C6C6', '#da5858', toSlider);
        setToggleAccessible(toSlider);

        fromSlider.oninput = () => controlFromSlider(fromSlider, toSlider, fromInput);
        toSlider.oninput = () => controlToSlider(fromSlider, toSlider, toInput);
        fromInput.oninput = () => controlFromInput(fromSlider, fromInput, toInput, toSlider);
        toInput.oninput = () => controlToInput(toSlider, fromInput, toInput, toSlider);
    </script>
    <script>
        $(document).ready(function(){
            $('#low_to_high').click(function(e) {
                e.preventDefault();
                filterProducts('asc');
            });
            $('#high_to_low').click(function(e) {
                e.preventDefault();
                filterProducts('desc');
            });
            function filterProducts(order) {
                var $products = $('.product-card');
                $products.sort(function(a, b) {
                    var priceA = parseFloat($(a).data('price'));
                    var priceB = parseFloat($(b).data('price'));

                    if (order === 'asc') {
                        return priceA - priceB;
                    } else {
                        return priceB - priceA;
                    }
                }).appendTo('.product-container');
            }
        });
    </script>
@endsection
