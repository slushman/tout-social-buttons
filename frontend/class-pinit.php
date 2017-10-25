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

class PinIt {

	/**
	 * The customizer settings.
	 *
	 * @since 		1.0.0
	 * @access 		private
	 * @var 		array 			$customizer 		The customizer settings.
	 */
	protected $customizer;

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
		$this->set_customizer();

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
	 * Returns the a11y text for the Pin It button.
	 *
	 * @since 		1.0.0
	 * @return 		mixed 		The Pin It Button a11y text.
	 */
	protected function get_a11y_text() {

		$text = __( 'Save pin to Pinterest', 'tout-social-buttons' );

		/**
		 * The tout_social_buttons_pinit_button_a11y_text filter.
		 *
		 * Allows for changing the Pin It a11y text.
		 *
		 * @param 		mixed 		$text 		The current Pin It a11y text.
		 */
		return apply_filters( 'tout_social_buttons_pinit_button_a11y_text', $text );

	} // get_a11y_text()

	/**
	 * Returns the button label.
	 *
	 * @since 		1.0.0
	 * @return 		mixed 		The button content.
	 */
	protected function get_button_label() {

		$label = '';

		/**
		 * The tout_social_buttons_pinit_button_label filter.
		 *
		 * Allows for changing the Pin It button label.
		 *
		 * @param 		mixed 		$label 		The current Pin It button label.
		 */
		return apply_filters( 'tout_social_buttons_pinit_button_label', $label );

	} // get_button_label()

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
	 * Return the classes for the button label.
	 *
	 * @since 		1.0.0
	 * @return 		string 		$classes 		The classes string.
	 */
	protected function get_label_classes() {

		$classes = array();

		$classes[] = 'pinit-button-label';

		/**
		 * The tout_social_buttons_pinit_button_label_classes filter.
		 *
		 * @param 		array 		$classes 		The current Pin It button label classes.
		 */
		$classes = apply_filters( 'tout_social_buttons_pinit_button_label_classes', $classes );

		return implode( ' ', $classes );

	} // get_label_classes()

	/**
	 * Return the classes for the pinit link.
	 *
	 * @since 		1.0.0
	 * @return 		string 		$classes 		The classes string.
	 */
	protected function get_pinit_classes() {

		$classes = array();

		$classes[] = 'pinit';
		$classes[] = 'pinit-pos-top-left';
		$classes[] = 'pinit-color-white-on-red';
		$classes[] = 'pinit-size-med';
		$classes[] = 'pinit-type-pinit';

		/**
		 * The tout_social_buttons_pinit_classes filter.
		 *
		 * @param 		array 		$classes 		The current pinit classes.
		 */
		$classes = apply_filters( 'tout_social_buttons_pinit_classes', $classes );

		return implode( ' ', $classes );

	} // get_pinit_classes()

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

		foreach ( $imgs as $img ) :

			$height = $img->getAttribute( 'height' );
			$width 	= $img->getAttribute( 'width' );

			if ( $height < $this->settings['pinit-min-height'] ) { continue; }
			if ( $width < $this->settings['pinit-min-width'] ) { continue; }

			$classcheck = $this->class_check( $img );

			if ( ! $classcheck ) { continue; }

			$parent = $img->parentNode;


			$parentClasses 	= $parent->getAttribute( 'class' );
			$space 			= empty( $parentClasses ) ? '' : ' ';

			$parent->setAttribute( 'class', $parentClasses . $space . 'pinthis' );

			if ( 'p' === $parent->tagName ) {

				$parent->setAttribute( 'style', 'width: ' . $width . 'px' );

			}

			$pinit 		= $document->createElement( 'a' );
			$classes 	= $this->get_pinit_classes();
			$ally 		= $document->createElement( 'span' );
			$label 		= $document->createElement( 'span' );
			$a11y_text 	= $document->createTextNode( $this->get_a11y_text() );
			$label_text = $document->createTextNode( $this->get_button_label() );

			$pinit->setAttribute( 'class', $classes );
			$pinit->setAttribute( 'href', $this->get_button_url( $img ) );

			$ally->setAttribute( 'class', 'screen-reader-text' );
			$ally->appendChild( $a11y_text );

			$label->setAttribute( 'class', $this->get_label_classes() );
			$label->appendChild( $label_text );

			$pinit->appendChild( $label );
			$pinit->appendChild( $ally );

			$parent->appendChild( $pinit );

		endforeach;

		$html = $document->saveHTML();

		return $html;

	} // pinit()

	/**
	 * Sets the class variable $customizer.
	 *
	 * @since 		1.0.0
	 */
	public function set_customizer() {

		$this->customizer = get_option( TOUT_SOCIAL_BUTTON_CUSTOMIZER );

	} // set_customizer()

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
