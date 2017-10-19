<?php

/**
 * The public-facing functionality of the plugin.
 *
 * Defines the Pin It Button functionality.
 *
 * @link 			https://www.slushman.com
 * @since 			1.0.0
 * @package 		ToutSocialButtons/Frontend
 * @author 			slushman <chris@slushman.com>
 */

namespace ToutSocialButtons\Frontend;
use \ToutSocialButtons\Buttons as Buttons;

class PinIt {

	/**
	 * The pinit plugin settings.
	 *
	 * @since 		1.0.0
	 * @access 		private
	 * @var 		array 			$settings 		The pinit plugin settings.
	 */
	protected $settings;

	/**
	 * Initialize the class and set its properties.
	 *
	 * @since 		1.0.0
	 */
	public function __construct() {

		$this->set_settings();

	} // __construct()

	/**
	 * Registers all the WordPress hooks and filters related to this class.
	 *
	 * @exits 		If the enable Pinit setting is not checked.
	 * @hooked 		init
	 * @since 		1.0.0
	 */
	public function hooks() {

		if ( empty( $this->settings['pinit-enable'] ) ) { return; }

		add_filter( 'the_content', array( $this, 'pinit' ), 99 );

	} // hooks()

	/**
	 * Determines if any of the exclude classes are present in the image classes.
	 *
	 * @since 		1.0.0
	 * @param 		obj 		$img 		The image DOM object.
	 * @return 		bool 					FALSE if exclude classes are present, otherwise TRUE.
	 */
	protected function class_check( $img ) {

		$classes 	= $img->getAttribute( 'class' );
		$excludes 	= $this->settings['pinit-exclude'];
		$excludes 	= explode( ',', $excludes );

		foreach ( $excludes as $exclude ) {

			if ( FALSE !== strpos( $classes, $exclude ) ) { return FALSE; break; }

		}

		return TRUE;

	} // class_check()

	/**
	 * Returns the button content
	 *
	 * @since 		1.0.0
	 * @param 		DOMDocument 		$document 		Document object.
	 * @return 		mixed 								The button content.
	 */
	protected function get_button_content( $document ) {

		global $tout_social_buttons;

		$return = $document->createCDATASection( $tout_social_buttons['pinterest']->get_pinit() );

		/**
		 * The tout_social_buttons_pinit_content filter.
		 *
		 * Allows for changing the Pin It Button content.
		 *
		 * @param 		mixed 				$return 					The Pin It SVG icon.
		 * @param 		DOMDocument 		$document 					Document object.
		 * @param 		Pinterest 			$tout_social_buttons 		The Pinterest Button object.
		 */
		return apply_filters( 'tout_social_buttons_pinit_content', $return, $document, $tout_social_buttons['pinterest'] );

	} // get_button_content()

	/**
	 * Returns the urlencoded URL for the image.
	 *
	 * @since 		1.0.0
	 * @param 		obj 		$img 		The image DOM object.
	 * @return 		string 					The URL for this image.
	 */
	protected function get_button_url( $img ) {

		global $tout_social_buttons;

		$image 					= $this->get_image( $img );
		$url_array 				= $tout_social_buttons['pinterest']->get_url_array();
		$args['url'] 			= urlencode( get_permalink() );
		$args['description'] 	= $this->get_description( $image, $img );
		$args['media'] 			= $image['url'];

		return add_query_arg( $args, $url_array['base_url'] );

	} // get_button_url()

	/**
	 * Returns the selected description for the image.
	 *
	 * @since 		1.0.0
	 * @param 		array 		$image 		Image info array.
	 * @param 		obj 		$img 		The image DOM object.
	 * @return 		string 					The image description.
	 */
	protected function get_description( $image, $img ) {

		$description = $img->getAttribute( 'alt' );

		if ( empty( $description ) ) {

			$description = $image['alt'];

		}

		if ( 'imgtitle' === $this->settings['pinit-source'] || empty( $description ) ) {

			$description = $image['title'];

		}

		/**
		 * The tout_social_buttons_pinit_description filter.
		 *
		 * @param 		string 		$description 		The description.
		 * @param 		array 		$image 				Image info array.
		 */
		$return = apply_filters( 'tout_social_buttons_pinit_description', $description, $image );

		return $return;

	} // get_description()

