<?php

/**
 * The public-facing functionality of the plugin.
 *
 * Defines the output of the shortcode toutthis.
 *
 * @link 			https://www.slushman.com
 * @since 			1.0.0
 * @package 		ToutSocialButtons/Frontend
 * @author 			slushman <chris@slushman.com>
 */

namespace ToutSocialButtons\Frontend;

class Shortcode_Toutthis {

	/**
	 * The button type.
	 *
	 * @since 		1.0.0
	 * @access 		private
	 * @var 		array 			$button_type
	 */
	private $button_type;

	/**
	 * The plugin customizer settings.
	 *
	 * @since 		1.0.0
	 * @access 		private
	 * @var 		array 			$core_settings 		The plugin customizer settings.
	 */
	private $customizer;

	/**
	 * The plugin settings.
	 *
	 * @since 		1.0.0
	 * @access 		private
	 * @var 		array 			$core_settings 		The plugin settings.
	 */
	private $settings;

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
	 * @hooked 		plugins_loaded
	 * @since 		1.0.0
	 */
	public function hooks() {

		add_shortcode( 'toutthis', 									array( $this, 'shortcode' ) );
		add_action( 'tout_social_buttons_shortcode_toutthis', 		array( $this, 'blockquote' ), 10, 3 );
		add_filter( 'tout_social_buttons_quote_button_set_classes', array( $this, 'add_quote_classes' ), 10, 2 );
		add_action( 'tout_social_buttons_quote_buttons_begin', 		array( $this, 'quote_pretext' ) );

	} // hooks()

	/**
	 * Adds classes to the quote button set.
	 *
	 * @hooked 		tout_social_buttons_quote_button_set_classes
	 * @since 		1.0.0
	 * @param 		array 		$classes 		The current quote button set classes.
	 * @param 		string 		$context 		Where the button classes are being used.
	 * @return 		array 						The modified quote button set classes.
	 */
	public function add_quote_classes( $classes, $context ) {

		if ( 'blockquote' === $context ) {

			$classes[] = 'tout-social-buttons-blockquote-buttons';

		}

		return $classes;

	} // add_quote_classes()

	/**
	 * Includes the blockquote partial file inside an output buffer.
	 *
	 * @hooked 		tout_social_buttons_shortcode_toutthis
	 * @since 		1.0.0
	 * @param 		array 		$args 			The shortxode arguments, with defaults.
	 * @param 		array 		$atts 			The raw shortcode attributes.
	 * @param 		mixed 		$content 		The post content.
	 * @return 		mixed 						The blockquote partial file.
	 */
	public function blockquote( $args, $atts, $content ) {

		if ( 'blockquote' !== $args['type'] ) { return; }

		/**
		 * The tout_social_buttons_quote_buttons filter.
		 *
		 * Allows for changing this list. NOTE: not all social sites
		 * allow for sharing content along with the URL, so
		 * changing this list may degrade the sharing experience for
		 * the end-user!
		 *
		 * The defaults are:
		 * 	Email
		 * 	Linkedin
		 * 	tumblr
		 * 	Twitter
		 *
		 * @var 	array 		The buttons for quote sharing.
		 */
		$buttons = apply_filters( 'tout_social_buttons_quote_buttons', array() );

		ob_start();

		include( plugin_dir_path( dirname( __FILE__ ) ) . 'frontend/partials/blockquote.php' );

		$output = ob_get_contents();

		ob_end_clean();

		return $output;

	} // blockquote()

	/**
	 * Returns a string of custom attributes for the button link.
	 *
	 * @since 		1.0.0
	 * @return 		string 		Custom link attributes.
	 */
	public function get_quote_button_link_attributes( $button ) {

		if ( empty( $this->link_attributes ) ) { return; }

		$return = '';

		foreach ( $this->link_attributes as $key => $value ) :

		    if ( 'data' === $key ) :

		        foreach ( $this->link_attributes['data'] as $key => $value ) :

		            $return .= ' data-' . $key . '="' . esc_attr( $value ) . '" ';

		        endforeach;

		    else :

		        $return .= ' ' . $key . '="' . esc_attr( $value ) . '" ';

		    endif;

		endforeach;

		if ( ! empty( $this->settings['button-behavior'] ) && 'email' !== $button ) {

			$return .= ' target="_blank"';

		}

		return $return;

	} // get_quote_button_link_attributes()

