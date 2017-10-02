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

		let parent = getParent( target, 'tout-social-button' );
		let checkbox = parent.querySelector( '.tout-social-button-checkbox' );
		let checked = '';

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
		let checked = checkBox( target );

		// save the selection via AJAX.
		let wrap = getParent( target, 'tout-social-button-wrap' );
		let selection = wrap.getAttribute( 'data-id' );

		tout.saveAjax( {
			action: 'save_button_selection',
			tbSelectionNonce: Tout_Social_Buttons_Ajax.tbSelectionNonce,
			selection: selection,
			checked: checked
		});

	} // processEvent()

	const buttons = document.querySelector( '.tout-social-buttons' );

	if ( ! buttons ) { return; }

	buttons.addEventListener( 'click', processEvent );

})( jQuery );
