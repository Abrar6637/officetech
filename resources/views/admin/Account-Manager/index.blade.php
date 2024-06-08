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
            Account Managers !
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
        <div class="col-lg-8">
            <div class="card" style="overflow-x: auto;">
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
                    <h5 class="card-title">Account Managers</h5>
                </div>
                <div class="card-body">
                    <table class="table">
                        <thead>
                            <tr>
                                <th>ID</th>
                                <th scope="col">Name</th>
                                <th scope="col">Email</th>
                                <th scope="col">Phone Number</th>
                                <th scope="col">Status</th>
                                <th scope="col">Actions</th>
                            </tr>
                        </thead>
                        <tbody>
                            @if ($managers->count() > 0)                                
                                @foreach ($managers as $manager)
                                    <tr>  
                                        <td style="width: 50px;">{{$loop->index + 1}}</td>
                                        @if ($manager->is_default_manager ==1)
                                            <td class="text-success">{{$manager->name}}</td>
                                        @else
                                            <td>{{$manager->name}}</td>
                                        @endif
                                        <td>{{$manager->email}}</td>
                                        <td>{{$manager->phone}}</td>
                                        @if ($manager->status == 0)
                                            <td class="text-warning">Inactive</td>
                                        @else
                                            <td class="text-success">Active</td>
                                        @endif
                                        <td>
                                            <a href="{{route('edit.account.manager',$manager->id)}}" class="text-success">
                                                <i class="mdi mdi-pencil font-size-18"></i>
                                            </a>
                                            <a href="{{ route('delete.account.manager', $manager->id) }}" class="text-danger delete-link" data-id="{{ $manager->id }}">
                                                <i class="mdi mdi-delete font-size-18"></i>
                                            </a>
                                        </td>
                                    </tr>
                                @endforeach
                                @else
                                <td colspan="6" class="text-center fs-5 fw-bold">No Managers</td>        
                            @endif
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
        <div class="col-lg-4">
            <div class="card">
                <div class="card-header">
                    <h5 class="card-title">Create Account Manager</h5>
                </div>
                <div class="card-body">
                    <form action="{{route('store.account.manager')}}" method="post">
                        @csrf
                        <div class="mb-3">
                            <label for="example-text-input" class="form-label">Manager Name</label>
                            <input class="form-control" type="text" name="name" id="" placeholder="Name" value="{{old('name')}}">
                        </div>
                        @error('name')
                            <p class="alert alert-danger">{{$message}}</p>
                        @enderror
                        <div class="mb-3">
                            <label class="form-label">Email</label>
                            <input class="form-control" type="text" name="email" id="" placeholder="Email" value="{{old('email')}}">
                        </div>
                        @error('email')
                            <p class="alert alert-danger">{{$message}}</p>
                        @enderror
                        <div class="mb-3">
                            <label class="form-label">Phone Number</label>
                            <input class="form-control" type="number" placeholder="Phone Number" name="phone" value="{{old('phone')}}">
                        </div>
                        @error('phone')
                            <p class="alert alert-danger">{{$message}}</p>
                        @enderror
                        <div class="mb-3">
                            <div class="form-check">
                                <input class="form-check-input" type="checkbox" name="default_manager" id="default_manager" {{ old('default_manager') ? 'checked' : '' }}>
                                <label class="form-check-label" for="default_manager">Default Manager </label>
                            </div>
                            <div id="replaceWarning" class="text-danger" style="display: none;">
                                If You already have a Default Manager. Selecting a new one will replace the existing Default Manager.
                            </div>
                        </div>
                        <div class="mb-3">
                            <label class="form-label">Status</label>
                            <select class="form-select" name="status">
                                <option value="0">Inactive</option>
                                <option value="1">Active</option>
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
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@10"></script>
    <script>
    $(document).ready(function() {
        function toggleReplaceWarning() {
            var isChecked = $('#default_manager').prop('checked');
            $('#replaceWarning').toggle(isChecked);
        }
        toggleReplaceWarning();
        $('#default_manager').on('change', function() {
            toggleReplaceWarning();
        });
    });
</script>
<script>
    document.querySelectorAll('.delete-link').forEach(function(link) {
        link.addEventListener('click', function(e) {
            e.preventDefault();
            var managerId = this.getAttribute('data-id');
            Swal.fire({
                title: 'Are you sure?',
                text: 'You won\'t be able to revert this!',
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#d33',
                cancelButtonColor: '#3085d6',
                confirmButtonText: 'Yes, delete it!'
            }).then((result) => {
                if (result.isConfirmed) {
                    window.location.href = "{{ route('delete.account.manager', ['id' => ':id']) }}".replace(':id', managerId);
                }
            });
        });
    });
</script>
@endsection
