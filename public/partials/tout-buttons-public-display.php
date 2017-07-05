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
			$reader = $this->shared->get_screen_reader_text( $button );

			?><li class="<?php echo esc_attr( $class ); ?>">
				<a class="tout-button-link" href="<?php echo esc_url( $url ); ?>" rel="nofollow"<?php

					if ( 'new' === $this->settings['button-behavior'] ) {

						echo ' target="_blank"';

					}

				?> title="<?php echo esc_attr( $reader ); ?>">
				<span class="screen-reader-text"><?php

					echo $reader;

				?></span><?php

				echo $this->shared->get_label( $lower );

				?></a>
			</li><?php

		endforeach;

	?></ul><!-- .tout-buttons-list -->
</div><!-- .tout-buttons-wrap -->
