(function( $ ) {

	'use strict';

	/**
	 * Gets the event target, then gets the checkbox,
	 * then checks the box.
	 *
	 * @param 		object 		event 		The event.
	 */
	function processEvent( event ) {

		var target = tout.getEventTarget( event );

		if ( 'path' !== target.nodeName && 'INPUT' !== target.nodeName && 'svg' !== target.nodeName ) { return; }

		var parent = tout.getParent( target, 'tout-btn' );
		var checkbox = parent.querySelector( '.tout-btn-checkbox' );

		// console.log( target );
		// console.log( parent );
		// console.log( checkbox );

		if ( 'checked' === checkbox.getAttribute( 'checked' ) ) { // checkbox is checked

			checkbox.removeAttribute( 'checked' );

		} else {

			checkbox.setAttribute( 'checked', 'checked' );

		}

		parent.classList.toggle( 'checked' );

		var wrap = tout.getParent( target, 'tout-btn-wrap' );
		var selection = wrap.getAttribute( 'data-id' );

		var opts = {
			url: ajaxurl,
			type: 'POST',
			async: true,
			cache: false,
			data: {
				action: 'save_button_selection',
				tbSelectionNonce: Tout_Buttons_Ajax.tbSelectionNonce,
				selection: selection
			},
			success: function ( response ) {
				$( '.button-status' ).html( '<span class="status">' + response  + '</span>' );
				$( '.button-status' ).addClass( 'updated' );
				$( '.button-status' ).fadeIn( 'fast' );
				$( '.button-status' ).fadeOut( 2000 );

				return;
			},
			error: function (xhr, testStatus, error ) {
				$( '.button-status' ).html( '<span class="status">' + error + '</span>' );
				$( '.button-status' ).addClass( 'error' );
				$( '.button-status' ).fadeIn( 'fast' );
				$( '.button-status' ).fadeOut( 2000 );

				return;
			}
		}

		$.ajax( opts );

	} // processEvent()

	var buttons = document.querySelector( '.tout-buttons' );

	buttons.addEventListener( 'click', processEvent );

})( jQuery );
