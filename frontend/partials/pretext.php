<?php

/**
 * Provide a frontend view for the plugin
 *
 * This file is used to markup the frontend aspects of the plugin.
 *
 * @link       https://www.slushman.com
 * @since      1.0.0
 * @package    ToutSocialButtons\Frontend
 */

?><span class="tout-social-buttons-pretext"><?php

	/**
	 * The tout_social_buttons_pretext filter.
	 */
	echo apply_filters( 'tout_social_buttons_pretext', esc_html__( 'Share This:', 'tout-social-buttons' ) );

?></span>
