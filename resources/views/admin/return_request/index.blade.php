@extends('layouts.master')
@section('title', 'Orders')
@section('css')
    <link href="{{ URL::asset('/assets/libs/admin-resources/admin-resources.min.css') }}" rel="stylesheet">
    <link href="{{ URL::asset('assets/libs/dropzone/dropzone.min.css') }}" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.datatables.net/1.13.7/css/jquery.dataTables.css" />
    <link rel="stylesheet" href="https://cdn.datatables.net/buttons/2.3.0/css/buttons.dataTables.min.css" />
    <style>
        .current {
            background: #f4f5f8 !important;
            border: none !important;
        }

        .dataTables_wrapper .dataTables_paginate .paginate_button:hover {
            background: transparent !important;
            color: #03045E !important;
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
    </style>
@endsection
@section('content')
    @component('components.breadcrumb')
        @slot('li_1')
            Dashboard
        @endslot
        @slot('title')
            Return Orders Request!
        @endslot
    @endcomponent
    @if (session('error'))
        <div class="alert alert-danger">
            {{ session('error') }}
        </div>
    @endif
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <style>
        /* Custom styles for pagination */
        .custom-pagination {
            display: flex;
            justify-content: center;
        }

        .custom-pagination .page-item {
            margin: 0 5px;
        }

        .custom-pagination .page-link {
            color: #333;
            background-color: #fff;
            border: 1px solid #ddd;
            padding: 8px 12px;
        }

        .custom-pagination .page-link:hover {
            background-color: #eee;
        }

        .inp:focus {
            outline: none !important;
            border: none !important;
            box-shadow: 0 0 0 1px #ced4da !important;

        }

        .swal2-styled.swal2-confirm {
            background-color: #03045E;
            outline: none !important;
            box-shadow: none !important;
        }

        .swal2-styled.swal2-confirm:focus {
            outline: none !important;
            box-shadow: none !important;
        }
    </style>
    <div class="">
        <div class="">
            <div class="card">
                <div class="card-header">
                    <div class="d-flex justify-content-between">
                        <h5 class="card-title">Return Request</h5>
                        <div class="">
                            <button class="btn btn-bg-color text-light btn-pdf">PDF</button>
                            <button class="btn btn-bg-color text-light btn-excel">Excel</button>
                        </div>
                    </div>
                </div>
                @if (session('success'))
                    <div class="alert alert-success alert-dismissible fade show" role="alert">
                        {{ session('success') }}
                        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                    </div>
                @endif
                <div class="card-body table-responsive">
                    <table class="table" id="AdminOrderTable">
                        <thead>
                            <tr>
                                <th scope="col">Order Number</th>
                                <th scope="col">Customer Name:</th>
                                <th scope="col">Customer Phone:</th>
                                <th scope="col">Customer Address:</th>
                                <th scope="col">Product Name:</th>
                                <th scope="col">Product Quantity:</th>
                                <th scope="col">Total:</th>
                                <th scope="col">Order Status</th>
                                <th scope="col">Return Status</th>
                                <th scope="col">Actions:</th>
                            </tr>
                        </thead>

                        <tbody>
                            @foreach ($orders as $order)
                                @if ($order->return_status != 0)
                                    <tr class="order-row">
                                        <th scope="row">{{ $order->order_number }}</th>
                                        <td>
                                            @if ($order->customer)
                                                {{ $order->customer->first_name }} {{ $order->customer->last_name }}
                                            @else
                                                N/A
                                            @endif
                                        </td>
                                        <td>
                                            @if ($order->customer)
                                                {{ $order->customer->phone_number }}
                                            @else
                                                N/A
                                            @endif
                                        </td>
                                        <td>
                                            @if ($order->customer)
                                                {{ $order->customer->address }}
                                            @else
                                                N/A
                                            @endif
                                        </td>
                                        <td>
                                            @if ($order->productQuantities && $order->productQuantities->product && $order->productQuantities->product->name)
                                                {{ $order->productQuantities->product->name }}
                                            @else
                                                N/A
                                            @endif
                                        </td>
                                        <td>
                                            @if ($order->productQuantities && $order->productQuantities->quantity)
                                                {{ $order->productQuantities->quantity }}
                                            @else
                                                N/A
                                            @endif
                                        </td>
                                        <td>{{ $order->grand_total }}</td>
                                        <td class="order_status">{{ $order->order_status }}</td>
                                        <td class="order_status">
                                            @if ($order->return_status == 1)
                                                <p class="text-warning">Pending</p>
                                            @elseif($order->return_status == 2)
                                                <p class="text-success">Approved</p>
                                            @elseif($order->return_status == 3)
                                                <p class="text-danger">Declined</p>
                                            @endif
                                        </td>

                                        <td>
                                            <form action="{{ route('admin.return.request.approve') }}" method="POST">
                                                @csrf
                                                <input type="hidden" name="order_id" value="{{ $order->id }}">
                                                <select class="form-control" name="request_action" id="request_action"
                                                    onchange="this.form.submit()">
                                                    <option value="" disabled selected>Select</option>
                                                    <option class="text-success" value="2">Approve</option>
                                                    <option class="text-danger" value="3">Decline</option>
                                                </select>
                                            </form>
                                        </td>

                                    </tr>
                                @endif
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
@endsection
@section('script')
    <!-- apexcharts -->
    <script src="{{ URL::asset('/assets/libs/apexcharts/apexcharts.min.js') }}"></script>
    <script src="{{ URL::asset('/assets/libs/admin-resources/admin-resources.min.js') }}"></script>
    <script src="{{ URL::asset('assets/libs/dropzone/dropzone.min.js') }}"></script>

    <!-- dashboard init -->
    <script src="{{ URL::asset('/assets/js/pages/dashboard.init.js') }}"></script>
    <script src="{{ URL::asset('/assets/js/app.min.js') }}"></script>

    <!-- file editor -->
    <script src="{{ URL::asset('assets/libs/@ckeditor/@ckeditor.min.js') }}"></script>
    <script src="{{ URL::asset('assets/js/pages/form-editor.init.js') }}"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@10"></script>
    <script src="https://code.jquery.com/jquery-3.6.4.min.js"></script>
    <script src="https://cdn.datatables.net/1.13.7/js/jquery.dataTables.js"></script>
    <script src="https://cdn.datatables.net/buttons/2.3.0/js/dataTables.buttons.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jszip/3.1.3/jszip.min.js"></script>
    <script src="https://cdn.datatables.net/buttons/2.3.0/js/buttons.html5.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/pdfmake@0.1.70/build/pdfmake.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/pdfmake@0.1.70/build/vfs_fonts.js"></script>
    <script>
        jQuery(document).ready(function($) {
            $.noConflict();
            globalTable = $('#AdminOrderTable').DataTable({
                paging: true,
                order: [
                    [0, 'desc']
                ],
                dom: 'lBfrtip',
                buttons: [
                    'excelHtml5',
                    {
                        extend: 'pdfHtml5',
                        text: 'PDF',
                        download: 'open',
                        exportOptions: {
                            columns: function(idx, data, node) {
                                const totalColumns = $(node).parents('table').find('thead th')
                                    .length;
                                if (idx === 5 || idx === 8) {
                                    return false;
                                }
                                return true;
                            },
                        },
                        customize: function(doc) {
                            doc.watermark = null;
                            doc.content[1].table.headerRows = 0;
                            doc.defaultStyle = {
                                alignment: 'center'
                            };
                        }
                    }
                ]
            });

            globalTable.buttons('.buttons-pdf, .buttons-excel').nodes().css("display", "none");

            $(document).on('click', '.btn-pdf', function() {
                if (globalTable) {
                    globalTable.button('.buttons-pdf').trigger();
                }
            });

            $(document).on('click', '.btn-excel', function() {
                if (globalTable) {
                    globalTable.button('.buttons-excel').trigger();
                }
            });
        });
    </script>
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            var deleteBtns = document.querySelectorAll('.text-danger');
            deleteBtns.forEach(function(deleteBtn) {
                deleteBtn.addEventListener('click', function(e) {
                    e.preventDefault();

                    Swal.fire({
                        title: 'Are you sure?',
                        text: "You won't be able to revert this!",
                        icon: 'warning',
                        showCancelButton: true,
                        confirmButtonText: 'Yes, delete it!',
                        focusConfirm: false,
                    }).then((result) => {
                        if (result.isConfirmed) {
                            document.getElementById('deleteForm').submit();
                        }
                    });
                });
            });
        });

        function showUpdateOrderStatusModal(orderId, currentOrderStatus) {
            Swal.fire({
                title: 'Update Order Status',
                html: `
            <select id="orderStatus" class="swal2-input inp">
                <option value="processing" ${currentOrderStatus === 'processing' ? 'selected' : ''}>Processing</option>
                <option value="shipped" ${currentOrderStatus === 'shipped' ? 'selected' : ''}>Shipped</option>
                <option value="En Route" ${currentOrderStatus === 'En Route' ? 'selected' : ''}>En Route</option>
                <option value="delivered" ${currentOrderStatus === 'delivered' ? 'selected' : ''}>Delivered</option>
                <option value="On Hold" ${currentOrderStatus === 'On Hold' ? 'selected' : ''}>On Hold</option>
            </select>
            <textarea id="ordermessage" class="swal2-input inp" placeholder="Order Message"></textarea>
            <div id="validation-message" style="color: red;"></div>
        `,
                showCancelButton: true,
                cancelButtonText: 'Cancel',
                confirmButtonText: 'Update',

                showLoaderOnConfirm: true,
                preConfirm: () => {
                    const orderStatus = document.getElementById('orderStatus').value;
                    const ordermessage = document.getElementById('ordermessage').value;

                    if (!ordermessage) {
                        document.getElementById('validation-message').innerText = 'Order Message is required.';
                        return false;
                    } else {
                        document.getElementById('validation-message').innerText = '';
                    }

                    return updateOrderStatus(orderId, orderStatus, ordermessage);
                },
                allowOutsideClick: () => !Swal.isLoading(),
            });
        }

        function updateOrderStatus(orderId, orderStatus, ordermessage) {
            return new Promise((resolve) => {
                $.ajax({
                    url: `/admin/orders/status/${orderId}`,
                    type: 'POST',
                    data: {
                        _token: '{{ csrf_token() }}',
                        orderStatus,
                        ordermessage
                    },
                    dataType: 'json',
                    success: (response) => {
                        if (response.success) {
                            Swal.fire({
                                title: 'Success!',
                                text: response.message,
                                icon: 'success',
                            }).then(() => {
                                location.reload();
                                resolve(true);
                            });
                        } else {
                            Swal.showValidationMessage(response.message);
                        }
                    },
                    error: (error) => {
                        console.log(error);
                        Swal.showValidationMessage(`Request failed: ${error.responseJSON.message}`);
                    },
                });
            });
        }
    </script>
@endsection
