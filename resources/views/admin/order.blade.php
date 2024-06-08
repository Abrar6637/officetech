@extends('layouts.master')
@section('title','Orders')
@section('css')
<link href="{{ URL::asset('/assets/libs/admin-resources/admin-resources.min.css') }}" rel="stylesheet">
<link href="{{ URL::asset('assets/libs/dropzone/dropzone.min.css') }}" rel="stylesheet">
<link rel="stylesheet" href="https://cdn.datatables.net/1.13.7/css/jquery.dataTables.css" />
<link rel="stylesheet" href="https://cdn.datatables.net/buttons/2.3.0/css/buttons.dataTables.min.css" />
<style>
    .current
   {
       background: #f4f5f8 !important;
       border: none !important;
   }
   .dataTables_wrapper .dataTables_paginate .paginate_button:hover
   {
       background: transparent !important;
       color: #03045E !important;
       border-color: transparent !important;
   }
   .dataTables_wrapper .dataTables_filter input:focus-visible
   {
       outline: none !important;
   }
   .dataTables_wrapper .dataTables_info
   {
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
Orders !
@endslot
@endcomponent
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
.swal2-styled.swal2-confirm
{
    background-color: #03045E;
    outline:none !important;
    box-shadow:none !important;
}
.swal2-styled.swal2-confirm:focus{
    outline: none !important;
    box-shadow: none !important;
}
@media(max-width:390px){
    .orders-none-display{
        display: flex;
        flex-direction: column;
    }
    .btn-bg-color{
        font-size: 14px;
    }
}
@media(min-width:306px) and (max-width:312px){
    .btn-bg-color{
        font-size: 13px;
    }
}
@media(min-width:286px) and (max-width:305px){
    .btn-bg-color{
        font-size: 11px;
    }
}
@media(max-width:285px){
    .btn-bg-color{
        font-size: 8px;
    }
}

</style>
<div class="">
    <div class="">
        <div class="card">
            <div class="container mt-3">
                @if (session('success'))
                    <div class="alert alert-success text-center alert-dismissible fade show">
                        {{session('success')}}
                        @if (session('order_number'))
                            <div class="fs-5">
                                <span>Order Updated Successfully Against Order number # <font class="fw-bold text-dark">
                                        {{ session('order_number') }}</font></span>
                            </div>
                        @endif
                        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                    </div>
                @endif
            </div>
            <div class="card-header">
                <div class="d-flex justify-content-between orders-none-display">
                    <h5 class="card-title">Orders</h5>
                    <div class="">
                        <a href="{{route('admin.create.order')}}" class="btn btn-bg-color text-light">Add Order</a>
                        <button class="btn btn-bg-color text-light btn-pdf">PDF</button>
                        <button class="btn btn-bg-color text-light btn-excel">Excel</button>
                    </div>
                </div>
            </div>
            <div class="card-body table-responsive">
                <table class="table" id="AdminOrderTable">
                    <thead>
                        <tr>
                        <th scope="col">Actions:</th>
                            <th scope="col">Order Number</th>
                            <th scope="col">Customer Name:</th>
                            <th scope="col">Customer Phone:</th>
                            <th scope="col">Customer Address:</th>
                            <th scope="col">Product Name:</th>
                            <th scope="col">Product Quantity:</th>
                            <th scope="col">Total:</th>
                            <th scope="col">Payment Mode:</th>
                            <th scope="col">Payment Status:</th>
                            <th scope="col">Trans Ref ID:</th>
                            <th scope="col">Order Status</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($orders as $order)
                        @if($order->return_status == 0)
                        <tr class="order-row">
                        <td>
                                <div class="dropdown open">
                                    <a class="btn btn-secondary dropdown-toggle" type="button" id="triggerId" data-bs-toggle="dropdown" aria-haspopup="true"
                                            aria-expanded="false">
                                                Options
                                            </a>
                                    <div class="dropdown-menu" aria-labelledby="triggerId">
                                        <a class="dropdown-item" href="{{route('admin.order.invoice', ['orderId' => encrypt($order->id)] )}}">Invoice</a>
                                        <a class="dropdown-item" href="{{route('admin.edit.order', ['id' => $order->id])}}">Edit Order</a>
                                        <a class="dropdown-item" style="cursor: pointer;" onclick="showUpdateOrderStatusModal('{{ $order->id }}', '{{ $order->order_status }}')">Order Status</a>
                                        <a class="dropdown-item">
                                            <form id="deleteForm" action="{{ route('admin.destory', ['id' => $order->id]) }}" method="POST" style="display: inline-block;">
                                                @csrf
                                                <button type="submit" class="" style="border: none; background-color: transparent; cursor: pointer;" onclick="confirmDelete()">
                                                    Delete
                                                </button>
                                            </form>
                                        </a>
                                    </div>
                                </div>
                            </td>
                            <th scope="row">{{ $order->order_number}}</th>
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
                            <td style="min-width: 250px;max-width: 250px">
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
                            <td>
                                {{ $order->payment_status }}
                            </td>
                            <td>
                                {{ $order->order_payment_status }}
                            </td>
                            <td>
                                @if ($order->tran_ref == '')
                                Manual
                                @else
                                {{ $order->tran_ref }}
                                @endif

                            </td>
                            <td class="order_status">{{ $order->order_status }}</td>
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
    jQuery(document).ready(function ($) {
    $.noConflict();
    globalTable= $('#AdminOrderTable').DataTable({
        paging: true,
        order: [[0, 'desc']],
        dom: 'lBfrtip',
        buttons: [
            'excelHtml5',
            {
                extend: 'pdfHtml5',
                text: 'PDF',
                download: 'open',
                exportOptions:{
                    columns: function(idx, data, node) {
                        const totalColumns = $(node).parents('table').find('thead th').length;
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
            <div id="validation-message" style="color: #03045E;"></div>
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
    function updateOrderStatus(orderId, orderStatus,ordermessage) {
        return new Promise((resolve) => {
            $.ajax({
                url: `/admin/orders/status/${orderId}`,
                type: 'POST',
                data: { _token: '{{ csrf_token() }}', orderStatus, ordermessage },
                dataType: 'json',
                success: (response) => {
                    if (response.success) {
                        Swal.fire({
                            title: 'Success!',
                            text: response.message,
                            icon: 'success',
                            iconColor: '#03045E',
                            confirmButtonColor: '#03045E',
                            confirmButtonText: 'OK'
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
