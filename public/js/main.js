$(".header__menu .menu__list > li:has(.sub-menu)").addClass("arrow");

$(".header__menu .menu__list > li:has(.sub-menu)").addClass("arrow");
$(".header__menu .menu__list li.arrow > a").click(function (e) {
    e.preventDefault();
    $(this).parent("li").toggleClass("active");
    $(this).next(".sub-menu").slideToggle();
});

function tabsToggle() {
    $("#products__items_1").fadeIn(200);

    $(".tabItem").click(function () {
        $(this).closest(".tabsWrapper").find(".tabItem").removeClass("active");
        $(this).addClass("active");

        $(this).closest(".tabsWrapper").find(".tabContent").fadeOut(0);
        $(`#${$(this).data("tab_id")}`).fadeIn(200);
    });
}
tabsToggle();

function slickCarousel() {
    $(".brands__slider").slick({
        dots: true,
        arrows: false,
        slidesToShow: 1,
        centerMode: true,
        slidesToScroll: 1,
        centerPadding: "0px",
        wariableWidth: true,
    });
    $(".promo__slider").slick({
        dots: true,
        arrows: false,
        slidesToShow: 1,
        centerMode: true,
        slidesToScroll: 1,
        centerPadding: "0px",
        wariableWidth: true,
        
        appendDots: $(".promo__dots"),
    });
    $(".reviews__slider").slick({
        dots: true,
        arrows: false,
        slidesToShow: 2,
        slidesToScroll: 2,
        centerPadding: "0px",
        wariableWidth: true,
        infinite: true,
        responsive: [
            {
                breakpoint: 1280,
                settings: {
                    slidesToShow: 1,
                    slidesToScroll: 1,
                },
            },
        ],
    });
}
slickCarousel();

function menuToggle() {
    $(".header__menu-btn").click(function name() {
        $(".header__menu .menu__list").slideToggle();
    });
}
menuToggle();
