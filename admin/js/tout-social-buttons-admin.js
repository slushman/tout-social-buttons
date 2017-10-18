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

	let parent = el.parentNode;

	if ( '' !== parent.classList && parent.classList.contains( className ) ) {

		return parent;

	}

	return getParent( parent, className );

} // getParent()

function ajaxFetch( data ) {

	let formData = new FormData();
	formData.append( 'action', data.action );
	formData.append( 'nonce', data.nonce );
	formData.append( 'data', data.order );

	let request = new Request( ajaxurl, {
		method: 'POST',
		headers: {
			'Content-Type': 'application/x-www-form-urlencoded; charset=utf-8'
		},
		body: formData,
		//body: 'action=' + data.action + '&nonce=' + data.nonce + '&active=' + data.active + '&inactive=' + data.inactive,
		credentials: 'same-origin'
	});

	fetch( request )
	.then( function( response ) {


		let output = document.querySelector( '.buttons-status' );
		return response;
		//let text = response.json().message;

		//console.log( text );

	})
	.catch( error => console.error( 'DB error: ', error ) );

} // ajaxFetch

/**
 * Makes the icons in the admin sortable using Ruxaba's Sortable.
 * Saves the inactive buttons and the active button order via AJAX.
 */
(function( $ ) {

	'use strict';

	const activeButtons = document.querySelector( '#tout-social-active-buttons' );
	const inactiveButtons = document.querySelector( '#tout-social-inactive-buttons' );
	const activeButtonsField = document.querySelector( 'input#active-buttons' );
	const inactiveButtonsField = document.querySelector( 'input#inactive-buttons' );

	if ( ! inactiveButtons ) { return; }

	/**
	 * Returns a string created from an array of items.
	 *
	 * @param 		array 		items 		The source array.
	 * @return 		string 					The source array items as a comma-separated string.
	 */
	function getArrayString( items ) {

		let collection = [];

		for ( let i = 0; i < items.length; i++ ) {

			collection.push( items[i].getAttribute('data-id') );

		}

		return collection.toString();

	} // getChildrenArray()

	const sortableInactiveButtons = Sortable.create( inactiveButtons, {
		animation: 150,
		group: 'toutSocialButtons'
	} );

	const sortableActiveButtons = Sortable.create( activeButtons, {
		animation: 150,
		group: 'toutSocialButtons',
		onSort: function( event ) {

			// Get the new order and add each item to the order array.
			let activeButtons = getArrayString( event.to.children );
			let inactiveButtons = getArrayString( event.from.children );

			// Save the order array in the order field.
			activeButtonsField.value = activeButtons;
			inactiveButtonsField.value = inactiveButtons;

			// Save the orders via AJAX and jQuery.
			let paramData = {
				action: 'save_button_orders',
				toutButtonNonce: Tout_Social_Buttons_Ajax.toutButtonNonce,
				active: activeButtons,
				inactive: inactiveButtons
			};

			// Save the order via AJAX and the Fetch API.
			// Fetch API simply doesn't work. Not sure why.
			// I get a 200 response, but it appears that its
			// simply telling me to accessed admin-ajax.php
			// successfully, not that it completed by actions
			// successfully. Cannot seem to get my messages
			// back from the PHP functions.
			//
			// let response = ajaxFetch( paramData );
			//
			// console.log( response );

			let output = $( '.buttons-status' );

			$.ajax({
				url: ajaxurl,
				type: 'POST',
				async: true,
				cache: false,
				data: paramData,
				success: function ( response ) {
					output.html( '<span class="status">' + response.data  + '</span>' );
					output.addClass( 'updated' );
					output.fadeIn( 'fast' );
					output.fadeOut( 2000 );

					return;
				},
				error: function (xhr, testStatus, error ) {
					output.html( '<span class="status">' + error + '</span>' );
					output.addClass( 'error' );
					output.fadeIn( 'fast' );
					output.fadeOut( 2000 );

					return;
				}
			});

		}
	} );

})( jQuery );
