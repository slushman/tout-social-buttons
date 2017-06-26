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

			var btnOrderField = $('#tout-button-order');
			var newOrder = sorter.sortable('toArray', {attribute:'data-id'}).toString();

			btnOrderField.val( newOrder );

			var opts = {
				url: ajaxurl,
				type: 'POST',
				async: true,
				cache: false,
				//dataType: 'json',
				data: {
					action: 'save_button_order',
					tbOrderNonce: Tout_Buttons_Ajax.tbOrderNonce,
					order: newOrder
				},
				success: function ( response ) {
					$( '.button-status' ).html( '<span class="status">' + response  + '</span>' );
					$( '.button-status' ).addClass( 'updated' );
					$( '.button-status' ).fadeIn( 'fast' );
					$( '.button-status' ).fadeOut( 2000 );

					return;
				},
				error: function (xhr, testStatus, error ) {
					$( '.button-status' ).html( '<span class="status">' + response + '</span>' );
					$( '.button-status' ).addClass( 'error' );
					$( '.button-status' ).fadeIn( 'fast' );
					$( '.button-status' ).fadeOut( 2000 );

					return;
				}
			}

			$.ajax( opts );

		}

	});

})( jQuery );
