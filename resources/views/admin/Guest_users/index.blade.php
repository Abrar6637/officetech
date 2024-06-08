@extends('layouts.master')
@section('title')
    @lang('Users')
@endsection
@section('css')
    <link href="{{ URL::asset('/assets/libs/admin-resources/admin-resources.min.css') }}" rel="stylesheet">
    <link href="{{ URL::asset('assets/libs/dropzone/dropzone.min.css') }}" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.datatables.net/1.13.7/css/jquery.dataTables.css" />
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
                    <h5 class="card-title">Users</h5>
                        <a href="{{ route('user.guest-user.create') }}" style="float:right" class="btn btn-bg-color text-white">Add Guest User</a>  
                </div>
                <div class="card-body table-responsive">
                    <table class="table" id="GuestUsers-Table">
                        <thead>
                            <tr>
                                <th>ID</th>
                                <th scope="col">Email</th>
                                <th scope="col">Status</th>
                                <th scope="col">Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            @if ($guest_users->count() > 0)                                
                                @foreach ($guest_users as $guest_user)
                                    <tr>  
                                        <td style="width: 50px;">{{$loop->index + 1}}</td>
                                        <td>{{$guest_user->email}}</td>
                                        <td>
                                            @if($guest_user->status == 1)
                                                Active
                                            @else
                                                Inactive
                                            @endif
                                        </td>

                                        <td>
                                            <a href="{{ route('user.guest-user.edit', $guest_user->id) }}" class="text-success">
                                                <i class="mdi mdi-pencil font-size-18"></i>
                                            </a>
                                            <form action="{{ route('user.guest-user.destroy', $guest_user->id) }}" method="POST" id="delete-form-{{ $guest_user->id }}">
                                                @csrf
                                                <a href="#" class="text-danger delete-link" data-id="{{ $guest_user->id }}">
                                                    <i class="mdi mdi-delete font-size-18"></i>
                                                </a>
                                            </form>
                                        </td>

                                    </tr>
                                @endforeach
                                @else
                                <td colspan="6" class="text-center fs-5 fw-bold">No Guest</td>        
                            @endif
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
    <script src="{{ URL::asset('/assets/libs/apexcharts/apexcharts.min.js') }}"></script>
    <script src="{{ URL::asset('/assets/libs/admin-resources/admin-resources.min.js') }}"></script>
    <script src="{{ URL::asset('assets/libs/dropzone/dropzone.min.js') }}"></script>
    <script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>
    <script>
        $(document).ready(function () {
            $('#GuestUsers-Table').DataTable();
            $('.delete-link').click(function (event) {
                event.preventDefault();
                var id = $(this).data('id');
                swal({
                    title: "Are you sure?",
                    text: "Once deleted, you will not be able to recover this guest user!",
                    icon: "warning",
                    buttons: true,
                    dangerMode: true,
                })
                .then((willDelete) => {
                    if (willDelete) {
                        $('#delete-form-' + id).submit();
                    } else {
                        swal("Your guest user is safe!");
                    }
                });
            });
        });
    </script>
@endsection
