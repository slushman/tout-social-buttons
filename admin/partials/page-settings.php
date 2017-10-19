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
/*
?><div class="wrap">
	<h1><?php echo esc_html( get_admin_page_title() ); ?></h1><?php

	$active_tab = $this->get_active_tab();

	/**
	 * Add tabs, if needed.
	 *
	if ( 1 < count( $this->tabs ) ) :

		?><h2 class="nav-tab-wrapper"><?php

			foreach ( $this->tabs as $tab_slug => $tab ) :

				?><a href="<?php

					echo esc_url( $tab['url'] );

				?>" class="nav-tab<?php

					if ( $tab_slug === $active_tab ) { echo ' nav-tab-active'; }

				?>"><?php echo esc_html( $tab['name'] ) ?></a><?php

			endforeach;

		?></h2><?php

	endif;

	?><form method="post" action="options.php"><?php

		// global $wp_settings_sections;
		//
		// echo '<pre>'; print_r( $wp_settings_sections ); echo '</pre>';
		//
		// echo '<pre>'; print_r( $this->tabs[$active_tab] ); echo '</pre>';

		settings_fields( $this->tabs[$active_tab]['fields'] );

		do_settings_sections( $this->tabs[$active_tab]['sections'] );

		submit_button( 'Save Settings' );

	?></form>
</div><!-- .wrap --><?php
*/

?><div class="wrap">
	<h1><?php echo esc_html( get_admin_page_title() ); ?></h1>
	<form method="post" action="options.php"><?php

		settings_fields( TOUT_SOCIAL_BUTTONS_SETTINGS );

		do_settings_sections( TOUT_SOCIAL_BUTTONS_SETTINGS );

		submit_button( 'Save Settings' );

	?></form>
</div><!-- .wrap --><?php
