<?php

/**
 * The plugin bootstrap file
 *
 * This file is read by WordPress to generate the plugin information in the plugin
 * admin area. This file also includes all of the dependencies used by the plugin,
 * registers the activation and deactivation functions, and defines a function
 * that starts the plugin.
 *
 * @link              https://www.slushman.com
 * @since             1.0.0
 * @package           ToutSocialButtons
 *
 * @wordpress-plugin
 * Plugin Name:       Tout.Social Buttons
 * Plugin URI:        https://www.tout.social
 * Description:       Adds social sharing buttons to your posts.
 * Version:           1.0.0
 * Author:            Slushman
 * Author URI:        https://www.slushman.com
 * License:           GPL-2.0+
 * License URI:       http://www.gnu.org/licenses/gpl-2.0.txt
 * Text Domain:       tout-social-buttons
 * Domain Path:       /languages
 *
 * @todo 		Blocks: add a Gutenblock for the buttons.
 * @todo 		Blocks: add a click-to-tweet Gutenblock for blockquote sharing
 *         			Is there already a blockquote block? Can we add an option that instead of creating another one?
 *
 * @todo 		ON HOLD. Figure out AJAX saving via Fetch API.
 */

use ToutSocialButtons\Includes as Inc;
use ToutSocialButtons\Admin;
use ToutSocialButtons\Frontend;
use ToutSocialButtons\Buttons as Buttons;
use ToutSocialButtons\Blocks as Blocks;

// If this file is called directly, abort.
if ( ! defined( 'WPINC' ) ) { die; }

/**
 * Define constants.
 */
define( 'TOUT_SOCIAL_BUTTONS_FILE', plugin_basename( __FILE__ ) );
define( 'TOUT_SOCIAL_BUTTONS_SLUG', 'tout-social-buttons' );
define( 'TOUT_SOCIAL_BUTTONS_SETTINGS', 'tout_social_buttons_settings' );
define( 'TOUT_SOCIAL_BUTTONS_VERSION', '1.0.0' );
define( 'TOUT_SOCIAL_BUTTON_CUSTOMIZER', 'tout_social_buttons' );
define( 'TOUT_SOCIAL_BUTTONS_PATH', plugin_dir_path( __FILE__ ) );

/**
 * Include the autoloader.
 */
require_once plugin_dir_path( __FILE__ ) . 'includes/class-autoloader.php';

/**
 * Activation and Deactivation Hooks.
 */
register_activation_hook( __FILE__, array( 'ToutSocialButtons\Includes\Activator', 'activate' ) );
register_deactivation_hook( __FILE__, array( 'ToutSocialButtons\Includes\Deactivator', 'deactivate' ) );

/**
 * Initializes each class and adds the hooks action in each to init.
 *
 * @global 		$tout_social_buttons
 */
function tout_social_buttons_init() {

	global $tout_social_buttons;

	$classes[] = new Inc\i18n();
	$classes[] = new Admin\Admin();
	$classes[] = new Admin\Ajax_Save_Buttons();
	$classes[] = new Admin\Customizer();
	$classes[] = new Frontend\Frontend();
	$classes[] = new Frontend\AutoPost();
	$classes[] = new Frontend\Shortcode_Clicktotweet();
	$classes[] = new Frontend\PinIt();
	//$classes[] = new Blocks\Blocks();

	$classes[] = $tout_social_buttons['email'] 			= new Buttons\Email();
	$classes[] = $tout_social_buttons['facebook'] 		= new Buttons\Facebook();
	$classes[] = $tout_social_buttons['google'] 		= new Buttons\Google();
	$classes[] = $tout_social_buttons['linkedin'] 		= new Buttons\LinkedIn();
	$classes[] = $tout_social_buttons['pinterest'] 		= new Buttons\Pinterest();
	$classes[] = $tout_social_buttons['stumbleupon'] 	= new Buttons\Stumbleupon();
	$classes[] = $tout_social_buttons['tumblr'] 		= new Buttons\tumblr();
	$classes[] = $tout_social_buttons['twitter'] 		= new Buttons\Twitter();

	foreach ( $classes as $class ) {

		add_action( 'init', array( $class, 'hooks' ) );

	}

} // tout_social_buttons_init()

add_action( 'plugins_loaded', 'tout_social_buttons_init' );
