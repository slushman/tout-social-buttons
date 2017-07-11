<?php

/**
* The HTML for the set of social buttons.
*/

?><ul class="tout-social-buttons" id="tout-social-button-sort"><?php

	foreach ( $this->buttons as $key => $button ) :

		include( plugin_dir_path( dirname( __FILE__ ) ) . 'partials/button.php' );

	endforeach;

?></ul>
<input id="tout-social-button-order" name="<?php echo TOUT_BUTTONS_SLUG; ?>-settings[button-order]" type="hidden" value="<?php echo esc_attr( $this->settings['button-order'] ); ?>" />
<div class="button-status"></div>
