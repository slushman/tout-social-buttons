<?php

/**
 * Provides markup for each individual button within the set.
 *
 * @link       https://www.slushman.com
 * @since      1.0.0
 * @package    ToutSocialButtons\Buttons
 */

?><li class="<?php echo esc_attr( $this->get_button_classes( $button ) ); ?>" data-id="<?php echo esc_attr( $button ); ?>" data-name="<?php echo esc_attr( $instance->get_name() ); ?>">
	<a class="<?php echo esc_attr( $this->get_button_link_classes( $button ) ); ?>" href="<?php echo esc_url( $instance->get_url(), $instance->get_protocols() ); ?>" rel="nofollow"<?php

		echo $instance->get_link_attributes( $button );

		if ( ! empty( $this->settings['button-behavior'] ) && 'email' !== $button ) {

			echo ' target="_blank"';

		}

		?> title="<?php echo esc_attr( $instance->get_title() ); ?>"><?php

		echo $instance->get_icon( $this->context );

		?><span class="screen-reader-text"><?php

			echo $instance->get_a11y_text();

		?></span>
		<span class="<?php echo esc_attr( $this->get_button_text_classes( $instance ) ); ?>"><?php

			echo apply_filters( 'tout_social_buttons_button_text', $instance->get_name(), $instance, $this->context );

		?></span>
	</a>
</li>
