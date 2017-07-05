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

		var parent = tout.getParent( target, 'tout-btn' );
		var checkbox = parent.querySelector( '.tout-btn-checkbox' );
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

		var target = tout.getEventTarget( event );

		if ( 'path' !== target.nodeName && 'INPUT' !== target.nodeName && 'svg' !== target.nodeName ) { return; }

		// Check the hidden checkbox input for the selected icon.
		var checked = checkBox( target );

		// save the selection via AJAX.
		var wrap = tout.getParent( target, 'tout-btn-wrap' );
		var selection = wrap.getAttribute( 'data-id' );

		tout.saveAjax( {
			action: 'save_button_selection',
			tbSelectionNonce: Tout_Buttons_Ajax.tbSelectionNonce,
			selection: selection,
			checked: checked
		});

	} // processEvent()

	var buttons = document.querySelector( '.tout-buttons' );

	buttons.addEventListener( 'click', processEvent );

})( jQuery );
