<?php

/**
 * Provide a public-facing view for the plugin
 *
 * This file is used to markup the public-facing aspects of the plugin.
 *
 * @link       https://www.slushman.com
 * @since      1.0.0
 *
 * @package    Tout_Social_Buttons
 * @subpackage Tout_Social_Buttons/public/partials
 */

?><div class="tout-social-buttons-wrap">
	<span class="tout-social-buttons-pretext"><?php

		/**
		 * The tout_social_buttons_pretext filter.
		 */
		echo apply_filters( 'tout_social_buttons_pretext', esc_html__( 'Share This:', 'tout-social-buttons' ) );

	?></span>
	<ul class="<?php echo esc_attr( $this->get_button_set_classes() ); ?>" id="tout-social-buttons"><?php

		foreach ( $this->buttons as $button ) :

			include( plugin_dir_path( dirname( __FILE__ ) ) . 'partials/tout-social-buttons-public-button.php' );

		endforeach;

	?></ul><!-- .tout-social-buttons-list -->
</div><!-- .tout-social-buttons-wrap -->
