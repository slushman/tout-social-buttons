<?php

/**
 * Provides the markup for a section in the plugin settings
 *
 * @since 			1.0.0
 * @package 		Tout_Social_Buttons
 * @subpackage 		Tout_Social_Buttons/admin/partials
 */

?><p><?php

	if ( ! empty( $params['description'] ) ) {

		echo esc_html( $params['description'] );

	}

?></p>
