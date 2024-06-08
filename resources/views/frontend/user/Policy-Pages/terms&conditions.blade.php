@extends('frontend.layout.main')
@section('title', 'Office Tech - Terms & Condition')
@section('main.container')
<style>
    .para-heading
    {
        color: #323232 !important;
        font-family: 'Figtree' !important;
        font-size: 28px !important;
        font-style: normal !important;
        font-weight: 700 !important;
        line-height: 103% !important;
        letter-spacing: 0.183px !important;
    }
    .para-div
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
                Terms & Conditions
                </span>
            </div>
        </div>
    </div>
    <div class="container mt-4" style="padding-bottom: 50px">
        <div class="row">
            <div class="col-12">
                <div class="mb-3 para-div">
                    <center><h3 class="para-heading ">Print package Contract Terms:</h3></center>
                    <p>Contract Duration: 24 months  starting from the installation date or  fixed number of prints purchased in the shopping cart whichever comes first .</p>
                    <p style="text-decoration: underline">The contract includes :</p>
                    <ol>
                        <li>All consumables and paper during the contract period</li>
                        <li>Chat with us using the chat application on the website, or</li>
                        <li>Installation of the device and its network connection.</li>
                        <li>Training on the use and operation of the device upon installation</li>
                        <li>Technician visits for replacing consumables and repairing faults</li>
                    </ol>
                    <p style="text-decoration: underline">The contract  exclude :</p>
                    <ol>
                        <li>Glass parts and damage due to misuse</li>
                        <li>Relocation of the device from one site to another</li>
                    </ol>
                    <p style="text-decoration: underline">Payment term:</p>
                    <p>Payment: 100% advance payment before delivery</p>
                    
                </div>
                
                             
            </div>
        </div>
        <div style="direction: rtl;">
            <ul>

          
                   <li> شروط عقدالطباعة: </li> 

                    <li> مدة العقد            : 24 شهر من تاريخ التركيب او عدد محدد من النسخ المختارة في سلة الشراء ايهما اقرب.</li>
            <ul>
             ويشمل :
          <li>  -1 أجور اليد وقطع الغيار التالفة نتيجة الصنع خلال مدة العقد.</li> 
              <li>        -2 جميع المواد الاستهلاكية والورق  خلال مدة العقد.  </li>                  
                <li>       -3 تركيب الجهاز وتوصيله بالشبكة.</li> 
                    <li>    -4 التدريب على الاستخدام وكيفية العمل مع التركيب.</li>
                      <li> -5 زيارة  الفني لتغير المستهلكات وصيانة الاعطال. </li> 
                        </ul> 
ولا يشمل:
<ul>
       <li>  -1 القطع الزجاجية وسوء الأستخدام.</li> 
        <li>  -2 نقل الجهاز من موقع لاخر.</li>
          </ul>
السداد           :     100% دفعة مقدمة قبل التوريد.
</ul>
        </div>
    </div>
</main>
@endsection