<?php

/**
 * Define the internationalization functionality
 *
 * Loads and defines the internationalization files for this plugin
 * so that it is ready for translation.
 *
 * @link 		https://www.slushman.com
 * @since 		1.0.0
 *
 * @package		Tout_Social_Buttons
 * @subpackage	Tout_Social_Buttons/includes
 */

/**
 * Define the internationalization functionality.
 *
 * Loads and defines the internationalization files for this plugin
 * so that it is ready for translation.
 *
 * @since 		1.0.0
 * @package 	Tout_Social_Buttons
 * @subpackage	Tout_Social_Buttons/includes
 * @author 		Slushman <chris@slushman.com>
 */
class Tout_Social_Buttons_i18n {


	/**
	 * Load the plugin text domain for translation.
	 *
	 * @since 		1.0.0
	 */
	public function load_plugin_textdomain() {

		load_plugin_textdomain(
			'tout-social-buttons',
			false,
			dirname( dirname( plugin_basename( __FILE__ ) ) ) . '/languages/'
		);

	} // load_plugin_textdomain()

} // class
