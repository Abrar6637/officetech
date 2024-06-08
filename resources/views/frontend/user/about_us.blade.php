@extends('frontend.layout.main')
@section('title', 'Office Tech - About Us')
@section('main.container')
<main class="main margin" >
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
                   About Us
                </span>
            </div>
        </div>
    </div>
    <div class="container mt-5 section-top">
        <div class="row">
            @if ($aboutUs)
                {!! $aboutUs->content !!}
            @else
                <div class="col-lg-6">
                    <h1 class="review-tab-heading" style="margin-top: 17px;">About OFFICETECH</h1>
                    <p class="page-result-p" style="color:#323232;margin-top: 48px !important;">With more than 50 years experiance,18 service centers and 3 main showrooms and growing,
                        OFFICETECH is nationally recognized as the biggest IT solutions providers and multifunction &amp;
                        commercial printers supplier. We’re passionate about supporting our customers – and it goes way
                        beyond.
                        We continue to pursue excellence, constantly developing, adapting and evolving our services to
                        meet and exceed our own high standards. Our commitment to you is simple: we provide cutting-
                        edge solutions that cater to your unique needs. Whether it&#39;s our high-performance products or our
                        exceptional services, OFFICETECH operates with an unwavering dedication to quality and customer
                        satisfaction.</p>
                
                </div>
                <div class="col-lg-6">
                    <h1 class="review-tab-heading" style="margin-top: 17px; display:flex; justify-content:end">نبذة عن OFFICETECH</h1>
                        <p class="page-result-p" style="color:#323232;margin-top: 48px !important;">مع أكثر من 50 عامًا من الخبرة و18 مركز خدمة و3 صالات عرض رئيسية، أصبحت شركة
                            OFFICETECH واحدة من أكبر مزودي حلول تكنولوجيا المعلومات وموردي الطابعات التجارية على
                            المستوى الوطني. نحن نواصل السعي لتحقيق التميز، والتطوير المستمرلخدماتنا ولتلبية معاييرنا العالية
                            وتجاوزها. إن التزامنا تجاهك بسيط: فنحن نقدم حلولاً متطورة تلبي احتياجاتك الفريدة. سواء أكان الأمر
                            يتعلق بمنتجاتنا عالية الأداء أو خدماتنا الاستثنائية، تعمل OFFICETECH بتفانٍ ثابت لتحقيق الجودة
                            ورضا العملاء.</p>
                </div>
            @endif
        </div>
    </div>
    

    <br><br>
    <br><br>
</main>
@endsection