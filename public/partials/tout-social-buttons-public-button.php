<?php

/**
 * Provides a public-facing view for the plugin
 *
 * This file is used to markup each individual button within the set.
 *
 * @link       https://www.slushman.com
 * @since      1.0.0
 *
 * @package    Tout_Social_Buttons
 * @subpackage Tout_Social_Buttons/public/partials
 */

$class_name = 'Tout_Button_' . $button;
$instance 	= new $class_name;

?><li class="tout-button tout-button-<?php echo esc_attr( $button ); ?>" data-id="<?php echo esc_attr( $button ); ?>" data-name="<?php echo esc_attr( $instance->get_name() ); ?>">
	<a class="tout-button-link<?php

		if ( 'popup' === $this->settings['button-behavior'] ) {

			echo esc_attr( ' tout-button-popup-link' );

		}

		?>" href="<?php echo esc_url( $instance->get_url() ); ?>" rel="nofollow"<?php

		if ( ! empty( $this->settings['button-behavior'] ) && 'email' !== $button ) {

			echo ' target="_blank"';

		}

	?> title="<?php echo esc_attr( $instance->get_title() ); ?>">
	<span class="screen-reader-text"><?php

		echo $instance->get_a11y_text();

	?></span><?php

	echo $instance->get_type();

	?></a>
</li>
