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
	 * Tout_Social_Buttons_Display object.
	 *
	 * @since 		1.0.0
	 * @access 		protected
	 * @var 		Tout_Social_Buttons_Display 		$shared 		Tout_Social_Buttons_Display object.
	 */
	private $shared;

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

		ob_start();

		$buttons = $this->get_active_buttons();

		if ( empty( $buttons ) ) { return; }

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
	 * Gets the buttons, then filters out the buttons not selected in the admin.
	 *
	 * @since 		1.0.0
	 * @return 		array 		The selected buttons.
	 */
	protected function get_active_buttons() {

		$buttons = $this->settings['button-order'];
		$buttons = explode( ',', $buttons );

		foreach ( $buttons as $key => $button ) {

			if ( 1 !== $this->settings['button-' . $button] ) {

				unset( $buttons[$key] );

			}

		}

		return $buttons;

	} // get_active_buttons()

	/**
	 * Registers shortcodes with WordPress.
	 *
	 * @since 		1.0.0
	 */
	public function register_shortcode() {

		add_shortcode( 'toutbuttons', array( $this, 'shortcode' ) );

	} // register_shortcode()

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
