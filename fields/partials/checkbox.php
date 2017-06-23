<?php

/**
* The HTML for a checkbox field.
*/

?><input type="hidden" value="0" name="<?php echo esc_attr( $this->attributes['name'] ); ?>" />
<input <?php

foreach ( $this->attributes as $key => $value ) :

    if ( 'data' === $key ) :

        foreach ( $this->attributes['data'] as $key => $value ) :

            echo 'data-' . $key . '="' . esc_attr( $value ) . '" ';

        endforeach;

    else :

        echo $key . '="' . esc_attr( $value ) . '" ';

    endif;

endforeach;

    checked( 1, $this->settings[$this->attributes['id']], true );

?>/>
