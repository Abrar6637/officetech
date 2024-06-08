@php
use App\Models\Product;
@endphp
<!DOCTYPE html>
<html lang="{{ app()->getLocale() }}" @if(app()->getLocale() == 'ar') dir="rtl" @else dir="ltr" @endif>

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>@yield('title', 'Office Tech')</title>
    <!-- <link rel="shortcut icon" href="favicon.ico" type="image/x-icon"> -->
    <link rel="stylesheet" type="text/css" href="https://cdn.jsdelivr.net/npm/slick-carousel@1.8.1/slick/slick.css" />
    <link rel="stylesheet" href="{{ asset('updated-assets/css/style.css') }}">
    {{-- <link rel="stylesheet" href="{{asset('updated-assets/css/reset.css')}}"> --}}
    {{-- <link rel="stylesheet" href="{{asset('updated-assets/css/test.css')}}"> --}}
    <link rel="stylesheet" href="{{ asset('updated-assets/style/reset.scss') }}">
    <link rel="stylesheet" href="{{ asset('updated-assets/style/style.scss') }}">
    <link rel="stylesheet" href="{{ asset('css/new-page.css') }}">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css" />
    <script src="https://cdn.jsdelivr.net/npm/alpinejs@2.8.2/dist/alpine.min.js" defer></script>
    <style>
        .header__login-dropdown {
            position: relative;
            display: inline-block;
        }

        .header__login-btn {
            cursor: pointer;
        }

        .header__dropdown-content {
            display: none;
            position: absolute;
            background-color: #fff;
            box-shadow: 0 8px 16px rgba(0, 0, 0, 0.1);
            z-index: 1;
        }

        .header__dropdown-content a {
            display: block;
            padding: 10px;
            text-decoration: none;
            color: #021A6F;
            font-weight: 600
        }

        .header__dropdown-content a:hover {
            background-color: #f5f5f5;
            /* Add hover effect */
        }

        .header__login-dropdown:hover .header__dropdown-content {
            display: block;
        }

        #suggestions {
            position: absolute;
            top: 115px;
            z-index: 90;
            background-color: white;
            padding: 10px;
            overflow: hidden;
            height: 400px;
            overflow-y: auto;
        }

        #suggestions::-webkit-scrollbar {
            height: auto;
            width: 6px;
            background: #F3F6F8;
            border-radius: 10px;
        }

        #suggestions::-webkit-scrollbar-thumb {
            background: #DADFE2;
            border-radius: 10px;
        }

        .inner-suggestion {
            cursor: pointer;
        }

        .inner-suggestion:hover {
            cursor: pointer;
            color: #021A6F
        }

        .header__menu .menu__list {
            gap: 16px;
        }

        .header__menu {
            padding: 15px 0px;
        }

        .header__menu .menu__list li.menu__item {
            font-size: 17px;
            font-weight: 600;
        }

        .header__menu .menu__list li.arrow>a {
            padding-right: 20px !important;
        }

        @media (max-width: 1200px) {
            .header__menu .menu__list {
                gap: 10px;
            }
        }

        @media (max-width: 486px) {
            #suggestions {
                top: 155px;
            }
        }

        .width-search {
            width: 274px;
        }
    </style>

</head>

