@extends('frontend.layout.main')
@section('title', 'Office Tech - Home')
@section('main.container')
<style>
    div:where(.swal2-container) button:where(.swal2-styled).swal2-default-outline:focus
    {
    box-shadow: 0 0 0 3px rgba(255, 255, 255, 0.5) !important;
    }
    div:where(.swal2-icon).swal2-info {
    border-color: rgb(218, 88, 88) !important;
    color: rgb(218, 88, 88) !important;
    }
    .slider-text ul
    {
        padding-left: 1rem;
    }
    .slider-text div
    {

        font-size: 60px;
        font-weight: 700;
    }
    .text-shadow
    {
        text-shadow:5px -5px #fe8c3d;
        color: #171717;
    }
    .text-shadow::after
    {
        content: '';
        height: 47px;
        width: 2px;
        background: lightgray;
        margin-left: 27px;
        text-shadow: none;
        display: inline-block;
    }
    .slider-text ul li::marker {
        content: "-";
        padding-right: 5px;
    }
    .slider-text ul li {
        padding-left: 10px;
        color: #535355 !important;
    }
    .slider-product-name
    {
        font-size: xx-large !important;
    }
    .buy-now-btn
    {
        background-color: transparent;
        border-radius: 5px;
        color: black !important;
        border: 1px solid black;
        padding: 15px 30px !important;
    }
    .buy-now-btn:hover
    {
        background: black;
        color: white !important;
    }
    .bundle-image-div
    {
        bottom: 72px;
        right: 15px;
    }
    @media(min-width:1444px)
    {
        .bundle-image-div
        {
            bottom: 72px;
            right: 70px;
        }
    }
