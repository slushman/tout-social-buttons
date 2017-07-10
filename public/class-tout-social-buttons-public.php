<?php

/**
 * The public-facing functionality of the plugin.
 *
 * @link 			https://www.slushman.com
 * @since 			1.0.0
 *
 * @package 		Tout_Social_Buttons
 * @subpackage 		Tout_Social_Buttons/public
 */

/**
 * The public-facing functionality of the plugin.
 *
 * Defines the plugin name, version, and two examples hooks for how to
 * enqueue the admin-specific stylesheet and JavaScript.
 *
 * @package 		Tout_Social_Buttons
 * @subpackage 		Tout_Social_Buttons/public
 * @author 			Slushman <chris@slushman.com>
 */
class Tout_Social_Buttons_Public {

	/**
	 * Tout_Social_Buttons_Display object.
	 *
	 * @since 		1.0.0
	 * @access 		protected
	 * @var 		array 		$buttons 		Array of active buttons.
	 */
	private $buttons;


	/**
	 * The ID of this plugin.
	 *
	 * @since 		1.0.0
	 * @access 		private
	 * @var 		string    $plugin_name    The ID of this plugin.
	 */
	private $plugin_name;

	/**
	 * The plugin settings.
	 *
	 * @since 		1.0.0
	 * @access 		private
	 * @var 		string 			$settings 		The plugin settings.
	 */
	private $settings;

	/**
	 * The version of this plugin.
	 *
	 * @since 		1.0.0
	 * @access 		private
	 * @var 		string    $version    The current version of this plugin.
	 */
	private $version;

	/**
	 * Initialize the class and set its properties.
	 *
	 * @since 		1.0.0
	 * @param 		string    $plugin_name       The name of the plugin.
	 * @param 		string    $version    The version of this plugin.
	 */
	public function __construct( $plugin_name, $version ) {

		$this->plugin_name = $plugin_name;
		$this->version = $version;

		$this->set_settings();
		$this->set_buttons();

	} // __construct()

	/**
	 * Adds the tout buttons after the post content.
	 *
	 * @since 		1.0.0
	 * @param 		mixed 		$content 		The current content.
	 * @return 		mixed 						The content plus the tout buttons.
	 */
	public function add_buttons_to_content( $content ) {

		global $wp_current_filter;

		if ( empty( $content ) ) { return $content; }
		if ( is_preview() ) { return $content; }
		if ( is_home() ) { return $content; }
		if ( is_front_page() ) { return $content; }
		if ( in_array( 'get_the_excerpt', (array) $wp_current_filter ) ) { return $content; }
		if ( ! is_main_query() ) { return $content; }
		if ( 0 === $this->settings['auto-post'] ) { return $content; }

		return $content . $this->display_buttons();

	} // add_buttons_to_content()

	/**
	 * Includes the tout buttons partial file inside an output buffer.
	 *
	 * @since 		1.0.0
	 * @return 		mixed 						The tout buttons partial file.
	 */
	public function display_buttons() {

		if ( empty( $this->buttons ) ) { return; }

		ob_start();

		include( plugin_dir_path( dirname( __FILE__ ) ) . 'public/partials/tout-social-buttons-public-button-set.php' );

		$output = ob_get_contents();

		ob_end_clean();

		return $output;

	} // display_buttons()

	/**
	 * Register the stylesheets for the public-facing side of the site.
	 *
	 * @since    1.0.0
	 */
	public function enqueue_styles() {

		wp_enqueue_style( $this->plugin_name, plugin_dir_url( __FILE__ ) . 'css/tout-social-buttons-public.css', array(), $this->version, 'all' );

	} // enqueue_styles()

	/**
	 * Register the JavaScript for the public-facing side of the site.
	 *
	 * @since 		1.0.0
	 */
	public function enqueue_scripts() {

		if ( 'popup' !== $this->settings['button-behavior'] ) { return; }

		wp_enqueue_script( $this->plugin_name . '-public', plugin_dir_url( __FILE__ ) . 'js/tout-social-buttons-public.min.js', array( 'jquery' ), $this->version, true );

	} // enqueue_scripts()

	/**
	 * Registers shortcodes with WordPress.
	 *
	 * @since 		1.0.0
	 */
	public function register_shortcode() {

		add_shortcode( 'toutbuttons', array( $this, 'shortcode' ) );

	} // register_shortcode()

	/**
	 * Sets the class variable $buttons with the buttons selected in the
	 * plugin settings.
	 *
	 * Gets the button order. Explodes that string into an array.
	 * Loops through the button order and adds any active buttons
	 * to the $buttons class variable array.
	 *
	 * @since 		1.0.0
	 */
	public function set_buttons() {

		$button_order 	= $this->settings['button-order'];
		$buttons 		= explode( ',', $button_order );
		$active_buttons = array();

		foreach ( $buttons as $key => $button ) {

			if ( 1 === $this->settings['button-' . $button] ) {

				$active_buttons[] = $button;

			}

		}

		/**
		 * The tout_social_buttons_active_buttons filter.
		 * Allows for adding active buttons via filter.
		 *
		 * @param 		array 		$active_buttons 		Button selected in the plugin settings.
		 */
		$this->buttons = apply_filters( 'tout_social_buttons_active_buttons', $active_buttons );

	} // set_buttons()

	/**
	 * Sets the class variable $settings with the plugin settings.
	 *
	 * @since 		1.0.0
	 */
	public function set_settings() {

		$this->settings = get_option( TOUT_BUTTONS_SETTINGS );

	} // set_settings()

	/**
	 * Handles the output of the shortcode.
	 *
	 * Does not currently use any shortcode attributes.
	 *
	 * @since 		1.0.0
	 * @param 		array 		$atts 			The shortcode attributes.
	 * @param 		mixed 		$content 		Optional. The post content.
	 * @return 		mixed 						The shortcode output.
	 */
	public function shortcode( $atts = array(), $content = null ) {

		$defaults[''] 	= '';

		$args 			= shortcode_atts( $defaults, $atts, 'toutbuttons' );

		return $this->display_buttons();

	} // shortcode()

} // class
