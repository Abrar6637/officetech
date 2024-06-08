@extends('layouts.master')
@section('title')
    @lang('Admin Quotation')
@endsection
@section('css')
    <link href="{{ URL::asset('/assets/libs/admin-resources/admin-resources.min.css') }}" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.datatables.net/1.13.7/css/jquery.dataTables.css" />
    <style>
        .current {
            background: #f4f5f8 !important;
            border: none !important;
        }

        .no-spinners {
            -moz-appearance: textfield;
        }

        .no-spinners::-webkit-outer-spin-button,
        .no-spinners::-webkit-inner-spin-button {
            -webkit-appearance: none;
            margin: 0;
        }

        article {
            background: #ccc;
            height: 200px;
            display: none;
        }

        article.on {
            display: block;
        }
    </style>
@endsection
@section('content')
    @component('components.breadcrumb')
        @slot('li_1')
            Dashboard
        @endslot
        @slot('title')
            Create Quotation !
        @endslot
    @endcomponent
    <div class="row">
        <div class="col-lg-12">
            <div class="card">
                <div class="container mt-3">
                    @if (session('success'))
                        <div class="alert alert-success text-center">
                            <div class="fs-5">
                                {{ session('success') }}
                            </div>
                            @if (session('order_number'))
                                <div class="fs-5">
                                    <span>Your quotation number is # <font class="fw-bold text-dark">
                                            {{ session('order_number') }}</font></span>
                                </div>
                            @endif
                        </div>
                    @endif
                </div>
                <div class="card-header d-flex justify-content-between">
                    <div>
                        <h5 class="card-title">Create Quotation</h5>
                    </div>
                    <div class="">
                        <!-- Button trigger modal -->
                        <button type="button" class="btn btn-primary btn-bg-color border-0"
                            id="new-user" data-bs-toggle="modal" data-bs-target="#myModal">
                            New User
                        </button>
                    </div>
                </div>
                <div class="card-body">
                    <form action="{{ route('admin.store.quotation') }}" method="post">
                        @csrf
                        <div class="row">
                            <div class="col-12">
                                <h4 class="mb-4">User Details</h4>
                                <div class="row">
                                    <div class="col-6">
                                        <div class="mb-3">
                                            <label for="" class="form-label"></label>
                                            <select name="user_id" id="user" class="form-control">
                                                <option value="" disabled selected>Select User</option>
                                                @foreach ($users as $user)
                                                    <option value="{{ $user->id }}" data-name="{{ $user->name }}"
                                                        data-email="{{ $user->email }}"
                                                        data-address="{{ $user->address }}">{{ $user->name }}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                    </div>
                                    <div class="col-6">
                                        <div class="mb-3">
                                            <label for="" class="form-label">Name</label>
                                            <input type="text" name="name" id="name" value="{{ old('name') }}"
                                                class="form-control" placeholder="Name" readonly>
                                        </div>
                                        @error('name')
                                            <p class="text-danger">{{ $message }}</p>
                                        @enderror
                                    </div>
                                    <div class="col-6">
                                        <div class="mb-3">
                                            <label for="" class="form-label">Address</label>
                                            <input type="text" name="address" id="address" class="form-control"
                                                value="{{ old('address') }}" placeholder="Address">
                                        </div>
                                        @error('address')
                                            <p class="text-danger">{{ $message }}</p>
                                        @enderror
                                    </div>

                                    <div class="col-6">
                                        <div class="mb-3">
                                            <label for="" class="form-label">Email</label>
                                            <input type="text" name="email" id="email" class="form-control"
                                                placeholder="Email" value="{{ old('email') }}" readonly>
                                        </div>
                                        @error('email')
                                            <p class="text-danger">{{ $message }}</p>
                                        @enderror
                                    </div>
                                    <div class="col-6">
                                        <div class="mb-3">
                                            <label for="" class="form-label">Account Manager</label>
                                                <select class="form-select  bg-input" name="account_manager" id="account_manager" aria-label="Default select example">
                                            <option value="" disabled>Select Account Manager</option>
                                                @foreach ($AccountManagers as $AccountManager)
                                                    <option value="{{$AccountManager->name}}">{{$AccountManager->name}}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                    </div>
                                    <div class="col-6">
                                        <div class="mb-3">
                                            <label for="" class="form-label">Region</label>
                                            <select class="form-select  bg-input" name="region_state" id="region_states" aria-label="Default select example">
                                                <option value="" disabled>Select Region</option>
                                                @foreach ($regions as $region)
                                                    <option value="{{$region->name}}" {{ ($region->name == 'Riyadh' ? 'selected' : '' )}}>{{$region->name}}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                    </div>
                                    <input type="hidden" name="added_by" id="added_by" value="admin">
                                </div>
                            </div>
                            <hr>
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
                                                value="@if (isset($discount_coupon)) {{ $discount_coupon }} @endif" id="discount_coupon"
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
                                                    <div class="mt-3 mb-3 mx-2 text-end"><span id="vat"></span></div>
                                                    <div class="mt-3 mb-3 mx-2 text-end"><span id="total-price"></span></div>
                                                </div>
                                            </div>
                                            <div class="hidden-fields">
                                                <input type="hidden" name="total_price" id='total-price-input' value="0">
                                                <input type="hidden" name="before_disount_price" id='before_disount_price' value="">
                                                <input type="hidden" name="product_ids" id="multipleProducts" value="">
                                                <input type="hidden" name="discount_amount" id="discount-amount" value="">
                                                <input type="hidden" name="shipping_amount" id="shipping_amount" value="">
                                                <input type="hidden" name="subtotal" id="subtotal" value="">
                                                <input type="hidden" name="new_total_amount" id="new_total_amount" value="">
                                                <input type="hidden" name="vat_amount" id="vat_amount" value="">
                                                <input type="hidden" name="coupon_name" id="coupon_name" value="">
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="row mt-2">
                                <div class="col-3 mx-auto">
                                    <button type="submit" class="btn btn-bg-color text-white w-100">Create Quotation</button>
                                </div>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
    <!-- Modal -->
    <div class="modal fade" id="myModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <form action="{{ url('sign-up/form') }}" method="POST">
                @csrf
                <div class="modal-content">
                    <div class="modal-header">
                        <h1 class="modal-title fs-5" id="exampleModalLabel">New User</h1>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <div class="mb-3">
                            <label for="" class="form-label">Name</label>
                            <input type="text" name="name" id="" value="{{ old('name') }}"
                                class="form-control" placeholder="Name">
                        </div>
                        @error('name')
                            <p class="text-danger">{{ $message }}</p>
                        @enderror
                        <div class="mb-3">
                            <label for="" class="form-label">Email</label>
                            <input type="text" name="email" id="" class="form-control"
                                placeholder="Email" value="{{ old('email') }}">
                        </div>
                        @error('email')
                            <p class="text-danger">{{ $message }}</p>
                        @enderror
                        <div class="mb-3">
                            <label for="" class="form-label">Address</label>
                            <input type="text" name="address" id="" class="form-control"
                                value="{{ old('address') }}" placeholder="Address (Optional)">
                        </div>
                        @error('address')
                            <p class="text-danger">{{ $message }}</p>
                        @enderror
                        <input type="hidden" name="password" value="password">
                        <input type="hidden" name="password_confirmation" value="password">
                        {{-- <div class="mb-3">
                            <label for="" class="form-label">Password</label>
                            <input type="password" name="password" id="password" class="form-control"
                                value="{{ old('password') }}" placeholder="Password">
                        </div>
                        @error('password')
                            <p class="text-danger">{{ $message }}</p>
                        @enderror
                        <div class="mb-3">
                            <label for="" class="form-label">Confirm Password</label>
                            <input type="password" name="password_confirmation" id="confirm_password" class="form-control"
                                value="{{ old('password_confirmation') }}" placeholder="Confirm Password">
                        </div>
                        @error('password_confirmation')
                            <p class="text-danger">{{ $message }}</p>
                        @enderror --}}
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                        <button type="submit" class="btn btn-primary btn-bg-color border-0">Save
                            changes</button>
                    </div>
                </div>
            </form>
        </div>
    </div>
