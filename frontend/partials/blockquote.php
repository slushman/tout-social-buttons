<?php

/**
 * Provides a public-facing view for the clicktotweet shortcode.
 *
 * @link 			https://www.slushman.com
 * @since 			1.0.0
 * @package 		ToutSocialButtons\Frontend
 */

?><div class="<?php echo esc_attr( $this->get_quote_wrap_classes() ); ?>">
	<blockquote class="<?php echo esc_attr( $this->get_quote_classes() ); ?>"><?php

		echo esc_html( $content );

	?></blockquote><?php

	if ( ! empty( $buttons ) ) {

		$this->set->set_buttons( $buttons );
		$this->set->output_button_set();

	}

?></div>
