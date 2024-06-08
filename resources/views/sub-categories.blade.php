@extends('layouts.master')
@section('title')
@lang('translation.Sub Categories')
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
Sub Categories !
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
                <div class="card" style="overflow-x: auto;">
                    <div class="card-header">
                        <div class="d-flex align-items-baseline gap-2">
                            <h5 class="card-title">
                                {{ $category->category_name }}
                            </h5>
                            <!-- Edit and Delete for Main Category -->
                            {{-- <a href="{{ route('edit.main.category', $category->id) }}" class="text-success"><i
                                class="mdi mdi-pencil font-size-18"></i></a> --}}
                            {{-- <a href="{{ route('delete.main.category', $category->id) }}" class="text-danger"
                            onclick="return confirm('Are you sure you want to delete this main category?')"><i
                                class="mdi mdi-delete font-size-18"></i></a> --}}
                        </div>
                    </div>
                    <div class="card-body">
                        <table class="table align-middle table-nowrap table-check">
                            <thead>
                                <tr>
                                    <th scope="col">Sub Category Name</th>
                                    <th scope="col">Status</th>
                                    <th scope="col">Actions</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($subCategories as $subCategory)
                                @if ($subCategory->parent_category_id == $category->id)
                                <tr>
                                    {{-- <td style="width: 50px;">{{ $subCategory->category_order == 0 ? 0 : $loop->index + 1}}</td> --}}
                                    <td style="width: 300px;">{{ $subCategory->sub_category_name }}</td>
                                    @if ($subCategory->status=='1')
                                        <td style="width: 300px;" class="text-success">Active</td>
                                        @else
                                        <td style="width: 300px;" class="text-danger">Inactive</td>
                                    @endif
                                    @php
                                    $index = $subCategory->category_order == 0 ? 0 : $loop->parent->index * 100 + $loop->index + 1;
                                    @endphp
                                    <td style="width: 50px;">
                                        <!-- Edit and Delete for Sub Category -->
                                        <a href="{{ route('edit.sub.category',['index' => $index, 'id' => $subCategory->id]) }}"
                                            class="text-success"><i class="mdi mdi-pencil font-size-18"></i></a>
                                        <a href="{{ route('delete.subcategory', $subCategory->id) }}"
                                            class="text-danger" onclick="return confirm('Are you sure you want to delete this main category?')"><i class="mdi mdi-delete font-size-18"></i></a>
                                    </td>
                                </tr>
                            </tbody>
                            @endif
                            @endforeach
                        </table>
                    </div>
                </div>
                @endforeach
            </div>
        </div>
    </div>

    <div class="col-lg-4">
        <div class="card">
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
                        <input class="form-control" type="text" name="sub_category_name" id="subCategory-input" placeholder="Sub Category Name">
                    </div>
                    <div class="mb-3">
                        <label class="form-label">Select Category Status</label>
                        <select class="form-select" name="sub_category_status">
                            <option value="1">Active</option>
                            <option value="0">Inactive</option>
                        </select>
                    </div>
                    <div class="mb-3 d-none">
                        <label class="form-label">Sub Category Order</label>
                        <input class="form-control" type="text" name="sub_category_order" id="mainCategory-input" placeholder="1,2,3,4...">
                        <code class="text-muted mt-2">Note! Sub Categories Shown By This Order</code>
                    </div>
                    <div class="mt-4">
                        <button type="submit" class="btn border-0 text-white w-md btn-bg-color">Submit</button>
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