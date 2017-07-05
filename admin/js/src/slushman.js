/**
 * The following pattern allows for outside files to use these functions as a library.
 *
 * The parameter passed into this function is 'exports'.
 * Each function within defines itself within 'exports', along with a unique name
 * 	that outside scripts can reference.
 * In the parenthesis below, setup the blank this.tout as an empty object.
 *
 * Outside scripts would call these like:
 * tout.getEventTarget( eventName )
 * tout.getParent( element, className )
 */
(function( exports, $ ) {

	'use strict';

	/**
	 * Returns the event target.
	 *
	 * @param 		object 		event 		The event.
	 * @return 		object 		target 		The event target.
	 */
	exports.getEventTarget = function getEventTarget( event ) {

		event = event || window.event;

		return event.target || event.srcElement;

	} // getEventTarget()

	/**
	 * Returns the parent node with the requested class.
	 *
	 * This is recursive, so it will continue up the DOM tree
	 * until the correct parent is found.
	 *
	 * @param 		object 		el 				The node element.
	 * @param 		string 		className 		Name of the class to find.
	 * @return 		object 						The parent element.
	 */
	exports.getParent = function getParent( el, className ) {

		var parent = el.parentNode;

		if ( '' !== parent.classList && parent.classList.contains( className ) ) {

			return parent;

		}

		return exports.getParent( parent, className );

	} // getParent()

	/**
	 * Sends data to a PHP handler for saving via AJAX.
	 *
	 * @since 		1.0.0
	 * @param 		array 		paramData 		The data to send to the PHP handler.
	 */
	exports.saveAjax = function saveAjax( paramData ) {

		//console.log( paramData );

		var opts = {
			url: ajaxurl,
			type: 'POST',
			async: true,
			cache: false,
			data: paramData,
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

		//console.log( opts );

		$.ajax( opts );

	} // saveAjax()

})( this.tout = {}, jQuery );
