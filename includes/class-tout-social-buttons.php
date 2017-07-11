<?php

/**
 * The file that defines the core plugin class
 *
 * A class definition that includes attributes and functions used across both the
 * public-facing side of the site and the admin area.
 *
 * @link 			https://www.slushman.com
 * @since 			1.0.0
 *
 * @package 		Tout_Social_Buttons
 * @subpackage		Tout_Social_Buttons/includes
 */

/**
 * The core plugin class.
 *
 * This is used to define internationalization, admin-specific hooks, and
 * public-facing site hooks.
 *
 * Also maintains the unique identifier of this plugin as well as the current
 * version of the plugin.
 *
 * @since 			1.0.0
 * @package 		Tout_Social_Buttons
 * @subpackage		Tout_Social_Buttons/includes
 * @author 			Slushman <chris@slushman.com>
 */
class Tout_Social_Buttons {

	/**
	 * The loader that's responsible for maintaining and registering all hooks that power
	 * the plugin.
	 *
	 * @since 		1.0.0
	 * @access 		protected
	 * @var 		Tout_Social_Buttons_Loader 		$loader 		Maintains and registers all hooks for the plugin.
	 */
	protected $loader;

	/**
	 * The unique identifier of this plugin.
	 *
	 * @since 		1.0.0
	 * @access 		protected
	 * @var 		string 		$plugin_name 		The string used to uniquely identify this plugin.
	 */
	protected $plugin_name;

	/**
	 * The current version of the plugin.
	 *
	 * @since 		1.0.0
	 * @access 		protected
	 * @var 		string 		$version 		The current version of the plugin.
	 */
	protected $version;

	/**
	 * Define the core functionality of the plugin.
	 *
	 * Set the plugin name and the plugin version that can be used throughout the plugin.
	 * Load the dependencies, define the locale, and set the hooks for the admin area and
	 * the public-facing side of the site.
	 *
	 * @since 		1.0.0
	 */
	public function __construct() {

		$this->plugin_name = 'tout-social-buttons';
		$this->version = '1.0.0';

		$this->load_dependencies();
		$this->set_locale();
		$this->define_admin_hooks();
		$this->define_public_hooks();
		$this->define_ajax_hooks();

	} // __construct()

