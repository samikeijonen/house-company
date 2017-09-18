/**
 * Slick Slider settings.
 */
( function( $ ) {

	$(document).ready( function() {
		$('.slider-images-wrapper').slick({
			//setting-name: setting-value
			infinite: true,
			autoplay: true,
			autoplaySpeed: 3000,
			arrows: false,
			centerMode: true,
			fade: true,
			cssEase: 'linear',
			speed: 600,
			slidesToShow: 1,
			slidesToScroll: 1,
			adaptiveHeight: false,
			pauseOnHover: false,
		});
	});

} )( jQuery );