	/**
	 * Returns all info about that img.
	 *
	 * @since 		1.0.0
	 * @param 		obj 		$img 		The image DOM object.
	 * @return 		array 					The image info array.
	 */
	protected function get_image( $img ) {

		$classes 	= $img->getAttribute( 'class' );
		$classes 	= explode( ' ', $classes );
		$found 		= '';

		foreach ( $classes as $class ) {

			if ( FALSE !== strpos( $class, 'wp-image-' ) ) {

				$found = $class;
				break;

			}

		}

		if ( empty( $found ) ) { return FALSE; }

		$imageID = str_replace( 'wp-image-', '', $found );

		return wp_prepare_attachment_for_js( $imageID );

	} // get_image()

	/**
	 * Adds the Pin It Button to images used in post content.
	 *
	 * @exits 		If $content is empty.
	 * @exit 		If there are no images in the content.
	 * @hooked 		the_content
	 * @global 		$tout_social_buttons
	 * @since 		1.0.0
	 * @param 		mixed 		$content 		The post content.
	 * @return 		mixed 						The modified post content.
	 */
	public function pinit( $content ) {

		if ( empty( $content ) ) { return $content; }

		global $tout_social_buttons;

		$pint 		= $tout_social_buttons['pinterest'];
		$content 	= mb_convert_encoding( $content, 'HTML-ENTITIES', "UTF-8" );
		$document 	= new \DOMDocument();

		libxml_use_internal_errors( true );

		$document->loadHTML( utf8_decode( $content ) );

		$imgs = $document->getElementsByTagName( 'img' );

		if ( empty( $imgs ) ) { return $content; }

		foreach ( $imgs as $img ) {

			$height = $img->getAttribute( 'height' );
			$width 	= $img->getAttribute( 'width' );

			if ( $height < $this->settings['pinit-min-height'] ) { continue; }
			if ( $width < $this->settings['pinit-min-width'] ) { continue; }

			$classcheck = $this->class_check( $img );

			if ( ! $classcheck ) { continue; }

			$parent = $img->parentNode;


			// Is this needed? How often will the parent not be figure or p?
			//
			// if ( 'p' !== $parent->tagName && 'figure' !== $parent->tagName ) {
			//
			// 	$oldparent 	= $parent;
			// 	$fig 		= $document->createElement( 'figure' );
			//
			// 	$fig->setAttribute( 'class', 'pinthis' );
			// 	$fig->setAttribute( 'style', 'width: ' . $width . 'px' );
			//
			// 	$parent 	= $oldparent->insertBefore( $fig );
			// 	$children 	= $oldparent->childNodes;
			//
			// 	foreach ( $children as $child ) {
			//
			// 		$parent->appendChild( $child );
			//
			// 	}
			//
			// 	// remove old parent?
			//
			// } else {

				$parentClasses 	= $parent->getAttribute( 'class' );
				$space 			= empty( $parentClasses ) ? '' : ' ';

				$parent->setAttribute( 'class', $parentClasses . $space . 'pinthis' );

				if ( 'p' === $parent->tagName ) {

					$parent->setAttribute( 'style', 'width: ' . $width . 'px' );

				}

			// }

			$pinit 	= $document->createElement( 'a' );
			$label	= $this->get_button_content( $document );

			$pinit->setAttribute( 'class', 'pinit pinit-top-left' );
			$pinit->setAttribute( 'href', $this->get_button_url( $img ) );
			$pinit->appendChild( $label );

			$parent->appendChild( $pinit );

		}

		$html = $document->saveHTML();

		return $html;

	} // pinit()

	/**
	 * Sets the class variable $settings.
	 *
	 * The Pinit Settings:
	 * 		pinit-enable			1 or 0
	 * 		pinit-min-height		int, default is 200
	 * 		pinit-min-width			int, default is 200
	 * 		pinit-exclude			string, comma-separated list of classes
	 * 		pinit-source			imgalt or imgtitle
	 *
	 * @since 		1.0.0
	 */
	public function set_settings() {

		$this->settings = get_option( TOUT_SOCIAL_BUTTONS_SETTINGS . '_pinit' );

	} // set_settings()

} // class
