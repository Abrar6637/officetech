@extends('frontend.layout.main')
@section('title', 'Office Tech - Services')
@section('main.container')
<main class="main margin" >
    <div class="breadcrumb-container">
        <div class="container">
            <ul class="breadcrumb">
                <li><a href="/">Orders</a></li>
                <li class="slash">/</li>
                <li>Request Service</li>
            </ul>
        </div>
    </div>
    <div class="container">
        <div class="row">
            <div class="col-4 mx-auto mt-5">
                <div class="card">
                    <div class="container mt-2">
                        @if (session('success'))
                            <p class="alert alert-success">{{ session('success') }}</p>
                        @endif
                    </div>
                    <div class="card-header bg-white">
                        <p class="card-title fw-bold">Choose Service</p>
                    </div>
                    <div class="card-body">
                        <form action="{{route('request.service')}}" method="post">
                            @csrf
                            <div class="mb-3">
                                <select class="form-select in" aria-label="Default select example" id="serviceSelect" name="service_type">
                                    @foreach ($services as $service)
                                        <option value="{{$service->id}}">
                                            {{$service->name}}
                                        </option>
                                    @endforeach
                                </select>
                            </div>
                            <div style="display: none" id="servicecontractform">
                                <div class="mb-3">
                                    <label for="" class="form-label">Choose Contract Year</label>
                                    <select class="form-select in" aria-label="Default select example" name="contract_year">
                                            <option value="1">1 Year</option>
                                            <option value="2">2 Year</option>
                                    </select>
                                </div>
                                <div class="mb-3">
                                    <label for="" class="form-label">Enter item cluster no/serial No</label>
                                    <select class="form-control" name="serial_num_contract_req">
                                        <option value="" selected disabled>Select Serial Number</option>
                                        @foreach ($orders as $order)
                                            @foreach ($order->productQuantity as $productQuantity)
                                                <option value="{{ $productQuantity->serial_no }}">{{ $productQuantity->serial_no }}</option>
                                            @endforeach
                                        @endforeach
                                    </select>
                                </div>
                                <div class="mb-3">
                                    <textarea name="service_contract_details" class="form-control" cols="30" rows="10" placeholder="Enter Request Details"></textarea>
                                </div>
                            </div>
                            <div id="servicecallform">
                                <div class="mb-3">
                                    <label for="" class="form-label" data-transalate="select_issue_type">Select Issue Type</label>
                                    <select class="form-select in" aria-label="Default select example" id="" name="service_call_type">
                                        <option value="paper_jam" selected  data-transalate="paper_jam">Paper Jam</option>
                                        <option value="setup_device">Setup device</option>
                                        <option value="mehine_error">Machine error</option>
                                        <option value="service_contract">printing quality</option>
                                    </select>
                                </div>
                                <div class="mb-3">
                                    <label for="" class="form-label">Enter item cluster no/serial No</label>
                                    <select class="form-control" name="serial_number">
                                        <option value="" selected disabled>Select Serial Number</option>
                                        @foreach ($orders as $order)
                                            @foreach ($order->productQuantity as $productQuantity)
                                                <option value="{{ $productQuantity->serial_no }}">{{ $productQuantity->serial_no }}</option>
                                            @endforeach
                                        @endforeach
                                    </select>
                                </div>
                                <div class="mb-3">
                                    <textarea name="call_service_details" class="form-control" cols="30" rows="10" placeholder="Enter Request Details"></textarea>
                                </div>
                            </div>
                            <input type="hidden" value="{{Session::get('user_id')}}" name="user_id">
                            <input type="hidden" value="{{Session::get('user_email')}}" name="email">
                            <input type="hidden" value="{{$orderId}}" name="order_id">
                            <div class="mb-3">
                                <button class="btn btn-bg-color text-white">Submit</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</main>
<script src="https://code.jquery.com/jquery-3.6.4.min.js"></script>
<script>
    $(document).ready(function () {
        var serviceCallForm = $('#servicecallform');
        var serviceContractForm = $('#servicecontractform');

        // Initially hide one of the forms
        serviceContractForm.hide();
        $('#servicecontractform').find('input, select, textarea').val('');
        $('#servicecallform').find('input, select, textarea').val('');
        $('#serviceSelect').change(function () {

            var selectedText = $(this).find("option:selected").text();

            if (selectedText.trim().toLowerCase() === 'service request') {
                serviceCallForm.show();
                serviceContractForm.hide();
                $('#servicecontractform').find('input, select, textarea').val('');
            } 
            else if (selectedText.trim().toLowerCase() === 'service contract') {
                $('#servicecallform').find('input, select, textarea').val('');
                serviceContractForm.show();
                serviceCallForm.hide();
            }
        });
    });
</script>
@endsection