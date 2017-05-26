<?php

/**
 * Provide a public-facing view for the plugin
 *
 * This file is used to markup the public-facing aspects of the plugin.
 *
 * @link       https://www.slushman.com
 * @since      1.0.0
 *
 * @package    Tout_Buttons
 * @subpackage Tout_Buttons/public/partials
 */

?><div class="tout-buttons-wrap">
	<span class="tout-buttons-pretext"><?php

		/**
		 * The tout_buttons_pretext filter.
		 */
		echo apply_filters( 'tout_buttons_pretext', esc_html__( 'Share This:', 'tout-buttons' ) );

	?></span>
	<ul class="tout-buttons-list"><?php

		foreach ( $buttons as $lower => $button ) :

			$class 	= $this->get_button_class( $lower );
			$url 	= $this->get_url( $lower );

			?><a class="<?php echo esc_attr( $class ); ?>" href="<?php echo esc_url( $url ); ?>" rel="nofollow">
				<span class="screen-reader-text"><?php

					echo $this->shared->get_screen_reader_text( $button );

				?></span><?php

				echo $this->shared->get_label( $lower );

			?></a><?php

		endforeach;

	?></ul><!-- .tout-buttons-list -->
</div><!-- .tout-buttons-wrap -->