</style>
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
</style>
@endif
<div class="container-fluid" style="padding-left: 0px;padding-right:0px;margin-top:138px">
    @if ($sliders->count() > 0)  
    <div id="carouselExampleIndicators" class="carousel slide" data-bs-ride="carousel" data-bs-interval="false">
        <div class="carousel-indicators main-index-caresoul-indicators">
            @foreach($sliders as $key => $slider)
                <button type="button" data-bs-target="#carouselExampleIndicators" data-bs-slide-to="{{ $key }}" {{ $key === 0 ? 'class=active' : '' }} aria-label="Slide {{ $key + 1 }}"></button>
            @endforeach
        </div>
        <div class="carousel-inner">
            @foreach($sliders as $key => $slider)
                <div class="carousel-item {{ $key === 0 ? 'active' : '' }} bg-white">
                    <div class="row">
                        <!-- First 6 columns -->
                        <div class="col-md-6 d-flex align-items-center" style="direction: unset;">
                            <div class="d-flex flex-column align-items-center cr-head slider-text">
                                {!! $slider->description !!}
                                <div class="d-flex align-items-start w-100">
                                    <a href="{{route('user.product_details', $slider->product_slug)}}" class="nav-item nav-link btn btn-text btn-common-blue mb-4 buy-now-btn">Buy Now !</a>
                                </div>
                            </div>
                        </div>
                        <!-- Second 6 columns -->
                        <div class="col-md-6" style="background-image: url('images/Banner-New.png');background-repeat: no-repeat;background-size: 870px 556px;">
                            <div class="row">
                                <div class="col-8">
                                    <img src="{{ asset('images/' . $slider->image) }}" alt="Image"
                                    class="main-index-slider-printer-img">
                                </div>
                                <div class="col-4">
                                    <div style="position: absolute;" class="bundle-image-div d-none d-xl-block">
                                        <p class="fs-4 mb-0 fw-bold" style="color:rgb(254, 140, 61); font-size:30px !important;" id="prints"></p>
                                        <p class="fs-4 mb-0 fw-bold" style="color:rgb(254, 140, 61); font-size:30px !important;" id="years"></p>
                                        <p class="fs-4 mb-0 fw-bold" style="color: #fe8c3d" id="product-name"></p>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>
    </div>
    @else
    <div id="carouselExampleIndicators" class="carousel slide" data-bs-ride="carousel" data-bs-interval="false">
        <div class="carousel-indicators main-index-caresoul-indicators">
            <button type="button" data-bs-target="#carouselExampleIndicators" data-bs-slide-to="0" class="active"
                aria-current="true" aria-label="Slide 1"></button>
            <button type="button" data-bs-target="#carouselExampleIndicators" data-bs-slide-to="1"
                aria-label="Slide 2"></button>
            <button type="button" data-bs-target="#carouselExampleIndicators" data-bs-slide-to="2"
                aria-label="Slide 3"></button>
        </div>
        <div class="carousel-inner">
            <div class="carousel-item active bg-white">
                <div class="row">
                    <!-- First 6 columns -->
                    <div class="col-md-6 d-flex align-items-center" style="direction: unset;">
                        <div class="d-flex flex-column align-items-start cr-head slider-text">
                            <h2 class="main-slider-heading">Quality and Speed: Your Perfect Printer</h2>
                            <h3 class="main-slider-heading-2">Needs vary, quality remains the same</h3>
                            <p class="main-slider-p">Experience <font style="color: #323232;
                                font-family: Figtree;
                                font-size: 18px;
                                font-style: normal;
                                font-weight: 700;
                                line-height: normal;
                                letter-spacing: 0.183px;">the ultimate printing precision </font> and <font style="color: #323232;
                                font-family: Figtree;
                                font-size: 18px;
                                font-style: normal;
                                font-weight: 700;
                                line-height: normal;
                                letter-spacing: 0.183px;">efficiency</font> with our cutting-edge printers. Explore a
                                world of crisp detail and rapid output.</p>
                            <a class="nav-item nav-link btn btn-text btn-common-blue"
                                style="background-color:#da5858">Catalog<img src="{{asset('images/arrow-white.png')}}"
                                    alt="arrow" class="btn-arrow"></a>
                        </div>
                    </div>
                    <!-- Second 6 columns -->
                    <div class="col-md-6">
                        <div class="float-end">
                            <img src="{{asset('images/slider-back-img.png')}}" alt="Image"
                                class="img-fluid main-index-slider-glass-img" style="z-index: 2;position: relative;">
                        </div>
                        <img src="{{asset('images/printer2.png')}}" alt="Image"
                            class="img-fluid main-index-slider-printer-img" style="z-index: 2;">
                        <div class="main-index-slider-circle-img" style="z-index: 1;">
                            <svg width="236" height="236" viewBox="0 0 236 236" fill="none"
                                xmlns="http://www.w3.org/2000/svg">
                                <path
                                    d="M171.315 118.711C171.315 148.304 147.428 172.263 118 172.263C88.5721 172.263 64.6847 148.304 64.6847 118.711C64.6847 89.1175 88.5721 65.1587 118 65.1587C147.428 65.1587 171.315 89.1175 171.315 118.711Z"
                                    stroke="#da5858" stroke-width="9" />
                                <circle cx="118" cy="118.474" r="73.8755" stroke="#da5858" stroke-width="2" />
                                <circle cx="118" cy="118" r="117" stroke="#da5858" stroke-width="2" />
                            </svg>
                        </div>
                    </div>
                </div>
            </div>
            <div class="carousel-item bg-white">
                <div class="row">
                    <!-- First 6 columns -->
                    <div class="col-md-6 d-flex align-items-center" style="direction: unset;">
                        <div class="d-flex flex-column align-items-start cr-head slider-text">
                            <h2 class="main-slider-heading">Quality and Speed: Your Perfect Printer</h2>
                            <h3 class="main-slider-heading-2">Needs vary, quality remains the same</h3>
                            <p class="main-slider-p">Experience <font style="color: #323232;
                                font-family: Figtree;
                                font-size: 18px;
                                font-style: normal;
                                font-weight: 700;
                                line-height: normal;
                                letter-spacing: 0.183px;">the ultimate printing precision </font> and <font style="color: #323232;
                                font-family: Figtree;
                                font-size: 18px;
                                font-style: normal;
                                font-weight: 700;
                                line-height: normal;
                                letter-spacing: 0.183px;">efficiency</font> with our cutting-edge printers. Explore a
                                world of crisp detail and rapid output.</p>
                            <a class="nav-item nav-link btn btn-text btn-common-blue"
                                style="background-color:#da5858">Catalog<img src="{{asset('images/arrow-white.png')}}"
                                    alt="arrow" class="btn-arrow"></a>
                        </div>
                    </div>

                    <!-- Second 6 columns -->
                    <div class="col-md-6">
                        <div class="float-end">
                            <img src="{{asset('images/slider-back-img.png')}}" alt="Image"
                                class="img-fluid main-index-slider-glass-img" style="z-index: 2;position: relative;">
                        </div>
                        <img src="{{asset('images/printer2.png')}}" alt="Image"
                            class="img-fluid main-index-slider-printer-img" style="z-index: 2;">
                        <div class="main-index-slider-circle-img" style="z-index: 1;">
                            <svg width="236" height="236" viewBox="0 0 236 236" fill="none"
                                xmlns="http://www.w3.org/2000/svg">
                                <path
                                    d="M171.315 118.711C171.315 148.304 147.428 172.263 118 172.263C88.5721 172.263 64.6847 148.304 64.6847 118.711C64.6847 89.1175 88.5721 65.1587 118 65.1587C147.428 65.1587 171.315 89.1175 171.315 118.711Z"
                                    stroke="#da5858" stroke-width="9" />
                                <circle cx="118" cy="118.474" r="73.8755" stroke="#da5858" stroke-width="2" />
                                <circle cx="118" cy="118" r="117" stroke="#da5858" stroke-width="2" />
                            </svg>
                        </div>

                    </div>
                </div>
            </div>
            <div class="carousel-item bg-white">
                <div class="row">
                    <!-- First 6 columns -->
                    <div class="col-md-6 d-flex align-items-center " style="direction: unset;">
                        <div class="d-flex flex-column align-items-start cr-head slider-text">
                            <h2 class="main-slider-heading">Quality and Speed: Your Perfect Printer</h2>
                            <h3 class="main-slider-heading-2">Needs vary, quality remains the same</h3>
                            <p class="main-slider-p">Experience <font style="color: #323232;
                                font-family: Figtree;
                                font-size: 18px;
                                font-style: normal;
                                font-weight: 700;
                                line-height: normal;
                                letter-spacing: 0.183px;">the ultimate printing precision </font> and <font style="color: #323232;
                                font-family: Figtree;
                                font-size: 18px;
                                font-style: normal;
                                font-weight: 700;
                                line-height: normal;
                                letter-spacing: 0.183px;">efficiency</font> with our cutting-edge printers. Explore a
                                world of crisp detail and rapid output.</p>
                            <a class="nav-item nav-link btn btn-text btn-common-blue"
                                style="background-color:#da5858">Catalog<img src="{{asset('images/arrow-white.png')}}"
                                    alt="arrow" class="btn-arrow"></a>
                        </div>
                    </div>
                    <!-- Second 6 columns -->
                    <div class="col-md-6">
                        <div class="float-end">
                            <img src="{{asset('images/slider-back-img.png')}}" alt="Image"
                                class="img-fluid main-index-slider-glass-img" style="z-index: 2;position: relative;">
                        </div>
                        <img src="{{asset('images/printer2.png')}}" alt="Image"
                            class="img-fluid main-index-slider-printer-img" style="z-index: 2;">
                        <div class="main-index-slider-circle-img" style="z-index: 1;">
                            <svg width="236" height="236" viewBox="0 0 236 236" fill="none"
                                xmlns="http://www.w3.org/2000/svg">
                                <path
                                    d="M171.315 118.711C171.315 148.304 147.428 172.263 118 172.263C88.5721 172.263 64.6847 148.304 64.6847 118.711C64.6847 89.1175 88.5721 65.1587 118 65.1587C147.428 65.1587 171.315 89.1175 171.315 118.711Z"
                                    stroke="#da5858" stroke-width="9" />
                                <circle cx="118" cy="118.474" r="73.8755" stroke="#da5858" stroke-width="2" />
                                <circle cx="118" cy="118" r="117" stroke="#da5858" stroke-width="2" />
                            </svg>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    @endif
