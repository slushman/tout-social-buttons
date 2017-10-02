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
	 * Initialize the class and set its properties.
	 *
	 * @since 		1.0.0
	 */
	public function __construct() {

		$this->set_customizer();

	} // __construct()

	/**
	 * Registers all the WordPress hooks and filters related to this class.
	 *
	 * @hooked 		plugins_loaded
	 * @since 		1.0.0
	 */
	public function hooks() {

		add_shortcode( 'clicktotweet', array( $this, 'shortcode' ) );

	} // hooks()

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
	 * @hooked 		clicktotweet
	 * @since 		1.0.0
	 * @param 		array 		$atts 			The shortcode attributes - there are none.
	 * @param 		mixed 		$content 		The post content.
	 * @return 		mixed 						The shortcode output.
	 */
	public function shortcode( $atts = array(), $content ) {

		if ( empty( $content ) ) { return 'The quote is empty!'; }

		$twitter = new Buttons\Twitter();

		ob_start();

		include( plugin_dir_path( dirname( __FILE__ ) ) . 'frontend/partials/click-to-tweet.php' );

		$output = ob_get_contents();

		ob_end_clean();

		return $output;

	} // shortcode()

} // class
