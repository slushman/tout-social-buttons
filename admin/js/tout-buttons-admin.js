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
(function( exports ) {

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

})( this.tout = {} );

(function() {

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

	} // processEvent()

	var buttons = document.querySelector( '.tout-buttons' );

	buttons.addEventListener( 'click', processEvent );

})();

(function( $ ) {

	'use strict';

	/**
	 * Makes the icons in the admin sortable using jQuery UI Sortable.
	 * Saves the button order via AJAX in the button-order hidden field.
	 */

	var sorter = $('#tout-btn-sort');

	sorter.sortable({
		cursor: 'move',
		forcePlaceholderSize: true,
		items: '.tout-btn-wrap',
		opacity: 0.6,
		placeholder: 'btn-placeholder',
		update: function( event, ui ) {

			var btnOrder = $('#tout-button-order');
			var order = sorter.sortable('toArray', {attribute:'data-id'}).toString();

			btnOrder.val( order );

			// console.log( order );
			//
			// $.ajax({
			// 	url: ajaxurl,
			// 	type: 'POST',
			// 	data: {
			// 		action: 'save_button_order',
			// 		tbboNonce: Tout_Buttons_Ajax.tbboNonce,
			// 		order: sorter.sortable('serialize')
			// 	},
			// 	success: function( response ) {
			// 		$( '.button-status' ).html( '<span class="status">' + response + '</span>' );
			// 		$( '.button-status' ).addClass( 'updated' );
			// 		$( '.button-status' ).fadeIn( 'fast' );
			// 		$( '.button-status' ).fadeOut( 2000 );
			// 	},
			// 	error: function( error ) {
			// 		alert( error );
			// 	}
			// });

			//return false;

			// var opts = {
			// 	url: ajaxurl,
			// 	type: 'POST',
			// 	async: true,
			// 	cache: false,
			// 	dataType: 'json',
			// 	data: {
			// 		'action': 'save_button_order',
			// 		'tbboNonce': Tout_Buttons_Ajax.tbboNonce,
			// 		'order': sorter.sortable('serialize')
			// 	},
			// 	success: function ( response ) {
			// 		$( '.button-status' ).html( '<span class="status">' + response  + '</span>' );
			// 		$( '.button-status' ).addClass( 'updated' );
			// 		$( '.button-status' ).fadeIn( 'fast' );
			// 		$( '.button-status' ).fadeOut( 2000 );
			//
			// 		return;
			// 	},
			// 	error: function (xhr, testStatus, error ) {
			// 		$( '.button-status' ).html( '<span class="status">' + Tout_Buttons_Ajax.error_message + '</span>' );
			// 		$( '.button-status' ).addClass( 'error' );
			// 		$( '.button-status' ).fadeIn( 'fast' );
			// 		$( '.button-status' ).fadeOut( 2000 );
			//
			// 		return;
			// 	}
			// }
			//
			// $.ajax( opts );

		}

	});

})( jQuery );
