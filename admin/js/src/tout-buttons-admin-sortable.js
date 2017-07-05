(function( $ ) {

	'use strict';

	/**
	 * Makes the icons in the admin sortable using Johnny's Sortable jQuery plugin.
	 * Saves the button order via AJAX and in the button-order hidden field.
	 */

	var sorter = $('#tout-btn-sort');

	sorter.sortable({
		placeholder: '<li class="placeholder"></li>',
		placeholderClass: 'placeholder',
		//pullPlaceholder: true,
		onDrop: function ( $item, container, _super, event ) {

			var btnOrderField = $('#tout-button-order');
			var newOrderObjects = sorter.sortable('serialize').get();
			var newOrder = newOrderObjects[0].map( function ( item ){

				return item.id;

			}).toString();

			// Save the order to the hidden order field.
			btnOrderField.val( newOrder );

			// Save the order in plugin settings via AJAX.
			tout.saveAjax( {
				action: 'save_button_order',
				tbOrderNonce: Tout_Buttons_Ajax.tbOrderNonce,
				order: newOrder
			});

			_super( $item, container );

		}
	});

})( jQuery );
