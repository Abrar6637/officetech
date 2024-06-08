@php
    use Carbon\Carbon;
@endphp
@extends('frontend.layout.main')
@section('title', 'Office Tech - My Orders')
@section('main.container')
<style>
    .myOrders__table{
        margin-left: 0px
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
                <span data-translate="my_orders">
                    My Orders
                </span>
            </div>
        </div>
    </div>

    <main>
        <section class="myOrders pS account">
            <div class="container">
                <div class="myOrders__inner account__inner">
                    <div class="account__menu">
                        <ul>
                            <li class="active">
                                <a href="#" data-translate="my_orders">
                                    My Orders
                                </a>
                            </li>
                            <li>
                                <a href="{{ route('user.user_setting') }}" data-translate="settings">
                                    Settings
                                </a>
                            </li>
                            <li>
                                <a href="{{ route('user.logout') }}" data-translate="logout">
                                    Logout
                                </a>
                            </li>
                        </ul>
                    </div>
                    <div class="myOrders__table">
                        <h1 class="cartCheckout__title" data-translate="my_orders">
                            My Orders
                        </h1>
                        @if (session('success'))
                            <div class="alert alert-success alert-dismissible fade show" role="alert">
                                {{ session('success') }}
                                <button type="button" class="btn-close" data-bs-dismiss="alert"
                                    aria-label="Close"></button>
                            </div>
                        @endif
                        @if ($order_details->count() > 0)
                            <div class="myOrders__table-wrapper">
                                <table>
                                    <thead>
                                        <tr>
                                            <td data-translate="order_no">
                                                Order No.
                                            </td>
                                            <td data-translate="product_name">
                                                Product Name
                                            </td>
                                            <!-- <td>
                                                Warranty
                                            </td> -->
                                            <td data-translate="cluster_no">
                                                Cluster / Serial No.
                                            </td>
                                            <td data-translate="payment_mode">
                                                Payment Mode
                                            </td>
                                            <td data-translate="payment_status">
                                                Payment Status
                                            </td>
                                            <td data-translate="trans_ref_id">
                                                Trans Ref ID
                                            </td>
                                            <td data-translate="amount">
                                                Amount
                                            </td>
                                            <td data-translate="purchase_date">
                                                Purchase date
                                            </td>
                                            <td data-translate="return_status">Return Status</td>
                                            <td data-translate="status">
                                                Status
                                            </td>
                                            <td data-translate="action">
                                                Action
                                            </td>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @forelse ($customer_orders as $customer_order)
                                            @foreach ($order_details as $order_detail)
                                                @if ($customer_order->customer_id == $order_detail->id)
                                                    <tr>
                                                        <td>
                                                            {{ $customer_order->order_number }}
                                                        </td>
                                                        <td>
                                                        <ol class="text-start">
                                                            @forelse ($customer_order->productQuantity as $product)
                                                                @if ($product->product)
                                                                    <li>{{$product->product->name}}</li>
                                                                    @else
                                                                        <li data-translate="no_product">No Product</li>
                                                                @endif
                                                                @empty
                                                                    <li data-translate="no_product" >No Product</li>
                                                            @endforelse 
                                                        </ol>
                                                        </td>
                                                        <!-- <td>
                                                            <ol>
                                                                @forelse ($customer_order->productQuantity as $product)
                                                                    @if ($product->product)
                                                                        @php
                                                                            $productWarranty = $product->product->warranty;
                                                                            $orderDate = $customer_order->created_at;
                                                                            $currentDate = now();
                                                                            $warrantyExpirationDate = $orderDate->addYear();

                                                                            $inWarranty = $currentDate->lte($warrantyExpirationDate);
                                                                        @endphp

                                                                        <li>
                                                                            @if ($inWarranty)
                                                                                In Warranty
                                                                            @else
                                                                                Out Of Warranty
                                                                            @endif
                                                                        </li>
                                                                    @else
                                                                        <li>Out Of Warranty</li>
                                                                    @endif
                                                                @empty
                                                                @endforelse
                                                            </ol>
                                                      </td> -->
                                                        <td>
                                                            <ol>
                                                                @forelse ($customer_order->productQuantity as $product)
                                                                    @if (!empty($product->serial_no))
                                                                        <li>{{ $product->serial_no }}</li>
                                                                    @else
                                                                        <li data-translate="not_issued">Not Issued</li>
                                                                    @endif
                                                                @empty
                                                                @endforelse
                                                            </ol>
                                                        </td>
                                                        <td>
                                                            @if ($customer_order->payment_status == 'Bank-Transfer')
                                                                Debit-Credit
                                                            @else
                                                                {{ $customer_order->payment_status }}
                                                            @endif
                                                        </td>

                                                        <td>
                                                            {{ $customer_order->order_payment_status }}
                                                        </td>
                                                        <td>
                                                            @if ($customer_order->tran_ref == '')
                                                            Manual
                                                            @else
                                                            {{ $customer_order->tran_ref }}
                                                            @endif

                                                        </td>
                                                        <td>
                                                            {{ $customer_order->grand_total }} SAR
                                                        </td>
                                                        <td>
                                                            {{ $customer_order->created_at->format('j-M-Y') }}
                                                        </td>
                                                        <td>
                                                            @if ($customer_order->return_status == 0)
                                                                    @if (Carbon::parse($customer_order->created_at)->diffInDays(now()) <= 7)
                                                                        <a class="return-request-link" 
                                                                            href="{{ route('return.order', ['orderId' => encrypt($customer_order->id)]) }}">
                                                                            <div class="text-nowrap">
                                                                                <button type="button" name="invoice" id="return-request"
                                                                                    class="btn btn-sm btn-bg-color border-0 text-white return-request-btn" data-translate="return_request">Return Request</button>
                                                                            </div>
                                                                        </a>
                                                                    @endif
                                                                @elseif ($customer_order->return_status == 1)
                                                                    <p class="text-warning" data-translate="request_pending">Request Pending</p>
                                                                @elseif ($customer_order->return_status == 2)
                                                                    <p class="text-danger" data-translate="order_returned">Order Returned</p>
                                                                @elseif ($customer_order->return_status == 3)
                                                                    <p class="text-danger" data-translate="request_declined">Request Declined</p>
                                                                @endif
                                                            </td>
                                                        <td>
                                                            {{ $customer_order->order_status }}
                                                        </td>
                                                        <td class="myOrders__table-btns">
                                                            <a href="{{ route('invoice.generate', ['orderId' => encrypt($customer_order->id)]) }}"
                                                                class="btnHover myOrders__table-btn" data-translate="sales_order">
                                                                Sales Order
                                                            </a>
                                                            <a href="{{ route('choose.service', ['orderId' => encrypt($customer_order->id)]) }}"
                                                                class="btnHover myOrders__table-btn" data-translate="service_request">
                                                                Service Request
                                                            </a>
                                                        </td>
                                                    </tr>
                                                @endif
                                            @endforeach
                                        @empty
                                            <tr>
                                                <td colspan="7">
                                                    <h4 data-translate="sorry_you_have_no_orders">Sorry You Have No orders</h4>
                                                </td>
                                            </tr>
                                        @endforelse
                                    </tbody>
                                </table>
                            </div>
                        @else
                            <h2 data-translate="sorry_you_have_no_orders">Sorry You Have No orders</h2>
                        @endif
                    </div>
                </div>
            </div>
        </section>
    </main>

@endsection
