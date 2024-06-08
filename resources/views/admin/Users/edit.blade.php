@extends('layouts.master')
@section('title')
@lang('Account Manager')
@endsection
@section('css')
<link href="{{ URL::asset('/assets/libs/admin-resources/admin-resources.min.css') }}" rel="stylesheet">
<link href="{{ URL::asset('assets/libs/dropzone/dropzone.min.css') }}" rel="stylesheet">
<style>
    input::-webkit-outer-spin-button,
    input::-webkit-inner-spin-button {
        -webkit-appearance: none;
        margin: 0;
    }
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
                <form action="{{route('update.user',$user->id)}}" method="post">
                    @csrf
                    <div class="mb-3">
                        <label for="example-text-input" class="form-label">Username</label>
                        <input class="form-control" type="text" name="user_name" placeholder="Region Name" value="{{$user->name}}">
                    </div>
                    @error('user_name')
                    <p class="alert alert-danger">{{$message}}</p>
                    @enderror
                    <div class="mb-3">
                        <label for="example-text-input" class="form-label">User Email</label>
                        <input class="form-control" type="text" name="user_email" placeholder="Region Name" value="{{$user->email}}">
                    </div>
                    @error('user_email')
                    <p class="alert alert-danger">{{$message}}</p>
                    @enderror
                    <div class="mb-3">
                        <label for="example-text-input" class="form-label">First Name</label>
                        <input class="form-control" type="text" name="first_name" placeholder="First Name" value="{{ $customer_details['billingDetail'] ? $customer_details['billingDetail']->first_name : 
              ($customer_details['customerOrder'] ? $customer_details['customerOrder']->first_name : '') }}">
                    </div>
                    @error('first_name')
                    <p class="alert alert-danger">{{$message}}</p>
                    @enderror
                    <div class="mb-3">
                        <label for="example-text-input" class="form-label">Last Name</label>
                        <input class="form-control" type="text" name="last_name" placeholder="Last Name" value="{{ $customer_details['billingDetail'] ? $customer_details['billingDetail']->last_name : 
                  ($customer_details['customerOrder'] ? $customer_details['customerOrder']->last_name : '') }}">
                    </div>
                    @error('last_name')
                    <p class="alert alert-danger">{{ $message }}</p>
                    @enderror
                    <div class="mb-3">
                        <label for="example-text-input" class="form-label">Address</label>
                        <input class="form-control" type="text" name="address" placeholder="Address" value="{{ $customer_details['billingDetail'] ? $customer_details['billingDetail']->address : 
                  ($customer_details['customerOrder'] ? $customer_details['customerOrder']->address : '') }}">
                    </div>
                    @error('address')
                    <p class="alert alert-danger">{{ $message }}</p>
                    @enderror
                    <div class="mb-3">
                        <label for="country" class="form-label">Country</label>
                        <select class="form-select" name="country" id="country">
                            <option value="">Select Country</option>
                            @foreach($countries as $country)
                            <option value="{{ $country->name }}" {{ isset($customer_details['billingDetail']) && $customer_details['billingDetail']->country == $country->name ? 'selected' : (isset($customer_details['customerOrder']) && $customer_details['customerOrder']->country == $country->name ? 'selected' : '') }}>{{ $country->name }}</option>
                            @endforeach
                        </select>
                    </div>

                    @error('country')
                    <p class="alert alert-danger">{{ $message }}</p>
                    @enderror
                    <div class="mb-3">
                        <label for="region" class="form-label">Region</label>
                        <select class="form-select" name="region" id="region">
                            <option value="">Select Region</option>
                            @foreach($regions as $region)
                            <option value="{{ $region->name }}" {{ isset($customer_details['billingDetail']) && $customer_details['billingDetail']->region == $region->name ? 'selected' : (isset($customer_details['customerOrder']) && $customer_details['customerOrder']->region_state == $region->name ? 'selected' : '') }}>{{ $region->name }}</option>
                            @endforeach
                        </select>
                    </div>

                    @error('region')
                    <p class="alert alert-danger">{{ $message }}</p>
                    @enderror
                    <div class="mb-3">
                        <label for="example-text-input" class="form-label">CR No</label>
                        <input class="form-control" type="text" name="cr_no" placeholder="CR No" value="{{ $customer_details['billingDetail'] ? $customer_details['billingDetail']->cr_no : 
                  ($customer_details['customerOrder'] ? $customer_details['customerOrder']->company_reg_no : '') }}">
                    </div>
                    @error('cr_no')
                    <p class="alert alert-danger">{{ $message }}</p>
                    @enderror

                    <div class="mb-3">
                        <label for="example-text-input" class="form-label">Vat Reg No</label>
                        <input class="form-control" type="number" name="vat_reg_no" placeholder="Vat Reg No" value="{{ $customer_details['billingDetail'] ? $customer_details['billingDetail']->vat_reg_no : 
                  ($customer_details['customerOrder'] ? $customer_details['customerOrder']->vat_reg_no : '') }}">
                    </div>
                    @error('vat_reg_no')
                    <p class="alert alert-danger">{{ $message }}</p>
                    @enderror
                    <div class="mb-3">
                        <label for="example-text-input" class="form-label">Billing Email</label>
                        <input class="form-control" type="text" name="billing_email" placeholder="Billing Email" value="{{ $customer_details['billingDetail'] ? $customer_details['billingDetail']->email : 
                  ($customer_details['customerOrder'] ? $customer_details['customerOrder']->email : '') }}">
                    </div>
                    @error('billing_email')
                    <p class="alert alert-danger">{{ $message }}</p>
                    @enderror

                    <div class="mb-3">
                        <label for="example-text-input" class="form-label">Phone Number</label>
                        <input class="form-control" type="text" name="phone" placeholder="Phone" value="{{ $customer_details['billingDetail'] ? $customer_details['billingDetail']->phone_number : 
                  ($customer_details['customerOrder'] ? $customer_details['customerOrder']->phone_number : '') }}">
                    </div>
                    @error('phone')
                    <p class="alert alert-danger">{{ $message }}</p>
                    @enderror

                    <div class="mb-3">
                        <label for="account_manager" class="form-label">Account Manager</label>
                        <select class="form-select" name="account_manager" id="account_manager">
                            <option value="">Select Account Manager</option>
                            @foreach($accountManagers as $manager)
                            <option value="{{ $manager->name }}" {{ isset($customer_details['billingDetail']) && $customer_details['billingDetail']->account_manager == $manager->name ? 'selected' : (isset($customer_details['customerOrder']) && $customer_details['customerOrder']->account_manager == $manager->name ? 'selected' : '') }}>{{ $manager->name }}</option>
                            @endforeach
                        </select>
                    </div>

                    @error('account_manager')
                    <p class="alert alert-danger">{{ $message }}</p>
                    @enderror

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