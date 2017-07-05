<?php

/**
 * Defines all the code for a text form field.
 */

class Tout_Buttons_Field_Buttons extends Tout_Buttons_Field {

	/**
	 * The set of buttons.
	 *
	 * @var 	array 		Array of social buttons.
	 */
	var $buttons = array();

	/**
	 * Instance of the Tout_Buttons_Display class.
	 *
	 * @var 	Tout_Buttons_Display
	 */
	var $shared = '';

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

		//$this->set_buttons();
		$this->set_shared();

		$this->set_context( $context );
		$this->set_settings( $attributes, $properties );

		$this->set_default_attributes();
		$this->set_value( $attributes );
		$this->set_name_attribute();
		$this->set_attributes( $attributes );

		$this->set_default_properties();
		$this->set_properties( $properties );

		$this->output_fieldset_begin();
		$this->output_description_legend();
		$this->output_field();
		$this->output_alert();
		$this->output_fieldset_end();

	} // __construct()

	/**
	 * Returns the screen reader text based on the plugin setting.
	 *
	 * @exits 		If the $button parameter is empty.
	 * @since 		1.0.0
	 * @param 		string 		$button 		The name of the button.
	 * @return 		string 						The screen text.
	 */
	protected function get_screen_reader_text( $button ) {

		if ( empty( $button ) ) { return; }

		$return 		= '';

		if ( 'Email' === $button ) {

			$return	= sprintf( esc_html__( 'Share content by %s', 'tout-buttons' ), $button );

		} else {

			$return = sprintf( esc_html__( 'Share content on %s', 'tout-buttons' ), $button );

		}

		return $return;

	} // get_screen_reader_text()

	/**
	 * Includes the button field HTML file.
	 *
	 * @since 		1.0.0
	 */
	public function output_field() {

		include( plugin_dir_path( dirname( __FILE__ ) ) . 'fields/partials/buttons.php' );

	} // output_field()

	/**
	 * Sets the $buttons class variable.
	 *
	 * @since 		1.0.0
	 */
	protected function set_buttons() {

		$this->buttons = $this->shared->get_button_array();

	} // set_buttons()

	/**
	 * Sets the $shared class variable with a new instance of the Tout_Buttons_Display class.
	 *
	 * @since 		1.0.0
	 */
	protected function set_shared() {

		$this->shared = new Tout_Buttons_Display();

	} // set_shared()

} // class
