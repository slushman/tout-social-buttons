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
