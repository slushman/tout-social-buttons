<?php

/**
* The HTML for the set of social buttons.
*/

if ( empty( $this->buttons ) || ! is_array( $this->buttons ) ) { return; }

?><ul class="tout-social-buttons inactive" id="tout-social-inactive-buttons"><?php

	foreach ( $this->buttons as $button => $instance ) :

		include( plugin_dir_path( dirname( __FILE__ ) ) . 'partials/button.php' );

	endforeach;

?></ul><?php

$args['attributes']['id'] 		= 'inactive-buttons';
$args['attributes']['value'] 	= isset( $this->settings['inactive-buttons'] ) ? $this->settings['inactive-buttons'] : '';

new \ToutSocialButtons\Fields\Hidden( 'settings', $args );
