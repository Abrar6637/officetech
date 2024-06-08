@extends('layouts.master')
@section('title')
@lang('Slider')
@endsection
@section('css')
<link href="{{ URL::asset('/assets/libs/admin-resources/admin-resources.min.css') }}" rel="stylesheet">
<link rel="stylesheet" href="https://cdn.datatables.net/1.13.7/css/jquery.dataTables.css" />
<style>
 .current
    {
        background: #f4f5f8 !important;
        border: none !important;
    }
    .dataTables_wrapper .dataTables_paginate .paginate_button:hover 
    {
        background: transparent !important;
        color: #da5858 !important;
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
Slider !
@endslot
@endcomponent
<div class="row">
    <div class="col-lg-12">
        @if (session('success')&& now()->lt(session('success_expiry')))
        <div class="alert alert-success" role="alert">
            {{ session('success') }}
        </div>
        <script>
        setTimeout(function() {
            $('.alert-success').fadeOut('fast');
        }, 5000);
        </script>
        @endif
        <div class="card">
            <div class="card-header">
                <h5 class="card-title">Slider</h5>
                <a href="{{route('add.slider')}}" class="btn btn-bg-color text-white">Add Slider</a>
            </div>
            <div class="card-body table-responsive">
                <table class="table " id="Products-Table">
                    <thead>
                        <tr>
                            <th>ID</th>
                            <th>Description</th>
                            <th>Product Name</th>
                            <th>Product Sku</th>
                            <th>Product Image</th>
                            <th>Status</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($sliders as $slider)
                            <tr>
                                <td>{{$loop->index + 1}}</td>
                                <td>{!! $slider->description !!}</td>
                                <td>{{$slider->product_slug}}</td>
                                <td>{{$slider->sku}}</td>
                                <td><img src="{{ asset('images/SliderImages/' . $slider->image) }}" alt="no-image" style="height:100px; width:100px;"></td>
                                @if ($slider->status == '1')
                                <td class="text-success">Active</td>
                                @else
                                <td class="text-danger">Inactive</td>
                                @endif
                                <td>
                                    <a href="{{route('edit.slider',$slider->id)}}" class="text-success"><i class="mdi mdi-pencil font-size-18"></i></a>
                                    <a href="{{route('delete.slider',$slider->id)}}" onclick="return confirm('Are you sure you want to delete this.');" class="text-danger"><i class="mdi mdi-delete font-size-18"></i></a>
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
<script src="https://code.jquery.com/jquery-3.6.4.min.js"></script>
<script src="https://cdn.datatables.net/1.13.7/js/jquery.dataTables.js"></script>
<!-- dashboard init -->
<script src="{{ URL::asset('/assets/js/pages/dashboard.init.js') }}"></script>
<script src="{{ URL::asset('/assets/js/app.min.js') }}"></script>
@endsection