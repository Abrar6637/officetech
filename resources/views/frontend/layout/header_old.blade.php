@php
    use App\Models\Product;
@endphp
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'Office Tech')</title>
    <!-- Bootstrap CDN -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.5.0/font/bootstrap-icons.css">
    <link rel="stylesheet" id="picostrap-styles-css" href="https://cdn.livecanvas.com/media/css/library/bundle.css"
        media="all" />
    <!-- External CSS Files -->
    @if (request()->is('/'))
        <link rel="stylesheet" href="{{ asset('css/index.css') }}">
    @endif
    @if (request()->is('about-us'))
        <link rel="stylesheet" href="{{ asset('css/about_us.css') }}">
    @endif
    @if (request()->is('accessories'))
        <link rel="stylesheet" href="{{ asset('css/accessories.css') }}">
    @endif
    @if (request()->is('cart'))
        <link rel="stylesheet" href="{{ asset('css/cart.css') }}">
    @endif
    @if (request()->is('checkout'))
        <link rel="stylesheet" href="{{ asset('css/checkout.css') }}">
    @endif
    @if (request()->is('contact-us'))
        <link rel="stylesheet" href="{{ asset('css/contact_us.css') }}">
    @endif
    @if (request()->is('forget-password'))
        <link rel="stylesheet" href="{{ asset('css/forget_password.css') }}">
    @endif
    @if (request()->is('orders'))
        <link rel="stylesheet" href="{{ asset('css/orders.css') }}">
    @endif
    @if (request()->is('order-status'))
        <link rel="stylesheet" href="{{ asset('css/order_status.css') }}">
    @endif
    @php
        $url = $_SERVER['REQUEST_URI'];
        $lastSegment = substr($url, strrpos($url, '/') + 1);
    @endphp
    @if (request()->is('Category/' . $lastSegment) ||
            request()->input('page') !== null ||
            request('_token') !== null ||
            request()->segment(1) !== null)
        <link rel="stylesheet" href="{{ asset('css/printers.css') }}">
    @endif

    @if (request()->is('printers') || request()->input('page') !== null)
        <link rel="stylesheet" href="{{ asset('css/printers.css') }}">
    @endif
    @php
        $url = $_SERVER['REQUEST_URI'];
        $segments = explode('/', $url);
        $lastSegment = urldecode(end($segments));
    @endphp

    @if (request()->is('product-details/' . $lastSegment) && !is_numeric($lastSegment))
        <link rel="stylesheet" href="{{ asset('css/product_details.css') }}">
    @endif
    @if (request()->is('product-details'))
        <link rel="stylesheet" href="{{ asset('css/product_details.css') }}">
    @endif
    @if (request()->is('reset-password'))
        <link rel="stylesheet" href="{{ asset('css/reset_password.css') }}">
    @endif
    @if (request()->is('services'))
        <link rel="stylesheet" href="{{ asset('css/services.css') }}">
    @endif
    @if (request()->is('sign-in'))
        <link rel="stylesheet" href="{{ asset('css/sign_in.css') }}">
    @endif
    @if (request()->is('software-solutions'))
        <link rel="stylesheet" href="{{ asset('css/software_solutions.css') }}">
    @endif
    @if (request()->is('track-order-details'))
        <link rel="stylesheet" href="{{ asset('css/track_order_details.css') }}">
    @endif
    @if (request()->is('track-order'))
        <link rel="stylesheet" href="{{ asset('css/track_order.css') }}">
    @endif
    @if (request()->is('order-successfull'))
        <link rel="stylesheet" href="{{ asset('css/order_successfull.css') }}">
    @endif
    @if (request()->is('user-setting'))
        <link rel="stylesheet" href="{{ asset('css/user_setting.css') }}">
    @endif
    @if (request()->is('work-station'))
        <link rel="stylesheet" href="{{ asset('css/workstations.css') }}">
    @endif
    <link rel="stylesheet" href="{{ asset('css/header.css') }}">
    <link rel="stylesheet" href="{{ asset('css/footer.css') }}">
    <link rel="stylesheet" href="{{ asset('css/main.css') }}">

    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <!-- External CSS Files End -->
</head>

