<?php

/**
 * The public-facing functionality of the plugin.
 *
 * @link       https://www.slushman.com
 * @since      1.0.0
 *
 * @package    Tout_Buttons
 * @subpackage Tout_Buttons/public
 */

/**
 * The public-facing functionality of the plugin.
 *
 * Defines the plugin name, version, and two examples hooks for how to
 * enqueue the admin-specific stylesheet and JavaScript.
 *
 * @package    Tout_Buttons
 * @subpackage Tout_Buttons/public
 * @author     Slushman <chris@slushman.com>
 */
class Tout_Buttons_Public {

	/**
	 * The ID of this plugin.
	 *
	 * @since    1.0.0
	 * @access   private
	 * @var      string    $plugin_name    The ID of this plugin.
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
	 * Tout_Buttons_Buttons object.
	 *
	 * @since 		1.0.0
	 * @access 		protected
	 * @var 		Tout_Buttons_Buttons 		$shared 		Tout_Buttons_Buttons object.
	 */
	private $shared;

	/**
	 * The version of this plugin.
	 *
	 * @since    1.0.0
	 * @access   private
	 * @var      string    $version    The current version of this plugin.
	 */
	private $version;

	/**
	 * Initialize the class and set its properties.
	 *
	 * @since    1.0.0
	 * @param      string    $plugin_name       The name of the plugin.
	 * @param      string    $version    The version of this plugin.
	 */
	public function __construct( $plugin_name, $version ) {

		$this->plugin_name = $plugin_name;
		$this->version = $version;

		$this->set_settings();
		$this->set_shared();

	} // __construct()

	/**
	 * Adds the tout buttons after the post content.
	 *
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

		$buttons = $this->get_buttons();

		include( plugin_dir_path( dirname( __FILE__ ) ) . 'public/partials/tout-buttons-public-display.php' );

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

		wp_enqueue_style( $this->plugin_name, plugin_dir_url( __FILE__ ) . 'css/tout-buttons-public.css', array(), $this->version, 'all' );

	} // enqueue_styles()

	/**
	 * Register the JavaScript for the public-facing side of the site.
	 *
	 * @since    1.0.0
	 */
	public function enqueue_scripts() {

		wp_enqueue_script( $this->plugin_name, plugin_dir_url( __FILE__ ) . 'js/tout-buttons-public.js', array( 'jquery' ), $this->version, false );

	} // enqueue_scripts()

	/**
	 * [get_buttons description]
	 * @return [type] [description]
	 */
	protected function get_buttons() {

		$buttons = $this->shared->get_button_array();

		 // filter buttons here.

		return $buttons;

	} // get_buttons()

	/**
	 * Returns the classes for button.
	 *
	 * Sets a blank array. Then adds the base class.
	 * Then adds a class specific to that button.
	 * Implodes the array with a space between each element.
	 *
	 * @exits 		If $lower is empty or not a string.
	 * @since 		1.0.0
	 * @param 		string 		$lower 		The button name - all lowercase.
	 * @return 		string 					The classes.
	 */
	protected function get_button_class( $lower ) {

		if ( empty( $lower ) || ! is_string( $lower ) ) { return ''; }

		$lower 		= strtolower( $lower );
		$class 		= array();

		$class[]	= 'tout-button';
		$class[]	= 'tout-button-' . $lower;

		$class 		= implode( ' ', $class );

		return $class;

	} // get_button_class()

	/**
	 * Returns the URL for the selected button.
	 *
	 * @exits 		If $lower is empty or not a string.
	 * @since 		1.0.0
	 * @param 		string 		$lower 		The button name - all lowercase.
	 * @return 		string 					The sharing URL.
	 */
	protected function get_url( $lower ) {

		if ( empty( $lower ) || ! is_string( $lower ) ) { return ''; }

		$return 	= '';
		$lower 		= strtolower( $lower );
		$title 		= urlencode( get_the_title() );
		$excerpt 	= urlencode( get_the_excerpt() );
		$link 		= urlencode( get_permalink() );
		$image 		= urlencode( wp_get_attachment_url( get_post_thumbnail_id() ) );
		$urls 		= array();

		// Facebook
		$urls['facebook']['args']['u'] 			= $link;
		$urls['facebook']['base_url'] 			= 'https://www.facebook.com/sharer/sharer.php';

		$return = esc_url( add_query_arg( $urls[$lower]['args'], $urls[$lower]['base_url'] ) );

		return $return;

	} // get_url()

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
	 * Sets the class variable $shared with an instance of the Tout_Buttons_Buttons class.
	 *
	 * @since 		1.0.0
	 */
	protected function set_shared() {

		$this->shared = new Tout_Buttons_Buttons();

	} // set_shared()

	/**
	 * 
	 *
	 * @param 		array 		$atts 		The shortcode attributes.
	 * @return 		mixed 					The shortcode output.
	 */
	public function shortcode( $atts = array(), $content = null ) {

		$defaults[''] 	= '';

		$args 			= shortcode_atts( $defaults, $args, 'toutbuttons' );

		return $this->display_buttons();

	} // shortcode()

} // class