	/**
	 * Returns altered text if using Text-only button style.
	 *
	 * @saince 		1.0.0
	 * @param 		string 		$button 						The button ID.
	 * @param 		obj 		ToutSocialButtons\Buttons 		The button object.
	 * @return 		string 										The text for this quote sharing.
	 */
	protected function get_text( $button, $instance ) {

		if ( 'twitter' === $button && 'text' === $this->customizer['button_type'] ) {

			return __( 'Tweet This', 'tout-social-buttons-pro' );

		} else {

			return $instance->get_name();

		}

	} // get_text()


	/**
	 * Returns the classes for the quote button link set.
	 *
	 * @since 		1.0.0
	 * @param 		string 		$button 						The button slug.
	 * @param 		obj 		ToutSocialButtons\Buttons 		The button object.
	 * @return 		string 										The classes for the button link.
	 */
	protected function quote_button_icon_wrap_classes( $button, $instance ) {

		$return 	= '';

		$classes[] 	= 'tout-social-button-icon-wrap';

		if ( 'icon' !== $instance->get_type() ) {

			$classes[] = 'hidden';

		}

		/**
		 * The tout_social_buttons_quote_button_icon_wrap_classes filter.
		 *
		 * Allows for changing classes on the quote button icon wrap.
		 *
		 * @var 		array 		$classes
		 * @var 		string 		$button
		 * @var 		obj 		$instance
		 */
		$classes 	= apply_filters( 'tout_social_buttons_quote_button_icon_wrap_classes', $classes, $button, $instance );
		$return 	= implode( ' ', $classes );

		return $return;

	} // quote_button_icon_wrap_classes()

	/**
	 * Returns the classes for the quote button link set.
	 *
	 * @since 		1.0.0
	 * @param 		string 		$button 		The button slug.
	 * @return 		string 						The classes for the button link.
	 */
	protected function quote_button_link_classes( $button ) {

		$return 	= '';

		$classes[] 	= 'tout-social-button-link';
		$classes[] 	= 'tout-social-button-link-' . $button;

		if ( 'popup' === $this->settings['button-behavior'] ) {

			$classes[] = 'tout-social-button-popup-link';

		}

		/**
		 * The tout_social_buttons_quote_button_link_classes filter.
		 *
		 * Allows for changing classes on the quote button links.
		 *
		 * @var 		array 		$classes
		 */
		$classes 	= apply_filters( 'tout_social_buttons_quote_button_link_classes', $classes, $button );
		$return 	= implode( ' ', $classes );

		return $return;

	} // quote_button_link_classes()

	/**
	 * Returns the classes for the quote button set.
	 *
	 * @since 		1.0.0
	 * @param 		string 		$context 		Where this set of buttons is being used.
	 * @return 		string 						The classes for the button set.
	 */
	protected function quote_button_set_classes( $context ) {

		$return 	= '';

		$classes[] 	= 'tout-social-buttons';
		$classes[] 	= 'tout-social-buttons-quote-buttons';

		/**
		 * The tout_social_buttons_quote_button_set_classes filter.
		 *
		 * Allows for changing classes on the quote button sets.
		 *
		 * @var 		array 		$classes
		 */
		$classes 	= apply_filters( 'tout_social_buttons_quote_button_set_classes', $classes, $context );
		$return 	= implode( ' ', $classes );

		return $return;

	} // quote_button_set_classes()

