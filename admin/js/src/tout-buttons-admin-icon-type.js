(function( $ ) {

	'use strict';

	function changeButtonType() {

		//

	} // changeButtonType()

	/**
	 * Gets the event target, then gets the checkbox,
	 * then checks the box.
	 *
	 * @param 		object 		event 		The event.
	 */
	function processEvent( event ) {

		var type = event.target.value;

		tout.saveAjax( {
			action: 'save_button_type',
			tbTypeNonce: Tout_Buttons_Ajax.tbTypeNonce,
			type: type
		});

	} // processEvent()

	var buttonTypeField = document.querySelector( '#button-type' );

	buttonTypeField.addEventListener( 'change', processEvent );

})( jQuery );
