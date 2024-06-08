@extends('layouts.master')
@section('title')
    @lang('Account Manager')
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
            Account Managers !
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
                    <h5 class="card-title">Edit Account Manager</h5>
                </div>
                <div class="card-body">
                    <form action="{{route('update.account.manager',$manager->id)}}" method="post">
                        @csrf
                        <div class="mb-3">
                            <label for="example-text-input" class="form-label">Manager Name</label>
                            <input class="form-control" type="text" name="name" id="" placeholder="Name" value="{{$manager->name}}">
                        </div>
                        @error('name')
                            <p class="alert alert-danger">{{$message}}</p>
                        @enderror
                        <div class="mb-3">
                            <label class="form-label">Email</label>
                            <input class="form-control" type="text" name="email" id="" placeholder="Email" value="{{$manager->email}}">
                        </div>
                        @error('email')
                            <p class="alert alert-danger">{{$message}}</p>
                        @enderror
                        <div class="mb-3">
                            <label class="form-label">Phone Number</label>
                            <input class="form-control" type="number" name="phone" value="{{$manager->phone}}">
                        </div>
                        @error('phone')
                            <p class="alert alert-danger">{{$message}}</p>
                        @enderror
                        <div class="mb-3 ">
                            <div class="form-check">
                                <input type="checkbox" class="form-check-input" id="default_manager" name="default_manager" {{ $manager->is_default_manager ? 'checked' : '' }}>
                                <label class="form-check-label" for="default_manager">Default Manager</label>
                            </div>
                            <div id="replaceWarning" class="text-danger" style="display: none;">
                                If You already have a Default Manager. Selecting a new one will replace the existing Default Manager.
                            </div>
                        </div>
                        <div class="mb-3">
                            <label class="form-label">Status</label>
                            <select class="form-select" name="status">
                                <option value="0" {{$manager->status == '0' ? 'selected' : ''}}>Inactive</option>
                                <option value="1" {{$manager->status == '1' ? 'selected' : ''}}>Active</option>
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