@endsection
@section('script')
    <script src="https://code.jquery.com/jquery-3.6.4.min.js"></script>
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
                                <input type="number" name="product_quantity[]"
                                class="form-control no-spinners product-quantity" placeholder="Quantity"
                                 value="${quantity}" min="1" id="new-product-quantity">
                            </td>
                            <td data-price="${unitPrice}">${unitPrice}</td>
                            <td data-sale="${saleprice}">${saleprice}</td>
                            <td class="product-subtotal">${productTotal}</td>
                            <td class="remove-product" data-id="${productId}" data-remove="append-tr-${name}" data-name="${name}">
                                <i class="mdi mdi-delete font-size-18 text-danger"></i>
                            </td>
                            <input type="hidden" name="product_names[]" value="${name}">
                            <input type="hidden" name="product_prices[]" value="${unitPrice}">
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
                $('#subtotal').val(newSubtotal);
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
                // $('#total-price-input').val(total-discount);
                }else{
                    var old_discount = $('#old_discount').val();
                    $('#total-price').text(total-old_discount);
                    // $('#total-price-input').val(total-old_discount);
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
                var total = $('#subtotal').val();
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
                                total = total + shipping;
                                var newshipping = newtotal * 0.05;
                                newtotal = newtotal + newshipping;
                            }

                            $('#discount-show').show();
                            if (response.discount) {
                                $('#discount').text('- ' + discount_amount + ' SAR');
                                $('#total').text(total + ' SAR');
                                $('#new_total_amount').val(total);
                                $('#discount-amount').val(discount_amount);
                                $('#coupon_name').val(response.coupon_name);
                            } else if (discount_coupon == '') {
                                $('#discount-show').hide();
                                $('#total').text(newtotal);
                                $('#new_total_amount').val(newtotal);
                                $('#discount-amount').val(0);
                                $('#discount').text( 0 + ' SAR');
                                $('#coupon_name').val('');
                            } else {
                                $('#discount').text(response.message);
                                $('#total').text(newtotal + ' SAR');
                                $('#new_total_amount').val(newtotal);
                                $('#discount-amount').val(0);
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
                var subamount = parseFloat($('#subtotal').val().replace(/[^\d.]/g, ''));
                var discountAmount = parseFloat($('#discount-amount').val());
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
                        $('#vat_amount').val(vatAmount);
                        var totalWithVat = grandTotal + vatAmount;
                        console.log("totalWithVat",totalWithVat);
                        console.log(grandTotal);
                        if (shippingAmount > 0) {
                            $('#shipping_amount').val(shippingAmount);
                            $('#shipping').text(shippingAmount + ' SAR');
                        } else {
                            $('#shipping_amount').val(0);
                            $('#shipping').text("Enjoy Free Shipping on Your Order!");
                        }
                        $('#total-price').text(totalWithVat.toFixed(2) + ' SAR');
                        $('#new_total_amount').val(totalWithVat.toFixed(2));

                    },
                    error: function(error) {
                        console.log("Ajax request failed:", error);
                    }
                });
            }
            $('#discount_coupon').on('keyup', function() {
                handleDiscountCoupon();
            });
            // updateShipping();
            // handleDiscountCoupon();
            $('#region_states').on('change', function() {
                updateShipping();
            });
        });
    </script>
    <!-- apexcharts -->
    <script src="{{ URL::asset('/assets/libs/apexcharts/apexcharts.min.js') }}"></script>
    <script src="{{ URL::asset('/assets/libs/admin-resources/admin-resources.min.js') }}"></script>
    <script src="https://cdn.datatables.net/1.13.7/js/jquery.dataTables.js"></script>
    <!-- dashboard init -->
    <script src="{{ URL::asset('/assets/js/pages/dashboard.init.js') }}"></script>
    <script src="{{ URL::asset('/assets/js/app.min.js') }}"></script>
    <script>
        $(document).ready(function() {
            $('#user').on('change', function() {
                // console.log('as');
                var selectedOption = $(this).find(":selected");

                var name = selectedOption.data("name");
                var email = selectedOption.data("email");
                var address = selectedOption.data("address");

                $('#name').val(name);
                $('#email').val(email);
                $('#address').val(address);
            });
        });
    </script>
@endsection
