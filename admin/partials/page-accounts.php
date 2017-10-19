<?php

/**
 * Provide a admin area view for the plugin
 *
 * This file is used to markup the admin-facing aspects of the plugin.
 *
 * @link 			https://developer.wordpress.org/reference/functions/settings_fields/
 * @link 			https://developer.wordpress.org/reference/functions/do_settings_sections/
 * @link 			https://developer.wordpress.org/reference/functions/submit_button/
 * @since 			1.0.0
 * @package 		ToutSocialButtons\Admin
 */

?><div class="wrap">
	<h1><?php echo esc_html( get_admin_page_title() ); ?></h1>
	<form method="post" action="options.php"><?php

		settings_fields( TOUT_SOCIAL_BUTTONS_SETTINGS . '_accounts' );

		do_settings_sections( TOUT_SOCIAL_BUTTONS_SETTINGS . '_accounts' );

		submit_button( 'Save Settings' );

	?></form>
</div><!-- .wrap -->
