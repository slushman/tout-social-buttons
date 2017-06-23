<?php

/**
 * Sanitize anything
 *
 * @since 			1.0.0
 * @package 		Tout_Buttons
 * @subpackage 		Tout_Buttons/includes
 */
class Tout_Buttons_Sanitize {

	/**
	 * Class constructor.
	 *
	 * @since 		1.0.0
	 */
	public function __construct() {} // __construct()

	/**
	 * Returns sanitized data.
	 *
	 * @since 		1.0.0
	 * @param 		mixed 		$data 		The data to sanitize.
	 * @param 		string  	$type 		The data type.
	 * @return 		mixed 					The sanitized data.
	 */
	public function clean( $data, $type ) {

		$check = '';

		if ( empty( $type ) ) {

			$check = new WP_Error( 'forgot_type', __( 'Specify the data type to sanitize.', 'tout-buttons' ) );

		}

		if ( is_wp_error( $check ) ) {

			wp_die( $check->get_error_message(), __( 'Forgot data type', 'tout-buttons' ) );

		}

		$sanitized = '';

		/**
		 * Add additional santization before the default sanitization.
		 */
		do_action( 'tout_buttons_pre_sanitize', $sanitized, $data, $type );

		switch ( $type ) {

			case 'radio'			:
			case 'select'			: $sanitized = $this->sanitize_random( $data ); break;

			case 'date'				:
			case 'datetime'			:
			case 'datetime-local'	:
			case 'time'				:
			case 'week'				: $sanitized = strtotime( $data ); break;

			case 'number'			:
			case 'range'			: $sanitized = intval( $data ); break;

			case 'hidden'			:
			case 'month'			:
			case 'image' 			:
			case 'text'				: $sanitized = sanitize_text_field( $data ); break;

			case 'checkbox'			: $sanitized = $data ? 1 : 0; break;
			case 'color' 			: $sanitized = $this->sanitize_color( $data ); break;
			case 'editor' 			: $sanitized = wp_kses_post( $data ); break;
			case 'email'			: $sanitized = sanitize_email( $data ); break;
			case 'file'				: $sanitized = esc_url_raw( $data ); break;
			case 'tel'				: $sanitized = $this->sanitize_phone( $data ); break;
			case 'textarea'			: $sanitized = esc_textarea( $data ); break;
			case 'url'				: $sanitized = esc_url_raw( $data ); break;

		} // switch

		/**
		 * Add additional santization after the default sanitization.
		 */
		do_action( 'tout_buttons_post_sanitize', $sanitized, $data, $type );

		return $sanitized;

	} // clean()

	/**
	 * Checks a date against a format to ensure its validity
	 *
	 * @since 		1.0.0
	 * @link 		http://www.php.net/manual/en/function.checkdate.php
	 * @param  		string 		$date   		The date as collected from the form field
	 * @param  		string 		$format 		The format to check the date against
	 * @return 		string 		A validated, formatted date
	 */
	private function validate_date( $date, $format = 'Y-m-d H:i:s' ) {

		$version = explode( '.', phpversion() );

		if ( ( (int) $version[0] >= 5 && (int) $version[1] >= 2 && (int) $version[2] > 17 ) ) {

			$d = DateTime::createFromFormat( $format, $date );

		} else {

			$d = new DateTime( date( $format, strtotime( $date ) ) );

		}

		return $d && $d->format( $format ) == $date;

	} // validate_date()

	/**
	 * Determines the type of color value and returns the result
	 * from the appropriate sanitization method.
	 *
	 * @exits 		If $color is empty.
	 * @since 		1.0.0
	 * @param 		string 		$color 		The color string.
	 * @return 		string 					The sanitized color string.
	 */
	private function sanitize_color( $color  ) {

		if ( empty( $color ) ) { return FALSE; }

		$four = substr( 0, 4 );

		switch ( $four ) {

			case 'rgba': return $this->sanitize_rgba_color( $color ); break;
			case 'hsla': return $this->sanitize_hsla_color( $color ); break;
			case 'rgb(': return $this->sanitize_rgb_color( $color ); break;
			case 'hsl(': return $this->sanitize_hsl_color( $color ); break;
			default : return sanitize_hex_color( $color ); break;

		}

	} // sanitize_color()

