@extends('layouts.master')
@section('title')
@lang('Service Call')
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
             Services Contract
        @endslot
    @endcomponent

    <div class="row">
        <div class="col-lg-12">
            <div class="card">
                <div class="card-header">
                    <h5 class="card-title">Service Call Requests</h5>
                </div>
                <div class="card-body">
                    <form action="{{route('update.service',$service->id)}}" method="post" enctype="multipart/form-data">
                        @csrf
                        <div class="mb-3">
                            <label for="" class="form-label">Edit Service Name</label>
                            <input type="text" name="name" class="form-control" value="{{$service->name}}">
                        </div>
                        <div class="mb-3">
                            <img src="{{asset('images/' . $service->image)}}" alt="No Image" id="serviceImagePreview" style="height:200px;width:300px">
                        </div>
                        <div class="mb-3">
                            <label for="main_category_image" class="form-label">Update Service Image</label>
                            <input class="form-control" type="file" name="service_image" id="service_image" accept="image/*">
                        </div>
                        <div class="mb-3">
                            <label class="form-label">Service Status</label>
                            <select class="form-select" name="service_status">
                                <option value="1" @if($service->status == '1') selected @endif>Active</option>
                                <option value="0" @if($service->status == '0') selected @endif>Inactive</option>
                            </select>
                        </div>
                        <div class="mb-3">
                            <button type="submit" class="btn btn-primary w-md btn-bg-color border-0">Update</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection
@section('script')
<script>
    $(document).ready(function () {
        $('#service_image').change(function () {
            previewImage(this);
        });

        function previewImage(input) {
            var preview = $('#serviceImagePreview');
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
