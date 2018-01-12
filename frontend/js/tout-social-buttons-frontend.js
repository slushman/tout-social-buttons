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

		var target 	= getEventTarget( event );

		if ( 'UL' === target.nodeName ) { return event; }

		var wrap = getParent( target, 'tout-social-button' );
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

/**
 * Functions available to use in JS.
 */

/**
 * Returns the event target.
 *
 * @since 		1.0.0
 * @param 		object 		event 		The event.
 * @return 		object 		target 		The event target.
 */
function getEventTarget( event ) {

	event.event || window.event;

	return event.target || event.scrElement;

} // getEventTarget()

/**
 * Returns the parent node with the requested class.
 *
 * This is recursive, so it will continue up the DOM tree
 * until the correct parent is found.
 *
 * @since 		1.0.0
 * @param 		object 		el 				The node element.
 * @param 		string 		className 		Name of the class to find.
 * @return 		object 						The parent element.
 */
function getParent( el, className ) {

	let parent = el.parentNode;

	if ( '' !== parent.classList && parent.classList.contains( className ) ) {

		return parent;

	}

	return getParent( parent, className );

} // getParent()
