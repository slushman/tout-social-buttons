<?php

/**
 * Defines all the code for a hidden form field.
 */

class Tout_Buttons_Field_Hidden extends Tout_Buttons_Field {

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

		$this->set_default_hidden_attributes();
		$this->set_attributes( $attributes );
		$this->set_value( $attributes );
		$this->set_name_attribute();

		$this->output_field();

	} // __construct()

	/**
	 * Includes the hidden field HTML file.
	 *
	 * @since 		1.0.0
	 */
	public function output_field() {

		include( plugin_dir_path( dirname( __FILE__ ) ) . 'fields/partials/hidden.php' );

	} // output_field()

	/**
	 * Sets the default attributes for the hidden field type.
	 *
	 * @since 		1.0.0
	 */
	protected function set_default_hidden_attributes() {

		$this->default_attributes['name'] 	= '';
		$this->default_attributes['type'] 	= 'hidden';
		$this->default_attributes['value'] 	= '';

	} // set_default_hidden_attributes()

} // class
