@extends('layouts.master')
@section('title')
@lang('Contacts')
@endsection
@section('css')
<link href="{{ URL::asset('/assets/libs/admin-resources/admin-resources.min.css') }}" rel="stylesheet">
<link rel="stylesheet" href="https://cdn.datatables.net/1.13.7/css/jquery.dataTables.css" />
<style>
     .current
    {
        background: #f4f5f8 !important;
        border: none !important;
    }
    .dataTables_wrapper .dataTables_paginate .paginate_button:hover 
    {
        background: transparent !important;
        color: #da5858 !important;
        border-color: transparent !important;
    }
    .dataTables_wrapper .dataTables_filter input:focus-visible
    {
        outline: none !important;
    }
    .dataTables_wrapper .dataTables_info 
    {
        padding-top: 30px !important;
    }
    .dataTables_wrapper .dataTables_paginate {
        padding-top: 20px !important;
    }
    .dataTables_wrapper .dataTables_length {
        margin-bottom: 10px;
    }
    div.dataTables_wrapper div.dataTables_filter {
        margin-bottom: 12px;
    }
</style>
@endsection
@section('content')
@component('components.breadcrumb')
@slot('li_1')
Dashboard
@endslot
@slot('title')
Customer Contacts !
@endslot
@endcomponent
<div class="row">
    <div class="col-lg-12">
        <div class="card">
            <div class="card-header">
                <h5 class="card-title">Customer Contacts</h5>
            </div>
            <div class="card-body table-responsive">
                <table class="table " id="Products-Table">
                    <thead>
                        <tr>
                            <th>#</th>
                            <th>Name</th>
                            <th>Email</th>
                            <th>Phone</th>
                            <th>Company</th>
                            <th>Message</th>
                            <th>Date</th>
                        </tr>
                    </thead>
                    <tbody>
                        @if ($contacts->count() > 0)
                            @foreach ($contacts as $contact)
                                <tr>
                                    <td>{{$loop->index + 1}}</td>
                                    <td>{{$contact->name}}</td>
                                    <td>{{$contact->email}}</td>
                                    <td>{{$contact->phone}}</td>
                                    <td>{{$contact->company}}</td>
                                    <td>{{$contact->message}}</td>
                                    <td>{{$contact->created_at->format('j-M-Y')}}</td>
                                </tr>
                            @endforeach
                            @else
                            <tr>
                                <td colspan="7" class="text-center fs-1">No Contacts</td>
                            </tr>
                        @endif
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>
@endsection
@section('script')
<!-- apexcharts -->
<script src="{{ URL::asset('/assets/libs/apexcharts/apexcharts.min.js') }}"></script>
<script src="{{ URL::asset('/assets/libs/admin-resources/admin-resources.min.js') }}"></script>
<script src="https://code.jquery.com/jquery-3.6.4.min.js"></script>
<script src="https://cdn.datatables.net/1.13.7/js/jquery.dataTables.js"></script>
<!-- dashboard init -->
<script src="{{ URL::asset('/assets/js/pages/dashboard.init.js') }}"></script>
<script src="{{ URL::asset('/assets/js/app.min.js') }}"></script>
@endsection