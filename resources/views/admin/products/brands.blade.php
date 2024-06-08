@extends('layouts.master')
@section('title')
@section('title') @lang('translation.Form_File_Upload') @endsection
@lang('translation.Categories')
@endsection
@section('css')
<link href="{{ URL::asset('/assets/libs/admin-resources/admin-resources.min.css') }}" rel="stylesheet">
<link href="{{ URL::asset('assets/libs/dropzone/dropzone.min.css') }}" rel="stylesheet">
@endsection
@section('content')
@component('components.breadcrumb')
@slot('li_1')
Dashboard
@endslot
@slot('title')
Brands !
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
        @if (session('success'))
        <div class="alert alert-success">
            {{ session('success') }}
        </div>
        <script>
        setTimeout(function() {
            $('.alert-success').fadeOut('fast');
        }, 5000);
        </script>
        @endif
        <div class="card" style="overflow-x: auto;">
            <div class="card-header">
                <h5 class="card-title">Brands List</h5>
            </div>
            <div class="card-body">
                <table class="table align-middle table-nowrap table-check">
                    <thead>
                        <tr>
                            <th>ID</th>
                            <th scope="col">Product Type ID</th>
                            <th scope="col">Brand</th>
                            <th scope="col">Image</th>
                            <th scope="col">Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($brands as $brand)
                        <tr>
                            <td>{{$brand->id}}</td>
                            <td>
                                @foreach ($products_type as $product_type)
                                @if ($product_type->id==$brand->product_type_id)
                                {{ $product_type->product_type }}
                                @endif
                                @endforeach
                            </td>
                            <td>{{$brand->brand_name}}</td>
                            @if ($brand->image && Storage::disk('public_images')->exists($brand->image))
                                <td>
                                    <img src="{{ asset('images/' . $brand->image) }}" alt="Brand Image" style="height: 30px; width:100px;">
                                </td>
                                @else
                                <td>
                                    No Image
                                </td>
                            @endif
                            <td>
                                <a href="{{route('edit.product.brands',$brand->id)}}" class="text-success"><i
                                        class="mdi mdi-pencil font-size-18"></i></a>
                                <a href="{{route('delete.product.brands',$brand->id)}}" class="text-danger"
                                    onclick="return confirm('Are you sure you want to delete this brand?')"><i
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
                <h5 class="card-title">Add Brands</h5>
            </div>
            <div class="card-body">
                <form action="{{route('add.product.brand')}}" method="post" enctype="multipart/form-data">
                    @csrf
                    <div class="mb-3">
                        <label class="form-label">Select Product Type</label>
                        <select class="form-select" name="product_type_id">
                            @foreach ($products_type as $product_type)
                            <option value="{{$product_type->id}}">{{$product_type->product_type}}</option>
                            @endforeach
                        </select>
                    </div>
                    @error('product_type_id')
                        <span class="text-danger">{{ $message }}</span>
                    @enderror
                    <div class="mb-3">
                        <label for="example-text-input" class="form-label">Brand Name</label>
                        <input class="form-control" type="text" id="example-text-input" name="brand_name" value="{{ old('brand_name') }}">
                    </div>
                    @error('brand_name')
                        <span class="text-danger">{{ $message }}</span>
                    @enderror
                    <div class="mb-3">
                        <label for="example-text-input" class="form-label">Brand Image</label>
                        <input class="form-control" type="file" id="example-text-input" name="brand_image" accept="image/*">
                    </div>
                    @error('brand_image')
                        <span class="text-danger">{{ $message }}</span>
                    @enderror
                    <div class="mb-3">
                        <button type="submit" class="btn btn-primary w-md btn-bg-color border-0">Submit</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>


<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
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
@endsection