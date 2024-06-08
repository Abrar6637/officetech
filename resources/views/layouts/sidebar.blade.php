<style>

    #sidebar-menu ul li a:hover, #sidebar-menu ul li a:hover i, #sidebar-menu ul li a:hover svg{
        color: #03045E !important;
    }
</style>

<!-- ========== Left Sidebar Start ========== -->
<div class="vertical-menu">
    <div data-simplebar class="h-100">
        <!--- Sidemenu -->
        <div id="sidebar-menu">
            <!-- Left Menu Start -->
            <ul class="metismenu list-unstyled" id="side-menu">
                <li class="menu-title" data-key="t-menu">@lang('translation.Menu')</li>
                <li>
                    <a href="{{ route('admin.dashboard') }}">
                        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24"
                            fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round"
                            stroke-linejoin="round" class="feather feather-home">
                            <path d="M3 9l9-7 9 7v11a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2z"></path>
                            <polyline points="9 22 9 12 15 12 15 22"></polyline>
                        </svg>
                        <span data-key="">Dashboards</span>
                    </a>
                </li>
                <li>
                    <a href="{{ route('products') }}">
                        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24"
                            fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round"
                            stroke-linejoin="round">
                            <line x1="12" y1="5" x2="12" y2="19"></line>
                            <line x1="5" y1="12" x2="19" y2="12"></line>
                        </svg>
                        <span data-key="">Product</span>
                    </a>
                </li>
                <li id="mm-active-1" class="">
                    <a href="javascript:void(0);" class="has-arrow">
                        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24"
                            fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round"
                            stroke-linejoin="round">
                            <line x1="12" y1="5" x2="12" y2="19"></line>
                            <line x1="5" y1="12" x2="19" y2="12"></line>
                        </svg>
                        <span data-key="t-pages">Categories</span>
                    </a>
                    <ul class="sub-menu mm-collapse" id="mm-show-1" aria-expanded="false">
                        <li id="mm-main-active-1" class=""><a href="{{ route('show.main.categories') }}"
                                data-key="t-starter-page">Add Main Categories</a></li>
                        <li><a href="{{ route('show.sub.categories') }}" data-key="t-starter-page">Add Sub
                                Categories</a></li>
                        {{-- <li>
                            <a href="{{ route('show.categories') }}">
                        <span data-key="t-categories">Sub Sub Categories</span>
                        </a>
                </li> --}}
                    </ul>
                </li>
                <li>
                    <a href="{{ route('produts.type') }}">
                        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24"
                            fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round"
                            stroke-linejoin="round">
                            <line x1="12" y1="5" x2="12" y2="19"></line>
                            <line x1="5" y1="12" x2="19" y2="12"></line>
                        </svg>
                        <span>Product Types</span>
                    </a>
                </li>
                <li>
                    <a href="{{ route('brands') }}">
                        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24"
                            fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round"
                            stroke-linejoin="round">
                            <line x1="12" y1="5" x2="12" y2="19"></line>
                            <line x1="5" y1="12" x2="19" y2="12"></line>
                        </svg>
                        <span>Brands</span>
                    </a>
                </li>
                <li>
                    <a href="/admin/orders">
                        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24"
                            fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round"
                            stroke-linejoin="round">
                            <line x1="12" y1="5" x2="12" y2="19"></line>
                            <line x1="5" y1="12" x2="19" y2="12"></line>
                        </svg>
                        <span>Orders</span>
                    </a>
                </li>
                <li>
                    <a href="{{route('account.manager')}}">
                        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24"
                            fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round"
                            stroke-linejoin="round">
                            <line x1="12" y1="5" x2="12" y2="19"></line>
                            <line x1="5" y1="12" x2="19" y2="12"></line>
                        </svg>
                        <span>Account Manager</span>
                    </a>
                </li>
                <li>
                    <a href="{{route('region')}}">
                        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24"
                            fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round"
                            stroke-linejoin="round">
                            <line x1="12" y1="5" x2="12" y2="19"></line>
                            <line x1="5" y1="12" x2="19" y2="12"></line>
                        </svg>
                        <span>Region</span>
                    </a>
                </li>
                {{-- <li>
                    <a href="{{route('cities')}}">
                        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24"
                            fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round"
                            stroke-linejoin="round">
                            <line x1="12" y1="5" x2="12" y2="19"></line>
                            <line x1="5" y1="12" x2="19" y2="12"></line>
                        </svg>
                        <span>Cities</span>
                    </a>
                </li> --}}
                <li>
                    <a href="{{route('countries')}}">
                        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24"
                            fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round"
                            stroke-linejoin="round">
                            <line x1="12" y1="5" x2="12" y2="19"></line>
                            <line x1="5" y1="12" x2="19" y2="12"></line>
                        </svg>
                        <span>Countries</span>
                    </a>
                </li>
                <li>
                    <a href="/discount-coupon">
                        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24"
                            fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round"
                            stroke-linejoin="round">
                            <line x1="12" y1="5" x2="12" y2="19"></line>
                            <line x1="5" y1="12" x2="19" y2="12"></line>
                        </svg>
                        <span>Discount Coupon</span>
                    </a>
                </li>
                <li>
                    <a href="{{ route('admin.reviews') }}">
                        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24"
                            fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round"
                            stroke-linejoin="round">
                            <line x1="12" y1="5" x2="12" y2="19"></line>
                            <line x1="5" y1="12" x2="19" y2="12"></line>
                        </svg>
                        <span>Reviews</span>
                    </a>
                </li>
                <li>
                    <a href="{{route('admin.slider')}}">
                        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24"
                            fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round"
                            stroke-linejoin="round">
                            <line x1="12" y1="5" x2="12" y2="19"></line>
                            <line x1="5" y1="12" x2="19" y2="12"></line>
                        </svg>
                        <span>Add Slider</span>
                    </a>
                </li>
                <li>
                    <a href="{{route('admin.contactus')}}">
                        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24"
                            fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round"
                            stroke-linejoin="round">
                            <line x1="12" y1="5" x2="12" y2="19"></line>
                            <line x1="5" y1="12" x2="19" y2="12"></line>
                        </svg>
                        <span>Contacts</span>
                    </a>
                </li>
                <li>
                    <a href="{{route('admin.quotations')}}">
                        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24"
                            fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round"
                            stroke-linejoin="round">
                            <line x1="12" y1="5" x2="12" y2="19"></line>
                            <line x1="5" y1="12" x2="19" y2="12"></line>
                        </svg>
                        <span>Users Quotations</span>
                    </a>
                </li>
                <li>
                    <a href="{{route('admin.index.quotation')}}">
                        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24"
                            fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round"
                            stroke-linejoin="round">
                            <line x1="12" y1="5" x2="12" y2="19"></line>
                            <line x1="5" y1="12" x2="19" y2="12"></line>
                        </svg>
                        <span>Admin Quotations</span>
                    </a>
                </li>
                <li>
                    <a href="{{route('admin.return.request')}}">
                        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24"
                            fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round"
                            stroke-linejoin="round">
                            <line x1="12" y1="5" x2="12" y2="19"></line>
                            <line x1="5" y1="12" x2="19" y2="12"></line>
                        </svg>
                        <span>Return Orders Request</span>
                    </a>
                </li>
                <li>
                    <a href="{{route('admin.users')}}">
                        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24"
                            fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round"
                            stroke-linejoin="round">
                            <line x1="12" y1="5" x2="12" y2="19"></line>
                            <line x1="5" y1="12" x2="19" y2="12"></line>
                        </svg>
                        <span>All Customers</span>
                    </a>
                </li>
               <li>
                    <a href="{{route('user.guest-user.index')}}">
                        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24"
                            fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round"
                            stroke-linejoin="round">
                            <line x1="12" y1="5" x2="12" y2="19"></line>
                            <line x1="5" y1="12" x2="19" y2="12"></line>
                        </svg>
                        <span>Guest Users</span>
                    </a>
                </li>
                <li>
                    <a href="{{route('admin.newsletters')}}">
                        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24"
                            fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round"
                            stroke-linejoin="round">
                            <line x1="12" y1="5" x2="12" y2="19"></line>
                            <line x1="5" y1="12" x2="19" y2="12"></line>
                        </svg>
                        <span>Newsletters</span>
                    </a>
                </li>
                <li id="mm-active-2" class="">
                    <a href="javascript:void(0);" class="has-arrow" aria-expanded="false">
                        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24"
                            fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round"
                            stroke-linejoin="round">
                            <line x1="12" y1="5" x2="12" y2="19"></line>
                            <line x1="5" y1="12" x2="19" y2="12"></line>
                        </svg>
                        <span data-key="t-tables">Services</span>
                    </a>
                    <ul class="sub-menu mm-collapse" id="mm-show-2" aria-expanded="false">
                        <li><a href="{{route('all.services')}}" data-key="t-basic-tables">Add Services</a></li>
                        <li><a href="{{route('services.call')}}" data-key="t-data-tables">Call Requests</a></li>
                        <li><a href="{{route('services.contract')}}" data-key="t-data-tables">Contract Requests</a></li>
                    </ul>
                </li>
                <li id="mm-active-3" class="">
                    <a href="javascript:void(0);" class="has-arrow" aria-expanded="false">
                        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none"
                            stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                            <line x1="12" y1="5" x2="12" y2="19"></line>
                            <line x1="5" y1="12" x2="19" y2="12"></line>
                        </svg>
                        <span data-key="t-tables">CMS</span>
                    </a>
                    <ul class="sub-menu mm-collapse" id="mm-show-3" aria-expanded="false">
                        <li><a href="{{ route('admin.privacy-policy.index') }}" data-key="t-basic-tables">Privacy Policy</a></li>
                        <li><a href="{{ route('admin.return-policy.index') }}" data-key="t-basic-tables">Return Policy</a></li>
                        <li><a href="{{ route('admin.service-policy.index') }}" data-key="t-basic-tables">Service Policy</a></li>
                        <li><a href="{{ route('admin.service-plan-policy.index') }}" data-key="t-basic-tables">Service Plan Policy</a></li>
                        <li><a href="{{ route('admin.payment-policy.index') }}" data-key="t-basic-tables">Payment Policy</a></li>
                        <li><a href="{{ route('admin.ecom-print-package.index') }}" data-key="t-basic-tables">Print Package</a></li>
                        <li><a href="{{ route('admin.about-us.index') }}" data-key="t-basic-tables">About Us</a></li>
                    </ul>
                </li>
            </ul>
        </div>
        <!-- Sidebar -->
    </div>
</div>
<!-- Left Sidebar End -->
