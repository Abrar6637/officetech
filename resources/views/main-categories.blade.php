@extends('layouts.master')
@section('title')
    @lang('translation.MainCategories')
@endsection
@section('css')
    <!-- Include your CSS if needed -->
@endsection
@section('content')
    @component('components.breadcrumb')
        @slot('li_1')
            Dashboard
        @endslot
        @slot('title')
            Main Categories
        @endslot
    @endcomponent

    <div class="row">
        {{-- @dd($main_categories) --}}
        <div class="col-lg-8">
            <div class="card" style="overflow-x: auto;">
                <div class="card-header">
                    <h5 class="card-title">Main Categories</h5>
                </div>
                <div class="card-body">
                    <table class="table">
                        <thead>
                            <tr>
                                <th>ID</th>
                                <th scope="col">Category Name</th>
                                <th scope="col">Status</th>
                                <th scope="col">Image</th>
                                <th scope="col">Actions</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($main_categories as $category)
                                <tr>
                                    <td style="width: 50px;">{{ $loop->index + 1 }}</td>
                                    <td>{{ $category->category_name }}</td>
                                    @if ($category->status == '1')
                                        <td class="text-success">Active</td>
                                    @else
                                        <td class="text-danger">Inactive</td>
                                    @endif
                                    <td><img src="{{asset('images/category_images/' . $category->image)}}" style="width: 100px; height: 100px" alt="{{$category->category_name}}"></td>
                                    @php
                                        $index = $loop->index + 1;
                                    @endphp
                                    <td>
                                        <a href="{{ route('edit.main.category', ['index' => $index, 'id' => $category->id]) }}"
                                            class="text-success">
                                            <i class="mdi mdi-pencil font-size-18"></i>
                                        </a>
                                        <a href="{{ route('delete.main.category', $category->id) }}" class="text-danger"
                                            onclick="return confirm('Are you sure you want to delete this main category?')"><i
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
                    <h5 class="card-title">Create Main Category</h5>
                </div>
                <div class="card-body">
                    <form action="{{ route('add.main.category') }}" method="post" enctype="multipart/form-data"
                        id="addMainCategory">
                        @csrf
                        <div class="mb-3">
                            <label for="example-text-input" class="form-label">Category Name</label>
                            <input class="form-control" type="text" name="main_category_name" id="mainCategory-input"
                                placeholder="Category Name">
                        </div>
                        @error('main_category_name')
                            <div class="alert alert-danger">{{ $message }}<button type="button"
                                class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button></div>
                        @enderror
                        <div class="mb-3">
                            <label class="form-label">Category Status</label>
                            <select class="form-select" name="category_status">
                                <option value="1">Active</option>
                                <option value="0">Inactive</option>
                            </select>
                        </div>
                        @error('category_status')
                            <div class="alert alert-danger">{{ $message }}<button type="button"
                                class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button></div>
                        @enderror
                        <div class="mb-3">
                            <label for="main_category_image" class="form-label">Category Image</label>
                            <input class="form-control" type="file" name="main_category_image" id="mainCategory-image"
                                accept="image/*">
                        </div>
                        @error('main_category_image')
                            <div class="alert alert-danger">{{ $message }}<button type="button"
                                class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button></div>
                        @enderror
                        <div class="mb-3">
                            <label class="form-label">Category Order</label>
                            <input class="form-control" type="text" name="main_category_order" id="mainCategory-input"
                                placeholder="1,2,3,4...">
                            <code class="text-muted">Note! Categories Shown By This Order</code>
                        </div>
                        @error('main_category_order')
                            <div class="alert alert-danger">{{ $message }}<button type="button"
                                class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button></div>
                        @enderror
                        <div class="mt-4">
                            <button type="submit" class="btn border-0 w-md btn-bg-color text-white">Submit</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection
@section('script')
    <!-- Include your scripts if needed -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>
@endsection
