@extends('frontend.layout.main')
@section('title', 'Office Tech - Track Order')
@section('main.container')

    <div class="breadcrumbs">
        <div class="container">
            <div class="breadcrumbs__inner">
                <a href="/" data-translate="home">
                    Home
                </a>
                <div class="el">
                    /
                </div>
                <span data-translate="order_details">
                    Order Details
                </span>
            </div>
        </div>
    </div>

    <main>
        <section class="trackOrderDetalis pS">
            <div class="container">
                <div class="trackOrderDetalis__inner">
                    <div class="trackOrderDetalis__top">
                        <div>
                            <div class="trackOrderDetalis__num">
                                #{{ $trackOrders[0]->order->order_number }}
                            </div>
                            <div class="trackOrderDetalis__info">
                                <span>
                                    {{ $trackOrders[0]->order_product->count() }} Products
                                </span>
                                <div class="dot"></div>
                                <span >
                                    <p data-translate="order_placed" style="display:inline-block">Order Placed in</p>
                                    {{ \Carbon\Carbon::parse($trackOrders[0]->order->created_at)->format('d M, Y \a\t h:i A') }}
                                </span>
                            </div>
                        </div>
                        <div class="trackOrderDetalis__price">
                            {{ $trackOrders[0]->order->grand_total }} <span data-translate="sar">SAR</span>
                        </div>
                    </div>
                    <div class="trackOrderDetalis__check">
                        @php
                            $expectedArrivalDate = \Carbon\Carbon::parse($trackOrders[0]->order->created_at);
                            $region = $region_details->delivery_days;
                            $expectedArrivalDate->addDays($region);
                        @endphp
                        <p class="trackOrderDetalis__check-title">
                            Order expected arrival {{ $expectedArrivalDate->format('d M, Y') }}
                        </p>
                        <div class="trackOrderDetalis__check-items">
                            @if ($trackOrders[0]->order_status == 'processing')
                                <div class="trackOrderDetalis__check-item active">
                                    <div class="trackOrderDetalis__check-item-state"></div>
                                    <div class="trackOrderDetalis__check-item-icon">
                                        <img src={{ asset('updated-assets/images/icons/order-item-1.svg') }} alt="">
                                    </div>
                                    <div class="trackOrderDetalis__check-item-title" data-translate="order_placed">
                                        Order Placed
                                    </div>
                                </div>
                                <span class="line"></span>
                                <div class="trackOrderDetalis__check-item">
                                    <div class="trackOrderDetalis__check-item-state"></div>
                                    <div class="trackOrderDetalis__check-item-icon">
                                        <img src={{ asset('updated-assets/images/icons/order-item-2.svg') }} alt="">
                                    </div>
                                    <div class="trackOrderDetalis__check-item-title" data-translate="packaging">
                                        Packaging
                                    </div>
                                </div>
                                <span class="line"></span>
                                <div class="trackOrderDetalis__check-item">
                                    <div class="trackOrderDetalis__check-item-state"></div>
                                    <div class="trackOrderDetalis__check-item-icon">
                                        <img src={{ asset('updated-assets/images/icons/order-item-3.svg') }} alt="">
                                    </div>
                                    <div class="trackOrderDetalis__check-item-title" data-translate="on_the_road">
                                        On The Road
                                    </div>
                                </div>
                                <span class="line"></span>
                                <div class="trackOrderDetalis__check-item">
                                    <div class="trackOrderDetalis__check-item-state"></div>
                                    <div class="trackOrderDetalis__check-item-icon">
                                        <img src={{ asset('updated-assets/images/icons/order-item-4.svg') }} alt="">
                                    </div>
                                    <div class="trackOrderDetalis__check-item-title" data-translate="delivered">
                                        Delivered
                                    </div>
                                </div>
                            @elseif($trackOrders[0]->order_status == 'shipped')
                                <div class="trackOrderDetalis__check-item active">
                                    <div class="trackOrderDetalis__check-item-state"></div>
                                    <div class="trackOrderDetalis__check-item-icon">
                                        <img src={{ asset('updated-assets/images/icons/order-item-1.svg') }} alt="">
                                    </div>
                                    <div class="trackOrderDetalis__check-item-title" data-translate="order_placed">
                                        Order Placed
                                    </div>
                                </div>
                                <span class="line"></span>
                                <div class="trackOrderDetalis__check-item active">
                                    <div class="trackOrderDetalis__check-item-state"></div>
                                    <div class="trackOrderDetalis__check-item-icon">
                                        <img src={{ asset('updated-assets/images/icons/order-item-2.svg') }}
                                            alt="">
                                    </div>
                                    <div class="trackOrderDetalis__check-item-title"  data-translate="packaging">
                                        Packaging
                                    </div>
                                </div>
                                <span class="line"></span>
                                <div class="trackOrderDetalis__check-item">
                                    <div class="trackOrderDetalis__check-item-state"></div>
                                    <div class="trackOrderDetalis__check-item-icon">
                                        <img src={{ asset('updated-assets/images/icons/order-item-3.svg') }}
                                            alt="">
                                    </div>
                                    <div class="trackOrderDetalis__check-item-title" data-translate="on_the_road">
                                        On The Road
                                    </div>
                                </div>
                                <span class="line"></span>
                                <div class="trackOrderDetalis__check-item">
                                    <div class="trackOrderDetalis__check-item-state"></div>
                                    <div class="trackOrderDetalis__check-item-icon">
                                        <img src={{ asset('updated-assets/images/icons/order-item-4.svg') }}
                                            alt="">
                                    </div>
                                    <div class="trackOrderDetalis__check-item-title" data-translate="delivered">
                                        Delivered
                                    </div>
                                </div>
                            @elseif($trackOrders[0]->order_status == 'En Route')
                                <div class="trackOrderDetalis__check-item active">
                                    <div class="trackOrderDetalis__check-item-state"></div>
                                    <div class="trackOrderDetalis__check-item-icon">
                                        <img src={{ asset('updated-assets/images/icons/order-item-1.svg') }}
                                            alt="">
                                    </div>
                                    <div class="trackOrderDetalis__check-item-title" data-translate="order_placed">
                                        Order Placed
                                    </div>
                                </div>
                                <span class="line"></span>
                                <div class="trackOrderDetalis__check-item active">
                                    <div class="trackOrderDetalis__check-item-state"></div>
                                    <div class="trackOrderDetalis__check-item-icon">
                                        <img src={{ asset('updated-assets/images/icons/order-item-2.svg') }}
                                            alt="">
                                    </div>
                                    <div class="trackOrderDetalis__check-item-title"  data-translate="packaging">
                                        Packaging
                                    </div>
                                </div>
                                <span class="line"></span>
                                <div class="trackOrderDetalis__check-item active">
                                    <div class="trackOrderDetalis__check-item-state"></div>
                                    <div class="trackOrderDetalis__check-item-icon">
                                        <img src={{ asset('updated-assets/images/icons/order-item-3.svg') }}
                                            alt="">
                                    </div>
                                    <div class="trackOrderDetalis__check-item-title" data-translate="on_the_road">
                                        On The Road
                                    </div>
                                </div>
                                <span class="line"></span>
                                <div class="trackOrderDetalis__check-item">
                                    <div class="trackOrderDetalis__check-item-state"></div>
                                    <div class="trackOrderDetalis__check-item-icon">
                                        <img src={{ asset('updated-assets/images/icons/order-item-4.svg') }}
                                            alt="">
                                    </div>
                                    <div class="trackOrderDetalis__check-item-title" data-translate="delivered">
                                        Delivered
                                    </div>
                                </div>
                            @elseif($trackOrders[0]->order_status == 'delivered')
                                <div class="trackOrderDetalis__check-item active">
                                    <div class="trackOrderDetalis__check-item-state"></div>
                                    <div class="trackOrderDetalis__check-item-icon">
                                        <img src={{ asset('updated-assets/images/icons/order-item-1.svg') }}
                                            alt="">
                                    </div>
                                    <div class="trackOrderDetalis__check-item-title" data-translate="order_placed">
                                        Order Placed
                                    </div>
                                </div>
                                <span class="line"></span>
                                <div class="trackOrderDetalis__check-item active">
                                    <div class="trackOrderDetalis__check-item-state"></div>
                                    <div class="trackOrderDetalis__check-item-icon">
                                        <img src={{ asset('updated-assets/images/icons/order-item-2.svg') }}
                                            alt="">
                                    </div>
                                    <div class="trackOrderDetalis__check-item-title"  data-translate="packaging">
                                        Packaging
                                    </div>
                                </div>
                                <span class="line"></span>
                                <div class="trackOrderDetalis__check-item active">
                                    <div class="trackOrderDetalis__check-item-state"></div>
                                    <div class="trackOrderDetalis__check-item-icon">
                                        <img src={{ asset('updated-assets/images/icons/order-item-3.svg') }}
                                            alt="">
                                    </div>
                                    <div class="trackOrderDetalis__check-item-title" data-translate="on_the_road">
                                        On The Road
                                    </div>
                                </div>
                                <span class="line"></span>
                                <div class="trackOrderDetalis__check-item active">
                                    <div class="trackOrderDetalis__check-item-state"></div>
                                    <div class="trackOrderDetalis__check-item-icon">
                                        <img src={{ asset('updated-assets/images/icons/order-item-4.svg') }}
                                            alt="">
                                    </div>
                                    <div class="trackOrderDetalis__check-item-title" data-translate="delivered">
                                        Delivered
                                    </div>
                                </div>
                            @else
                                <div>
                                    <div class="trackOrderDetalis__check-item active">
                                        <div class="trackOrderDetalis__check-item-state"></div>
                                        <div class="trackOrderDetalis__check-item-icon">
                                            <img src={{ asset('updated-assets/images/icons/order-item-1.svg') }}
                                                alt="">
                                        </div>
                                        <div class="trackOrderDetalis__check-item-title" data-translate="order_placed">
                                            Order Placed
                                        </div>
                                    </div>
                                    <span class="line"></span>
                                    <div class="trackOrderDetalis__check-item">
                                        <div class="trackOrderDetalis__check-item-state"></div>
                                        <div class="trackOrderDetalis__check-item-icon">
                                            <img src={{ asset('updated-assets/images/icons/order-item-2.svg') }}
                                                alt="">
                                        </div>
                                        <div class="trackOrderDetalis__check-item-title"  data-translate="packaging">
                                            Packaging
                                        </div>
                                    </div>
                                    <span class="line"></span>
                                    <div class="trackOrderDetalis__check-item">
                                        <div class="trackOrderDetalis__check-item-state"></div>
                                        <div class="trackOrderDetalis__check-item-icon">
                                            <img src={{ asset('updated-assets/images/icons/order-item-3.svg') }}
                                                alt="">
                                        </div>
                                        <div class="trackOrderDetalis__check-item-title" data-translate="on_the_road">
                                            On The Road
                                        </div>
                                    </div>
                                    <span class="line"></span>
                                    <div class="trackOrderDetalis__check-item">
                                        <div class="trackOrderDetalis__check-item-state"></div>
                                        <div class="trackOrderDetalis__check-item-icon">
                                            <img src={{ asset('updated-assets/images/icons/order-item-4.svg') }}
                                                alt="">
                                        </div>
                                        <div class="trackOrderDetalis__check-item-title" data-translate="delivered">
                                            Delivered
                                        </div>
                                    </div>
                                </div>
                            @endif
                        </div>
                    </div>
                    <div class="trackOrderDetalis__check-list">
                        <div class="trackOrderDetalis__check-list-title" data-translate="order_activity">
                            Order Activity
                        </div>
                        @foreach ($trackOrders as $trackorder)
                            <div class="trackOrderDetalis__check-list-item">
                                @if ($trackorder->order_status == 'processing')
                                    <img src={{asset('updated-assets/images/icons/order-item-1.svg')}} alt="">
                                @elseif($trackorder->order_status == 'shipped')
                                    <img src={{asset('updated-assets/images/icons/order-item-2.svg')}} alt="">
                                @elseif($trackorder->order_status == 'En Route')
                                    <img src={{asset('updated-assets/images/icons/order-item-3.svg')}} alt="">
                                @elseif($trackorder->order_status == 'delivered')
                                    <img src={{asset('updated-assets/images/icons/order-item-4.svg')}} alt="">
                                @endif
                                <div>
                                    <div class="trackOrderDetalis__check-list-item-title">
                                        {{ $trackorder->track_order_msg }}
                                    </div>
                                    <div class="trackOrderDetalis__check-list-item-date">
                                        {{ \Carbon\Carbon::parse($trackorder->created_at)->format('d M, Y \a\t h:i A') }}</
                                            </div>
                                    </div>
                                </div>




                            </div>
                        @endforeach
                    </div>
                </div>
        </section>
    </main>
@endsection
