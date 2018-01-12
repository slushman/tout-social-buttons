<?php

/**
 * The public-facing functionality of the plugin.
 *
 * Defines the output of the shortcode clicktotweet.
 *
 * @link 			https://www.slushman.com
 * @since 			1.0.0
 * @package 		ToutSocialButtons/Frontend
 * @author 			slushman <chris@slushman.com>
 */

namespace ToutSocialButtons\Frontend;
use \ToutSocialButtons\Buttons as Buttons;

class Shortcode_Clicktotweet {

	/**
	 * The context where the button set is being used.
	 *
	 * @since 		1.0.0
	 * @access 		private
	 * @var 		string 		$context 		Where this is being used.
	 */
	private $context;

	/**
	 * Array of customizer settings.
	 *
	 * @since 		1.0.0
	 * @access 		private
	 * @var 		array
	 */
	private $customizer;

	/**
	 * Initialize the class and set its properties.
	 *
	 * @since 		1.0.0
	 */
	public function __construct() {

		$this->set_customizer();
		$this->make_button_set();

	} // __construct()

	/**
	 * Registers all the WordPress hooks and filters related to this class.
	 *
	 * @hooked 		init
	 * @since 		1.0.0
	 */
	public function hooks() {

		add_shortcode( 'clicktotweet', 								array( $this, 'shortcode' ) );

		add_filter( 'tout_social_buttons_button_set_classes', 		array( $this, 'button_set_classes' ), 10, 2 );
		add_filter( 'tout_social_buttons_button_set_wrap_classes', 	array( $this, 'button_set_wrap_classes' ), 10, 2 );
		add_filter( 'tout_social_buttons_button_classes', 			array( $this, 'button_classes' ), 10, 3 );
		add_filter( 'tout_social_buttons_button_link_classes', 		array( $this, 'button_link_classes' ), 10, 3 );
		add_filter( 'tout_social_buttons_button_icon_wrap_classes', array( $this, 'icon_wrap_classes' ), 10, 2 );
		add_filter( 'tout_social_buttons_button_text_classes', 		array( $this, 'text_classes' ), 10, 2 );
		add_filter( 'tout_social_buttons_button_text', 				array( $this, 'button_text' ), 10, 3 );

	} // hooks()

	/**
	 * Returns the button classes for the clicktotweet shortcode.
	 *
	 * @exits 		If not in the clicktotweet context.
	 * @hooked 		tout_social_buttons_button_classes
	 * @since 		1.0.0
	 * @param 		array 		$classes 		The current classes.
	 * @param 		string 		$context 		Where this is being used.
	 * @param 		string 		$button 		The button ID.
	 * @return 		array 		$classes 		The modifed classes.
	 */
	public function button_classes( $classes, $context, $button ) {

		if ( 'clicktotweet' !== $context ) { return $classes; }

		$classes 	= array();
		$classes[] 	= 'click-to-tweet-button';
		$classes[] 	= 'click-to-tweet-button-' . $button;

		return $classes;

	} // button_classes()

	/**
	 * Returns the button classes for the clicktotweet shortcode.
	 *
	 * @exits 		If not in the clicktotweet context.
	 * @hooked 		tout_social_buttons_button_link_classes
	 * @since 		1.0.0
	 * @param 		array 		$classes 		The current classes.
	 * @param 		string 		$context 		Where this is being used.
	 * @param 		string 		$button 		The button ID.
	 * @return 		array 		$classes 		The modifed classes.
	 */
	public function button_link_classes( $classes, $context, $button ) {

		if ( 'clicktotweet' !== $context ) { return $classes; }

		$classes 	= array();
		$classes[] 	= 'click-to-tweet-button-link';
		$classes[] 	= 'click-to-tweet-button-link-' . $button;

		return $classes;

	} // button_link_classes()

	/**
	 * Returns the button set classes for the clicktotweet shortcode.
	 *
	 * @exits 		If not in the clicktotweet context.
	 * @hooked 		tout_social_buttons_button_set_classes
	 * @since 		1.0.0
	 * @param 		array 		$classes 		The current classes.
	 * @param 		string 		$context 		Where this is being used.
	 * @return 		array 		$classes 		The modifed classes.
	 */
	public function button_set_classes( $classes, $context ) {

		if ( 'clicktotweet' !== $context ) { return $classes; }

		$classes 	= array();
		$classes[] 	= 'click-to-tweet-buttons';

		return $classes;

	} // button_set_classes()

