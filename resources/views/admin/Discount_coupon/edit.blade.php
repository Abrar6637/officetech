@extends('layouts.master')
@section('title')
@section('title') @lang('translation.Form_DashboardFile_Upload') @endsection
@lang('translation.Categories')
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
Discount Coupon !
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
    <div class="col-12">
        <div class="card">
            <div class="card-header">
                <h4 class="card-title">Edit Coupon</h4>
            </div>
            <form method="post" action="{{ route('store.discount') }}">
                @csrf
                <div class="card-body p-4">
                    <div class="row">
                        <div class="col-lg-6">
                            <div class="mb-3">
                                <label for="example-text-input" class="form-label">Discount Coupon</label>
                                <input class="form-control" type="text" value="{{ old('discount_coupon', $discount->discount_coupon) }}" name="discount_coupon" id="discount_coupon">
                                @error('discount_coupon')
                                <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>
                            <div class="mb-3">
                            <input class="form-control" type="hidden" value="{{$discount->id}}" name="id">
                                <label for="example-search-input" class="form-label">Discount Amount</label>
                                <input class="form-control" type="text" value="{{ old('discount', $discount->discount) }}" name="discount" id="discount">
                                @error('discount')
                                <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>
                            <div class="mb-3">
                                <label for="example-search-input" class="form-label">Status</label>
                                <select class="form-select" name="status">
                                    <option value="1" {{ (old('status', $discount->status) == '1' || !old('status')) ? 'selected' : '' }}>Active</option>
                                    <option value="0" {{ old('status', $discount->status) == '0' ? 'selected' : '' }}>In Active</option>
                                </select>
                                @error('status')
                                <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>
                            <div class="mb-3">
                                <label for="example-search-input" class="form-label">Is one time</label>
                                <input class="form-check-input" value="1" name="is_one_time" type="checkbox" id="formCheck2" {{ old('is_one_time', $discount->is_one_time) ? 'checked' : '' }}>
                                @error('is_one_time')
                                <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>
                        </div>
                        <div class="col-lg-6">
                            <div class="mt-3 mt-lg-0">
                                <div class="mb-3">
                                    <label for="example-date-input" class="form-label">Start Date</label>
                                    <input class="form-control" type="date" value="{{ old('start_date', \Carbon\Carbon::parse($discount->start_date)->format('Y-m-d')) }}" name="start_date" id="start_date">
                                    @error('start_date')
                                    <span class="text-danger">{{ $message }}</span>
                                    @enderror
                                </div>
                                <div class="mb-3">
                                    <label for="example-date-input" class="form-label">End Date</label>
                                    <input class="form-control" type="date" value="{{ old('end_date', \Carbon\Carbon::parse($discount->end_date)->format('Y-m-d')) }}" name="end_date" id="end_date">
                                    @error('end_date')
                                    <span class="text-danger">{{ $message }}</span>
                                    @enderror
                                </div>
                                <div class="mb-3">
                                    <label class="form-label">Discount Type</label>
                                    <select class="form-select" name="discount_type">
                                        <option value="" hidden>Select Type</option>
                                        <option value="Fixed Price" {{ old('discount_type', $discount->discount_type) == 'Fixed Price' ? 'selected' : '' }}>Fixed Price</option>
                                        <option value="Percentage" {{ old('discount_type', $discount->discount_type) == 'Percentage' ? 'selected' : '' }}>Percentage</option>
                                    </select>
                                    @error('discount_type')
                                    <span class="text-danger">{{ $message }}</span>
                                    @enderror
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="mb-3">
                        <button type="submit" class="btn border-0 w-md btn-bg-color text-white">Submit</button>
                    </div>
                </div>
            </form>
        </div>
    </div> <!-- end col -->
</div>
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script src="{{ URL::asset('/assets/libs/apexcharts/apexcharts.min.js') }}"></script>
<script src="{{ URL::asset('/assets/libs/admin-resources/admin-resources.min.js') }}"></script>
<script src="{{ URL::asset('assets/libs/dropzone/dropzone.min.js') }}"></script>
@endsection