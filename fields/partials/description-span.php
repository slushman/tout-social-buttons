<?php

/**
* The HTML for a field description in a span tag.
*/

?><span class="description <?php echo esc_attr( $this->properties['class-desc'] ); ?>"><?php echo wp_kses( $this->properties['description'], array( 'code' => array() ) ); ?></span>
