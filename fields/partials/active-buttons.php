<?php

/**
* The HTML for the set of social buttons.
*/

?><ul class="tout-social-buttons tout-social-active-buttons" id="tout-social-active-buttons"><?php

	foreach ( $this->buttons as $button => $instance ) :

		include( plugin_dir_path( dirname( __FILE__ ) ) . 'partials/button.php' );

	endforeach;

?></ul><?php

$args['attributes']['id'] 		= 'active-buttons';
$args['attributes']['value'] 	= isset( $this->settings['active-buttons'] ) ? $this->settings['active-buttons'] : '';

new \ToutSocialButtons\Fields\Hidden( 'settings', $args );

?><div class="buttons-status"></div>
