@extends('frontend.layout.main')
@section('title', 'Office Tech - Service-Policy')
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
                  Service Policy
                </span>
            </div>
        </div>
    </div>
    <div class="container mt-4" style="padding-bottom: 50px">
        <div class="row">
            @if ($servicePolicy)
                <?php
                    $content = $servicePolicy->content;
                    $allowedTags = '<h1><h3><li><ol><p>';
                    $strippedContent = strip_tags($content, $allowedTags);
                ?>
                {!! $strippedContent !!}
            @else
            <div class="col-12" style="display:flex; flex-direction:column; gap:20px">
                <div>
                    <h1>Maintenance Policy</h1>
                    <p>In general, service is available five working days based on 8.5 hours. Unless additional service terms
                            have been previously negotiated as part of the service agreement.
                        For all the brands other than Konica Minolta and Sharp, the warranty is for one year and covered by
                        local authorized agent. Customers are requested to contact the certified service centers of the local
                        agent Service providers directly.</p>
                </div>
                <div>
                    <h1>
                    Response Time 
                    </h1>
                    <p>
                        The expected response time is 4 working hours and might extend due to device location and availability
                            hours. This time is measured starting from maintenance request time until the service starts on the
                        dedicated problem. The related countermeasure action can also be a remote service activity.
                    </p>
                </div>
                <div>
                    <h1>Service Charges</h1>
                    <p>Service charges do not include spare parts, consumable parts nor toners value. Charges are defined as
                        per type of service and time needed to perform the service in addition to device type, brand and model.
                        Additional charges may be applied due and not limited to device(s) location and site readiness.</p>
                </div>
                <div>
                    <h1>Checkup Visits</h1>
                    <p>We might perform visits to see the device(s) condition and to collect data from device(s) panel without
                        any previous notice. You will not be charged for checkup visits unless a request is raised from your side
                        and the visitor technician can perform service immediately. We are not restricted to perform a number
                        of checkup visits unless there is an agreement between you and us defining the quantity and the
                        frequency of these checkup visits for the agreement period.</p>
                </div>
                <div>
                    <h1>Downtime</h1>
                    <p>Maximum downtime is 16 hours, “Downtime” refers to the time that a system has been without its
                        standard output functions. Downtime ends when the system is working again with its standard output
                        functions, after any type of service action has been performed. Downtime is measured in the time span
                        of the selected service availability.
                        Lost times caused by difficulties accessing the system physically or remotely because of the location
                        environment are not calculated as downtime.
                        In cases where the installed device is beyond reasonable distance from the Service center, then the
                        separate charges will be applicable.
                        Defined preventive maintenance is not considered for downtime, same as breakdowns caused by
                        mishandling, carelessness, vandalism, and force majeure.
                        Downtime refers to ongoing service issues and not to the refill status of the system.</p>
                </div>
                <div>
                    <h1>Service and Support Operations</h1>
                    <p>All the support engineers assigned certified and will be able to handle Level 1 and 2 troubleshooting and
                        issue resolution.
                        We are equipped with a strong Service Management System which provides complete visibility of all our
                        machines in the field in terms of agreement management, maintenance requests management,
                        inventory management and performance management.</p>
                </div>
                <div>
                    <h1>On-site Service: Repair workflow</h1>
                    <p>After receiving the request, the desk operator tries to solve the issue directly. This can also include a
                        second phone call or access via remote diagnostics by a back-office technician.
                        If this is not successful, an on-site visit is scheduled by the dispatcher. A service engineer will check the
                        device within the agreed timeframe. In some cases, issues escalated to the manufacturer if our service
                        engineer and product specialist were not able to diagnose it.
                        We might reject the request due to device(s) purchasing source, device(s) location, device(s) condition,
                        device(s) brand/model, and/or for any other reason like not limited to issues caused by mishandling,
                        carelessness, vandalism, and force majeure.
                        If we approved the request based on the inspection - a quotation will be shared to perform the service
                        and after your approval and we receive the payment (if applicable) - then service will be applied.
                        You can always track your request status from My Dashboard under &quot; Maintenance Requests” and view
                        quotation and report. You can also submit the payment for the quoted value</p>
                </div>
                <div>
                    <h1>Qualified Support</h1>
                    <p>All support staff are fully qualified in supporting the range of printers and multi-function devices. There
                        are several levels of training and qualifications provided by the manufacturers.

                        The support qualifications are graded as “Associate Professional”, “Expert “and “Master certification”.
                        Instructor-led training courses are made available to the technical team, as a part of their continuous
                        skill and personnel development.
                        IT networking, color knowledge and solutions skills are all part of the online training resources that are
                        offered.</p>
                </div>
                <div>
                    <h1>Standby Service</h1>
                    <p>With a view to ensuring service continuity, we assure to replace a device of similar capabilities, in the
                        unforeseen case where the device is non-serviceable for more than 24 working hours.
                        The terms of such a service vary, according to the agreement, but may include one or the combination
                        of the following conditions:

                        o A standby device of similar capability will be shipped when required,
                        o A standby machine of similar capability will be kept as standby in the agreed location, to
                        be installed and used when the need arises,
                        o A hot stand by device of exact specifications fully configured to be swapped
                        immediately, whenever a breakdown occurs.

                        It is required to provide sufficient and safe storage space to hold and release such standby machines.
                        The rates applicable for these standby machines will be determined upon the agreement in force.</p>
                </div>
                
            </div>
            <div style="display:flex; flex-direction:column; gap:20px">
                <h1 style="direction:rtl">سياسة الصيانة</h1>
                <ul style="direction:rtl">
                    <li>
                        <h1>توفر الخدمة</h1>
                        <p>بشكل عام ، الخدمة متاحة لمدة خمسة أيام عمل بناءً على 8.5 ساعة. ما لم يتم التفاوض على شروط الخدمة الإضافية مسبقًا كجزء من
                        اتفاقية الخدمة.
                        بالنسبة لجميع العلامات التجارية بخلاف كونيكا مينولتا وشارب، يكون الضمان لمدة عام واحد ويغطيه الوكيل المحلي المعتمد. ويُطلب
                        من العملاء الاتصال مباشرة بمراكز الخدمة المعتمدة لدى الوكلاء المحليين لمقدمي الخدمة.</p> بعض الأجهزة
                    </li>
                    <li>
                        <h1>وقت الاستجابة</h1>
                        <p>وقت الاستجابة المتوقع هو 4 ساعات عمل وقد يمتد بسبب موقع الجهاز وساعات التوفر. يتم قياس هذا الوقت بدءًا من وقت طلب
                            الصيانة حتى يبدأ الحل في المشكلة ويمكن أيضًا أن يتم عبر الخدمة عن بُعد.</p>
                    </li>
                    <li>
                        <h1>رسوم الصيانة</h1>
                        <p>لا تشمل رسوم الصيانة قطع الغيار أو الأجزاء المستهلكة أو قيمة الأحبار. يتم تحديد الرسوم حسب نوع الصيانة والوقت اللازم لأداء
                        الصيانة بالإضافة إلى نوع الجهاز والعلامة التجارية والطراز.
                        قد يتم تطبيق رسوم إضافية بسبب على سبيل المثال لا الحصر موقع الجهاز/الأجهزة وجهوزية الموقع.</p>
                    </li>
                    <li>
                        <h1>زيارات الفحص</h1>
                        <p>قد نقوم بزيارات لمعرفة حالة الجهاز/الأجهزة ولجمع البيانات من لوحة الجهاز/الأجهزة دون أي إشعار مسبق. لا يوجد رسوم عليك
                            مقابل زيارات الفحص ما لم يتم تقديم طلب منك حيث يمكن للفني الزائر إجراء الخدمة على الفور. نحن لسنا مقيدين بإجراء عدد من
                            زيارات الفحص ما لم يكن هناك اتفاق بينك وبيننا يحدد كمية وتواتر زيارات الفحص هذه لفترة الاتفاقية.</p>
                    </li>
                    <li>
                        <h1>وقت التعطل</h1>
                        <p>الحد الأقصى لوقت توقف الجهاز/الأجهزة عن العمل هو 16 ساعة، يشير &quot;وقت التعطل&quot; إلى الوقت الذي كان فيه الجهاز/الأجهزة خارج
                            عن الوظائف القياسية. ينتهي وقت التعطل عندما يعمل الجهاز/الأجهزة مرة أخرى بعد تنفيذ أي نوع من إجراءات الخدمة. يتم قياس وقت
                            التعطل عن العمل في الفترة الزمنية لتوافر الخدمة المختارة.
                            لا يتم احتساب الوقت الضائع الناتج عن صعوبات الوصول إلى الجهاز/الأجهزة في الموقع أو عن بُعد بسبب بيئة الموقع.
                            في الحالات التي تكون فيها الأجهزة في موقع بعيد عن مركز الخدمة في المدينة المغطاة، فسيتم تطبيق رسوم إضافية.
                            لا يتم اعتبار الصيانة الوقائية المحددة، مثل الأعطال الناتجة عن سوء الإدارة والإهمال والتخريب والقوة القاهرة كوقت تعطل.
                            يشير وقت التعطل إلى مشكلات الخدمة وليس إلى حالة إعادة تهيئته مثل و لا يقتصر على تغيير الحبر أو تعبئة الورق.</p>
                    </li>
                    <li>
                        <h1>عمليات الخدمة والدعم</h1>
                        <p>جميع مهندسينا للدعم معتمدين وقادرين على تشخيص الأعطال من المستوى 1 و 2 وإصلاحها.
                        نحن مجهزون بنظام إدارة خدمة قوي يوفر رؤية كاملة لجميع أجهزتنا من حيث إدارة الاتفاقيات وإدارة طلبات الصيانة وإدارة المخزون
                        وإدارة الأداء.</p>
                    </li>
                    <li>
                        <h1>الصيانة في الموقع: سير عمل الإصلاح</h1>
                        <p>بعد تلقي الطلب، يحاول المشغّل لدينا حل المشكلة مباشرة. يمكن أن يشمل ذلك أيضًا مكالمة هاتفية ثانية أو الوصول عبر التشخيص عن
                        بُعد بواسطة فني من مكانه.
                        إذا لم ينجح ذلك ، فسيتم تحديد موعد زيارة لفحص الجاهز/الأجهزة في الموقع. سيقوم مهندس الخدمة بفحص الجهاز خلال الإطار
                        الزمني المتفق عليه. في بعض الحالات، يتم الإستعانة بالشركة المصنّعة إذا لم يتمكن مهندس الخدمة واختصاصي المنتج لدينا من
                        تشخيصها.

                        قد نرفض طلب الصيانة بسبب مصدر شراء الجهاز/الأجهزة ، وموقع الجهاز/الأجهزة ، وحالة الجهاز/الأجهزة، والعلامة التجارية
                        وموديل الجهاز/الأجهزة، و/أو لأي سبب آخر، على سبيل المثال لا الحصر، الأعطال الناجمة عن سوء الاستخدام، الإهمال والتخريب
                        والقوة القاهرة.
                        إذا وافقنا على الطلب بناءً على الفحص - ستتم مشاركة عرض سعر للصيانة المطلوبة وبعد موافقتك واستلامنا لقيمة الصيانة المرسلة
                        (في حالة استحقاق مبلغ على الصيانة المطلوبة) - فسيتم حينها إجراء الصيانة.
                        يمكنك دائمًا تتبع حالة طلبك من حسابي في طلبات الصيانة الخاص بي ومراجعة عرض الأسعار والتقارير. يمكنك أيضًا الدفع مباشرة
                        عبر الرابط الذي تلقيته في البريد الإلكتروني المرسل إليك بعنوان منinfo@officetech.com.sa بعنوان &quot; تسعيرة # XXXX &quot;</p>
                    </li>
                    <li>
                        <h1>التأهيل للدعم</h1>
                        <p>جميع موظفينا للدعم مؤهلين تمامًا لدعم مجموعة الطابعات والأجهزة متعددة الوظائف. هناك عدة مستويات من التدريب والمؤهلات التي
                            تقدمها لنا الشركات المصنّعة.
                            يتم تصنيف مؤهلات الدعم كـ &quot;محترف مشارك&quot; و &quot;خبير&quot; و &quot;محترف&quot;. يتم توفير الدورات التدريبية لفريقنا الفني، كجزء من مهاراتهم
                            المستمرة وتطويرهم.
                            تعد شبكات الإتصال ومعرفة الألوان ومهارات الحلول جزءًا من موارد التدريب عبر الإنترنت التي يتم تقديمها.</p>
                    </li>
                    <li>
                        <h1>الخدمة الاحتياطية</h1>
                        <p>تختلف شروط هذه الخدمة، وفقًا للاتفاقية، وقد تتضمن واحدًا أو مجموعة من الشروط التالية:
                            o توفير جهاز بديل بقدرات مماثلة عند الحاجة،
                            o توفير جهاز بديل بقدرات مماثلة في موقع متفق عليه ليتم تركيبه واستخدامه عند الحاجة،
                            o توفير جهاز بديل بقدرات مطابقة مجهّز ليتم استخدامه بشكل مباشر عند الحاجة.
                            مطلوب توفير مساحة تخزين كافية وآمنة للأجهزة البديلة. يتم تحديد الأسعارلتوفير الأجهزة البديلة حسب الحالة باتفاقية ملزمة.</p>
                    </li>
                </ul>
            </div>
            @endif
        </div>
    </div>
</main>
@endsection
