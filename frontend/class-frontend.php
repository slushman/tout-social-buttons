<?php

/**
 * The frontend functionality of the plugin.
 *
 * @link 			https://www.slushman.com
 * @since 			1.0.0
 * @package 		ToutSocialButtons\Frontend
 * @author 			Slushman <chris@slushman.com>
 */

namespace ToutSocialButtons\Frontend;

class Frontend {

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
	 * @hooked 		init
	 * @since 		1.0.0
	 */
	public function hooks() {

		add_action( 'wp_enqueue_scripts', 	array( $this, 'enqueue_styles' ) );
		add_action( 'wp_enqueue_scripts', 	array( $this, 'enqueue_scripts' ) );

	} // hooks()

	/**
	 * Register the stylesheets for the frontend of the site.
	 *
	 * @hooked 		wp_enqueue_scripts
	 * @since 		1.0.0
	 */
	public function enqueue_styles() {

		wp_enqueue_style( TOUT_SOCIAL_BUTTONS_SLUG, plugin_dir_url( __FILE__ ) . 'css/tout-social-buttons.css', array(), TOUT_SOCIAL_BUTTONS_VERSION, 'all' );

	} // enqueue_styles()

	/**
	 * Register the JavaScript for the frontend of the site.
	 *
	 * @hooked 		wp_enqueue_scripts
	 * @since 		1.0.0
	 */
	public function enqueue_scripts() {

		//if ( 'popup' !== $this->settings['button-behavior'] ) { return; }

		wp_enqueue_script( TOUT_SOCIAL_BUTTONS_SLUG, plugin_dir_url( __FILE__ ) . 'js/tout-social-buttons-frontend.min.js', array( 'jquery' ), TOUT_SOCIAL_BUTTONS_VERSION, true );

	} // enqueue_scripts()

	/**
	 * Sets the class variable $settings with the plugin settings.
	 *
	 * @since 		1.0.0
	 */
	public function set_settings() {

		$this->settings = get_option( TOUT_SOCIAL_BUTTONS_SETTINGS );

	} // set_settings()

} // class
