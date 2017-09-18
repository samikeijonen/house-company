/**
 * Housecompany JavaScript file.
 *
 * Set up the logo animation.
 */
( function( $ ) {

	// Variables.
	var logoWrapper     = $( '#logo-wrapper' );
	var mastHead        = $( '#masthead' );
	var mastHeadPadding = $( '#masthead' ).css( 'padding-top' );
	var content         = $( '#content' );
	var thumbnail       = content.find( '.has-post-thumbnail' );

	/* Content margin.
	if ( thumbnail.length ) {
		var contentMargin = mastHead.height() + 200;
		$( thumbnail ).css( 'margin-top', -contentMargin );
	}
	*/

	$(window).scroll( function() {

		// // Set padding top between 30-200 (mastHeadPadding).
		// var paddingTop = Math.max( 30, parseInt( mastHeadPadding ) - $(document).scrollTop() / 4 );
		//
		// // Set max-width between 334-668.
		// var maxWidth   = Math.max( 334, 668 - $(document).scrollTop() * 1.25 );
		//
		// // Set calculations to elements.
		// $( mastHead ).css( 'padding-top', paddingTop );
		// $( logoWrapper ).css( 'max-width', maxWidth );

		/* Content margin.
		if ( thumbnail.length ) {
			var contentMargin = mastHead.height() + 200;
			$( thumbnail ).css( 'margin-top', -contentMargin );
		}
		*/

});

} )( jQuery );
