<style>
    .btn-bg-color {
        background-color: #76E5A9 !important;
        color: #03045E !important;
        border-radius: 5px;
        font-weight: 700;
        font-size: 15px;
    }

    .upload__btn {
        background-color: #CAF0F8 !important;
        color: #03045E !important;
        border: none !important;
        border-radius: 5px;
        font-weight: 700;
        font-size: 15px;
    }

    body[data-topbar="dark"] #page-topbar {
        background-color: #03045E !important;
    }

    .fa-bars {
        color: #ffffff !important;
        font-size: 20px
    }

    .logo-lg img {
        width: 200px;
        filter: brightness(0) invert(1);
    }

    .logo-sm img {
        filter: brightness(0) invert(1);
    }

    .mm-active .active,
    .mm-active .active i,
    .mm-active .active svg,
    .mm-active>a,
    .mm-active>a i,
    .mm-active>a svg,
    .mm-active>i {
        color: #03045E !important;
    }
    .btn-styling{
        background-color: #03045E !important;
        border-color: #03045E !important;
    }
</style>
<header id="page-topbar" class="border-0">
    <div class="navbar-header ">
        <div class="d-flex">
            <!-- LOGO -->
            <div style="background-color: #03045E" class="navbar-brand-box  border-0">
                <a href="{{route('admin.dashboard')}}" class="logo logo-dark">
                    <span class="logo-sm ">
                        <img src="{{ URL::asset('updated-assets/images/logo.svg') }}" alt="" height="50"
                            width="60">
                    </span>
                    <span class="logo-lg ">
                        <img src="{{ URL::asset('updated-assets/images/logo.svg') }}" alt="" height="54"
                            width="60">
                    </span>
                </a>

                <a href="{{route('admin.dashboard')}}" class="logo logo-light">
                    <span class="logo-sm ">
                        <img src="{{ URL::asset('updated-assets/images/logo.svg') }}" alt="" height="50"
                            width="60">
                    </span>
                    <span class="logo-lg">
                        <img src="{{ URL::asset('updated-assets/images/logo.svg') }}" alt="" height="54"
                            width="60">
                    </span>
                </a>
            </div>

            <button type="button" class="btn btn-sm px-3 font-size-16 header-item" id="vertical-menu-btn"
                style="margin-left:15px">
                <i class="fa fa-fw fa-bars" id="menu-bar-show"></i>
            </button>

            <!-- App Search-->
            <!-- <form class="app-search d-none d-lg-block">
                <div class="position-relative">
                    <input type="text" class="form-control" placeholder="Search...">
                    <button class="btn btn-bg-color text-white" type="button"><i
                            class="bx bx-search-alt align-middle"></i></button>
                </div>
            </form> -->
        </div>

        <div class="d-flex">

            <div class="dropdown d-inline-block d-lg-none ms-2">
                <button type="button" class="btn header-item" id="page-header-search-dropdown"
                    data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                    <i data-feather="search" class="icon-lg"></i>
                </button>
                <div class="dropdown-menu dropdown-menu-lg dropdown-menu-end p-0"
                    aria-labelledby="page-header-search-dropdown">

                    <form class="p-3">
                        <div class="form-group m-0">
                            <div class="input-group">
                                <input type="text" class="form-control" placeholder="Search ..."
                                    aria-label="Search Result">

                                <button class="btn btn-bg-color" type="submit"><i class="mdi mdi-magnify"></i></button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>


            <div class="dropdown d-none d-sm-inline-block">
                <button type="button" class="btn header-item" id="mode-setting-btn" style="display: none;">
                    <i data-feather="moon" class="icon-lg layout-mode-dark"></i>
                    <i data-feather="sun" class="icon-lg layout-mode-light"></i>
                </button>
            </div>
            <div class="dropdown d-inline-block">
                <button type="button" class="btn header-item bg-soft-light border-start border-end"
                    id="page-header-user-dropdown" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                    <img class="rounded-circle header-profile-user" src="{{ url('images/avatar-1.JPG') }}"
                        alt="Header Avatar">
                    <span class="d-none d-xl-inline-block ms-1 fw-medium">
                        <span class="d-none d-xl-inline-block ms-1 fw-medium">
                            @if (auth()->guard('admin')->check())
                                @php
                                    $adminName = auth()
                                        ->guard('admin')
                                        ->user()->name;
                                @endphp

                                @if ($adminName)
                                    {{ $adminName }}
                                @else
                                    <script>
                                        window.location = "{{ route('admin.login') }}";
                                    </script>
                                @endif
                            @else
                                <script>
                                    window.location = "{{ route('admin.login') }}";
                                </script>
                            @endif
                        </span>
                    </span>
                    <i class="mdi mdi-chevron-down d-none d-xl-inline-block"></i>
                </button>
                <div class="dropdown-menu dropdown-menu-end">
                    <!-- item-->
                    <div class="dropdown-divider"></div>
                    <a class="dropdown-item" href="{{ route('admin.logout') }}">
                        <i class="bx bx-power-off font-size-16 align-middle me-1"></i> <span
                            key="t-logout">@lang('translation.Logout')</span>
                    </a>
                    <a id="change-username-btn" class="dropdown-item" href="#">
                        <i class="bx bx-user font-size-16 align-middle me-1"></i> Change Username
                    </a>
                    <a id="change-password-btn" class="dropdown-item" href="#">
                            <i class="bx bx-lock font-size-16 align-middle me-1"></i> Change Password
                        </a>
                </div>

            </div>

        </div>
    </div>
