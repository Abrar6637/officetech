@extends('layouts.master')

@section('title')
    Privacy Policy
@endsection

@section('css')
    <link href="{{ URL::asset('/assets/libs/admin-resources/admin-resources.min.css') }}" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.datatables.net/1.13.7/css/jquery.dataTables.css" />
    <style>
        /* Your custom CSS styles here */
    </style>
@endsection

@section('content')
    @component('components.breadcrumb')
        @slot('li_1')
            Dashboard
        @endslot
        @slot('title')
            Privacy Policy
        @endslot
    @endcomponent

    <div class="row">
        <div class="col-lg-12">
            @if (session('success') && now()->lt(session('success_expiry')))
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
                    <h5 class="card-title">Privacy Policy</h5>
                    <a href="{{ route('admin.privacy-policy.create') }}" style="float:right" class="btn btn-bg-color text-white">Add Privacy Policy</a>
                </div>
                <div class="card-body table-responsive">
                    <table class="table" id="PrivacyPolicy-Table">
                        <thead>
                            <tr>
                                <th>ID</th>
                                <th>Name</th>
                                <th>Status</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($privacyPolicies as $privacyPolicy)
                                <tr>
                                    <td>{{ $privacyPolicy->id }}</td>
                                    <td>{{ $privacyPolicy->name }}</td>
                                    <td>  @if($privacyPolicy->status == 1)
                                        <span style="color:green;">Active</span>
                                        @else
                                            <span style="color:red;">Inactive</span>
                                        @endif
                                    </td>
                                   
                                    <td>
                                        <a href="{{ route('admin.privacy-policy.edit', $privacyPolicy->id) }}" class="text-success"><i class="mdi mdi-pencil font-size-18"></i></a>
                                        <a href="{{ route('admin.privacy-policy.destroy', $privacyPolicy->id) }}" onclick="event.preventDefault(); document.getElementById('delete-form-{{ $privacyPolicy->id }}').submit();" class="text-danger"><i class="mdi mdi-delete font-size-18"></i></a>
                                        <form id="delete-form-{{ $privacyPolicy->id }}" action="{{ route('admin.privacy-policy.destroy', $privacyPolicy->id) }}" method="POST" style="display: none;">
                                            @csrf
                                            @method('DELETE')
                                        </form>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('script')
    <script src="https://code.jquery.com/jquery-3.6.4.min.js"></script>
    <script src="https://cdn.datatables.net/1.13.7/js/jquery.dataTables.js"></script>
    <!-- Add your custom scripts here -->
    <script>
        $(document).ready(function() {
            $('#PrivacyPolicy-Table').DataTable();
        });
    </script>
@endsection
