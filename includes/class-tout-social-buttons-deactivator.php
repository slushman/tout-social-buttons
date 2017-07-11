<?php

/**
 * Fired during plugin deactivation
 *
 * @link 		https://www.slushman.com
 * @since 		1.0.0
 *
 * @package		Tout_Social_Buttons
 * @subpackage	Tout_Social_Buttons/includes
 */

/**
 * Fired during plugin deactivation.
 *
 * This class defines all code necessary to run during the plugin's deactivation.
 *
 * @since 		1.0.0
 * @package 	Tout_Social_Buttons
 * @subpackage	Tout_Social_Buttons/includes
 * @author		Slushman <chris@slushman.com>
 */
class Tout_Social_Buttons_Deactivator {

	/**
	 * Removes plugin options from the database.
	 *
	 * @since 		1.0.0
	 */
	public static function deactivate() {

		delete_option( 'tout-social-buttons-settings' );
		delete_option( 'tout-social-buttons-errors' );

	} // deactivate()

} // class
