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
            Quotations Edit !
        @endslot
    @endcomponent
    @if (session('success'))
        <div class="alert alert-success">
            {{ session('success') }}
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
                        <h5 class="card-title">Quotations Edit</h5>
                    </div>
                </div>
                <form action="{{ route('admin.update.quotation',$orderProducts->id) }}" method="post">
                    @csrf
                    <div class="ms-3 me-3 mb-3">
                        <div class="row mt-3">
                            <div class="col">
                                <label for="first_name" class="form-label">First Name:</label>
                                <input type="text" class="form-control" name="first_name"
                                    value="{{ $orderProducts->first_name }}">
                            </div>
                            <div class="col">
                                <label for="last_name" class="form-label">Last Name:</label>
                                <input type="text" class="form-control" name="last_name"
                                    value="{{ $orderProducts->last_name }}">
                            </div>
                        </div>
                        <div class="row mt-3">
                            <div class="col">
                                <label for="last_name" class="form-label">Email:</label>
                                <input type="text" class="form-control" name="email"
                                    value="{{ $orderProducts->email }}">
                            </div>
                            <div class="col">
                                <label for="address" class="form-label">Address</label>
                                <input type="text" name="address" class="form-control"
                                    value="{{ $orderProducts->address }}">
                            </div>
                        </div>
                        <div class="row mt-3">
                            <div class="col">
                                <div class="mb-3">
                                    <label for="" class="form-label">Region</label>
                                    <select class="form-select bg-input" name="region_state" id="region_states" aria-label="Default select example">
                                        <option value="" disabled>Select Region</option>
                                        @foreach ($regions as $region)
                                            <option value="{{$region->name}}" {{ ($region->name == $orderProducts->region_state ? 'selected' : '' )}}>{{$region->name}}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                            <div class="col">
                                <div class="mb-3">
                                    <label for="" class="form-label">Account Manager</label>
                                        <select class="form-select bg-input" name="account_manager" id="region_states" aria-label="Default select example">
                                    <option value="" disabled>Select Account Manager</option>
                                        @foreach ($AccountManagers as $AccountManager)
                                            <option value="{{$AccountManager->name}}" {{ ($AccountManager->name == $orderProducts->account_manager ? 'selected' : '' )}}>{{$AccountManager->name}}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                        </div>
                        <hr>
                        <div class="row">
                            <div class="col-6">
                                <div class="d-flex justify-content-between">
                                    <h4 class="mb-4">Select Products</h4>
                                </div>
                                <div class="row">
                                    <div class="mb-3">
                                        <select class="form-select" name="product_id[]">
                                            <option value="Select">Select</option>
                                            @foreach ($products as $product)
                                                <option value="{{ $product->id }}"
                                                    data-id = "{{$product->id}}"
                                                    data-price="{{ $product->sale_price ? $product->sale_price : $product->price }}"
                                                    data-sale="{{ $product->sale_price }}"
                                                    data-name="{{ $product->name }}"
                                                    data-quantity = "{{ $product->quantity }}"
                                                    @if (count($product->gallery_images) > 0)
                                                        data-image="{{$product->gallery_images[0]->images}}"
                                                    @endif
                                                >{{$product->name}}
                                                </option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>
                                <div class="mb-3">
                                    <button type="button" class="btn btn-primary btn-bg-color border-0" id="add">Add Product</button>
                                </div>
                            </div>
                            <div class="col-6">
                                <div class="card">
                                    <div class="card-body">
                                        <div class="d-flex justify-content-between">
                                            <h4 class="mb-4">Products</h4>
                                            <input type="text" class="form-control w-50 mb-4"
                                                value="@if (isset($orderProducts->discount_code_coppen)) {{$orderProducts->discount_code_coppen }} @endif" id="discount_coupon"
                                                placeholder="Enter coupon code here">
                                        </div>
                                        <div class="table-responsive">
                                            <table class="table mb-0">
                                                <thead>
                                                    <th scope="col">Product Name</th>
                                                    <th scope="col">Product Image</th>
                                                    <th scope="col">Quantity</th>
                                                    <th scope="col">Unit Price</th>
                                                    <th scope="col">Sale Price</th>
                                                    <th scope="col">Subtotal</th>
                                                    <th scope="col">Action</th>
                                                </thead>
                                                <tbody class="table-body">
                                                    @foreach ($orderProducts->products as $orderProduct) 
                                                        <tr class="append-tr-{{$orderProduct->product->name}}" id="{{$orderProduct->product->id}}">
                                                                <td>{{ $orderProduct->product->name }}</td>
                                                                <td>
                                                                @foreach ($orderProduct->product->gallery_images as $productImage)
                                                                    <img src="{{url('images/product_images/'. $productImage->images)}}" alt="" style="height:100px;width:120px;">
                                                                    @break
                                                                @endforeach
                                                            </td>   
                                                            <td>
                                                                <input type="number" name="quantity[]"
                                                                class="form-control no-spinners product-quantity" placeholder="Quantity"
                                                                value="{{ $orderProduct->product_quantity }}" id="productQuantity" min="1">    
                                                            </td>   
                                                            <td data-price="{{ $orderProduct->product->sale_price ? $orderProduct->product->sale_price : $orderProduct->product->price }}">
                                                                {{ $orderProduct->product->price }}
                                                            </td>
                                                            <td>
                                                            @if (isset($orderProduct->product->sale_price))  
                                                            {{$orderProduct->product->sale_price}}
                                                            @else
                                                            <p class="text-center">0</p>
                                                            @endif
                                                            </td>
                                                            <td class="product-subtotal" id="subtotal">
                                                                @if (isset($orderProduct->product->sale_price))     
                                                                {{$orderProduct->product->sale_price * $orderProduct->product_quantity}}
                                                                @else
                                                                {{$orderProduct->product->price * $orderProduct->product_quantity}}
                                                                @endif
                                                            </td>  
                                                            <td class="remove-product" data-id="{{$orderProduct->product_id}}" data-remove="append-tr-{{ $orderProduct->product->name }}" data-name="{{ $orderProduct->product->name }}">
                                                                <i class="mdi mdi-delete font-size-18 text-danger"></i>
                                                            </td>
                                                        </tr>
                                                        @endforeach
                                                        <div class="hidden-fields">
                                                        <input type="hidden" name="total_price" id='total-price-input' value="{{$orderProducts->grand_total}}">
                                                        <input type="hidden" name="product_ids" id="multipleProducts" value="{{$orderProduct->product_id}}">
                                                        <input type="hidden" name="old_price" id="old_price" value="{{$orderProducts->grand_total}}">
                                                        <input type="hidden" name="old_discount" id="old_discount" value="{{$orderProducts->discount_amount}}">
                                                        <input type="hidden" name="discount_amount" id="discount_amount" value="{{$orderProducts->discount_amount}}">
                                                        <input type="hidden" name="shipping_amount" id="shipping_amount" value="{{$orderProducts->shipping_amount}}">
                                                        <input type="hidden" name="new_subtotal" id="new_subtotal" value="{{$orderProducts->total_amount}}">
                                                        <input type="hidden" name="new_total_amount" id="new_total_amount" value="">
                                                        <input type="hidden" name="vat_amount" id="vat_amount" value="">
                                                        <input type="hidden" name="coupon_name" id="coupon_name" value="">
                                                    </div>
                                                        <script>
                                                            document.getElementById('multipleProducts').value = '{{ $productIdsString }}';
                                                        </script>
                                                </tbody>
                                            </table>
                                            <div class="d-flex justify-content-between">
                                                <div>
                                                    <p class="fw-bold mt-3 mb-3 mx-2">Discount</p>
                                                    <p class="fw-bold mt-3 mb-3 mx-2">Shipping</p>
                                                    <p class="fw-bold mt-3 mb-3 mx-2">Total</p>
                                                </div>
                                                <div>
                                                    <div class="mt-3 mb-3 mx-2 text-end"><span id="discount"></span></div>
                                                    <div class="mt-3 mb-3 mx-2 text-end"><span id="shipping"></span></div>
                                                    <div class="mt-3 mb-3 mx-2 text-end"><span id="total-price"></span></div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="row mt-2">
                            <div class="col-3 mx-auto">
                                <button type="submit" class="btn btn-bg-color text-white w-100">Update Order</button>
                            </div>
                        </div>
                    </div>
                </form>
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
    {{-- <script src="https://cdn.datatables.net/1.13.7/js/jquery.dataTables.js"></script> --}}
    {{-- <script src="https://cdn.datatables.net/buttons/2.3.0/js/dataTables.buttons.min.js"></script> --}}
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jszip/3.1.3/jszip.min.js"></script>
    <script src="https://cdn.datatables.net/buttons/2.3.0/js/buttons.html5.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/pdfmake@0.1.70/build/pdfmake.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/pdfmake@0.1.70/build/vfs_fonts.js"></script>
    {{-- <script>
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

        // function showUpdateOrderStatusModal(orderId, currentOrderStatus) {
        //     Swal.fire({
        //         title: 'Update Order Status',
        //         html: `
        //     <select id="orderStatus" class="swal2-input">
        //         <option value="processing" ${currentOrderStatus === 'processing' ? 'selected' : ''}>Processing</option>
        //         <option value="shipped" ${currentOrderStatus === 'shipped' ? 'selected' : ''}>Shipped</option>
        //         <option value="En Route" ${currentOrderStatus === 'En Route' ? 'selected' : ''}>En Route</option>
        //         <option value="delivered" ${currentOrderStatus === 'delivered' ? 'selected' : ''}>Delivered</option>
        //         <option value="On Hold" ${currentOrderStatus === 'On Hold' ? 'selected' : ''}>On Hold</option>
        //     </select>
        //     <textarea id="ordermessage" class="swal2-input" placeholder="Order Message"></textarea>
        //     <div id="validation-message" style="color: red;"></div>
        //     `,
        //         showCancelButton: true,
        //         confirmButtonText: 'Update',
        //         cancelButtonText: 'Cancel',
        //         showLoaderOnConfirm: true,
        //         preConfirm: () => {
        //             const orderStatus = document.getElementById('orderStatus').value;
        //             const ordermessage = document.getElementById('ordermessage').value;

        //             if (!ordermessage) {
        //                 document.getElementById('validation-message').innerText = 'Order Message is required.';
        //                 return false;
        //             } else {
        //                 document.getElementById('validation-message').innerText = '';
        //             }

        //             return updateOrderStatus(orderId, orderStatus, ordermessage);
        //         },
        //         allowOutsideClick: () => !Swal.isLoading(),
        //     });
        // }

        // function updateOrderStatus(orderId, orderStatus, ordermessage) {
        //     return new Promise((resolve) => {
        //         $.ajax({
        //             url: `/admin/orders/status/${orderId}`,
        //             type: 'POST',
        //             data: {
        //                 _token: '{{ csrf_token() }}',
        //                 orderStatus,
        //                 ordermessage
        //             },
        //             dataType: 'json',
        //             success: (response) => {
        //                 if (response.success) {
        //                     Swal.fire({
        //                         title: 'Success!',
        //                         text: response.message,
        //                         icon: 'success',
        //                     }).then(() => {
        //                         location.reload();
        //                         resolve(true);
        //                     });
        //                 } else {
        //                     Swal.showValidationMessage(response.message);
        //                 }
        //             },
        //             error: (error) => {
        //                 console.log(error);
        //                 Swal.showValidationMessage(`Request failed: ${error.responseJSON.message}`);
        //             },
        //         });
        //     });
        // }
    </script> --}}
    <!-- <script>
        $(document).ready(function() {
            $(".remove-input").on("click", function(e) {
                e.preventDefault();

                Swal.fire({
                    title: 'Are you sure?',
                    text: 'You are about to remove this product. This action cannot be undone.',
                    icon: 'warning',
                    showCancelButton: true,
                    confirmButtonColor: '#da5858',
                    cancelButtonColor: '#757575',
                    confirmButtonText: 'Yes, remove it!'
                }).then((result) => {
                    if (result.isConfirmed) {
                        // User clicked the confirm button
                        $(this).closest(".product-row").hide();
                        Swal.fire('Removed!', 'The product has been removed.', 'success');
                    }
                });
            });

            $(document).on('click', '.remove-appended-input', function(e) {
                e.preventDefault();
                $(this).closest(".product-row").hide();
            });
            $(document).on('keyup', '.saved-quantity', function(e) {
                e.preventDefault();
                var quantity = parseInt($(this).val()) || 0;
                console.log(quantity);
                var productRow = $(this).closest(".product-row");
                var productPriceField = productRow.find(".saved-product-price");
                console.log(productPriceField);
                var initialProductPrice = productPriceField.data("initial-price");
                console.log(initialProductPrice);
                var newProductPrice = initialProductPrice * quantity;
                productPriceField.val(newProductPrice);
            });

            $(".add-input").on("click", function(e) {
                e.preventDefault();

                var newInput = `<div class="row product-row">`;
                newInput += `<div class="col">`;
                newInput += `<label for="product_name" class="form-label">Product Name</label>`;
                newInput += `<select name="product_name[]" class="form-control product-dropdown">`;
                newInput += `<option value="" selected disabled>Please select a product</option>`;
                @foreach ($products as $product)
                    newInput +=
                        `<option value="{{ $product->name }}" data-price="{{ $product->price }}">{{ $product->name }}</option>`;
                @endforeach

                newInput += `</select>`;
                newInput += `</div>`;
                newInput += `<div class="col product-quantity-container" style="display:none">`;
                newInput += `<label for="product_quantity" class="form-label">Product Quantity</label>`;
                newInput +=
                    `<input type="number" name="product_quantity[]" class="form-control product-quantity" value="">`;
                newInput += `</div>`;
                newInput += `<div class="col product-price-container" style="display:none">`;
                newInput += `<label for="product_price" class="form-label">Product Price</label>`;
                newInput +=
                    `<input type="number" name="product_price[]" class="form-control product-price" value="">`;
                newInput += `</div>`;
                newInput += `<div class="col-1">`;
                newInput +=
                    `<button class="remove-appended-input btn-styling" style="margin-top: 36px;">Remove</button>`;
                newInput += `</div>`;
                newInput += `</div>`;

                $('#input-container').append(newInput);

                $(document).on("change", ".product-dropdown", function() {
                    var selectedOption = $(this).find("option:selected");
                    var productPrice = selectedOption.data("price");
                    $(this).closest(".product-row").find(".product-quantity-container").show();
                    $(this).closest(".product-row").find(".product-price-container").show();
                    $(this).closest(".product-row").find(".product-quantity").val('1');
                    updateProductPrice($(this).closest(".product-row"));
                });

                $(document).on('keyup', '.product-quantity', function(e) {
                    e.preventDefault();
                    updateProductPrice($(this).closest(".product-row"));
                });

                function updateProductPrice(productRow) {
                    var quantity = parseInt(productRow.find(".product-quantity").val()) || 0;
                    var productPrice = parseFloat(productRow.find(".product-dropdown option:selected").data(
                        "price")) || 0;
                    var newProductPrice = productPrice * quantity;
                    productRow.find(".product-price").val(newProductPrice);
                }

            });
        });
        $("#qoutation_update").on("click", function(e) {
            e.preventDefault();

            // Hide the rows you want to exclude
            $(".product-row:hidden").remove();

            // Now submit the form
            $("form").submit();
        });
    </script> -->
    <script>
        $(document).ready(function () {
            $('#add').click(function (e) { 
                e.preventDefault();
                $('select[name="product_id[]"]').each(function(index, element) {
                    var selectedOption = $(element).find(':selected');
                    if(selectedOption.val()!=='Select')
                    {
                        $(selectedOption).hide();
                        var productId = selectedOption.data('id');
                        var productIdToRemove = selectedOption.data('id');
                        var productIds=$('#multipleProducts').val();
                        $('#multipleProducts').val(productId);
                        if(productIds!=""){
                        productId = productId+','+productIds;
                        }
                        $('#multipleProducts').val(productId);
                        var name = selectedOption.data('name');
                        var image = selectedOption.data('image');
                        var quantity = 1;
                        var unitPrice = selectedOption.data('price');
                        var saleprice = selectedOption.data('sale');
                        var productTotal = quantity * unitPrice;
                        var tableProductRow = `
                        <tr class="append-tr-${name}" id="${productIdToRemove}">
                            <td>${name}</td>
                            <td><img src="/images/product_images/${image}" alt="image" style="height:100px;width:100px;"></td>
                            <td>
                                <input type="number" name="quantity[]"
                                class="form-control no-spinners product-quantity" placeholder="Quantity"
                                 value="${quantity}" min="1" id="new-product-quantity">
                            </td>
                            <td data-price="${unitPrice}">${unitPrice}</td>
                            <td data-sale="${saleprice}">${saleprice}</td>
                            <td class="product-subtotal">${productTotal}</td>
                            <td class="remove-product" data-id="${productId}" data-remove="append-tr-${name}" data-name="${name}">
                                <i class="mdi mdi-delete font-size-18 text-danger"></i>
                            </td>
                        </tr>
                        `;  
                        $('.table-body').append(tableProductRow);
                        $(element).val('Select');
                        
                    }
                });
                updateTotal();
                updateShipping();
                handleDiscountCoupon();
                updateNewSubtotal(); 
            });
            function updateNewSubtotal() {
                var newSubtotal = 0;
                $('.product-subtotal').each(function() { 
                    newSubtotal += parseFloat($(this).text());
                });
                $('#new_subtotal').val(newSubtotal);
            }
            $('.table-body').on('keyup', '.product-quantity', function () {
                updateSubtotal($(this));
                updateNewSubtotal();
                updateTotal();
                updateShipping(); 
                
            });
            function updateSubtotal(inputElement) {
                var quantity = parseInt(inputElement.val());
                var unitPrice = parseFloat(inputElement.closest('tr').find('[data-price]').data('price'));
                var productTotal = quantity * unitPrice;
                inputElement.closest('tr').find('.product-subtotal').text(productTotal.toFixed(2));
            }
            function updateTotal() {
                var total = 0;
                $('.product-subtotal').each(function() { 
                    total += parseFloat($(this).text());
                });
                $('#old_price').val(total);
                let discount = $('#discount').text();
                if(isNumeric(discount)){
                $('#total-price').text(total-discount);
                $('#total-price-input').val(total-discount);
                }else{
                    var old_discount = $('#old_discount').val();
                    $('#total-price').text(total-old_discount);
                    $('#total-price-input').val(total-old_discount);
                }
                function isNumeric(discount) {
                    var discount= Number(discount);
                    return typeof discount === 'number' && !isNaN(discount);
                }
            }
            // Remove Product 
            $('.table-body').on('click', '.remove-product', function (e) {
                console.log('called');
                e.preventDefault();
                var productName = $(this).data('remove');

                var productOrignalName = $(this).data('name');


                var productIdToRemove = $(this).data('id');

                var productIdsValue = document.getElementById('multipleProducts').value;

                let idToRemove = productIdToRemove;

                
                let valueArray = productIdsValue.split(',');
                
                
                valueArray = valueArray.filter(value => value != idToRemove);
                

                let updatedValueString = valueArray.join(',');
                $('#multipleProducts').val(updatedValueString);
                $(`#${productIdToRemove}`).remove();

                
                var show = $('select[name="product_id[]"] option[data-name="' + productOrignalName + '"]');
                
                show.css('display','block');
                
                updateTotal();
                updateNewSubtotal();
                updateShipping(); 
            });
            $(document).on('keydown', '#new-product-quantity', function(e) {
                var inputValue = $(this).val();

                if (e.which === 8 && inputValue.length === 1) {
                    e.preventDefault();
                }
            });
            $(document).on('keydown', '#productQuantity', function(e) {
                var inputValue = $(this).val();

                if (e.which === 8 && inputValue.length === 1) {
                    e.preventDefault();
                }
            });
            
        // --------------Shipping And Discount Coupon Calculation
            var timeoutId;
            function handleDiscountCoupon() {
                clearTimeout(timeoutId);
                var discount_coupon = $('#discount_coupon').val();
                console.log("-----Discount Coupon----------",discount_coupon)
                var total = $('#subtotal').text();
                var totalAmount = parseFloat(total.replace(/\D/g, ''));
                
                timeoutId = setTimeout(function() {
                    $.ajax({
                        type: 'POST',
                        url: "/cart/discount",
                        data: {
                            totalAmount: totalAmount,
                            discount_coupon: discount_coupon,
                            _token: '{{ csrf_token() }}',
                        },
                        success: function(response) {
                            console.log(response);
                            total = response.total;
                            var newtotal = $('#subtotal').text();
                            var newtotal = parseFloat(newtotal.replace(/\D/g, ''));
                            discount_amount = response.discount;
                            var selectedRegionState = $('#region_states').val();

                            if (!(selectedRegionState == 'Makkah' || selectedRegionState == 'Dammam' || selectedRegionState == 'Kohbar' ||
                                    selectedRegionState == 'Jeddah' || selectedRegionState == 'Riyadh')) {
                                var shipping = newtotal * 0.05;
                                // total = total + shipping;
                                var newshipping = newtotal * 0.05;
                                // newtotal = newtotal + newshipping;
                            }

                            $('#discount-show').show();
                            if (response.discount) {
                                $('#discount').text('- ' + discount_amount + ' SAR');
                                $('#total').text(total + ' SAR');
                                $('#new_total_amount').val(total);
                                $('#discount_amount').val(discount_amount);
                                $('#coupon_name').val(response.coupon_name);
                            } else if (discount_coupon == '') {
                                $('#discount-show').hide();
                                $('#total').text(newtotal);
                                $('#new_total_amount').val(newtotal);
                                $('#discount_amount').val(0);
                                $('#discount').text( 0 + ' SAR');
                                $('#coupon_name').val('');
                            } else {
                                $('#discount').text(response.message);
                                $('#total').text(newtotal + ' SAR');
                                $('#new_total_amount').val(newtotal);
                                $('#discount_amount').val(0);
                                $('#coupon_name').val('');
                            }
                            updateShipping();
                        },
                        error: function(response) {
                            console.log(response);
                        },
                    });
                }, 1000);
            }
            function updateShipping() {
                var subamount = parseFloat($('#new_subtotal').val().replace(/[^\d.]/g, ''));
                var discountAmount = parseFloat($('#discount_amount').val());
                var selectedRegionState = $('#region_states').val();
                console.log("----Given Subtotal-----",subamount)
                console.log("----Given DiscountAmount-----",discountAmount)
                console.log("----Given RegionSelected-----",selectedRegionState)
                $.ajax({
                    type: 'POST',
                    url: '{{ route("admin.update.shipping") }}',
                    data: {
                        selectedRegionState: selectedRegionState,
                        subtotal: subamount,
                        discountAmount: discountAmount,
                        _token: '{{ csrf_token() }}',
                    },
                    success: function(response) {
                        console.log("----------", response);
                        var shippingAmount = response.shippingAmount;
                        var grandTotal = response.grandTotal;
                        var vatRate = 0.15;
                        var vatAmount = grandTotal * vatRate;
                        $('#vat_amount').val(vatAmount.toFixed(2));
                        var totalWithVat = grandTotal + vatAmount;
                        console.log("totalWithVat",totalWithVat);
                        console.log(grandTotal);
                        if (shippingAmount > 0) {
                            $('#shipping_amount').val(shippingAmount);
                            $('#shipping').text(shippingAmount + ' SAR');
                        } else {
                            $('#shipping_amount').val(0);
                            $('#shipping').text("Enjoy Free Shipping on Your Order!");
                        };
                        $('#total-price').text(totalWithVat.toFixed(2) + ' SAR');
                        $('#new_total_amount').val(totalWithVat.toFixed(2));
                        var new_total_amount = parseFloat($('#new_total_amount').val());
                        console.log(new_total_amount);
                    },
                    error: function(error) {
                        console.log("Ajax request failed:", error);
                    }
                });
            }
            $('#discount_coupon').on('keyup', function() {
                handleDiscountCoupon();
            });
            updateShipping();
            handleDiscountCoupon();
            $('#region_states').on('change', function() {
                updateShipping();
            });
        });
    </script>
@endsection
