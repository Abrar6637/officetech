@extends('layouts.master')
@section('title')
    @lang('translation.Dashboards')
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
    <!-- Main Category Form -->
    <div class="container">
        <form action="{{ route('update.products.type', $products_type->id) }}" method="post">
            @csrf
            <div class="mb-3">
                <label for="mainCategory-input" class="form-label">Edit Products Type</label>
                <input class="form-control" type="text" name="products_type"
                    value="{{ $products_type->product_type }}">
            </div>
            <div class="mt-4">
                <button type="submit" class="btn btn-primary w-md">Update Product Type</button>
            </div>
        </form>
    </div>
@endsection
@section('script')
    <!-- apexcharts -->
    <script src="{{ URL::asset('/assets/libs/apexcharts/apexcharts.min.js') }}"></script>
    <script src="{{ URL::asset('/assets/libs/admin-resources/admin-resources.min.js') }}"></script>

    <!-- dashboard init -->
    <script src="{{ URL::asset('/assets/js/pages/dashboard.init.js') }}"></script>
    <script src="{{ URL::asset('/assets/js/app.min.js') }}"></script>
@endsection
