@extends('frontend.layout.main')
@section('title', 'Office Tech - User Setting')
@section('main.container')
    <main class="main margin">
        <div class="breadcrumb-container">
            <div class="container">
                <ul class="breadcrumb">
                    <li><a href="/">Home</a></li>
                    <li class="slash">/</li>
                    <li>User Setting</li>
                </ul>
            </div>
        </div>
        {{-- @dd($user_details) --}}
        <div class="container text-center mt-4 section-top">
            <div class="row">
                <div class="col-md-3 col-12 text-start">
                    <div class="d-flex flex-row flex-md-column gap-5 gap-md-0">
                        <a href="{{route('user.orders')}}" class="font-size:18px fw-bold text-black">My Orders</a>
                        <a href="{{ route('user.user_setting') }}" class="text-danger fw-bold">Setting</a>
                        <a href="{{ route('user.logout') }}" class="fw-bold text-black">Logout</a>
                    </div>
                </div>
                <div class="col-md-9 col-12 d-flex flex-column gap-5  bg-white p-4 mb-5">
                    <div class="div">
                        @if (session('success'))
                            <div class="alert alert-success" role="alert">
                                {{ session('success') }}
                            </div>
                        @endif
                        <form action="{{ route('user.account.details.store') }}" method="POST">
                            @csrf
                            <h1 class="text-start fw-bold pb-3 d-flex flex-column " style="font-size:28px">Account Settings
                            </h1>

                            <div class="col-lg-10 col-12 row">
                                <div class="col-md-4 col-12 d-flex flex-column gap-4">
                                    <div class="d-flex flex-column gap-2">
                                        <label for="" class="text-start d-flex gap-2">Display name<span
                                                class="text-danger">*</span></label>
                                        <input type="text" class="w-100 border-0 in px-2" name="display_name"
                                            placeholder="Name" style="height:35px; background-color:#F3F6F8"
                                            value="{{ $user_account_details->display_name ?? '' }}">
                                    </div>
                                    @error('display_name')
                                        <p class="text-danger">{{$message}}</p>
                                    @enderror
                                    <div class="d-flex flex-column gap-2">
                                        <label for="" class="text-start d-flex gap-2">Full Name<span
                                                class="text-danger  ">*</span></label>
                                        <input type="text" class="w-100 border-0 in px-2" name="full_name"
                                            placeholder="Name" style="height:35px; background-color:#F3F6F8"
                                            value="{{ $user_account_details->full_name ?? '' }}">
                                    </div>
                                    @error('full_name')
                                        <p class="text-danger">{{$message}}</p>
                                    @enderror
                                </div>
                                <div class="col-md-4 col-12  d-flex flex-column gap-4" s>
                                    <div class="d-flex flex-column gap-2 ">
                                        <label for="" class="text-start mt-3 mt-sm-0 d-flex gap-2">Username<span
                                                class="text-danger">*</span></label>
                                        <input type="text" class="w-100 border-0 in px-2" name="user_name"
                                            placeholder="Name" style="height:35px; background-color:#F3F6F8"
                                            value="{{ $user_account_details->user_name ?? '' }}">
                                    </div>
                                    @error('user_name')
                                        <p class="text-danger">{{$message}}</p>
                                    @enderror
                                    <div class="d-flex flex-column gap-2">
                                        <label for="" class="text-start d-flex gap-2">Email<span
                                                class="text-danger">*</span></label>
                                        <input type="text" class="w-100 border-0 in px-2"
                                            placeholder="zain.tariq559@gmail.com" name="email"
                                            style="height:35px; background-color:#F3F6F8"
                                            value="{{ $user_account_details->email ?? '' }}">
                                    </div>
                                    @error('email')
                                    <p class="text-danger">{{$message}}</p>
                                    @enderror
                                </div>
                                <div class="col-md-4 col-12 ">
                                    <div class="d-flex flex-column gap-2">
                                        <label for="" class="text-start mt-3 mt-sm-0 d-flex gap-2">Phone Number<span
                                                class="text-danger  ">*</span></label>
                                        <input type="text" class="w-100 border-0 in px-2" name="phone_number"
                                            placeholder="+919111111" style="height:35px; background-color:#F3F6F8"
                                            value="{{ $user_account_details->phone_number ?? '' }}">
                                    </div>
                                    @error('phone_number')
                                    <p class="text-danger">{{$message}}</p>
                                    @enderror
                                </div>
                            </div>
                            <div class="d-flex justify-content-start mt-5">
                                <button class=" text-white"
                                    style="height:37px ; border-radius:20px; width:207px; border:none;  margin-top:10px; background-color:#da5858">Save
                                    changes
                                </button>
                            </div>
                        </form>
                    </div>
                    <div class="div">
                        <form action="{{ route('user.billing.details.store') }}" method="POST">
                            @csrf
                            <h1 class="text-start fw-bold pb-3" style="font-size:28px">Billing Settings</h1>
                            <div class="d-flex flex-column gap-md-5">
                                <div class="col-lg-10 row gy-3">
                                    <div class="col-md-4 col-12">
                                        <div class="d-flex flex-column gap-2">
                                            <label for="" class="text-start d-flex gap-2">First Name<span class="text-danger">*</span></label>
                                            @php
                                                $billing_first_name = '';
                                                if ($user_billing_details && is_object($user_billing_details)) {
                                                    $billing_first_name = $user_billing_details->first_name ?? '';
                                                } elseif ($user_details && is_object($user_details)) {
                                                    $billing_first_name = $user_details->first_name ?? '';
                                                }
                                            @endphp
                                            <input type="text" class="border-0 in px-2" placeholder="First Name" name="first_name" style="height:35px; background-color:#F3F6F8; " value="{{$billing_first_name}}">
                                        </div>
                                        @error('first_name')
                                            <div class="text-danger">{{$message}}</div>
                                        @enderror
                                    </div>
                                    <div class="col-md-4 col-12">
                                        <div class="d-flex flex-column gap-2">
                                            <label for="" class="text-start mt-3 mt-sm-0 d-flex gap-2">Last
                                                Name<span class="text-danger  ">*</span></label>
                                                @php
                                                    $billing_last_name = '';
                                                    if ($user_billing_details && is_object($user_billing_details)) {
                                                        $billing_last_name = $user_billing_details->last_name ?? '';
                                                    } elseif ($user_details && is_object($user_details)) {
                                                        $billing_last_name = $user_details->last_name ?? '';
                                                    }
                                                @endphp
                                            <input type="text" class=" border-0 in px-2" placeholder="Last Name" name="last_name" style="height:35px; background-color:#F3F6F8; " value="{{$billing_last_name}}">
                                        </div>
                                        @error('last_name')
                                            <div class="text-danger">{{$message}}</div>
                                        @enderror
                                    </div>
                                    <div class="col-md-4 col-12">
                                        <div class="d-flex flex-column gap-2">
                                            <label for="" class="text-start mt-3 mt-sm-0">Company Name
                                                (Optional)</label>
                                                @php
                                                    $billing_company_name = '';
                                                    if ($user_billing_details && is_object($user_billing_details)) {
                                                        $billing_company_name = $user_billing_details->company_name ?? '';
                                                    } elseif ($user_details && is_object($user_details)) {
                                                        $billing_company_name = $user_details->company_name ?? '';
                                                    }
                                                @endphp
                                            <input type="text" class=" border-0 in px-2" placeholder="Company Name"
                                                name="company_name"
                                                style="height:35px; background-color:#F3F6F8; "  value="{{ $billing_company_name }}">
                                        </div>
                                    </div>
                              
                                <div class=" col-12 ">
                                    <div class="d-flex flex-column gap-2">
                                        <label for="" class="text-start d-flex gap-2">Address<span
                                                class="text-danger">*</span></label>
                                                @php
                                                    $billing_address = '';
                                                    if ($user_billing_details && is_object($user_billing_details)) {
                                                        $billing_address = $user_billing_details->address ?? '';
                                                    } elseif ($user_details && is_object($user_details)) {
                                                        $billing_address = $user_details->address ?? '';
                                                    }
                                                @endphp
                                        <input type="text" class=" border-0 in px-2" placeholder="Address"
                                            name="address" style="height:35px; background-color:#F3F6F8 ; " value="{{ $billing_address }}">
                                    </div>
                                    @error('address')
                                        <div class="text-danger mt-2">{{$message}}</div>
                                    @enderror
                                </div>
                                <div class="col-md-3 col-12 ">
                                    <div class="d-flex flex-column gap-2">
                                        @php
                                            $billing_country = '';
                                            if ($user_billing_details && is_object($user_billing_details)) {
                                                $billing_country = $user_billing_details->country ?? '';
                                            } elseif ($user_details && is_object($user_details)) {
                                                $billing_country = $user_details->country ?? '';
                                            }
                                        @endphp
                                        <label for="" class="text-start d-flex gap-2">Country<span
                                            class="text-danger  ">*</span></label>
                                            <select class="form-select border-0 bg-input rounded-0" name="country" aria-label="Default select example" style="height:35px">
                                                <option selected>Select...</option>
                                                @foreach ($countries as $country)
                                                <option value="{{$country->name}}" {{ ($billing_country == $country->name || $country->is_default_country == '1') ? 'selected' : '' }}>
                                                    {{$country->name}}
                                                    </option>
                                                @endforeach
                                            </select>
                                    </div>
                                </div>
                                    @error('country')
                                    <div class="text-danger">{{$message}}</div>
                                    @enderror
                                    <div class="col-md-3 col-12  ">
                                        <div class="d-flex flex-column gap-2">
                                            <label for="" class="text-start d-flex gap-2">Region/State<span
                                                class="text-danger">*</span>
                                            </label>
                                            @php
                                                $billing_region = '';
                                                if ($user_billing_details && is_object($user_billing_details)) {
                                                    $billing_region = $user_billing_details->region ?? '';
                                                } elseif ($user_details && is_object($user_details)) {
                                                    $billing_region = $user_details->region_state ?? '';
                                                }
                                            @endphp
                                            <select class="form-select border-0 bg-input rounded-0" name="region" aria-label="Default select example" style="height:35px">
                                                <option disabled>Select...</option>
                                                @foreach ($regions as $region)
                                                    <option value="{{$region->name}}" {{ ($billing_region === $region->name) ? 'selected' : '' }}>{{$region->name}}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                    </div>
                                    @error('region')
                                        <div class="text-danger">{{$message}}</div>
                                    @enderror
                                    <div class="col-md-3 col-12 ">
                                        <div class="d-flex flex-column gap-2">
                                            @php
                                            $billing_cr_no = '';
                                            if ($user_billing_details && is_object($user_billing_details)) {
                                                $billing_cr_no = $user_billing_details->cr_no ?? '';
                                            } elseif ($user_details && is_object($user_details)) {
                                                $billing_cr_no = $user_details->company_reg_no ?? '';
                                            }
                                        @endphp                                        
                                            <label for="" class="text-start d-flex gap-2">CR No.<span
                                                    class="text-danger  ">*</span></label>
                                            <input type="text" class="w-100 border-0 in px-2" placeholder="Reg No."
                                                name="cr_no" style="height:35px; background-color:#F3F6F8" value="{{ $billing_cr_no }}" >
                                        </div>
                                    </div>
                                    @error('cr_no')
                                        <div class="text-danger">{{$message}}</div>
                                    @enderror
                                    <div class="col-md-3 col-12 ">
                                        <div class="d-flex flex-column gap-2">
                                            <label for="" class="text-start mt-3 mt-sm-0">Vat Reg No.<span
                                                    class="text-danger  ">*</span></label>
                                                    @php
                                                    $billing_vat_reg_no = '';
                                                    if ($user_billing_details && is_object($user_billing_details)) {
                                                        $billing_vat_reg_no = $user_billing_details->vat_reg_no ?? '';
                                                    } elseif ($user_details && is_object($user_details)) {
                                                        $billing_vat_reg_no = $user_details->vat_reg_no ?? '';
                                                    }
                                                @endphp                                                
                                            <input type="text" class="w-100 border-0 in px-2" name="vat_reg_no"
                                                placeholder="Vat Reg No"  value="{{ $billing_vat_reg_no }}"
                                                style="height:35px; background-color:#F3F6F8">
                                        </div>
                                    </div>
                                    @error('vat_reg_no')
                                        <div class="text-danger">{{$message}}</div>
                                    @enderror
               
                                    <div class="col-md-4 col-12 ">
                                        <div class="d-flex flex-column gap-2">
                                            <label for="" class="text-start d-flex gap-2">Email<span
                                                    class="text-danger  ">*</span></label>
                                                    @php
                                                    $billing_email = '';
                                                    if ($user_billing_details && is_object($user_billing_details)) {
                                                        $billing_email = $user_billing_details->email ?? '';
                                                    } elseif ($user_details && is_object($user_details)) {
                                                        $billing_email = $user_details->email ?? '';
                                                    }
                                                @endphp                                                
                                            <input type="text" class="w-100 border-0 in px-2" name="billing_email"
                                                placeholder="Email" value="{{ $billing_email }}"
                                                style="height:35px; background-color:#F3F6F8">
                                        </div>
                                        @error('billing_email')
                                            <div class="text-danger">{{$message}}</div>
                                        @enderror
                                    </div>
                                    <div class="col-md-4 col-12 ">
                                        <div class="d-flex flex-column gap-2">
                                            <label for="" class="text-start d-flex gap-2">Phone Number<span
                                                    class="text-danger  ">*</span></label>
                                                    @php
                                                    $billing_phone_number = '';
                                                    if ($user_billing_details && is_object($user_billing_details)) {
                                                        $billing_phone_number = $user_billing_details->phone_number ?? '';
                                                    } elseif ($user_details && is_object($user_details)) {
                                                        $billing_phone_number = $user_details->phone_number ?? '';
                                                    }
                                                @endphp                                                
                                            <input type="text" class="w-100 border-0 in px-2"
                                                placeholder="+91111111111" name="billing_phone_number" value="{{ $billing_phone_number }}"
                                                style="height:35px; background-color:#F3F6F8">
                                        </div>
                                    </div>
                                    @error('billing_phone_number')
                                        <div class="text-danger">{{$message}}</div>
                                    @enderror
                                    <div class="col-md-4 col-12 ">
                                        <div class="d-flex flex-column gap-2">
                                            <label for="" class="text-start d-flex gap-2">Account Manager<span
                                                    class="text-danger  ">*</span></label>
                                                    @php
                                                    $billing_account_manager = '';
                                                    if ($user_billing_details && is_object($user_billing_details)) {
                                                        $billing_account_manager = $user_billing_details->account_manager ?? '';
                                                    } elseif ($user_details && is_object($user_details)) {
                                                        $billing_account_manager = $user_details->account_manager ?? '';
                                                    }
                                                @endphp                       
                                                <select class="form-select border-0 bg-input rounded-0" name="account_manager" aria-label="Default select example" style="height:35px">
                                                    @foreach ($account_manager as $manager)
                                                        <option value="{{$manager->name}}" {{ ($billing_account_manager === $manager->name || $manager->is_default_manager == '1') ? 'selected' : '' }}>{{$manager->name}}</option>
                                                    @endforeach
                                                </select>                         
                                            {{-- <input type="text" class="w-100 border-0 in px-2" name="account_manager"
                                                placeholder="Account Manager"value="{{ ($billing_account_manager || ) }}"
                                                style="height:35px; background-color:#F3F6F8"> --}}
                                        </div>
                                    </div>
                                    @error('account_manager')
                                        <p class="text-danger">{{$message}}</p>
                                    @enderror
                                </div>
                            
                            <div class="d-flex justify-content-start mt-5">
                                <button class="  text-white"
                                    style="height:37px ; border-radius:20px; width:207px; border:none;  margin-top:10px; background-color:#da5858">Save
                                    changes
                                </button>
                            </div>
                        </form>
                    </div>
                    <div class="div">
                        @php
                            $user_id = Session::get('user_id');
                        @endphp
                        <form action="{{ route('change.password', $user_id) }}" method="POST">
                            @csrf
                            <h1 class="text-start fw-bold pb-3" style="font-size:28px; margin-top:25px">Change Password</h1>
                            <div class="col-lg-10 col-12 d-flex flex-column gap-md-5">
                                <div class="">
                                    @if (session('error'))
                                        <p class="alert alert-danger">{{ session('error') }}</p>
                                    @endif
                                    <div class="d-flex flex-column gap-2">
                                        <label for="" class="text-start mt-3 mt-sm-0 d-flex gap-2">Current
                                            Password<span class="text-danger">*</span></label>
                                        <input type="password" name="current_password" class="border-0 in px-2" placeholder="Current Password" style="height:35px; background-color:#F3F6F8; width:98%">
                                    </div>
                                    @error('current_password')
                                        <span class="text-danger mt-2">{{ $message }}</span>
                                    @enderror
                                </div>
                                <div class="">
                                    <div class="d-flex flex-column gap-2">
                                        <label for="" class="text-start mt-3 mt-sm-0 d-flex gap-2">New Password<span
                                                class="text-danger">*</span></label>
                                        <input type="password" name="new_password" class="no-outline border-0 in px-2" placeholder="New Password" style="height:35px; background-color:#F3F6F8; width:98%;">
                                    </div>
                                    @error('new_password')
                                        <span class="text-danger mt-2">{{ $message }}</span>
                                    @enderror
                                </div>
                                <div class="">
                                    <div class="d-flex flex-column gap-2">
                                        <label for="" class="text-start d-flex gap-2 align-items-center">Confirm
                                            Password<span class="text-danger">*</span></label>
                                        <input type="password" name="confirm_password" class="border-0 in px-2" placeholder="Confirm Password" style="height:35px; background-color:#F3F6F8; width:98%">
                                    </div>
                                    @error('confirm_password')
                                        <span class="text-danger mt-2">{{ $message }}</span>
                                    @enderror
                                </div>
                            </div>
                            <div class="d-flex justify-content-start mt-5">
                                <button type="submit" class="text-white" style="height:37px; border-radius:20px; width:207px; border:none;  margin-top:10px; background-color:#da5858">
                                    Save changes
                                </button>
                            </div>
                        </form>
                    </div>                    
                </div>
            </div>
        </div>
    </main>
@endsection
