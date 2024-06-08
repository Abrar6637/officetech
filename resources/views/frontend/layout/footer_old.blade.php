{{-- Get In Touch  --}}
<meta name="csrf-token" content="{{ csrf_token() }}">
@if (!Session::get('user_name'))
    <div class="container" id="error_message_pt">
        <div class="row mt-5">
            <div class="col-12 col-md-6 bg-white py-5 text-start shadow" style="padding-left:50px">
                <h1 class="text-black foot-left">Get in touch</h1>
                <p>You can contact us on the contact page</p>
                <button class="arrow-white text-white "
                    style="height:37px ; border-radius:20px; width:207px; border:none;  margin-top:10px;background: #da5858"><a href="{{ route('user.contact_us') }}" class="text-white">Contact
                    us</a></button>
            </div>
            <div class="col-12 col-md-6 py-5" style="background: #da5858">
                <div class="text-start pb-4" style="padding-left:30px">
                    <h1 class="text-white">Subscribe to our newsletter</h1>
                    <p class="text-white">Stay up to date with new events</p>
                </div>
                <div class="row">
                    <form action="{{route('user.newsletter')}}" id="newsletterForm" method="POST">
                        @csrf
                        <input type="email" class="col-7 offset-1 newsletter-input in text-light" placeholder="Your Email"
                            style="border-radius:20px ; background-color: transparent; border-color:white; border: 1px solid white; height:35px;margin-right:10px;padding-left: 10px;" name="email" id="email">
                        <button class="arrow-black col-3 bg-white newsletter-submit-btn"
                            style="height:37px ; border-radius:20px;  border:none; margin-left:10px; text-wrap:nowrap; font-size:13px" id="newsletterBtn">Submit</button>
                        <!-- <input type="text" class="col-7 offset-1 newsletter-input in" placeholder="Your Email" style="border-radius:20px ; background-color: transparent; border-color:white; border: 1px solid white; height:35px;  margin-right:10px">
                        <button class="arrow-black col-3 bg-white newsletter-submit-btn" style="height:37px ; border-radius:20px;  border:none; margin-left:10px">Submit</button> -->
                    </form>
                </div>
            </div>
        </div>
    </div>
@endif

<br><br><br>
<footer class="footer bg-white" style="padding-top:50px;">
    <div class="container text-start">
        <div class="row">
            <!-- First Section: Logo, Paragraph, and Visa Card Image -->
            <div class="col-lg-3 col-md-6 col-sm-12 ">
                <img src="{{ asset('images/logo.png') }}" alt="Company Logo" class="d-flex m-auto m-sm-none"
                    style="width: 187.66px;">
                <p class=" footer-p mt-2 text-center text-sm-start">Your reliable partner in office technology. We provide solutions for efficient
                    office process management and support your business in finding optimal technological solutions.</p>
                <div class="footer-payment-img d-flex justify-content-center justify-content-sm-start">
                    <img src="{{ asset('images/visa.png') }}" alt="Visa Card" style="object-fit:contain" width="50">
                    <img src="{{ asset('images/mastercard.png') }}" alt="Visa Card" width="50">
                </div>
            </div>
            <!-- Second Section: Categories -->
            <div class="col-lg-3 col-md-6 col-sm-12 text-center text-sm-start">
                <div class="categories-footer-section">
                    <h5 class="footer-section-heading">Categories</h5>
                    <div class="footer-category">
                        <ul>
                            @if ($main_categories->count() > 0)                        
                                @foreach ($main_categories as $main_category)
                                    @if ($main_category->subCategories->count() > 0 && $main_category->id == $main_category->subCategories->first()->parent_category_id)
                                        @foreach ($main_category->subCategories->take(1) as $subcategory)                                          
                                            <li><a href="{{ route('sub.category.products', $subcategory->slug) }}">{{$main_category->category_name}}</a></li>  
                                        @endforeach
                                    @endif
                                @endforeach
                                @else
                                <li><a href="#">No Categories</a></li>
                            @endif
                        </ul>
                    </div>
                </div>
            </div>
            <!-- Third Section: Quick Links -->
            <div class="col-lg-3 col-md-6 col-sm-12 text-center text-sm-start">
                <h5 class="footer-section-heading">Quick Links</h5>
                <div class="footer-category">
                    <ul>
                        {{-- <li><a href="{{ route('user.services') }}">Services</a></li> --}}
                        <li><a href="{{ route('user.aboutUs') }}">About OfficeTech</a></li>
                        <li><a href="{{ route('user.contact_us') }}">Contact Us</a></li>
                        <li><a href="{{ route('user.track_order') }}">Track Order</a></li>
                        <li><a href="{{ route('payment.policy') }}">Payment Policy</a></li>
                        <li><a href="{{ route('service.plans.policy') }}">Service Plans Policy</a></li>
                        <li><a href="{{ route('service.policy') }}">Service Policy</a></li>
                    </ul>
                </div>
            </div>
            <!-- Fourth Section: Contact Information -->
            <div class="col-lg-3 col-md-6 col-sm-12 text-center text-sm-start">
                <h5 class="footer-section-heading">Contact Us</h5>
                <ul class="footer-contact">
                    <li><a href="#">+1 (234) 5678 900</a></li>
                    <li><a href="#">info@officetech.com.sa</a></li>
                    <li class="footer-p d-flex m-auto m-sm-0" style="width: 221px;">Lorem Ipsum is simply dummy text</li>
                    <li class="footer-social-img">
                        <a href="#" class=""><img src="{{ asset('images/ri_facebook-fill.png') }}"
                                alt=""></a>
                        <a href="#" class="">
                            <img src="{{ asset('images/ri_twitter-x-fill.png') }}" alt="">
                        </a>
                        <a href="#" class=""><img src="{{ asset('images/mdi_youtube.png') }}"
                                alt=""></a>
                    </li>
                </ul>
            </div>
        </div>
        <hr>
        <div class="d-flex flex-column flex-md-row justify-content-md-between mt-1 text-center text-sm-start">
            <p class="footer-office">© 2023 OfficeTech | All rights reserved. Developed by
                <font class="footer-office-go">GO-Globe.com</font>
            </p>
            <div class="d-flex flex-column flex-md-row">
                <p class="footer-policy"><a href="{{route('privacy.policy')}}">Policy</a> &nbsp;</p>
                <p class="footer-term"><a href="{{route('terms.conditions')}}">Terms & Conditions</a></p>
            </div>
        </div>
    </div>
