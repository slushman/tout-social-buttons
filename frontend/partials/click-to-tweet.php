<?php

/**
 * Provides a public-facing view for the clicktotweet shortcode.
 *
 * @link 			https://www.slushman.com
 * @since 			1.0.0
 * @package 		ToutSocialButtons\Frontend
 */

?><div class="click-to-tweet-wrap <?php echo esc_attr( $this->customizer['clicktotweet_style'] ); ?>">
	<blockquote class="click-to-tweet-quote"><?php

		echo esc_html( $content );

	?></blockquote>
	<div class="click-to-tweet-action">
		<a class="click-to-tweet-link" href="<?php echo esc_url( $twitter->get_url(), $twitter->get_protocols() ); ?>" rel="nofollow">
			<span class="click-to-tweet-text"><?php

				/**
				 * The tout_social_buttons_clicktotweet_text filter.
				 *
				 * @var 		string 		The current Click to Tweet text.
				 */
				echo apply_filters( 'tout_social_buttons_clicktotweet_text', esc_html__( 'Click to Tweet', 'tout-social-buttons' ) );

			?></span>
			<span class="click-to-tweet-icon"><?php

				echo $twitter->get_icon();

			?></span>
		</a>
	</div>
</div>