	/**
	 * Load the required dependencies for this plugin.
	 *
	 * Include the following files that make up the plugin:
	 *
	 * - Tout_Social_Buttons_Loader. Orchestrates the hooks of the plugin.
	 * - Tout_Social_Buttons_i18n. Defines internationalization functionality.
	 * - Tout_Social_Buttons_Admin. Defines all hooks for the admin area.
	 * - Tout_Social_Buttons_Public. Defines all hooks for the public side of the site.
	 *
	 * Create an instance of the loader which will be used to register the hooks
	 * with WordPress.
	 *
	 * @since 		1.0.0
	 * @access 		private
	 */
	private function load_dependencies() {

		/**
		 * The class responsible for orchestrating the actions and filters of the
		 * core plugin.
		 */
		require_once plugin_dir_path( dirname( __FILE__ ) ) . 'includes/class-tout-social-buttons-loader.php';

		/**
		 * The class responsible for defining internationalization functionality
		 * of the plugin.
		 */
		require_once plugin_dir_path( dirname( __FILE__ ) ) . 'includes/class-tout-social-buttons-i18n.php';

		/**
		 * The class responsible for defining all actions that occur in the admin area.
		 */
		require_once plugin_dir_path( dirname( __FILE__ ) ) . 'admin/class-tout-social-buttons-admin.php';

		/**
		 * The class responsible for defining a generic tout button.
		 */
		require_once plugin_dir_path( dirname( __FILE__ ) ) . 'buttons/class-tout-social-button.php';

		/**
		 * The class responsible for defining the Baidu tout button.
		 */
		require_once plugin_dir_path( dirname( __FILE__ ) ) . 'buttons/class-tout-social-button-baidu.php';

		/**
		 * The class responsible for defining the Buffer tout button.
		 */
		require_once plugin_dir_path( dirname( __FILE__ ) ) . 'buttons/class-tout-social-button-buffer.php';

		/**
		 * The class responsible for defining the Digg tout button.
		 */
		require_once plugin_dir_path( dirname( __FILE__ ) ) . 'buttons/class-tout-social-button-digg.php';

		/**
		 * The class responsible for defining the Douban tout button.
		 */
		require_once plugin_dir_path( dirname( __FILE__ ) ) . 'buttons/class-tout-social-button-douban.php';

		/**
		 * The class responsible for defining the Email tout button.
		 */
		require_once plugin_dir_path( dirname( __FILE__ ) ) . 'buttons/class-tout-social-button-email.php';

		/**
		 * The class responsible for defining the Evernote tout button.
		 */
		require_once plugin_dir_path( dirname( __FILE__ ) ) . 'buttons/class-tout-social-button-evernote.php';

		/**
		 * The class responsible for defining the Facebook tout button.
		 */
		require_once plugin_dir_path( dirname( __FILE__ ) ) . 'buttons/class-tout-social-button-facebook.php';

		/**
		 * The class responsible for defining the Google+ tout button.
		 */
		require_once plugin_dir_path( dirname( __FILE__ ) ) . 'buttons/class-tout-social-button-google.php';

		/**
		 * The class responsible for defining the LinkedIn tout button.
		 */
		require_once plugin_dir_path( dirname( __FILE__ ) ) . 'buttons/class-tout-social-button-linkedin.php';

		/**
		 * The class responsible for defining the Pinterest tout button.
		 */
		require_once plugin_dir_path( dirname( __FILE__ ) ) . 'buttons/class-tout-social-button-pinterest.php';

		/**
		 * The class responsible for defining the QZone tout button.
		 */
		require_once plugin_dir_path( dirname( __FILE__ ) ) . 'buttons/class-tout-social-button-qzone.php';

		/**
		 * The class responsible for defining the Reddit tout button.
		 */
		require_once plugin_dir_path( dirname( __FILE__ ) ) . 'buttons/class-tout-social-button-reddit.php';

		/**
		 * The class responsible for defining the Renren tout button.
		 */
		require_once plugin_dir_path( dirname( __FILE__ ) ) . 'buttons/class-tout-social-button-renren.php';

		/**
		 * The class responsible for defining the Stumbleupon tout button.
		 */
		require_once plugin_dir_path( dirname( __FILE__ ) ) . 'buttons/class-tout-social-button-stumbleupon.php';

		/**
		 * The class responsible for defining the tumblr tout button.
		 */
		require_once plugin_dir_path( dirname( __FILE__ ) ) . 'buttons/class-tout-social-button-tumblr.php';

		/**
		 * The class responsible for defining the Twitter tout button.
		 */
		require_once plugin_dir_path( dirname( __FILE__ ) ) . 'buttons/class-tout-social-button-twitter.php';

		/**
		 * The class responsible for defining the VK tout button.
		 */
		require_once plugin_dir_path( dirname( __FILE__ ) ) . 'buttons/class-tout-social-button-vk.php';

		/**
		 * The class responsible for defining the Weibo tout button.
		 */
		require_once plugin_dir_path( dirname( __FILE__ ) ) . 'buttons/class-tout-social-button-weibo.php';

		/**
		 * The class responsible for defining the Xing tout button.
		 */
		require_once plugin_dir_path( dirname( __FILE__ ) ) . 'buttons/class-tout-social-button-xing.php';

		/**
		 * The class responsible for defining all actions that occur in the public-facing
		 * side of the site.
		 */
		require_once plugin_dir_path( dirname( __FILE__ ) ) . 'public/class-tout-social-buttons-public.php';

		/**
		 * The class responsible for defining the sanitization actions.
		 */
		require_once plugin_dir_path( dirname( __FILE__ ) ) . 'includes/class-tout-social-buttons-sanitize.php';

		/**
		 * The class responsible for defining a form field.
		 */
		require_once( plugin_dir_path( dirname( __FILE__ ) ) . 'fields/class-tout-social-buttons-field.php' );

		/**
		 * The class responsible for defining the buttons form field.
		 */
		require_once( plugin_dir_path( dirname( __FILE__ ) ) . 'fields/class-tout-social-buttons-field-buttons.php' );

		/**
		 * The class responsible for defining a checkbox form field.
		 */
		require_once( plugin_dir_path( dirname( __FILE__ ) ) . 'fields/class-tout-social-buttons-field-checkbox.php' );

		/**
		 * The class responsible for defining a hidden form field.
		 */
		require_once( plugin_dir_path( dirname( __FILE__ ) ) . 'fields/class-tout-social-buttons-field-hidden.php' );

		/**
		 * The class responsible for defining a select form field.
		 */
		require_once( plugin_dir_path( dirname( __FILE__ ) ) . 'fields/class-tout-social-buttons-field-select.php' );

		/**
		 * The class responsible for defining a text form field.
		 */
		require_once( plugin_dir_path( dirname( __FILE__ ) ) . 'fields/class-tout-social-buttons-field-text.php' );

		/**
		 * The class responsible for defining all actions for saving the button order via AJAX.
		 */
		require_once plugin_dir_path( dirname( __FILE__ ) ) . 'admin/class-tout-social-buttons-admin-ajax-save-buttons.php';

		$this->loader = new Tout_Social_Buttons_Loader();

	} // load_dependencies()