</div>
<div class="container text-center mt-4 section-top">
    <!-- Feature Product and Services -->
    <div class="flex-col d-sm-flex  justify-content-sm-between align-items-baseline py-2  " >
        <div class="d-sm-flex flex-col gap-4 py-4 py-sm-0">
            <div class="d-flex gap-5">
            <a class="fw-bold" id="featured-tab" style="font-size:16px" onclick="loadData('featured-products')" style="font-size:20px">Featured Products and Services</a>
            <a class="tab" id="recommended-tab" style="font-size:16px" onclick="loadData('recommended-products')" style="font-size:20px">Recommended Products</a>
            </div>
            <a class="tab d-none d-sm-block" style="font-size:16px" data-tab="new" id="new-tab" onclick="loadData('latest-products')">New</a>
        </div>
        <div class="d-flex justify-content-between  ">
        <a class="tab d-block d-sm-none" style="font-size:16px; padding-left:25px" data-tab="new" id="new-tab" onclick="loadData('latest-products')">New</a>
    </div>
    </div>
    <div class="row mb-4" id="product-row" style="row-gap:25px"></div>
    <!-- <div class="d-flex justify-content-between align-items-center bg-white mt-4" style="height:52px">
        <div class="">
            <button type="button" class="btn btn-outline-none bg-white" style=" height:52px; width:45px;font-size:20px">
                <i class="fa fa-angle-left"></i>
            </button>
            <button type="button" class="btn btn-outline-none "
                style="background-color:#F3F6F8 ; height:52px; width:45px">1</button>
            <button type="button" class="btn btn-outline-none bg-white" style=" height:52px; width:45px">2</button>
            <button type="button" class="btn btn-outline-none bg-white" style=" height:52px; width:45px">3</button>
        </div>
        <div class="">
            <button type="button" class="btn btn-outline-none bg-white"
                style=" height:52px; width:45px;font-size:20px"><i class="fa fa-angle-right"></i></button></button>
        </div>
    </div> -->
    <!-- Product catagories -->
    <div class="d-flex flex-column flex-md-row justify-content-between align-items-center py-2 mt-5">
        <div class="d-flex gap-4">
            <p class="fw-bold text-black" style="font-size:28px">Product Categories</p>

        </div>
    </div>
    <div class="row gy-1">
        @foreach ($main_categories as $key => $main_category)
            @if ($key == 0)
                <div class="col-12 col-sm-6 col-md-12 col-lg-6 bg-white border border-5 rounded d-flex position-relative pro-cat" style="border-color:#F3F6F8 !important; padding-left:0px !important;">
                    <img src="{{asset('images/im14.png')}}" width="70%" height="276px" alt="">
                    <div class="position-absolute" style="left:50% ; top:15%">
                        <img src="{{asset('images/category_images/' . $main_category->image)}}" width="250px" alt="">
                    </div>
                    <div class="position-absolute d-flex flex-column justify-content-between py-4"
                        style="height:100% ; left:5%">
                        <button class="w-75 text-white sale-badge " style="background-color:#da5858  !important; border:none">New</button>
                        <div class="text-white text-start"> 
                            <h5>{{$main_category->category_name}}</h5>
                            @if ($main_category->subCategories->count() > 0 && $main_category->id == $main_category->subCategories->first()->parent_category_id)
                                @foreach ($main_category->subCategories->take(1) as $subcategory)
                                <p>Over {{$subcategory->product->count()}}  Models</p>
                                    <p class="arrow-white"><a href="{{ route('sub.category.products', $subcategory->slug) }}" class="text-white">Go to catalog</a></p>
                                @endforeach
                                @else
                                    <p class="pt-4 arrow text-info fw-bold" style="margin-top:80px"><a href="" class="font-color" disabled>Go to catalog</a></p>
                            @endif
                        </div>
                    </div>
                </div>
            @else
                <div class="col-12 col-sm-6 col-md-6 col-lg-3 border border-5 bg-white rounded" style="border-color:#F3F6F8 !important;">
                    <img src="{{asset('images/category_images/' . $main_category->image)}}" style="width: 295px; height: 168px;object-fit:contain" class="pt-5">
                    <p>{{$main_category->category_name}}</p>
                    @if ($main_category->subCategories->count() > 0 && $main_category->id == $main_category->subCategories->first()->parent_category_id)
                        @foreach ($main_category->subCategories->take(1) as $subcategory)
                            <p class="pt-4 arrow text-info fw-bold" style="margin-top:80px"><a href="{{ route('sub.category.products', $subcategory->slug) }}" class="font-color">Go to catalog</a></p>
                        @endforeach
                        @else
                            <p class="pt-4 arrow text-info fw-bold" style="margin-top:80px"><a class="font-color" disabled>Go to catalog</a></p>
                    @endif
                </div>
            @endif
        @endforeach
    </div>
    <!-- Super Offers -->
    <!-- <div style="margin-top:50px">
        <h3 class="text-start" style="font-size:28px; font-weight:700; color:black">Super offers</h3>
        <div class="d-flex flex-column flex-lg-row gap-3 mt-5 top-50">
            <div class="border w-100 text-start d-flex flex-column flex-sm-row justify-content-between  py-5 px-4"
                style="background-color:#00A9E1">
                <div class="">
                    <div class=" rounded  justify-content-center align-items-center   pt-1 mb-5"
                        style="width:89px ; height:30px; background-color:#E60188; ">
                        <p style="font-size:15px; color:white; text-align:center">sale 25%</p>
                    </div>
                    <h4 style="   color:white; font-weight:700" class="super-head">Print Smarter, Save
                    </h4>
                    <h4 style="font-size:28px ; color:white; font-weight:700">Bigger!</h4>
                    <p>Impeccable quality</p>
                    <p class="arrow-white text-white catalog-text" style=" text-wrap:nowrap">Go to catalog</p>
                </div>
                <div class="super-img">
                    <img src="{{asset('images/printer.png')}}" alt="">
                </div>
            </div>
            <div class="border w-100 text-start bg-warning d-flex flex-column flex-sm-row  justify-content-between py-5 px-3"
                style="background-color:#FDDF00">
                <div>
                    <div class=" rounded   justify-content-center align-items-center   pt-1 mb-5" o
                        style="width:89px ; height:30px; background-color:white; ">
                        <p style="font-size:15px; color:black; text-align:center">sale 25%</p>
                    </div>
                    <h4 style=" color:black; font-weight:700" class="super-head">Save Big on </h4>
                    <h4 style="font-size:28px ; color:black; font-weight:700">Workstations!</h4>
                    <p>Impeccable quality</p>
                    <p class="arrow-white catalog-text" >Go to catalog</p>
                </div>
                <div class="super-img mb-5">
                    <img src="{{asset('images/im16.png')}}" alt="">
                </div>
            </div>
        </div>
    </div> -->
    <!-- Brand -->
    <h3 class="text-start fw-bold " style="font-size:28px; font-weight:700; color:black; margin-top:60px">Brands</h3>
    <div class="">
        <div class="row">
            <div class="col-md-12">
                <div class="lc-block">
                    <div id="carouselLogos" class="carousel slide pt-5 pb-4" data-bs-ride="carousel">
                        <div class="carousel-inner">
                            @php $brandsChunked = $brands->chunk(6); @endphp
                            @foreach($brandsChunked as $key => $brandGroup)
                                <div class="carousel-item @if($key === 0) active @endif">
                                    <div class="row">
                                        @foreach($brandGroup as $brand)
                                            <div class="col-6 col-lg-2 align-self-center">
                                                <img class="d-block px-3 mb-3 brands-img" style="height: 38px; width:154px;" src="{{ asset('images/' . $brand->image) }}"
                                                    alt="{{ $brand->brand_name }}" />
                                            </div>
                                        @endforeach
                                    </div>
                                </div>
                            @endforeach
                        </div>
                        <center>
                            <ol class="carousel-indicators position-relative main-index-secondcaresoul-indicators">
                                @foreach($brandsChunked as $key => $brandGroup)
                                    <li data-bs-target="#carouselLogos" data-bs-slide-to="{{ $key }}" @if($key === 0) class="active" @endif></li>
                                @endforeach
                            </ol>
                        </center>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- services -->
    <div class="row">
        <h3 class="text-start fw-bold my-4" style="font-size:28px; font-weight:700; color:black">Services</h3>
        <div class="col-12 col-md-4 col-12 mt-2 mb-3 mb-sm-0">
            <div class="card border-0">
                <div class="card-body p-0">
                    <img src="{{asset('images/im17.png')}}" alt="">
                    <div class="text-start ">

                        <h5 class="text-black fw-bold p-2 mt-2" style="font-size:18px">Service Ticket</h5>
                        <p class="text-black p-2" style="font-size:16px">ur experts ensure fast and high-quality
                            servicing
                            of your
                            equipment. We
                            are always ready to address any issues, so you can have confidence in the reliability of
                            your technology</p>
                    </div>
                </div>
                <div class="card-footer bg-transparent border-top-0">
                    <div class="d-flex justify-content-between ">
                        <h5 class="fw-bold">1 500 SAR</h5>
                        <p class="arrow fw-bold text-info font-color">More</p>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-12 col-md-4 col-12 mt-2 mb-3 mb-sm-0">
            <div class="card border-0">
                <div class="card-body p-0">

                    <img src="{{asset('images/im18.png')}}" alt="">
                    <div class="text-start ">

                        <h5 class="text-black fw-bold p-2 mt-2" style="font-size:18px">Service Ticket</h5>
                        <p class="text-black p-2" style="font-size:16px">ur experts ensure fast and high-quality
                            servicing
                            of your
                            equipment. We
                            are always ready to address any issues, so you can have confidence in the reliability of
                            your technology</p>
                    </div>
                </div>
                <div class="card-footer bg-transparent border-top-0">
                    <div class="d-flex justify-content-between ">
                        <h5 class="fw-bold">1 500 SAR</h5>
                        <p class="arrow fw-bold text-info font-color">More</p>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-12 col-md-4 col-12 mt-2">
            <div class="card border-0">
                <div class="card-body p-0">

                    <img src="{{asset('images/im19.png')}}" alt="">
                    <div class="text-start ">
                        <h5 class="text-black fw-bold p-2 mt-2" style="font-size:18px">Service Ticket</h5>
                        <p class="text-black p-2" style="font-size:16px">ur experts ensure fast and high-quality
                            servicing
                            of your
                            equipment. We
                            are always ready to address any issues, so you can have confidence in the reliability of
                            your technology</p>
                    </div>
                </div>
                <div class="card-footer bg-transparent border-top-0">
                    <div class="d-flex justify-content-between ">
                        <h5 class="fw-bold">1 500 SAR</h5>
                        <p class="arrow fw-bold text-info font-color">More</p>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- solution and solution -->
    <!-- <div class="d-flex flex-column flex-md-row justify-content-between align-items-center py-2 "
        style="margin-top:60px">
        <div class="d-flex gap-4">
            <p class="fw-bold text-black" style="font-size:28px">Solutions & Software</p>
        </div>
        <div>
            <p class="arrow text-info fw-bold font-color" style="font-size:15px">All Solutions & Software</p>
        </div>
    </div>
    <div class="row g-3 " style="margin-left: 0px ; margin-top:10px">
        <div class="col-md-4 col-lg-2 col-12">
            <div class="card">
                <div class="card-body">
                    <img src="{{asset('images/im20.png')}}" class="pt-3" width="150px" height="110px" alt="">
                    <div class="text-start ">
                        <h5 class="fw-bolder mt-4">Microsoft Packet</h5>
                    </div>
                </div>
                <div class="card-footer bg-transparent border-top-0">
                    <div class="d-flex justify-content-between ">
                        <h5 class="fw-bold solutions-text">145 SAR</h5>
                        <p class="arrow fw-bold text-info font-color">Buy</p>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-md-4 col-lg-2 col-12">
            <div class="card">
                <div class="card-body">
                    <img src="{{asset('images/im21.png')}}" class="pt-3" width="150px" height="110px" alt="">
                    <div class="text-start ">

                        <h5 class="fw-bolder mt-4">Microsoft Packet</h5>

                    </div>
                </div>
                <div class="card-footer bg-transparent border-top-0">
                    <div class="d-flex justify-content-between ">
                        <h5 class="fw-bold solutions-text">145 SAR</h5>
                        <p class="arrow fw-bold text-info font-color">Buy</p>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-md-4 col-lg-2 col-12">
            <div class="card">
                <div class="card-body">
                    <img src="{{asset('images/im22.png')}}" class="pt-3" width="150px" height="110px" alt="">
                    <div class="text-start ">

                        <h5 class="fw-bolder mt-4">Microsoft Packet</h5>

                    </div>
                </div>
                <div class="card-footer bg-transparent border-top-0">
                    <div class="d-flex justify-content-between ">
                        <h5 class="fw-bold solutions-text">145 SAR</h5>
                        <p class="arrow fw-bold text-info font-color">Buy</p>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-md-4 col-lg-2 col-12">
            <div class="card">
                <div class="card-body">
                    <img src="{{asset('images/im23.png')}}" class="pt-3" width="150px" height="110px" alt="">
                    <div class="text-start ">
                        <h5 class="fw-bolder mt-4">Microsoft Packet</h5>
                    </div>
                </div>
                <div class="card-footer bg-transparent border-top-0">
                    <div class="d-flex justify-content-between ">
                        <h5 class="fw-bold solutions-text">145 SAR</h5>
                        <p class="arrow fw-bold text-info font-color">Buy</p>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-md-4 col-lg-2 col-12">
            <div class="card">
                <div class="card-body">
                    <img src="{{asset('images/im24.png')}}" class="pt-3" width="150px" height="110px" alt="">
                    <div class="text-start ">
                        <h5 class="fw-bolder mt-4">Microsoft Packet</h5>
                    </div>
                </div>
                <div class="card-footer bg-transparent border-top-0">
                    <div class="d-flex justify-content-between ">
                        <h5 class="fw-bold solutions-text" >145 SAR</h5>
                        <p class="arrow fw-bold text-info font-color">Buy</p>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-md-4 col-lg-2 col-12">
            <div class="card">
                <div class="card-body">
                    <img src="{{asset('images/im25.png')}}" class="pt-3" width="150px" height="110px" alt="">
                    <div class="text-start ">
                        <h5 class="fw-bolder mt-4">Microsoft Packet</h5>
                    </div>
                </div>
                <div class="card-footer bg-transparent border-top-0">
                    <div class="d-flex justify-content-between ">
                        <h5 class="fw-bold solutions-text">145 SAR</h5>
                        <p class="arrow fw-bold text-info font-color">Buy</p>
                    </div>
                </div>
            </div>
        </div>
    </div> -->
    <!-- Customer Reviews -->
    @if ($reviews->count() > 0)    
    <div class="mb-5" style="margin-top:60px">
        <div class="d-flex flex-column flex-md-row justify-content-between align-items-center py-2 mt-5">
            <div class="d-flex gap-4">
                <p class="fw-bold text-black" style="font-size:28px">Customer Reviews</p>
            </div>
        </div>
        <div class="lc-block">
            <div id="carouselLogos2" class="carousel slide pb-4 pointer-event" data-bs-ride="carousel" data-bs-interval="false">
                <div class="carousel-inner">
                    @foreach ($reviews->chunk(2) as $key => $chunk)
                        <div class="carousel-item{{ $key === 0 ? ' active' : '' }}">
                            <div class="d-flex flex-column flex-md-row gap-3">
                                @foreach ($chunk as $review)
                                @if ($review->product)
                                    <div class="col-12 col-xl-6">
                                        <div class="d-flex flex-column  flex-md-row bg-white cr-h w-100"
                                        style="padding-right:14px; padding-left:8px">
                                        <div class="d-flex  ">
                                        <img src="{{asset('images/avatar.png')}}" width="52px" class=" mx-4 ava " alt=""
                                            style="object-fit:none ; height:60px ">
                                            <h2 style="font-size: 22px; font-weight:700; margin-top:50px" class="d-block d-sm-none">{{$review->name}}</h2>
                                            </div>
                                        <div class="ava-border" style="width: 554px; ">
                                            <div class="d-flex pt-sm-5 pt-2" style="border-bottom: 1px solid rgb(128, 128, 128,0.5);">
                                                <h2 style="font-size: 22px; font-weight:700" class="d-none d-sm-block ">{{$review->name}}</h2>
                                                <div class="product-review-rating mx-3 pb-3 pb-sm-0">
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
                                                    <sup class="product-review-rating-font mx-1">{{$review->rating}}</sup>
                                                </div>
                                            </div>
                                            <p class="text-start py-3 pe-2 rev-text" style="font-size: 16px;">{{$review->review}}</p>
                                            <div class="d-flex align-items-start gap-3">
                                                <svg width="16" height="16" viewBox="0 0 16 16" fill="none"
                                                    xmlns="http://www.w3.org/2000/svg">
                                                    <circle cx="8" cy="8" r="8" fill="#469F00"></circle>
                                                    <rect x="7.33331" y="4" width="1.06667" height="8" fill="white"></rect>
                                                    <rect x="4" y="8.40009" width="1.06667" height="8"
                                                        transform="rotate(-90 4 8.40009)" fill="white"></rect>
                                                </svg>
                                                <div class="text-start">
                                                    <h5 class="fw-bold" style="font-size: 12px;">Advantages</h5>
                                                    <h5 style="font-size: 10px;"> {{$review->advantages}}</h5>
                                                </div>
                                            </div>
                                            <div class="d-flex gap-3">
                                                <svg width="16" height="16" viewBox="0 0 16 16" fill="none"
                                                    xmlns="http://www.w3.org/2000/svg">
                                                    <circle cx="8" cy="8" r="8" fill="#9F0000"></circle>
                                                    <rect x="4" y="8.40033" width="1.06667" height="8"
                                                        transform="rotate(-90 4 8.40033)" fill="white"></rect>
                                                </svg>

                                                <div class="text-start">
                                                    <h5 class="fw-bold" style="font-size: 12px;">Flaws</h5>
                                                    <h5 style="font-size: 10px;">{{$review->flaws}}</h5>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="pt-5 mt-5 pt-sm-0" style="width: 320px;">
                                            @if ($review->product && count($review->product->gallery_images) >= 0)
                                            <img src="{{url('images/product_images/' . $review->product->gallery_images[0]->images)}}" alt=""
                                                style="height: 114px;width: 197px;padding-left: 13px;">
                                            @else
                                            <img src="{{url('images/no-image.png')}}" style="width: 334px; height: 355px;object-fit:contain;">
                                            @endif
                                            <div class="text-start " style="padding-left:20px;margin-top: 18px;">
                                                @if (isset($review->product->sku))
                                                    <h6 style="font-size: 12px;">{{$review->product->sku}}</h6>
                                                @endif
                                                @if (isset($review->product->name))
                                                    <h5 style="font-weight:800; color:black">{{$review->product->name}}</h5>
                                                @endif
                                                @if (isset($review->product->availability) && $review->product->availability == 'in-stock')
                                                    <p class="tick text-success">{{ str_replace('-', ' ', ucwords($review->product->availability)) }}</p>
                                                @elseif (isset($review->product->availability) && $review->product->availability == 'out-of-stock')
                                                    <p class="text-danger">{{ str_replace('-', ' ', ucwords($review->product->availability)) }}</p>
                                                @elseif(isset($review->product->availability))
                                                    <p class="tick text-success">{{$review->product->availability}}</p>
                                                @endif
                                            </div>
                                            <div>
                                                <a href="{{route('user.product_details',$review->product->slug)}}" class="arrow text-start font-color" style="padding-left:20px ; margin-top:55px ;
                                                    font-family: Figtree;
                                                    font-size: 12px;
                                                    font-style: normal;
                                                    font-weight: 700;
                                                    line-height: normal;
                                                    letter-spacing: 0.183px;
                                                    float:left">View</a>
                                            </div>
                                        </div>
                                    </div>
                                    </div>
                                @endif
                                @endforeach
                            </div>
                        </div>
                    @endforeach
                </div>
                <center>
                    <ol class="carousel-indicators position-relative main-index-secondcaresoul-indicators">
                        @foreach ($reviews->chunk(2) as $key => $chunk)
                            <li data-bs-target="#carouselLogos2" data-bs-slide-to="{{ $key }}" class="{{ $key === 0 ? 'active' : '' }}"></li>
                        @endforeach
                    </ol>
                </center>                
            </div>
        </div>
    </div>
    @else
    <p></p>
    @endif
    <!-- Latest Blog Post -->
    <!-- <div class="d-flex flex-column flex-md-row justify-content-between align-items-center py-2 mt-5">
        <div class="d-flex gap-4">
            <p class="fw-bold text-black" style="font-size:28px">Latest Blog Post</p>
        </div>
        <div>
            <p class="arrow read-more fw-bold d-none d-sm-block" style="font-size:15px">More Post</p>
        </div>
    </div>
    <div class="d-flex justify-content-end d-block d-sm-none">
            <p class="arrow read-more fw-bold" style="font-size:15px">More Post</p>
        </div>
    <div class="row" style="margin-left: -15px;margin-right: -16px; margin-bottom:60px">
        <div class="col-12 col-md-4 col-12 mt-2">
            <div class="card">
                <div class="card-body p-0">
                    <img src="{{asset('images/im-bl.png')}}" alt="">
                    <div class="text-start ">
                        <h5 class="text-black fw-bold p-3" style="font-size:18px">Technology: Raising the Curtain on
                            the Future</h5>
                        <p class="text-black p-3" style="font-size:16px">ur experts ensure fast and high-quality
                            servicing
                            of your
                            equipment. We
                            are always ready to address any issues, so you can have confidence in the reliability of
                            your technology</p>
                    </div>
                </div>
                <div class="card-footer bg-transparent border-top-0">
                    <p class="arrow fw-bold  text-start read-more">Read More</p>
                </div>
            </div>
        </div>
        <div class="col-12 col-md-4 col-12 mt-2">
            <div class="card">
                <div class="card-body p-0">
                    <img src="{{asset('images/im-bl2.png')}}" alt="">
                    <div class="text-start ">

                        <h5 class="text-black fw-bold p-3" style="font-size:18px">Technology: Raising the Curtain on
                            the Future</h5>
                        <p class="text-black p-3" style="font-size:16px">ur experts ensure fast and high-quality
                            servicing
                            of your
                            equipment. We
                            are always ready to address any issues, so you can have confidence in the reliability of
                            your technology</p>
                    </div>
                </div>
                <div class="card-footer bg-transparent border-top-0">
                    <p class="arrow fw-bold  text-start read-more">Read More</p>
                </div>
            </div>
        </div>
        <div class="col-12 col-md-4 col-12 mt-2">
            <div class="card">
                <div class="card-body p-0">
                    <img src="{{asset('images/im-bl3.png')}}" alt="">
                    <div class="text-start ">
                        <h5 class="text-black fw-bold p-3" style="font-size:18px">Technology: Raising the Curtain on
                            the Future</h5>
                        <p class="text-black p-3" style="font-size:16px">ur experts ensure fast and high-quality
                            servicing
                            of your
                            equipment. We
                            are always ready to address any issues, so you can have confidence in the reliability of
                            your technology</p>
                    </div>
                </div>
                <div class="card-footer bg-transparent border-top-0">
                    <p class="arrow fw-bold read-more text-start">Read More</p>
                </div>
            </div>
        </div>
    </div> -->
