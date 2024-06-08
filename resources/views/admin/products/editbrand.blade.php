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
Products !
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
                <h5 class="card-title">Edit Brand</h5>
            </div>
            <div class="card-body">
                <form method="post" action="{{route('update.product.brand',$brands->id)}}" enctype="multipart/form-data">
                    @csrf
                    @method('PUT')
                    <div class="mb-3">
                        <label class="form-label">Select Product Type</label>
                        <select class="form-select" name="product_type">
                            @foreach ($products_type as $type)
                                <option value="{{$type->id}}" @if($type->id==$brands->product_type_id) selected @endif>{{$type->product_type}}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="mb-3">
                        <label for="mainCategory-input" class="form-label">Edit Brand Name</label>
                        <input class="form-control" type="text" name="brand_name"
                            value="{{ $brands->brand_name }}">
                    </div>
                    <div class="mb-3">
                        <label for="example-text-input" class="form-label">Update Brand Image</label>
                        <input class="form-control" type="file" id="brand_image" name="brand_image" accept="image/*">
                    </div>
                    <div class="mb-3">
                        @if ($brands->image && Storage::disk('public_images')->exists($brands->image))
                            <img src="{{ asset('images/' . $brands->image) }}" id="brandImagePreview" alt="Brand Image" style="height: 100px; width:150px">
                        @else
                            <img src="{{ asset('path-to-default-image.jpg') }}" alt="No Image">
                        @endif
                    </div>
                    <input type="hidden" name="old_image" value="{{ $brands->image }}">       
                    <div class="mt-4">
                        <button type="submit" class="btn btn-primary w-md btn-bg-color">Update</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
@endsection
@section('script')
<script>
    $(document).ready(function () {
        $('#brand_image').change(function () {
            previewImage(this);
        });

        function previewImage(input) {
            var preview = $('#brandImagePreview');
            var file = input.files[0];
            var reader = new FileReader();

            reader.onload = function (e) {
                preview.attr('src', e.target.result);
            };

            if (file) {
                reader.readAsDataURL(file);
            }
        }
    });
</script>
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