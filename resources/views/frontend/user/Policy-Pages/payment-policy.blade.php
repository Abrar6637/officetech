@extends('frontend.layout.main')
@section('title', 'Office Tech - Payment-Policy')
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
                  Payment Policy
                </span>
            </div>
        </div>
    </div>
    <div class="container mt-4" style="padding-bottom: 50px">
        <div class="row">
            @if ($paymentPolicy)
                <?php
                    $content = $paymentPolicy->content;
                    $allowedTags = '<h1><h3><li><ol><p>';
                    $strippedContent = strip_tags($content, $allowedTags);
                ?>
                {!! $strippedContent !!}
            @else
            <div class="col-12" style="display:flex; flex-direction:column; gap:20px">
                <h3>Payment Policy </h3>
                <ol style="display:flex; flex-direction:column; gap:20px; padding-left: 20px; padding-top:10px;">
                    <li>We provide secure and multiple method of payments: VISA, MasterCard, Mada, cash on
                            delivery, Bank Transfer for completing online orders.</li>
                    <li>Payment methods may change from product/service, value of order or location of delivery.</li>
                    <li>Online Payments through Mada, Visa and MasterCard will be available only from cards issued by
                    Saudi Banks.</li>
                    <li>Cash on Delivery will be available only for consumables orders and with location and quantity
                        limitations and it might include additional fees.</li>
                    <li>Recurring Payments (available on selected items) is a service provided from selected Saudi
                    banks/companies and have their own terms and conditions and you must read it carefully and
                    communicate with your bank for more details and/or requests.</li>
                    <li>Payment transactions will be in Saudi Riyals.</li>
                    <li>Card details provided by you will be truthful, valid and accurate and you shall use the card only
                        owned by you.</li>
                    <li>For online payment transactions, confirmation on the screen will be received once the payment
                    has been authorized. We cannot accept any liability if payment is refused or declined by the
                    card supplier for any reason, check your card supplier.</li>
                    <li>Order will be automatically canceled from our side in case we didn’t receive from payment
                        gateway any acceptance or rejection of the transaction within 15 minutes.</li>
                    <li>Payment details entered in the website payment gateway are encrypted and all communications
                    between us and the service providers are encrypted as well.</li>
                    <li>We do not store any credit card details on the website. You should protect your passwords,
                        personal data and debit/credit card details and do not share this information.</li>
                    <li>We will not share any of your transactions’ details with any entity unless it is required to
                    complete the order or officially for fraud verifications or by law, regulation or court order.</li>
                    <li>We and the services providers from our side are not responsible for any credit card fraud. The
                    liability of using card fraudulently will be on you and you only shall be responsibility to prove the
                    opposite.</li>
                    <li>You will be informed if we are not able to supply full or part of the order and a refund will be
                        processed for full or part of the order.</li>
                    <li>You are accepting all the above terms by using the online payments provided by this website
                        while if you do not accept these terms, do not use this facility.</li>
                </ol>
                    <div style="display:flex; flex-direction:column; text-align:right; gap:20px; margin-top:20px">
                        <h1>تم التحديث في 07- نوفمبر-2023</h1>
                        <h1>سياسة الدفع</h1>
                        <ol style="direction: rtl; display:flex ; flex-direction:column; gap:20px;
                        padding-inline-start: 0;">
                        <li style="  /* Align the text to the left */
                        ;"> يمكن الدفع لعمليات الشراء المراد تنفيذها على الموقع عبر الطرق التالية: فيزا، ماستركارد، مدى ونقداً عند الاستلام و التحويل
                        البنكي.</li>
                                            <li> تغير طرق الدفع المتوفرة حسب نوع المنتج/الخدمة، قيمة الطلب او حسب موقع التوصيل.
                        </li>
                        <li>استخدام الدفع عبر فيزا، ماستركارد ومدى متاح للبطاقات الصادرة من البنوك في المملكة العربية السعودية فقط.
                        </li>
                        <li>إمكانية الدفع عند الاستلام متاحة لعدد معين و/أو مدن معينة فقط لطلبات الأحبار مع إمكانية اضافة رسوم إضافية على ذلك.</li>
                        <li>الدفع التلقائي الشهري (متاحة لمنتجات معينة) هي خدمة مقدمة من بنك/شركة معينة حيث يجب عليك قراءة الشروط والأحكام الخاصة بمقدم هذه الخدمة والرجوع له في حال لديك أي استفسار او طلب.
                        </li>
                        <li>العملة المستخدمة لعمليات الدفع على الموقع هي الريال السعودي.
                        </li>
                        <li>للدفع يجب استخدام البطاقة المملوكة لك وادخال المعلومات الصحيحة، الحقيقية والنشطة.
                        </li>
                        <li>ا نتحمل أدنى مسؤولية في حال تم رفض الدفع من الحهة المانحة لك للبطاقة وعليك التواصل معهم لمعرفة المعلومات والاسباب بينما ستظهر لك شاشة تأكيد مع رقم الطلب في حال تم تأكيد/قبول الدفع.</li>
                        <li>سيتم الغاء الطلب تلقائياً بعد 15 دقيقة في حال عدم استلامنا التأكيد أو الرفض على العملية من مزود خدمة الدفع.
                        </li>
                        <li>كل المعلومات المستخدمة من جهتنا و/أو من جهة أي مزود خدمة نتعامل معه لإتمام عمليات الدفع مشفرة.
                        </li>
                        <li>لا نقوم بتخزين معلومات البطاقات المستخدمة على الموقع لأي عملية دفع ويجب عليك حماية هذه المعلومات وعدم مشاركتها.</li>
                        <li>لا نقوم بمشاركة معلومات عمليات الدفع مع أي جهة إلا ان كانت ضرورية لإكمال طلبك أو رسمياً بطلب من محكمة أو جهة قانونية مكلفة</li>
                        <li>نحن ومزودينا بالخدمات لا نتحمل أدنى مسؤولية على عمليات التزوير التي ممكن أن تحدث للبطاقات المستخدمة وتقع مسؤولية استخدامك بطاقات مزورة على عاتقك انت فقط</li>
                        <li>سيتم اخطارك ان لم نتمكن من تنفيذ طلبك كله أو بعضه وسيتم إنشاء عملية إرجاع للمبلغ المدفوع كله أو جزء منه.
                        </li>
                        <li>باستخدامك لطرق الدفع المتوقرة على الموقع فأنت توافق على الشروط كلها أعلاه وفي حال عدم موافقتك نرجو منك عدم استخدام هذه الخدمة.</li>

                        </ol>
                    </div>  
            </div>
            @endif
        </div>
    </div>
</main>
@endsection
