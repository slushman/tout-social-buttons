/**
 * customizer.js
 *
 * Theme Customizer enhancements for a better user experience.
 *
 * Contains handlers to make the Customizer preview reload changes asynchronously.
 */
( function( $ ) {

	/**
	 * AlterClass function by Pete Boere.
	 *
	 * @link https://gist.github.com/peteboere/1517285
	 * @param 		string 		removals 		Classses to remove.
	 * @param 		string 		additions 		Classes to add.
	 * @return 		string 						Classes for an element.
	 */
	$.fn.alterClass = function ( removals, additions ) {

		var self = this;

		if ( removals.indexOf( '*' ) === -1 ) {
			// Use native jQuery methods if there is no wildcard matching
			self.removeClass( removals );
			return !additions ? self : self.addClass( additions );
		}

		var patt = new RegExp( '\\s' +
				removals.
					replace( /\*/g, '[A-Za-z0-9-_]+' ).
					split( ' ' ).
					join( '\\s|\\s' ) +
				'\\s', 'g' );

		self.each( function ( i, it ) {
			var cn = ' ' + it.className + ' ';
			while ( patt.test( cn ) ) {
				cn = cn.replace( patt, ' ' );
			}
			it.className = $.trim( cn );
		});

		return !additions ? self : self.addClass( additions );
	};

	// Button Type
	wp.customize( 'tout_social_buttons_button_type', function( value ) {
		value.bind( function( to ){

			var labels = $('.tout-social-button-text');
			var icons = $('.tout-social-button-icon');

			labels.toggleClass( 'screen-reader-text' );
			icons.toggleClass( 'hidden' );

			// if ( 'icon' == value ) {
			//
			// 	labels.addClass( 'screen-reader-text' );
			// 	icons.removeClass( 'hidden' );
			//
			// } else {
			//
			// 	labels.removeClass( 'screen-reader-text' );
			// 	icons.addClass( 'hidden' );
			//
			// }
		});
	});

})( jQuery );
