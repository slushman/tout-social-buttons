<?php

/**
 * Defines all the code for a text form field.
 */

class Tout_Buttons_Field_Text extends Tout_Buttons_Field {

	/**
	 * Class constructor.
	 *
	 * @since 		1.0.0
	 * @param 		string 		$context 			The field context. Options:
	 *                               					settings: plugin settings
	 *                               					metabox: in a metabox
	 *                               					widget: in widget form
	 * @param 		array 		$attributes 		The field attributes.
	 * @param 		array 		$properties 		The field properties.
	 */
	public function __construct( $context, $attributes, $properties ) {

		$this->set_context( $context );
		$this->set_settings( $attributes, $properties );

		$this->set_default_attributes();
		$this->set_attributes( $attributes );
		$this->set_value( $attributes );
		$this->set_name_attribute();

		$this->set_default_properties();
		$this->set_properties( $properties );

		$this->output_label();
		$this->output_field();
		$this->output_description();

	} // __construct()

	/**
	 * Includes the text field HTML file.
	 *
	 * @since 		1.0.0
	 */
	public function output_field() {

		include( plugin_dir_path( dirname( __FILE__ ) ) . 'fields/partials/text.php' );

	} // output_field()

} // class
