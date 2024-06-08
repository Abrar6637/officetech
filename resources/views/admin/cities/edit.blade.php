@extends('layouts.master')
@section('title')
    @lang('Cities')
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
            Edit City !
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
                    <h5 class="card-title">Edit City</h5>
                </div>
                <div class="card-body">
                    <form action="{{route('update.city',$city->id)}}" method="post">
                        @csrf
                        <div class="mb-3">
                            <label for="example-text-input" class="form-label">City</label>
                            <input class="form-control" type="text" name="name" id="" placeholder="City Name" value="{{$city->name}}">
                        </div>
                        @error('name')
                            <p class="alert alert-danger">{{$message}}</p>
                        @enderror
                        <div class="mb-3">
                            <label class="form-label">Region</label>
                            <select class="form-select" name="region">
                                @if ($regions->count() > 0)    
                                    @foreach ($regions as $region)
                                     <option value="{{$region->id}}" {{$city->region_id == $region->id ? 'selected' : '' }}>{{$region->name}}</option>
                                    @endforeach
                                @endif
                            </select>
                        </div>
                        <div class="mb-3">
                            <label class="form-label">Status</label>
                            <select class="form-select" name="status">
                                <option value="1" {{$city->status == 1 ? 'selected' : ''}}>Active</option>
                                <option value="0" {{$city->status == 0 ? 'selected' : ''}}>Inactive</option>
                            </select>
                        </div>
                        <div class="mt-4">
                            <button type="submit" class="btn border-0 w-md btn-bg-color text-white">Submit</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="{{ URL::asset('/assets/libs/apexcharts/apexcharts.min.js') }}"></script>
    <script src="{{ URL::asset('/assets/libs/admin-resources/admin-resources.min.js') }}"></script>
    <script src="{{ URL::asset('assets/libs/dropzone/dropzone.min.js') }}"></script>
    <script>
    $(document).ready(function() {
        function toggleReplaceWarning() {
            var isChecked = $('#default_manager').prop('checked');
            $('#replaceWarning').toggle(isChecked);
        }
        toggleReplaceWarning();
        $('#default_manager').on('change', function() {
            toggleReplaceWarning();
        });
    });
    </script>
@endsection