<body>
    <header class="header">
        <div class="container">
            <div class="header__top">
                <a href="{{ route('user.index') }}" class="header__logo">
                    <img src="{{ asset('updated-assets/images/logo.svg') }}" alt="">
                </a>
                <div class="header__top-right">
                    <a href="#" class="lang" id="langSwitchBtn">
                        <svg width="32" height="15" viewBox="0 0 32 15" fill="none" xmlns="http://www.w3.org/2000/svg">
                            <path d="M0 7.67442C0 7.39535 0.0231335 7.09884 0.0694005 6.78488C0.127234 6.4593 0.208201 6.11628 0.312302 5.75581C0.42797 5.38372 0.566771 4.99419 0.728705 4.58721L1.97791 5.07558C1.86225 5.40116 1.75815 5.7093 1.66561 6C1.58464 6.2907 1.52103 6.56395 1.47476 6.81977C1.44006 7.07558 1.42271 7.31977 1.42271 7.55233C1.42271 8.0407 1.52681 8.45349 1.73501 8.7907C1.95478 9.13953 2.25552 9.42442 2.63722 9.64535C3.01892 9.86628 3.45267 10.0291 3.93848 10.1337C4.43585 10.2384 4.96214 10.2907 5.51734 10.2907C6.18821 10.2907 6.81282 10.2326 7.39115 10.1163C7.98106 10 8.49578 9.8314 8.93531 9.61047C9.38642 9.40116 9.7392 9.15698 9.99367 8.87791C10.2481 8.61047 10.3754 8.31977 10.3754 8.00581C10.3754 7.85465 10.3175 7.71512 10.2019 7.58721C10.0862 7.4593 9.9127 7.33721 9.68137 7.22093C9.45003 7.10465 9.17243 6.99419 8.84856 6.88953C8.52469 6.77326 8.15456 6.65698 7.73816 6.5407L8.06781 5.09302C8.66928 5.32558 9.20135 5.52326 9.66402 5.68605C10.1267 5.83721 10.5315 5.9593 10.8785 6.05233C11.2255 6.14535 11.5263 6.21512 11.7807 6.26163C12.0352 6.29651 12.2492 6.31395 12.4227 6.31395C12.6656 6.31395 12.8391 6.38372 12.9432 6.52326C13.0589 6.65116 13.1167 6.80814 13.1167 6.99419C13.1167 7.18023 13.0357 7.35465 12.8738 7.51744C12.7119 7.6686 12.5037 7.74419 12.2492 7.74419C12.1798 7.74419 12.1104 7.74419 12.041 7.74419C11.9716 7.74419 11.8964 7.74419 11.8154 7.74419C11.746 7.74419 11.6766 7.74419 11.6072 7.74419C11.6304 7.84884 11.6477 7.93023 11.6593 7.98837C11.6708 8.05814 11.6766 8.14535 11.6766 8.25C11.6766 8.68023 11.5263 9.09884 11.2255 9.50581C10.9364 9.91279 10.5084 10.2791 9.94162 10.6047C9.37485 10.9419 8.68663 11.2093 7.87696 11.407C7.07885 11.6047 6.16508 11.7035 5.13564 11.7035C4.22186 11.7035 3.37171 11.5523 2.58517 11.25C1.8102 10.9593 1.18559 10.5174 0.711355 9.92442C0.237118 9.3314 0 8.5814 0 7.67442ZM6.38485 15C6.14194 15 5.93374 14.9128 5.76024 14.7384C5.59831 14.5756 5.51734 14.3779 5.51734 14.1453C5.51734 13.9128 5.59831 13.7093 5.76024 13.5349C5.93374 13.3605 6.14194 13.2733 6.38485 13.2733C6.61618 13.2733 6.81282 13.3605 6.97475 13.5349C7.14825 13.7093 7.235 13.9128 7.235 14.1453C7.235 14.3779 7.14825 14.5756 6.97475 14.7384C6.81282 14.9128 6.61618 15 6.38485 15ZM4.00788 15C3.76498 15 3.55678 14.9128 3.38327 14.7384C3.22134 14.5756 3.14037 14.3779 3.14037 14.1453C3.14037 13.9128 3.22134 13.7093 3.38327 13.5349C3.55678 13.3605 3.76498 13.2733 4.00788 13.2733C4.23921 13.2733 4.43585 13.3605 4.59778 13.5349C4.77128 13.7093 4.85803 13.9128 4.85803 14.1453C4.85803 14.3779 4.77128 14.5756 4.59778 14.7384C4.43585 14.9128 4.23921 15 4.00788 15Z" fill="#03045E" />
                            <path d="M12.2549 7.74419L12.4284 6.31395C12.9952 6.31395 13.4463 6.27907 13.7817 6.2093C14.1171 6.13953 14.36 6 14.5104 5.7907C14.6608 5.56977 14.7359 5.24419 14.7359 4.81395C14.7359 4.52326 14.6897 4.18023 14.5971 3.78488C14.5046 3.37791 14.3832 2.94767 14.2328 2.49419C14.0824 2.0407 13.9205 1.59302 13.747 1.15116L15.1524 0.627907C15.3027 1 15.4415 1.42442 15.5688 1.90116C15.7076 2.37791 15.8232 2.84884 15.9158 3.31395C16.0083 3.77907 16.0546 4.18605 16.0546 4.53488C16.0546 5 16.0025 5.41279 15.8984 5.77326C15.8059 6.12209 15.6613 6.42442 15.4647 6.68023C15.268 6.92442 15.0135 7.12791 14.7012 7.2907C14.4005 7.44186 14.0477 7.55814 13.6429 7.63953C13.2381 7.7093 12.7754 7.74419 12.2549 7.74419ZM14.1113 10.9884C13.8684 10.9884 13.6602 10.9012 13.4867 10.7267C13.3248 10.564 13.2438 10.3663 13.2438 10.1337C13.2438 9.90116 13.3248 9.69767 13.4867 9.52326C13.6602 9.34884 13.8684 9.26163 14.1113 9.26163C14.3427 9.26163 14.5393 9.34884 14.7012 9.52326C14.8747 9.69767 14.9615 9.90116 14.9615 10.1337C14.9615 10.3663 14.8747 10.564 14.7012 10.7267C14.5393 10.9012 14.3427 10.9884 14.1113 10.9884Z" fill="#03045E" />
                            <path d="M16.9837 11.7035L16.4806 10.3779C17.325 10.0988 18.0247 9.77907 18.5799 9.4186C19.1467 9.05814 19.592 8.67442 19.9159 8.26744C20.2513 7.86047 20.4885 7.44767 20.6273 7.02907C20.7661 6.59884 20.8355 6.18605 20.8355 5.7907C20.8355 5.22093 20.7082 4.64535 20.4538 4.06395C20.2109 3.47093 19.939 2.91279 19.6383 2.38953L20.9049 1.74419C21.1246 2.15116 21.3155 2.55233 21.4774 2.94767C21.6509 3.34302 21.8013 3.71512 21.9285 4.06395C22.0673 4.41279 22.1772 4.73256 22.2582 5.02326C22.4201 5.52326 22.6283 5.86628 22.8828 6.05233C23.1488 6.22674 23.5074 6.31395 23.9585 6.31395C24.2014 6.31395 24.3749 6.38372 24.479 6.52326C24.5947 6.65116 24.6525 6.80814 24.6525 6.99419C24.6525 7.18023 24.5715 7.35465 24.4096 7.51744C24.2477 7.6686 24.0395 7.74419 23.785 7.74419C23.276 7.74419 22.8596 7.65698 22.5358 7.48256C22.2235 7.29651 21.9864 7.05814 21.8244 6.76744C21.6625 6.46512 21.5526 6.15116 21.4948 5.82558L22.05 6.13953C22.05 6.90698 21.8765 7.60465 21.5295 8.23256C21.194 8.87209 20.7603 9.42442 20.2282 9.88953C19.6961 10.3663 19.1409 10.7558 18.5626 11.0581C17.9843 11.3605 17.458 11.5756 16.9837 11.7035Z" fill="#03045E" />
                            <path d="M23.7934 7.74419L23.9669 6.31395C24.6956 6.31395 25.2566 6.30814 25.6499 6.29651C26.0547 6.28488 26.3496 6.27326 26.5347 6.26163C26.7198 6.23837 26.847 6.22674 26.9164 6.22674C26.7082 6.11047 26.4653 5.93023 26.1877 5.68605C25.9101 5.43023 25.6672 5.11047 25.459 4.72674C25.2508 4.3314 25.1467 3.86628 25.1467 3.3314C25.1467 2.6686 25.2971 2.08721 25.5978 1.58721C25.9101 1.08721 26.3323 0.697674 26.8644 0.418604C27.408 0.139535 28.0268 0 28.7208 0C28.9869 0 29.2702 0.0232557 29.571 0.0697671C29.8717 0.116279 30.1609 0.186046 30.4385 0.27907L30.1435 1.62209C29.9122 1.56395 29.6693 1.51744 29.4148 1.48256C29.1604 1.44767 28.929 1.43023 28.7208 1.43023C28.3044 1.43023 27.9343 1.51163 27.6104 1.67442C27.2865 1.82558 27.0321 2.0407 26.847 2.31977C26.6619 2.59884 26.5694 2.93605 26.5694 3.3314C26.5694 3.63372 26.633 3.91279 26.7603 4.1686C26.8875 4.41279 27.0552 4.63372 27.2634 4.8314C27.4716 5.02907 27.703 5.19186 27.9574 5.31977C28.2119 5.44767 28.4606 5.54651 28.7035 5.61628C28.9579 5.68605 29.1835 5.71512 29.3801 5.70349C29.5189 5.65698 29.6462 5.61628 29.7618 5.5814C29.8775 5.54651 30.0047 5.50581 30.1435 5.4593C30.2939 5.40116 30.4732 5.32558 30.6814 5.23256C30.9012 5.13953 31.1788 5.01744 31.5142 4.86628L32 6.13953C31.225 6.45349 30.4327 6.73256 29.623 6.97674C28.8249 7.22093 27.9516 7.41279 27.0032 7.55233C26.0663 7.68023 24.9963 7.74419 23.7934 7.74419Z" fill="#03045E" />
                        </svg>
                    </a>
                    <div class="header__top-body">
                        <div class="searchbar-officetech">
                            <form class="header__search" role="search" method="GET" action="{{ route('search.products') }}" id="search-form">
                                <input type="text" name="search-text" id="search-field" placeholder="Type and search" value="">
                                <button></button>
                                <!-- Suggestions Container -->
                                <div id="suggestions" class="header-search-suggestions searchbar-officetech width-search" style="display:none;"></div>
                            </form>
                            <p class="search_error" style="display: none; color:red">Please type 3 words</p>
                        </div>

                        <a href="{{ url('/track-order') }}" class="header__track" data-translate="track_order_btn">
                            Track Order
                            <svg width="22" height="20" viewBox="0 0 22 20" fill="none" xmlns="http://www.w3.org/2000/svg">
                                <mask id="mask0_1_219" style="mask-type:luminance" maskUnits="userSpaceOnUse" x="1" y="0" width="21" height="20">
                                    <path d="M21.2383 0H1.23828V20H21.2383V0Z" fill="white" />
                                </mask>
                                <g mask="url(#mask0_1_219)">
                                    <path d="M11.2412 7.96086L14.2712 6.74986L6.77119 3.74986L4.18519 4.78386C4.05465 4.83609 3.93211 4.90645 3.82119 4.99286L11.2412 7.96086ZM3.27619 5.85286C3.25279 5.95926 3.24105 6.0679 3.24119 6.17686V9.25686C4.08055 8.95974 4.9892 8.91832 5.85212 9.13783C6.71504 9.35733 7.49344 9.8279 8.08882 10.49C8.68419 11.1521 9.06977 11.9759 9.19676 12.8572C9.32374 13.7385 9.18643 14.6376 8.80219 15.4409L10.7422 17.3789V8.83886L3.27519 5.85186L3.27619 5.85286ZM11.7412 17.7329C12.0132 17.6929 12.2812 17.6229 12.5412 17.5179L18.2982 15.2149C18.5763 15.1037 18.8147 14.9117 18.9828 14.6638C19.1509 14.4159 19.2409 14.1234 19.2412 13.8239V6.17686C19.2412 6.06686 19.2292 5.95686 19.2062 5.85286L11.7412 8.83786V17.7329ZM18.6622 4.99286L15.6162 6.21086L8.11619 3.21086L9.94119 2.48086C10.7757 2.14701 11.7067 2.14701 12.5412 2.48086L18.2982 4.78386C18.4287 4.83612 18.5513 4.90647 18.6622 4.99286ZM4.74119 16.9999C5.52719 16.9999 6.25319 16.7399 6.83719 16.3029L9.38719 18.8529C9.43361 18.8994 9.48873 18.9363 9.54941 18.9614C9.61009 18.9866 9.67513 18.9996 9.74083 18.9997C9.80653 18.9997 9.87159 18.9868 9.93231 18.9617C9.99302 18.9366 10.0482 18.8998 10.0947 18.8534C10.1412 18.807 10.1781 18.7518 10.2033 18.6911C10.2284 18.6305 10.2414 18.5654 10.2415 18.4997C10.2415 18.434 10.2286 18.369 10.2035 18.3083C10.1784 18.2475 10.1416 18.1924 10.0952 18.1459L7.54519 15.5959C8.0172 14.9647 8.26233 14.1926 8.2409 13.4047C8.21946 12.6168 7.93271 11.8592 7.42708 11.2546C6.92145 10.6499 6.22653 10.2337 5.45486 10.0732C4.68319 9.91269 3.87993 10.0174 3.17516 10.3703C2.47038 10.7232 1.90535 11.3036 1.57156 12.0176C1.23776 12.7316 1.15474 13.5374 1.33593 14.3045C1.51713 15.0716 1.95194 15.755 2.56995 16.2442C3.18796 16.7334 3.953 16.9996 4.74119 16.9999ZM4.74119 15.9999C4.07814 15.9999 3.44226 15.7365 2.97342 15.2676C2.50458 14.7988 2.24119 14.1629 2.24119 13.4999C2.24119 12.8368 2.50458 12.2009 2.97342 11.7321C3.44226 11.2633 4.07814 10.9999 4.74119 10.9999C5.40423 10.9999 6.04011 11.2633 6.50895 11.7321C6.97779 12.2009 7.24119 12.8368 7.24119 13.4999C7.24119 14.1629 6.97779 14.7988 6.50895 15.2676C6.04011 15.7365 5.40423 15.9999 4.74119 15.9999Z" fill="#03045E" />
                                </g>
                            </svg>
                        </a>
                        <div x-data="{ open: false }" class="header__login-dropdown">
                            <button @click="open = !open" class="header__login header__login-btn">
                                @if (Session::get('user_authenticated'))
                                Hello {{ Session::get('user_name') }}
                                <svg width="20" height="23" viewBox="0 0 20 23" fill="none" xmlns="http://www.w3.org/2000/svg">
                                    <g clip-path="url(#clip0_1_214)">
                                        <path d="M9.92188 12.4023C11.3616 12.4023 12.7424 11.8229 13.7605 10.7914C14.7785 9.75998 15.3504 8.36103 15.3504 6.90234C15.3504 5.44365 14.7785 4.04471 13.7605 3.01326C12.7424 1.98181 11.3616 1.40234 9.92188 1.40234C8.48213 1.40234 7.10135 1.98181 6.08329 3.01326C5.06524 4.04471 4.4933 5.44365 4.4933 6.90234C4.4933 8.36103 5.06524 9.75998 6.08329 10.7914C7.10135 11.8229 8.48213 12.4023 9.92188 12.4023ZM7.98371 14.4648C3.80625 14.4648 0.421875 17.8937 0.421875 22.1262C0.421875 22.8309 0.985938 23.4023 1.68147 23.4023H18.1623C18.8578 23.4023 19.4219 22.8309 19.4219 22.1262C19.4219 17.8937 16.0375 14.4648 11.86 14.4648H7.98371Z" fill="#76E5A9" />
                                    </g>
                                    <defs>
                                        <clipPath id="clip0_1_214">
                                            <rect width="19" height="22" fill="white" transform="translate(0.421875 0.951172)" />
                                        </clipPath>
                                    </defs>
                                </svg>
                                @else
                                <a style="display: flex; align-items: start; gap:10px" class="dropdown-item user-icon-dropdown" href="{{ route('user.signin') }}" data-translate="login_btn">Log In
                                    <svg width="20" height="23" viewBox="0 0 20 23" fill="none" xmlns="http://www.w3.org/2000/svg">
                                        <g clip-path="url(#clip0_1_214)">
                                            <path d="M9.92188 12.4023C11.3616 12.4023 12.7424 11.8229 13.7605 10.7914C14.7785 9.75998 15.3504 8.36103 15.3504 6.90234C15.3504 5.44365 14.7785 4.04471 13.7605 3.01326C12.7424 1.98181 11.3616 1.40234 9.92188 1.40234C8.48213 1.40234 7.10135 1.98181 6.08329 3.01326C5.06524 4.04471 4.4933 5.44365 4.4933 6.90234C4.4933 8.36103 5.06524 9.75998 6.08329 10.7914C7.10135 11.8229 8.48213 12.4023 9.92188 12.4023ZM7.98371 14.4648C3.80625 14.4648 0.421875 17.8937 0.421875 22.1262C0.421875 22.8309 0.985938 23.4023 1.68147 23.4023H18.1623C18.8578 23.4023 19.4219 22.8309 19.4219 22.1262C19.4219 17.8937 16.0375 14.4648 11.86 14.4648H7.98371Z" fill="#76E5A9" />
                                        </g>
                                        <defs>
                                            <clipPath id="clip0_1_214">
                                                <rect width="19" height="22" fill="white" transform="translate(0.421875 0.951172)" />
                                            </clipPath>
                                        </defs>
                                    </svg>
                                </a>
                                @endif

                            </button>
                            <div x-show="open" @click.away="open = false" class="header__dropdown-content">
                                @if (Session::get('user_authenticated'))
                                <a href="{{ route('user.orders') }}" data-translate="my_orders_btn">My
                                    Orders</a>
                                <a href="{{ route('user.user_setting') }}" data-translate="user_setting_btn">User Settings</a>
                                <a href="{{ route('user.logout') }}" data-translate="logout_btn">Logout</a>
                                @endif
                            </div>
                        </div>
                        <div x-data="{ open: false }" class="header__login-dropdown">
                            <button @click="open = !open" class="header__login header__login-btn">
                                <div href="{{ route('user.cart') }}" class="header__cart">
                                    <span class="header__cart-count" id=cart-badge></span>
                                </div>
                            </button>
                            <div x-show="open" @click.away="open = false" id="cartCountDropdown" class="header__dropdown-content" style="right: 0px; width: 100px">
                                <a href="{{ route('user.cart') }}" data-translate="cart_btn">Cart</a>
                                <a href="#" id="clearCart" data-translate="clear_cart_btn">Clear Cart</a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="header__menu">
            <div class="container">
                <div class="header__menu-btn"></div>
                <nav class="menu">
                    <ul class="menu__list">
                        @if ($main_categories->count() > 0)
                        @foreach ($main_categories as $main_category)
                        <li class="menu__item">
                            <a href="#">
                                {{ $main_category->category_name }}
                            </a>
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
                            <ul class="sub-menu">
                                @foreach ($sub_categories as $subcategory)
                                @php
                                $productsCount = Product::where('sub_categories_id', $subcategory->id)->count();
                                @endphp
                                @if ($subcategory->parent_category_id == $main_category->id && $productsCount > 0)
                                <li>
                                    <a href="{{ route('sub.category.products', $subcategory->slug) }}">
                                        {{ $subcategory->sub_category_name }}
                                    </a>
                                </li>
                                @endif
                                @endforeach
                            </ul>
                            @endif
                        </li>
                        @endforeach
                        @endif
                    </ul>
                </nav>
            </div>
        </div>
    </header>
    <script src="https://code.jquery.com/jquery-3.6.4.min.js"></script>
    <!-- <script>
        $(document).ready(function() {
            $('#langSwitchBtn').click(function(event) {
                event.preventDefault();
                var currentLang = $('html').attr('lang');
                var newLang = (currentLang === 'en') ? 'ar' : 'en';

                $.ajax({
                    url: '/lang/' + newLang,
                    type: 'GET',
                    dataType: 'json',
                    success: function(data) {
                        $('[data-translate]').each(function() {
                            var key = $(this).attr('data-translate');
                            if (data[key]) {
                                $(this).text(data[key]);
                            }
                        });
                        $('html').attr('lang', newLang);
                    },
                    error: function(xhr, status, error) {
                        // Log the error message to the console
                        console.error('Error fetching translation:', error);
                        
                        // Construct a user-friendly error message
                        var errorMessage = 'An error occurred while fetching translations.';
                        errorMessage += ' Please try again later.';
                        
                        // Show the error message to the user
                        alert(errorMessage);
                    }
                });
            });
        });

    </script> -->
    <script>
        $(document).ready(function() {
            var buttonClicked = false;
            function fetchTranslations(lang) {
                console.log(lang);
                $.ajax({
                    url: '/lang/' + lang,
                    type: 'GET',
                    dataType: 'json',
                    success: function(data) {
                        $('[data-translate]').each(function() {
                            var key = $(this).attr('data-translate');
                            if (data[key]) {
                                $(this).text(data[key]);
                            }
                        });
                        $('html').attr('lang', lang);
                        $('body').css('direction', (lang === 'ar') ? 'rtl' : 'ltr');
                        $('.promo__slider ').css('direction', 'ltr');
                    },
                    error: function(xhr, status, error) {
                        console.error('Error fetching translation:', error);
                    }
                });
            }
            function getCountryByIP() {
                $.ajax({
                    url: 'https://ipinfo.io/json',
                    type: 'GET',
                    dataType: 'json',
                    success: function(data) {
                        var countryCode = data.country_code;
                        var lang = (countryCode === 'EG' || countryCode === 'SA' || countryCode === 'AE') ? 'ar' : 'en';
                        fetchTranslations(lang);
                    },
                    error: function(xhr, status, error) {
                        console.error('Error fetching country by IP:', error);
                        fetchTranslations('en');
                    }
                });
            }
            $('#langSwitchBtn').click(function(event) {
                event.preventDefault();
                buttonClicked = true;
                var currentLang = $('html').attr('lang');
                var newLang = (currentLang === 'en') ? 'ar' : 'en';
                fetchTranslations(newLang);
            });
            // if (!buttonClicked) {
            //     getCountryByIP();
            // }
        });
    </script>
    <script>
        $(document).ready(function() {
            $.ajax({
                type: 'GET',
                url: "/cart/total-count",
                data: {
                    user_id: @json($user_id ?? $without_user_add_to_Cart),
                    _token: $('meta[name="csrf-token"]').attr('content'),
                },
                success: function(response) {
                    if (response.success) {
                        console.log("-----------", response.success);
                        $("#cart-badge").text(response.totalCount);
                        updateCartBadgeCount();
                    }
                },
                error: function(data) {
                    console.log(data);
                },
            });
            $("#clearCart").on("click", function(e) {
                e.preventDefault();
                Swal.fire({
                    title: 'Are you sure?',
                    text: "This action will clear your cart!",
                    icon: 'warning',
                    showCancelButton: true,
                    confirmButtonColor: '#03045E',
                    cancelButtonColor: '#d33',
                    confirmButtonText: 'Yes, clear it!'
                }).then((result) => {
                    if (result.isConfirmed) {
                        $.ajax({
                            url: "{{ route('cart.delete.all') }}",
                            method: "GET",
                            success: function(response) {
                                Swal.fire({
                                    title: 'Cleared!',
                                    text: 'Your cart has been cleared.',
                                    icon: 'success',
                                    iconColor: '#03045E',
                                    confirmButtonColor: '#03045E',
                                    confirmButtonText: 'OK'
                                });
                                updateCartBadgeCount();
                            },
                            error: function(error) {
                                Swal.fire('Error!', 'Unable to clear the cart.',
                                    'error');
                            }
                        });
                    }
                });
            });

            function updateCartBadgeCount() {
                var count = $("#cart-badge").text();
                if (count == 0) {
                    console.log('count is 0');
                    $('#cartCountDropdown').addClass('invisible');
                } else {
                    $('#cartCountDropdown').removeClass('invisible');
                }
            }
        });
    </script>

</body>

</html>