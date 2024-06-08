@extends('layouts.master')
@section('title')
    @lang('translation.Categories')
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
            Categories !
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
            <div class="card">
                <div class="card-header">
                    <h5 class="card-title">Categories</h5>
                </div>
                <div class="card-body">
                    @foreach ($main_categories as $category)
                        <div class="card">
                            <div class="card-header">
                                <div class="d-flex align-items-baseline gap-2">
                                    <h5 class="card-title">
                                        {{ $category->category_name }}
                                    </h5>
                                    <!-- Edit and Delete for Main Category -->
                                    <a href="{{ route('edit.main.category', $category->id) }}" class="text-success"><i class="mdi mdi-pencil font-size-18"></i></a>
                                    <a href="{{ route('delete.main.category', $category->id) }}" class="text-danger" onclick="return confirm('Are you sure you want to delete this main category?')"><i class="mdi mdi-delete font-size-18"></i></a>
                                </div>
                            </div>
                            <div class="card-body">
                                @foreach ($subCategories as $subCategory)
                                    @if ($subCategory->parent_category_id == $category->id)
                                        <table class="table align-middle table-nowrap table-check">
                                            <tbody>
                                                <tr>
                                                    <td style="width: 300px;">{{ $subCategory->sub_category_name }}</td>
                                                    <td style="width: 50px;">
                                                        <!-- Edit and Delete for Sub Category -->
                                                        <a href="{{ route('edit.sub.category', $subCategory->id) }}" class="text-success"><i class="mdi mdi-pencil font-size-18"></i></a>
                                                        <a href="{{ route('delete.subcategory', $subCategory->id) }}" class="text-danger"><i class="mdi mdi-delete font-size-18"></i></a>
                                                    </td>
                                                    <td>
                                                        <table>
                                                            @foreach ($sub_sub_categories as $subSubCategory)
                                                                @if ($subSubCategory->sub_category_id == $subCategory->id)
                                                                    <tr>
                                                                        <td>{{ $subSubCategory->sub_category_name }}</td>
                                                                        <td class="">
                                                                            <!-- Edit and Delete for Sub Sub Category -->
                                                                            <a href="{{ route('edit.sub.sub.category', $subSubCategory->id) }}" class="text-success"><i class="mdi mdi-pencil font-size-18"></i></a>
                                                                            <a href="{{route('delete.sub.sub.category', $subSubCategory->id)}}" class="text-danger"><i class="mdi mdi-delete font-size-18"></i></a>
                                                                        </td>
                                                                    </tr>
                                                                @endif
                                                            @endforeach
                                                        </table>
                                                    </td>
                                                </tr>
                                            </tbody>
                                        </table>
                                    @endif
                                @endforeach
                            </div>
                        </div>
                    @endforeach
                </div>
            </div>
        </div>
        
        <div class="col-lg-4">
            <div class="card">
                <div class="card-header">
                    <h5 class="card-title">Create Main Category</h5>
                </div>
                <div class="card-body">
                    <form action="{{ route('add.main.category') }}" method="post" id="addMainCategory">
                        @csrf
                        <div class="mb-3">
                            <label for="example-text-input" class="form-label">Category Name</label>
                            <input class="form-control" type="text" name="main_category_name" id="mainCategory-input">
                        </div>
                        <div class="mt-4">
                            <button type="submit" class="btn btn-primary w-md btn-bg-color">Submit</button>
                        </div>
                    </form>
                </div>
            </div>
            <div class="card mt-4">
                <div class="card-header">
                    <h5 class="card-title">Create Sub Category</h5>
                </div>
                <div class="card-body">
                    <form action="{{ route('add.sub.categories') }}" method="post">
                        @csrf
                        <div class="mb-3">
                            <label class="form-label">Please Select Main Category</label>
                            <select class="form-select" name="main_category_id">
                                @foreach ($main_categories as $category)  
                                <option value="{{$category->id}}">{{$category->category_name}}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="mb-3">
                            <label for="subCategory-input" class="form-label">Sub Category Name</label>
                            <input class="form-control" type="text" name="sub_category_name" id="subCategory-input">
                        </div>
                        <div class="mt-4">
                            <button type="submit" class="btn btn-primary w-md btn-bg-color">Submit</button>
                        </div>
                    </form>
                </div>
            </div>
            <div class="card mt-4">
                <div class="card-header">
                    <h5 class="card-title">Create Sub of Sub Category</h5>
                </div>
                <div class="card-body">
                    <form action="{{route('add.sub.sub.category')}}" method="post">
                        @csrf
                        <div class="mb-3">
                            <label class="form-label">Please Select Main Category</label>
                            <select class="form-select" name="main_category_id">
                                @foreach ($main_categories as $category)  
                                <option value="{{$category->id}}">{{$category->category_name}}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="mb-3">
                            <label class="form-label">Please Select Sub Category</label>
                                <select class="form-select" name="sub_category_id">
                                    @foreach ($subCategories as $category)  
                                    <option value="{{$category->id}}">{{$category->sub_category_name}}</option>
                                    @endforeach
                            </select>
                        </div>
                        <div class="mb-3">
                            <label for="subCategory-input" class="form-label">Sub of Sub Category Name</label>
                            <input class="form-control" type="text" name="sub_sub_category_name" id="subCategory-input">
                        </div>
                        <div class="mt-4">
                            <button type="submit" class="btn btn-primary w-md btn-bg-color">Submit</button>
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
