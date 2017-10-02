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

function ajaxFetch( data ) {

	let formData = new FormData();
	formData.append( 'action', data.action );
	formData.append( 'nonce', data.nonce );
	formData.append( 'data', data.order );

	let request = new Request( ajaxurl, {
		method: 'POST',
		headers: {
			'Content-Type': 'application/x-www-form-urlencoded; charset=utf-8'
		},
		body: formData,
		//body: 'action=' + data.action + '&nonce=' + data.nonce + '&active=' + data.active + '&inactive=' + data.inactive,
		credentials: 'same-origin'
	});

	fetch( request )
	.then( function( response ) {


		let output = document.querySelector( '.buttons-status' );
		return response;
		//let text = response.json().message;

		//console.log( text );

	})
	.catch( error => console.error( 'DB error: ', error ) );

} // ajaxFetch

/**
 * Sends data to a PHP handler for saving via AJAX.
 *
 * @since 		1.0.0
 * @param 		array 		paramData 		The data to send to the PHP handler.
 */
var tout = {};

tout.saveAjax = function( paramData ) {
	jQuery.ajax({
		url: ajaxurl,
		type: 'POST',
		async: true,
		cache: false,
		data: paramData,
		success: function ( response ) {
			jQuery( '.buttons-status' ).html( '<span class="status">' + response.data  + '</span>' );
			jQuery( '.buttons-status' ).addClass( 'updated' );
			jQuery( '.buttons-status' ).fadeIn( 'fast' );
			jQuery( '.buttons-status' ).fadeOut( 2000 );

			return;
		},
		error: function (xhr, testStatus, error ) {
			jQuery( '.buttons-status' ).html( '<span class="status">' + error + '</span>' );
			jQuery( '.buttons-status' ).addClass( 'error' );
			jQuery( '.buttons-status' ).fadeIn( 'fast' );
			jQuery( '.buttons-status' ).fadeOut( 2000 );

			return;
		}
	});
};
