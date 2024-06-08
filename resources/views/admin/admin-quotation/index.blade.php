@extends('layouts.master')
@section('title', 'Quotations')
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
    </style>
@endsection
@section('content')
    @component('components.breadcrumb')
        @slot('li_1')
            Dashboard
        @endslot
        @slot('title')
            Quotations !
        @endslot
    @endcomponent
    @if (session('success'))
        <div class="alert alert-success alert-dismissible fade show" role="alert">
            {{ session('success') }}
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
    @endif
    @if (session('danger'))
        <div class="alert alert-success alert-dismissible fade show" role="alert">
            {{ session('danger') }}
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
    @endif


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
    </style>
    <div class="">
        <div class="">
            <div class="card">
                <div class="card-header">
                    <div class="d-flex justify-content-between">
                        <h5 class="card-title">Quotations</h5>
                        <div class="">
                            <a href="{{ route('admin.create.quotation') }}" class="btn btn-bg-color text-light">Add
                                Quotation</a>
                            <button class="btn btn-bg-color text-light btn-pdf">PDF</button>
                            <button class="btn btn-bg-color text-light btn-excel">Excel</button>
                        </div>
                    </div>
                </div>
                <div class="card-body table-responsive">
                    <table class="table" id="AdminOrderTable">
                        <thead>
                            <tr>
                                <th scope="col">Quotation Number</th>
                                <th scope="col">Customer Name:</th>
                                <th scope="col">Customer Email:</th>
                                <th scope="col">Customer Address:</th>
                                {{-- <th scope="col">Product Name:</th> --}}
                                {{-- <th scope="col">Product Quantity:</th> --}}
                                {{-- <th scope="col">Total:</th> --}}
                                <th scope="col">Quotation Date</th>
                                <th scope="col">Actions:</th>
                            </tr>
                        </thead>

                        <tbody>
                            @foreach ($quotation_details as $quotation_detail)

                                <tr class="order-row">
                                    <th scope="row">{{ $quotation_detail->id }}</th>
                                    <td>
                                        @if ($quotation_detail->first_name)
                                            {{ $quotation_detail->first_name }} {{ $quotation_detail->last_name }}
                                        @else
                                            N/A
                                        @endif
                                    </td>
                                    <td>
                                        @if ($quotation_detail->email)
                                            {{ $quotation_detail->email }}
                                        @else
                                            N/A
                                        @endif
                                    </td>
                                    <td>
                                        @if ($quotation_detail->address)
                                            {{ $quotation_detail->address }}
                                        @else
                                            N/A
                                        @endif
                                    </td>
                                    {{-- <td>
                                @dd($quotation_detail)
                                @if ($quotation_detail->products && $quotation_detail->product->name)
                                    {{ $quotation_detail->product->name }}
                                @else
                                    N/A
                                @endif
                            </td> --}}
                                    {{-- <td>
                                @if ($order->productQuantities && $order->productQuantities->quantity)
                                    {{ $order->productQuantities->quantity }}
                                @else
                                    N/A
                                @endif
                            </td> --}}
                                    {{-- <td>{{ $quotation_detail->created_at }}</td> --}}
                                    <td>{{ $quotation_detail->created_at->format('j-M-Y') }}</td>
                                    <td>
                                        {{-- @dd($quotation_detail) --}}
                                        <a href="{{ route('admin.edit.quotation', ['id' => $quotation_detail->id]) }}"
                                            class="text-warning">
                                            <i class="mdi mdi-pencil font-size-18"></i>
                                        </a>
                                        <a href="{{ route('admin.show.quotation', ['id' => $quotation_detail->id]) }}">
                                            <i class="mdi mdi-eye font-size-18 text-success"></i>
                                        </a>
                                        <form id="deleteForm"
                                            action="{{ route('admin.delete.quotation', ['id' => $quotation_detail->id]) }}"
                                            method="POST" style="display: inline-block;">
                                            @csrf
                                            <button type="submit" class="text-danger"
                                                style="border: none; background-color: transparent; cursor: pointer;"
                                                onclick="confirmDelete()">
                                                <i class="mdi mdi-delete font-size-18"></i>
                                            </button>
                                        </form>
                                        {{-- <i class="mdi mdi-delete font-size-18 text-danger"></i> --}}
                                    </td>
                                </tr>
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
                        confirmButtonColor: '#03045E',
                        cancelButtonColor: '#757575',
                        showCancelButton: true,
                        confirmButtonText: 'Yes, delete it!',
                        customClass: {
                            confirmButton: 'btn btn-danger'
                        },
                        focusConfirm: false,
                    }).then((result) => {
                        if (result.isConfirmed) {
                            document.getElementById('deleteForm').submit();
                        }
                    });
                });
            });
        });
    </script>
@endsection