	/**
	 * Validates the input is a hex color.
	 *
	 * Based on the WP Core Customizer function sanitize_hex_color().
	 *
	 * @exits 		If $color is empty.
	 * @since 		1.0.0
	 * @see 		https://developer.wordpress.org/reference/functions/sanitize_hex_color/
	 * @param 		string 		$color 			The hex color string
	 * @return 		string 						The sanitized hex color string
	 */
	private function sanitize_hex_color( $color ) {

		if ( empty( $color ) ) { return FALSE; }

		$color = trim( $color );

		if ( preg_match('|^#([A-Fa-f0-9]{3}){1,2}$|', $color ) ) {

			return $color;

		}

		return FALSE;

	} // sanitize_hex_color()

	/**
	 * Sanitizes HSL color values.
	 *
	 * Checks if the color contains "hsl(". Returns if not.
	 * Then trims out extra space and remove the hsl( at the beginning
	 * and ) at the end.
	 * Creates an array from the remainder.
	 * Checks each value individually.
	 * 		$hue must be between 0 and 360.
	 *   	$sat must contain "%" and the rest must be between 0 and 100.
	 *   	$light must contain "%" and the rest must be between 0 and 100.
	 *
	 * @exits 		If the string does not contain "hsl(".
	 * @exits 		If $hue is not between 0 and 360.
	 * @exits 		If $sat does not contain "%".
	 * @exits 		If $light does not contain "%".
	 * @exits 		If $h, $s, or $l are empty.
	 * @since 		1.0.0
	 * @param 		string 		$color 		HSL color string.
	 * @return 		string 					Sanitized HSL color string.
	 */
	private function sanitize_hsl_color( $color ) {

		if ( false === strpos( $color, 'hsl(' ) ) { return; }

		$color 		= str_replace( ' ', '', $color );
		$sub 		= substr( 4, -1 );
		$subarray 	= explode( ',', $sub );
		list( $hue, $sat, $light ) = $subarray;

		$h = $s = $l = '';

		if ( 0 <= $hue && 360 >= $hue ) {

			$h = $hue;

		} else {

			return FALSE;

		} // $hue is between 0 & 360

		if ( false === strpos( $sat, '%' ) ) { return FALSE; } // $sat must contain "%"

		$sat = substr( 0, -1 );

		if ( 0 <= $sat && 100 >= $sat ) { $s = $sat; } // $sat must be between 0 & 100

		if ( false === strpos( $light, '%' ) ) { return FALSE; } // $light must contain "%"

		$light = substr( 0, -1 );

		if ( 0 <= $light && 100 >= $light ) { $l = $light; } // $light must be between 0 & 100

		if ( empty( $h ) || empty( $s ) || empty( $l ) ) { return FALSE; }

		return 'hsl(' . $h . ',' . $s . '%,' . $l . '%)';

	} // sanitize_hsl_color()

