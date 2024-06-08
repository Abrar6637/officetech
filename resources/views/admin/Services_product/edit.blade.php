@extends('layouts.master')
@section('title')
@section('title')
@lang('translation.Form_File_Upload')
@endsection
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
Service !
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

    #ckeditor-meta-title .ck ck-editor {
        max-height: 100px;
    }
</style>
@if ($errors->any())
<div class="alert alert-danger">
    <ul>
        @foreach ($errors->all() as $error)
        <li>{{ $error }}</li>
        @endforeach
    </ul>
</div>
@endif
<form action="{{ route('update.product.services') }}" method="post" enctype="multipart/form-data">
    @csrf
    <div class="row">
        <div class="col-lg-8">
            @if (session('success') && now()->lt(session('success_expiry')))
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
                    <h4 class="card-title">Edit Service</h4>
                </div>
                <div class="card-body p-4">
                    <div class="row">
                        <div class="col-lg-6">
                            <div>
                                <div class="mb-3">
                                    <label for="example-text-input" class="form-label">SKU</label>
                                    <input class="form-control @error('service_sku') is-invalid @enderror" type="text" value="{{ old('service_sku', $product_Service->service_sku) }}" name='service_sku' id="service_sku_input">
                                    <input type="hidden" value="{{ $id }}" name='id'>
                                    @error('service_sku')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>

                                <div class="mb-3">
                                    <label for="example-password-input" class="form-label">Title</label>
                                    <input class="form-control @error('title') is-invalid @enderror" type="text" value="{{ old('title', $product_Service->title) }}" name="title" id="title_input">
                                    @error('title')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>
                        </div>

                        <div class="col-lg-6">
                            <div class="mt-3 mt-lg-0">
                                <div class="mb-3">
                                    <label for="example-number-input" class="form-label">Prices</label>
                                    <input class="form-control @error('price') is-invalid @enderror" type="number" value="{{ old('price', $product_Service->price) }}" name="price" id="price_input">
                                    @error('price')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                                <div class="mb-3">
                                    <label for="example-number-input" class="form-label">Sale Prices</label>
                                    <input class="form-control @error('sale_price') is-invalid @enderror" type="number" value="{{ old('sale_price', $product_Service->sale_price) }}" name="sale_price" id="sale_price_input" placeholder="Optional">
                                    @error('sale_price')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="card">
                <div class="card-header">
                    <h4 class="card-title">Description</h4>
                </div>
                <div class="card-body">
                    <textarea name="description" id="ckeditor-description">{{ old('description', $product_Service->description) }}</textarea>
                </div>
            </div>
        </div>
        <div class="col-lg-4">
            <div class="card">
                <div class="card-header">
                    <h5 class="card-title">Select Service</h5>
                </div>
                <div class="card-body">
                    <div class="mb-3">
                        <label class="form-label">Service Status</label>
                        <select class="form-select" name="status">
                            <option value='1' @if ($product_Service->status == '1' || old('status') == '1' ) selected @endif>Active</option>
                            <option value='0' @if ($product_Service->status == '0' || old('status') == '0' ) selected @endif>Inactive</option>
                        </select>
                    </div>
                    <div class="mb-3">
                        <label for="example-text-input" class="form-label">Service</label>
                        <select class="form-select" name="service_id" id="service_id">
                            @foreach ($Services as $Service)
                            <option value="{{ $Service->id }}" @if (old('service_id', $product_Service->service_id) == $Service->id) selected @endif>
                                {{ $Service->name }}
                            </option>
                            @endforeach
                        </select>
                        @error('service_id')
                        <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                </div>
            </div>
            <div class="card">
                <div class="card-header">
                    <h4 class="card-title">Meta Title</h4>
                </div>
                <div class="card-body">
                    <textarea name="meta_title" id="ckeditor-meta-title">{{ old('meta_title', $product_Service->meta_title) }}</textarea>
                </div>
            </div>
            <div class="card">
                <div class="card-header">
                    <h4 class="card-title">Meta Description</h4>
                </div>
                <div class="card-body">
                    <textarea name="meta_description" id="ckeditor-meta-description">{{ old('meta_description', $product_Service->meta_description) }}</textarea>
                </div>
            </div>
            <div class="card">
                <div class="card-header">
                    <h4 class="card-title">Images</h4>
                </div>
                <div class="card-body">
                    <div class="upload__box">
                        <div class="upload__btn-box">
                            <label class="upload__btn">
                                <p style="margin-bottom: 0px;">Upload images</p>
                                <input type="file" name="image_url[]" multiple="multiple" class="upload__inputfile" accept="image/*">
                            </label>
                            <img src="{{ url('/assets/images/services/'. $product_Service->image_url)}}">
                        </div>
                        <div class="upload__img-wrap">
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="mb-3">
            <button type="submit" class="btn border-0 w-md btn-bg-color text-white">Submit</button>
        </div>
    </div>
