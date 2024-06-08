@extends('frontend.layout.main')
@section('title', 'Office Tech - Return-Policy')
@section('main.container')
<style>
    h3
    {
        color: #323232 !important;
        font-family: 'Figtree' !important;
        font-size: 28px !important;
        font-style: normal !important;
        font-weight: 700 !important;
        line-height: 103% !important;
        letter-spacing: 0.183px !important;
    }
    .mb-3 ol li
    {
        color: #323232;
        font-family: 'Figtree';
        font-size: 18px;
        font-style: normal;
        font-weight: 400;
        line-height: 30px;
        letter-spacing: 0.183px;
    }
    .mb-3 p
    {
        color: #323232;
        font-family: 'Figtree';
        font-size: 18px;
        font-style: normal;
        font-weight: 400;
        line-height: 30px;
        letter-spacing: 0.183px;
    }
</style>
<main class="main">
<div class="breadcrumbs">
        <div class="container">
            <div class="breadcrumbs__inner">
                <a href="/">
                    Home
                </a>
                <div class="el">
                    /
                </div>
                <span>
                  Return Policy
                </span>
            </div>
        </div>
    </div>
    <div class="container mt-4" style="padding-bottom: 50px">
        <div class="row">
            @if ($returnPolicy)
                <?php
                    $content = $returnPolicy->content;
                    $allowedTags = '<h1><h3><li><ol><p>';
                    $strippedContent = strip_tags($content, $allowedTags);
                ?>
                {!! $strippedContent !!}
            @else
                <div class="col-12" style="display:flex; flex-direction:column; gap:20px">
                    <div>
                        <h1>Return and Exchange Policy</h1>
                        <p>To request a return/exchange, please read this page carefully then get your order number and:
                            Send us a message on contact us page,
                            Chat with us using the chat application on the website or
                            Send us an email on <a href="mailto:Info@officetech.com.sa" style="color: #0831c9">Info@officetech.com.sa</a> with order number and your concerns.
                            Return/exchange requests will be approved only if below conditions are met:
                            Item(s) still in original packing as received.
                            Within 2 days from received date
                            Products and services in promotion are subject to exchange only not to return in case conditions in previous point are met.
                            A refund request for full/part of order value will be generated from our side after the approval of your return request.
                            Refund may take up to 45 days based on payment method and bank used.
                        </p>
                    </div>
                    <div>
                        <h1>
                        For Received Orders 
                        </h1>
                        <p>
                            Order or part of order can be returned/exchanged without applying/deducting any charges only if:
                            Item received is not the item ordered,
                            Item’s specifications received are not matching specification/description of item displayed on website or
                            Packaging of item received is damaged.
                            Shipping charges and additional collecting fees will be deducted from order value if you want to return/exchange item(s) for cases other than mentioned in point A above.
                            We will inform you regarding orders or part of value (for some orders) which will be saved in your account as credit so you can use it for new orders.
                        </p>
                    </div>
                    <div>
                        <h1>For Requested Services</h1>
                        <p>Requests can be accepted to process a refund without applying/deducting any charges only if:
                            Machine/device is still in your site and no visit from technician is made after your request.
                            If the machine/device is collected from your site to be fixed in one of our service centers and you decided for any reason to cancel your request within 4 hours from collection, then collecting and returning charges will be deducted/applied on your service request.
                            Any amount submitted while the status of the request currently is “Processing” or “Completed” is not refundable.
                            .</p>
                    </div>
                    <div>
                        <h1>For Rental Plans</h1>
                        <p>Requests can be accepted to process a refund with deducting/applying management charges only if all below are met:
                            Within 24 hours from order payment date.
                            Machine/device is not received.
                            Status of the subscription is “Not Active”.
                        </p>
                    </div>
                </div>
                    <div style="display:flex; flex-direction:column; gap:20px">
                        
                        <ul style="direction:rtl">
                            <li>
                                <h1>سياسة الإسترجاع و الإستبدال</h1>
                                <p>بشكل عام ، الخدمة متاحة لمدة خمسة أيام عمل بناءً على 8.5 ساعة. ما لم يتم التفاوض على شروط الخدمة الإضافية مسبقًا كجزء من
                                    اتفاقية الخدمة.
                                    بالنسبة لجميع العلامات التجارية بخلاف كونيكا مينولتا وشارب، يكون الضمان لمدة عام واحد ويغطيه الوكيل المحلي المعتمد. ويُطلب
                                    من العملاء الاتصال مباشرة بمراكز الخدمة المعتمدة لدى الوكلاء المحليين لمقدمي الخدمة.
                                </p>
                            </li>
                            <li>
                                <h1>لطلبات الشراء المستلمة</h1>
                                <p>ا يتم اضافة/خصم اي رسوم من قيمة فاتورة الشراء في أي من الحالات التالية:
                                    المنتج المستلم لا يتطابق مع المنتج الذي تم طلبه.
                                    مواصفات المنتج المستلم لا تتطابق مع المواصفات المذكورة في الموقع.
                                    وجود عيوب/ضرر في غلاف المنتج المستلم.
                                    سيتم اضافة/خصم رسوم الشحن والاستلام من قيمة فاتورة الشراء للحالات غير المذكورة في النقطة السابقة.
                                    يمكن ان يتم حفظ كل/بعض قيمة فاتورة الشراء في حسابك ليتم استخدام المبلغ في أي عملية شراء لاحقة وهذا يعتمد على المنتج او قيمة الفاتورة وسيتم اخطارك بذلك.
                                </p>
                            </li>
                            <li>
                                <h1>طلبات خدمات الصيانة</h1>
                                <p>لإلغاء طلب صيانة، لا يتم اضافة/خصم اي رسوم من قيمة الطلب فقط في حالة:
                                    الآلة المراد اصلاحها ما زالت في موقعك ولم تتم زيارتك من أي فني منذ إرسالك للطلب.
                                    في غضون 4 ساعات فقط وفي حالة رغبتك بإلغاء طلب الصيانة لأي سبب كان بعد ان قام فريقنا بأخذ الآلة لأحد مراكزنا فسيتم اضافة/خصم رسوم الشحن والاستلام من قيمة الطلب.
                                    أي مبالغ مدفوعة لطلبات الصيانة هي غير مسترجعة ان كانت حالة الطلب "تحت التنفيذ" او "مكتمل".
                                </p>
                            </li>
                            <li>
                                <h1>لطلبات الحلول التأجيرية</h1>
                            <p>يتم الموافقة على طلب الإلغاء مع إضافة/خصم رسوم إدارية في حال توفر الشروط التالية كلها:
                                إذا كان طلب الإلغاء في غضون 24 ساعة من تاريخ الطلب.
                                لم يتم استلام الآلة.
                                حالة الطلب "غير نشط".
                            </p>
                            </li>
                        </ul>
                    </div>
                @endif
        </div>
    </div>
</main>
@endsection