</header>
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@10"></script>
<script>
    $(document).ready(function(){
        $('#menu-bar-show').click(function(){
        $('.pace-done').toggleClass('sidebar-enable');
        if ($('.pace-done').hasClass('sidebar-enable')) {
                $('.pace-done').attr('data-sidebar-size', 'sm');
            } else {
                $('.pace-done').attr('data-sidebar-size', 'lg');
            }
        });
    });
    $(document).on('click', '#change-password-btn', function() {
        Swal.fire({
            title: 'Change Password',
            html:
                '<input id="old-password" class="swal2-input" type="text" placeholder="Old Password">' +
                '<input id="new-password" class="swal2-input" type="text" placeholder="New Password">' +
                '<input id="confirm-password" class="swal2-input" type="text" placeholder="Confirm New Password">',
            showCancelButton: true,
            confirmButtonText: 'Change',
            showLoaderOnConfirm: true,
            preConfirm: () => {
                const oldPassword = Swal.getPopup().querySelector('#old-password').value;
                const newPassword = Swal.getPopup().querySelector('#new-password').value;
                const confirmPassword = Swal.getPopup().querySelector('#confirm-password').value;
                return $.ajax({
                    url: '{{ route("admin.change.password") }}',
                    type: 'POST',
                    data: {
                        '_token': '{{ csrf_token() }}',
                        'old_password': oldPassword,
                        'password': newPassword,
                        'password_confirmation': confirmPassword
                    }
                });
            }
        }).then((result) => {
            if (result.value.success) {
                Swal.fire({
                    title: 'Success!',
                    text: result.value.message,
                    icon: 'success',
                    onClose: function() {
                        location.reload(); 
                    }
                });
            } else {
                Swal.fire('Error!', result.value.message, 'error');
            }
        });
    });

    $(document).on('click', '#change-username-btn', function() {
        Swal.fire({
            title: 'Change Username',
            html:
                '<input id="old-username" class="swal2-input" type="text" placeholder="Old Username">' +
                '<input id="new-username" class="swal2-input" type="text" placeholder="New Username">' ,
            showCancelButton: true,
            confirmButtonText: 'Change',
            showLoaderOnConfirm: true,
            preConfirm: () => {
                const oldUsername = Swal.getPopup().querySelector('#old-username').value;
                const newUsername = Swal.getPopup().querySelector('#new-username').value;
                return $.ajax({
                    url: '{{ route("admin.change.username") }}',
                    type: 'POST',
                    data: {
                        '_token': '{{ csrf_token() }}',
                        'old_username': oldUsername,
                        'new_username': newUsername,
                    }
                });
            }
        }).then((result) => {
            if (result.value.success) {
                Swal.fire({
                    title: 'Success!',
                    text: result.value.message,
                    icon: 'success',
                    onClose: function() {
                        location.reload(); 
                    }
                });
            } else {
                Swal.fire('Error!', result.value.message, 'error');
            }
        });
    });

</script>
