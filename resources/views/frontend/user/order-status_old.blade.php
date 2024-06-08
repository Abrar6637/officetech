@extends('frontend.layout.main')
@section('title', 'Office Tech - Order Status')
@section('main.container')
<main class="main margin" >
    <div class="breadcrumb-container">
        <div class="container">
            <ul class="breadcrumb">
                <li><a href="/">Home</a></li>
                <li class="slash">/</li>
                <li>About Us</li>
            </ul>
        </div>
    </div>
    <div class="container px-md-4 py-5 mx-auto section-top">
        <div class="card order-status-card p-5">
            <div class="d-flex justify-content-between p-4"
                style="border-radius: 4px;background: rgba(0, 169, 225, 0.09);">
                <div>
                    <p style="color: #191C1F;
                        font-family: Figtree;
                        font-size: 14px;
                        font-style: normal;
                        font-weight: 400;
                        line-height: 20px;"> <strong>#96459761</strong></p>
                    <p style="color: #475156;
                        font-family: Figtree;
                        font-size: 14px;
                        font-style: normal;
                        font-weight: 400;
                        line-height: 20px;">4 Products . Order Placed in 17 Jan, 2021 at 7:32 PM</p>
                </div>
                <div>
                    <p style="color: #00A9E1;
                        font-family: Figtree;
                        font-size: 14px;
                        font-style: normal;
                        font-weight: 700;
                        line-height: 20px;">1199.00 SAR</p>
                </div>
            </div>
            <div class="row d-flex justify-content-between top" style="padding-bottom: 0px !important;">
                <div>
                    <p>Order expected arrival <strong> 23 Jan, 2021</strong></p>
                </div>

            </div>
            <!-- Add class 'active' to progress -->
            <div class="row d-flex justify-content-center">
                <div class="col-12">
                    <ul id="order-progress-bar" class="text-center">
                        <li class="active step0"></li>
                        <li class="active step0"></li>
                        <li class="active step0"></li>
                        <li class="step0"></li>
                    </ul>
                </div>
            </div>
            <div class="row col-12">
                <div class="col-3 text-center">
                    <svg class="icon" width="32" height="32" viewBox="0 0 32 32" fill="none"
                        xmlns="http://www.w3.org/2000/svg">
                        <path opacity="0.2"
                            d="M10 27H6C5.73478 27 5.48043 26.8946 5.29289 26.7071C5.10536 26.5196 5 26.2652 5 26V6C5 5.73478 5.10536 5.48043 5.29289 5.29289C5.48043 5.10536 5.73478 5 6 5H10V27Z"
                            fill="#2DB324" />
                        <path d="M14 14H22" stroke="#2DB324" stroke-width="2" stroke-linecap="round"
                            stroke-linejoin="round" />
                        <path d="M14 18H22" stroke="#2DB324" stroke-width="2" stroke-linecap="round"
                            stroke-linejoin="round" />
                        <path
                            d="M26 5H6C5.44772 5 5 5.44772 5 6V26C5 26.5523 5.44772 27 6 27H26C26.5523 27 27 26.5523 27 26V6C27 5.44772 26.5523 5 26 5Z"
                            stroke="#2DB324" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" />
                        <path d="M10 5V27" stroke="#2DB324" stroke-width="2" stroke-linecap="round"
                            stroke-linejoin="round" />
                    </svg>
                    <div class="d-flex flex-column">
                        <p class="font-weight-bold order-status-text">Order Processed</p>
                    </div>
                </div>
                <div class="col-3 text-center">
                    <svg class="icon" width="32" height="32" viewBox="0 0 32 32" fill="none"
                        xmlns="http://www.w3.org/2000/svg">
                        <path opacity="0.2"
                            d="M4.1375 9.32422C4.04693 9.47979 3.99946 9.6567 4 9.83672V22.1617C4.00096 22.3397 4.04884 22.5144 4.13882 22.668C4.2288 22.8216 4.35769 22.9488 4.5125 23.0367L15.5125 29.2242C15.6608 29.309 15.8292 29.3521 16 29.3492L16.1125 15.9992L4.1375 9.32422Z"
                            fill="#00A9E1" />
                        <path
                            d="M28 22.1627V9.83766C27.999 9.65963 27.9512 9.485 27.8612 9.33137C27.7712 9.17775 27.6423 9.05057 27.4875 8.96266L16.4875 2.77516C16.3393 2.68958 16.1711 2.64453 16 2.64453C15.8289 2.64453 15.6607 2.68958 15.5125 2.77516L4.5125 8.96266C4.35769 9.05057 4.22879 9.17775 4.13882 9.33137C4.04884 9.485 4.00096 9.65963 4 9.83766V22.1627C4.00096 22.3407 4.04884 22.5153 4.13882 22.6689C4.22879 22.8226 4.35769 22.9497 4.5125 23.0377L15.5125 29.2252C15.6607 29.3107 15.8289 29.3558 16 29.3558C16.1711 29.3558 16.3393 29.3107 16.4875 29.2252L27.4875 23.0377C27.6423 22.9497 27.7712 22.8226 27.8612 22.6689C27.9512 22.5153 27.999 22.3407 28 22.1627V22.1627Z"
                            stroke="#00A9E1" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" />
                        <path d="M22.125 19.0625V12.5625L10 5.875" stroke="#00A9E1" stroke-width="2"
                            stroke-linecap="round" stroke-linejoin="round" />
                        <path d="M27.8624 9.32422L16.1125 15.9992L4.13745 9.32422" stroke="#00A9E1" stroke-width="2"
                            stroke-linecap="round" stroke-linejoin="round" />
                        <path d="M16.1125 16L16 29.35" stroke="#00A9E1" stroke-width="2" stroke-linecap="round"
                            stroke-linejoin="round" />
                    </svg>
                    <div class="d-flex flex-column">
                        <p class="font-weight-bold order-status-text">Order Shipped</p>
                    </div>
                </div>
                <div class="col-3 text-center">
                    <svg class="icon" width="32" height="32" viewBox="0 0 32 32" fill="none"
                        xmlns="http://www.w3.org/2000/svg">
                        <path opacity="0.2"
                            d="M22 18H2V23C2 23.2652 2.10536 23.5196 2.29289 23.7071C2.48043 23.8946 2.73478 24 3 24H5.5C5.5 23.2044 5.81607 22.4413 6.37868 21.8787C6.94129 21.3161 7.70435 21 8.5 21C9.29565 21 10.0587 21.3161 10.6213 21.8787C11.1839 22.4413 11.5 23.2044 11.5 24H20.5C20.4997 23.4731 20.6381 22.9553 20.9014 22.4989C21.1648 22.0425 21.5437 21.6635 22 21.4V18Z"
                            fill="#00A9E1" />
                        <path opacity="0.2"
                            d="M26.5 24C26.5003 23.4732 26.362 22.9557 26.0988 22.4993C25.8356 22.043 25.4569 21.664 25.0008 21.4005C24.5447 21.1369 24.0273 20.9982 23.5005 20.9981C22.9737 20.998 22.4562 21.1366 22 21.4V15H30V23C30 23.2652 29.8946 23.5196 29.7071 23.7071C29.5196 23.8946 29.2652 24 29 24H26.5Z"
                            fill="#00A9E1" />
                        <path
                            d="M22 10H27.325C27.5242 9.99872 27.7192 10.0577 27.8843 10.1693C28.0494 10.2808 28.1769 10.4397 28.25 10.625L30 15"
                            stroke="#00A9E1" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" />
                        <path d="M2 18H22" stroke="#00A9E1" stroke-width="2" stroke-linecap="round"
                            stroke-linejoin="round" />
                        <path
                            d="M23.5 27C25.1569 27 26.5 25.6569 26.5 24C26.5 22.3431 25.1569 21 23.5 21C21.8431 21 20.5 22.3431 20.5 24C20.5 25.6569 21.8431 27 23.5 27Z"
                            stroke="#00A9E1" stroke-width="2" stroke-miterlimit="10" />
                        <path
                            d="M8.5 27C10.1569 27 11.5 25.6569 11.5 24C11.5 22.3431 10.1569 21 8.5 21C6.84315 21 5.5 22.3431 5.5 24C5.5 25.6569 6.84315 27 8.5 27Z"
                            stroke="#00A9E1" stroke-width="2" stroke-miterlimit="10" />
                        <path d="M20.5 24H11.5" stroke="#00A9E1" stroke-width="2" stroke-linecap="round"
                            stroke-linejoin="round" />
                        <path
                            d="M5.5 24H3C2.73478 24 2.48043 23.8946 2.29289 23.7071C2.10536 23.5196 2 23.2652 2 23V9C2 8.73478 2.10536 8.48043 2.29289 8.29289C2.48043 8.10536 2.73478 8 3 8H22V21.4"
                            stroke="#00A9E1" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" />
                        <path
                            d="M22 15H30V23C30 23.2652 29.8946 23.5196 29.7071 23.7071C29.5196 23.8946 29.2652 24 29 24H26.5"
                            stroke="#00A9E1" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" />
                    </svg>
                    <div class="d-flex flex-column">
                        <p class="font-weight-bold order-status-text">Order En Route</p>
                    </div>
                </div>
                <div class="col-3 text-center">
                    <svg class="icon" width="32" height="32" viewBox="0 0 32 32" fill="none"
                        xmlns="http://www.w3.org/2000/svg">
                        <path opacity="0.2"
                            d="M25 19.1118L20.4 23.7118C20.2746 23.829 20.1227 23.9141 19.9573 23.9599C19.7918 24.0056 19.6178 24.0105 19.45 23.9743L12.2 22.1618C12.0676 22.1249 11.9442 22.061 11.8375 21.9743L5 16.6368L9.075 8.97429L15.4875 7.09929C15.7154 7.03395 15.959 7.05167 16.175 7.14929L20.5 9.11179H17.9125C17.7826 9.11134 17.654 9.1365 17.5339 9.18583C17.4138 9.23516 17.3045 9.3077 17.2125 9.39929L12.3125 14.2868C12.2125 14.3895 12.1354 14.5123 12.0863 14.647C12.0373 14.7818 12.0174 14.9254 12.0281 15.0684C12.0387 15.2114 12.0796 15.3505 12.148 15.4765C12.2164 15.6025 12.3109 15.7125 12.425 15.7993L13.1 16.3118C13.7932 16.8292 14.635 17.1087 15.5 17.1087C16.365 17.1087 17.2068 16.8292 17.9 16.3118L19.5 15.1118L25 19.1118Z"
                            fill="#00A9E1" />
                        <path
                            d="M30.0875 15.2241L27 16.7616L23 9.11161L26.125 7.54911C26.3572 7.43073 26.6269 7.40898 26.8751 7.48859C27.1233 7.56821 27.33 7.74274 27.45 7.97411L30.525 13.8616C30.5874 13.9795 30.6255 14.1086 30.6372 14.2414C30.6489 14.3742 30.634 14.5081 30.5932 14.635C30.5525 14.762 30.4867 14.8795 30.3999 14.9806C30.313 15.0818 30.2068 15.1646 30.0875 15.2241V15.2241Z"
                            stroke="#00A9E1" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" />
                        <path
                            d="M5.00003 16.6385L1.91253 15.0885C1.79365 15.0302 1.6877 14.9486 1.60098 14.8486C1.51425 14.7486 1.44853 14.6321 1.40772 14.5062C1.3669 14.3802 1.35183 14.2474 1.36339 14.1155C1.37496 13.9836 1.41292 13.8554 1.47503 13.7385L4.55003 7.85097C4.67032 7.61976 4.87613 7.44464 5.12361 7.36293C5.3711 7.28121 5.64072 7.29934 5.87503 7.41347L9.00003 8.97597L5.00003 16.6385Z"
                            stroke="#00A9E1" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" />
                        <path
                            d="M27 16.7617L25 19.1117L20.4 23.7117C20.2746 23.829 20.1227 23.9141 19.9573 23.9598C19.7918 24.0055 19.6178 24.0105 19.45 23.9742L12.2 22.1617C12.0676 22.1248 11.9442 22.061 11.8375 21.9742L5 16.6367"
                            stroke="#00A9E1" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" />
                        <path
                            d="M25.0001 19.1133L19.5001 15.1133L17.9001 16.3133C17.2069 16.8307 16.3651 17.1102 15.5001 17.1102C14.6351 17.1102 13.7933 16.8307 13.1001 16.3133L12.4251 15.8008C12.311 15.714 12.2166 15.604 12.1481 15.478C12.0797 15.352 12.0388 15.2129 12.0282 15.0699C12.0175 14.9269 12.0374 14.7833 12.0864 14.6485C12.1355 14.5138 12.2126 14.391 12.3126 14.2883L17.2126 9.40079C17.3047 9.3092 17.4139 9.23666 17.534 9.18732C17.6541 9.13799 17.7828 9.11283 17.9126 9.11329H23.0001"
                            stroke="#00A9E1" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" />
                        <path
                            d="M9.07495 8.97429L15.4875 7.09929C15.7153 7.03395 15.959 7.05167 16.175 7.14929L20.5 9.11179"
                            stroke="#00A9E1" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" />
                        <path d="M14 26.6125L10.2375 25.6625C10.0842 25.6279 9.94221 25.5547 9.825 25.45L7 23"
                            stroke="#00A9E1" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" />
                    </svg>

                    <div class="d-flex flex-column">
                        <p class="font-weight-bold order-status-text">Order Arrived</p>
                    </div>
                </div>
            </div>
        </div>
        <div class="d-flex flex-column gap-4 bg-white p-5 mb-5">


            <div class="d-flex gap-3">
                <svg width="48" height="48" viewBox="0 0 48 48" fill="none" xmlns="http://www.w3.org/2000/svg">
                    <rect x="0.5" y="0.5" width="47" height="47" rx="1.5" fill="#EAF7E9" />
                    <path d="M25.875 19.875L17.625 28.125L13.5 24" stroke="#2DB324" stroke-width="1.5"
                        stroke-linecap="round" stroke-linejoin="round" />
                    <path d="M34.5 19.875L26.25 28.125L24.0563 25.9313" stroke="#2DB324" stroke-width="1.5"
                        stroke-linecap="round" stroke-linejoin="round" />
                    <rect x="0.5" y="0.5" width="47" height="47" rx="1.5" stroke="#D5F0D3" />
                </svg>
                <div class="text-start">
                    <h6 style="font-size:14px ; font-weight:400; color:black">Your order has been delivered. Thank
                        you
                        for shopping at Clicon!</h6>
                    <h6>23 Jan, 2021 at 7:32 PM</h6>
                </div>


            </div>
            <div class="d-flex gap-3">
                <svg width="48" height="48" viewBox="0 0 48 48" fill="none" xmlns="http://www.w3.org/2000/svg">
                    <rect x="0.5" y="0.5" width="47" height="47" rx="1.5" fill="#EAF6FE" />
                    <path
                        d="M24 27C27.3137 27 30 24.3137 30 21C30 17.6863 27.3137 15 24 15C20.6863 15 18 17.6863 18 21C18 24.3137 20.6863 27 24 27Z"
                        stroke="#2DA5F3" stroke-width="1.5" stroke-miterlimit="10" />
                    <path
                        d="M14.9062 32.2508C15.8278 30.6544 17.1533 29.3287 18.7496 28.407C20.3459 27.4853 22.1567 27 24 27C25.8433 27 27.6541 27.4853 29.2504 28.407C30.8467 29.3287 32.1722 30.6544 33.0938 32.2508"
                        stroke="#2DA5F3" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round" />
                    <rect x="0.5" y="0.5" width="47" height="47" rx="1.5" stroke="#D5EDFD" />
                </svg>

                <div class="text-start">
                    <h6 style="font-size:14px ; font-weight:400; color:black">Your order has been delivered. Thank
                        you
                        for shopping at Clicon!</h6>
                    <h6>23 Jan, 2021 at 7:32 PM</h6>
                </div>


            </div>
            <div class="d-flex gap-3">
                <svg width="48" height="48" viewBox="0 0 48 48" fill="none" xmlns="http://www.w3.org/2000/svg">
                    <rect x="0.5" y="0.5" width="47" height="47" rx="1.5" fill="#EAF6FE" />
                    <path d="M17.25 33.75H30.75" stroke="#2DA5F3" stroke-width="1.5" stroke-linecap="round"
                        stroke-linejoin="round" />
                    <path
                        d="M31.5 21.75C31.5 28.5 24 33.75 24 33.75C24 33.75 16.5 28.5 16.5 21.75C16.5 19.7609 17.2902 17.8532 18.6967 16.4467C20.1032 15.0402 22.0109 14.25 24 14.25C25.9891 14.25 27.8968 15.0402 29.3033 16.4467C30.7098 17.8532 31.5 19.7609 31.5 21.75V21.75Z"
                        stroke="#2DA5F3" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round" />
                    <path
                        d="M24 24.75C25.6569 24.75 27 23.4069 27 21.75C27 20.0931 25.6569 18.75 24 18.75C22.3431 18.75 21 20.0931 21 21.75C21 23.4069 22.3431 24.75 24 24.75Z"
                        stroke="#2DA5F3" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round" />
                    <rect x="0.5" y="0.5" width="47" height="47" rx="1.5" stroke="#D5EDFD" />
                </svg>

                <div class="text-start">
                    <h6 style="font-size:14px ; font-weight:400; color:black">Your order has been delivered. Thank
                        you
                        for shopping at Clicon!</h6>
                    <h6>23 Jan, 2021 at 7:32 PM</h6>
                </div>


            </div>
            <div class="d-flex gap-3">
                <svg width="48" height="48" viewBox="0 0 48 48" fill="none" xmlns="http://www.w3.org/2000/svg">
                    <rect x="0.5" y="0.5" width="47" height="47" rx="1.5" fill="#EAF6FE" />
                    <path d="M21 29.25L15 30.75V17.25L21 15.75" stroke="#2DA5F3" stroke-width="1.5"
                        stroke-linecap="round" stroke-linejoin="round" />
                    <path d="M27 32.25L21 29.25V15.75L27 18.75V32.25Z" stroke="#2DA5F3" stroke-width="1.5"
                        stroke-linecap="round" stroke-linejoin="round" />
                    <path d="M27 18.75L33 17.25V30.75L27 32.25" stroke="#2DA5F3" stroke-width="1.5"
                        stroke-linecap="round" stroke-linejoin="round" />
                    <rect x="0.5" y="0.5" width="47" height="47" rx="1.5" stroke="#D5EDFD" />
                </svg>

                <div class="text-start">
                    <h6 style="font-size:14px ; font-weight:400; color:black">Your order has been delivered. Thank
                        you
                        for shopping at Clicon!</h6>
                    <h6>23 Jan, 2021 at 7:32 PM</h6>
                </div>


            </div>
            <div class="d-flex gap-3">
                <svg width="48" height="48" viewBox="0 0 48 48" fill="none" xmlns="http://www.w3.org/2000/svg">
                    <rect x="0.5" y="0.5" width="47" height="47" rx="1.5" fill="#EAF7E9" />
                    <path d="M28.125 21.75L22.6219 27L19.875 24.375" stroke="#2DB324" stroke-width="1.5"
                        stroke-linecap="round" stroke-linejoin="round" />
                    <path
                        d="M24 33C28.9706 33 33 28.9706 33 24C33 19.0294 28.9706 15 24 15C19.0294 15 15 19.0294 15 24C15 28.9706 19.0294 33 24 33Z"
                        stroke="#2DB324" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round" />
                    <rect x="0.5" y="0.5" width="47" height="47" rx="1.5" stroke="#D5F0D3" />
                </svg>

                <div class="text-start">
                    <h6 style="font-size:14px ; font-weight:400; color:black">Your order has been delivered. Thank
                        you
                        for shopping at Clicon!</h6>
                    <h6>23 Jan, 2021 at 7:32 PM</h6>
                </div>


            </div>
            <div class="d-flex gap-3">
                <svg width="48" height="48" viewBox="0 0 48 48" fill="none" xmlns="http://www.w3.org/2000/svg">
                    <rect x="0.5" y="0.5" width="47" height="47" rx="1.5" fill="#EAF6FE" />
                    <path d="M21 24H27" stroke="#2DA5F3" stroke-width="1.5" stroke-linecap="round"
                        stroke-linejoin="round" />
                    <path d="M21 27H27" stroke="#2DA5F3" stroke-width="1.5" stroke-linecap="round"
                        stroke-linejoin="round" />
                    <path
                        d="M17.25 15.75H30.75C30.9489 15.75 31.1397 15.829 31.2803 15.9697C31.421 16.1103 31.5 16.3011 31.5 16.5V30.75C31.5 31.3467 31.2629 31.919 30.841 32.341C30.419 32.7629 29.8467 33 29.25 33H18.75C18.1533 33 17.581 32.7629 17.159 32.341C16.7371 31.919 16.5 31.3467 16.5 30.75V16.5C16.5 16.3011 16.579 16.1103 16.7197 15.9697C16.8603 15.829 17.0511 15.75 17.25 15.75V15.75Z"
                        stroke="#2DA5F3" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round" />
                    <path d="M19.5 14.25V17.25" stroke="#2DA5F3" stroke-width="1.5" stroke-linecap="round"
                        stroke-linejoin="round" />
                    <path d="M24 14.25V17.25" stroke="#2DA5F3" stroke-width="1.5" stroke-linecap="round"
                        stroke-linejoin="round" />
                    <path d="M28.5 14.25V17.25" stroke="#2DA5F3" stroke-width="1.5" stroke-linecap="round"
                        stroke-linejoin="round" />
                    <rect x="0.5" y="0.5" width="47" height="47" rx="1.5" stroke="#D5EDFD" />
                </svg>

                <div class="text-start">
                    <h6 style="font-size:14px ; font-weight:400; color:black">Your order has been delivered. Thank
                        you
                        for shopping at Clicon!</h6>
                    <h6>23 Jan, 2021 at 7:32 PM</h6>
                </div>


            </div>
        </div>

    </div>
    <br><br>
    <br><br>
</main>
@endsection