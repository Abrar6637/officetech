<body>
    <footer class="footer">
        <div class="container">
            <div class="footer__inner">
                <div class="footer__l">
                    <a href="/" class="footer__logo">
                        <img src={{ asset('updated-assets/images/logo.svg') }} alt="">
                    </a>
                    <p class="footer__l-dscr" data-translate="footer_message">
                        Your reliable partner in office technology. We provide solutions for efficient office process
                        management and support
                        your business in finding optimal technological solutions.
                    </p>
                </div>
                <div class="footer__menu">
                    <ul class="menu__list">
                        <li class="footer__menu-title" data-translate="categories">
                            Categories
                        </li>
                        @if ($main_categories->count() > 0)
                            @foreach ($main_categories->take(2) as $main_category)
                                @if (
                                    $main_category->subCategories->count() > 0 &&
                                        $main_category->id == $main_category->subCategories->first()->parent_category_id)
                                    @foreach ($main_category->subCategories->take(1) as $subcategory)
                                        <li class="menu__item">
                                            <a class="menu__link"
                                                href="{{ route('sub.category.products', $subcategory->slug) }}">{{ $main_category->category_name }}</a>
                                        </li>
                                    @endforeach
                                @endif
                            @endforeach
                        @else
                            <li><a href="#">No Categories</a></li>
                        @endif
                    </ul>
                    <ul class="menu__list">
                        <li class="footer__menu-title" data-translate="quick_links">
                            Quick Links
                        </li>
                        <li class="menu__item">
                            <a href="{{ route('user.aboutUs') }}" class="menu__link" data-translate="about_officetech">
                                About OfficeTech
                            </a>
                        </li>
                        <li class="menu__item">
                            <a href="{{ route('user.contact_us') }}" class="menu__link" data-translate="contact_us_btn">
                                Contact Us
                            </a>
                        </li>
                        <li class="menu__item">
                            <a href="{{ route('user.track_order') }}" class="menu__link" data-translate="track_order_btn">
                                Track Order
                            </a>
                        </li>
                        <li class="menu__item">
                            <a href="{{ route('payment.policy') }}" class="menu__link" data-translate="payment_policy">
                                Payment Policy
                            </a>
                        </li>
                        <li class="menu__item">
                            <a href="{{ route('service.plans.policy') }}" class="menu__link" data-translate="service_plan_policy">
                                Service Plans Policy
                            </a>
                        </li>
                        <li class="menu__item">
                            <a href="{{ route('service.policy') }}" class="menu__link" data-translate="service_policy">
                                Service Policy
                            </a>
                        </li>
                        <li class="menu__item">
                            <a href="{{ route('return.policy') }}" class="menu__link" data-translate="return_policy">
                                Return Policy
                            </a>
                        </li>
                        <li class="menu__item">
                            <a href="{{ route('vat.certificate') }}" class="menu__link" data-translate="vat_certificate">
                                Vat Certificate
                            </a>
                        </li>
                        <li class="menu__item">
                            <a href="{{ route('ecom.print.package') }}" class="menu__link" data-translate="print_package">
                                Print Package
                            </a>
                        </li>
                        <li class="menu__item">
                                <a href="{{ route('privacy.policy') }}" class="menu__link" data-translate="policy">
                                    Policy
                                </a>
                            </li>
                            <li class="menu__item">
                                <a href="{{ route('terms.conditions') }}" class="menu__link" data-translate="terms_conditions">
                                    Terms & Conditions
                                </a>
                            </li>
                    </ul>
                    <div class="menu__list contact">
                        <div class="footer__menu-title" data-translate="contact_us_btn">
                            Contact Us
                        </div>
                        <ul>
                            <li class="menu__item">
                                <a href="tel:+966920012082" class="menu__link">
                                    +966 92 001 2082
                                </a>
                            </li>
                            <li class="menu__item">
                                <a href="mailto:info@officetech.com.sa" class="menu__link">
                                    info@officetech.com.sa
                                </a>
                            </li>
                        </ul>
                        <div class="footer__social">
                            <a href="https://www.facebook.com">
                                <img src={{ asset('updated-assets/images/icons/footer__social_1.svg') }} alt="">
                            </a>
                            <a href="https://youtube.com">
                                <img src={{ asset('updated-assets/images/icons/footer__social_2.svg') }}
                                    alt="">
                            </a>
                            <a href="https://twitter.com">
                                <img src={{ asset('updated-assets/images/icons/footer__social_3.svg') }}
                                    alt="">
                            </a>
                        </div>
                    </div>
                </div>
            </div>
            <div class="footer__bottom">
                <div class="footer__payment">
                    <img src={{ asset('updated-assets/images/payment.webp') }} alt="">
                </div>
                <div class="footer__bottom-r">
                    <p class="footer__copy">
                        © 2024 OfficeTech. All rights reserved. Developed by <a href="https://www.go-globe.com/ ">GO-Globe.com</a>
                    </p>
                </div>
            </div>
        </div>
        <meta name="csrf-token" content="{{ csrf_token() }}">
    </footer>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://code.jquery.com/jquery-3.6.4.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/slick-carousel@1.8.1/slick/slick.min.js"></script>
    <script src="{{ asset('updated-assets/js/main.js') }}"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script>
        $(document).ready(function() {
            $('#newsletterBtn').click(function(e) {
                e.preventDefault();
                var email = $('#newsletterForm input[name="email"]').val();
                var format = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;
                if (!format.test(email.trim())) {
                    Swal.fire({
                        icon: 'error',
                        title: 'Oops...',
                        text: 'Please Enter Valid Email !',
                        iconColor: '#03045E',
                        confirmButtonColor: '#03045E',
                    });
                    return;
                } else {
                    $.ajax({
                        type: 'POST',
                        url: '{{ route('user.newsletter') }}',
                        data: {
                            email: email
                        },
                        dataType: 'json',
                        success: function(response) {
                            Swal.fire({
                                title: 'Success !',
                                text: 'Subscribed!',
                                icon: 'success',
                                iconColor: '#03045E',
                                confirmButtonColor: '#03045E',
                                confirmButtonText: 'OK'
                            });
                            $('#newsletterForm input[name="email"]').val('');
                        },
                        error: function(error) {
                            Swal.fire({
                                icon: 'info',
                                title: 'Oops...',
                                text: 'Already Subscribed!',
                                iconColor: '#03045E',
                                confirmButtonColor: '#03045E',
                            });
                        }
                    });
                }
            });
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
                            if(data.product.length === 0 && data.gallery_image.length === 0){
                                console.log('Field Is Empty');
                                $('#suggestions').removeClass('header-search-suggestions');
                                $(suggestionsContainer).empty();
                                $(suggestionsContainer).hide();
                                // $(suggestionsContainer).css('style:', 'display:none !important');
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
            $(document).click(function(event) {
                var searchInput = $('#search-field');
                var suggestionsContainer = $('#suggestions');

                if (!searchInput.is(event.target)){
                    suggestionsContainer.empty().hide();
                }
            });
            function displaySuggestions(products, suggestionsContainer) {
                $(suggestionsContainer).empty();

                let searchBarWidth =  $('.searchbar-officetech').width();
                $.each(products.product, function(index, product) {
                    var suggestion = '<div class="d-flex align-items-center justify-content-around" style="gap:10px; display:flex; justify-content:space-between"><div>';
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
</body>
