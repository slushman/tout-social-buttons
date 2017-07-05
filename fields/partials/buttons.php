<?php

/**
* The HTML for the set of social buttons.
*/

?><ul class="tout-buttons" id="tout-btn-sort"><?php

foreach ( $this->shared->get_button_array() as $lower => $button ) :

	?><li class="tout-btn-wrap <?php echo esc_attr( $this->settings['button-type'] ); ?>" data-id="<?php echo esc_attr( $lower ); ?>" id="tout-btn-<?php echo esc_attr( $lower ); ?>" title="<?php echo esc_attr( $button ); ?>">
		<label class="tout-btn tout-btn-<?php echo esc_attr( $lower ); if ( 1 === $this->settings['button-' . $lower] ) { echo esc_attr( ' checked' ); } ?>" for="<?php echo $lower; ?>">
			<input type="hidden" value="0" name="<?php echo TOUT_BUTTONS_SLUG; ?>-settings[button-<?php echo $lower; ?>]" />
			<input <?php checked( 1, $this->settings['button-' . $lower], true ); ?> class="tout-btn-checkbox" id="tout-button-checkbox-<?php echo $lower; ?>" name="<?php echo TOUT_BUTTONS_SLUG; ?>-settings[button-<?php echo $lower; ?>]" type="checkbox" value="1" />
			<span class="screen-reader-text"><?php

				echo $this->get_screen_reader_text( $button );

			?></span><?php

			echo $this->shared->get_svg( $lower );

		?></label>
	</li><?php

endforeach;

?></ul>
<input id="tout-button-order" name="<?php echo TOUT_BUTTONS_SLUG; ?>-settings[button-order]" type="hidden" value="<?php echo esc_attr( $this->settings['button-order'] ); ?>" />
<div class="button-status"></div>
