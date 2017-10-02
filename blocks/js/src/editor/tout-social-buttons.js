/**
 * Block: Tout.Social Buttons
 *
 * Registers a basic editable block with Gutenbuerg.
 */

( function() {

	var __ = wp.i18n.__;
	var el = wp.element.createElement;
	var Editable = wp.blocks.Editable;
	var children = wp.blocks.query.children;
	var registerBlockType = wp.blocks.registerBlockType;

	registerBlockType( 'tout-social-buttons/tout-social-buttons', {

		title: __( 'Social Buttons', 'tout-social-buttons' ),
		icon: 'share',
		category: 'common',
		keywords: [ __( 'social', 'tout-social-buttons' ) ],
		attributes: {
			content: children( 'a' ),
		},
		edit: function( props ) {
			var content = props.attributes.content;
			var focus = props.focus;

			/**
			 * Update content on change.
			 */
			function onChangeContent( newContent ) {
				console.log( 'newContent: ', newContent );
				props.setAttributes( { content: newContent } );
			}

			return el(
				Editable,
				{
					tagName: 'a',
					className: props.className,
					onChange: onChangeContent,
					value: content,
					focus: null,
					onFocus: props.setFocus,
				}
			);
		},

		save: function ( props ) {
			var tweetContent = props.attributes.content;
			console.log( 'tweetContent: ', tweetContent );

			var tweetURI = 'https://twitter.com/home?status=' + encodeURIComponent( tweetContent );
			var attrs = {
				href: tweetURI,
				className: props.className,
				target: '_blank'
			};

			return el( 'a', attrs, tweetContent	 );
		}

	});

})();
