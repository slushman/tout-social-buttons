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
	wp.customize( 'tout_social_buttons[button_type]', function( value ) {
		value.bind( function( to ){

			var labels = $('.tout-social-button-text');
			var icons = $('.tout-social-button-icon-wrap');
			var classyLabels = labels.hasClass( 'screen-reader-text' );
			var classyIcons = icons.hasClass( 'hidden' );

			if ( 'icon' === to && ! classyLabels ) { // selected icon, labels don't have class - add class

				labels.addClass( 'screen-reader-text' );

			}

			if ( 'icon' === to && classyIcons ) { // selected icons, icons have class - remove class

				icons.removeClass( 'hidden' );

			}

			if ( 'text' === to && classyLabels ) { // selected text, labels have class - remove class

				labels.removeClass( 'screen-reader-text' );

			}

			if ( 'text' === to && ! classyIcons ) { // selected text, icons don't have class - add class

				icons.addClass( 'hidden' );

			}


			// icon, labels has class - nothing
			// icon, labels no class - add class
			// text, labels has class - remove class
			// text, labels no class -
			//
			// icon, icons has class -
			// icon, icons no class -
			// text, icons has class -
			// text, icons no class -

			// labels.toggleClass( 'screen-reader-text' );
			// icons.toggleClass( 'hidden' );

		});
	});

	// Click to Tweet Style
	wp.customize( 'tout_social_buttons[clicktotweet_style]', function( value ) {
		value.bind( function( to ){

			var wrap = $('.click-to-tweet-wrap');

			wrap.alterClass( 'default solid border shadow', to );

		});
	});

})( jQuery );
