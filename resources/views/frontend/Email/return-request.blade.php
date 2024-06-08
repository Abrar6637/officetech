<!DOCTYPE html>
<html class="no-js" lang="en">

<head>
    <!-- Meta Tags -->
    <meta charset="utf-8">
    <meta http-equiv="x-ua-compatible" content="ie=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="author" content="ThemeMarch">
    <!-- Site Title -->
    <!-- <title>General Invoice</title> -->
    <link rel="stylesheet" href="{{ url('invoice-css/assets/css/style.css') }}">
    <style>
        body #sizer {
            display: none !important;
        }

        .btn-bg-color {
            background: #da5858 !important;
        }
        body, html {
            color: #000;
            font-family: "Inter", sans-serif;
            font-size: 14px;
            font-weight: 400;
            line-height: 1.5em;
            overflow-x: hidden;
            background-color: #f5f7ff;
        }
    </style>
</head>

<body>
    <div class="cs-container">
        <div class="cs-invoice cs-style1">
            <div class="cs-invoice_in" id="download_section">
                <div class="cs-invoice_head cs-type1 cs-mb25">
                    <div class="cs-invoice_left">
                        <!-- <p class="cs-invoice_number cs-primary_color cs-mb5 cs-f16"><b class="cs-primary_color">Invoice No:</b> #FS{{ $order->invoice_no }}</p> -->
                        <p class="cs-invoice_number cs-primary_color cs-mb5 cs-f16"><b class="cs-primary_color">Return
                                Request Received</b></p>
                        <p class="cs-invoice_date cs-primary_color cs-m0"><b class="cs-primary_color">Date:
                            </b>{{ $order->created_at->format('j-M-Y') }}</p>
                    </div>
                    <div class="cs-invoice_right cs-text_right">
                        <div class="cs-logo cs-mb5"><img src="{{ url('updated-assets/images/logo.svg') }}" alt="Logo"
                                style="height: 91px;width: 183px;"></div>
                    </div>
                </div>
                <div class="cs-invoice_head cs-mb10">
                    <div class="cs-invoice_left">
                        <!-- <b class="cs-primary_color">Invoice To:</b> -->
                        <p>
                            Dear, Admin, {{ $order->order_number }} has been received, Please review and update the
                            status of the Return Request in the Admin Dashboard.
                            {{-- {{ $order->customer->first_name }} {{ $order->customer->last_name }}<br>
              {{ $order->customer->address }}<br>{{ $order->customer->email }}<br> --}}
                        </p>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <script src="{{ url('invoice-css/assets/js/jquery.min.js') }}"></script>
    <script src="{{ url('invoice-css/assets/js/jspdf.min.js') }}"></script>
    <script src="{{ url('invoice-css/assets/js/html2canvas.min.js') }}"></script>
    <script src="{{ url('invoice-css/assets/js/main.js') }}"></script>
</body>

</html>
