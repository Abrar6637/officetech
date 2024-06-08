$('.header__menu .menu__list > li:has(.sub-menu)').addClass('arrow');

$('.header__menu .menu__list > li:has(.sub-menu)').addClass('arrow');
$('.header__menu .menu__list li.arrow > a').click( function (e) {
	e.preventDefault();
	$(this).parent('li').toggleClass('active');
	$(this).next('.sub-menu').slideToggle();
})

function tabsToggle() {
	$('#products__items_1').fadeIn(200);

	$('.tabItem').click(function () {
		$(this).closest('.tabsWrapper').find('.tabItem').removeClass('active');
		$(this).addClass('active');

		$(this).closest('.tabsWrapper').find('.tabContent').fadeOut(0);
		$(`#${$(this).data('tab_id')}`).fadeIn(200);
	})
}
tabsToggle();

function slickCarousel() {
	// $('.brands__slider').slick({
	// 	dots: true,
	// 	arrows: false,
	// 	slidesToShow: 6,
	// 	centerMode: true,
	// 	slidesToScroll: 1,
	// 	centerPadding: '0px',
	// 	wariableWidth: true,
	// });
	$('.brands__slider').slick({
		dots: true,
		arrows: false,
		slidesToShow: 6,
		centerMode: false,
		slidesToScroll: 1,
		centerPadding: '0px',
		variableWidth: false,
		autoplay: true, // Add autoplay
		autoplaySpeed: 3000,
		infinite: true, // Add loop		// Adjust autoplay speed in milliseconds (e.g., 2000ms for 2 seconds)
		responsive: [
			{
				breakpoint: 768, // Adjust this breakpoint as needed
				settings: {
					slidesToShow: 3,
				}
			},
			// Add more breakpoints and settings if needed
		]
	});
	$('.promo__slider').slick({
		dots: true,
		arrows: false,
		slidesToShow: 1,
		centerMode: true,
		slidesToScroll: 1,
		centerPadding: '0px',
		wariableWidth: true,
		appendDots: $('.promo__dots'),
		autoplay: true,
		autoplaySpeed: 5000,
	});
	$('.reviews__slider').slick({
		dots: true,
		arrows: false,
		slidesToShow: 2,
		slidesToScroll: 2,
		centerPadding: '0px',
		wariableWidth: true,
		infinite: true,
		responsive: [
			{
				breakpoint: 1280,
				settings: {
					slidesToShow: 1,
					slidesToScroll: 1,
				}
			}
		]
	});
	$('.single__slider-main').slick({
		dots: false,
		arrows: false,
		slidesToShow: 1,
		slidesToScroll: 1,
		centerPadding: '0px',
		wariableWidth: true,
		infinite: true,
		asNavFor: '.single__slider-items'
	});
	$('.single__slider-items').slick({
		dots: false,
		arrows: true,
		slidesToShow: 5,
		slidesToScroll: 1,
		centerPadding: '0px',
		wariableWidth: true,
		infinite: true,
		focusOnSelect: true,
		asNavFor: '.single__slider-main',
		responsive: [
			{
				breakpoint: 1280,
				settings: {
					slidesToShow: 3,
				}
			}
		]
	});
}
slickCarousel();

function menuToggle() {
	$('.header__menu-btn').click( function name() {
		$('.header__menu .menu__list').slideToggle();
	})
}
menuToggle();

function accordion() {
	$(".accordion-item").on("click", function (e) {
		e.preventDefault();

		if (!$(this).hasClass("accordion-active")) {
			$(".accordion-item-body").slideUp(300);
			$(".accordion-item-title").removeClass("accordion-active");
			$(".accordion-item").removeClass("accordion-active");
		}

		$(this).toggleClass("accordion-active");
		$(this).children('.accordion-item-title').toggleClass("accordion-active");
		$(this).children('.accordion-item-body').slideToggle();
	});
	$(".accordion-item-body a").on("click", function (e) {
        e.stopPropagation();
    });
}
accordion();

function cartAddAndRemoveBtns() {
	let countSpan = document.querySelector('.single__count span');
	if (countSpan) {
		document.querySelector('.single__count .add').addEventListener('click', function () {
			let currentCount = parseInt(countSpan.textContent);
			countSpan.textContent = currentCount + 1;
		});
		document.querySelector('.single__count .remove').addEventListener('click', function () {
			let currentCount = parseInt(countSpan.textContent);
			if (currentCount > 1) {
				countSpan.textContent = currentCount - 1;
			}
		});
	}
}
cartAddAndRemoveBtns();

function priceRange() {
	const rangeInput = document.querySelectorAll(".range-input input"),
  priceInput = document.querySelectorAll(".price-input input"),
  range = document.querySelector(".slider .progress");
	let priceGap = 0;

	priceInput.forEach((input) => {
		input.addEventListener("input", (e) => {
			let minPrice = parseInt(priceInput[0].value),
				maxPrice = parseInt(priceInput[1].value);

			if (maxPrice - minPrice >= priceGap && maxPrice <= rangeInput[1].max) {
				if (e.target.className === "input-min") {
					rangeInput[0].value = minPrice;
					range.style.left = (minPrice / rangeInput[0].max) * 100 + "%";
				} else {
					rangeInput[1].value = maxPrice;
					range.style.right = 100 - (maxPrice / rangeInput[1].max) * 100 + "%";
				}
			}
		});
	});

	rangeInput.forEach((input) => {
		input.addEventListener("input", (e) => {
			let minVal = parseInt(rangeInput[0].value),
				maxVal = parseInt(rangeInput[1].value);

			if (maxVal - minVal < priceGap) {
				if (e.target.className === "range-min") {
					rangeInput[0].value = maxVal - priceGap;
				} else {
					rangeInput[1].value = minVal + priceGap;
				}
			} else {
				priceInput[0].value = minVal;
				priceInput[1].value = maxVal;
				range.style.left = (minVal / rangeInput[0].max) * 100 + "%";
				range.style.right = 100 - (maxVal / rangeInput[1].max) * 100 + "%";
			}
		});
	});
}
priceRange();

function maxPrice() {
	document.addEventListener('DOMContentLoaded', function () {
		let inputElement = document.querySelector('.input-max');

		inputElement.addEventListener('change', function () {
			let maxValue = parseFloat(inputElement.getAttribute('max'));
			let currentValue = parseFloat(inputElement.value);

			if (currentValue > maxValue) {
				inputElement.value = maxValue;
			}
		});
	});
}
maxPrice();