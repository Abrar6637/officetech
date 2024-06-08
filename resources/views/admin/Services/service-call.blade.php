@extends('layouts.master')
@section('title')
@lang('Service Call')
@endsection
@section('css')
    <!-- Include your CSS if needed -->
@endsection
@section('content')
    @component('components.breadcrumb')
        @slot('li_1')
            Dashboard
        @endslot
        @slot('title')
             Services Call
        @endslot
    @endcomponent

    <div class="row">
        <div class="col-lg-12">
            <div class="card" style="overflow-x: auto;">
                <div class="card-header">
                    @if (Session::has('success'))
                        <p class="alert alert-success">{{ Session::get('success') }}</p>
                    @endif
                    <h5 class="card-title">Service Call Requests</h5>
                </div>
                <div class="card-body">
                    <table class="table">
                        <thead>
                            <tr>
                                <th>ID</th>
                                <th scope="col">User Name</th>
                                <th scope="col">Contact Number</th>
                                <th scope="col">Email</th>
                                <th scope="col">Service Name</th>
                                <th scope="col">Service Call Type</th>
                                <th scope="col">Cluster</th>
                                <th scope="col">Details</th>
                                <th scope="col">Product SKU's</th>
                                <th scope="col">Order No</th>
                                <th scope="col">Status</th>
                                <th colspan="2" class="text-center">Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            @if ($ServicesCall->count() > 0)    
                                @foreach ($ServicesCall as $service)
                                <tr>
                                    <td>{{$loop->index + 1}}</td>
                                    <td>{{$service->user->name}}</td>
                                    <td>{{$service->order->customer->phone_number}}</td>
                                    <td>{{$service->order->customer->email}}</td>
                                    <td>{{$service->service->name}}</td>
                                    <td>{{$service->service_call_type}}</td>
                                    <td>{{$service->serial_num_call_req}}</td>
                                    <td>{{$service->service_call_description}}</td>
                                    <td>
                                        <ol>
                                            @foreach ($service->order->productQuantity as $product)
                                                <li>{{$product->product->sku}}</li>
                                            @endforeach
                                        </ol>
                                    </td>
                                    <td>{{$service->order->order_number}}</td>
                                    @if ($service->status == '1')
                                        <td class="text-success">Approved</td>
                                    @else
                                    <td class="text-warning">Pending</td>
                                    @endif
                                    <td colspan="2" class="text-center">
                                        <div class="dropdown">
                                            <button class="btn btn-secondary dropdown-toggle" type="button" id="dropdownMenuButton1" data-bs-toggle="dropdown" aria-expanded="false">
                                              Options
                                            </button>
                                            <ul class="dropdown-menu" aria-labelledby="dropdownMenuButton1">
                                              <li><a class="dropdown-item" href="{{route('update.service.call.request', ['id' => $service->id]) }}">Approve</a></li>
                                              <li><a class="dropdown-item" href="{{ route('update.service.call.request', ['id' => $service->id]) }}">Decline</a></li>
                                              <li><a class="dropdown-item" href="{{ route('delete.service.call.request', ['id' => $service->id]) }}" onclick="return confirm('Are you sure you want to delete this main category?')">Delete</a></li>
                                            </ul>
                                        </div>
                                    </td>
                                </tr>
                                @endforeach
                                @else
                                <tr>
                                    <td colspan="11" class="text-center fw-bold fs-5">No Call Requests</td>
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
@endsection
