@extends('layouts.master')
@section('title')
    @lang('Slider')
@endsection
@section('css')
    <link href="{{ URL::asset('/assets/libs/admin-resources/admin-resources.min.css') }}" rel="stylesheet">
@endsection
@section('content')
    @component('components.breadcrumb')
        @slot('li_1')
            Dashboard
        @endslot
        @slot('title')
            Welcome !
        @endslot
    @endcomponent
<style>
    .card-body{
        background-color: #CAF0F8;
    }
    .text-muted{
        color: #03045E !important;
    }
</style>
    <div class="row">
        <div class="col-xl-3 col-md-6">
            <!-- card -->
            <div class="card card-h-100">
                <!-- card body -->
                <div class="card-body">
                    <div class="d-flex align-items-center justify-content-between">
                        <a href="{{ route('show.main.categories') }}">
                            <div class="flex-grow-1">
                                <span class="text-muted mb-3 lh-1 d-block text-truncate fw-bolder"
                                    style="font-size:15px">Total Categories</span>
                                <h4 class="mb-3">
                                    <span class="counter-value" data-target="{{ $categories->count() }}">0</span>
                                </h4>
                                {{-- <div class="text-nowrap">
                                <span class="badge bg-soft-success text-success">+$20.9k</span>
                                <span class="ms-1 text-muted font-size-13">Since last week</span>
                            </div> --}}
                            </div>
                        </a>
                        <div class="flex-shrink-0 text-end dash-widget">
                            <img src="{{ url('assets/images/category.svg') }}" width="20px" alt="">
                        </div>
                    </div>
                </div><!-- end card body -->
            </div><!-- end card -->
        </div><!-- end col -->

        <div class="col-xl-3 col-md-6">
            <!-- card -->
            <div class="card card-h-100">
                <!-- card body -->
                <div class="card-body">
                    <div class="d-flex align-items-center justify-content-between">
                        <a href="{{ route('products') }}">
                            <div class="flex-grow-1">
                                <span class="text-muted mb-3 lh-1 d-block text-truncate fw-bolder"
                                    style="font-size:15px">Total Products</span>
                                <h4 class="mb-3">
                                    <span class="counter-value" data-target="{{ $products->count() }}">0</span>
                                </h4>
                                {{-- <div class="text-nowrap">
                                <span class="badge bg-soft-danger text-danger">-29 Trades</span>
                                <span class="ms-1 text-muted font-size-13">Since last week</span>
                            </div> --}}
                            </div>
                        </a>
                        <div class="flex-shrink-0 text-end dash-widget">
                            <img src="{{ url('assets/images/product.svg') }}" width="20px" alt="">
                        </div>
                    </div>
                </div><!-- end card body -->
            </div><!-- end card -->
        </div><!-- end col-->

        <div class="col-xl-3 col-md-6">
            <!-- card -->
            <div class="card card-h-100">
                <!-- card body -->
                <div class="card-body">
                    <div class="d-flex align-items-center justify-content-between">
                        <a href="{{ route('admin.orders') }}">
                            <div class="flex-grow-1">
                                <span class="text-muted mb-3 lh-1 d-block text-truncate fw-bolder"
                                    style="font-size:15px">Total Orders</span>
                                <h4 class="mb-3">
                                    <span class="counter-value" data-target="{{ $orders->count() }}">0</span>
                                </h4>
                                {{-- <div class="text-nowrap">
                                <span class="badge bg-soft-success text-success">+ $2.8k</span>
                                <span class="ms-1 text-muted font-size-13">Since last week</span>
                            </div> --}}
                            </div>
                        </a>
                        <div class="flex-shrink-0 text-end dash-widget">
                            <img src="{{ url('assets/images/orders.svg') }}" width="20px" alt="">
                        </div>
                    </div>
                </div><!-- end card body -->
            </div><!-- end card -->
        </div><!-- end col -->

        <div class="col-xl-3 col-md-6">
            <!-- card -->
            <div class="card card-h-100">
                <!-- card body -->
                <div class="card-body">
                    <div class="d-flex align-items-center">
                        <a href="{{route('admin.users')}}">
                            <div class="flex-grow-1">
                                <span class="text-muted mb-3 lh-1 d-block text-truncate fw-bolder" style="font-size:15px">Total
                                    Users</span>
                                <h4 class="mb-3">
                                    <span class="counter-value" data-target="{{ $users->count() }}">0</span>
                                </h4>
                                {{-- <div class="text-nowrap">
                                <span class="badge bg-soft-success text-success">+5.32%</span>
                                <span class="ms-1 text-muted font-size-13">Since last week</span>
                                </div> --}}
                            </div>
                        </a>
                        <div class="flex-shrink-0 text-end dash-widget">
                            <img src="{{ url('assets/images/users.svg') }}" width="20px" alt="">
                        </div>
                    </div>
                </div><!-- end card body -->
            </div><!-- end card -->
        </div><!-- end col -->
    </div><!-- end row-->
@endsection
@section('script')
    <!-- apexcharts -->
    <script src="{{ URL::asset('/assets/libs/apexcharts/apexcharts.min.js') }}"></script>
    <script src="{{ URL::asset('/assets/libs/admin-resources/admin-resources.min.js') }}"></script>

    <!-- dashboard init -->
    <script src="{{ URL::asset('/assets/js/pages/dashboard.init.js') }}"></script>
    <script src="{{ URL::asset('/assets/js/app.min.js') }}"></script>
@endsection
