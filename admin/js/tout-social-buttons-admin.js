(function() {

	'use strict';

	/**
	 * Gets the event target, gets the parent wrap element,
	 * then on focusin it adds the focus class or on focusout
	 * it removes the focus class.
	 *
	 * @since 		1.0.0
	 * @param 		object 		event 		The event.
	 */
	function processEvent( event ) {

		var target = getEventTarget( event );

		if ( 'INPUT' !== target.nodeName ) { return; }

		var wrap = getParent( target, 'tout-social-button-wrap' );

		if ( ! wrap ) { return; }

		if ( 'focusin' === event.type && ! wrap.classList.contains( 'focus' ) ) {

			wrap.classList.add( 'focus' );

		} else if ( 'focusout' === event.type && wrap.classList.contains( 'focus' ) ) {

			wrap.classList.remove( 'focus' );

		}

	} // processEvent()

	var buttons = document.querySelector( '.tout-social-buttons' );

	if ( ! buttons ) { return; }

	buttons.addEventListener( 'focusin', processEvent, true );
	buttons.addEventListener( 'focusout', processEvent, true );

})();

(function( $ ) {

	'use strict';

	/**
	 * Checks the hidden checkbox input when the icon is clicked.
	 * Returns boolean: TRUE if the box was checked, otherwise FALSE.
	 *
	 * @since 		1.0.0
	 * @param 		object 		target 		The event target object.
	 * @return 		bool 					Whether the box was checked or not.
	 */
	function checkBox( target ) {

		var parent = getParent( target, 'tout-social-button' );
		var checkbox = parent.querySelector( '.tout-social-button-checkbox' );
		var checked = '';

		if ( 'checked' === checkbox.getAttribute( 'checked' ) ) { // checkbox is checked

			checkbox.removeAttribute( 'checked' );
			checked = 0;

		} else {

			checkbox.setAttribute( 'checked', 'checked' );
			checked = 1;

		}

		parent.classList.toggle( 'checked' );

		return checked;

	} // checkBox()

	/**
	 * Gets the event target, then gets the checkbox,
	 * then checks the box.
	 *
	 * @since 		1.0.0
	 * @param 		object 		event 		The event.
	 */
	function processEvent( event ) {

		var target = getEventTarget( event );

		if ( 'path' !== target.nodeName && 'INPUT' !== target.nodeName && 'svg' !== target.nodeName ) { return; }

		// Check the hidden checkbox input for the selected icon.
		var checked = checkBox( target );

		// save the selection via AJAX.
		var wrap = getParent( target, 'tout-social-button-wrap' );
		var selection = wrap.getAttribute( 'data-id' );

		tout.saveAjax( {
			action: 'save_button_selection',
			tbSelectionNonce: Tout_Social_Buttons_Ajax.tbSelectionNonce,
			selection: selection,
			checked: checked
		});

	} // processEvent()

	var buttons = document.querySelector( '.tout-social-buttons' );

	if ( ! buttons ) { return; }

	buttons.addEventListener( 'click', processEvent );

})( jQuery );

/**
 * Returns the event target.
 *
 * @since 		1.0.0
 * @param 		object 		event 		The event.
 * @return 		object 		target 		The event target.
 */
function getEventTarget( event ) {

	event.event || window.event;

	return event.target || event.scrElement;

} // getEventTarget()

/**
 * Returns the parent node with the requested class.
 *
 * This is recursive, so it will continue up the DOM tree
 * until the correct parent is found.
 *
 * @since 		1.0.0
 * @param 		object 		el 				The node element.
 * @param 		string 		className 		Name of the class to find.
 * @return 		object 						The parent element.
 */
function getParent( el, className ) {

	var parent = el.parentNode;

	if ( '' !== parent.classList && parent.classList.contains( className ) ) {

		return parent;

	}

	return getParent( parent, className );

} // getParent()

/**
 * Sends data to a PHP handler for saving via AJAX.
 *
 * @since 		1.0.0
 * @param 		array 		paramData 		The data to send to the PHP handler.
 */
var tout = {};

tout.saveAjax = function( paramData ) {
	jQuery.ajax({
		url: ajaxurl,
		type: 'POST',
		async: true,
		cache: false,
		data: paramData,
		success: function ( response ) {
			jQuery( '.button-status' ).html( '<span class="status">' + response  + '</span>' );
			jQuery( '.button-status' ).addClass( 'updated' );
			jQuery( '.button-status' ).fadeIn( 'fast' );
			jQuery( '.button-status' ).fadeOut( 2000 );

			return;
		},
		error: function (xhr, testStatus, error ) {
			jQuery( '.button-status' ).html( '<span class="status">' + error + '</span>' );
			jQuery( '.button-status' ).addClass( 'error' );
			jQuery( '.button-status' ).fadeIn( 'fast' );
			jQuery( '.button-status' ).fadeOut( 2000 );

			return;
		}
	});
};

(function( $ ) {

	'use strict';

	/**
	 * Makes the icons in the admin sortable using Johnny's Sortable jQuery plugin.
	 * Saves the button order via AJAX and in the button-order hidden field.
	 */

	var sorter = $('#tout-social-button-sort');

	if ( ! sorter ) { return; }

	sorter.sortable({
		placeholder: '<li class="placeholder"></li>',
		placeholderClass: 'placeholder',
		//pullPlaceholder: true,
		onDrop: function ( $item, container, _super, event ) {

			var btnOrderField = $('#tout-social-button-order');
			var newOrderObjects = sorter.sortable('serialize').get();
			var newOrder = newOrderObjects[0].map( function ( item ){

				return item.id;

			}).toString();

			// Save the order to the hidden order field.
			btnOrderField.val( newOrder );

			// Save the order in plugin settings via AJAX.
			tout.saveAjax( {
				action: 'save_button_order',
				tbOrderNonce: Tout_Social_Buttons_Ajax.tbOrderNonce,
				order: newOrder
			});

		}
	});

})( jQuery );
