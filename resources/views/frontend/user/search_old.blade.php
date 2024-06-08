@extends('frontend.layout.main')
@section('title', 'Office Tech - Search')
@section('main.container')
<meta name="csrf-token" content="{{ csrf_token() }}">
<main class="main" style="margin-top:158px;">
    <div class="container">
        <div class="row">
            <div class="col-lg-3 text-start d-none d-lg-block">
                <form
                method="GET" action="{{route('sub.category.products', ['slug' => $slug])}}">
                    @csrf
                    <div class="range filter-sidebar-div">
                        <h4 class="filter-sidebar-heading">Price Range</h4>
                        <div class="range_container">
                            <div class="sliders_control">
                                <input id="fromSlider" type="range" value="" min="500" max="50000" />
                                <input id="toSlider" type="range" value="" min="500" max="50000" />
                            </div>
                            <div class="row">
                                <div class="col-6 text-center">
                                    <p>500 SAR</p>
                                </div>
                                <div class="col-6 text-center">
                                    <p>500 SAR</p>
                                </div>
                            </div>
                            <div class="form_control">
                                <div class="form_control_container filter-sidebar-range-input">
                                    <input class="form_control_container__time__input" type="number" name="fromInput"
                                        id="fromInput" value="" min="500" max="50000" />

                                </div>
                                <div class="upto filter-sidebar-range-input-center-text">Upto</div>
                                <div class="form_control_container filter-sidebar-range-input">
                                    <input class="form_control_container__time__input" type="number" name="toInput"
                                        id="toInput" value="" min="500" max="50000" />
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
                                value="{{ $uniqueAttribute['speed'] }}">
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
                                value="{{ $uniqueBrand['name'] }}">
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
                                value="{{ $uniquePaperSize['paper_size'] }}">
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
                <div class="row">
                    @foreach ($filteredProducts as $filteredProduct)
                        @if ($filteredProduct->status == 1)
                            <div class="col-md-4 mb-4">
                                <a href="{{ route('user.product_details', $filteredProduct->slug) }}"
                                    class="text-decoration-none font-color-black" style="color: inherit">
                                    <div class="card border-0">
                                        <div class="card-body">
                                            @if ($filteredProduct->sale_price)
                                                <span class="position-absolute sale-badge">Sale 25%</span>
                                            @endif
                                            @if ($filteredProduct->galleryImages)
                                                <img src="{{ url('images/product_images/' . $filteredProduct->galleryImages) }}"
                                                    class="py-3" alt="{{ $filteredProduct->name }}"
                                                    style="height: 222px !important; width:209px !important; object-fit:contain !important;">
                                            @else
                                                <img src="{{ url('images/no-image.png') }}"
                                                    style="height: 222px !important; width:209px !important; object-fit:contain !important;">
                                            @endif

                                            <div class="text-start">
                                                <p>{{ $filteredProduct->sku }}</p>
                                                <h5 class="fw-bolder">{{ $filteredProduct->name }}</h5>
                                                @if ($filteredProduct->availability == 'in-stock')
                                                    <p class="tick text-success">
                                                        {{ str_replace('-', ' ', ucwords($filteredProduct->availability)) }}
                                                    </p>
                                                @elseif ($filteredProduct->availability == 'out-of-stock')
                                                    <p class="text-danger">
                                                        {{ str_replace('-', ' ', ucwords($filteredProduct->availability)) }}
                                                    </p>
                                                @endif
                                            </div>
                                        </div>
                                        <div class="card-footer bg-transparent border-top-0">
                                            <div class="d-flex justify-content-between">
                                                <h5 class="fw-bold">{{ $filteredProduct->price }} SAR</h5>
                                                <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
                                                <a id="add-tocart" data-id="{{ $filteredProduct->id }}"
                                                    class="arrow fw-bold clr @if ($filteredProduct->quantity <= 0) disabled-link text-muted arrow-disable @else add-to-cart @endif">Add
                                                    to cart</a>
                                            </div>
                                        </div>
                                    </div>
                                </a>
                            </div>
                        @endif
                    @endforeach
                </div>
            </div>
        </div>
    </div>
</main>
<script>
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
        fillSlider(fromInput, toInput, '#da5858', '#00A9E1', controlSlider);
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
        fillSlider(fromSlider, toSlider, '#C6C6C6', '#da5858', toSlider);
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
@endsection
