@extends('layouts.master')
@section('title')
    @lang('Regions')
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
            Regions !
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
        <div class="col-lg-8">
            <div class="card" style="overflow-x: auto;">
                <div class="container mt-3">
                    @if (session('success'))
                        <div class="alert alert-success text-center alert-dismissible fade show">
                            <div class="fs-5">
                                {{ session('success') }}
                            </div>
                        </div>
                    @endif
                </div>
                <div class="card-header">
                    <h5 class="card-title">Regions</h5>
                </div>
                <div class="card-body">
                    <table class="table">
                        <thead>
                            <tr>
                                <th>ID</th>
                                <th scope="col">Region Name</th>
                                <th scope="col">Shipping Amount</th>
                                <th scope="col">Shipping Type</th>
                                <th scope="col">Delivery Days</th>
                                <th scope="col">Status</th>
                                <th scope="col">Actions</th>
                            </tr>
                        </thead>
                        <tbody>
                            @if ($regions->count() > 0)                                
                                @foreach ($regions as $region)
                                    <tr>  
                                        <td style="width: 50px;">{{$loop->index + 1}}</td>
                                        <td>{{$region->name}}</td>
                                        @if ($region->shipping_type == 1)
                                        <td  class="text-center">{{$region->amount}} %</td>
                                        @else
                                            <td  class="text-center">{{$region->amount}} SAR</td>
                                        @endif
                                        @if ($region->shipping_type == 0)
                                            <td>Fixed Amount</td>
                                        @elseif ($region->shipping_type == 1)
                                            <td>Percentage</td>
                                        @elseif ($region->shipping_type == 2)
                                            <td>Free Shipping</td>
                                        @endif
                                        <td class="text-center">{{$region->delivery_days}} Days</td>
                                        @if ($region->status == 0)
                                            <td class="text-warning">Inactive</td>
                                            @else
                                            <td class="text-success">Active</td>
                                        @endif
                                        <td>
                                            <a href="{{route('edit.region',$region->id)}}" class="text-success">
                                                <i class="mdi mdi-pencil font-size-18"></i>
                                            </a>
                                            <a href="{{route('delete.region',$region->id)}}" class="text-danger" onclick="return confirm('Are you sure you want to delete this main category?')"><i class="mdi mdi-delete font-size-18"></i></a>
                                        </td>
                                    </tr>
                                @endforeach
                                @else
                                <tr>
                                    <td colspan="6" class="text-center fw-bold fs-5">No Regions</td>
                                </tr>
                            @endif
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
        <div class="col-lg-4">
            <div class="card">
                <div class="card-header">
                    <h5 class="card-title">Create Regions</h5>
                </div>
                <div class="card-body">
                    <form action="{{route('add.region')}}" method="post">
                        @csrf
                        <div class="mb-3">
                            <label for="example-text-input" class="form-label">Region Name</label>
                            <input class="form-control" type="text" name="name" id="" placeholder="Region Name" value="{{old('name')}}">
                        </div>
                        @error('name')
                            <p class="alert alert-danger">{{$message}}</p>
                        @enderror
                        <div class="mb-3">
                            <label class="form-label">Shipping Type</label>
                            <select class="form-select" name="shipping_type"  id="shipping_type">
                                <option value="" selected disabled>Select Shipping Type</option>
                                <option value="0">Fixed Amount</option>
                                <option value="1">Percentage</option>
                                <option value="2">Free Shipping</option>
                            </select>
                        </div>
                        @error('shipping_type')
                            <p class="alert alert-danger">{{$message}}</p>
                        @enderror
                        <div class="mb-3">
                            <label class="form-label">Shipping Amount</label>
                            <input class="form-control" type="number" placeholder="Shipping Amount" name="amount" value="{{old('amount')}}" id="shipping_amount">
                        </div>
                        @error('amount')
                            <p class="alert alert-danger">{{$message}}</p>
                        @enderror
                        <div class="mb-3">
                            <label class="form-label">Delivery Days</label>
                            <input class="form-control" type="number" placeholder="Delivery Days" name="delivery_days" value="{{old('delivery_days')}}">
                        </div>
                        @error('delivery_days')
                            <p class="alert alert-danger">{{$message}}</p>
                        @enderror
                        <div class="mb-3">
                            <label class="form-label">Status</label>
                            <select class="form-select" name="status">
                                <option value="0">Inactive</option>
                                <option value="1">Active</option>
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
                if (selectedShippingType == 2) { // Free Shipping
                    $('#shipping_amount').val(0).prop('readonly', true);
                } else {
                    $('#shipping_amount').val('').prop('readonly', false);
                }
            });
        });
    </script>

@endsection
