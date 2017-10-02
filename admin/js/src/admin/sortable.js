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
	const statusBanner = document.querySelector( 'buttons-status' );

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

			// Save the order via AJAX and the Fetch API.
			// Fetch API simply doesn't work. Not sure why.
			// I get a 200 response, but it appears that its
			// simply telling me to accessed admin-ajax.php
			// successfully, not that it completed by actions
			// successfully. Cannot seem to get my messages
			// back from the PHP functions.
			//
			// let response = ajaxFetch({
			// 	action: 'save_buttons_order',
			// 	nonce: Tout_Social_Buttons_Ajax.toutOrderNonce,
			// 	active: activeButtons,
			// 	inactive: inactiveButtons
			// });
			//
			// console.log( response );

			// Save the orders via AJAX and jQuery.
			tout.saveAjax( {
				action: 'save_button_orders',
				toutButtonNonce: Tout_Social_Buttons_Ajax.toutButtonNonce,
				active: activeButtons,
				inactive: inactiveButtons
			});

		}
	} );

})( jQuery );
