<?php

/**
* The HTML for the single social buttons.
*/

$class_name = 'Tout_Button_' . $button;
$instance 	= new $class_name;

?><li class="tout-btn-wrap" data-id="<?php echo esc_attr( $button ); ?>" id="tout-btn-<?php echo esc_attr( $button ); ?>" title="<?php echo esc_attr( $button ); ?>">
	<label class="tout-btn tout-btn-<?php echo esc_attr( $button ); if ( $instance->is_active() ) { echo esc_attr( ' checked' ); } ?>" for="<?php echo $button; ?>">
		<input type="hidden" value="0" name="<?php echo TOUT_BUTTONS_SLUG; ?>-settings[button-<?php echo $button; ?>]" />
		<input <?php checked( 1, $this->settings['button-' . $button], true ); ?> class="tout-btn-checkbox" id="tout-button-checkbox-<?php echo $button; ?>" name="<?php echo TOUT_BUTTONS_SLUG; ?>-settings[button-<?php echo $button; ?>]" type="checkbox" value="1" />
		<span class="screen-reader-text"><?php

			echo $instance->get_a11y_text();

		?></span><?php

		echo $instance->get_icon();

	?></label>
</li>
