@extends('layouts.master')
@section('title')
    @lang('translation.Edit Categegories')
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
            Cateogores !
        @endslot
    @endcomponent
    <!-- Main Category Form -->
    <!-- Main Category Form -->
    <div class="container">
        @if (isset($mainCategory))
        {{-- @dd($mainCategory) --}}
            <form action="{{ route('update.main.category', $mainCategory->id) }}" enctype="multipart/form-data" method="post">
                @csrf
                <div class="mb-3">
                    <label for="mainCategory-input" class="form-label">Main Category Name</label>
                    <input class="form-control" type="text" name="main_category_name"
                        value="{{ $mainCategory->category_name }}" id="mainCategory-input">
                </div>
                @error('main_category_name')
                    <div class="text-danger">{{$message}}<button type="button"
                        class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button></div>
                @enderror
                <div class="mb-3">
                    <label class="form-label">Category Status</label>
                    <select class="form-select" name="category_status">
                        <option value="1" @if($mainCategory->status=='1') selected @endif>Active</option>
                        <option value="0" @if($mainCategory->status=='0') selected @endif>Inactive</option>
                    </select>
                </div>
                @error('category_status')
                    <p class="text-danger">{{$message}}<button type="button"
                        class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button></p>
                @enderror
                <div class="mb-3">
                    <label class="form-label">Category Order</label>
                    <input class="form-control" type="text" name="main_category_order" id="mainCategory-input" value="{{ $index }}" placeholder="1,2,3,4...">
                    <code class="text-muted">Note! Categories Shown By This Order</code>
                </div>
                <div class="mb-3">
                    <label for="formFile" class="form-label">Category Image</label>
                    <input class="form-control @error('image') is-invalid @enderror" type="file" id="category_image" name="image" accept="image/*">
                </div>
                <div class="mb-3">
                    <img src="{{asset('images/category_images/'.$mainCategory->image)}}" style="height: 300px;width:300px;" id="categoryImagePreview">
                </div>
                @error('image')
                    <p class="text-danger">{{$message}}<button type="button"
                        class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button></p>
                @enderror
                <input type="hidden" name="old_image" value="{{ $mainCategory->image }}">
                <div class="mt-4">
                    <button type="submit" class="btn border-0 btn-primary w-md btn-bg-color">Update</button>
                </div>
            </form>
        @elseif(isset($sub_category))
            <div class="card">
                <div class="card-header">
                    <h5 class="card-title">Edit Categories</h5>
                </div>
                <div class="card-body">
                    <form action="{{ route('update.sub.category', $sub_category->id) }}" method="post">
                        @csrf
                        <div class="mb-3">
                            <label class="form-label">Select Main Category</label>
                            <select class="form-select" name="main_category">
                                @foreach ($maincategories as $category)
                                    <option value="{{ $category->id }}" @if ($category->id == $sub_category->parent_category_id) selected @endif>{{ $category->category_name }}</option>
                                @endforeach
                            </select>
                        </div>

                        <div class="mb-3">
                            <label for="mainCategory-input" class="form-label">Sub Category Name</label>
                            <input class="form-control" type="text" name="sub_category_name"
                                value="{{ $sub_category->sub_category_name }}" id="mainCategory-input">
                        </div>
                        <div class="mb-3">
                            <label class="form-label">Category Status</label>
                            <select class="form-select" name="sub_category_status">
                                <option value="1" @if($sub_category->status=='1') selected @endif>Active</option>
                                <option value="0" @if($sub_category->status=='0') selected @endif>Inactive</option>
                            </select>
                        </div>
                        {{-- <div class="mb-3">
                            <label class="form-label">Category Order</label>
                            <input class="form-control" type="text" value="{{ $index }}" name="sub_category_order" id="mainCategory-input" value="1" placeholder="1,2,3,4...">
                            <code class="text-muted">Note! Categories Shown By This Order</code>
                        </div> --}}
                        <div class="mt-4">
                            <button type="submit" class="btn border-0 btn-primary w-md btn-bg-color">Update</button>
                        </div>
                    </form>
                </div>
            </div>
        @elseif($categories)
            <form action="{{ route('update.sub.sub.category', $categories->id) }}" method="post">
                @csrf
                <div class="mb-3">
                    <label for="mainCategory-input" class="form-label">Category Name</label>
                    <input class="form-control" type="text" name="sub_sub_category_name"
                        value="{{ $categories->sub_category_name }}" id="mainCategory-input">
                </div>
                <div class="mt-4">
                    <button type="submit" class="btn btn-primary w-md btn-bg-color">Update</button>
                </div>
            </form>
        @endif



    </div>
@endsection
@section('script')
    <!-- apexcharts -->
    <script src="{{ URL::asset('/assets/libs/apexcharts/apexcharts.min.js') }}"></script>
    <script src="{{ URL::asset('/assets/libs/admin-resources/admin-resources.min.js') }}"></script>

    <!-- dashboard init -->
    <script src="{{ URL::asset('/assets/js/pages/dashboard.init.js') }}"></script>
    <script src="{{ URL::asset('/assets/js/app.min.js') }}"></script>
    <script>
        $(document).ready(function () {
            $('#category_image').change(function () {
                previewImage(this);
            });

            function previewImage(input) {
                var preview = $('#categoryImagePreview');
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
@endsection
