@extends('layouts.master')
@section('title')
    @lang('Account Manager')
@endsection
@section('css')
    <link href="{{ URL::asset('/assets/libs/admin-resources/admin-resources.min.css') }}" rel="stylesheet">
    <link href="{{ URL::asset('assets/libs/dropzone/dropzone.min.css') }}" rel="stylesheet">
    <style>
        /* Chrome, Safari, Edge, Opera */
input::-webkit-outer-spin-button,
input::-webkit-inner-spin-button {
  -webkit-appearance: none;
  margin: 0;
}

/* Firefox */
input[type=number] {
  -moz-appearance: textfield;
}
</style>
@endsection
@section('content')
    @component('components.breadcrumb')
        @slot('li_1')
            Dashboard
        @endslot
        @slot('title')
            Account Managers !
        @endslot
    @endcomponent
    <style>
        table {
            width: 100%;
            border: 1px solid #ddd;
        }

        td {
            padding: 16px;
        }

        tr:nth-child(even) {
            background-color: #eee;
        }
    </style>
    <div class="row">
        <div class="col-lg-12">
            <div class="card">
                <div class="card-header">
                    <h5 class="card-title">Edit Account Manager</h5>
                </div>
                <div class="card-body">
                    <form action="{{route('update.region',$region->id)}}" method="post">
                        @csrf
                        <div class="mb-3">
                            <label for="example-text-input" class="form-label">Region Name</label>
                            <input class="form-control" type="text" name="name" placeholder="Region Name" value="{{$region->name}}">
                        </div>
                        @error('name')
                            <p class="alert alert-danger">{{$message}}</p>
                        @enderror
                        <div class="mb-3">
                            <label class="form-label">Shipping Type</label>
                            <select class="form-select" name="shipping_type" id="shipping_type">
                                <option value="" disabled>Select Shipping Type</option>
                                <option value="0" {{ old('shipping_type', $region->shipping_type) == 0 ? 'selected' : '' }}>Fixed Amount</option>
                                <option value="1" {{ old('shipping_type', $region->shipping_type) == 1 ? 'selected' : '' }}>Percentage</option>
                                <option value="2" {{ old('shipping_type', $region->shipping_type) == 2 ? 'selected' : '' }}>Free Shipping</option>
                            </select>
                        </div>
                        @error('shipping_type')
                            <p class="alert alert-danger">{{ $message }}</p>
                        @enderror

                        <div class="mb-3">
                            <label class="form-label">Shipping Amount</label>
                            <input class="form-control" type="number" placeholder="Shipping Amount" name="amount" value="{{$region->amount}}" id="shipping_amount">
                        </div>
                        @error('amount')
                            <p class="alert alert-danger">{{$message}}</p>
                        @enderror
                        <div class="mb-3">
                            <label class="form-label">Delivery Days</label>
                            <input class="form-control" type="number" placeholder="Delivery Days" name="delivery_days" value="{{$region->delivery_days}}">
                        </div>
                        @error('delivery_days')
                            <p class="alert alert-danger">{{$message}}</p>
                        @enderror
                        <div class="mb-3">
                            <label class="form-label">Status</label>
                            <select class="form-select" name="status">
                                <option value="0" {{$region->status == '0' ? 'selected' : ''}}>Inactive</option>
                                <option value="1" {{$region->status == '1' ? 'selected' : ''}}>Active</option>
                            </select>
                        </div>
                        <div class="mt-4">
                            <button type="submit" class="btn border-0 w-md btn-bg-color text-white">Submit</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="{{ URL::asset('/assets/libs/apexcharts/apexcharts.min.js') }}"></script>
    <script src="{{ URL::asset('/assets/libs/admin-resources/admin-resources.min.js') }}"></script>
    <script src="{{ URL::asset('assets/libs/dropzone/dropzone.min.js') }}"></script>
    <script>
       $(document).ready(function() {
            $('#shipping_type').on('change', function() {
                var selectedShippingType = $(this).val();
                if (selectedShippingType == 2) {
                    $('#shipping_amount').val(0).prop('readonly', true);
                } else {
                    $('#shipping_amount').val('').prop('readonly', false);
                }
            });
            $('#shipping_type').trigger('change');
        });

    </script>
@endsection
