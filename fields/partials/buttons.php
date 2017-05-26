<?php

/**
* The HTML for the set of social buttons.
*/

?><ul id="tout-btn-sort"><?php

foreach ( $this->shared->get_button_array() as $lower => $button ) :

	echo '<pre>'; print_r( $lower ); echo '</pre>';
	echo '<pre>'; print_r( $button ); echo '</pre>';

	?><li class="tout-btn-wrap" data-id="<?php echo esc_attr( $button ); ?>" id="tout-btn-<?php echo esc_attr( $lower ); ?>" title="<?php echo esc_attr( $button ); ?>">
		<input <?php checked( 1, $this->settings['button-' . $lower], true ); ?> class="tout-btn-handle" id="tout-button-checkbox-<?php echo $lower; ?>" name="<?php echo TOUT_BUTTONS_SLUG; ?>-settings[button-<?php echo $lower; ?>]" type="checkbox" value="1" />
		<label class="tout-btn tout-btn-<?php echo esc_attr( $lower ); ?>" for="<?php echo $lower; ?>">
			<span class="screen-reader-text"><?php

				echo $this->shared->get_screen_reader_text( $button );

			?></span><?php

			echo $this->shared->get_label( $lower );

		?></label>
	</li><?php

endforeach;

?></ul>
