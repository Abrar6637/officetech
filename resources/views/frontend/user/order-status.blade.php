@extends('frontend.layout.main')
@section('title', 'Office Tech - Order Status')
@section('main.container')

<div class="breadcrumbs">
    <div class="container">
        <div class="breadcrumbs__inner" data-translate="home">
            <a href="/">
                Home
            </a>
            <div class="el">
                /
            </div>
            <span data-translate="sales_order">
                Sales Order
            </span>
        </div>
    </div>
</div>

<main>
    <section class="otherPage pS">
        <div class="container">
            <div class="otherPage__inner">
                <h1 class="otherPage__title" data-translate="sales_order">
                    Sales Order
                </h1>
                <div class="otherPage__top">
                    <div>
                        <p>
                            <b data-translate="order_received">Order Received</b>
                        </p>
                        <p>
                            <b data-translate="date">Date</b>: 2-Jan-2024
                        </p>
                    </div>
                    <img src="images/logo.svg" alt="">
                </div>
                <div class="otherPage__items">
                    <div class="otherPage__item">
                        <p data-translate="customer_name">Customer Name</p>
                        <p data-translate="office_tech">Office Tech</p>
                    </div>
                    <div class="otherPage__item">
                        <p data-translate="address">Address</p>
                        <p>Tahlyah St., P.O.Box: 5967 Postal Code: 21432</p>
                    </div>
                    <div class="otherPage__item">
                        <p>emaid@gmail.com</p>
                        <p>info@officetech.com.sa</p>
                    </div>
                </div>
                <div class="otherPage__table">
                    <table>
                        <thead>
                            <tr>
                                <td>
                                    #
                                </td>
                                <td data-translate="item">
                                    Item
                                </td>
                                <td data-translate="quantity">
                                    Qty
                                </td>
                                <td data-translate="price">
                                    Price
                                </td>
                                <td data-translate="sale_price">
                                    Sale Price
                                </td>
                                <td data-translate="total">
                                    Total
                                </td>
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                                <td>
                                    1
                                </td>
                                <td>
                                    Konica Minolta Bizhub C226i MFP
                                </td>
                                <td>
                                    1
                                </td>
                                <td>
                                    9799 SAR
                                </td>
                                <td>
                                    0 SAR
                                </td>
                                <td>
                                    9799 SAR
                                </td>
                            </tr>
                        </tbody>
                    </table>
                </div>
                <div class="otherPage__bottom">
                    <div class="otherPage__bottom-l">
                        <div class="otherPage__bottom-title" data-translate="additional_information">
                            Additional Information:
                        </div>
                        <div class="otherPage__bottom-dscr" data-translate="at_check_in_you_may_need_to_present_the_credit_card_used_for_payment_of_this_ticket">
                            At check in you may need to present the creditcard used for payment of this ticket.
                        </div>
                    </div>
                    <div class="otherPage__bottom-info">
                        <div class="otherPage__bottom-item">
                            <span data-translate="sub_total">
                                Subtotal
                            </span>
                            <p>
                                157 SAR
                            </p>
                        </div>
                        <div class="otherPage__bottom-item">
                            <span data-translate="shipping">
                                Shipping
                            </span>
                            <p>
                                0 SAR
                            </p>
                        </div>
                        <div class="otherPage__bottom-item">
                            <span data-translate="discount">
                                Discount
                            </span>
                            <p>
                                0 SAR
                            </p>
                        </div>
                        <div class="otherPage__bottom-item">
                            <span>
                                VAT (15%)
                            </span>
                            <p>
                                0 SAR
                            </p>
                        </div>
                        <hr>
                        <div class="otherPage__bottom-item">
                            <span data-translate="total">
                                Total
                            </span>
                            <p>
                                256 SAR
                            </p>
                        </div>
                    </div>
                </div>
                <a download href="#" class="otherPage__btn btnHover" data-translate="download">
                    Download
                    <svg width="19" height="18" viewBox="0 0 19 18" fill="none" xmlns="http://www.w3.org/2000/svg">
                        <path
                            d="M7.53139 12.0625C8.62973 13.1609 10.4105 13.1609 11.5089 12.0625L11.5089 12.0625L13.5164 10.055C13.8888 9.69528 13.8991 9.10178 13.5394 8.72936C13.1797 8.35694 12.5862 8.34663 12.2138 8.70633C12.206 8.71386 12.1983 8.72157 12.1908 8.72936L10.4514 10.4681L10.437 1.9375C10.437 1.41974 10.0173 1 9.49952 1C8.98176 1 8.56202 1.41974 8.56202 1.9375L8.57515 10.4544L6.84953 8.72874C6.47711 8.36904 5.88362 8.37935 5.52391 8.75177C5.17302 9.11508 5.17302 9.69106 5.52391 10.0544L7.53139 12.0625Z"
                            fill="#03045E" />
                        <path
                            d="M16.0625 10.0627C15.5447 10.0627 15.125 10.4825 15.125 11.0002V13.8696C15.1246 14.0106 15.0104 14.1249 14.8694 14.1252H4.13061C3.98958 14.1249 3.87532 14.0106 3.875 13.8696V11.0002C3.875 10.4825 3.45526 10.0627 2.9375 10.0627C2.41974 10.0627 2 10.4825 2 11.0002V13.8696C2.00138 15.0458 2.95449 15.9989 4.13061 16.0002H14.8693C16.0455 15.9989 16.9986 15.0458 17 13.8696V11.0003C17 10.4825 16.5803 10.0627 16.0625 10.0627Z"
                            fill="#03045E" />
                    </svg>
                </a>
            </div>
        </div>
    </section>
</main>

@endsection