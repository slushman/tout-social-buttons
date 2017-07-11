<?php

/**
 * The admin-specific functionality of the plugin.
 *
 * @link       https://www.slushman.com
 * @since      1.0.0
 *
 * @package    Tout_Social_Buttons
 * @subpackage Tout_Social_Buttons/admin
 */

/**
 * The admin-specific functionality of the plugin.
 *
 * Defines the plugin name, version, and two examples hooks for how to
 * enqueue the admin-specific stylesheet and JavaScript.
 *
 * @package    Tout_Social_Buttons
 * @subpackage Tout_Social_Buttons/admin
 * @author     Slushman <chris@slushman.com>
 */
class Tout_Social_Buttons_Admin {

	/**
	 * The ID of this plugin.
	 *
	 * @since    1.0.0
	 * @access   private
	 * @var      string    $plugin_name    The ID of this plugin.
	 */
	private $plugin_name;

	private $tabs;

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

		$this->set_tabs();

	} // __ construct()

	/**
	 * Displays an error notice displaying the error notice, if there is one.
	 *
	 * @since 		1.0.0
	 * @return
	 */
	public function activation_error_notice() {

		$error = get_option( 'tout-social-buttons-errors' );

		if ( empty( $error ) ) { return; }

		include( plugin_dir_path( dirname( __FILE__ ) ) . 'admin/partials/tout-social-buttons-error-notice.php' );

	} // activation_error_notice()

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
			esc_html__( 'Tout.Social Buttons Settings', 'tout-social-buttons' ),
			esc_html__( 'Tout.Social Buttons', 'tout-social-buttons' ),
			'manage_options',
			TOUT_SOCIAL_BUTTONS_SETTINGS,
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

		wp_enqueue_style( $this->plugin_name, plugin_dir_url( __FILE__ ) . 'css/tout-social-buttons-admin.css', array(), $this->version, 'all' );

	} // enqueue_styles()

	/**
	 * Register the JavaScript for the admin area.
	 *
	 * @hooked 		admin_enqueue_scripts
	 * @since 		1.0.0
	 */
	public function enqueue_scripts( $hook_suffix ) {

		$screen = get_current_screen();

		if ( $screen->id != $hook_suffix ) { return; }

		wp_enqueue_script( 'johnny-sortable', '//johnny.github.io/jquery-sortable/js/jquery-sortable-min.js', array( 'jquery' ), $this->version, true );
		wp_enqueue_script( $this->plugin_name . '-admin', plugin_dir_url( __FILE__ ) . 'js/tout-social-buttons-admin.min.js', array( 'jquery', 'johnny-sortable' ), $this->version, true );

	} // enqueue_scripts()

	/**
	 * Creates a custom field for selecting the social buttons.
	 *
	 * @param 		array 		$args 		The field arguments.
	 * @return 		string 					The HTML field.
	 */
	public function field_buttons( $args ) {

		new Tout_Social_Buttons_Field_Buttons( 'settings', $args['attributes'], $args['properties'] );

	} // field_buttons()

	/**
	 * Creates a checkbox form field.
	 *
	 * @param 		array 		$args 		The field arguments.
	 * @return 		string 					The HTML field.
	 */
	public function field_checkbox( $args ) {

		new Tout_Social_Buttons_Field_Checkbox( 'settings', $args['attributes'], $args['properties'] );

	} // field_checkbox()

	/**
	 * Creates a hidden form field.
	 *
	 * @since 		1.0.0
	 * @param 		array 		$args 		The field arguments.
	 * @return 		string 					The HTML field.
	 */
	public function field_hidden( $args ) {

		new Tout_Social_Buttons_Field_Hidden( 'settings', $args['attributes'], $args['properties'] );

	} // field_hidden()

	/**
	 * Creates a select form field.
	 *
	 * @since 		1.0.0
	 * @param 		array 		$args 		The field arguments.
	 * @return 		string 					The HTML field.
	 */
	public function field_select( $args ) {

		new Tout_Social_Buttons_Field_Select( 'settings', $args['attributes'], $args['properties'], $args['options'] );

	} // field_select()

	/**
	 * Creates a text form field.
	 *
	 * @since 		1.0.0
	 * @param 		array 		$args 		The field arguments.
	 * @return 		string 					The HTML field.
	 */
	public function field_text( $args ) {

		new Tout_Social_Buttons_Field_Text( 'settings', $args['attributes'], $args['properties'] );

	} // field_text()

	/**
	 * Returns the active tab.
	 *
	 * @since 		1.0.0
	 * @return 		string 			The name of the active tab.
	 */
	protected function get_active_tab() {

		if ( isset( $_GET['tab'] ) ) {

			return $_GET['tab'];

		} else {

			return 'settings';

		}

	} // get_active_tab()

	/**
	 * Returns an array of settings names, field types, and default values.
	 *
	 * $settings[] = array( 'field-name', 'field-type', 'default-value' )
	 *
	 * @since 		1.0.0
	 * @return 		array 		An array of settings.
	 */
	public static function get_settings_list() {

		$settings = array();

		$settings[] = array( 'account-tumblr', 'text', '' );
		$settings[] = array( 'account-twitter', 'text', '' );
		$settings[] = array( 'auto-post', 'checkbox', 1 );
		$settings[] = array( 'button-behavior', 'select', '' );
		$settings[] = array( 'button-order', 'hidden', 'baidu,buffer,digg,douban,email,evernote,facebook,google,linkedin,pinterest,qzone,reddit,renren,stumbleupon,tumblr,twitter,vk,weibo,xing' );
		$settings[] = array( 'button-type', 'select', 'icon' );

		$settings[] = array( 'button-baidu', 'checkbox', 0 );
		$settings[] = array( 'button-buffer', 'checkbox', 0 );
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
		$settings[] = array( 'button-tumblr', 'checkbox', 0 );
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

		$links[] = sprintf( '<a href="%s">%s</a>', admin_url( 'options-general.php?page=' . TOUT_SOCIAL_BUTTONS_SETTINGS ), esc_html__( 'Settings', 'tout-social-buttons' ) );

		return $links;

	} // link_settings()

	/**
	 * Sends localization strings to scripts.
	 *
	 * @since 		1.0.0
	 * @param 		string 		$hook_suffix 		The current admin page.
	 */
	public function localize_scripts( $hook_suffix ) {

		$screen = get_current_screen();

		if ( $screen->id != $hook_suffix ) { return; }

		wp_localize_script(
			$this->plugin_name . '-admin',
			'Tout_Social_Buttons_Ajax',
			array(
				'tbOrderNonce' 		=> wp_create_nonce( 'tout-social-buttons-order-ajax-nonce' ),
				'tbSelectionNonce' 	=> wp_create_nonce( 'tout-social-buttons-selection-ajax-nonce' ),
				'tbTypeNonce' 		=> wp_create_nonce( 'tout-social-buttons-type-ajax-nonce' ),
			)
		);

	} // localize_scripts()

	/**
	 * Includes the options page partial file.
	 *
	 * @since 		1.0.0
	 */
	public function page_settings() {

		include( plugin_dir_path( dirname( __FILE__ ) ) . 'admin/partials/tout-social-buttons-page-settings.php' );

	} // page_settings()

	/**
	 * Registers settings fields.
	 *
	 * @link 		https://developer.wordpress.org/reference/functions/add_settings_field/
	 * @since 		1.0.0
	 */
	public function register_fields() {

		// Buttons fields
		add_settings_field(
			'buttons',
			esc_html__( 'Buttons', 'tout-social-buttons' ),
			array( $this, 'field_buttons' ),
			TOUT_SOCIAL_BUTTONS_SLUG,
			TOUT_SOCIAL_BUTTONS_SLUG . '-buttons',
			array(
				'attributes' 	=> array(
					'id' 		=> 'buttons'
				),
				'properties' 	=> array(
					'description' 	=> __( 'Click a button to activate or deactivate it. Drag them into the order you prefer.', 'tout-social-buttons' )
				)
			)
		);

		add_settings_field(
			'button-type',
			esc_html__( 'Button Type', 'tout-social-buttons' ),
			array( $this, 'field_select' ),
			TOUT_SOCIAL_BUTTONS_SLUG,
			TOUT_SOCIAL_BUTTONS_SLUG . '-buttons',
			array(
				'attributes' 	=> array(
					'id' 		=> 'button-type',
					'value' 	=> 'icon'
				),
				'properties' 	=> array(
					'description' 	=> __( '', 'tout-social-buttons' )
				),
				'options' 		=> array(
					array( 'label' => __( 'Icon', 'tout-social-buttons' ), 'value' => 'icon' ),
					array( 'label' => __( 'Text', 'tout-social-buttons' ), 'value' => 'text' )
				)
			)
		);

		add_settings_field(
			'button-behavior',
			esc_html__( 'Button Behavior', 'tout-social-buttons' ),
			array( $this, 'field_select' ),
			TOUT_SOCIAL_BUTTONS_SLUG,
			TOUT_SOCIAL_BUTTONS_SLUG . '-buttons',
			array(
				'attributes' 	=> array(
					'id' 		=> 'button-behavior'
				),
				'properties' 	=> array(
					'blank' 		=> __( 'Links', 'tout-social-buttons' ),
					'alert' 		=> __( 'WARNING: Forcing links to open in pop-ups or new tabs/windows creates an accessibility problem.', 'tout-social-buttons' ),
					'description' 	=> __( 'Should the share buttons be links (default), open a pop-up window, or open in a new tab or window?', 'tout-social-buttons' )
				),
				'options' 		=> array(
					array( 'label' => __( 'Open a Pop-up', 'tout-social-buttons' ), 'value' => 'popup' ),
					array( 'label' => __( 'Open in New Tab/Window', 'tout-social-buttons' ), 'value' => 'new' )
				)
			)
		);

		add_settings_field(
			'auto-post',
			esc_html__( 'Auto Post', 'tout-social-buttons' ),
			array( $this, 'field_checkbox' ),
			TOUT_SOCIAL_BUTTONS_SLUG,
			TOUT_SOCIAL_BUTTONS_SLUG . '-buttons',
			array(
				'attributes' 	=> array(
					'id' 		=> 'auto-post',
					'value' 	=> 1
				),
				'properties' 	=> array(
					'description' 	=> __( 'Check to have buttons automatically appear at the end of posts.', 'tout-social-buttons' )
				)
			)
		);



		// Accounts fields
		add_settings_field(
			'account-twitter',
			esc_html__( 'Twitter Account', 'tout-social-buttons' ),
			array( $this, 'field_text' ),
			TOUT_SOCIAL_BUTTONS_SLUG,
			TOUT_SOCIAL_BUTTONS_SLUG . '-accounts',
			array(
				'attributes' 	=> array(
					'id' 		=> 'account-twitter'
				),
				'properties' 	=> array(
					'description' 	=> __( 'Enter your Twitter username.', 'tout-social-buttons' )
				)
			)
		);

		add_settings_field(
			'account-tumblr',
			esc_html__( 'tumblr Account', 'tout-social-buttons' ),
			array( $this, 'field_text' ),
			TOUT_SOCIAL_BUTTONS_SLUG,
			TOUT_SOCIAL_BUTTONS_SLUG . '-accounts',
			array(
				'attributes' 	=> array(
					'id' 		=> 'account-tumblr'
				),
				'properties' 	=> array(
					'description' 	=> __( 'Enter your tumblr username.', 'tout-social-buttons' )
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
			TOUT_SOCIAL_BUTTONS_SLUG . '-buttons',
			esc_html__( 'Buttons', 'tout-social-buttons' ),
			array( $this, 'sections' ),
			TOUT_SOCIAL_BUTTONS_SLUG
		);

		add_settings_section(
			TOUT_SOCIAL_BUTTONS_SLUG . '-accounts',
			esc_html__( 'Accounts', 'tout-social-buttons' ),
			array( $this, 'sections' ),
			TOUT_SOCIAL_BUTTONS_SLUG
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
			TOUT_SOCIAL_BUTTONS_SETTINGS,
			TOUT_SOCIAL_BUTTONS_SETTINGS,
			array( $this, 'validate_settings' )
		);

	} // register_settings()

	/**
	 * Saves activations errors to a plugin setting.
	 *
	 * @since 		1.0.0
	 */
	public function save_activation_errors() {

		update_option( 'tout-social-buttons-errors', ob_get_contents() );

	} // save_activation_errors()

	/**
	 * Includes the settings section partial file based on the section ID.
	 *
	 * @since 		1.0.0
	 * @param 		array 		$params 		Array of parameters for the section.
	 * @return 		mixed 						The settings section.
	 */
	public function sections( $params ) {

		if ( TOUT_SOCIAL_BUTTONS_SLUG . '-accounts' === $params['id'] ) {

			$params['description'] = __( 'Enter your username(s) for correct attributions on items shared on these sites. This is completely optional.', 'tout-social-buttons' );

		}

		include( plugin_dir_path( dirname( __FILE__ ) ) . 'admin/partials/tout-social-buttons-settings-section.php' );

	} // sections()

	/**
	 * Sets the class variable $settings.
	 *
	 * @since 		1.0.0
	 */
	private function set_settings() {

		$this->settings = get_option( TOUT_SOCIAL_BUTTONS_SETTINGS );

	} // set_settings()

	/**
	 * Sets the class variable $tabs.
	 *
	 * Tabs can be added using the tout_buttons_settings_tabs filter.
	 * Each tab array needs the following:
	 * 	name 		The name of the tab
	 *  url 		The URL for the tab.
	 *  fields 		The settings key for this tab's fields
	 *  sections 	The settings key for this tab's sections
	 *
	 * @since 		1.0.0
	 */
	private function set_tabs() {

		// Settings Tab
		$default_tabs['settings']['name'] 		= esc_html__( 'Settings', 'tout-social-buttons' );
		$default_tabs['settings']['url'] 		= '?page=' . TOUT_SOCIAL_BUTTONS_SETTINGS . '&tab=settings';
		$default_tabs['settings']['fields'] 	= TOUT_SOCIAL_BUTTONS_SETTINGS;
		$default_tabs['settings']['sections'] 	= TOUT_SOCIAL_BUTTONS_SLUG;

		// Settings Tab
		// $default_tabs['help']['name'] 		= esc_html__( 'Help', 'tout-social-buttons' );
		// $default_tabs['help']['url'] 		= '?page=' . TOUT_SOCIAL_BUTTONS_SETTINGS . '&tab=help';
		// $default_tabs['help']['fields'] 	= 'tout-social-buttons-help';
		// $default_tabs['help']['sections'] 	= 'tout-social-buttons-help';

		/**
		 * The tout_buttons_settings_tabs filter.
		 *
		 * @param 		array 		$default_tabs 		The default tabs.
		 */
		$this->tabs = apply_filters( 'tout_buttons_settings_tabs', $default_tabs );

	} // set_tabs()

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

			$sanitizer 			= new Tout_Social_Buttons_Sanitize();
			$valid[$setting[0]] = $sanitizer->clean( $input[$setting[0]], $setting[1] );

			if ( $valid[$setting[0]] != $input[$setting[0]] && 'checkbox' !== $setting[1] ) {

				add_settings_error( $setting[0], $setting[0] . '_error', esc_html__( $setting[0] . ' error.', 'tout-social-buttons' ), 'error' );

			}

			unset( $sanitizer );

		}

		//wp_die( print_r( $valid ) );

		return $valid;

	} // validate_settings()

} // class
