(function() {

	'use strict';

	/**
	 * Gets the event target, if its the UL, it returns the event.
	 * Gets the tout-button wrap element, then the data-id attribute.
	 * If this equals "email", it returns the event.
	 * Gets the link, then the HREF attribute.
	 * Opens a new window using that HREF.
	 *
	 * @exits 		If the target is the UL.
	 * @exits 		If the selection is email.
	 * @since 		1.0.0
	 * @param 		object 		event 		The event.
	 */
	function processEvent( event ) {

		var target 	= tout.getEventTarget( event );

		if ( 'UL' === target.nodeName ) { return event; }

		var wrap = tout.getParent( target, 'tout-social-button' );
		var selection = wrap.getAttribute( 'data-id' );

		if ( 'email' === selection ) { return event; }

		event.preventDefault();

		var link = wrap.querySelector( '.tout-social-button-popup-link' );
		var href = link.getAttribute( 'href' );

		window.open( href, 'Share', 'menubar=no,resizeable=no,scrollbars=no,status=no,width=550,height=420' );

	} // processEvent()

	var buttons = document.querySelector( '.tout-social-buttons' );

 	buttons.addEventListener( 'click', processEvent );

})();
