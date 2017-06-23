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
