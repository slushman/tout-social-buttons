<?php

/**
 * The ajax-specific functionality of the plugin.
 *
 * @link       https://www.slushman.com
 * @since      1.0.0
 *
 * @package    Tout_Buttons
 * @subpackage Tout_Buttons/admin
 */

/**
 * The ajax-specific functionality of the plugin.
 *
 * Handles the AJAX request for saving the button order in the admin.
 *
 * @package    Tout_Buttons
 * @subpackage Tout_Buttons/admin
 * @author     Slushman <chris@slushman.com>
 */
class Tout_Buttons_AJAX_Save_Buttons {

	/**
	 * The plugin settings.
	 *
	 * @since 		1.0.0
	 * @access 		private
	 * @var 		string 			$settings 		The plugin settings.
	 */
	private $settings;

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

		//$this->set_settings();

	} // __construct()

	/**
	 * Saves the button order when buttons are sorted.
	 * Request comes through AJAX.
	 *
	 * @since 		1.0.0
	 */
	public function save_button_order() {

		echo 'yep';

		wp_die();

		//check_ajax_referer( 'tout-buttons-ajax-nonce', 'tbboNonce' );

		//$order 							= $this->settings['button-order'];
		$new_order 					= $_POST['order'];
		$new_order_string 			= implode( ',', $new_order );
		$settings 					= get_option( 'tout-buttons-settings' );
		$settings['button-order'] 	= $new_order_string;
		$update 					= update_option( 'tout-buttons-settings', $settings );

		if ( ! $update ) {

			esc_html_e( 'There was a problem saving the button order.', 'tout-buttons' );

		} else {

			esc_html_e( 'Button order saved.', 'tout-buttons' );

		}

		wp_die();

	} // save_button_order()

	/**
	 * Sets the class variable $settings.
	 *
	 * @since 		1.0.0
	 */
	private function set_settings() {

		$this->settings = get_option( TOUT_BUTTONS_SETTINGS );

	} // set_settings()

} // class
