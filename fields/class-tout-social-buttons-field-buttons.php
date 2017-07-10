<?php

/**
 * Defines all the code for a text form field.
 */

class Tout_Social_Buttons_Field_Buttons extends Tout_Social_Buttons_Field {

	/**
	 * The set of buttons.
	 *
	 * @var 	array 		Array of social buttons.
	 */
	var $buttons = array();

	/**
	 * Instance of the Tout_Social_Buttons_Display class.
	 *
	 * @var 	Tout_Social_Buttons_Display
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

		$this->set_context( $context );
		$this->set_settings( $attributes, $properties );
		$this->set_buttons();

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
	 * Includes the button field HTML file.
	 *
	 * @since 		1.0.0
	 */
	public function output_field() {

		include( plugin_dir_path( dirname( __FILE__ ) ) . 'fields/partials/button-set.php' );

	} // output_field()

	/**
	 * Sets the $buttons class variable.
	 *
	 * @since 		1.0.0
	 */
	protected function set_buttons() {

		$button_order 	= $this->settings['button-order'];
		$buttons 		= explode( ',', $button_order );

		/**
		 * The tout_social_buttons_admin_buttons filter.
		 *
		 * @param 		array 		$buttons 		Array of button derived from the button-order setting.
		 */
		$this->buttons 	= apply_filters( 'tout_social_buttons_admin_buttons', $buttons );

	} // set_buttons()

} // class
