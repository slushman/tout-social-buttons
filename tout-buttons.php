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
 * @package           Tout_Buttons
 *
 * @wordpress-plugin
 * Plugin Name:       Tout Buttons
 * Plugin URI:        https://www.slushman.com/tout-buttons
 * Description:       Adds social sharing buttons to your posts.
 * Version:           1.0.0
 * Author:            Slushman
 * Author URI:        https://www.slushman.com
 * License:           GPL-2.0+
 * License URI:       http://www.gnu.org/licenses/gpl-2.0.txt
 * Text Domain:       tout-buttons
 * Domain Path:       /languages
 *
 * @todo 		Public: Add modal for sharing.
 * @todo 		Public: Add pop-up window for sharing.
 *
 * PRO Version
 * @todo 		Shortcode: add options for sharing specific content within the shortcode.
 *         			blockquotes
 * @todo 		Design: more options for the button designs - square, circle, etc
 * @todo 		Public: Side pop-out menu sharing window option - like time.com
 * @todo 		Admin Option: tab of post types (public only) where the share buttons should appear.
 * @todo 		Public: show the buttons, in the correct order, on selected  post types
 *
 * Analytics Add-on
 * @todo 		Analytics: separate tab. Show each link and its share count.
 * @todo 		Analytics: each post has a metabox showing each share: time, date, and where.
 *
 * Schedule Add-on:
 * Adds the ability to schedule social media posts. You can schedule social media posts when writing posts
 * 	and have them auto-publish those posts, so your content marketing efforts are on-going.
 * Posts can be re-published on your social feeds at a custom or pre-chosen schedule based on best practices.
 *
 * @todo 		Admin: add options for sharing particular content on your social networks
 *         				on a schedule. Uses WP-Cron to schedule the social post.
 * @todo 		Admin: add the ability to schedule social media posts on a chosen schedule.
 * @todo 		Admin: add the ability to schedule social media posts on a custom schedule.
 * @todo 		Admin: add login and API bridges for each social network.
 */

// If this file is called directly, abort.
if ( ! defined( 'WPINC' ) ) {
	die;
}

define( 'TOUT_BUTTONS_FILE', plugin_basename( __FILE__ ) );
define( 'TOUT_BUTTONS_SLUG', 'tout-buttons' );
define( 'TOUT_BUTTONS_SETTINGS', 'tout-buttons-settings' );

/**
 * The code that runs during plugin activation.
 * This action is documented in includes/class-tout-buttons-activator.php
 */
function activate_tout_buttons() {
	require_once plugin_dir_path( __FILE__ ) . 'includes/class-tout-buttons-activator.php';
	Tout_Buttons_Activator::activate();
}

/**
 * The code that runs during plugin deactivation.
 * This action is documented in includes/class-tout-buttons-deactivator.php
 */
function deactivate_tout_buttons() {
	require_once plugin_dir_path( __FILE__ ) . 'includes/class-tout-buttons-deactivator.php';
	Tout_Buttons_Deactivator::deactivate();
}

register_activation_hook( __FILE__, 'activate_tout_buttons' );
register_deactivation_hook( __FILE__, 'deactivate_tout_buttons' );

/**
 * The core plugin class that is used to define internationalization,
 * admin-specific hooks, and public-facing site hooks.
 */
require plugin_dir_path( __FILE__ ) . 'includes/class-tout-buttons.php';

/**
 * Begins execution of the plugin.
 *
 * Since everything within the plugin is registered via hooks,
 * then kicking off the plugin from this point in the file does
 * not affect the page life cycle.
 *
 * @since    1.0.0
 */
function run_tout_buttons() {

	$plugin = new Tout_Buttons();
	$plugin->run();

}
run_tout_buttons();
