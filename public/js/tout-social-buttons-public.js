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

/**
 * The following pattern allows for outside files to use these functions as a library.
 *
 * The parameter passed into this function is 'exports'.
 * Each function within defines itself within 'exports', along with a unique name
 * 	that outside scripts can reference.
 * In the parenthesis below, setup the blank this.tout as an empty object.
 *
 * Outside scripts would call these like:
 * tout.getEventTarget( eventName )
 * tout.getParent( element, className )
 */
(function( exports ) {

	'use strict';

	/**
	 * Returns the event target.
	 *
	 * @param 		object 		event 		The event.
	 * @return 		object 		target 		The event target.
	 */
	exports.getEventTarget = function getEventTarget( event ) {

		event = event || window.event;

		return event.target || event.srcElement;

	} // getEventTarget()

	/**
	 * Returns the parent node with the requested class.
	 *
	 * This is recursive, so it will continue up the DOM tree
	 * until the correct parent is found.
	 *
	 * @param 		object 		el 				The node element.
	 * @param 		string 		className 		Name of the class to find.
	 * @return 		object 						The parent element.
	 */
	exports.getParent = function getParent( el, className ) {

		var parent = el.parentNode;

		if ( '' !== parent.classList && parent.classList.contains( className ) ) {

			return parent;

		}

		return exports.getParent( parent, className );

	} // getParent()

})( this.tout = {} );
