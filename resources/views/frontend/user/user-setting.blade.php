@extends('frontend.layout.main')
@section('title', 'Office Tech - User Setting')
@section('main.container')

    <div class="breadcrumbs">
        <div class="container">
            <div class="breadcrumbs__inner">
                <a href="/" data-translate="home">
                    Home
                </a>
                <div class="el">
                    /
                </div>
                <span data-translate="settings">
                    Settings
                </span>
            </div>
        </div>
    </div>

    <main>
        <section class="accountSettings pS account">
            <div class="container">
                <div class="accountSettings__inner account__inner">
                    <div class="account__menu">
                        <ul>
                            <li>
                                <a href="{{ route('user.orders') }}" data-translate="my_orders">
                                    My Orders
                                </a>
                            </li>
                            <li class="active">
                                <a href="#" data-translate="settings">
                                    Settings
                                </a>
                            </li>
                            <li>
                                <a href="{{ route('user.logout') }}" data-translate="logout">
                                    Logout
                                </a>
                            </li>
                        </ul>
                    </div>
                    <div class="accountSettings__from-wrapper">
                        <form action="{{ route('user.account.details.store') }}" method="post"
                            class="accountSettings__form inputSWrap">
                            @csrf
                            <h2 class="cartCheckout__title" data-translate="account_settings">
                                Account Settings
                            </h2>
                            <div class="accountSettings__form-grid-3">
                                <div class="input__wrapper">
                                    <label data-translate="display_name">Display name</label>
                                    <input type="text" name="display_name"
                                        value="{{ $user_account_details->display_name ?? '' }}">
                                        @error('display_name')
                                            <p style="color:red;">{{ $message }}</p>
                                        @enderror
                                </div>
                                <div class="input__wrapper">
                                    <label data-translate="user_name">Username</label>
                                    <input type="text" name="user_name"
                                        value="{{ $user_account_details->user_name ?? '' }}">
                                        @error('user_name')
                                            <p style="color:red;">{{ $message }}</p>
                                        @enderror
                                </div>
                                <div class="input__wrapper">
                                    <label data-translate="phone_number">Phone Number</label>
                                    <input type="text" name="phone_number"
                                        value="{{ $user_account_details->phone_number ?? '' }}">
                                    @error('phone_number')
                                        <p style="color:red;">{{ $message }}</p>
                                    @enderror
                                </div>
                            </div>
                            <div class="accountSettings__form-grid-2">
                                <div class="input__wrapper">
                                    <label data-translate="full_name">Full Name</label>
                                    <input type="text" name="full_name"
                                        value="{{ $user_account_details->full_name ?? '' }}">
                                    @error('full_name')
                                        <p style="color:red;">{{ $message }}</p>
                                    @enderror
                                </div>
                                <div class="input__wrapper">
                                    <label data-translate="email">Email</label>
                                    <input type="email" name="email" value="{{ $user_account_details->email ?? '' }}">
                                    @error('email')
                                        <p style="color:red;">{{ $message }}</p>
                                    @enderror
                                </div>
                            </div>
                            <button type="submit" class="btnHover" data-translate="save_changes">
                                Save changes
                            </button>
                        </form>
                        <form action="{{ route('user.billing.details.store') }}" method="post"
                            class="accountSettings__form inputSWrap">
                            @csrf
                            <h2 class="cartCheckout__title" data-translate="billing_settings">
                                Billing Settings
                            </h2>
                            <div class="accountSettings__form-grid-3">
                                <div class="input__wrapper">
                                    <label data-translate="first_name">First Name</label>
                                    @php
                                        $billing_first_name = '';
                                        if ($user_billing_details && is_object($user_billing_details)) {
                                            $billing_first_name = $user_billing_details->first_name ?? '';
                                        } elseif ($user_details && is_object($user_details)) {
                                            $billing_first_name = $user_details->first_name ?? '';
                                        }
                                    @endphp
                                    <input type="text" name="first_name" value="{{ $billing_first_name }}"    
                                    >
                                    @error('first_name')
                                        <p style="color:red;">{{ $message }}</p>
                                    @enderror
                                </div>
                                <div class="input__wrapper">
                                    <label data-translate="last_name">Last Name</label>
                                    @php
                                        $billing_last_name = '';
                                        if ($user_billing_details && is_object($user_billing_details)) {
                                            $billing_last_name = $user_billing_details->last_name ?? '';
                                        } elseif ($user_details && is_object($user_details)) {
                                            $billing_last_name = $user_details->last_name ?? '';
                                        }
                                    @endphp
                                    <input type="text" name="last_name" value="{{ $billing_last_name }}">
                                    @error('last_name')
                                        <p style="color:red;">{{ $message }}</p>
                                    @enderror
                                </div>
                                <div class="input__wrapper">
                                    <label data-translate="company_name">Company Name (Optional)</label>
                                    @php
                                        $billing_company_name = '';
                                        if ($user_billing_details && is_object($user_billing_details)) {
                                            $billing_company_name = $user_billing_details->company_name ?? '';
                                        } elseif ($user_details && is_object($user_details)) {
                                            $billing_company_name = $user_details->company_name ?? '';
                                        }
                                    @endphp
                                    <input type="text" name="company_name" value="{{ $billing_company_name }}">
                                    @error('company_name')
                                        <p style="color:red;">{{ $message }}</p>
                                    @enderror
                                </div>
                            </div>
                            <div class="input__wrapper">
                                <label data-translate="address">Address</label>
                                @php
                                    $billing_address = '';
                                    if ($user_billing_details && is_object($user_billing_details)) {
                                        $billing_address = $user_billing_details->address ?? '';
                                    } elseif ($user_details && is_object($user_details)) {
                                        $billing_address = $user_details->address ?? '';
                                    }
                                @endphp
                                <input type="text" name="address" value="{{ $billing_address }}">
                                @error('address')
                                    <p style="color:red;">{{ $message }}</p>
                                @enderror
                            </div>
                            <div class="accountSettings__form-grid-4">
                                <div class="input__wrapper">
                                    <label data-translate="country">Country</label>
                                    @php
                                        $billing_country = '';
                                        if ($user_billing_details && is_object($user_billing_details)) {
                                            $billing_country = $user_billing_details->country ?? '';
                                        } elseif ($user_details && is_object($user_details)) {
                                            $billing_country = $user_details->country ?? '';
                                        }
                                    @endphp
                                    <div class="select">
                                        <select name="country">
                                            <option data-translate="select">
                                                Select...
                                            </option>
                                            @foreach ($countries as $country)
                                                <option value="{{ $country->name }}"
                                                    {{ $billing_country == $country->name || $country->is_default_country == '1' ? 'selected' : '' }}>
                                                    {{ $country->name }}
                                                </option>
                                            @endforeach
                                        </select>
                                    </div>
                                    @error('country')
                                        <p style="color:red;">{{ $message }}</p>
                                    @enderror
                                </div>
                                <div class="input__wrapper">
                                    <label data-translate="region/state">Region/State</label>
                                    @php
                                        $billing_region = '';
                                        if ($user_billing_details && is_object($user_billing_details)) {
                                            $billing_region = $user_billing_details->region ?? '';
                                        } elseif ($user_details && is_object($user_details)) {
                                            $billing_region = $user_details->region_state ?? '';
                                        }
                                    @endphp
                                    <div class="select">
                                        <select name="region">
                                            <option value="Select..." data-translate="select" option>
                                                Select...
                                            </option>
                                            @foreach ($regions as $region)
                                                <option value="{{ $region->name }}"
                                                    {{ $billing_region === $region->name ? 'selected' : '' }}>
                                                    {{ $region->name }}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                    @error('region')
                                        <p style="color:red;">{{ $message }}</p>
                                    @enderror
                                </div>
                                <div class="input__wrapper">
                                    <label data-translate="vat_reg_no">VAT Reg. No.</label>
                                    @php
                                        $billing_vat_reg_no = '';
                                        if ($user_billing_details && is_object($user_billing_details)) {
                                            $billing_vat_reg_no = $user_billing_details->vat_reg_no ?? '';
                                        } elseif ($user_details && is_object($user_details)) {
                                            $billing_vat_reg_no = $user_details->vat_reg_no ?? '';
                                        }
                                    @endphp
                                    <input type="text" name="vat_reg_no" value="{{ $billing_vat_reg_no }}">
                                    @error('vat_reg_no')
                                        <p style="color:red;">{{ $message }}</p>
                                    @enderror
                                </div>
                                <div class="input__wrapper">
                                    <label data-translate="cr_company_reg_no">CR -Company Reg. No.</label>
                                    @php
                                        $billing_cr_no = '';
                                        if ($user_billing_details && is_object($user_billing_details)) {
                                            $billing_cr_no = $user_billing_details->cr_no ?? '';
                                        } elseif ($user_details && is_object($user_details)) {
                                            $billing_cr_no = $user_details->company_reg_no ?? '';
                                        }
                                    @endphp
                                    <input type="text" name="cr_no" value="{{ $billing_cr_no }}">
                                    @error('cr_no')
                                        <p style="color:red;">{{ $message }}</p>
                                    @enderror
                                </div>
                            </div>
                            <div class="accountSettings__form-grid-3">
                                <div class="input__wrapper">
                                    <label data-translate="account_manager">Account Manager</label>
                                    @php
                                        $billing_account_manager = '';
                                        if ($user_billing_details && is_object($user_billing_details)) {
                                            $billing_account_manager = $user_billing_details->account_manager ?? '';
                                        } elseif ($user_details && is_object($user_details)) {
                                            $billing_account_manager = $user_details->account_manager ?? '';
                                        }
                                    @endphp
                                    <div class="select">
                                        <select name="account_manager">
                                            @foreach ($account_manager as $manager)
                                                <option value="{{ $manager->name }}"
                                                    {{ $billing_account_manager === $manager->name || $manager->is_default_manager == '1' ? 'selected' : '' }}>
                                                    {{ $manager->name }}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                    @error('account_manager')
                                        <p style="color:red;">{{ $message }}</p>
                                    @enderror
                                </div>
                                <div class="input__wrapper">
                                    <label data-translate="email">Email</label>
                                    @php
                                        $billing_email = '';
                                        if ($user_billing_details && is_object($user_billing_details)) {
                                            $billing_email = $user_billing_details->email ?? '';
                                        } elseif ($user_details && is_object($user_details)) {
                                            $billing_email = $user_details->email ?? '';
                                        }
                                    @endphp
                                    <input type="email" name="billing_email" value="{{ $billing_email }}">
                                    @error('billing_email')
                                        <p style="color:red;">{{ $message }}</p>
                                    @enderror
                                </div>
                                <div class="input__wrapper">
                                    <label data-translate="phone_number">Phone Number</label>
                                    @php
                                        $billing_phone_number = '';
                                        if ($user_billing_details && is_object($user_billing_details)) {
                                            $billing_phone_number = $user_billing_details->phone_number ?? '';
                                        } elseif ($user_details && is_object($user_details)) {
                                            $billing_phone_number = $user_details->phone_number ?? '';
                                        }
                                    @endphp
                                    <input type="text" name="billing_phone_number"
                                        value="{{ $billing_phone_number }}">
                                    @error('billing_phone_number')
                                        <p style="color:red;">{{ $message }}</p>
                                    @enderror
                                </div>
                            </div>
                            <button type="submit" class="btnHover" data-translate="save_changes">
                                Save changes
                            </button>
                        </form>
                        @php
                            $user_id = Session::get('user_id');
                        @endphp
                        <form action="{{ route('change.password', $user_id) }}" method="post"
                            class="accountSettings__form inputSWrap">
                            @csrf
                            @if (session('error'))
                                <p style="color:red;">{{ session('error') }}</p>
                            @endif
                            @if (session('success'))
                                <p style="color:green;">{{ session('success') }}</p>
                            @endif
                            <h2 class="cartCheckout__title" data-translate="change_password">
                                Change Password
                            </h2>
                            <div class="input__wrapper">
                                <label data-translate="current_password">Current Password</label>
                                <input type="text" name="current_password" placeholder="Current Password">
                            </div>
                            @error('current_password')
                                <p style="color:red;">{{ $message }}</p>
                            @enderror
                            <div class="input__wrapper">
                                <label data-translate="new_password">New Password</label>
                                <input type="text" name="new_password" placeholder="New Password">
                            </div>
                            @error('new_password')
                                <p style="color:red;">{{ $message }}</p>
                            @enderror
                            <div class="input__wrapper">
                                <label data-translate="c_password">Confirm Password</label>
                                <input type="text" name="confirm_password" placeholder="Confirm New Password">
                            </div>
                            @error('confirm_password')
                                <p style="color:red;">{{ $message }}</p>
                            @enderror
                            <button type="submit" class="btnHover" data-translate="save_changes">
                                Save changes
                            </button>
                        </form>
                    </div>
                </div>
            </div>
        </section>
    </main>

@endsection
