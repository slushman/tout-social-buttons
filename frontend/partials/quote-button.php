<?php

/**
 * Provides a public-facing view for the plugin
 *
 * This file is used to markup each button for a blockquote.
 *
 * @link       https://www.slushman.com
 * @since      1.0.0
 * @package    ToutSocialButtons\Frontend
 */

?><a class="<?php echo esc_attr( $this->quote_button_link_classes( $button ) ); ?>" href="<?php echo esc_url( $instance->get_url(), $instance->get_protocols() ); ?>" rel="nofollow"<?php

	echo $this->get_quote_button_link_attributes( $button );

	?> title="<?php echo esc_attr( $instance->get_title() ); ?>">
	<span class="<?php echo esc_attr( $this->quote_button_icon_wrap_classes( $button, $instance ) ); ?>"><?php

		echo $instance->get_icon();

	?></span>
	<span class="screen-reader-text"><?php

		echo $instance->get_a11y_text();

	?></span>
	<span class="<?php echo esc_attr( $this->quote_button_text_classes( $button, $instance ) ); ?>"><?php

		echo $this->get_text( $button, $instance );

	?></span>
</a>
