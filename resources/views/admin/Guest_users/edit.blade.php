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
            Edit User !
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
                    <h5 class="card-title">Edit User</h5>
                </div>
                <div class="card-body">
                    <form action="{{route('user.guest-user.update',$guest_user->id)}}" method="post">
                        @csrf
                        <div class="mb-3">
                            <label for="example-text-input" class="form-label">User Email</label>
                            <input class="form-control" type="text" name="user_email" placeholder="Region Name" value="{{$guest_user->email}}">
                        </div>
                        @error('user_email')
                            <p class="alert alert-danger">{{$message}}</p>
                        @enderror
                        <div class="mb-3">
                            <label for="example-text-input" class="form-label">Current Password</label>
                            <input class="form-control" type="text" name="cuurent_password" placeholder="Current Password" >
                        </div>
                        @error('cuurent_password')
                            <p class="alert alert-danger">{{$message}}</p>
                        @enderror
                        <div class="mb-3">
                            <label for="example-text-input" class="form-label">New Password</label>
                            <input class="form-control" type="text" name="password" placeholder="New Password">
                        </div>
                        @error('new_password')
                            <p class="alert alert-danger">{{$message}}</p>
                        @enderror

                        <div class="mb-3">
                            <label for="example-text-input" class="form-label">Confirm New Password</label>
                            <input class="form-control" type="text" name="password_confirmation" placeholder="Confirm New Password">
                        </div>
                        @error('c_new_password')
                            <p class="alert alert-danger">{{$message}}</p>
                        @enderror
                        <div class="mb-3">
                            <label for="status" class="form-label">Status</label>
                            <select class="form-select" id="status" name="status">
                                <option value="1" {{ $guest_user->status == 1 ? 'selected' : '' }}>Active</option>
                                <option value="0" {{ $guest_user->status == 0 ? 'selected' : '' }}>Inactive</option>
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
@endsection
