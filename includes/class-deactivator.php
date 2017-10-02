<?php

/**
 * Fired during plugin deactivation
 *
 * This class defines all code necessary to run during the plugin's deactivation.
 *
 * @link 		https://www.slushman.com
 * @since 		1.0.0
 * @package		ToutSocialButtons\Includes
 * @author		Slushman <chris@slushman.com>
 */

namespace ToutSocialButtons\Includes;

class Deactivator {

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