</footer>
<!-- BootStrap Script -->
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js"></script>
<!-- Script For Show Category -->
<script>
    $(document).ready(function() {
        $(".main-category-li").click(function(e) {
            e.preventDefault();
            $(".hide-nav-class").hide();
            var targetId = $(this).data("target");
            $("#" + targetId).toggle();
            $(".hoverable-dropdown").show();
        });

        $(document).click(function(e) {
            if (
                !$(e.target).closest(".hoverable-dropdown").length &&
                !$(e.target).hasClass("main-nav") &&
                !$(e.target).hasClass("categories-container")
            ) {
                $(".hoverable-dropdown").hide();
            }
        });

        $(".hoverable-dropdown").click(function(e) {
            e.stopPropagation();
        });

        $(".categories-container").click(function(e) {
            e.stopPropagation();
        });

        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });
        var user_id = @json($user_id ?? null);
        if (user_id == null) {
            var user_id = @json($without_user_add_to_Cart ?? null);
            card_badge_show(user_id);
        } else {
            ;
            card_badge_show(user_id);
        }

        function card_badge_show(user_id) {
            $.ajax({
                type: 'POST',
                url: "/cart/showquantity",
                data: {
                    user_id: user_id,
                },
                success: function(response) {
                    if (response.data) {
                        $("#cart-badge").text(response.data.length);
                        $("#mobile-cart-badge").text(response.data.length);
                    }
                },
                error: function(data) {
                    console.log(data);
                }
            });
        }
        $("#cart-badge").show();
        $("#mobile-cart-badge").show();
    });

    document.addEventListener("DOMContentLoaded", function() {
        var subNavs = document.querySelectorAll(".sub-nav");

        subNavs.forEach(function(subNav) {
            var parentLi = subNav.closest("li");
            var subNavLinks = subNav.querySelectorAll("a");
            // Calculate the maximum width based on the content
            subNavLinks.forEach(function(link) {
                var linkWidth = link.getBoundingClientRect().width;
                if (linkWidth > maxWidth) {
                    maxWidth = linkWidth;
                }
            });

            // Set the sub-nav width based on the content or the data-width attribute
            if (parentLi && parentLi.dataset.width) {
                subNav.style.width = parentLi.dataset.width + "px";
            } else {
                subNav.style.width = maxWidth + "px";
            }
        });
    });
    document.addEventListener("DOMContentLoaded", function() {
        var mainNav = document.querySelector(".main-nav");
        var ccontainer = document.querySelector(".categories-container");
        var showCategoriesBtn = document.getElementById("show-categories-btn");

       
        function toggleCategories() {
            if (mainNav.style.display === "block") {
                ccontainer.style.transition = "opacity 0.8s"; 
                mainNav.style.opacity = "0"; 
                setTimeout(function() {
                    mainNav.style.display = "none"; 
                }, 500); 
            } else {
                mainNav.style.transition = "opacity 0.8s";
                mainNav.style.display = "block"; 
                setTimeout(function() {
                    mainNav.style.opacity = "1"; 
                }, 10); 
            }
        }
        showCategoriesBtn.addEventListener("click", toggleCategories);
    });
