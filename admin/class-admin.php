<?php

/**
 * The admin-specific functionality of the plugin.
 *
 * @link       https://www.slushman.com
 * @since      1.0.0
 * @package    ToutSocialButtons\Admin
 * @author     Slushman <chris@slushman.com>
 */

namespace ToutSocialButtons\Admin;
use \ToutSocialButtons\Fields as Fields;
use \ToutSocialButtons\Includes as Inc;

class Admin {

	private $all_buttons = array();

	/**
	 * Array of plugin settings to validate before saving to the database.
	 *
	 * @since 		1.0.0
	 * @access 		private
	 * @var 		array
	 */
	private $settings;

	/**
	 * The settings tabs.
	 *
	 * @since 		1.0.0
	 * @access 		private
	 * @var 		array 		$tabs 		The settings tabs.
	 */
	private $tabs;

	/**
	 * Initialize the class and set its properties.
	 *
	 * @since 		1.0.0
	 */
	public function __construct() {

		//

	} // __ construct()

	/**
	 * Registers all the WordPress hooks and filters related to this class.
	 *
	 * @hooked 		init
	 * @since 		1.0.0
	 */
	public function hooks() {

		add_action( 'activated_plugin', 				array( $this, 'save_activation_errors' ) );
		add_action( 'admin_notices', 					array( $this, 'activation_error_notice' ) );
		add_action( 'admin_enqueue_scripts', 			array( $this, 'enqueue_styles' ) );
		add_action( 'admin_enqueue_scripts', 			array( $this, 'enqueue_scripts' ) );
		//add_action( 'admin_enqueue_scripts', 			array( $this, 'localize_scripts' ) );
		add_action( 'admin_init', 						array( $this, 'register_settings' ) );
		add_action( 'admin_init', 						array( $this, 'register_fields' ) );
		add_action( 'admin_init', 						array( $this, 'register_sections' ) );
		add_action( 'admin_menu', 						array( $this, 'add_menu' ) );
		add_action( 'plugin_action_links_' . TOUT_SOCIAL_BUTTONS_FILE, array( $this, 'link_settings' ) );
		add_action( 'wp_head', 							array( $this, 'print_button_styles' ) );
		add_action( 'admin_head', 						array( $this, 'print_button_styles' ) );

	} // hooks()