	/**
	 * Sanitizes HSLA color values.
	 *
	 * Checks if the color contains "hsla". Returns if not.
	 * Then trims out extra space and remove the hsla( at the beginning
	 * and ) at the end.
	 * Creates an array from the remainder.
	 * Checks each value individually.
	 * 		$hue must be between 0 and 360.
	 *   	$sat must contain "%" and the rest must be between 0 and 100.
	 *   	$light must contain "%" and the rest must be between 0 and 100.
	 *   	$alpha must be between 0 and 1.
	 *
	 * @exits 		If the string does not contain "hsla".
	 * @exits 		If $hue is not between 0 and 360.
	 * @exits 		If $sat does not contain "%".
	 * @exits 		If $light does not contain "%".
	 * @exits 		If $h, $s, $l, or $a are empty.
	 * @since 		1.0.0
	 * @param 		string 		$color 		HSLA color string.
	 * @return 		string 					Sanitized HSLA color string.
	 */
	private function sanitize_hsla_color( $color ) {

		if ( false === strpos( $color, 'hsla' ) ) { return; }

		$color 		= str_replace( ' ', '', $color );
		$sub 		= substr( 5, -1 );
		$subarray 	= explode( ',', $sub );
		list( $hue, $sat, $light, $alpha ) = $subarray;

		$h = $s = $l = $a = '';

		if ( 0 <= $hue && 360 >= $hue ) {

			$h = $hue;

		} else {

			return FALSE;

		} // $hue is between 0 & 360

		if ( false === strpos( $sat, '%' ) ) { return FALSE; } // $sat must contain "%"

		$sat = substr( 0, -1 );

		if ( 0 <= $sat && 100 >= $sat ) { $s = $sat; } // $sat must be between 0 & 100

		if ( false === strpos( $light, '%' ) ) { return FALSE; } // $light must contain "%"

		$light = substr( 0, -1 );

		if ( 0 <= $light && 100 >= $light ) { $l = $light; } // $light must be between 0 & 100

		if ( 0 <= $alpha && 1 >= $alpha ) { $l = $alpha; } // $alpha must be between 0 & 100

		if ( empty( $h ) || empty( $s ) || empty( $l ) || empty( $a ) ) { return FALSE; }

		return 'hsla(' . $h . ',' . $s . '%,' . $l . '%,' . $a . ')';

	} // sanitize_hsla_color()

	/**
	 * Sanitizes RGB color values.
	 *
	 * @since 		1.0.0
	 * @see 		https://github.com/aristath/ornea/blob/master/inc/kirki/includes/class-kirki-sanitize.php
	 * @param 		string 		$color 		RGB color string.
	 * @return 		string 					Sanitized RGB color string.
	 */
	private function sanitize_rgb_color( $color ) {

		if ( false === strpos( $color, 'rgb(' ) ) { return; }

		$color = str_replace( ' ', '', $color );
		sscanf( $color, 'rgb(%d,%d,%d)', $red, $green, $blue );
		return 'rgb(' . $red . ',' . $green . ',' . $blue . ')';

	} // sanitize_rgb_color()

	/**
	 * Sanitizes RGBA color values.
	 *
	 * @since 		1.0.0
	 * @see 		https://github.com/aristath/ornea/blob/master/inc/kirki/includes/class-kirki-sanitize.php
	 * @param 		string 		$color 		RGBA color string.
	 * @return 		string 					Sanitized RGBA color string.
	 */
	private function sanitize_rgba_color( $color ) {

		if ( false === strpos( $color, 'rgba' ) ) { return; }

		$color = str_replace( ' ', '', $color );
		sscanf( $color, 'rgba(%d,%d,%d,%f)', $red, $green, $blue, $alpha );
		return 'rgba('.$red.','.$green.','.$blue.','.$alpha.')';

	} // sanitize_rgba_color()

	/**
	 * Validates a phone number
	 *
	 * @exits 		If $phone is empty.
	 * @since		1.0.0
	 * @link		http://jrtashjian.com/2009/03/code-snippet-validate-a-phone-number/
	 * @param 		string 			$phone				A phone number string
	 * @return		string|bool		$phone|FALSE		Returns the valid phone number, FALSE if not
	 */
	private function sanitize_phone( $phone ) {

		if ( empty( $phone ) ) { return FALSE; }

		if ( preg_match( '/^[+]?([0-9]?)[(|s|-|.]?([0-9]{3})[)|s|-|.]*([0-9]{3})[s|-|.]*([0-9]{4})$/', $phone ) ) {

			return trim( $phone );

		} // $phone validation

		return FALSE;

	} // sanitize_phone()

	/**
	 * Performs general cleaning functions on data
	 *
	 * @exits 		If $input is empty.
	 * @since 		1.0.0
	 * @param 		mixed 	$input 		Data to be cleaned
	 * @return 		mixed 	$return 	The cleaned data
	 */
	private function sanitize_random( $input ) {

		if ( empty( $input ) ) { return ''; }

		$one	= trim( $input );
		$two	= stripslashes( $one );
		$return	= htmlspecialchars( $two );

		return $return;

	} // sanitize_random()

} // class
