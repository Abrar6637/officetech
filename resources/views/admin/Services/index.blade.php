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
            Services
        @endslot
    @endcomponent

    <div class="row">
        <div class="col-lg-8">
            <div class="card" style="overflow-x: auto;">
                <div class="card-header">
                    <h5 class="card-title">Services</h5>
                </div>
                <div class="card-body">
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
                    <table class="table">
                        <thead>
                            <tr>
                                <th>ID</th>
                                <th scope="col">Service Name</th>
                                <th scope="col">Status</th>
                                <th scope="col">Image</th>
                                <th scope="col">Actions</th>
                            </tr>
                        </thead>
                        <tbody>
                            @if($services->count() > 0)
                                @foreach ($services as $service)
                                    <tr>
                                        <td style="width: 50px;">{{ $loop->index + 1 }}</td>
                                        <td>{{ $service->name }}</td>
                                        @if ($service->status == '1')
                                            <td class="text-success">Active</td>
                                        @else
                                            <td class="text-danger">Inactive</td>
                                        @endif
                                        @if ($service->image == '')
                                        <td>No Image</td>
                                        @else
                                        <td><img src="{{asset('images/' . $service->image)}}" style="width: 100px; height: 100px" alt="{{$service->image}}"></td>
                                            @endif
                                        <td>
                                            <a href="{{route('edit.service',['id' => $service->id])}}"
                                                class="text-success">
                                                <i class="mdi mdi-pencil font-size-18"></i>
                                            </a>
                                            <a href="{{route('delete.service', ['id' => $service->id] )}}" class="text-danger"
                                                onclick="return confirm('Are you sure you want to delete this service category?')"><i
                                                    class="mdi mdi-delete font-size-18"></i></a>
                                        </td>
                                    </tr>
                                @endforeach
                            @else
                            <tr>
                                <td colspan="7" class="text-center fs-1">No Services</td>
                            </tr>
                            @endif
                        </tbody>
                    </table>
                </div>
            </div>
        </div>

        <div class="col-lg-4">
            <div class="card">
                <div class="card-header">
                    <h5 class="card-title">Create Service</h5>
                </div>
                <div class="card-body">
                    <form action="{{route('add.services')}}" method="post" enctype="multipart/form-data" id="addMainCategory">
                        @csrf
                        <div class="mb-3">
                            <label for="example-text-input" class="form-label">Service Name</label>
                            <input class="form-control" type="text" name="service_name" id=""
                                placeholder="Service Name">
                        </div>
                        @error('service_name')
                            <p class="text-danger">{{ $message }}</p>
                        @enderror
                        <div class="mb-3">
                            <label class="form-label">Service Status</label>
                            <select class="form-select" name="service_status">
                                <option value="1">Active</option>
                                <option value="0">Inactive</option>
                            </select>
                        </div>
                        @error('service_status')
                            <div class="alert alert-danger">{{ $message }}<button type="button"
                                class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button></div>
                        @enderror
                        <div class="mb-3">
                            <label for="main_category_image" class="form-label">Service Image</label>
                            <input class="form-control" type="file" name="service_image" id="mainCategory-image"
                                accept="image/*">
                        </div>
                        @error('service_image')
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