	/**
	 * Displays an error notice displaying the error notice, if there is one.
	 *
	 * @hooked 		admin_notices
	 * @since 		1.0.0
	 */
	public function activation_error_notice() {

		$error = get_option( 'tout_social_buttons_errors' );

		if ( empty( $error ) ) { return; }

		include( plugin_dir_path( dirname( __FILE__ ) ) . 'admin/partials/error-notice.php' );

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

		add_menu_page(
			esc_html__( 'Settings', 'tout-social-buttons' ),
			esc_html__( 'Tout.Social', 'tout-social-buttons' ),
			'manage_options',
			TOUT_SOCIAL_BUTTONS_SETTINGS,
			array( $this, 'page_settings' ),
			'dashicons-share'
		);

		add_submenu_page(
			TOUT_SOCIAL_BUTTONS_SETTINGS,
			esc_html__( 'Settings', 'tout-social-buttons' ),
			esc_html__( 'Settings', 'tout-social-buttons' ),
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

		wp_enqueue_style( TOUT_SOCIAL_BUTTONS_SLUG, plugin_dir_url( __FILE__ ) . 'css/tout-social-buttons-admin.css', array(), TOUT_SOCIAL_BUTTONS_VERSION, 'all' );

	} // enqueue_styles()

	/**
	 * Register the JavaScript for the admin area.
	 *
	 * @hooked 		admin_enqueue_scripts
	 * @since 		1.0.0
	 * @param 		string 		$hook_suffix 		The suffix for the admin page.
	 */
	public function enqueue_scripts( $hook_suffix ) {

		$screen = get_current_screen();

		if ( $screen->id != $hook_suffix ) { return; }

		wp_enqueue_script( 'rubaxa-sortable', '//cdn.jsdelivr.net/npm/sortablejs@1.6.1/Sortable.min.js', array(), TOUT_SOCIAL_BUTTONS_VERSION, true );
		wp_enqueue_script( TOUT_SOCIAL_BUTTONS_SLUG . '-admin', plugin_dir_url( __FILE__ ) . 'js/tout-social-buttons-admin.js', array( 'jquery', 'rubaxa-sortable' ), TOUT_SOCIAL_BUTTONS_VERSION, true );

	} // enqueue_scripts()

	/**
	 * Creates a custom field for selecting the social buttons.
	 *
	 * @param 		array 		$args 		The field arguments.
	 * @return 		string 					The HTML field.
	 */
	public function field_active_buttons( $args ) {

		new Fields\Active_Buttons( 'settings', $args );

	} // field_active_buttons()

	/**
	 * Creates a  form field.
	 *
	 * @param 		array 		$args 		The field arguments.
	 * @return 		string 					The HTML field.
	 */
	public function field_checkbox( $args ) {

		new Fields\Checkbox( 'settings', $args );

	} // field_checkbox()

	/**
	 * Creates the design form field.
	 *
	 * @param 		array 		$args 		The field arguments.
	 * @return 		string 					The HTML field.
	 */
	public function field_design( $args ) {

		new Fields\Design( 'settings', $args );

	} // field_design()

	/**
	 * Creates a hidden form field.
	 *
	 * @since 		1.0.0
	 * @param 		array 		$args 		The field arguments.
	 * @return 		string 					The HTML field.
	 */
	public function field_hidden( $args ) {

		new Fields\Hidden( 'settings', $args );

	} // field_hidden()

	/**
	 * Creates a custom field with all the inactive buttons.
	 *
	 * @param 		array 		$args 		The field arguments.
	 * @return 		string 					The HTML field.
	 */
	public function field_inactive_buttons( $args ) {

		new Fields\Inactive_Buttons( 'settings', $args );

	} // field_inactive_buttons()

	/**
	 * Creates a select form field.
	 *
	 * @since 		1.0.0
	 * @param 		array 		$args 		The field arguments.
	 * @return 		string 					The HTML field.
	 */
	public function field_select( $args ) {

		new Fields\Select( 'settings', $args );

	} // field_select()

	/**
	 * Creates a text form field.
	 *
	 * @since 		1.0.0
	 * @param 		array 		$args 		The field arguments.
	 * @return 		string 					The HTML field.
	 */
	public function field_text( $args ) {

		new Fields\Text( 'settings', $args );

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
	 * Adds a link to the plugin settings page from the Plugin listings.
	 *
	 * @hooked 		plugin_action_links_ . TOUT_SOCIAL_BUTTONS_FILE
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
	 * @hooked 		admin_enqueue_scripts
	 * @since 		1.0.0
	 * @param 		string 		$hook_suffix 		The current admin page.
	 */
	public function localize_scripts( $hook_suffix ) {

		$screen = get_current_screen();

		if ( $screen->id != $hook_suffix ) { return; }

		wp_localize_script();

	} // localize_scripts()

	/**
	 * Includes the options page partial file.
	 *
	 * @since 		1.0.0
	 */
	public function page_settings() {

		include( plugin_dir_path( dirname( __FILE__ ) ) . 'admin/partials/page-settings.php' );

	} // page_settings()

	/**
	 * Prints the CSS styles for each button in the head.
	 *
	 * @hooked 		wp_head
	 * @hooked 		admin_head
	 * @since 		1.0.0
	 */
	public function print_button_styles() {

		if ( is_admin() ) {

			$screen = get_current_screen();

			if ( 'toplevel_page_tout_social_buttons_settings' !== $screen->id ) { return; }

		}

		/**
		 * The tout_social_buttons_admin_buttons filter.
		 *
		 * @param 		array 		$buttons 		Array of button objects.
		 */
		$buttons = apply_filters( 'tout_social_buttons_admin_buttons', array() );

		if ( empty( $buttons ) ) { return; }

		?><style type="text/css"><?php

		foreach ( $buttons as $button => $object ) :

			$colors = $object->get_colors();

			echo '.tout-social-button-wrap-' . $button . '{color:' . $colors['contrast'] . ';background-color:' . $colors['brand'] . ';}';
			echo '.tout-social-button-icon-' . $button . '{fill:' . $colors['contrast'] . ';}';

		endforeach;

		?></style><!-- Tout.Social Buttons --><?php

	} // print_button_styles()

	/**
	 * Registers settings fields.
	 *
	 * add_settings_field( $id, $title, $callback, $page, $section = 'default', $args = array() )
	 *
	 * @hooekd 		admin_init
	 * @link 		https://developer.wordpress.org/reference/functions/add_settings_field/
	 * @since 		1.0.0
	 */
	public function register_fields() {

		// Buttons fields
		add_settings_field(
			'active-buttons',
			esc_html__( 'Active Buttons', 'tout-social-buttons' ),
			array( $this, 'field_active_buttons' ),
			TOUT_SOCIAL_BUTTONS_SLUG,
			TOUT_SOCIAL_BUTTONS_SETTINGS . '_buttons',
			array(
				'attributes' 	=> array(
					'id' 		=> 'active-buttons'
				),
				'properties' 	=> array(
					'description' 	=> __( 'Drag buttons to this area to activate them.', 'tout-social-buttons' )
				)
			)
		);
		$this->settings[] = array( 'active-buttons', 'hidden' );

		add_settings_field(
			'inactive-buttons',
			esc_html__( 'Inactive Buttons', 'tout-social-buttons' ),
			array( $this, 'field_inactive_buttons' ),
			TOUT_SOCIAL_BUTTONS_SLUG,
			TOUT_SOCIAL_BUTTONS_SETTINGS . '_buttons',
			array(
				'attributes' 	=> array(
					'id' 		=> 'inactive-buttons'
				),
				'properties' 	=> array(
					'description' 	=> __( '', 'tout-social-buttons' )
				)
			)
		);
		$this->settings[] = array( 'inactive-buttons', 'hidden' );

		add_settings_field(
			'button-behavior',
			esc_html__( 'Button Behavior', 'tout-social-buttons' ),
			array( $this, 'field_select' ),
			TOUT_SOCIAL_BUTTONS_SLUG,
			TOUT_SOCIAL_BUTTONS_SETTINGS . '_buttons',
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
		$this->settings[] = array( 'button-behavior', 'select' );

		add_settings_field(
			'auto-post',
			esc_html__( 'Auto Post', 'tout-social-buttons' ),
			array( $this, 'field_checkbox' ),
			TOUT_SOCIAL_BUTTONS_SLUG,
			TOUT_SOCIAL_BUTTONS_SETTINGS . '_buttons',
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
		$this->settings[] = array( 'auto-post', 'checkbox', 1 );



		// Accounts fields
		add_settings_field(
			'account-twitter',
			esc_html__( 'Twitter Account', 'tout-social-buttons' ),
			array( $this, 'field_text' ),
			TOUT_SOCIAL_BUTTONS_SLUG,
			TOUT_SOCIAL_BUTTONS_SETTINGS . '_accounts',
			array(
				'attributes' 	=> array(
					'id' 		=> 'account-twitter'
				),
				'properties' 	=> array(
					'description' 	=> __( 'Enter your Twitter username.', 'tout-social-buttons' )
				)
			)
		);
		$this->settings[] = array( 'account-twitter', 'text' );

		add_settings_field(
			'account-tumblr',
			esc_html__( 'tumblr Account', 'tout-social-buttons' ),
			array( $this, 'field_text' ),
			TOUT_SOCIAL_BUTTONS_SLUG,
			TOUT_SOCIAL_BUTTONS_SETTINGS . '_accounts',
			array(
				'attributes' 	=> array(
					'id' 		=> 'account-tumblr'
				),
				'properties' 	=> array(
					'description' 	=> __( 'Enter your tumblr username.', 'tout-social-buttons' )
				)
			)
		);
		$this->settings[] = array( 'account-tumblr', 'text' );



		// Design fields
		add_settings_field(
			'design',
			esc_html__( 'Design', 'tout-social-buttons' ),
			array( $this, 'field_design' ),
			TOUT_SOCIAL_BUTTONS_SLUG,
			TOUT_SOCIAL_BUTTONS_SETTINGS . '_design',
			array(
				'attributes' 	=> array(
					'id' 		=> 'design'
				),
				'properties' 	=> array(
					'description' 	=> __( 'Customize the appearance of the Tout.Social buttons.', 'tout-social-buttons' )
				)
			)
		);

	} // register_fields()

	/**
	 * Registers settings sections.
	 *
	 * add_settings_section( $id, $title, $callback, $menu_slug );
	 *
	 * @hooked 		admin_init
	 * @link 		https://developer.wordpress.org/reference/functions/add_settings_section/
	 * @since 		1.0.0
	 */
	public function register_sections() {

		add_settings_section(
			TOUT_SOCIAL_BUTTONS_SETTINGS . '_buttons',
			esc_html__( 'Buttons', 'tout-social-buttons' ),
			array( $this, 'sections' ),
			TOUT_SOCIAL_BUTTONS_SLUG
		);

		add_settings_section(
			TOUT_SOCIAL_BUTTONS_SETTINGS . '_accounts',
			esc_html__( 'Accounts', 'tout-social-buttons' ),
			array( $this, 'sections' ),
			TOUT_SOCIAL_BUTTONS_SLUG
		);

		add_settings_section(
			TOUT_SOCIAL_BUTTONS_SETTINGS . '_design',
			esc_html__( 'Design', 'tout-social-buttons' ),
			array( $this, 'sections' ),
			TOUT_SOCIAL_BUTTONS_SLUG
		);

	} // register_sections()

	/**
	 * Registers plugin settings.
	 *
	 * register_setting( $option_group, $option_name, $sanitize_callback );
	 *
	 * @hooked 		admin_init
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
	 * @hooked 		activated_plugin
	 * @since 		1.0.0
	 */
	public function save_activation_errors() {

		update_option( 'tout_social_buttons_errors', ob_get_contents() );

	} // save_activation_errors()

	/**
	 * Includes the settings section partial file based on the section ID.
	 *
	 * @since 		1.0.0
	 * @param 		array 		$params 		Array of parameters for the section.
	 * @return 		mixed 						The settings section.
	 */
	public function sections( $params ) {

		switch ( $params['id'] ) :

			case TOUT_SOCIAL_BUTTONS_SLUG . '-accounts': 	$params['description'] = __( 'Enter your username(s) for correct attributions on items shared on these sites. This is completely optional.', 'tout-social-buttons' ); break;
			case TOUT_SOCIAL_BUTTONS_SLUG . '-design': 		$params['description'] = __( 'Customize the appearance of the Tout.Social buttons.', 'tout-social-buttons' ); break;

		endswitch;

		include( plugin_dir_path( dirname( __FILE__ ) ) . 'admin/partials/settings-section.php' );

	} // sections()

	/**
	 * Validates the saved settings.
	 *
	 * @since 		1.0.0
	 * @param 		array 		$input 		Array of submitted plugin settings.
	 * @return 		array 					Array of validated plugin settings.
	 */
	public function validate_settings( $input ) {

		//wp_die( print_r( $input ) );

		$valid = array();

		//wp_die( print_r( $this->settings ) );

		foreach ( $this->settings as $setting ) {

			$sanitizer 			= new Inc\Sanitize();
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