	/**
	 * Define the locale for this plugin for internationalization.
	 *
	 * Uses the Tout_Social_Buttons_i18n class in order to set the domain and to register the hook
	 * with WordPress.
	 *
	 * @since 		1.0.0
	 * @access 		private
	 */
	private function set_locale() {

		$plugin_i18n = new Tout_Social_Buttons_i18n();

		$this->loader->add_action( 'plugins_loaded', $plugin_i18n, 'load_plugin_textdomain' );

	} // set_locale()

	/**
	 * Register all of the hooks related to the admin area functionality
	 * of the plugin.
	 *
	 * @since 		1.0.0
	 * @access 		private
	 */
	private function define_admin_hooks() {

		$plugin_admin = new Tout_Social_Buttons_Admin( $this->get_plugin_name(), $this->get_version() );

		$this->loader->add_action( 'activated_plugin', 		$plugin_admin, 'save_activation_errors' );
		$this->loader->add_action( 'admin_notices', 		$plugin_admin, 'activation_error_notice' );
		$this->loader->add_action( 'admin_enqueue_scripts', $plugin_admin, 'enqueue_styles' );
		$this->loader->add_action( 'admin_enqueue_scripts', $plugin_admin, 'enqueue_scripts' );
		$this->loader->add_action( 'admin_enqueue_scripts', $plugin_admin, 'localize_scripts' );
		$this->loader->add_action( 'admin_init', 			$plugin_admin, 'register_settings' );
		$this->loader->add_action( 'admin_init', 			$plugin_admin, 'register_fields' );
		$this->loader->add_action( 'admin_init', 			$plugin_admin, 'register_sections' );
		$this->loader->add_action( 'admin_menu', 			$plugin_admin, 'add_menu' );
		$this->loader->add_action( 'plugin_action_links_' . TOUT_SOCIAL_BUTTONS_FILE, $plugin_admin, 'link_settings' );

	} // define_admin_hooks()

	/**
	 * Register all of the hooks related to the AJAX processes for saving the
	 * button order.
	 *
	 * @since 		1.0.0
	 * @access 		private
	 */
	private function define_ajax_hooks() {

		$plugin_ajax = new Tout_Social_Buttons_AJAX_Save_Buttons( $this->get_plugin_name(), $this->get_version() );

		$this->loader->add_action( 'wp_ajax_save_button_order', $plugin_ajax, 'save_button_order' );
		$this->loader->add_action( 'wp_ajax_save_button_selection', $plugin_ajax, 'save_button_selection' );
		$this->loader->add_action( 'wp_ajax_save_button_type', $plugin_ajax, 'save_button_type' );

	} // define_ajax_hooks()

	/**
	 * Register all of the hooks related to the public-facing functionality
	 * of the plugin.
	 *
	 * @since 		1.0.0
	 * @access 		private
	 */
	private function define_public_hooks() {

		$plugin_public = new Tout_Social_Buttons_Public( $this->get_plugin_name(), $this->get_version() );

		$this->loader->add_action( 'wp_enqueue_scripts', 	$plugin_public, 'enqueue_styles' );
		$this->loader->add_action( 'wp_enqueue_scripts', 	$plugin_public, 'enqueue_scripts' );
		$this->loader->add_filter( 'the_content', 			$plugin_public, 'add_buttons_to_content', 19, 1 );
		$this->loader->add_action( 'init', 					$plugin_public, 'register_shortcode' );
		//$this->loader->add_action( 'wp_footer', 			$plugin_public, 'inline_scripts' );

		/**
		 * Action instead of template tag.
		 *
		 * Usage:
		 * do_action( 'toutbuttons' );
		 *
		 * @link 		http://nacin.com/2010/05/18/rethinking-template-tags-in-plugins/
		 */
		$this->loader->add_action( 'toutbuttons', 			$plugin_public, 'display_buttons' );

	} // define_public_hooks()

	/**
	 * Run the loader to execute all of the hooks with WordPress.
	 *
	 * @since 		1.0.0
	 */
	public function run() {
		$this->loader->run();
	}

	/**
	 * The name of the plugin used to uniquely identify it within the context of
	 * WordPress and to define internationalization functionality.
	 *
	 * @since 		1.0.0
	 * @return 		string 		The name of the plugin.
	 */
	public function get_plugin_name() {
		return $this->plugin_name;
	}

	/**
	 * The reference to the class that orchestrates the hooks with the plugin.
	 *
	 * @since 		1.0.0
	 * @return 		Tout_Social_Buttons_Loader 		Orchestrates the hooks of the plugin.
	 */
	public function get_loader() {
		return $this->loader;
	}

	/**
	 * Retrieve the version number of the plugin.
	 *
	 * @since 		1.0.0
	 * @return 		string 		The version number of the plugin.
	 */
	public function get_version() {
		return $this->version;
	}

} // class
