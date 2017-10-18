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

		$set = new \ToutSocialButtons\Buttons\Button_Set( $this->context, $buttons );

	}

?></div>
