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

?><div class="tout-social-buttons-wrap"><?php

	/**
	 * The tout_social_buttons_button_set_wrap_begin action.
	 *
	 * @hooked 		pretext
	 */
	do_action( 'tout_social_buttons_button_set_wrap_begin' );

	?><ul class="<?php echo esc_attr( $this->get_button_set_classes() ); ?>" id="tout-social-buttons"><?php

		/**
		 * The tout_social_buttons_button_set_begin action.
		 */
		do_action( 'tout_social_buttons_button_set_begin' );

		foreach ( $buttons as $button => $instance ) :

			$this->display_button( $button );

		endforeach;

		/**
		 * The tout_social_buttons_button_set_end action.
		 */
		do_action( 'tout_social_buttons_button_set_end' );

	?></ul><!-- .tout-social-buttons-list --><?php

	/**
	 * The tout_social_buttons_button_set_wrap_end action.
	 */
	do_action( 'tout_social_buttons_button_set_wrap_end' );

?></div><!-- .tout-social-buttons-wrap -->
