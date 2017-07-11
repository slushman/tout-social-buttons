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
 * @package           Tout_Social_Buttons
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
 * Analytics Add-on
 * @todo 		Analytics: separate settings tab. Show each link and its share count on each network.
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

define( 'TOUT_SOCIAL_BUTTONS_FILE', plugin_basename( __FILE__ ) );
define( 'TOUT_SOCIAL_BUTTONS_SLUG', 'tout-social-buttons' );
define( 'TOUT_SOCIAL_BUTTONS_SETTINGS', 'tout-social-buttons-settings' );

/**
 * The code that runs during plugin activation.
 * This action is documented in includes/class-tout-social-buttons-activator.php
 */
function activate_tout_social_buttons() {
	require_once plugin_dir_path( __FILE__ ) . 'includes/class-tout-social-buttons-activator.php';
	Tout_Social_Buttons_Activator::activate();
}

/**
 * The code that runs during plugin deactivation.
 * This action is documented in includes/class-tout-social-buttons-deactivator.php
 */
function deactivate_tout_social_buttons() {
	require_once plugin_dir_path( __FILE__ ) . 'includes/class-tout-social-buttons-deactivator.php';
	Tout_Social_Buttons_Deactivator::deactivate();
}

register_activation_hook( __FILE__, 'activate_tout_social_buttons' );
register_deactivation_hook( __FILE__, 'deactivate_tout_social_buttons' );

/**
 * The core plugin class that is used to define internationalization,
 * admin-specific hooks, and public-facing site hooks.
 */
require plugin_dir_path( __FILE__ ) . 'includes/class-tout-social-buttons.php';

/**
 * Begins execution of the plugin.
 *
 * Since everything within the plugin is registered via hooks,
 * then kicking off the plugin from this point in the file does
 * not affect the page life cycle.
 *
 * @since    1.0.0
 */
function run_tout_social_buttons() {

	$plugin = new Tout_Social_Buttons();
	$plugin->run();

}
run_tout_social_buttons();
