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
    .upload__img-box {
    position: relative;
}

.img-bg {
    position: relative;
    display: flex;
    align-items: center;
    justify-content: center;
}

.delete-btn {
    position: absolute;
    top: 50%;
    left: 50%;
    transform: translate(-50%, -50%);
    background: none;
    border: none;
    color: red;
    cursor: pointer;
    z-index: 1;
    opacity: 0; 
    font-size: 24px;
    transition: opacity 0.3s ease;
}

.img-bg:hover .delete-btn {
    opacity: 1;
}
.swal2-icon.swal2-warning{
    color: rgb(3, 4, 94) !important;
}
.swal2-icon.swal2-warning{
    border-color: rgb(3, 4, 94) !important;
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
@if ($errors->has('galleryimages.*'))
<div class="alert alert-danger">
    <ul>
        @foreach ($errors->get('galleryimages.*') as $error)
        <li>{{ $error[0] }}</li>
        @endforeach
    </ul>
</div>
@endif
<form action="{{ route('update.products', $products->id) }}" method="post" enctype="multipart/form-data">
    @csrf
    <div class="row">
        <div class="col-lg-8">
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
                    <h4 class="card-title">Edit Products</h4>
                </div>
                <div class="card-body p-4">
                    <div class="row">
                        <div class="col-lg-6">
                            <div>
                                <div class="mb-3">
                                    <label for="example-text-input" class="form-label">SKU</label>
                                    <input class="form-control @error('sku') is-invalid @enderror" type="text" value="{{ old('sku', $products->sku) }}" name="sku" id="sku_input">
                                    @error('sku')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                                <div class="mb-3">
                                    <label for="example-tel-input" class="form-label">Model Number</label>
                                    <input class="form-control @error('model_number') is-invalid @enderror" type="tel" value="{{ old('model_number', $products->model_number) }}" name="model_number" id="model_number_input">
                                    @error('model_number')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                                <div class="mb-3">
                                    <label for="example-password-input" class="form-label">Name</label>
                                    <input class="form-control @error('name') is-invalid @enderror" type="text" value="{{ old('name', $products->name) }}" name="name" id="name_input">
                                    @error('name')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                                <div class="mb-3">
                                    <label for="example-number-input" class="form-label">Sale Price</label>
                                    <input class="form-control @error('sale_price') is-invalid @enderror" type="number" value="{{ old('sale_price', $products->sale_price) }}" name="sale_price" id="sale_price_input" placeholder="Optional">
                                    @error('sale_price')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-6">
                            <div class="mt-3 mt-lg-0">
                                <div class="mb-3">
                                    <label for="example-number-input" class="form-label">Quantity</label>
                                    <input class="form-control @error('quantity') is-invalid @enderror" type="number" value="{{ old('quantity', $products->quantity) }}" name="quantity" id="quantity_input">
                                    @error('quantity')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                                <div class="mb-3">
                                    <label for="example-number-input" class="form-label">Minimum Quantity</label>
                                    <input class="form-control @error('min_quantity') is-invalid @enderror" type="number" value="{{ old('min_quantity', $products->min_qty) }}" name="min_quantity" id="quantity_input">
                                    @error('quantity')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                                <div class="mb-3">
                                    <label for="example-number-input" class="form-label">Price</label>
                                    <input class="form-control @error('price') is-invalid @enderror" type="number" value="{{ old('price', $products->price) }}" name="price" id="price_input">
                                    @error('price')
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
                    <h4 class="card-title">Product Attributes</h4>
                </div>
                <div class="card-body p-4">
                    <div class="row">
                        <div class="col-lg-6">
                            <div>
                                <div class="mb-3" id="functional_show">
                                    <label for="example-text-input" class="form-label">Functional</label>
                                    <input class="form-control" type="text" value="{{ old('functional', $products->product_attribute[0]->functional) }}" name='functional' id="functional_input">
                                </div>
                                <div class="mb-3" id="compatible_model_show" style="display:none">
                                    <label for="example-number-input" class="form-label">Compatible Model</label>
                                    <input class="form-control" type="text" value="{{ old('compatible_toners', $products->product_attribute[0]->compatible_toners) }}" name="compatible_toners" id="compatible_model_input">
                                </div>
                                <div class="mb-3" id="type_show">
                                    <label for "example-text-input" class="form-label">Type</label>
                                    <input class="form-control" type="text" value="{{ old('type', $products->product_attribute[0]->type) }}" name='type' id="type_input">
                                </div>
                                <div class="mb-3" id="product_code_show">
                                    <div id="input-container" class="product_codes_w">
                                        <label for="example-password-input" class="form-label">Product Codes</label>
                                        @if(isset($products->product_item_code))
                                        @foreach($products->product_item_code as $productCode)
                                        <input class="form-control" type="text" name="product_code[]" id="product_code_input" value="{{ $productCode->product_code }}">@if(!$loop->last) <br> @endif
                                        @endforeach
                                        @endif
                                    </div>
                                    <div class="pt-32">
                                        <button class="add-input btn-styling">+</button>
                                        <button class="remove-input btn-styling" style="display:none; margin-top: 36px;">-</button>
                                    </div>
                                </div>
                                <div class="mb-3" id="warrenty_show">
                                    <label for="example-number-input" class="form-label">Warrenty</label>
                                    <input class="form-control" type="text" value="{{ old('warrenty', $products->warrenty) }}" name="warrenty" id="warrenty_input">
                                </div>
                                <div class="mb-3" id="license_show" style="display:none;">
                                    <label for="example-number-input" class="form-label">License</label>
                                    <input class="form-control" type="text" value="{{ old('license', $products->license) }}" name="license" id="license_input">
                                </div>
                                <!-- <div class="form-group">
                                    <div class="row">
                                        <div class="col-md-6 col-lg-6">
                                            <div class="form-check">
                                                <input type="checkbox" class="form-check-input" id="featured-customCheck" name="product_fetaured" @if($products->featured_product==='1') checked @endif>
                                                <label class="form-check-label" for="featured-customCheck">Is Featured</label>
                                                <input type="hidden" id="isFeaturedInput" name="is_featured" value="@if($products->featured_product === '1') 1 @else 0 @endif">
                                            </div>
                                        </div>
                                        <div class="col-md-6 col-lg-6 col-sm-12">
                                            <div class="form-check">
                                                <input type="checkbox" class="form-check-input" id="recomended-customCheck" name="product_recomended" @if($products->recommended==='1') checked @endif>
                                                <label class="form-check-label" for="recomended-customCheck">Recomended</label>
                                                <input type="hidden" id="isRecommendedInput" name="is_recommended" value="@if($products->recommended === '1') 1 @else 0 @endif">
                                            </div>
                                        </div>
                                    </div>
                                </div> -->
                            </div>
                        </div>

                        <div class="col-lg-6">
                            <div class="mt-3 mt-lg-0">
                                <div class="mb-3" id="compatible_toners_show">
                                    <label for="example-number-input" class="form-label">Compatible Toners</label>
                                    <input class="form-control" type="text" value="{{ old('compatible_toners', $products->product_attribute[0]->compatible_toners) }}" name="compatible_toners" id="compatible_toners_input">
                                </div>
                                <div class="mb-3" id="speed_show">
                                    <label for="example-tel-input" class="form-label">Speed</label>
                                    <input class="form-control" type="text" value="{{ old('speed', $products->product_attribute[0]->speed) }}"
                                        name="speed" id="speed_input">
                                </div>
                                <div class="mb-3" id="paper_size_show">
                                    <label for="example-tel-input" class="form-label">Paper Size</label>
                                    <select class="form-select" name="paper_size">
                                        <option value="" {{old('paper_size', $products->product_attribute[0]->paper_size) == '' ? 'selected' : ''}} disabled>Please Select Paper Size</option>
                                        <option value="A1" {{old('paper_size', $products->product_attribute[0]->paper_size) == 'A1' ? 'selected' : ''}}>A1</option>
                                        <option value="A2" {{old('paper_size', $products->product_attribute[0]->paper_size) == 'A2' ? 'selected' : ''}}>A2</option>
                                        <option value="A3" {{old('paper_size', $products->product_attribute[0]->paper_size) == 'A3' ? 'selected' : ''}}>A3</option>
                                        <option value="A4" {{old('paper_size', $products->product_attribute[0]->paper_size) == 'A4' ? 'selected' : ''}}>A4</option>
                                        <option value="A5" {{old('paper_size', $products->product_attribute[0]->paper_size) == 'A5' ? 'selected' : ''}}>A5</option>
                                    </select>
                                </div>
                                <div class="mb-3" id="bundles_show" style="display: none;">
                                    <label for="example-number-input" class="form-label">Bundles</label>
                                    <input class="form-control" type="text" value="{{ old('bundles', $products->product_attribute[0]->bundles) }}" name="bundles" id="bundles_input">
                                </div>
                                <div class="mb-3" id="yeild_show" style="display: none;">
                                    <label for="example-number-input" class="form-label">Yeild</label>
                                    <input class="form-control" type="text" value="{{ old('yeild', $products->product_attribute[0]->yeild) }}" name="yeild" id="yeild_input">
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
                    <textarea name="product_description" id="ckeditor-description">
                    {{ old('product_description', $products->product_description) }}
                    </textarea>
                </div>
            </div>

            <div class="card">
                <div class="card-header">
                    <h4 class="card-title">Specifications</h4>
                </div>
                <div class="card-body">
                    <textarea name="specifications" id="ckeditor-specifications">
                    {{ old('specifications', $products->specifications) }}
                    </textarea>
                </div>
            </div>
{{-- @dd($products) --}}
        </div>
        <div class="col-lg-4">
            <div class="card">
                <div class="card-header">
                    <h5 class="card-title">Select Product</h5>
                </div>
                <div class="card-body">
                    <div class="mb-3">
                        <label class="form-label">Product Type</label>
                        <select disabled class="form-select" name="product_type_id" id="productType">
                            @foreach ($ProductTypes as $ProductType)
                            <option value="{{ $ProductType->id }}" {{ old('product_type_id', $products->product_type_id) == $ProductType->id ? 'selected' : '' }}>
                                {{ $ProductType->product_type }}
                            </option>
                            @endforeach
                        </select>
                    </div>
                    <div class="mb-3">
                        <label class="form-label">Product Status</label>
                        <select class="form-select" name="status">
                            <option value="1" {{ old('status', $products->status) == 1 ? 'selected' : '' }}>Active</option>
                            <option value="0" {{ old('status', $products->status) == 0 ? 'selected' : '' }}>In Active</option>
                        </select>
                    </div>
                    <div class="mb-3">
                        <label for="exampleDataList" class="form-label">Availability</label>
                        <select class="form-select" name="availability">
                            <option value="in-stock" {{ old('availability', $products->availability) == 'in-stock' ? 'selected' : '' }}>In Stock</option>
                            <option value="out-of-stock" {{ old('availability', $products->availability) == 'out-of-stock' ? 'selected' : '' }}>Out of Stock</option>
                            <option value="pre-order" {{ old('availability', $products->availability) == 'pre-order' ? 'selected' : '' }}>Pre-Order</option>
                            <option value="limited-stock" {{ old('availability', $products->availability) == 'limited-stock' ? 'selected' : '' }}>Limited Stock</option>
                            <option value="coming-soon" {{ old('availability', $products->availability) == 'coming-soon' ? 'selected' : '' }}>Coming Soon</option>
                        </select>
                    </div>
                    <div class="mb-3">
                        <label for="example-text-input" class="form-label">Brand</label>
                        <select class="form-select" name="brand_id" id="brand_id">
                            @foreach ($brand as $brands)
                            <option value="{{$brands->id}}" @if(old('brand_id', $products->brand_id) == $brands->id) selected @endif>{{$brands->brand_name}}</option>
                            @endforeach
                        </select>
                        @error('brand')
                        <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                </div>
            </div>
            <div class="card mt-4">
                <div class="card-header">
                    <h5 class="card-title">Create Sub Category</h5>
                </div>
                <div class="card-body">
                    <div class="mb-3">
                        <label class="form-label">Category</label>
                        <select class="form-select" name="category" id="category">
                            <option value="0">Select Category</option>
                            @foreach ($main_categories as $category)
                            <option value="{{ $category->id }}" @if($products->categories_id == $category->id) selected @endif>{{ $category->category_name }}</option>
                            @endforeach
                        </select>
                    </div>
                    <label class="form-label" id="subcategories">Sub Category</label>
                    <div id="subcategory-container" class="mb-3">
                        <select class="form-select" name="sub_category" id="subcategory">
                            <option value="0">Select Category</option>
                            @foreach ($subCategories as $category)
                            <option value="{{ $category->id }}" @if($products->sub_categories_id == $category->id) selected @endif>{{ $category->sub_category_name }}</option>
                            @endforeach
                        </select>
                    </div>
                    <label class="form-label" id="subsubcategories" style="display:none">Sub of SubCategory</label>
                    <div id="subsubcategory-container" class="mb-3"></div>
                </div>
            </div>
            <div class="card">
                <div class="card-header">
                    <h4 class="card-title">Meta Title</h4>
                </div>
                <div class="card-body">
                    <textarea name="product_meta_title" id="ckeditor-meta-title">
                    {{ old('product_meta_title', $products->meta_title) }}
                    </textarea>
                </div>
            </div>
            <div class="card">
                <div class="card-header">
                    <h4 class="card-title">Meta Description</h4>
                </div>
                <div class="card-body">
                    <textarea name="product_meta_description" id="ckeditor-meta-description">
                    {{ old('product_meta_description', $products->meta_description) }}
                    </textarea>
                </div>
            </div>
            <div class="card">
                <div class="card-header">
                    <h4 class="card-title">Images</h4>
                    <p class="card-title-desc">Gallery Images</p>
                </div>
                <div class="card-body">
                    <div class="upload__box">
                        <div class="upload__btn-box">
                            <label class="upload__btn">
                                <p style="margin-bottom:0px;">Upload images</p>
                                <input type="file" multiple="multiple" data-max_length="20" name="galleryimages[]" class="upload__inputfile">
                            </label>
                        </div>
                        <div class="upload__img-wrap">
                            @if(count($products->gallery_images) > 0)
                                @foreach($products->gallery_images as $image)
                                <div class="upload__img-box">
                                    <div class="img-bg">
                                        <img id="image-{{ $image->id }}" src="{{ asset('images/product_images/'.$image->images) }}" style="width: 100%;">
                                        <button class="delete-btn" type="button" data-image-id="{{ $image->id }}"><i class="fas fa-trash-alt"></i></button>
                                    </div>
                                </div>
                                @endforeach
                            @endif
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="mb-3">
            <button type="submit" class="btn btn-bg-color border-0 w-md text-light">Submit</button>
        </div>
    </div>
</form>
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@10"></script>
<script>
    $(document).ready(function() {
        let inputCount = 1;
        $('.add-input').on('click', function(e) {
            e.preventDefault();
            inputCount++;
            const newInput = `<br><input class="form-control" type="text" name="product_code[]" id="product_code_input_${inputCount}">`;
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
        $('#category').change(function() {
            var categoryId = $(this).val();
            $.get('/getSubCategories/' + categoryId, function(data) {
                $('#subcategories').show();
                var subcategorySelect = $('<select class="form-select" name="sub_category" id="subcategory">').html(data.options);
                $('#subcategory-container').empty().append(subcategorySelect);
            });
        });
        $('#subcategory-container').on('change', '#subcategory', function() {
            var subcategory = $(this).val();
            $.get('/getSubSubCategories/' + subcategory, function(data) {
                $('#subsubcategories').show();
                var subsubcategorySelect = $('<select class="form-select" name="sub_sub_category" id="subsubcategory">').html(data.options);
                $('#subsubcategory-container').empty().append(subsubcategorySelect);
            });
        });
        var selectedText = "{{ $products->product_type_id }}";
        if (selectedText == '1') {
            $('#paper_size_show').show();
            $('#bundles_show').hide();
            $('#license_show').hide();
            $('#warrenty_show').show();
            $('#compatible_model_show').hide();
            $('#compatible_toners_show').show();
            $('#type_show').show();
            $('#product_code_show').show();
            $('#speed_show').show();
            $('#functional_show').show();
            $('#yeild_show').hide();
        } else if (selectedText == '2') {
            $('#paper_size_show').show();
            $('#bundles_show').show();
            $('#license_show').hide();
            $('#warrenty_show').show();
            $('#compatible_model_show').hide();
            $('#compatible_toners_show').show();
            $('#bundles_show').show();
            $('#type_show').show();
            $('#product_code_show').show();
            $('#speed_show').show();
            $('#functional_show').show();
            $('#yeild_show').hide();
        } else if (selectedText == '3') {
            $('#paper_size_show').hide();
            $('#compatible_model_show').show();
            $('#yeild_show').show();
            $('#compatible_toners_show').hide();
            $('#bundles_show').hide();
            $('#product_code_show').hide();
            $('#speed_show').hide();
            $('#functional_show').hide();
            $('#warrenty_show').hide();
            $('#license_show').hide();
        } else if (selectedText == '4' || selectedText == '5' ||
            selectedText == '6' || selectedText == '7' || selectedText == '8') {
            $('#paper_size_show').hide();
            $('#warrenty_show').show();
            $('#compatible_model_show').hide();
            $('#compatible_toners_show').hide();
            $('#bundles_show').hide();
            $('#type_show').hide();
            $('#product_code_show').hide();
            $('#speed_show').hide();
            $('#functional_show').hide();
            $('#license_show').hide();
            $('#yeild_show').hide();
        } else if (selectedText == '9' || selectedText == '10') {
            $('#paper_size_show').hide();
            $('#license_show').show();
            $('#warrenty_show').hide();
            $('#compatible_model_show').hide();
            $('#compatible_toners_show').hide();
            $('#bundles_show').hide();
            $('#type_show').hide();
            $('#product_code_show').hide();
            $('#speed_show').hide();
            $('#functional_show').hide();
            $('#yeild_show').hide();
        } else {
            $('#yeild_show').hide();
            $('#bundles_show').hide();
        }
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
                                var html = "<div class='upload__img-box'><div style='background-image: url(" + e.target.result + ")' data-number='" + $(".upload__img-close").length + "' data-file='" + f.name + "' class='img-bg'><div class='upload__img-close'></div></div></div>";
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
<script>
$(document).on('click', '.delete-btn', function(e) {
    e.preventDefault(); 
    console.log('Delete button clicked'); 
    var imageId = $(this).data('image-id');
    Swal.fire({
        title: 'Are you sure?',
        text: 'You won\'t be able to revert this!',
        icon: 'warning',
        showCancelButton: true,
        confirmButtonText: 'Yes, delete it!',
        cancelButtonText: 'Cancel'
    }).then((result) => {
        if (result.isConfirmed) {
            $.ajax({
                type: 'POST',
                url: '{{ route("delete.product-image") }}',
                data: {
                    '_token': '{{ csrf_token() }}',
                    'image_id': imageId
                },
                success: function(response) {
                    if (response.success) {
                        // $('#image-' + imageId).remove();
                        $('#image-' + imageId).closest('.img-bg').parent().remove();
                        Swal.fire('Deleted!', response.message, 'success');
                    } else {
                        Swal.fire('Error!', response.message, 'error');
                    }
                },
                error: function(xhr, status, error) {
                    console.error(xhr.responseText);
                    Swal.fire('Error!', 'An error occurred while deleting the image.', 'error');
                }
            });
        }
    });
});
</script>
@endsection
@section('script')
<script>
    // document.addEventListener('DOMContentLoaded', function() {
    //     var featuredCheckbox = document.getElementById('featured-customCheck');
    //     var recommendedCheckbox = document.getElementById('recomended-customCheck');

    //     var isFeaturedInput = document.getElementById('isFeaturedInput');
    //     var isRecommendedInput = document.getElementById('isRecommendedInput');

    //     featuredCheckbox.addEventListener('change', function() {
    //         isFeaturedInput.value = featuredCheckbox.checked ? 1 : 0;
    //     });

    //     recommendedCheckbox.addEventListener('change', function() {
    //         isRecommendedInput.value = recommendedCheckbox.checked ? 1 : 0;
    //     });
    // });
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
