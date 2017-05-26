<?php

/**
 * Defines all the code for a select form field.
 */

class Tout_Buttons_Field_Select extends Tout_Buttons_Field {

	/**
	 * The options for the select menu.
	 *
	 * @var 		array 		The selection options.
	 */
	var $options;

	/**
	 * Class constructor.
	 *
	 * @since 		1.0.0
	 * @param 		string 		$context 			The field context.
	 *                               					settings: plugin settings
	 *                               					metabox: in a metabox
	 *                               					widget: in widget form
	 * @param 		array 		$attributes 		The field attributes.
	 * @param		array 		$properties 		The field properties.
	 * @param 		array 		$options 			The selection options.
	 */
	public function __construct( $context, $attributes, $properties, $options ) {

		$this->set_context( $context );

		$this->set_default_attributes();
		$this->set_default_select_attributes();
		$this->set_attributes( $attributes );
		$this->set_name_attribute();
		$this->set_value( $attributes );

		$this->set_default_properties();
		$this->set_default_select_properties();
		$this->set_properties( $properties );

		$this->set_options( $options );

		$this->output_label();
		$this->output_field();
		$this->output_description();

	} // __construct()

	/**
	 * Includes the select field HTML file.
	 *
	 * @since 		1.0.0
	 */
	public function output_field() {

		include( plugin_dir_path( dirname( __FILE__ ) ) . 'fields/partials/select.php' );

	} // output_field()

	/**
	 * Sets default attributes specific to select fields.
	 *
	 * @since 		1.0.0
	 */
	protected function set_default_select_attributes() {

		$this->default_attributes['aria-label'] = __( 'Select an option.', 'tout-buttons' );
		$this->default_attributes['type'] 		= '';

	} // set_default_select_attributes()

	/**
	 * Sets default properties specific to select fields.
	 *
	 * @since 		1.0.0
	 */
	protected function set_default_select_properties() {

		$this->default_properties['blank'] = __( '- Select -', 'tout-buttons' );
		$this->default_properties['error'] = __( 'There was an error with the options for this field.', 'tout-buttons' );

	} // set_default_select_properties()

	/**
	 * Sets the options for the select field.
	 *
	 * Options can be structured two ways:
	 * 		array( ''one,' two', 'three' );
	 * 		array( array( 'label => 'one', 'value' => 'ONE' ) );
	 *
	 * The first way creates both the labels and values with the individual array items.
	 * The second way creates separate labels and values from the subarray items.
	 *
	 * @param 		array 		$options 		The options array.
	 */
	protected function set_options( $options ) {

		$this->options = $options;

	} // set_options()

} // class
