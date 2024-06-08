@extends('layouts.master')
@section('title')
    @lang('Countries')
@endsection
@section('css')
    <link href="{{ URL::asset('/assets/libs/admin-resources/admin-resources.min.css') }}" rel="stylesheet">
    <link href="{{ URL::asset('assets/libs/dropzone/dropzone.min.css') }}" rel="stylesheet">
    <style>
        /* Chrome, Safari, Edge, Opera */
input::-webkit-outer-spin-button,
input::-webkit-inner-spin-button {
  -webkit-appearance: none;
  margin: 0;
}

/* Firefox */
input[type=number] {
  -moz-appearance: textfield;
}
    </style>
@endsection
@section('content')
    @component('components.breadcrumb')
        @slot('li_1')
            Dashboard
        @endslot
        @slot('title')
        Countries !
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
            <div class="card" style="overflow-x: auto;">
                <div class="container mt-3">
                    @if (session('success'))
                        <div class="alert alert-success text-center alert-dismissible fade show">
                            <div class="fs-5">
                                {{ session('success') }}
                            </div>
                        </div>
                    @endif
                </div>
                <div class="card-header">
                    <h5 class="card-title">Countries</h5>
                </div>
                <div class="card-body">
                    <table class="table">
                        <thead>
                            <tr>
                                <th>ID</th>
                                <th scope="col">Name</th>
                                <th scope="col">Status</th>
                                <th scope="col">Actions</th>
                            </tr>
                        </thead>
                        <tbody>
                            @if ($countries->count() > 0)                                
                                @foreach ($countries as $country)
                                    <tr>  
                                        <td style="width: 50px;">{{$loop->index + 1}}</td>
                                        <td class="{{$country->is_default_country == '1' ? 'text-success' : ''}}">{{$country->name}}</td>
                                        @if ($country->status == 0)
                                            <td class="text-warning">Inactive</td>
                                        @else
                                            <td class="text-success">Active</td>
                                        @endif
                                        <td>
                                            <a href="{{route('edit.country',$country->id)}}" class="text-success">
                                                <i class="mdi mdi-pencil font-size-18"></i>
                                            </a>
                                            <a href="{{route('delete.country',$country->id)}}" class="text-danger" onclick="return confirm('Are you sure you want to delete this country?')"><i class="mdi mdi-delete font-size-18"></i></a>
                                        </td>
                                    </tr>
                                @endforeach
                                @else
                                <td colspan="6" class="text-center fs-5 fw-bold">No countries</td>        
                            @endif
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
        <div class="col-lg-4">
            <div class="card">
                <div class="card-header">
                    <h5 class="card-title">Create Country</h5>
                </div>
                <div class="card-body">
                    <form action="{{route('country.store')}}" method="post">
                        @csrf
                        <div class="mb-3">
                            <label for="example-text-input" class="form-label">Country</label>
                            <input class="form-control" type="text" name="name" id="" placeholder="Country Name" value="{{old('name')}}">
                        </div>
                        @error('name')
                            <p class="alert alert-danger">{{$message}}</p>
                        @enderror
                        <div class="mb-3">
                            <div class="form-check">
                                <input class="form-check-input" type="checkbox" name="default_country" id="default_country" {{ old('default_country') ? 'checked' : '' }}>
                                <label class="form-check-label" for="default_manager">Default Country</label>
                            </div>
                            <div id="replaceWarning" class="text-danger" style="display: none;">
                                If You already have a Default Country. Selecting a new one will replace the existing Default Country.
                            </div>
                        </div>
                        <div class="mb-3">
                            <label class="form-label">Status</label>
                            <select class="form-select" name="status">
                                <option value="1">Active</option>
                                <option value="0">Inactive</option>
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
            var isChecked = $('#default_country').prop('checked');
            $('#replaceWarning').toggle(isChecked);
        }
        toggleReplaceWarning();
        $('#default_country').on('change', function() {
            toggleReplaceWarning();
        });
    });
</script>
@endsection
