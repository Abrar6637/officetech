@extends('frontend.layout.main')
@section('title', 'Ecommerce-Print-Package')
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
                  Ecommerce Print Package
                </span>
            </div>
        </div>
    </div>
    <div class="container mt-4" style="padding-bottom: 50px">
        @if ($ecomPrintPackage)
            <?php
                $content = $ecomPrintPackage->content;
                $allowedTags = '<h1><h2><h3><h4><h5><li><ol><p><br><ul>';
                $strippedContent = strip_tags($content, $allowedTags);
            ?>
            {!! $strippedContent !!}
        @else
            <div class="row">
                <div class="col-12">
                    <h1 style="text-align: center;padding-bottom:20px"><u>Print package Contract Terms:</u></h1>
                    <strong><strong><u>Contract Duration:</u></strong> 24 months starting from the installation date or fixed number of prints purchased in the shopping cart whichever comes first.</strong>
                    <p style="padding-top:20px"><strong><u>The contract includes:</u></strong></p>
                    <ol style="font-size: 1em; padding-left:40px; padding-top:10px">
                        <li>Labor fees and replacement of parts damaged due to manufacturing defects during the contract period</li>
                        <li>All consumables and paper during the contract period</li>
                        <li>Installation of the device and its network connection</li>
                        <li>Training on the use and operation of the device upon installation</li>
                        <li>Technician visits for replacing consumables and repairing faults</li>
                    </ol>

                    <p style="padding-top:20px"><strong><u>The contract includes:</u></strong></p>
                    <ol style="font-size: 1em; padding-left: 40px; padding-top:10px">
                    <li>Glass parts and damage due to misuse</li>
                    <li>Relocation of the device from one site to another</li>
                    </ol>
                    <p><strong></strong></p>
                    <p style="padding-top:20px"><strong><u>Payment term:</u></strong></p>
                    <p style="padding-top:10px"><strong>Payment: 100% advance payment before delivery</strong></p>

                    <h1 style="text-align:center; padding-top:20px"><strong><u>: شروط عقد الطباعة</u></strong></h1>

                    <div style="direction: rtl;">
                        <h3 style="padding-top:20px"><u>مدة العقد   :</u><small> 24   شهر من تاريخ التركيب أو عدد محدد من النسخ المختارة في سلة الشراء أيهما أقرب.</small></h3>

                        <h3 style="padding-top:20px"><u>ويشمل   :</u></h3>
                        <ol style="font-size: 1.3em; padding-right:40px; padding-top:10px">
                            <li>.أجور اليد وقطع الغيار التالفة نتيجة الصنع خلال مدة العقد</li>
                            <li>.جميع المواد الاستهلاكية والورق خلال مدة العقد</li>
                            <li>.تركيب الجهاز وتوصيله بالشبكة</li>
                            <li>التدريب على الاستخدام وكيفية العمل مع التركيب</li>
                            <li>زيارة الفني لتغيير المستهلكات وصيانة الأعطال</li>
                        </ol>

                        <h3 style="padding-top:20px"><u>ولا يشمل  :</u></h3>
                        <ol style="font-size: 1.3em; padding-right:40px; padding-top:10px">
                            <li>القطع الزجاجية وسوء الاستخدام</li>
                            <li>نقل الجهاز من موقع لآخر</li>
                        </ol>

                        <h3 style="padding-top:20px"><u>السداد :</u><small>  100% دفعة مقدمة قبل التوريد </small></h3>
                    </div>
                </div>
            </div>
        @endif
    </div>
</main>
@endsection
