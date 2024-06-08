@extends('layouts.master')
@section('title')
    @lang('Users')
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
            Users !
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
                    <h5 class="card-title">Users</h5>
                </div>
                <div class="card-body overflow-auto">
                    <table class="table text-nowrap">
                        <thead>
                            <tr>
                                <th>ID</th>
                                <th>Username</th>
                                <th>Email</th>
                                <th>First Name</th>
                                <th>Last Name</th>
                                <th>Address</th>
                                <th>Country</th>
                                <th>Region</th>
                                <th>CR No</th>
                                <th>Vat reg no</th>
                                <th>Billing Email</th>
                                <th>Phone</th>
                                <th>Account Manager</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            @if ($users->count() > 0)
                                @foreach ($users as $user)
                                    <tr>  
                                        <td>{{$user->id}}</td>
                                        <td>{{$user->name}}</td>
                                        <td>{{$user->email}}</td>   
                                        @if (isset($user_details[$user->id]))
                                            @php
                                                $details = $user_details[$user->id];
                                            @endphp
                                            <td>{{$details['billing_detail']->first_name ??  $details['customer_order']->first_name ?? 'N/A'}}</td>
                                            <td>{{$details['billing_detail']->last_name ??  $details['customer_order']->last_name ?? 'N/A'}}</td>
                                            <td>{{$details['billing_detail']->address ??  $details['customer_order']->address ?? 'N/A'}}</td>
                                            <td>{{$details['billing_detail']->country ??  $details['customer_order']->country ?? 'N/A'}}</td>
                                            <td>{{$details['billing_detail']->region ??  $details['customer_order']->region_state ?? 'N/A'}}</td>
                                            <td>{{$details['billing_detail']->cr_no ??  $details['customer_order']->company_reg_no ?? 'N/A'}}</td>
                                            <td>{{$details['billing_detail']->vat_reg_no ?? $details['customer_order']->vat_reg_no ?? 'N/A'}}</td>
                                            <td>{{$details['billing_detail']->email ??  $details['customer_order']->email ?? 'N/A'}}</td>
                                            <td>{{$details['billing_detail']->phone_number ??  $details['customer_order']->phone_number ?? 'N/A'}}</td>
                                            <td>{{$details['billing_detail']->account_manager ??  $details['customer_order']->account_manager ?? 'N/A'}}</td>
                                            <td>
                                                <a href="{{route('edit.user',$user->id)}}" class="text-success">
                                                    <i class="mdi mdi-pencil font-size-18"></i>
                                                </a>
                                            </td>
                                        @else
                                            <td colspan="13">No billing details or customer orders found</td>
                                            <td>
                                                <a href="{{route('edit.user',$user->id)}}" class="text-success">
                                                    <i class="mdi mdi-pencil font-size-18"></i>
                                                </a>
                                            </td>
                                        @endif
                                    </tr>
                                @endforeach
                            @else
                                <tr>
                                    <td colspan="14" class="text-center fs-5 fw-bold">No Users</td>        
                                </tr>
                            @endif
                        </tbody>
                    </table>
                </div>

            </div>
        </div>

    </div>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="{{ URL::asset('/assets/libs/apexcharts/apexcharts.min.js') }}"></script>
    <script src="{{ URL::asset('/assets/libs/admin-resources/admin-resources.min.js') }}"></script>
    <script src="{{ URL::asset('assets/libs/dropzone/dropzone.min.js') }}"></script>
@endsection
