<?php

/**
 * The ajax-specific functionality of the plugin.
 *
 * Handles the AJAX request for saving the button order in the admin.
 *
 * @link       https://www.slushman.com
 * @since      1.0.0
 * @package    ToutSocialButtons\Admin
 * @author     Slushman <chris@slushman.com>
 */

namespace ToutSocialButtons\Admin;

class Ajax_Save_Buttons {

	/**
	 * The plugin settings.
	 *
	 * @since 		1.0.0
	 * @access 		private
	 * @var 		string 			$settings 		The plugin settings.
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

		add_action( 'admin_enqueue_scripts', 				array( $this, 'localize_scripts' ) );
		add_action( 'wp_ajax_save_button_orders', 			array( $this, 'save_button_orders' ) );

	} // hooks()

	/**
	 * Sends localization strings to scripts.
	 *
	 * @hooked 		admin_enqueue_scripts
	 * @since 		1.0.0
	 * @param 		string 		$hook_suffix 		The current admin page.
	 */
	public function localize_scripts( $hook_suffix ) {

		wp_localize_script(
			TOUT_SOCIAL_BUTTONS_SLUG . '-admin',
			'Tout_Social_Buttons_Ajax',
			array(
				'toutButtonNonce' 		=> wp_create_nonce( 'tout-social-buttons-order-nonce' )
			)
		);

	} // localize_scripts()

	/**
	 * Saves the active and inactive buttons in order via AJAX.
	 *
	 * @hooked 		wp_ajax_save_button_orders
	 * @since 		1.0.0
	 */
	public function save_button_orders() {

		check_ajax_referer( 'tout-social-buttons-order-nonce', 'toutButtonNonce' );

		$active 							= $_POST['active'];
		$inactive 							= $_POST['inactive'];
		$this->settings['active-buttons']	= $active;
		$this->settings['inactive-buttons']	= $inactive;
		$update 							= update_option( TOUT_SOCIAL_BUTTONS_SETTINGS, $this->settings );

		if ( ! $update ) {

			wp_send_json_error( esc_html__( 'There was a problem saving the button orders.', 'tout-social-buttons' ) );

		} else {

			wp_send_json_success( json_encode( esc_html__( 'Button orders saved.', 'tout-social-buttons' ) ) );

		}

	} // save_button_orders()

	/**
	 * Sets the class variable $settings.
	 *
	 * @since 		1.0.0
	 */
	private function set_settings() {

		$this->settings = get_option( TOUT_SOCIAL_BUTTONS_SETTINGS );

	} // set_settings()

} // class
