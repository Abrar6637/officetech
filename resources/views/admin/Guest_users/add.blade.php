@extends('layouts.master')
@section('title', __('Account Manager'))
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
Add User
@endslot
@endcomponent

<div class="row">
    <div class="col-lg-12">
        <div class="card">
            <div class="card-header">
                <h5 class="card-title">Add User</h5>
            </div>
            <div class="card-body">
                <form action="{{ route('user.guest-user.store') }}" method="post">
                    @csrf
                    <div class="mb-3">
                        <label for="user_email" class="form-label">User Email</label>
                        <input class="form-control" type="text" id="user_email" name="user_email" placeholder="User Email">
                    </div>
                    @error('user_email')
                    <p class="alert alert-danger">{{ $message }}</p>
                    @enderror

                    <div class="mb-3">
                        <label for="password" class="form-label">Password</label>
                        <input class="form-control" type="password" id="password" name="password" placeholder="Password">
                    </div>
                    @error('password')
                    <p class="alert alert-danger">{{ $message }}</p>
                    @enderror

                    <div class="mb-3">
                        <label for="password_confirmation" class="form-label">Confirm Password</label>
                        <input class="form-control" type="password" id="password_confirmation" name="password_confirmation" placeholder="Confirm Password">
                    </div>
                    @error('password_confirmation')
                    <p class="alert alert-danger">{{ $message }}</p>
                    @enderror

                    <div class="mb-3">
                        <label for="status" class="form-label">Status</label>
                        <select class="form-select" id="status" name="status">
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

@endsection

@section('scripts')
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script src="{{ URL::asset('/assets/libs/apexcharts/apexcharts.min.js') }}"></script>
<script src="{{ URL::asset('/assets/libs/admin-resources/admin-resources.min.js') }}"></script>
<script src="{{ URL::asset('assets/libs/dropzone/dropzone.min.js') }}"></script>
@endsection