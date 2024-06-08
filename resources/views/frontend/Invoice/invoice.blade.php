
<!DOCTYPE html>
<html class="no-js" lang="en">

<head>
  <!-- Meta Tags -->
  <meta charset="utf-8">
  <meta http-equiv="x-ua-compatible" content="ie=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <meta name="author" content="ThemeMarch">
  <!-- Site Title -->
  <title>General Invoice</title>
  <link rel="stylesheet" href="{{url('invoice-css/assets/css/style.css')}}">
  <style>
    body #sizer
    {
        display: none !important;
    }
    .btn-bg-color
    {
        background: #CAF0F8  !important;
        color: black !important;
    }
  </style>
</head>

<body>
  <div class="cs-container">
    <div class="cs-invoice cs-style1">
      <div class="cs-invoice_in" id="download_section">
        <div class="cs-invoice_head cs-type1 cs-mb25">
          <div class="cs-invoice_left">
            <!-- <p class="cs-invoice_number cs-primary_color cs-mb5 cs-f16"><b class="cs-primary_color">Invoice No:</b> #FS{{$order->invoice_no}}</p> -->
            <p class="cs-invoice_number cs-mb5 cs-f16" style="color: #021A6F;"><b data-translate="order_received">Order Received</b></p>
            <p class="cs-invoice_date  cs-m0" style="color: #021A6F;"><b><span data-translate="date">Date</span>: </b>{{$order->created_at->format('j-M-Y')}}</p>
          </div>
          <div class="cs-invoice_right cs-text_right">
            <div class="cs-logo cs-mb5"><img src="{{ asset('updated-assets/images/logo.svg') }}" alt="Logo" style="height: 91px;width: 183px;"></div>
          </div>
        </div>
        <div class="cs-invoice_head cs-mb10" style="color: #021A6F">
          <div class="cs-invoice_left">
            <!-- <b class="cs-primary_color">Invoice To:</b> -->
            <p>
                {{ $order->customer->first_name }} {{ $order->customer->last_name }}<br>
                {{ $order->customer->address }}<br>{{ $order->customer->email }}<br>
            </p>
          </div>
          <div class="cs-invoice_right cs-text_right">
            <!-- <b class="cs-primary_color">Pay To:</b> -->
            <p>
                Office Tech<br>
                Tahlyah St., P.O.Box: 5967 Postal Code: 21432<br>
                info@officetech.com.sa
            </p>
          </div>
        </div>
        <div class="cs-table cs-style1">
          <div class="cs-round_border">
            <div class="cs-table_responsive" style="color: #021A6F;">
              <table>
                <thead>
                  <tr>
                    <th class="cs-width_3 cs-semi_bold  cs-focus_bg">#</th>
                    <th class="cs-width_3 cs-semi_bold  cs-focus_bg" data-translate="item">Item</th>
                    <th class="cs-width_4 cs-semi_bold  cs-focus_bg" data-translate="quantity">Qty</th>
                    <th class="cs-width_2 cs-semi_bold  cs-focus_bg" data-translate="price">Price</th>
                    <th class="cs-width_2 cs-semi_bold  cs-focus_bg" data-translate="sale_price">Sale Price</th>
                    <th class="cs-width_1 cs-semi_bold  cs-focus_bg" data-translate="total">Total</th>
                  </tr>
                </thead>
                <tbody>
                    @foreach ($productQuantities as $orderQuantity)
                        <tr class="border-bottom">
                            <td class="cs-width_3">{{$loop->index+1}}</td>
                            <td class="cs-width_4">{{ $orderQuantity->product->name }}</td>
                            <td class="cs-width_2">{{ $orderQuantity->quantity }}</td>
                            <td class="cs-width_1">{{ $orderQuantity->product->price }} <span data-translate="sar">SAR</span> </td>
                            <td class="cs-width_1">{{ $orderQuantity->product->sale_price ?? '0' }} <span data-translate="sar">SAR</span> </td>
                            <td class="cs-width_2">{{ $orderQuantity->product->sale_price ? $orderQuantity->product->sale_price * $orderQuantity->quantity : $orderQuantity->product->price * $orderQuantity->quantity }} SAR</td>
                        </tr>
                    @endforeach 
                </tbody>
              </table>
            </div>
            <div class="cs-invoice_footer cs-border_top">
              <div class="cs-left_footer cs-mobile_hide" style="color: #021A6F;">
                <p class="cs-mb0"><b data-translate="additional_information">Additional Information:</b></p>
                <p class="cs-m0" data-translate="at_check_in_you_may_need_to_present_the_credit_card">At check in you may need to present the credit card <br> <span data-translate="used_for_payment">used for payment of this ticket.</span> </p>
              </div>
              <div class="cs-right_footer">
                <table>
                <tbody style="color: #021A6F;">
                    <tr class="cs-border_left">
                      <td class="cs-width_3 cs-semi_bold  cs-focus_bg" data-translate="sub_totall">Subtotal</td>
                      <td class="cs-width_3 cs-semi_bold cs-focus_bg  cs-text_right">{{$order->total_amount }} SAR</td>
                    </tr>
                    <tr class="cs-border_left">
                        <td class="cs-width_3 cs-semi_bold  cs-focus_bg" data-translate="shipping">Shipping</td>
                        @if ($order->shipping_amount > 0)
                            <td class="cs-width_3 cs-semi_bold cs-focus_bg  cs-text_right">{{ $order->shipping_amount }} <span data-translate="sar"> SAR</td>
                        @else
                            <td class="cs-width_3 cs-semi_bold cs-focus_bg  cs-text_right">0 <span data-translate="sar">SAR</span> </td>
                        @endif
                    </tr>
                    <tr class="cs-border_left">
                        <td class="cs-width_3 cs-semi_bold  cs-focus_bg" data-translate="discount">Discount</td>
                        <td class="cs-width_3 cs-semi_bold cs-focus_bg  cs-text_right">{{ $order->discount_amount ?? '0' }} SAR</td>
                    </tr>
                    <tr class="cs-border_left">
                      <td class="cs-width_3 cs-semi_bold  cs-focus_bg" data-translate="vat">VAT (15%)</td>
                      <td class="cs-width_3 cs-semi_bold cs-focus_bg  cs-text_right">
                          {{ $order->vat_amount }} <span data-translate="sar">SAR</span> 
                      </td>
                    </tr>
                  </tbody>
                </table>
              </div>
            </div>
          </div>
          <div class="cs-invoice_footer">
            <div class="cs-left_footer cs-mobile_hide"></div>
            <div class="cs-right_footer">
              <table>
                <tbody>
                <tr class="cs-border_none" style="color: #021A6F;">
                    <td class="cs-width_3 cs-border_top_0 cs-bold cs-f16" data-translate="total_amount">Total Amount</td>
                    <td class="cs-width_3 cs-border_top_0 cs-bold cs-f16 cs-text_right">
                        {{ ($order->grand_total) }} <span data-translate="sar">SAR</span> 
                    </td>
                </tr>
                </tbody>
              </table>
            </div>
          </div>
        </div>
        <!-- <div class="cs-note">
          <div class="cs-note_left">
            <svg xmlns="http://www.w3.org/2000/svg" class="ionicon" viewBox="0 0 512 512"><path d="M416 221.25V416a48 48 0 01-48 48H144a48 48 0 01-48-48V96a48 48 0 0148-48h98.75a32 32 0 0122.62 9.37l141.26 141.26a32 32 0 019.37 22.62z" fill="none" stroke="currentColor" stroke-linejoin="round" stroke-width="32"/><path d="M256 56v120a32 32 0 0032 32h120M176 288h160M176 368h160" fill="none" stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="32"/></svg>
          </div>
          <div class="cs-note_right">
            <p class="cs-mb0"><b class="cs-primary_color cs-bold">Note:</b></p>
            <p class="cs-m0">Free Shipping With 30 Days Money Back Guraantee</p>
          </div>
        </div> -->
      </div>
      <div class="cs-invoice_btns cs-hide_print">
        <button id="download_btn" class="cs-invoice_btn cs-color2 btn-bg-color">
          <svg xmlns="http://www.w3.org/2000/svg" style="color: #03045E;" class="ionicon" viewBox="0 0 512 512"><title data-translate="download">Download</title><path d="M336 176h40a40 40 0 0140 40v208a40 40 0 01-40 40H136a40 40 0 01-40-40V216a40 40 0 0140-40h40" fill="none" stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="32"/><path fill="none" stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="32" d="M176 272l80 80 80-80M256 48v288"/></svg>
          <span style="color: #03045E;" data-translate="download">Download</span>
        </button>
      </div>
    </div>
  </div>
  <script src="{{url('invoice-css/assets/js/jquery.min.js')}}"></script>
  <script src="{{url('invoice-css/assets/js/jspdf.min.js')}}"></script>
  <script src="{{url('invoice-css/assets/js/html2canvas.min.js')}}"></script>
  <script src="{{url('invoice-css/assets/js/main.js')}}"></script>
</body>
</html>