@extends('frontend.layout.main')
@section('title', 'Office Tech - Services')
@section('main.container')
<main class="main margin" >
    <div class="breadcrumb-container">
        <div class="container">
            <ul class="breadcrumb">
                <li><a href="/">Home</a></li>
                <li class="slash">/</li>
                <li>Services</li>
            </ul>
        </div>
    </div>
    <div class="container mt-5 section-top">
        <div class="row">
            <div class="col-lg-6">
                <h1 class="review-tab-heading" style="margin-top: 17px;">Service Ticket</h1>
                <p class="page-result-p " style="color:#323232; text-align:justify">A
                    Service
                    Ticket is your
                    direct gateway to timely and efficient support. Easily log and track technical issues or service
                    requests for your products or systems. Our dedicated team of experts is ready to address your
                    concerns and provide the necessary assistance to get you back on track.</p>
                <ul class="service-ticket-ul d-flex flex-column gap-3" style="margin-top: 35px !important;">
                    <li class="service-ticket-li">Swiftly report and resolve issues.</li>
                    <li class="service-ticket-li">Transparent tracking of service requests.</li>
                    <li class="service-ticket-li">Valuable documentation for issue history.</li>
                </ul>
                <div class="d-flex justify-content-between service-sec-1" style="">
                    <p class="about-us-price">500 SAR</p>
                    <p class="arrow fw-bold  " style="color:#da5858">Add to cart</p>
                </div>
            </div>
            <div class="col-lg-6">
                <img src="{{asset('images/services1.png')}}" alt="">
            </div>
        </div>
    </div>
    <div class="card mt-5 service-card" style="padding:50px;border:0px">
        <div class="container">
            <div class="row">
                <div class="col-lg-6">
                    <img src="{{asset('images/services2.png')}}" alt="">
                </div>
                <div class="col-lg-6">
                    <h1 class="review-tab-heading" style="margin-top: 17px;" data-translate="service_contract">Service Contract</h1>
                    <p class="page-result-p" style="color:#323232; text-align:justify;">A
                        Service Ticket is
                        your direct gateway to timely and efficient support. Easily log and track technical issues
                        or service requests for your products or systems. Our dedicated team of experts is ready to
                        address your concerns and provide the necessary assistance to get you back on track.</p>
                    <ul class="service-ticket-ul d-flex flex-column gap-3 contract-list" style="">
                        <li class="service-ticket-li">Swiftly report and resolve issues.</li>
                        <li class="service-ticket-li">Transparent tracking of service requests.</li>
                        <li class="service-ticket-li">Valuable documentation for issue history.</li>
                    </ul>
                    <div class="d-flex justify-content-between service-sec-2" >
                        <p class="about-us-price">500 SAR</p>
                        <p class="arrow fw-bold  " style="color:#da5858">Add to cart</p>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="container mt-5">
        <div class="row">
            <div class="col-lg-6">
                <h1 class="review-tab-heading" style="margin-top: 17px;">Managed Services (IT, MPS, DMS)</h1>
                <p class="page-result-p" style="color:#323232;text-align:justify">A Service
                    Ticket is your
                    direct gateway to timely and efficient support. Easily log and track technical issues or service
                    requests for your products or systems. Our dedicated team of experts is ready to address your
                    concerns and provide the necessary assistance to get you back on track.</p>
                <ul class="service-ticket-ul d-flex flex-column gap-3" >
                    <li class="service-ticket-li">Swiftly report and resolve issues.</li>
                    <li class="service-ticket-li">Transparent tracking of service requests.</li>
                    <li class="service-ticket-li">Valuable documentation for issue history.</li>
                </ul>
                <div class="d-flex justify-content-between service-sec" >
                    <p class="about-us-price">500 SAR</p>
                    <p class="arrow fw-bold  " style="color:#da5858">Add to cart</p>
                </div>
            </div>
            <div class="col-lg-6">
                <img src="{{asset('images/services3.png')}}" alt="">
            </div>
        </div>
    </div>
    {{-- Customer Reviews To Set  --}}
     <div class="container">
        <div class="mb-3">
            <div class="d-flex flex-column flex-md-row justify-content-between align-items-center py-2 mt-5">
                <div class="d-flex gap-4">
                    <h1 class="text-start mt-3" style="font-size:28px; font-weight:700">Customer Reviews</h1>
                </div>
            </div>
        </div>
        <div class="lc-block">
            <div id="carouselLogos" class="carousel slide pb-4 pointer-event" data-bs-ride="carousel"
                data-bs-interval="false">
                <div class="carousel-inner">
                    @foreach ($reviews->chunk(2) as $key => $chunk)
                        <div class="carousel-item carousel-item-active-color{{ $key === 0 ? ' active' : '' }}">
                            <div class="d-flex flex-column flex-md-row gap-3">
                                @foreach ($chunk as $review)
                                    <div class="col-12 col-xl-6">
                                        <div class="d-flex flex-column  flex-md-row bg-white cr-h w-100"
                                        style="padding-right:14px;">
                                        <div class="d-flex  ">
                                        <img src="{{asset('images/avatar.png')}}" width="52px" class=" mx-4 ava ser-ava" alt=""
                                            style="object-fit:none ; height:60px ">
                                            <h2 style="font-size: 22px; font-weight:700; margin-top:50px" class="d-block d-sm-none">{{$review->name}}</h2>
                                            </div>
                                        <div class="ava-border ser-part" style="width: 554px; ">
                                            <div class="d-flex pt-2 pt-sm-5" style="border-bottom: 1px solid rgb(128, 128, 128,0.5);">
                                                <h2 style="font-size: 22px; font-weight:700" class="d-none d-sm-block ">{{$review->name}}</h2>
                                                <div class="product-review-rating mx-3">
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
                                            <p class="text-start py-3 pe-2 rev-text ser-text" style="font-size: 12px;">{{$review->review}}</p>
                                            <div class="d-flex align-items-start gap-3 me-5">
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
                                            @if (count($review->product->gallery_images) > 0)
                                            <img src="{{url('images/product_images/' . $review->product->gallery_images[0]->images)}}" alt=""
                                                style="height: 114px;width: 197px;padding-left: 13px;">
                                            @else
                                            <img src="{{url('images/no-image.png')}}" style="width: 334px; height: 355px;object-fit:contain;">
                                            @endif
                                            <div class="text-start " style="padding-left:20px;margin-top: 18px;">
                                                <h6 style="font-size: 12px;">{{$review->product->sku}}</h6>
                                                <h5 style="font-weight:800; color:black">{{$review->product->name}}</h5>
                                                @if ($review->product->availability== 'in-stock')
                                                <p class="tick text-success">{{ str_replace('-', ' ', ucwords($review->product->availability)) }}</p>
                                                @elseif ($review->product->availability== 'out-of-stock')
                                                <p class="text-danger">{{ str_replace('-', ' ', ucwords($review->product->availability)) }}</p>
                                                @else
                                                <p class="tick text-success">{{$review->product->availability}}</p>
                                                @endif
                                            </div>
                                            <div>
                                                <a href="{{route('user.product_details',$review->product->slug)}}" class="arrow text-start font-color mb-4" style="padding-left:20px ; margin-top:35px ;
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
</main>
@endsection