	/**
	 * Returns the button set wrap classes for the clicktotweet shortcode.
	 *
	 * @exits 		If not in the clicktotweet context.
	 * @hooked 		tout_social_buttons_button_set_wrap_classes
	 * @since 		1.0.0
	 * @param 		array 		$classes 		The current classes.
	 * @param 		string 		$context 		Where this is being used.
	 * @return 		array 		$classes 		The modifed classes.
	 */
	public function button_set_wrap_classes( $classes, $context ) {

		if ( 'clicktotweet' !== $context ) { return $classes; }

		$classes 	= array();
		$classes[] 	= 'click-to-tweet-buttons-wrap';

		return $classes;

	} // button_set_wrap_classes()

	/**
	 * Returns the button text for the Twitter button for the clicktotweet shortcode.
	 *
	 * @exits 		If not in the Twitter button.
	 * @hooked 		tout_social_buttons_button_text
	 * @since 		1.0.0
	 * @param 		string 		$name 			The current name.
	 * @param 		obj 		$instance 		The button object instance.
	 * @param 		string 		$context 		Where this is being used.
	 * @return 		array 		$name 			The modifed name.
	 */
	public function button_text( $name, $instance, $context ) {

		if ( 'clicktotweet' !== $context ) { return $name; }

		return $instance->get_click_to_tweet_text();

	} // button_text()

	/**
	 * Returns the icon wrap classes for the clicktotweet shortcode.
	 *
	 * @exits 		If not in the clicktotweet context.
	 * @hooked 		tout_social_buttons_button_icon_wrap_classes
	 * @since 		1.0.0
	 * @param 		array 		$classes 		The current classes.
	 * @param 		string 		$context 		Where this is being used.
	 * @return 		array 		$classes 		The modifed classes.
	 */
	public function icon_wrap_classes( $classes, $context ) {

		if ( 'clicktotweet' !== $context ) { return $classes; }

		$classes 	= array();
		$classes[] 	= 'click-to-tweet-icon';

		return $classes;

	} // icon_wrap_classes()

	/**
	 * Returns the quote classes for the clicktotweet shortcode.
	 *
	 * @exits 		If not in the clicktotweet context.
	 * @since 		1.0.0
	 * @return 		array 		$classes 		The modifed classes.
	 */
	public function get_quote_classes() {

		if ( 'clicktotweet' !== $this->set->get_context() ) { return $classes; }

		$classes[] 	= 'click-to-tweet-quote';

		return implode( ' ', $classes );

	} // get_quote_classes()

	/**
	 * Returns the quote wrap classes for the clicktotweet shortcode.
	 *
	 * @exits 		If not in the clicktotweet context.
	 * @since 		1.0.0
	 * @return 		array 		$classes 		The modifed classes.
	 */
	public function get_quote_wrap_classes() {

		if ( 'clicktotweet' !== $this->set->get_context() ) { return; }

		$classes[] 	= 'click-to-tweet-wrap';
		$classes[] 	= $this->customizer['clicktotweet_style'];

		return implode( ' ', $classes );

	} // get_quote_wrap_classes()

	/**
	 * Sets the $set class variable with an instance of the Button_Set
	 * class with the context for this class.
	 *
	 * @since 		1.0.0
	 */
	protected function make_button_set() {

		$this->set = new Buttons\Button_Set( 'clicktotweet' );

	} // make_button_set()

	/**
	 * Sets the $customizer class variable.
	 *
	 * @since 		1.0.0
	 */
	protected function set_customizer() {

		$this->customizer = get_option( TOUT_SOCIAL_BUTTON_CUSTOMIZER );

	} // set_customizer()

	/**
	 * Handles the output of the clicktotweet shortcode.
	 *
	 * The buttons for Click to Tweet is limited to just Twitter.
	 *
	 * @hooked 		clicktotweet
	 * @since 		1.0.0
	 * @param 		array 		$atts 			The shortcode attributes - there are none.
	 * @param 		mixed 		$content 		The post content.
	 * @return 		mixed 						The shortcode output.
	 */
	public function shortcode( $atts = array(), $content ) {

		if ( empty( $content ) ) { return 'The quote is empty!'; }

		global $tout_social_buttons;

		$buttons = array( 'twitter' => $tout_social_buttons['twitter'] );

		ob_start();

		include( plugin_dir_path( dirname( __FILE__ ) ) . 'frontend/partials/blockquote.php' );

		$output = ob_get_contents();

		ob_end_clean();

		return $output;

	} // shortcode()

	/**
	 * Returns the text classes for the clicktotweet shortcode.
	 *
	 * @exits 		If not in the clicktotweet context.
	 * @hooked 		tout_social_buttons_button_text_classes
	 * @since 		1.0.0
	 * @param 		array 		$classes 		The current classes.
	 * @param 		string 		$context 		Where this is being used.
	 * @return 		array 		$classes 		The modifed classes.
	 */
	public function text_classes( $classes, $context ) {

		if ( 'clicktotweet' !== $context ) { return $classes; }

		$classes 	= array();
		$classes[] 	= 'click-to-tweet-text';

		return $classes;

	} // text_classes()

} // class
