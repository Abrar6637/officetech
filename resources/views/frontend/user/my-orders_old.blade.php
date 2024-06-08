@php
    use Carbon\Carbon;
@endphp
@extends('frontend.layout.main')
@section('title', 'Office Tech - My Orders')
@section('main.container')
    <link rel="stylesheet" href="https://cdn.datatables.net/1.13.7/css/jquery.dataTables.css" />
    <style>
        .current {
            background: #f4f5f8 !important;
            border: none !important;
        }

        .dataTables_wrapper .dataTables_paginate .paginate_button:hover {
            background: transparent !important;
            color: #da5858 !important;
            border-color: transparent !important;
        }

        .dataTables_wrapper .dataTables_filter input:focus-visible {
            outline: none !important;
        }

        .dataTables_wrapper .dataTables_info {
            padding-top: 30px !important;
        }

        .dataTables_wrapper .dataTables_paginate {
            padding-top: 20px !important;
        }

        .dataTables_wrapper .dataTables_length {
            margin-bottom: 10px;
        }

        div.dataTables_wrapper div.dataTables_filter {
            margin-bottom: 12px;
        }

        .btn:focus-visible {
            box-shadow: 0 0 10px rgba(218, 88, 88, 1) !important;
        }

        .btn:focus {
            box-shadow: 0 0 10px rgba(218, 88, 88, 1) !important;
        }
    </style>
    <main class="main margin" >
        <div class="breadcrumb-container">
            <div class="container">
                <ul class="breadcrumb">
                    <li><a href="/">Home</a></li>
                    <li class="slash">/</li>
                    <li>My Orders</li>
                </ul>
            </div>
        </div>
        <div class="container text-center mt-4 section-top">
            <div class="row">
                <div class="col-md-2 col-12 text-start">
                    <div class="d-flex flex-column gap-2">
                        <a class="fw-bold" style="color:#da5858">My Orders</a>
                        <a href="{{ route('user.user_setting') }}" class="text-black fw-bold">Setting</a>
                        <a href="{{ route('user.logout') }}" class="fw-bold text-black">Logout</a>
                    </div>
                </div>
                <div class="col-md-10 col-12 bg-white p-4">
                    <h1 class="text-start fw-bold pb-3" style="font-size:28px">My Orders</h1>
                    @if (session('success'))
                        <div class="alert alert-success alert-dismissible fade show" role="alert">
                            {{ session('success') }}
                            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                        </div>
                    @endif
                    @if ($order_details->count() > 0)
                        <div class="table-responsive border p-3">
                            <table class="table bg-white border-0 border-white text-nowrap" id="OrderTable" data-page-length='10'>
                                <thead class="border-bottom border-white">
                                    <tr>
                                        {{-- <th scope="col">Order Name</th> --}}
                                        <th scope="col">Order No.</th>
                                        <th scope="col">Customer Name</th>
                                        <th scope="col">Product SKU</th>
                                        <th scope="col">Warrenty</th>
                                        <th scope="col">Cluster / Serial No</th>
                                        <th scope="col">Payment Status</th>
                                        <th scope="col">Amount</th>
                                        <th scope="col">Address</th>
                                        <th scope="col">Purchase Date</th>
                                        <th scope="col">Status</th>
                                      <th scope="col">Return Status</th>
                                        <th scope="col">Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @forelse ($customer_orders as $customer_order)
                                        @foreach ($order_details as $order_detail)
                                            @if ($customer_order->customer_id == $order_detail->id)
                                                <tr class="mt-2 border-bottom">
                                                    {{-- <td scope="row">{{ $customer_order->order_number }}</td> --}}
                                                    <td>{{ $customer_order->order_number }}</td>
                                                    <td>{{ $order_detail->company_name }}</td>
                                                    <td>
                                                        <ol class="text-start">
                                                            @forelse ($customer_order->productQuantity as $product)
                                                                @if ($product->product)
                                                                    <li>{{$product->product->name}}</li>
                                                                    @else
                                                                        <li>No Product</li>
                                                                @endif
                                                                @empty
                                                                    <li>No Product</li>
                                                            @endforelse 
                                                        </ol>
                                                    </td>
                                                    <td style="text-wrap:nowrap;">
                                                        @forelse ($customer_order->productQuantity as $product)
                                                        @if ($product->product)
                                                            @php
                                                                $productWarranty = $product->product->warranty;
                                                                $orderDate = $customer_order->created_at;
                                                                $currentDate = now();
                                                                $warrantyExpirationDate = $orderDate->addYear();

                                                                $inWarranty = $currentDate->lte($warrantyExpirationDate);
                                                                if ($inWarranty) {
                                                                    echo '<p class="mb-0">In Warranty</p>';
                                                                } else {
                                                                    echo '<p class="mb-0">Out Of Warranty</p>';
                                                                }
                                                            @endphp
                                                                @else
                                                                    <p class="mb-0">Out Of Warrenty</p>
                                                            @endif
                                                            @empty
                                                                <p class="mb-0">Out Of Warrenty</p>
                                                        @endforelse 
                                                    </td>
                                                    <td>
                                                        <ol>
                                                            @forelse ($customer_order->productQuantity as $product)
                                                                @if (!empty($product->serial_no))
                                                                    <li>{{ $product->serial_no }}</li>
                                                                @else
                                                                    <li>No Serial No</li>
                                                                @endif
                                                            @empty
                                                                <li>No Serial No</li>
                                                            @endforelse
                                                        </ol>
                                                    </td>

                                                    <td>{{ $customer_order->payment_status }}</td>
                                                    <td>{{ $customer_order->grand_total }} SAR</td>
                                                    <td>{{ $order_detail->address }}</td>
                                                    <td>{{ $customer_order->created_at->format('j-M-Y') }}</td>
                                                    <td>{{ $customer_order->order_status }}</td>
                                                  <td>
                                                  @if ($customer_order->return_status == 0)
                                                        @if (Carbon::parse($customer_order->created_at)->diffInDays(now()) <= 7)
                                                            <a class="return-request-link" 
                                                                href="{{ route('return.order', ['orderId' => encrypt($customer_order->id)]) }}">
                                                                <div class="text-nowrap">
                                                                    <button type="button" name="invoice" id="return-request"
                                                                        class="btn btn-sm btn-bg-color border-0 text-white return-request-btn">Return Request</button>
                                                                </div>
                                                            </a>
                                                        @endif
                                                    @elseif ($customer_order->return_status == 1)
                                                        <p class="text-warning">Request Pending</p>
                                                    @elseif ($customer_order->return_status == 2)
                                                        <p class="text-danger">Order Returned</p>
                                                    @elseif ($customer_order->return_status == 3)
                                                        <p class="text-danger">Request Declined</p>
                                                    @endif
                                                  </td>
                                                    <td>
                                                        <div class="d-flex gap-1">
                                                            <a
                                                                href="{{ route('invoice.generate', ['orderId' => encrypt($customer_order->id)]) }}">
                                                                <div class="text-nowrap">
                                                                    <button type="button" name="invoice" id="invoice"
                                                                        class="btn btn-sm btn-bg-color border-0 text-white">Sales
                                                                        Order</button>
                                                                </div>
                                                            </a>
                                                            <a
                                                                href="{{ route('choose.service', ['orderId' => encrypt($customer_order->id)]) }}">
                                                                <div class="text-nowrap">
                                                                    <button type="button" name="invoice" id="invoice"
                                                                        class="btn btn-sm btn-bg-color border-0 text-white">Service
                                                                        Request</button>
                                                                </div>
                                                            </a>
                                                        </div>
                                                    </td>
                                                </tr>
                                            @endif
                                        @endforeach
                                    @empty
                                        <tr class="mt-2">
                                            <td colspan="7">
                                                <h4>Sorry You Have No orders</h4>
                                            </td>
                                        </tr>
                                    @endforelse
                                </tbody>
                            @else
                                <h2>Sorry You Have No orders</h2>
                    @endif
                    </table>
                </div>
            </div>
        </div>
        <br>
        <br>
        </div>
    </main>
    <script src="https://code.jquery.com/jquery-3.6.4.min.js"></script>
    <script src="https://cdn.datatables.net/1.13.7/js/jquery.dataTables.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@10"></script>
    <script>
        $(document).ready(function() {
            $.noConflict();
            let table = new DataTable('#myTable');
            $('#OrderTable').DataTable({
                paging: true,
                order: [
                    [0, 'desc']
                ],
            });
        });
    </script>
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            // Select the return request button
            var returnRequestBtn = document.querySelector('.return-request-btn');

            // Add click event listener
            returnRequestBtn.addEventListener('click', function(e) {
                e.preventDefault();

                // Show SweetAlert confirmation dialog
                Swal.fire({
                    title: 'Are you sure?',
                    text: "Do you want to create a return request?",
                    icon: 'warning',
                    confirmButtonColor: '#da5858',
                    cancelButtonColor: '#757575',
                    showCancelButton: true,
                    confirmButtonText: 'Yes, create return request',
                    cancelButtonText: 'Cancel',
                    reverseButtons: true,
                }).then((result) => {
                    if (result.isConfirmed) {
                        window.location.href = returnRequestBtn.closest('.return-request-link').getAttribute('href');
                    }
                });
            });
        });
    </script>
@endsection
