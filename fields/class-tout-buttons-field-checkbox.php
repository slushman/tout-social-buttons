<?php

/**
 * Defines all the code for a checkbox form field.
 */

class Tout_Buttons_Field_Checkbox extends Tout_Buttons_Field {

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
		$this->set_default_checkbox_attributes();
		$this->set_attributes( $attributes );
		$this->set_value( $attributes );
		$this->set_name_attribute();

		$this->set_default_properties();
		$this->set_default_checkbox_properties();
		$this->set_properties( $properties );

		$this->output_label_begin();
		$this->output_field();
		$this->output_description_span();
		$this->output_label_end();

	} // __construct()

	/**
	 * Includes the checkbox field HTML file.
	 *
	 * @since 		1.0.0
	 */
	public function output_field() {

		include( plugin_dir_path( dirname( __FILE__ ) ) . 'fields/partials/checkbox.php' );

	} // output_field()

	/**
	 * Sets default attributes specifically for checkbox fields.
	 *
	 * @since 		1.0.0
	 */
	protected function set_default_checkbox_attributes() {

		$this->default_attributes['type'] 	= 'checkbox';
		$this->default_attributes['value'] 	= 1;

	} // set_default_checkbox_attributes()

	/**
	 * Sets default properties specifically for checkbox fields.
	 *
	 * @since 		1.0.0
	 */
	protected function set_default_checkbox_properties() {

		$this->default_attributes['class-label'] 		= 'checkbox-label';
		$this->default_attributes['class-label-span'] 	= 'checkbox-label-text';

	} // set_default_checkbox_properties()

} // class
