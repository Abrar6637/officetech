@extends('frontend.layout.main')
@section('title', 'Office Tech - Privacy-Policy')
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
    .mb-3 ul li::marker,
.mb-3 ol li::marker {
    /* Increase the size of the bullet or number */
    font-size: 20px; /* Adjust the size as needed */
    /* Additional styling */
    color: #323232;
    font-family: 'Figtree';
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
                  Privacy Policy
                </span>
            </div>
        </div>
    </div>
    <div class="container mt-4" style="padding-bottom: 50px">
        <div class="row">
            @if ($privacyPolicy)
                <?php
                    $content = $privacyPolicy->content;
                    $allowedTags = '<h1><h3><li><ol><p>';
                    $strippedContent = strip_tags($content, $allowedTags);
                ?>
                {!! $strippedContent !!}
            @else
              <div class="col-12" style="display:flex; flex-direction:column; gap:20px">
                <div>
                  <h1>Overview</h1>
                  <p>Please read our privacy policy carefully to understand how we collect, use, protect or handle your
                    information in accordance with our website.</p>
                </div>
                <div>
                  <h1>What personal information do we collect when you visit our website?</h1>
                  <p>You can visit and surf our website anonymously. While when you need to place an order or register you
                    will be asked to enter your Name, Business Email address, Shipping address, Mobile number, CR number
                    and/or other details to help us serve you.</p>
                </div>
                <div>
                  <h1>When do we collect information?</h1>
                  <p>We collect information from you when you register on our website, place an order, subscribe to a
                    newsletter, respond to a survey, and fill out a form or enter information on our site.</p>
                </div>
                <div>
                  <h1>Is the information changeable?</h1>
                  <p>You can change your personal information by logging in to your account and change the personal
                      information anytime in addition to that you can also unsubscribe from newsletter emails by following
                      the steps in the bottom of any newsletter email.</p>
                </div>
                <div>
                  <h1>How do we use your information?</h1>
                  <ul>
                      <li>To process your order properly.</li>
                      <li>To contact you regarding your order.</li>
                      <li>To share a contest, promotion, survey or any other announcement.</li>
                      <li>To personalize your experience and to allow us to recommend products in which you are most
                        interested.</li>
                      <li>To guarantee better service in responding to your requests and take feedback after supplying
                        products/services.</li>
                  </ul>
                </div>
                <div>
                  <h1>How do we protect your information?</h1>
                  <p>We use a secured network, and we allow access to your information by limited people who are required
                      to keep your information confidential.
                      We do not store payment information and such transactions are processed by payment gateway
                      provider and all communication between us and them is encrypted.</p>
                </div>
                <div>
                  <h1>Do we use cookies?</h1>
                  <p>Yes, (if you allow) to enable us to recognize your browser and capture/remember certain information.
                    We may also use trusted third-party services that track this information on our behalf. This is done so
                    we can offer better experience/journey and tools to you on your next visits.
                    We use cookies to:
                  <ul>
                    <li>Remember and process the items in the shopping cart.</li>
                    <li>Recognize you for future visits.</li>
                    <li>Track any advertisement.</li>
                    <li>Help us compile analytical data about website traffic and interactions.</li>
      
                  </ul>You can change the cookies settings from your internet browser to be warned each time a cookie is sent
                    or disable all cookies. If you disable cookies, some features will be disabled and some of our services will
                    not function properly, but you can still surf and place orders.</p>
                </div>
                <div>
                  <h1>Third Party Disclosure</h1>
                  <p>We do not sell, trade, or transfer your personal information to outside parties other than those parties
                    who assist us in operating this website and there are agreements with these parties to keep this
                    information confidential. We may also release your information when we believe release is appropriate
                    to comply with the law, enforce our website policies, or protect ours or others&#39; rights, property, or
                    safety.
                  </p>
                </div>
                <div>
                  <h1>Third party links</h1>
                  <p>We are not responsible for the content and activities of third-party links that might be available on our
                    website as these third-party links have their own privacy policies on their websites.</p>
                </div>
                <div>
                  <h1>How does our site handle do-not-track signals?</h1>
                  <p>We respect do-not-track signals, plant cookies, or use advertising when a do-not-track browser
                    mechanism is in place, and we do not allow third party behavioral tracking.</p>
                </div>
              </div>
            @endif
        </div>
    </div>
</main>
@endsection
