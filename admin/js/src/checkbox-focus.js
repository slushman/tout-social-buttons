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

		var target = tout.getEventTarget( event );

		if ( 'INPUT' !== target.nodeName ) { return; }

		var wrap = tout.getParent( target, 'tout-social-button-wrap' );

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
