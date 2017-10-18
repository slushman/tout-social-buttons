<?php

/**
 * The auto-post functionality of the plugin.
 *
 * @link 			https://www.slushman.com
 * @since 			1.0.0
 * @package 		ToutSocialButtons\Frontend
 * @author 			Slushman <chris@slushman.com>
 */

namespace ToutSocialButtons\Frontend;
use \ToutSocialButtons\Buttons as Buttons;

class AutoPost {

	/**
	 * The context where the button set is being used.
	 *
	 * @since 		1.0.0
	 * @access 		private
	 * @var 		string 		$context 		Where this is being used.
	 */
	private $context;

	/**
	 * The plugin settings.
	 *
	 * @since 		1.0.0
	 * @access 		private
	 * @var 		array 			$settings 		The plugin settings.
	 */
	private $settings;

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

		add_shortcode( 'toutsocialbuttons', 				array( $this, 'shortcode' ) );

		add_filter( 'the_content', 							array( $this, 'add_buttons_to_content' ), 19, 1 );

		add_action( 'tout_social_buttons_set_wrap_begin', 	array( $this, 'pretext' ), 10 );
		//add_action( 'wp_footer', 							array( $this, 'inline_scripts' ) );

		/**
		 * Action instead of template tag.
		 *
		 * Usage:
		 * do_action( 'toutsocialbuttons' );
		 *
		 * @link 		http://nacin.com/2010/05/18/rethinking-template-tags-in-plugins/
		 */
		add_action( 'toutsocialbuttons', array( $this, 'shortcode' ) );

	} // hooks()

	/**
	 * Adds the tout buttons after the post content.
	 *
	 * @hooked 		the_content
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

		$current_post_type = get_post_type();

		if ( ! $this->check_post_type( $current_post_type ) ) { return $content; }
		if ( ! $this->check_auto_post( $current_post_type ) ) { return $content; }

		ob_start();

		echo $content;

		$this->display_buttons();

		$output = ob_get_contents();

		ob_end_clean();

		return $output;

	} // add_buttons_to_content()

	/**
	 * Returns whether the buttons should automatically appear at the bottom
	 * of posts or not.
	 *
	 * The filter allows extensions to change this check based on a different
	 * criteria, like a different plugin setting.
	 *
	 * @since 		1.0.0
	 * @param 		string 		$current_post_type 		The current post type.
	 * @return 		bool 								TRUE if autoposting, FALSE if not
	 */
	protected function check_auto_post( $current_post_type ) {

		$autopost = FALSE;

		if ( isset( $this->settings['auto-post'] ) && 1 === $this->settings['auto-post'] ) {

			$autopost = TRUE;

		}

		/**
		 * The tout_social_buttons_check_auto_post filter.
		 *
		 * Allows for changing this check based on criteria besides
		 * the auto-post plugin setting.
		 *
		 * @var 		bool 		$autopost 				Whether auto-post setting is on or off.
		 * @var 		string 		$current_post_type 		The current post type.
		 */
		return apply_filters( 'tout_social_buttons_check_auto_post', $autopost, $current_post_type );

	} // check_auto_post()

	/**
	 * Returns whether the buttons should automatically appear at the bottom
	 * of the current post type or not.
	 *
	 * The filter allows for checking other post types.
	 *
	 * @since 		1.0.0
	 * @param 		string 		$current_post_type 		The current post type.
	 * @return 		bool 								TRUE if post type is selected, FALSE if not
	 */
	protected function check_post_type( $current_post_type ) {

		$post_types[] = 'post';

		/**
		 * The tout_social_buttons_check_post_types filter.
		 *
		 * Allows for chceking other post types.
		 *
		 * @var 		array 		$post_type
		 */
		$post_types = apply_filters( 'tout_social_buttons_check_post_types', $post_types );

		return in_array( $current_post_type, $post_types );

	} // check_post_type()

	/**
	 * Includes the tout buttons partial file inside an output buffer.
	 *
	 * @exits 		If no buttons are selected.
	 * @exits 		If not on the selected post type.
	 * @hooked 		toutsocialbuttons
	 * @since 		1.0.0
	 */
	public function display_buttons() {

		$buttons = $this->get_buttons();

		if ( empty( $buttons ) ) { return; }

		$set = new Buttons\Button_Set( $this->context, $buttons );

	} // display_buttons()

	/**
	 * Returns all the active buttons and an instance of each button class.
	 *
	 * Gets the button order. Explodes that string into an array.
	 * Loops through the button order and adds any active buttons
	 * to the $buttons class variable array.
	 *
	 * @since 		1.0.0
	 */
	protected function get_buttons() {

		$active = explode( ',', $this->settings['active-buttons'] );

		/**
		 * The tout_social_buttons_admin_active_buttons filter.
		 *
		 * @param 		array 		$active 		Array of active buttons from settings.
		 */
		$active = apply_filters( 'tout_social_buttons_admin_active_buttons', $active );

		if ( empty( $active ) ) { return; }

		/**
		 * The tout_social_buttons_frontend_active_buttons filter.
		 *
		 * Allows for adding active buttons via filter.
		 */
		return apply_filters( 'tout_social_buttons_frontend_active_buttons', $active );

	} // get_buttons()

	/**
	 * Includes the pretext partial file.
	 *
	 * @hooked 		tout_social_buttons_set_wrap_begin
	 * @since 		1.0.0
	 */
	public function pretext() {

		if ( 'autopost' !== $this->context ) { return; }

		include( plugin_dir_path( dirname( __FILE__ ) ) . 'frontend/partials/pretext.php' );

	} // pretext()

	/**
	 * Sets the class variable $settings with the plugin settings.
	 *
	 * @since 		1.0.0
	 */
	public function set_settings() {

		$this->settings = get_option( TOUT_SOCIAL_BUTTONS_SETTINGS );

	} // set_settings()

	/**
	 * Handles the output of the shortcode.
	 *
	 * Does not currently use any shortcode attributes.
	 *
	 * @hooked 		toutsocialbuttons
	 * @since 		1.0.0
	 * @param 		array 		$atts 			The shortcode attributes.
	 * @param 		mixed 		$content 		Optional. The post content.
	 * @return 		mixed 						The shortcode output.
	 */
	public function shortcode( $atts = array(), $content = null ) {

		$defaults[''] 	= '';
		$args 			= shortcode_atts( $defaults, $atts, 'toutsocialbuttons' );
		$this->context 	= 'autopost';

		ob_start();

		$this->display_buttons();

		$output = ob_get_contents();

		ob_end_clean();

		return $output;

	} // shortcode()

} // class