	/**
	 * Returns the classes for the quote button text.
	 *
	 * @since 		1.0.0
	 * @param 		string 		$button 						The button slug.
	 * @param 		obj 		ToutSocialButtons\Buttons 		The button object.
	 * @return 		string 										The classes for the button text.
	 */
	protected function quote_button_text_classes( $button, $instance ) {

		$return 	= '';

		$classes[] 	= 'tout-social-button-text';

		if ( 'icon' === $instance->get_type() ) :

			$classes[] 	= 'screen-reader-text' ;

		endif;

		/**
		 * The tout_social_buttons_quote_button_text_classes filter.
		 *
		 * Allows for changing classes on the quote button text.
		 *
		 * @var 		array 		$classes
		 * @var 		string 		$button
		 * @var 		obj 		$instance
		 */
		$classes 	= apply_filters( 'tout_social_buttons_quote_button_text_classes', $classes, $button, $instance );
		$return 	= implode( ' ', $classes );

		return $return;

	} // quote_button_text_classes()

	/**
	 * Returns the classes for the quote button wrapper.
	 *
	 * @since 		1.0.0
	 * @param 		string 		$button 		The button slug.
	 * @return 		string 						The classes for the button wrapper.
	 */
	protected function quote_button_wrap_classes( $button ) {

		$return 	= '';

		$classes[] 	= 'tout-social-button';
		$classes[] 	= 'tout-social-button-' . $button;

		/**
		 * The tout_social_buttons_quote_button_wrap_classes filter.
		 *
		 * Allows for changing classes on the quote button wrapper.
		 *
		 * @var 		array 		$classes
		 */
		$classes 	= apply_filters( 'tout_social_buttons_quote_button_wrap_classes', $classes, $button );
		$return 	= implode( ' ', $classes );

		return $return;

	} // quote_button_wrap_classes()

	/**
	 * Includes the quote pretext partial.
	 *
	 * @exits 		If the button type is not icon.
	 * @hooked 		tout_social_buttons_pro_quote_buttons_begin
	 * @since 		1.0.0
	 */
	public function quote_pretext() {

		if ( 'icon' !== $this->customizer['button_type'] ) { return; }

		include( plugin_dir_path( dirname( __FILE__ ) ) . 'frontend/partials/pretext.php' );

	} // quote_pretext()

	/**
	 * Sets the class variable $customizer with the customizer settings.
	 *
	 * @since 		1.0.0
	 */
	protected function set_customizer() {

		$this->customizer = get_option( TOUT_SOCIAL_BUTTON_CUSTOMIZER );

	} // set_customizer()

	/**
	 * Sets the class variable $settings with the plugin settings.
	 *
	 * @since 		1.0.0
	 */
	protected function set_settings() {

		$this->settings = get_option( TOUT_SOCIAL_BUTTONS_SETTINGS );

	} // set_settings()

	/**
	 * Handles the output of the toutthis shortcode.
	 *
	 * Attributes:
	 * 		type 		blockquote: creates a blockquote with the Tout.Social Buttons
	 * 						at the bottom.
	 * 					inline: highlights the text with sharing buttons following.
	 *
	 * @hooked 		toutthis
	 * @since 		1.0.0
	 * @param 		array 		$atts 			The shortcode attributes.
	 * @param 		mixed 		$content 		The post content.
	 * @return 		mixed 						The shortcode output.
	 */
	public function shortcode( $atts = array(), $content ) {

		if ( empty( $content ) ) { return 'The quote is empty!'; }

		$defaults['type'] 	= 'blockquote'; // options: blockquote, inline
		$args 				= shortcode_atts( $defaults, $atts, 'toutthis' );

		/**
		 * The tout_social_buttons_shortcode_toutthis action.
		 *
		 * Determines the processing function for the touthis shortcode.
		 *
		 * @param 		$args 			The arguments for the shortcode, including default values.
		 * @param 		$atts 			The attributes from the shortcode.
		 * @param 		$content 		The content from the shortcode.
		 */
		echo do_action( 'tout_social_buttons_shortcode_toutthis', $args, $atts, $content );

	} // shortcode()

} // class
