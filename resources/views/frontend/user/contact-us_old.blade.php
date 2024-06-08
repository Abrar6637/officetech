@extends('frontend.layout.main')
@section('title', 'Office Tech - Contact Us')
@section('main.container')
<main class="main margin" >
    <div class="breadcrumb-container">
        <div class="container">
            <ul class="breadcrumb">
                <li><a href="/">Home</a></li>
                <li class="slash">/</li>
                <li>Contact US</li>
            </ul>
        </div>
    </div>
    <div class="container text-center section-top" style="margin-top:60px;">
        <div class="row">
            <div class="col-md-7 col-12  text-start  pe-5">
                <div class="row ">
                    <div class="col-md-6 col-12 mb-5 mb-md-0">
                        <h3 class="heading-font ">Want to reach out directly?</h3>
                        <p class="p-font">You can contact us using the contact details below</p>
                        <div class="d-flex gap-3 align-items-center mt-5">
                            <svg width="29" height="29" viewBox="0 0 29 29" fill="none"
                                xmlns="http://www.w3.org/2000/svg">
                                <circle cx="14.5" cy="14.5" r="14.5" fill="#828E9F" />
                                <path
                                    d="M19.3333 9.66602H8.66665C7.93331 9.66602 7.33998 10.266 7.33998 10.9993L7.33331 18.9993C7.33331 19.7327 7.93331 20.3327 8.66665 20.3327H19.3333C20.0666 20.3327 20.6666 19.7327 20.6666 18.9993V10.9993C20.6666 10.266 20.0666 9.66602 19.3333 9.66602ZM19.0666 12.4993L14.3533 15.446C14.14 15.5793 13.86 15.5793 13.6466 15.446L8.93331 12.4993C8.86646 12.4618 8.80793 12.4111 8.76124 12.3503C8.71455 12.2895 8.68069 12.2199 8.6617 12.1456C8.64271 12.0713 8.63898 11.994 8.65075 11.9182C8.66252 11.8425 8.68954 11.7699 8.73017 11.7049C8.7708 11.6399 8.8242 11.5838 8.88713 11.54C8.95006 11.4962 9.02123 11.4657 9.09631 11.4502C9.17139 11.4347 9.24883 11.4347 9.32395 11.45C9.39906 11.4653 9.47029 11.4957 9.53331 11.5393L14 14.3327L18.4666 11.5393C18.5297 11.4957 18.6009 11.4653 18.676 11.45C18.7511 11.4347 18.8286 11.4347 18.9036 11.4502C18.9787 11.4657 19.0499 11.4962 19.1128 11.54C19.1758 11.5838 19.2292 11.6399 19.2698 11.7049C19.3104 11.7699 19.3374 11.8425 19.3492 11.9182C19.361 11.994 19.3573 12.0713 19.3383 12.1456C19.3193 12.2199 19.2854 12.2895 19.2387 12.3503C19.192 12.4111 19.1335 12.4618 19.0666 12.4993Z"
                                    fill="white" />
                            </svg>

                            <div class="div">
                                <h6 class="head-font">Email</h6>
                                <h6>info@officetech.com.sa</h6>
                            </div>
                        </div>
                        <div class="d-flex gap-3 align-items-center mt-3">
                            <svg width="29" height="29" viewBox="0 0 29 29" fill="none"
                                xmlns="http://www.w3.org/2000/svg">
                                <circle cx="14.5" cy="14.5" r="14.5" fill="#828E9F" />
                                <path
                                    d="M17.417 15.6795L17.0757 16.0192C17.0757 16.0192 16.2635 16.8262 14.0472 14.6227C11.831 12.4192 12.6432 11.6122 12.6432 11.6122L12.8577 11.3977C13.388 10.8712 13.4382 10.0252 12.9755 9.40723L12.0305 8.14498C11.4575 7.37998 10.3512 7.27873 9.69497 7.93123L8.51747 9.10123C8.19272 9.42523 7.97522 9.84373 8.00147 10.3087C8.06897 11.499 8.60747 14.0587 11.6105 17.0452C14.7957 20.2117 17.7845 20.3377 19.0062 20.2237C19.3932 20.1877 19.7292 19.9912 20 19.7212L21.065 18.6622C21.785 17.9475 21.5825 16.7212 20.6615 16.221L19.229 15.4417C18.6245 15.1132 17.8895 15.21 17.417 15.6795Z"
                                    fill="white" />
                            </svg>
                            <div class="div">
                                <h6 class="head-font">Phone</h6>
                                <h6>+1 (234) 5678 900</h6>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-6 col-12">
                        <h3 class="heading-font ">Follow us on social media</h3>
                        <div class="d-flex gap-3 pb-4">
                            <svg width="29" height="29" viewBox="0 0 29 29" fill="none"
                                xmlns="http://www.w3.org/2000/svg">
                                <circle cx="14.5" cy="14.5" r="14.5" fill="#828E9F" />
                                <path
                                    d="M16.0834 15.6882H18.0625L18.8542 12.5215H16.0834V10.9382C16.0834 10.1227 16.0834 9.35482 17.6667 9.35482H18.8542V6.69482C18.5961 6.66078 17.6216 6.58398 16.5924 6.58398C14.443 6.58398 12.9167 7.89578 12.9167 10.3048V12.5215H10.5417V15.6882H12.9167V22.4173H16.0834V15.6882Z"
                                    fill="white" />
                            </svg>
                            <svg width="29" height="29" viewBox="0 0 29 29" fill="none"
                                xmlns="http://www.w3.org/2000/svg">
                                <circle cx="14.5" cy="14.5" r="14.5" fill="#828E9F" />
                                <path
                                    d="M13.3333 17.4993L17.6583 14.9993L13.3333 12.4993V17.4993ZM22.9667 10.9743C23.075 11.366 23.15 11.891 23.2 12.5577C23.2583 13.2243 23.2833 13.7993 23.2833 14.2993L23.3333 14.9993C23.3333 16.8243 23.2 18.166 22.9667 19.0243C22.7583 19.7743 22.275 20.2577 21.525 20.466C21.1333 20.5743 20.4167 20.6493 19.3167 20.6993C18.2333 20.7577 17.2417 20.7827 16.325 20.7827L15 20.8327C11.5083 20.8327 9.33332 20.6993 8.47499 20.466C7.72499 20.2577 7.24166 19.7743 7.03332 19.0243C6.92499 18.6327 6.84999 18.1077 6.79999 17.441C6.74166 16.7743 6.71666 16.1993 6.71666 15.6993L6.66666 14.9993C6.66666 13.1743 6.79999 11.8327 7.03332 10.9743C7.24166 10.2243 7.72499 9.74102 8.47499 9.53268C8.86666 9.42435 9.58332 9.34935 10.6833 9.29935C11.7667 9.24102 12.7583 9.21602 13.675 9.21602L15 9.16602C18.4917 9.16602 20.6667 9.29935 21.525 9.53268C22.275 9.74102 22.7583 10.2243 22.9667 10.9743Z"
                                    fill="white" />
                            </svg>
                            <svg width="29" height="29" viewBox="0 0 29 29" fill="none"
                                xmlns="http://www.w3.org/2000/svg">
                                <circle cx="14.5" cy="14.5" r="14.5" fill="#828E9F" />
                                <path
                                    d="M19.4123 6.78125H22.0311L16.3098 13.3204L23.0405 22.2188H17.7696L13.6418 16.822L8.91876 22.2188H6.29834L12.4179 15.2244L5.96188 6.78125H11.365L15.0961 11.7141L19.4107 6.78125H19.4123ZM18.4932 20.6513H19.9443L10.5773 8.26642H9.02009L18.4932 20.6513Z"
                                    fill="white" />
                            </svg>
                        </div>
                        <div class="mt-5">
                            <h3 class="head-font mt-5">Address</h3>
                            <p>Lorem Ipsum is simply dummy text
                                dummy text</p>
                        </div>
                    </div>
                </div>
                <div class="row contact-acc" style="margin-top:115px">
                    <div class="card border-0">
                        <div class="card-body">
                            <h1
                                style="color: #323232;
                        font-family: 'Figtree';
                        font-size: 20px;
                        font-style: normal;
                        font-weight: 700;
                        line-height: 30px;
                        padding-left:16px;">
                                FAQ's</h1>
                            <div class="accordion accordion-flush" id="accordionFlushExample">
                                <div class="accordion-item">
                                    <h2 class="accordion-header" id="flush-headingOne">
                                        <button class="accordion-button collapsed" type="button"
                                            data-bs-toggle="collapse" data-bs-target="#flush-collapseOne"
                                            aria-expanded="false" aria-controls="flush-collapseOne">
                                            Return Policy
                                        </button>
                                    </h2>
                                    <div id="flush-collapseOne" class="accordion-collapse collapse"
                                        aria-labelledby="flush-headingOne" data-bs-parent="#accordionFlushExample">
                                        <div class="accordion-body">Placeholder content for this accordion, which is
                                            intended to
                                            demonstrate
                                            the <code>.accordion-flush</code> class. This is the first item's accordion
                                            body.</div>
                                    </div>
                                </div>
                                <div class="accordion-item">
                                    <h2 class="accordion-header" id="flush-headingTwo">
                                        <button class="accordion-button collapsed" type="button"
                                            data-bs-toggle="collapse" data-bs-target="#flush-collapseTwo"
                                            aria-expanded="false" aria-controls="flush-collapseTwo">
                                            Shipping Options
                                        </button>
                                    </h2>
                                    <div id="flush-collapseTwo" class="accordion-collapse collapse"
                                        aria-labelledby="flush-headingTwo" data-bs-parent="#accordionFlushExample">
                                        <div class="accordion-body">Placeholder content for this accordion, which is
                                            intended to
                                            demonstrate
                                            the <code>.accordion-flush</code> class. This is the second item's accordion
                                            body. Let's
                                            imagine
                                            this being filled with some actual content.</div>
                                    </div>
                                </div>
                                <div class="accordion-item">
                                    <h2 class="accordion-header" id="flush-headingThree">
                                        <button class="accordion-button collapsed" type="button"
                                            data-bs-toggle="collapse" data-bs-target="#flush-collapseThree"
                                            aria-expanded="false" aria-controls="flush-collapseThree">
                                            Shipping Options
                                        </button>
                                    </h2>
                                    <div id="flush-collapseThree" class="accordion-collapse collapse"
                                        aria-labelledby="flush-headingThree" data-bs-parent="#accordionFlushExample">
                                        <div class="accordion-body">Placeholder content for this accordion, which is
                                            intended to
                                            demonstrate
                                            the <code>.accordion-flush</code> class. This is the third item's accordion
                                            body.
                                            Nothing
                                            more
                                            exciting happening here in terms of content, but just filling up the space
                                            to make it
                                            look,
                                            at
                                            least at first glance, a bit more representative of how this would look in a
                                            real-world
                                            application.</div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-md-5 col-12  bg-white pt-3 pb-5 rounded">
                @if (session('success'))
                    <p class="alert alert-success">{{ session('success') }}</p>
                @endif
                <form action="{{ route('user.contactus') }}" method="post">
                    <div class="row justify-content-center">
                        <div class="col-md-6 col-12  text-start d-flex flex-column gap-4">
                            @csrf
                            <div class="d-flex flex-column gap-2">
                                <label for="">Name</label>
                                <input type="text" class="w-100 border-0 inp"
                                    style="height:35px; background-color:#F3F6F8" name="name">
                            </div>
                            @error('name')
                                <p class="text-danger">{{ $message }}</p>
                            @enderror
                            <div class="d-flex flex-column gap-2">
                                <label for="">Email</label>
                                <input type="email" class="w-100 border-0 inp"
                                    style="height:35px; background-color:#F3F6F8" name="email">
                            </div>
                            @error('email')
                                <p class="text-danger">{{ $message }}</p>
                            @enderror
                        </div>
                        <div class="col-md-6 col-12  text-start d-flex flex-column gap-4">
                            <div class="d-flex flex-column gap-2">
                                <label for="">Phone</label>
                                <input type="number" class="w-100 border-0 no-spinners inp"
                                    style="height:35px; background-color:#F3F6F8" name="phone">
                            </div>
                            @error('phone')
                                <p class="text-danger">{{ $message }}</p>
                            @enderror
                            <div class="d-flex flex-column gap-2">
                                <label for="">Company</label>
                                <input type="text" class="w-100 border-0 inp"
                                    style="height:35px; background-color:#F3F6F8" name="company">
                            </div>
                        </div>
                    </div>
                    <div class="mt-5">
                        <textarea class="w-100  border-0 inp" style="height:30vh; background-color:#F3F6F8" name="message"></textarea>
                    </div>
                    @error('message')
                        <p class="text-danger">{{ $message }}</p>
                    @enderror
                    <div class="d-flex justify-content-start mt-3">
                        <button class="arrow-white  text-white" style="height:37px ; border-radius:20px; width:207px; border:none;  margin-top:10px; background-color:#da5858">Send Message</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</main>
<script>
    $(document).ready(function() {

        $('#incrementBtn').click(function() {
            var currentValue = parseInt($('#quantity').val());
            $('#quantity').val(currentValue + 1);
        });

        $('#decrementBtn').click(function() {
            var currentValue = parseInt($('#quantity').val());
            if (currentValue > 1) {
                $('#quantity').val(currentValue - 1);
            }
        });
    });
</script>
@endsection
