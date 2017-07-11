<?php

/**
 * Fired during plugin activation
 *
 * @link 		https://www.slushman.com
 * @since 		1.0.0
 *
 * @package 	Tout_Social_Buttons
 * @subpackage 	Tout_Social_Buttons/includes
 */

/**
 * Fired during plugin activation.
 *
 * This class defines all code necessary to run during the plugin's activation.
 *
 * @since 		1.0.0
 * @package 	Tout_Social_Buttons
 * @subpackage 	Tout_Social_Buttons/includes
 * @author 		Slushman <chris@slushman.com>
 */
class Tout_Social_Buttons_Activator {



	/**
	 * Short Description. (use period)
	 *
	 * Long Description.
	 *
	 * @since 		1.0.0
	 */
	public static function activate() {

		require_once plugin_dir_path( dirname( __FILE__ ) ) . 'admin/class-tout-social-buttons-admin.php';

		$opts 		= array();
		$options 	= Tout_Social_Buttons_Admin::get_settings_list();

		foreach ( $options as $option ) {

			$opts[ $option[0] ] = $option[2];

		} // foreach

		update_option( TOUT_BUTTONS_SETTINGS, $opts  );

	} // activate()

} // class
