@extends('layouts.master')
@section('title')
@lang('Reviews')
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
Customer Reviews !
@endslot
@endcomponent
<div class="row">
    <div class="col-lg-12">
        @if (session('success')&& now()->lt(session('success_expiry')))
        <div class="alert alert-success" role="alert">
            {{ session('success') }}
        </div>
        <script>
        setTimeout(function() {
            $('.alert-success').fadeOut('fast');
        }, 5000);
        </script>
        @endif
        <div class="card">
            <div class="card-header">
                <h5 class="card-title">Customer Reviews</h5>
            </div>
            <div class="card-body table-responsive">
                <table class="table " id="Products-Table">
                    <thead>
                        <tr>
                            <th>Rating</th>
                            <th>Review</th>
                            <th>Advantages</th>
                            <th>Flaws</th>
                            <th>Customer Name</th>
                            <th>Email</th>
                            <th>Product Name</th>
                            <th>Status</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        @if ($reviews->count() > 0)
                            @foreach ($reviews as $review)
                                <tr>
                                    <td>{{$review->rating}} Star</td>
                                    <td>{{Str::limit($review->review,50)}}</td>
                                    <td>{{Str::limit($review->advantages,20)}}</td>
                                    <td>{{$review->flaws}}</td>
                                    <td>{{$review->user->name}}</td>
                                    <td>{{Str::limit($review->email,10)}}</td>
                                    <td> {{ isset($review->product) ? $review->product->name : 'Product not available' }}</td>
                                        @if ($review->status == 1)
                                            <td class="text-success">Approved</td>
                                            @else
                                            <td class="text-warning">Pending</td>
                                        @endif
                                    <td>
                                        <a href="{{route('update.reviews',['id'=>$review->id,'status'=> 1])}}" class="text-success"><i
                                        class="mdi mdi-check font-size-18"></i></a><br>
                                        <a href="{{route('update.reviews',['id'=>$review->id,'status'=> 0])}}" class="text-danger"><i
                                        class="mdi mdi-cancel font-size-18"></i></a><br>
                                        <a data-bs-toggle="modal"
                                        data-rating="{{$review->rating}}" 
                                        data-advantages="{{$review->advantages}}" 
                                        data-flaws="{{$review->flaws}}" 
                                        data-name="{{$review->user->name}}" 
                                        data-review="{{$review->review}}" 
                                        data-email="{{$review->email}}" 
                                        data-id="{{$review->id}}" 
                                        data-productname="{{ isset($review->product) ? $review->product->name : '' }}"
                                        data-productsku="{{ isset($review->product) ? $review->product->sku : '' }}"
                                        data-bs-target="#review-detail" class="review-details text-danger" style="cursor: pointer;"><i class="mdi mdi-eye-circle font-size-18"></i></a>
                                    </td>
                                </tr>
                            @endforeach
                            @else
                            <tr>
                                <td colspan="9" class="text-center fs-5 fw-bold">No reviews</td>
                            </tr>
                        @endif
                        <div class="modal fade" id="review-detail" tabindex="-1" role="dialog" aria-labelledby="modalTitleId" aria-hidden="true">
                            <div class="modal-dialog modal-dialog-centered" role="document">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h5 class="modal-title" id="modalTitleId">Review Details</h5>
                                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                    </div>
                                    <div class="modal-body">
                                        <label class="form-label">Ratings :</label>
                                        <p class="card-text" id="star-rating">3 Stars</p>
                                        <label class="form-label">Review :</label>
                                        <p class="card-text" id="review-show">Lorem ipsum dolor sit amet, consectetur adipisicing elit. Cum ducimus commodi ratione natus modi corporis odit culpa consectetur alias optio magni dolorum quod expedita rerum, molestias non at quidem nam.</p>
                                        <label class="text-success form-label">Advantages :</label>
                                        <p class="card-text" id="advantages-show">Lorem ipsum dolor sit, amet consectetur adipisicing elit. Dolor, mollitia.</p>
                                        <label class="text-danger form-label">Flaws :</label>
                                        <p class="card-text" id="disadvantages-show">Lorem ipsum dolor sit amet.</p>
                                        <label class="form-label">Customer Name :</label>
                                        <p class="card-text" id="customer-name">Husnain</p>
                                        <label class="form-label">Customer Email :</label>
                                        <p class="card-text" id="customer-email">user@gmail.com</p>
                                        <label class="form-label">Product Name :</label>
                                        <p class="card-text" id="product-name">Konica Minolta Bizhub C266i</p>
                                        <label class="form-label">Product Sku :</label>
                                        <p class="card-text" id="product-sku">PR19KM40000</p>
                                    </div>
                                    <div class="modal-footer">
                                    </div>
                                </div>
                            </div>
                        </div>
                        <script>
                            const myModal = new bootstrap.Modal(document.getElementById('review-detail'), options)
                            console.log(myModal);
                        </script>
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
<script>
    $(document).ready(function(){
        $('.review-details').click(function() {
            $('#star-rating').text($(this).data('rating'));
            $('#review-show').text($(this).data('review'));
            $('#advantages-show').text($(this).data('advantages'));
            $('#disadvantages-show').text($(this).data('flaws'));
            $('#customer-name').text($(this).data('name'));
            $('#customer-email').text($(this).data('email'));
            $('#product-name').text($(this).data('productname'));
            $('#product-sku').text($(this).data('productsku'));
        });
    });
</script>
@endsection