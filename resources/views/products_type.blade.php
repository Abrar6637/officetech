@extends('layouts.master')
@section('title')
@lang('translation.Products Type')
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
Products Type !
@endslot
@endcomponent

<div class="row">
    <div class="col-lg-8">
        @if (session('success')&& now()->lt(session('success_expiry')))
        <div class="alert alert-success" role="alert">
            {{ session('success') }}
        </div>
        <script>
        // Add a script to hide the success message after 5 seconds
        setTimeout(function() {
            $('.alert-success').fadeOut('fast');
        }, 5000);
        </script>
        @endif
        <div class="card" style="overflow-x: auto;">
            <div class="card-header">
                <h5 class="card-title">Products Type</h5>
            </div>
            <div class="card-body">
                <table class="table">
                    <thead>
                        <tr>
                            <th scope="col">ID</th>
                            <th scope="col">Type</th>
                            <th scope="col">Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($products_type as $product_type )
                        <tr>
                            <th scope="row">{{$product_type->id}}</th>
                            <td>{{$product_type->product_type}}</td>
                            <td>
                                <a href="{{route('edit.products.type',$product_type->id)}}" class="text-success"><i
                                        class="mdi mdi-pencil font-size-18"></i></a>
                                <a href="{{route('delete.products.type',$product_type->id)}}" class="text-danger"><i
                                        class="mdi mdi-delete font-size-18"></i></a>
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
    <div class="col-lg-4">
        <div class="card">
            <div class="card-header">
                <h5 class="card-title">Create Products Type</h5>
            </div>
            <div class="card-body">
                <form action="{{ route('add.products.type') }}" method="post" id="">
                    @csrf
                    <div class="mb-3">
                        <label for="example-text-input" class="form-label">Products Type</label>
                        <input class="form-control" type="text" name="products_type" id="">
                    </div>
                    <div class="mt-4">
                        <button type="submit" class="btn btn-bg-color text-light w-md">Submit</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
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