</script>
<script>
    window.Laravel = {!! json_encode(['baseUrl' => url('/')]) !!};
    $(document).ready(function() {
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });

        function handleSearch(query, suggestionsContainer, displayCallback) {
            if (query.length >= 3 || query.length == 0) {
                $.ajax({
                    url: '/search',
                    method: 'POST',
                    data: {
                        query: query
                    },
                    dataType: 'json',
                    success: function(data) {
                        console.log(data);
                        if(data.products == ''){
                            console.log('Field Is Empty');
                            $('#suggestions').removeClass('header-search-suggestions');
                        } else{
                            $('#suggestions').addClass('header-search-suggestions');
                            $(suggestionsContainer).show();
                        }
                        displayCallback(data, suggestionsContainer);
                        $('.inner-suggestion').on('click', function() {
                            var productSlug = $(this).data('product-slug');
                            window.location.href = '/product-details/' + productSlug;
                        });
                    },
                    error: function(data) {
                        console.log(data);
                    }
                });
            } else {
                $(suggestionsContainer).empty().hide();
            }
        }

        function displaySuggestions(products, suggestionsContainer) {
            $(suggestionsContainer).empty();

            let searchBarWidth =  $('.searchbar-officetech').width();
            $(suggestionsContainer).attr('style', 'width: '+searchBarWidth+'px !important');
            $.each(products.product, function(index, product) {
                var suggestion = '<div class="d-flex align-items-center justify-content-around"><div>';
                suggestion += '<div class="inner-suggestion " data-product-slug="' + product.slug + '">' +
                    product.name + '</div>';
                suggestion += '<div class="mb-2">' + product.sku + '</div></div>';
                if (products.gallery_image[index] && products.gallery_image[index].length > 0) {
                    var imagePath = window.Laravel.baseUrl + '/images/product_images/' + products.gallery_image[index];
                    suggestion += '<div class=""><img src="' + imagePath +
                        '" alt="Gallery Image" class=" ms-2" style="width:60px; height:60px"></div></div><hr>';
                }

                $(suggestionsContainer).append(suggestion);
            });
        }

        $('#search-field').keyup(function(e) {
                var query = $(this).val();
                handleSearch(query, '#suggestions', displaySuggestions);
        });

        $('#search-field-mobile').keyup(function() {
            var queryMobile = $(this).val();
            handleSearch(queryMobile, '#suggestions-mobile', displaySuggestions);
        });
    });
</script>
<script>
    $(document).ready(function() {
        $('#search-form').submit(function() {
            var query = $('#search-field').val().trim();

            if (query.length === 0 || query.length < 3) {
                $('.search_error').show()
                return false;
            }
            $('.search_error').hide();
            return true;
        });
    });
</script>
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<script>
    $(document).ready(function () {
        $('#newsletterBtn').click(function (e) { 
            e.preventDefault();
            var email = $('#newsletterForm input[name="email"]').val();
            var format  = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;
            if (!format.test(email.trim())) {
                Swal.fire({
                    icon: 'error',
                    title: 'Oops...',
                    text: 'Please Enter Valid Email !',
                    iconColor: '#da5858',
                    confirmButtonColor: '#da5858',
                });
                return;
            }
            else
            {
                $.ajax({
                    type: 'POST',
                    url: '{{route('user.newsletter')}}',
                    data: {email:email},
                    dataType: 'json',
                    success: function (response) {
                        Swal.fire({
                            title: 'Success !',
                            text: 'Subscribed!',
                            icon: 'success',
                            iconColor: '#da5858',
                            confirmButtonColor: '#da5858',
                            confirmButtonText: 'OK'
                        });
                        $('#newsletterForm input[name="email"]').val('');
                    },
                    error: function (error) {
                    Swal.fire({
                            icon: 'info',
                            title: 'Oops...',
                            text: 'Already Subscribed!',
                            iconColor: '#da5858',
                            confirmButtonColor: '#da5858',
                        });
                    }
                });
            }
        });
    });
</script>
</body>
</html>