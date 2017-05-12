<?php

/**
 * The admin-specific functionality of the plugin.
 *
 * @link       https://www.slushman.com
 * @since      1.0.0
 *
 * @package    Tout_Buttons
 * @subpackage Tout_Buttons/admin
 */

/**
 * The admin-specific functionality of the plugin.
 *
 * Defines the plugin name, version, and two examples hooks for how to
 * enqueue the admin-specific stylesheet and JavaScript.
 *
 * @package    Tout_Buttons
 * @subpackage Tout_Buttons/admin
 * @author     Slushman <chris@slushman.com>
 */
class Tout_Buttons_Admin {

	/**
	 * The ID of this plugin.
	 *
	 * @since    1.0.0
	 * @access   private
	 * @var      string    $plugin_name    The ID of this plugin.
	 */
	private $plugin_name;

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
	 * @param      string    $plugin_name       The name of this plugin.
	 * @param      string    $version    The version of this plugin.
	 */
	public function __construct( $plugin_name, $version ) {

		$this->plugin_name = $plugin_name;
		$this->version = $version;

	} // __ construct()

	/**
	 * Adds a settings page link to a menu
	 *
	 * Top-level page
	 * add_menu_page( $page_title, $menu_title, $capability, $menu_slug, $function, $icon_url, $position );
	 *
	 * Submenu Page
	 * add_submenu_page( $parent_slug, $page_title, $menu_title, $capability, $menu_slug, $function);
	 *
	 * Admin menu page slugs:
	 * 	Options: options-general.php?page=
	 * 	Tools: tools.php?page=
	 *
	 *
	 * @hooked 		admin_menu
	 * @link 		https://codex.wordpress.org/Administration_Menus
	 * @since 		1.0.0
	 */
	public function add_menu() {

		add_submenu_page(
			'options-general.php',
			esc_html__( 'Tout Buttons Settings', 'tout-buttons' ),
			esc_html__( 'Tout Buttons', 'tout-buttons' ),
			'manage_options',
			TOUT_BUTTONS_SETTINGS,
			array( $this, 'page_settings' )
		);

	} // add_menu()

	/**
	 * Register the stylesheets for the admin area.
	 *
	 * @hooked 		admin_enqueue_scripts
	 * @since 		1.0.0
	 */
	public function enqueue_styles() {

		wp_enqueue_style( $this->plugin_name, plugin_dir_url( __FILE__ ) . 'css/tout-buttons-admin.css', array(), $this->version, 'all' );

	} // enqueue_styles()

	/**
	 * Register the JavaScript for the admin area.
	 *
	 * @hooked 		admin_enqueue_scripts
	 * @since 		1.0.0
	 */
	public function enqueue_scripts( $hook_suffix ) {

		wp_enqueue_script( $this->plugin_name, plugin_dir_url( __FILE__ ) . 'js/tout-buttons-admin.js', array( 'jquery' ), $this->version, false );

	} // enqueue_scripts()

	/**
	 * Returns an array of settings names, field types, and default values.
	 *
	 * $settings[] = array( 'field-name', 'field-type', 'default-value' )
	 *
	 * @since 		1.0.0
	 * @return 		array 		An array of settings.
	 */
	public function get_settings_list() {

		$settings = array();

		return $settings;

	} // get_settings_list()

	/**
	 * Adds a link to the plugin settings page from the Plugin listings.
	 *
	 * @since 		1.0.0
	 * @param 		array 		$links 		The current array of links.
	 * @return 		array 		$links 		The modified array of links.
	 */
	public function link_settings( $links ) {

		$links[] = sprintf( '<a href="%s">%s</a>', admin_url( 'options-general.php?page=' . TOUT_BUTTONS_SETTINGS ), esc_html__( 'Settings', 'tout-buttons' ) );

		return $links;

	} // link_settings()

	/**
	 * Includes the options page partial file.
	 *
	 * @since 		1.0.0
	 */
	public function page_settings() {

		include( plugin_dir_path( dirname( __FILE__ ) ) . 'admin/partials/pages/settings.php' );

	} // page_settings()

	/**
	 * Registers plugin settings.
	 *
	 * register_setting( $option_group, $option_name, $sanitize_callback );
	 *
	 * @link 		https://developer.wordpress.org/reference/functions/register_setting/
	 * @since 		1.0.0
	 */
	public function register_settings() {

		register_setting(
			TOUT_BUTTONS_SETTINGS,
			TOUT_BUTTONS_SETTINGS,
			array( $this, 'validate_settings' )
		);

	} // register_settings()

	/**
	 * Validates the saved settings.
	 *
	 * @since 		1.0.0
	 * @param 		array 		$input 		Array of submitted plugin settings.
	 * @return 		array 					Array of validated plugin settings.
	 */
	public function validate_settings( $input ) {

		//wp_die( print_r( $input ) );

		$valid 		= array();
		$settings 	= $this->get_settings_list();

		//wp_die( print_r( $settings ) );

		foreach ( $settings as $setting ) {

			$sanitizer 			= new Tout_Buttons_Sanitize();
			$valid[$setting[0]] = $sanitizer->clean( $input[$setting[0]], $setting[1] );

			//wp_die( print_r( $valid ) );

			if ( $valid[$setting[0]] != $input[$setting[0]] ) {

				add_settings_error( $setting[0], $setting[0] . '_error', esc_html__( $setting[0] . ' error.', 'tout-buttons' ), 'error' );

			}

			unset( $sanitizer );

		}

		//wp_die( print_r( $valid ) );

		return $valid;

	} // validate_settings()

} // class