<body style="background-color:#F3F6F8">
    <div class="container-fluid fixed-top" style="padding-left: 0px;padding-right:0px; ">
        <div class="d-flex flex-column  w-100 bg-white d-none d-lg-flex  ">
            <div class="row align-items-center justify-content-lg-around" style="height: 98px">
                <div class="row  align-items-center">
                    <div class="col-lg-2 " style="margin-left:1.7%;">
                        <a href="{{ route('user.index') }}" class=""><img src="{{ url('images/logohead.png') }}"
                                width="200px" alt="logo"></a>
                    </div>
                    <div class="col-lg-4 d-flex align-items-center border p-3 col-lg-4 searchbar-officetech"
                        style="border-radius:30px; height:42px; background-color:#F0F0F0">
                        <svg xmlns="http://www.w3.org/2000/svg" width="20" height="18" viewBox="0 0 25 26"
                            fill="none">
                            <path
                                d="M19.7904 18.4484L24.9189 23.5758L23.2246 25.2701L18.0972 20.1416C16.1894 21.671 13.8165 22.5028 11.3714 22.4993C5.42259 22.4993 0.594604 17.6713 0.594604 11.7226C0.594604 5.77379 5.42259 0.945801 11.3714 0.945801C17.3201 0.945801 22.1481 5.77379 22.1481 11.7226C22.1516 14.1677 21.3198 16.5406 19.7904 18.4484ZM17.3884 17.56C18.908 15.9972 19.7567 13.9024 19.7533 11.7226C19.7533 7.09214 16.0018 3.34063 11.3714 3.34063C6.74094 3.34063 2.98944 7.09214 2.98944 11.7226C2.98944 16.353 6.74094 20.1045 11.3714 20.1045C13.5512 20.1079 15.646 19.2592 17.2088 17.7396L17.3884 17.56Z"
                                fill="#BBBBBB" />
                        </svg>
                        <form method="GET" action="{{ route('search.products') }}" id="search-form">
                            <input type="text" class="header-search-field" id="search-field" placeholder="Search" value="{{ session('search_query') }}">
                            <!-- Suggestions Container -->
                            <div id="suggestions" class="header-search-suggestions searchbar-officetech" style="display:none;"></div>
                        </form>
                        <p class="search_error text-danger" style="display: none">Please type 3 words</p>
                    </div>
                    <div class="col-md-5 col-xl-4 offset-xl-1">
                        <div class="d-flex justify-content-between justify-content-xl-evenly align-items-center ">
                            <div class=" d-flex gap-2 gap-md-0 justify-content-center py-2 rounded-5 px-3  track-btn">
                                <a href="{{ url('/track-order') }}"><span style="color: white;" class="me-2">Track
                                        Order</span></a>
                                <svg xmlns="http://www.w3.org/2000/svg" width="21" height="20"
                                    viewBox="0 0 21 20" fill="none">
                                    <g clip-path="url(#clip0_465_163)">
                                        <path
                                            d="M10.5 7.96098L13.53 6.74998L6.03001 3.74998L3.44401 4.78398C3.31347 4.83621 3.19093 4.90657 3.08001 4.99298L10.5 7.96098ZM2.53501 5.85298C2.51161 5.95938 2.49987 6.06802 2.50001 6.17698V9.25698C3.33937 8.95986 4.24802 8.91844 5.11094 9.13795C5.97386 9.35745 6.75226 9.82802 7.34764 10.4901C7.94301 11.1522 8.32859 11.976 8.45558 12.8573C8.58256 13.7386 8.44525 14.6377 8.06101 15.441L10.001 17.379V8.83898L2.53401 5.85198L2.53501 5.85298ZM11 17.733C11.272 17.693 11.54 17.623 11.8 17.518L17.557 15.215C17.8351 15.1038 18.0735 14.9118 18.2416 14.6639C18.4097 14.416 18.4997 14.1235 18.5 13.824V6.17698C18.5 6.06698 18.488 5.95698 18.465 5.85298L11 8.83798V17.733ZM17.921 4.99298L14.875 6.21098L7.37501 3.21098L9.20001 2.48098C10.0345 2.14713 10.9655 2.14713 11.8 2.48098L17.557 4.78398C17.6875 4.83624 17.8101 4.90659 17.921 4.99298ZM4.00001 17C4.78601 17 5.51201 16.74 6.09601 16.303L8.64601 18.853C8.69243 18.8995 8.74755 18.9364 8.80823 18.9615C8.86891 18.9867 8.93395 18.9997 8.99965 18.9998C9.06535 18.9998 9.13041 18.9869 9.19113 18.9618C9.25184 18.9367 9.30702 18.8999 9.35351 18.8535C9.39999 18.8071 9.43688 18.7519 9.46207 18.6912C9.48725 18.6306 9.50024 18.5655 9.50028 18.4998C9.50033 18.4341 9.48744 18.3691 9.46234 18.3084C9.43724 18.2476 9.40043 18.1925 9.35401 18.146L6.80401 15.596C7.27602 14.9648 7.52115 14.1927 7.49972 13.4048C7.47828 12.6169 7.19153 11.8593 6.6859 11.2547C6.18027 10.65 5.48535 10.2338 4.71368 10.0733C3.94201 9.91281 3.13875 10.0175 2.43398 10.3704C1.7292 10.7233 1.16417 11.3037 0.830375 12.0177C0.496578 12.7317 0.413556 13.5375 0.594753 14.3046C0.775949 15.0717 1.21076 15.7551 1.82877 16.2443C2.44678 16.7335 3.21182 16.9997 4.00001 17ZM4.00001 16C3.33696 16 2.70108 15.7366 2.23224 15.2677C1.7634 14.7989 1.50001 14.163 1.50001 13.5C1.50001 12.8369 1.7634 12.201 2.23224 11.7322C2.70108 11.2634 3.33696 11 4.00001 11C4.66305 11 5.29893 11.2634 5.76777 11.7322C6.23661 12.201 6.50001 12.8369 6.50001 13.5C6.50001 14.163 6.23661 14.7989 5.76777 15.2677C5.29893 15.7366 4.66305 16 4.00001 16Z"
                                            fill="white" />
                                    </g>
                                    <defs>
                                        <clipPath id="clip0_465_163">
                                            <rect width="20" height="20" fill="white"
                                                transform="translate(0.5)" />
                                        </clipPath>
                                    </defs>
                                </svg>
                            </div>
                            <div class="">
                                <a href="" style=""><img src="{{ url('images/lang.png') }}"
                                        alt=""></a>
                            </div>
                            <div class="px-1"></div>
                            <div class="d-flex gap-3">
                                <div class=" dropdown user-dropdown">
                                    <a href="#" class="dropdown-toggle drp" role="button"
                                        data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                        @if (Session::get('user_authenticated'))
                                            Hello {{ Session::get('user_name') }}
                                        @else
                                            Log In
                                        @endif <img src="{{ url('images/fa6-solid_user.png') }}"
                                            id="userDropdown" class="user-img" alt="user-icon">
                                    </a>
                                    <div class="dropdown-menu" id="user_Dropdown" aria-labelledby="userDropdown">
                                        @if (Session::get('user_authenticated'))
                                            <a class="dropdown-item user-icon-dropdown"
                                                href="{{ route('user.orders') }}">My
                                                Orders</a>
                                            <a class="dropdown-item user-icon-dropdown"
                                                href="{{ route('user.user_setting') }}">User Settings</a>
                                            <a class="dropdown-item user-icon-dropdown"
                                                href="{{ route('user.logout') }}">Logout</a>
                                        @else
                                            <a class="dropdown-item user-icon-dropdown"
                                                href="{{ route('user.signin') }}">Login</a>
                                        @endif
                                    </div>
                                </div>
                                <div class="dropdown user-dropdown">
                                    <a href="#" class="dropdown-toggle drp" role="button"
                                        data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                        <img src="{{ url('images/fa-solid_shopping-cart.png') }}" alt=""
                                            id="userDropdown2">
                                        <span class="badge" style="color: black; display: none;"
                                            id="cart-badge">0</span>
                                    </a>
                                    <div class="dropdown-menu" id="user_Dropdown2" aria-labelledby="userDropdown2">
                                        <a class="dropdown-item user-icon-dropdown"
                                            href="{{ route('user.cart') }}">Cart</a>
                                        <a class="dropdown-item user-icon-dropdown"
                                            href="{{ route('cart.delete.all') }}"
                                            onclick="return confirm('Are you sure you want to clear cart?');">Clear
                                            Cart</a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="container-fluid categories-container justify-content-center  " data-target_na="target"
                style="background-color:#da5858;height:40px;align-items:center;  ">
                <ul class="main-nav">
                    @if ($main_categories->count() > 0)                        
                        @foreach ($main_categories as $main_category)
                            <li class="main-nav-li">
                                <a href="#" class="main-category-li"
                                    data-target="sub-nav-{{ $main_category->id }}">{{ $main_category->category_name }}</a>
                                <div class="hoverable-dropdown">
                                    <div class="hoverable-dropdown">
                                        @php
                                            $hasSubcategoriesWithProducts = false;
                                        @endphp
                                        @foreach ($sub_categories as $subcategory)
                                            @php
                                                $productsCount = Product::where('sub_categories_id', $subcategory->id)->count();
                                                if ($subcategory->parent_category_id == $main_category->id && $productsCount > 0) {
                                                    $hasSubcategoriesWithProducts = true;
                                                    break;
                                                }
                                            @endphp
                                        @endforeach
                                        @if ($hasSubcategoriesWithProducts)
                                            <ul class="sub-nav hide-nav-class @if ($loop->last) last-item @endif"
                                                id="sub-nav-{{ $main_category->id }}">
                                                @foreach ($sub_categories as $subcategory)
                                                    @php
                                                        $productsCount = Product::where('sub_categories_id', $subcategory->id)->count();
                                                    @endphp
                                                    @if ($subcategory->parent_category_id == $main_category->id && $productsCount > 0)
                                                        <li>
                                                            <a class="dropdown-item"
                                                                href="{{ route('sub.category.products', $subcategory->slug) }}">{{ $subcategory->sub_category_name }}</a>
                                                        </li>
                                                    @endif
                                                @endforeach
                                            </ul>
                                        @endif
                                    </div>
                                </div>
                            </li>
                        @endforeach
                    @endif
                </ul>
            </div>
        </div>
        <div class="d-flex justify-content-between   bg-white align-items-center d-flex d-lg-none mb-4 px-4">
            <a href="{{ url('/') }}" class=""><img src="{{ url('images/logo.png') }}" width="100px"
                    alt="logo"></a>
            <div class="d-flex align-items-center">
                <a href="{{ route('user.cart') }}" class="nav-item nav-link cart-1024px"
                    style="margin-left: 32px; position: relative;">
                    <img src="{{ url('images/fa-solid_shopping-cart.png') }}" alt="">
                    <span class="badge" style="color: black; display:none;" id="mobile-cart-badge">0</span>
                </a>
                <div class="hamburger mobile-hamburger-menu" data-bs-toggle="modal" data-bs-target="#mainModal">
                    <div class="menu-icon" id="menuIcon">
                        <div class="bar"></div>
                        <div class="bar"></div>
                        <div class="bar"></div>
                    </div>
                </div>
            </div>
            <div class="modal right fade" id="mainModal" tabindex="-1" aria-labelledby="exampleModalLabel"
                aria-hidden="true">
                <div class="modal-dialog">
                    <div class="modal-content">
                        <div class="modal-header">
                            <div>
                                @if (Session::get('user_authenticated'))
                                <h5 class="modal-title user-a" id="exampleModalLabel">
                                        Hello {{ Session::get('user_name') }}
                                </h5>
                                @else
                                <a href="{{url('/sign-in') }}" class="btn btn-bg-color text-white">
                                    Log In
                                </a>
                                @endif
                            </div>
                            <button type="button" class="btn-close me-2" data-bs-dismiss="modal"
                                aria-label="Close"></button>
                        </div>
                        <div class="modal-body">
                            <!-- Search Form -->
                            <form class="d-flex d-inline">
                                <div class="input-group search-field-div" style="border-radius: 30px">
                                    <button class="search-field-btn mx-1"><i class="bi-search"></i></button>
                                    <form method="GET" action="{{ route('search.products') }}"
                                        id="search-form-mobile">
                                        <input type="text" class="search-field" id="search-field-mobile"
                                            placeholder="Search">
                                        <div id="suggestions-mobile" class="header-search-suggestions"
                                            style="display:none;"></div>
                                    </form>
                                </div>
                            </form>
                            <div class="categories-sm-Container" style="margin-top: 30px;">
                                <!-- Main Categories -->
                                <div class="categories mt-2 categories-font" style="font-size:20px">
                                    @foreach ($main_categories as $main_category)
                                        <details class="details">
                                            <summary class="">{{ $main_category->category_name }}</summary>
                                            @foreach ($sub_categories as $subcategory)
                                                @php
                                                    $productsCount = Product::where('sub_categories_id', $subcategory->id)->count();
                                                @endphp
                                                @if ($subcategory->parent_category_id == $main_category->id && $productsCount > 0)
                                                    <a href="{{ route('sub.category.products', $subcategory->slug) }}"
                                                        class="sub-categories-mobile-a">{{ $subcategory->sub_category_name }}</a><br>
                                                @endif
                                            @endforeach
                                        </details>
                                    @endforeach
                                </div>
                                @if (Session::get('user_authenticated'))
                                <div class="categories mt-2 categories-font" style="font-size:20px">
                                    <a href="{{ route('user.user_setting') }}">Account Setting</a>
                                    <i class="fa fa-angle-right" aria-hidden="true"
                                        style="float:right;margin-top:4px;"></i>
                                </div>
                                <div class="categories mt-2 categories-font" style="font-size:20px">
                                    <a href="{{ route('user.logout') }}">Logout</a>
                                    <i class="fa fa-angle-right" aria-hidden="true"
                                        style="float:right;margin-top:4px;"></i>
                                </div>
                                @endif
                            </div>
                        </div>
                        <div class="modal-footer d-flex justify-content-between">
                            <div class="d-flex gap-1">
                                <a href="#" class=""><img
                                        src="{{ asset('images/ri_facebook-fill.png') }}" alt=""
                                        class="mobile-navbar-footer-img"></a>
                                <a href="#" class=""><img
                                        src="{{ asset('images/ri_twitter-x-fill.png') }}" alt=""
                                        class="mobile-navbar-footer-img"></a>
                                <a href="#" class=""><img src="{{ asset('images/mdi_youtube.png') }}"
                                        alt="" class="mobile-navbar-footer-img"></a>
                            </div>
                            <div class="mail-icon">
                                <a href="#">info@officetech.com.sa</a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