</form>
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script>
    $(document).ready(function() {

        let inputCount = 1;
        $('.add-input').on('click', function(e) {
            e.preventDefault();
            inputCount++;
            const newInput =
                `<br><input class="form-control" type="text" name="product_code[]" id="product_code_input_${inputCount}">`;
            $('#input-container').append(newInput);
            $('.remove-input').show();
        });

        $('.remove-input').on('click', function(e) {
            e.preventDefault();
            if (inputCount > 1) {
                $(`#product_code_input_${inputCount}`).prev('br').remove();
                $(`#product_code_input_${inputCount}`).remove();
                inputCount--;
            }
            console.log(inputCount);
            if (inputCount == 1) {
                $('.remove-input').hide();
            }
        });

    });

    document.addEventListener("DOMContentLoaded", function() {
        ClassicEditor
            .create(document.querySelector('#ckeditor-description'))
            .catch(error => {
                console.error(error);
            });

        ClassicEditor
            .create(document.querySelector('#ckeditor-specifications'))
            .catch(error => {
                console.error(error);
            });

        ClassicEditor
            .create(document.querySelector('#ckeditor-meta-title'))
            .catch(error => {
                console.error(error);
            });

        ClassicEditor
            .create(document.querySelector('#ckeditor-meta-description'))
            .catch(error => {
                console.error(error);
            });
    });

    jQuery(document).ready(function() {
        ImgUpload();
    });

    function ImgUpload() {
        var imgWrap = "";
        var imgArray = [];

        $('.upload__inputfile').each(function() {
            $(this).on('change', function(e) {
                imgWrap = $(this).closest('.upload__box').find('.upload__img-wrap');
                var maxLength = $(this).attr('data-max_length');

                var files = e.target.files;
                var filesArr = Array.prototype.slice.call(files);
                var iterator = 0;
                filesArr.forEach(function(f, index) {

                    if (!f.type.match('image.*')) {
                        return;
                    }

                    if (imgArray.length > maxLength) {
                        return false
                    } else {
                        var len = 0;
                        for (var i = 0; i < imgArray.length; i++) {
                            if (imgArray[i] !== undefined) {
                                len++;
                            }
                        }
                        if (len > maxLength) {
                            return false;
                        } else {
                            imgArray.push(f);

                            var reader = new FileReader();
                            reader.onload = function(e) {
                                var html =
                                    "<div class='upload__img-box'><div style='background-image: url(" +
                                    e.target.result + ")' data-number='" + $(
                                        ".upload__img-close").length + "' data-file='" + f
                                    .name +
                                    "' class='img-bg'><div class='upload__img-close'></div></div></div>";
                                imgWrap.append(html);
                                iterator++;
                            }
                            reader.readAsDataURL(f);
                        }
                    }
                });
            });
        });

        $('body').on('click', ".upload__img-close", function(e) {
            var file = $(this).parent().data("file");
            for (var i = 0; i < imgArray.length; i++) {
                if (imgArray[i].name === file) {
                    imgArray.splice(i, 1);
                    break;
                }
            }
            $(this).parent().parent().remove();
        });
    }
</script>
@endsection
@section('script')
<script>
    document.addEventListener('DOMContentLoaded', function() {
        var featuredCheckbox = document.getElementById('featured-customCheck');
        var recommendedCheckbox = document.getElementById('recomended-customCheck');

        var isFeaturedInput = document.getElementById('isFeaturedInput');
        var isRecommendedInput = document.getElementById('isRecommendedInput');

        featuredCheckbox.addEventListener('change', function() {
            isFeaturedInput.value = featuredCheckbox.checked ? 1 : 0;
        });

        recommendedCheckbox.addEventListener('change', function() {
            isRecommendedInput.value = recommendedCheckbox.checked ? 1 : 0;
        });
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