</div>
<script src="https://code.jquery.com/jquery-3.6.4.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<script>
    function loadData(tab) {
        var route;

        switch (tab) {
            case 'featured-products':
                route = '{{ route("featured.products") }}';
                break;
            case 'recommended-products':
                route = '{{ route("recommended.products") }}';
                break;
            case 'latest-products':
                route = '{{ route("latest.products") }}';
                break;
        }
        $.ajax({
            url: route,
            method: 'GET',
            data: { tab: tab, _token: '{{ csrf_token() }}' },
            dataType: 'json',
            success: function(response) {
                displayProducts(response.data);
            },
            error: function(xhr, status, error) {
                console.error('Error loading data:');
                console.log('XHR:', xhr);
                console.log('Status:', status);
                console.log('Error:', error);
            }
        });
    }

    function displayProducts(products) {
       // console.log('Products received:', products);
        const rowContainer = $('#product-row');
        rowContainer.empty();

        if (Array.isArray(products)) {
            products.forEach(product => {
                const cardColumn = $('<div class="col-md-6 col-lg-3 col-12"></div>');
                const productDetailsLink = $(`<a href="/product-details/${product.slug}" class="text-decoration-none font-color-black" style="color: inherit"></a>`);
                const card = $('<div class="card mt-2 border-0"></div>');
                const cardBody = $('<div class="card-body"></div>');
                const productImage = $(`
                    <img src="${product.gallery_images.length > 0 ? '{{ url("images/product_images/") }}' + '/' + product.gallery_images[0].images : '{{ url("images/no-image.png") }}'}"
                        class="py-3"
                        alt="${product.name}"
                        style="height: 222px !important; width:209px !important; object-fit:contain !important;"
                    >
                `);
                const productInfo = $(`
                    <div class="text-start">
                        <p>${product.sku}</p>
                        <h5 class="fw-bolder">${product.name}</h5>
                        <p class="${product.availability == 'in-stock' ? 'tick text-success' : 'text-danger'}">
                            ${product.availability == 'in-stock' ? 'In Stock' : 'Out of Stock'}
                        </p>
                    </div>
                `);
                const cardFooter = $('<div class="card-footer bg-transparent border-top-0"></div>');
                const flexContainer = $('<div class="d-flex justify-content-between "></div>');
                const price = $(`<h5 class="fw-bold">${product.price} SAR</h5>`);
                const addToCart = $(`
                    <a
                        id="add-to-cart"
                        data-id="${product.id}"
                        class="index-add-to-cart arrow fw-bold clr ${product.quantity <= 0 ? 'disabled-link text-muted arrow-disable' : 'add-to-cart'}"
                    >
                        Add to cart
                    </a>
                `);
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
                    function  increment_ajax(productId, user_id, quantity){
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
                                        text: 'Product Added to Cart!',
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

                cardBody.append(productImage);
                cardBody.append(productInfo);

                flexContainer.append(price);
                flexContainer.append(addToCart);

                cardFooter.append(flexContainer);

                card.append(cardBody);
                card.append(cardFooter);

                productDetailsLink.append(card);

                cardColumn.append(productDetailsLink);

                rowContainer.append(cardColumn);
            });

        } else {
            console.error('Products is not an array:', products);
        }
    }

    $(document).ready(function() {
        loadData('featured-products');
        $('#featured-tab').addClass('fw-bold text-dark');
        $('#featured-tab').click(function name() {
            $('#featured-tab').addClass('fw-bold text-dark');
            $('#recommended-tab').removeClass('fw-bold text-dark');
            $('#new-tab').removeClass('fw-bold text-dark');
        });
        $('#recommended-tab').click(function name() {
            $('#recommended-tab').addClass('fw-bold text-dark');
            $('#featured-tab').removeClass('fw-bold text-dark');
            $('#new-tab').removeClass('fw-bold text-dark');
        });
        $('#new-tab').click(function name() {
            $('#new-tab').addClass('fw-bold text-dark');
            $('#featured-tab').removeClass('fw-bold text-dark');
            $('#recommended-tab').removeClass('fw-bold text-dark');
        });
    });
</script>
@if ($sliders->count() > 0)    
<script>
    $(document).ready(function () {
        var prints = $('.slider-text div:eq(1)').text();
        var years = $('.slider-text div:eq(2)').text();
        $('#prints').text(prints);
        $('#years').text(years);
        $('.slider-text div:eq(1)').addClass('text-shadow');

        var productName = {!! json_encode($slider->product_slug) !!};
        productName = productName.replace(/-/g, ' ');
        productName = productName.replace(/\b\w/g, function (match) {
            return match.toUpperCase();
        });

        var words = productName.split(' ');

        var formattedProductName = '';
        // Limit the loop to the first 4 words
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

@endif
@endsection
