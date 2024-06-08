@extends('frontend.layout.main')
@section('title', 'Office Tech - Work Stations')
@section('main.container')
<main class="main margin" >
    <div class="breadcrumb-container">
        <div class="container">
            <ul class="breadcrumb">
                <li><a href="/">Home</a></li>
                <li class="slash">/</li>
                <li>Workstations</li>
            </ul>
        </div>
    </div>
    <div class="container text-center mt-4 section-top" style="padding:0px 37px">
        <h2 class="text-start pages-heading">Work Station</h2>

        <details class=" d-block d-lg-none text-start mb-3">
            <summary class=" fs-3 text-end">Filter<i class="fa fa-filter"></i></summary>
            <div class="pages text-start col-12">
                <p class="filter-sidebar-option active">Multi-Functional</p>
                <p class="filter-sidebar-option">Single-Functional</p>
                <p class="filter-sidebar-option">Bundles</p>
                <p class="filter-sidebar-option">Headsets</p>
                <p class="filter-sidebar-option">Barcode Printers</p>
            </div>
            <div class="range filter-sidebar-div">

                <div class="range_container">

                    <div class="row">
                        <div class="col-6">
                            <p>500 SAR</p>
                        </div>
                        <div class="col-6 text-end">
                            <p>500 SAR</p>
                        </div>
                    </div>
                    <div class="form_control">
                        <div class="form_control_container filter-sidebar-range-input">
                            <input class="form_control_container__time__input" type="number" id="fromInput" value="10"
                                min="0" max="100" />

                        </div>
                        <div class="upto filter-sidebar-range-input-center-text">Upto</div>
                        <div class="form_control_container filter-sidebar-range-input">
                            <input class="form_control_container__time__input" type="number" id="toInput" value="30"
                                min="0" max="100" />
                        </div>
                    </div>
                </div>
            </div>
            <div class="brand filter-sidebar-div">
                <h4 class="filter-sidebar-heading">Printer Speed</h4>
                <input type="checkbox" class="checkbox" id="HP" name="hp" value="HP">
                <label for="hp" class="checkbox-label">4ms / <font class="filter-sidebar-checkbox-label">3
                    </font>
                </label><br>
                <input type="checkbox" class="checkbox" id="HP" name="hp" value="HP">
                <label for="hp" class="checkbox-label">2ms / <font class="filter-sidebar-checkbox-label">8
                    </font>
                </label><br>
                <input type="checkbox" class="checkbox" id="HP" name="hp" value="HP">
                <label for="hp" class="checkbox-label">5ms / <font class="filter-sidebar-checkbox-label">9
                    </font>
                </label><br>
            </div>
            <div class="screen-size filter-sidebar-div">
                <h4 class="filter-sidebar-heading">Paper Size</h4>
                <input type="checkbox" class="checkbox" id="HP" name="hp" value="HP">
                <label for="hp" class="checkbox-label">A1 / <font class="filter-sidebar-checkbox-label">10
                    </font>
                </label><br>
                <input type="checkbox" class="checkbox" id="HP" name="hp" value="HP">
                <label for="hp" class="checkbox-label">A2 / <font class="filter-sidebar-checkbox-label">4
                    </font>
                </label><br>
                <input type="checkbox" class="checkbox" id="HP" name="hp" value="HP">
                <label for="hp" class="checkbox-label">A3 / <font class="filter-sidebar-checkbox-label">7
                    </font>
                </label><br>
                <input type="checkbox" class="checkbox" id="HP" name="hp" value="HP">
                <label for="hp" class="checkbox-label">A4 / <font class="filter-sidebar-checkbox-label">8
                    </font>
                </label><br>
                <input type="checkbox" class="checkbox" id="HP" name="hp" value="HP">
                <label for="hp" class="checkbox-label">A5 / <font class="filter-sidebar-checkbox-label">3
                    </font>
                </label><br>
            </div>
            <div class="screen-size filter-sidebar-div">
                <h4 class="filter-sidebar-heading">Brand</h4>
                <input type="checkbox" class="checkbox" id="HP" name="hp" value="HP">
                <label for="hp" class="checkbox-label">Laser / <font class="filter-sidebar-checkbox-label">
                        10
                    </font>
                </label><br>
                <input type="checkbox" class="checkbox" id="HP" name="hp" value="HP">
                <label for="hp" class="checkbox-label">Samsung / <font class="filter-sidebar-checkbox-label">4
                    </font>
                </label><br>
                <input type="checkbox" class="checkbox" id="HP" name="hp" value="HP">
                <label for="hp" class="checkbox-label">Lenovo / <font class="filter-sidebar-checkbox-label">
                        7
                    </font>
                </label><br>
                <input type="checkbox" class="checkbox" id="HP" name="hp" value="HP">
                <label for="hp" class="checkbox-label">Apple / <font class="filter-sidebar-checkbox-label">8
                    </font>
                </label><br>
                <input type="checkbox" class="checkbox" id="HP" name="hp" value="HP">
                <label for="hp" class="checkbox-label">Philips / <font class="filter-sidebar-checkbox-label">3
                    </font>
                </label><br>
            </div>
            <div class="btn-div filter-sidebar-div">
                <button class="filter-sidebar-btn btn-bg-color w-75">Apply</button>
            </div>
            <div class="reset-div text-center">
                <p class="filter-sidebar-reset">Reset All</p>
            </div>
        </details>
        <div class="row">
            <div class="col-lg-3 text-start d-none d-lg-block">
                <div class="pages">
                    <p class="filter-sidebar-option active">Laptops</p>
                    <p class="filter-sidebar-option">LCD</p>
                    <p class="filter-sidebar-option">Computer</p>
                </div>
                <div class="range filter-sidebar-div">
                    <h4 class="filter-sidebar-heading">Price Range</h4>
                    <div class="range_container">
                        <div class="sliders_control">
                            <input id="fromSlider" type="range" value="10" min="0" max="100" />
                            <input id="toSlider" type="range" value="30" min="0" max="100" />
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
                                <input class="form_control_container__time__input" type="number" id="fromInput"
                                    value="10" min="0" max="100" />

                            </div>
                            <div class="upto filter-sidebar-range-input-center-text">Upto</div>
                            <div class="form_control_container filter-sidebar-range-input">
                                <input class="form_control_container__time__input" type="number" id="toInput" value="30"
                                    min="0" max="100" />
                            </div>
                        </div>
                    </div>
                </div>
                <div class="brand filter-sidebar-div">
                    <h4 class="filter-sidebar-heading">Brands</h4>
                    <input type="checkbox" class="checkbox" id="HP" name="hp" value="HP">
                    <label for="hp" class="checkbox-label">HP / <font class="filter-sidebar-checkbox-label">10</font>
                    </label><br>
                    <input type="checkbox" class="checkbox" id="HP" name="hp" value="HP">
                    <label for="hp" class="checkbox-label">Dell / <font class="filter-sidebar-checkbox-label">10</font>
                    </label><br>
                    <input type="checkbox" class="checkbox" id="HP" name="hp" value="HP">
                    <label for="hp" class="checkbox-label">Lenovo / <font class="filter-sidebar-checkbox-label">10
                        </font>
                    </label><br>
                </div>
                <div class="screen-size filter-sidebar-div">
                    <h4 class="filter-sidebar-heading">Screen Size</h4>
                    <input type="checkbox" class="checkbox" id="HP" name="hp" value="HP">
                    <label for="hp" class="checkbox-label">12" / <font class="filter-sidebar-checkbox-label">10</font>
                    </label><br>
                    <input type="checkbox" class="checkbox" id="HP" name="hp" value="HP">
                    <label for="hp" class="checkbox-label">10" / <font class="filter-sidebar-checkbox-label">10</font>
                    </label><br>
                    <input type="checkbox" class="checkbox" id="HP" name="hp" value="HP">
                    <label for="hp" class="checkbox-label">16" / <font class="filter-sidebar-checkbox-label">10</font>
                    </label><br>
                </div>
                <div class="btn-div filter-sidebar-div">
                    <button class="filter-sidebar-btn btn-bg-color w-75">Apply</button>
                    <p class="filter-sidebar-reset w-75 text-center">Reset All</p>
                </div>
            </div>
            <div class="col-lg-9">
                <!-- Feature Product and Services -->
                <!-- Dropdown  -->
                <div class="d-flex flex-column align-items-center flex-md-row justify-content-md-between py-2">
                    <div class="d-flex gap-4">
                        <p class="fw-bold text-black">Featured Products and Services</p>
                        <p>Recommended</p>
                        <p>New</p>
                    </div>
                    <div class="d-flex" style="gap:20px">
                        <p class="fw-bold sort-by">Sort By</p>

                        <div class="dropdown" style="float:right;">
                            <button class="dropbtn">Price (Ascending) &nbsp<i class="fa fa-angle-down"></i></button>
                            <div class="dropdown-content">
                                <a href="#">Low To High</a>
                                <a href="#">High To Low</a>
                                <a href="#">Medium</a>
                            </div>

                        </div>
                    </div>

                </div>
                <div class="row mb-4">
                    <div class="col-md-6 col-lg-4 col-12">
                        <div class="card mt-2">
                            <div class="card-body">
                                <span class="position-absolute sale-badge">Sale 25%</span>
                                <img src="{{('images/lp1.png')}}" class="py-3" width="150px" height="110px" alt="">
                                <div class="text-start ">
                                    <p>RM32141566737</p>
                                    <h5 class="fw-bolder">Printer Epson L805 Black</h5>
                                    <p class="tick text-success">In stock</p>
                                </div>
                            </div>
                            <div class="card-footer bg-transparent border-top-0">
                                <div class="d-flex justify-content-between ">
                                    <h5 class="fw-bold">1 500 SAR</h5>
                                    <p class="arrow fw-bold font-color ">Add to cart</p>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-6 col-lg-4 col-12">
                        <div class="card mt-2">
                            <div class="card-body">
                                <img src="{{('images/lp2.png')}}" class="py-3" width="150px" height="110px" alt="">
                                <div class="text-start ">
                                    <p>RM32141566737</p>
                                    <h5 class="fw-bolder">Printer Epson L1300 Black</h5>
                                    <p class="tick text-success">In stock</p>
                                </div>
                            </div>
                            <div class="card-footer bg-transparent border-top-0">
                                <div class="d-flex justify-content-between ">
                                    <h5 class="fw-bold">1 500 SAR</h5>
                                    <p class="arrow fw-bold font-color ">Add to cart</p>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-6 col-lg-4 col-12">
                        <div class="card mt-2">
                            <div class="card-body">
                                <img src="{{('images/lp3.png')}}" class="py-3" width="150px" height="110px" alt="">
                                <div class="text-start ">
                                    <p>RM32141566737</p>
                                    <h5 class="fw-bolder">Xiaomi Wireless Foto Printer White</h5>
                                    <p class="tick text-success">In stock</p>
                                </div>
                            </div>
                            <div class="card-footer bg-transparent border-top-0">
                                <div class="d-flex justify-content-between ">
                                    <h5 class="fw-bold">1 500 SAR</h5>
                                    <p class="arrow fw-bold font-color ">Add to cart</p>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-6 col-lg-4 col-12">
                        <div class="card mt-2">
                            <div class="card-body">
                                <img src="{{('images/lp4.png')}}" class="py-3" width="150px" height="110px" alt="">
                                <div class="text-start ">
                                    <p>RM32141566737</p>
                                    <h5 class="fw-bolder">Ribbon Cartridge BROTHER</h5>
                                    <p class="tick text-success">In stock</p>
                                </div>
                            </div>
                            <div class="card-footer bg-transparent border-top-0">
                                <div class="d-flex justify-content-between ">
                                    <h5 class="fw-bold">1 500 SAR</h5>
                                    <p class="arrow fw-bold font-color ">Add to cart</p>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-6 col-lg-4 col-12">
                        <div class="card mt-2">
                            <div class="card-body">
                                <span class="position-absolute sale-badge">Sale 25%</span>
                                <img src="{{('images/lp5.png')}}" class="py-3" width="150px" height="110px" alt="">
                                <div class="text-start ">
                                    <p>RM32141566737</p>
                                    <h5 class="fw-bolder">Ink for Epson 664 Cyan printer</h5>
                                    <p class="tick text-success">In stock</p>
                                </div>
                            </div>
                            <div class="card-footer bg-transparent border-top-0">
                                <div class="d-flex justify-content-between ">
                                    <h5 class="fw-bold">1 500 SAR</h5>
                                    <p class="arrow fw-bold font-color">Add to cart</p>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-6 col-lg-4 col-12">
                        <div class="card mt-2">
                            <div class="card-body">
                                <img src="{{('images/lp6.png')}}" class="py-3" width="150px" height="110px" alt="">
                                <div class="text-start ">
                                    <p>RM32141566737</p>
                                    <h5 class="fw-bolder">Printer Epson L805 Black</h5>
                                    <p class="tick text-success">In stock</p>
                                </div>
                            </div>
                            <div class="card-footer bg-transparent border-top-0">
                                <div class="d-flex justify-content-between ">
                                    <h5 class="fw-bold">2 000 SAR</h5>
                                    <p class="arrow fw-bold font-color ">Add to cart</p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="d-flex justify-content-between align-items-center bg-white mt-4" style="height:52px">
                    <div class="">
                        <!-- Pagination buttons will be added here -->
                        <button type="button" class="btn btn-outline-none bg-white"
                            style=" height:52px; width:45px;font-size:20px">
                            <i class="fa fa-angle-left"></i>
                        </button>
                        <button type="button" class="btn btn-outline-none "
                            style="background-color:#F3F6F8 ; height:52px; width:45px">1</button>
                        <button type="button" class="btn btn-outline-none bg-white"
                            style=" height:52px; width:45px">2</button>
                        <button type="button" class="btn btn-outline-none bg-white"
                            style=" height:52px; width:45px">3</button>
                    </div>
                    <div class="">
                        <!-- Pagination buttons will be added here -->
                        <button type="button" class="btn btn-outline-none bg-white"
                            style=" height:52px; width:45px;font-size:20px"><i
                                class="fa fa-angle-right"></i></button></button>
                    </div>
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
<!-- BootStrap Script -->
@endsection