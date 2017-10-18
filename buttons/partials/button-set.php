<?php

/**
 * Provide a view for the button set.
 *
 * @link       https://www.slushman.com
 * @since      1.0.0
 * @package    ToutSocialButtons\Buttons
 */

?><div class="<?php echo esc_attr( $this->get_button_set_wrap_classes() ); ?>"><?php

	/**
	 * The tout_social_buttons_set_wrap_begin action.
	 *
	 * @hooked 		Frontend\pretext 		10
	 *
	 * @param 		string 		$context 		Where this is being used.
	 */
	do_action( 'tout_social_buttons_set_wrap_begin', $this->context );

	?><ul class="<?php echo esc_attr( $this->get_button_set_classes() ); ?>" id="<?php echo esc_attr( $this->get_button_set_id() ); ?>"><?php

		/**
		 * The tout_social_buttons_button_set_begin action.
		 *
		 * @param 		string 		$context 		Where this is being used.
		 */
		do_action( 'tout_social_buttons_button_set_begin', $this->context );

		if ( ! empty( $this->buttons ) ) {

			foreach ( $this->buttons as $button => $instance ) :

				include( TOUT_SOCIAL_BUTTONS_PATH . 'buttons/partials/button.php' );

			endforeach;

		}

		/**
		 * The tout_social_buttons_button_set_end action.
		 *
		 * @param 		string 		$context 		Where this is being used.
		 */
		do_action( 'tout_social_buttons_button_set_end', $this->context );

	?></ul><!-- .tout-social-buttons-list --><?php

	/**
	 * The tout_social_buttons_set_wrap_end action.
	 *
	 * @param 		string 		$context 		Where this is being used.
	 */
	do_action( 'tout_social_buttons_set_wrap_end', $this->context );

?></div><!-- .tout-social-buttons-wrap -->
