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
	 * Creates a custom field for selecting the social buttons.
	 *
	 * @param 		array 		$args 		The field arguments.
	 * @return 		string 					The HTML field.
	 */
	public function field_buttons( $args ) {

		new Tout_Buttons_Field_Buttons( 'settings', $args['attributes'], $args['properties'], $args['options'] );

	} // field_buttons()

	/**
	 * Creates a checkbox form field.
	 *
	 * @param 		array 		$args 		The field arguments.
	 * @return 		string 					The HTML field.
	 */
	public function field_checkbox( $args ) {

		new Tout_Buttons_Field_Checkbox( 'settings', $args['attributes'], $args['properties'], $args['options'] );

	} // field_checkbox()

	/**
	 * Creates a hidden form field.
	 *
	 * @since 		1.0.0
	 * @param 		array 		$args 		The field arguments.
	 * @return 		string 					The HTML field.
	 */
	public function field_hidden( $args ) {

		new Tout_Buttons_Field_Hidden( 'settings', $args['attributes'], $args['properties'] );

	} // field_hidden()

	/**
	 * Creates a select form field.
	 *
	 * @since 		1.0.0
	 * @param 		array 		$args 		The field arguments.
	 * @return 		string 					The HTML field.
	 */
	public function field_select( $args ) {

		new Tout_Buttons_Field_Select( 'settings', $args['attributes'], $args['properties'], $args['options'] );

	} // field_select()

	/**
	 * Creates a text form field.
	 *
	 * @since 		1.0.0
	 * @param 		array 		$args 		The field arguments.
	 * @return 		string 					The HTML field.
	 */
	public function field_text( $args ) {

		new Tout_Buttons_Field_Text( 'settings', $args['attributes'], $args['properties'] );

	} // field_text()

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

		$settings[] = array( 'account-delicious', 'text', '' );
		$settings[] = array( 'account-tumblr', 'text', '' );
		$settings[] = array( 'account-twitter', 'text', '' );
		$settings[] = array( 'auto-post', 'checkbox', 1 );
		$settings[] = array( 'button-behavior', 'select', '' );
		$settings[] = array( 'button-order', 'hidden', 'Baidu,Buffer,Delicious,Digg,Douban,Email,Evernote,Facebook,Google,Linkedin,Pinterest,QZone,Reddit,Renren,Stumbleupon,tumblr,Twitter,VK,Weibo,Xing' );
		$settings[] = array( 'button-type', 'select', 'icon' );

		$settings[] = array( 'button-baidu', 'checkbox', 0 );
		$settings[] = array( 'button-buffer', 'checkbox', 0 );
		$settings[] = array( 'button-delicious', 'checkbox', 0 );
		$settings[] = array( 'button-digg', 'checkbox', 0 );
		$settings[] = array( 'button-douban', 'checkbox', 0 );
		$settings[] = array( 'button-email', 'checkbox', 0 );
		$settings[] = array( 'button-evernote', 'checkbox', 0 );
		$settings[] = array( 'button-facebook', 'checkbox', 0 );
		$settings[] = array( 'button-google', 'checkbox', 0 );
		$settings[] = array( 'button-linkedin', 'checkbox', 0 );
		$settings[] = array( 'button-pinterest', 'checkbox', 0 );
		$settings[] = array( 'button-qzone', 'checkbox', 0 );
		$settings[] = array( 'button-reddit', 'checkbox', 0 );
		$settings[] = array( 'button-renren', 'checkbox', 0 );
		$settings[] = array( 'button-stumbleupon', 'checkbox', 0 );
		$settings[] = array( 'button-twitter', 'checkbox', 0 );
		$settings[] = array( 'button-vk', 'checkbox', 0 );
		$settings[] = array( 'button-weibo', 'checkbox', 0 );
		$settings[] = array( 'button-xing', 'checkbox', 0 );

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
	 * Registers settings fields.
	 *
	 * @link 		https://developer.wordpress.org/reference/functions/add_settings_field/
	 * @since 		1.0.0
	 */
	public function register_fields() {

		add_settings_field(
			'buttons',
			esc_html__( 'Buttons', 'tout-buttons' ),
			array( $this, 'field_buttons' ),
			TOUT_BUTTONS_SLUG,
			TOUT_BUTTONS_SLUG . '-buttons',
			array(
				'attributes' 	=> array(
					'id' 		=> 'buttons'
				),
				'properties' 	=> array(
					'description' 	=> __( 'Click a button to activate or decactivate it. Drag them into the order you prefer.', 'tout-buttons' )
				)
			)
		);

		add_settings_field(
			'account-twitter',
			esc_html__( 'Twitter Account', 'tout-buttons' ),
			array( $this, 'field_text' ),
			TOUT_BUTTONS_SLUG,
			TOUT_BUTTONS_SLUG . '-accounts',
			array(
				'attributes' 	=> array(
					'id' 		=> 'account-twitter'
				),
				'properties' 	=> array(
					'description' 	=> __( 'Enter your Twitter username.', 'tout-buttons' )
				)
			)
		);

		add_settings_field(
			'account-delicious',
			esc_html__( 'Delicious Account', 'tout-buttons' ),
			array( $this, 'field_text' ),
			TOUT_BUTTONS_SLUG,
			TOUT_BUTTONS_SLUG . '-accounts',
			array(
				'attributes' 	=> array(
					'id' 		=> 'account-delicious'
				),
				'properties' 	=> array(
					'description' 	=> __( 'Enter your Delicious username.', 'tout-buttons' )
				)
			)
		);

		add_settings_field(
			'account-tumblr',
			esc_html__( 'tumblr Account', 'tout-buttons' ),
			array( $this, 'field_text' ),
			TOUT_BUTTONS_SLUG,
			TOUT_BUTTONS_SLUG . '-accounts',
			array(
				'attributes' 	=> array(
					'id' 		=> 'account-tumblr'
				),
				'properties' 	=> array(
					'description' 	=> __( 'Enter your tumblr username.', 'tout-buttons' )
				)
			)
		);

		add_settings_field(
			'button-type',
			esc_html__( 'Button Type', 'tout-buttons' ),
			array( $this, 'field_select' ),
			TOUT_BUTTONS_SLUG,
			TOUT_BUTTONS_SLUG . '-buttons',
			array(
				'attributes' 	=> array(
					'id' 		=> 'button-type',
					'value' 	=> 'icon'
				),
				'properties' 	=> array(
					'description' 	=> __( '', 'tout-buttons' )
				),
				'options' 		=> array(
					array( 'label' => __( 'Icon', 'tout-buttons' ), 'value' => 'icon' ),
					array( 'label' => __( 'Text', 'tout-buttons' ), 'value' => 'text' )
				)
			)
		);

		add_settings_field(
			'button-behavior',
			esc_html__( 'Button Behavior', 'tout-buttons' ),
			array( $this, 'field_select' ),
			TOUT_BUTTONS_SLUG,
			TOUT_BUTTONS_SLUG . '-buttons',
			array(
				'attributes' 	=> array(
					'id' 		=> 'button-behavior'
				),
				'properties' 	=> array(
					'description' 	=> __( 'Should the share buttons open a modal, pop-up window, or something else?', 'tout-buttons' )
				),
				'options' 		=> array(
					array( 'label' => __( 'Pop-up', 'tout-buttons' ), 'value' => 'popup' ),
					array( 'label' => __( 'Modal', 'tout-buttons' ), 'value' => 'modal' ),
					array( 'label' => __( 'New Tab/Window', 'tout-buttons' ), 'value' => 'new' )
				)
			)
		);

		add_settings_field(
			'auto-post',
			esc_html__( 'Auto Post', 'tout-buttons' ),
			array( $this, 'field_checkbox' ),
			TOUT_BUTTONS_SLUG,
			TOUT_BUTTONS_SLUG . '-buttons',
			array(
				'attributes' 	=> array(
					'id' 		=> 'auto-post',
					'value' 	=> 1
				),
				'properties' 	=> array(
					'description' 	=> __( 'Check to have buttons automatically appear at the end of posts.', 'tout-buttons' )
				)
			)
		);

	} // register_fields()

	/**
	 * Registers settings sections.
	 *
	 * add_settings_section( $id, $title, $callback, $menu_slug );
	 *
	 * @link 		https://developer.wordpress.org/reference/functions/add_settings_section/
	 * @since 		1.0.0
	 */
	public function register_sections() {

		add_settings_section(
			TOUT_BUTTONS_SLUG . '-buttons',
			esc_html__( 'Buttons', 'tout-buttons' ),
			array( $this, 'section_buttons' ),
			TOUT_BUTTONS_SLUG
		);

		add_settings_section(
			TOUT_BUTTONS_SLUG . '-accounts',
			esc_html__( 'Accounts', 'tout-buttons' ),
			array( $this, 'section_accounts' ),
			TOUT_BUTTONS_SLUG
		);

	} // register_sections()

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
	 * Includes the settings section partial file.
	 *
	 * @since 		1.0.0
	 * @param 		array 		$params 		Array of parameters for the section.
	 * @return 		mixed 						The settings section.
	 */
	public function section_accounts( $params ) {

		include( plugin_dir_path( dirname( __FILE__ ) ) . 'admin/partials/sections/accounts.php' );

	} // section_accounts()

	/**
	 * Includes the buttons section partial file.
	 *
	 * @since 		1.0.0
	 * @param 		array 		$params 		Array of parameters for the section.
	 * @return 		mixed 						The buttons section.
	 */
	public function section_buttons( $params ) {

		include( plugin_dir_path( dirname( __FILE__ ) ) . 'admin/partials/sections/buttons.php' );

	} // section_buttons()

	/**
	 * Sets the class variable $settings.
	 *
	 * @since 		1.0.0
	 */
	private function set_settings() {

		$this->settings = get_option( TOUT_BUTTONS_SETTINGS );

	} // set_settings()

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

			// if ( 'auto-post' === $setting[0] ) {
			//
			// 	wp_die( print_r( $input ) );
			//
			// }

			if ( $valid[$setting[0]] != $input[$setting[0]] && 'checkbox' !== $setting[1] ) {

				add_settings_error( $setting[0], $setting[0] . '_error', esc_html__( $setting[0] . ' error.', 'tout-buttons' ), 'error' );

			}

			unset( $sanitizer );

		}

		//wp_die( print_r( $valid ) );

		return $valid;

	} // validate_settings()

} // class
