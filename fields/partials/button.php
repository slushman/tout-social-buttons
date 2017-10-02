<?php

/**
* The HTML for the single social buttons.
*/

?><li class="tout-social-button-wrap tout-social-button-wrap-<?php echo esc_attr( $button ); ?>" data-id="<?php echo esc_attr( $button ); ?>" id="tout-social-button-<?php echo esc_attr( $button ); ?>" title="<?php echo esc_attr( $button ); ?>">
	<span class="screen-reader-text"><?php

		echo $instance->get_a11y_text();

	?></span><?php

	echo $instance->get_icon();

	?><span class="tout-social-button-name"><?php

		echo $instance->get_name();

	?></span>
</li>
