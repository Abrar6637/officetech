@extends('frontend.layout.main')
@section('title', 'Service-Plans-Policy')
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
    .mb-3 ul li
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
                  Service Plans
                </span>
            </div>
        </div>
    </div>
    <div class="container mt-4" style="padding-bottom: 50px">
        @if ($servicePlanPolicy)
            <?php
                $content = $servicePlanPolicy->content;
                $allowedTags = '<h1><h3><li><ol><p>';
                $strippedContent = strip_tags($content, $allowedTags);
            ?>
            {!! $strippedContent !!}
        @else
            <div class="row">
                <div class="col-12">
                    <h1>Service Plans Policy</h1>
                    <div>
                        <h1>Introduction</h1>
                        <p>This is a service for us to supply you with the needed parts and manpower to maintain your devices for
                            agreed period. Terms and conditions for this service are customized and will be clear in the service level
                            agreement that we will sign together.
                            Plan types vary by covering the spare parts, consumables and toners, manpower and/or all for selected
                            period and/or number of usages. Service plans are designed to cover selected device types, brands and
                            models which we are authorized to service in Saudi.</p>
                    </div>
                    <div>
                        <h1>Request Flow</h1>
                        <p>After we receive your request from the service plans page, we immediately assign it to our technical
                            team to contact you and visit your site to inspect the device(s) condition and status (without any
                            charges).
                            We might reject the request due to your location, device(s) condition, device(s) brand/model, and/or for
                            any other reason.
                            If we approve the request, your account manager will contact you to know your requirements and to
                            consult you with the best plan.
                            Then a technical and financial proposal will be shared with you along with the service level agreement
                            for your approval and signature.
                            You can always track your request status from My Dashboard under &quot;Maintenance Contracts” and view
                            quotation and agreement. You can also submit the payment for the quoted plan online from the link you
                            received from officetech.com.sa with the subject “Quotation # officetech.com.sa”</p>
                    </div> 
                    <div>
                        <h1>Types and Coverage</h1>
                        <p>Definitions:</p>
                        <ul>
                            <li>Service charges: fees for manpower, time and service type provided.</li>
                            <li>Spare Parts: value of new spare parts needed excluding consumables and toners.</li>
                            <li>Consumable Parts: value of parts which are consumed and defined from manufacture to be
                                replaced after usage (quantity or time). Example no limit to consumable parts; printer
                                developer, printer imaging unit, printer drum.</li>
                            <li>Toners: container inside it liquid or powder used to print on paper. Here the coverage of toners
                                means to replace the consumed/empty toners not the damaged.</li>
                            <li>Technician: the engineer who performs the maintenance.</li>
                        </ul>
                        <p>Spare parts and consumable parts will be considered as defined by the manufacturer.</p>
                        <p>Types of plans:</p>
                        <ul>
                            <li>Extend Warranty: plan to cover the service charges and spare parts for the agreement period.
                                Coverage will start and end at the dates as mentioned in the signed agreement and will be
                                charged in advance.</li>
                            <li>On Site Support: plan to cover the service charges and spare parts along with limited quantity of
                                consumable parts for selected period. Coverage will start and end at the dates as mentioned in
                                the signed agreement and will be charged in advance.</li>
                            <li>On Site Support Plus: plan to cover the service charges and spare parts along with limited
                                quantity of consumable parts and toners for selected period. Coverage will start and end at the
                                dates as mentioned in the signed agreement and will be charged in advance.</li>
                            <li>Per A4 page: plan to cover the service charges, spare parts, consumable parts and toners for
                                selected quantity of A4 printouts in color and black. Coverage will start from the date
                                mentioned in the signed agreement and ends when the quantity of printouts is consumed or at
                                the end date mentioned in the signed agreement (which comes first) and will be charged in
                                advance.</li>
                            <li>Technician per month: plan to supply you with a technician to be available on your site for the
                                agreed period on the agreed working days &amp; hours. This Plan covers all service charges, start
                                and end at the dates as mentioned in the signed agreement and will be charged in advance.</li>
                            <li>Standby Service Plan: This plan covers replacing down device with another one until issue is
                                fixed. Availability of the standby device will start and end at the dates as mentioned in the
                                signed agreement and will be charged in advance while the terms of such service vary, according
                                to the agreement, but may include one or the combination of the following conditions:
                                 A standby device of similar capability will be shipped when required,
                                 A standby machine of similar capability will be kept as standby in the agreed location, to
                                be installed and used when the need arises,
                                 A hot stand by device of exact specifications fully configured to be swapped
                                immediately, whenever a breakdown occurs.</li>
                        </ul>
                    </div>              
                </div>
            </div>
            <div>
                <ul style="direction:rtl">
                    <li>
                        <h1>المقدمة</h1>
                        <p>هذه خدمة نقدمها لتزويدك بالقطع والفنيين لصيانة أجهزتك لفترة متفق عليها. يتم تخصيص شروط وأحكام هذه الخدمة وستكون واضحة
                            في اتفاقية مستوى الخدمة الموقّعة بيننا.
                            تختلف أنواع الإتفاقيات من خلال تغطية قطع الغيار والمواد الاستهلاكية والأحبار والأجور الفنية و/أو جميعها لفترة محددة و/أو عدد
                            المطبوعات. يتم تصميم اتفاقيات الصيانة لتغطية أنواع محددة من الأجهزة والعلامات التجارية والموديلات المصرح لنا صيانتها في
                            المملكة العربية السعودية.</p>
                    </li>
                    <li>
                        <h1>سير عمل الطلب</h1>
                        <p>بعد تلقينا للطلب من صفحة حلول للصيانة، نقوم على الفور بتعيين الفريق الفني للتواصل معك وزيارة موقعك لإجراء فحص لحالة
                            الجهاز/الأجهزة المراد تغطيتها في اتفاقية صيانة (بدون أي رسوم).
                            يمكن أن يتم رفض الطلب بسبب موقع الأجهزة، حالة الأجهزة، العلامة التجارية/الموديل، و/أو لأي سبب آخر.
                            في حال الموافقة على الطلب، سيقوم مدير حسابك بالتواصل معك للرد على طلبك وتقديم الإستشارة لأفضل خطة تناسبك.
                            بعد ذلك، سيتم مشاركة عرض تقني ومالي معك بالإضافة على اتفاقية مستوى الخدمة للموافقة عليها والتوقيع.
                            يمكنك دائمًا تتبع حالة طلبك من حسابي في اتفاقيات الصيانة الخاص بي ومراجعة عرض الأسعار والتقارير. يمكنك أيضًا الدفع مباشرة
                            عبر الرابط الذي تلقيته في البريد الإلكتروني المرسل إليك بعنوان من officetech.com.sa بعنوان &quot; تسعيرة # XXXX &quot;</p>
                    </li>
                    <li>
                        <h1>الأنواع والتغطية</h1>
                        <h1>التعريف:</h1>
                    <ul>
                        <li>أجور فنية: رسوم الصيانة الفنية حسب الوقت والخدمة المقدّمة.</li>
                        <li>قطع الغيار: قيمة قطع الغيار الجديدة من دون القطع الإستهلاكية والأحبار.</li>
                        <li>لقطع الإستهلاكية: قيمة القطع التي تمت تعرفتها من المصنّع كقطع استهلاكية ويتم تغييرها بعد كمية طباعة معيّنة مثال دون الحصر درام، ديفيلوبر</li>
                        <li>أحبار: علب الأحبار سواء السائلة أو البودرة وهنا تعني استبدال الأحبار الفارغة وليس تغطية الأحبار المتضررة.</li>
                        <li>ني: المهندس الذي يقوم بعمل الصيانة.</li>
                    </ul>
                    </li>
                    <li>
                        <h1>أنواع الخطط</h1>
                    <ul>
                        <li>تمديد الضمان: خطة لتغطية الأجور الفنية وقطع الغيار طول مدة الإتفاقية. تبدأ وتنتهي التغطية كما يتم ذكره في الإتفاقية الموقّعة بيننا ويتم تحصيل مبلغ الإتفاقية في بداية المدة</li>
                        <li>دعم في الموقع: خطة لتغطية الأجور الفنية وقطع الغيار مع  أعداد محدودة من القطع الإستهلاكية طول مدة الإتفاقية. تبدأ وتنتهي التغطية كما يتم ذكره في الإتفاقية الموقّعة بيننا ويتم تحصيل مبلغ الإتفاقية في بداية المدة.</li>
                        <li>دعم في الموقع بلس: خطة لتغطية الأجور الفنية وقطع الغيار مع  أعداد محدودة من القطع الإستهلاكية والأحبار طول مدة الإتفاقية. تبدأ وتنتهي التغطية كما يتم ذكره في الإتفاقية الموقّعة بيننا ويتم تحصيل مبلغ الإتفاقية في بداية المدة.</li>
                        <li>الدعم حسب الطباعة: خطة لتغطية الأجور الفنية وقطع الغيار والقطع الإستهلاكية والأحبار حتى طباعة عدد متفق عليه من الورق بحجم A4 سواء كان أسود أو ملون. تبدأ التغطية من بداية الإتفاقية وتنتهي عند طباعة كل الكمية المتفق عليها أو انتهاء مدة الإتفاقية (أيهما أول) ويتم تحصيل مبلغ الإتفاقية في بداية المدة.</li>
                        <li>فني بالشهر: خطة لتزويدك بفني يكون متواجد في موقعك بالأوقات والمدة المتفق عليها. هذه الخطة الأجور الفنية التي تبدأ وتنتهي كما يتم ذكره في الإتفاقية ويتم تحصيل المبلغ في بداية المدة</li>
                        <li>خطة الخدمة الاحتياطية: خطة لتزويدك بجهاز بديلة لاستبدال الجهاز المتعطل حتى يتم صيانته. تيتم الإتفاق على مدة تواجد الجاهز البديل وتختلف شروط هذه الخدمة، وفقًا للاتفاقية، وقد تتضمن واحدًا أو مجموعة من الشروط التالية:</li>
                        <li>توفير جهاز بديل بقدرات مماثلة عند الحاجة</li>
                        <li>توفير جهاز بديل بقدرات مماثلة في موقع متفق عليه ليتم تركيبه واستخدامه عند الحاجة،</li>
                        <li>وفير جهاز بديل بقدرات مطابقة مجهّز ليتم استخدامه بشكل مباشر عند الحاجة.</li>
                    </ul>
                    </li>
                </ul>
            </div>
        @endif
    </div>
</main>
@endsection
